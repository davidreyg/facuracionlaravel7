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
        return Venta::$rules;
    }
}
