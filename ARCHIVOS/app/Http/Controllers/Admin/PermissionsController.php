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
use Route;
use DB;
use Illuminate\Routing\Controller;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    //función por defecto del controlador , actua como el index del controlador
    public function get_index()
    {
        $permisos = Permission::all(); //get entrega todos los resultados,  reemplazarlo por paginate
        return View::make("admin.permissions.index")->with('permisos',$permisos);
    }

    public function get_crear()
    {
        return View::make("admin.permissions.crear");
    }
    
    public function post_crear(Request $request)
    {
        
        //recibe todos los datos enviados en el formulario
        $recibir= $request->all();
        //creacion de reglas para validación en un array

        $reglas = array(
                'name' => 'required|min:4|max:50'
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
            $permiso = new Permission;
            //asignamos los valores
            $permiso->name = $request->input('name');
            //guardamos en la base de datos con el método save
            $permiso->save();
            //ahora creamos una variable de sesion antes de hacer la redirección
            Session::flash("mensaje","Permiso creado exitosamente!");
            //redireccionamos
            return Redirect::to("permisos");
        }
    }

    public function editar($id){
        $permiso = Permission::find($id);
        return View::make("admin.permissions.editar")->with("permiso",$permiso);
    }

    public function actualizar($id, Request $request)
    {
        //recibe todos los datos enviados en el formulario
        $recibir= $request->all();
        //creacion de reglas para validación en un array

        $reglas = array(
                'name' => 'required|min:4|max:50'
        );
        
        $mensajes = array(
                'required'=>'Campo obligatorio'
            );

        //logica de validación
        $validar = Validator::make($recibir,$reglas,$mensajes); //los mensajes son opcionales

        if($validar->fails())
        {
            return Redirect::to('permisos/'.$id.'/editar')->withErrors($validar); //Si hay un error se redirecciona nuevamente al formulario mostrando los mensajes de error que ocurrieron
        }else{
            //creamos el modelo
            $permiso = Permission::find($id);
            //asignamos los valores
            $permiso->name = $request->input('name');
            //guardamos en la base de datos con el método save
            $permiso->save();
            //ahora creamos una variable de sesion antes de hacer la redirección

            Session::flash("mensaje","Permiso actualizado exitosamente!");
            //redireccionamos
            return Redirect::to("permisos");
        }
    }

    public function mostrar($id){
        $permiso = Permission::find($id);
        return View::make("admin.permissions.mostrar")->with("permiso",$permiso);
    }

    public function eliminar($id){
        $permiso = Permission::find($id);
        $permiso->delete();
        Session::flash("mensaje","Permiso eliminado exitosamente!");
        //redireccionamos
        return Redirect::to("permisos");
    }

    public function actualizarPermisos(){
        $routeCollection = Route::getRoutes();
        foreach ($routeCollection as $value) {  
            if($value->getName()!== null)
            {
                $pathname = $value->getName();
                //buscar permiso
                $cantpermname = Permission::where('name', $pathname)->count();
                if($cantpermname == 0 )
                {
                    //creamos el modelo
                    $permiso = new Permission;
                    //asignamos los valores
                    $permiso->name = $pathname;
                    //guardamos en la base de datos con el método save
                    $permiso->save();
                    Session::flash("mensaje","Permiso creado exitosamente!");
                }    
            }  
        }
        //redireccionamos
        return Redirect::to("permisos");
    }
}
