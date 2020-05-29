<?php

namespace App\Http\Controllers\TipoDocumento;

use App\Http\Controllers\ApiController;
use App\Http\Requests\TipoDocumento\CrearTipoDocumentoRequest;
use App\Http\Resources\TipoDocumento\TipoDocumentoCollection;
use App\Http\Resources\TipoDocumento\TipoDocumentoResource;
use App\Models\TipoDocumento;
use App\Repositories\TipoDocumentoRepository;
use Illuminate\Http\Request;

class TipoDocumentoController extends ApiController
{

    /** @var  TipoDocumentoRepository */
    private $tipoDocumentoRepository;

    public function __construct(TipoDocumentoRepository $tipoDocRepo)
    {
        $this->tipoDocumentoRepository = $tipoDocRepo;
    }

    /**
     * @OA\Get(
     *     path="/tipo_documentos",
     *     summary="Mostrar tipo de documentos",
     *     tags={"tipo_documentos"},
     *     @OA\Response(
     *         response="401",
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de tipo de documentos. Correcto",
     *     ),
     *     security={
     *         {"bearer": {}}
     *     }
     * )
     */
    public function index()
    {
        $tipodocumentos = $this->tipoDocumentoRepository->all();

        return $this->showAll(new TipoDocumentoCollection($tipodocumentos));
    }

    /**
     * @OA\Post(
     *     path="/tipo_documentos",
     *     tags={"tipo_documentos"},
     *     operationId="store",
     *     summary="Agregar un nuevo tipo de documento(DNI,CARNET DE EXTRANJERIA, CEDULA,ETC).",
     *     @OA\RequestBody(
     *         description="TipoDocumento a ser creado",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/TipoDocumento")
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
    public function store(CrearTipoDocumentoRequest $request)
    {
        $campos = $request->validated();
        $tipoDocumento = $this->tipoDocumentoRepository->create($campos);

        return $this->showOne(new TipoDocumentoResource($tipoDocumento), 201);
    }


    /**
     * @OA\Get(
     *     path="/tipo_documentos/{tipo_documento_id}",
     *     summary="Buscar tipo de documentos por ID",
     *     description="Retorna un solo tipo de documento",
     *     operationId="show",
     *     tags={"tipo_documentos"},
     *     @OA\Parameter(
     *         description="ID del tipo de documento a retornar",
     *         in="path",
     *         name="tipo_documento_id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/TipoDocumento")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="TIpo de documento no existe"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function show(TipoDocumento $tipoDocumento)
    {
        return $this->showOne(new TipoDocumentoResource($tipoDocumento), 200);
    }

    /**
     * @OA\Put(
     *     path="/tipo_documentos/{tipoDocumentoId}",
     *     tags={"tipo_documentos"},
     *     operationId="update",
     *     summary="Actualizar un tipo de documento existente",
     *     description="",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Tipo de documento a ser actualizado",
     *         @OA\JsonContent(ref="#/components/schemas/TipoDocumento")
     *     ),
     *     @OA\Parameter(
     *         description="ID del documento a actualizar",
     *         in="path",
     *         name="tipoDocumentoId",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tipo de documento no encontrada",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Tipo de documento actualizada correctamente"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function update(CrearTipoDocumentoRequest $request, TipoDocumento $tipo_documento)
    {
        $campos = $request->validated();

        $tipo_documento = $this->tipoDocumentoRepository->update($campos, $tipo_documento);

        return $this->showOne(new TipoDocumentoResource($tipo_documento), 200);
    }

    /**
     * @OA\Delete(
     *     path="/tipo_documentos/{tipoDocumentoId}",
     *     summary="Elimina una tipo de documento",
     *     description="",
     *     operationId="delete",
     *     tags={"tipo_documentos"},
     *     @OA\Parameter(
     *         description="Id del tipo de documento a eliminar",
     *         in="path",
     *         name="tipoDocumentoId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tipo de documento no encontrada",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Inserta tu token pues hermano!",
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Tipo de documento eliminada correctamente"
     *     ),
     *     security={
     *       {"bearer": {}}
     *     }
     * )
     */
    public function destroy(TipoDocumento $tipo_documento)
    {
        // if ($tipo_documento->productos()->count()) {
        //     return $this->errorResponse("Esta tipo_$tipo_documento tiene productos relacionados", 403);
        // }

        $tipo_documento->delete();

        return $this->showOne(new TipoDocumentoResource($tipo_documento), 200);
    }
}
