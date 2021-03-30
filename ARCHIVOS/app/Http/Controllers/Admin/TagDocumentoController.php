<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\GrupoUsoRepository;
use App\Repositories\TagDocumentoRepository;

class TagDocumentoController extends Controller {

	protected $tagDocumento;
	protected $grupoUso;
	protected $routes = [
		'index' => 'tag-documentos.index',
		'index-by-use-group' => 'tag-documentos.index-by-use-group',
		'create' => 'tag-documentos.create',
		'store' => 'tag-documentos.store',
		'edit' => 'tag-documentos.edit',
		'update' => 'tag-documentos.update',
		'delete' => 'tag-documentos.delete'
	];

	public function __construct(TagDocumentoRepository $tagDocumento) {
		$this->tagDocumento = $tagDocumento;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
		$documentTags = $this->tagDocumento->all();
		
		$vars = [
			'documentTags'
		];

		return view('admin.tag-documentos.index', compact($vars));
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
		$documentTypes = $this->tagDocumento->getModel()::$TIPO_OPTIONS;

		$vars = [
			'documentTypes'
		];

        return view('admin.tag-documentos.create', compact($vars));
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
			'tipo' => 'required',
			'tag' => 'required'
		];

		$messages = [
			'required' => 'El campo es obligatorio'
		];

		$validator = Validator::make($input, $rules, $messages);

		if($validator->fails()) {
			session()->flash('error', 'Hay problemas con la información cargada');
			return back()->withErrors($validator)->withInput($input);
		}

		$input['obligatorio'] = array_key_exists('obligatorio', $input) && $input['obligatorio'] === '1';

		try {
			$documentTag = $this->tagDocumento->create($input);

			session()->flash('success', 'Se creó el Tag de Documento ['. $documentTag->tag .'] éxitosamente');
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
    public function show($documentTagId) {
		$documentTag = $this->tagDocumento->findOrFail($documentTagId);
		$useGroup = $documentTag->grupoUso;
		
		$vars = [
			'documentTag',
			'useGroup'
		];

		return view('admin.tag-documentos.show', compact($vars));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($documentTagId) {
		$documentTypes = $this->tagDocumento->getModel()::$TIPO_OPTIONS;
		$documentTag = $this->tagDocumento->findOrFail($documentTagId);
		
		$vars = [
			'documentTag',
			'documentTypes'
		];

		return view('admin.tag-documentos.edit', compact($vars));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $documentTagId) {
        $input = $request->all();
        $rules = [
			'tipo' => 'required',
			'tag' => 'required'
		];

		$messages = [
			'required' => 'El campo es obligatorio'
		];

		$validator = Validator::make($input, $rules, $messages);

		if($validator->fails()) {
			session()->flash('error', 'Hay problemas con la información cargada');
			return back()->withErrors($validator)->withInput($input);
		}

		$documentTag = $this->tagDocumento->findOrFail($documentTagId);

		$input['obligatorio'] = array_key_exists('obligatorio', $input) && $input['obligatorio'] === '1';

		try {
			$documentTag = $this->tagDocumento->update($documentTag->id, $input);

			session()->flash('success', 'Se actualizó el Tag de Documento ['. $documentTag->tag .'] éxitosamente');
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
    public function delete($documentTagId) {
		$useGroup = $this->tagDocumento->findOrFail($documentTagId);
		
		$this->tagDocumento->delete($useGroup->id);

		session()->flash('success', 'Se eliminó el Tag de Documento ['. $useGroup->tag .'] éxitosamente');
		return redirect()->route($this->routes['index']);
    }
}
