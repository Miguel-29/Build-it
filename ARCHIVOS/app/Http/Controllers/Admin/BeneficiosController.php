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
use Storage;
use Illuminate\Routing\Controller;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Admin\Beneficio;
use App\Models\Admin\CategoriaBeneficio;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;

class BeneficiosController extends Controller {

	/* funciones del controlador */

	//función por defecto del controlador , actua como el index del controlador
	public function get_index()
	{
        $beneficio = Beneficio::all();
		return View::make("admin.beneficios.index")->with('beneficio',$beneficio);
    }

	public function get_crear()
	{
        $categorias = CategoriaBeneficio::all();
		return View::make("admin.beneficios.crear")->with('categorias',$categorias);
	}

	public function post_crear(Request $request)
	{
		//recibe todos los datos enviados en el formulario
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(
			'titulo' => 'required|min:3',
            'descripcion' => 'required|min:3',
            'estado' => 'required',
            'items' => 'required',

        );

        if ($request->file('imagen')) {
            $reglas['imagen'] = 'required|mimes:jpg,jpeg,png,gif,pdf,xls|max:4096';
        }

        if ($request->file('archivo')) {
            $reglas['archivo'] = 'required|mimes:jpg,jpeg,png,gif,pdf,xls|max:4096';
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
                $beneficio = new Beneficio;
                $beneficio->titulo = $request->input('titulo');
                $beneficio->descripcion = $request->input('descripcion');
                $beneficio->estado = $request->input('estado');



                //guardamos en la base de datos con el método save
                if($beneficio->save())
                {
                    if($request->file('imagen')){
                        $cover = $request->file('imagen');
                        $extension = time() . '.' . $cover->getClientOriginalExtension();
                        $destinationPath = public_path('uploads/beneficios/'.$beneficio->idbeneficio);
                        $cover->move($destinationPath, $cover->getFilename().'.'.$extension);
                        $beneficio->imagen = $cover->getFilename().'.'.$extension;
                    }

                    if($request->file('archivo')){
                        $cover = $request->file('archivo');
                        $extension = time() . '.' . $cover->getClientOriginalExtension();
                        $destinationPath = public_path('uploads/beneficios/'.$beneficio->idbeneficio);
                        $cover->move($destinationPath, $cover->getFilename().'.'.$extension);
                        $beneficio->archivo = $cover->getFilename().'.'.$extension;
                    }

    
                    if($beneficio->save()){
                        $categoriasList = $request->input('items');
                        $beneficio->categorias()->detach();
                        foreach ($categoriasList as  $itemvalue) {
    
                            $categoriaID = $itemvalue;
    
                            $beneficio->categorias()->attach([$categoriaID]);
                        }
                        $success = true;    
                    }
                }

            } catch (\Exception $e) {
                echo $e->getMessage();die();
                // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
            }
            //ahora creamos una variable de sesion antes de hacer la redirección
            if ($success) {
                DB::commit();
                Session::flash("mensaje","Beneficio creado satisfactoriamente!");
                return Redirect::to("beneficios");
            } else {
                DB::rollback();
                Session::flash("errordataform","El beneficio no pudo ser creado, inténtalo nuevamente.");
                $mensajeerror="El beneficio no pudo ser creado, inténtalo nuevamente.";
                return Redirect::to('beneficios')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
	}

	public function editar($id){
        $beneficio = Beneficio::find($id);
        $categorias = CategoriaBeneficio::all();
		return View::make("admin.beneficios.editar")->with('beneficio',$beneficio)->with('categorias',$categorias);
	}

	public function actualizar($id, Request $request){
		//recibe todos los datos enviados en el formulario
		$recibir= $request->all();

        		//creacion de reglas para validación en un array
		$reglas = array(
			'titulo' => 'required|min:3',
            'descripcion' => 'required|min:3',
            'estado' => 'required',
            'items' => 'required',

        );

        if ($request->file('imagen')) {
            $reglas['imagen'] = 'required|mimes:jpg,jpeg,png,gif,pdf,xls|max:4096';
        }

        if ($request->file('archivo')) {
            $reglas['archivo'] = 'required|mimes:jpg,jpeg,png,gif,pdf,xls|max:4096';
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
				$beneficio = Beneficio::find($id);
                $beneficio->titulo = $request->input('titulo');
                $beneficio->descripcion = $request->input('descripcion');
                $beneficio->estado = $request->input('estado');



                //guardamos en la base de datos con el método save
                if($beneficio->save())
                {
                    if($request->file('imagen')){

                        if($beneficio->imagen !== NULL){
                            if(file_exists('/uploads/beneficios/'.$beneficio->idbeneficio.'/'.$beneficio->imagen)){
                                unlink(public_path('uploads/beneficios/'.$beneficio->idbeneficio.'/'.$beneficio->imagen));
                            }
                        }
                        $cover = $request->file('imagen');
                        $extension = time() . '.' . $cover->getClientOriginalExtension();
                        $destinationPath = public_path('uploads/beneficios/'.$beneficio->idbeneficio);
                        $cover->move($destinationPath, $cover->getFilename().'.'.$extension);
                        $beneficio->imagen= $cover->getFilename().'.'.$extension;
                    }

                    if($request->file('archivo')){

                        if($beneficio->archivo !== NULL){
                            if(file_exists('/uploads/beneficios/'.$beneficio->idbeneficio.'/'.$beneficio->archivo)){
                                unlink(public_path('uploads/beneficios/'.$beneficio->idbeneficio.'/'.$beneficio->archivo));
                            }
                        }
                        $cover = $request->file('archivo');
                        $extension = time() . '.' . $cover->getClientOriginalExtension();
                        $destinationPath = public_path('uploads/beneficios/'.$beneficio->idbeneficio);
                        $cover->move($destinationPath, $cover->getFilename().'.'.$extension);
                        $beneficio->archivo= $cover->getFilename().'.'.$extension;
                    }

    
                    if($beneficio->save()){
                        $categoriasList = $request->input('items');
                        $beneficio->categorias()->detach();
                        foreach ($categoriasList as  $itemvalue) {
    
                            $categoriaID = $itemvalue;
    
                            $beneficio->categorias()->attach([$categoriaID]);
                        }
                        $success = true;    
                    }
                }

			} catch (\Exception $e) {
				echo $e->getMessage();die();
				// maybe log this exception, but basically it's just here so we can rollback if we get a surprise
			}
			//ahora creamos una variable de sesion antes de hacer la redirección
			if ($success) {
				DB::commit();
				Session::flash("mensaje","Beneficio actualizado satisfactoriamente!");
				return Redirect::to("beneficios");
			} else {
				DB::rollback();
				Session::flash("errordataform","El beneficio no pudo ser actualizado, inténtalo nuevamente.");
				$mensajeerror="El beneficio no pudo ser actualizado, inténtalo nuevamente.";
				return Redirect::to('beneficios')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
			}
		}
	}

	public function mostrar($id){
		$beneficio = Beneficio::find($id);
		return View::make("admin.beneficios.mostrar")->with("beneficio",$beneficio);
	}
	
	public function eliminar($id){
		$beneficio = Beneficio::find($id);
		
		//borrar el usuario
		$beneficio->delete();
		Session::flash("mensaje","Beneficio eliminado exitosamente!");
		return Redirect::to("beneficios");
	}

}
