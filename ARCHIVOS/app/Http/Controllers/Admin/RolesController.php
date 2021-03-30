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

class RolesController extends Controller {

	/* funciones del controlador */

	//función por defecto del controlador , actua como el index del controlador
	public function get_index()
	{
		$roles = Role::all(); //get entrega todos los resultados,  reemplazarlo por paginate	
		return View::make("admin.roles.index")->with('roles',$roles);
	}

	public function get_crear()
	{
		return View::make("admin.roles.crear");
	}

	public function post_crear(Request $request)
	{
		//recibe todos los datos enviados en el formulario
		$recibir = $request->all();
		//creacion de reglas para validación en un array

		$reglas = array(
				'name' => 'required|min:4|max:50',
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
			$rol = new Role;
			//asignamos los valores
			$rol->name = $request->input('name');
			//guardamos en la base de datos con el método save
			$rol->save();
			//ahora creamos una variable de sesion antes de hacer la redirección
			Session::flash("mensaje","Rol creado exitosamente!");
			//redireccionamos
			return Redirect::to("roles");
		}
	}

	public function editar($id){
		$rol = Role::find($id);
		return View::make("admin.roles.editar")->with("rol",$rol);
	}

	public function actualizar($id, Request $request){
		//recibe todos los datos enviados en el formulario
		$recibir= $request->all();
		//creacion de reglas para validación en un array

		$reglas = array(
				'name' => 'required|min:4|max:50',
			);
		
		$mensajes = array(
				'required'=>'Campo obligatorio'
			);

		//logica de validación
		$validar = Validator::make($recibir,$reglas,$mensajes); //los mensajes son opcionales

		if($validar->fails())
		{
			return Redirect::to('roles/'.$id.'/editar')->withErrors($validar); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
			//creamos el modelo
			$rol = Role::find($id);
			//asignamos los valores
			$rol->name = $request->input('name');
			//guardamos en la base de datos con el método save
			$rol->save();
			//ahora creamos una variable de sesion antes de hacer la redirección
			Session::flash("mensaje","Rol actualizado exitosamente!");
			//redireccionamos
			return Redirect::to("roles");
		}
	}

	public function mostrar($id){
		$rol = Role::find($id);
		return View::make("admin.roles.mostrar")->with("rol",$rol);
	}
	
	public function eliminar($id){
		$rol = Role::find($id);
		$rol->delete();
		Session::flash("mensaje","Rol eliminado exitosamente!");
		//redireccionamos
		return Redirect::to("roles");
	}
	
	//función para asociar permisos a los roles
	public function get_permisos($rol) 
	{
		$objrol = Role::find($rol);
		$listadopermisos = Permission::all();
		
		return View::make("admin.roles.permisos")->with('objrol',$objrol)->with('listadopermisos',$listadopermisos);
	}

	//función para guardar los tipos de relación que se asociaron a roles
	public function save_permisos($rol, Request $request) 
	{	
		$objrol = Role::find($rol);
		$listadopermisos = Permission::all();
		
		$varsrequest = $_POST;
		$mensajeerror = "";
		
		if($mensajeerror!="")
		{
			Session::flash("errordataform",$mensajeerror);	
			return Redirect::to('roles/'.$rol.'/permisos')->with('errordataform',$mensajeerror)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
			$success = false;
			$tipospermisossel = $request->input('items');
	
			foreach ($tipospermisossel as $key => $nameperm) {
				$arrayPerm[] = $nameperm;
				//$objrol->givePermissionTo($nameperm);
			}
			$currentperms = Permission::whereIn('name', $arrayPerm)->get();

			if($objrol->syncPermissions($currentperms));
				$success = true;
	
			if ($success) {
				Session::flash("mensaje","Permisos asociados al rol exitosamente!");
				return Redirect::to("roles");
			} else {
				Session::flash("errordataform","Los permisos no pudieros ser asociados al rol, inténtalo nuevamente.");	
				return Redirect::to('roles/'.$rol.'/permisos')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
			}
			
		}
	}
}
