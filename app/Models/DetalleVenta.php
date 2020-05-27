<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetalleVenta extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public $fillable = [
        'total',
        'user_id',
        'cliente_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'total'      => 'integer',
        'user_id'    => 'integer',
        'cliente_id' => 'integer',
    ];

    public static $rules = [
        'total' => 'required|numeric',
        'user_id' => 'required',
        'user_id'  => 'required|exists:usuarios,id,deleted_at,NULL',
        'cliente_id'  => 'required|exists:clientes,id,deleted_at,NULL'
    ];
}
