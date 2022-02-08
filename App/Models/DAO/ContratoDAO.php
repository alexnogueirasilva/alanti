<?php

namespace App\Models\DAO;

use App\Models\Entidades\Contrato;
use App\Models\Entidades\Edital;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Representante;
use App\Models\Entidades\ClienteLicitacao;
use Exception;

class ContratoDAO extends BaseDAO
{
    public  function listar($ctrId = null)
    {        
        
        $sql = " SELECT ctr.ctr_id, ctr.ctr_numero, ctr.ctr_datainicio, ctr.ctr_datavencimento, ctr.ctr_valor,ctr.ctr_status,
        ctr.ctr_prazoentrega, ctr.ctr_prazopagamento, ctr.ctr_anexo, ctr.ctr_observacao, edt.edt_id, edt.edt_numero, r.codRepresentante,    
        r.nomeRepresentante, c.licitacaoCliente_cod, c.nomefantasia, c.razaosocial, c.CNPJ, u.nome, u.apelido, i.inst_nomeFantasia, i.inst_id
		FROM contrato ctr
		INNER JOIN edital edt ON edt.edt_id = ctr.ctr_edital
		INNER JOIN cadRepresentante r ON r.codRepresentante = edt.edt_representante
        INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = edt.edt_cliente
        INNER JOIN instituicao i ON i.inst_id = edt.edt_instituicao
        INNER JOIN usuarios u ON u.id = edt.edt_usuario ";
        
        if($ctrId) 
        {    
            $sql.= " WHERE ctr.ctr_id = $ctrId";
        }         
        $resultado = $this->select($sql);
        $dados = $resultado->fetchAll();
        $lista = [];
       
        foreach ($dados as $dado) {                
        $contrato = new Contrato();
        $contrato->setCtrId($dado['ctr_id']);
        $contrato->setCtrNumero($dado['ctr_numero']);
        $contrato->setCtrDataInicio($dado['ctr_datainicio']);
        $contrato->setCtrDataVencimento($dado['ctr_datavencimento']);            
        $contrato->setCtrValor(number_format($dado['ctr_valor'], 2, ',', '.'));
        $contrato->setCtrStatus($dado['ctr_status']);
        $contrato->setCtrObservacao($dado['ctr_observacao']);
        $contrato->setCtrAnexo($dado['ctr_anexo']);
        $contrato->setCtrPrazoEntrega($dado['ctr_prazoentrega']);
        $contrato->setCtrPrazoPagamento($dado['ctr_prazopagamento']);
        $contrato->setCtrUsuario($dado['ctr_usuario']);
        $contrato->setCtrInstituicao($dado['ctr_instituicao']);
        $contrato->setCtrDataCadastro($dado['ctr_datacadastro']);
        $contrato->setCtrDataAlteracao($dado['ctr_dataalteracao']);
        $contrato->setEdital(new Edital());
        $contrato->getEdital()->setEdtId($dado['edt_id']);;
        $contrato->getEdital()->setEdtNumero($dado['edt_numero']);
        $contrato->getEdital()->setEdtDataAbertura($dado['edt_dataabertura']);
        $contrato->getEdital()->setEdtHora($dado['edt_hora']);
        $contrato->getEdital()->setEdtDataResultado($dado['edt_dataresultado']);
        $contrato->getEdital()->setEdtProposta($dado['edt_proposta']);
        $contrato->getEdital()->setEdtModalidade($dado['edt_modalidade']);
        $contrato->getEdital()->setEdtTipo($dado['edt_tipo']);
        $contrato->getEdital()->setEdtGarantia($dado['edt_garantia']);
        $contrato->getEdital()->setEdtValor(number_format($dado['edt_valor'], 2, ',', '.'));
        $contrato->getEdital()->setEdtStatus($dado['edt_status']);
        $contrato->getEdital()->setEdtAnalise($dado['edt_analise']);
        $contrato->getEdital()->setEdtObservacao($dado['edt_observacao']);
        $contrato->getEdital()->setEdtAnexo($dado['edt_anexo']);
        $contrato->getEdital()->setEdtDataAlteracao($dado['edt_dataabertura']);
        $contrato->getEdital()->setEdtDataCadastro($dado['edt_datacadastro']);
        $contrato->getEdital()->setEdtDataAlteracao($dado['edt_dataalteracao']);               
        $contrato->setRepresentante(new Representante());               
        $contrato->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
        $contrato->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']); 
        $contrato->setClienteLicitacao(new ClienteLicitacao());
        $contrato->getClienteLicitacao()->setCodCliente($dado['licitacaoCliente_cod']);
        $contrato->getClienteLicitacao()->setNomeFantasia($dado['nomefantasia']);
        $contrato->getClienteLicitacao()->setRazaoSocial($dado['razaosocial']);
        $contrato->getClienteLicitacao()->setCnpj($dado['CNPJ']);
        $contrato->getClienteLicitacao()->setTipoCliente($dado['tipo']);
        $contrato->getClienteLicitacao()->setTrocaMarca($dado['trocamarca']);
        $contrato->setInstituicao(new Instituicao());
        $contrato->getInstituicao()->setInst_Id($dado['inst_id']);                    
        $contrato->getInstituicao()->setInst_Nome($dado['inst_nome']);                    
        $contrato->getInstituicao()->setInst_Nome($dado['inst_nomeFantasia']);                    
        $contrato->setUsuario(new Usuario());
        $contrato->getUsuario()->setId($dado['id']);
        $contrato->getUsuario()->setNome($dado['nome']);
        $contrato->getUsuario()->setApelido($dado['apelido']);

                $lista[] = $contrato;
            }
            return $lista;        
                
    }
    public  function listarRepresentanteContrato($ctrId = null)
    {        
        $sql = " SELECT distinct(r.codRepresentante), r.codRepresentante, r.nomeRepresentante		
        FROM contrato c        
        INNER JOIN edital e ON e.edt_id = c.ctr_edital       
        INNER JOIN cadRepresentante r ON r.codRepresentante = e.edt_representante ";
        if($ctrId) 
        {    
            $sql.= " WHERE ctr.ctr_id = $ctrId";
        }         
        
        $resultado = $this->select($sql);
        $dados = $resultado->fetchAll();
        $lista = [];
        foreach ($dados as $dado) {  
                
            $contrato = new Contrato();
            
            $contrato->setEdital(new Edital());
            $contrato->getEdital()->setRepresentante(new Representante());               
            $contrato->getEdital()->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
            $contrato->getEdital()->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);  

                $lista[] = $contrato;
            }
            return $lista;        
                
    }
    public  function listarClienteContrato($ctrId = null)
    {        
        $sql = " SELECT distinct(c.razaosocial), c.licitacaoCliente_cod, c.nomefantasia
		FROM contrato ctr
		INNER JOIN edital edt ON edt.edt_id = ctr.ctr_edital		
        INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = edt.edt_cliente ";
        if($ctrId) 
        {    
            $sql.= " WHERE ctr.ctr_id = $ctrId";
        }         
        
        $resultado = $this->select($sql);
        $dados = $resultado->fetchAll();
        $lista = [];
        foreach ($dados as $dado) {  

            $contrato = new Contrato();
            $contrato->setEdital(new Edital());
            $contrato->getEdital()->setClienteLicitacao(new ClienteLicitacao());
            $contrato->getEdital()->getClienteLicitacao()->setCodCliente($dado['licitacaoCliente_cod']);
            $contrato->getEdital()->getClienteLicitacao()->setNomeFantasia($dado['nomefantasia']);
            $contrato->getEdital()->getClienteLicitacao()->setRazaoSocial($dado['razaosocial']);

            $lista[] = $contrato;
        }
            return $lista;        
                
    }
    public  function listarPorEdital($ctrId = null)
    {        
        $sql = " SELECT * FROM contrato ";
            if($ctrId) 
            {    
                $sql.= " WHERE ctr_edital = $ctrId";
            }         
            
            $resultado = $this->select($sql);
            $dados = $resultado->fetchAll();
            $lista = [];
            foreach ($dados as $dado) {  
               
        $contrato = new Contrato();
        $contrato->setCtrId($dado['ctr_id']);
        $contrato->setCtrNumero($dado['ctr_numero']);
        $contrato->setCtrDataInicio($dado['ctr_datainicio']);
        $contrato->setCtrDataVencimento($dado['ctr_datavencimento']);            
        $contrato->setCtrValor(number_format($dado['ctr_valor'], 2, ',', '.'));
        $contrato->setCtrStatus($dado['ctr_status']);
        $contrato->setCtrObservacao($dado['ctr_observacao']);
        $contrato->setCtrAnexo($dado['ctr_anexo']);
        $contrato->setCtrPrazoEntrega($dado['ctr_prazoentrega']);
        $contrato->setCtrPrazoPagamento($dado['ctr_prazopagamento']);
        $contrato->setCtrUsuario($dado['ctr_usuario']);
        $contrato->setCtrInstituicao($dado['ctr_instituicao']);
        $contrato->setCtrDataCadastro($dado['ctr_datacadastro']);
        $contrato->setCtrDataAlteracao($dado['ctr_dataalteracao']);

                $lista[] = $contrato;
            }
            return $lista;        
                
    }
  public  function qtdeContratoPorEdital($ctrId = null)
    {        
        $sql = " SELECT COUNT(*) as total FROM contrato ";
               
        if($ctrId) 
        {    
            $sql.= " WHERE ctr_edital = $ctrId";
        }else{
            $sql .= " WHERE ctr_status NOT IN ('Vencido', 'VENCIDO') ";
        } 
            $resultado = $this->select($sql);           
            $dado = $resultado->fetch();
            if ($dado) {
                $contrato = new Contrato();               
                $contrato->setCtrNumero($dado['total']);
                
            }
                return $contrato;                         
    }
    
    public  function qtdeContratoVencido($ctrId = null)
    {        
        $sql = " SELECT COUNT(*) as totalVencido FROM contrato ";
               
        if($ctrId) 
        {    
            $sql.= " WHERE ctr_edital = $ctrId";
        }else{
            $sql .= " WHERE ctr_status IN ('Vencido', 'VENCIDO') ";
        }   
            $resultado = $this->select($sql);           
            $dado = $resultado->fetch();
            if ($dado) {
                $contrato = new Contrato();               
                $contrato->setCtrNumero($dado['totalVencido']);
                
            }
                return $contrato;                         
    }
  
    public  function listarDinamico(Contrato $contrato)
    {   
        $codCliente         = $contrato->getCtrClienteLicitacao();
        $representante      = $contrato->getCtrRepresentante();
        $codContrato        = $contrato->getCtrId();
        $edital             = $contrato->getCodEdital();
        $numeroContrato     = $contrato->getCtrNumero();
        $status             = $contrato->getCtrStatus();
        $modalidade         = $contrato->getCtrModalidade();
        $numeroLicitacao    = $contrato->getCtrNumeroLicitacao();        
        
        /* inicio anterior
        $sql = " SELECT * 
		FROM contrato ctr
		INNER JOIN edital edt ON edt.edt_id = ctr.ctr_edital
		INNER JOIN cadRepresentante r ON r.codRepresentante = ctr.ctr_representante
        INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = ctr.ctr_clientelicitacao
        INNER JOIN instituicao i ON i.inst_id = edt.edt_instituicao
        INNER JOIN usuarios u ON u.id = ctr.ctr_usuario ";
        fim anterior */

        $sql = " SELECT c.ctr_id, c.ctr_numero, c.ctr_prazoentrega, c.ctr_prazopagamento, c.ctr_datainicio, c.ctr_datavencimento, c.ctr_datacadastro, c.ctr_dataalteracao, c.ctr_valor, c.ctr_status, c.ctr_anexo, c.ctr_observacao, c.ctr_usuario,
        u.id, u.apelido, u.nome,
        e.edt_id, e.edt_numero, e.edt_modalidade,
        cl.licitacaoCliente_cod, cl.razaosocial, cl.nomefantasia, cl.tipo,
        r.codRepresentante, r.nomeRepresentante,
        i.inst_id, i.inst_nomeFantasia
        FROM contrato c
        INNER JOIN usuarios u ON u.id = c.ctr_usuario
        INNER JOIN edital e ON e.edt_id = c.ctr_edital
        INNER JOIN clienteLicitacao cl ON cl.licitacaoCliente_cod = e.edt_cliente
        INNER JOIN cadRepresentante r ON r.codRepresentante = e.edt_representante
        INNER JOIN instituicao i ON i.inst_id = e.edt_instituicao ";               

        $where = Array();
		if( $codCliente ){ $where[] = " cl.licitacaoCliente_cod = {$codCliente}"; }
		if( $representante ){ $where[] = " r.codRepresentante = {$representante}"; }
        if( $codContrato ){ $where[] = " c.ctr_id = {$codContrato}"; }
		if( $numeroContrato ){ $where[] = " c.ctr_numero LIKE '%{$numeroContrato}%'"; }
		if( $status ){ $where[] = " c.ctr_status = '{$status}'"; }
        if( $edital ){ $where[] = " e.edt_id = {$edital}"; }
		if( $modalidade ){ $where[] = " e.edt_modalidade = '{$modalidade}'"; }
        if( $numeroLicitacao ){ $where[] = " e.edt_numero LIKE '%{$numeroLicitacao}%'"; }   
     
        if( sizeof( $where ) )
        $sql .= ' WHERE '.implode( ' AND ',$where );    
        
        $resultado = $this->select($sql);
        $dados = $resultado->fetchAll();
       
            $lista = [];
            foreach ($dados as $dado) {                
                $contrato = new Contrato();
                $contrato->setCtrId($dado['ctr_id']);
                $contrato->setCtrNumero($dado['ctr_numero']);
                $contrato->setCtrPrazoEntrega($dado['ctr_prazoentrega']);
                $contrato->setCtrPrazoPagamento($dado['ctr_prazopagamento']);
                $contrato->setCtrDataInicio($dado['ctr_datainicio']);
                $contrato->setCtrDataVencimento($dado['ctr_datavencimento']);            
                $contrato->setCtrValor(number_format($dado['ctr_valor'], 2, ',', '.'));
                $contrato->setCtrStatus($dado['ctr_status']);
                $contrato->setCtrAnexo($dado['ctr_anexo']);
                $contrato->setCtrObservacao($dado['ctr_observacao']);
                $contrato->setCtrUsuario($dado['ctr_usuario']);
                $contrato->setCtrDataCadastro($dado['ctr_datacadastro']);
                $contrato->setCtrDataAlteracao($dado['ctr_dataalteracao']);
                $contrato->setEdital(new Edital());
                $contrato->getEdital()->setEdtId($dado['edt_id']);;
                $contrato->getEdital()->setEdtNumero($dado['edt_numero']);
                $contrato->getEdital()->setEdtDataAbertura($dado['edt_dataabertura']);
                $contrato->getEdital()->setEdtHora($dado['edt_hora']);
                $contrato->getEdital()->setEdtDataResultado($dado['edt_dataresultado']);
                $contrato->getEdital()->setEdtProposta($dado['edt_proposta']);
                $contrato->getEdital()->setEdtModalidade($dado['edt_modalidade']);
                $contrato->getEdital()->setEdtTipo($dado['edt_tipo']);
                $contrato->getEdital()->setEdtGarantia($dado['edt_garantia']);
                $contrato->getEdital()->setEdtValor(number_format($dado['edt_valor'], 2, ',', '.'));
                $contrato->getEdital()->setEdtStatus($dado['edt_status']);
                $contrato->getEdital()->setEdtAnalise($dado['edt_analise']);
                $contrato->getEdital()->setEdtObservacao($dado['edt_observacao']);
                $contrato->getEdital()->setEdtAnexo($dado['edt_anexo']);
                $contrato->getEdital()->setEdtDataAlteracao($dado['edt_dataabertura']);
                $contrato->getEdital()->setEdtDataCadastro($dado['edt_datacadastro']);
                $contrato->getEdital()->setEdtDataAlteracao($dado['edt_dataalteracao']);               
                $contrato->getEdital()->setRepresentante(new Representante());               
                $contrato->getEdital()->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
                $contrato->getEdital()->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
                $contrato->getEdital()->setClienteLicitacao(new ClienteLicitacao());
                $contrato->getEdital()->getClienteLicitacao()->setCodCliente($dado['licitacaoCliente_cod']);
                $contrato->getEdital()->getClienteLicitacao()->setNomeFantasia($dado['nomefantasia']);
                $contrato->getEdital()->getClienteLicitacao()->setRazaoSocial($dado['razaosocial']);
                $contrato->getEdital()->getClienteLicitacao()->setCnpj($dado['CNPJ']);
                $contrato->getEdital()->getClienteLicitacao()->setTipoCliente($dado['tipo']);
                $contrato->getEdital()->getClienteLicitacao()->setTrocaMarca($dado['trocamarca']);
                $contrato->setInstituicao(new Instituicao());
                $contrato->getInstituicao()->setInst_Id($dado['inst_id']);                    
                $contrato->getInstituicao()->setInst_Nome($dado['inst_nome']);                               
                $contrato->getInstituicao()->setInst_NomeFantasia($dado['inst_nomeFantasia']);                  
                $contrato->setUsuario(new Usuario());
                $contrato->getUsuario()->setId($dado['id']);
                $contrato->getUsuario()->setNome($dado['nome']);
                $contrato->getUsuario()->setApelido($dado['apelido']);
                
                $lista[] = $contrato;
            }
            return $lista;        
                
    }
    public function autoCompleteContratoClienteRazaoSocial(ClienteLicitacao $clienteLicitacao)
    {
        $resultado = $this->select(
            " SELECT * 
            FROM contrato ctr
            INNER JOIN edital edt ON edt.edt_id = ctr.ctr_edital            
             INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = edt.edt_cliente            
            WHERE c.razaosocial
            LIKE '%".$clienteLicitacao->getRazaoSocial()."%' ORDER BY edt.edt_numero LIMIT 0,6"
        );
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function autoCompleteNumeroContratoCodCliente(Edital $edital, ClienteLicitacao $clienteLicitacao)
    {
        $sql = "SELECT * 
        FROM contrato ctr
        INNER JOIN edital edt ON edt.edt_id = ctr.ctr_edital       
        INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = edt.edt_cliente        
        WHERE edt.edt_numero
        LIKE '%".$edital->getEdtNumero()."%' AND c.licitacaoCliente_cod = ".$clienteLicitacao->getCodCliente()." ORDER BY edt.edt_numero LIMIT 0,6";
        $resultado = $this->select($sql);
        
var_dump($sql);
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function autoCompleteEditalClienteRazaoSocial(ClienteLicitacao $clienteLicitacao)
    {
        $resultado = $this->select(
            " SELECT edt.edt_id, c.licitacaoCliente_cod, edt.edt_numero,c.razaosocial,c.nomefantasia
                FROM edital edt
                INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = edt.edt_cliente
                WHERE c.razaosocial
                LIKE '%".$clienteLicitacao->getRazaoSocial()."%' ORDER BY edt.edt_numero LIMIT 0,6"
        );
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function autoCompleteNumeroEditalCodCliente(Edital $edital, ClienteLicitacao $clienteLicitacao)
    {
        $resultado = $this->select(
            " SELECT edt.edt_id, c.licitacaoCliente_cod, edt.edt_numero,c.razaosocial,c.nomefantasia, i.inst_nome, i.inst_nomeFantasia
            FROM edital edt            
            INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = edt.edt_cliente
            INNER JOIN instituicao i ON i.inst_id = edt.edt_instituicao
            INNER JOIN usuarios u ON u.id = edt.edt_usuario 
            WHERE edt.edt_numero
            LIKE '%".$edital->getEdtNumero()."%' AND c.licitacaoCliente_cod = ".$clienteLicitacao->getCodCliente()." ORDER BY edt.edt_numero LIMIT 0,6"
        );
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);
    }
    
   /* public function listarPorContrato($edtNome = null)
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
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Contrato::class);
    }*/

    public  function salvar(Contrato $contrato)
    {     
        try {
            $ctrNumero                     = $contrato->getCtrNumero();
            $ctrDataInicio                 = $contrato->getCtrDataInicio()->format('Y-m-d');
            $ctrDataVencimento             = $contrato->getCtrDataVencimento()->format('Y-m-d');
            $ctrValor                    = $contrato->getCtrValor();
           // $ctrValor                      = str_replace(",", ".", $valorAtual);
            $ctrStatus                     = $contrato->getCtrStatus();
            $ctrObservacao                 = $contrato->getCtrObservacao();
            $ctrAnexo                      = $contrato->getCtrAnexo();
            //$ctrClienteLicitacao           = $contrato->getClienteLicitacao()->getCodCliente();
            $ctrUsuario                    = $contrato->getUsuario()->getId();           
           // $ctrRepresentante              = $contrato->getRepresentante()->getCodRepresentante();           
           $ctrPrazoEntrega               = $contrato->getCtrPrazoEntrega();
           $ctrPrazoPagamento             = $contrato->getCtrPrazoPagamento();
           //$ctrInstituicao                = $contrato->getInstituicao()->getInst_Id();
           $ctrDataCadastro               = $contrato->getCtrDataCadastro()->format('Y-m-d h:m:s');
           $ctrEdital                     = $contrato->getEdital()->getEdtId();           
           $ctrDataAlteracao              = $contrato->getCtrDataAlteracao()->format('Y-m-d h:m:s');
            
            $ctrAnexo = $this->anexo($ctrAnexo);

            return $this->insert(
                'contrato',
                ":ctr_numero, :ctr_datainicio, :ctr_datavencimento, :ctr_valor, :ctr_status, :ctr_observacao, :ctr_anexo, :ctr_usuario, 
                :ctr_prazoentrega, :ctr_prazopagamento, :ctr_datacadastro, :ctr_dataalteracao, :ctr_edital",
                [
                    ':ctr_numero'           => $ctrNumero,
                    ':ctr_datainicio'       => $ctrDataInicio,
                    ':ctr_datavencimento'   => $ctrDataVencimento,
                    ':ctr_valor'            => $ctrValor,
                    ':ctr_status'           => $ctrStatus,
                    ':ctr_observacao'       => $ctrObservacao,
                    ':ctr_anexo'            => $ctrAnexo,
                    ':ctr_usuario'          => $ctrUsuario,
                    ':ctr_prazoentrega'     => $ctrPrazoEntrega,
                    ':ctr_prazopagamento'   => $ctrPrazoPagamento,
                    ':ctr_datacadastro'     => $ctrDataCadastro,
                    ':ctr_dataalteracao'    => $ctrDataAlteracao,
                    ':ctr_edital'           => $ctrEdital,
                    ':ctr_dataalteracao'    =>$ctrDataAlteracao
                    ]
                ); 
            } catch (\Exception $e) {        
                throw new \Exception("Erro na gravação de dados. " . $e, 500);
            }
    }
        
    /*public  function listaPorNome(Contrato $contrato)
    {       
        $resultado = $this->select(
            "SELECT * FROM cidade WHERE cidnome 
             like '%".$contrato->getCidNome()."%' LIMIT 0,6 "
        );        
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);        
    }*/

    public  function atualizar(Contrato $contrato)
    {
        try {          
            
            $ctrId                         = $contrato->getCtrId();
            $ctrNumero                     = $contrato->getCtrNumero();
            $ctrDataInicio                 = $contrato->getCtrDataInicio()->format('Y-m-d');
            $ctrDataVencimento             = $contrato->getCtrDataVencimento()->format('Y-m-d');
            $ctrValor                    = $contrato->getCtrValor();
           // $ctrValor                      = str_replace(',','.', str_replace(".", "", $valorAtual));
            //str_replace(',','.', str_replace('.','', $_POST['txtSalario']))
           // var_dump($ctrValor);
            $ctrStatus                     = $contrato->getCtrStatus();
            $ctrObservacao                 = $contrato->getCtrObservacao();
            $ctrAnexo                      = $contrato->getCtrAnexo();
           // $ctrClienteLicitacao           = $contrato->getClienteLicitacao()->getCodCliente();
            $ctrUsuario                    = $contrato->getUsuario()->getId();           
            //$ctrRepresentante              = $contrato->getRepresentante()->getCodRepresentante();           
            $ctrPrazoEntrega               = $contrato->getCtrPrazoEntrega();
            $ctrPrazoPagamento             = $contrato->getCtrPrazoPagamento();
            //$ctrInstituicao                = $contrato->getInstituicao()->getInst_Id();
            // $ctrDataCadastro               = $contrato->getCtrDataCadastro()->format('Y-m-d h:m:s');
            $ctrDataAlteracao              = date('Y-m-d h:m:s');
            $ctrEdital                     = $contrato->getEdital()->getEdtId();           
            $ctrAnexo = $this->anexo($ctrAnexo);
            
            return $this->update(
                'contrato',               
                "ctr_numero= :ctrNumero, ctr_datainicio= :ctrDataInicio, ctr_datavencimento= :ctrDataVencimento, ctr_valor= :ctrValor, ctr_status= :ctrStatus, 
                 ctr_observacao= :ctrObservacao, ctr_anexo= :ctrAnexo, ctr_usuario =:ctrUsuario, 
                 ctr_prazoentrega= :ctrPrazoEntrega, ctr_prazopagamento= :ctrPrazoPagamento, ctr_dataalteracao= :ctrDataAlteracao, 
                 ctr_edital=:ctrEdital",
               [
                    ':ctrId'                => $ctrId,
                    ':ctrNumero'            => $ctrNumero,
                    ':ctrDataInicio'        => $ctrDataInicio,
                    ':ctrDataVencimento'    => $ctrDataVencimento,
                    ':ctrValor'             => $ctrValor,
                    ':ctrStatus'            => $ctrStatus,
                    ':ctrObservacao'        => $ctrObservacao,
                    ':ctrAnexo'             => $ctrAnexo,
                    ':ctrUsuario'           => $ctrUsuario,
                    ':ctrPrazoEntrega'      => $ctrPrazoEntrega,
                    ':ctrPrazoPagamento'    => $ctrPrazoPagamento,
                    ':ctrDataAlteracao'     => $ctrDataAlteracao, 
                    ':ctrEdital'            => $ctrEdital,
                ],
                "ctr_id = :ctrId"
  );
        } catch (\Exception $e) {
           
            throw new \Exception("Erro na gravação de dados. ", 500);
        }
    }

    public function excluir(Contrato $contrato)
    {
        try {
            $ctrId = $contrato->getCtrId();
            
            $this->delete('contrato', "ctr_id = $ctrId");
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
     private $Contrato;
    public function sicronizar()
    {
       $this->Contrato = $this->listarContratoScr();
       if($this->Contrato){                              
            return true;                
        }else{
            return false;
        }      
    }

    private function listarContratoScr()
    {
        $sql = " SELECT ctr_id, ctr_datavencimento, ctr_status FROM contrato where ctr_datavencimento < now() AND ctr_status != 'Vencido'";
        
        $resultado = $this->select($sql);

        $this->Contrato =  $resultado->fetchAll();
        if($this->Contrato){
            $this->sicronizarDados($this->Contrato); 
            return true;
        }else{            
            return false;
        }
    } 
       
    private function sicronizarDados(array $Dados)
    {       
        try { 
            foreach($Dados as $Contrato){
                extract($Contrato);//extraindo parar usar as colunas da tabel mysql como variavel
               
                $ctrId                         = $ctr_id;
                $ctrStatus                     = 'Vencido';
                $ctrUsuario                    = $_SESSION['id'];
                $ctrDataAlteracao              = date('Y-m-d h:m:s');

                 $this->update(
                    'contrato',               
                    "ctr_status= :ctrStatus, 
                   ctr_usuario =:ctrUsuario, 
                    ctr_dataalteracao= :ctrDataAlteracao",
                [
                        ':ctrId'                => $ctrId,
                        ':ctrStatus'            => $ctrStatus,
                        ':ctrUsuario'           => $ctrUsuario,
                        ':ctrDataAlteracao'     => $ctrDataAlteracao,
                    ],
                    "ctr_id = :ctrId"
                );
            }            
            return true;
        } catch (\Exception $e) {           
            throw new \Exception("Erro na gravação de dados. ", 500);
        }
    }

}
