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
use App\Models\Admin\ServicioEspecialidad;
use App\Models\Admin\EspecialidadProveedor;

class ServiciosEspecialidadController extends Controller {

	/* funciones del controlador */

	//función por defecto del controlador , actua como el index del controlador
	public function get_index()
	{
		$servicios = ServicioEspecialidad::all(); //get entrega todos los resultados,  reemplazarlo por paginate	
		return View::make("admin.servicios-especialidad.index")->with('servicios',$servicios);
	}

	public function get_crear()
	{
        $especialidades = EspecialidadProveedor::all();
		return View::make("admin.servicios-especialidad.crear")->with('especialidades',$especialidades);
	}

	public function post_crear(Request $request)
	{
		//recibe todos los datos enviados en el formulario
		$recibir = $request->all();
		//creacion de reglas para validación en un array

		$reglas = array(
			'nombre' => 'required|min:4|max:50',
			'idespecialidad' => 'required',
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
			$servicio = new ServicioEspecialidad;
			//asignamos los valores
			$servicio->nombre = $request->input('nombre');
			$servicio->idespecialidad = $request->input('idespecialidad');
			//guardamos en la base de datos con el método save
			$servicio->save();
			//ahora creamos una variable de sesion antes de hacer la redirección
			Session::flash("mensaje","Servicio creado exitosamente!");
			//redireccionamos
			return Redirect::to("servicios-especialidad");
		}
	}

	public function editar($id){
        $servicio = ServicioEspecialidad::find($id);
        $especialidades = EspecialidadProveedor::all();
		return View::make("admin.servicios-especialidad.editar")->with("especialidades",$especialidades)->with('servicio',$servicio);
	}

	public function actualizar($id, Request $request){
		//recibe todos los datos enviados en el formulario
		$recibir= $request->all();
		//creacion de reglas para validación en un array

		$reglas = array(
			'nombre' => 'required|min:4|max:50',
			'idespecialidad' => 'required',
		);
		
		$mensajes = array(
			'required'=>'Campo obligatorio'
		);

		//logica de validación
		$validar = Validator::make($recibir,$reglas,$mensajes); //los mensajes son opcionales

		if($validar->fails())
		{
			return Redirect::to('servicios-especialidad/'.$id.'/editar')->withErrors($validar); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
			//creamos el modelo
			$servicio = ServicioEspecialidad::find($id);
			//asignamos los valores
			$servicio->nombre = $request->input('nombre');
			$servicio->idespecialidad = $request->input('idespecialidad');
			//guardamos en la base de datos con el método save
			$servicio->save();
			//ahora creamos una variable de sesion antes de hacer la redirección
			Session::flash("mensaje","Servicio actualizado exitosamente!");
			//redireccionamos
			return Redirect::to("servicios-especialidad");
		}
	}

	public function mostrar($id){
		$servicio = ServicioEspecialidad::find($id);
		return View::make("admin.servicios-especialidad.mostrar")->with("servicio",$servicio);
	}
	
	public function eliminar($id){
		$servicio = ServicioEspecialidad::find($id);
		$servicio->delete();
		Session::flash("mensaje","Servicio eliminado exitosamente!");
		//redireccionamos
		return Redirect::to("servicios-especialidad");
	}
	
}
