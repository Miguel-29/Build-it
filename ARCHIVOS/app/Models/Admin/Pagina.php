<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Pagina extends Model
{
    //nombre de la tabla del modelo
	protected $table = 'paginas';
	//llave primaria de la tabla
	protected $primaryKey = 'idpagina';
	//datos que pueden ser editados en las consultas
    protected $fillable = 
    ['titulo',
    'ruta_pagina',
    'imagen_header',
    'asociada_a',
    'estado',

    ];

	/*
	Relaciones
	*/ 
	public function contenidos()
	{
	    return $this->hasMany('App\Models\Admin\ContenidoPagina','idpagina','idpagina');
 
	}
	
	
}
