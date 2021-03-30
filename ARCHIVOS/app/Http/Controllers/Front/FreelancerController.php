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
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use App\Models\Front\Freelancer;
use App\Models\Front\FormacionAcademica;
use App\Models\Front\ExperienciaLaboral;
use App\Models\Front\SupervisionTecnica;
use App\Models\Front\ModelacionBim;
use App\Models\Front\Revision;
use App\Models\Front\Idioma;
use App\Models\Front\Documento;
use App\Models\Admin\OpcionListado;
use App\Models\Admin\Listado;
use App\Models\Admin\Profesion;
use App\Models\Admin\SubUsoOcupacion;
use App\Models\Admin\TagDocumento;
use App\Models\Admin\AreaProfesion;
use App\Models\Admin\User;
use App\Models\Front\ProfesionFreelancer;
use Illuminate\Routing\Controller;
use App\Support\Perfiles;
use App\Notifications\DatosUsuario;


class FreelancerController extends Controller
{
    use Perfiles;

    public function crear($tipo)
    {
        return view('front.crear')->with('tipo',$tipo);
    }

    public function post_email($tipo,Request $request)
    {
        $recibir = $request->all();

        $idfreelancer = 0;

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
            $email = Freelancer::where('email',$request->input('email'))->get();
            if ($email->count() == 0){

                $success = false;
                DB::beginTransaction();
                try {
                    //creamos el modelo
                    $freelancer = new Freelancer;
                    $freelancer->email = $request->input('email');
                    $freelancer->estado = 1;

                    //guardamos en la base de datos con el método save
                    if($freelancer->save())
                    {   
                        $idfreelancer = $freelancer->idfreelancer;
                        //creamos el modelo
                        $usuario = new User;
                        $usuario->iduserrelacion = $idfreelancer;
                        $usuario->tipoRelacion = 'Freelancer';
                        $usuario->email = $request->input('email');
                        $usuario->name = 'Sin Asignar';
                        $usuario->lastname = 'Sin Asignar';
                        $usuario->password = Hash::make($request->input('password'));
                        //guardamos en la base de datos con el método save
                        if($usuario->save())
                        {

                            $usuario->assignRole('Freelancer');
                            $success = true;
                            $token = 'Freelancer';
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
                    Session::flash("mensaje","Freelancer creado satisfactoriamente, ahora, rellena el siguiente formulario");
                    return Redirect::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-1');
                } else {
                    DB::rollback();
                    Session::flash("errordataform","El Freelancer no pudo ser creado, inténtalo nuevamente.");
                    $mensajeerror="El Freelancer no pudo ser creado, inténtalo nuevamente.";
                    return Redirect::to('clientes/crear-f/'.$tipo.'')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
                }
            }else{
                
                Session::flash("errordataform","Ya existe un freelancer con ese email, intenta con otro.");
                $mensajeerror="Ya existe un freelancer con ese email, intenta con otro.";
                return view('front.crear')->with('tipo',$tipo);
            }

		}
    }

    public function paso1($tipo,$idfreelancer)
    {
        $freelancer = Freelancer::find($idfreelancer);
        return view('front.freelancer.paso1')->with('tipo',$tipo)->with('idfreelancer',$idfreelancer)->with('freelancer',$freelancer);
    }

    public function post_paso1($tipo,$idfreelancer, Request $request)
    {
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(

            'nombres' => 'required|min:3',
            'apellidos' => 'required|min:3',
            'pais' => 'required',
            'ciudad_residencia' => 'required',
            'fecha_nacimiento' => 'required',
            'genero' => 'required',
            'direccion' => 'required|min:3',
            'tipo_documento' => 'required',
            'documento' => 'required|min:4',
            'edad' => 'required',
            'celular' => 'required|min:5',
            'nacionalidad' => 'required',
            'disponibilidad_tiempo' => 'required',

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
        Session::put('ciudad', $request->input('ciudad_residencia'));

		$validar = Validator::make($recibir,$reglas,$mensajes); //los mensajes son opcionales
		if($validar->fails())
		{
            Session::flash("errordataform","Completa los campos obligatorios para continuar.");
            $mensajeerror="Completa los campos obligatorios para continuar.";
            Session::put('ciudad', $request->input('ciudad_residencia'));
			return Redirect::back()->with('errordataform',$mensajeerror)->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
            $success = false;
            $urlFail = 'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-1';
            $urlSuccess = 'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-2';
            $mensajeSuccess = "Paso guardado correctamente";

            DB::beginTransaction();
            try {
                //creamos el modelo
                $freelancer = Freelancer::find($idfreelancer);
                $freelancer->nombres = $request->input('nombres');
                $freelancer->apellidos = $request->input('apellidos');
                $freelancer->pais = $request->input('pais');
                $freelancer->ciudad_residencia = $request->input('ciudad_residencia');
                $freelancer->fecha_nacimiento = $request->input('fecha_nacimiento');
                $freelancer->genero = $request->input('genero');
                $freelancer->direccion = $request->input('direccion');
                $freelancer->tipo_documento = $request->input('tipo_documento');
                $freelancer->documento = $request->input('documento');
                $freelancer->edad = $request->input('edad');
                $freelancer->celular = $request->input('celular');
                $freelancer->nacionalidad = $request->input('nacionalidad');
                $freelancer->disponibilidad_tiempo = $request->input('disponibilidad_tiempo');

                if($request->file('image')){
					$cover = $request->file('image');
					$extension = time() . '.' . $cover->getClientOriginalExtension();
					$destinationPath = public_path('uploads/front/freelancer/general/'.$idfreelancer.'');
					$cover->move($destinationPath, $cover->getFilename().'.'.$extension);
					$freelancer->image = $cover->getFilename().'.'.$extension;
                }
                
                //guardamos en la base de datos con el método save
                if($freelancer->save())
                {   
                    $usuario = User::where('iduserrelacion',$idfreelancer)->where('tipoRelacion','Freelancer')->first();
                    $usuario->name = $request->input('nombres');
                    $usuario->lastname = $request->input('apellidos');
                    $usuario->save();
                    $success = true;
                }

            } catch (\Exception $e) {
                echo $e->getMessage();die();
                // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
            }
            if($request->get('editar')){
                $urlSuccess = 'clientes/perfil-freelancer/'.$idfreelancer;
                $urlFail = 'clientes/editar-freelancer/freelancer/'.$idfreelancer;
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

    public function paso2($tipo,$idfreelancer)
    {
        $freelancer = Freelancer::find($idfreelancer);
        $profesiones = Profesion::where('estado',1)->get();
        return view('front.freelancer.paso2')->with('tipo',$tipo)
        ->with('idfreelancer',$idfreelancer)
        ->with('freelancer',$freelancer)
        ->with('profesiones',$profesiones);
    }

    public function addDisciplinas($idfreelancer)
    {
        $freelancer = Freelancer::find($idfreelancer);
        $tipo = 'freelancer';
        $profesiones = Profesion::where('estado',1)->get();
        return view('front.freelancer.add-disciplinas')->with('tipo',$tipo)
        ->with('idfreelancer',$idfreelancer)
        ->with('freelancer',$freelancer)
        ->with('profesiones',$profesiones);
    }

    public function profesion($profesion)
    {
        $profesion = Profesion::find($profesion);
        $disciplinas = $profesion->disciplinas;   

        return $disciplinas;
    }
    public function post_savedisciplina($tipo,$idfreelancer, Request $request)
    {
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(

            'fp_profesion' => 'required',
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
                $idprofesion = $request->input('fp_profesion');
                $iddisciplina =  $request->input('fp_linea_enfoque_area');
                $freelancer = Freelancer::find($idfreelancer);
                $disciplinasGuardadas = ProfesionFreelancer::where('idrelacion',$idfreelancer)->where('idprofesion',$idprofesion)->where('iddisciplina',$iddisciplina)->first();
                if($disciplinasGuardadas == NULL){
                    $disciplinasGuardadas = new ProfesionFreelancer;
                }    
                $disciplinasGuardadas->idrelacion = $idfreelancer;
                $disciplinasGuardadas->idprofesion = $idprofesion;
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
                return Redirect::to('clientes/perfil-freelancer/'.$idfreelancer);
            } else {
                DB::rollback();
                Session::flash("errordataform","La disciplina no pudo ser guardada, inténtalo nuevamente.");
                $mensajeerror="La disciplina no pudo ser guardada, inténtalo nuevamente.";
                return Redirect::to('clientes/perfil-freelancer/'.$idfreelancer)->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }
    public function post_paso2($tipo,$idfreelancer, Request $request)
    {
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(

            'fp_profesion' => 'required',
            'fp_linea_enfoque_area' => 'required',
            'fp_competencias' => 'required',
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
            Session::flash("errordataform","Completa los campos obligatorios para continuar.");
            $mensajeerror="Completa los campos obligatorios para continuar.";
			return Redirect::back()->with('errordataform',$mensajeerror)->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
            $success = false;
            DB::beginTransaction();
            try {
                //creamos el modelo
                $competencias = $request->input('fp_competencias');
                $competencias = implode(',', $competencias);
                $idprofesion = $request->input('fp_profesion');
                $iddisciplina =  $request->input('fp_linea_enfoque_area');
                $freelancer = Freelancer::find($idfreelancer);
                $disciplinasGuardadas = ProfesionFreelancer::where('idrelacion',$idfreelancer)->where('idprofesion',$idprofesion)->where('iddisciplina',$iddisciplina)->first();
                if($disciplinasGuardadas == NULL){
                    $disciplinasGuardadas = new ProfesionFreelancer;
                }    
                $disciplinasGuardadas->idrelacion = $idfreelancer;
                $disciplinasGuardadas->idprofesion = $idprofesion;
                $disciplinasGuardadas->iddisciplina = $iddisciplina;
                $freelancer->fp_competencias = $competencias;
                $freelancer->fp_descripcion_profesional = $request->input('fp_descripcion_profesional');
                
                //guardamos en la base de datos con el método save
                if($disciplinasGuardadas->save() && $freelancer->save())
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
                return Redirect::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-3');
            } else {
                DB::rollback();
                Session::flash("errordataform","El paso no pudo ser guardado, inténtalo nuevamente.");
                $mensajeerror="El paso no pudo ser guardado, inténtalo nuevamente.";
                return Redirect::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-2')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }

    public function paso3($tipo,$idfreelancer)
    {
        $freelancer = Freelancer::find($idfreelancer);
        $formacion = FormacionAcademica::where('tipo_relacion','freelancer')->where('idrelacion',$idfreelancer)->get();
        $opcion1 = Listado::where('nombre','universidades')->first();
        $universidades = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
        return view('front.freelancer.paso3')->with('tipo',$tipo)->with('idfreelancer',$idfreelancer)->with('freelancer',$freelancer)->with('formacion',$formacion)->with('universidad',$universidades);
    }

    public function post_paso3($tipo,$idfreelancer, Request $request)
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
            Session::flash("errordataform","Completa los campos obligatorios para continuar.");
            $mensajeerror="Completa los campos obligatorios para continuar.";
			return Redirect::back()->with('errordataform',$mensajeerror)->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
            $success = false;
            $urlFail = 'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-3';
            $urlSuccess = 'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-4';
            $mensajeSuccess = "Paso guardado correctamente";

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
            if($request->get('editar')){
                $urlSuccess = 'clientes/perfil-freelancer/'.$idfreelancer;
                $urlFail = 'clientes/editar-freelancer/freelancer/'.$idfreelancer.'/formacion-academica';
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

    public function paso4($tipo,$idfreelancer, Request $request)
    {
        $freelancer = Freelancer::find($idfreelancer);
        if($request->get('disciplinas')){
            $disciplinas = ProfesionFreelancer::where('idrelacion',$idfreelancer)->where('iddisciplina',$request->get('disciplinas')*1)->first();
            $disciplinas = $disciplinas->disciplinas;
        }else{
            $disciplinas = $freelancer->disciplinas->last();
        }
        if($disciplinas->nombre == "Diseño estructural"){

            $opcion1 = Listado::where('nombre','diseno_estructural_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_diseno_estructural_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }elseif($disciplinas->nombre == "Hidráulica e Hidrosanitaria"){

            $opcion1 = Listado::where('nombre','hidraulica_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_hidraulica_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }elseif($disciplinas->nombre == "Topografía"){

            $opcion1 = Listado::where('nombre','topografia_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_topografia_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }elseif($disciplinas->nombre == "Diseño arquitectónico"){

            $opcion1 = Listado::where('nombre','diseno_arquitectonico_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_diseno_arquitectonico_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }elseif($disciplinas->nombre == "Geotécnia"){

            $opcion1 = Listado::where('nombre','geotecnia_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_geotecnia_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }elseif($disciplinas->nombre == "Urbanismo"){

            $opcion1 = Listado::where('nombre','urbanismo_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_urbanismo_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Gerencia"){

            $opcion1 = Listado::where('nombre','gerencia_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_gerencia_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Ing. Eléctrica"){

            $opcion1 = Listado::where('nombre','electrica_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_electrica_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Electrónica" || $disciplinas->nombre == "Ing. Electrónica"){

            $opcion1 = Listado::where('nombre','electronica_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_electronica_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Construcción"){

            $opcion1 = Listado::where('nombre','construccion_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_construccion_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Arqueología"){

            $opcion1 = Listado::where('nombre','arqueologia_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_arqueologia_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Diseño acústico"){

            $opcion1 = Listado::where('nombre','diseno_acustico_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_diseno_acustico_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Diseño bioclimático"){

            $opcion1 = Listado::where('nombre','diseno_bioclimatico_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_diseno_bioclimatico_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Telecomunicaciones"){

            $opcion1 = Listado::where('nombre','telecomunicaciones_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_telecomunicaciones_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Diseño de interiores"){

            $opcion1 = Listado::where('nombre','diseno_interiores_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_diseno_interiores_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Ing. Mecánica"){

            $opcion1 = Listado::where('nombre','ing_mecanica_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_ing_mecanica_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Gestión Ambiental"){

            $opcion1 = Listado::where('nombre','gestion_ambiental_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_gestion_ambiental_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Derecho"){

            $opcion1 = Listado::where('nombre','derecho_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_derecho_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Patrimonio"){

            $opcion1 = Listado::where('nombre','patrimonio_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_patrimonio_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Diseño Geométrico de vías y Estudio de tráfico"){

            $opcion1 = Listado::where('nombre','diseno_geometrico_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_diseno_geometrico_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Seguridad humana"){

            $opcion1 = Listado::where('nombre','seguridad_humana_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_seguridad_humana_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Infraestructura vial y Pavimentos"){

            $opcion1 = Listado::where('nombre','infraestructura_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_infraestructura_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Contabilidad"){

            $opcion1 = Listado::where('nombre','contabilidad_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_contabilidad_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Asesoría comercial"){

            $opcion1 = Listado::where('nombre','asesor_comercial_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_asesor_comercial_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Publicidad"){

            $opcion1 = Listado::where('nombre','publicidad_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_publicidad_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        else{

            $opcion1 = Listado::where('nombre','diseno_estructural_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','experiencia_software_diseno_estructural_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        $subUso = SubUsoOcupacion::all();
        $experiencia = ExperienciaLaboral::where('tipo_relacion','freelancer')->where('idrelacion',$idfreelancer)->where('iddisciplina',$disciplinas->iddisciplina)->first();
        $idioma = Idioma::where('tipo_relacion','freelancer')->where('idrelacion',$idfreelancer)->where('iddisciplina',$disciplinas->iddisciplina)->get();
        $iddisciplina = $disciplinas->iddisciplina;
        $opcion3 = Listado::where('nombre','idiomas')->first();
        $nombreIdioma = OpcionListado::where('idlistado',$opcion3->idlistado)->get();
        $opcion4 = Listado::where('nombre','nivel_idiomas')->first();
        $nivelIdioma = OpcionListado::where('idlistado',$opcion4->idlistado)->get();
        return view('front.freelancer.paso4')->with('tipo',$tipo)
        ->with('idfreelancer',$idfreelancer)
        ->with('freelancer',$freelancer)
        ->with('subUso',$subUso)->with('actividad',$actividad)
        ->with('software',$software)
        ->with('experiencia',$experiencia)
        ->with('iddisciplina',$iddisciplina)
        ->with('nombreIdioma',$nombreIdioma)
        ->with('nivelIdioma',$nivelIdioma)
        ->with('idioma',$idioma);
    }

    public function post_paso4($tipo,$idfreelancer, Request $request)
    {
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(

            'tipo_relacion' => 'required',
            'idrelacion' => 'required',
            'iddisciplina' => 'required',
            'anios_experiencia' => 'required|numeric',
            'm2_disenados' => 'required',
            'tipo_estructuras_disenadas' => 'required',
            'actividades_desempena' => 'required',
            'uso_software' => 'required',
            'disponibilidad_personal' => 'required',
            'certificados_cursos_seminarios' => 'required',
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
            Session::flash("errordataform","Completa los campos obligatorios para continuar.");
            $mensajeerror="Completa los campos obligatorios para continuar.";
			return Redirect::back()->with('errordataform',$mensajeerror)->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
            $success = false;
            $urlFail = 'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-4';
            $urlSuccess = 'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-5';
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
                $anios_experiencia = $request->input('anios_experiencia').' Años';
                $m2_disenados = $request->input('m2_disenados');
                $iddisciplina = $request->input('iddisciplina');
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
                $urlSuccess = 'clientes/perfil-freelancer/'.$idfreelancer;
                $urlFail = 'clientes/editar-freelancer/freelancer/'.$idfreelancer.'/experiencia-laboral';
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

    public function paso5($tipo,$idfreelancer, Request $request)
    {
        $freelancer = Freelancer::find($idfreelancer);
        $subUso = SubUsoOcupacion::all();

        if($request->get('disciplinas')){
            $disciplinas = ProfesionFreelancer::where('idrelacion',$idfreelancer)->where('iddisciplina',$request->get('disciplinas'))->first();
            $disciplinas = $disciplinas->disciplinas;

        }else{
            $disciplinas = $freelancer->disciplinas->last();
        }
        if($disciplinas->nombre == "Diseño estructural"){

            $opcion1 = Listado::where('nombre','diseno_estructural_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_diseno_estructural_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }elseif($disciplinas->nombre == "Hidráulica e Hidrosanitaria"){

            $opcion1 = Listado::where('nombre','hidraulica_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_hidraulica_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }elseif($disciplinas->nombre == "Topografía"){

            $opcion1 = Listado::where('nombre','topografia_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_topografia_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }elseif($disciplinas->nombre == "Diseño arquitectónico"){

            $opcion1 = Listado::where('nombre','diseno_arquitectonico_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_diseno_arquitectonico_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }elseif($disciplinas->nombre == "Geotécnia"){

            $opcion1 = Listado::where('nombre','geotecnia_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_geotecnia_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Urbanismo"){

            $opcion1 = Listado::where('nombre','urbanismo_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_urbanismo_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Gerencia"){

            $opcion1 = Listado::where('nombre','gerencia_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_gerencia_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Ing. Eléctrica"){

            $opcion1 = Listado::where('nombre','electrica_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_electrica_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Electrónica" || $disciplinas->nombre == "Ing. Electrónica"){

            $opcion1 = Listado::where('nombre','electronica_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_electronica_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Construcción"){

            $opcion1 = Listado::where('nombre','construccion_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_construccion_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Arqueología"){

            $opcion1 = Listado::where('nombre','arqueologia_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_arqueologia_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Diseño acústico"){

            $opcion1 = Listado::where('nombre','diseno_acustico_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_diseno_acustico_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Diseño bioclimático"){

            $opcion1 = Listado::where('nombre','diseno_bioclimatico_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_diseno_bioclimatico_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Telecomunicaciones"){

            $opcion1 = Listado::where('nombre','telecomunicaciones_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_telecomunicaciones_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Diseño de interiores"){

            $opcion1 = Listado::where('nombre','diseno_interiores_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_diseno_interiores_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Ing. Mecánica"){

            $opcion1 = Listado::where('nombre','ing_mecanica_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_ing_mecanica_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Gestión Ambiental"){

            $opcion1 = Listado::where('nombre','gestion_ambiental_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_gestion_ambiental_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Derecho"){

            $opcion1 = Listado::where('nombre','derecho_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_derecho_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Patrimonio"){

            $opcion1 = Listado::where('nombre','patrimonio_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_patrimonio_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Diseño Geométrico de vías y Estudio de tráfico"){

            $opcion1 = Listado::where('nombre','diseno_geometrico_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_diseno_geometrico_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Seguridad humana"){

            $opcion1 = Listado::where('nombre','seguridad_humana_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_seguridad_humana_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Infraestructura vial y Pavimentos"){

            $opcion1 = Listado::where('nombre','infraestructura_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_infraestructura_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Contabilidad"){

            $opcion1 = Listado::where('nombre','contabilidad_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_contabilidad_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Asesoría comercial"){

            $opcion1 = Listado::where('nombre','asesor_comercial_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_asesor_comercial_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        elseif($disciplinas->nombre == "Publicidad"){

            $opcion1 = Listado::where('nombre','publicidad_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_publicidad_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        else{

            $opcion1 = Listado::where('nombre','diseno_estructural_freelancer')->first();
            $actividad = OpcionListado::where('idlistado',$opcion1->idlistado)->get();
            $opcion2 = Listado::where('nombre','modelacion_software_diseno_estructural_freelancer')->first();
            $software = OpcionListado::where('idlistado',$opcion2->idlistado)->get();

        }
        $modelacion = ModelacionBim::where('tipo_relacion','freelancer')->where('idrelacion',$idfreelancer)->where('iddisciplina',$disciplinas->iddisciplina)->first();
        $iddisciplina = $disciplinas->iddisciplina;
        return view('front.freelancer.paso5')
        ->with('tipo',$tipo)
        ->with('idfreelancer',$idfreelancer)
        ->with('freelancer',$freelancer)
        ->with('actividad',$actividad)
        ->with('software',$software)
        ->with('subUso',$subUso)
        ->with('iddisciplina',$iddisciplina)
        ->with('modelacion',$modelacion);
    }

    public function post_paso5($tipo,$idfreelancer, Request $request)
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
            Session::flash("errordataform","Completa los campos obligatorios para continuar.");
            $mensajeerror="Completa los campos obligatorios para continuar.";
			return Redirect::back()->with('errordataform',$mensajeerror)->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
            $success = false;
            $urlFail = 'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-5';
            $urlSuccess = 'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-6';
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
                $urlSuccess = 'clientes/perfil-freelancer/'.$idfreelancer;
                $urlFail = 'clientes/editar-freelancer/freelancer/'.$idfreelancer.'/modelacion-bim';
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

    public function paso6($tipo,$idfreelancer, Request $request)
    {
        $freelancer = Freelancer::find($idfreelancer);
        $subUso = SubUsoOcupacion::all();
        if($request->get('disciplinas')){
            $disciplinas = ProfesionFreelancer::where('idrelacion',$idfreelancer)->where('iddisciplina',$request->get('disciplinas'))->first();
            $disciplinas = $disciplinas->disciplinas;

        }else{
            $disciplinas = $freelancer->disciplinas->last();
        }

        $revision = Revision::where('tipo_relacion','freelancer')->where('idrelacion',$idfreelancer)->where('iddisciplina',$disciplinas->iddisciplina)->first();
        $iddisciplina = $disciplinas->iddisciplina;
        return view('front.freelancer.paso6')->with('tipo',$tipo)->with('idfreelancer',$idfreelancer)->with('freelancer',$freelancer)->with('subUso',$subUso)->with('iddisciplina',$iddisciplina)->with('revision',$revision);
    
    }

    public function post_paso6($tipo,$idfreelancer, Request $request)
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
            Session::flash("errordataform","Completa los campos obligatorios para continuar.");
            $mensajeerror="Completa los campos obligatorios para continuar.";
			return Redirect::back()->with('errordataform',$mensajeerror)->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
            $success = false;
            $urlFail = 'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-6';
            $urlSuccess = 'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-7';
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
                $urlSuccess = 'clientes/perfil-freelancer/'.$idfreelancer;
                $urlFail = 'clientes/editar-freelancer/freelancer/'.$idfreelancer.'/revision-bim';
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

    public function paso7($tipo,$idfreelancer, Request $request)
    {
        $freelancer = Freelancer::find($idfreelancer);
        $subUso = SubUsoOcupacion::all();
        if($request->get('disciplinas')){
            $disciplinas = ProfesionFreelancer::where('idrelacion',$idfreelancer)->where('iddisciplina',$request->get('disciplinas'))->first();
            $disciplinas = $disciplinas->disciplinas;

        }else{
            $disciplinas = $freelancer->disciplinas->last();
        }

        $supervision = SupervisionTecnica::where('tipo_relacion','freelancer')->where('idrelacion',$idfreelancer)->where('iddisciplina',$disciplinas->iddisciplina)->first();
        $iddisciplina = $disciplinas->iddisciplina;
        
        return view('front.freelancer.paso7')
        ->with('tipo',$tipo)
        ->with('idfreelancer',$idfreelancer)
        ->with('freelancer',$freelancer)
        ->with('subUso',$subUso)
        ->with('iddisciplina',$iddisciplina)
        ->with('supervision',$supervision);
    
    }

    public function post_paso7($tipo,$idfreelancer, Request $request)
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
            Session::flash("errordataform","Completa los campos obligatorios para continuar.");
            $mensajeerror="Completa los campos obligatorios para continuar.";
			return Redirect::back()->with('errordataform',$mensajeerror)->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
            $success = false;
            $urlFail = 'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-7';
            $urlSuccess = 'clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-8';
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
                $urlSuccess = 'clientes/perfil-freelancer/'.$idfreelancer;
                $urlFail = 'clientes/editar-freelancer/freelancer/'.$idfreelancer.'/supervision-bim';
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

    public function paso8($tipo,$idfreelancer)
    {
        $tag = TagDocumento::where('tipo','freelance')->get();
        $freelancer = Freelancer::find($idfreelancer);
        return view('front.freelancer.paso8')->with('tipo',$tipo)->with('idfreelancer',$idfreelancer)->with('freelancer',$freelancer)->with('tag',$tag);
    
    }

    public function post_paso8($tipo,$idfreelancer, Request $request)
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
                return Redirect::to('clientes/crear-f/'.$tipo.'/'.$idfreelancer.'/paso-8')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }


}