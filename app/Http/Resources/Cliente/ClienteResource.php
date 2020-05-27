<?php

namespace App\Http\Resources\Cliente;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TipoDocumento\TipoDocumentoResource;

class ClienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'nombres'      => $this->nombres,
            'apellidos' => $this->apellidos,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'numero_documento' => $this->numero_documento,
            'tipo_documento' => TipoDocumentoResource::make($this->tipo_documento),
            'links'       => [
                [
                    'rel'  => 'self',
                    'href' => route('clientes.show', $this->id)
                ],
                // [
                //     'rel' => 'categoria.productos',
                //     'href' => route('categorias.productos.index', $this->id)
                // ]
            ]
        ];
    }
}
