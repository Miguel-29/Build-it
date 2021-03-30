<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class SubUsoOcupacion extends Model {

	protected $table = 'sub_uso_ocupacion';

    protected $fillable = [
		'nombre',
		'grupo_uso_id'
	];

	public function grupoUso() {
		return $this->belongsTo('App\Models\Admin\GrupoUso', 'grupo_uso_id');
	}
}
