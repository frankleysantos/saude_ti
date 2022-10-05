<?php
namespace App\Services;

use App\Repositories\Contracts\EspecialidadeRepositoryInterface;
use Illuminate\Http\Request;

class EspecialidadeServices
{
    private $repo;

    public function __construct(EspecialidadeRepositoryInterface $repo)
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
            $especialidade = $request->all();
            $especialidade = $this->repo->store($especialidade);
            return $especialidade;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }

	public function update($codigo, $request)
    {
        try {
            $especialidade = $request->all();
            $especialidadeExiste = $this->repo->getEntity('espec_codigo', $codigo);
            if ($especialidadeExiste) {
                $especialidade = $this->repo->update('espec_codigo', $codigo, new Request($especialidade));
                if( $especialidade == 0)
                    $especialidade = 'Erro ao atualizar especialidade.';
                return $especialidade;
            }
            return 'Especialidade não encontrado.';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

	public function delete($codigo)
    {
        $especialidadeExiste = $this->repo->getEntity('espec_codigo', $codigo);
        if (isset($especialidadeExiste)) {
            $this->repo->delete('espec_codigo', $codigo);
            $message = "Especialidade deletada com sucesso.";
        } else {
            $message = 'Especialidade não existe';
        }
        return $message;
    }
}