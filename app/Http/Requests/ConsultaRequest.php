<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ConsultaRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules(Request $request)
    {
        if (Request::route('id')) {
            $validacao = []; 
            if ($request->has('proc_codigo'))
                $validacao = array_merge($validacao, ['proc_codigo'  => 'required|exists:procedimentos,proc_codigo']);

            if ($request->has('med_codigo'))
                $validacao = array_merge($validacao, ['med_codigo'  => 'required|exists:medicos,med_codigo']);

            if ($request->has('pac_codigo'))
                $validacao = array_merge($validacao, ['pac_codigo'  => 'required|exists:pacientes,pac_codigo']);

            if ($request->has('data')) 
                $validacao = array_merge($validacao, ['data'  => 'required']);

            if ($request->has('hora')) 
                $validacao = array_merge($validacao, ['hora'  => 'required']);

            return $validacao;
        }

        return [
            'proc_codigo'   => 'required|exists:procedimentos,proc_codigo',
            'med_codigo'    => 'required|exists:medicos,med_codigo',
            'pac_codigo'    => 'required|exists:pacientes,pac_codigo',
            'data'          => 'required',
            'hora'          => 'required'
        ];
    }

    public function messages()
    {
        return [
            'proc_codigo.required'      => 'Código do Procedimento é obrigatório.',
            'proc_codigo.exists'        => 'Código do procedimento não existe.',
            'med_codigo.required'       => 'Código do Medico é obrigatório.',
            'med_codigo.exists'         => 'Código do Medico não existe.',
            'pac_codigo.required'       => 'Código do Paciente é obrigatório.',
            'pac_codigo.exists'         => 'Código do Paciente não existe.',
            'data.required'             => 'Data é obrigatório.',
            'hora.required'             => 'Hora é obrigatório.'
        ];
    }
}
