<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Parametro;
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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ParametrosController extends Controller {
    /* funciones del controlador */

    //función por defecto del controlador , actua como el index del controlador
    public function get_index() {
        //valida que este logueado
        //valida el permiso de acceso

        $parametros = Parametro::all(); //get entrega todos los resultados,  reemplazarlo por paginate

        return View::make("admin.parametros.index")->with('parametros', $parametros);
    }

    public function get_crear() {
        //valida que este logueado

        return View::make("admin.parametros.crear");
    }

    public function post_crear(Request $request) {

        //valida el permiso de acceso
        //recibe todos los datos enviados en el formulario
        $recibir = $request->all();
        //creacion de reglas para validación en un array

        $reglas = array(
            'nombre' => 'required|min:4|max:255',
            'valor' => 'required|min:1',
        );
        //mensajes opcionales de validacion (sirve para cambiar los mensajes por defecto de una validación)
        $mensajes = array(
            'required' => 'Campo obligatorio'
        );
        //logica de validación
        $validar = Validator::make($recibir, $reglas, $mensajes); //los mensajes son opcionales

        if ($validar->fails()) {
            return Redirect::back()->withErrors($validar)->withInput(); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
        } else {
            $success = false;
			DB::beginTransaction();
			try {
				//creamos el modelo
				$parametro = new Parametro;
				$parametro->nombre = $request->input('nombre');
				$parametro->valor = $request->input('valor');
				//guardamos en la base de datos con el método save
				if($parametro->save())
				{
					$success = true;
				}
			} catch (\Exception $e) {
				// maybe log this exception, but basically it's just here so we can rollback if we get a surprise
				echo "<pre>";
				echo $e->getMessage();
				echo "<hr>";
				echo $e->getTraceAsString();
				echo "</pre>";
				exit();
			}

			//ahora creamos una variable de sesion antes de hacer la redirección
			if ($success) {
				DB::commit();
				Session::flash("mensaje","Parámetro creado satisfactoriamente!");
				return Redirect::to('parametros/');
			} else {
				DB::rollback();
				Session::flash("errordataform","El parámetro no pudo ser creado, inténtalo nuevamente.");
				return Redirect::to('parametros/')->with('errordataform',"El parámetro no pudo ser creado, inténtalo nuevamente."); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
			}
		}
    }

    public function editar($id) {

        //valida el permiso de acceso
        $parametro = Parametro::find($id);
        return View::make("admin.parametros.editar")->with("parametro", $parametro);
    }

    public function actualizar($id, Request $request) {

        //valida el permiso de acceso
        //recibe todos los datos enviados en el formulario
        $recibir = $request->all();
        //creacion de reglas para validación en un array

        $reglas = array(
            'nombre' => 'required|min:4|max:255',
            'valor' => 'required|min:1',
        );

        //logica de validación
        $validar = Validator::make($recibir, $reglas); //los mensajes son opcionales

        if ($validar->fails()) {
            return Redirect::to('parametros/' . $id . '/editar')->withErrors($validar); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
        } else {
            $success = false;
			DB::beginTransaction();
			try {
				//creamos el modelo
				$parametro = Parametro::find($id);
				$parametro->nombre = $request->input('nombre');
				$parametro->valor = $request->input('valor');
				//guardamos en la base de datos con el método save
				if($parametro->save())
				{
					$success = true;
				}
			} catch (\Exception $e) {
				// maybe log this exception, but basically it's just here so we can rollback if we get a surprise
				echo "<pre>";
				echo $e->getMessage();
				echo "<hr>";
				echo $e->getTraceAsString();
				echo "</pre>";
				exit();
			}

			//ahora creamos una variable de sesion antes de hacer la redirección
			if ($success) {
				DB::commit();
				Session::flash("mensaje","Parámetro actualizado satisfactoriamente!");
				return Redirect::to('parametros/');
			} else {
				DB::rollback();
				Session::flash("errordataform","El parámetro no pudo ser actualizado, inténtalo nuevamente.");
				return Redirect::to('parametros/')->with('errordataform',"El parámetro no pudo ser actualizado, inténtalo nuevamente."); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
			}
		}
    }

    public function mostrar($id ) {
        //valida que este logueado
        //valida el permiso de acceso
        $parametro = Parametro::find($id);
        return View::make("admin.parametros.mostrar")->with("parametro", $parametro);
    }

    public function eliminar($id ) {
        //valida que este logueado
        //valida el permiso de acceso

        $parametro = Parametro::find($id);
        $parametro->delete();
        Session::flash("mensaje", "Parametro eliminado exitosamente!");
        //redireccionamos
        return Redirect::to("parametros");
    }
} 
