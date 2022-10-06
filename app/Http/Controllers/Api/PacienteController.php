<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PacienteServices;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    protected $paciente;

    public function __construct(PacienteServices $service) {
        $this->middleware('auth:api');
        $this->paciente = $service;
    }

    /**
     * @OA\Post(
     *   security={{"bearer_token":{}}},
     *   tags={"Paciente"},
     *   path="/paciente/store",
     *   summary="Paciente store",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"pac_nome", "pac_dataNascimento"},
     *       @OA\Property(property="pac_nome", type="string", example="Fulano Pereira dos Santos"),
     *       @OA\Property(property="pac_dataNascimento", type="date", example="16/08/1989")
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
    public function store(Request $pacienteRequest) 
    {
        $paciente = $this->paciente->store($pacienteRequest); 
        return response()->json($paciente);
    }

    /**
     * @OA\Put(
     *   tags={"Paciente"},
     *   security={{"bearer_token":{}}},
     *   path="/paciente/update/{id}",
     *   summary="Paciente update",
     *   @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="pac_nome", type="string", example="Fulano Pereira dos Santos"),
     *       @OA\Property(property="pac_dataNascimento", type="date", example="16/08/1989")
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

    public function update($codigo, Request $pacienteRequest) 
    {
        $paciente = $this->paciente->update((int) $codigo, $pacienteRequest);      
        return response()->json($paciente);
    }

    /**
     * @OA\Delete(
     *   tags={"Paciente"},
     *   path="/paciente/delete/{id}",
     *   security={{"bearer_token":{}}},
     *   summary="Paciente delete",
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
        $message = $this->paciente->delete($codigo);    
        return response()->json($message);
    }

    /**
     * @OA\Get(
     *   tags={"Paciente"},
     *   security={{"bearer_token":{}}},
     *   path="/paciente/show",
     *   summary="Paciente show",
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *   ),
     *   @OA\Response(response=404, description="Not Found")
     * )
     */
    public function show()
    {
        $response = $this->paciente->getAll();
        return response()->json($response);
        // return response()->json(new pacienteSaudeCollection($response, ['notPagination' => true]));
    }
}