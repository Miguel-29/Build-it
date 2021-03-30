<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Listado extends Model
{
    //nombre de la tabla del modelo
	protected $table = 'listados';
	//llave primaria de la tabla
	protected $primaryKey = 'idlistado';
	//datos que pueden ser editados en las consultas
	protected $fillable = ['nombre','descripcion'];

	/*
	Relaciones
	*/ 
	public function opciones()
	{
	    return $this->hasMany('App\Models\Admin\OpcionListado','idlistado','idlistado');
 
	}
	
	
}
