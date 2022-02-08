<?php

namespace App\Models\DAO;

use App\Models\Entidades\Pessoa;

class PessoaDAO extends BaseDAO
{
    public  function listar(Pessoa $pessoa) 
    {
        $id = $pessoa->getPesId();
        $tipo = $pessoa->getPesTipo();
        $Sql = "SELECT * FROM pessoas " ;        

            $resultado = $this->select(
               $Sql);
            $dados = $resultado->fetchAll();
            $where = Array();
            if( $id ){ $where[] = " pes_id = {$id}"; }
            if( $tipo ){ $where[] = " pes_tipo = '{$tipo}'"; }
            
            if( sizeof( $where ) ){
                $SQL .= ' WHERE '.implode( ' AND ',$where );
               }
            if ($dados) {
                $lista = [];
                foreach ($dados as $dado) {
                   $pessoa = new Pessoa();
                   $pessoa->setPesId($dado['pes_id']);
                   $pessoa->setPesTipo($dado['pes_tipo']);
            
                    $lista[] = $pessoa;
                }    
                return $lista;
            }
    }

    public  function salvar($tipo)
    {
        try {
          $tipo      = $tipo;
            $usuario         = $_SESSION['id'];
           $dataCadastro    = date('Y-m-d H:i:s');
           $dataAlteracao   = date('Y-m-d H:i:s');
            return $this->insert(
                'pessoas',
                ":pes_tipo, :usuario_id, :pes_datacadastro, :pes_dataalteracao",
                [
                    ':pes_tipo'             => $tipo,
                    ':usuario_id'           => $usuario,
                    ':pes_datacadastro'     => $dataCadastro,
                    ':pes_dataalteracao'    => $dataAlteracao
                ]
            );
        } catch (\Exception $e) {
            
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public  function atualizar(Pessoa $pessoa){
        try {
            $id      =$pessoa->getPesId();
            $tipo    =$pessoa->getPesTipo();
            return $this->update(
                'pessoas',
                "pes_tipo = :tipo",
                [
                    ':id' => $id,
                    ':tipo' => $tipo,
                ],
                "pes_id = :id"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ", 500);
        }
    }

    public function excluir(Pessoa $pessoa)
    {        
        try {
            $id = $pessoa->getPesId();            
            return $this->delete('pessoas', "pes_id = $id");
        } catch (Exception $e) {
            throw new \Exception("Erro ao deletar", 500);
        }
    }
}