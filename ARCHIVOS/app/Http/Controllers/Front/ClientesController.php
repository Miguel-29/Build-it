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
use App\Models\Front\Cliente;
use App\Models\Admin\Profesion;
use App\Models\Admin\TagDocumento;
use App\Models\Admin\AreaProfesion;
use Illuminate\Routing\Controller;
use App\Support\Perfiles;
use App\Notifications\DatosUsuario;
use Illuminate\Notifications\Notifiable;
use App\Models\Admin\User;

class ClientesController extends Controller
{
    use Perfiles;

    public function crear($tipo)
    {
        return view('front.crear')->with('tipo',$tipo);
    }

    public function post_email($tipo,Request $request)
    {
        $recibir = $request->all();

        $idcliente = 0;

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
			return Redirect::back()->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
            $email = Cliente::where('email',$request->input('email'))->get();
            if ($email->count() == 0){
                $success = false;
                DB::beginTransaction();
                try {
                    //creamos el modelo
                    $cliente = new Cliente;
                    $cliente->email = $request->input('email');
                    $cliente->estado = 1;

                    //guardamos en la base de datos con el método save
                    if($cliente->save())
                    {   
                        $idcliente = $cliente->idcliente;
                        //creamos el modelo
                        $usuario = new User;
                        $usuario->iduserrelacion = $idcliente;
                        $usuario->tipoRelacion = 'Cliente';
                        $usuario->email = $request->input('email');
                        $usuario->name = 'Sin Asignar';
                        $usuario->lastname = 'Sin Asignar';
                        $usuario->password = Hash::make($request->input('password'));
                        //guardamos en la base de datos con el método save
                        if($usuario->save())
                        {

                            $usuario->assignRole('Cliente');
                            $success = true;
                            $token = 'Cliente';
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
                    Session::flash("mensaje","Cliente creado satisfactoriamente, ahora, rellena el siguiente formulario");
                    return Redirect::to('clientes/crear-c/'.$tipo.'/'.$idcliente.'/paso-1');
                } else {
                    DB::rollback();
                    Session::flash("errordataform","El cliente no pudo ser creado, inténtalo nuevamente.");
                    $mensajeerror="El cliente no pudo ser creado, inténtalo nuevamente.";
                    return Redirect::to('clientes/crear-c/'.$tipo.'')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
                }
            }else{
                Session::flash("errordataform","Ya existe un cliente con ese email, intenta con otro.");
                $mensajeerror="Ya existe un cliente con ese email, intenta con otro.";
                return view('front.crear')->with('tipo',$tipo);
            }
		}
    }

    public function paso1($tipo,$idcliente)
    {
        $cliente = Cliente::find($idcliente);
        return view('front.cliente.paso1')->with('tipo',$tipo)->with('idcliente',$idcliente)->with('cliente',$cliente);
    }

    public function post_paso1($tipo,$idcliente, Request $request)
    {
        $recibir = $request->all();


        if($request->input('tipo_persona') == "natural"){

            $reglas = array(

                'tipo_persona' => 'required',
                'nombre_razon_social' => 'required',
                'apellidos' => 'required|min:3',
                'pais' => 'required',
                'ciudad' => 'required',
                'fecha_nacimiento_creacion' => 'required',
                'direccion' => 'required',
                'tipo_documento' => 'required',
                'documento' => 'required|min:4',
                'edad' => 'required',
                'celular' => 'required'
    
            );
    
            if ($request->file('image')) {
                $reglas['image'] = 'required|mimes:jpg,jpeg,png,gif,pdf,xls|max:4096';
            }
    
        }else{

            $reglas = array(

                'nombres_razon_social' => 'required|min:3',
                'paises' => 'required',
                'ciudades' => 'required',
                'direcciones' => 'required|min:3',
                'nit_rut' => 'required',
                'descripcion_empresa' => 'required',
                'celulares' => 'required|min:5'
    
            );
    
            if ($request->file('imagen')) {
                $reglas['imagen'] = 'required|mimes:jpg,jpeg,png,gif,pdf,xls|max:4096';
            }

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
			return Redirect::back()->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
            $success = false;
            $urlFail = 'clientes/crear-c/'.$tipo.'/'.$idcliente.'/paso-1';
            $urlSuccess = 'clientes/login';
            $mensajeSuccess = "Haz guardado todos tus datos, ahora prosigue a crear tú proyecto.";
            DB::beginTransaction();
            try {

                if ($request->input('tipo_persona') == "natural"){
                    //creamos el modelo
                    $cliente = Cliente::find($idcliente);
                    $cliente ->tipo_persona = $request->input('tipo_persona');
                    $cliente->nombre_razon_social = $request->input('nombre_razon_social');
                    $cliente->apellidos = $request->input('apellidos');
                    $cliente->pais = $request->input('pais');
                    $cliente->ciudad = $request->input('ciudad');
                    $cliente->fecha_nacimiento_creacion = $request->input('fecha_nacimiento_creacion');
                    $cliente->direccion = $request->input('direccion');
                    $cliente->tipo_documento = $request->input('tipo_documento');
                    $cliente->documento = $request->input('documento');
                    $cliente->edad = $request->input('edad');
                    $cliente->celular = $request->input('celular');

                    if($request->file('image')){
                        $cover = $request->file('image');
                        $extension = time() . '.' . $cover->getClientOriginalExtension();
                        $destinationPath = public_path('uploads/front/cliente/general/'.$idcliente.'');
                        $cover->move($destinationPath, $cover->getFilename().'.'.$extension);
                        $cliente->image = $cover->getFilename().'.'.$extension;
                    }
                    
                    //guardamos en la base de datos con el método save
                    if($cliente->save())
                    {   
                        $usuario = User::where('iduserrelacion',$idcliente)->where('tipoRelacion','Cliente')->first();
                        $usuario->name = $request->input('nombre_razon_social');
                        $usuario->lastname = NULL;
                        $usuario->save();
    
                        $success = true;
                    }

                }else{

                    //creamos el modelo
                    $cliente = Cliente::find($idcliente);
                    $cliente ->tipo_persona = $request->input('tipo_persona');
                    $cliente->nombre_razon_social = $request->input('nombres_razon_social');
                    $cliente->pais = $request->input('paises');
                    $cliente->ciudad = $request->input('ciudades');
                    $cliente->direccion = $request->input('direcciones');
                    $cliente->nit_rut = $request->input('nit_rut');
                    $cliente->celular = $request->input('celulares');
                    $cliente->descripcion_empresa = $request->input('descripcion_empresa');

                    if($request->input('pagina_web')){
                        $cliente->pagina_web = $request->input('pagina_web');
                    }

                    if($request->input('redes_sociales')){
                        $cliente->redes_sociales = $request->input('redes_sociales');
                    }

                    if($request->file('imagen')){
                        $cover = $request->file('imagen');
                        $extension = time() . '.' . $cover->getClientOriginalExtension();
                        $destinationPath = public_path('uploads/front/cliente/general/'.$idcliente.'');
                        $cover->move($destinationPath, $cover->getFilename().'.'.$extension);
                        $cliente->image = $cover->getFilename().'.'.$extension;
                    }
                    //guardamos en la base de datos con el método save
                    if($cliente->save())
                    {   
                        $success = true;
                        
                    }
                }
            } catch (\Exception $e) {
                echo $e->getMessage();die();
                // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
            }
            //ahora creamos una variable de sesion antes de hacer la redirección
            if ($success) {
                if($request->get('editar')){
                    $urlSuccess = 'clientes/perfil-cliente/'.$idcliente;
                    $urlFail = 'clientes/editar-perfil/clientes/'.$idcliente;
                    $mensajeSuccess = 'Perfil Editado Correctamente';
                }

                DB::commit();
                Session::flash("mensaje",$mensajeSuccess);
                return Redirect::to($urlSuccess);
            } else {
                DB::rollback();
                Session::flash("errordataform","El perfil no pudo ser guardado, inténtalo nuevamente.");
                $mensajeerror="El perfil no pudo ser guardado, inténtalo nuevamente.";
                return Redirect::to($urlFail)->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }
}