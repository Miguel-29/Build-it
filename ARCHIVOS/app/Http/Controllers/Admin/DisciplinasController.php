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
use App\Models\Admin\Disciplina;
use App\Models\Admin\ServicioEspecialidad;
use App\Models\Admin\Profesion;

class DisciplinasController extends Controller {

	/* funciones del controlador */

	//función por defecto del controlador , actua como el index del controlador
	public function get_index()
	{
		$disciplinas = Disciplina::all(); //get entrega todos los resultados,  reemplazarlo por paginate	
		return View::make("admin.disciplinas.index")->with('disciplinas',$disciplinas);
	}

	public function get_crear()
	{
		return View::make("admin.disciplinas.crear");
	}

	public function post_crear(Request $request)
	{
		//recibe todos los datos enviados en el formulario
		$recibir = $request->all();
		//creacion de reglas para validación en un array

		$reglas = array(
			'nombre' => 'required|min:4|max:50',
            'descripcion' => 'required|min:3',
            'asociada_a' => 'required'
		);

        if ($request->file('image')) {
            $reglas['image'] = 'required|mimes:jpg,jpeg,png,gif,pdf,xls|max:4096';
        }

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
			$disciplina = new Disciplina;
			//asignamos los valores
			$disciplina->nombre = $request->input('nombre');
            $disciplina->descripcion = $request->input('descripcion');
            $disciplina->asociada_a = $request->input('asociada_a');
            if($request->file('image')){
                $cover = $request->file('image');
                $extension = time() . '.' . $cover->getClientOriginalExtension();
                $destinationPath = public_path('uploads/disciplinas');
                $cover->move($destinationPath, $cover->getFilename().'.'.$extension);
                $disciplina->image = $cover->getFilename().'.'.$extension;
            }

			//guardamos en la base de datos con el método save
			$disciplina->save();
			//ahora creamos una variable de sesion antes de hacer la redirección
			Session::flash("mensaje","Disciplina creada exitosamente!");
			//redireccionamos
			return Redirect::to("disciplinas");
		}
	}

	public function editar($id){
		$disciplina = Disciplina::find($id);
		return View::make("admin.disciplinas.editar")->with("disciplina",$disciplina);
	}

	public function actualizar($id, Request $request){
        $recibir = $request->all();
		//recibe todos los datos enviados en el formulario
		$reglas = array(
			'nombre' => 'required|min:4|max:50',
            'descripcion' => 'required|min:3',
            'asociada_a' => 'required'
		);

        if ($request->file('image')) {
            $reglas['image'] = 'required|mimes:jpg,jpeg,png,gif,pdf,xls|max:4096';
        }
		
		$mensajes = array(
			'required'=>'Campo obligatorio'
		);

		//logica de validación
		$validar = Validator::make($recibir,$reglas,$mensajes); //los mensajes son opcionales

		if($validar->fails())
		{
			return Redirect::to('disciplinas/'.$id.'/editar')->withErrors($validar); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
		}else{
			//creamos el modelo
			$disciplina = Disciplina::find($id);
			//asignamos los valores
			$disciplina->nombre = $request->input('nombre');
            $disciplina->descripcion = $request->input('descripcion');
            $disciplina->asociada_a = $request->input('asociada_a');
            if($request->file('image')){
                $cover = $request->file('image');
                $extension = time() . '.' . $cover->getClientOriginalExtension();
                $destinationPath = public_path('uploads/disciplinas');
                $cover->move($destinationPath, $cover->getFilename().'.'.$extension);
                $disciplina->image = $cover->getFilename().'.'.$extension;
            }

			//guardamos en la base de datos con el método save
			$disciplina->save();
			//ahora creamos una variable de sesion antes de hacer la redirección
			Session::flash("mensaje","Disciplina actualizada exitosamente!");
			//redireccionamos
			return Redirect::to("disciplinas");
		}
	}

	public function mostrar($id){
		$disciplina = Disciplina::find($id);
		return View::make("admin.disciplinas.mostrar")->with("disciplina",$disciplina);
	}
	
	public function eliminar($id){
		$disciplina = Disciplina::find($id);
		$disciplina->delete();
		Session::flash("mensaje","Disciplina eliminada exitosamente!");
		//redireccionamos
		return Redirect::to("disciplinas");
    }
    //SAVE SERVICIOS-DISCIPLINA
    public function get_servicios($id){
        $disciplina = Disciplina::find($id);
        $servicios = ServicioEspecialidad::all();
		return View::make("admin.disciplinas.servicios")->with("disciplina",$disciplina)->with('servicios',$servicios);
    }
    
    public function save_servicios($id, Request $request){
        $disciplina = Disciplina::find($id);
        $success = false;
        DB::beginTransaction();
        try {
            $servicioslist = $request->input('items');
            $arrayProds = [];
            $disciplina->servicios()->detach();
            foreach ($servicioslist as  $itemvalue) {
                $arrayValue = $itemvalue;
                $serviceID = $arrayValue;
                $disciplina->servicios()->attach([$serviceID]);
            }
            $success = true;
        } catch (\Exception $e) {
            echo $e->getMessage();die();
            // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
        }
        //ahora creamos una variable de sesion antes de hacer la redirección
        if ($success) {
            DB::commit();
            Session::flash("mensaje","Servicios asociados satisfactoriamente!");
            return Redirect::to("disciplinas");
        } else {
            DB::rollback();
            Session::flash("errordataform","Los servicios no pudieron ser asociados, inténtalo nuevamente.");
            $mensajeerror="Los servicios no pudieron ser asociados, inténtalo nuevamente.";
            return Redirect::to('disciplinas')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
        }
    }
    
    //SAVE PROFESION-DISCIPLINA
    public function get_profesiones($id){
        $disciplina = Disciplina::find($id);
        $profesiones = Profesion::all();
		return View::make("admin.disciplinas.profesiones")->with("disciplina",$disciplina)->with('profesiones',$profesiones);
    }
    
    public function save_profesiones($id, Request $request){
        $disciplina = Disciplina::find($id);
        $success = false;
        DB::beginTransaction();
        try {
            $profesionesList = $request->input('items');
            $arrayProds = [];
            $disciplina->profesiones()->detach();
            foreach ($profesionesList as  $itemvalue) {
                $arrayValue = $itemvalue;
                $profesionID = $arrayValue;
                $disciplina->profesiones()->attach([$profesionID]);
            }
            $success = true;
        } catch (\Exception $e) {
            echo $e->getMessage();die();
            // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
        }
        //ahora creamos una variable de sesion antes de hacer la redirección
        if ($success) {
            DB::commit();
            Session::flash("mensaje","Profesiones asociadas satisfactoriamente!");
            return Redirect::to("disciplinas");
        } else {
            DB::rollback();
            Session::flash("errordataform","Las profesiones no pudieron ser asociadas, inténtalo nuevamente.");
            $mensajeerror="Las profesiones no pudieron ser asociadas, inténtalo nuevamente.";
            return Redirect::to('disciplinas')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
        }
    }

    	
}
