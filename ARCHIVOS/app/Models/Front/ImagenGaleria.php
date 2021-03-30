<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class ImagenGaleria extends Model {

    protected $table = 'imagenGaleria';
    
    protected $primaryKey = 'idimagen';


    protected $fillable = [
        'image',
        'descripcion',
        'estado'
    ];
    
/*RELACIONES IRÁN ACÁ*/

    public function galerias() {
        return $this->belongsTo('App\Models\Front\Galeria', 'idgaleria','idgaleria');
    }

}
