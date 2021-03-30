<?php 
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Form;
use View;
use Validator;
//use Input;
use Redirect;
use Session;
use DateTime;
use DB;
use Illuminate\Routing\Controller;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Admin\EspecialidadProveedor;
use App\Models\Admin\ServicioEspecialidad;


class EspecialidadesProveedorController extends Controller {

	/* funciones del controlador */

	//función por defecto del controlador , actua como el index del controlador
	public function get_index()
	{
		$especialidades = EspecialidadProveedor::all(); //get entrega todos los resultados,  reemplazarlo por paginate	
		return View::make("admin.especialidades-proveedor.index")->with('especialidades',$especialidades);
	}

	public function get_crear()
	{
		return View::make("admin.especialidades-proveedor.crear");
	}

	public function post_crear(Request $request)
	{
		//recibe todos los datos enviados en el formulario
		$recibir = $request->all();
		//creacion de reglas para validación en un array

		$reglas = array(
			'nombre' => 'required|min:4|max:50',
		);

		//mensajes opcionales de validacion (sirve para cambiar los mensajes por defecto de una validación)
		$mensajes = array(
			'required'=>'Campo obligatorio'			
		);
		//logica de validación
		$validar = Validator::make($recibir,$reglas,$mensajes); //los mensajes son opcionales

		if($validar->fails())
		{
			return Redirect::back()->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{

			//creamos el modelo
			$espacialidades = new EspecialidadProveedor;
			//asignamos los valores
			$espacialidades->nombre = $request->input('nombre');
			//guardamos en la base de datos con el método save
			$especialidades->save();
			//ahora creamos una variable de sesion antes de hacer la redirección
			Session::flash("mensaje","Especialidad creado exitosamente!");
			//redireccionamos
			return Redirect::to("especialidades-proveedor");
		}
	}

	public function editar($id){
		$especialidad = EspecialidadProveedor::find($id);
		return View::make("admin.especialidades-proveedor.editar")->with("especialidad",$especialidad);
	}

	public function actualizar($id, Request $request){
		//recibe todos los datos enviados en el formulario
		$recibir= $request->all();
		//creacion de reglas para validación en un array

		$reglas = array(
			'nombre' => 'required|min:4|max:50',
		);
		
		$mensajes = array(
			'required'=>'Campo obligatorio'
		);

		//logica de validación
		$validar = Validator::make($recibir,$reglas,$mensajes); //los mensajes son opcionales

		if($validar->fails())
		{
			return Redirect::to('especialidades-proveedor/'.$id.'/editar')->withErrors($validar); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
			//creamos el modelo
			$especialidad = EspecialidadProveedor::find($id);
			//asignamos los valores
			$especialidad->nombre = $request->input('nombre');
			//guardamos en la base de datos con el método save
			$especialidad->save();
			//ahora creamos una variable de sesion antes de hacer la redirección
			Session::flash("mensaje","Especialidad actualizada exitosamente!");
			//redireccionamos
			return Redirect::to("especialidades-proveedor");
		}
	}

	public function mostrar($id){
		$especialidad = EspecialidadProveedor::find($id);
		return View::make("admin.especialidades-proveedor.mostrar")->with("especialidad",$especialidad);
	}
	
	public function eliminar($id){
		$especialidad = EspecialidadProveedor::find($id);
		$especialidad->delete();
		Session::flash("mensaje","Especialidad eliminada exitosamente!");
		//redireccionamos
		return Redirect::to("especialidades-proveedor");
    }
    
    //GET SERVICIOS DE ESPECIALIDAD
    public function index_servicio($id){
		$especialidad = EspecialidadProveedor::find($id);
		$servicios = ServicioEspecialidad::where('idespecialidad',$especialidad->idespecialidad)->get();
		return View::make("admin.servicios-especialidad.index")->with('especialidad',$especialidad)->with('servicios',$servicios);
    }

    public function crear_servicio($id){
		$especialidades = EspecialidadProveedor::where('idespecialidad',$id)->get();
		return View::make("admin.servicios-especialidad.crear")->with('especialidades',$especialidades);
    }

    public function editar_servicio($idespecialidad,$idservicio){
        $servicio = ServicioEspecialidad::find($idservicio);
		$especialidades = EspecialidadProveedor::where('idespecialidad',$idespecialidad)->get();
		return View::make("admin.servicios-especialidad.editar")->with('especialidades',$especialidades)->with('servicio',$servicio);
    }
	
}
