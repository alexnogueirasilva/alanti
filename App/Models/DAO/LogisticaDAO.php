<?php

namespace App\Models\DAO;

use App\Models\Entidades\ClienteLicitacao;
use App\Models\Entidades\Logistica;
use App\Models\Entidades\LogisticaStatus;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\Representante;
use App\Models\Entidades\Transportadora;
use App\Models\Entidades\Usuario;

use Exception;

class LogisticaDAO extends BaseDAO
{
    public function listar(Logistica $logistica)
    {
        $codigo = $logistica->getLgtId();
        //$status    = $logistica->getLgtStatus();

        $sql = " SELECT l.lgt_id, 
                        l.lgt_nfe, 
                        l.lgt_valorcorrigido, 
                        l.lgt_rota, 
                        l.lgt_datacadastro, 
                        l.lgt_dataalteracao,
                        l.lgt_fk_erp, 
                        l.lgt_fk_transportadora, 
                        l.lgt_fk_statuslogistica, 
                        l.lgt_fk_operador,  l.lgt_valorfrete,
                        l.lgt_anexo,    
                        u.id, 
                        u.nome,
                        u.apelido,
                        u.email, 
                        u.status,
                        pe.perp_id, 
                        pe.perp_codcontrole, 
                        pe.perp_valor, 
                        pe.perp_numeroerp,
                        t.tra_id, 
                        t.tra_nomefantasia, 
                        t.tra_razaosocial, 
                        t.tra_cnpj,
                        c.nomefantasia, 
                        c.razaosocial, 
                        c.licitacaoCliente_cod, 
                        c.tipo, 
                        c.CNPJ
                   FROM crt_logistica as l
                   INNER JOIN usuarios u ON u.id = l.lgt_fk_operador
                   INNER JOIN crt_pedidoerp as pe ON pe.perp_id = l.lgt_fk_erp
                   INNER JOIN controlePedido as  p ON p.codControle  = pe.perp_codcontrole
                   INNER JOIN clienteLicitacao as c ON c.licitacaoCliente_cod = p.codCliente
                   INNER JOIN transportadoras as t ON t.tra_id = l.lgt_fk_transportadora ";

/*        $sql = " SELECT l.lgt_id, l.lgt_nfe, l.lgt_valorcorrigido, l.lgt_rota, l.lgt_datacadastro, l.lgt_fk_erp, l.lgt_infoexcluir, l.lgt_infovalorcorrigido,
        l.lgt_fk_transportadora, l.lgt_fk_statuslogistica, l.lgt_fk_operador, l.lgt_anexo,    
       u.id, u.nome, u.email, u.status,
       pe.perp_id, pe.perp_codcontrole, pe.perp_valor, pe.perp_numeroerp,
       t.tra_id, t.tra_nomefantasia, t.tra_razaosocial, t.tra_cnpj,
       c.nomefantasia, c.razaosocial, c.licitacaoCliente_cod, c.tipo, c.CNPJ,
       r.nomeRepresentante, r.statusRepresentante
       FROM crt_logistica as l
       INNER JOIN usuarios u ON u.id = l.lgt_fk_operador
       INNER JOIN crt_pedidoerp as pe ON pe.perp_id = l.lgt_fk_erp
       INNER JOIN controlePedido as  p ON p.codControle  = pe.perp_codcontrole
       INNER JOIN clienteLicitacao as c ON c.licitacaoCliente_cod = p.codCliente
       INNER JOIN transportadora as t ON t.tra_id = l.lgt_fk_transportadora
       INNER JOIN cadRepresentante as r ON r.codRepresentante = p.codRepresentante ";
*/
        $where = Array();
        if ($codigo) {
            $where[] = " l.lgt_id = {$codigo}";
        }
        // if( $status ){ $where[] = " tra.tra_status = '{$status}'"; }
        if (sizeof($where)) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        } else {
             $sql .= " WHERE l.lgt_fk_statuslogistica  NOT IN ('EXCLUIDO','ENTREGUE') ";
        }
        $resultado = $this->select($sql);
    
           $dados = $resultado->fetchAll();
           $lista = [];
           foreach ($dados as $dado) {
               $logistica = new Logistica();
               $logistica->setLgtId($dado['lgt_id']);
               $logistica->setLgtNfe($dado['lgt_nfe']);
               $logistica->setLgtValorCorrigido(number_format($dado['lgt_valorcorrigido'], 2, ',', '.'));
                $logistica->setLgtValorFrete(number_format($dado['lgt_valorfrete'], 2, ',', '.'));
               $logistica->setLgtRota($dado['lgt_rota']);
               $logistica->setLgtInfoExcluir($dado['lgt_infoexcluir']);
               $logistica->setLgtInfoValorCorrigido($dado['lgt_infovalorcorrigido']);
               $logistica->setLgtDataCadastro($dado['lgt_datacadastro']);
               $logistica->setLgtDataAlteracao($dado['lgt_dataalteracao']);
               $logistica->setFk_Pedido(new Pedido());
               $logistica->getFk_Pedido()->setPerpId($dado['perp_id']);
               $logistica->getFk_Pedido()->setPerpCodControle($dado['perp_codcontrole']);
               $logistica->getFk_Pedido()->setPerpValor(number_format($dado['perp_valor'], 2, ',', '.'));
               $logistica->getFk_Pedido()->setPerpNumero($dado['perp_numeroerp']);
               /*$logistica->setFk_Erp()->setClienteLicitacao(new ClienteLicitacao());
               $logistica->getFk_Cliente()->setCodCliente($dado['licitacaoCliente_cod']);
               $logistica->getFk_Cliente()->setRazaoSocial($dado['razaosocial']);
               $logistica->getFk_Cliente()->setNomeFantasia($dado['nomefantasia']);
               $logistica->getFk_Cliente()->setTipoCliente($dado['tipo']);
               $logistica->getFk_Cliente()->setCnpj($dado['CNPJ']);*/

               $logistica->setFk_Transportadora(new Transportadora());
               $logistica->getFk_Transportadora()->setTraId($dado['tra_id']);
               $logistica->getFk_Transportadora()->setTraCnpj($dado['tra_cnpj']);
               $logistica->getFk_Transportadora()->setTraRazaoSocial($dado['tra_razaosocial']);
               $logistica->getFk_Transportadora()->setTraNomeFantasia($dado['tra_nomefantasia']);
               $logistica->getFk_Transportadora()->setTraId($dado['tra_id']);

               /* $logistica->setFk_StatusLogistica(new LogisticaStatus());
                $logistica->getFk_StatusLogistica()->setSttId($dado['stt_id']);
                $logistica->getFk_StatusLogistica()->setSttNome($dado['stt_nome']);*/
               $logistica->setFk_representante(new Representante());
               $logistica->getFk_representante()->setCodRepresentante($dado['codRepresentante']);
               $logistica->getFk_representante()->setNomeRepresentante($dado['nomeRepresentante']);

               $logistica->setFk_Operador(new Usuario());
               $logistica->getFk_Operador()->setId($dado['id']);
               $logistica->getFk_Operador()->setNome($dado['nome']);
               $logistica->getFk_Operador()->setApelido($dado['apelido']);
               $logistica->getFk_Operador()->setEmail($dado['email']);
               $logistica->getFk_Operador()->setStatus($dado['status']);

               $lista[] = $logistica;
            }
          
            return $lista; 

    }
     public function entregues()
    {        
        $sql = " SELECT COUNT(l.lgt_id) AS Entregues
        FROM crt_logistica as l       
        WHERE l.lgt_fk_statuslogistica  IN ('ENTREGUE') ";
                
           $resultado = $this->select($sql);
    
           $dados = $resultado->fetch();
                     
            return $dados; 
    }
    public function pendentes()
    {
        $sql = " SELECT COUNT(l.lgt_id) AS Pendentes
        FROM crt_logistica as l       
        WHERE l.lgt_fk_statuslogistica  NOT IN ('ENTREGUE', 'EXCLUIDO') ";
                
           $resultado = $this->select($sql);
    
           $dados = $resultado->fetch();
                     
            return $dados;
    }
    public function indexLogistica(Logistica $logistica)
    {
        $codigo             = $logistica->getLgtId();
        $status             = $logistica->getCodStatus();
        $codRepresentante   = $logistica->getCodRepresentante();
        $codCliente         = $logistica->getCodCliente();
        $codTransportadora  = $logistica->getCodTransportadora();
        $nfe                = $logistica->getLgtNfe();
       if(!empty($status)){
            $status = implode("','", $status);
        }
        $sql = " SELECT l.lgt_id, l.lgt_nfe, l.lgt_valorcorrigido, l.lgt_rota, l.lgt_datacadastro, l.lgt_dataalteracao,l.lgt_fk_erp, l.lgt_infoexcluir, l.lgt_infovalorcorrigido,
        l.lgt_fk_transportadora, l.lgt_fk_statuslogistica, l.lgt_fk_operador, l.lgt_valorfrete, l.lgt_anexo,    
       u.id, u.nome, u.apelido, u.email, u.status, p.numeroAf, p.codControle,
       pe.perp_id, pe.perp_codcontrole, pe.perp_valor, pe.perp_numeroerp,p.fk_idInstituicao,
       t.tra_id, t.tra_nomefantasia, t.tra_razaosocial, t.tra_cnpj,
       c.nomefantasia, c.razaosocial, c.licitacaoCliente_cod, c.tipo, c.CNPJ,
       r.codRepresentante, r.nomeRepresentante, r.statusRepresentante
       FROM crt_logistica as l
       INNER JOIN usuarios u ON u.id = l.lgt_fk_operador
       INNER JOIN crt_pedidoerp as pe ON pe.perp_id = l.lgt_fk_erp
       INNER JOIN controlePedido as  p ON p.codControle  = pe.perp_codcontrole
       INNER JOIN clienteLicitacao as c ON c.licitacaoCliente_cod = p.codCliente
       INNER JOIN transportadoras as t ON t.tra_id = l.lgt_fk_transportadora
       INNER JOIN cadRepresentante as r ON r.codRepresentante = p.codRepresentante ";

        $where = Array();
        
       if( $codigo ){ $where[] = " l.lgt_id = {$codigo}"; }
       if( $status ){ $where[] = " l.lgt_fk_statuslogistica IN ('{$status}')"; }
       if( $codCliente ){ $where[] = " c.licitacaoCliente_cod = {$codCliente}"; }
       if( $codTransportadora ){ $where[] = " t.tra_id = {$codTransportadora}"; }
       if( $codRepresentante ){ $where[] = " r.codRepresentante = {$codRepresentante}"; }
       if( $nfe ){ $where[] = " l.lgt_nfe = '{$nfe}'"; }        
        if (sizeof($where)) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        } else {
            $sql .= " WHERE l.lgt_fk_statuslogistica  NOT IN ('EXCLUIDO','ENTREGUE') ";
        }        
           $resultado = $this->select($sql);
    
           $dados = $resultado->fetchAll();
           $lista = [];
           foreach ($dados as $dado) {
               $logistica = new Logistica();
               $logistica->setLgtId($dado['lgt_id']);
               $logistica->setLgtNfe($dado['lgt_nfe']);
               $logistica->setLgtValorCorrigido(number_format($dado['lgt_valorcorrigido'], 2, ',', '.'));
               $logistica->setLgtValorFrete(number_format($dado['lgt_valorfrete'], 2, ',', '.'));
               $logistica->setLgtRota($dado['lgt_rota']);
               $logistica->setLgtInfoExcluir($dado['lgt_infoexcluir']);
               $logistica->setLgtInfoValorCorrigido($dado['lgt_infovalorcorrigido']);
               $logistica->setLgtAnexo($dado['lgt_anexo']);
               $logistica->setLgtDataCadastro($dado['lgt_datacadastro']);
               $logistica->setLgtDataAlteracao($dado['lgt_dataalteracao']);

               /* $logistica->setFk_Erp($dado['lgt_fk_erp']);
                $logistica->getFk_Erp()->setPerpId($dado['perp_id']);
                $logistica->getFk_Erp()->setPerpCodControle($dado['perp_codcontrole']);
                $logistica->getFk_Erp()->setPerpValor(number_format($dado['perp_valor'], 2, ',', '.'));
                $logistica->getFk_Erp()->setPerpNumero($dado['perp_numeroerp']);*/
               /*$logistica->setFk_Cliente(new ClienteLicitacao());*/
               $logistica->getClienteLicitacao()->setCodCliente($dados['licitacaoCliente_cod']);
               $logistica->getClienteLicitacao()->setRazaoSocial($dados['razaosocial']);
               $logistica->getClienteLicitacao()->setNomeFantasia($dados['nomefantasia']);
               $logistica->getClienteLicitacao()->setTipoCliente($dados['tipo']);
               $logistica->getClienteLicitacao()->setCnpj($dados['CNPJ']);
             
               $logistica->setFk_Pedido(new Pedido());
               $logistica->getFk_Pedido()->setNumeroAF($dado['numeroAf']);
               $logistica->getFk_Pedido()->setPerpId($dado['perp_id']);
               $logistica->getFk_Pedido()->setPerpCodControle($dado['perp_codcontrole']);
               $logistica->getFk_Pedido()->setPerpValor(number_format($dado['perp_valor'], 2, ',', '.'));
               $logistica->getFk_Pedido()->setPerpNumero($dado['perp_numeroerp']);
               $logistica->getFk_Pedido()->setCodCliente($dado['licitacaoCliente_cod']);
               $logistica->getFk_Pedido()->setFk_instituicao($dado['fk_idInstituicao']);
               $logistica->getFk_Pedido()->setClienteLicitacao(new ClienteLicitacao());
               $logistica->getFk_Pedido()->getClienteLicitacao()->setCodCliente($dado['licitacaoCliente_cod']);
               $logistica->getFk_Pedido()->getClienteLicitacao()->setRazaoSocial($dado['razaosocial']);
               $logistica->getFk_Pedido()->getClienteLicitacao()->setNomeFantasia($dado['nomefantasia']);
               $logistica->getFk_Pedido()->getClienteLicitacao()->setTipoCliente($dado['tipo']);
               $logistica->getFk_Pedido()->getClienteLicitacao()->setCnpj($dado['CNPJ']);

               $logistica->setFk_Transportadora(new Transportadora());
               $logistica->getFk_Transportadora()->setTraId($dado['tra_id']);
               $logistica->getFk_Transportadora()->setTraCnpj($dado['tra_cnpj']);
               $logistica->getFk_Transportadora()->setTraRazaoSocial($dado['tra_razaosocial']);
               $logistica->getFk_Transportadora()->setTraNomeFantasia($dado['tra_nomefantasia']);
               $logistica->getFk_Transportadora()->setTraId($dado['tra_id']);

               /* $logistica->setFk_StatusLogistica(new LogisticaStatus());
                $logistica->getFk_StatusLogistica()->setSttId($dado['stt_id']);
                $logistica->getFk_StatusLogistica()->setSttNome($dado['stt_nome']);*/
               $logistica->setFk_representante(new Representante());
               $logistica->getFk_representante()->setCodRepresentante($dado['codRepresentante']);
               $logistica->getFk_representante()->setNomeRepresentante($dado['nomeRepresentante']);

               $logistica->setFk_StatusLogistica($dado['lgt_fk_statuslogistica']);
              /* $logistica->setFk_StatusLogistica(new LogisticaStatus());
               $logistica->getFk_StatusLogistica()->setSttId($dado['stt_id']);
               $logistica->getFk_StatusLogistica()->setSttNome($dado['stt_nome']);*/
               $logistica->getFk_Pedido()->setRepresentante(new Representante());
               $logistica->getFk_Pedido()->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
               $logistica->getFk_Pedido()->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
               $logistica->getFk_Pedido()->getRepresentante()->setStatusRepresentante($dado['statusRepresentante']);

               $logistica->setFk_Operador(new Usuario());
               $logistica->getFk_Operador()->setId($dado['id']);
               $logistica->getFk_Operador()->setNome($dado['nome']);
               $logistica->getFk_Operador()->setApelido($dado['apelido']);
               $logistica->getFk_Operador()->setEmail($dado['email']);
               $logistica->getFk_Operador()->setStatus($dado['status']);

               $lista[] = $logistica;
            }
          
            return $lista; 

    }
    public function salvar(Logistica $logistica)
    {
        try {
            $nfe            = $logistica->getLgtNfe();
            $valor          = str_replace(',','.', str_replace(".", "", $logistica->getLgtValorCorrigido()));
            $valorFrete     = str_replace(',','.', str_replace(".", "", $logistica->getLgtValorFrete()));
            $rota           = $logistica->getLgtRota();
            $excluir        = $logistica->getLgtInfoExcluir();
            $valorCorrigido = $logistica->getLgtInfoValorCorrigido();
            $anexo          = $logistica->getLgtAnexo();
            $numeroErp      = $logistica->getFk_Pedido()->getPerpId();
            $transportadora = $logistica->getFk_Transportadora()->getTraId();           
            $status         = $logistica->getFk_StatusLogistica();
            $operador       = $logistica->getFk_Operador()->getId();
            $nomeAnexo      = $this->anexo($anexo);
            return $this->insert(
                'crt_logistica',
                "
                :lgt_nfe, :lgt_valorcorrigido, :lgt_rota, :lgt_infoexcluir, :lgt_infovalorcorrigido, :lgt_valorfrete, :lgt_anexo, :lgt_fk_erp, 
                :lgt_fk_transportadora, :lgt_fk_statuslogistica, :lgt_fk_operador, :lgt_dataalteracao
                ",
                [
                    ':lgt_nfe'                  => $nfe,
                    ':lgt_valorcorrigido'       => $valor,
                     ':lgt_valorfrete'       => $valorFrete,
                    ':lgt_rota'                 => $rota,
                    ':lgt_infoexcluir'          => $excluir,
                    ':lgt_infovalorcorrigido'   => $valorCorrigido,
                    ':lgt_anexo'                => $nomeAnexo,
                    ':lgt_fk_erp'               => $numeroErp,
                    ':lgt_fk_transportadora'    => $transportadora,
                    ':lgt_fk_statuslogistica'   => $status,
                    ':lgt_fk_operador'          => $operador,
                    ':lgt_dataalteracao'        => date('Y-m-d H:m:s')
                    ]
                ); 
        } catch (\Exception $e) {
          // echo '<pre>';
           //var_dump($e);
            throw new \Exception("Erro na gravação de dados. " , 500);
        }

    }
    public function atualizar(Logistica $logistica)
    {
        try {                  
            $codigo         = $logistica->getLgtId();
            $nfe            = $logistica->getLgtNfe();
            $valor          = str_replace(',','.', str_replace(".", "", $logistica->getLgtValorCorrigido()));
            $valorFrete     = str_replace(',','.', str_replace(".", "", $logistica->getLgtValorFrete()));
            $rota           = $logistica->getLgtRota();
            $excluir        = $logistica->getLgtInfoExcluir();
            $valorCorrigido = $logistica->getLgtInfoValorCorrigido();
            $anexo          = $logistica->getLgtAnexo();
            $numeroErp      = $logistica->getFk_Pedido()->getPerpId();
            $transportadora = $logistica->getFk_Transportadora()->getTraId();           
            $status         = $logistica->getFk_StatusLogistica();
            $operador       = $logistica->getFk_Operador()->getId();
            $nomeAnexo      = $this->anexo($anexo);             
             
            return $this->update(
                'crt_logistica',
            " lgt_nfe                   = :nfe, 
              lgt_valorcorrigido        = :valor, 
               lgt_valorfrete            = :valorFrete,
              lgt_rota                  = :rota, 
              lgt_infoexcluir           = :excluir, 
              lgt_infovalorcorrigido    = :valorCorrigido, 
              lgt_anexo                 = :anexo, 
              lgt_fk_erp                = :numeroErp, 
              lgt_fk_transportadora     = :transportadora, 
              lgt_fk_statuslogistica    = :status, 
              lgt_fk_operador           = :operador, 
              lgt_dataalteracao         = :data ",
                 [
                    ':codigo'           => $codigo,
                    ':nfe'              => $nfe,
                    ':valor'            => $valor,
                    ':valorFrete'            => $valorFrete,
                    ':rota'             => $rota,
                    ':excluir'          => $excluir,
                    ':valorCorrigido'   => $valorCorrigido,      
                    ':anexo'            => $nomeAnexo,
                    ':numeroErp'        => $numeroErp,
                    ':transportadora'   => $transportadora,
                    ':status'           => $status,
                    ':operador'         => $operador,
                    ':data'             => date('Y-m-d H:m:s'),
                ],
                " lgt_id = :codigo"
                );  
        } catch (\Exception $e) {
           
            //var_dump($e);
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }

    }
    public function excluir(Logistica $logistica)
    {
        try {
            $codigo = $logistica->getLgtId();
            return $this->delete('crt_logistica', "lgt_id = $codigo");
        } catch (Exception $e) {
            throw new \Exception("Erro ao excluir! ", 500);
        }

    }
    public function anexo($anexo)
    {
                $nomeanexo = date('Y-m-d-h:m:s');

            if (!$_FILES['anexoLogistica']['name'] == "") {
                $validextensions = array("jpeg", "jpg", "png", "PNG", "JPG", "JPEG", "pdf", "PDF", "docx");
                $temporary = explode(".", $_FILES["anexoLogistica"]["name"]);
                $file_extension = end($temporary);
                $anexo = md5($nomeanexo) . "." . $file_extension;

                if (in_array($file_extension, $validextensions)) {
                    $sourcePath = $_FILES['anexoLogistica']['tmp_name'];
                    $targetPath = "public/assets/media/anexos/" . md5($nomeanexo) . "." . $file_extension;
                    move_uploaded_file($sourcePath, $targetPath); // Move arquivo                    
                }
            } else {
                if($anexo == ""){
                    $anexo = "sem_anexo1.png";
                    }
            } 
            return $anexo;
    }

}