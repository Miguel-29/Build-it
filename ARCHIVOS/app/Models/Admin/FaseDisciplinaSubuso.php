<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class FaseDisciplinaSubuso extends Model {

	protected $table = 'fase_disciplina_subuso';

    protected $fillable = [
		'tipo_proyecto_id',
		'sub_uso_ocupacion_id',
		'disciplina_id',
		'fase_id',
		'es_obligatorio'
	];

	// --------- RELATIONSHIP METHODS ---------
	public function tipoProyecto() {
		return $this->belongsTo('App\Models\Admin\TipoProyecto', 'tipo_proyecto_id');
	}

	public function subUsoOcupacion() {
		return $this->belongsTo('App\Models\Admin\SubUsoOcupacion', 'sub_uso_ocupacion_id');
	}

	public function disciplina() {
		return $this->belongsTo('App\Models\Admin\Disciplina', 'disciplina_id', 'iddisciplina');
	}

	public function fase() {
		return $this->belongsTo('App\Models\Admin\Fase', 'fase_id', 'idfase');
	}
}
