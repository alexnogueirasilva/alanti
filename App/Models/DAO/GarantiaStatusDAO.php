<?php

namespace App\Models\DAO;

use App\Models\Entidades\GarantiaStatus;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Instituicao;

class GarantiaStatusDAO extends BaseDAO
{
    public  function listar(GarantiaStatus $garantiaStatus)
    {             
        $codigo    = $garantiaStatus->getStGarId();
        $nome      = $garantiaStatus->getStGarNome();

        $SQL = " SELECT gst.stgar_id, gst.stgar_nome, gst.stgar_observacao, gst.stgar_usuario, 
        gst.stgar_instituicao,  gst.stgar_datacadastro, gst.stgar_dataalteracao,
        u.id, u.nome, u.email, i.inst_id, i.inst_nome, i.inst_codigo
        FROM crt_garantiaStatus gst
        INNER JOIN instituicao i ON i.inst_id = gst.stgar_instituicao
        INNER JOIN usuarios u ON u.id = gst.stgar_usuario  ";                 
             $where = Array();
             if( $codigo ){ $where[] = " gst.stgar_id = {$codigo}"; }
             if( $nome ){ $where[] = " gst.stgar_nome = '{$nome}'"; }
          
          if( sizeof( $where ) ){

              $SQL .= ' WHERE '.implode( ' AND ',$where );
          }else {
            $SQL .= " WHERE gst.stgar_id  ORDER BY gst.stgar_id desc ";
        }
          $resultado = $this->select($SQL);
         
          $dados = $resultado->fetchAll();
          $lista = [];
          foreach ($dados as $dado) { 
            
        $garantiaStatus = new GarantiaStatus();
        $garantiaStatus->setStGarId($dado['stgar_id']);
        $garantiaStatus->setStGarNome($dado['stgar_nome']);
        $garantiaStatus->setStGarObservacao($dado['stgar_observacao']);
        $garantiaStatus->setStGarDataCadastro($dado['stgar_datacadastro']);
        $garantiaStatus->setStGarDataAlteracao($dado['stgar_dataalteracao']);
        $garantiaStatus->setStGarUsuario(new Usuario());
        $garantiaStatus->getStGarUsuario()->setId($dado['id']);
        $garantiaStatus->getStGarUsuario()->setNome($dado['nome']);
        $garantiaStatus->getStGarUsuario()->setEmail($dado['email']);
        $garantiaStatus->setStGarInstituicao(new Instituicao());
        $garantiaStatus->getStGarInstituicao()->setInst_Id($dado['inst_id']);                    
        $garantiaStatus->getStGarInstituicao()->setInst_Nome($dado['inst_nome']);  
        $garantiaStatus->getStGarInstituicao()->setInst_Codigo($dado['inst_codigo']);  
           
        $lista[] = $garantiaStatus;
        }
        return $lista;                
    }

    public  function salvar(GarantiaStatus $garantiaStatus)
    {     
        try {
            $nome              = $garantiaStatus->getStGarNome();
            $observacao        = $garantiaStatus->getStGarObservacao();
            $dataCadastro      = $garantiaStatus->getStGarDataAlteracao()->format('Y-m-d H:m:s');
            $dataAlteracao     = $garantiaStatus->getStGarDataCadastro()->format('Y-m-d H:m:s');
            $usuario           = $garantiaStatus->getStGarUsuario()->getId();
            $instituicao       = $garantiaStatus->getStGarInstituicao()->getInst_Id();
            
            return $this->insert(
                'crt_garantiastatus',
                ":stgar_nome, :stgar_observacao, :stgar_usuario, :stgar_instituicao, :stgar_datacadastro, :stgar_dataalteracao",
                [
                    ':stgar_nome' => $nome,
                    ':stgar_observacao' => $observacao,
                    ':stgar_usuario' => $usuario,
                    ':stgar_instituicao' => $instituicao,
                    ':stgar_datacadastro' =>date('Y-m-d H:i:s'),
                    ':stgar_dataalteracao' =>date('Y-m-d H:i:s')
                    ]
                ); 
            } catch (\Exception $e) {        
                throw new \Exception("Erro na gravação de dados. " . $e, 500);
            }
    }
        
    public  function atualizar(GarantiaStatus $garantiaStatus)
    {
        try {                  
            $codigo            = $garantiaStatus->getStGarId();
            $nome              = $garantiaStatus->getStGarNome();
            $observacao        = $garantiaStatus->getStGarObservacao();
            $dataCadastro      = $garantiaStatus->getStGarDataAlteracao()->format('Y-m-d H:m:s');
            $dataAlteracao     = $garantiaStatus->getStGarDataCadastro()->format('Y-m-d H:m:s');
            $usuario           = $garantiaStatus->getStGarUsuario()->getId();
            $instituicao       = $garantiaStatus->getStGarInstituicao()->getInst_Id();
                   
            return $this->update(
                'crt_garantiastatus',               
            "   stgar_nome          =: nome,
                stgar_observacao    =: observacao,
                stgar_usuario       =: usuario,
                tgar_instituicao    =: instituicao,
                stgar_dataalteracao =: dataalteracao",
                 [
                    ':nome'             => $nome,
                    ':observacao'       => $observacao,
                    ':usuario'          => $usuario,
                    ':instituicao'      => $instituicao,
                    ':dataalteracao'    => date('Y-m-d H:i:s'),
                ],
                " ntf_cod = :notificacaoId"
                );  
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ", 500);
        }
    }

    public function excluir(GarantiaStatus $garantiaStatus)
    {
        try {
            $garantiaStatus = $garantiaStatus->getStGarId();
            return $this->delete('crt_garantiaStatus', "stgar_id = $garantiaStatus");
        } catch (Exception $e) {
          //  var_dump($e);
            throw new \Exception("Erro ao excluir ", 500);
        }
    }
}
