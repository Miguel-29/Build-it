<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Form;
use View;
use Validator;
use Input;
use Redirect;
use Session;
use DateTime;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use App\Models\Front\Proveedor;
use App\Models\Admin\Profesion;
use App\Models\Admin\EspecialidadProveedor;
use App\Models\Admin\ServicioEspecialidad;
use App\Models\Admin\TagDocumento;
use App\Models\Admin\AreaProfesion;
use Illuminate\Routing\Controller;
use App\Support\Perfiles;
use App\Notifications\DatosUsuario;
use Illuminate\Notifications\Notifiable;
use App\Models\Admin\User;

class ProveedoresController extends Controller
{
    use Perfiles;

    public function crear($tipo)
    {
        return view('front.crear')->with('tipo',$tipo);
    }

    public function post_email($tipo,Request $request)
    {
        $recibir = $request->all();

        $idproveedor = 0;

		//creacion de reglas para validación en un array
		//creacion de reglas para validación en un array
		$reglas = array(
            'email' => 'required|email',
            'password' =>['required',
							'min:6',
							'max:100',
							'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',],
            'password_repite' => 'required|same:password',
            'terminos' => 'required'
        );
		//mensajes opcionales de validacion (sirve para cambiar los mensajes por defecto de una validación)
		$mensajes = array(
			'required'=>'Campo obligatorio',
			'min'=>'Longitud mínima de :min caracteres',
			'max'=>'Longitud mínima de :max caracteres',
			'email'=>'El email debe tener el formato ejemplo@ejemplo.ejemplo',
			'date_format'=>'Campo de fecha no valido',
			'after'=>'El valor de la fecha debe ser posterior al día de mañana o al inicio del rango',
            'regex'=>'Contraseña no cumple con las condiciones necesarias.',
            'numeric'=>'Este campo debe contener valores numéricos',
			'same'=>'El campo confirmación de password no coincide.'			
		);
		//logica de validación
		$validar = Validator::make($recibir,$reglas,$mensajes); //los mensajes son opcionales
		if($validar->fails())
		{
            Session::flash("errordataform","Revisa todos los campos para continuar.");
            $mensajeerror="Revisa todos los campos para continuar.";
			return Redirect::back()->with('errordataform',$mensajeerror)->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
            $email = Proveedor::where('email',$request->input('email'))->get();
            if ($email->count() == 0){
                $success = false;
                DB::beginTransaction();
                try {
                    //creamos el modelo
                    $proveedor = new Proveedor;
                    $proveedor->email = $request->input('email');
                    $proveedor->estado = 1;

                    //guardamos en la base de datos con el método save
                    if($proveedor->save())
                    {   
                        $idproveedor = $proveedor->idproveedor;
                        //creamos el modelo
                        $usuario = new User;
                        $usuario->iduserrelacion = $idproveedor;
                        $usuario->tipoRelacion = 'Proveedor';
                        $usuario->email = $request->input('email');
                        $usuario->name = 'Sin Asignar';
                        $usuario->lastname = 'Sin Asignar';
                        $usuario->password = Hash::make($request->input('password'));
                        //guardamos en la base de datos con el método save
                        if($usuario->save())
                        {

                            $usuario->assignRole('Proveedor');
                            $success = true;
                            $token = 'Proveedor';
                            $usuario->notify(new DatosUsuario($token));

                        }
                        
                        $success = true;
                    }

                } catch (\Exception $e) {
                    echo $e->getMessage();die();
                    // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
                }
                //ahora creamos una variable de sesion antes de hacer la redirección
                if ($success) {
                    DB::commit();
                    Session::flash("mensaje","Proveedor creado satisfactoriamente, ahora, rellena el siguiente formulario");
                    return Redirect::to('clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-1');
                } else {
                    DB::rollback();
                    Session::flash("errordataform","El proveedor no pudo ser creado, inténtalo nuevamente.");
                    $mensajeerror="El proveedor no pudo ser creado, inténtalo nuevamente.";
                    return Redirect::to('clientes/crear-p/'.$tipo.'')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
                }
            }else{
                
                Session::flash("errordataform","Ya existe un proveedor con ese email, intenta con otro.");
                $mensajeerror="Ya existe un proveedor con ese email, intenta con otro.";
                return view('front.crear')->with('tipo',$tipo);
            }

		}
    }

    public function paso1($tipo,$idproveedor)
    {
        $proveedor = Proveedor::find($idproveedor);
        return view('front.proveedor.paso1')->with('tipo',$tipo)->with('idproveedor',$idproveedor)->with('proveedor',$proveedor);
    }

    public function post_paso1($tipo,$idproveedor, Request $request)
    {
        $recibir = $request->all();

        $reglas = array(

            'nombre' => 'required',
            'pais_residencia' => 'required',
            'ciudad_residencia' => 'required',
            'direccion' => 'required',
            'nit_rut' => 'required',
            'celular' => 'required',
            'descripcion' => 'required',
            'presta_servicios_otras_ciudades' => 'required'

        );

        if ($request->file('image')) {
            $reglas['image'] = 'required|mimes:jpg,jpeg,png,gif,pdf,xls|max:4096';
        }

		//mensajes opcionales de validacion (sirve para cambiar los mensajes por defecto de una validación)
		$mensajes = array(
			'required'=>'Campo obligatorio',
			'min'=>'Longitud mínima de :min caracteres',
			'max'=>'Longitud mínima de :max caracteres',
			'email'=>'El email no es valido',
			'date_format'=>'Campo de fecha no valido',
			'after'=>'El valor de la fecha debe ser posterior al día de mañana o al inicio del rango',
            'regex'=>'Contraseña no cumple con las condiciones necesarias.',
            'numeric'=>'Este campo debe contener valores numéricos',
			'same'=>'El campo confirmación de password no coincide.'			
		);
		//logica de validación
		$validar = Validator::make($recibir,$reglas,$mensajes); //los mensajes son opcionales
		if($validar->fails())
		{
            Session::flash("errordataform","Revisa todos los campos para continuar.");
            $mensajeerror="Revisa todos los campos para continuar.";
			return Redirect::back()->with('errordataform',$mensajeerror)->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
            $success = false;
            $urlFail = 'clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-1';
            $urlSuccess = 'clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-2';
            $mensajeSuccess = "Paso guardado correctamente";

            DB::beginTransaction();
            try {

                //creamos el modelo
                $proveedor = Proveedor::find($idproveedor);
                $proveedor ->nombre = $request->input('nombre');
                $proveedor->pais_residencia = $request->input('pais_residencia');
                $proveedor->ciudad_residencia = $request->input('ciudad_residencia');
                $proveedor->direccion = $request->input('direccion');
                $proveedor->nit_rut = $request->input('nit_rut');
                $proveedor->celular = $request->input('celular');
                $proveedor->descripcion = $request->input('descripcion');
                $proveedor->presta_servicios_otras_ciudades = $request->input('presta_servicios_otras_ciudades');


                if($request->file('image')){
                    $cover = $request->file('image');
                    $extension = time() . '.' . $cover->getClientOriginalExtension();
                    $destinationPath = public_path('uploads/front/proveedor/general/'.$idproveedor.'');
                    $cover->move($destinationPath, $cover->getFilename().'.'.$extension);
                    $proveedor->image = $cover->getFilename().'.'.$extension;
                }

                if($request->input('rup')){
                    $proveedor->rup = $request->input('rup');
                }

                if($request->input('pagina_web')){
                    $proveedor->pagina_web = $request->input('pagina_web');
                }

                if($request->input('redes_sociales')){
                    $proveedor->redes_sociales = $request->input('redes_sociales');
                }

                if($request->input('anio_fundacion')){
                    $proveedor->anio_fundacion = $request->input('anio_fundacion');
                }

                //guardamos en la base de datos con el método save
                if($proveedor->save())
                {   
                    $usuario = User::where('iduserrelacion',$idproveedor)->where('tipoRelacion','Proveedor')->first();
                    $usuario->name = $request->input('nombre');
                    $usuario->lastname = NULL;
                    $usuario->save();

                    $success = true;
                }

            } catch (\Exception $e) {
                echo $e->getMessage();die();
                // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
            }
            if($request->get('editar')){
                $urlSuccess = 'clientes/perfil-proveedor/'.$idproveedor;
                $urlFail = 'clientes/editar-proveedor/proveedor/'.$idproveedor;
                $mensajeSuccess = 'Perfil Editado Correctamente';
            }

            //ahora creamos una variable de sesion antes de hacer la redirección
            if ($success) {
                DB::commit();
                Session::flash("mensaje",$mensajeSuccess);
                return Redirect::to($urlSuccess);
            } else {
                DB::rollback();
                Session::flash("errordataform","El paso no pudo ser guardado, inténtalo nuevamente.");
                $mensajeerror="El paso no pudo ser guardado, inténtalo nuevamente.";
                return Redirect::to($urlFail)->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }

    public function paso2($tipo,$idproveedor)
    {
        $proveedor = Proveedor::find($idproveedor);
        return view('front.proveedor.paso2')->with('tipo',$tipo)->with('idproveedor',$idproveedor)->with('proveedor',$proveedor);
    }

    public function post_paso2($tipo,$idproveedor, Request $request)
    {
        $recibir = $request->all();

        $reglas = array(

            'gerente_nombre' => 'required',
            'gerente_tipodocumento' => 'required',
            'gerente_documento' => 'required',
            'gerente_celular' => 'required',
        );

        if ($request->file('image')) {
            $reglas['image'] = 'required|mimes:jpg,jpeg,png,gif,pdf,xls|max:4096';
        }

		//mensajes opcionales de validacion (sirve para cambiar los mensajes por defecto de una validación)
		$mensajes = array(
			'required'=>'Campo obligatorio',
			'min'=>'Longitud mínima de :min caracteres',
			'max'=>'Longitud mínima de :max caracteres',
			'email'=>'El email no es valido',
			'date_format'=>'Campo de fecha no valido',
			'after'=>'El valor de la fecha debe ser posterior al día de mañana o al inicio del rango',
            'regex'=>'Contraseña no cumple con las condiciones necesarias.',
            'numeric'=>'Este campo debe contener valores numéricos',
			'same'=>'El campo confirmación de password no coincide.'			
		);
		//logica de validación
		$validar = Validator::make($recibir,$reglas,$mensajes); //los mensajes son opcionales
		if($validar->fails())
		{
            Session::flash("errordataform","Revisa todos los campos para continuar.");
            $mensajeerror="Revisa todos los campos para continuar.";
			return Redirect::back()->with('errordataform',$mensajeerror)->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
            $success = false;
            DB::beginTransaction();
            try {

                //creamos el modelo
                $proveedor = Proveedor::find($idproveedor);
                $proveedor ->gerente_nombre = $request->input('gerente_nombre');
                $proveedor ->gerente_tipodocumento = $request->input('gerente_tipodocumento');

                $proveedor ->gerente_documento = $request->input('gerente_documento');
                $proveedor ->gerente_celular = $request->input('gerente_celular');



                //guardamos en la base de datos con el método save
                if($proveedor->save())
                {   

                    $success = true;
                }

            } catch (\Exception $e) {
                echo $e->getMessage();die();
                // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
            }
            //ahora creamos una variable de sesion antes de hacer la redirección
            if ($success) {
                DB::commit();
                Session::flash("mensaje","Paso guardado correctamente");
                return Redirect::to('clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-3');
            } else {
                DB::rollback();
                Session::flash("errordataform","El paso no pudo ser guardado, inténtalo nuevamente.");
                $mensajeerror="El paso no pudo ser guardado, inténtalo nuevamente.";
                return Redirect::to('clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-2')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }

    public function paso3($tipo,$idproveedor)
    {
        $proveedor = Proveedor::find($idproveedor);
        $especialidades = EspecialidadProveedor::all();
        return view('front.proveedor.paso3')->with('tipo',$tipo)
        ->with('idproveedor',$idproveedor)
        ->with('proveedor',$proveedor)
        ->with('especialidades',$especialidades);
    }

    public function especialidad($especialidad)
    {
        return $servicio = ServicioEspecialidad::where('idespecialidad',$especialidad)->get();
    }

    public function post_paso3($tipo,$idproveedor, Request $request)
    {
        $recibir = $request->all();
        $proveedorP = Proveedor::find($idproveedor);

        $reglas = array(

            'idproveedor' => 'required'

        );
        if($proveedorP->especialidades->count() === 0 && $proveedorP->servicios->count() === 0 ){
            $reglas['idespecialidad'] = 'required';
            $reglas['idservicio'] = 'required';

        }


		//mensajes opcionales de validacion (sirve para cambiar los mensajes por defecto de una validación)
		$mensajes = array(
			'required'=>'Campo obligatorio',
			'min'=>'Longitud mínima de :min caracteres',
			'max'=>'Longitud mínima de :max caracteres',
			'email'=>'El email no es valido',
			'date_format'=>'Campo de fecha no valido',
			'after'=>'El valor de la fecha debe ser posterior al día de mañana o al inicio del rango',
            'regex'=>'Contraseña no cumple con las condiciones necesarias.',
            'numeric'=>'Este campo debe contener valores numéricos',
			'same'=>'El campo confirmación de password no coincide.'			
		);
		//logica de validación
		$validar = Validator::make($recibir,$reglas,$mensajes); //los mensajes son opcionales
		if($validar->fails())
		{
            Session::flash("errordataform","Debes agregar servicios relacionados a tu perfil.");
            $mensajeerror="Debes agregar servicios relacionados a tu perfil.";
			return Redirect::back()->with('errordataform',$mensajeerror)->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
            $proveedor = Proveedor::find($idproveedor);
            $success = false;
            $urlFail = 'clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-3';
            $urlSuccess = 'clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-4';
            $mensajeSuccess = "Paso guardado correctamente";

            DB::beginTransaction();
            try {

                $especialidadList = $request->input('idespecialidad');
                $servicioslist = $request->input('idservicio');
                if($especialidadList[0] == NULL || $servicioslist[0] == NULL){
                    $success = true;
                }else{

                    foreach($especialidadList as $key => $especialidad){
                        $especialidadID = $especialidad*1;
                        $proveedor->especialidades()->attach($especialidadID);    
                    }
                    if($proveedor->especialidades->count() > 0){
                        $success = true;
                        
    
                        foreach($servicioslist as $key => $services){
                            $serviceID = $services*1;
                            $proveedor->servicios()->attach($serviceID);
                        }
                        if($proveedor->servicios->count() > 0)
                        {   
                            $success = true;
                        }

                    }
                }

            } catch (\Exception $e) {
                echo $e->getMessage();die();
                // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
            }

            if($request->get('editar')){
                $urlSuccess = 'clientes/perfil-proveedor/'.$idproveedor;
                $urlFail = 'clientes/editar-proveedor/proveedor/'.$idproveedor.'/servicios';
                $mensajeSuccess = 'Perfil Editado Correctamente';
            }

            //ahora creamos una variable de sesion antes de hacer la redirección
            if ($success) {
                DB::commit();
                Session::flash("mensaje",$mensajeSuccess);
                return Redirect::to($urlSuccess);
            } else {
                DB::rollback();
                Session::flash("errordataform","El paso no pudo ser guardado, inténtalo nuevamente.");
                $mensajeerror="El paso no pudo ser guardado, inténtalo nuevamente.";
                return Redirect::to($urlFail)->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }

    public function paso4($tipo,$idproveedor)
    {
        $tag = TagDocumento::where('tipo','proveedor')->get();
        $proveedor = Proveedor::find($idproveedor);
        return view('front.proveedor.paso4')->with('tipo',$tipo)->with('idproveedor',$idproveedor)->with('proveedor',$proveedor)->with('tag',$tag);
    
    }

    public function post_paso4($tipo,$idproveedor, Request $request)
    {
        $recibir = $request->all();
        //creacion de reglas para validación en un array
        $reglas = array(
            'tipoDocumento' => 'required',
            'idrelacion' => 'required',
            'items' => 'required'
        );

		//mensajes opcionales de validacion (sirve para cambiar los mensajes por defecto de una validación)
		$mensajes = array(
			'required'=>'Campo obligatorio',
			'min'=>'Longitud mínima de :min caracteres',
			'max'=>'Longitud mínima de :max caracteres',
			'email'=>'El email no es valido',
			'date_format'=>'Campo de fecha no valido',
			'after'=>'El valor de la fecha debe ser posterior al día de mañana o al inicio del rango',
            'regex'=>'Contraseña no cumple con las condiciones necesarias.',
            'numeric'=>'Este campo debe contener valores numéricos',
			'same'=>'El campo confirmación de password no coincide.'			
		);
		//logica de validación
		$validar = Validator::make($recibir,$reglas,$mensajes); //los mensajes son opcionales
		if($validar->fails())
		{
			return Redirect::back()->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
            $success = false;
            DB::beginTransaction();
            try {

                $tipoDocumento = $request->input('tipoDocumento');
                $idrelacion = $request->input('idrelacion');
                $docs = $request->input('items');

                foreach ($docs as  $doc) {
                    $arrayValue = explode("_",$doc);
                    $idtag = $arrayValue[1];
                    $cover = $request->file('tag_'.$idtag);
                    $insertDocumentos = $this->saveDocumento($tipoDocumento,
                                                    $idrelacion,
                                                    $doc,
                                                    $cover);

                    
                    if($insertDocumentos){

                        $success = true;

                    }else{

                        $success = false;
                    }
                }

            } catch (\Exception $e) {
                echo $e->getMessage();die();
                // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
            }
            //ahora creamos una variable de sesion antes de hacer la redirección
            if ($success) {
                DB::commit();
                Session::flash("mensaje","Haz guardado todos tus datos, ahora prosigue a iniciar sesión.");
                return Redirect::to('clientes/login');
            } else {
                DB::rollback();
                Session::flash("errordataform","El paso no pudo ser guardado, inténtalo nuevamente.");
                $mensajeerror="El paso no pudo ser guardado, inténtalo nuevamente.";
                return Redirect::to('clientes/crear-p/'.$tipo.'/'.$idproveedor.'/paso-4')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }
}