<?php

namespace App\Http\Controllers\Admin\Api;

use App\Models\Admin\FaseDisciplinaSubuso;
use Exception;
use Validator;
use Illuminate\Http\Request;
use App\Repositories\TipoProyectoRepository;
use App\Repositories\SubUsoOcupacionRepository;
use App\Repositories\DisciplinaRepository;
use App\Repositories\FaseRepository;
use App\Repositories\FaseDisciplinaSubusoRepository;

class FaseDisciplinaSubusoController extends ApiController {

	protected $faseDisciplinaSubuso;
	protected $tipoProyecto;
	protected $subUsoOcupacion;
	protected $disciplina;
	protected $fase;

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

    public function addPhase(Request $request, $projectTypeId) {
		// Start of basic validation
		$projectType = $this->tipoProyecto->find($projectTypeId);
		if($projectType === null) 
			return $this->error('E001', "No projectType model found for id [$projectTypeId]", 404);

		$phaseId = $request->get('fase_id');
		if($phaseId === null)
			return $this->error('E002', "Param fase_id is required", 400);

		$phase = $this->fase->find($phaseId);
		if($phase === null) 
			return $this->error('E003', "No phase model found for id [$phaseId]", 404);

		// End of validation. Starts the create action

		try {
			$phaseDisciplineSubuse = $this->faseDisciplinaSubuso->addToProjectType($projectType->id, [
				'fase_id' => $phase->idfase,
				'es_obligatorio' => false
			]);

			$result = [
				'id' => $phaseDisciplineSubuse->id,
				'fase' => $phase, 
				'tipoProyecto' => $projectType,
				'disciplina' => $phaseDisciplineSubuse->disciplina,
				'subUsoOcupacion' => $phaseDisciplineSubuse->subUsoOcupacion,
				'es_obligatorio' => $phaseDisciplineSubuse->es_obligatorio
			];

			return $this->response($result, 201);
		} catch(Exception $e) {
			return $this->error($e->getCode(), $e->getMessage(), 500); 
		}
	}

	public function update(Request $request, $phaseDisciplineSubuseId) {
		// Start of basic validation
		$phaseDisciplineSubuse = $this->faseDisciplinaSubuso->find($phaseDisciplineSubuseId);
		if($phaseDisciplineSubuse === null)
			return $this->error('E0001', "No phaseDisciplineSubuse model found with id [$phaseDisciplineSubuseId]", 404);

		$inputs = $request->all();

		if(array_key_exists('tipo_proyecto_id', $inputs))
			unset($inputs['tipo_proyecto_id']);

		if(array_key_exists('fase_id', $inputs))
			unset($inputs['fase_id']);

		if(count($inputs) === 0)
			return $this->response($phaseDisciplineSubuse);

		// End of validation. Starts the create action

		try {
			$phaseDisciplineSubuse = $this->faseDisciplinaSubuso->update($phaseDisciplineSubuse->id, $inputs);

			$result = [
				'id' => $phaseDisciplineSubuse->id,
				'fase' => $phaseDisciplineSubuse->fase, 
				'tipoProyecto' => $phaseDisciplineSubuse->tipoProyecto,
				'disciplina' => $phaseDisciplineSubuse->disciplina,
				'subUsoOcupacion' => $phaseDisciplineSubuse->subUsoOcupacion,
				'es_obligatorio' => $phaseDisciplineSubuse->es_obligatorio
			];

			return $this->response($result);
		} catch(Exception $e) {
			return $this->error($e->getCode(), $e->getMessage(), 500); 
		}
	}

	public function createOrUpdate(Request $request) {
		// Start of basic validation
		$projectTypeId = $request->get('tipo_proyecto_id');
		if($projectTypeId === null)
			return $this->error('E001', "Param tipo_proyecto_id is required", 400);

		$projectType = $this->tipoProyecto->find($projectTypeId);
		if($projectType === null) 
			return $this->error('E002', "No projectType model found for id [$projectTypeId]", 404);

		$phaseId = $request->get('fase_id');
		if($phaseId === null)
			return $this->error('E003', "Param fase_id is required", 400);

		$phase = $this->fase->find($phaseId);
		if($phase === null) 
			return $this->error('E004', "No phase model found for id [$phaseId]", 404);

		$disciplineId = $request->get('disciplina_id');
		if($disciplineId === null)
			return $this->error('E005', "Param disciplina_id is required", 400);

		$discipline = $this->disciplina->find($disciplineId);
		if($discipline === null) 
			return $this->error('E006', "No discipline model found for id [$disciplineId]", 404);

		$subUseOcupationId = $request->get('sub_uso_ocupacion_id');
		if($subUseOcupationId === null)
			return $this->error('E005', "Param sub_uso_ocupacion_id is required", 400);

		$subUseOcupation = $this->subUsoOcupacion->find($subUseOcupationId);
		if($subUseOcupation === null) 
			return $this->error('E006', "No subUseOcupation model found for id [$subUseOcupationId]", 404);

		// End of validation. Starts the create action

		try {
			$inputs = $request->all();
			$phaseDisciplineSubuse = $this->faseDisciplinaSubuso->addToProjectType($projectType->id, $inputs);

			$result = [
				'id' => $phaseDisciplineSubuse->id,
				'fase' => $phase, 
				'tipoProyecto' => $projectType,
				'disciplina' => $discipline,
				'subUsoOcupacion' => $subUseOcupation,
				'es_obligatorio' => $phaseDisciplineSubuse->es_obligatorio
			];

			return $this->response($result, 201);
		} catch(Exception $e) {
			return $this->error($e->getCode(), $e->getMessage(), 500); 
		}
	}

	public function delete($phaseDisciplineSubuseId) {
		// Start of basic validation
        $success = false;
		$phaseDisciplineSubuse = $this->faseDisciplinaSubuso->find($phaseDisciplineSubuseId);
		if($phaseDisciplineSubuse === null)
			return $this->error('E0001', "No phaseDisciplineSubuse model found with id [$phaseDisciplineSubuseId]", 404);

		// End of validation. Starts the create action

		try {
			$phaseDisciplineSubuse = $this->faseDisciplinaSubuso->delete($phaseDisciplineSubuse->id);
            if($phaseDisciplineSubuse){
                $success = true;
            }
		} catch(Exception $e) {
			return $this->error($e->getCode(), $e->getMessage(), 500); 
		}
        if($success){
            return 'Eliminado';
        }else{
            return 'No eliminado';
        }
	}

    public function deleteFase($tipoP, $fase) {
		// Start of basic validation
        $success = false;

		// End of validation. Starts the create action

		try {
			$phaseDisciplineSubuse = $this->faseDisciplinaSubuso->deleteFase($tipoP, $fase);
            if($phaseDisciplineSubuse){
                $success = true;
            }
		} catch(Exception $e) {
			return $this->error($e->getCode(), $e->getMessage(), 500); 
		}
        if($success){
            return 'Eliminado';
        }else{
            return 'No eliminado';
        }
	}
}
