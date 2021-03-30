<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Profesion extends Model {

	protected $table = 'profesiones';

    protected $fillable = [
		'nombre',
		'estado'
	];

	public function isActive() {
		return $this->estado;
    }
    
    public function disciplinas() {
        return $this->belongsToMany('App\Models\Admin\Disciplina','profesiones_disciplinas','idprofesion','iddisciplina')->withPivot('iddisciplina')->withTimestamps(); //relación muchos a muchos
	}

	public function areasProfesion() {
		return $this->hasMany('App\Models\Admin\AreaProfesion', 'profesion_id');
    }
    
    public function freelancers()
	{
	    return $this->belongsToMany('App\Models\Front\Freelancer','profesiones_freelancer','idprofesion','idrelacion')->withPivot('iddisciplina')->withTimestamps(); //relación muchos a muchos
    }

    public function empresas()
	{
	    return $this->belongsToMany('App\Models\Front\Empresa','profesiones_empresa','idprofesion','idrelacion')->withTimestamps(); //relación muchos a muchos
    }
    
}
