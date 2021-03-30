<?php

namespace App\Repositories;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Form;
use View;
use Validator;
//use Input;
use Redirect;
use Session;
use DateTime;
use Illuminate\Routing\Controller;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Exception;

class FaseDisciplinaSubusoRepository extends RepositoryInterface {
	protected $model = '\App\Models\Admin\FaseDisciplinaSubuso';
	protected $mandatoryFields = [
		'tipo_proyecto_id',
		'fase_id',
		'es_obligatorio'
	];
	protected $tipoProyecto;
	protected $subUsoOcupacion;
	protected $disciplina;
	protected $fase;

	public function __construct(
		TipoProyectoRepository $projectType,
		SubUsoOcupacionRepository $ocupationSubUse,
		DisciplinaRepository $discipline,
		FaseRepository $phase
	) {
		$this->tipoProyecto = $projectType;
		$this->subUsoOcupacion = $ocupationSubUse;
		$this->disciplina = $discipline;
		$this->fase = $phase;
	}

	public function create(array $data) {
		if(!is_array($data) || count($data) === 0)
			throw new Exception("La información para la creación de la fase_disciplina_subuso no se ha recibido en el formato correcto.", 1001);

		if(!$this->hasAllMandatoryFields($data)) {
			$missingFields = $this->getLastMissingFields();
			$message = "Campos incompletos. Faltan los siguientes campos obligatorios para la creación del modelo: [ ";
			$message .= implode(", ", $missingFields);
			$message .= " ]";
			throw new Exception($message, 1002);
		}

		// Validate that the assigned model exists
		$projectType = $this->tipoProyecto->findOrFail($data['tipo_proyecto_id']);
		$phase = $this->fase->findOrFail($data['fase_id']);

		if(array_key_exists('sub_uso_ocupacion_id', $data))
			$ocupationSubUse = $this->subUsoOcupacion->findOrFail($data['sub_uso_ocupacion_id']);
			
		if(array_key_exists('disciplina_id', $data))
			$discipline = $this->disciplina->findOrFail($data['disciplina_id']);

		$data['es_obligatorio'] = $data['es_obligatorio'] == true;

		$phaseDisciplineSubuse = new $this->model($data);
		$phaseDisciplineSubuse->save();

		return $phaseDisciplineSubuse;
	}

	public function update($id, array $data) {
		if(!is_array($data) || count($data) === 0)
			throw new Exception("La información para la creación de la fase_disciplina_subuso no se ha recibido en el formato correcto.", 1001);

		$phaseDisciplineSubuse = $this->model::findOrFail($id);

		if(!$this->hasAllMandatoryFields($data, true)) {
			$missingFields = $this->getLastMissingFields();
			$message = "Campos incompletos. Los siguientes campos no pueden ser vacíos para la actualiazción del modelo: [ ";
			$message .= implode(", ", $missingFields);
			$message .= " ]";
			throw new Exception($message, 1002);
		}

		// Validate that the assigned model exists
		$projectType = $this->tipoProyecto->findOrFail($data['tipo_proyecto_id']);
		$ocupationSubUse = $this->subUsoOcupacion->findOrFail($data['sub_uso_ocupacion_id']);
		$discipline = $this->disciplina->findOrFail($data['disciplina_id']);
		$phase = $this->fase->findOrFail($data['fase_id']);

		$data['es_obligatorio'] = $data['es_obligatorio'] == true;

		$phaseDisciplineSubuse->update($data);
		$phaseDisciplineSubuse->save();

		return true;
	}

	public function delete($id) {
        $success = false;
		$delete = DB::delete('delete from fase_disciplina_subuso where id = ?',[$id*1]);
        $success = true;
		return $success;
	}

    public function deleteFase($tipoP, $fase) {
        $success = false;
		$delete = DB::delete('delete from fase_disciplina_subuso where tipo_proyecto_id  = '.$tipoP *1 .' and  fase_id = '.$fase*1 );
        $success = true;
		return $success;
	}


	// --------- EXTRA CRUD METHODS ---------
	public function addToProjectType($projectTypeId, array $data) {
		$projectType = $this->tipoProyecto->findOrFail($projectTypeId);
		$filters = [
			'tipo_proyecto_id',
			'fase_id',
			'sub_uso_ocupacion_id',
			'disciplina_id'
		];

		$where = [];

		$data['tipo_proyecto_id'] = $projectType->id;

		foreach($filters as $filter) {
			if(array_key_exists($filter, $data))
				$where[] = [
					$filter,
					$data[$filter]
				];
		}

		$phaseDisciplineSubuse = $this->model::where($where)->first();

		if($phaseDisciplineSubuse === null) 
			$phaseDisciplineSubuse = $this->create($data);
		else
			$phaseDisciplineSubuse = $this->update($phaseDisciplineSubuse->id, $data);
		

		return $phaseDisciplineSubuse;
	}

	public function findFor($_filters) {
		$filters = [
			'tipo_proyecto_id',
			'fase_id',
			'sub_uso_ocupacion_id',
			'disciplina_id'
		];

		$where = [];

		foreach($filters as $filter) {
			if(array_key_exists($filter, $_filters))
				$where[] = [
					$filter,
					$_filters[$filter]
				];
		}

		return $this->model::where($where)->first();		
	}

}