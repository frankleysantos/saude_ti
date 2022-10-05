<?php
namespace App\Services;

use App\Repositories\Contracts\MedicoRepositoryInterface;
use Illuminate\Http\Request;

class MedicoServices
{
    private $repo;

    public function __construct(MedicoRepositoryInterface $repo)
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
            $medico = $request->all();
            $medico = $this->repo->store($medico);
            return $medico;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }

	public function update($codigo, $request)
    {
        try {
            $medico = $request->all();
            $medicoExiste = $this->repo->getEntity('med_codigo', $codigo);
            if ($medicoExiste) {
                $medico = $this->repo->update('med_codigo', $codigo, new Request($medico));
                if( $medico == 0)
                    $medico = 'Erro ao atualizar medico.';
                return $medico;
            }
            return 'Medico não encontrado.';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

	public function delete($codigo)
    {
        $medicoExiste = $this->repo->getEntity('med_codigo', $codigo);
        if (isset($medicoExiste)) {
            $this->repo->delete('med_codigo', $codigo);
            $message = "Medico deletada com sucesso.";
        } else {
            $message = 'Medico não existe';
        }
        return $message;
    }
}