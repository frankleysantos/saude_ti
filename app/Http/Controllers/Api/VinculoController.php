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

    public function store(Request $vinculoRequest) 
    {
        $vinculo = $this->vinculo->store($vinculoRequest); 
        return response()->json($vinculo);
    }

    public function update($codigo, Request $vinculoRequest) 
    {
        $vinculo = $this->vinculo->update((int) $codigo, $vinculoRequest);      
        return response()->json($vinculo);
    }

    public function delete($codigo)
    {
        $message = $this->vinculo->delete($codigo);    
        return response()->json($message);
    }

    public function show()
    {
        $response = $this->vinculo->getAll();
        return response()->json($response);
    }
}