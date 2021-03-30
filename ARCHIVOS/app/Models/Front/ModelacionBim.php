<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class ModelacionBim extends Model {

    protected $table = 'modelacion_bim';
    
    protected $primaryKey = 'idmodelacion';

    protected $fillable = [
        'tipo_relacion',
        'ha_trabajado_bim',
        'anios_experiencia',
        'm2_disenados_bim',
        'tipo_estructuras_disenadas',
        'uso_software_bim',
        'tiene_certificados_bim',
        'desea_aprender_bim'
	];

}
