<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model {

    protected $table = 'categorias';
    //llave primaria de la tabla
	protected $primaryKey = 'idcategoria';

    protected $fillable = [
		'nombre',
	];

	public function post()
	{
	    return $this->belongsToMany('App\Models\Admin\Post','post_categorias','idcategoria','idpost')->withPivot('idpost')->withTimestamps(); //relación muchos a muchos
    }
}