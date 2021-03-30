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
use App\Models\Admin\Post;
use App\Models\Admin\Categoria;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;

class PostsController extends Controller {

	/* funciones del controlador */

	//función por defecto del controlador , actua como el index del controlador
	public function get_index()
	{
        $post = Post::all();
		return View::make("admin.posts.index")->with('post',$post);
    }

	public function get_crear()
	{
        $categorias = Categoria::all();
		return View::make("admin.posts.crear")->with('categorias',$categorias);
	}

	public function post_crear(Request $request)
	{
		//recibe todos los datos enviados en el formulario
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(
			'titulo' => 'required|min:3',
            'resumenDescripcion' => 'required|min:3',
            'descripcion' => 'required|min:3',
            'estado' => 'required',
            'items' => 'required',

        );

        if ($request->file('imagenFull')) {
            $reglas['imagenFull'] = 'required|mimes:jpg,jpeg,png,gif,pdf,xls|max:4096';
        }

        if ($request->file('imagenSmall')) {
            $reglas['imagenSmall'] = 'required|mimes:jpg,jpeg,png,gif,pdf,xls|max:4096';
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
                $post = new Post;
                $post->titulo = $request->input('titulo');
                $post->resumenDescripcion = $request->input('resumenDescripcion');
                $post->descripcion = $request->input('descripcion');
                $post->estado = $request->input('estado');



                //guardamos en la base de datos con el método save
                if($post->save())
                {
                    if($request->file('imagenFull')){
                        $cover = $request->file('imagenFull');
                        $extension = time() . '.' . $cover->getClientOriginalExtension();
                        $destinationPath = public_path('uploads/posts/'.$post->idpost);
                        $cover->move($destinationPath, $cover->getFilename().'.'.$extension);
                        $post->imagenFull = $cover->getFilename().'.'.$extension;
                    }
    
                    if($request->file('imagenSmall')){
                        $cover = $request->file('imagenSmall');
                        $extension = time() . '.' . $cover->getClientOriginalExtension();
                        $destinationPath = public_path('uploads/posts/'.$post->idpost);
                        $cover->move($destinationPath, $cover->getFilename().'.'.$extension);
                        $post->imagenSmall = $cover->getFilename().'.'.$extension;
                    }
                    if($post->save()){
                        $categoriasList = $request->input('items');
                        $post->categorias()->detach();
                        foreach ($categoriasList as  $itemvalue) {
    
                            $categoriaID = $itemvalue;
    
                            $post->categorias()->attach([$categoriaID]);
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
                Session::flash("mensaje","Post creado satisfactoriamente!");
                return Redirect::to("posts");
            } else {
                DB::rollback();
                Session::flash("errordataform","El post no pudo ser creado, inténtalo nuevamente.");
                $mensajeerror="El post no pudo ser creado, inténtalo nuevamente.";
                return Redirect::to('posts')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
	}

	public function editar($id){
        $post = Post::find($id);
        $categorias = Categoria::all();
		return View::make("admin.posts.editar")->with('post',$post)->with('categorias',$categorias);
	}

	public function actualizar($id, Request $request){
		//recibe todos los datos enviados en el formulario
		$recibir= $request->all();

        		//creacion de reglas para validación en un array
		$reglas = array(
			'titulo' => 'required|min:3',
            'resumenDescripcion' => 'required|min:3',
            'descripcion' => 'required|min:3',
            'estado' => 'required',
            'items' => 'required',

        );

        if ($request->file('imagenFull')) {
            $reglas['imagenFull'] = 'required|mimes:jpg,jpeg,png,gif,pdf,xls|max:4096';
        }

        if ($request->file('imagenSmall')) {
            $reglas['imagenSmall'] = 'required|mimes:jpg,jpeg,png,gif,pdf,xls|max:4096';
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
				$post = Post::find($id);
                $post->titulo = $request->input('titulo');
                $post->resumenDescripcion = $request->input('resumenDescripcion');
                $post->descripcion = $request->input('descripcion');
                $post->estado = $request->input('estado');



                //guardamos en la base de datos con el método save
                if($post->save())
                {
                    if($request->file('imagenFull')){

                        if($post->imagenFull !== NULL){
                            if(file_exists('/uploads/posts/'.$post->idpost.'/'.$post->imagenFull)){
                                unlink(public_path('uploads/posts/'.$post->idpost.'/'.$post->imagenFull));
                            }
                        }
                        $cover = $request->file('imagenFull');
                        $extension = time() . '.' . $cover->getClientOriginalExtension();
                        $destinationPath = public_path('uploads/posts/'.$post->idpost);
                        $cover->move($destinationPath, $cover->getFilename().'.'.$extension);
                        $post->imagenFull = $cover->getFilename().'.'.$extension;
                    }
    
                    if($request->file('imagenSmall')){

                        if($post->imagenSmall !== NULL){
                            if(file_exists('/uploads/posts/'.$post->idpost.'/'.$post->imagenSmall)){
                                unlink(public_path('uploads/posts/'.$post->idpost.'/'.$post->imagenSmall));
                            }
                        }

                        $cover = $request->file('imagenSmall');
                        $extension = time() . '.' . $cover->getClientOriginalExtension();
                        $destinationPath = public_path('uploads/posts/'.$post->idpost);
                        $cover->move($destinationPath, $cover->getFilename().'.'.$extension);
                        $post->imagenSmall = $cover->getFilename().'.'.$extension;
                    }

                    if($post->save()){
                        $categoriasList = $request->input('items');
                        $post->categorias()->detach();
                        foreach ($categoriasList as  $itemvalue) {
    
                            $categoriaID = $itemvalue;
    
                            $post->categorias()->attach([$categoriaID]);
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
				Session::flash("mensaje","Post actualizado satisfactoriamente!");
				return Redirect::to("posts");
			} else {
				DB::rollback();
				Session::flash("errordataform","El post no pudo ser actualizado, inténtalo nuevamente.");
				$mensajeerror="El post no pudo ser actualizado, inténtalo nuevamente.";
				return Redirect::to('posts')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
			}
		}
	}

	public function mostrar($id){
		$post = Post::find($id);
		return View::make("admin.posts.mostrar")->with("post",$post);
	}
	
	public function eliminar($id){
		$post = Post::find($id);
		
		//borrar el usuario
		$post->delete();
		Session::flash("mensaje","Post eliminado exitosamente!");
		return Redirect::to("posts");
	}

}
