<?php

namespace App\Models\DAO;

use App\Models\Entidades\Cidade;
use App\Models\Entidades\Cors;
use App\Models\Entidades\Estado;
use App\Models\Entidades\Transportadora;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Pessoa;
use App\Models\Entidades\Situacoes;

class TransportadoraDAO extends BaseDAO
{
    public function listar(Transportadora $transportadora)
    {
        
        $codTransportadora    = $transportadora->getTraId();        
        $razaoSocial          = $transportadora->getTraRazaoSocial();
        $nomeFantasia         = $transportadora->getTraNomeFantasia();
        $status               = $transportadora->getTraStatus();
        $cnpj                 = $transportadora->getTraCnpj();
        $usuario              = "";//$transportadora->getTraUsuario();
        $instituicao          = '';//$transportadora->getTraInstituicao();
        
        $sql =
                " SELECT tra.tra_id, tra.tra_razaosocial, tra.tra_nomefantasia,tra.tra_cnpj, tra.tra_ie, tra.tra_email, tra.tra_contato, tra.tra_telefone,
                tra.tra_celular,tra.tra_observacao, tra.tra_datacadastro,tra.tra_dataalteracao, tra.tra_usuario, tra.tra_instituicao, tra.pessoa_id,tra.tra_status,
                end.end_id,end.end_longradouro,end.end_numero,end.end_bairro,end.end_complemento,end.end_pontoreferencia,end.end_cep,end.end_dataalteracao,end.end_datacadastro,end.end_cidade,end.pessoa_id,
                u.id, u.nome,u.nivel, u.email, u.status, u.id_dep,
                i.inst_id, i.inst_codigo, i.inst_nome, i.inst_nomeFantasia,
                d.id as idDep, d.nome as nomeDep,
                pes.pes_id,pes.pes_tipo, s.sit_nome, s.sit_id, cor.cor_id, cor.cor_cor,
                cid.cid_id, cid.cid_nome,cid.estado_id,
                est.est_id, est.est_nome, est.est_uf
                FROM transportadoras as tra
                INNER JOIN instituicao AS i ON i.inst_id = tra.tra_instituicao
                INNER JOIN usuarios AS u ON u.id = tra.tra_usuario
                INNER JOIN departamentos AS d ON d.id = u.id_dep
                INNER JOIN pessoas AS pes ON pes.pes_id = tra.pessoa_id                
                INNER JOIN enderecos AS end ON end.pessoa_id = pes.pes_id
                INNER JOIN cidades AS cid ON cid.cid_id = end.cidade_id
                INNER JOIN estados AS est ON est.est_id = cid.estado_id 
                INNER JOIN situacoes s ON s.sit_id = tra.situacao_id
                INNER JOIN cors cor ON cor.cor_id = s.cor_id ";
           
             $where = Array();
             if( $codTransportadora ){ $where[] = " tra.tra_id = {$codTransportadora}"; }             
             if( $status ){ $where[] = " tra.tra_status = '{$status}'"; }
             if($razaoSocial){ $where[] = " tra.tra_razaosocial = '{$razaoSocial}'"; }
             if($nomeFantasia){ $where[] = " tra.tra_nomefantasia = '{$nomeFantasia}'"; }
             if($cnpj){ $where[] = " tra.tra_cnpj = '{$cnpj}'"; }
             if( $usuario ){ $where[] = " u.id = {$usuario}"; }
             if( $instituicao ){ $where[] = " i.inst_id = {$instituicao}"; }
            
             if( sizeof( $where ) ){
                 $sql .= ' WHERE '.implode( ' AND ',$where );
                }else {
                   // $sql .= " WHERE tra.tra_status  NOT IN ('ATIVO') ";
                }                
                $resultado = $this->select($sql);
         
                $dados = $resultado->fetchAll();
                $lista = [];
                foreach ($dados as $dado) {
                   $transportadora = new Transportadora();
                   $transportadora->setTraId($dado['tra_id']);
                    $transportadora->setTraRazaoSocial($dado['tra_razaosocial']);
                    $transportadora->setTraNomeFantasia($dado['tra_nomefantasia']);
                    $transportadora->setTraCnpj($dado['tra_cnpj']);
                    $transportadora->setTraIE($dado['tra_ie']);
                    $transportadora->setTraEmail($dado['tra_email']);
                    $transportadora->setTraContato($dado['tra_contato']);
                    $transportadora->setTraTelefone($dado['tra_telefone']);
                    $transportadora->setTraCelular($dado['tra_celular']);
                    $transportadora->setTraStatus($dado['tra_status']);
                    $transportadora->setTraObservacao($dado['tra_observacao']);
                    $transportadora->setTraPessoa($dado['pessoa_id']);
                    $transportadora->setTraDataCadastro($dado['tra_datacadastro']);
                    $transportadora->setTraDataAlteracao($dado['tra_dataalteracao']);
                    $transportadora->setEndLongradouro($dado['end_longradouro']);
                    $transportadora->setEndNumero($dado['end_numero']);
                    $transportadora->setEndBairro($dado['end_bairro']);
                    $transportadora->setEndComplemento($dado['end_complemento']);
                    $transportadora->setEndPontoReferencia($dado['end_pontoreferencia']);
                    $transportadora->setEndCep($dado['end_cep']);
                    $transportadora->setEndPessoa($dado['pessoa_id']);
                    $transportadora->setPessoa(new Pessoa());
                    $transportadora->getPessoa()->setPesId($dado['pes_id']);
                    $transportadora->getPessoa()->setPesTipo($dado['pes_tipo']);
                    $transportadora->setEndCidade(new Cidade());
                    $transportadora->getEndCidade()->setCidId($dado['cid_id']);
                    $transportadora->getEndCidade()->setCidNome($dado['cid_nome']);
                    $transportadora->getEndCidade()->setEstado(new Estado());
                    $transportadora->getEndCidade()->getEstado()->setEstId($dado['est_id']);
                    $transportadora->getEndCidade()->getEstado()->setEstNome($dado['est_nome']);
                    $transportadora->getEndCidade()->getEstado()->setEstUf($dado['est_uf']);
                    $transportadora->setTraInstituicao(new Instituicao());
                    $transportadora->getTraInstituicao()->setInst_Id($dado['inst_id']);
                    $transportadora->getTraInstituicao()->setInst_Codigo($dado['inst_codigo']);
                    $transportadora->getTraInstituicao()->setInst_Nome($dado['inst_nome']);
                    $transportadora->setSituacoes(new Situacoes());
                    $transportadora->getSituacoes()->setSitId($dado['sit_id']);
                    $transportadora->getSituacoes()->setSitNome($dado['sit_nome']);
                    $transportadora->getSituacoes()->setCors(new Cors());
                    $transportadora->getSituacoes()->getCors()->setCorId($dado['cor_id']);
                    $transportadora->getSituacoes()->getCors()->setCorNome($dado['cor_nome']);
                    $transportadora->getSituacoes()->getCors()->setCorCor($dado['cor_cor']);
                    $transportadora->setTraUsuario(new Usuario());
                    $transportadora->getTraUsuario()->setId($dado['id']);
                    $transportadora->getTraUsuario()->setNome($dado['nome']);
                    $transportadora->getTraUsuario()->setEmail($dado['email']);
                    $transportadora->getTraUsuario()->setNivel($dado['nivel']);


                    $lista[] = $transportadora;
                }
              
                return $lista;        
    }

    public function listarTransportadoraLogisticaNfe()
    {
        
        $sql = " SELECT distinct(t.tra_razaosocial),
        t.tra_id, t.tra_nomefantasia, t.tra_cnpj
        FROM crt_logistica as l
        INNER JOIN crt_pedidoerp as pe ON pe.perp_id = l.lgt_fk_erp
        INNER JOIN controlePedido as  p ON p.codControle  = pe.perp_codcontrole
        INNER JOIN transportadoras as t ON t.tra_id = l.lgt_fk_transportadora ";
                      
                $resultado = $this->select($sql);
         
                $dados = $resultado->fetchAll();
                $lista = [];
                foreach ($dados as $dado) {
                    $transportadora = new Transportadora();
                    $transportadora->setTraId($dado['tra_id']);
                    $transportadora->setTraRazaoSocial($dado['tra_razaosocial']);
                    $transportadora->setTraNomeFantasia($dado['tra_nomefantasia']);
                    $transportadora->setTraCnpj($dado['tra_cnpj']);
           
                    $lista[] = $transportadora;
                }
              
                return $lista;        
    }

    public function listarPorRazaoSocial(Transportadora $transportadora)
    {
        $resultado = $this->select(
            "SELECT * FROM transportadoras WHERE tra_razaosocial
                        LIKE '%".$transportadora->getTraRazaoSocial()."%' ORDER BY tra_razaosocial LIMIT 0,10"
        );
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);
    }

     public function salvar(Transportadora $transportadora)
    {
        try {
                $razaoSocial    = $transportadora->getTraRazaoSocial();
                $nomeFantasia   = $transportadora->getTraNomeFantasia();
                $cnpj           = $transportadora->getTraCnpj();
                $insEstadual    = $transportadora->getTraIE();
                $email          = $transportadora->getTraEmail();
                $pessoa         = $transportadora->getTraPessoa();
                $status         = $transportadora->getSituacoes()->getSitId();
                $observacao     = $transportadora->getTraObservacao();
                $telefone       = $transportadora->getTraTelefone();
                $celular        = $transportadora->getTraCelular();
                $contato        = $transportadora->getTraContato();
                $cargo          = $transportadora->getTraCargo();
                //$dataCadastro   = $transportadora->getTraDataCadastro()->format('Y-m-d H:m:s');;
                $usuario        = $transportadora->getTraUsuario()->getId();
                $instituicao    = $transportadora->getTraInstituicao()->getInst_Id();
               // $anexo          = $transportadora->getTraAnexo();
                //$anexo = $this->anexo($anexo);

            return $this->insert(
                'transportadoras',
                   ":tra_razaosocial,
                    :tra_nomefantasia,
                    :tra_cnpj,
                    :tra_ie,
                    :tra_email,
                    :tra_contato,
                    :tra_cargo,
                    :tra_telefone,
                    :tra_celular,
                    :tra_observacao,
                    :situacao_id,
                    :tra_datacadastro,
                    :tra_dataalteracao,                   
                    :tra_usuario,
                    :tra_instituicao,
                    :pessoa_id",
                [                    
                    ':tra_razaosocial'  => $razaoSocial,
                    ':tra_nomefantasia' =>$nomeFantasia,
                    ':tra_cnpj'         => $cnpj,
                    ':tra_ie'           => $insEstadual,
                    ':tra_email'        =>$email,
                    ':tra_contato'      =>$contato,
                    ':tra_cargo'        =>$cargo,
                    ':tra_telefone'     =>$telefone,
                    ':tra_celular'      => $celular,
                    ':tra_observacao'   => $observacao,
                    ':situacao_id'      => $status,
                    ':tra_datacadastro' => date('Y-m-d H:i:s'),
                    ':tra_dataalteracao'=> date('Y-m-d H:i:s'),
                    ':tra_usuario'      =>$usuario,
                    ':tra_instituicao'  =>$instituicao,
                    ':pessoa_id'       => $pessoa
                ]
            );
                
            } catch (\Exception $e) {
                    //var_dump($e);
                    throw new \Exception("Erro na gravação de dados. " . $e, 500);
            }
    }
    
    public function addContatos(Transportadora $transportadora)
    {    
        try { 
            $conta = count($transportadora->getContatos()->getContato());
            if($conta > 0){
            for($i = 0; $i < $conta; $i++ ){                               
                $nome               = $transportadora->getContatos()->getContato()[$i];             
                $email              = $transportadora->getContatos()->getEmail()[$i];
                $telefone           = $transportadora->getContatos()->getTelefone()[$i];
                $celular            = $transportadora->getContatos()->getCelular()[$i];
                $cargosetor         = $transportadora->getContatos()->getCargo()[$i];
                $datacadastro       = date('Y-m-d H:i:s');
                $usuario_id         = $_SESSION['id'];
                $pessoa_id          = $transportadora->getTraPessoa();
               
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
    
     public function alterar(Transportadora $transportadora)
    {        
        try {             
                $codTransportadora  = $transportadora->getTraId();
                $razaoSocial        = $transportadora->getTraRazaoSocial();
                $nomeFantasia       = $transportadora->getTraNomeFantasia();
                $cnpj               = $transportadora->getTraCnpj();
                $insEstadual        = $transportadora->getTraIE();
                $email              = $transportadora->getTraEmail();
                $pessoa             = $transportadora->getTraPessoa();
                $status             = $transportadora->getSituacoes()->getSitId();
                $observacao         = $transportadora->getTraObservacao();
                $telefone           = $transportadora->getTraTelefone();
                $celular            = $transportadora->getTraCelular();
                $contato            = $transportadora->getTraContato();
                $cargo              = $transportadora->getTraCargo();
                $usuario            = $transportadora->getTraUsuario()->getId();
                $instituicao        = $transportadora->getTraInstituicao()->getInst_Id();
               // $anexo          = $transportadora->getTraAnexo();
               //$anexo = $this->anexo($anexo);

            return $this->update(
                'transportadoras',
                   "tra_razaosocial     =:razaosocial,
                    tra_nomefantasia    =:nomefantasia,
                    tra_cnpj            =:cnpj,
                    tra_ie              =:ie,
                    tra_email           =:email,
                    tra_contato         =:contato,
                    tra_cargo           =:cargo,
                    tra_telefone        =:telefone,
                    tra_celular         =:celular,
                    tra_observacao      =:observacao,
                    situacao_id         =:status,
                    tra_dataalteracao   =:dataalteracao,                   
                    tra_usuario         =:usuario,
                    tra_instituicao     =:instituicao,
                    pessoa_id           =:pessoa",
                [
                    ':codTransportadora'=> $codTransportadora,
                    ':razaosocial'      => $razaoSocial,
                    ':nomefantasia'     =>$nomeFantasia,
                    ':cnpj'             => $cnpj,
                    ':ie'               => $insEstadual,
                    ':email'            =>$email,
                    ':cargo'          =>$cargo,
                    ':contato'          =>$contato,
                    ':telefone'         =>$telefone,
                    ':celular'          => $celular,
                    ':observacao'       => $observacao,
                    ':status'           => $status,
                    ':dataalteracao'    => date('Y-m-d H:m:s'),
                    ':usuario'          =>$usuario,
                    ':instituicao'      =>$instituicao,
                    ':pessoa'           => $pessoa,
                ],
                "tra_id =:codTransportadora"
            );          
        } catch (\Exception $e) {
           // var_dump("teste ".$e);
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }
    
    public function excluir(Transportadora $transportadora)
    {        
        try {
            $codTransportadora = $transportadora->getTraId();

            return $this->delete('transportadoras', "tra_id = $codTransportadora");
        } catch (\Exception $e) {
            throw new \Exception("Erro ao excluir cadastro! ", 500);
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