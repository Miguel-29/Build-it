<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class ProfesionFreelancer extends Model {

    protected $table = 'profesiones_freelancer';
    
    protected $primaryKey = 'iden';


    protected $fillable = [
        'iden',
        'idrelacion',
        'idprofesion',
        'iddisciplina'

	];

    public function freelancers() {
		return $this->belongsToMany('App\Models\Admin\Freelancer','profesiones_freelancer', 'iden','idrelacion')->withTimestamps();
    }
    
	public function profesiones() {
		return $this->belongsTo('App\Models\Admin\Profesion', 'idprofesion','id');
    }
    
    public function disciplinas() {
		return $this->belongsTo('App\Models\Admin\Disciplina', 'iddisciplina','iddisciplina');
	}

}
