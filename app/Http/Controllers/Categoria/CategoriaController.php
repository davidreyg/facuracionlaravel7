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
     * @OA\Get(
     *     path="/categorias",
     *     summary="Mostrar categorias",
     *     tags={"categorias"},
     *     @OA\Response(
     *         response="401",
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de categorias. Correcto",
     *     ),
     *     security={
     *         {"bearer": {}}
     *     }
     * )
     */
    public function index()
    {
        $categorias = $this->categoriaRepository->all();

        return $this->showAll(new CategoriaCollection($categorias));
    }

    /**
     * @OA\Post(
     *     path="/categorias",
     *     tags={"categorias"},
     *     operationId="store",
     *     summary="Agregar una nueva categoria.",
     *     @OA\RequestBody(
     *         description="Pet object that needs to be added to the store",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Categoria")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Creado",
     *     ),
     *     security={
     *         {"bearer": {}}
     *     }
     * )
     */
    public function store(CrearCategoriaRequest $request)
    {
        $campos = $request->validated();
        $categoria = $this->categoriaRepository->create($campos);

        return $this->showOne(new CategoriaResource($categoria), 201);
    }

    /**
     * @OA\Get(
     *     path="/categorias/{categoriaId}",
     *     summary="Buscar categoria por ID",
     *     description="Retorna una sola categoria",
     *     operationId="show",
     *     tags={"categorias"},
     *     @OA\Parameter(
     *         description="ID de la categoria a retornar",
     *         in="path",
     *         name="categoriaId",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Categoria")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Categoria no existe"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function show(Categoria $categoria)
    {
        return $this->showOne(new CategoriaResource($categoria), 200);
    }

    /**
     * @OA\Put(
     *     path="/categorias/{categoriaId}",
     *     tags={"categorias"},
     *     operationId="update",
     *     summary="Actualizar una categoria existente",
     *     description="",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Categoria a ser actualizada",
     *         @OA\JsonContent(ref="#/components/schemas/Categoria")
     *     ),
     *     @OA\Parameter(
     *         description="ID de la categoria a actualizar",
     *         in="path",
     *         name="categoriaId",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Categoria no encontrada",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Categoria actualizada correctamente"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function update(ActualizarCategoriaRequest $request, Categoria $categoria)
    {
        $campos = $request->validated();

        $categoria = $this->categoriaRepository->update($campos, $categoria);

        return $this->showOne(new CategoriaResource($categoria), 200);
    }

    /**
     * @OA\Delete(
     *     path="/categorias/{categoriaId}",
     *     summary="Elimina una categoria",
     *     description="",
     *     operationId="delete",
     *     tags={"categorias"},
     *     @OA\Parameter(
     *         description="Id de la categoria a eliminar",
     *         in="path",
     *         name="categoriaId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Categoria no encontrada",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Tiene productos relacionados",
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Categoria eliminada correctamente"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
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
