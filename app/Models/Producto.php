<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre',
        'descripcion',
        'stock',
        'precio_compra',
        'precio_venta',
        'ganancia',
        'moneda',
        'categoria_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'            => 'integer',
        'nombre'        => 'string',
        'stock'         => 'integer',
        'precio_compra' => 'integer',
        'precio_venta'  => 'integer',
        'ganancia'      => 'integer',
        'moneda'        => 'string',
        'categoria_id'  => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre'        => 'required',
        'stock'         => 'required',
        'precio_compra' => 'required',
        'precio_venta'  => 'required',
        'ganancia'      => 'required',
        'moneda'        => 'string|required',
        'descripcion'   => 'string|nullable|min:4|max:100',
        'imagen'        => 'required|image',
        'categoria_id'  => 'required|exists:categorias,id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }


}
