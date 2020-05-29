<?php

namespace App\Models;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema()
 */
class TipoDocumento extends Model
{
    use SoftDeletes;

    public $table = 'tipo_documentos';


    protected $dates = ['deleted_at'];

    /**
     * The product name
     * @var string
     *
     * @OA\Property(
     *   property="nombre",
     *   type="string",
     *   description="Nombre del tipo de documento"
     * )
     */
    /**
     * The product name
     * @var string
     *
     * @OA\Property(
     *   property="tabla",
     *   type="string",
     *   description="tabla del tipo de documento"
     * )
     */
    /**
     * The product name
     * @var int
     *
     * @OA\Property(
     *   property="tamaño",
     *   type="int",
     *   description="tamaño del tipo de documento"
     * )
     */
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
