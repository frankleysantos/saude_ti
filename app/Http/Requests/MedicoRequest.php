<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MedicoRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules(Request $request)
    {
        if (Request::route('id')) {
            if ($request->has('med_crm'))
                $validacao = ['med_crm'       => 'required|unique:medicos'];
            
            if ($request->has('espec_codigo'))
                $validacao = array_merge($validacao, ['espec_codigo'  => 'required|exists:especialidades,espec_codigo']);

            if ($request->has('med_nome')) 
                $validacao = array_merge($validacao, ['med_nome'  => 'required']);

            return $validacao;
        }

        return [
            'espec_codigo'  => 'required|exists:especialidades,espec_codigo',
            'med_crm'       => 'required|unique:medicos',
            'med_nome'      => 'required'
        ];
    }

    public function messages()
    {
        return [
            'med_crm.required'        => 'CRM é obrigatório.',
            'med_crm.unique'          => 'CRM já cadastrado.',
            'espec_codigo.required'   => 'espec_codigo é obrigatório.',
            'espec_codigo.exists'     => 'Código de especialidade não existe.',
            'med_nome.required'       => 'Nome do medico é obrigatório.'
        ];
    }
}
