<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProfesionRepository;

class ProfesionController extends Controller {

	protected $profesion;
	protected $routes = [
		'index' => 'profesiones.index',
		'create' => 'profesiones.create',
		'store' => 'profesiones.store',
		'edit' => 'profesiones.edit',
		'update' => 'profesiones.update',
		'delete' => 'profesiones.delete'
	];

	public function __construct(ProfesionRepository $profesion) {
		$this->profesion = $profesion;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
		$professions = $this->profesion->all();
		
		$vars = [
			'professions'
		];

		return view('admin.profesiones.index', compact($vars));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.profesiones.create');
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

		$messages = [
			'required' => 'El campo es obligatorio'
		];

		$validator = Validator::make($input, $rules, $messages);

		if($validator->fails()) {
			session()->flash('error', 'Hay problemas con la información cargada');
			return back()->withErrors($validator)->withInput($input);
		}

		try {
			$profession = $this->profesion->create($input);

			session()->flash('success', 'Se creó la Profesión ['. $profession->nombre .'] éxitosamente');
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
    public function show($professionId) {
		$profession = $this->profesion->findOrFail($professionId);
		
		$vars = [
			'profession'
		];

		return view('admin.profesiones.show', compact($vars));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($professionId) {
		$profession = $this->profesion->findOrFail($professionId);
		
		$vars = [
			'profession'
		];

		return view('admin.profesiones.edit', compact($vars));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $professionId) {
        $input = $request->all();
        $rules = [
			'nombre' => 'required'
		];

		$messages = [
			'required' => 'El campo es obligatorio'
		];

		$validator = Validator::make($input, $rules, $messages);

		if($validator->fails()) {
			session()->flash('error', 'Hay problemas con la información cargada');
			return back()->withErrors($validator)->withInput($input);
		}

		$profession = $this->profesion->findOrFail($professionId);

		$input['estado'] = array_key_exists('estado', $input) && $input['estado'] === '1';

		try {
			$profession = $this->profesion->update($profession->id, $input);

			session()->flash('success', 'Se actualizó la Profesión ['. $profession->nombre .'] éxitosamente');
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
    public function delete($professionId) {
		$profession = $this->profesion->findOrFail($professionId);
		
		$this->profesion->delete($profession->id);

		session()->flash('success', 'Se eliminó la Profesión ['. $profession->nombre .'] éxitosamente');
		return redirect()->route($this->routes['index']);
    }
}
