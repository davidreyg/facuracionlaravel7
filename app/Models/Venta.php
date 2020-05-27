<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{

    public static $rules = [
        'nombre' => 'required|string',
        'tabla' => 'string|nullable',
        'tamaño' => 'required|numeric'
    ];
}
