<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ServicioEspecialidad extends Model
{
    //nombre de la tabla del modelo
	protected $table = 'servicios_especialidad';
	//llave primaria de la tabla
	protected $primaryKey = 'idservicio';
	//datos que pueden ser editados en las consultas
	protected $fillable = ['nombre'];

	/*
	Relaciones
	*/ 
	public function especialidades()
	{
	    return $this->belongsTo('App\Models\Admin\EspecialidadProveedor','idespecialidad','idespecialidad');
 
    }
    
    public function disciplinas()
	{
        return $this->belongsToMany('App\Models\Admin\Disciplina','serviciosproveedores_disciplinas','idservicio','iddisciplina')->withPivot('iddisciplina')->withTimestamps(); //relación muchos a muchos
    }

    public function proveedores()
	{
        return $this->belongsToMany('App\Models\Front\Proveedor','proveedores_servicios','idservicio','idproveedor')->withPivot('idproveedor')->withTimestamps(); //relación muchos a muchos
    }

    
	
	
}