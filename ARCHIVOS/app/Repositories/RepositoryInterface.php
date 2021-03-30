<?php

namespace App\Repositories;

abstract class RepositoryInterface {
	protected $model;
	protected $mandatoryFields;
	protected $lastMissingFields;

	abstract public function create(array $data);
	abstract public function update($id, array $data);
	abstract public function delete($id);

	public function all() {
		return $this->model::all();
	}

	public function find($id) {
		return $this->model::find($id);
	}

	public function findOrFail($id) {
		return $this->model::findOrFail($id);
	}

	public function findByField($field, $value) {
		return $this->model::where($field, $value)->first();
	}

	public function getModel() {
		return $this->model;
	}

	protected function hasAllMandatoryFields(array $data = [], $isForUpdate = false) {
		$this->lastMissingFields = [];
		foreach($this->mandatoryFields as $field) {
			if($isForUpdate && !array_key_exists($field, $data))
				continue;
				
			if(!array_key_exists($field, $data))
				$this->lastMissingFields[] = $field;
			else {
				$value = $data[$field];
				if(is_null($value) || $value === '')
					$this->lastMissingFields[] = $field;
			}
		}

		return count($this->lastMissingFields) === 0;
	}

	protected function getLastMissingFields() {
		return $this->lastMissingFields;
	}
}