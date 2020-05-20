<?php

namespace App\Http\Resources\Producto;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Categoria\CategoriaResource;

class ProductoResource extends JsonResource
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
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'stock' => $this->stock,
            'precio_venta' => $this->precio_venta,
            'precio_compra' => $this->precio_compra,
            'ganancia' => $this->ganancia,
            'moneda' => $this->moneda,
            'categoria' => CategoriaResource::make($this->categoria),
            'categoria_id' => $this->categoria->id,
            'imagen' => ($this->getMedia())->isEmpty() ? null : $this->getMedia(),
            'imagen_url' => ($this->getMedia())->isEmpty() ? null : $this->getMedia()->first()->getUrl(),
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('productos.show', $this->id)
                ]
            ]
        ];
    }
}
