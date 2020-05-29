<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema()
 */

class Categoria extends Model
{
    use SoftDeletes;

    /**
     * The product name
     * @var string
     *
     * @OA\Property(
     *   property="nombre",
     *   type="string",
     *   description="Nombre del producto"
     * )
     */

    protected $dates = ['deleted_at'];
    /**
     * The product name
     * @var string
     *
     * @OA\Property(
     *   property="descripcion",
     *   type="string",
     *   description="Descripcion del producto"
     * )
     */
    public $fillable = ['nombre', 'descripcion'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'string|required|min:4|max:20',
        'descripcion' => 'string|nullable|min:4|max:100',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
