<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema()
 */
class Cliente extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /**
     * The product name
     * @var string
     *
     * @OA\Property(
     *   property="nombres",
     *   type="string",
     *   description="Nombres del cliente"
     * )
     */
    /**
     * The product name
     * @var string
     *
     * @OA\Property(
     *   property="apellidos",
     *   type="string",
     *   description="Apellidos del cliente"
     * )
     */
    /**
     * The product name
     * @var string
     *
     * @OA\Property(
     *   property="correo",
     *   type="string",
     *   description="correo del cliente"
     * )
     */
    /**
     * The product name
     * @var int
     *
     * @OA\Property(
     *   property="telefono",
     *   type="int",
     *   description="telefono del cliente"
     * )
     */
        /**
     * The product name
     * @var string
     *
     * @OA\Property(
     *   property="direccion",
     *   type="string",
     *   description="direccion del cliente"
     * )
     */
    /**
     * The product name
     * @var int
     *
     * @OA\Property(
     *   property="numero_documento",
     *   type="int",
     *   description="numero_documento del cliente"
     * )
     */
    /**
     * The product name
     * @var int
     *
     * @OA\Property(
     *   property="tipo_documento_id",
     *   type="int",
     *   description="tipo_documento_id del cliente"
     * )
     */
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
        'nombres'           => 'required',
        'apellidos'         => 'required',
        'correo'            => 'nullable',
        'telefono'          => 'required',
        'direccion'         => 'nullable',
        'tipo_documento_id' => 'required|exists:tipo_documentos,id,deleted_at,NULL'
    ];

    public function tipo_documento()
    {
        return $this->belongsTo(TipoDocumento::class);
    }
}
