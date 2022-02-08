<?php

namespace App\Models\Entidades;

use DateTime;

class LogisticaStatus
{

    private $sttId;
    private $sttNome;
    private $sttDataCadastro;
    private $sttDataAlteracao;
   
    /**
     * Get the value of sttId
     */ 
    public function getSttId()
    {
        return $this->sttId;
    }

    /**
     * Set the value of sttId
     *
     * @return  self
     */ 
    public function setSttId($sttId)
    {
        $this->sttId = $sttId;

        return $this;
    }

    /**
     * Get the value of sttNome
     */ 
    public function getSttNome()
    {
        return $this->sttNome;
    }

    /**
     * Set the value of sttNome
     *
     * @return  self
     */ 
    public function setSttNome($sttNome)
    {
        $this->sttNome = $sttNome;

        return $this;
    }

    /**
     * Get the value of sttDataCadastro
     */ 
    public function getSttDataCadastro()
    {
        return new DateTime($this->sttDataCadastro);
    }

    /**
     * Set the value of sttDataCadastro
     *
     * @return  self
     */ 
    public function setSttDataCadastro($sttDataCadastro)
    {
        $this->sttDataCadastro = $sttDataCadastro;

        return $this;
    }

    /**
     * Get the value of sttDataAlteracao
     */ 
    public function getSttDataAlteracao()
    {
        return new DateTime($this->sttDataAlteracao);
    }

    /**
     * Set the value of sttDataAlteracao
     *
     * @return  self
     */ 
    public function setSttDataAlteracao($sttDataAlteracao)
    {
        $this->sttDataAlteracao = $sttDataAlteracao;

        return $this;
    }

}