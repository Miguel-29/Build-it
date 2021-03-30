<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Idioma extends Model {

    protected $table = 'idiomas';
    
    protected $primaryKey = 'iden';


    protected $fillable = [
		'tipo_relacion',
        'nombreIdioma',
        'nivelIdioma'
	];

}
