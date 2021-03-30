<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model {

    protected $table = 'documentos';
    
    protected $primaryKey = 'iddocumento';

    protected $fillable = [
        'tipoDocumento',
        'tagDocumento',
        'nombre',
        'urlDoc'
	];

}
