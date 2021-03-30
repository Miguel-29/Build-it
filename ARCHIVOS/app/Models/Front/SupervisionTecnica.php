<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class SupervisionTecnica extends Model {

    protected $table = 'supervision_tecnica';
    
    protected $primaryKey = 'idsupervision';

    protected $fillable = [
        'tipo_relacion',
        'realiza_supervision_tecnica',
        'anios_experiencia_supervision',
        'm2_supervisados',
        'tipo_estructuras'
	];

}
