<?php

namespace App\Http\Controllers\Venta;

use App\Models\Venta;
use Illuminate\Http\Request;
use App\Repositories\VentaRepository;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Venta\CrearVentaRequest;

class VentaController extends ApiController
{

    /** @var  VentaRepository */
    private $ventaRepository;

    public function __construct(VentaRepository $ventaRepo)
    {
        $this->ventaRepository = $ventaRepo;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearVentaRequest $request)
    {
        return $request;
        DB::transaction(function () {

        });
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
