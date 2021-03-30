<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model {

    protected $table = 'proyectos';
    
    protected $primaryKey = 'idproyecto';

    
	public function clientes() {
		return $this->belongsTo('App\Models\Front\Cliente', 'idcliente','idcliente');
    }
        
    public function tipos() {
            return $this->belongsTo('App\Models\Admin\TipoProyecto', 'idtipo','id');
    }

    public function grupoUso() {
            return $this->belongsTo('App\Models\Admin\GrupoUso', 'ie_grupouso','id');
    }

    public function subUso() {
            return $this->belongsTo('App\Models\Admin\SubUsoOcupacion', 'ie_subuso','id');
    }

    public function fases(){
	    return $this->belongsToMany('App\Models\Admin\Fase','proyecto_fase_disciplina','idproyecto','idfase')
        			->withPivot('iddisciplina','cuenta_con_contratista','seleccion_del_catalogo','tipo_contratista','idcontratista','estado_contratista','calificacion_contratista_proyecto')->withTimestamps(); //relación muchos a muchos
    }

    public function disciplinas(){
	    return $this->belongsToMany('App\Models\Admin\Disciplina','proyecto_fase_disciplina','idproyecto','iddisciplina')
        			->withPivot('idfase','cuenta_con_contratista','seleccion_del_catalogo','tipo_contratista','idcontratista','estado_contratista','calificacion_contratista_proyecto')->withTimestamps(); //relación muchos a muchos
    }

    public function contactos(){
	    return $this->belongsToMany('App\Models\Front\Cliente','contactos','idproyecto','idcliente')
        			->withPivot('iddisciplina','idfase','tipo_contratista','nombres','correo','celular')->withTimestamps(); //relación muchos a muchos
    }



  
  


}
