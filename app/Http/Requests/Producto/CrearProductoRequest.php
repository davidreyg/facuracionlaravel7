<?php

namespace App\Http\Requests\Producto;

use App\Models\Producto;
use App\Http\Requests\ApiBaseRequest;

class CrearProductoRequest extends ApiBaseRequest
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
        return Producto::$rules;
    }
}
