<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\Consulta;
use App\Repositories\Contracts\ConsultaRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


class EloquentConsultaRepository extends BaseEloquentRepository implements ConsultaRepositoryInterface
{
    public function entity() 
    {
        return Consulta::class;
    }
}