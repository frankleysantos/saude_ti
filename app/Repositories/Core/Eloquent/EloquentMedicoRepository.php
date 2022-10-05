<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\Medico;
use App\Repositories\Contracts\MedicoRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


class EloquentMedicoRepository extends BaseEloquentRepository implements MedicoRepositoryInterface
{
    public function entity() 
    {
        return Medico::class;
    }
}