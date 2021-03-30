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
use App\Models\Admin\ContenidoPagina;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;

class ContenidosPaginasController extends Controller {

	/* funciones del controlador */

	//función por defecto del controlador , actua como el index del controlador
	public function get_index()
	{
        $contenidospaginas = ContenidoPagina::all();
		return View::make("admin.contenidos-paginas.index")->with('contenidospaginas',$contenidospaginas);
    }

	public function get_crear()
	{
        $paginas = Pagina::where('estado','activo')->get();
		return View::make("admin.contenidos-paginas.crear")->with('paginas',$paginas);
	}

	public function post_crear(Request $request)
	{
		//recibe todos los datos enviados en el formulario
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(
			'nombre' => 'required|min:3',
            'idpagina' => 'required',
            'descripcion' => 'required',
            'estado' => 'required',

        );
        if ($request->file('imagen')) {
            $reglas['imagen'] = 'required|mimes:jpg,jpeg,png,gif,pdf,xls|max:4096';
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
                $contenido = new ContenidoPagina;
                $contenido->nombre = $request->input('nombre');
                $contenido->idpagina = $request->input('idpagina');
                $contenido->descripcion = $request->input('descripcion');
                $contenido->estado = $request->input('estado');


                //guardamos en la base de datos con el método save
                if($contenido->save())
                {
                    $success = true;

                    if($request->file('imagen')){
                        $cover = $request->file('imagen');
                        $extension = time() . '.' . $cover->getClientOriginalExtension();
                        $destinationPath = public_path('uploads/paginas/'.$contenido->idpagina.'/contenidos/'.$contenido->idcontenido);
                        $cover->move($destinationPath, $cover->getFilename().'.'.$extension);
                        $contenido->imagen = $cover->getFilename().'.'.$extension;
                    }
                    if($contenido->save())
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
                Session::flash("mensaje","Contenido creado satisfactoriamente!");
                return Redirect::to("contenidos-paginas");
            } else {
                DB::rollback();
                Session::flash("errordataform","El contenido de la página no pudo ser creada, inténtalo nuevamente.");
                $mensajeerror="El contenido de la página no pudo ser creada, inténtalo nuevamente.";
                return Redirect::to('contenidos-paginas')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
	}

	public function editar($id){
        $contenido = ContenidoPagina::find($id);
        $paginas = Pagina::where('estado','activo')->get();

		return View::make("admin.contenidos-paginas.editar")->with('contenido',$contenido)->with('paginas',$paginas);
	}

	public function actualizar($id, Request $request){
		//recibe todos los datos enviados en el formulario
		$recibir= $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(
			'nombre' => 'required|min:3',
            'idpagina' => 'required',
            'descripcion' => 'required',
            'estado' => 'required',

        );
        if ($request->file('imagen')) {
            $reglas['imagen'] = 'required|mimes:jpg,jpeg,png,gif,pdf,xls|max:4096';
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
				$contenido = ContenidoPagina::find($id);
                $contenido->nombre = $request->input('nombre');
                $contenido->idpagina = $request->input('idpagina');
                $contenido->descripcion = $request->input('descripcion');
                $contenido->estado = $request->input('estado');


                //guardamos en la base de datos con el método save
                if($contenido->save())
                {
                    $success = true;

                    if($request->file('imagen')){
                        $cover = $request->file('imagen');
                        $extension = time() . '.' . $cover->getClientOriginalExtension();
                        $destinationPath = public_path('uploads/paginas/'.$contenido->idpagina.'/contenidos/'.$contenido->idcontenido);
                        $cover->move($destinationPath, $cover->getFilename().'.'.$extension);
                        $contenido->imagen = $cover->getFilename().'.'.$extension;
                    }
                    if($contenido->save())
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
				Session::flash("mensaje","Contenido actualizada satisfactoriamente!");
				return Redirect::to("contenidos-paginas");
			} else {
				DB::rollback();
				Session::flash("errordataform","El contenido de la página no pudo ser actualizada, inténtalo nuevamente.");
				$mensajeerror="El contenido de la página no pudo ser actualizada, inténtalo nuevamente.";
				return Redirect::to('contenidos-paginas')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
			}
		}
	}

	public function mostrar($id){
		$contenido = ContenidoPagina::find($id);
		return View::make("admin.contenidos-paginas.mostrar")->with("contenido",$contenido);
	}
	
	public function eliminar($id){
		$contenido = ContenidoPagina::find($id);
		
		//borrar el usuario
		$contenido->delete();
		Session::flash("mensaje","Contenido eliminado exitosamente!");
		return Redirect::to("contenidos-paginas");
	}

}
