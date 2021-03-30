<?php

namespace App\Repositories;

use Exception;

class TagDocumentoRepository extends RepositoryInterface {
	protected $model = '\App\Models\Admin\TagDocumento';
	protected $mandatoryFields = [
		'tipo',
		'tag',
		'obligatorio'
	];

	public function __construct() {
	}

	public function create(array $data) {
		if(!is_array($data) || count($data) === 0)
			throw new Exception("La información para la creación del tag de documento no se ha recibido en el formato correcto.", 1001);

		if(!$this->hasAllMandatoryFields($data)) {
			$missingFields = $this->getLastMissingFields();
			$message = "Campos incompletos. Faltan los siguientes campos obligatorios para la creación del modelo: [ ";
			$message .= implode(", ", $missingFields);
			$message .= " ]";
			throw new Exception($message, 1002);
		}

		$documentType = $data['tipo'];
		if(!$this->model::isTipoOptionValid($documentType)) {
			$message = "El tipo de documento [$documentType] no es un tipo válido. Los tipos de documento válidos son: [ ";
			$message .= implode(", ", $this->model::$TIPO_OPTIONS);
			$message .= " ]";
			throw new Exception($message, 1003);
		}

		$documentTag = new $this->model($data);
		$documentTag->save();

		return $documentTag;
	}

	public function update($id, array $data) {
		if(!is_array($data) || count($data) === 0)
			throw new Exception("La información para la creación del tag de documento no se ha recibido en el formato correcto.", 1001);

		$documentTag = $this->model::findOrFail($id);

		if(!$this->hasAllMandatoryFields($data, true)) {
			$missingFields = $this->getLastMissingFields();
			$message = "Campos incompletos. Los siguientes campos no pueden ser vacíos para la actualiazción del modelo: [ ";
			$message .= implode(", ", $missingFields);
			$message .= " ]";
			throw new Exception($message, 1002);
		}
		
		$documentType = $data['tipo'];
		if(!$this->model::isTipoOptionValid($documentType)) {
			$message = "El tipo de documento [$documentType] no es un tipo válido. Los tipos de documento válidos son: [ ";
			$message .= implode(", ", $this->model::$TIPO_OPTIONS);
			$message .= " ]";
			throw new Exception($message, 1003);
		}

		$documentTag->update($data);
		$documentTag->save();

		return $documentTag;
	}

	public function delete($id) {
		$documentTag = $this->model::findOrFail($id);
		$documentTag->delete();
		return $documentTag;
	}
}