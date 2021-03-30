<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model {

    protected $table = 'empresa';
    
    protected $primaryKey = 'idempresa';


    protected $fillable = [
		'image',
        'razon_social',
        'ciudad_residencia',
        'pais',
        'direccion',
        'nit',
        'rup',
        'anio_fundacion',
        'pagina_web',
        'redes_sociales',
        'email',
        'celular',
        'nacionalidad',
        'descripcion_empresa',
        'fp_profesion',
        'fp_linea_enfoque_area',
        'fp_competencias',
        'fp_descripcion_profesional',
        'gerente_nombres',
        'gerente_apellidos',
        'gerente_celular',
        'estado'
    ];
    
	/*public function profesiones() {
		return $this->belongsTo('App\Models\Admin\Profesion', 'fp_profesion','id');
    }
    
    public function disciplinas() {
		return $this->belongsTo('App\Models\Admin\Disciplina', 'fp_linea_enfoque_area','iddisciplina');
    }*/
    public function disciplinas(){
	    return $this->belongsToMany('App\Models\Admin\Disciplina','profesiones_empresa','idrelacion','iddisciplina')
        			->withTimestamps(); //relación muchos a muchos
    }

    public function profesiones(){
	    return $this->belongsToMany('App\Models\Admin\Profesion','profesiones_empresa','idrelacion','idprofesion')
        			->withPivot('iddisciplina')->withTimestamps(); //relación muchos a muchos
    }

	public function profesionesGerente() {
		return $this->belongsTo('App\Models\Admin\Profesion', 'gerente_idprofesion','id');
    }
    
    public function disciplinasGerente() {
		return $this->belongsTo('App\Models\Admin\Disciplina', 'gerente_iddisciplina','iddisciplina');
	}

}
