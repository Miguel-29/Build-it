<?php

namespace App\Repositories;

use Storage;
use Exception;

class TipoProyectoRepository extends RepositoryInterface {
	protected $model = '\App\Models\Admin\TipoProyecto';
	protected $mandatoryFields = [
		'nombre'
	];

	public function __construct() {
	}

	public function create(array $data) {
		if(!is_array($data) || count($data) === 0)
			throw new Exception("La información para la creación del tipo de proyecto no se ha recibido en el formato correcto.", 1001);

		if(!$this->hasAllMandatoryFields($data)) {
			$missingFields = $this->getLastMissingFields();
			$message = "Campos incompletos. Faltan los siguientes campos obligatorios para la creación del modelo: [ ";
			$message .= implode(", ", $missingFields);
			$message .= " ]";
			throw new Exception($message, 1002);
		}

		$projectType = new $this->model($data);
		$projectType->save();

		if(array_key_exists('imagen', $data))
			$this->updateModelImage($projectType, $data['imagen']);

		return $projectType;
	}

	public function update($id, array $data) {
		if(!is_array($data) || count($data) === 0)
			throw new Exception("La información para la creación del tipo de proyecto no se ha recibido en el formato correcto.", 1001);

		$projectType = $this->model::findOrFail($id);

		if(!$this->hasAllMandatoryFields($data, true)) {
			$missingFields = $this->getLastMissingFields();
			$message = "Campos incompletos. Los siguientes campos no pueden ser vacíos para la actualiazción del modelo: [ ";
			$message .= implode(", ", $missingFields);
			$message .= " ]";
			throw new Exception($message, 1002);
		}

		$projectType->update($data);
		$projectType->save();

		if(array_key_exists('imagen', $data))
			$this->updateModelImage($projectType, $data['imagen']);

		return $projectType;
	}

	public function delete($id) {
		$projectType = $this->model::findOrFail($id);
		$projectType->delete();
		return $projectType;
	}

	private function updateModelImage($model, $image) {
		if($model->imagen !== null) 
			Storage::delete($model->imagen);

		$baseDir = 'public/tipo-proyecto/imagenes/' . $model->id;
		$newPath = Storage::putFile($baseDir, $image);

		$offset = strlen('public/');
		$newPath = substr($newPath, $offset);
		$model->imagen = $newPath;
		$model->save();
	}
}