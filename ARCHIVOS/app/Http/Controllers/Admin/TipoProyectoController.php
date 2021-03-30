<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TipoProyectoRepository;

class TipoProyectoController extends Controller {

	protected $tipoProyecto;
	protected $routes = [
		'index' => 'tipo-proyectos.index',
		'create' => 'tipo-proyectos.create',
		'store' => 'tipo-proyectos.store',
		'edit' => 'tipo-proyectos.edit',
		'update' => 'tipo-proyectos.update',
		'delete' => 'tipo-proyectos.delete'
	];

	public function __construct(TipoProyectoRepository $tipoProyecto) {
		$this->tipoProyecto = $tipoProyecto;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
		$projectTypes = $this->tipoProyecto->all();
		
		$vars = [
			'projectTypes'
		];

		return view('admin.tipo-proyectos.index', compact($vars));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.tipo-proyectos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
		$input = $request->all();
        $rules = [
			'nombre' => 'required'
		];

		if(array_key_exists("imagen", $input) && $input['imagen'] !== null)
			$rules['imagen'] = 'mimes:jpg,jpeg,png|max:4096';

		$messages = [
			'required' => 'El campo es obligatorio',
			'mimes' => 'Por favor cargue una imagen válida (jpg, jpeg o png).',
			'max' => 'El archivo de imagen no debe superar los 4MB'
		];

		$validator = Validator::make($input, $rules, $messages);

		if($validator->fails()) {
			session()->flash('error', 'Hay problemas con la información cargada');
			return back()->withErrors($validator)->withInput($input);
		}

		try {
			$projectType = $this->tipoProyecto->create($input);

			session()->flash('success', 'Se creó el Tipo de Proyecto ['. $projectType->nombre .'] éxitosamente');
			return redirect()->route($this->routes['index']);
		} catch(Exception $e) {
			session()->flash('error', 'Ocurrió un problema al guardar la información [ERRNO: '. $e->getCode() .' ]');
			return back()->withInput($input);
		}
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($projectTypeId) {
		$projectType = $this->tipoProyecto->findOrFail($projectTypeId);
		
		$vars = [
			'projectType'
		];

		return view('admin.tipo-proyectos.show', compact($vars));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($projectTypeId) {
		$projectType = $this->tipoProyecto->findOrFail($projectTypeId);
		
		$vars = [
			'projectType'
		];

		return view('admin.tipo-proyectos.edit', compact($vars));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $projectTypeId) {
        $input = $request->all();
        $rules = [
			'nombre' => 'required'
		];

		if(array_key_exists("imagen", $input) && $input['imagen'] !== null)
			$rules['imagen'] = 'mimes:jpg,jpeg,png|max:4096';

		$messages = [
			'required' => 'El campo es obligatorio',
			'mimes' => 'Por favor cargue una imagen válida (jpg, jpeg o png).',
			'max' => 'El archivo de imagen no debe superar los 4MB'
		];

		$validator = Validator::make($input, $rules, $messages);

		if($validator->fails()) {
			session()->flash('error', 'Hay problemas con la información cargada');
			return back()->withErrors($validator)->withInput($input);
		}

		$projectType = $this->tipoProyecto->findOrFail($projectTypeId);

		try {
			$projectType = $this->tipoProyecto->update($projectType->id, $input);

			session()->flash('success', 'Se actualizó el Tipo de Proyecto ['. $projectType->nombre .'] éxitosamente');
			return redirect()->route($this->routes['index']);
		} catch(Exception $e) {
			session()->flash('error', 'Ocurrió un problema al guardar la información [ERRNO: '. $e->getCode() .' ]');
			return back()->withInput($input);
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($projectTypeId) {
		$projectType = $this->tipoProyecto->findOrFail($projectTypeId);
		
		$this->tipoProyecto->delete($projectType->id);

		session()->flash('success', 'Se eliminó el Tipo de Proyecto ['. $projectType->nombre .'] éxitosamente');
		return redirect()->route($this->routes['index']);
    }
}
