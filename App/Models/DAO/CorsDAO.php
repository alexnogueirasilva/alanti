<?php

namespace App\Models\DAO;

use App\Models\Entidades\Cors;

class CorsDAO extends  BaseDAO
{

    public  function listar($cors)
    {   
        $codigo     = $cors->getCorId();
        $nome       = $cors->getCorNome();

            $sql = " SELECT cor_id, cor_nome, cor_cor, cor_datacadastro, cor_dataalteracao, usuario_id ";
            $where = Array();
             if( $codigo){ $where[] = " c.licitacaoCliente_cod = {$codigo}"; }
             if( $nome ){ $where[] = " cor_nome LIKE '%{$nome}%'"; }   
             
          if( sizeof( $where ) ){
            $sql .= ' WHERE '.implode( ' AND ',$where );
           }else {
            $sql.= " ORDER BY cor_id DESC ";
           }

           $resultado = $this->select($sql );
           $dados = $resultado->fetchAll();           
            if ($dados) {
                $lista = [];

                foreach ($dados as $dado) {
                    $cors = new Cors();
                    $cors->setCorId($dado['cor_id']);
                    $cors->setCorNome($dado['cor_nome']);
                    $cors->setCorCor($dado['cor_cor']);
                    $cors->setCorDataAlteracao($dado['cor_dataalteracao']);
                    $cors->setCorDataCadastro($dado['cor_datacadastro']);
                    $cors->setUsuario($dado['usuario_id']);
                   
                    $lista[] = $cors;
                }                           
                return $lista;
            }           
    }
   
    
    public function salvar(Cors $cors)
    {
        try {

            $nome           = $cors->getCorNome();
            $cor            = $cors->getCorCor();
            $dataCadastro   = date('Y-m-d H:i:s');
            $dataAlteracao  = date('Y-m-d H:i:s');
            $usuario        = $_SESSION['id'];
            
            return $this->insert(
                'cors',
                ":cor_nome, :cor_cor, :cor_datacadastro, :cor_dataalteracao, :usuario_id",
                [
                    ":cor_nome"             => $nome,
                    ':cor_cor'              => $cor,
                    ':cor_datacadastro'     => $dataCadastro,
                    ':cor_dataalteracao'    => $dataAlteracao,
                    ":usuario_id"           => $usuario
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados:" . $e->getMessage(), 500);
        }
    }

    public function atualizar(Cors $cors)
    {
        try {
            
            $codigo         = $cors->getCorId();
            $nome           = $cors->getCorNome();
            $cor            = $cors->getCorCor();
            $dataAlteracao  = date('Y-m-d H:i:s');
            $usuario        = $_SESSION['id'];

            return $this->update(
                'cors',
                "  cor_nome =:nome, cor_cor =:cor, 
                cor_dataalteracao =:dataAlteracao,
                usuario_id =:usuario ",
                [
                    ':codigo'           => $codigo,
                    ':nome'             => $nome,
                    ':cor'              => $cor,
                    ':dataAlteracao'    => $$dataAlteracao,
                    ':usuario'          => $usuario,
                ],
                "cor_id = :codigo"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro ao alterar dados " . $e->getMessage(), 500);
        }
    }

    public function excluir(Cors $cors)
    {
        try {
            $codigo = $cors->getCorId();
            return $this->delete('cors', 
            ":cor_id = $codigo"
        );
        } catch (\Exception $e) {
            throw new \Exception("Erro ao deletar" . $e->getMessage(), 500);
        }
    }
}