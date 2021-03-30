<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\GrupoUsoRepository;

class GrupoUsoController extends Controller {

	protected $grupoUso;
	protected $routes = [
		'index' => 'grupos-uso.index',
		'create' => 'grupos-uso.create',
		'store' => 'grupos-uso.store',
		'edit' => 'grupos-uso.edit',
		'update' => 'grupos-uso.update',
		'delete' => 'grupos-uso.delete'
	];

	public function __construct(GrupoUsoRepository $grupoUso) {
		$this->grupoUso = $grupoUso;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
		$useGroups = $this->grupoUso->all();
		
		$vars = [
			'useGroups'
		];

		return view('admin.grupos-uso.index', compact($vars));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.grupos-uso.create');
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
			$useGroup = $this->grupoUso->create($input);

			session()->flash('success', 'Se creó el Grupo de Uso ['. $useGroup->nombre .'] éxitosamente');
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
    public function show($useGroupId) {
		$useGroup = $this->grupoUso->findOrFail($useGroupId);
		
		$vars = [
			'useGroup'
		];

		return view('admin.grupos-uso.show', compact($vars));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($useGroupId) {
		$useGroup = $this->grupoUso->findOrFail($useGroupId);
		
		$vars = [
			'useGroup'
		];

		return view('admin.grupos-uso.edit', compact($vars));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $useGroupId) {
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

		$useGroup = $this->grupoUso->findOrFail($useGroupId);

		try {
			$useGroup = $this->grupoUso->update($useGroup->id, $input);

			session()->flash('success', 'Se actualizó el Grupo de Uso ['. $useGroup->nombre .'] éxitosamente');
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
    public function delete($useGroupId) {
		$useGroup = $this->grupoUso->findOrFail($useGroupId);
		
		$this->grupoUso->delete($useGroup->id);

		session()->flash('success', 'Se eliminó el Grupo de Uso ['. $useGroup->nombre .'] éxitosamente');
		return redirect()->route($this->routes['index']);
    }
}
