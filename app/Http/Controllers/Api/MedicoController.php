<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\MedicoServices;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    protected $medico;

    public function __construct(MedicoServices $service) {
        $this->middleware('auth:api');
        $this->medico = $service;
    }

    /**
     * @OA\Post(
     *   tags={"Medico"},
     *   security={{"bearer_token":{}}},
     *   path="/medico/store",
     *   summary="Medico store",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"espec_codigo", "med_crm", "med_nome"},
     *       @OA\Property(property="espec_codigo", type="integer"),
     *       @OA\Property(property="med_crm", type="string"),
     *       @OA\Property(property="med_nome", type="string")
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
    public function store(Request $medicoRequest) 
    {
        $medico = $this->medico->store($medicoRequest); 
        return response()->json($medico);
    }

    /**
     * @OA\Put(
     *   tags={"Medico"},
     *   security={{"bearer_token":{}}},
     *   path="/medico/update/{id}",
     *   summary="Medico update",
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="espec_codigo", type="integer"),
     *       @OA\Property(property="med_crm", type="string"),
     *       @OA\Property(property="med_nome", type="string")
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
    public function update($codigo, Request $medicoRequest) 
    {
        $medico = $this->medico->update((int) $codigo, $medicoRequest);      
        return response()->json($medico);
    }

    /**
     * @OA\Delete(
     *   tags={"Medico"},
     *   path="/medico/delete/{id}",
     *   security={{"bearer_token":{}}},
     *   summary="Medico delete",
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
        $message = $this->medico->delete($codigo);    
        return response()->json($message);
    }

    /**
     * @OA\Get(
     *   tags={"Medico"},
     *   security={{"bearer_token":{}}},
     *   path="/medico/show",
     *   summary="Medico show",
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *   ),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function show()
    {
        $response = $this->medico->getAll();
        return response()->json($response);
    }
}