<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PlanoSaudeRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules(Request $request)
    {

        if (Request::route('id')) {
            if ($request->has('plano_descricao'))
                $validacao = ['plano_descricao'       => 'required|unique:plano_saudes'];

            if ($request->has('plano_telefone')) 
                $validacao = array_merge($validacao, ['plano_telefone'  => 'required']);

            return $validacao;
        }

        return [
            'plano_descricao'       => 'required|unique:plano_saudes',
            'plano_telefone'        => 'required'
        ];
    }

    public function messages()
    {
        return [
            'plano_descricao.required'        => 'Nome do plano é obrigatório.',
            'plano_descricao.unique'          => 'Plano de Saúde já esta cadastrado',
            'plano_telefone.required'         => 'Numero de telefone é obrigatório.',
        ];
    }
}
