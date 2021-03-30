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
use App\Models\Front\Proyecto;
use App\Models\Admin\Profesion;
use App\Models\Admin\SubUsoOcupacion;
use App\Models\Admin\FaseDisciplinaSubuso;
use App\Models\Admin\GrupoUso;
use App\Models\Admin\Listado;
use App\Models\Admin\Fase;
use App\Models\Admin\OpcionListado;
use App\Models\Admin\TagDocumento;
use App\Models\Admin\TipoProyecto;
use App\Models\Admin\AreaProfesion;
use Illuminate\Routing\Controller;
use App\Support\Perfiles;
use App\Models\Front\Freelancer;
use App\Models\Front\Empresa;
use App\Models\Front\Proveedor;
use App\Models\Front\ProfesionFreelancer;
use App\Models\Front\ProfesionEmpresa;
use App\Models\Admin\Disciplina;
use App\Models\Admin\EspecialidadProveedor;
use App\Models\Front\SupervisionTecnica;
use App\Models\Front\Revision;

class ProyectosController extends Controller
{
    use Perfiles;

    public function paso1($idcliente)
    {
        $cliente = Cliente::find($idcliente);
        $tipoproyecto = TipoProyecto::all();
        return view('front.proyecto.paso1')
        ->with('idcliente',$idcliente)
        ->with('cliente',$cliente)
        ->with('tipoproyecto',$tipoproyecto);
    }

    public function get_proyectos($id)
	{
        $response = new Response();
		$response->header('Content-type', 'application/json');

        $tipoproyecto = TipoProyecto::find($id);


		$data = $tipoproyecto->toJson();
		$response->setContent($data);

		return $response;
    }

    public function post_paso1($idcliente,Request $request)
    {
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(
			'idtipo' => 'required',
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
                $proyecto = new Proyecto;
                $proyecto->idtipo = $request->input('idtipo');
                $proyecto->idcliente = $idcliente;
                $proyecto->proceso = 0;
                $proyecto->estado = 'en_proceso';


                //guardamos en la base de datos con el método save
                if($proyecto->save())
                {   
                    $idproyecto = $proyecto->idproyecto;
                    $idtipo = $proyecto->idtipo;
                    $success = true;
                }

            } catch (\Exception $e) {
                echo $e->getMessage();die();
                // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
            }
            //ahora creamos una variable de sesion antes de hacer la redirección
            if ($success) {
                DB::commit();
                Session::flash("mensaje","Paso guardado exitosamente.");
                $tipoproyecto = TipoProyecto::find($idtipo);
                if($tipoproyecto->nombre == "Remodelación"){

                    return Redirect::to('clientes/crear-proyecto/'.$idproyecto.'/'.$idcliente.'/remodelacion/paso-2/');

                }elseif($tipoproyecto->nombre == "Arreglos locativos"){

                    return Redirect::to('clientes/crear-proyecto/'.$idproyecto.'/'.$idcliente.'/arreglos-locativos/paso-2/');

                }elseif($tipoproyecto->nombre == "Inmobiliaria"){

                    return Redirect::to('clientes/crear-proyecto/'.$idproyecto.'/'.$idcliente.'/inmobiliaria/paso-2/');

                }else{

                    return Redirect::to('clientes/crear-proyecto/'.$idproyecto.'/'.$idcliente.'/paso-2');

                }
                    
            } else {
                DB::rollback();
                Session::flash("errordataform","El proyecto no pudo ser creado, inténtalo nuevamente.");
                $mensajeerror="El proyecto no pudo ser creado, inténtalo nuevamente.";
                return Redirect::to('clientes/crear-proyecto/'.$idcliente.'/paso-1')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }

    public function paso2($idproyecto,$idcliente)
    {
        $cliente = Cliente::find($idcliente);
        $proyecto = Proyecto::find($idproyecto);
        $grupouso = SubUsoOcupacion::all();
        $listado = Listado::where('nombre','grupo_uso_listado')->first();
        $opcion = OpcionListado::where('idlistado',$listado->idlistado)->get();
        $informacion1 = Listado::where('nombre','informacion_adicional_crea_tu_proyecto')->first();
        $informacion = OpcionListado::where('idlistado',$informacion1->idlistado)->get();
        $tag = TagDocumento::where('tipo','proyecto')->get();
        return view('front.proyecto.paso2')
        ->with('idcliente',$idcliente)
        ->with('cliente',$cliente)
        ->with('proyecto',$proyecto)
        ->with('idproyecto',$idproyecto)
        ->with('grupouso',$grupouso)
        ->with('opcion',$opcion)
        ->with('informacion',$informacion)
        ->with('tag',$tag);
    }

    public function paso2_remodelacion($idproyecto,$idcliente)
    {
        $cliente = Cliente::find($idcliente);
        $proyecto = Proyecto::find($idproyecto);
        $grupouso = GrupoUso::all();
        $listado = Listado::where('nombre','grupo_uso_listado')->first();
        $opcion = OpcionListado::where('idlistado',$listado->idlistado)->get();
        $informacion1 = Listado::where('nombre','informacion_adicional_crea_tu_proyecto')->first();
        $informacion = OpcionListado::where('idlistado',$informacion1->idlistado)->get();

        $tag = TagDocumento::where('tipo','proyecto')->get();
        return view('front.proyecto.remodelacion.paso2')
        ->with('idcliente',$idcliente)
        ->with('cliente',$cliente)
        ->with('proyecto',$proyecto)
        ->with('idproyecto',$idproyecto)
        ->with('grupouso',$grupouso)
        ->with('opcion',$opcion)
        ->with('informacion',$informacion)
        ->with('tag',$tag);
    }

    public function post_paso2remodelacion($idproyecto,$idcliente,Request $request)
    {
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(

            'nombre' => 'required',
            'propietario' => 'required',
            'departamento' => 'required',
            'ciudad' => 'required',
            'direccion' => 'required',
            'area' => 'required',
            'cantidad_pisos' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'ie_grupouso' => 'required',
            'ie_subuso' => 'required',
            'ie_grupousolistado' => 'required',
            'ie_proyecto_colinda_bic_100' => 'required',
            'ie_predio_demolicion' => 'required',
            'ie_tiempo_ejecucion' => 'required',
            'ie_metodo_pago_ejecucion' => 'required',
            'ie_conocimiento_previo' => 'required',
            'ad_administracion' => 'required',
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
                $proyecto = Proyecto::find($idproyecto);
                $proyecto->nombre = $request->input('nombre');
                $proyecto->propietario = $request->input('propietario');
                $proyecto->departamento = $request->input('departamento');
                $proyecto->ciudad = $request->input('ciudad');
                $proyecto->direccion = $request->input('direccion');
                $proyecto->area = $request->input('area');
                $proyecto->cantidad_pisos = $request->input('cantidad_pisos');
                $proyecto->ubicacion_latitud = $request->input('lat');
                $proyecto->ubicacion_longitud = $request->input('lng');
                $proyecto->ie_grupousolistado = $request->input('ie_grupousolistado');
                $proyecto->ie_grupouso = $request->input('ie_grupouso');
                $proyecto->ie_subuso = $request->input('ie_subuso');
                $proyecto->ie_proyecto_colinda_bic_100 = $request->input('ie_proyecto_colinda_bic_100');
                $proyecto->ie_predio_demolicion = $request->input('ie_predio_demolicion');
                $proyecto->ie_tiempo_ejecucion = $request->input('ie_tiempo_ejecucion');
                $proyecto->ie_metodo_pago_ejecucion = $request->input('ie_metodo_pago_ejecucion');
                $proyecto->ie_conocimiento_previo = $request->input('ie_conocimiento_previo');
                $proyecto->ad_administracion = $request->input('ad_administracion');


                if($request->input('informacion')){
                    $item = $request->input('informacion');
                    $text = implode(",",$item);
                    $proyecto->informacion_adicional = $text;
                }

                if($request->file('image')){
					$cover = $request->file('image');
					$extension = time() . '.' . $cover->getClientOriginalExtension();
					$destinationPath = public_path('uploads/front/proyecto/general/'.$idproyecto.'');
					$cover->move($destinationPath, $cover->getFilename().'.'.$extension);
					$proyecto->image = $cover->getFilename().'.'.$extension;
                }


                //guardamos en la base de datos con el método save
                if($proyecto->save())
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
                Session::flash("mensaje","Paso guardado exitosamente.");
                return Redirect::to('clientes/crear-proyecto/'.$idproyecto.'/'.$idcliente.'/paso-3');
            } else {
                DB::rollback();
                Session::flash("errordataform","El cliente no pudo ser creado, inténtalo nuevamente.");
                $mensajeerror="El cliente no pudo ser creado, inténtalo nuevamente.";
                return Redirect::to('clientes/crear-proyecto/'.$idproyecto.'/'.$idcliente.'/remodelacion/paso-2')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }


    public function paso2_arreglos($idproyecto,$idcliente)
    {
        $cliente = Cliente::find($idcliente);
        $proyecto = Proyecto::find($idproyecto);
        $grupouso = SubUsoOcupacion::all();
        $listado = Listado::where('nombre','grupo_uso_listado')->first();
        $opcion = OpcionListado::where('idlistado',$listado->idlistado)->get();
        $tag = TagDocumento::where('tipo','proyecto')->get();
        $informacion1 = Listado::where('nombre','informacion_adicional_crea_tu_proyecto')->first();
        $informacion = OpcionListado::where('idlistado',$informacion1->idlistado)->get();


        return view('front.proyecto.arreglos-locativos.paso2')
        ->with('idcliente',$idcliente)
        ->with('cliente',$cliente)
        ->with('proyecto',$proyecto)
        ->with('idproyecto',$idproyecto)
        ->with('grupouso',$grupouso)
        ->with('opcion',$opcion)
        ->with('informacion',$informacion)
        ->with('tag',$tag);
    }

    public function post_paso2arreglos($idproyecto,$idcliente,Request $request)
    {
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(
            'nombre' => 'required',
            'propietario' => 'required',
            'departamento' => 'required',
            'ciudad' => 'required',
            'direccion' => 'required',
            'area' => 'required',
            'cantidad_pisos' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'ie_grupouso' => 'required',
            'ie_subuso' => 'required',
            'ie_grupousolistado' => 'required',
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
                $proyecto = Proyecto::find($idproyecto);
                $proyecto->nombre = $request->input('nombre');
                $proyecto->propietario = $request->input('propietario');
                $proyecto->departamento = $request->input('departamento');
                $proyecto->ciudad = $request->input('ciudad');
                $proyecto->direccion = $request->input('direccion');
                $proyecto->area = $request->input('area');
                $proyecto->cantidad_pisos = $request->input('cantidad_pisos');
                $proyecto->ubicacion_latitud = $request->input('lat');
                $proyecto->ubicacion_longitud = $request->input('lng');
                $proyecto->ie_grupouso = $request->input('ie_grupouso');
                $proyecto->ie_subuso = $request->input('ie_subuso');
                $proyecto->ie_grupousolistado = $request->input('ie_grupousolistado');

                if($request->input('informacion')){
                    $item = $request->input('informacion');
                    $text = implode(",",$item);
                    $proyecto->informacion_adicional = $text;
                }

                if($request->file('image')){
					$cover = $request->file('image');
					$extension = time() . '.' . $cover->getClientOriginalExtension();
					$destinationPath = public_path('uploads/front/proyecto/general/'.$idproyecto.'');
					$cover->move($destinationPath, $cover->getFilename().'.'.$extension);
					$proyecto->image = $cover->getFilename().'.'.$extension;
                }


                //guardamos en la base de datos con el método save
                if($proyecto->save())
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
                Session::flash("mensaje","Paso guardado exitosamente.");
                return Redirect::to('clientes/crear-proyecto/'.$idproyecto.'/'.$idcliente.'/paso-3');
            } else {
                DB::rollback();
                Session::flash("errordataform","El cliente no pudo ser creado, inténtalo nuevamente.");
                $mensajeerror="El cliente no pudo ser creado, inténtalo nuevamente.";
                return Redirect::to('clientes/crear-proyecto/'.$idproyecto.'/'.$idcliente.'/arreglos-locativos/paso-2')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }

    public function paso2_inmobiliaria($idproyecto,$idcliente)
    {
        $cliente = Cliente::find($idcliente);
        $proyecto = Proyecto::find($idproyecto);
        $grupouso = GrupoUso::all();
        $listado = Listado::where('nombre','grupo_uso_listado')->first();
        $opcion = OpcionListado::where('idlistado',$listado->idlistado)->get();
        $tag = TagDocumento::where('tipo','proyecto')->get();
        $informacion1 = Listado::where('nombre','informacion_adicional_crea_tu_proyecto')->first();
        $informacion = OpcionListado::where('idlistado',$informacion1->idlistado)->get();

        return view('front.proyecto.inmobiliaria.paso2')
        ->with('idcliente',$idcliente)
        ->with('cliente',$cliente)
        ->with('proyecto',$proyecto)
        ->with('idproyecto',$idproyecto)
        ->with('grupouso',$grupouso)
        ->with('opcion',$opcion)
        ->with('informacion',$informacion)

        ->with('tag',$tag);
    }

    public function post_paso2inmobiliaria($idproyecto,$idcliente,Request $request)
    {
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(
            'nombre' => 'required',
            'propietario' => 'required',
            'departamento' => 'required',
            'ciudad' => 'required',
            'direccion' => 'required',
            'area' => 'required',
            'cantidad_pisos' => 'required',
            'lat' => 'required',
            'lng' => 'required',
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
                $proyecto = Proyecto::find($idproyecto);
                $proyecto->nombre = $request->input('nombre');
                $proyecto->propietario = $request->input('propietario');
                $proyecto->departamento = $request->input('departamento');
                $proyecto->ciudad = $request->input('ciudad');
                $proyecto->direccion = $request->input('direccion');
                $proyecto->area = $request->input('area');
                $proyecto->cantidad_pisos = $request->input('cantidad_pisos');
                $proyecto->ubicacion_latitud = $request->input('lat');
                $proyecto->ubicacion_longitud = $request->input('lng');

                if($request->input('informacion')){
                    $item = $request->input('informacion');
                    $text = implode(",",$item);
                    $proyecto->informacion_adicional = $text;
                }

                if($request->file('image')){
					$cover = $request->file('image');
					$extension = time() . '.' . $cover->getClientOriginalExtension();
					$destinationPath = public_path('uploads/front/proyecto/general/'.$idproyecto.'');
					$cover->move($destinationPath, $cover->getFilename().'.'.$extension);
					$proyecto->image = $cover->getFilename().'.'.$extension;
                }


                //guardamos en la base de datos con el método save
                if($proyecto->save())
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
                Session::flash("mensaje","Paso guardado exitosamente.");
                return Redirect::to('clientes/crear-proyecto/'.$idproyecto.'/'.$idcliente.'/paso-3');
            } else {
                DB::rollback();
                Session::flash("errordataform","El cliente no pudo ser creado, inténtalo nuevamente.");
                $mensajeerror="El cliente no pudo ser creado, inténtalo nuevamente.";
                return Redirect::to('clientes/crear-proyecto/'.$idproyecto.'/'.$idcliente.'/inmobiliaria/paso-2')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }

    public function get_usos($id)
	{
        $response = new Response();
		$response->header('Content-type', 'application/json');


        $subuso = SubUsoOcupacion::find($id);
        $id2 = $subuso->grupo_uso_id;
        $grupoUso = GrupoUso::find($id2);
		$data = $grupoUso->toJson();
		$response->setContent($data);

		return $response;
    }

    
    public function post_paso2($idproyecto,$idcliente,Request $request)
    {
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(
            'nombre' => 'required',
            'propietario' => 'required',
            'departamento' => 'required',
            'ciudad' => 'required',
            'direccion' => 'required',
            'area' => 'required',
            'cantidad_pisos' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'ie_grupouso' => 'required',
            'ie_subuso' => 'required',
            'ie_grupousolistado' => 'required',
            'ie_disponibilidad_licenciacons' => 'required',
            'ie_proyecto_colinda_bic_100' => 'required',
            'ie_predio_demolicion' => 'required',
            'ie_tiempo_ejecucion' => 'required',
            'ie_metodo_pago_ejecucion' => 'required',
            'ie_conocimiento_previo' => 'required',
            'ad_administracion' => 'required',

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
                $proyecto = Proyecto::find($idproyecto);
                $proyecto->nombre = $request->input('nombre');
                $proyecto->propietario = $request->input('propietario');
                $proyecto->departamento = $request->input('departamento');
                $proyecto->ciudad = $request->input('ciudad');
                $proyecto->direccion = $request->input('direccion');
                $proyecto->area = $request->input('area');
                $proyecto->cantidad_pisos = $request->input('cantidad_pisos');
                $proyecto->ubicacion_latitud = $request->input('lat');
                $proyecto->ubicacion_longitud = $request->input('lng');
                $proyecto->ie_grupouso = $request->input('ie_grupouso');
                $proyecto->ie_subuso = $request->input('ie_subuso');
                $proyecto->ie_grupousolistado = $request->input('ie_grupousolistado');
                $proyecto->ie_disponibilidad_licenciacons = $request->input('ie_disponibilidad_licenciacons');
                $proyecto->ie_proyecto_colinda_bic_100 = $request->input('ie_proyecto_colinda_bic_100');
                $proyecto->ie_predio_demolicion = $request->input('ie_predio_demolicion');
                $proyecto->ie_tiempo_ejecucion = $request->input('ie_tiempo_ejecucion');
                $proyecto->ie_metodo_pago_ejecucion = $request->input('ie_metodo_pago_ejecucion');
                $proyecto->ie_conocimiento_previo = $request->input('ie_conocimiento_previo');
                $proyecto->ad_administracion = $request->input('ad_administracion');



                

                if($request->input('informacion')){
                    $item = $request->input('informacion');
                    $text = implode(",",$item);
                    $proyecto->informacion_adicional = $text;
                }

                if($request->file('image')){
					$cover = $request->file('image');
					$extension = time() . '.' . $cover->getClientOriginalExtension();
					$destinationPath = public_path('uploads/front/proyecto/general/'.$idproyecto.'');
					$cover->move($destinationPath, $cover->getFilename().'.'.$extension);
					$proyecto->image = $cover->getFilename().'.'.$extension;
                }


                //guardamos en la base de datos con el método save
                if($proyecto->save())
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
                Session::flash("mensaje","Paso guardado exitosamente.");
                return Redirect::to('clientes/crear-proyecto/'.$idproyecto.'/'.$idcliente.'/paso-3');
            } else {
                DB::rollback();
                Session::flash("errordataform","El cliente no pudo ser creado, inténtalo nuevamente.");
                $mensajeerror="El cliente no pudo ser creado, inténtalo nuevamente.";
                return Redirect::to('clientes/crear-proyecto/'.$idproyecto.'/'.$idcliente.'/paso-2')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }

    public function paso3($idproyecto,$idcliente)
    {

        $cliente = Cliente::find($idcliente);
        $proyecto = Proyecto::find($idproyecto);
        $especialidades = EspecialidadProveedor::whereIn('nombre',['Alquiler', 'Proveedor','Instalaciones', 'Laboratorios'])->get();
        $fases = DB::select("SELECT f.idfase as idfase, f.nombre as nombre from fases as f, fase_disciplina_subuso as fs where fs.fase_id = f.idfase AND fs.tipo_proyecto_id = $proyecto->idtipo GROUP by f.nombre, f.idfase ORDER BY f.idfase ASC");
        $fases_disciplinas = FaseDisciplinaSubuso::where('sub_uso_ocupacion_id',$proyecto->ie_subuso)->where('tipo_proyecto_id',$proyecto->idtipo)->where('disciplina_id','!=', 105)->get();
        return view('front.proyecto.paso3')
        ->with('idcliente',$idcliente)
        ->with('cliente',$cliente)
        ->with('proyecto',$proyecto)
        ->with('idproyecto',$idproyecto)
        ->with('fases',$fases)
        ->with('fases_disciplinas',$fases_disciplinas)
        ->with('especialidades',$especialidades);

    }

    public function post_paso3($idproyecto,$idcliente,Request $request)
    {
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(
            'informaciones' => 'required',
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
                $proyecto = Proyecto::find($idproyecto);
                $fasesDisciplinas = $request->input('informaciones');
                $proyecto->fases()->detach();
                foreach ($fasesDisciplinas as $itemvalue) {

                    $arrayValue = explode("_",$itemvalue);
                    $disciplina = $arrayValue[0];
                    $fase = $arrayValue[1];

                    $proyecto->fases()->attach([$fase=>["iddisciplina" =>$disciplina]]);
                }

                //guardamos en la base de datos con el método save
                if($proyecto->save())
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
                Session::flash("mensaje","Paso guardado exitosamente.");
                return Redirect::to('clientes/crear-proyecto/'.$idproyecto.'/'.$idcliente.'/paso-4');
            } else {
                DB::rollback();
                Session::flash("errordataform","El cliente no pudo ser creado, inténtalo nuevamente.");
                $mensajeerror="El cliente no pudo ser creado, inténtalo nuevamente.";
                return Redirect::to('clientes/crear-proyecto/'.$idproyecto.'/'.$idcliente.'/paso-3')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }

    public function paso4($idproyecto,$idcliente)
    {

        $cliente = Cliente::find($idcliente);
        $proyecto = Proyecto::find($idproyecto);
        $especialidades = EspecialidadProveedor::whereIn('nombre',['Alquiler', 'Proveedor','Instalaciones', 'Laboratorios'])->get();
        $fases = DB::select("SELECT f.idfase as idfase, f.nombre as nombre from fases as f, fase_disciplina_subuso as fs where fs.fase_id = f.idfase AND fs.tipo_proyecto_id = $proyecto->idtipo GROUP by f.nombre, f.idfase ORDER BY f.idfase ASC");
        $fases_disciplinas = FaseDisciplinaSubuso::where('sub_uso_ocupacion_id',$proyecto->ie_subuso)->get();
        return view('front.proyecto.paso4')
        ->with('idcliente',$idcliente)
        ->with('cliente',$cliente)
        ->with('proyecto',$proyecto)
        ->with('idproyecto',$idproyecto)
        ->with('fases',$fases)
        ->with('fases_disciplinas',$fases_disciplinas)
        ->with('especialidades',$especialidades);

    }

    public function getTipo($disciplina,$seleccion)
    {

        if ($seleccion == "freelancer"){
            $freelancer = Freelancer::where('estado',1)->get();
            foreach($freelancer as $freelancers){
                if($freelancers->disciplinas->count() > 0){
                    foreach($freelancers->disciplinas as $disciplinas){
                        if($disciplinas->iddisciplina == $disciplina){
                            foreach($disciplinas->freelancers as $free){
                                $free->fp_linea_enfoque_area = $this->getDisciplina($disciplinas->iddisciplina);
                                $free->fp_profesion = $this->getProfesion($disciplinas->pivot->idprofesion);
                            }
                            return $disciplinas->freelancers;
                        }
                    }
                }
            }
        }elseif($seleccion == "empresa"){
            $empresa = Empresa::where('estado',1)->get();
            foreach($empresa as $empresas){
                if($empresas->disciplinas->count() > 0){
                    foreach($empresas->disciplinas as $disciplinas){
                        if($disciplinas->iddisciplina == $disciplina){
                            foreach($disciplinas->empresas as $free){
                                $free->fp_linea_enfoque_area = $this->getDisciplina($disciplinas->iddisciplina);
                            }
                            return $disciplinas->empresas;
                        }
                    }
                }
            }

        }else{
            $proveedor = Proveedor::where('estado',1)->get();
            foreach($proveedor as $proveedores){
                if($proveedores->servicios->count() > 0){
                    foreach($proveedores->servicios as $servicios){
                        foreach($servicios->disciplinas as $disciplinas){
                            if($disciplinas->iddisciplina == $disciplina){
                                foreach($servicios->proveedores as $result){
                                    $result->descripcion = $this->getDisciplina($disciplina);
                                    
                                }
                                return $servicios->proveedores;
                                
                            }
                        }
            
                    }
                }
            }
        }

    }

    public function getRevision($disciplina,$seleccion)
    {
        $newdisciplina = Disciplina::find($disciplina);
        if ($seleccion == "freelancer"){
            if($newdisciplina->nombre == "Revisión Estructural"){
                $diseno = Disciplina::where('nombre','Diseño Estructural')->first();
                $revision = Revision::where('tipo_relacion','freelancer')->where('iddisciplina',$diseno->iddisciplina)->where('realiza_funcion_revision_diseno', 1)->get();
                $idfreelancers = [];
                foreach($revision as $key){
                    $idfreelancers[] = $key->idrelacion;
                }
                $freelancer = Freelancer::whereIn('idfreelancer',$idfreelancers)->where('estado',1)->get();
                foreach($freelancer as $freelancers){
                    if($freelancers->disciplinas->count() > 0){
                        foreach($freelancers->disciplinas as $disciplinas){
                            if($disciplinas->iddisciplina == $diseno->iddisciplina){
                                foreach($disciplinas->freelancers as $free){
                                    $free->fp_linea_enfoque_area = $this->getDisciplina($disciplinas->iddisciplina);
                                    $free->fp_profesion = $this->getProfesion($disciplinas->pivot->idprofesion);
                                    $free->disc = $disciplinas->iddisciplina;
                                }
                                return $disciplinas->freelancers;
                            }
                        }
                    }
                }
            }else{
                $contratistas = [];
                $disc = Disciplina::whereIn('nombre',['Diseño Estructural','Construcción','Diseño arquitectónico'])->get();
                $alldisciplinas = [];
                foreach($disc as $key){
                    $alldisciplinas[] = $key->iddisciplina;
                }
                $revision = SupervisionTecnica::where('tipo_relacion','freelancer')->whereIn('iddisciplina',$alldisciplinas)->where('realiza_supervision_tecnica', 1)->get();

                $idfreelancers = [];
                foreach($revision as $key){
                    $idfreelancers[] = $key->idrelacion;
                }

                $freelancer = Freelancer::whereIn('idfreelancer',$idfreelancers)->where('estado',1)->get();

                foreach($freelancer as $freelancers){
                    if($freelancers->disciplinas->count() > 0){
                        foreach($freelancers->disciplinas as $disciplinas){
                            foreach($disc as $new){
                                if($disciplinas->iddisciplina == $new->iddisciplina){
                                   
                                        $contratistas[] = [
                                            'idfreelancer' => $freelancers->idfreelancer,
                                            'estado' => 'Freelancer',
                                            'nombres' => $freelancers->nombres,
                                            'apellidos' => $freelancers->apellidos,
                                            'image' => $freelancers->image,
                                            'email' => $freelancers->email,
                                            'celular' => $freelancers->celular,
                                            'ciudad_residencia' => $freelancers->ciudad_residencia,
                                            'disc' => $disciplinas->iddisciplina,
                                            'fp_linea_enfoque_area' => $this->getDisciplina($disciplinas->iddisciplina),
                                            'fp_profesion' => $this->getProfesion($disciplinas->pivot->idprofesion),
                                        ];
                                    
                                }
                                
                            }
                            //return $disciplinas->freelancers;
                        }
                    }
                }
                return $contratistas;

            }

            /*$freelancer = Freelancer::where('estado',1)->get();
            foreach($freelancer as $freelancers){
                if($freelancers->disciplinas->count() > 0){
                    foreach($freelancers->disciplinas as $disciplinas){
                        if($disciplinas->iddisciplina == $disciplina){
                            foreach($disciplinas->freelancers as $free){
                                $free->fp_linea_enfoque_area = $this->getDisciplina($disciplinas->iddisciplina);
                                $free->fp_profesion = $this->getProfesion($disciplinas->pivot->idprofesion);
                            }
                            return $disciplinas->freelancers;
                        }
                    }
                }
            }*/
        }elseif($seleccion == "empresa"){
            /*$empresa = Empresa::where('estado',1)->get();
            foreach($empresa as $empresas){
                if($empresas->disciplinas->count() > 0){
                    foreach($empresas->disciplinas as $disciplinas){
                        if($disciplinas->iddisciplina == $disciplina){
                            foreach($disciplinas->empresas as $free){
                                $free->fp_linea_enfoque_area = $this->getDisciplina($disciplinas->iddisciplina);
                            }
                            return $disciplinas->empresas;
                        }
                    }
                }
            }*/
            if($newdisciplina->nombre == "Revisión Estructural"){
                $diseno = Disciplina::where('nombre','Diseño Estructural')->first();
                $revision = Revision::where('tipo_relacion','empresa')->where('iddisciplina',$diseno->iddisciplina)->where('realiza_funcion_revision_diseno', 1)->get();
                $idempresas = [];
                foreach($revision as $key){
                    $idempresas[] = $key->idrelacion;
                }
                $empresa = Empresa::whereIn('idempresa',$idempresas)->where('estado',1)->get();
                foreach($empresa as $empresas){
                    if($empresas->disciplinas->count() > 0){
                        foreach($empresas->disciplinas as $disciplinas){
                            if($disciplinas->iddisciplina == $diseno->iddisciplina){
                                foreach($disciplinas->empresas as $free){
                                    $free->fp_linea_enfoque_area = $this->getDisciplina($disciplinas->iddisciplina);
                                    $free->disc = $disciplinas->iddisciplina;
                                }
                                return $disciplinas->empresas;
                            }
                        }
                    }
                }
            }else{
                $contratistas = [];
                $disc = Disciplina::whereIn('nombre',['Diseño Estructural','Construcción','Diseño arquitectónico'])->get();
                $alldisciplinas = [];
                foreach($disc as $key){
                    $alldisciplinas[] = $key->iddisciplina;
                }
                $revision = SupervisionTecnica::where('tipo_relacion','empresa')->whereIn('iddisciplina',$alldisciplinas)->where('realiza_supervision_tecnica', 1)->get();

                $idempresas = [];
                foreach($revision as $key){
                    $idempresas[] = $key->idrelacion;
                }

                $empresa = Empresa::whereIn('idempresa',$idempresas)->where('estado',1)->get();

                foreach($empresa as $empresas){
                    if($empresas->disciplinas->count() > 0){
                        foreach($empresas->disciplinas as $disciplinas){
                            foreach($disc as $new){
                                if($disciplinas->iddisciplina == $new->iddisciplina){
                                   
                                        $contratistas[] = [
                                            'idempresa' => $empresas->idempresa,
                                            'estado' => 'Empresa',
                                            'razon_social' => $empresas->razon_social,
                                            'image' => $empresas->image,
                                            'email' => $empresas->email,
                                            'celular' => $empresas->celular,
                                            'disc' => $disciplinas->iddisciplina,
                                            'ciudad_residencia' => $empresas->ciudad_residencia,
                                            'fp_linea_enfoque_area' => $this->getDisciplina($disciplinas->iddisciplina),
                                        ];
                                    
                                }
                                
                            }
                            //return $disciplinas->freelancers;
                        }
                    }
                }
                return $contratistas;

            }

        }

    }

    public function getContratista($id,$seleccion,$disciplina)
	{

        $response = new Response();
        $response->header('Content-type', 'application/json');
        
        if ($seleccion == "freelancer"){
            $contratista = Freelancer::find($id);
            $disciplinas = ProfesionFreelancer::where('idrelacion',$contratista->idfreelancer)->where('iddisciplina',$disciplina)->first();
            $contratista->fp_linea_enfoque_area = $disciplina;
        }elseif($seleccion == "empresa"){
            $contratista = Empresa::find($id);
            $disciplinas = ProfesionEmpresa::where('idrelacion',$contratista->idempresa)->where('iddisciplina',$disciplina)->first();

            $contratista->fp_linea_enfoque_area = $disciplina;
        }else{
            $contratista = Proveedor::find($id);

        }

		$data = $contratista->toJson();
        
		$response->setContent($data);

		return $response;

    }

    public function getProfesion($profesion){
        $profesiones = Profesion::find($profesion);
        return $profesiones->nombre;
    }

    public function getDisciplina($disciplina){
        $disciplinas = Disciplina::find($disciplina);
        return $disciplinas->nombre;
    }


    public function post_paso4($idproyecto,$idcliente,Request $request)
    {
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(
            'informaciones' => 'required',
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
                $proyecto = Proyecto::find($idproyecto);
                $fasesDisciplinas = $request->input('informaciones');
                $proyecto->fases()->detach();
                foreach ($fasesDisciplinas as $itemvalue) {

                    $arrayValue = explode("_",$itemvalue);
                    $disciplina = $arrayValue[0];
                    $fase = $arrayValue[1];
                    $cuenta = $request->input('cuenta_con_contratista_'.$disciplina.'_'.$fase);
                    $seleccion = $request->input('seleccion_del_catalogo_'.$disciplina.'_'.$fase);

                    $contratista = $request->input('tipo_contratista_'.$disciplina.'_'.$fase);

                    $idcontratista = $request->input('idcontratista_'.$disciplina.'_'.$fase);
                    $estadocontratista = $request->input('estado_contratista_'.$disciplina.'_'.$fase);


                    $proyecto->fases()->attach([$fase=>["iddisciplina" =>$disciplina,
                                                "cuenta_con_contratista"=>$cuenta,
                                                "seleccion_del_catalogo"=>$seleccion,
                                                "tipo_contratista"=>$contratista,
                                                "idcontratista" => $idcontratista,
                                                "estado_contratista" => $estadocontratista]]);
                }

                //guardamos en la base de datos con el método save
                if($proyecto->save())
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
                Session::flash("mensaje","Paso guardado exitosamente.");
                return Redirect::to('clientes/crear-proyecto/'.$idproyecto.'/'.$idcliente.'/paso-5');
            } else {
                DB::rollback();
                Session::flash("errordataform","El cliente no pudo ser creado, inténtalo nuevamente.");
                $mensajeerror="El cliente no pudo ser creado, inténtalo nuevamente.";
                return Redirect::to('clientes/crear-proyecto/'.$idproyecto.'/'.$idcliente.'/paso-4')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }

    public function checkEmail($disciplina, $email, $seleccion)
	{
        if($seleccion == "freelancer"){
            $contratista = Freelancer::where('email',$email)->where('estado',1)->first();
            $disciplinaF = '';
            if(!empty($contratista)){
                $disciplinaF = ProfesionFreelancer::where('idrelacion',$contratista->idfreelancer)->where('iddisciplina',$disciplina)->first();
            }
        }elseif($seleccion == "empresa"){
            $contratista = Empresa::where('email',$email)->where('estado',1)->first();
            $disciplinaF = '';
            if(!empty($contratista)){
                $disciplinaF = ProfesionEmpresa::where('idrelacion',$contratista->idempresa)->where('iddisciplina',$disciplina)->first();
            }

        }else{
            $contratista = Proveedor::where('email',$email)->where('estado',1)->first();
            $disciplinaF = '';
            if(!empty($contratista)){
                $servicio = $contratista->servicios;
                foreach($servicio as $servicios){
                    foreach($servicios->disciplinas as $disciplinas){
                        if($disciplinas->iddisciplina == $disciplina){
                            $disciplinaF = $disciplina;
                        }
                    }
                }
            }
        }
		if(!empty($disciplinaF))
		{
			$arrayResponse = [
				'status' => 'exist',
				'contratista' => $contratista
			];
		}else{
			$arrayResponse = [
				'status' => 'not found'
			];
		}
		
    	$json = json_encode($arrayResponse);
		return response($json, 200)->header('Content-type', 'application/json');
	}


    public function paso5($idproyecto,$idcliente)
    {

        $cliente = Cliente::find($idcliente);
        $proyecto = Proyecto::find($idproyecto);
        return view('front.proyecto.paso5')
        ->with('idcliente',$idcliente)
        ->with('cliente',$cliente)
        ->with('proyecto',$proyecto)
        ->with('idproyecto',$idproyecto);

    }

    public function save_contacto(Request $request)
    {
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(
            'idproyecto' => 'required',
            'idcliente' => 'required',
            'iddisciplina' => 'required',
            'idfase' => 'required',
            'tipo_contratista' => 'required',
            'nombres' => 'required',
            'correo' => 'required',
            'celular' => 'required|numeric'
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
                //creamos el modelo
                $idproyecto = $request->input('idproyecto');
                $idcliente = $request->input('idcliente');
                $iddisciplina = $request->input('iddisciplina');
                $idfase = $request->input('idfase');

                $proyecto = Proyecto::find($idproyecto);

                $contratista = $request->input('tipo_contratista');
                $nombres = $request->input('nombres');
                $correo = $request->input('correo');
                $celular = $request->input('celular');



                $proyecto->contactos()->attach([$idcliente=>["iddisciplina" =>$iddisciplina,
                                            "idfase"=>$idfase,
                                            "tipo_contratista"=>$contratista,
                                            "nombres" => $nombres,
                                            "correo" => $correo,
                                            "celular" => $celular]]);

                //guardamos en la base de datos con el método save
                if($proyecto->save())
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
                $json = [
                    'status' => 'success',
                    'message' => 'Contacto guardado correctamente'
                ];
                $json = json_encode($json);
                return response($json,200)->header('Content-type', 'application/json');
            }else{
                DB::rollback();
                $json = [
                    'status' => 'error',
                    'error' => "Contacto error",
                    'message' => 'Error al crear el contacto'
                ];

                $json = json_encode($json);
                return response($json,401)->header('Content-type', 'application/json');
            }
		}
    }

    public function post_paso5($idproyecto,$idcliente,Request $request)
    {
        Session::flash("mensaje","Proyecto guardado correctamente");
        return Redirect::to('clientes/ver-contratistas');
    }

}