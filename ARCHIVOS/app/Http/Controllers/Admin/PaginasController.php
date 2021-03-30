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
use App\Models\Admin\Pagina;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;

class PaginasController extends Controller {

	/* funciones del controlador */

	//función por defecto del controlador , actua como el index del controlador
	public function get_index()
	{
        $paginas = Pagina::all();
		return View::make("admin.paginas.index")->with('paginas',$paginas);
    }

	public function get_crear()
	{
		return View::make("admin.paginas.crear");
	}

	public function post_crear(Request $request)
	{
		//recibe todos los datos enviados en el formulario
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(
			'titulo' => 'required|min:3',
            'ruta_pagina' => 'required|min:3',
            'asociada_a' => 'required',
            'estado' => 'required',

        );
        if ($request->file('imagen_header')) {
            $reglas['imagen_header'] = 'required|mimes:jpg,jpeg,png,gif,pdf,xls|max:4096';
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
                $pagina = new Pagina;
                $pagina->titulo = $request->input('titulo');
                $pagina->ruta_pagina = $request->input('ruta_pagina');
                $pagina->asociada_a = $request->input('asociada_a');
                $pagina->estado = $request->input('estado');


                //guardamos en la base de datos con el método save
                if($pagina->save())
                {
                    $success = true;

                    if($request->file('imagen_header')){
                        $cover = $request->file('imagen_header');
                        $extension = time() . '.' . $cover->getClientOriginalExtension();
                        $destinationPath = public_path('uploads/paginas/'.$pagina->idpagina);
                        $cover->move($destinationPath, $cover->getFilename().'.'.$extension);
                        $pagina->imagen_header = $cover->getFilename().'.'.$extension;
                    }
                    if($pagina->save())
                    {
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
                Session::flash("mensaje","Página creada satisfactoriamente!");
                return Redirect::to("paginas");
            } else {
                DB::rollback();
                Session::flash("errordataform","La página no pudo ser creada, inténtalo nuevamente.");
                $mensajeerror="La página no pudo ser creada, inténtalo nuevamente.";
                return Redirect::to('paginas')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
	}

	public function editar($id){
        $pagina = Pagina::find($id);

		return View::make("admin.paginas.editar")->with('pagina',$pagina);
	}

	public function actualizar($id, Request $request){
		//recibe todos los datos enviados en el formulario
		$recibir= $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(
			'titulo' => 'required|min:3',
            'ruta_pagina' => 'required|min:3',
            'asociada_a' => 'required',
            'estado' => 'required',

        );
        if ($request->file('imagen_header')) {
            $reglas['imagen_header'] = 'required|mimes:jpg,jpeg,png,gif,pdf,xls|max:4096';
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
				$pagina = Pagina::find($id);
                $pagina->titulo = $request->input('titulo');
                $pagina->ruta_pagina = $request->input('ruta_pagina');
                $pagina->asociada_a = $request->input('asociada_a');
                $pagina->estado = $request->input('estado');


                //guardamos en la base de datos con el método save
                if($pagina->save())
                {
                    $success = true;

                    if($request->file('imagen_header')){
                        $cover = $request->file('imagen_header');
                        $extension = time() . '.' . $cover->getClientOriginalExtension();
                        $destinationPath = public_path('uploads/paginas/'.$pagina->idpagina);
                        $cover->move($destinationPath, $cover->getFilename().'.'.$extension);
                        $pagina->imagen_header = $cover->getFilename().'.'.$extension;
                    }
                    if($pagina->save())
                    {
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
				Session::flash("mensaje","Página actualizada satisfactoriamente!");
				return Redirect::to("paginas");
			} else {
				DB::rollback();
				Session::flash("errordataform","La página no pudo ser actualizada, inténtalo nuevamente.");
				$mensajeerror="La página no pudo ser actualizada, inténtalo nuevamente.";
				return Redirect::to('paginas')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
			}
		}
	}

	public function mostrar($id){
		$pagina = Pagina::find($id);
		return View::make("admin.paginas.mostrar")->with("pagina",$pagina);
	}
	
	public function eliminar($id){
		$pagina = Pagina::find($id);
		
		//borrar el usuario
		$pagina->delete();
		Session::flash("mensaje","Página eliminada exitosamente!");
		return Redirect::to("paginas");
	}

}
