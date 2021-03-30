<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model {

    protected $table = 'galeria';
    
    protected $primaryKey = 'idgaleria';


    protected $fillable = [
		'tipo_relacion',
        'idrelacion',
        'nombre',
        'descripcion',
        'estado'
    ];
    
/*RELACIONES IRÁN ACÁ*/

    public function imagenes() {
        return $this->hasMany('App\Models\Front\ImagenGaleria', 'idgaleria','idgaleria');
    }

    public function comentarios() {
        return $this->hasMany('App\Models\Front\ComentarioGaleria', 'idgaleria','idgaleria');
    }



}
