<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetalleVenta extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'detalle_venta';

    public $fillable = [
        'cantidad',
        'precio_unitario',
        'precio_total',
        'producto_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'total'           => 'integer',
        'precio_unitario' => 'integer',
        'precio_total'    => 'integer',
        'venta_id'        => 'integer',
        'producto_id'     => 'integer',
    ];

    public static $rules = [
        'total'       => 'required|numeric',
        'venta_id'    => 'required|exists:ventas,id,deleted_at,NULL',
        'producto_id' => 'required|exists:productos,id,deleted_at,NULL'
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
