<?php

namespace App\Models\Entidades;

 use DateTime;
 class Desenvolvimento
 {

    private $desId;
    private $desRequisito;
    private $desRegraNegocio;
    private $desGeral;
    private $desTeste;
    private $desCorrecao;
    private $desStatus;
    private $desAnexo;
    private $desDataAlteracao;
    private $desDataCadastro;
    private $desUsuario;
    private $desCodUsuario;
    private $desInstituicao;

   
    /**
     * Get /* des_id, des_requisito, des_regranegocio, des_geral, des_teste, des_datacadastro,
     */ 
    public function getDesId()
    {
        return $this->desId;
    }

    /**
     * Set /* des_id, des_requisito, des_regranegocio, des_geral, des_teste, des_datacadastro,
     *
     * @return  self
     */ 
    public function setDesId($desId)
    {
        $this->desId = $desId;

        return $this;
    }

    /**
     * Get the value of desRequisito
     */ 
    public function getDesRequisito()
    {
        return $this->desRequisito;
    }

    /**
     * Set the value of desRequisito
     *
     * @return  self
     */ 
    public function setDesRequisito($desRequisito)
    {
        $this->desRequisito = $desRequisito;

        return $this;
    }

    /**
     * Get the value of desRegraNegocio
     */ 
    public function getDesRegraNegocio()
    {
        return $this->desRegraNegocio;
    }

    /**
     * Set the value of desRegraNegocio
     *
     * @return  self
     */ 
    public function setDesRegraNegocio($desRegraNegocio)
    {
        $this->desRegraNegocio = $desRegraNegocio;

        return $this;
    }

    /**
     * Get the value of desGeral
     */ 
    public function getDesGeral()
    {
        return $this->desGeral;
    }

    /**
     * Set the value of desGeral
     *
     * @return  self
     */ 
    public function setDesGeral($desGeral)
    {
        $this->desGeral = $desGeral;

        return $this;
    }

    /**
     * Get the value of desTeste
     */ 
    public function getDesTeste()
    {
        return $this->desTeste;
    }

    /**
     * Set the value of desTeste
     *
     * @return  self
     */ 
    public function setDesTeste($desTeste)
    {
        $this->desTeste = $desTeste;

        return $this;
    }

    /**
     * Get the value of desStatus
     */ 
    public function getDesStatus()
    {
        return $this->desStatus;
    }

    /**
     * Set the value of desStatus
     *
     * @return  self
     */ 
    public function setDesStatus($desStatus)
    {
        $this->desStatus = $desStatus;

        return $this;
    }

    /**
     * Get the value of desAnexo
     */ 
    public function getDesAnexo()
    {
        return $this->desAnexo;
    }

    /**
     * Set the value of desAnexo
     *
     * @return  self
     */ 
    public function setDesAnexo($desAnexo)
    {
        $this->desAnexo = $desAnexo;

        return $this;
    }
     /**
     * Get the value of desDataAlteracao
     */ 
    public function getDesDataAlteracao()
    {
        return new DateTime($this->desDataAlteracao);
    }

    /**
     * Set the value of desDataAlteracao
     *
     * @return  self
     */ 
    public function setDesDataAlteracao($desDataAlteracao)
    {
        $this->desDataAlteracao = $desDataAlteracao;

        return $this;
    }

    /**
     * Get the value of desDataCadastro
     */ 
    public function getDesDataCadastro()
    {
        return new DateTime($this->desDataCadastro);
    }

    /**
     * Set the value of desDataCadastro
     *
     * @return  self
     */ 
    public function setDesDataCadastro($desDataCadastro)
    {
        $this->desDataCadastro = $desDataCadastro;

        return $this;
    }
    
    
    /**
     * Get the value of desUsuario
     */ 
    public function getDesUsuario()
    {
        return $this->desUsuario;
    }

    /**
     * Set the value of desUsuario
     *
     * @return  self
     */ 
    public function setDesUsuario(Usuario $desUsuario)
    {
        $this->desUsuario = $desUsuario;

        return $this;
    }

    /**
     * Get the value of desCodUsuario
     */ 
    public function getDesCodUsuario()
    {
        return $this->desCodUsuario;
    }

    /**
     * Set the value of desCodUsuario
     *
     * @return  self
     */ 
    public function setDesCodUsuario($desCodUsuario)
    {
        $this->desCodUsuario = $desCodUsuario;

        return $this;
    }

    /**
     * Get the value of desCorrecao
     */ 
    public function getDesCorrecao()
    {
        return $this->desCorrecao;
    }

    /**
     * Set the value of desCorrecao
     *
     * @return  self
     */ 
    public function setDesCorrecao($desCorrecao)
    {
        $this->desCorrecao = $desCorrecao;

        return $this;
    }
}