<?php 

namespace App\Models\DAO;

use App\Models\Entidades\Login;
use App\Models\Entidades\Instituicao;

class LoginDAO extends BaseDAO
{
    public function salvarLogin(Login $login)
    {
        try
        {
            $nomeLogin      = $login->getNomeLogin();
            $emailLogin     = $login->getEmailLogin();

            return $this->insert(
                'login',
                ":nomeLogin, :emailLogin",
                [
                    ':nomeLogin'=>$nomeLogin,
                    ':emailLogin'=>$emailLogin
                ]
            );
        }catch (\Exception $e){
            throw new \Exception("Erro ao fazer cadastro de login", 500);
        }
    }

    
    public function autenticar($email, $Password) 
    {          
        if (!$email =="" && !$Password =="") {
            $pwd = sha1($Password);
                     
            $resultado = $this->select(
                //"SELECT * FROM usuarios AS u INNER JOIN instituicao AS i on i.inst_id = u.fk_idInstituicao where u.email ='" . $email . "' AND u.senha ='" . $pwd . "'"
                "SELECT u.id, u.nome, u.info, u.apelido, u.nivel, u.email, u.status, u.dataCadastro, u.valida, u.dica, u.fk_idInstituicao, u.id_dep,
                i.inst_id, i.inst_nome,
                d.id aS idDep, d.nome AS nomeDep FROM usuarios AS u 
                INNER JOIN instituicao AS i on i.inst_id = u.fk_idInstituicao
                INNER JOIN departamentos AS d on d.id = u.id_dep where u.email ='" . $email . "' AND u.senha ='" . $pwd . "'"
            );
            $dado = $resultado->fetch();
            if ($dado) {               
                $login = new Login();                
                $login->setCodUsuario($dado['id']);
                $login->setEmailLogin($dado['email']);
                $login->setNomeLogin($dado['nome']);
                $login->setNivel($dado['nivel']);
                $login->setInfo($dado['info']);
                $login->setUsuStatus($dado['status']);
                $login->setApelidoLogin($dado['apelido']);
                $login->setFk_Instituicao($dado['fk_idInstituicao']);
                $login->setInstituicao(new Instituicao());
                $login->getInstituicao()->setInst_Id($dado['inst_id']);   
                $login->getInstituicao()->setInst_Nome($dado['inst_nome']);   
                $login->getInstituicao()->setInst_NomeFantasia($dado['inst_nomeFantasia']);   
                $login->getInstituicao()->setInst_Codigo($dado['inst_codigo']);   
                
                return $login;      
            }           
        }   
            return false;
    }
    
    
           

}
