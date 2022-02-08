<?php

namespace App\Models\DAO;

use App\Models\Entidades\Cidade;
use App\Models\Entidades\Estado;
use App\Models\Entidades\Usuario;

class CidadeDAO extends BaseDAO
{

    public  function listar($cidade)
    {        
        $cidId      = $cidade->getCidId();
        $cidNome    = $cidade->getCidNome();
        $estado     = $cidade->getUf();
        if(!empty($estado)){
            $estado = implode("','", $estado);
        }

        $sql = " SELECT c.cid_id, c.cid_nome, c.cid_datacadastro, c.cid_dataalteracao,e.est_id, e.est_nome, e.est_uf, u.id, u.nome, u.apelido,u.email
                FROM cidades c
                INNER JOIN estados e ON e.est_id = estado_id 
                INNER JOIN usuarios u ON u.id = c.usuario_id ";

            $where = Array();
            if( $cidId){ $where[] = " c.cid_id = {$cidId}"; }
            if( $cidNome  ){ $where[] = "  c.cid_nome LIKE '%{$cidNome }%'"; }
            if( $estado ){ $where[] = " e.est_uf IN ('{$estado}')"; } 
            if( sizeof( $where ) ){
                $sql .= ' WHERE '.implode( ' AND ',$where );
            }else {
                $sql.= " ORDER BY c.cid_nome ASC ";
            }
            $resultado = $this->select($sql);
            
            $dados = $resultado->fetchAll();
                $lista = [];
                foreach ($dados as $dado) {

                    $cidade = new Cidade();
                    $cidade->setCidId($dado['cid_id']);
                    $cidade->setCidNome($dado['cid_nome']);
                    $cidade->setCidDataAlteracao($dado['cid_dataalteracao']);
                    $cidade->setCidDataCadastro($dado['cid_datacadastro']);
                    $cidade->setEstado(new Estado());
                    $cidade->getEstado()->setEstId($dado['est_id']);
                    $cidade->getEstado()->setEstNome($dado['est_nome']);
                    $cidade->getEstado()->setEstUf($dado['est_uf']);
                    $cidade->setUsuario(new Usuario());
                    $cidade->getUsuario()->setId($dado['id']);
                    $cidade->getUsuario()->setNome($dado['nome']);
                    $cidade->getUsuario()->setApelido($dado['apelido']);
                    $cidade->getUsuario()->setEmail($dado['email']);

                    $lista[] = $cidade;
                }

                return $lista;        
    }    
  

    public function listarPorCidade($cidNome = null)
    {
        if($cidNome)
        {
            $resultado = $this->select(
                "SELECT c.cid_id, c.cid_nome, c.cid_datacadastro, c.cid_dataalteracao,e.est_id, e.est_nome, e.est_uf, u.id, u.nome, u.apelido, u.email 
                FROM cidades c
                INNER JOIN estado e ON e.est_id = estado_id 
                INNER JOIN usuarios u ON u.id = usuario_id WHERE c.est_nome = $cidNome"
            );
        }
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Cidade::class);
    }

    public  function listaPorNome(Cidade $cidade)
    {       
        $resultado = $this->select(
            " SELECT c.cid_id, c.cid_nome, e.est_uf
             FROM cidades c
             INNER JOIN estados e ON e.est_id = c.estado_id 
             WHERE cid_nome 
             like '%".$cidade->getCidNome()."%' LIMIT 0,30 "
        );        
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);        
    }

    public  function salvar(Cidade $cidade)
    {
        try {

            $cidNome            = $cidade->getCidNome();
            $cidUsuario         = $cidade->getUsuario()->getId();
            $cidEstado          = $cidade->getEstado()->getEstId();            
            $cidDataCadastro    = date('Y-m-d H:i:s');

            return $this->insert(
                'cidades',
                ":cid_nome,:usuario_id, :estado_id, :cid_datacadastro",
                [
                    ':cid_nome'         => $cidNome,
                    ':usuario_id'       => $cidUsuario,
                    ':estado_id'        => $cidEstado,
                    ':cid_datacadastro' => $cidDataCadastro
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. " . $e, 500);
        }
    }
   
    public  function atualizar(Cidade $cidade)
    {
        try {
            
            $cidId              = $cidade->getCidId();
            $cidNome            = $cidade->getCidNome();
            $cidUsuario         = $cidade->getUsuario()->getId();
            $cidEstado          = $cidade->getEstado()->getEstId();
            
            $cidDataAlteracao   = date($date, 'Y-m-d H:i:s');
          
            return $this->update(
                'cidades',
                "cid_nome = :cidNome, usuario_id = :cidUsuario, 
                estado_id = :cidEstado,
                cid_dataalteracao = :cidDataAlteracao",
                [
                    ':cidId'            => $cidId,
                    ':cidNome'          => $cidNome,
                    ':cidUsuario'       => $cidUsuario,
                    ':cidEstado'        => $cidEstado,
                    ':cidDataAlteracao' => $cidDataAlteracao, 
                ],
                "cid_id = :cidId"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }
 
    public function excluir(Cidade $cidade)
    {
        try {
            $cidId = $cidade->getCidId();

            return $this->delete('cidades', "cid_id = $cidId");
        } catch (Exception $e) {

            throw new \Exception("Erro ao deletar", 500);
        }
    }

}
