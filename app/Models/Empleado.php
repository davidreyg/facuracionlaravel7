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
        'tipo_documento_id'
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
        'tipo_documento_id' => 'integer'
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
        'tipo_documento_id' => 'required'
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
