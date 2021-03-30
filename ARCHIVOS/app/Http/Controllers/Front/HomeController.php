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

use Illuminate\Routing\Controller;
use App\Models\Front\Freelancer;
use App\Models\Front\Empresa;
use App\Models\Admin\Disciplina;
use App\Models\Admin\Profesion;
use App\Models\Admin\EspecialidadProveedor;
use App\Models\Admin\Categoria;
use App\Models\Admin\Post;
use App\Models\Front\Proveedor;
use App\Models\Front\Cliente;
use App\Models\Front\Galeria;
use App\Models\Front\Proyecto;

use App\Models\Front\ProyectoFaseDisciplina;
use App\Models\Admin\FaseDisciplinaSubuso;
use App\Models\Front\FormacionAcademica;
use App\Models\Front\ExperienciaLaboral;
use App\Models\Front\SupervisionTecnica;
use App\Models\Front\ModelacionBim;
use App\Models\Front\Revision;
use App\Models\Front\Idioma;
use App\Support\Perfiles;
use App\Models\Admin\Beneficio;
use App\Models\Admin\Pagina;
use App\Models\Admin\ContenidoPagina;

use App\Models\Admin\CategoriaBeneficio;

class HomeController extends Controller
{
    use Perfiles;

    public function userAuthenticate( Request $request){
        if(Auth::user()){
            if(Auth::user()->hasRole('Administrador')){
                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return Redirect::to('/clientes/login');
            }else{
                return Redirect::to('/clientes/ultimas-noticias');
            }
        }else{
            return Redirect::to('/clientes/login');
        }
    }
    
    public function homeValidation()

    {

        $user = auth()->user();

        if($user->hasRole('Administrador')){

            return Redirect::to('/home');

        }else{

            return Redirect::to('/clientes/ultimas-noticias');

        }

    }

    public function landing_page(){
        $categoria = Categoria::where('nombre','Landing Page')->first();
        $posts = $categoria->post()->where('estado','publicado')->get();
        $disciplinas = Disciplina::where('asociada_a','profesionales')->orderBy( 'nombre','ASC')->get();
        $especialidades = EspecialidadProveedor::all();
        $vars = [
            'categoria',
            'posts',
            'disciplinas',
            'especialidades'
        ];

        return view('front.landing', compact($vars));
    }
    
    public function index()
    {
        return view('front.index');
    }

    public function crear(Request $request)
    {
        $tipo = $request->input('tipo');
        switch($tipo){
            case 'Freelancer':
                $tipo = 'freelancer';
                return Redirect::to('clientes/crear-f/'.$tipo.'');
                break;
            case 'Clientes':
                $tipo = 'clientes';
                return Redirect::to('clientes/crear-c/'.$tipo.'');
                break;
            case 'Empresas':
                $tipo = 'empresas';
                return Redirect::to('clientes/crear-e/'.$tipo.'');
                break;
            case 'Proveedores':
                $tipo = 'proveedores';
                return Redirect::to('clientes/crear-p/'.$tipo.'');
                break;
            default:
                break;
        }
    }

    public function get_contratistas(){
        $freelancers = Freelancer::where('estado',1)->get();
        $empresas = Empresa::where('estado',1)->get();
        $profesiones = Profesion::where('estado',1)->get();
        $vars = [
            'freelancers',
            'empresas',
            'profesiones'
        ];

        return view('front.home.contratistas', compact($vars));
    }

    public function get_empresas_filter(Request $request){
		$response = new Response();
		$response->header('Content-type', 'application/json');

        $where = [];
        $area = "";
        $ciudad = "";
		if($request->get('area')) {
			$area = $request->get('area');
			$where['fp_linea_enfoque_area'] = $area;
        }
        
        if($request->get('ciudad')) {
			$ciudad = $request->get('ciudad');
			$where['ciudad_residencia'] = $ciudad;
		}
        $contratistas = [];
		if($request->get('usuario') == "freelancer"  ) {
			$contratista = Empresa::where('estado',1)->where('razon_social','<>',NULL)->get();
        }elseif($ciudad == "")
			$contratista = Empresa::where('estado',1)->where('razon_social','<>',NULL)->get();
		else 
            $contratista = Empresa::where('ciudad_residencia',$ciudad)->where('razon_social','<>',NULL)->get();
          
        foreach($contratista as $valor){
            if($request->get('usuario') == "freelancer" || $area == "" ){
                if($valor->disciplinas->count() > 0){
                    foreach($valor->disciplinas as $disciplinas){
                        foreach($disciplinas->empresas as $free){
                            if($free->idempresa == $valor->idempresa){
                                $contratistas[] = [
                                    'idempresa' => $free->idempresa,
                                    'estado' => 'Empresa',
                                    'razon_social' => $free->razon_social,
                                    'image' => $free->image,
                                    'ciudad_residencia' => $free->ciudad_residencia,
                                    'fp_linea_enfoque_area' => $this->getArea($disciplinas->iddisciplina),
                                ];
                            }
                        }
                        //$contratistas = $disciplinas->empresas;
                        
                    }
                }
            }else{
                if($valor->disciplinas->count() > 0){
                    foreach($valor->disciplinas as $disciplinas){
                        if($disciplinas->iddisciplina == $area*1){
                                $contratistas[] = [
                                    'idempresa' => $valor->idempresa,
                                    'estado' => 'Freelancer',
                                    'razon_social' => $valor->razon_social,
                                    'image' => $valor->image,
                                    'ciudad_residencia' => $valor->ciudad_residencia,
                                    'fp_linea_enfoque_area' => $this->getArea($disciplinas->iddisciplina),
                                ];
                            //$contratistas = $profesiones->freelancers;
                        }
                        
                    }
                }

            }
        }


        $json = [
            'data' => $contratistas
        ];

        $response->setContent($json);
		return $response;
    }

    public function get_freelancer_filter(Request $request){
		$response = new Response();
		$response->header('Content-type', 'application/json');
        $area = "";
        $profesion = "";
        $ciudad = "";
        $where = [];
        $contratistas = [];
		if($request->get('profesion')) {
			$profesion = $request->get('profesion');
			$where['fp_profesion'] = $profesion;
		}

		if($request->get('area')) {
			$area = $request->get('area');
			$where['fp_linea_enfoque_area'] = $area;
        }
        
        if($request->get('ciudad')) {
			$ciudad = $request->get('ciudad');
			$where['ciudad_residencia'] = $ciudad;
		}
        $contratistas = [];
		if( $request->get('usuario') == "empresa"  ) {
            $contratista = Freelancer::where('estado',1)->where('nombres','<>',NULL)->get();
        }elseif($ciudad == ""){
			$contratista = Freelancer::where('estado',1)->where('nombres','<>',NULL)->get();
        }else{
            $contratista = Freelancer::where('ciudad_residencia','=',$ciudad)->where('estado',1)->where('nombres','<>',NULL)->get();

        } 
        foreach($contratista as $valor){
            if($request->get('usuario') == "empresa" || $area == "" && $profesion == ""){
                if($valor->disciplinas->count() > 0){
                    foreach($valor->disciplinas as $disciplinas){
                        foreach($disciplinas->freelancers as $free){
                            if($free->idfreelancer == $valor->idfreelancer){
                                $contratistas[] = [
                                    'idfreelancer' => $free->idfreelancer,
                                    'estado' => 'Freelancer',
                                    'nombres' => $free->nombres.' '.$free->apellidos,
                                    'image' => $free->image,
                                    'ciudad_residencia' => $free->ciudad_residencia,
                                    'fp_linea_enfoque_area' => $this->getArea($disciplinas->iddisciplina),
                                    'fp_profesion' => $this->getProfesion($disciplinas->pivot->idprofesion),
                                ];
                            }
                        }
                        //$contratistas = $disciplinas->freelancers;
                        
                    }
                }
            }elseif($profesion !== "" && $area == ""){
                if($valor->profesiones->count() > 0){
                    foreach($valor->profesiones as $profesiones){
                        if($profesiones->id == $profesion*1){
                                $contratistas[] = [
                                    'idfreelancer' => $valor->idfreelancer,
                                    'estado' => 'Freelancer',
                                    'nombres' => $valor->nombres.' '.$valor->apellidos,
                                    'image' => $valor->image,
                                    'ciudad_residencia' => $valor->ciudad_residencia,
                                    'fp_linea_enfoque_area' => $this->getArea($profesiones->pivot->iddisciplina),
                                    'fp_profesion' => $this->getProfesion($profesiones->id),
                                ];
                            //$contratistas = $profesiones->freelancers;
                        }
                        
                    }
                }
            }elseif($profesion !== "" && $area !== ""){
                if($valor->disciplinas->count() > 0){
                    foreach($valor->disciplinas as $disciplinas){
                        if($disciplinas->iddisciplina == $area*1){
                                $contratistas[] = [
                                    'idfreelancer' => $valor->idfreelancer,
                                    'estado' => 'Freelancer',
                                    'nombres' => $valor->nombres.' '.$valor->apellidos,
                                    'image' => $valor->image,
                                    'ciudad_residencia' => $valor->ciudad_residencia,
                                    'fp_linea_enfoque_area' => $this->getArea($disciplinas->iddisciplina),
                                    'fp_profesion' => $this->getProfesion($disciplinas->pivot->idprofesion),
                                ];
                            //$contratistas = $profesiones->freelancers;
                        }
                        
                    }
                }
            }
        }


        $json = [
            'data' => $contratistas
        ];
        $response->setContent($json);
		return $response;
    }

    public function get_proveedor_filter(Request $request){
		$response = new Response();
		$response->header('Content-type', 'application/json');
        $especialidad = "";
        $material = "";
        $ciudad = "";
        $where = [];
        $contratistas = [];
		if($request->get('especialidad')) {
			$especialidad = $request->get('especialidad');
			$where['especialidad'] = $especialidad;
		}

		if($request->get('material')) {
			$material = $request->get('material');
			$where['material'] = $material;
        }
        
        if($request->get('ciudad')) {
			$ciudad = $request->get('ciudad');
			$where['ciudad_residencia'] = $ciudad;
		}
        $contratistas = [];
        if($ciudad == ""){
			$contratista = Proveedor::where('estado',1)->where('nombre','<>',NULL)->get();
        }else{
            $contratista = Proveedor::where('ciudad_residencia','=',$ciudad)->where('estado',1)->where('nombre','<>',NULL)->get();

        } 
        foreach($contratista as $valor){
            if($especialidad == "" && $material == ""){
                if($valor->servicios->count() > 0){
                    foreach ($valor->servicios as $servicio){
                        $contratistas[] = [
                            'idproveedor' => $valor->idproveedor,
                            'estado' => 'Proveedor',
                            'nombre' => $valor->nombre,
                            'image' => $valor->image,
                            'ciudad_residencia' => $valor->ciudad_residencia,
                            'idespecialidad' => $this->getEspec($servicio->idespecialidad),
                            'idservicio' => $servicio->nombre,
                        ];
                    }
                }
            }elseif($especialidad !== "" && $material == ""){
                if($valor->servicios->count() > 0){
                    foreach ($valor->servicios as $servicio){
                        if($servicio->idespecialidad == $especialidad*1){
                            $contratistas[] = [
                                'idproveedor' => $valor->idproveedor,
                                'estado' => 'Proveedor',
                                'nombre' => $valor->nombre,
                                'image' => $valor->image,
                                'ciudad_residencia' => $valor->ciudad_residencia,
                                'idespecialidad' => $this->getEspec($servicio->idespecialidad),
                                'idservicio' => $servicio->nombre,
                            ];
                        }
                    }
                }
            }elseif($especialidad !== "" && $material !== ""){
                if($valor->servicios->count() > 0){
                    foreach ($valor->servicios as $servicio){
                        if($servicio->idespecialidad == $especialidad*1){
                            if($servicio->idservicio == $material*1){
                                $contratistas[] = [
                                    'idproveedor' => $valor->idproveedor,
                                    'estado' => 'Proveedor',
                                    'nombre' => $valor->nombre,
                                    'image' => $valor->image,
                                    'ciudad_residencia' => $valor->ciudad_residencia,
                                    'idespecialidad' => $this->getEspec($servicio->idespecialidad),
                                    'idservicio' => $servicio->nombre,
                                ];
    
                            }
                        }
                    }
                }
            }
        }


        $json = [
            'data' => $contratistas
        ];
        $response->setContent($json);
		return $response;
    }


    public function getEspec($especialidad)
    {
        $especialidad = EspecialidadProveedor::find($especialidad);
        $especialidad = $especialidad->nombre;   

        return $especialidad;
    }

    public function getProfesion($profesion)
    {
        $profesion = Profesion::find($profesion);
        $profesion = $profesion->nombre;   

        return $profesion;
    }

    public function getArea($disciplina)
    {
        $disciplinas = Disciplina::find($disciplina);
        $disciplinas = $disciplinas->nombre;   

        return $disciplinas;
    }

    public function get_proveedores_filter(Request $request){

        $especialidades = EspecialidadProveedor::all();
        $vars = [
            'especialidades'
        ];

        return view('front.home.proveedores', compact($vars));
          
    }

    public function get_noticias(){
        $categoria = Categoria::where('nombre','Noticias')->first();
        $posts = $categoria->post()->where('estado','publicado')->orderBy('created_at', 'DESC')->get();
        $cuentaB = 0;
        foreach ($posts as $post){
            foreach ($post->categorias as $categorias){
                if($categorias->nombre !== 'Noticias'){
                    $cuentaB = $cuentaB+1;
                }
            }
    
        }
        $freelancers = Freelancer::where('estado',1)->where('nombres','<>',NULL)->orderBy('created_at', 'DESC')->take(8)->get();
        $empresas = Empresa::where('estado',1)->where('razon_social','<>',NULL)->orderBy('created_at', 'DESC')->take(8)->get();
        $categoriaA = Categoria::where('nombre','Anuncios')->first();
        $anuncios = $categoriaA->post()->where('estado','publicado')->orderBy('created_at', 'DESC')->get();
        

        $vars = [
            'categoria',
            'posts',
            'anuncios',
            'freelancers',
            'empresas',
            'cuentaB'
        ];

        return view('front.home.homeusuario', compact($vars));
    }
    
    public function get_post($id){
        $post = Post::find($id);
        $vars = [
            'post'
        ];

        return view('front.home.ver-post', compact($vars));
    }

    public function get_perfilCliente($id){
        $cliente = Cliente::find($id);
        $vars = [
            'cliente',
        ];

        return view('front.home.perfil-cliente', compact($vars));
    }

    public function get_perfilFreelancer($id){
        $freelancer = Freelancer::find($id);
        $proyectos = ProyectoFaseDisciplina::where('tipo_contratista','freelancer')->where('idcontratista',$id)->get();
        $galeria = Galeria::where('tipo_relacion','freelancer')->where('idrelacion',$id)->get();
        $formacion = FormacionAcademica::where('tipo_relacion','freelancer')->where('idrelacion',$id)->get();
        /*$experiencia = ExperienciaLaboral::where('tipo_relacion','freelancer')->where('idrelacion',$id)->first();
        $idioma = Idioma::where('tipo_relacion','freelancer')->where('idrelacion',$id)->get();
        $modelacion = ModelacionBim::where('tipo_relacion','freelancer')->where('idrelacion',$id)->first();
        $revision = Revision::where('tipo_relacion','freelancer')->where('idrelacion',$id)->first();
        $supervision = SupervisionTecnica::where('tipo_relacion','freelancer')->where('idrelacion',$id)->first();*/

        $vars = [
            'freelancer',
            'formacion',
            'proyectos',
            'galeria'
        ];

        return view('front.home.perfil-freelancer', compact($vars));
    }

    public function get_perfilEmpresa($id){
        $empresa = Empresa::find($id);
        $proyectos = ProyectoFaseDisciplina::where('tipo_contratista','empresa')->where('idcontratista',$id)->get();
        $galeria = Galeria::where('tipo_relacion','empresa')->where('idrelacion',$id)->get();

        $formacion = FormacionAcademica::where('tipo_relacion','empresa')->where('idrelacion',$id)->get();
        /*$experiencia = ExperienciaLaboral::where('tipo_relacion','empresa')->where('idrelacion',$id)->first();
        $idioma = Idioma::where('tipo_relacion','empresa')->where('idrelacion',$id)->get();
        $modelacion = ModelacionBim::where('tipo_relacion','empresa')->where('idrelacion',$id)->first();
        $revision = Revision::where('tipo_relacion','empresa')->where('idrelacion',$id)->first();
        $supervision = SupervisionTecnica::where('tipo_relacion','empresa')->where('idrelacion',$id)->first();*/

        $vars = [
            'empresa',
            'formacion',
            'proyectos',
            'galeria'
        ];

        return view('front.home.perfil-empresa', compact($vars));
    }

    public function get_perfilProveedor($id){
        
        $proveedor = Proveedor::find($id);
        $proyectos = ProyectoFaseDisciplina::where('tipo_contratista','proveedor')->where('idcontratista',$id)->get();
        $galeria = Galeria::where('tipo_relacion','proveedor')->where('idrelacion',$id)->get();

        $vars = [
            'proveedor',
            'proyectos',
            'galeria'
        ];

        return view('front.home.perfil-proveedor', compact($vars));

    }

    public function get_proyectosCliente($id, $relacion){
        
        $cliente = NULL;
        $proveedor = NULL;
        $freelancer = NULL;
        $empresa = NULL;
        $arrayId = [];
        if($relacion == 'cliente'){
            $proyectos = Proyecto::where('idcliente',$id)->get();
            $cliente = Cliente::find($id);    
        }elseif($relacion == 'freelancer'){
            $project = ProyectoFaseDisciplina::where('tipo_contratista','freelancer')->where('idcontratista',$id)->get();
            $arrayId = [];
            foreach($project as $proyecto){
                foreach ($proyecto->proyectos as $proyectos_asociados){
                    $arrayId[] = $proyectos_asociados->idproyecto;
                }

            }
            $proyectos = Proyecto::whereIn('idproyecto',$arrayId)->get();

        }elseif($relacion == 'empresa'){
            $project = ProyectoFaseDisciplina::where('tipo_contratista','empresa')->where('idcontratista',$id)->get();
            $arrayId = [];

            foreach($project as $proyecto){
                foreach ($proyecto->proyectos as $proyectos_asociados){
                    $arrayId[] = $proyectos_asociados->idproyecto;
                }

            }
            $proyectos = Proyecto::whereIn('idproyecto',$arrayId)->get();

        }else{
            $project = ProyectoFaseDisciplina::where('tipo_contratista','proveedor')->where('idcontratista',$id)->get();
            $arrayId = [];
            foreach($project as $proyecto){
                foreach ($proyecto->proyectos as $proyectos_asociados){
                    $arrayId[] = $proyectos_asociados->idproyecto;
                }

            }
            $proyectos = Proyecto::whereIn('idproyecto',$arrayId)->get();

        }
        $vars = [
            'proyectos',
            'cliente',
            'proveedor',
            'freelancer',
            'empresa',
            'relacion'
        ];

        return view('front.home.misproyectos', compact($vars));

    }

    public function updateCliente($proceso,$cliente,$proyecto){
        $success = false;
        DB::beginTransaction();
        try {
            //creamos el modelo
            $proyectos = Proyecto::find($proyecto);
            $proyectos->proceso = $proceso;
            if($proceso === "100"){
                $proyectos->estado = 'finalizado';

            }else{
                $proyectos->estado = 'en_proceso';

            }
            if($proyectos->save())
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
            Session::flash("mensaje","Proceso actualizado correctamente");
            return Redirect::to("clientes/".$cliente."/cliente/mis-proyectos");
        } else {
            DB::rollback();
            Session::flash("errordataform","El proceso no pudo ser actualizado, inténtalo nuevamente.");
            $mensajeerror="El proceso no pudo ser actualizado, inténtalo nuevamente.";
            return Redirect::to('clientes/'.$cliente.'/cliente/mis-proyectos')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
        }
    }

    public function proyectoInfo($relacion,$id, $idproyecto){
        
        $cliente = NULL;
        $empresa = NULL;
        $freelancer = NULL;
        $proveedor = NULL;
        if($relacion == 'cliente'){
            $cliente = Cliente::find($id);
        }elseif($relacion == 'freelancer'){
            $freelancer = Freelancer::find($id);
        }elseif($relacion == 'empresa'){
            $empresa = Empresa::find($id);
        }else{
            $proveedor = Proveedor::find($id);
        }
        $proyecto = Proyecto::find($idproyecto);

        $especialidades = EspecialidadProveedor::whereIn('nombre',['Alquiler', 'Proveedor','Instalaciones', 'Laboratorios'])->get();
        $fases = DB::select("SELECT f.idfase as idfase, f.nombre as nombre from fases as f, fase_disciplina_subuso as fs where fs.fase_id = f.idfase AND fs.tipo_proyecto_id = $proyecto->idtipo GROUP by f.nombre, f.idfase ORDER BY f.idfase ASC");
        $fases_disciplinas = FaseDisciplinaSubuso::where('sub_uso_ocupacion_id',$proyecto->ie_subuso)->get();
        $vars = [
            'cliente',
            'proveedor',
            'freelancer',
            'empresa',
            'relacion',
            'proyecto',
            'especialidades',
            'fases',
            'fases_disciplinas',
        ];

        return view('front.home.info-proyecto', compact($vars));

    }

    public function saveNewContratista($idproyecto, $idfase, $iddisciplina, $idcliente, Request $request){
        
        $recibir = $request->all();

        $reglas = array(
            'cuenta' => 'required',
        );
		//creacion de reglas para validación en un array
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
                $proyecto = ProyectoFaseDisciplina::where('idproyecto',$idproyecto)->where('idfase',$idfase)->where('iddisciplina',$iddisciplina)->first();
                $cuenta = 0;
                $seleccion = $request->input('seleccion_del_catalogo_'.$iddisciplina.'_'.$idfase);

                $contratista = $request->input('tipo_contratista_'.$iddisciplina.'_'.$idfase);

                $idcontratista = $request->input('idcontratista_'.$iddisciplina.'_'.$idfase);
                $estadocontratista = $request->input('estado_contratista_'.$iddisciplina.'_'.$idfase);

                $proyecto->cuenta_con_contratista = $cuenta;
                $proyecto->seleccion_del_catalogo = $seleccion;
                $proyecto->tipo_contratista = $contratista;
                $proyecto->idcontratista = $idcontratista;
                $proyecto->estado_contratista = $estadocontratista;

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
                Session::flash("mensaje","Contratista guardado correctamente");
                return Redirect::to('clientes/cliente/'.$idcliente.'/mis-proyectos/'.$idproyecto);
            } else {
                DB::rollback();
                Session::flash("errordataform","El contratista no pudo ser guardado, inténtalo nuevamente.");
                $mensajeerror="El contratista no pudo ser guardado, inténtalo nuevamente.";
                return Redirect::to('clientes/cliente/'.$idcliente.'/mis-proyectos/'.$idproyecto)->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}

    }

    public function beneficios(){
        
        $categoriaCliente = CategoriaBeneficio::where('nombre','Clientes Beneficios')->first();
        $categoriaCliente2 = CategoriaBeneficio::where('nombre','Clientes Descuentos')->first();
        $beneficiosClientes = $categoriaCliente->beneficios()->where('estado','publicado')->get();
        $descuentosClientes = $categoriaCliente2->beneficios()->where('estado','publicado')->get();


        $categoriaContratistas = CategoriaBeneficio::where('nombre','Contratistas Beneficios')->first();
        $categoriaContratistas2 = CategoriaBeneficio::where('nombre','Contratistas Descuentos')->first();
        $beneficiosContratistas = $categoriaContratistas->beneficios()->where('estado','publicado')->get();
        $descuentosContratistas = $categoriaContratistas2->beneficios()->where('estado','publicado')->get();



        $categoriaUniversidad = CategoriaBeneficio::where('nombre','Universidades Beneficios')->first();
        $categoriaUniversidad2 = CategoriaBeneficio::where('nombre','Universidades Descuentos')->first();
        $beneficiosUniversidades = $categoriaUniversidad->beneficios()->where('estado','publicado')->get();
        $descuentosUniversidades = $categoriaUniversidad2->beneficios()->where('estado','publicado')->get();


        $categoriaPasante = CategoriaBeneficio::where('nombre','Pasantes Beneficios')->first();
        $categoriaPasante2 = CategoriaBeneficio::where('nombre','Pasantes Descuentos')->first();
        $beneficiosPasantes = $categoriaPasante->beneficios()->where('estado','publicado')->get();
        $descuentosPasantes = $categoriaPasante2->beneficios()->where('estado','publicado')->get();

        

        $vars = [
            'beneficiosClientes',
            'descuentosClientes',
            'beneficiosContratistas',
            'descuentosContratistas',
            'beneficiosUniversidades',
            'descuentosUniversidades',
            'beneficiosPasantes',
            'descuentosPasantes',
        ];

        return view('front.home.beneficios', compact($vars));


    }

    public function getContenidos($id){
        
		$currentUrl = str_replace('http://', '', url()->current());
		$currentUrl = explode('/', $currentUrl, 4);



		// Consulta el slug a qué convocatoria pertenece
		$paginas = Pagina::where('ruta_pagina', $currentUrl[3])->first();

		$contenido = ContenidoPagina::where('idpagina', '=', $paginas->idpagina)->where('estado', 'activo')->get(); 

        $vars = [
            'paginas',
            'contenido',
        ];

        return view('front.home.paginas', compact($vars));

    }


}