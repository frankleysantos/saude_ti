<?php
namespace App\Services;

use App\Repositories\Contracts\ConsultaRepositoryInterface;
use Helpers;
use Illuminate\Http\Request;

class ConsultaServices
{
    private $repo;

    public function __construct(ConsultaRepositoryInterface $repo)
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
            $consulta = $request->all();
            $consulta['data'] = Helpers::formatDate($consulta['data']);
            $consulta = $this->repo->store($consulta);
            return $consulta;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        
    }

	public function update($codigo, $request)
    {
        try {
            $consulta = $request->all();
            $consultaExiste = $this->repo->getEntity('cons_codigo', $codigo);
            if ($consultaExiste) {
                $consulta = $this->repo->update('cons_codigo', $codigo, new Request($consulta));
                if( $consulta == 0)
                    $consulta = 'Erro ao atualizar consulta.';
                return $consulta;
            }
            return 'Consulta não encontrado.';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

	public function delete($codigo)
    {
        $consultaExiste = $this->repo->getEntity('cons_codigo', $codigo);
        if (isset($consultaExiste)) {
            $this->repo->delete('cons_codigo', $codigo);
            $message = "Consulta deletado com sucesso.";
        } else {
            $message = 'Consulta não existe';
        }
        return $message;
    }
}