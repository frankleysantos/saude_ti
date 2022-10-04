<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\PlanoSaude;
use App\Repositories\Contracts\PlanoSaudeRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;


class EloquentPlanoSaudeRepository extends BaseEloquentRepository implements PlanoSaudeRepositoryInterface
{
    public function entity() 
    {
        return PlanoSaude::class;
    }
}