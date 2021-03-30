<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class TagDocumento extends Model {

	protected $table = 'tags_documentos';

    protected $fillable = [
		'tipo',
		'tag',
		'obligatorio'
	];

	/* --------- STATIC CONTENT --------- */
	public static $TIPO_OPTIONS = [
		'proyecto',
		'proveedor',
		'freelance',
		'empresa',
		'pasante'
	];

	public static function isTipoOptionValid($option) {
		if(strlen($option) === 0)
			return false;

		$option = strtolower($option);

		return in_array($option, TagDocumento::$TIPO_OPTIONS);
	}
}
