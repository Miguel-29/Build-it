<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class EspecialidadProveedor extends Model
{
    //nombre de la tabla del modelo
	protected $table = 'especialidades_proveedores';
	//llave primaria de la tabla
	protected $primaryKey = 'idespecialidad';
	//datos que pueden ser editados en las consultas
	protected $fillable = ['nombre'];

	/*
	Relaciones
    */ 

    public function servicios()
	{
	    return $this->hasMany('App\Models\Admin\ServicioEspecialidad','idespecialidad','idespecialidad');
 
	}

    public function proveedores()
	{
        return $this->belongsToMany('App\Models\Front\Proveedor','proveedores_especialidades','idespecialidad','idproveedor')->withPivot('idproveedor')->withTimestamps(); //relación muchos a muchos
    }

    
	
}