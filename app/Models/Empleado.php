<?php

namespace App\Models;

use App\Models\TipoDocumento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public $fillable = [
        'nombres',
        'apellidos',
        'correo',
        'telefono',
        'direccion',
        'numero_documento',
        'id_tipo_documento'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombres' => 'string',
        'apellidos' => 'string',
        'correo' => 'string',
        'telefono' => 'integer',
        'direccion' => 'string',
        'numero_documento' => 'integer',
        'id_tipo_documento' => 'integer'
    ];

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

    public function tipo_documento()
    {
        return $this->belongsTo(TipoDocumento::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
