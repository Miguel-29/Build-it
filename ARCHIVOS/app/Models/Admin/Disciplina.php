<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    //nombre de la tabla del modelo
	protected $table = 'disciplinas';
	//llave primaria de la tabla
	protected $primaryKey = 'iddisciplina';
	//datos que pueden ser editados en las consultas
	protected $fillable = ['nombre','descripcion','asociada_a','image'];

	/*
	Relaciones
    */ 
    public function freelancers()
	{
	    return $this->belongsToMany('App\Models\Front\Freelancer','profesiones_freelancer','iddisciplina','idrelacion')->withPivot('idprofesion')->withTimestamps(); //relación muchos a muchos
    }

    public function empresas()
	{
	    return $this->belongsToMany('App\Models\Front\Empresa','profesiones_empresa','iddisciplina','idrelacion')->withTimestamps(); //relación muchos a muchos
    }
    
    

	public function servicios()
	{
	    return $this->belongsToMany('App\Models\Admin\ServicioEspecialidad','serviciosproveedores_disciplinas','iddisciplina','idservicio')->withPivot('idservicio')->withTimestamps(); //relación muchos a muchos
    }
    
    public function profesiones()
	{
	    return $this->belongsToMany('App\Models\Admin\Profesion','profesiones_disciplinas','iddisciplina','idprofesion')->withTimestamps(); //relación muchos a muchos
	}
	
}