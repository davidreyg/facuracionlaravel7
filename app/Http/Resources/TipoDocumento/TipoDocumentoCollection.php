<?php

namespace App\Http\Resources\TipoDocumento;

use App\Models\TipoDocumento;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TipoDocumentoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (TipoDocumento $categoria) {
            return (new TipoDocumentoResource($categoria));
        });
        return [
            'data' => $this->collection
        ];
    }
}
