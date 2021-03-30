<?php

namespace App\Http\Controllers\Front;

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
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;

use Illuminate\Routing\Controller;
use App\Models\Front\Freelancer;
use App\Models\Front\Empresa;
use App\Models\Admin\Disciplina;
use App\Models\Admin\Profesion;
use App\Models\Admin\EspecialidadProveedor;
use App\Models\Admin\Categoria;
use App\Models\Admin\Post;
use App\Models\Front\Proveedor;
use App\Models\Front\Cliente;
use App\Models\Front\Galeria;
use App\Models\Front\ProyectoFaseDisciplina;

use App\Models\Front\FormacionAcademica;
use App\Models\Front\ExperienciaLaboral;
use App\Models\Front\SupervisionTecnica;
use App\Models\Front\ModelacionBim;
use App\Models\Front\Revision;
use App\Models\Front\Idioma;
use App\Support\Perfiles;


class GaleriaController extends Controller
{
    use Perfiles;

    public function createGaleria(Request $request)
    {
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(

            'tipo_relacion' => 'required',
            'idrelacion' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
        );


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

                $tipo_relacion = $request->input('tipo_relacion');
                $idrelacion = $request->input('idrelacion');
                $idproyecto = $request->input('idproyecto');
                $nombre = $request->input('nombre');
                $descripcion = $request->input('descripcion');
                $estado = 0;

                $insertGaleria = $this->saveGaleria(
                                                                    $tipo_relacion,
                                                                    $idrelacion,
                                                                    $idproyecto,
                                                                    $nombre,
                                                                    $descripcion,
                                                                    $estado);

                if($insertGaleria){

                    $success = true;

                }else{

                    $success = false;
                }

            } catch (\Exception $e) {
                echo $e->getMessage();die();
                // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
            }
            $mensajeSuccess = 'Galeria creada exitosamente';
            $tipo_relacion = $request->input('tipo_relacion');
            $idrelacion = $request->input('idrelacion');

            if($tipo_relacion == 'freelancer'){
               $url = '/clientes/perfil-freelancer/'.$idrelacion;
            }elseif($tipo_relacion == 'empresa'){
                $url = '/clientes/perfil-empresa/'.$idrelacion;
            }else{
                $url = '/clientes/perfil-proveedor/'.$idrelacion;

            }
            
            //ahora creamos una variable de sesion antes de hacer la redirección
            if ($success) {
                DB::commit();
                Session::flash("mensaje",$mensajeSuccess);
                return Redirect::to($url);
            } else {
                DB::rollback();
                Session::flash("errordataform","Hubo un error creando la galeria, inténtalo nuevamente.");
                $mensajeerror="Hubo un error creando la galeria, inténtalo nuevamente.";
                return Redirect::to($url)->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }

    public function editarGaleria(Request $request)
    {
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(

            'idgaleria' => 'required',
            'descripcionImagen' => 'required',
            'imagen' => 'required',

        );


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

                $idgaleria = $request->input('idgaleria');
                $descripcion = $request->input('descripcionImagen');
                $image = $request->file('imagen');
                $estado = 0;

                $editarGaleria = $this->editGaleria($idgaleria,
                                                                    $image,
                                                                    $descripcion,
                                                                    $estado);

                if($editarGaleria){

                    $success = true;

                }else{

                    $success = false;
                }

            } catch (\Exception $e) {
                echo $e->getMessage();die();
                // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
            }
            $mensajeSuccess = 'Imagenes agregadas exitosamente';
            $tipo_relacion = $request->input('tipo_relacion');
            $idrelacion = $request->input('idrelacion');

            if($tipo_relacion == 'freelancer'){
               $url = '/clientes/perfil-freelancer/'.$idrelacion;
            }elseif($tipo_relacion == 'empresa'){
                $url = '/clientes/perfil-empresa/'.$idrelacion;
            }else{
                $url = '/clientes/perfil-proveedor/'.$idrelacion;

            }
            
            //ahora creamos una variable de sesion antes de hacer la redirección
            if ($success) {
                DB::commit();
                Session::flash("mensaje",$mensajeSuccess);
                return Redirect::to($url);
            } else {
                DB::rollback();
                Session::flash("errordataform","Hubo un error editando la galeria, inténtalo nuevamente.");
                $mensajeerror="Hubo un error editando la galeria, inténtalo nuevamente.";
                return Redirect::to('/clientes')->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
            }
		}
    }

    public function createComentario(Request $request)
    {
        $recibir = $request->all();

		//creacion de reglas para validación en un array
		$reglas = array(

            'tipo_relacion' => 'required',
            'idrelacion' => 'required',
            'idgaleria' => 'required',
            'descripcion_'.$request->input('idgaleria')*1 => 'required'
        );


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

                $tipo_relacion = $request->input('tipo_relacion');
                $idrelacion = $request->input('idrelacion');
                $idgaleria = $request->input('idgaleria')*1;
                $descripcion = $request->input('descripcion_'.$idgaleria);
                $insertComentario = $this->saveComentario(
                                                                    $tipo_relacion,
                                                                    $idrelacion,
                                                                    $idgaleria,
                                                                    $descripcion);

                if($insertComentario){

                    $success = true;

                }else{

                    $success = false;
                }

            } catch (\Exception $e) {
                echo $e->getMessage();die();
                // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
            }
            $mensajeSuccess = 'Comentario creado exitosamente';
            $tipo_relacion = $request->input('tipo_relacion');
            $idrelacion = $request->input('idrelacion');

            if($tipo_relacion == 'freelancer'){
               $url = '/clientes/perfil-freelancer/'.$idrelacion;
            }elseif($tipo_relacion == 'empresa'){
                $url = '/clientes/perfil-empresa/'.$idrelacion;
            }else{
                $url = '/clientes/perfil-proveedor/'.$idrelacion;

            }
            
            //ahora creamos una variable de sesion antes de hacer la redirección
            if ($success) {
                DB::commit();
                Session::flash("mensaje",$mensajeSuccess);
                if($tipo_relacion == 'cliente'){
                    return Redirect::back();
                }else{
                    return Redirect::to($url);
                }
            } else {
                DB::rollback();
                Session::flash("errordataform","Hubo un error creando el comentario, inténtalo nuevamente.");
                $mensajeerror="Hubo un error creando el comentario, inténtalo nuevamente.";
                if($tipo_relacion == 'cliente'){
                    return Redirect::back()->with('errordataform',$mensajeerror);
                }else{
                    return Redirect::to($url)->with('errordataform',$mensajeerror); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron

                }
            }
		}
    }
}