<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\Vinculo;
use App\Repositories\Contracts\VinculoRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


class EloquentVinculoRepository extends BaseEloquentRepository implements VinculoRepositoryInterface
{
    public function entity() 
    {
        return Vinculo::class;
    }
}