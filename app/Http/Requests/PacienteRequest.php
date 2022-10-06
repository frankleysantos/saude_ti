<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PacienteRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules(Request $request)
    {

        if (Request::route('id')) {
            if ($request->has('pac_nome'))
                $validacao = ['pac_nome'       => 'required'];

            if ($request->has('pac_dataNascimento')) 
                $validacao = array_merge($validacao, ['pac_dataNascimento'  => 'required']);

            return $validacao;
        }

        return [
            'pac_nome'                  => 'required',
            'pac_dataNascimento'        => 'required'
        ];
    }

    public function messages()
    {
        return [
            'pac_nome.required'        => 'Nome do paciente é obrigatório.',
            'pac_dataNascimento.required'   => 'Data de nascimento é obrigatório.',
        ];
    }
}
