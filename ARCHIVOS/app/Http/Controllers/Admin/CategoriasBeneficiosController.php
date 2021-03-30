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
use App\Models\Admin\CategoriaBeneficio;

class CategoriasBeneficiosController extends Controller {

	/* funciones del controlador */

	//función por defecto del controlador , actua como el index del controlador
	public function get_index()
	{
		$categorias = CategoriaBeneficio::all(); //get entrega todos los resultados,  reemplazarlo por paginate	
		return View::make("admin.categorias-beneficios.index")->with('categorias',$categorias);
	}

	public function get_crear()
	{
		return View::make("admin.categorias-beneficios.crear");
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
			$categoria = new CategoriaBeneficio;
			//asignamos los valores
			$categoria->nombre = $request->input('nombre');
			//guardamos en la base de datos con el método save
			$categoria->save();
			//ahora creamos una variable de sesion antes de hacer la redirección
			Session::flash("mensaje","Categoria creada exitosamente!");
			//redireccionamos
			return Redirect::to("categorias-beneficios");
		}
	}

	public function editar($id){
		$categoria = CategoriaBeneficio::find($id);
		return View::make("admin.categorias-beneficios.editar")->with("categoria",$categoria);
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
			return Redirect::to('categorias/'.$id.'/editar')->withErrors($validar); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
			//creamos el modelo
			$categoria = CategoriaBeneficio::find($id);
			//asignamos los valores
			$categoria->nombre = $request->input('nombre');
			//guardamos en la base de datos con el método save
			$categoria->save();
			//ahora creamos una variable de sesion antes de hacer la redirección
			Session::flash("mensaje","Categoria actualizada exitosamente!");
			//redireccionamos
			return Redirect::to("categorias-beneficios");
		}
	}

	public function mostrar($id){
		$categoria = CategoriaBeneficio::find($id);
		return View::make("admin.categorias-beneficios.mostrar")->with("categoria",$categoria);
	}
	
	public function eliminar($id){
		$categoria = CategoriaBeneficio::find($id);
		$categoria->delete();
		Session::flash("mensaje","Categoría eliminado exitosamente!");
		//redireccionamos
		return Redirect::to("categorias-beneficios");
	}
    
}