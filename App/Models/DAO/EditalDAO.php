<?php

namespace App\Models\DAO;

use App\Models\Entidades\Edital;
use App\Models\Entidades\EditalStatus;
use App\Models\Entidades\Estado;
use App\Models\Entidades\Cidade;
use App\Models\Entidades\Pessoa;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Representante;
use App\Models\Entidades\ClienteLicitacao;
use App\Models\Entidades\Cors;

class EditalDAO extends BaseDAO
{
    public  function listar($edtId = null)
    {        
        $SQL = " SELECT edt.edt_id, edt.edt_numero, edt.edt_dataabertura, edt.edt_hora, edt.edt_datalimite, edt.edt_horalimite, edt.edt_identificador, edt.edt_portal, 
        edt.edt_operador, edt.edt_dataresultado, edt.edt_proposta, edt.edt_modalidade, edt.edt_tipo, edt.edt_garantia, edt.edt_valor, edt.edt_status, 
        edt.edt_analise, edt.edt_observacao, edt.edt_anexo, edt.edt_datacadastro, edt.edt_dataalteracao, edt.edt_disputa, edt.edt_justificativa, 
        r.codRepresentante, r.nomeRepresentante, c.licitacaoCliente_cod, c.nomefantasia, c.razaosocial, c.tipo, c.CNPJ, c.trocamarca, i.inst_id, c.pessoa_id,
        end.end_cidade,end.pessoa_id as edn_pessoa_id, cid.cid_id, cid.cid_nome, e.est_id, e.est_nome, e.est_uf, p.pes_id, p.pes_tipo,
        i.inst_nome, i.inst_nomeFantasia, u.id, u.nome, u.apelido, edtSt.stedt_id, edtSt.stedt_nome, cor.cor_id, cor.cor_nome, cor.cor_cor
		FROM edital edt
		INNER JOIN cadRepresentante r ON r.codRepresentante = edt.edt_representante
        INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = edt.edt_cliente
        INNER JOIN instituicao i ON i.inst_id = edt.edt_instituicao
        INNER JOIN usuarios u ON u.id = edt.edt_usuario 
		INNER JOIN editalStatus edtSt ON edtSt.stedt_id = edt.edt_status
		INNER JOIN pessoas p ON p.pes_id = c.pessoa_id
        INNER JOIN enderecos end ON end.pessoa_id = c.pessoa_id                
        INNER JOIN cidades cid ON cid.cid_id = end.cidade_id
        INNER JOIN estados e ON e.est_id = cid.estado_id 
		INNER JOIN cors cor ON cor.cor_id = edtSt.cor_id ";
            
            if($edtId) 
            {    
                $SQL.= " WHERE edt.edt_id =  $edtId";
            }
            $resultado = $this->select($SQL);
            $dados = $resultado->fetchAll();
            $lista = [];
            foreach ($dados as $dado) {                
                $edital = new Edital();
                $edital->setEdtId($dado['edt_id']);;
                $edital->setEdtNumero($dado['edt_numero']);
                $edital->setEdtDataAbertura($dado['edt_dataabertura']);
                $edital->setEdtHora($dado['edt_hora']);
                $edital->setEdtDataLimite($dado['edt_datalimite']);
                $edital->setEdtHoraLimite($dado['edt_horalimite']);
                $edital->setEdtIdentificador($dado['edt_identificador']);
                $edital->setEdtPortal($dado['edt_portal']);
                $edital->setEdtOperador($dado['edt_operador']);
                $edital->setEdtDataResultado($dado['edt_dataresultado']);
                $edital->setEdtProposta($dado['edt_proposta']);
                $edital->setEdtModalidade($dado['edt_modalidade']);
                $edital->setEdtTipo($dado['edt_tipo']);
                $edital->setEdtGarantia($dado['edt_garantia']);
                $edital->setEdtValor(number_format($dado['edt_valor'], 2, ',', '.'));
                $edital->setEdtSomar($dado['edt_valor']);
                $edital->setEdtStatus($dado['edt_status']);
                $edital->setEdtAnalise($dado['edt_analise']);
                $edital->setEdtObservacao($dado['edt_observacao']);
                $edital->setEdtAnexo($dado['edt_anexo']);
                $edital->setEdtDataCadastro($dado['edt_datacadastro']);
                $edital->setEdtDataAlteracao($dado['edt_dataalteracao']);
                $edital->setDisputa($dado['edt_disputa']);
                $edital->setJustificativa($dado['edt_justificativa']);
                $edital->setRepresentante(new Representante());
                $edital->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
                $edital->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
                $edital->setClienteLicitacao(new ClienteLicitacao());
                $edital->getClienteLicitacao()->setCodCliente($dado['licitacaoCliente_cod']);
                $edital->getClienteLicitacao()->setNomeFantasia($dado['nomefantasia']);
                $edital->getClienteLicitacao()->setRazaoSocial($dado['razaosocial']);
                $edital->getClienteLicitacao()->setTipoCliente($dado['tipo']);
                $edital->getClienteLicitacao()->setCnpj($dado['CNPJ']);
                $edital->getClienteLicitacao()->setTrocaMarca($dado['trocamarca']);
                 $edital->getClienteLicitacao()->setPessoa(new Pessoa());
                  $edital->getClienteLicitacao()->getPessoa()->setPesId($dado['pes_id']);
                  $edital->getClienteLicitacao()->getPessoa()->setPesTipo($dado['pes_tipo']);
                  $edital->getClienteLicitacao()->setEndCidade(new Cidade());
                  $edital->getClienteLicitacao()->getEndCidade()->setCidId($dado['cid_id']);
                  $edital->getClienteLicitacao()->getEndCidade()->setCidNome($dado['cid_nome']);
                  $edital->getClienteLicitacao()->getEndCidade()->setEstado(new Estado());
                  $edital->getClienteLicitacao()->getEndCidade()->getEstado()->setEstId($dado['est_id']);
                  $edital->getClienteLicitacao()->getEndCidade()->getEstado()->setEstNome($dado['est_nome']);
                  $edital->getClienteLicitacao()->getEndCidade()->getEstado()->setEstUf($dado['est_uf']); 
                $edital->setInstituicao(new Instituicao());
                $edital->getInstituicao()->setInst_Id($dado['inst_id']);                    
                $edital->getInstituicao()->setInst_Nome($dado['inst_nome']);                    
                $edital->getInstituicao()->setInst_NomeFantasia($dado['inst_nomeFantasia']);                    
                $edital->setUsuario(new Usuario());
                $edital->getUsuario()->setId($dado['id']);
                $edital->getUsuario()->setNome($dado['nome']);
                $edital->getUsuario()->setApelido($dado['apelido']);
                $edital->setEditalStatus(new EditalStatus());
                $edital->getEditalStatus()->setStEdtId($dado['stedt_id']);;
                $edital->getEditalStatus()->setStEdtNome($dado['stedt_nome']);
                $edital->getEditalStatus()->setCors(new Cors());
                $edital->getEditalStatus()->getCors()->setCorId($dado['cor_id']);
                $edital->getEditalStatus()->getCors()->setCorNome($dado['cor_nome']);
                $edital->getEditalStatus()->getCors()->setCorCor($dado['cor_cor']);
                
                $lista[] = $edital;
            }
            return $lista;        
                
    }
    
      public  function listarDinamico(Edital $edital)
    {     
        $codCliente         = $edital->getEdtCliente();      
        $codEdital          = $edital->getEdtId();
        $proposta           = $edital->getEdtProposta();
        $numeroLicitacao    = $edital->getEdtNumero();
        $status             = $edital->getEdtStatus();
        $modalidade         = $edital->getEdtModalidade();
        $representante      = $edital->getEdtRepresentante();
        $edtOperador        = $edital->getEdtOperador();
        $dataInicial        = $edital->getEdtDataInicio();
        $dataFinal          = $edital->getEdtDataFinal();

        $sql = " SELECT edt.edt_id, edt.edt_numero, edt.edt_dataabertura, edt.edt_hora, edt.edt_datalimite, edt.edt_horalimite, edt.edt_identificador, edt.edt_portal, 
            edt.edt_operador, edt.edt_dataresultado, edt.edt_proposta, edt.edt_modalidade, edt.edt_tipo, edt.edt_garantia, edt.edt_valor, edt.edt_status, 
            edt.edt_analise, edt.edt_observacao, edt.edt_anexo, edt.edt_datacadastro, edt.edt_dataalteracao, edt.edt_disputa, edt.edt_justificativa, 
            r.codRepresentante, r.nomeRepresentante, c.licitacaoCliente_cod, c.nomefantasia, c.razaosocial, c.tipo, c.CNPJ, c.trocamarca, i.inst_id, c.pessoa_id,
            end.end_cidade,end.pessoa_id as edn_pessoa_id, cid.cid_id, cid.cid_nome, e.est_id, e.est_nome, e.est_uf, p.pes_id, p.pes_tipo,
            i.inst_nome, i.inst_nomeFantasia, u.id, u.nome, u.apelido, edtSt.stedt_id, edtSt.stedt_nome, cor.cor_id, cor.cor_nome, cor.cor_cor
            FROM clienteLicitacao c
            INNER JOIN edital edt ON c.licitacaoCliente_cod = edt.edt_cliente
            INNER JOIN cadRepresentante r ON r.codRepresentante = edt.edt_representante
            INNER JOIN instituicao i ON i.inst_id = edt.edt_instituicao
            INNER JOIN usuarios u ON u.id = edt.edt_usuario 
            INNER JOIN editalStatus edtSt ON edtSt.stedt_id = edt.edt_status 
            INNER JOIN pessoas p ON p.pes_id = c.pessoa_id
            INNER JOIN enderecos end ON end.pessoa_id = c.pessoa_id                
            INNER JOIN cidades cid ON cid.cid_id = end.cidade_id
            INNER JOIN estados e ON e.est_id = cid.estado_id 
            INNER JOIN cors cor ON cor.cor_id = edtSt.cor_id ";                 
            
             $where = Array();
             if( $codCliente ){ $where[] = " edt.edt_cliente = {$codCliente}"; }
             if( $codEdital ){ $where[] = " edt.edt_id = {$codEdital}"; }
             if( $proposta ){ $where[] = " edt.edt_proposta = '{$proposta}'"; }
             if( $status ){ $where[] = " edt.edt_status = {$status}"; }
             if( $representante ){ $where[] = " r.codRepresentante = {$representante}"; }
             if( $modalidade ){ $where[] = " edt.edt_modalidade = '{$modalidade}'"; }
             if( $edtOperador ){ $where[] = " edt.edt_operador = '{$edtOperador}'"; }
             if( $numeroLicitacao ){ $where[] = " edt.edt_numero = '{$numeroLicitacao}'"; }   
            if( ($dataInicial) & ($dataFinal) ){
                if($_SESSION['edtDataCadDisp']){
                    $where[] = " edt.edt_dataabertura between '{$dataInicial}' AND '{$dataFinal} 23:59:00'"; 
                }else{
                    $where[] = " edt.edt_datalimite between '{$dataInicial}' AND '{$dataFinal} 23:59:00'";
                }
            }
                
          if( sizeof( $where ) )
          {
              $sql .= ' WHERE '.implode( ' AND ',$where ); 
              $sql .= '  ORDER BY edt.edt_dataabertura ASC';
            } else {
                //$sql .= " WHERE edt.edt_status NOT IN ('10','11','12','13','14') ORDER BY edt.edt_dataabertura ASC ";
                $sql .= " WHERE edt.edt_dataabertura >= '".date('Y-m-d', strtotime('-2 days'))."' AND
                edt.edt_status NOT IN ('10','11','12','13','14') ORDER BY edt.edt_dataabertura ASC ";
                ;
            }
           
            $resultado = $this->select($sql);
            $dados = $resultado->fetchAll();
            $lista = [];
            foreach ($dados as $dado) {                
                $edital = new Edital();
                $edital->setEdtId($dado['edt_id']);;
                $edital->setEdtNumero($dado['edt_numero']);
                $edital->setEdtDataAbertura($dado['edt_dataabertura']);
                $edital->setEdtHora($dado['edt_hora']);
                $edital->setEdtDataLimite($dado['edt_datalimite']);
                $edital->setEdtHoraLimite($dado['edt_horalimite']);
                $edital->setEdtIdentificador($dado['edt_identificador']);
                $edital->setEdtPortal($dado['edt_portal']);
                $edital->setEdtOperador($dado['edt_operador']);
                $edital->setEdtDataResultado($dado['edt_dataresultado']);
                $edital->setEdtProposta($dado['edt_proposta']);
                $edital->setEdtModalidade($dado['edt_modalidade']);
                $edital->setEdtTipo($dado['edt_tipo']);
                $edital->setEdtGarantia($dado['edt_garantia']);
                $edital->setEdtValor(number_format($dado['edt_valor'], 2, ',', '.'));
                $edital->setEdtSomar($dado['edt_valor']);
                $edital->setEdtStatus($dado['edt_status']);
                $edital->setEdtAnalise($dado['edt_analise']);
                $edital->setEdtObservacao($dado['edt_observacao']);
                $edital->setEdtAnexo($dado['edt_anexo']);
                $edital->setEdtDataCadastro($dado['edt_datacadastro']);
                $edital->setEdtDataAlteracao($dado['edt_dataalteracao']);
                $edital->setDisputa($dado['edt_disputa']);
                $edital->setJustificativa($dado['edt_justificativa']);
                $edital->setRepresentante(new Representante());
                $edital->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
                $edital->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
                $edital->setClienteLicitacao(new ClienteLicitacao());
                $edital->getClienteLicitacao()->setCodCliente($dado['licitacaoCliente_cod']);
                $edital->getClienteLicitacao()->setNomeFantasia($dado['nomefantasia']);
                $edital->getClienteLicitacao()->setRazaoSocial($dado['razaosocial']);
                $edital->getClienteLicitacao()->setTipoCliente($dado['tipo']);
                $edital->getClienteLicitacao()->setCnpj($dado['CNPJ']);
                $edital->getClienteLicitacao()->setTrocaMarca($dado['trocamarca']);
                $edital->getClienteLicitacao()->setPessoa(new Pessoa());
                  $edital->getClienteLicitacao()->getPessoa()->setPesId($dado['pes_id']);
                  $edital->getClienteLicitacao()->getPessoa()->setPesTipo($dado['pes_tipo']);
                  $edital->getClienteLicitacao()->setEndCidade(new Cidade());
                  $edital->getClienteLicitacao()->getEndCidade()->setCidId($dado['cid_id']);
                  $edital->getClienteLicitacao()->getEndCidade()->setCidNome($dado['cid_nome']);
                  $edital->getClienteLicitacao()->getEndCidade()->setEstado(new Estado());
                  $edital->getClienteLicitacao()->getEndCidade()->getEstado()->setEstId($dado['est_id']);
                  $edital->getClienteLicitacao()->getEndCidade()->getEstado()->setEstNome($dado['est_nome']);
                  $edital->getClienteLicitacao()->getEndCidade()->getEstado()->setEstUf($dado['est_uf']); 
                $edital->setInstituicao(new Instituicao());
                $edital->getInstituicao()->setInst_Id($dado['inst_id']);                    
                $edital->getInstituicao()->setInst_Nome($dado['inst_nome']);                    
                $edital->setUsuario(new Usuario());
                $edital->getUsuario()->setId($dado['id']);
                $edital->getUsuario()->setNome($dado['nome']);
                $edital->getUsuario()->setApelido($dado['apelido']);
                $edital->setEditalStatus(new EditalStatus());
                $edital->getEditalStatus()->setStEdtId($dado['stedt_id']);;
                $edital->getEditalStatus()->setStEdtNome($dado['stedt_nome']);
                $edital->getInstituicao()->setInst_NomeFantasia($dado['inst_nomeFantasia']);
                $edital->getEditalStatus()->setCors(new Cors());
                $edital->getEditalStatus()->getCors()->setCorId($dado['cor_id']);
                $edital->getEditalStatus()->getCors()->setCorNome($dado['cor_nome']);
                $edital->getEditalStatus()->getCors()->setCorCor($dado['cor_cor']);
                
                $lista[] = $edital;
            }
            return $lista; 
    }
    
    
    public  function editaisPendentes()
    {     
        $sql = " SELECT COUNT(edt.edt_id) AS Pendentes
        FROM edital edt
        INNER JOIN instituicao i ON i.inst_id = edt.edt_instituicao
        INNER JOIN editalStatus edtSt ON edtSt.stedt_id = edt.edt_status 
        WHERE edt.edt_status NOT IN ('10','11','12','13','14') ";
        
            $resultado = $this->select($sql);
            $dados = $resultado->fetch();
            if($dados){
                return $dados;        
            }else{
                return false;
            }
                
    }
    
    public  function editaisFinalizados()
    {     
        $sql = " SELECT COUNT(edt.edt_id) AS Finalizados
        FROM edital edt
        INNER JOIN instituicao i ON i.inst_id = edt.edt_instituicao
        INNER JOIN editalStatus edtSt ON edtSt.stedt_id = edt.edt_status 
        WHERE edt.edt_status IN ('10','11','12','13','14') ";
        
            $resultado = $this->select($sql);
            $dados = $resultado->fetch();
            if($dados){
                return $dados;        
            }else{
                return false;
            }
                
    }

    public  function listarOperadorEdital()
    {     
        
        $sql = " SELECT distinct(e.edt_operador)
            FROM  edital AS e ORDER BY e.edt_operador  ";       
             
            $resultado = $this->select($sql);
            $dados = $resultado->fetchAll();
            
            $lista = [];
            foreach ($dados as $dado) {                
                $edital = new Edital();
                
                $edital->setEdtOperador($dado['edt_operador']);
                
                $lista[] = $edital;
            }
            
            return $lista;        
               
    }

    public  function listarRepresentanteEdital($edtId = null)
    {        
        $SQL = " SELECT distinct(r.codRepresentante), r.nomeRepresentante
		FROM edital edt
		INNER JOIN cadRepresentante r ON r.codRepresentante = edt.edt_representante
        INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = edt.edt_cliente
        INNER JOIN instituicao i ON i.inst_id = edt.edt_instituicao
		INNER JOIN usuarios u ON u.id = edt.edt_usuario 
		INNER JOIN editalStatus edtSt ON edtSt.stedt_id = edt.edt_status ";
            if($edtId) 
            {    
                $SQL.= " WHERE edt.edt_id = $edtId";
            }         
            $resultado = $this->select($SQL);
            $dados = $resultado->fetchAll();
            $lista = [];
            foreach ($dados as $dado) {                
                $edital = new Edital();
                $edital->setEdtId($dado['edt_id']);;
                $edital->setEdtNumero($dado['edt_numero']);
                $edital->setEdtDataAbertura($dado['edt_dataabertura']);
                $edital->setEdtHora($dado['edt_hora']);
                $edital->setEdtDataLimite($dado['edt_datalimite']);
                $edital->setEdtHoraLimite($dado['edt_horalimite']);
                $edital->setEdtIdentificador($dado['edt_identificador']);
                $edital->setEdtPortal($dado['edt_portal']);
                $edital->setEdtOperador($dado['edt_operador']);
                $edital->setEdtDataResultado($dado['edt_dataresultado']);
                $edital->setEdtProposta($dado['edt_proposta']);
                $edital->setEdtModalidade($dado['edt_modalidade']);
                $edital->setEdtTipo($dado['edt_tipo']);
                $edital->setEdtGarantia($dado['edt_garantia']);
                $edital->setEdtValor(number_format($dado['edt_valor'], 2, ',', '.'));
                $edital->setEdtStatus($dado['edt_status']);
                $edital->setEdtAnalise($dado['edt_analise']);
                $edital->setEdtObservacao($dado['edt_observacao']);
                $edital->setEdtAnexo($dado['edt_anexo']);
                $edital->setEdtDataAlteracao($dado['edt_dataabertura']);
                $edital->setEdtDataCadastro($dado['edt_datacadastro']);
                $edital->setEdtDataAlteracao($dado['edt_dataalteracao']);
                $edital->setRepresentante(new Representante());
                $edital->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
                $edital->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
                $edital->setClienteLicitacao(new ClienteLicitacao());
                $edital->getClienteLicitacao()->setCodCliente($dado['licitacaoCliente_cod']);
                $edital->getClienteLicitacao()->setNomeFantasia($dado['nomefantasia']);
                $edital->getClienteLicitacao()->setRazaoSocial($dado['razaosocial']);
                $edital->getClienteLicitacao()->setCnpj($dado['CNPJ']);
                $edital->getClienteLicitacao()->setTrocaMarca($dado['trocamarca']);
                $edital->setInstituicao(new Instituicao());
                $edital->getInstituicao()->setInst_Id($dado['inst_id']);                    
                $edital->getInstituicao()->setInst_Nome($dado['inst_nome']);                    
                $edital->setUsuario(new Usuario());
                $edital->getUsuario()->setId($dado['id']);
                $edital->getUsuario()->setNome($dado['nome']);
                $edital->setEditalStatus(new EditalStatus());
                $edital->getEditalStatus()->setStEdtId($dado['stedt_id']);;
                $edital->getEditalStatus()->setStEdtNome($dado['stedt_nome']);
                
                $lista[] = $edital;
            }
            return $lista;        
                
    }

  
   /* 
   public function listarPorEdital($edtNome = null)
    {
        if($edtNome)
        {
            $resultado = $this->select(
                "SELECT * 
                FROM cidade c
                INNER JOIN estado e ON e.estid = cidestado 
                INNER JOIN usuarios u ON u.id = cidusuario WHERE c. = $edtNome"
            );
        }
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Edital::class);
    }*/

    
    public function autoCompleteEditalClienteRazaoSocial(ClienteLicitacao $clienteLicitacao)
    {
        $resultado = $this->select(
            " SELECT edt.edt_id, edt.edt_numero, c.licitacaoCliente_cod, c.razaosocial,c.nomefantasia
            FROM edital edt
            INNER JOIN cadRepresentante r ON r.codRepresentante = edt.edt_representante
            INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = edt.edt_cliente
            INNER JOIN instituicao i ON i.inst_id = edt.edt_instituicao
            INNER JOIN usuarios u ON u.id = edt.edt_usuario 
            WHERE c.razaosocial
                        LIKE '%".$clienteLicitacao->getRazaoSocial()."%' ORDER BY edt.edt_numero LIMIT 0,6"
        );
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function autoCompleteNumeroEditalCodCliente(Edital $edital, ClienteLicitacao $clienteLicitacao)
    {
        $resultado = $this->select(
            " SELECT edt.edt_id, edt.edt_numero, c.licitacaoCliente_cod, c.razaosocial,c.nomefantasia
            FROM edital edt
            INNER JOIN cadRepresentante r ON r.codRepresentante = edt.edt_representante
            INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = edt.edt_cliente
            INNER JOIN instituicao i ON i.inst_id = edt.edt_instituicao
            INNER JOIN usuarios u ON u.id = edt.edt_usuario 
            WHERE edt.edt_numero
                        LIKE '%".$edital->getEdtNumero()."%' AND c.licitacaoCliente_cod = ".$clienteLicitacao->getCodCliente()." ORDER BY edt.edt_numero LIMIT 0,6"
        );
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);
    }
    /*public  function listaPorNome(Edital $edital)
    {       
        $resultado = $this->select(
            "SELECT * FROM cidade WHERE cidnome 
             like '%".$edital->getCidNome()."%' LIMIT 0,6 "
        );        
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);        
    }*/

    public  function salvar(Edital $edital)
    {      
        try {
            $edtNumero                     = $edital->getEdtNumero();
            $edtDataAbertura               = $edital->getEdtDataAbertura()->format('Y-m-d');
            $edtHora                       = $edital->getEdtHora()->format('H:i:s');
           // $edtDataResultado              = $edital->getEdtDataResultado()->format('Y-m-d H:i:s');
            $edtProposta                   = $edital->getEdtProposta();
            $edtHoraLimite                 = $edital->getEdtHoraLimite()->format('H:i:s');
            $edtDataLimite                 = $edital->getEdtDataLimite()->format('Y-m-d');
            $edtIdentificador              = $edital->getEdtIdentificador();
            $edtPortal                     = $edital->getEdtPortal    ();
            $edtUsuario                    = $edital->getEdtOperador();
            $edtOperador                   = $edital->getUsuario()->getApelido();           
            $edtModalidade                 = $edital->getEdtModalidade();
            $edtTipo                       = $edital->getEdtTipo();
            $edtGarantia                   = $edital->getEdtGarantia();
            //$edtValor                       = $edital->getEdtValor();
           // $edtValor                      = str_replace(",", ".", $valorAtual);
            $edtStatus                    = $edital->getEditalStatus()->getStEdtId();
            $edtAnalise                    = $edital->getEdtAnalise();
            $edtObservacao                 = $edital->getEdtObservacao();
            $edtAnexo                      = $edital->getEdtAnexo();
            $edtRepresentante              = $edital->getRepresentante()->getCodRepresentante();
            $edtCliente                    = $edital->getClienteLicitacao()->getCodCliente();
            $edtInstituicao                = $edital->getInstituicao()->getInst_Id();
            $edtDataCadastro               = $edital->getEdtDataCadastro()->format('Y-m-d H:i:s');
            $edtDataAlteracao              = $edital->getEdtDataAlteracao()->format('Y-m-d H:i:s');
            $edtAnexo                      = $this->anexo($edtAnexo);
            $disputa                       = $edital->getDisputa();
            $justificativa                 = $edital->getJustificativa();

            return $this->insert(
                'edital',
                ":edt_numero,:edt_dataabertura,:edt_hora,:edt_horalimite,:edt_datalimite, :edt_proposta,
                :edt_modalidade,:edt_tipo,:edt_garantia,:edt_status,:edt_portal, :edt_identificador,:edt_operador,
                :edt_analise,:edt_observacao,:edt_anexo,:edt_representante,:edt_cliente,
                :edt_usuario,:edt_instituicao,:edt_datacadastro,:edt_dataalteracao, :edt_disputa, :edt_justificativa",
                [
                    ':edt_numero'           => $edtNumero,
                    ':edt_dataabertura'     => $edtDataAbertura,
                    ':edt_datalimite'       => $edtDataLimite,
                    ':edt_horalimite'       => $edtHoraLimite,
                    ':edt_operador'         => $edtOperador,
                    ':edt_identificador'    => $edtIdentificador,
                    ':edt_portal'           => $edtPortal,
                    ':edt_hora'             => $edtHora,
                    ':edt_proposta'         => $edtProposta,
                    ':edt_modalidade'       => $edtModalidade,
                    ':edt_tipo'             => $edtTipo,
                    ':edt_garantia'         => $edtGarantia,             
                    ':edt_status'           => $edtStatus,
                    ':edt_analise'          => $edtAnalise,
                    ':edt_observacao'       => $edtObservacao,
                    ':edt_anexo'            => $edtAnexo,
                    ':edt_representante'    => $edtRepresentante,
                    ':edt_cliente'          => $edtCliente,
                    ':edt_usuario'          => $edtUsuario,
                    ':edt_instituicao'      => $edtInstituicao,
                    ':edt_datacadastro'     => $edtDataCadastro,
                    ':edt_dataalteracao'    => $edtDataAlteracao,
                    ':edt_disputa'          => $disputa,
                    ':edt_justificativa'    => $justificativa
                    ]
                );
            } catch (\Exception $e) {               
                throw new \Exception("Erro na gravação de dados. " . $e, 500);
            }
    }

    public  function atualizar(Edital $edital)
    {
        try {            
            $edtId                         = $edital->getEdtId();
            $edtNumero                     = $edital->getEdtNumero();
            $edtDataAbertura               = $edital->getEdtDataAbertura()->format('Y-m-d');
            $edtHora                       = $edital->getEdtHora()->format('H:i:s');
            $edtHoraLimite                 = $edital->getEdtHoraLimite()->format('H:i:s');
            $edtDataLimite                 = $edital->getEdtDataLimite()->format('Y-m-d');
            $edtIdentificador              = $edital->getEdtIdentificador();
            $edtPortal                     = $edital->getEdtPortal();
            $edtUsuario                    = $edital->getEdtOperador();
            $edtOperador                   = $edital->getUsuario()->getApelido();           
            //$edtDataResultado            = $edital->getEdtDataResultado()->format('Y-m-d H:i:s');
            $edtProposta                   = $edital->getEdtProposta();
            $edtModalidade                 = $edital->getEdtModalidade();
            $edtTipo                       = $edital->getEdtTipo();
            $edtGarantia                   = $edital->getEdtGarantia();
            $edtValor                      = $edital->getEdtValor();
           // $edtValor                      = str_replace(",", ".", $valorAtual);
            $edtStatus                     = $edital->getEditalStatus()->getStEdtId();
            $edtAnalise                    = $edital->getEdtAnalise();
            $edtObservacao                 = $edital->getEdtObservacao();
            $edtAnexo                      = $edital->getEdtAnexo();
            $edtRepresentante              = $edital->getRepresentante()->getCodRepresentante();
            $edtCliente                    = $edital->getClienteLicitacao()->getCodCliente();
            $edtInstituicao                = $edital->getInstituicao()->getInst_Id();
           // $edtDataCadastro               = $edital->getEdtDataCadastro()->format('Y-m-d H:i:s');
            $edtDataAlteracao              = $edital->getEdtDataAlteracao()->format('Y-m-d H:i:s');
            $edtAnexo                      = $this->anexo($edtAnexo);
            $disputa                       = $edital->getDisputa();
            $justificativa                 = $edital->getJustificativa();

            return $this->update(
                'edital',
                "edt_numero= :edtNumero, edt_datalimite= :edtDataLimite,edt_dataabertura= :edtDataAbertura, edt_horalimite= :edtHoraLimite, edt_hora= :edtHora,  edt_proposta= :edtProposta, edt_modalidade= :edtModalidade, 
                edt_valor= :edtValor, edt_tipo= :edtTipo, edt_garantia= :edtGarantia, edt_operador =:edtOperador, edt_portal =:edtPortal, edt_identificador =:edtIdentificador, edt_status= :edtStatus, edt_analise= :edtAnalise, edt_observacao= :edtObservacao, edt_anexo= :edtAnexo, 
                edt_representante= :edtRepresentante, edt_cliente= :edtCliente, edt_usuario= :edtUsuario, edt_instituicao= :edtInstituicao, edt_dataalteracao=:edtDataAlteracao, edt_disputa =:disputa, edt_justificativa =:justificativa",
                [
                    ':edtId' => $edtId,
                    ':edtNumero' => $edtNumero,
                    ':edtDataAbertura' => $edtDataAbertura,
                    ':edtHora' => $edtHora,
                    ':edtDataLimite' => $edtDataLimite,
                    ':edtHoraLimite' => $edtHoraLimite,
                    ':edtOperador' => $edtOperador,
                    ':edtIdentificador' => $edtIdentificador,
                    ':edtPortal' => $edtPortal,
                    ':edtProposta' => $edtProposta,
                    ':edtModalidade' => $edtModalidade,
                    ':edtTipo' => $edtTipo,
                   ':edtValor' => $edtValor,
                    ':edtGarantia' => $edtGarantia,
                    ':edtStatus' => $edtStatus,
                    ':edtAnalise' => $edtAnalise,
                    ':edtObservacao' => $edtObservacao,
                    ':edtAnexo' => $edtAnexo,
                    ':edtRepresentante' => $edtRepresentante,
                    ':edtCliente' => $edtCliente,
                    ':edtUsuario' => $edtUsuario,
                    ':edtInstituicao' => $edtInstituicao,
                    ':edtDataAlteracao' => $edtDataAlteracao, 
                    ':disputa'             => $disputa,
                    ':justificativa'        => $justificativa,
                ],
                "edt_id = :edtId"
                );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }

    public function excluir(Edital $edital)
    {
        try {
            $edtId = $edital->getEdtId();
            $this->delete('notificacao', "ntf_edital = $edtId");
            $this->delete('contrato', "ctr_edital = $edtId");
            $this->delete('crt_garantia', "grt_pk_edtital = $edtId");
            $this->delete('edital', "edt_id = $edtId");
        } catch (\Exception $e) {
            throw new \Exception("Erro ao excluir edital", 500);
        }
    }
    public function anexo($anexo)
    {
        $nomeanexo = date('Y-m-d-h:i:s');
            if (!$_FILES['anexo']['name'] == "") {
                $validextensions = array("jpeg", "jpg", "png", "PNG", "JPG", "JPEG", "pdf", "PDF", "docx","zip","doc");
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
    private $Resultado;
     /**
     * Get the value of Resultado
     */ 
    public function getResultado()
    {
        return $this->Resultado;
    }
    public function proximosEditais()
    {     
         //quantidade licitacoes nos proximos 10 dias
         $sql = " SELECT count(*) AS totalLicitacoes
         FROM edital e
         INNER JOIN editalStatus es ON es.stedt_id = e.edt_status
         WHERE es.stedt_nome NOT IN ('ADJUDICADO','ARREMATADO','CONTRATO','PERDIDO','DESCLASSIFICADO','DESISTIDO','SUSPENSO','ANULADO') 
         and e.edt_datalimite BETWEEN '".date('Y-m-d ')."' AND '".date('Y-m-d', strtotime('+10 days'))."' ";
         
         $totalLicitacoes = $this->select($sql);
         $this->Resultado['totalLicitacoes'] = $totalLicitacoes->fetch();
        
         if($this->Resultado['totalLicitacoes'][0] > 0){
             
             $this->Resultado['totalLicitacoes'] = $totalLicitacoes->fetch();
            //quantidade licitacoes finalizadas
            $sql = " SELECT COUNT(edt.edt_id) AS Finalizados
                FROM edital edt
                INNER JOIN instituicao i ON i.inst_id = edt.edt_instituicao
                INNER JOIN editalStatus edtSt ON edtSt.stedt_id = edt.edt_status 
                WHERE edt.edt_status IN ('10','11','12','13','14') ";
            
                $resultado = $this->select($sql);
                $this->Resultado['Finalizados'] = $resultado->fetch();
                
                //quantidade licitacoes Pendentes
            $sql = " SELECT COUNT(edt.edt_id) AS Pendentes
            		FROM edital edt
            		INNER JOIN editalStatus edtSt ON edtSt.stedt_id = edt.edt_status
            		WHERE edt.edt_status NOT IN ('8','9','10','11','12','13','14') 
            		and edt.edt_dataabertura < '".date('Y-m-d', strtotime('-1 days'))."' ";
                    
                $resultado = $this->select($sql);
                $this->Resultado['Pendentes'] = $resultado->fetch();
            
            //quantidade licitacoes nos proximos 10 dias
            $sql = " SELECT count(*) AS totalLicitacoes
                FROM edital e
                INNER JOIN editalStatus es ON es.stedt_id = e.edt_status
                WHERE es.stedt_nome NOT IN ('ADJUDICADO','ARREMATADO','CONTRATO','PERDIDO','DESCLASSIFICADO','DESISTIDO','SUSPENSO','ANULADO') 
                and e.edt_datalimite BETWEEN '".date('Y-m-d ')."' AND '".date('Y-m-d', strtotime('+10 days'))."' ";
                
                $totalLicitacoes = $this->select($sql);
                $this->Resultado['totalLicitacoes'] = $totalLicitacoes->fetch();
            //todas as licitacoes nos proximos 10 dias
            $sql = "SELECT edt.edt_id, edt.edt_numero, edt.edt_dataabertura, edt.edt_hora, edt.edt_datalimite, edt.edt_horalimite, edt.edt_identificador, edt.edt_disputa,
                edt.edt_portal, edt.edt_operador, edt.edt_dataresultado, edt.edt_proposta, edt.edt_modalidade, edt.edt_tipo, edt.edt_garantia, edt.edt_valor,edt_status, edt.edt_analise, edt.edt_observacao, edt.edt_anexo, edt.edt_datacadastro, edt.edt_dataalteracao,
                r.codRepresentante, r.nomeRepresentante, c.nomefantasia, c.razaosocial, c.CNPJ, c.trocamarca, i.inst_id, i.inst_nome, i.inst_nomeFantasia, u.id, u.nome, u.apelido, u.email, edtSt.stedt_id, edtSt.stedt_nome, 
                cor.cor_id, cor.cor_nome, cor.cor_cor
                FROM edital edt
                INNER JOIN cadRepresentante r ON r.codRepresentante = edt.edt_representante
                INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = edt.edt_cliente
                INNER JOIN instituicao i ON i.inst_id = edt.edt_instituicao
                INNER JOIN usuarios u ON u.id = edt.edt_usuario 
                INNER JOIN editalStatus edtSt ON edtSt.stedt_id = edt.edt_status
                INNER JOIN cors cor ON cor.cor_id = edtSt.cor_id 
                WHERE edtSt.stedt_nome NOT IN ('ADJUDICADO','ARREMATADO','CONTRATO','PERDIDO','DESCLASSIFICADO','DESISTIDO','SUSPENSO','ANULADO') 
                and edt.edt_datalimite BETWEEN '".date('Y-m-d ')."' AND '".date('Y-m-d', strtotime('+10 days'))."' ORDER BY edt.edt_datalimite, edt.edt_horalimite, i.inst_nome";
                
                $totalLicitacoes = $this->select($sql);
                $this->Resultado['Licitacoes'] = $totalLicitacoes->fetchAll();

        
            return $this->Resultado;        
        }else{
            return false;
        }                
    }

}
