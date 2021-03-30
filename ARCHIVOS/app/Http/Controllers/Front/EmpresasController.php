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
use App\Models\Front\Empresa;
use App\Models\Front\FormacionAcademica;
use App\Models\Front\ExperienciaLaboral;
use App\Models\Front\SupervisionTecnica;
use App\Models\Front\ModelacionBim;

use App\Models\Front\Revision;
use App\Models\Front\Idioma;

use App\Models\Front\Documento;
use App\Models\Admin\Profesion;
use App\Models\Admin\TagDocumento;
use App\Models\Admin\AreaProfesion;
use App\Models\Admin\Disciplina;
use App\Models\Admin\OpcionListado;
use App\Models\Admin\Listado;
use App\Models\Admin\SubUsoOcupacion;
use App\Models\Front\ProfesionEmpresa;
use Illuminate\Routing\Controller;
use App\Support\Perfiles;
use App\Notifications\DatosUsuario;
use Illuminate\Notifications\Notifiable;
use App\Models\Admin\User;

class EmpresasController extends Controller
{
    use Perfiles;

    public function crear($tipo)
    {
        return view('front.crear')->with('tipo',$tipo);
    }

    public function post_email($tipo,Request $request)
    {
        $recibir = $request->all();

        $idempresa = 0;

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
            $email = Empresa::where('email',$request->input('email'))->get();
            if ($email->count() == 0){

                $success = false;
                DB::beginTransaction();
                try {
                    //creamos el modelo
                    $empresa = new Empresa;
                    $email = $request->input('email');
                    $empresa->estado = 1;

                    //guardamos en la base de datos con el método save
                    if($empresa->save())
                    {   
                        $idempresa = $empresa->idempresa;
                        //creamos el modelo
                        $usuario = new User;
                        $usuario->iduserrelacion = $idempresa;
                        $usuario->tipoRelacion = 'Empresa';
                        $usuario->email = $request->input('email');
                        $usuario->name = 'Sin Asignar';
                        $usuario->lastname = 'Sin Asignar';
                        $usuario->password = Hash::make($request->input('password'));
                        //guardamos en la base de datos con el método save
                        if($usuario->save())
                        {

                            $usuario->assignRole('Empresa');
                            $success = true;
                            $token = 'Empresa';
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
                    Session::flash("mensaje","Empresa creado satisfactoriamente, ahora, rellena el siguiente formulario");
                    return Redirect::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-1');
                } else {
                    DB::rollback();
                    Session::flash("errordataform","La empresa no pudo ser creado, inténtalo nuevamente.");
                    $mensajeerror="La empresa no pudo ser creado, inténtalo nuevamente.";
                    return Redirect::to('clientes/crear-e/'.$tipo.'')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
                }
            }else{
                
                Session::flash("errordataform","Ya existe una empresa con ese email, intenta con otro.");
                $mensajeerror="Ya existe una empresa con ese email, intenta con otro.";
                return view('front.crear')->with('tipo',$tipo);
            }

		}
    }

    public function paso1($tipo,$idempresa)
    {
        $empresa = Empresa::find($idempresa);
        return view('front.empresa.paso1')->with('tipo',$tipo)->with('idempresa',$idempresa)->with('empresa',$empresa);
    }

    public function post_paso1($tipo,$idempresa, Request $request)
    {
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(

            'razon_social' => 'required|min:3',
            'pais' => 'required',
            'ciudad_residencia' => 'required',
            'direccion' => 'required|min:3',
            'nit' => 'required',
            'anio_fundacion' => 'required',
            'celular' => 'required|min:5',
            'nacionalidad' => 'required',
            'descripcion_empresa' => 'required',
            'presta_servicios_otras_ciudades' => 'required',

        );

        if ($request->file('image')) {
            $reglas['image'] = 'required|mimes:jpg,jpeg,png|max:4096';
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
            'mimes'=>'Este campo solo acepta formatos (jpg,jpeg,png)',
			'same'=>'El campo confirmación de password no coincide.'			
		);
		//logica de validación
        $validar = Validator::make($recibir,$reglas,$mensajes); //los mensajes son opcionales
        Session::put('ciudad', $request->input('ciudad_residencia'));

		if($validar->fails())
		{
            Session::put('ciudad', $request->input('ciudad_residencia'));

            Session::flash("errordataform","Revisa todos los campos para continuar.");
            $mensajeerror="Revisa todos los campos para continuar.";
			return Redirect::back()->with('errordataform',$mensajeerror)->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
            $success = false;
            $urlFail = 'clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-1';
            $urlSuccess = 'clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-2';
            $mensajeSuccess = "Paso guardado correctamente";

            DB::beginTransaction();
            try {
                //creamos el modelo
                $empresa = Empresa::find($idempresa);
                $empresa->razon_social = $request->input('razon_social');
                $empresa->pais = $request->input('pais');
                $empresa->ciudad_residencia = $request->input('ciudad_residencia');
                $empresa->nit = $request->input('nit');
                $empresa->anio_fundacion = $request->input('anio_fundacion');
                $empresa->direccion = $request->input('direccion');
                $empresa->celular = $request->input('celular');
                $empresa->nacionalidad = $request->input('nacionalidad');
                $empresa->descripcion_empresa = $request->input('descripcion_empresa');
                $empresa->presta_servicios_otras_ciudades = $request->input('presta_servicios_otras_ciudades');


                if($request->file('image')){
					$cover = $request->file('image');
					$extension = time() . '.' . $cover->getClientOriginalExtension();
					$destinationPath = public_path('uploads/front/empresa/general/'.$idempresa.'');
					$cover->move($destinationPath, $cover->getFilename().'.'.$extension);
					$empresa->image = $cover->getFilename().'.'.$extension;
                }
                
                if($request->input('rup')){
                    $empresa->rup = $request->input('rup');
                }

                if($request->input('pagina_web')){
                    $empresa->pagina_web = $request->input('pagina_web');
                }

                if($request->input('redes_sociales')){
                    $empresa->redes_sociales = $request->input('redes_sociales');
                }

                //guardamos en la base de datos con el método save
                if($empresa->save())
                {   
                    $usuario = User::where('iduserrelacion',$idempresa)->where('tipoRelacion','Empresa')->first();
                    $usuario->name = $request->input('razon_social');
                    $usuario->lastname = NULL;
                    $usuario->save();
                    $success = true;
                }

            } catch (\Exception $e) {
                echo $e->getMessage();die();
                // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
            }

            if($request->get('editar')){
                $urlSuccess = 'clientes/perfil-empresa/'.$idempresa;
                $urlFail = 'clientes/editar-empresa/empresa/'.$idempresa;
                $mensajeSuccess = 'Perfil Editado Correctamente';
            }

            //ahora creamos una variable de sesion antes de hacer la redirección
            if ($success) {
                DB::commit();
                Session::flash("mensaje",$mensajeSuccess);
                Session::put('ciudad', $request->input('ciudad_residencia'));

                return Redirect::to($urlSuccess);
            } else {
                DB::rollback();
                Session::flash("errordataform","El paso no pudo ser guardado, inténtalo nuevamente.");
                Session::put('ciudad', $request->input('ciudad_residencia'));

                $mensajeerror="El paso no pudo ser guardado, inténtalo nuevamente.";
                return Redirect::to($urlFail)->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }

    public function paso2($tipo,$idempresa)
    {
        $empresa = Empresa::find($idempresa);
        $disciplinas = Disciplina::where('asociada_a','profesionales')->orderBy( 'nombre','ASC')->get();
        return view('front.empresa.paso2')->with('tipo',$tipo)
        ->with('idempresa',$idempresa)
        ->with('empresa',$empresa)
        ->with('disciplinas',$disciplinas);
    }

    public function addDisciplinas($idempresa)
    {
        $empresa = Empresa::find($idempresa);
        $tipo = 'empresa';
        $disciplinas = Disciplina::where('asociada_a','profesionales')->orderBy( 'nombre','ASC')->get();
        return view('front.empresa.add-disciplinas')->with('tipo',$tipo)
        ->with('idempresa',$idempresa)
        ->with('empresa',$empresa)
        ->with('disciplinas',$disciplinas);
    }

    public function post_savedisciplina($tipo,$idempresa, Request $request)
    {
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(

            'fp_linea_enfoque_area' => 'required',
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
            Session::flash("errordataform","Completa los campos obligatorios para continuar.");
            $mensajeerror="Completa los campos obligatorios para continuar.";
			return Redirect::back()->with('errordataform',$mensajeerror)->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
            $success = false;
            DB::beginTransaction();
            try {
                //creamos el modelo
                $iddisciplina =  $request->input('fp_linea_enfoque_area');
                $empresa = Empresa::find($idempresa);
                $disciplinasGuardadas = ProfesionEmpresa::where('idrelacion',$idempresa)->where('iddisciplina',$iddisciplina)->first();
                if($disciplinasGuardadas == NULL){
                    $disciplinasGuardadas = new ProfesionEmpresa;
                }    
                $disciplinasGuardadas->idrelacion = $idempresa;
                $disciplinasGuardadas->iddisciplina = $iddisciplina;
                
                //guardamos en la base de datos con el método save
                if($disciplinasGuardadas->save())
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
                Session::flash("mensaje","Disciplina agregada correctamente");
                return Redirect::to('clientes/perfil-empresa/'.$idempresa);
            } else {
                DB::rollback();
                Session::flash("errordataform","La disciplina no pudo ser guardada, inténtalo nuevamente.");
                $mensajeerror="La disciplina no pudo ser guardada, inténtalo nuevamente.";
                return Redirect::to('clientes/perfil-empresa/'.$idempresa)->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }

    public function profesion($profesion)
    {
        $profesion = Profesion::find($profesion);
        $disciplinas = $profesion->disciplinas;   

        return $disciplinas;
    }

    public function post_paso2($tipo,$idempresa, Request $request)
    {
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(

            'fp_linea_enfoque_area' => 'required',
            'fp_descripcion_profesional' => 'required|min:3',
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
            Session::flash("errordataform","Revisa todos los campos para continuar.");
            $mensajeerror="Revisa todos los campos para continuar.";
			return Redirect::back()->with('errordataform',$mensajeerror)->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
            $success = false;
            DB::beginTransaction();
            try {
                //creamos el modelo
                $empresa = Empresa::find($idempresa);
                $iddisciplina =  $request->input('fp_linea_enfoque_area');
                $disciplinasGuardadas = ProfesionEmpresa::where('idrelacion',$idempresa)->where('iddisciplina',$iddisciplina)->first();
                if($disciplinasGuardadas == NULL){
                    $disciplinasGuardadas = new ProfesionEmpresa;
                }    
                $disciplinasGuardadas->idrelacion = $idempresa;
                $disciplinasGuardadas->iddisciplina = $iddisciplina;

                $empresa->fp_descripcion_profesional = $request->input('fp_descripcion_profesional');
                
                //guardamos en la base de datos con el método save
                if($disciplinasGuardadas->save() && $empresa->save())
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
                return Redirect::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-3');
            } else {
                DB::rollback();
                Session::flash("errordataform","El paso no pudo ser guardado, inténtalo nuevamente.");
                $mensajeerror="El paso no pudo ser guardado, inténtalo nuevamente.";
                return Redirect::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-2')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }

    public function paso3($tipo,$idempresa)
    {
        $empresa = Empresa::find($idempresa);
        $profesiones = Profesion::where('estado',1)->get();
        return view('front.empresa.paso3')->with('tipo',$tipo)
        ->with('idempresa',$idempresa)
        ->with('empresa',$empresa)
        ->with('profesiones',$profesiones);
    }

    public function post_paso3($tipo,$idempresa, Request $request)
    {
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(

            'gerente_nombres' => 'required',
            'gerente_apellidos' => 'required',
            'gerente_celular' => 'required',
            'gerente_idprofesion' => 'required',
            'gerente_iddisciplina' => 'required',
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
            Session::flash("errordataform","Revisa todos los campos para continuar.");
            $mensajeerror="Revisa todos los campos para continuar.";
			return Redirect::back()->with('errordataform',$mensajeerror)->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
            $success = false;
            DB::beginTransaction();
            try {
                //creamos el modelo
                $empresa = Empresa::find($idempresa);
                $empresa->gerente_nombres = $request->input('gerente_nombres');
                $empresa->gerente_apellidos = $request->input('gerente_apellidos');
                $empresa->gerente_celular = $request->input('gerente_celular');

                $empresa->gerente_idprofesion = $request->input('gerente_idprofesion');
                $empresa->gerente_iddisciplina = $request->input('gerente_iddisciplina');
                
                //guardamos en la base de datos con el método save
                if($empresa->save())
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
                return Redirect::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-5');
            } else {
                DB::rollback();
                Session::flash("errordataform","El paso no pudo ser guardado, inténtalo nuevamente.");
                $mensajeerror="El paso no pudo ser guardado, inténtalo nuevamente.";
                return Redirect::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-3')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }

    public function paso4($tipo,$idempresa)
    {
        $empresa = Empresa::find($idempresa);
        $formacion = FormacionAcademica::where('tipo_relacion','empresa')->where('idrelacion',$idempresa)->get();
        return view('front.empresa.paso4')->with('tipo',$tipo)->with('idempresa',$idempresa)->with('empresa',$empresa)->with('formacion',$formacion);
    }



    public function post_paso4($tipo,$idempresa, Request $request)
    {
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(

            'tipo_relacion' => 'required',
            'idrelacion' => 'required',
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

                $tipo_relacion = $request->input('tipo_relacion');
                $idrelacion = $request->input('idrelacion');
                $tipoFormacion = $request->input('tipoFormacion');
                $nivelFormacion = $request->input('nivelFormacion');
                $titulo = $request->input('titulo');
                $universidad = $request->input('universidad');
                $anio_culminacion = $request->input('anio_culminacion');


                $insertFormation = $this->saveFormacionAcademica(
                                                                    $tipo_relacion,
                                                                    $idrelacion,
                                                                    $tipoFormacion,
                                                                    $nivelFormacion,
                                                                    $titulo,
                                                                    $universidad,
                                                                    $anio_culminacion);

                if($insertFormation){

                    $success = true;

                }else{

                    $success = false;
                }

            } catch (\Exception $e) {
                echo $e->getMessage();die();
                // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
            }
            //ahora creamos una variable de sesion antes de hacer la redirección
            if ($success) {
                DB::commit();
                Session::flash("mensaje","Paso guardado correctamente");
                return Redirect::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-5');
            } else {
                DB::rollback();
                Session::flash("errordataform","El paso no pudo ser guardado, inténtalo nuevamente.");
                $mensajeerror="El paso no pudo ser guardado, inténtalo nuevamente.";
                return Redirect::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-4')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }

    public function paso5($tipo,$idempresa, Request $request)
    {
        $empresa = Empresa::find($idempresa);
        if($request->get('disciplinas')){
            $disciplinas = ProfesionEmpresa::where('idrelacion',$idempresa)->where('iddisciplina',$request->get('disciplinas'))->first();
            $disciplinas = $disciplinas->disciplinas;

        }else{
            $disciplinas = $empresa->disciplinas->last();
        }
        if($disciplinas->nombre == "Diseño estructural"){

            $opcion1 = Listado::where('nombre','diseno_estructural_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_diseno_estructural_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }elseif($disciplinas->nombre == "Hidráulica e Hidrosanitaria"){

            $opcion1 = Listado::where('nombre','hidraulica_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_hidraulica_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }elseif($disciplinas->nombre == "Topografía"){

            $opcion1 = Listado::where('nombre','topografia_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_topografia_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }elseif($disciplinas->nombre == "Diseño arquitectónico"){

            $opcion1 = Listado::where('nombre','diseno_arquitectonico_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_diseno_arquitectonico_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }elseif($disciplinas->nombre == "Geotécnia"){

            $opcion1 = Listado::where('nombre','geotecnia_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_geotecnia_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }elseif($disciplinas->nombre == "Urbanismo"){

            $opcion1 = Listado::where('nombre','urbanismo_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_urbanismo_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Gerencia"){

            $opcion1 = Listado::where('nombre','gerencia_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_gerencia_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Ing. Eléctrica"){

            $opcion1 = Listado::where('nombre','electrica_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_electrica_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Electrónica" || $disciplinas->nombre == "Ing. Electrónica"){

            $opcion1 = Listado::where('nombre','electronica_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_electronica_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Construcción"){

            $opcion1 = Listado::where('nombre','construccion_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_construccion_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Arqueología"){

            $opcion1 = Listado::where('nombre','arqueologia_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_arqueologia_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Diseño acústico"){

            $opcion1 = Listado::where('nombre','diseno_acustico_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_diseno_acustico_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Diseño bioclimático"){

            $opcion1 = Listado::where('nombre','diseno_bioclimatico_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_diseno_bioclimatico_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Telecomunicaciones"){

            $opcion1 = Listado::where('nombre','telecomunicaciones_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_telecomunicaciones_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Diseño de interiores"){

            $opcion1 = Listado::where('nombre','diseno_interiores_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_diseno_interiores_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Ing. Mecánica"){

            $opcion1 = Listado::where('nombre','ing_mecanica_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_ing_mecanica_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Gestión Ambiental"){

            $opcion1 = Listado::where('nombre','gestion_ambiental_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_gestion_ambiental_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Derecho"){

            $opcion1 = Listado::where('nombre','derecho_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_derecho_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Patrimonio"){

            $opcion1 = Listado::where('nombre','patrimonio_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_patrimonio_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Diseño Geométrico de vías y Estudio de tráfico"){

            $opcion1 = Listado::where('nombre','diseno_geometrico_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_diseno_geometrico_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Seguridad humana"){

            $opcion1 = Listado::where('nombre','seguridad_humana_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_seguridad_humana_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Infraestructura vial y Pavimentos"){

            $opcion1 = Listado::where('nombre','infraestructura_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_infraestructura_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Contabilidad"){

            $opcion1 = Listado::where('nombre','contabilidad_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_contabilidad_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Asesoría comercial"){

            $opcion1 = Listado::where('nombre','asesor_comercial_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_asesor_comercial_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Publicidad"){

            $opcion1 = Listado::where('nombre','publicidad_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_publicidad_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        else{

            $opcion1 = Listado::where('nombre','diseno_estructural_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_diseno_estructural_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        $subUso = SubUsoOcupacion::all();
        $experiencia = ExperienciaLaboral::where('tipo_relacion','empresa')->where('idrelacion',$idempresa)->where('iddisciplina',$disciplinas->iddisciplina)->first();
        $idioma = Idioma::where('tipo_relacion','empresa')->where('idrelacion',$idempresa)->where('iddisciplina',$disciplinas->iddisciplina)->get();
        $iddisciplina = $disciplinas->iddisciplina;
        $opcion3 = Listado::where('nombre','idiomas')->first();
        $nombreIdioma = OpcionListado::where('idlistado',$opcion3->idlistado)->get();
        $opcion4 = Listado::where('nombre','nivel_idiomas')->first();
        $nivelIdioma = OpcionListado::where('idlistado',$opcion4->idlistado)->get();

        return view('front.empresa.paso5')
        ->with('tipo',$tipo)
        ->with('idempresa',$idempresa)
        ->with('empresa',$empresa)
        ->with('subUso',$subUso)
        ->with('actividad',$actividad)
        ->with('software',$software)
        ->with('iddisciplina',$iddisciplina)
        ->with('nombreIdioma',$nombreIdioma)
        ->with('nivelIdioma',$nivelIdioma)
        ->with('experiencia',$experiencia)
        ->with('idioma',$idioma);
    }

    public function post_paso5($tipo,$idempresa, Request $request)
    {
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(

            'tipo_relacion' => 'required',
            'idrelacion' => 'required',
            'iddisciplina' => 'required',
            'anios_experiencia' => 'required',
            'm2_disenados' => 'required',
            'tipo_estructuras_disenadas' => 'required',
            'actividades_desempena' => 'required',
            'uso_software' => 'required',
            'disponibilidad_personal' => 'required',
            'disponibilidad_viajar' => 'required',
            'tipo_contratacion' => 'required'

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
            Session::flash("errordataform","Revisa todos los campos para continuar.");
            $mensajeerror="Revisa todos los campos para continuar.";
			return Redirect::back()->with('errordataform',$mensajeerror)->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
            $success = false;
            $urlFail = 'clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-5';
            $urlSuccess = 'clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-6';
            $mensajeSuccess = "Paso guardado correctamente";
    
            DB::beginTransaction();
            try {

                //creamos el modelo
                $estructuras = $request->input('tipo_estructuras_disenadas');
                $estructuras = implode(',', $estructuras);
                
                $actividades = $request->input('actividades_desempena');
                $actividades = implode(',', $actividades);

                $software = $request->input('uso_software');
                $software = implode(',', $software);

                $tipo_relacion = $request->input('tipo_relacion');
                $idrelacion = $request->input('idrelacion');
                $iddisciplina = $request->input('iddisciplina');
                $anios_experiencia = $request->input('anios_experiencia');
                $m2_disenados = $request->input('m2_disenados');
                $tipo_estructuras_disenadas = $estructuras;
                $actividades_desempena = $actividades;
                $uso_software = $software;
                $disponibilidad_personal = $request->input('disponibilidad_personal');
                $certificados_cursos_seminarios = $request->input('certificados_cursos_seminarios');
                $disponibilidad_viajar = $request->input('disponibilidad_viajar');
                $nombreIdioma = $request->input('nombreIdioma');
                $nivelIdioma = $request->input('nivelIdioma');
                $tipo_contratacion = $request->input('tipo_contratacion');
                $costo_por_unidad_contratacion = 0;

                $insertExperiencia = $this->saveExperienciaLaboral(
                                                                    $tipo_relacion,
                                                                    $idrelacion,
                                                                    $anios_experiencia,
                                                                    $m2_disenados,
                                                                    $tipo_estructuras_disenadas,
                                                                    $actividades_desempena,
                                                                    $uso_software,
                                                                    $disponibilidad_personal,
                                                                    $certificados_cursos_seminarios,
                                                                    $disponibilidad_viajar,
                                                                    $tipo_contratacion,
                                                                    $costo_por_unidad_contratacion,
                                                                    $iddisciplina);

                if($insertExperiencia){
                    $success = true;
                    if($nombreIdioma[0] !== NULL && $nivelIdioma[0] !== NULL){
                        $insertIdiomas = $this->saveIdiomas(
                            $tipo_relacion,
                            $idrelacion,
                            $nombreIdioma,
                            $nivelIdioma,
                            $iddisciplina);

                        if($insertIdiomas){

                        $success = true;

                        }else{

                        $success = false;

                        }
                
                    }

                }else{

                    $success = false;
                }

            } catch (\Exception $e) {
                echo $e->getMessage();die();
                // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
            }
            if($request->get('editar')){
                $urlSuccess = 'clientes/perfil-empresa/'.$idempresa;
                $urlFail = 'clientes/editar-empresa/empresa/'.$idempresa.'/experiencia-laboral';
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

    public function paso6($tipo,$idempresa, Request $request)
    {
        $empresa = Empresa::find($idempresa);
        if($request->get('disciplinas')){
            $disciplinas = ProfesionEmpresa::where('idrelacion',$idempresa)->where('iddisciplina',$request->get('disciplinas'))->first();
            $disciplinas = $disciplinas->disciplinas;

        }else{
            $disciplinas = $empresa->disciplinas->last();
        }

        if($disciplinas->nombre == "Diseño estructural"){

            $opcion1 = Listado::where('nombre','diseno_estructural_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_diseno_estructural_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }elseif($disciplinas->nombre == "Hidráulica e Hidrosanitaria"){

            $opcion1 = Listado::where('nombre','hidraulica_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_hidraulica_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }elseif($disciplinas->nombre == "Topografía"){

            $opcion1 = Listado::where('nombre','topografia_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_topografia_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }elseif($disciplinas->nombre == "Diseño arquitectónico"){

            $opcion1 = Listado::where('nombre','diseno_arquitectonico_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_diseno_arquitectonico_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }elseif($disciplinas->nombre == "Geotécnia"){

            $opcion1 = Listado::where('nombre','geotecnia_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_geotecnia_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }elseif($disciplinas->nombre == "Urbanismo"){

            $opcion1 = Listado::where('nombre','urbanismo_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_urbanismo_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Gerencia"){

            $opcion1 = Listado::where('nombre','gerencia_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_gerencia_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Ing. Eléctrica"){

            $opcion1 = Listado::where('nombre','electrica_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_electrica_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Electrónica" || $disciplinas->nombre == "Ing. Electrónica"){

            $opcion1 = Listado::where('nombre','electronica_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_electronica_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Construcción"){

            $opcion1 = Listado::where('nombre','construccion_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_construccion_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Arqueología"){

            $opcion1 = Listado::where('nombre','arqueologia_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_arqueologia_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Diseño acústico"){

            $opcion1 = Listado::where('nombre','diseno_acustico_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_diseno_acustico_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Diseño bioclimático"){

            $opcion1 = Listado::where('nombre','diseno_bioclimatico_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_diseno_bioclimatico_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Telecomunicaciones"){

            $opcion1 = Listado::where('nombre','telecomunicaciones_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_telecomunicaciones_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Diseño de interiores"){

            $opcion1 = Listado::where('nombre','diseno_interiores_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_diseno_interiores_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Ing. Mecánica"){

            $opcion1 = Listado::where('nombre','ing_mecanica_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_ing_mecanica_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Gestión Ambiental"){

            $opcion1 = Listado::where('nombre','gestion_ambiental_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_gestion_ambiental_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Derecho"){

            $opcion1 = Listado::where('nombre','derecho_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_derecho_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Patrimonio"){

            $opcion1 = Listado::where('nombre','patrimonio_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_patrimonio_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Diseño Geométrico de vías y Estudio de tráfico"){

            $opcion1 = Listado::where('nombre','diseno_geometrico_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_diseno_geometrico_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Seguridad humana"){

            $opcion1 = Listado::where('nombre','seguridad_humana_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_seguridad_humana_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Infraestructura vial y Pavimentos"){

            $opcion1 = Listado::where('nombre','infraestructura_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_infraestructura_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Contabilidad"){

            $opcion1 = Listado::where('nombre','contabilidad_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_contabilidad_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Asesoría comercial"){

            $opcion1 = Listado::where('nombre','asesor_comercial_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_asesor_comercial_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Publicidad"){

            $opcion1 = Listado::where('nombre','publicidad_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_publicidad_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        else{

            $opcion1 = Listado::where('nombre','diseno_estructural_empresa')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_diseno_estructural_empresa')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        $subUso = SubUsoOcupacion::all();
        $modelacion = ModelacionBim::where('tipo_relacion','empresa')->where('idrelacion',$idempresa)->where('iddisciplina',$disciplinas->iddisciplina)->first();
        $iddisciplina = $disciplinas->iddisciplina;
        return view('front.empresa.paso6')
        ->with('tipo',$tipo)
        ->with('idempresa',$idempresa)
        ->with('empresa',$empresa)
        ->with('subUso',$subUso)
        ->with('actividad',$actividad)
        ->with('iddisciplina',$iddisciplina)
        ->with('software',$software)
        ->with('modelacion',$modelacion);
    }

    public function post_paso6($tipo,$idempresa, Request $request)
    {
        $recibir = $request->all();

        if($request->input('ha_trabajado_bim') == "1"){

            //creacion de reglas para validación en un array
            $reglas = array(
                'tipo_relacion' => 'required',
                'idrelacion' => 'required',
                'iddisciplina' => 'required',
                'ha_trabajado_bim' => 'required',
                'anios_experiencia' => 'required',
                'm2_disenados_bim' => 'required',
                'tipo_estructuras_disenadas' => 'required',
                'uso_software_bim' => 'required',
                'tiene_certificados_bim' => 'required'
            );

        }else{

            $reglas = array(
                'tipo_relacion' => 'required',
                'idrelacion' => 'required',
                'iddisciplina' => 'required',
                'ha_trabajado_bim' => 'required',
                'desea_aprender_bim'=>'required'
            );

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
            $urlFail = 'clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-6';
            $urlSuccess = 'clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-7';
            $mensajeSuccess = "Paso guardado correctamente";

            DB::beginTransaction();
            try {

                //creamos el modelo
                $estructuras = $request->input('tipo_estructuras_disenadas');
                if($estructuras !== NULL){
                    $estructuras = implode(',', $estructuras);
                }
                
                $software = $request->input('uso_software_bim');
                if($software !== NULL){
                    $software = implode(',', $software);

                }
                
                $tipo_relacion = $request->input('tipo_relacion');
                $idrelacion = $request->input('idrelacion');
                $iddisciplina = $request->input('iddisciplina');
                $ha_trabajado_bim = $request->input('ha_trabajado_bim');
                $anios_experiencia = $request->input('anios_experiencia');
                $m2_disenados_bim = $request->input('m2_disenados_bim');
                $tipo_estructuras_disenadas = $estructuras;
                $uso_software_bim = $software;
                $tiene_certificados_bim = $request->input('tiene_certificados_bim');
                $desea_aprender_bim = $request->input('desea_aprender_bim');

                $insertModelacion = $this->saveModelacion(
                                                            $tipo_relacion,
                                                            $idrelacion,
                                                            $ha_trabajado_bim,
                                                            $anios_experiencia,
                                                            $m2_disenados_bim,
                                                            $tipo_estructuras_disenadas,
                                                            $uso_software_bim,
                                                            $tiene_certificados_bim,
                                                            $desea_aprender_bim,
                                                            $iddisciplina);

                if($insertModelacion){

                    $success = true;

                }else{

                    $success = false;
                }

            } catch (\Exception $e) {
                echo $e->getMessage();die();
                // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
            }

            if($request->get('editar')){
                $urlSuccess = 'clientes/perfil-empresa/'.$idempresa;
                $urlFail = 'clientes/editar-empresa/empresa/'.$idempresa.'/modelacion-bim';
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

    public function paso7($tipo,$idempresa, Request $request)
    {
        $empresa = Empresa::find($idempresa);

        $subUso = SubUsoOcupacion::all();
        if($request->get('disciplinas')){
            $disciplinas = ProfesionEmpresa::where('idrelacion',$idempresa)->where('iddisciplina',$request->get('disciplinas'))->first();
            $disciplinas = $disciplinas->disciplinas;

        }else{
            $disciplinas = $empresa->disciplinas->last();
        }

        $revision = Revision::where('tipo_relacion','empresa')->where('idrelacion',$idempresa)->where('iddisciplina',$disciplinas->iddisciplina)->first();
        $iddisciplina = $disciplinas->iddisciplina;

        return view('front.empresa.paso7')
        ->with('tipo',$tipo)
        ->with('idempresa',$idempresa)
        ->with('empresa',$empresa)
        ->with('subUso',$subUso)
        ->with('iddisciplina',$iddisciplina)
        ->with('revision',$revision);
    
    }

    public function post_paso7($tipo,$idempresa, Request $request)
    {
        $recibir = $request->all();

        if($request->input('realiza_funcion_revision_diseno') == "1"){

            //creacion de reglas para validación en un array
            $reglas = array(
                'tipo_relacion' => 'required',
                'idrelacion' => 'required',
                'iddisciplina' => 'required',
                'realiza_funcion_revision_diseno' => 'required',
                'anios_experiencia_revision' => 'required',
                'm2_revisados' => 'required',
                'tipos_estructuras' => 'required'
            );

        }else{

            $reglas = array(
                'tipo_relacion' => 'required',
                'idrelacion' => 'required',
                'iddisciplina' => 'required',
                'realiza_funcion_revision_diseno' => 'required'
            );

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
            $urlFail = 'clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-7';
            $urlSuccess = 'clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-8';
            $mensajeSuccess = "Paso guardado correctamente";

            DB::beginTransaction();
            try {
                $estructuras = $request->input('tipos_estructuras');
                if($estructuras !== NULL){
                    $estructuras = implode(',', $estructuras);
                }

                $tipo_relacion = $request->input('tipo_relacion');
                $idrelacion = $request->input('idrelacion');
                $iddisciplina = $request->input('iddisciplina');
                $realiza_funcion_revision_diseno = $request->input('realiza_funcion_revision_diseno');
                $anios_experiencia_revision = $request->input('anios_experiencia_revision');
                $m2_revisados = $request->input('m2_revisados');
                $tipos_estructuras = $estructuras;

                $insertRevision = $this->saveRevision(
                                                            $tipo_relacion,
                                                            $idrelacion,
                                                            $realiza_funcion_revision_diseno,
                                                            $anios_experiencia_revision,
                                                            $m2_revisados,
                                                            $tipos_estructuras,
                                                            $iddisciplina);

                if($insertRevision){

                    $success = true;

                }else{

                    $success = false;
                }

            } catch (\Exception $e) {
                echo $e->getMessage();die();
                // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
            }
            if($request->get('editar')){
                $urlSuccess = 'clientes/perfil-empresa/'.$idempresa;
                $urlFail = 'clientes/editar-empresa/empresa/'.$idempresa.'/revision-bim';
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

    public function paso8($tipo,$idempresa, Request $request)
    {
        $empresa = Empresa::find($idempresa);
        $subUso = SubUsoOcupacion::all();
        if($request->get('disciplinas')){
            $disciplinas = ProfesionEmpresa::where('idrelacion',$idempresa)->where('iddisciplina',$request->get('disciplinas'))->first();
            $disciplinas = $disciplinas->disciplinas;

        }else{
            $disciplinas = $empresa->disciplinas->last();
        }

        $supervision = SupervisionTecnica::where('tipo_relacion','empresa')->where('idrelacion',$idempresa)->where('iddisciplina',$disciplinas->iddisciplina)->first();
        $iddisciplina = $disciplinas->iddisciplina;

        return view('front.empresa.paso8')
        ->with('tipo',$tipo)
        ->with('idempresa',$idempresa)
        ->with('empresa',$empresa)
        ->with('subUso',$subUso)
        ->with('iddisciplina',$iddisciplina)
        ->with('supervision',$supervision);
    
    }

    public function post_paso8($tipo,$idempresa, Request $request)
    {
        $recibir = $request->all();

        if($request->input('realiza_supervision_tecnica') == "1"){

            //creacion de reglas para validación en un array
            $reglas = array(
                'tipo_relacion' => 'required',
                'idrelacion' => 'required',
                'iddisciplina' => 'required',
                'realiza_supervision_tecnica' => 'required',
                'anios_experiencia_supervision' => 'required',
                'm2_supervisados' => 'required',
                'tipo_estructura' => 'required'
            );

        }else{

            $reglas = array(
                'tipo_relacion' => 'required',
                'idrelacion' => 'required',
                'iddisciplina' => 'required',
                'realiza_supervision_tecnica' => 'required'
            );

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
            $urlFail = 'clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-8';
            $urlSuccess = 'clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-9';
            $mensajeSuccess = "Paso guardado correctamente";

            DB::beginTransaction();
            try {

                $estructuras = $request->input('tipo_estructura');
                if($estructuras !== NULL){
                    $estructuras = implode(',', $estructuras);
                }

                $tipo_relacion = $request->input('tipo_relacion');
                $idrelacion = $request->input('idrelacion');
                $iddisciplina = $request->input('iddisciplina');
                $realiza_supervision_tecnica = $request->input('realiza_supervision_tecnica');
                $anios_experiencia_supervision = $request->input('anios_experiencia_supervision');
                $m2_supervisados = $request->input('m2_supervisados');
                $tipo_estructura = $estructuras;

                $insertSupervision = $this->saveSupervision(
                                                            $tipo_relacion,
                                                            $idrelacion,
                                                            $realiza_supervision_tecnica,
                                                            $anios_experiencia_supervision,
                                                            $m2_supervisados,
                                                            $tipo_estructura,
                                                            $iddisciplina);

                if($insertSupervision){

                    $success = true;

                }else{

                    $success = false;
                }

            } catch (\Exception $e) {
                echo $e->getMessage();die();
                // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
            }
            if($request->get('editar')){
                $urlSuccess = 'clientes/perfil-empresa/'.$idempresa;
                $urlFail = 'clientes/editar-empresa/empresa/'.$idempresa.'/supervision-bim';
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

    public function paso9($tipo,$idempresa)
    {
        $tag = TagDocumento::where('tipo','empresa')->get();
        $empresa = Empresa::find($idempresa);
        return view('front.empresa.paso9')->with('tipo',$tipo)->with('idempresa',$idempresa)->with('empresa',$empresa)->with('tag',$tag);
    
    }

    public function post_paso9($tipo,$idempresa, Request $request)
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
            Session::flash("errordataform","Revisa todos los campos para continuar.");
            $mensajeerror="Revisa todos los campos para continuar.";
			return Redirect::back()->with('errordataform',$mensajeerror)->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
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
                return Redirect::to('clientes/crear-e/'.$tipo.'/'.$idempresa.'/paso-9')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }
}