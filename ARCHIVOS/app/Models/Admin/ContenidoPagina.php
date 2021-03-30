<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ContenidoPagina extends Model
{
    //nombre de la tabla del modelo
	protected $table = 'contenido_paginas';
	//llave primaria de la tabla
	protected $primaryKey = 'idcontenido';
	//datos que pueden ser editados en las consultas
	protected $fillable = [
        'nombre',
        'imagen',
        'descripcion',
        'estado',

    ];

	/*
	Relaciones
	*/ 
	public function paginas()
	{
	    return $this->belongsTo('App\Models\Admin\Pagina','idpagina','idpagina');
 
	}
	
	
}
