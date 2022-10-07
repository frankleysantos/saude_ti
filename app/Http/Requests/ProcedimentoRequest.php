<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProcedimentoRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules(Request $request)
    {

        if (Request::route('id')) {
            if ($request->has('proc_nome'))
                $validacao = ['proc_nome'       => 'required'];

            if ($request->has('proc_valor')) 
                $validacao = array_merge($validacao, ['proc_valor'  => 'required|numeric']);

            return $validacao;
        }

        return [
            'proc_nome'         => 'required',
            'proc_valor'        => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'proc_nome.required'        => 'Nome do procedimento é obrigatório.',
            'proc_valor.required'   => 'Valor do procedimento é obrigatório.',
            'proc_valor.numeric'   => 'Valor do procedimento deve ser um numero válido.',
        ];
    }
}
