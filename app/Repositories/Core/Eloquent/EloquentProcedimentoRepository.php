<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\Procedimento;
use App\Repositories\Contracts\ProcedimentoRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


class EloquentProcedimentoRepository extends BaseEloquentRepository implements ProcedimentoRepositoryInterface
{
    public function entity() 
    {
        return Procedimento::class;
    }
}