<?php

namespace App\Http\Controllers\Cliente;

use App\Models\Cliente;
use App\Http\Controllers\ApiController;
use App\Repositories\ClienteRepository;
use App\Http\Requests\Cliente\CrearClienteRequest;
use App\Http\Resources\Cliente\ClienteCollection;
use App\Http\Resources\Cliente\ClienteResource;

class ClienteController extends ApiController
{
    /** @var  ClienteRepository */
    private $clienteRepository;

    public function __construct(ClienteRepository $clienteRepo)
    {
        $this->clienteRepository = $clienteRepo;
    }

    /**
     * @OA\Get(
     *     path="/clientes",
     *     summary="Mostrar clientes",
     *     tags={"clientes"},
     *     @OA\Response(
     *         response="401",
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de clientes. Correcto",
     *     ),
     *     security={
     *         {"bearer": {}}
     *     }
     * )
     */
    public function index()
    {
        $cliente = $this->clienteRepository->all();

        return $this->showAll(new ClienteCollection($cliente));
    }

    /**
     * @OA\Post(
     *     path="/clientes",
     *     tags={"clientes"},
     *     operationId="store",
     *     summary="Agrega un nuevo Cliente.",
     *     @OA\RequestBody(
     *         description="Cliente a ser agregado",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Cliente")
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
    public function store(CrearClienteRequest $request)
    {
        $campos = $request->validated();
        $cliente = $this->clienteRepository->create($campos);

        return $this->showOne(new ClienteResource($cliente), 201);
    }

    /**
     * @OA\Get(
     *     path="/clientes/{clienteId}",
     *     summary="Buscar Cliente por ID",
     *     description="Retorna un solo Cliente",
     *     operationId="show",
     *     tags={"clientes"},
     *     @OA\Parameter(
     *         description="ID del cliente a retornar",
     *         in="path",
     *         name="clienteId",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Cliente")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Cliente no existe"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function show(Cliente $cliente)
    {
        return $this->showOne(new ClienteResource($cliente), 200);
    }

    /**
     * @OA\Put(
     *     path="/clientes/{clienteId}",
     *     tags={"clientes"},
     *     operationId="update",
     *     summary="Actualizar un cliente existente",
     *     description="",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Cliente a ser actualizado",
     *         @OA\JsonContent(ref="#/components/schemas/Cliente")
     *     ),
     *     @OA\Parameter(
     *         description="ID del cliente a actualizar",
     *         in="path",
     *         name="clienteId",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cliente no encontrado",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Cliente actualizado correctamente"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function update(CrearClienteRequest $request, Cliente $cliente)
    {
        $campos = $request->validated();
        $this->clienteRepository->update($campos, $cliente);
        return $this->showOne(new clienteResource($cliente), 200);
    }

    /**
     * @OA\Delete(
     *     path="/clientes/{clienteId}",
     *     summary="Elimina un Cliente",
     *     description="",
     *     operationId="delete",
     *     tags={"clientes"},
     *     @OA\Parameter(
     *         description="Id del cliente a eliminar",
     *         in="path",
     *         name="clienteId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cliente no encontrada",
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
     *         description="Cliente eliminado correctamente"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return $this->showOne(new ClienteResource($cliente), 200);
    }
}
