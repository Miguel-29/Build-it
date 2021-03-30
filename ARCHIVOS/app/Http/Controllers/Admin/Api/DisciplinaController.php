<?php

namespace App\Http\Controllers\Admin\Api;

use App\Repositories\DisciplinaRepository;

class DisciplinaController extends ApiController {

	protected $disciplina;

	public function __construct(
		DisciplinaRepository $disciplina
	) {
		$this->disciplina = $disciplina;
	}

	public function index() {
		$disciplines = $this->disciplina->all();

		$result = $disciplines->all();
		
		return $this->response($result);
	}
}
