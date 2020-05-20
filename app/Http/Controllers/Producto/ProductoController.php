<?php

namespace App\Http\Controllers\Producto;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ApiController;
use App\Repositories\ProductoRepository;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\Producto\ProductoResource;
use App\Http\Resources\Producto\ProductoCollection;
use App\Http\Requests\Producto\CrearProductoRequest;
use App\Http\Requests\Producto\ActualizarProductoRequest;
use Dingo\Api\Contract\Http\Request as HttpRequest;

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
        //Store Image
        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            $producto->addMediaFromRequest('imagen')->toMediaCollection();
        }

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
        $this->productoRepository->update($campos, $producto);
        // $nombreImagen = $producto->getMedia()->first()->file_name;

        // if ($nombreImagen == 'default_product_image.png') {
        //     return "me parece raro :v";
        // }

        //Store Image
        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            $producto->media($producto)->forceDelete();
            $producto->addMediaFromRequest('imagen')->toMediaCollection();
        }
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


    public function mostrarImagen(HttpRequest $request)
    {
        // $path = storage_path('app/public/' . $file.'/'.$filename);
        $path = $request;
        return $request->url;
        if (!File::exists($path)) {
            return "asd";
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);

        return $response;
    }
}
