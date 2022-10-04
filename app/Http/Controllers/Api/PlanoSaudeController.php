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

    public function store(Request $planoSaudeRequest) 
    {
        $plano = $this->plano->store($planoSaudeRequest); 
        return response()->json($plano);
    }

    public function update($codigo, Request $planoSaudeRequest) 
    {
        $plano = $this->plano->update((int) $codigo, $planoSaudeRequest);      
        return response()->json($plano);
    }

    public function delete($codigo)
    {
        $message = $this->plano->delete($codigo);    
        return response()->json($message);
    }

    public function show()
    {
        $response = $this->plano->getAll();
        return response()->json(new PlanoSaudeCollection($response, ['notPagination' => true]));
    }
}