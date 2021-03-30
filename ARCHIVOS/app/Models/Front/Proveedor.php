<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model {

    protected $table = 'proveedores';
    
    protected $primaryKey = 'idproveedor';


    protected $fillable = [

		'image',
        'nombre',
        'gerente_nombre',
        'gerente_documento',
        'gerente_celular',
        'ciudad_residencia',
        'pais_residencia',
        'direccion',
        'nit_rut',
        'rup',
        'anio_fundacion',
        'pagina_web',
        'redes_sociales',
        'email',
        'celular',
        'nacionalidad',
        'descripcion',
        'presta_servicios_otras_ciudades',
        'estado'
    ];

    public function servicios()
	{
        return $this->belongsToMany('App\Models\Admin\ServicioEspecialidad','proveedores_servicios','idproveedor','idservicio')->withTimestamps(); //relación muchos a muchos
    }
    
    public function especialidades()
	{
        return $this->belongsToMany('App\Models\Admin\EspecialidadProveedor','proveedores_especialidades','idproveedor','idespecialidad')->withTimestamps(); //relación muchos a muchos
    }

    public function allEspecialidades()
	{
        return $this->especialidades; //relación muchos a muchos
    }


    

}
