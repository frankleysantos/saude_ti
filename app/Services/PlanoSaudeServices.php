<?php
namespace App\Services;

use App\Repositories\Contracts\PlanoSaudeRepositoryInterface;
use Illuminate\Http\Request;

class PlanoSaudeServices
{
    private $repo;

    public function __construct(PlanoSaudeRepositoryInterface $repo)
    {
       $this->repo = $repo; 
    }
    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function getPlano($plan_codigo)
    {

    }

    public function store($request)
    {
        try {
            $planoSaude = $request->all();
            $planoSaude = $this->repo->store($planoSaude);
            return $planoSaude;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }

	public function update($codigo, $request)
    {
        try {
            $planoSaude = $request->all();
            $planoSaudeExiste = $this->repo->getEntity('plan_codigo', $codigo);
            if ($planoSaudeExiste) {
                $planoSaude = $this->repo->update('plan_codigo', $codigo, new Request($planoSaude));
                if( $planoSaude == 0)
                    $planoSaude = 'Erro ao atualizar cliente.';
                return $planoSaude;
            }
            return 'Cliente não cadastrado.';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

	public function delete($codigo)
    {
        $planoSaudeExiste = $this->repo->getEntity('plan_codigo', $codigo);
        if (isset($planoSaudeExiste)) {
            $this->repo->delete('plan_codigo', $codigo);
            $message = "Plano de saúde deletado com sucesso.";
        } else {
            $message = 'Plano não existe';
        }
        return $message;
    }
}