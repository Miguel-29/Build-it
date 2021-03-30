<?php

namespace App\Repositories;

use Exception;

class FaseRepository extends RepositoryInterface {
	protected $model = '\App\Models\Admin\Fase';
	protected $mandatoryFields = [
	];

	public function __construct() {
	}

	public function create(array $data) {
		throw new Exception('Method not implemented');
	}

	public function update($id, array $data) {
		throw new Exception('Method not implemented');
	}

	public function delete($id) {
		$discipline = $this->model::findOrFail($id);
		$discipline->delete();
		return $discipline;
	}
}