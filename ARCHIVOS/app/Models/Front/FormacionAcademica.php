<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class FormacionAcademica extends Model {

    protected $table = 'formacion_academica';
    
    protected $primaryKey = 'idfreelancer';


    protected $fillable = [
		'tipo_relacion',
        'tipoFormacion',
        'nivelFormacion',
        'titulo',
        'universidad',
        'anio_culminacion'
	];


}
