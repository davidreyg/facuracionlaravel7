<?php

namespace App\Http\Controllers\Producto;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Producto\ActualizarProductoRequest;
use App\Http\Requests\Producto\CrearProductoRequest;
use App\Http\Resources\Producto\ProductoCollection;
use App\Http\Resources\Producto\ProductoResource;
use App\Repositories\ProductoRepository;

class ProductoController extends ApiController
{


    /** @var  ProductoRepository */
    private $productoRepository;

    public function __construct(ProductoRepository $productoRepo)
    {
        $this->productoRepository = $productoRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producto = $this->productoRepository->all();

        return $this->showAll(new ProductoCollection($producto));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearProductoRequest $request)
    {
        $campos = $request->validated();
        $producto = $this->productoRepository->create($campos);

        return $this->showOne(new ProductoResource($producto), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        return $this->showOne(new ProductoResource($producto), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(ActualizarProductoRequest $request, Producto $producto)
    {
        $campos = $request->validated();

        $this->categoriaRepository->update($campos, $producto);

        return $this->showOne(new ProductoResource($producto), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {

        $producto->delete();

        return $this->showOne(new ProductoResource($producto), 200);
    }
}
