<?php

namespace App\Repositories;

use Exception;

class AreaProfesionRepository extends RepositoryInterface {
	protected $model = '\App\Models\Admin\AreaProfesion';
	protected $mandatoryFields = [
		'nombre',
		'profesion_id'
	];
	protected $profesion;

	public function __construct(ProfesionRepository $profession) {
		$this->profesion = $profession;
	}

	public function create(array $data) {
		if(!is_array($data) || count($data) === 0)
			throw new Exception("La información para la creación del área de profesión no se ha recibido en el formato correcto.", 1001);

		if(!$this->hasAllMandatoryFields($data)) {
			$missingFields = $this->getLastMissingFields();
			$message = "Campos incompletos. Faltan los siguientes campos obligatorios para la creación del modelo: [ ";
			$message .= implode(", ", $missingFields);
			$message .= " ]";
			throw new Exception($message, 1002);
		}

		// Validate that the assigned model exists
		$profession = $this->profesion->findOrFail($data['profesion_id']);

		$ocupationSubUse = new $this->model($data);
		$ocupationSubUse->save();

		return $ocupationSubUse;
	}

	public function update($id, array $data) {
		if(!is_array($data) || count($data) === 0)
			throw new Exception("La información para la creación del área de profesión no se ha recibido en el formato correcto.", 1001);

		$ocupationSubUse = $this->model::findOrFail($id);

		if(!$this->hasAllMandatoryFields($data, true)) {
			$missingFields = $this->getLastMissingFields();
			$message = "Campos incompletos. Los siguientes campos no pueden ser vacíos para la actualiazción del modelo: [ ";
			$message .= implode(", ", $missingFields);
			$message .= " ]";
			throw new Exception($message, 1002);
		}


		// Validate that the assigned model exists
		$profession = $this->profesion->findOrFail($data['profesion_id']);

		$ocupationSubUse->update($data);
		$ocupationSubUse->save();

		return $ocupationSubUse;
	}

	public function delete($id) {
		$ocupationSubUse = $this->model::findOrFail($id);
		$ocupationSubUse->delete();
		return $ocupationSubUse;
	}
}