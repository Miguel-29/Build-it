<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class OpcionListado extends Model
{
    //nombre de la tabla del modelo
	protected $table = 'opciones_listado';
	//llave primaria de la tabla
	protected $primaryKey = 'idlistado';
	//datos que pueden ser editados en las consultas
	protected $fillable = ['nombre'];

	/*
	Relaciones
	*/ 
	public function listados()
	{
	    return $this->belongsTo('App\Models\Admin\Listado','idlistado','idlistado');
 
	}
	
	
}
