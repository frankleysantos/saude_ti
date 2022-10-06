<?php

namespace App\Http\Resources\Consulta;

use Illuminate\Http\Resources\Json\JsonResource;

class ConsultaResource extends JsonResource
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
            "consulta" => [
                "cons_codigo"               => $this->cons_codigo,
                "data"                      => $this->data, 
                "hora"                      => $this->hora, 
                "particular"                => $this->particular,
                "paciente" => [
                    "pac_nome"              => $this->paciente['pac_nome'],
                    "pac_dataNascimento"    => $this->paciente['pac_dataNascimento'],
                ],
                "medico" => [
                    "med_crm"               => $this->medico['med_crm'],
                    "med_nome"              => $this->medico['med_nome'],
                ],
                "procedimento" => [
                    "proc_nome"             => $this->procedimento['proc_nome'],
                    "proc_valor"            => $this->procedimento['proc_valor']
                ]
            ]
        ];
    }
}
