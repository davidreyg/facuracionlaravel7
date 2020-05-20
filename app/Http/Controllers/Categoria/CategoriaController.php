<?php

namespace App\Http\Controllers\Categoria;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Repositories\CategoriaRepository;
use Illuminate\Contracts\Validation\Validator;
use App\Http\Resources\Categoria\CategoriaResource;
use App\Http\Resources\Categoria\CategoriaCollection;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Requests\Categoria\CrearCategoriaRequest;
use App\Http\Requests\Producto\ActualizarProductoRequest;
use App\Http\Requests\Categoria\ActualizarCategoriaRequest;

class CategoriaController extends ApiController
{

    /** @var  CategoriaRepository */
    private $categoriaRepository;

    public function __construct(CategoriaRepository $categoriaRepo)
    {
        $this->categoriaRepository = $categoriaRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = $this->categoriaRepository->all();

        return $this->showAll(new CategoriaCollection($categorias));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearCategoriaRequest $request)
    {
        $campos = $request->validated();
        $categoria = $this->categoriaRepository->create($campos);

        return $this->showOne(new CategoriaResource($categoria), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        return $this->showOne(new CategoriaResource($categoria), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActualizarCategoriaRequest $request,Categoria $categoria)
    {
        $campos = $request->validated();

        $categoria = $this->categoriaRepository->update($campos, $categoria);

        return $this->showOne(new CategoriaResource($categoria), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        if ($categoria->productos()->count()) {
            return $this->errorResponse("Esta categoria tiene productos relacionados", 403);
        }

        $categoria->delete();

        return $this->showOne(new CategoriaResource($categoria), 200);
    }
}
