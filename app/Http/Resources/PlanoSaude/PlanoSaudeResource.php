<?php

namespace App\Http\Resources\PlanoSaude;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanoSaudeResource extends JsonResource
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
            'plan_codigo'       => $this->plan_codigo,
            'plano_descricao'   => $this->plano_descricao,
            'plano_telefone'    => $this->plano_telefone,
        ];
    }
}
