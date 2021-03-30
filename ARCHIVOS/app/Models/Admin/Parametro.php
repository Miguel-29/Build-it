<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Model;

class Parametro extends Model 
{
    //nombre de la tabla del modelo
	protected $table = 'parametros';
	//llave primaria de la tabla
	protected $primaryKey = 'idparametro';  
	//datos que pueden ser editados en las consultas
	protected $fillable = ['nombre','valor','idparametro'];
	
	/**** Custom Methods ****/
	public static function valueParameterByName($name="",$arrayreplace="")
    {
		$resultado = "";
		$j=0;
		if($arrayreplace!="")
		foreach($arrayreplace as $key => $value)
		{
			$arraysearch[$j] = $key;
			$arrayreplace[$j] = $value;
			$j++;
		}
		
		if($name!="")
		{
			$parameter = Parametro::where('nombre', '=', $name)->take(1)->get();
			$resultado = $parameter[0]->valor;
			if($j>0)
			{
				$resultado = str_replace($arraysearch,$arrayreplace,$resultado);
			}
		}
		
		return $resultado;
    }
	
	/*
	Relaciones
	*/
	
}
