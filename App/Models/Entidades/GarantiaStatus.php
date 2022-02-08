<?php

namespace App\Models\Entidades;

 use DateTime;
 class GarantiaStatus
 {
     
    private $stGarId;
    private $stGarNome;
    private $stGarDataAlteracao;
    private $stGarDataCadastro;
    private $stGarObservacao;
    private $stGarInstituicao;
    private $stGarUsuario;
    private $cors;

     /**
      * Get the value of stGarId
      * @param string $trim
      */
    public function getStGarId()
    {
        return $this->stGarId;
    }

    /**
     * Set the value of stGarId
     *
     * @return  self
     */ 
    public function setStGarId($stgar_id)
    {
        $this->stGarId = $stgar_id;

        return $this;
    }

    /**
     * Get the value of stGarNome
     */ 
    public function getStGarNome()
    {
        return $this->stGarNome;
    }

    /**
     * Set the value of stGarNome
     *
     * @return  self
     */ 
    public function setStGarNome($stGarNome)
    {
        $this->stGarNome = $stGarNome;

        return $this;
    }
    /**
     * Get the value of stGarObservacao
     */ 
    public function getStGarObservacao()
    {
        return $this->stGarObservacao;
    }

    /**
     * Set the value of stGarObservacao
     *
     * @return  self
     */ 
    public function setStGarObservacao($stGarObservacao)
    {
        $this->stGarObservacao = $stGarObservacao;

        return $this;
    }

    /**
     * Get the value of stGarDataAlteracao
     */ 
    public function getStGarDataAlteracao()
    {
        return new DateTime($this->stGarDataAlteracao);
    }

    /**
     * Set the value of stGarDataAlteracao
     *
     * @return  self
     */ 
    public function setStGarDataAlteracao($stGarDataAlteracao)
    {
        $this->stGarDataAlteracao = $stGarDataAlteracao;

        return $this;
    }

    /**
     * Get the value of stGarDataCadastro
     */ 
    public function getStGarDataCadastro()
    {
        return new DateTime($this->stGarDataCadastro);
    }

    /**
     * Set the value of stGarDataCadastro
     *
     * @return  self
     */ 
    public function setStGarDataCadastro($stGarDataCadastro)
    {
        $this->stGarDataCadastro = $stGarDataCadastro;

        return $this;
    }
    
    /**
     * Get the value of stGarInstituicao
     */ 
    public function getStGarInstituicao()
    {
        return $this->stGarInstituicao;
    }

    /**
     * Set the value of stGarInstituicao
     *
     * @return  self
     */ 
    public function setStGarInstituicao(Instituicao $stGarInstituicao)
    {
        $this->stGarInstituicao = $stGarInstituicao;

        return $this;
    }

    /**
     * Get the value of stGarUsuario
     */ 
    public function getStGarUsuario()
    {
        return $this->stGarUsuario;
    }

    /**
     * Set the value of stGarUsuario
     *
     * @return  self
     */ 
    public function setStGarUsuario(Usuario $stGarUsuario)
    {
        $this->stGarUsuario = $stGarUsuario;

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