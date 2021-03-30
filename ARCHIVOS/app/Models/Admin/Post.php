<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    protected $table = 'post';
    //llave primaria de la tabla
	protected $primaryKey = 'idpost';

    protected $fillable = [
        'titulo',
        'resumenDescripcion',
        'descripcion',
        'imagenFull',
        'imagenSmall',
        'estado'
	];

	public function categorias()
	{
	    return $this->belongsToMany('App\Models\Admin\Categoria','post_categorias','idpost','idcategoria')->withPivot('idcategoria')->withTimestamps(); //relación muchos a muchos
    }
}