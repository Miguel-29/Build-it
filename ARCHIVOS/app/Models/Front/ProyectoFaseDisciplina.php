<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class ProyectoFaseDisciplina extends Model {

    protected $table = 'proyecto_fase_disciplina';
    
    protected $primaryKey = 'iden';


    protected $fillable = [
		'cuenta_con_contratista',
        'seleccion_del_catalogo',
        'tipo_contratista',
        'idcontratista',
        'estado_contratista',
        'calificacion_contratista_proyecto',
        'comentarios_al_contratista'
    ];
    
    public function proyectos() {
		return $this->hasMany('App\Models\Front\Proyecto', 'idproyecto','idproyecto');
    }

    public function fases() {
		return $this->hasMany('App\Models\Admin\Fase', 'idfase','idfase');
    }

    
    public function disciplinas() {
		return $this->hasMany('App\Models\Admin\Disciplina', 'iddisciplina','iddisciplina');
    }


}
