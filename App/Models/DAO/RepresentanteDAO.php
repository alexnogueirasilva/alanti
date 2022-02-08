<?php 

namespace App\Models\DAO;

use App\Models\Entidades\Representante;


class RepresentanteDAO extends BaseDAO
{
    public function listar($representanteiD = null)
    {
        $sql = "SELECT * FROM cadRepresentante ";
        if($representanteiD){
            $sql .= " WHERE codRepresentante = $representanteiD ";
        }
         $sql .= " ORDER BY nomeRepresentante ASC ";
            $resultado = $this->select($sql);
            
            $dados = $resultado->fetchAll();            
                $lista = [];

                foreach ($dados as $dado) {
                    
                $representante = new Representante();
                
                $representante->setCodRepresentante($dado['codRepresentante']);
                $representante->setDataCadastro($dado['dataCadastro']);
                //date_format($date, 'Y-m-d H:i:s');
                $representante->setNomeRepresentante($dado['nomeRepresentante']);
                             
                    $lista[] = $representante;
                }
                return $lista;
    }

    public function listarRepresentantesLogisticaNfe()
    {
        $sql = "SELECT distinct(r.nomeRepresentante),
        r.codRepresentante, r.statusRepresentante
        FROM crt_logistica as l
        INNER JOIN crt_pedidoerp as pe ON pe.perp_id = l.lgt_fk_erp
        INNER JOIN controlePedido as  p ON p.codControle  = pe.perp_codcontrole
        INNER JOIN cadRepresentante as r ON r.codRepresentante = p.codRepresentante
        ORDER BY r.nomeRepresentante ";
        
            $resultado = $this->select($sql);
            
            $dados = $resultado->fetchAll();            
                $lista = [];

                foreach ($dados as $dado) {
                    $representante = new Representante();
                    $representante->setCodRepresentante($dado['codRepresentante']);
                    $representante->setNomeRepresentante($dado['nomeRepresentante']);
                    $representante->setDataCadastro($dado['dataCadastro']);
                             
                    $lista[] = $representante;
                }
                return $lista;
    }
    public function listarRepresentantePedidoErp()
    {
        $sql = "SELECT distinct(r.nomeRepresentante), r.codRepresentante
        FROM crt_pedidoerp crtperp
        INNER JOIN controlePedido as p ON p.codControle = crtperp.perp_codcontrole
        INNER JOIN cadRepresentante as r ON r.codRepresentante = p.codRepresentante 
        ORDER BY r.nomeRepresentante ";
        
            $resultado = $this->select($sql);
            
            $dados = $resultado->fetchAll();            
                $lista = [];

                foreach ($dados as $dado) {
                    $representante = new Representante();
                    $representante->setCodRepresentante($dado['codRepresentante']);
                    $representante->setNomeRepresentante($dado['nomeRepresentante']);
                    $representante->setDataCadastro($dado['dataCadastro']);
                             
                    $lista[] = $representante;
                }
                return $lista;
    }

    public function salvarRepresentante(Representante $representante)
    {
        try
        {
            $nomeRepresentante     = $representante->getNomeRepresentante();
            return $this->insert(
                'cadRepresentante',
                ":nomeRepresentante",
                [
                    ':nomeRepresentante'=>$nomeRepresentante
                ]
            );
        }catch (\Exception $e){
            throw new \Exception("Erro na gravação dos dados !", 500);
        }
    }

    public function atualizarRepresentante(Representante $representante)
    {
        try
        {
            $codRepresentante       = $representante->getCodRepresentante();
            $nomeRepresentante      = $representante->getNomeRepresentante();
            $statusRepresentante    = $representante->getStatusRepresentante();

            return $this->update(
                'cadRepresentante',
                "nomeRepresentante = :nomeRepresentante , statusRepresentante = :statusRepresentante",
                [
                    ':codRepresentante'     =>$codRepresentante,
                    ':nomeRepresentante'    =>$nomeRepresentante,
                    ':statusRepresentante'  =>$statusRepresentante
                ],
                "codRepresentante = :codRepresentante"
            );
        }catch (\Exception $e){
            throw new \Exception("Erro ao gravar dados", 500);
        }
    }

    public function excluirRepresentante(Representante $representante)
    {
        try
        {
            $codRepresentante = $representante->getCodRepresentante();

            return $this->delete('cadRepresentante', "codRepresentante = $codRepresentante");
        }catch (\Exception $e){
            throw new \Exception("erro ao gravar dados", 500);
        }
    }
}




?>