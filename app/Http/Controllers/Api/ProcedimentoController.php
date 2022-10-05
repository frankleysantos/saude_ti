<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProcedimentoServices;
use Illuminate\Http\Request;

class ProcedimentoController extends Controller
{
    protected $plano;

    public function __construct(ProcedimentoServices $service) {
        $this->middleware('auth:api');
        $this->procedimento = $service;
    }

    public function store(Request $procedimentoRequest) 
    {
        $procedimento = $this->procedimento->store($procedimentoRequest); 
        return response()->json($procedimento);
    }

    public function update($codigo, Request $procedimentoRequest) 
    {
        $procedimento = $this->procedimento->update((int) $codigo, $procedimentoRequest);      
        return response()->json($procedimento);
    }

    public function delete($codigo)
    {
        $message = $this->procedimento->delete($codigo);    
        return response()->json($message);
    }

    public function show()
    {
        $response = $this->procedimento->getAll();
        return response()->json($response);
    }
}