<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombres' => 'required',
        'apellidos' => 'required',
        'correo' => 'nullable',
        'telefono' => 'nullable',
        'direccion' => 'nullable',
        'numero_documento' => 'required',
        'id_tipo_documento' => 'required'
    ];
}
