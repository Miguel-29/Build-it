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
use App\Models\Admin\Listado;
use App\Models\Admin\OpcionListado;

class ListadosController extends Controller {

	/* funciones del controlador */

	//función por defecto del controlador , actua como el index del controlador
	public function get_index()
	{
		$listados = Listado::all(); //get entrega todos los resultados,  reemplazarlo por paginate	
		return View::make("admin.listados.index")->with('listados',$listados);
	}

	public function get_crear()
	{
		return View::make("admin.listados.crear");
	}

	public function post_crear(Request $request)
	{
		//recibe todos los datos enviados en el formulario
		$recibir = $request->all();
		//creacion de reglas para validación en un array

		$reglas = array(
			'nombre' => 'required|min:4',
			'descripcion' => 'required|min:3',
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
			$listado = new Listado;
			//asignamos los valores
			$listado->nombre = $request->input('nombre');
			$listado->descripcion = $request->input('descripcion');
			//guardamos en la base de datos con el método save
			$listado->save();
			//ahora creamos una variable de sesion antes de hacer la redirección
			Session::flash("mensaje","Listado creado exitosamente!");
			//redireccionamos
			return Redirect::to("listados");
		}
	}

	public function editar($id){
		$listado = Listado::find($id);
		return View::make("admin.listados.editar")->with("listado",$listado);
	}

	public function actualizar($id, Request $request){
		//recibe todos los datos enviados en el formulario
		$recibir= $request->all();
		//creacion de reglas para validación en un array

		$reglas = array(
			'nombre' => 'required|min:4',
			'descripcion' => 'required|min:3',
		);
		
		$mensajes = array(
			'required'=>'Campo obligatorio'
		);

		//logica de validación
		$validar = Validator::make($recibir,$reglas,$mensajes); //los mensajes son opcionales

		if($validar->fails())
		{
			return Redirect::to('listados/'.$id.'/editar')->withErrors($validar); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
			//creamos el modelo
			$listado = Listado::find($id);
			//asignamos los valores
			$listado->nombre = $request->input('nombre');
			$listado->descripcion = $request->input('descripcion');
			//guardamos en la base de datos con el método save
			$listado->save();
			//ahora creamos una variable de sesion antes de hacer la redirección
			Session::flash("mensaje","Listado actualizado exitosamente!");
			//redireccionamos
			return Redirect::to("listados");
		}
	}

	public function mostrar($id){
		$listado = Listado::find($id);
		return View::make("admin.listados.mostrar")->with("listado",$listado);
	}
	
	public function eliminar($id){
		$listado = Listado::find($id);
		$listado->delete();
		Session::flash("mensaje","Listado eliminado exitosamente!");
		//redireccionamos
		return Redirect::to("listados");
    }
    
    //GET OPCIONES DE LISTADO
    public function index_opcion($id){
		$listado = Listado::find($id);
		return View::make("admin.opcion-listados.index")->with('listado',$listado);
    }

    public function crear_opcion($id){
		$listados = Listado::where('idlistado',$id)->get();
		return View::make("admin.opcion-listados.crear")->with('listados',$listados);
    }

    public function editar_opcion($idlistado,$idopcion){
        $opcion = OpcionListado::where('idopcion',$idopcion)->first();
		$listados = Listado::where('idlistado',$idlistado)->get();
		return View::make("admin.opcion-listados.editar")->with('listados',$listados)->with('opcion',$opcion);
    }
	
}
