<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class ExperienciaLaboral extends Model {

    protected $table = 'experiencia_laboral';
    
    protected $primaryKey = 'idexperiencia';

    protected $fillable = [
		'tipo_relacion',
        'anios_experiencia',
        'm2_disenados',
        'tipo_estructuras_disenadas',
        'actividades_desempena',
        'uso_software',
        'disponibilidad_personal',
        'certificados_cursos_seminarios',
        'disponibilidad_viajar',
        'tipo_contratacion',
        'costo_por_unidad_contratacion'
	];

}
