<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Beneficio extends Model {

    protected $table = 'beneficios';
    //llave primaria de la tabla
	protected $primaryKey = 'idbeneficio';

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'archivo',
        'estado'
	];

	public function categorias()
	{
	    return $this->belongsToMany('App\Models\Admin\CategoriaBeneficio','categorias_b','idbeneficio','idcategoria')->withPivot('idcategoria')->withTimestamps(); //relación muchos a muchos
    }
}