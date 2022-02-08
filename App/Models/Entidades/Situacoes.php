<?php


namespace App\Models\Entidades;

use DateTime;

class Situacoes
{
    private $sitId;
    private $sitNome;
    private $sitDataCadastro;
    private $sitDataAlteracao;
    private $usuario;
    private $cor;
    private $cors;


    /**
     * Get the value of sitId
     */ 
    public function getSitId()
    {
        return $this->sitId;
    }

    /**
     * Set the value of sitId
     *
     * @return  self
     */ 
    public function setSitId($sitId)
    {
        $this->sitId = $sitId;

        return $this;
    }

    /**
     * Get the value of sitNome
     */ 
    public function getSitNome()
    {
        return $this->sitNome;
    }

    /**
     * Set the value of sitNome
     *
     * @return  self
     */ 
    public function setSitNome($sitNome)
    {
        $this->sitNome = $sitNome;

        return $this;
    }

    /**
     * Get the value of sitDataCadastro
     */ 
    public function getSitDataCadastro()
    {
        return new DateTime($this->sitDataCadastro);
    }

    /**
     * Set the value of sitDataCadastro
     *
     * @return  self
     */ 
    public function setSitDataCadastro($sitDataCadastro)
    {
        $this->sitDataCadastro = $sitDataCadastro;

        return $this;
    }

    /**
     * Get the value of sitDataAlteracao
     */ 
    public function getSitDataAlteracao()
    {
        return new DateTime($this->sitDataAlteracao);
    }

    /**
     * Set the value of sitDataAlteracao
     *
     * @return  self
     */ 
    public function setSitDataAlteracao($sitDataAlteracao)
    {
        $this->sitDataAlteracao = $sitDataAlteracao;

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

    /**
     * Get the value of cor
     */ 
    public function getCor()
    {
        return $this->cor;
    }

    /**
     * Set the value of cor
     *
     * @return  self
     */ 
    public function setCor($cor)
    {
        $this->cor = $cor;

        return $this;
    }
     /**
     * Get the value of cors
     */ 
    public function getCors()
    {
        return $this->cors;
    }

    /**
     * Set the value of cors
     *
     * @return  self
     */ 
    public function setCors(Cors $cors)
    {
        $this->cors = $cors;

        return $this;
    }
}
