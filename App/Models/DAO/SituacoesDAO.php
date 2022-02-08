<?php

namespace App\Models\DAO;

use App\Models\Entidades\Cors;
use App\Models\Entidades\Situacoes;

class SituacoesDAO extends  BaseDAO
{

    public  function listar($situacoes)
    {   
        $codigo     = $situacoes->getSitId();
        $nome       = $situacoes->getSitNome();
        $corId      = $situacoes->getCor();

            $sql = " SELECT s.sit_id, s.sit_nome, s.sit_datacadastro, s.sit_dataalteracao,s.usuario_id,
            c.cor_id, c.cor_nome, c.cor_cor
            FROM situacoes s
            INNER JOIN cors c ON c.cor_id = s.cor_id ";
            $where = Array();
             if( $codigo){ $where[] = " s.sit_id = {$codigo}"; }
             if( $corId){ $where[] = " c.cor_id = {$corId}"; }
             if( $nome){ $where[] = " s.sit_nome LIKE '%{$nome}%'"; }   
             
          if( sizeof( $where ) ){
            $sql .= ' WHERE '.implode( ' AND ',$where );
           }else {
            $sql.= " ORDER BY s.sit_id DESC ";
           }

           $resultado = $this->select($sql );
           $dados = $resultado->fetchAll();           
            if ($dados) {
                $lista = [];

                foreach ($dados as $dado) {
                    $situacoes = new Situacoes();
                    $situacoes->setSitId($dado['sit_id']);
                    $situacoes->setSitNome($dado['sit_nome']);
                    $situacoes->setSitDataCadastro($dado['sit_datacadastro']);
                    $situacoes->setSitDataAlteracao($dado['sit_dataalteracao']);
                    $situacoes->setUsuario($dado['usuario_id']);
                    $situacoes->setCors(new Cors());
                    $situacoes->getCors()->setCorId($dado['cor_id']);
                    $situacoes->getCors()->setCorNome($dado['cor_nome']);
                    $situacoes->getCors()->setCorCor($dado['cor_cor']);
                   
                    $lista[] = $situacoes;
                }                           
                return $lista;
            }           
    }
   
    
    public function salvar(Situacoes $situacoes)
    {
        try {
            $nome           = $situacoes->getSitNome();
            $corId          = $situacoes->getCor();
            $dataCadastro   = date('Y-m-d H:i:s');
            $dataAlteracao  = date('Y-m-d H:i:s');
            $usuario        = $_SESSION['id'];
            
            return $this->insert(
                'situacoes',
                ":sit_nome, :cor_id, :sit_datacadastro, :sit_dataalteracao, :usuario_id",
                [
                    ":sit_nome"             => $nome,
                    ':cor_id'               => $corId,
                    ':sit_datacadastro'     => $dataCadastro,
                    ':sit_dataalteracao'    => $dataAlteracao,
                    ":usuario_id"           => $usuario
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados:" . $e->getMessage(), 500);
        }
    }

    public function atualizar(Situacoes $situacoes)
    {
        try {
            
            $codigo         = $situacoes->getSitId();
            $nome           = $situacoes->getSitNome();
            $corId          = $situacoes->getCor();
            $dataAlteracao  = date('Y-m-d H:i:s');
            $usuario        = $_SESSION['id'];

            return $this->update(
                'situacoes',
                " sit_nome =:nome, cor_id =:cor, 
                sit_dataalteracao =:dataAlteracao,
                usuario_id =:usuario ",
                [
                    ':codigo'           => $codigo,
                    ':nome'             => $nome,
                    ':cor'              => $corId,
                    ':dataAlteracao'    => $$dataAlteracao,
                    ':usuario'          => $usuario,
                ],
                "sit_id = :codigo"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro ao alterar dados " . $e->getMessage(), 500);
        }
    }

    public function excluir(Situacoes $situacoes)
    {
        try {
            $codigo = $situacoes->getSitId();
            return $this->delete('situacoes', 
            ":sit_id = $codigo"
        );
        } catch (\Exception $e) {
            throw new \Exception("Erro ao deletar" . $e->getMessage(), 500);
        }
    }
}