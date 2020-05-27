<?php

namespace App\Http\Requests\Cliente;

use App\Http\Requests\ApiBaseRequest;
use App\Models\Cliente;

class CrearClienteRequest extends ApiBaseRequest
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
        $rules = Cliente::$rules;
        if ($this->request->get('tipo_documento_id') == 1) {
            $rules['numero_documento'] = 'required|digits:8';
        }
        return $rules;
    }
}
