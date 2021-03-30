<?php

namespace App\Http\Controllers\Admin\Api;

use App\Repositories\FaseRepository;

class FaseController extends ApiController {

	protected $fase;

	public function __construct(
		FaseRepository $fase
	) {
		$this->fase = $fase;
	}

	public function index() {
		$phases = $this->fase->all();
		$results = $phases->all();
		return $this->response($results);
	}
}
