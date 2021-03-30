<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model {

    protected $table = 'clientes';
    
    protected $primaryKey = 'idcliente';


    protected $fillable = [
		'image',
        'nombre_razon_social',
        'apellidos',
        'ciudad',
        'pais',
        'direccion',
        'nit_rut',
        'tipo_documento',
        'documento',
        'fecha_nacimiento_creacion',
        'edad',
        'email',
        'celular',
        'pagina_web',
        'redes_sociales',
        'descripcion_empresa',
        'estado'
    ];
    
    public function proyectos() {
		return $this->hasMany('App\Models\Front\Proyecto', 'idcliente','idcliente');
    }


}
