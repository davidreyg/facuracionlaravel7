<?php

namespace App\Http\Requests\Venta;

use App\Http\Requests\ApiBaseRequest;
use App\Models\Venta;
use Illuminate\Foundation\Http\FormRequest;

class CrearVentaRequest extends ApiBaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        $rules = [
            'total'                       => 'required|numeric',
            'user_id'                     => 'required|exists:users,id',
            'cliente_id'                  => 'required|exists:clientes,id,deleted_at,NULL',
            'detalle_venta'               => 'required|array',
            'detalle_venta.*.producto_id' => 'required|exists:productos,id,deleted_at,NULL',
            'detalle_venta.*.cantidad'    => 'required|numeric'
        ];
        return $rules;
    }
}
