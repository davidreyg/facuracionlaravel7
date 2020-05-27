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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente = $this->clienteRepository->all();

        return $this->showAll(new ClienteCollection($cliente));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearClienteRequest $request)
    {
        $campos = $request->validated();
        $cliente = $this->clienteRepository->create($campos);

        return $this->showOne(new ClienteResource($cliente), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return $this->showOne(new ClienteResource($cliente), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(CrearClienteRequest $request, Cliente $cliente)
    {
        $campos = $request->validated();
        $this->clienteRepository->update($campos, $cliente);
        return $this->showOne(new clienteResource($cliente), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return $this->showOne(new ClienteResource($cliente), 200);
    }
}
