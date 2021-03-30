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

class OpcionListadoController extends Controller {

	/* funciones del controlador */

	//función por defecto del controlador , actua como el index del controlador
	public function get_index()
	{
		//$opciones = OpcionListado::all(); //get entrega todos los resultados,  reemplazarlo por paginate	
		//return View::make("admin.opcion-listados.index")->with('opciones',$opciones);
        return View::make("admin.opcion-listados.index");
	}

	public function get_crear()
	{
        $listados = Listado::all();
		return View::make("admin.opcion-listados.crear")->with('listados',$listados);
	}

	public function post_crear(Request $request)
	{
		//recibe todos los datos enviados en el formulario
		$recibir = $request->all();
		//creacion de reglas para validación en un array

		$reglas = array(
			'nombre' => 'required|min:1',
			'idlistado' => 'required',
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
			$opcion = new OpcionListado;
			//asignamos los valores
			$opcion->nombre = $request->input('nombre');
			$opcion->idlistado = $request->input('idlistado');
			//guardamos en la base de datos con el método save
			$opcion->save();
			//ahora creamos una variable de sesion antes de hacer la redirección
			Session::flash("mensaje","Opción creada exitosamente!");
			//redireccionamos
			return Redirect::to("opcionlistados");
		}
	}

	public function editar($id){
        $opcion = OpcionListado::where('idopcion',$id)->first();

        $listados = Listado::all();
		return View::make("admin.opcion-listados.editar")->with("listados",$listados)->with('opcion',$opcion);
	}

	public function actualizar($id, Request $request){
		//recibe todos los datos enviados en el formulario
		$recibir= $request->all();
		//creacion de reglas para validación en un array

		$reglas = array(
			'nombre' => 'required|min:1',
			'idlistado' => 'required',
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

            $affected = DB::update('update opciones_listado set nombre = :nombre, idlistado = :idlistado where idopcion = :idopcion', [':nombre' => $request->input('nombre'),
                                                                                                                                        ':idlistado' => $request->input('idlistado')*1,
                                                                                                                                        ':idopcion' => $id*1
                                                                                                                                        ]);

            /*$opcion = OpcionListado::where('idopcion',$id)->first();
			//asignamos los valores
			$opcion->nombre = $request->input('nombre');
			$opcion->idlistado = $request->input('idlistado');
			//guardamos en la base de datos con el método save
			$opcion->save();*/
			//ahora creamos una variable de sesion antes de hacer la redirección
			Session::flash("mensaje","Opción actualizado exitosamente!");
			//redireccionamos
			return Redirect::to('opcionlistados');
		}
	}

	public function mostrar($id){
        $opcion = OpcionListado::where('idopcion',$id)->first();

		return View::make("admin.opcion-listados.mostrar")->with("opcion",$opcion);
	}
	
	public function eliminar($id){
        //$opcion = OpcionListado::where('idopcion',$id)->first();
        $delete = DB::delete('delete from opciones_listado where idopcion = ?',[$id*1]);
		Session::flash("mensaje","Opción eliminada exitosamente!");
		//redireccionamos
		return Redirect::to("opcionlistados");
	}
	
}
