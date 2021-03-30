<?php 
namespace App\Http\Controllers\Admin;

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
use Illuminate\Routing\Controller;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Admin\Fase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;

class FasesController extends Controller {

	/* funciones del controlador */

	//función por defecto del controlador , actua como el index del controlador
	public function get_index()
	{
        $fases = Fase::all();
		return View::make("admin.fases.index")->with('fases',$fases);
    }

	public function get_crear()
	{
		return View::make("admin.fases.crear");
	}

	public function post_crear(Request $request)
	{
		//recibe todos los datos enviados en el formulario
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(
			'nombre' => 'required|min:3',
            'descripcion' => 'required|min:3',
        );
        if ($request->file('image')) {
            $reglas['image'] = 'required|mimes:jpg,jpeg,png,gif,pdf,xls|max:4096';
            }

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
                $fase = new Fase;
                $fase->nombre = $request->input('nombre');
                $fase->descripcion = $request->input('descripcion');

                if($request->file('image')){
                    $cover = $request->file('image');
                    $extension = time() . '.' . $cover->getClientOriginalExtension();
                    $destinationPath = public_path('uploads/fases');
                    $cover->move($destinationPath, $cover->getFilename().'.'.$extension);
                    $fase->image = $cover->getFilename().'.'.$extension;
                }
                //guardamos en la base de datos con el método save
                if($fase->save())
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
                Session::flash("mensaje","Fase creada satisfactoriamente!");
                return Redirect::to("fases");
            } else {
                DB::rollback();
                Session::flash("errordataform","La fase no pudo ser creada, inténtalo nuevamente.");
                $mensajeerror="La fase no pudo ser creada, inténtalo nuevamente.";
                return Redirect::to('fases')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
	}

	public function editar($id){
        $fase = Fase::find($id);

		return View::make("admin.fases.editar")->with('fase',$fase);
	}

	public function actualizar($id, Request $request){
		//recibe todos los datos enviados en el formulario
		$recibir= $request->all();
		//creacion de reglas para validación en un array

		$reglas = array(
			'nombre' => 'required|min:3',
            'descripcion' => 'required|min:3',
        );
        if ($request->file('image')) {
            $reglas['image'] = 'required|mimes:jpg,jpeg,png,gif,pdf,xls|max:4096';
            }


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
				$fase = Fase::find($id);
				$fase->nombre = $request->input('nombre');
				$fase->descripcion = $request->input('descripcion');

                if($request->file('image')){
					$cover = $request->file('image');
					$extension = time() . '.' . $cover->getClientOriginalExtension();
					$destinationPath = public_path('uploads/fases');
					$cover->move($destinationPath, $cover->getFilename().'.'.$extension);
					$fase->image = $cover->getFilename().'.'.$extension;
				}

				//guardamos en la base de datos con el método save
				if($fase->save())
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
				Session::flash("mensaje","Fase actualizada satisfactoriamente!");
				return Redirect::to("fases");
			} else {
				DB::rollback();
				Session::flash("errordataform","La fase no pudo ser actualizada, inténtalo nuevamente.");
				$mensajeerror="La fase no pudo ser actualizada, inténtalo nuevamente.";
				return Redirect::to('fases')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
			}
		}
	}

	public function mostrar($id){
		$fase = Fase::find($id);
		return View::make("admin.fases.mostrar")->with("fase",$fase);
	}
	
	public function eliminar($id){
		$fase = Fase::find($id);
		
		//borrar el usuario
		$fase->delete();
		Session::flash("mensaje","Fase eliminada exitosamente!");
		return Redirect::to("fases");
	}

}
