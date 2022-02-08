<?php


namespace App\Models\Entidades;

use DateTime;

class Cors
{
    private $corId;
    private $corNome;
    private $corCor;
    private $corDataCadastro;
    private $corDataAlteracao;
    private $usuario;

    /**
     * Get the value of sitId
     */ 
    public function getCorId()
    {
        return $this->corId;
    }

    /**
     * Set the value of sitId
     *
     * @return  self
     */ 
    public function setCorId($corId)
    {
        $this->corId = $corId;

        return $this;
    }

    /**
     * Get the value of sitNome
     */ 
    public function getCorNome()
    {
        return $this->corNome;
    }

    /**
     * Set the value of sitNome
     *
     * @return  self
     */ 
    public function setCorNome($corNome)
    {
        $this->corNome = $corNome;

        return $this;
    }

    /**
     * Get the value of sitDataCadastro
     */ 
    public function getCorDataCadastro()
    {
        return new DateTime($this->corDataCadastro);
    }

    /**
     * Set the value of sitDataCadastro
     *
     * @return  self
     */ 
    public function setCorDataCadastro($corDataCadastro)
    {
        $this->corDataCadastro = $corDataCadastro;

        return $this;
    }

    /**
     * Get the value of sitDataAlteracao
     */ 
    public function getCorDataAlteracao()
    {
        return new DateTime($this->corDataAlteracao);
    }

    /**
     * Set the value of sitDataAlteracao
     *
     * @return  self
     */ 
    public function setCorDataAlteracao($corDataAlteracao)
    {
        $this->corDataAlteracao = $corDataAlteracao;

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
     * Get the value of corCor
     */ 
    public function getCorCor()
    {
        return $this->corCor;
    }

    /**
     * Set the value of corCor
     *
     * @return  self
     */ 
    public function setCorCor($corCor)
    {
        $this->corCor = $corCor;

        return $this;
    }
}
