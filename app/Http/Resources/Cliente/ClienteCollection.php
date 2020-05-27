<?php

namespace App\Http\Resources\Cliente;

use App\Models\Cliente;
use App\Http\Resources\Cliente\ClienteResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ClienteCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (Cliente $producto) {
            return (new ClienteResource($producto));
        });
        return [
            'data' => $this->collection
        ];
    }
}
