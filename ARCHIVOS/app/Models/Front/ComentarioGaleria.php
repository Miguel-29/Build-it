<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class ComentarioGaleria extends Model {

    protected $table = 'comentariosGaleria';
    
    protected $primaryKey = 'idcomentario';


    protected $fillable = [
        'tipo_relacion',
        'descripcion',
        'idrelacion'
    ];
    
/*RELACIONES IRÁN ACÁ*/

    public function galerias() {
        return $this->belongsTo('App\Models\Front\Galeria', 'idgaleria','idgaleria');
    }

}
