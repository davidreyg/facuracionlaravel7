<?php

namespace App\Http\Resources\TipoDocumento;

use Illuminate\Http\Resources\Json\JsonResource;

class TipoDocumentoResource extends JsonResource
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
            'nombre'      => $this->nombre,
            'tabla' => $this->tabla,
            'tamaño' => $this->tamaño,
            'links'       => [
                [
                    'rel'  => 'self',
                    'href' => route('tipo_documentos.show', $this->id)
                ],
                // [
                //     'rel' => 'categoria.productos',
                //     'href' => route('categorias.productos.index', $this->id)
                // ]
            ]
        ];
    }
}
