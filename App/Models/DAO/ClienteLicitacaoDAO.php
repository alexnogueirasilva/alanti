<?php

namespace App\Models\DAO;

use App\Models\Entidades\ClienteLicitacao;
use App\Models\Entidades\Produto;
use App\Models\Entidades\Contato;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Estado;
use App\Models\Entidades\Cidade;
use App\Models\Entidades\Pessoa;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Cors;
use App\Models\Entidades\Situacoes;

class ClienteLicitacaoDAO extends  BaseDAO
{

    public  function listar($clienteLicitacao)
    {   
        $codCliente     = $clienteLicitacao->getCodCliente();
        $cnpj           = $clienteLicitacao->getCnpj();
        $razaoSocial    = $clienteLicitacao->getRazaoSocial();
        $nomeFantasia   = $clienteLicitacao->getNomeFantasia();
        $status         = $clienteLicitacao->getStatus();
        $tipoCliente    = $clienteLicitacao->getTipoCliente();
        
            $sql = " SELECT c.licitacaoCliente_cod, c.razaosocial, c.nomefantasia, c.CNPJ, c.trocamarca, c.tipo, c.pessoa_id as cli_pessoa_id,
            c.cli_contato, c.cli_observacao, c.cli_celular, c.cli_cargo, c.cli_telefone, c.cli_email, c.cli_datacadastro, c.cli_dataalteracao,
            end.end_id,end.end_longradouro,end.end_numero,end.end_bairro,end.end_complemento,
            end.end_pontoreferencia,end.end_cep,end.end_dataalteracao,end.end_datacadastro,
            end.end_cidade,end.pessoa_id as edn_pessoa_id, cid.cid_id, cid.cid_nome, e.est_id, e.est_nome, e.est_nome, e.est_uf,
            p.pes_id, p.pes_tipo, s.sit_nome, s.sit_id, cor.cor_id, cor.cor_cor, u.id, u.nome, u.apelido, u.email, u.nivel
            FROM clienteLicitacao c
            INNER JOIN usuarios u ON u.id = c.usuario_id
            INNER JOIN pessoas p ON p.pes_id = c.pessoa_id
            INNER JOIN enderecos end ON end.pessoa_id = c.pessoa_id                
            INNER JOIN cidades cid ON cid.cid_id = end.cidade_id
            INNER JOIN estados e ON e.est_id = cid.estado_id 
            INNER JOIN situacoes s ON s.sit_id = c.situacao_id
            INNER JOIN cors cor ON cor.cor_id = s.cor_id ";
            $where = Array();
             if( $codCliente){ $where[] = " c.licitacaoCliente_cod = {$codCliente}"; }
             if( $cnpj  ){ $where[] = "  c.CNPJ = '{$cnpj }'"; }
             if( $razaoSocial ){ $where[] = " c.razaosocial LIKE '%{$razaoSocial}%'"; }   
             if( $nomeFantasia ){ $where[] = " c.nomefantasia LIKE '%{$nomeFantasia}%'"; }                
       if( $status  ){ $where[] = " s.sit_nome LIKE '%{$status}%'"; }   
             if( $tipoCliente  ){ $where[] = " c.tipo LIKE '%{$tipoCliente }%'"; }
            
                   
          if( sizeof( $where ) ){
            $sql .= ' WHERE '.implode( ' AND ',$where );
           }else {
            $sql.= " ORDER BY c.razaosocial ASC ";
           }

           $resultado = $this->select($sql );
           $dados = $resultado->fetchAll();           
            if ($dados) {
                $lista = [];

                foreach ($dados as $dado) {

                    $clienteLicitacao = new ClienteLicitacao();
                    $clienteLicitacao->setCodCliente($dado['licitacaoCliente_cod']);
                    $clienteLicitacao->setRazaoSocial($dado['razaosocial']);
                    $clienteLicitacao->setNomeFantasia($dado['nomefantasia']);
                    $clienteLicitacao->setCnpj($dado['CNPJ']);
                    $clienteLicitacao->setCliObservacao($dado['cli_observacao']);
                    $clienteLicitacao->setCliContato($dado['cli_contato']);
                    $clienteLicitacao->setCliCelular($dado['cli_celular']);
                    $clienteLicitacao->setCliCargo($dado['cli_cargo']);
                    $clienteLicitacao->setCliTelefone($dado['cli_telefone']);
                    $clienteLicitacao->setCliDataCadastro($dado['cli_datacadastro']);
                    $clienteLicitacao->setCliDataCadastro($dado['cli_dataalteracao']);
                    $clienteLicitacao->setCliEmail($dado['cli_email']);
                    $clienteLicitacao->setTrocaMarca($dado['trocamarca']);
                    $clienteLicitacao->setTipoCliente($dado['tipo']);
                    $clienteLicitacao->setStatus($dado['situacao_id']);
                    $clienteLicitacao->setCliPessoa($dado['cli_pessoa_id']);
                    $clienteLicitacao->setEndLongradouro($dado['end_longradouro']);
                    $clienteLicitacao->setEndNumero($dado['end_numero']);
                    $clienteLicitacao->setEndBairro($dado['end_bairro']);
                    $clienteLicitacao->setEndComplemento($dado['end_complemento']);
                    $clienteLicitacao->setEndPontoReferencia($dado['end_pontoreferencia']);
                    $clienteLicitacao->setEndCep($dado['end_cep']);
                    $clienteLicitacao->setEndPessoa($dado['end_pessoa_id']);
                    $clienteLicitacao->setPessoa(new Pessoa());
                    $clienteLicitacao->getPessoa()->setPesId($dado['pes_id']);
                    $clienteLicitacao->getPessoa()->setPesTipo($dado['pes_tipo']);
                    $clienteLicitacao->setEndCidade(new Cidade());
                    $clienteLicitacao->getEndCidade()->setCidId($dado['cid_id']);
                    $clienteLicitacao->getEndCidade()->setCidNome($dado['cid_nome']);
                    $clienteLicitacao->getEndCidade()->setEstado(new Estado());
                    $clienteLicitacao->getEndCidade()->getEstado()->setEstId($dado['est_id']);
                    $clienteLicitacao->getEndCidade()->getEstado()->setEstNome($dado['est_nome']);
                    $clienteLicitacao->getEndCidade()->getEstado()->setEstUf($dado['est_uf']);                
                     $clienteLicitacao->setSituacoes(new Situacoes());
                    $clienteLicitacao->getSituacoes()->setSitId($dado['sit_id']);
                    $clienteLicitacao->getSituacoes()->setSitNome($dado['sit_nome']);
                    $clienteLicitacao->getSituacoes()->setCors(new Cors());
                    $clienteLicitacao->getSituacoes()->getCors()->setCorId($dado['cor_id']);
                    $clienteLicitacao->getSituacoes()->getCors()->setCorNome($dado['cor_nome']);
                    $clienteLicitacao->getSituacoes()->getCors()->setCorCor($dado['cor_cor']);
                    $clienteLicitacao->setUsuario(new Usuario());
                    $clienteLicitacao->getUsuario()->setId($dado['id']);
                    $clienteLicitacao->getUsuario()->setNome($dado['nome']);
                    $clienteLicitacao->getUsuario()->setApelido($dado['apelido']);
                    $clienteLicitacao->getUsuario()->setEmail($dado['email']);
                    $clienteLicitacao->getUsuario()->setNivel($dado['nivel']);

                    $lista[] = $clienteLicitacao;
                }                           
                return $lista;
            }           
    }
    
    
    public function listarPorRazaoSocial(ClienteLicitacao $clienteLicitacao)
    {
        $resultado = $this->select(
            "SELECT * FROM clienteLicitacao c 
             INNER JOIN enderecos end ON end.pessoa_id = c.pessoa_id                
            INNER JOIN cidades cid ON cid.cid_id = end.cidade_id
            INNER JOIN estados e ON e.est_id = cid.estado_id
            WHERE razaosocial
                        LIKE '%".$clienteLicitacao->getRazaoSocial()."%' ORDER BY c.razaosocial LIMIT 0,20"
        );
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function qtdeClientes()
    {
        $sql = " SELECT COUNT(*) FROM clienteLicitacao WHERE situacao_id = 1";    
        $resultado = $this->select($sql);
        $this->Resultado['clientesAtivos'] = $resultado->fetch();        
        
        $sql = " SELECT COUNT(*) FROM clienteLicitacao WHERE situacao_id != 1";    
        $resultado = $this->select($sql);
        $this->Resultado['clientesInativos'] = $resultado->fetch();        
        
        if($this->Resultado){
            return $this->Resultado;
        }else{
            return false;
        }
    }
    
    public  function listaClientesEdital()
    {       

            $resultado = $this->select(
                ' SELECT distinct(c.razaosocial), c.licitacaoCliente_cod,c.tipo, c.nomefantasia,c.CNPJ              
                FROM  clienteLicitacao AS c
                 INNER JOIN edital AS e on e.edt_cliente = c.licitacaoCliente_cod ORDER BY c.razaosocial  '
            );
            $dados = $resultado->fetchAll();

            if ($dados) {

                $lista = [];

                foreach ($dados as $dado) {

                    $clienteLicitacao = new ClienteLicitacao();
                    $clienteLicitacao->setCodCliente($dado['licitacaoCliente_cod']);
                    $clienteLicitacao->setRazaoSocial($dado['razaosocial']);
                    $clienteLicitacao->setNomeFantasia($dado['nomefantasia']);
                    $clienteLicitacao->setCnpj($dado['CNPJ']);
                    $clienteLicitacao->setTrocaMarca($dado['trocamarca']);
                    $clienteLicitacao->setTipoCliente($dado['tipo']);                    

                    $lista[] = $clienteLicitacao;
                }
                return $lista;
            }        
    }

    public  function listaClientesPedido()
    {
            $resultado = $this->select(
                ' SELECT distinct(c.razaosocial), c.licitacaoCliente_cod,c.tipo, c.nomefantasia,c.CNPJ              
                FROM  clienteLicitacao AS c
                 INNER JOIN controlePedido AS con on c.licitacaoCliente_cod = con.codCliente ORDER BY c.razaosocial '
            );
            $dados = $resultado->fetchAll();

            if ($dados) {

                $lista = [];

                foreach ($dados as $dado) {

                    $clienteLicitacao = new ClienteLicitacao();
                    $clienteLicitacao->setCodCliente($dado['licitacaoCliente_cod']);
                    $clienteLicitacao->setRazaoSocial($dado['razaosocial']);
                    $clienteLicitacao->setNomeFantasia($dado['nomefantasia']);
                    $clienteLicitacao->setCnpj($dado['CNPJ']);
                    $clienteLicitacao->setTrocaMarca($dado['trocamarca']);
                    $clienteLicitacao->setTipoCliente($dado['tipo']);
                    // $clienteLicitacao->setDataCadastro($dado['dataCadastro']);

                    $lista[] = $clienteLicitacao;
                }
                return $lista;
            }        
    }

    public  function listarClientesPedidoErp()
    {       

            $resultado = $this->select(
                ' SELECT distinct(c.razaosocial), c.nomefantasia, c.licitacaoCliente_cod, c.CNPJ, c.trocamarca, c.tipo
                            FROM crt_pedidoerp crtperp
                            INNER JOIN controlePedido as p ON p.codControle = crtperp.perp_codcontrole
                            INNER JOIN clienteLicitacao as c ON c.licitacaoCliente_cod = p.codCliente
                            ORDER BY c.razaosocial desc '
            );
            $dados = $resultado->fetchAll();

            if ($dados) {

                $lista = [];

                foreach ($dados as $dado) {

                    $clienteLicitacao = new ClienteLicitacao();
                    $clienteLicitacao->setCodCliente($dado['licitacaoCliente_cod']);
                    $clienteLicitacao->setRazaoSocial($dado['razaosocial']);
                    $clienteLicitacao->setNomeFantasia($dado['nomefantasia']);
                    $clienteLicitacao->setCnpj($dado['CNPJ']);
                    $clienteLicitacao->setTrocaMarca($dado['trocamarca']);
                    $clienteLicitacao->setTipoCliente($dado['tipo']);

                    $lista[] = $clienteLicitacao;
                }
                return $lista;
            }        
    }
    
    public  function listarClientesLogisticaNfe()
    {       

            $resultado = $this->select(
                ' SELECT distinct(c.razaosocial), c.nomefantasia,  c.licitacaoCliente_cod, c.tipo, c.CNPJ
                FROM crt_logistica as l
                INNER JOIN crt_pedidoerp as pe ON pe.perp_id = l.lgt_fk_erp
                INNER JOIN controlePedido as  p ON p.codControle  = pe.perp_codcontrole
                INNER JOIN clienteLicitacao as c ON c.licitacaoCliente_cod = p.codCliente
                ORDER BY c.razaosocial desc '
            );
            $dados = $resultado->fetchAll();

            if ($dados) {

                $lista = [];

                foreach ($dados as $dado) {

                    $clienteLicitacao = new ClienteLicitacao();
                    $clienteLicitacao->setCodCliente($dado['licitacaoCliente_cod']);
                    $clienteLicitacao->setRazaoSocial($dado['razaosocial']);
                    $clienteLicitacao->setNomeFantasia($dado['nomefantasia']);
                    $clienteLicitacao->setCnpj($dado['CNPJ']);
                    $clienteLicitacao->setTrocaMarca($dado['trocamarca']);
                    $clienteLicitacao->setTipoCliente($dado['tipo']);

                    $lista[] = $clienteLicitacao;
                }
                return $lista;
            }        
    }
    
    public function listarClienteLicitacao(ClienteLicitacao $clienteLicitacao)
    {
        $resultado = $this->select(
            "SELECT FC.faltaCliente_cod,
                    CL.nomefantasia as cliente,
                    P.ProCodigo,
                    P.ProNome,
                    F.nomefantasia,
                    P.ProMarca,
                    FC.proposta,
                    FC.AFM,
                    FC.observacao,
                    FC.dataFalta
                    
                FROM faltaCliente FC
     
         INNER JOIN faltaporcliente FPC on FPC.FK_ID_FALTACLIENTE = FC.faltaCliente_cod
         INNER JOIN clienteLicitacao CL on CL.licitacaoCliente_cod = FC.fk_cliente
         INNER JOIN Produto P on P.ProCodigo = FPC.FK_IDPRODUTO
         INNER JOIN fornecedor F on F.fornecedor_cod = P.ProFornecedor
    
         "
            );

        return $resultado->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function listarporCliente($clienteLicitacao = null)
    {
        if($clienteLicitacao)
        {
            $resultado = $this->select(
                "SELECT * FROM faltaporcliente fp INNER JOIN clienteLicitacao cl  ON fp.FK_ID_FALTACLIENTE = cl.licitacaoCliente_cod WHERE FK_ID_FALTACLIENTE = $clienteLicitacao"
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, ClienteLicitacao::class);
        }
        
    }
    public  function listaClienteLicitacao2()
    {
        $resultado = $this->select(
            'SELECT * FROM cliente c INNER JOIN tipoCliente tp ON tp.codTipoCliente = c.idTipoCliente'
        );

        $dataSetclienteLicitacaos = $resultado->fetchAll();

        if ($dataSetclienteLicitacaos) {

            $listaClienteLicitacao2 = [];

            foreach ($dataSetclienteLicitacaos as $dataSetclienteLicitacao) {

                $clienteLicitacao = new ClienteLicitacao();
                $clienteLicitacao->setCodCliente($dataSetclienteLicitacao['idCliente']);
                $clienteLicitacao->setRazaoSocial($dataSetclienteLicitacao['nome']);
                $clienteLicitacao->setNomeFantasia($dataSetclienteLicitacao['nomeFantasia']);
                $clienteLicitacao->getTipoCliente()->setNomeTipo($dataSetclienteLicitacao['nomeTipo']);

                $listaClienteLicitacao2[] = $clienteLicitacao;
            }
            return $listaClienteLicitacao2;
        }

        return false;
    }

    public function listaClienteLicitacao($idCliente = null)
    {
        
        if ($idCliente) {

            $resultado = $this->select(
                "SELECT * FROM clienteLicitacao  WHERE licitacaoCliente_cod = $idCliente"
               // "SELECT * FROM cliente c INNER JOIN tipoCliente tp ON tp.codTipoCliente = c.tipoCliente WHERE c.idTipoCliente = $idCliente"
            );

            return $resultado->fetchObject(ClienteLicitacao::class);
        } else {
            $resultado = $this->select(
                "SELECT * FROM clienteLicitacao "
                //'SELECT * FROM cliente c INNER JOIN tipoCliente tp ON tp.codTipoCliente = c.idTipoCliente '
            );
            return  $resultado->fetchAll(\PDO::FETCH_CLASS, ClienteLicitacao::class);
        }

        return false;
    }
    public function listaTipoClienteLicitacao(ClienteLicitacao $clienteLicitacao)
    {
        $descricao = null;
        $codTipo = null;

        $SQL = "SELECT * FROM clienteTipo ORDER BY tpc_descricao" ;
                
                $where = Array();
                if( $codTipo ){ $where[] = " tpc_id = {$codTipo}"; }
                if( $descricao ){ $where[] = " tpc_descricao LIKE '%{$descricao}%' "; }
                
                if( sizeof( $where ) ){
                    $SQL .= ' WHERE '.implode( ' AND ',$where );
                   }else {
                     //  $SQL .= " WHERE tpc_status  not in  ('INATIVO') ";
                   }
            $resultado = $this->select($SQL);
            $dados = $resultado->fetchAll();

        if ($dados) {
            $lista = [];
            foreach ($dados as $dado) {
                $clienteLicitacao = new ClienteLicitacao();
                $clienteLicitacao->setTpcId($dado['tpc_id']);
                $clienteLicitacao->setTpcDescricao($dado['tpc_descricao']);
               /* $clienteLicitacao->setTpcDescricao($dado['tpc_status']);
                $clienteLicitacao->setTpcDescricao($dado['tpc_datacadastro']);
                $clienteLicitacao->setTpcDescricao($dado['tpc_dataalteracao']);
                $clienteLicitacao->setTpcDescricao($dado['tpc_intituicao']);
                $clienteLicitacao->setTpcDescricao($dado['tpc_usuario']);
                $clienteLicitacao->setInstituicao(new Instituicao());
                $clienteLicitacao->getInstituicao()->setInst_Id($dado['inst_id']);
                $clienteLicitacao->getInstituicao()->setInst_Codigo($dado['inst_codigo']);
                $clienteLicitacao->getInstituicao()->setInst_Nome($dado['inst_nome']);
                $clienteLicitacao->setUsuario(new Usuario());
                $clienteLicitacao->getUsuario()->setId($dado['id']);
                $clienteLicitacao->getUsuario()->setNome($dado['nome']);
                $clienteLicitacao->getUsuario()->setEmail($dado['email']);
                */
                $lista[] = $clienteLicitacao;
            }
            return $lista;
        }

        return false;
    }
    public function listarTeste($idCliente = null)
    {
        $SQL = "SELECT * FROM clienteLicitacao ";
        if($idCliente){
            $SQL.= " WHERE licitacaoCliente_cod = $idCliente";
        }
            $resultado = $this->select($SQL);
            
            $dados = $resultado->fetchAll();            
                $lista = [];

                foreach ($dados as $dado) {
                    
                $clienteLicitacao = new ClienteLicitacao();
                
                $clienteLicitacao->setCodCliente($dado['clienteLicitacao_cod']);
                $clienteLicitacao->setRazaoSocial($dado['razaosocial']);
                //date_format($date, 'Y-m-d H:i:s');
                $clienteLicitacao->setNomeFantasia($dado['nomefantasia']);
                             
                    $lista[] = $clienteLicitacao;
                }                
                return $lista;
    }
    public function salvar(ClienteLicitacao $clienteLicitacao)
    {
        try {
            $razaoSocial    = $clienteLicitacao->getRazaoSocial();
            $email          = $clienteLicitacao->getCliEmail();
            $telefone       = $clienteLicitacao->getCliTelefone();
            $celular        = $clienteLicitacao->getCliCelular();
            $contato        = $clienteLicitacao->getCliContato();
            $cargosetor     = $clienteLicitacao->getCliCargo();
            $dataCadastro   = date('Y-m-d H:i:s');
            $dataAlteracao  = date('Y-m-d H:i:s');
            $nomeFantasia   = $clienteLicitacao->getNomeFantasia();
            $cnpj           = $clienteLicitacao->getCnpj();
            $trocaMarca     = $clienteLicitacao->getTrocaMarca();
            $tipoCliente    = $clienteLicitacao->getTipoCliente();
            $pessoa         = $clienteLicitacao->getCliPessoa();
            $status         = $clienteLicitacao->getSituacoes()->getSitId();
            $observacao     = $clienteLicitacao->getCliObservacao();
            $usuario        = $_SESSION['id'];
  
            return $this->insert(
                'clienteLicitacao',
                ":razaosocial, :cli_email, :cli_telefone, :cli_celular, :cli_contato,
                :cli_cargo, :cli_datacadastro, :cli_dataalteracao, :nomefantasia, 
                :cnpj, :trocamarca, :tipo, :pessoa_id, :situacao_id, :usuario_id, :cli_observacao",
                [
                    ":razaosocial"       => $razaoSocial,
                    ':cli_email'         => $email,
                    ':cli_telefone'      => $telefone,
                    ':cli_celular'       => $celular,
                    ':cli_contato'       => $contato,
                    ':cli_cargo'         => $cargosetor,
                    ':cli_datacadastro'  => $dataCadastro,
                    ':cli_dataalteracao' => $dataAlteracao,
                    ":nomefantasia"      => $nomeFantasia,
                    ":cnpj"              => $cnpj,
                    ":trocamarca"        => $trocaMarca,
                    ":tipo"              => $tipoCliente,
                    ":pessoa_id"         => $pessoa,
                    ":situacao_id"       => $status,
                    ":cli_observacao"    => $observacao,
                    ":usuario_id"        => $usuario
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados:" . $e->getMessage(), 500);
        }
    }
    public function addContatos(ClienteLicitacao $clienteLicitacao)
    {    
        try { 
            $conta = count($clienteLicitacao->getContatos()->getContato());
            if($conta > 0){
            for($i = 0; $i < $conta; $i++ ){                               
                $nome               = $clienteLicitacao->getContatos()->getContato()[$i];             
                $email              = $clienteLicitacao->getContatos()->getEmail()[$i];
                $telefone           = $clienteLicitacao->getContatos()->getTelefone()[$i];
                $celular            = $clienteLicitacao->getContatos()->getCelular()[$i];
                $cargosetor         = $clienteLicitacao->getContatos()->getCargo()[$i];
                $datacadastro       = date('Y-m-d H:i:s');
                $usuario_id         = $_SESSION['id'];
                $pessoa_id          = $clienteLicitacao->getCliPessoa();
               
             $this->insert(
                'contatos',
                ":cnt_nome, :cnt_email, :cnt_telefone, :cnt_celular, 
                :cnt_datacadastro, :cnt_cargosetor, :usuario_id, :pessoa_id",
                [
                    ":cnt_nome"          => $nome,
                    ":cnt_email"         => $email, 
                    ":cnt_telefone"      => $telefone, 
                    ":cnt_celular"       => $celular, 
                    ":cnt_datacadastro"  => $datacadastro,
                    ":cnt_cargosetor"    => $cargosetor, 
                    ":usuario_id"        => $usuario_id, 
                    ":pessoa_id"         => $pessoa_id                    
                ]
                );
            }
            }
                return true;
        } catch (\Exception $e) {            
            throw new \Exception("Erro na gravação de dados:" . $e->getMessage(), 500);
            return false;
        }
    }
    public function addContato(Contato $contato)
    {
        
        try {      
             $nome              = $contato->getContato();             
             $email             = $contato->getEmail();
             $telefone          = $contato->getTelefone();
             $celular           = $contato->getCelular();
            $datacadastro       = date('Y-m-d H:i:s');
            $cargosetor         = $contato->getCargo();
            $usuario_id         = $_SESSION['id'];
            $pessoa_id          = $contato->getPessoa();

             $this->insert(
                'contatos',
                ":cnt_nome, :cnt_email, :cnt_telefone, :cnt_celular, 
                :cnt_datacadastro, :cnt_cargosetor, :usuario_id, :pessoa_id",
                [
                    ":cnt_nome"          => $nome,
                    ":cnt_email"         => $email, 
                    ":cnt_telefone"      => $telefone, 
                    ":cnt_celular"       => $celular, 
                    ":cnt_datacadastro"  => $datacadastro,
                    ":cnt_cargosetor"    => $cargosetor, 
                    ":usuario_id"        => $usuario_id, 
                    ":pessoa_id"         => $pessoa_id                    
                ]
                );
                return true;
        } catch (\Exception $e) {                         
            throw new \Exception("Erro na gravação de dados:" . $e->getMessage(), 500);
            return false;
        }
    }

    public function atualizar(ClienteLicitacao $clienteLicitacao)
    {
        try {
            
            $codCliente     = $clienteLicitacao->getCodCliente();
            $razaoSocial    = $clienteLicitacao->getRazaoSocial();
            $email          = $clienteLicitacao->getCliEmail();
            $telefone       = $clienteLicitacao->getCliTelefone();
            $celular        = $clienteLicitacao->getCliCelular();
            $contato        = $clienteLicitacao->getCliContato();
            $cargosetor     = $clienteLicitacao->getCliCargo();
            $dataAlteracao  = date('Y-m-d H:i:s');
            $nomeFantasia   = $clienteLicitacao->getNomeFantasia();
            $cnpj           = $clienteLicitacao->getCnpj();
            $trocaMarca     = $clienteLicitacao->getTrocaMarca();
            $status         = $clienteLicitacao->getSituacoes()->getSitId();
            $tipoCliente    = $clienteLicitacao->getTipoCliente();
            $observacao     = $clienteLicitacao->getCliObservacao();
            $pessoa_id      = $clienteLicitacao->getCliPessoa();
            $usuario        = $_SESSION['id'];
           
            return $this->update(
                'clienteLicitacao',
                "  razaoSocial =:razaoSocial, nomeFantasia =:nomeFantasia, 
                cli_email =:email, cli_telefone =:telefone, cli_celular =:celular,
                cli_contato =:contato, cli_cargo =:cargo, cli_dataalteracao =:dataAlteracao,
                cnpj =:cnpj, trocaMarca =:trocaMarca, 
                situacao_id =:status, tipo =:tipoCliente, cli_observacao =:observacao, pessoa_id =:pessoa ",
                [
                    ':codCliente'       => $codCliente,
                    ':razaoSocial'      => $razaoSocial,
                    ':email'            => $email,
                    ':telefone'         => $telefone,
                    ':celular'          => $celular,
                    ':contato'          => $contato,
                    ':cargo'            => $cargosetor,
                    ':dataAlteracao'    => $$dataAlteracao,
                    ':nomeFantasia'     => $nomeFantasia,
                    ':cnpj'             => $cnpj,
                    ':trocaMarca'       => $trocaMarca,
                    ':status'           => $status,
                    ':tipoCliente'      => $tipoCliente,
                    ':observacao'       => $observacao,
                    ':pessoa'           => $pessoa_id,
                ],
                "licitacaoCliente_cod = :codCliente"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro ao gravar dados " . $e->getMessage(), 500);
        }
    }

    public function excluir(ClienteLicitacao $clienteLicitacao)
    {
        try {

            $codCliente = $clienteLicitacao->getCodCliente();

            return $this->delete('clienteLicitacao', ":licitacaoCliente_cod = $codCliente");
        } catch (\Exception $e) {
            throw new \Exception("Erro ao deletar" . $e->getMessage(), 500);
        }
    }
    
    // end: funcoes pra sicronizar dados (pessoa/ endereço/ cliente)
        private $PessoaId;
        private $Cliente;
        private $ClienteId;
        private $Endereco;
        private $Resultado;
        public function sicronizar()
        {
            $this->Cliente = $this->listarClienteScr();       
            if($this->Cliente){   
            
               if($this->atualizacao()){
                   return $this->Resultado;
                }else{                   
                    return false;                
               }
            }else{
                return false;
            }        
        }
        private function listarClienteScr()
        {
            $sql = " SELECT licitacaoCliente_cod FROM clienteLicitacao WHERE pessoa_id IS NULL ";
            
            $resultado = $this->select($sql);
    
            $this->Cliente = $resultado->fetchAll();
            if($this->Cliente){
                return $this->Cliente;
            }else{
               
                return false;
            }
        }

        private function atualizacao()
        {
           foreach($this->Cliente as $Cliente){
               extract($Cliente);
                $this->ClienteId = $licitacaoCliente_cod;  
                $this->sicronizarDados();            
           }
        }
    
        private function sicronizarDados()
        {              
                 $this->cadastrarPessoa();
                if($this->PessoaId){               
                    $this->cadastrarEndereco();
                    if($this->Endereco){                       
                        if($this->atualizarCliente()){
                            return true;
                        }else{
                            return false;
                        }
                    }else{
                        return false;
                    }               
                }else{
                    return false;
                }
           
        }
         
        private function cadastrarEndereco()
        {               
            try {      
                    $longradouro        = "IMPLATACAO";               
                    $datacadastro       =  date('Y-m-d H:i:s');
                    $cidade             = 411 ;
                    $pessoa             = $this->PessoaId;
    
                   $this->Endereco = $this->insert(
                        'enderecos',
                       ":end_longradouro,
                        :end_datacadastro,                  
                        :cidade_id,
                        :pessoa_id",
                        [
                            ':end_longradouro'      => $longradouro,                       
                            ':end_datacadastro'     => $datacadastro,
                            ':cidade_id'            => $cidade,
                            ':pessoa_id'            => $pessoa
                        ]
                    );
    
            } catch (\Exception $e) {          
                throw new \Exception("Erro na gravação de dados. ", 500);
                return false;
            }
    
        }
        private function cadastrarPessoa()
        {
            try {
               $tipo            = "IMPLATACAO";
               $usuario         = $_SESSION['id'];
               $dataCadastro    = date('Y-m-d H:i:s');
                $this->PessoaId = $this->insert(
                    'pessoas',
                    ":pes_tipo, :usuario_id, :pes_datacadastro",
                    [
                        ':pes_tipo'             => $tipo,
                        ':usuario_id'           => $usuario,
                        ':pes_datacadastro'     => $dataCadastro
                    ]
                );
            } catch (\Exception $e) {            
                throw new \Exception("Erro na gravação de dados.". $e->getMessage(), 500);
            }
    
        }
    
        private  function atualizarCliente()
        {
            try {
                
                $this->Resultado += 1;
                $codCliente         = $this->ClienteId;
                $pessoa             = $this->PessoaId;
                $usuario            = $_SESSION['id'];
                $dataAlteracao      = date('Y-m-d H:i:s');           
    
                $this->update(
                    'clienteLicitacao',
                    " cli_dataalteracao =:dataAlteracao, usuario_id =:usuario, pessoa_id =:pessoa ",
                    [
                        ':codCliente'       => $codCliente,
                        ':dataAlteracao'    => $dataAlteracao,
                        ':usuario'          => $usuario,
                        ':pessoa'           => $pessoa,
                    ],
                    "licitacaoCliente_cod = :codCliente"
                );
            } catch (\Exception $e) {
                throw new \Exception("Erro na gravação de dados. ".$e, 500);
            }
        }
       // begin: funcoes pra sicronizar dados (pessoa/ endereço/ cliente)
 
}