<?php

namespace App\Repositories;

use Exception;

class ProfesionRepository extends RepositoryInterface {
	protected $model = '\App\Models\Admin\Profesion';
	protected $mandatoryFields = [
		'nombre'
	];

	public function __construct() {
	}

	public function create(array $data) {
		if(!is_array($data) || count($data) === 0)
			throw new Exception("La información para la creación del profesión no se ha recibido en el formato correcto.", 1001);

		if(!$this->hasAllMandatoryFields($data)) {
			$missingFields = $this->getLastMissingFields();
			$message = "Campos incompletos. Faltan los siguientes campos obligatorios para la creación del modelo: [ ";
			$message .= implode(", ", $missingFields);
			$message .= " ]";
			throw new Exception($message, 1002);
		}
		
		$profession = new $this->model($data);
		$profession->save();

		return $profession;
	}

	public function update($id, array $data) {
		if(!is_array($data) || count($data) === 0)
			throw new Exception("La información para la creación del profesión no se ha recibido en el formato correcto.", 1001);

		$profession = $this->model::findOrFail($id);

		if(!$this->hasAllMandatoryFields($data, true)) {
			$missingFields = $this->getLastMissingFields();
			$message = "Campos incompletos. Los siguientes campos no pueden ser vacíos para la actualiazción del modelo: [ ";
			$message .= implode(", ", $missingFields);
			$message .= " ]";
			throw new Exception($message, 1002);
		}

		$profession->update($data);
		$profession->save();

		return $profession;
	}

	public function delete($id) {
		$profession = $this->model::findOrFail($id);
		$profession->delete();
		return $profession;
	}
}