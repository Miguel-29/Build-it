<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class CategoriaBeneficio extends Model {

    protected $table = 'categorias_beneficios';
    //llave primaria de la tabla
	protected $primaryKey = 'idcategoria';

    protected $fillable = [
		'nombre',
	];

	public function beneficios()
	{
	    return $this->belongsToMany('App\Models\Admin\Beneficio','categorias_b','idcategoria','idbeneficio')->withPivot('idbeneficio')->withTimestamps(); //relación muchos a muchos
    }
}