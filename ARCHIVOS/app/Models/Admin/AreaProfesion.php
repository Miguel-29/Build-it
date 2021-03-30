<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AreaProfesion extends Model {

	protected $table = 'areas_profesiones';

    protected $fillable = [
		'nombre',
		'profesion_id'
	];

	public function profesion() {
		return $this->belongsTo('App\Models\Admin\Profesion', 'profesion_id');
	}
}
