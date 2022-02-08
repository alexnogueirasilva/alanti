<?php

namespace App\Models\DAO;

use App\Models\Entidades\Usuario;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Situacoes;
use App\Models\Entidades\Cors;

use Exception;

class UsuarioDAO extends BaseDAO
{
    private $Query;
    
    public function verificaEmail($email)
    {
        try {
            $sql = "SELECT id, nome, apelido, email, nivel, nivei_id, id_dep, dica, valida, status, fk_idInstituicao, situacao_id FROM usuarios WHERE email = '$email' ";
            $resultado = $this->select($sql);
            
            $dado = $resultado->fetch();
            if ($dado) {
                $usuario = new Usuario();
            
                $usuario->setId($dado['id']);
                $usuario->setEmail($dado['email']);
                $usuario->setNome($dado['nome']);
                $usuario->setApelido($dado['apelido']);
                $usuario->setId_dep($dado['id_dep']);
                $usuario->setDica($dado['dica']);
                $usuario->setNivel($dado['nivel']);
                $usuario->setNivelId($dado['nivei_id']);
                $usuario->setStatus($dado['status']);
                $usuario->setValida($dado['valida']);
                $usuario->setFk_Instituicao($dado['fk_idInstituicao']);
                
                return $usuario;
            }           
        } catch (Exception $e) {
            throw new \Exception("Erro no acesso aos dados.", 500);
        }
    }
    
     public function validacadastro($codigo,$valida,$email)
    {
        $sql ="SELECT id, email, status, valida, dica, fk_idInstituicao
            FROM usuarios
            where valida ='$valida' AND id ='$codigo' AND email ='$email'";
        $resultado = $this->select($sql);               
        $dado = $resultado->fetch();
        
        if ($dado) {
            $usuario = new Usuario();
            $usuario->setId($dado['id']);
            $usuario->setEmail($dado['email']);
            $usuario->setStatus($dado['status']);
            $usuario->setValida($dado['valida']); 
            
            return $usuario;
        }else{
            return false;
        }

    }

    public function listarprecadastro($id = null)
    {
        if ($id) {
            //$pwd = sha1($password);
            
            $resultado = $this->select(
                "SELECT u.usu_id, u.usu_nome, u.usu_email, u.usu_datacadastro, u.usu_dataalteracao
                FROM usuario AS u  where u.usu_id ='" . $id . "'"
            );
            $dado = $resultado->fetch();
            
            if ($dado) {
                $usuario = new Usuario();
                $usuario->setId($dado['usu_id']);
                $usuario->setNome($dado['usu_nome']);
                $usuario->setEmail($dado['usu_email']);
                $usuario->setDataAlteracao($dado['usu_dataalteracao']);
                $usuario->setDataCadastro($dado['usu_datacadastro']);
            
                return $usuario;
            }
        } else {
            
            $resultado = $this->select(
                " SELECT u.usu_id, u.usu_nome, u.usu_email, u.usu_datacadastro, u.usu_dataalteracao
                  FROM usuario AS u ORDER BY u.usu_nome ASC"
            );
            $dados = $resultado->fetchAll();
            
            if ($dados) {
                
                $lista = [];
                
                foreach ($dados as $dado) {
                    $usuario = new Usuario();
                    $usuario->setId($dado['usu_id']);
                    $usuario->setNome($dado['usu_nome']);
                    $usuario->setEmail($dado['usu_email']);
                    $usuario->setDataAlteracao($dado['usu_dataalteracao']);
                    $usuario->setDataCadastro($dado['usu_datacadastro']); 
                    $lista[] = $usuario;
                }

                return $lista;                
            }
            return false;
        }
    }

     public function listar(Usuario $usuario)
    {               
            $id             = $usuario->getId();
            $nome           = $usuario->getNome();
            $status         = $usuario->getStatus();
            $email          = $usuario->getEmail();
            $departamento   = $usuario->getCodDepartamento();
            
            $sql = " SELECT u.id, u.nome, u.apelido, u.info, u.nivel, u.email, u.senha, u.status, u.dataCadastro, u.valida, u.dica, u.fk_idInstituicao, u.id_dep,
                i.inst_id, i.inst_nome, d.id aS idDep, d.nome AS nomeDep,
                s.sit_nome, s.sit_id, cor.cor_id, cor.cor_cor
                FROM usuarios AS u 
                INNER JOIN instituicao AS i on i.inst_id = u.fk_idInstituicao
                INNER JOIN departamentos AS d on d.id = u.id_dep 
                INNER JOIN situacoes s ON s.sit_id = u.situacao_id
                INNER JOIN cors cor ON cor.cor_id = s.cor_id ";
            if(!empty($status)){
                $status = implode("','",$status);
            }
            
            $where = Array();
            if( $id ){ $where[] = " u.id = {$id}"; }  
            if( $departamento ){ $where[] = " d.id = {$departamento}"; }  
            if( $nome ){ $where[] = " u.nome = '{$nome}'"; } 
            if( $email ){ $where[] = " u.email = '{$email}'"; } 
            if( $status ){ $where[] = " u.status in ('{$status}')"; }  
            
            if( sizeof( $where ) ){
                $sql .= ' WHERE '.implode( ' AND ',$where );
                $sql .= " ORDER BY u.apelido ASC ";
            }else {
                $sql .= " ORDER BY u.apelido ASC ";
            }
            
            $resultado = $this->select($sql );
           
            $dados = $resultado->fetchAll();
            
            if ($dados) {
                
                $lista = [];
                
                foreach ($dados as $dado) {
                    $usuario = new Usuario();
                    $usuario->setId($dado['id']);
                    $usuario->setNome($dado['nome']);
                    $usuario->setApelido($dado['apelido']);
                    $usuario->setNivel($dado['nivel']);
                    $usuario->setEmail($dado['email']);
                    $usuario->setId_dep($dado['id_dep']);
                    $usuario->setStatus($dado['status']);
                    $usuario->setDataCadastro($dado['dataCadastro']);
                    $usuario->setValida($dado['valida']);
                    $usuario->setDica($dado['dica']);
                    $usuario->setInfo($dado['info']);
                    $usuario->setSenha($dado['senha']);
                    $usuario->setFk_Instituicao($dado['fk_idInstituicao']);
                    $usuario->getDepartamento()->setId($dado['idDep']);
                    $usuario->getDepartamento()->setNome($dado['nomeDep']);
                    $usuario->setSituacoes(new Situacoes());
                    $usuario->getSituacoes()->setSitId($dado['sit_id']);
                    $usuario->getSituacoes()->setSitNome($dado['sit_nome']);
                    $usuario->getSituacoes()->setCors(new Cors());
                    $usuario->getSituacoes()->getCors()->setCorId($dado['cor_id']);
                    $usuario->getSituacoes()->getCors()->setCorNome($dado['cor_nome']);
                    $usuario->getSituacoes()->getCors()->setCorCor($dado['cor_cor']);
                    $usuario->setInstituicao(new Instituicao());
                    $usuario->getInstituicao()->setInst_Id($dado['inst_id']);                    
                    $usuario->getInstituicao()->setInst_Nome($dado['inst_nome']);  
                    $lista[] = $usuario;
                }

                return $lista;                
            }
           
    }
    
    public  function usuariosAtivos()
    {       
            $this->Query = " SELECT COUNT(id) AS UserQtde FROM  usuarios WHERE situacao_id=1 ";
            $resultado = $this->select(
                $this->Query );           
            $Resultado = $resultado->fetch();                       
                return $Resultado;
                
    }
    
    public  function usuariosInativos()
    {       
        $this->Query = " SELECT COUNT(id) AS UserQtde FROM  usuarios WHERE situacao_id=2 ";
        $resultado = $this->select(
            $this->Query );           
        $Resultado = $resultado->fetch();                       
            return $Resultado;
                
    }
    
    public  function listarUsuarioEdital()
    {       

            $resultado = $this->select(
                ' SELECT distinct(u.nome), u.id     
                FROM  usuarios AS u
                 INNER JOIN edital AS e on e.edt_usuario = u.id ORDER BY u.nome   '
            );
            $dados = $resultado->fetchAll();

            if ($dados) {

                $lista = [];

                foreach ($dados as $dado) {

                    $usuario = new Usuario();
                    $usuario->setId($dado['id']);
                    $usuario->setNome($dado['nome']);
                    $usuario->setEmail($dado['email']);                                   

                    $lista[] = $usuario;
                }
                return $lista;
            }        
    }
    
    public  function salvar(Usuario $usuario) 
    {
        try {
            $nome           = $usuario->getNome();
            $apelido        = $usuario->getApelido();
            $email          = $usuario->getEmail();
            $senha          = $usuario->getSenha();           
            $nivel          = $usuario->getNivel();
            $idDep          = $usuario->getId_dep();
            $status         = $usuario->getStatus();
            $fk_instituicao = $usuario->getFk_Instituicao();
            $dataCadastro   = date('Y-m-d H:i:s');
            $dataAlteracao  = date('Y-m-d H:i:s');
            $valida         = sha1($dataAlteracao."-".$email);
            $dica           = $usuario->getDica();
            
           return $this->insert(
                'usuarios',
                ":nome, :apelido, :email, :senha, :nivel, :id_dep,
                :status, :fk_idInstituicao , :dataCadastro, :usu_dataalteracao,
                :valida, :dica, :situacao_id",
                [
                    ':nome'                 => $nome,
                    ':apelido'              => $apelido,
                    ':email'                => $email,
                    ':senha'                => $senha,
                    ':nivel'                => $nivel,
                    ':id_dep'               => $idDep,
                    ':status'               => $status,
                    ':fk_idInstituicao'     => $fk_instituicao,
                    ':dataCadastro'         => $dataCadastro,
                    ':usu_dataalteracao'    => $dataAlteracao,
                    ':valida'               => $valida,
                    ':dica'                 => $dica,
                    ':situacao_id'          => $status

                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ", 500);
        }
    }

    public  function atualizar(Usuario $usuario)
    {
        try {
            
            $id              = $usuario->getId();
            $nome            = $usuario->getNome();
            $apelido         = $usuario->getApelido();
            $email           = $usuario->getEmail();
            $senha           = $usuario->getSenha();           
            $nivel           = $usuario->getNivel();
            $idDep           = $usuario->getId_dep();
            $status          = $usuario->getStatus();
            $fk_instituicao  = $usuario->getFk_Instituicao();           
            $dica            = $usuario->getDica();
            $dataAlteracao   = date('Y-m-d H:i:s');
            $valida          = md5($dataAlteracao."-".$email);

            return $this->update(
                'usuarios',
                "nome = :nome, apelido =:apelido, email =:email, nivel =:nivel, valida =:valida, senha =:senha, id_dep =:idDep,
                status =:status, fk_idInstituicao = :fk_instituicao, dica =:dica, usu_dataalteracao =:dataAlteracao, situacao_id =:status",
                [
                    ':id'               => $id,
                    ':nome'             => $nome,
                    ':apelido'          => $apelido,
                    ':email'            => $email,
                    ':nivel'            => $nivel,
                    ':valida'           => $valida,
                    ':senha'            => $senha,
                    ':idDep'            => $idDep,
                    ':status'           => $status,
                    ':fk_instituicao'   => $fk_instituicao,
                    ':dataAlteracao'    => $dataAlteracao,
                    ':dica'             => $dica,  
                    ':status'           => $status,                  
                ],
                "id = :id"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }
    
    public  function precadastro(Usuario $usuario) 
    {
        try {
            $nome           = $usuario->getNome();
            $email          = $usuario->getEmail();
            $senha          = $usuario->getSenha();
            $pwd            = sha1($senha);           
            
           return $this->insert(
                'usuario',
                ":usu_nome, :usu_email, :usu_senha, :usu_datacadastro, :usu_dataalteracao",
                [
                    ':usu_nome' => $nome,
                    ':usu_email' => $email,
                    ':usu_senha' => $pwd,
                    ':usu_datacadastro' => date('Y-m-d H:i:s'),
                    ':usu_dataalteracao' => date('Y-m-d H:i:s')
                ]
            );
        } catch (\Exception $e) {           
            throw new \Exception("Erro na gravação de dados. ", 500);
        }
    }

    public  function desInfo(Usuario $usuario)
    {
        try {
            
            $id             = $usuario->getId();
            $dataAlteracao  = date('Y-m-d H:i:s');
           $info            = $usuario->getInfo();
          return $this->update(
                'usuarios',
                " info =:info, usu_dataalteracao =:dataAlteracao",
                [
                    ':id' => $id,
                    ':info' => $info,
                     ':dataAlteracao'    => $dataAlteracao,
                ],
                "id = :id"
            );
        } catch (\Exception $e) {           

            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }

   public  function ativarcadastro(Usuario $usuario)
   {
        try {

            $id             = $usuario->getId();            
            $email          = $usuario->getEmail();
            $status         = $usuario->getStatus();          
            $dataAlteracao  = date('Y-m-d H:i:s');
            $valida         = sha1($dataAlteracao."-".$email);          
            
            return $this->update(
                'usuarios',
                "valida = :valida, email =:email, status =:status, usu_dataalteracao =:dataAlteracao,
                situacao_id =:status",
                [
                    ':id'               => $id,
                    ':valida'           => $valida,
                    ':email'            => $email,
                    ':status'           => $status,
                    ':dataAlteracao'    => $dataAlteracao,
                    ':status'           => $status,  
                ],
                "id = :id"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }

    public function excluir(Usuario $usuario)
    {
        try {
            $id = $usuario->getId();

            return $this->delete('usuarios', "id = $id");
        } catch (Exception $e) {

            throw new \Exception("Erro ao deletar", 500);
        }
    }
}
