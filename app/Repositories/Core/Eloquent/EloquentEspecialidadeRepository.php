<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\Especialidade;
use App\Repositories\Contracts\EspecialidadeRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


class EloquentEspecialidadeRepository extends BaseEloquentRepository implements EspecialidadeRepositoryInterface
{
    public function entity() 
    {
        return Especialidade::class;
    }
}