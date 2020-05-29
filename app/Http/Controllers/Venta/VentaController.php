<?php

namespace App\Http\Controllers\Venta;

use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\VentaRepository;
use App\Http\Controllers\ApiController;
use App\Repositories\DetalleVentaRepository;
use App\Http\Resources\Venta\VentaCollection;
use App\Http\Requests\Venta\CrearVentaRequest;


class VentaController extends ApiController
{

    /** @var  ventaRepository */
    private $ventaRepository;

    /** @var  detalleventaRepository */
    private $detalleventaRepository;

    public function __construct(VentaRepository $ventaRepo)
    {
        $this->ventaRepository = $ventaRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $producto = $this->ventaRepository->all();

        return $this->showAll(new VentaCollection($producto));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearVentaRequest $request)
    {
        $camposVenta = $request->except('detalle_venta');
        $camposDetalle = $request->only('detalle_venta')['detalle_venta'];

        DB::beginTransaction();
        try {
            $venta = $this->ventaRepository->create($camposVenta);
            foreach ($camposDetalle as $detalle) {
                $item = new DetalleVenta($detalle);
                $venta->detalle_venta()->create($detalle);
            }
            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }
        return $venta;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
