<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;
    protected $fillable = ['cons_codigo', 'pac_codigo', 'proc_codigo', 'med_codigo', 'data', 'hora', 'particular'];

    public function Paciente()
    {
        return $this->hasOne(Paciente::class, 'pac_codigo', 'pac_codigo');
    }

    public function Medico()
    {
        return $this->hasOne(Medico::class, 'med_codigo', 'med_codigo');
    }

    public function Procedimento()
    {
        return $this->hasOne(Procedimento::class, 'proc_codigo', 'proc_codigo');
    }

}
