<?php
namespace App\Services;

use App\Repositories\Contracts\PacienteRepositoryInterface;
use Helpers;
use Illuminate\Http\Request;

class PacienteServices
{
    private $repo;

    public function __construct(PacienteRepositoryInterface $repo)
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
            $planoSaude = $request->all();
            $planoSaude['pac_dataNascimento'] = Helpers::formatDate($planoSaude['pac_dataNascimento']);
            $planoSaude = $this->repo->store($planoSaude);
            return $planoSaude;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }

	public function update($codigo, $request)
    {
        try {
            $paciente = $request->all();
            $pacienteExiste = $this->repo->getEntity('pac_codigo', $codigo);
            if ($pacienteExiste) {
                $paciente = $this->repo->update('pac_codigo', $codigo, new Request($paciente));
                if( $paciente == 0)
                    $paciente = 'Erro ao atualizar Paciente.';
                return $paciente;
            }
            return 'Paciente não cadastrado.';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

	public function delete($codigo)
    {
        $planoSaudeExiste = $this->repo->getEntity('pac_codigo', $codigo);
        if (isset($planoSaudeExiste)) {
            $this->repo->delete('pac_codigo', $codigo);
            $message = "Paciente deletado com sucesso.";
        } else {
            $message = 'Paciente não existe';
        }
        return $message;
    }
}