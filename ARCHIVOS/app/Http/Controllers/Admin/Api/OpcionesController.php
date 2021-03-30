<?php 
namespace App\Http\Controllers\Admin\Api;

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
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Admin\Listado;
use App\Models\Admin\OpcionListado;

class OpcionesController extends Controller {

    public function get_opciones(Request $request) {
		$response = new Response();
		$response->header('Content-type', 'application/json');

		$opciones = OpcionListado::all();
        foreach($opciones as $opcion){
            $opcion->nombrelistado = $this->getListado($opcion->idlistado);
        }

		$data = [
			'data' => $opciones
		];
		$response->setContent($data);

		return $response;
    }

    public function get_opcioneslist($idlistado, Request $request) {
		$response = new Response();
		$response->header('Content-type', 'application/json');

		$opciones = OpcionListado::where('idlistado',$idlistado)->get();
        foreach($opciones as $opcion){
            $opcion->nombrelistado = $this->getListado($opcion->idlistado);
        }

		$data = [
			'data' => $opciones
		];
		$response->setContent($data);

		return $response;
    }

    public function getListado($idlistado) {
        $listado = Listado::find($idlistado);
        $listado = $listado->nombre;   

        return $listado;
    }
}