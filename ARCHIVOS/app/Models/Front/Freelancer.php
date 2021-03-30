<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Freelancer extends Model {

    protected $table = 'freelancer';
    
    protected $primaryKey = 'idfreelancer';


    protected $fillable = [
		'image',
        'nombres',
        'apellidos',
        'genero',
        'ciudad_residencia',
        'pais',
        'tipo_documento',
        'documento',
        'fecha_nacimiento',
        'edad',
        'email',
        'celular',
        'nacionalidad',
        'disponibilidad_tiempo',
        'fp_competencias',
        'fp_descripcion_profesional',
        'estado'
	];
	public function disciplinas2()
	{
	    return $this->hasMany('App\Models\Front\ProfesionFreelancer','idfreelancer','idrelacion');
 
	}
	/*public function profesiones() {
		return $this->hasMany('App\Models\Front\ProfesionFreelancer', 'fp_profesion','id');
    }*/
    
    /*public function disciplinas() {
		return $this->hasMany('App\Models\Front\ProfesionFreelancer', 'fp_linea_enfoque_area','iddisciplina');
    }*/
    public function disciplinas(){
	    return $this->belongsToMany('App\Models\Admin\Disciplina','profesiones_freelancer','idrelacion','iddisciplina')
        			->withPivot('idprofesion')->withTimestamps(); //relación muchos a muchos
    }

    public function profesiones(){
	    return $this->belongsToMany('App\Models\Admin\Profesion','profesiones_freelancer','idrelacion','idprofesion')
        			->withPivot('iddisciplina')->withTimestamps(); //relación muchos a muchos
    }

}
