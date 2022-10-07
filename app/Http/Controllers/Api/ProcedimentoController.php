<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProcedimentoRequest;
use App\Services\ProcedimentoServices;
use Illuminate\Http\Request;

class ProcedimentoController extends Controller
{
    protected $procedimento;

    public function __construct(ProcedimentoServices $service) {
        $this->middleware('auth:api');
        $this->procedimento = $service;
    }

    /**
     * @OA\Post(
     *   tags={"Procedimento"},
     *   security={{"bearer_token":{}}},
     *   path="/procedimento/store",
     *   summary="Procedimento store",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"proc_nome", "proc_valor"},
     *       @OA\Property(property="proc_nome", type="string"),
     *       @OA\Property(property="proc_valor", type="float")
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
    public function store(ProcedimentoRequest $procedimentoRequest) 
    {
        $procedimento = $this->procedimento->store($procedimentoRequest); 
        return response()->json($procedimento);
    }

    /**
     * @OA\Put(
     *   tags={"Procedimento"},
     *   security={{"bearer_token":{}}},
     *   path="/procedimento/update/{id}",
     *   summary="Procedimento update",
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="proc_nome", type="string"),
     *       @OA\Property(property="proc_valor", type="float")
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
    public function update($codigo, ProcedimentoRequest $procedimentoRequest) 
    {
        $procedimento = $this->procedimento->update((int) $codigo, $procedimentoRequest);      
        return response()->json($procedimento);
    }

    /**
     * @OA\Delete(
     *   tags={"Procedimento"},
     *   path="/procedimento/delete/{id}",
     *   security={{"bearer_token":{}}},
     *   summary="Procedimento delete",
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
        $message = $this->procedimento->delete($codigo);    
        return response()->json($message);
    }

    /**
     * @OA\Get(
     *   tags={"Procedimento"},
     *   security={{"bearer_token":{}}},
     *   path="/procedimento/show",
     *   summary="Procedimento show",
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *   ),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function show()
    {
        $response = $this->procedimento->getAll();
        return response()->json($response);
    }
}