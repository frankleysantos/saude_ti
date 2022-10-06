<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EspecialidadeRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules(Request $request)
    {
        return [
            'espec_nome'           => 'required|unique:especialidades',
        ];
    }

    public function messages()
    {
        return [
            'espec_nome.required'        => 'Especialidade é obrigatória.',
            'espec_nome.unique'          => 'Especialidade já cadastrada.',
        ];
    }
}
