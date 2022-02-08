<?php 

namespace App\Models\Entidades;


class Contato{

    private $cntId;
    private $cargo;
    private $contato;
    private $telefone;
    private $celular;
    private $email;
    private $codCliente;
    private $contatos;
    private $pessoa;
    private $usuario;
    private $cntDataCadastro;
    private $cntDataAlteracao;

    /**
     * Get the value of cntId
     */ 
    public function getCntId()
    {
        return $this->cntId;
    }

    /**
     * Set the value of cntId
     *
     * @return  self
     */ 
    public function setCntId($cntId)
    {
        $this->cntId = $cntId;

        return $this;
    }

    /**
     * Get the value of telefone
     */ 
    public function getTelefone() 
    {
        return $this->telefone;
    }

    /**
     * Set the value of telefone
     *
     * @return  self
     */ 
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get the value of celular
     */ 
    public function getCelular() 
    {
        return $this->celular;
    }

    /**
     * Set the value of celular
     *
     * @return  self
     */ 
    public function setCelular( $celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of codCliente
     */ 
    public function getCodCliente()
    {
        return $this->codCliente;
    }

    /**
     * Set the value of codCliente
     *
     * @return  self
     */ 
    public function setCodCliente($codCliente)
    {
        $this->codCliente = $codCliente;

        return $this;
    }

    /**
     * Get the value of cargo
     */ 
    public function getCargo() 
    {
        return $this->cargo;
    }

    /**
     * Set the value of cargo
     *
     * @return  self
     */ 
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get the value of contato
     */ 
    public function getContato()
    {
        return $this->contato;
    }

    /**
     * Set the value of contato
     *
     * @return  self
     */ 
    public function setContato($contato)
    {
        $this->contato = $contato;

        return $this;
    }
/**
         * @return mixed
         */
        public function getContatos() : array
        {
            return $this->contatos;
        }
    
        /**
         * @param mixed $Contatos
         */
        public function setContatos(array $contatos)
        {
            $this->contatos = $contatos;
        }


    /**
     * Get the value of pessoa
     */ 
    public function getPessoa()
    {
        return $this->pessoa;
    }

    /**
     * Set the value of pessoa
     *
     * @return  self
     */ 
    public function setPessoa($pessoa)
    {
        $this->pessoa = $pessoa;

        return $this;
    }

    /**
     * Get the value of cntDataCadastro
     */ 
    public function getCntDataCadastro()
    {
        return $this->cntDataCadastro;
    }

    /**
     * Set the value of cntDataCadastro
     *
     * @return  self
     */ 
    public function setCntDataCadastro($cntDataCadastro)
    {
        $this->cntDataCadastro = $cntDataCadastro;

        return $this;
    }

    /**
     * Get the value of cntDataAlteracao
     */ 
    public function getCntDataAlteracao()
    {
        return $this->cntDataAlteracao;
    }

    /**
     * Set the value of cntDataAlteracao
     *
     * @return  self
     */ 
    public function setCntDataAlteracao($cntDataAlteracao)
    {
        $this->cntDataAlteracao = $cntDataAlteracao;

        return $this;
    }

    /**
     * Get the value of usuario
     */ 
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */ 
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }
}



?>