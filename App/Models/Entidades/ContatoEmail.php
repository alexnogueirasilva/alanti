<?php 

namespace App\Models\Entidades;

use DateTime;

class ContatoEmail

{
    //cnte = contato email
    private $cnteId;
    private $cnteNome;
    private $cnteEmail;
    private $cnteAssunto;
    private $cnteMensagem;
    private $cnteDataCadastro;
    private $cnteDataAlteracao;

    /**
     * Get the value of cnteId
     */ 
    public function getCnteId()
    {
        return $this->cnteId;
    }

    /**
     * Set the value of cnteId
     *
     * @return  self
     */ 
    public function setCnteId($cnteId)
    {
        $this->cnteId = $cnteId;

        return $this;
    }

    /**
     * Get the value of cnteNome
     */ 
    public function getCnteNome()
    {
        return $this->cnteNome;
    }

    /**
     * Set the value of cnteNome
     *
     * @return  self
     */ 
    public function setCnteNome($cnteNome)
    {
        $this->cnteNome = $cnteNome;

        return $this;
    }

    /**
     * Get the value of cnteAssunto
     */ 
    public function getCnteAssunto()
    {
        return $this->cnteAssunto;
    }

    /**
     * Set the value of cnteAssunto
     *
     * @return  self
     */ 
    public function setCnteAssunto($cnteAssunto)
    {
        $this->cnteAssunto = $cnteAssunto;

        return $this;
    }

    /**
     * Get the value of cnteMensagem
     */ 
    public function getCnteMensagem()
    {
        return $this->cnteMensagem;
    }

    /**
     * Set the value of cnteMensagem
     *
     * @return  self
     */ 
    public function setCnteMensagem($cnteMensagem)
    {
        $this->cnteMensagem = $cnteMensagem;

        return $this;
    }

    /**
     * Get the value of cnteDataCadastro
     */ 
    public function getCnteDataCadastro()
    {
        return new DateTime($this->cnteDataCadastro);
    }

    /**
     * Set the value of cnteDataCadastro
     *
     * @return  self
     */ 
    public function setCnteDataCadastro($cnteDataCadastro)
    {
        $this->cnteDataCadastro = $cnteDataCadastro;

        return $this;
    }

    /**
     * Get the value of cnteDataAlteracao
     */ 
    public function getCnteDataAlteracao()
    {
        return new DateTime( $this->cnteDataAlteracao);
    }

    /**
     * Set the value of cnteDataAlteracao
     *
     * @return  self
     */ 
    public function setCnteDataAlteracao($cnteDataAlteracao)
    {
        $this->cnteDataAlteracao = $cnteDataAlteracao;

        return $this;
    }

    /**
     * Get the value of cnteEmail
     */ 
    public function getCnteEmail()
    {
        return $this->cnteEmail;
    }

    /**
     * Set the value of cnteEmail
     *
     * @return  self
     */ 
    public function setCnteEmail($cnteEmail)
    {
        $this->cnteEmail = $cnteEmail;

        return $this;
    }
}