<?php

namespace App\Models\DAO;

use App\Models\Entidades\Cidade;
use App\Models\Entidades\Estado;
use App\Models\Entidades\Transportadora;
use App\Models\Entidades\Desenvolvimento;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Departamento;
use App\Models\Entidades\Instituicao;

class DesenvolvimentoDAO extends BaseDAO
{
    public function listar(Desenvolvimento $desenvolvimento)
    {        
        $idDesenvolvimento          = $desenvolvimento->getDesId();        
        $status      = $desenvolvimento->getDesStatus();
        $usuario     = $desenvolvimento->getDesCodUsuario();
        
        $SQL =
                " SELECT des.des_id, des.des_requisito, des.des_regranegocio, DES.des_correcao, des.des_status, des.des_geral, des.des_teste, des.des_datacadastro, des.des_dataalteracao,
                u.id,u.nome,u.email, u.nivel,u.id_dep,u.status,
                d.id as idDep, d.nome as nomeDep 
                FROM desenvolvimento des
                INNER JOIN usuarios u ON u.id = des.des_usuario
                INNER JOIN departamentos d ON d.id = u.id  ";
           
             $where = Array();
             if( $idDesenvolvimento ){ $where[] = " des.des_id = {$idDesenvolvimento}"; }             
             if( $status ){ $where[] = " des.des_status = '{$status}'"; }
             if($usuario){ $where[] = " des.des_ususuario = {$usuario}"; }
            
             if( sizeof( $where ) ){
                 $SQL .= ' WHERE '.implode( ' AND ',$where );
                }else {
                    $SQL .= " WHERE des.des_status  NOT IN ('CONCLUIDO, CANCELADO') ";
                }                
                $resultado = $this->select($SQL);
         
                $dados = $resultado->fetchAll();
                $lista = [];
                foreach ($dados as $dado) {
                    $desenvolvimento = new Desenvolvimento();
                    
                    $desenvolvimento->setDesId($dado['des_id']);
                    $desenvolvimento->setDesRequisito($dado['des_requisito']);
                    $desenvolvimento->setDesRegraNegocio($dado['des_regranegocio']);
                    $desenvolvimento->setDesCorrecao($dado['des_correcao']);
                    $desenvolvimento->setDesGeral($dado['des_geral']);
                    $desenvolvimento->setDesTeste($dado['des_teste']);
                    $desenvolvimento->setDesDataCadastro($dado['des_datacadastro']);
                    $desenvolvimento->setDesDataAlteracao($dado['des_dataalteracao']);
                    $desenvolvimento->setDesStatus($dado['des_status']);
                    $desenvolvimento->setDesAnexo($dado['des_anexo']);
                    $desenvolvimento->setDesUsuario(new Usuario());
                    $desenvolvimento->getDesUsuario()->setId($dado['id']);
                    $desenvolvimento->getDesUsuario()->setNome($dado['nome']);
                    $desenvolvimento->getDesUsuario()->setEmail($dado['email']);
                    $desenvolvimento->getDesUsuario()->setNivel($dado['nivel']);
                    $desenvolvimento->getDesUsuario()->setStatus($dado['status']);
                    $desenvolvimento->getDesUsuario()->setDepartamento(new Departamento());
                    $desenvolvimento->getDesUsuario()->getDepartamento()->setId($dado['idDep']);
                    $desenvolvimento->getDesUsuario()->getDepartamento()->setId($dado['nomeDep']);
                    
                    $lista[] = $desenvolvimento;
                }
              
                return $lista;        
    }

    public function salvar(Desenvolvimento $desenvolvimento)
    {
        try {
            
                $regra           = $desenvolvimento->getDesRegraNegocio();
                $requisito       = $desenvolvimento->getDesRequisito();
                $geral           = $desenvolvimento->getDesGeral();
                $teste           = $desenvolvimento->getDesTeste();
                $correcao        = $desenvolvimento->getDesCorrecao();
                $dataAlteracaoDesenvolvimento   = $desenvolvimento->getDesDataAlteracao()->format('Y-m-d H:m:s');;;
                $dataCadastroDesenvolvimento    = $desenvolvimento->getDesDataCadastro()->format('Y-m-d H:m:s');;;
                $anexo           = $desenvolvimento->getDesAnexo();
                $status          = $desenvolvimento->getDesStatus();
                $usuario         = $desenvolvimento->getDesUsuario()->getId();
                $nomeanexo                      =  date('Y-m-d-H:m:s');
    
            if (!$_FILES['anexo']['name'] == "") {
                $validextensions = array("jpeg", "jpg", "png", "PNG", "JPG", "JPEG", "pdf", "PDF", "docx");
                $temporary = explode(".", $_FILES["anexo"]["name"]);
                $file_extension = end($temporary);
                $anexo = md5($nomeanexo) . "." . $file_extension;
                //var_dump($file_extension);

                if (in_array($file_extension, $validextensions)) {
                    $sourcePath = $_FILES['anexo']['tmp_name'];
                    $targetPath = "public/assets/media/anexos/" . md5($nomeanexo) . "." . $file_extension;
                    move_uploaded_file($sourcePath, $targetPath); // Move arquivo                    
                }
            } else {
                $anexo = "sem_anexo1.png";
            }                        
            return $this->insert(
                'desenvolvimento',
                   ":des_requisito,
                    :des_regranegocio,
                    :des_geral,
                    :des_teste,
                    :des_correcao,
                    :des_datacadastro,
                    :des_dataalteracao,
                    :des_usuario,
                    :des_status,
                    :des_anexo",
                [                    
                    ':des_requisito'  => $requisito,
                    ':des_regranegocio' =>$regra,
                    ':des_geral'         => $geral,
                    ':des_teste'           => $teste,
                    ':des_correcao'           => $correcao,                    
                    ':des_datacadastro' => date('Y-m-d H:i:s'),
                    ':des_dataalteracao'=> date('Y-m-d H:i:s'),
                    ':des_usuario'      =>$usuario,
                    ':des_status'  =>$status,
                    ':des_anexo'  =>$anexo
                ]
            );
                
            } catch (\Exception $e) {
                    //var_dump($e);
                    throw new \Exception("Erro na gravação de dados. " . $e, 500);
            }
        

    }
    public function alterar(Desenvolvimento $desenvolvimento)
    {        
        try {             
            $idDesenvolvimento              = $desenvolvimento->getDesId();
            $regra           = $desenvolvimento->getDesRegraNegocio();
            $requisito       = $desenvolvimento->getDesRequisito();
            $geral           = $desenvolvimento->getDesGeral();
            $teste           = $desenvolvimento->getDesTeste();
            $correcao        = $desenvolvimento->getDesCorrecao();
            $dataAlteracaoDesenvolvimento   = $desenvolvimento->getDesDataAlteracao()->format('Y-m-d H:m:s');;;
            $dataCadastroDesenvolvimento    = $desenvolvimento->getDesDataCadastro()->format('Y-m-d H:m:s');;;
            $anexo           = $desenvolvimento->getDesAnexo();
            $status          = $desenvolvimento->getDesStatus();
            $usuario         = $desenvolvimento->getDesUsuario()->getId();
            $nomeanexo                      =  date('Y-m-d-H:m:s');
            

            if (!$_FILES['anexo']['name'] == "") {
                $validextensions = array("jpeg", "jpg", "png", "PNG", "JPG", "JPEG", "pdf", "PDF", "docx");
                $temporary = explode(".", $_FILES["anexo"]["name"]);
                $file_extension = end($temporary);
                $anexo = md5($nomeanexo) . "." . $file_extension;
                //var_dump($file_extension);

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
            return $this->update(
                'desenvolvimento',
                /* ,    des_requisito,    des_regranegocio,    des_geral,    des_teste,    des_datacadastro,
        des_dataalteracao,    des_usuario,    des_status,    des_anexo */
                   "des_requisito     =:req$requisito,
                   des_regranegocio    =:regra,
                   des_geral            =:geral,
                   des_teste              =:teste,
                   des_correcao              =:correcao,
                   des_dataalteracao           =:dataalteracao,
                   des_usuario         =:usuario,
                   des_status        =:status,
                   des_anexo         =:ane$anexo",
                [
                    ':idDesenvolvimento'=> $idDesenvolvimento,
                    ':reqrequisito'      =>$requisito,
                    ':regra'     =>$regra,
                    ':geral'             => $geral,
                    ':teste'               => $teste,
                    ':correcao'               => $correcao,
                    ':dataalteracao'            => date('Y-m-d H:i:s'),
                    ':usuario'          =>$usuario,
                    ':status'         =>$status,
                    ':ane$anexo'          =>$anexo,
                    ':dataalteracao'    => date('Y-m-d H:i:s'),
                ],
                "des_id =:idDesenvolvimento"
            );          
        } catch (\Exception $e) {
           // var_dump("teste ".$e);
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }

    public function excluir(Desenvolvimento $desenvolvimento)
    {        
        try {
            $idDesenvolvimento = $desenvolvimento->getDesId();

            return $this->delete('desenvolvimento', "tra_id = $idDesenvolvimento");
        } catch (\Exception $e) {
            throw new \Exception("Erro ao excluir cadastro! ", 500);
        }
    }

}