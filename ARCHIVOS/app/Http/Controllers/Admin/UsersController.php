<?php 
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Form;
use View;
use Validator;
use Input;
use Redirect;
use Session;
use DateTime;
use DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Routing\Controller;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Admin\User;

//use App\Rules\PassHistoryRule;



class UsersController extends Controller {

	//función por defecto del controlador , actua como el index del controlador
	public function get_index()
	{
		$usuarios = User::all(); //get entrega todos los resultados,  reemplazarlo por paginate
		//var_dump($usuarios);
		return View::make("admin.usuarios.index")->with('usuarios',$usuarios);
	}

	public function get_crear()
	{
		$listroles = Role::all();
		// Obtienen las Sedes
		return View::make("admin.usuarios.crear")->with('listroles',$listroles);
	}
	
	public function post_crear(Request $request)
	{
		//recibe todos los datos enviados en el formulario
		$recibir= $request->all();
		//creacion de reglas para validación en un array

		$reglas = array(
				'name' => 'required|min:3',
				'lastname' => 'required|min:3',
				'email' => 'required|email',
				'password' =>['required',
							'min:6',
							'max:100',
							'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                			
                			//'confirmed',
               				//new PassHistoryRule($recibir['email'])
               				],

				'password_repite' => 'required|same:password', //indica que debe ser igual al campo que se le dice en este caso al de contrasena
			);
		//mensajes opcionales de validacion (sirve para cambiar los mensajes por defecto de una validación)
		$mensajes = array(
				'required'=>'Campo obligatorio',
				'email'=>'Correo electrónico no válido',
				'regex'=>'Contraseña no cumple con las condiciones necesarias.',
				'same'=>'El campo confirmación de password no coincide.'
			);
		//logica de validación
		$validar = Validator::make($recibir,$reglas,$mensajes); //los mensajes son opcionales
		
		if($validar->fails())
		{
			
			return Redirect::back()->withErrors($validar)->withInput($recibir); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
			
			$success = false;
			DB::beginTransaction();
			try {
				//creamos el modelo
				$usuario = new User;
				$usuario->email = $request->input('email');
				$usuario->name = $request->input('name');
				$usuario->lastname = $request->input('lastname');
				$usuario->password = Hash::make($request->input('password'));
				//guardamos en la base de datos con el método save
				if($usuario->save())
				{
					$roleslist = $request->input('items');
	
					foreach ($roleslist as $key => $namerol) {
						$arrayPerm[] = $namerol;
					}

					$usuario->syncRoles($arrayPerm);
					$success = true;
					$token = $request->input('password');
				}

			} catch (\Exception $e) {
				echo $e->getMessage();die();
				// maybe log this exception, but basically it's just here so we can rollback if we get a surprise
			}
			//ahora creamos una variable de sesion antes de hacer la redirección
			if ($success) {
				DB::commit();
				Session::flash("mensaje","Usuario creado satisfactoriamente!");
				return Redirect::to("usuarios");
			} else {
				DB::rollback();
				Session::flash("errordataform","El usuario no pudo ser creado, inténtalo nuevamente.");
				$mensajeerror="El usuario no pudo ser creado, inténtalo nuevamente.";
				return Redirect::to('usuarios')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
			}
		}
	}

	public function editar($id){

		$usuario = User::find($id);
		$listroles = Role::all();
		
		return View::make("admin.usuarios.editar")->with("usuario",$usuario)->with('listroles',$listroles);
	}

	public function actualizar($id, Request $request){
		
		//recibe todos los datos enviados en el formulario
		$recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(
				'name' => 'required|min:3',
				'lastname' => 'required|min:3',
				'email' => 'required|email',
			);
		if(!empty($recibir['password']))
		{
			$reglas["password"]=['min:6',
								'max:100',
								'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
								//'confirmed',
								//new PassHistoryRule($recibir['email'])
							];
			$reglas["password_repite"]=['same:password'];
		}

		//mensajes opcionales de validacion (sirve para cambiar los mensajes por defecto de una validación)
		$mensajes = array(
						'required'=>'Campo obligatorio',
						'email'=>'Correo electrónico no válido',
						'regex'=>'Contraseña no cumple con las condiciones necesarias.',
						'same'=>'El campo confirmación de password no coincide.'
					);

		//logica de validación
		$validar = Validator::make($recibir,$reglas,$mensajes); //los mensajes son opcionales

		if($validar->fails())
		{
			return Redirect::to('usuarios/'.$id.'/editar')->withErrors($validar); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
			$success = false;
			DB::beginTransaction();
			try {
				//creamos el modelo
				$usuario = User::find($id);
				$usuario->email = $request->input('email');
				$usuario->name = $request->input('name');
				$usuario->lastname = $request->input('lastname');
				
				if($request->input('password')!="")
					$usuario->password = Hash::make($request->input('password'));

				//guardamos en la base de datos con el método save
				if($usuario->save())
				{
					$roleslist = $request->input('items');
	
					foreach ($roleslist as $key => $namerol) {
						$arrayPerm[] = $namerol;						
					}

					$usuario->syncRoles($arrayPerm);
					$success = true;
				}
			} catch (\Exception $e) {
				// maybe log this exception, but basically it's just here so we can rollback if we get a surprise
				//print_r($e);
			}

			//ahora creamos una variable de sesion antes de hacer la redirección
			if ($success) {
				DB::commit();
				Session::flash("mensaje","Usuario actualizado satisfactoriamente!");
				return Redirect::to("usuarios");
			} else {
				DB::rollback();
				Session::flash("errordataform","El usuario no pudo ser actualizado, inténtalo nuevamente.");
				$mensajeerror="El usuario no pudo ser actualizado, inténtalo nuevamente.";
				return Redirect::to('usuarios')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
			}

		}

	}

	public function mostrar($id){
		$usuario = User::find($id);
		return View::make("admin.usuarios.mostrar")->with("usuario",$usuario);
	}

	public function eliminar($id){
		$usuario = User::find($id);
		$usuario->delete();
		Session::flash("mensaje","Usuario eliminado exitosamente!");
		//redireccionamos
		return Redirect::to("usuarios/");
	}

}
