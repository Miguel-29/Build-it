<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model {

    protected $table = 'contactos';
    //llave primaria de la tabla
	protected $primaryKey = 'idcontacto';

    protected $fillable = [
        'tipo_contratista',
        'nombres',
        'correo',
        'celular'
	];

	public function proyectos()
	{
	    return $this->belongsTo('App\Models\Front\Proyecto','idproyecto','idproyecto');
 
    }
    
    public function clientes()
	{
	    return $this->belongsTo('App\Models\Front\Cliente','idcliente','idcliente');
 
    }
    
    public function disciplinas()
	{
	    return $this->belongsTo('App\Models\Admin\Disciplina','iddisciplina','iddisciplina');
 
    }
    
    public function fases()
	{
	    return $this->belongsTo('App\Models\Admin\Fase','idfase','idfase');
 
	}
}