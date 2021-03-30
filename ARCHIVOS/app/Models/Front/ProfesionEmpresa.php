<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class ProfesionEmpresa extends Model {

    protected $table = 'profesiones_empresa';
    
    protected $primaryKey = 'iden';


    protected $fillable = [
        'iden',
        'idrelacion',
        'iddisciplina'

	];

    public function empresas() {
		return $this->belongsTo('App\Models\Admin\Empresa', 'idrelacion','idempresa');
    }
    
	public function profesiones() {
		return $this->belongsTo('App\Models\Admin\Profesion', 'idprofesion','id');
    }
    
    public function disciplinas() {
		return $this->belongsTo('App\Models\Admin\Disciplina', 'iddisciplina','iddisciplina');
	}

}
