<?php
namespace App\Services;

use App\Repositories\Contracts\PacienteRepositoryInterface;
use App\Repositories\Contracts\PlanoSaudeRepositoryInterface;
use App\Repositories\Contracts\VinculoRepositoryInterface;
use HelpersCuco;
use Illuminate\Http\Request;

class VinculoServices
{
    private $repo;
    private $repoPaciente;
    private $repoPlano;

    public function __construct(VinculoRepositoryInterface $repo, PacienteRepositoryInterface $repoPaciente, PlanoSaudeRepositoryInterface $repoPlano)
    {
       $this->repo = $repo; 
       $this->repoPaciente = $repoPaciente;
       $this->repoPlano = $repoPlano;
    }
    public function getAll()
    {
        return $this->repo->with(['paciente', 'plano'])->get();
    }

    public function store($request)
    {
        try {
            $vinculo = $request->all();
            $paciente = $this->repoPaciente->getEntity('pac_codigo', $request['pac_codigo']);
            if(empty($paciente))
                return 'Paciente não encontrado.';
            $plano = $this->repoPlano->getEntity('plan_codigo', $request['plan_codigo']);
            if(empty($plano))
                return 'Plano não encontrado.';
            $vinculo = $this->repo->store($vinculo);
            return $vinculo;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }

	public function update($codigo, $request)
    {
        try {
            $vinculo = $request->all();
            $vinculoExiste = $this->repo->getEntity('vinculo_codigo', $codigo);
            if ($vinculoExiste) {
                $vinculo = $this->repo->update('vinculo_codigo', $codigo, new Request($vinculo));
                if( $vinculo == 0)
                    $vinculo = 'Erro ao atualizar vinculo.';
                return $vinculo;
            }
            return 'Vinculo não encontrado.';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

	public function delete($codigo)
    {
        $vinculoExiste = $this->repo->getEntity('vinculo_codigo', $codigo);
        if (isset($vinculoExiste)) {
            $this->repo->delete('vinculo_codigo', $codigo);
            $message = "Vinculo deletado com sucesso.";
        } else {
            $message = 'Vinculo não existe';
        }
        return $message;
    }
}