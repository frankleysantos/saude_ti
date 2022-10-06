<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlanoSaude\PlanoSaudeCollection;
use App\Services\VinculoServices;
use Illuminate\Http\Request;

class VinculoController extends Controller
{
    protected $vinculo;

    public function __construct(VinculoServices $service) {
        $this->middleware('auth:api');
        $this->vinculo = $service;
    }

    /**
     * @OA\Post(
     *   tags={"Vinculo"},
     *   security={{"bearer_token":{}}},
     *   path="/vinculo/store",
     *   summary="Vinculo store",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"pac_codigo", "plan_codigo", "nr_contrato"},
     *       @OA\Property(property="pac_codigo", type="number"),
     *       @OA\Property(property="plan_codigo", type="number"),
     *       @OA\Property(property="nr_contrato", type="string", example="148956")
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
    public function store(Request $vinculoRequest) 
    {
        $vinculo = $this->vinculo->store($vinculoRequest); 
        return response()->json($vinculo);
    }

    /**
     * @OA\Put(
     *   tags={"Vinculo"},
     *   security={{"bearer_token":{}}},
     *   path="/vinculo/update/{id}",
     *   summary="Vinculo update",
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
     *       @OA\Property(property="plan_codigo", type="number"),
     *       @OA\Property(property="nr_contrato", type="string", example="148956")
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
    public function update($codigo, Request $vinculoRequest) 
    {
        $vinculo = $this->vinculo->update((int) $codigo, $vinculoRequest);      
        return response()->json($vinculo);
    }

    /**
     * @OA\Delete(
     *   tags={"Vinculo"},
     *   path="/vinculo/delete/{id}",
     *   security={{"bearer_token":{}}},
     *   summary="Vinculo delete",
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
        $message = $this->vinculo->delete($codigo);    
        return response()->json($message);
    }

    /**
     * @OA\Get(
     *   tags={"Vinculo"},
     *   security={{"bearer_token":{}}},
     *   path="/vinculo/show",
     *   summary="Vinculo show",
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *   ),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function show()
    {
        $response = $this->vinculo->getAll();
        return response()->json($response);
    }
}