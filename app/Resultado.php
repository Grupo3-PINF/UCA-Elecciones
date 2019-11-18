<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    // Nombre de la tabla
    protected $table = 'resultados';
    protected $casts = [
        'recuento' => 'array'
    ];
}
