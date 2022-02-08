<?php

namespace App\Models\DAO;

use App\Models\Entidades\Estado;
use App\Models\Entidades\Usuario;

class EstadoDAO extends BaseDAO
{
    public  function listar($estId = null)
    {

        if ($estId) {         
            $resultado = $this->select(
                " SELECT e.est_id, e.est_nome, e.est_uf, e.est_datacadastro, e.est_dataalteracao, u.id, u.nome, u.apelido, u.nome
                FROM estados e 
                INNER JOIN usuarios u ON u.id = e.usuario_id WHERE e.est_id = $estId "
            );
            $dado = $resultado->fetch();
            if ($dado) {
                $estado = new Estado();
                $estado->setEstId($dado['est_id']);
                $estado->setEstNome($dado['est_nome']);
                $estado->setEstUf($dado['est_uf']);
                $estado->setDataCadastro($dado['est_datacadastro']);
                $estado->setDataAlteracao($dado['est_dataalteracao']);
                $estado->setUsuario(new Usuario);
                $estado->getUsuario()->setNome($dado['nome']);
                $estado->getUsuario()->setApelido($dado['apelido']);
                $estado->getUsuario()->setEmail($dado['email']);
                
                return $estado;
            }
        } else {
            $resultado = $this->select(
                "SELECT e.est_id, e.est_nome, e.est_uf, e.est_datacadastro, e.est_dataalteracao, u.id, u.nome, u.apelido, u.nome 
                FROM estados e  INNER JOIN usuarios u ON u.id = e.usuario_id  ORDER BY e.est_nome " 
            );
            $dados = $resultado->fetchAll();

            if ($dados) {

                $lista = [];

                foreach ($dados as $dado) {

                    $estado = new Estado();
                    $estado->setEstId($dado['est_id']);
                    $estado->setEstNome($dado['est_nome']);
                    $estado->setEstUf($dado['est_uf']);
                    $estado->setDataCadastro($dado['est_datacadastro']);
                    $estado->setDataAlteracao($dado['est_dataalteracao']);
                    $estado->setUsuario(new Usuario);
                    $estado->getUsuario()->setNome($dado['nome']);
                    $estado->getUsuario()->setApelido($dado['apelido']);
                    $estado->getUsuario()->setEmail($dado['email']);
                    $lista[] = $estado;
                }               
                return $lista;
            }
        }

        return false;
    }    
    
    public function listaPorNome(Estado $estado)
    {
        $resultado = $this->select(
            "SELECT est_id, est_nome, est_uf, usuario_id, est_datacadastro, est_dataalteracao  
            FROM estados WHERE est_nome 
            LIKE '%".$estado->getEstNome()."%' LIMIT 0,6"
        );
    
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);
    }
   
   
    public function listaPorUf(Estado $estado)
    {
        $resultado = $this->select(
            "SELECT est_id, est_nome, est_uf, usuario_id, est_datacadastro, est_dataalteracao 
            FROM estados WHERE est_nome 
            LIKE '%".$estado->getEstUf()."%' LIMIT 0,6"
        );
    
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);
    }
    
     public  function salvar(Estado $estado)
    {
        try {

            $estNome            = $estado->getEstNome();
            $estUf              = $estado->getEstUf();
            $estUsuario         = $estado->getEstUsuario();
            $dataCadastro       = date('Y-m-d H:i:s');

            return $this->insert(
                'estados',
                ":est_nome, :est_uf, :usuario_id, :est_datacadastro ",
                [
                    ':est_nome' => $estNome,
                    ':es_tuf' => $estUf,
                    ':usuario_id' => $estUsuario,
                    ':est_datacadastro' => $dataCadastro
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ", 500);
        }
    }

    public  function atualizar(Estado $estado){
        try {

            $estId               =$estado->getEstId();
            $estNome             =$estado->getEstNome();
            $estUf               =$estado->getEstUf();
            $estUsuario          =$estado->getEstUsuario();
            $dataAlteracao       = date('Y-m-d H:i:s');
            return $this->update(
                'estados',
                "est_nome = :estNome, est_uf = :estUf, usuario_id = :estUsuario, cid_dataalteracao = :dataAlteracao " ,
                [
                    ':estId' => $estId,
                    ':estNome' => $estNome,
                    ':estUf' => $estUf,
                    ':estUsuario' => $estUsuario,
                    ':dataAlteracao' => $dataAlteracao,
                ],
                "est_id = :estId"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ", 500);
        }
    }

    public function excluir(Estado $estado)
    {
        try {
            $estId =$estado->getEstId();

            return $this->delete('estados', "est_id = $estId");
        } catch (Exception $e) {

            throw new \Exception("Erro ao deletar. ", 500);
        }
    }
}
