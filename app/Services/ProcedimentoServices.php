<?php
namespace App\Services;

use App\Repositories\Contracts\ProcedimentoRepositoryInterface;
use Illuminate\Http\Request;

class ProcedimentoServices
{
    private $repo;

    public function __construct(ProcedimentoRepositoryInterface $repo)
    {
       $this->repo = $repo; 
    }
    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function store($request)
    {
        try {
            $procedimento = $request->all();
            $procedimento = $this->repo->store($procedimento);
            return $procedimento;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }

	public function update($codigo, $request)
    {
        try {
            $procedimento = $request->all();
            $procedimentoExiste = $this->repo->getEntity('proc_codigo', $codigo);
            if ($procedimentoExiste) {
                $procedimento = $this->repo->update('proc_codigo', $codigo, new Request($procedimento));
                if( $procedimento == 0)
                    $procedimento = 'Erro ao atualizar procedimento.';
                return $procedimento;
            }
            return 'procedimento não encontrado.';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

	public function delete($codigo)
    {
        $procedimentoExiste = $this->repo->getEntity('proc_codigo', $codigo);
        if (isset($procedimentoExiste)) {
            $this->repo->delete('proc_codigo', $codigo);
            $message = "Procedimento deletado com sucesso.";
        } else {
            $message = 'Procedimento não existe';
        }
        return $message;
    }
}