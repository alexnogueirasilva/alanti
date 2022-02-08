<?php

namespace App\Models\DAO;

use App\Models\Entidades\Fornecedor;

class FornecedorDAO extends BaseDAO
{
    public  function listar($fornecedor_cod = null)
    {

        if ($fornecedor_cod) {
            $resultado = $this->select(
                "SELECT * FROM fornecedor WHERE fornecedor_cod = $fornecedor_cod"
            );
            $dado = $resultado->fetch();

            if ($dado) {
                $fornecedor = new Fornecedor();
                $fornecedor->setFornecedor_Cod($dado['fornecedor_cod']);
                $fornecedor->setForRazaoSocial($dado['razaosocial']);
                $fornecedor->setForNomeFantasia($dado['nomefantasia']);
                $fornecedor->setForCnpj($dado['CNPJ']);
                //$fornecedor->setForDataCadastro($dado['for_datacadastro']);

                return $fornecedor;
            }
        } else {

            $resultado = $this->select(
                "SELECT * FROM fornecedor ORDER BY razaoSocial"
            );
            $dados = $resultado->fetchAll();

            if ($dados) {

                $lista = [];

                foreach ($dados as $dado) {

                    $fornecedor = new Fornecedor();
                   $fornecedor->setFornecedor_Cod($dado['fornecedor_cod']);
                   $fornecedor->setForRazaoSocial($dado['razaosocial']);
                   $fornecedor->setForNomeFantasia($dado['nomefantasia']);
                   $fornecedor->setForCnpj($dado['CNPJ']);
                   //$fornecedor->setForDataCadastro($dado['for_datacadastro']);
                   
                    $lista[] = $fornecedor;
                }
             
                return $lista;
            }
           
        }

        return false;
    }
    public  function listarId($fornecedorId)
    {
        /*
         $sql = " SELECT * FROM fornecedor f 
               -- INNER JOIN pessoas p ON p.pes_id = f.pessoa_id
                INNER JOIN enderecos end ON end.pessoa_id = f.pessoa_id                
                INNER JOIN cidades cid ON cid.cid_id = end.cidade_id
                INNER JOIN estados e ON e.est_id = cid.estado_id 
                WHERE f.fornecedor_cod = {$fornecedorId} ";
        */
                $sql = " SELECT * FROM fornecedor f
                WHERE f.fornecedor_cod = {$fornecedorId} ";

            $resultado = $this->select($sql);
            $dados = $resultado->fetchAll();
            if ($dados) {

                $lista = [];

                foreach ($dados as $dado) {           
                $fornecedor = new Fornecedor();
                $fornecedor->setFornecedor_Cod($dado['fornecedor_cod']);
                $fornecedor->setForRazaoSocial($dado['razaosocial']);
                $fornecedor->setForNomeFantasia($dado['nomefantasia']);
                $fornecedor->setForCnpj($dado['CNPJ']);
                //$fornecedor->setForIe($dado['for_ie']);
                /*$fornecedor->setForDataCadastro($dado['for_datacadastro']);
                $fornecedor->setForDataAlteracao($dado['for_dataalteracao']);
                $fornecedor->setForTipo($dado['for_tipo']);
                $fornecedor->setForStatus($dado['for_status']);
                $fornecedor->setForPessoa($dado['pessoa_id']);
                $fornecedor->setEndLongradouro($dado['end_longradouro']);
                $fornecedor->setEndNumero($dado['end_numero']);
                $fornecedor->setEndBairro($dado['end_bairro']);
                $fornecedor->setEndComplemento($dado['end_complemento']);
                $fornecedor->setEndPontoReferencia($dado['end_pontoreferencia']);
                $fornecedor->setEndCep($dado['end_cep']);
                $fornecedor->setEndPessoa($dado['pessoa_id']);
                $fornecedor->setPessoa(new Pessoa());
                $fornecedor->getPessoa()->setPesId($dado['pes_id']);
                $fornecedor->getPessoa()->setPesTipo($dado['pes_tipo']);
                $fornecedor->setEndCidade(new Cidade());
                $fornecedor->getEndCidade()->setCidId($dado['cid_id']);
                $fornecedor->getEndCidade()->setCidNome($dado['cid_nome']);
                $fornecedor->getEndCidade()->setEstado(new Estado());
                $fornecedor->getEndCidade()->getEstado()->setEstId($dado['est_id']);
                $fornecedor->getEndCidade()->getEstado()->setEstNome($dado['est_nome']);
                $fornecedor->getEndCidade()->getEstado()->setEstUf($dado['est_uf']);                
                $fornecedor->setUsuario(new Usuario());
                $fornecedor->getUsuario()->setId($dado['id']);
                $fornecedor->getUsuario()->setNome($dado['nome']);
                $fornecedor->getUsuario()->setApelido($dado['apelido']);
                $fornecedor->getUsuario()->setEmail($dado['email']);
                $fornecedor->getUsuario()->setNivel($dado['nivel']);*/

                $lista[] = $fornecedor;
            }          
            return $lista;
        }
    }
    public  function qtde()
    {
        $resultado = $this->select(
            "SELECT COUNT(*) FROM fornecedor"
        );
        $fornecedor = $resultado->fetch();

        return $fornecedor;

        if ($fornecedor) {

            return $fornecedor;
        }

        return false;
    }
    public  function qtde1()
    {
        $resultado = $this->select(
            // "SELECT COUNT(*) FROM fornecedor"
            "SELECT R.codFornecedor,R.razaoSocial, R.qtdePedidos FROM (
                SELECT DISTINCT f.razaoSocial, f.codFornecedor,
                (SELECT COUNT(p.nome) AS qtde
                FROM produto AS p 
                WHERE f.codFornecedor = p.fornecedor_id
                ) as qtdePedidos FROM fornecedor as f ) AS R
                WHERE R.qtdePedidos > 0
                 ORDER BY R.qtdePedidos DESC "
        );
        $dados = $resultado->fetchAll();

        /*if ($dados) {

            $lista = [];

            foreach ($dados as $dado) {

                $fornecedor = new Fornecedor();
                //  $fornecedor->setCodFornecedor($dado['codFornecedor']);
                $fornecedor->setCodFornecedor($dado['qtdePedidos']);
                $fornecedor->setRazaoSocial($dado['razaoSocial']);
                //  $fornecedor->setNomeFantasia($dado['nomeFantasia']);
                //  $fornecedor->setCnpj($dado['cnpj']);
                $fornecedor->$dado['qtdePedidos'];

                $lista[] = $fornecedor;
            }
            return $lista;
            
    }*/
        return $dados;
        // return false;
    }


    public  function salvar(Fornecedor $fornecedor)
    {
        try {

            $nomeFantasia   = $fornecedor->getForNomeFantasia();
            $razaoSocial    = $fornecedor->getForRazaoSocial();
            $cnpj           = $fornecedor->getForCnpj();
            $dataCadastro   = date('Y-m-d H:i:s');
            $dataAlteracao  = date('Y-m-d H:i:s');

            return $this->insert(
                'fornecedor',
                ":razaosocial,:nomefantasia, :for_datacadastro, :for_dataalteracao, :CNPJ",
                [
                    ':razaosocial'          => $razaoSocial,
                    ':nomefantasia'         => $nomeFantasia,
                    ':for_datacadastro'     => $dataCadastro,
                    ':for_dataalteracao'    => $dataAlteracao,
                    ':CNPJ'                 => $cnpj
                ]
            );
        } catch (\Exception $e) {
            
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }

    public  function atualizar(Fornecedor $fornecedor)
    {
        try {

            $codFornecedor  = $fornecedor->getFornecedor_Cod();
            $nomeFantasia   = $fornecedor->getForNomeFantasia();
            $razaoSocial    = $fornecedor->getForRazaoSocial();
            $cnpj           = $fornecedor->getForCnpj();
            $dataAlteracao  = date('Y-m-d H:i:s');

            return $this->update(
                'fornecedor',
                "razaoSocial = :razaoSocial, nomeFantasia = :nomeFantasia, cnpj = :cnpj,  for_dataalteracao = :dataAlteracao",
                [
                    ':fornecedor_cod'   => $codFornecedor,
                    ':razaoSocial'      => $nomeFantasia,
                    ':nomeFantasia'     => $razaoSocial,
                    ':cnpj'             => $cnpj,
                    ':dataAlteracao'    =>  $dataAlteracao,
                ],
                "fornecedor_cod = :fornecedor_cod"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }

    public function excluir(Fornecedor $fornecedor)
    {
        try {
            $codFornecedor = $fornecedor->getFornecedor_Cod();

            return $this->delete('fornecedor', "fornecedor_cod = $codFornecedor");
        } catch (\Exception $e) {

            throw new \Exception(" Erro ao deletar ", 500);
        }
    }

    public function listarFornecedor(Fornecedor $fornecedor)
    {
        $resultado = $this->select("SELECT f.fornecedor_cod, f.nomefantasia FROM fornecedor f WHERE f.nomefantasia LIKE '%" . $fornecedor->getForNomeFantasia() . "%' LIMIT 0,6");

        return $resultado->fetchAll(\PDO::FETCH_ASSOC);
    }
}
