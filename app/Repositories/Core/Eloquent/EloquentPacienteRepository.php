<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\Paciente;
use App\Repositories\Contracts\PacienteRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


class EloquentPacienteRepository extends BaseEloquentRepository implements PacienteRepositoryInterface
{
    public function entity() 
    {
        return Paciente::class;
    }
}