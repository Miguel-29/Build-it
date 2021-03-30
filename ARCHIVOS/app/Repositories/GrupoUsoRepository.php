<?php

namespace App\Repositories;

use Exception;

class GrupoUsoRepository extends RepositoryInterface {
	protected $model = '\App\Models\Admin\GrupoUso';
	protected $mandatoryFields = [
		'nombre'
	];

	public function __construct() {
	}

	public function create(array $data) {
		if(!is_array($data) || count($data) === 0)
			throw new Exception("La información para la creación del grupo de uso no se ha recibido en el formato correcto.", 1001);

		if(!$this->hasAllMandatoryFields($data)) {
			$missingFields = $this->getLastMissingFields();
			$message = "Campos incompletos. Faltan los siguientes campos obligatorios para la creación del modelo: [ ";
			$message .= implode(", ", $missingFields);
			$message .= " ]";
			throw new Exception($message, 1002);
		}

		$useGroup = new $this->model($data);
		$useGroup->save();

		return $useGroup;
	}

	public function update($id, array $data) {
		if(!is_array($data) || count($data) === 0)
			throw new Exception("La información para la creación del grupo de uso no se ha recibido en el formato correcto.", 1001);

		$useGroup = $this->model::findOrFail($id);

		if(!$this->hasAllMandatoryFields($data, true)) {
			$missingFields = $this->getLastMissingFields();
			$message = "Campos incompletos. Los siguientes campos no pueden ser vacíos para la actualiazción del modelo: [ ";
			$message .= implode(", ", $missingFields);
			$message .= " ]";
			throw new Exception($message, 1002);
		}

		$useGroup->update($data);
		$useGroup->save();

		return $useGroup;
	}

	public function delete($id) {
		$useGroup = $this->model::findOrFail($id);
		$useGroup->delete();
		return $useGroup;
	}
}