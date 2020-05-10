<?php

namespace App\Models;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoDocumento extends Model
{
    use SoftDeletes;

    public $table = 'tipo_documentos';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre',
        'tabla',
        'tamaño'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'tabla' => 'string',
        'tamaño' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string',
        'tabla' => 'string|nullable',
        'tamaño' => 'required|numeric'
    ];

    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }
}
