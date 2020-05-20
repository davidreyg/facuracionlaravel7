<?php

namespace App\Http\Requests\Categoria;

use App\Http\Requests\ApiBaseRequest;
use App\Models\Categoria;

class ActualizarCategoriaRequest extends ApiBaseRequest
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
        return Categoria::$rules;
    }
}
