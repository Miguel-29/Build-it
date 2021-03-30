<?php

namespace App\Repositories;

use Exception;

class SubUsoOcupacionRepository extends RepositoryInterface {
	protected $model = '\App\Models\Admin\SubUsoOcupacion';
	protected $mandatoryFields = [
		'nombre',
		'grupo_uso_id'
	];
	protected $grupoUso;

	public function __construct(GrupoUsoRepository $useGroup) {
		$this->grupoUso = $useGroup;
	}

	public function create(array $data) {
		if(!is_array($data) || count($data) === 0)
			throw new Exception("La información para la creación del sub uso de ocupación no se ha recibido en el formato correcto.", 1001);

		if(!$this->hasAllMandatoryFields($data)) {
			$missingFields = $this->getLastMissingFields();
			$message = "Campos incompletos. Faltan los siguientes campos obligatorios para la creación del modelo: [ ";
			$message .= implode(", ", $missingFields);
			$message .= " ]";
			throw new Exception($message, 1002);
		}

		// Validate that the assigned model exists
		$useGroup = $this->grupoUso->findOrFail($data['grupo_uso_id']);

		$ocupationSubUse = new $this->model($data);
		$ocupationSubUse->save();

		return $ocupationSubUse;
	}

	public function update($id, array $data) {
		if(!is_array($data) || count($data) === 0)
			throw new Exception("La información para la creación del sub uso de ocupación no se ha recibido en el formato correcto.", 1001);

		$ocupationSubUse = $this->model::findOrFail($id);

		if(!$this->hasAllMandatoryFields($data, true)) {
			$missingFields = $this->getLastMissingFields();
			$message = "Campos incompletos. Los siguientes campos no pueden ser vacíos para la actualiazción del modelo: [ ";
			$message .= implode(", ", $missingFields);
			$message .= " ]";
			throw new Exception($message, 1002);
		}


		// Validate that the assigned model exists
		$useGroup = $this->grupoUso->findOrFail($data['grupo_uso_id']);

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