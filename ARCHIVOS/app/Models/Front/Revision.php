<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model {

    protected $table = 'revision_diseno';
    
    protected $primaryKey = 'idrevision';

    protected $fillable = [
        'tipo_relacion',
        'realiza_funcion_revision_diseno',
        'anios_experiencia_revision',
        'm2_revisados',
        'tipos_estructuras'
	];

}
