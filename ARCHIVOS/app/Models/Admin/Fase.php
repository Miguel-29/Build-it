<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    //nombre de la tabla del modelo
	protected $table = 'fases';
	//llave primaria de la tabla
	protected $primaryKey = 'idfase';
	//datos que pueden ser editados en las consultas
	protected $fillable = ['nombre','descripcion','image'];

	/*
	Relaciones
	*/ 
}