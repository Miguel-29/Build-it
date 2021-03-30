<?php

namespace App\Http\Controllers\Admin\Api;

use App\Repositories\SubUsoOcupacionRepository;

class SubUsoOcupacionController extends ApiController {

	protected $subUsoOcupacion;

	public function __construct(
		SubUsoOcupacionRepository $subUsoOcupacion
	) {
		$this->subUsoOcupacion = $subUsoOcupacion;
	}

	public function index() {
		$ocupationSubUses = $this->subUsoOcupacion->all();
		$results = $ocupationSubUses->all();
		return $this->response($results);
	}
}
