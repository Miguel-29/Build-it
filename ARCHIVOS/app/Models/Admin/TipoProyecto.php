<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class TipoProyecto extends Model {

	protected $table = 'tipo_proyectos';

    protected $fillable = [
		'nombre',
		'descripcion',
		'imagen'
	];

	public function getImageUrl() {
		return '/storage/' . $this->imagen;
	}

	// --------- RELATIONSHIPS METHODS ---------
	public function fasesDisciplinasSubusos() {
		return $this->hasMany('App\Models\Admin\FaseDisciplinaSubuso', 'tipo_proyecto_id');
    }
    
	public function fases()
	{
	    return $this->belongsToMany('App\Models\Admin\Fase','fase_disciplina_subuso','tipo_proyecto_id','fase_id')
        			->withPivot('sub_uso_ocupacion_id','disciplina_id')->withTimestamps(); //relación muchos a muchos
	}
}
