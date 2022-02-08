<?php 

namespace App\Models\DAO;

use App\Models\Entidades\Endereco;
use App\Models\Entidades\enderecoCleinte;

class EnderecoDAO extends BaseDAO
{
    public function getById($codEndereco)
    {
        $resultado = $this->select(
            "SELECT * FROM enderecos WHERE end_id = $codEndereco"
        );

        return $resultado->fetchObject(CodCliente::class);
    }

    public function listarEndereco()
    {
        $resultado = $this->select(
            'SELECT * FROM enderecos'
        );
        return $resultado->fetchAll(\PDO::FETCH_CLASS, CodCliente::class);
    }
    
    public  function salvar(Endereco $endereco)
    {
        try {
            $longradouro        = $endereco->getEndLongradouro();
            $numero             = $endereco->getEndNumero();
            $bairro             = $endereco->getEndBairro();
            $complemento        = $endereco->getEndComplemento();
            $pontoreferencia    = $endereco->getEndPontoReferencia();
            $cep                = $endereco->getEndCep();
            $datacadastro       = $endereco->getEndDataCadastro();
            $dataalteracao      = $endereco->getEndDataAlteracao();
            $cidade             = $endereco->getEndCidade()->getCidId();
            $pessoa             = $endereco->getEndPessoa();        
            
        return $this->insert(
            'enderecos',
           ":end_longradouro,
            :end_numero,
            :end_bairro,
            :end_complemento,
            :end_pontoreferencia,
            :end_cep,
            :end_datacadastro,
            :end_dataalteracao,
            :cidade_id,
            :pessoa_id",
            [
                ':end_longradouro'      => $longradouro,
                ':end_numero'           => $numero,
                ':end_bairro'           => $bairro,
                ':end_complemento'      => $complemento,
                ':end_pontoreferencia'  => $pontoreferencia,
                ':end_cep'              => $cep,
                ':end_datacadastro'     =>  date('Y-m-d H:i:s'),
                ':end_dataalteracao'    =>  date('Y-m-d H:i:s'),
                ':cidade_id'           => $cidade,
                ':pessoa_id'           => $pessoa
            ]
        );

        } catch (\Exception $e) {
            //var_dump($e);
            throw new \Exception("Erro na gravação de dados. " . $e, 500);
    }
    }
    public function alterar(Endereco $endereco)
    {        
        try {      
                $longradouro        = $endereco->getEndLongradouro();
                $numero             = $endereco->getEndNumero();
                $bairro             = $endereco->getEndBairro();
                $complemento        = $endereco->getEndComplemento();
                $pontoreferencia    = $endereco->getEndPontoReferencia();
                $cep                = $endereco->getEndCep();
                $cidade             = $endereco->getEndCidade()->getCidId();
                $pessoa             = $endereco->getEndPessoa();       
            
            return $this->update(
                'enderecos',
                "end_longradouro        =:longradouro,
                    end_numero             =:numero,
                    end_bairro             =:bairro,
                    end_complemento        =:complemento,
                    end_pontoreferencia    =:pontoreferencia,
                    end_cep                =:cep,
                    end_dataalteracao      =:dataalteracao,
                    cidade_id             =:cidade",
                [
                    ':pessoa'           => $pessoa,
                    ':longradouro'      => $longradouro,
                    ':numero'           => $numero,
                    ':bairro'           => $bairro,
                    ':complemento'      => $complemento,
                    ':pontoreferencia'  => $pontoreferencia,
                    ':cep'              => $cep,
                    ':dataalteracao'    => date('Y-m-d H:i:s'),
                    ':cidade'           => $cidade,
                ],
                "pessoa_id = :pessoa"
            );          
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }
    public function excluir(Endereco $endereco)
    {
        
        try {
            $codPessoa = $endereco->getEndPessoa();

            return $this->delete('enderecos', "end_pessoa = $codPessoa");
        } catch (Exception $e) {

            throw new \Exception("Erro ao excluir cadastro! ", 500);
        }
        

    }
}

?>