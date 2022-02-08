<?php

namespace App\Models\DAO;

use App\Models\Entidades\Fornecedor;
use App\Models\Entidades\Cidade;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Estado;
use App\Models\Entidades\Pessoa;
use App\Models\Entidades\Situacoes;
use App\Models\Entidades\Cors;

class FornecedorDAO extends BaseDAO
{
    public  function listar(Fornecedor $fornecedor)
    {
       
        $codFonecedor      = $fornecedor->getFornecedor_Cod();
        $cnpj              = $fornecedor->getForCnpj();
        $razaoSocial       = $fornecedor->getForRazaoSocial();
        $nomeFantasia      = $fornecedor->getForNomeFantasia();
        $status            = $fornecedor->getForStatus();
        $tipoFonecedor     = $fornecedor->getForTipo();        

        $sql = " SELECT f.fornecedor_cod, f.nomefantasia, f.razaosocial, f.CNPJ,f.for_ie, f.for_tipo, f.for_observacao, f.for_email, f.for_contato, f.for_cargo, 
            f.for_celular, f.for_telefone, f.for_datacadastro, f.for_dataalteracao, p.pes_id, p.pes_tipo, 
            u.id, u.nome, u.apelido, u.email, u.nivel, end.end_id, end.end_longradouro, end.end_complemento, end.end_numero, end.end_bairro, end.end_cep, end.end_pontoreferencia, end.pessoa_id,
            cid.cid_id, cid.cid_nome, cid.estado_id, e.est_id, e.est_nome, e.est_uf,
            s.sit_id, s.sit_nome, s.cor_id, cor.cor_id, cor.cor_nome, cor.cor_cor
            FROM fornecedor f 
            INNER JOIN usuarios u on u.id = f.usuario_id
            INNER JOIN pessoas p ON p.pes_id = f.pessoa_id
            INNER JOIN enderecos end ON end.pessoa_id = f.pessoa_id                
            INNER JOIN cidades cid ON cid.cid_id = end.cidade_id
            INNER JOIN estados e ON e.est_id = cid.estado_id 
            INNER JOIN situacoes s ON s.sit_id = f.situacao_id
            INNER JOIN cors cor ON cor.cor_id = s.cor_id ";
        $where = Array();
        if( $codFonecedor){ $where[] = " f.fornecedor_cod = {$codFonecedor}"; }
    
        if( $cnpj  ){ $where[] = "  f.CNPJ LIKE '%{$cnpj }%'"; }
        if( $razaoSocial ){ $where[] = " f.razaosocial LIKE '%{$razaoSocial}%'"; }   
        if( $nomeFantasia ){ $where[] = " f.nomefantasia LIKE '%{$nomeFantasia}%'"; }                
        if( $status  ){ $where[] = " s.sit_nome LIKE '%{$status }%'"; }   
        if( $tipoFonecedor  ){ $where[] = " f.for_tipo LIKE '%{$tipoFonecedor }%'"; }            
                   
        if( sizeof( $where ) ){
            $sql .= ' WHERE '.implode( ' AND ',$where );
        }else {
            $sql.= " ORDER BY f.fornecedor_cod DESC ";
        }         
            $resultado = $this->select($sql );
            $dados = $resultado->fetchAll();

            if ($dados) {

                $lista = [];

                foreach ($dados as $dado) {           
                $fornecedor = new Fornecedor();
                $fornecedor->setFornecedor_Cod($dado['fornecedor_cod']);
                $fornecedor->setForRazaoSocial($dado['razaosocial']);
                $fornecedor->setForNomeFantasia($dado['nomefantasia']);
                $fornecedor->setForCnpj($dado['CNPJ']);
                $fornecedor->setForIE($dado['for_ie']);
                $fornecedor->setForTipo($dado['for_tipo']);
                $fornecedor->setForStatus($dado['for_status']);
                $fornecedor->setForObservacao($dado['for_observacao']);
                $fornecedor->setForEmail($dado['for_email']);
                $fornecedor->setForContato($dado['for_contato']);
                $fornecedor->setForCargo($dado['for_cargo']);
                $fornecedor->setForCelular($dado['for_celular']);
                $fornecedor->setForTelefone($dado['for_telefone']);
                $fornecedor->setForDataCadastro($dado['for_datacadastro']);
                $fornecedor->setForDataAlteracao($dado['for_dataalteracao']);
                $fornecedor->setForPessoa($dado['pessoa_id']);                
                $fornecedor->setPessoa(new Pessoa());
                $fornecedor->getPessoa()->setPesId($dado['pes_id']);
                $fornecedor->getPessoa()->setPesTipo($dado['pes_tipo']);
                $fornecedor->setEndLongradouro($dado['end_longradouro']);
                $fornecedor->setEndNumero($dado['end_numero']);
                $fornecedor->setEndBairro($dado['end_bairro']);
                $fornecedor->setEndComplemento($dado['end_complemento']);
                $fornecedor->setEndPontoReferencia($dado['end_pontoreferencia']);
                $fornecedor->setEndCep($dado['end_cep']);
                $fornecedor->setEndPessoa($dado['pessoa_id']);
                $fornecedor->setEndCidade(new Cidade());
                $fornecedor->getEndCidade()->setCidId($dado['cid_id']);
                $fornecedor->getEndCidade()->setCidNome($dado['cid_nome']);
                $fornecedor->getEndCidade()->setEstado(new Estado());
                $fornecedor->getEndCidade()->getEstado()->setEstId($dado['est_id']);
                $fornecedor->getEndCidade()->getEstado()->setEstNome($dado['est_nome']);
                $fornecedor->getEndCidade()->getEstado()->setEstUf($dado['est_uf']);
                $fornecedor->setSituacoes(new Situacoes());
                $fornecedor->getSituacoes()->setSitId($dado['sit_id']);
                $fornecedor->getSituacoes()->setSitNome($dado['sit_nome']);
                $fornecedor->getSituacoes()->setCors(new Cors());
                $fornecedor->getSituacoes()->getCors()->setCorId($dado['cor_id']);
                $fornecedor->getSituacoes()->getCors()->setCorNome($dado['cor_nome']);
                $fornecedor->getSituacoes()->getCors()->setCorCor($dado['cor_cor']);               
                $fornecedor->setUsuario(new Usuario());
                $fornecedor->getUsuario()->setId($dado['id']);
                $fornecedor->getUsuario()->setNome($dado['nome']);
                $fornecedor->getUsuario()->setApelido($dado['apelido']);
                $fornecedor->getUsuario()->setEmail($dado['email']);
                $fornecedor->getUsuario()->setNivel($dado['nivel']);

                $lista[] = $fornecedor;
            }            
            return $lista;
        }
    }
    public  function listarId($fornecedorId)
    {
                $sql = " SELECT * FROM fornecedor f 
                INNER JOIN pessoas p ON p.pes_id = f.pessoa_id
                INNER JOIN enderecos end ON end.pessoa_id = f.pessoa_id                
                INNER JOIN cidades cid ON cid.cid_id = end.cidade_id
                INNER JOIN estados e ON e.est_id = cid.estado_id 
                WHERE f.fornecedor_cod = {$fornecedorId} ";

            $resultado = $this->select($sql);
            $dados = $resultado->fetchAll();
            if ($dados) {

                $lista = [];

                foreach ($dados as $dado) {           
                $fornecedor = new Fornecedor();
                $fornecedor->setFornecedor_Cod($dado['fornecedor_cod']);
                $fornecedor->setForRazaoSocial($dado['razaosocial']);
                $fornecedor->setForNomeFantasia($dado['nomefantasia']);
                $fornecedor->setForTipo($dado['for_tipo']);
                $fornecedor->setForStatus($dado['for_status']);
                $fornecedor->setForPessoa($dado['pessoa_id']);
                $fornecedor->setForCnpj($dado['CNPJ']);
                //$fornecedor->setForDataCadastro($dado['dataCadastro']);
                $fornecedor->setEndLongradouro($dado['end_longradouro']);
                $fornecedor->setEndNumero($dado['end_numero']);
                $fornecedor->setEndBairro($dado['end_bairro']);
                $fornecedor->setEndComplemento($dado['end_complemento']);
                $fornecedor->setEndPontoReferencia($dado['end_pontoreferencia']);
                $fornecedor->setEndCep($dado['end_cep']);
                $fornecedor->setEndPessoa($dado['pessoa_id']);
                $fornecedor->setPessoa(new Pessoa());
                $fornecedor->getPessoa()->setPesId($dado['pes_id']);
                $fornecedor->getPessoa()->setPesTipo($dado['pes_tipo']);
                $fornecedor->setEndCidade(new Cidade());
                $fornecedor->getEndCidade()->setCidId($dado['cid_id']);
                $fornecedor->getEndCidade()->setCidNome($dado['cid_nome']);
                $fornecedor->getEndCidade()->setEstado(new Estado());
                $fornecedor->getEndCidade()->getEstado()->setEstId($dado['est_id']);
                $fornecedor->getEndCidade()->getEstado()->setEstNome($dado['est_nome']);
                $fornecedor->getEndCidade()->getEstado()->setEstUf($dado['est_uf']);                
                $fornecedor->setUsuario(new Usuario());
                $fornecedor->getUsuario()->setId($dado['id']);
                $fornecedor->getUsuario()->setNome($dado['nome']);
                $fornecedor->getUsuario()->setApelido($dado['apelido']);
                $fornecedor->getUsuario()->setEmail($dado['email']);
                $fornecedor->getUsuario()->setNivel($dado['nivel']);

                $lista[] = $fornecedor;
            }          
            return $lista;
        }
    }
    public  function qtde()
    {
        $resultado = $this->select(
            "SELECT COUNT(*) FROM fornecedor"
        );
        $fornecedor = $resultado->fetch();

        return $fornecedor;

        if ($fornecedor) {

            return $fornecedor;
        }

        return false;
    }
    public  function qtde1()
    {
        $resultado = $this->select(
            // "SELECT COUNT(*) FROM fornecedor"
            "SELECT R.codFornecedor,R.razaoSocial, R.qtdePedidos FROM (
                SELECT DISTINCT f.razaoSocial, f.codFornecedor,
                (SELECT COUNT(p.nome) AS qtde
                FROM produto AS p 
                WHERE f.codFornecedor = p.fornecedor_id
                ) as qtdePedidos FROM fornecedor as f ) AS R
                WHERE R.qtdePedidos > 0
                 ORDER BY R.qtdePedidos DESC "
        );
        $dados = $resultado->fetchAll();

        /*if ($dados) {

            $lista = [];

            foreach ($dados as $dado) {

                $fornecedor = new Fornecedor();
                //  $fornecedor->setCodFornecedor($dado['codFornecedor']);
                $fornecedor->setCodFornecedor($dado['qtdePedidos']);
                $fornecedor->setRazaoSocial($dado['razaoSocial']);
                //  $fornecedor->setNomeFantasia($dado['nomeFantasia']);
                //  $fornecedor->setCnpj($dado['cnpj']);
                $fornecedor->$dado['qtdePedidos'];

                $lista[] = $fornecedor;
            }
            return $lista;
            
        }*/
        return $dados;
        // return false;
    }

    public function listarFornecedor(Fornecedor $fornecedor)
    {
        $resultado = $this->select("SELECT f.fornecedor_cod, f.nomefantasia 
        FROM fornecedor f WHERE f.nomefantasia LIKE '%" . $fornecedor->getForNomeFantasia() . "%' LIMIT 0,10");

        return $resultado->fetchAll(\PDO::FETCH_ASSOC);
    }

    public  function salvar(Fornecedor $fornecedor)
    {
        try {

            $razaoSocial    = $fornecedor->getForRazaoSocial();            
            $nomeFantasia   = $fornecedor->getForNomeFantasia();
            $cnpj           = $fornecedor->getForCnpj();
            $ie             = $fornecedor->getForIE();
            $tipo           = $fornecedor->getForTipo();
            $observacao     = $fornecedor->getForObservacao();
            $email          = $fornecedor->getForEmail();
            $contato        = $fornecedor->getForContato();
            $cargo          = $fornecedor->getForCargo();
            $celular        = $fornecedor->getForCelular();
            $telefone       = $fornecedor->getForTelefone();
            $dataCadastro   = date('Y-m-d H:i:s');
            $dataAlteracao  = date('Y-m-d H:i:s');
            $pessoa         = $fornecedor->getForPessoa();
            $usuario        = $_SESSION['id'];
            $status         = $fornecedor->getSituacoes()->getSitId();

            return $this->insert(
                'fornecedor',
                ":razaosocial,:nomefantasia, :CNPJ, :for_ie, :for_tipo, :for_observacao, :for_email, :for_contato, :for_cargo, :for_celular, :for_telefone,
                :for_datacadastro, :for_dataalteracao, :pessoa_id, :usuario_id, :situacao_id ",
                [
                    ':razaosocial'          => $razaoSocial,
                    ':nomefantasia'         => $nomeFantasia,
                    ':CNPJ'                 => $cnpj,
                    ':for_ie'               => $ie,
                    ':for_tipo'             => $tipo,
                    ':for_observacao'       => $observacao,
                    ':for_email'            => $email,
                    ':for_contato'          => $contato,
                    ':for_cargo'            => $cargo,
                    ':for_celular'          => $celular,
                    ':for_telefone'         => $telefone,
                    ':for_datacadastro'     => $dataCadastro,
                    ':for_dataalteracao'    => $dataAlteracao,
                    ':pessoa_id'            => $pessoa,
                    ':usuario_id'           => $usuario,
                    ':situacao_id'          => $status
                ]
            );
        } catch (\Exception $e) {
            
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }

    public  function atualizar(Fornecedor $fornecedor)
    {
        try {

            $codFornecedor  = $fornecedor->getFornecedor_Cod();            
            $razaoSocial    = $fornecedor->getForRazaoSocial();            
            $nomeFantasia   = $fornecedor->getForNomeFantasia();
            $cnpj           = $fornecedor->getForCnpj();
            $ie             = $fornecedor->getForIE();
            $tipo           = $fornecedor->getForTipo();
            $observacao     = $fornecedor->getForObservacao();
            $email          = $fornecedor->getForEmail();
            $contato        = $fornecedor->getForContato();
            $cargo          = $fornecedor->getForCargo();
            $celular        = $fornecedor->getForCelular();
            $telefone       = $fornecedor->getForTelefone();
            $dataAlteracao  = date('Y-m-d H:i:s');
            $pessoa         = $fornecedor->getForPessoa();
            $usuario        = $_SESSION['id'];
            $status         = $fornecedor->getSituacoes()->getSitId();

            return $this->update(
                'fornecedor',
                "razaosocial = :razaoSocial, nomefantasia = :nomeFantasia, cnpj = :cnpj, for_ie = :ie,                
                for_tipo = :tipo, for_observacao = :observacao, for_email = :email, for_contato = :contato, for_cargo = :cargo, for_celular = :celular, for_telefone = :telefone, for_dataalteracao = :dataAlteracao,
                pessoa_id = :pessoa, usuario_id = :usuario, situacao_id = :status ",
                [
                    ':fornecedor_cod'   => $codFornecedor,
                    ':razaoSocial'      => $razaoSocial,
                    ':nomeFantasia'     => $nomeFantasia,
                    ':cnpj'             => $cnpj,
                    ':ie'               => $ie,
                    ':tipo'             => $tipo,
                    ':observacao'       => $observacao,
                    ':email'            => $email,
                    ':contato'          => $contato,
                    ':cargo'            => $cargo,
                    ':celular'          => $celular,
                    ':telefone'         => $telefone,
                    ':dataAlteracao'    => $dataAlteracao,
                    ':pessoa'           => $pessoa,
                    ':usuario'          => $usuario,
                    ':status'           => $status,
                ],
                "fornecedor_cod = :fornecedor_cod"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }

    public function excluir(Fornecedor $fornecedor)
    {
        try {
            $codFornecedor  = $fornecedor->getFornecedor_Cod();
            $codPessoa      = $fornecedor->getForPessoa();
            $this->delete('contatos', "pessoa_id = $codPessoa");
            $this->delete('enderecos', "pessoa_id = $codPessoa");
            $this->delete('fornecedor', "fornecedor_cod = $codFornecedor");
            return $this->delete('pessoas', "pes_id = $codPessoa");
        } catch (\Exception $e) {

            throw new \Exception(" Erro ao deletar ", 500);
        }
    }
// end: funcoes pra sicronizar dados (pessoa/ endereço/ cliente)
    private $PessoaId;
    private $Fornecedor;
    private $FornecedorId;
    private $Endereco;
    private $Resultado;
    public function sicronizar()
    {
        $this->Fornecedor = $this->listarFornecedorScr();       
        if($this->Fornecedor){   
        
           $this->atualizacao();     
          
            return $this->Resultado;
        }else{
            return false;
        }        
    }
    private function listarFornecedorScr()
    {
        $sql = " SELECT fornecedor_cod FROM fornecedor WHERE pessoa_id IS NULL ";
        
        $resultado = $this->select($sql);

        $this->Fornecedor = $resultado->fetchAll();
        if($this->Fornecedor){
            return $this->Fornecedor;
        }else{
           
            return false;
        }
    }    
    private function atualizacao()
    {
       foreach($this->Fornecedor as $Fornecedor){
           extract($Fornecedor);
            $this->FornecedorId = $fornecedor_cod;            
            $this->sicronizarDados();            
       }
    }

    private function sicronizarDados()
    {              
            $this->cadastrarPessoa();
            if($this->PessoaId){               
                $this->cadastrarEndereco();
                if($this->Endereco){
                   
                    if($this->atualizarFornecedor()){
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

    private  function atualizarFornecedor()
    {
        try {
            
            $this->Resultado += 1;
            $codFornecedor  = $this->FornecedorId;
            $pessoa         = $this->PessoaId;
            $usuario        = $_SESSION['id'];
            $dataAlteracao  = date('Y-m-d H:i:s');           

           $this->update(
                'fornecedor',
                "pessoa_id = :pessoa, 
                usuario_id = :usuario, for_dataalteracao = :dataAlteracao",
                [
                    ':fornecedor_cod'   => $codFornecedor,
                    ':pessoa'           => $pessoa,
                    ':usuario'          => $usuario,
                    ':dataAlteracao'    => $dataAlteracao,
                ],
                "fornecedor_cod = :fornecedor_cod"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }
   // begin: funcoes pra sicronizar dados (pessoa/ endereço/ cliente)
}