<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\TipoProyectoRepository;
use App\Repositories\SubUsoOcupacionRepository;
use App\Repositories\DisciplinaRepository;
use App\Repositories\FaseRepository;
use App\Repositories\FaseDisciplinaSubusoRepository;
use Illuminate\Support\Collection;

class FaseDisciplinaSubusoController extends Controller {

	protected $faseDisciplinaSubuso;
	protected $tipoProyecto;
	protected $subUsoOcupacion;
	protected $disciplina;
	protected $fase;
	protected $routes = [
		'index' => 'fases-disciplinas-subusos.index',
		'index-by-use-group' => 'fases-disciplinas-subusos.index-by-use-group',
		'create' => 'fases-disciplinas-subusos.create',
		'store' => 'fases-disciplinas-subusos.store',
		'edit' => 'fases-disciplinas-subusos.edit',
		'update' => 'fases-disciplinas-subusos.update',
		'delete' => 'fases-disciplinas-subusos.delete'
	];

	public function __construct(
		FaseDisciplinaSubusoRepository $faseDisciplinaSubuso,
		TipoProyectoRepository $tipoProyecto,
		SubUsoOcupacionRepository $subUsoOcupacion,
		DisciplinaRepository $disciplina,
		FaseRepository $fase
	) {
		$this->faseDisciplinaSubuso = $faseDisciplinaSubuso;
		$this->tipoProyecto = $tipoProyecto;
		$this->subUsoOcupacion = $subUsoOcupacion;
		$this->disciplina = $disciplina;
		$this->fase = $fase;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($projectTypeId) {
		$projectType = $this->tipoProyecto->findOrFail($projectTypeId*1);
        $phaseDisciplineSubuses = $projectType->fasesDisciplinasSubusos;
        
        $idPhase = $phaseDisciplineSubuses->unique('fase_id');
		// Get all unique phases from the queried search
		$phases = $idPhase->reduce(function ($carry, $phaseDisciplineSubuse) {
            $phase = $carry->get($phaseDisciplineSubuse->fase_id);

			// It's not in the final collection, so add it
            if($phase === null)
				$carry->put($phaseDisciplineSubuse->id, $phaseDisciplineSubuse->fase);

			return $carry;
        }, new Collection());
		$phaseDisciplineSubuses = $phaseDisciplineSubuses->filter(function ($item, $key) {
			return $item->subUsoOcupacion !== null && $item->disciplina !== null; 
		});
        $phaseDisciplineSubuses = $phaseDisciplineSubuses->groupBy('fase_id');


		$vars = [
			'projectType',
			'phaseDisciplineSubuses',
			'phases'
		];

		return view('admin.fases-disciplinas-subusos.index', compact($vars));
	}
}
