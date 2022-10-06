<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlanoSaude\PlanoSaudeCollection;
use App\Services\PlanoSaudeServices;
use Illuminate\Http\Request;

class PlanoSaudeController extends Controller
{
    protected $plano;

    public function __construct(PlanoSaudeServices $service) {
        $this->middleware('auth:api');
        $this->plano = $service;
    }

    /**
     * @OA\Post(
     *   tags={"Plano de Saúde"},
     *   security={{"bearer_token":{}}},
     *   path="/plano-saude/store",
     *   summary="Plano de Saúde store",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"plano_descricao", "plano_telefone"},
     *       @OA\Property(property="plano_descricao", type="string", example="Unimed"),
     *       @OA\Property(property="plano_telefone", type="string", example="(33) 3522-1526")
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

    public function store(Request $planoSaudeRequest) 
    {
        $plano = $this->plano->store($planoSaudeRequest); 
        return response()->json($plano);
    }

    /**
     * @OA\Put(
     *   tags={"Plano de Saúde"},
     *   security={{"bearer_token":{}}},
     *   path="/plano-saude/update/{id}",
     *   summary="Plano de Saúde update",
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="plano_descricao", type="string", example="Unimed"),
     *       @OA\Property(property="plano_telefone", type="string", example="(33) 3522-1526")
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
    public function update($codigo, Request $planoSaudeRequest) 
    {
        $plano = $this->plano->update((int) $codigo, $planoSaudeRequest);      
        return response()->json($plano);
    }

    /**
     * @OA\Delete(
     *   tags={"Plano de Saúde"},
     *   path="/plano-saude/delete/{id}",
     *   security={{"bearer_token":{}}},
     *   summary="Plano de Saúde delete",
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
        $message = $this->plano->delete($codigo);    
        return response()->json($message);
    }

    /**
     * @OA\Get(
     *   tags={"Plano de Saúde"},
     *   security={{"bearer_token":{}}},
     *   path="/plano-saude/show",
     *   summary="Plano de Saúde show",
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *   ),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function show()
    {
        $response = $this->plano->getAll();
        return response()->json(new PlanoSaudeCollection($response, ['notPagination' => true]));
    }
}