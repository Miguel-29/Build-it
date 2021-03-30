<?php

namespace App\Http\Controllers\Admin\Api;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class ApiController extends Controller {

	public function __construct() {}

	public function response($content, $statusCode = 200) {
		$response = new Response();
		$response->header('Content-Type', 'application/json');
		$response->setStatusCode($statusCode);
		$response->setContent($content);
		return $response;
	}

	public function error($code, $message, $statusCode = 400) {
		$error = [
			'code' => $code,
			'message' => $message
		];
		return $this->response($error, $statusCode);
	}
}
