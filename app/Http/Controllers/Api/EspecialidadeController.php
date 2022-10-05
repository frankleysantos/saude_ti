<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EspecialidadeServices;
use Illuminate\Http\Request;

class EspecialidadeController extends Controller
{
    protected $especialidade;

    public function __construct(EspecialidadeServices $service) {
        $this->middleware('auth:api');
        $this->especialidade = $service;
    }

    /**
     * @OA\Post(
     *   tags={"Especialidade"},
     *   security={{"bearer_token":{}}},
     *   path="/especialidade/store",
     *   summary="Especialidade store",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"espec_nome"},
     *       @OA\Property(property="espec_nome", type="string")
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
    public function store(Request $especialidadeRequest) 
    {
        $especialidade = $this->especialidade->store($especialidadeRequest); 
        return response()->json($especialidade);
    }

    /**
     * @OA\Put(
     *   tags={"Especialidade"},
     *   security={{"bearer_token":{}}},
     *   path="/especialidade/update/{id}",
     *   summary="Especialidade update",
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="espec_nome", type="string")
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
    public function update($codigo, Request $especialidadeRequest) 
    {
        $especialidade = $this->especialidade->update((int) $codigo, $especialidadeRequest);      
        return response()->json($especialidade);
    }

    /**
     * @OA\Delete(
     *   tags={"Especialidade"},
     *   path="/especialidade/delete/{id}",
     *   security={{"bearer_token":{}}},
     *   summary="Especialidade delete",
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
        $message = $this->especialidade->delete($codigo);    
        return response()->json($message);
    }

    /**
     * @OA\Get(
     *   tags={"Especialidade"},
     *   security={{"bearer_token":{}}},
     *   path="/especialidade/show",
     *   summary="Especialidade show",
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *   ),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function show()
    {
        $response = $this->especialidade->getAll();
        return response()->json($response);
    }
}