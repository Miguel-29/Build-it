<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProfesionRepository;
use App\Repositories\AreaProfesionRepository;

class AreaProfesionController extends Controller {

	protected $areaProfesion;
	protected $profesion;
	protected $routes = [
		'index' => 'areas-profesiones.index',
		'index-by-profession' => 'areas-profesiones.index-by-profession',
		'create' => 'areas-profesiones.create',
		'store' => 'areas-profesiones.store',
		'edit' => 'areas-profesiones.edit',
		'update' => 'areas-profesiones.update',
		'delete' => 'areas-profesiones.delete'
	];

	public function __construct(
		AreaProfesionRepository $areaProfesion,
		ProfesionRepository $profesion
	) {
		$this->areaProfesion = $areaProfesion;
		$this->profesion = $profesion;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
		$professionAreas = $this->areaProfesion->all();
		
		$vars = [
			'professionAreas'
		];

		return view('admin.areas-profesiones.index', compact($vars));
	}
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByUseGroup($professionId) {
		$profession = $this->profesion->findOrFail($professionId);

		$professionAreas = $profession->areaProfesiones;
		
		$vars = [
			'professionAreas',
			'profession'
		];

		return view('admin.areas-profesiones.index-by-profession', compact($vars));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
		$professions = $this->profesion->all();

		$vars = [
			'professions'
		];

        return view('admin.areas-profesiones.create', compact($vars));
	}
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createByUseGroup($professionId) {
		$profession = $this->profesion->findOrFail($professionId);
		$professions = $this->profesion->all();

		$vars = [
			'professions',
			'profession'
		];

        return view('admin.areas-profesiones.create-by-profession', compact($vars));
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
			'nombre' => 'required',
			'profesion_id' => 'required|int'
		];

		$messages = [
			'required' => 'El campo es obligatorio',
			'int' => 'El campo está en un formato inválido'
		];

		$validator = Validator::make($input, $rules, $messages);

		if($validator->fails()) {
			session()->flash('error', 'Hay problemas con la información cargada');
			return back()->withErrors($validator)->withInput($input);
		}

		try {
			$professionArea = $this->areaProfesion->create($input);

			session()->flash('success', 'Se creó el Área de Profesión ['. $professionArea->nombre .'] éxitosamente');
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
    public function show($professionAreaId) {
		$professionArea = $this->areaProfesion->findOrFail($professionAreaId);
		$profession = $professionArea->profesion;
		
		$vars = [
			'professionArea',
			'profession'
		];

		return view('admin.areas-profesiones.show', compact($vars));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($professionAreaId) {
		$professions = $this->profesion->all();
		$professionArea = $this->areaProfesion->findOrFail($professionAreaId);
		
		$vars = [
			'professionArea',
			'professions'
		];

		return view('admin.areas-profesiones.edit', compact($vars));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $professionAreaId) {
        $input = $request->all();
        $rules = [
			'nombre' => 'required',
			'profesion_id' => 'required|int'
		];

		$messages = [
			'required' => 'El campo es obligatorio',
			'int' => 'El campo está en un formato inválido'
		];

		$validator = Validator::make($input, $rules, $messages);

		if($validator->fails()) {
			session()->flash('error', 'Hay problemas con la información cargada');
			return back()->withErrors($validator)->withInput($input);
		}

		$professionArea = $this->areaProfesion->findOrFail($professionAreaId);

		try {
			$professionArea = $this->areaProfesion->update($professionArea->id, $input);

			session()->flash('success', 'Se actualizó el Área de Profesión ['. $professionArea->nombre .'] éxitosamente');
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
    public function delete($professionAreaId) {
		$ocupatinSubUse = $this->areaProfesion->findOrFail($professionAreaId);
		
		$this->areaProfesion->delete($ocupatinSubUse->id);

		session()->flash('success', 'Se eliminó el Área de Profesión ['. $ocupatinSubUse->nombre .'] éxitosamente');
		return redirect()->route($this->routes['index']);
    }
}
