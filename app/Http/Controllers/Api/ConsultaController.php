<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Consulta\ConsultaCollection;
use App\Services\ConsultaServices;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConsultaController extends Controller
{
    protected $consulta;

    public function __construct(ConsultaServices $service) {
        $this->middleware('auth:api');
        $this->consulta = $service;
    }

    /**
     * @OA\Post(
     *   tags={"Consulta"},
     *   security={{"bearer_token":{}}},
     *   path="/consulta/store",
     *   summary="Consulta store",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"pac_codigo", "proc_codigo", "med_codigo", "data", "hora", "particular"},
     *       @OA\Property(property="pac_codigo", type="number"),
     *       @OA\Property(property="proc_codigo", type="number"),
     *       @OA\Property(property="med_codigo", type="number"),
     *       @OA\Property(property="data", type="date", example="05/06/2022"),
     *       @OA\Property(property="hora", type="string", example="11:34"),
     *       @OA\Property(property="particular", type="string", example="Nao")
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="OK",
     *   ),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function store(Request $consultaRequest) 
    {
        $consulta = $this->consulta->store($consultaRequest); 
        return response()->json($consulta, Response::HTTP_CREATED);
    }

    /**
     * @OA\Put(
     *   tags={"Consulta"},
     *   security={{"bearer_token":{}}},
     *   path="/consulta/update/{id}",
     *   summary="Consulta update",
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="pac_codigo", type="number"),
     *       @OA\Property(property="proc_codigo", type="number"),
     *       @OA\Property(property="med_codigo", type="number"),
     *       @OA\Property(property="data", type="date", example="05/06/2022"),
     *       @OA\Property(property="hora", type="string", example="11:34"),
     *       @OA\Property(property="particular", type="string", example="Nao")
     *     )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *   ),
     *   @OA\Response(response=404, description="Not Found"),
     *   @OA\Response(response=422, description="Unprocessable Entity")
     * )
     */
    public function update($codigo, Request $consultaRequest) 
    {
        $consulta = $this->consulta->update((int) $codigo, $consultaRequest);      
        return response()->json($consulta, Response::HTTP_OK);
    }

    /**
     * @OA\Delete(
     *   tags={"Consulta"},
     *   path="/consulta/delete/{id}",
     *   security={{"bearer_token":{}}},
     *   summary="Consulta delete",
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *   ),
     *   @OA\Response(response=200, description="OK"),
     *   @OA\Response(response=401, description="Unauthorized"),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function delete($codigo)
    {
        $message = $this->consulta->delete($codigo);    
        return response()->json($message, Response::HTTP_OK);
    }

    /**
     * @OA\Get(
     *   tags={"Consulta"},
     *   security={{"bearer_token":{}}},
     *   path="/consulta/show",
     *   summary="Consulta show",
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *   ),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function show()
    {
        $response = $this->consulta->getAll();
        return response()->json(new ConsultaCollection($response, ['notPagination' => true]), Response::HTTP_OK);
    }
}