<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vinculo extends Model
{
    use HasFactory;

    protected $fillable = ['pac_codigo', 'plan_codigo', 'nr_contrato'];

    public function Paciente()
    {
        return $this->hasOne(Paciente::class, 'pac_codigo', 'pac_codigo');
    }

    public function Plano()
    {
        return $this->hasOne(PlanoSaude::class, 'plan_codigo', 'plan_codigo');
    }
}
