<?php

namespace App\Models\DAO;

use App\Models\Entidades\Pedido;
use App\Models\Entidades\ClienteLicitacao;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Representante;
use App\Models\Entidades\Status;
use App\Models\Entidades\Usuario;
use Exception;

class PedidoDAO extends BaseDAO
{
    public function listarTeste($codControle = null)
    {
       //  $codControle    = $pedido->getCodControle();

        if ($codControle) {
            $resultado = $this->select(
                "SELECT con.codControle,
                       con.dataFechamento,
                       con.dataCadastro,
                       con.fk_idInstituicao,
                       con.dataAlteracao,
                       con.valorPedido,
                       con.anexo,
                       con.numeroAf,
                       con.numeroPregao,
                       cp.perp_numeroerp,
                       con.observacao,
                       con.codCliente as idCliente,
                       con.codRepresentante as idRepresentante,
                       con.codStatus as idStatus,
                       c.licitacaoCliente_cod,
                       c.tipo,c.razaosocial,
                       c.nomefaNtasia,c.CNPJ,
                       r.codRepresentante,r.nomeRepresentante,r.statusRepresentante,
                       i.inst_id,
                       i.inst_nome,
                       s.codStatus,
                       s.nome as nomeStatus,
                       u.id,u.nome,u.email,u.nivel
                        FROM controlePedido AS con
                         INNER JOIN statusPedido AS s on s.codStatus = con.codStatus
                         INNER JOIN cadRepresentante AS r on r.codRepresentante = con.codRepresentante
                         INNER JOIN clienteLicitacao AS c on c.licitacaoCliente_cod = con.codCliente
                         INNER JOIN instituicao AS i on i.inst_id = con.fk_idInstituicao
                         INNER JOIN crt_pedidoerp cp on con.codControle = cp.perp_codcontrole
                         INNER JOIN usuarios AS u on u.id = con.fk_idUsuarioPed = $codControle "
            );
            $dados = $resultado->fetchAll();

            if ($dados) {

                $lista = [];

                foreach ($dados as $dado) {
                    $pedido = new Pedido();
                    $pedido->setCodControle($dado['codControle']);
                    $pedido->setDataCadastro($dado['dataCadastro']);
                    //date_format($date, 'Y-m-d H:i:s');
                    $pedido->setNumeroLicitacao($dado['numeroPregao']);
                    $pedido->setNumeroAf($dado['numeroAf']);
                    $pedido->setValorPedido(number_format($dado['valorPedido'], 2, ',', '.'));
                    $pedido->setCodStatus($dado['idStatus']);
                    $pedido->setCodCliente($dado['idCliente']);
                    $pedido->setAnexo($dado['anexo']);
                    $pedido->setObservacao($dado['observacao']);
                    $pedido->setCodRepresentante($dado['idRepresentante']);
                    //$pedido->setFk_Instituicao($dado['fk_idInstituicao']);
                    $pedido->setDataFechamento($dado['dataFechamento']);
                    $pedido->setDataAlteracao($dado['dataAlteracao']);
                    $pedido->getCliente()->setCodCliente($dado['codCliente']);
                    $pedido->getCliente()->setNomeCliente($dado['nomeCliente']);
                    $pedido->getCliente()->setTipoCliente($dado['tipoCliente']);
                    $pedido->getCliente()->setStatus($dado['statusCliente']);
                    $pedido->setStatus(new Status());
                    $pedido->getStatus()->setNome($dado['nomeStatus']);
                    $pedido->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
                    $pedido->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
                    $pedido->getRepresentante()->setStatusRepresentante($dado['statusRepresentante']);
                    $pedido->getInstituicao()->setInst_Nome($dado['inst_nome']);
                    $lista[] = $pedido;
                }
                return $lista;
                print json_encode($lista);
          
            }
        } else {
            $resultado = $this->select(
                "SELECT con.codControle,con.dataFechamento,con.dataCadastro,con.dataAlteracao,con.valorPedido,s.nome,con.anexo, con.numeroAf, con.numeroPregao,con.observacao,con.codCliente as idCliente,con.codRepresentante as idRepresentante, con.codStatus as idStatus
               ,c.codCliente,c.tipoCliente,c.nomeCliente,c.status AS statusCliente
               ,r.codRepresentante,r.nomeRepresentante,r.statusRepresentante
               ,i.inst_nome,s.nome as nomeStatus
                u.id,u.nome,u.email,u.nivel
               FROM controlePedido AS con 
				INNER JOIN statusPedido AS s on s.codStatus = con.codStatus
                INNER JOIN cadRepresentante AS r on r.codRepresentante = con.codRepresentante
                INNER JOIN cliente AS c on c.codCliente = con.codCliente
                INNER JOIN instituicao AS i on i.inst_id = con.fk_idInstituicao
                INNER JOIN usuarios AS u on u.id = con.fk_idUsuarioPed
                ORDER BY c.nomeCliente ASC"
            );
            $dados = $resultado->fetchAll();

            if ($dados) {

                $lista = [];

                foreach ($dados as $dado) {
                    $pedido = new Pedido();
                    $pedido->setCodControle($dado['codControle']);
                    $pedido->setDataCadastro($dado['dataCadastro']);
                    //date_format($date, 'Y-m-d H:i:s');
                    $pedido->setNumeroLicitacao($dado['numeroPregao']);
                    $pedido->setNumeroAf($dado['numeroAf']);
                    $pedido->setValorPedido(number_format($dado['valorPedido'], 2, ',', '.'));
                    $pedido->setCodStatus($dado['idStatus']);
                    $pedido->setCodCliente($dado['idCliente']);
                    $pedido->setAnexo($dado['anexo']);
                    $pedido->setObservacao($dado['observacao']);
                    $pedido->setCodRepresentante($dado['idRepresentante']);
                    //$pedido->setFk_Instituicao($dado['fk_idInstituicao']);
                    $pedido->setDataFechamento($dado['dataFechamento']);
                    $pedido->setDataAlteracao($dado['dataAlteracao']);
                    $pedido->getCliente()->setCodCliente($dado['codCliente']);
                    $pedido->getCliente()->setNomeCliente($dado['nomeCliente']);
                    $pedido->getCliente()->setTipoCliente($dado['tipoCliente']);
                    $pedido->getCliente()->setStatus($dado['statusCliente']);
                    $pedido->setStatus(new Status());
                    $pedido->getStatus()->setNome($dado['nomeStatus']);
                    $pedido->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
                    $pedido->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
                    $pedido->getRepresentante()->setStatusRepresentante($dado['statusRepresentante']);
                    $pedido->getInstituicao()->setInst_Nome($dado['inst_nome']);
                    $lista[] = $pedido;
                }
                return $lista;
            }
        }
        return false;
    }

    public function listar(Pedido $pedido)
    { 
        $codCliente         = $pedido->getCodCliente();
        $nomefantasia       = $pedido->getNomeFantasia();
        $codRepresentante   = $pedido->getCodRepresentante();
        $codControle        = $pedido->getCodControle();
        $numeropedido       = $pedido->getNumeroAF();
        $codStatus          = $pedido->getCodStatus();
        $numeroLicitacao    = $pedido->getNumeroLicitacao();
        $tipo               = $pedido->getTipoCliente();
        if(!empty($tipo)){
            $tipo = implode("','", $tipo);
        }
            $sql =
                "SELECT con.codControle,con.dataFechamento,con.dataCadastro,con.fk_idInstituicao,con.dataAlteracao,con.valorPedido,con.anexo, con.numeroAf, con.numeroPregao,con.observacao,con.codCliente as idCliente,con.codRepresentante as idRepresentante, con.codStatus as idStatus
                ,c.licitacaoCliente_cod,c.tipo,c.razaosocial, c.nomefantasia,c.CNPJ
                ,r.codRepresentante,r.nomeRepresentante,r.statusRepresentante
                ,i.inst_id,i.inst_nome, i.inst_nomeFantasia, s.codStatus,s.nome as nomeStatus,
                u.id,u.apelido,u.nome,u.email,u.nivel
                FROM controlePedido AS con 
                 INNER JOIN statusPedido AS s on s.codStatus = con.codStatus
                 INNER JOIN cadRepresentante AS r on r.codRepresentante = con.codRepresentante
                 INNER JOIN clienteLicitacao AS c on c.licitacaoCliente_cod = con.codCliente
                 INNER JOIN instituicao AS i on i.inst_id = con.fk_idInstituicao
                 INNER JOIN usuarios AS u on u.id = con.fk_idUsuarioPed
                ";
             $where = Array();
             if( $codControle ){ $where[] = " con.codControle = {$codControle}"; }
             if( $codCliente ){ $where[] = " c.licitacaoCliente_cod = {$codCliente}"; }
             if( $codRepresentante ){ $where[] = " r.codRepresentante = {$codRepresentante}"; }
             if( $codStatus ){ $where[] = " s.codStatus = {$codStatus}"; }
            if( $numeropedido ){ $where[] = " con.numeroAf LIKE '%{$numeropedido}%' "; }
              if( $nomefantasia ){ $where[] = " c.nomefantasia LIKE '%{$nomefantasia}%' "; }
             if( $numeroLicitacao ){ $where[] = " con.numeroPregao = '{$numeroLicitacao}'"; }
             if( $tipo ){ $where[] = " c.tipo in ('{$tipo}')"; }
                // $where[] = " s.nome  not in  ('ATENDIDO','CANCELADO') ";
              if( sizeof( $where ) ){
                 $sql .= ' WHERE '.implode( ' AND ',$where );
                }else {
                    $sql .= " WHERE s.nome  not in  ('ATENDIDO','CANCELADO') ORDER BY s.nome ASC ";
                }
          $resultado = $this->select($sql);
         
            $dados = $resultado->fetchAll();
            $lista = [];
                foreach ($dados as $dado) {
                    $pedido = new Pedido();
                    $pedido->setCodControle($dado['codControle']);
                    $pedido->setDataCadastro($dado['dataCadastro']);
                    $pedido->setDataAlteracao($dado['dataAlteracao']);
                    //date_format($date, 'Y-m-d H:i:s');
                    $pedido->setNumeroLicitacao($dado['numeroPregao']);
                    $pedido->setNumeroAf($dado['numeroAf']);
                    $pedido->setValorPedido(number_format($dado['valorPedido'], 2, ',', '.'));
                    $pedido->setCodStatus($dado['idStatus']);
                    $pedido->setSomaPedido($dado['valorPedido']);
                    $pedido->setAnexo($dado['anexo']);
                    $pedido->setObservacao($dado['observacao']);
                    $pedido->setDataFechamento($dado['dataFechamento']);
                    $pedido->setDataAlteracao($dado['dataAlteracao']);
                    $pedido->setClienteLicitacao(new ClienteLicitacao());
                    $pedido->getClienteLicitacao()->setCodCliente($dado['licitacaoCliente_cod']);
                    $pedido->getClienteLicitacao()->setRazaoSocial($dado['razaosocial']);
                    $pedido->getClienteLicitacao()->setCnpj($dado['CNPJ']);
                    $pedido->getClienteLicitacao()->setNomeFantasia($dado['nomefantasia']);      
                    $pedido->getClienteLicitacao()->setTipoCliente($dado['tipo']);
                    $pedido->getClienteLicitacao()->setTrocaMarca($dado['trocamarca']);
                    $pedido->setStatus(new Status());
                    $pedido->getStatus()->setCodStatus($dado['codStatus']);
                    $pedido->getStatus()->setNome($dado['nomeStatus']);
                    $pedido->setRepresentante(new Representante());
                    $pedido->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
                    $pedido->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
                    $pedido->getRepresentante()->setStatusRepresentante($dado['statusRepresentante']);
                    $pedido->setInstituicao(new Instituicao());
                    $pedido->getInstituicao()->setInst_Id($dado['inst_id']);
                    $pedido->getInstituicao()->setInst_Codigo($dado['inst_codigo']);
                    $pedido->getInstituicao()->setInst_Nome($dado['inst_nome']);
                    $pedido->getInstituicao()->setInst_NomeFantasia($dado['inst_nomeFantasia']);
                    $pedido->setUsuario(new Usuario());
                    $pedido->getUsuario()->setId($dado['id']);
                    $pedido->getUsuario()->setNome($dado['nome']);
                    $pedido->getUsuario()->setApelido($dado['apelido']);
                    $pedido->getUsuario()->setEmail($dado['email']);

                    $lista[] = $pedido;
                }
                return $lista;
    }
    
     public function pedidosAutorizados()
    { 
       
            $sql =
                "SELECT COUNT(con.codControle) AS PedidoAutorizados
                FROM controlePedido AS con 
                 INNER JOIN statusPedido AS s on s.codStatus = con.codStatus                                  
                 INNER JOIN instituicao AS i on i.inst_id = con.fk_idInstituicao
                 INNER JOIN usuarios AS u on u.id = con.fk_idUsuarioPed
                WHERE s.nome  in  ('ATENDIDO PARCIAL','AUTORIZADO')";
                
          $resultado = $this->select($sql);
        
            $dados = $resultado->fetch();
            
                return $dados;
    }
    
    public function pedidoNaoAutorizados()
    { 
       
            $sql =
                "SELECT COUNT(con.codControle) AS PedidoNaoAutorizados                
                FROM controlePedido AS con 
                 INNER JOIN statusPedido AS s on s.codStatus = con.codStatus                                  
                 INNER JOIN instituicao AS i on i.inst_id = con.fk_idInstituicao
                 INNER JOIN usuarios AS u on u.id = con.fk_idUsuarioPed
                WHERE s.nome  not in  ('ATENDIDO','CANCELADO','ATENDIDO PARCIAL','AUTORIZADO')";
                
          $resultado = $this->select($sql);
        
            $dados = $resultado->fetch();
            
                return $dados;
    }
    
    
    public function qtdePedidoClientes()
    {
       $sql ="  SELECT R.licitacaoCliente_cod,R.razaosocial, R.qtdePedidos FROM (
            SELECT DISTINCT c.razaosocial, c.licitacaoCliente_cod,
            (SELECT COUNT(con.numeroAf) AS qtde
            FROM controlePedido AS con 
            WHERE c.licitacaoCliente_cod = con.codCliente AND con.fk_idInstituicao = 3  AND c.tipo IN ('Estadual','Federal','Estadual')
            ) as qtdePedidos
            FROM clienteLicitacao as c ) AS R
             WHERE R.qtdePedidos > 0
             ORDER BY R.qtdePedidos DESC |";
              $resultado = $this->select($sql);
         
              $dados = $resultado->fetchAll();
              $lista = [];
                foreach ($dados as $dado) {
                    $pedido = new Pedido();
                    $pedido->setCodControle($dado['qtdePedidos']);
                    $pedido->setClienteLicitacao(new ClienteLicitacao());
                    $pedido->getClienteLicitacao()->setCodCliente($dado['licitacaoCliente_cod']);
                    $pedido->getClienteLicitacao()->setRazaoSocial($dado['razaosocial']);

                    $lista[] = $pedido;
                }
                return $lista;
    }
    public function listarAtendidos($codControle = null)
    {

        if ($codControle) {
            $resultado = $this->select(
                "SELECT con.codControle,CON.dataFechamento,con.dataCadastro,con.dataAlteracao,con.valorPedido,s.nome,c.tipoCliente,c.nomeCliente,con.anexo, con.numeroAf, con.numeroPregao,con.observacao,con.codCliente as idCliente,con.codRepresentante as idRepresentante, con.codStatus as idStatus
                FROM controlePedido AS con 
                 INNER JOIN statusPedido AS s on s.codStatus = con.codStatus
                 INNER JOIN cadRepresentante AS r on r.codRepresentante = con.codRepresentante
                 INNER JOIN cliente AS c on c.codCliente = con.codCliente
                 INNER JOIN instituicao AS i on i.inst_id = con.fk_idInstituicao
                 WHERE con.codControle = $codControle "
            );
            $dado = $resultado->fetch();

            if ($dado) {

                $pedido = new Pedido();

                $pedido->setCodControle($dado['codControle']);
                $pedido->setDataCadastro($dado['dataCadastro']);
                //date_format($date, 'Y-m-d H:i:s');
                $pedido->setNumeroLicitacao($dado['numeroPregao']);
                $pedido->setNumeroAf($dado['numeroAf']);
                $pedido->setValorPedido(number_format($dado['valorPedido'], 2, ',', '.'));
                $pedido->setCodStatus($dado['idStatus']);
                $pedido->setAnexo($dado['anexo']);
                $pedido->setObservacao($dado['observacao']);
                $pedido->setCodRepresentante($dado['idRepresentante']);
                //        $pedido->setFk_Instituicao($dado['fk_idInstituicao']);
                $pedido->setDataFechamento($dado['dataFechamento']);
                $pedido->setDataAlteracao($dado['dataAlteracao']);
                $pedido->getCliente()->setNomeCliente($dado['nomeCliente']);
                $pedido->getCliente()->setTipoCliente($dado['tipoCliente']);
                $pedido->getStatus()->setNome($dado['nome']);
                $pedido->setInstituicao(new Instituicao());
                    $pedido->getInstituicao()->setInst_Id($dado['inst_id']);

                    $pedido->getInstituicao()->setInst_Nome($dado['inst_nome']);

                return $pedido;
            }
        } else {

            $resultado = $this->select(
                "SELECT con.codControle,con.dataFechamento,con.dataCadastro,con.dataAlteracao,con.valorPedido,s.nome,con.anexo, con.numeroAf, con.numeroPregao,con.observacao,con.codCliente as idCliente,con.codRepresentante as idRepresentante, con.codStatus as idStatus
               ,c.tipoCliente,c.nomeCliente,c.status AS statusCliente
               ,r.nomeRepresentante,r.statusRepresentante
               ,i.inst_nome
               FROM controlePedido AS con 
				INNER JOIN statusPedido AS s on s.codStatus = con.codStatus
                INNER JOIN cadRepresentante AS r on r.codRepresentante = con.codRepresentante
                INNER JOIN cliente AS c on c.codCliente = con.codCliente
                INNER JOIN instituicao AS i on i.inst_id = con.fk_idInstituicao
                WHERE s.nome in  ('ATENDIDO')
                ORDER BY c.nomeCliente ASC"
            );
            $dados = $resultado->fetchAll();

            if ($dados) {

                $lista = [];

                foreach ($dados as $dado) {
                    $pedido = new Pedido();
                    $pedido->setCodControle($dado['codControle']);
                    $pedido->setDataCadastro($dado['dataCadastro']);
                    //date_format($date, 'Y-m-d H:i:s');
                    $pedido->setNumeroLicitacao($dado['numeroPregao']);
                    $pedido->setNumeroAf($dado['numeroAf']);
                    $pedido->setValorPedido(number_format($dado['valorPedido'], 2, ',', '.'));
                    $pedido->setCodStatus($dado['idStatus']);
                    $pedido->setCodCliente($dado['idCliente']);
                    $pedido->setAnexo($dado['anexo']);
                    $pedido->setObservacao($dado['observacao']);
                    $pedido->setCodRepresentante($dado['idRepresentante']);
                    //        $pedido->setFk_Instituicao($dado['fk_idInstituicao']);
                    $pedido->setDataFechamento($dado['dataFechamento']);
                    $pedido->setDataAlteracao($dado['dataAlteracao']);
                    $pedido->getCliente()->setNomeCliente($dado['nomeCliente']);
                    $pedido->getCliente()->setTipoCliente($dado['tipoCliente']);
                    $pedido->getCliente()->setStatus($dado['statusCliente']);
                    $pedido->getStatus()->setNome($dado['nome']);
                    $pedido->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
                    $pedido->getRepresentante()->setStatusRepresentante($dado['statusRepresentante']);
                    $pedido->setInstituicao(new Instituicao());
                    $pedido->getInstituicao()->setInst_Id($dado['inst_id']);
                    $pedido->getInstituicao()->setInst_Nome($dado['inst_nome']);
                    $lista[] = $pedido;
                }
                return $lista;
            }
        }
        return false;
    }

    public  function salvar(Pedido $pedido)
    {
        try {
            $numeroLicitacao    = $pedido->getNumeroLicitacao();
            $numeroAf           = $pedido->getNumeroAf();
            $valorPedido        = str_replace(',','.', str_replace(".", "", $pedido->getValorPedido())); 
            $codStatus          = $pedido->getStatus()->getCodStatus();
            $codCliente         = $pedido->getClienteLicitacao()->getCodCliente();
            $codRepresentante   = $pedido->getRepresentante()->getCodRepresentante();
            $codUsuario         = $pedido->getUsuario()->getId();
            $fk_instituicao     = $pedido->getInstituicao()->getInst_Id();
            $dataCadastroAtual  = $pedido->getDataCadastro();
            $dataAlteracao      = $pedido->getDataAlteracao();
            $observacao         = $pedido->getObservacao();
            $anexo              = $pedido->getAnexo();
            $dataCadastro       = $dataCadastroAtual->format('Y-m-d H:m:s');
            $dataAlteracao      = $dataCadastro;
            $anexo = $this->anexo($anexo);
           
            return $this->insert(
                'controlePedido',
               ":numeroPregao, 
                :numeroAf, 
                :valorPedido, 
                :codStatus, 
                :codCliente, 
                :codRepresentante, 
                :fk_idUsuarioPed,
                :dataCadastro, 
                :fk_idInstituicao , 
                :dataAlteracao, 
                :observacao, 
                :anexo",
                [
                    ':numeroPregao'     => $numeroLicitacao,
                    ':numeroAf'         => $numeroAf,
                    ':valorPedido'      => $valorPedido,
                    ':codStatus'        => $codStatus,
                    ':codCliente'       => $codCliente,
                    ':codRepresentante' => $codRepresentante,
                    ':fk_idUsuarioPed'  => $codUsuario,
                    ':dataCadastro'     => date('Y-m-d H:i:s'),
                    ':fk_idInstituicao' => $fk_instituicao,
                    ':dataAlteracao'    => date('Y-m-d H:i:s'),
                    ':observacao'       => $observacao,
                    ':anexo'            => $anexo
                ]
            );
            
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ", 500);
        }
    }

    public  function atualizar(Pedido $pedido)
    {
        try {            
            $codControle        = $pedido->getCodControle();
            $numeroLicitacao    = $pedido->getNumeroLicitacao();
            $numeroAf           = $pedido->getNumeroAf();
            $valorPedido        = str_replace(',','.', str_replace(".", "", $pedido->getValorPedido())); 
            $codStatus          = $pedido->getStatus()->getCodStatus();
            $codCliente         = $pedido->getClienteLicitacao()->getCodCliente();
            $codRepresentante   = $pedido->getRepresentante()->getCodRepresentante();
            $codUsuario         = $pedido->getUsuario()->getId();
            $fk_instituicao     = $pedido->getInstituicao()->getInst_Id();
            $dataCadastroAtual  = $pedido->getDataCadastro();
            $dataAlteracao      = $pedido->getDataAlteracao();
            $observacao         = $pedido->getObservacao();
            $anexo              = $pedido->getAnexo();
            $dataCadastro       = $dataCadastroAtual->format('Y-m-d H:m:s');
            $dataAlteracao      = $dataCadastro;
            $anexo = $this->anexo($anexo);
                      
            return $this->update(
                'controlePedido',
               "numeroPregao= :numeroPregao, 
                numeroAf=:numeroAf, 
                valorPedido=:valorPedido, 
                codStatus=:codStatus, 
                codCliente=:codCliente, 
                codRepresentante=:codRepresentante, 
                fk_idUsuarioPed=:codUsuario, 
                fk_idInstituicao=:fk_instituicao , 
                dataAlteracao=:dataAlteracao, 
                observacao=:observacao, 
                anexo=:anexo",
                [
                    ':codControle'      => $codControle,
                    ':numeroPregao'     => $numeroLicitacao,
                    ':numeroAf'         => $numeroAf,
                    ':valorPedido'      => $valorPedido,
                    ':codStatus'        => $codStatus,
                    ':codCliente'       => $codCliente,
                    ':codRepresentante' => $codRepresentante,
                    ':codUsuario'       => $codUsuario,
                    ':fk_instituicao'   => $fk_instituicao,
                    ':dataAlteracao'    => date('Y-m-d H:i:s'),
                    ':observacao'       => $observacao,
                    ':anexo'            => $anexo,
                ],
                "codControle = :codControle"
            );
           
        } catch (\Exception $e) {
           // var_dump("teste ".$e);
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }

    public function excluir(Pedido $pedido)
    {
        try {
            $codControle = $pedido->getCodControle();

            return $this->delete('controlePedido', "codControle = $codControle");
        } catch (Exception $e) {

            throw new \Exception("Erro ao deletar", 500);
        }
    }
    public function anexo($anexo)
    {
        $nomeanexo = date('Y-m-d-h:m:s');
            if (!$_FILES['anexo']['name'] == "") {
                $validextensions = array("jpeg", "jpg", "png", "PNG", "JPG", "JPEG", "pdf", "PDF", "docx");
                $temporary = explode(".", $_FILES["anexo"]["name"]);
                $file_extension = end($temporary);
                $anexo = md5($nomeanexo) . "." . $file_extension;

                if (in_array($file_extension, $validextensions)) {
                    $sourcePath = $_FILES['anexo']['tmp_name'];
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
