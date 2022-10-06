<?php

namespace App\Http\Resources\Especialidade;

use Illuminate\Http\Resources\Json\JsonResource;

class EspecialidadeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [ 
            "especialidade" =>[
                'espec_codigo'      => $this->espec_codigo,
                'espec_nome'        => $this->espec_nome,
            ]
        ];
    }
}
