<?php 

namespace App\Models\DAO;

use App\Models\Entidades\ClienteLicitacao;
use App\Models\Entidades\PedidoErp;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\Representante;
use App\Models\Entidades\Status;
use App\Models\Entidades\Usuario;
use Exception;

class PedidoErpDAO extends BaseDAO
{
    public  function listar(Pedido $pedidoErp)
    {             
        $usuario            = $pedidoErp->getPerpUsuario();     
        $codPedidoErp       = $pedidoErp->getPerpId();
        $codControle        = $pedidoErp->getPerpCodControle();      
        $numero             = $pedidoErp->getPerpNumero();              
        $codRepresentante   = $pedidoErp->getCodRepresentante();      
        
        
        $sql = " SELECT crtperp.perp_id,
                            crtperp.perp_codcontrole,
                            crtperp.perp_dataalteracao,
                            crtperp.perp_datacadastro,
                            crtperp.perp_numeroerp,
                            crtperp.perp_usuario,
                            crtperp.perp_valor,
                            crtperp.perp_status,
                            u.id,
                            u.nome as nomeUsuario,
                            u.nivel,
                            u.email, 
                            r.codRepresentante,
                            r.nomeRepresentante, 
                            p.numeroPregao, 
                            p.numeroAf, 
                            p.valorPedido, 
                            c.razaosocial, 
                            c.nomefantasia, 
                            s.codStatus, 
                            s.nome
                            FROM crt_pedidoerp crtperp
                            INNER JOIN usuarios as u ON u.id = crtperp.perp_usuario
                            INNER JOIN controlePedido as p ON p.codControle = crtperp.perp_codcontrole
                            INNER JOIN statusPedido as s ON s.codStatus = p.codStatus
                            INNER JOIN cadRepresentante as r ON r.codRepresentante = p.codRepresentante
                            INNER JOIN clienteLicitacao as c ON c.licitacaoCliente_cod = p.codCliente ";
             $where = Array();
             if( $codControle){ $where[] = " crtperp.perp_codcontrole = {$codControle}"; }
             if( $codPedidoErp ){ $where[] = " crtperp.perp_id = {$codPedidoErp}"; }
             if( $usuario ){ $where[] = " crtperp.perp_usuario = '{$usuario}'"; }
             if( $numero ){ $where[] = " crtperp.perp_numeroerp = '{$numero}'"; }   
             if( $codRepresentante ){ $where[] = " r.codRepresentante = {$codRepresentante}"; }
          
          if( sizeof( $where ) )
          $sql .= ' WHERE '.implode( ' AND ',$where );
          $sql.= ' ORDER BY crtperp.perp_id DESC';
          $resultado = $this->select($sql);
         print_r($numero);
          $dados = $resultado->fetchAll();
          $lista = [];
          foreach ($dados as $dado) { 
            
        $pedidoErp = new Pedido();
        $pedidoErp->setPerpId($dado['perp_id']);
        $pedidoErp->setPerpNumero($dado['perp_numeroerp']);
        $pedidoErp->setPerpValor(number_format($dado['perp_valor'], 2, ',', '.'));
        $pedidoErp->setPerpUsuario($dado['perp_usuario']);
        $pedidoErp->setPerpDataCadastro($dado['perp_datacadastro']);
        $pedidoErp->setPerpDataAlteracao($dado['perp_dataalteracao']);
        $pedidoErp->setPerpCodControle($dado['perp_codcontrole']);
        $pedidoErp->setPerpStatus($dado['perp_status']);
        $pedidoErp->setNumeroAF($dado['numeroAf']);
        $pedidoErp->setValorPedido($dado['valorPedido']);
        $pedidoErp->setPerpUsuario(new Usuario());
        $pedidoErp->getPerpUsuario()->setId($dado['id']);
        $pedidoErp->getPerpUsuario()->setNome($dado['nomeUsuario']);
        $pedidoErp->getPerpUsuario()->setNivel($dado['nivel']);
        $pedidoErp->getPerpUsuario()->setEmail($dado['email']);
        $pedidoErp->setRepresentante(new Representante());
        $pedidoErp->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
        $pedidoErp->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
        $pedidoErp->setClienteLicitacao(new ClienteLicitacao());
        $pedidoErp->getClienteLicitacao()->setCodCliente($dado['licitacaoCliente_cod']);
        $pedidoErp->getClienteLicitacao()->setNomeFantasia($dado['nomefantasia']);
        $pedidoErp->getClienteLicitacao()->setRazaoSocial($dado['razaosocial']);
        $pedidoErp->setStatus(new Status());
        $pedidoErp->getStatus()->setCodStatus($dado['codStatus']);
        $pedidoErp->getStatus()->setNome($dado['nome']);

            $lista[] = $pedidoErp;
        }     
           
        return $lista;
      //    return $resultado->fetchAll(\PDO::FETCH_CLASS, Notificacao::class);   
                
    }

     public  function listarPedidoUnico($numePedido)
    {    
        $numero   = $numePedido;        
        $sql = " SELECT perp_id, perp_codcontrole, perp_numeroerp
                 FROM crt_pedidoerp ";

             $where = Array();
            
             if( $numero ){ $where[] = " perp_numeroerp = '{$numero}'"; }               
          
          if( sizeof( $where ) )
          $sql .= ' WHERE '.implode( ' AND ',$where );
          $sql.= ' ORDER BY perp_id DESC';
          $resultado = $this->select($sql);
        
          $dados = $resultado->fetchAll();
          $lista = [];
          if($dados){
            foreach ($dados as $dado) { 
            
                $pedidoErp = new Pedido();
                $pedidoErp->setPerpId($dado['perp_id']);
                $pedidoErp->setPerpNumero($dado['perp_numeroerp']);
                $pedidoErp->setPerpCodControle($dado['perp_codcontrole']);
    
                $lista[] = $pedidoErp;
            }
                return $lista;
          }else{
              return false;
          }
    }

    public  function listarAtendidos(Pedido $pedidoErp)
    {             
        $usuario            = $pedidoErp->getPerpUsuario();     
        $codPedidoErp       = $pedidoErp->getPerpId();
        $codControle        = $pedidoErp->getPerpCodControle();      
        $codCliente         = $pedidoErp->getCodCliente();
        $numero             = $pedidoErp->getPerpNumero();              
        $codRepresentante   = $pedidoErp->getCodRepresentante();
        $status             = $pedidoErp->getPerpStatus();
        $codStatus          = $pedidoErp->getCodStatus();
            
        $sql = " SELECT crtperp.perp_id,
                            crtperp.perp_codcontrole,
                            crtperp.perp_dataalteracao,
                            crtperp.perp_datacadastro,
                            crtperp.perp_numeroerp,
                            crtperp.perp_status,
                            crtperp.perp_usuario,
                            crtperp.perp_valor,
                            u.id,
                            u.nome as nomeUsuario,
                            u.nivel,
                            u.email, 
                            r.codRepresentante,
                            r.nomeRepresentante, 
                            p.numeroPregao, 
                            p.numeroAf, 
                            p.valorPedido, 
                            c.razaosocial, 
                            c.nomefantasia, 
                            s.codStatus,
                            s.nome
                            FROM crt_pedidoerp crtperp
                            INNER JOIN usuarios as u ON u.id = crtperp.perp_usuario
                            INNER JOIN controlePedido as p ON p.codControle = crtperp.perp_codcontrole
                            INNER JOIN statusPedido as s ON s.codStatus = p.codStatus
                            INNER JOIN cadRepresentante as r ON r.codRepresentante = p.codRepresentante
                            INNER JOIN clienteLicitacao as c ON c.licitacaoCliente_cod = p.codCliente ";
             $where = Array();
                if(!empty($codStatus)){
                    $codStatus = implode(",",$codStatus);
                }       
                if(!empty($status)){
                    $status = implode(",",$status);
                } 
             if( $codControle){ $where[] = " crtperp.perp_codcontrole = {$codControle}"; }
             if( $codPedidoErp ){ $where[] = " crtperp.perp_id = {$codPedidoErp}"; }
             if( $usuario ){ $where[] = " crtperp.perp_usuario = '{$usuario}'"; }
             if( $status ){ $where[] = " crtperp.perp_status in ('{$status}')"; }
             if( $codCliente ){ $where[] = " c.licitacaoCliente_cod = {$codCliente}"; }
             if( $numero ){ $where[] = " crtperp.perp_numeroerp = '{$numero}'"; }   
             if( $codRepresentante ){ $where[] = " r.codRepresentante = {$codRepresentante}"; }
             if($codStatus ){ $where[] = " s.codStatus in ('{$codStatus}')"; }
          
          if( sizeof( $where ) ){
                $sql .= ' WHERE '.implode( ' AND ',$where );
           }else {
               $sql .= " WHERE crtperp.perp_status IN ('ATENDIDO') ORDER BY c.razaosocial desc ";
           }

          $resultado = $this->select($sql);
         
          $dados = $resultado->fetchAll();
          $lista = [];
          foreach ($dados as $dado) { 
            
        $pedidoErp = new Pedido();
        $pedidoErp->setPerpId($dado['perp_id']);
        $pedidoErp->setPerpNumero($dado['perp_numeroerp']);
        $pedidoErp->setPerpValor(number_format($dado['perp_valor'], 2, ',', '.'));
        $pedidoErp->setPerpUsuario($dado['perp_usuario']);
        $pedidoErp->setPerpDataCadastro($dado['perp_datacadastro']);
        $pedidoErp->setPerpDataAlteracao($dado['perp_dataalteracao']);
        $pedidoErp->setPerpCodControle($dado['perp_codcontrole']);
        $pedidoErp->setPerpStatus($dado['perp_status']);
        $pedidoErp->setNumeroAF($dado['numeroAf']);
        $pedidoErp->setValorPedido($dado['valorPedido']);
        $pedidoErp->setPerpUsuario(new Usuario());
        $pedidoErp->getPerpUsuario()->setId($dado['id']);
        $pedidoErp->getPerpUsuario()->setNome($dado['nomeUsuario']);
        $pedidoErp->getPerpUsuario()->setNivel($dado['nivel']);
        $pedidoErp->getPerpUsuario()->setEmail($dado['email']);
        $pedidoErp->setRepresentante(new Representante());
        $pedidoErp->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
        $pedidoErp->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
        $pedidoErp->setClienteLicitacao(new ClienteLicitacao());
        $pedidoErp->getClienteLicitacao()->setCodCliente($dado['licitacaoCliente_cod']);
        $pedidoErp->getClienteLicitacao()->setNomeFantasia($dado['nomefantasia']);
        $pedidoErp->getClienteLicitacao()->setRazaoSocial($dado['razaosocial']);
        $pedidoErp->setStatus(new Status());
        $pedidoErp->getStatus()->setCodStatus($dado['codStatus']);
        $pedidoErp->getStatus()->setNome($dado['nome']);

            $lista[] = $pedidoErp;
        }     
           
        return $lista;
      //    return $resultado->fetchAll(\PDO::FETCH_CLASS, Notificacao::class);   
                
    }

    public  function listarStatusPedidoErp() 
    {
        $resultado = $this->select(
            "SELECT distinct(crtperp.perp_status)
            FROM crt_pedidoerp crtperp
            INNER JOIN controlePedido as p ON p.codControle = crtperp.perp_codcontrole ORDER BY crtperp.perp_status "
            );
        $dados = $resultado->fetchAll();
        
        if ($dados) {
           
            $lista = [];

            foreach ($dados as $dado) {
            $pedidoErp = new Pedido();
            $pedidoErp->setPerpStatus($dado['perp_status']);

                $lista[] = $pedidoErp;
            }           
            return $lista;
        }

        return false;
    }

    public  function salvar(PedidoErp $pedidoErp)
    {
        try {            
            $perpNumero       = $pedidoErp->getPerpNumero();
            $perpValor        = str_replace(',','.', str_replace(".", "", $pedidoErp->getPerpValor())); 
            $codControle      = $pedidoErp->getPerpCodControle(); 
            $perpUsuario      = $pedidoErp->getPerpUsuario();
            $perpStatus       = $pedidoErp->getPerpStatus();
                           
        return $this->insert(
            'crt_pedidoerp',
           ":perp_numeroerp,
            :perp_status,
            :perp_valor,
            :perp_dataalteracao,
            :perp_datacadastro,
            :perp_codcontrole,
            :perp_usuario",
            [                
                ':perp_numeroerp'      => $perpNumero,
                ':perp_valor'          => $perpValor,
                ':perp_status'         => $perpStatus,
                ':perp_datacadastro'   => date('Y-m-d H:i:s'),
                ':perp_dataalteracao'  => date('Y-m-d H:i:s'),
                ':perp_codcontrole'    => $codControle,
                ':perp_usuario'        => $perpUsuario
            ]
            );
        } catch (\Exception $e) {
            //var_dump($e);
            throw new \Exception("Erro na gravação de dados. " . $e, 500);
        }
    }

    public function alterar(PedidoErp $pedidoErp)
    {        
        try {       
            $perpId           = $pedidoErp->getPerpId();
            $perpNumero       = $pedidoErp->getPerpNumero();
            $perpStatus       = $pedidoErp->getPerpStatus();
            $perpValor        = str_replace(',','.', str_replace(".", "", $pedidoErp->getPerpValor())); 
            $perpUsuario      = $pedidoErp->getPerpUsuario();
            $codControle      = $pedidoErp->getPerpCodControle();            
            return $this->update(
                'crt_pedidoerp',
                "
                    perp_numeroerp      =:perNumero,
                    perp_valor          =:perpValor,
                    perp_status         =:perpStatus,
                    perp_dataalteracao  =:dataAlteracao,
                    perp_codcontrole    =:codControle,
                    perp_usuario        =:usuario",
                [
                    ':perpId'         => $perpId,
                    ':perNumero'      => $perpNumero,
                    ':perpValor'      => $perpValor,
                    ':perpStatus'      => $perpStatus,
                    ':dataAlteracao'  => date('Y-m-d H:i:s'),
                    ':codControle'    => $codControle,
                    ':usuario'        => $perpUsuario,
                ],
                "perp_id = :perpId"
            );          
        } catch (\Exception $e) {            
            var_dump($e);
             throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }

    public function excluir(PedidoErp $pedidoErp)
    {
        try {
            $codPedido = $pedidoErp->getPerpId();

            return $this->delete('crt_pedidoerp', "perp_id = $codPedido");
        } catch (Exception $e) {

            throw new \Exception("Erro ao excluir cadastro! ", 500);
        }
    }

    public function excluirPorPedido(Pedido $pedidoErp)
    {       
        try {
            $codPedido = $pedidoErp->getCodControle();
           return $this->delete('crt_pedidoerp', "perp_codcontrole = $codPedido");
        } catch (Exception $e) {

            throw new \Exception("Erro ao excluir cadastro! ", 500);
        }
    }
}

?>