<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class GrupoUso extends Model {

	protected $table = 'grupo_uso';

    protected $fillable = [
		'nombre',
		'descripcion'
	];

	public function subUsoOcupaciones() {
		return $this->hasMany('App\Models\Admin\SubUsoOcupacion', 'grupo_uso_id');
	}
}
