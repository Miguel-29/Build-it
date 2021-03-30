<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\GrupoUsoRepository;
use App\Repositories\SubUsoOcupacionRepository;

class SubUsoOcupacionController extends Controller {

	protected $subUsoOcupacion;
	protected $grupoUso;
	protected $routes = [
		'index' => 'sub-uso-ocupaciones.index',
		'index-by-use-group' => 'sub-uso-ocupaciones.index-by-use-group',
		'create' => 'sub-uso-ocupaciones.create',
		'store' => 'sub-uso-ocupaciones.store',
		'edit' => 'sub-uso-ocupaciones.edit',
		'update' => 'sub-uso-ocupaciones.update',
		'delete' => 'sub-uso-ocupaciones.delete'
	];

	public function __construct(
		SubUsoOcupacionRepository $subUsoOcupacion,
		GrupoUsoRepository $grupoUso
	) {
		$this->subUsoOcupacion = $subUsoOcupacion;
		$this->grupoUso = $grupoUso;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
		$ocupationSubUses = $this->subUsoOcupacion->all();
		
		$vars = [
			'ocupationSubUses'
		];

		return view('admin.sub-uso-ocupaciones.index', compact($vars));
	}
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByUseGroup($useGroupId) {
		$useGroup = $this->grupoUso->findOrFail($useGroupId);

		$ocupationSubUses = $useGroup->subUsoOcupaciones;
		
		$vars = [
			'ocupationSubUses',
			'useGroup'
		];

		return view('admin.sub-uso-ocupaciones.index-by-use-group', compact($vars));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
		$useGroups = $this->grupoUso->all();

		$vars = [
			'useGroups'
		];

        return view('admin.sub-uso-ocupaciones.create', compact($vars));
	}
	
	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createByUseGroup($useGroupId) {
		$useGroup = $this->grupoUso->findOrFail($useGroupId);
		$useGroups = $this->grupoUso->all();

		$vars = [
			'useGroups',
			'useGroup'
		];

        return view('admin.sub-uso-ocupaciones.create-by-use-group', compact($vars));
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
			'grupo_uso_id' => 'required|int'
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
			$ocupationSubUse = $this->subUsoOcupacion->create($input);

			session()->flash('success', 'Se creó el Sub Uso de Ocupación ['. $ocupationSubUse->nombre .'] éxitosamente');
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
    public function show($ocupationSubUseId) {
		$ocupationSubUse = $this->subUsoOcupacion->findOrFail($ocupationSubUseId);
		$useGroup = $ocupationSubUse->grupoUso;
		
		$vars = [
			'ocupationSubUse',
			'useGroup'
		];

		return view('admin.sub-uso-ocupaciones.show', compact($vars));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($ocupationSubUseId) {
		$useGroups = $this->grupoUso->all();
		$ocupationSubUse = $this->subUsoOcupacion->findOrFail($ocupationSubUseId);
		
		$vars = [
			'ocupationSubUse',
			'useGroups'
		];

		return view('admin.sub-uso-ocupaciones.edit', compact($vars));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ocupationSubUseId) {
        $input = $request->all();
        $rules = [
			'nombre' => 'required',
			'grupo_uso_id' => 'required|int'
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

		$ocupationSubUse = $this->subUsoOcupacion->findOrFail($ocupationSubUseId);

		try {
			$ocupationSubUse = $this->subUsoOcupacion->update($ocupationSubUse->id, $input);

			session()->flash('success', 'Se actualizó el Sub Uso de Ocupación ['. $ocupationSubUse->nombre .'] éxitosamente');
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
    public function delete($ocupationSubUseId) {
		$ocupatinSubUse = $this->subUsoOcupacion->findOrFail($ocupationSubUseId);
		
		$this->subUsoOcupacion->delete($ocupatinSubUse->id);

		session()->flash('success', 'Se eliminó el Sub Uso de Ocupación ['. $ocupatinSubUse->nombre .'] éxitosamente');
		return redirect()->route($this->routes['index']);
    }
}
