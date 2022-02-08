<?php 

namespace App\Models\Entidades;

use DateTime;


class Login 
{

    private $codUsuario;
    private $nomeLogin;
    private $emailLogin;
    private $apelidoLogin;
    private $passoword;
    private $nivel;
    private $info;
    private $dataCadastro;
    private $fk_instituicao;
    private $instituicao;
    private $usuStatus;
    

    /**
     * Get the value of codUsuario
     */ 
    public function getCodUsuario()
    {
        return $this->codUsuario;
    }

    /**
     * Set the value of codUsuario
     *
     * @return  self
     */ 
    public function setCodUsuario($codUsuario)
    {
        $this->codUsuario = $codUsuario;

        return $this;
    }

    /**
     * Get the value of fk_instituicao
     */ 
    public function getFk_Instituicao()
    {
        return $this->fk_instituicao;
    }
    /**
         * Set the value of Instituicao
         *
         * @return  self
         */ 
        public function getInstituicao() {
            return $this->instituicao;
        }
    
        public function setInstituicao(Instituicao $instituicao) {
            $this->instituicao = $instituicao;
        }
    /**
     * Set the value of fk_instituicao
     *
     * @return  self
     */ 
    public function setFk_Instituicao($fk_instituicao)
    {
        $this->fk_instituicao = $fk_instituicao;

        return $this;
    }

    /**
     * Get the value of nomeLogin
     */ 
    public function getNomeLogin()
    {
        return $this->nomeLogin;
    }

    /**
     * Set the value of nomeLogin
     *
     * @return  self
     */ 
    public function setNomeLogin($nomeLogin)
    {
        $this->nomeLogin = $nomeLogin;

        return $this;
    }

    /**
     * Get the value of dataCadastro
     */ 
    public function getDataCadastro()
    {
        return new DateTime($this->dataCadastro);
    }

    /**
     * Set the value of dataCadastro
     *
     * @return  self
     */ 
    public function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;

        return $this;
    }

    /**
     * Get the value of emailLogin
     */ 
    public function getEmailLogin()
    {
        return $this->emailLogin;
    }

    /**
     * Set the value of emailLogin
     *
     * @return  self
     */ 
    public function setEmailLogin($emailLogin)
    {
        $this->emailLogin = $emailLogin;

        return $this;
    }

    /**
     * Get the value of passoword
     */ 
    public function getPassoword()
    {
        return $this->passoword;
    }

    /**
     * Set the value of passoword
     *
     * @return  self
     */ 
    public function setPassoword($passoword)
    {
        $this->passoword = $passoword;

        return $this;
    }
    /**
     * Get the value of nivel
     */ 
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set the value of nivel
     *
     * @return  self
     */ 
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }
    /**
     * Get the value of info
     */ 
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set the value of info
     *
     * @return  self
     */ 
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }
    /**
     * Get the value of apelidoLogin
     */ 
    public function getApelidoLogin()
    {
        return $this->apelidoLogin;
    }

    /**
     * Set the value of apelidoLogin
     *
     * @return  self
     */ 
    public function setApelidoLogin($apelidoLogin)
    {
        $this->apelidoLogin = $apelidoLogin;

        return $this;
    }
     /**
     * Get the value of usuStatus
     */ 
    public function getUsuStatus()
    {
        return $this->usuStatus;
    }

    /**
     * Set the value of usuStatus
     *
     * @return  self
     */ 
    public function setUsuStatus($usuStatus)
    {
        $this->usuStatus = $usuStatus;

        return $this;
    }

}

?>