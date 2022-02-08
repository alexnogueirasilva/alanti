<?php
 namespace App\Models\Entidades;

 use DateTime;

 class Edital{
     
    private $edtId;
    private $edtNumero; 
    private $edtIdentificador; 
    private $edtPortal; 
    private $edtOperador; 
    private $edtDataAbertura;
    private $edtDataLimite;
    private $edtHora;
    private $edtHoraLimite;
    private $edtDataResultado;
    private $edtProposta;
    private $edtModalidade;
    private $edtTipo;
    private $edtGarantia;
    private $edtValor;
    private $edtSomar;
    private $edtStatus;
    private $edtAnalise;
    private $edtObservacao;
    private $edtAnexo;
    private $edtDataCadastro;
    private $edtDataAlteracao;
    private $usuario;
    private $instituicao;
    private $editalStatus;
    private $edtInstituicao;
    private $representante;
    private $clienteLicitacao;
    private $edtCliente;
    private $edtRepresentante;
    private $edtDataInicio;
    private $edtDataFinal;
    private $disputa;
    private $justificativa;

         /**
         * Set the value of edtCliente
         *
         * @return  self
         */ 
        public function getEdtCliente()
        {
                return $this->edtCliente;
        }

        public function setEdtCliente($edtCliente)        {
                $this->edtCliente = $edtCliente;
                return $this;
        }
         /**
         * Set the value of edtInstituicao
         *
         * @return  self
         */ 
        public function getEdtInstituicao()
        {
                return $this->edtInstituicao;
        }

        public function setEdtInstituicao($edtInstituicao)        {
                $this->edtInstituicao = $edtInstituicao;
                return $this;
        }
         /**
         * Set the value of edtValor
         *
         * @return  self
         */ 
        public function getEdtValor()
        {
                return $this->edtValor;
        }

        public function setEdtValor($edtValor)        {
                $this->edtValor = $edtValor;
                return $this;
        }
         /**
         * Set the value of edtAnalise
         *
         * @return  self
         */ 
        public function getEdtAnalise()
        {
                return $this->edtAnalise;
        }

        public function setEdtAnalise($edtAnalise)        {
                $this->edtAnalise = $edtAnalise;
                return $this;
        }
         /**
         * Set the value of edtObservacao
         *
         * @return  self
         */ 
        public function getEdtObservacao()
        {
                return $this->edtObservacao;
        }

        public function setEdtObservacao($edtObservacao)        {
                $this->edtObservacao = $edtObservacao;
                return $this;
        }
         /**
         * Set the value of edtAnexo
         *
         * @return  self
         */ 
        public function getEdtAnexo()
        {
                return $this->edtAnexo;
        }

        public function setEdtAnexo($edtAnexo)        {
                $this->edtAnexo = $edtAnexo;
                return $this;
        }
         /**
         * Set the value of edtModalidade
         *
         * @return  self
         */ 
        public function getEdtModalidade()
        {
                return $this->edtModalidade;
        }

        public function setEdtModalidade($edtModalidade)        {
                $this->edtModalidade = $edtModalidade;
                return $this;
        }
         /**
         * Set the value of edtTipo
         *
         * @return  self
         */ 
        public function getEdtTipo()
        {
                return $this->edtTipo;
        }

        public function setEdtTipo($edtTipo)        {
                $this->edtTipo = $edtTipo;
                return $this;
        }
         /**
         * Set the value of edtGarantia
         *
         * @return  self
         */ 
        public function getEdtGarantia()
        {
                return $this->edtGarantia;
        }

        public function setEdtGarantia($edtGarantia)        {
                $this->edtGarantia = $edtGarantia;
                return $this;
        }
         /**
         * Set the value of edtStatus
         *
         * @return  self
         */ 
        public function getEdtStatus()
        {
                return $this->edtStatus;
        }

        public function setEdtStatus($edtStatus)        {
                $this->edtStatus = $edtStatus;
                return $this;
        }
         /**
         * Set the value of edtProposta
         *
         * @return  self
         */ 
        public function getEdtProposta()
        {
                return $this->edtProposta;
        }

        public function setEdtProposta($edtProposta)        {
                $this->edtProposta = $edtProposta;
                return $this;
        }
         /**
         * Set the value of edtId
         *
         * @return  self
         */ 
        public function getEdtId()
        {
                return $this->edtId;
        }

        public function setEdtId($edtId)        {
                $this->edtId = $edtId;
                return $this;
        }
        
        /**
         * Set the value of edtNumero
         *
         * @return  self
         */ 
        public function setEdtNumero($edtNumero)        {
                $this->edtNumero = $edtNumero;
                return $this;
        }
        public function getEdtNumero()
        {
                return $this->edtNumero;
        }
        /**
         * Set the value of edtOperador
         *
         * @return  self
         */ 
        public function setEdtOperador($edtOperador)        {
                $this->edtOperador = $edtOperador;
                return $this;
        }
        public function getEdtOperador()
        {
                return $this->edtOperador;
        }
        /**
         * Set the value of edtIdentificador
         *
         * @return  self
         */ 
        public function setEdtIdentificador($edtIdentificador)        {
                $this->edtIdentificador = $edtIdentificador;
                return $this;
        }
        public function getEdtIdentificador()
        {
                return $this->edtIdentificador;
        }
        
        /**
         * Set the value of edtDataAlteracao
         *
         * @return  self
         */ 
       
        public function getEdtDataAlteracao()
        {
                return new DateTime($this->edtDataAlteracao);
        }
        public function setEdtDataAlteracao($edtDataAlteracao)
        {
                $this->edtDataAlteracao = $edtDataAlteracao;

                return $this;
        }
        /**
         * Set the value of edtDataCadastro
         *
         * @return  self
         */ 
        public function getEdtDataCadastro()
        {
                return new DateTime($this->edtDataCadastro);
        }

        public function setEdtDataCadastro($edtDataCadastro)
        {
                $this->edtDataCadastro = $edtDataCadastro;

                return $this;
        }
        /**
         * Set the value of edtDataAbertura
         *
         * @return  self
         */ 
        public function getEdtDataAbertura()
        {
                return new DateTime($this->edtDataAbertura);
        }

        public function setEdtDataAbertura($edtDataAbertura)
        {
                $this->edtDataAbertura = $edtDataAbertura;

                return $this;
        }
        /**
         * Set the value of edtDataLimite
         *
         * @return  self
         */ 
        public function getEdtDataLimite()
        {
                return new DateTime($this->edtDataLimite);
        }

        public function setEdtDataLimite($edtDataLimite)
        {
                $this->edtDataLimite = $edtDataLimite;

                return $this;
        }
        /**
         * Set the value of edtDataResultado
         *
         * @return  self
         */ 
        public function getEdtDataResultado()
        {
                return new DateTime($this->edtDataResultado);
        }

        public function setEdtDataResultado($edtDataResultado)
        {
                $this->edtDataResultado = $edtDataResultado;

                return $this;
        }
        /**
         * Set the value of edtHora
         *
         * @return  self
         */ 
        public function getEdtHora()
        {
                return new DateTime($this->edtHora);
        }

        public function setEdtHora($edtHora)
        {
                $this->edtHora = $edtHora;

                return $this;
        }
        /**
         * Set the value of edtHoraLimite
         *
         * @return  self
         */ 
        public function getEdtHoraLimite()
        {
                return new DateTime($this->edtHoraLimite);
        }

        public function setEdtHoraLimite($edtHoraLimite)
        {
                $this->edtHoraLimite = $edtHoraLimite;

                return $this;
        }
        /**
         * Set the value of Representante
         *
         * @return  self
         */ 

        public function getRepresentante() {
            return $this->representante;
        }
    
        public function setRepresentante(Representante $representante) {
            $this->representante = $representante;
            return $this;
        }
        /**
         * Set the value of EditalStatus
         *
         * @return  self
         */ 
        public function getEditalStatus() {
            return $this->editalStatus;
        }
    
        public function setEditalStatus(EditalStatus $editalStatus) {
            $this->editalStatus = $editalStatus;
            return $this;
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
            return $this;
        }
        /**
         * Set the value of ClienteLicitacao
         *
         * @return  self
         */ 
        public function getClienteLicitacao() {
                return $this->clienteLicitacao;
        }
        
        public function setClienteLicitacao(ClienteLicitacao $clienteLicitacao) {
                $this->clienteLicitacao = $clienteLicitacao;
               
                return $this;
        }
        /**
         * Set the value of Usuario
         *
         * @return  self
         */ 

        public function getUsuario() {
                return $this->usuario;
        }
        
        public function setUsuario(Usuario $usuario) {
                $this->usuario = $usuario;
                return $this;
        }

    /**
     * Get the value of edtRepresentante
     */ 
    public function getEdtRepresentante()
    {
        return $this->edtRepresentante;
    }

    /**
     * Set the value of edtRepresentante
     *
     * @return  self
     */ 
    public function setEdtRepresentante($edtRepresentante)
    {
        $this->edtRepresentante = $edtRepresentante;

        return $this;
    }

    /**
     * Get the value of edtPortal
     */ 
    public function getEdtPortal()
    {
        return $this->edtPortal;
    }

    /**
     * Set the value of edtPortal
     *
     * @return  self
     */ 
    public function setEdtPortal($edtPortal)
    {
        $this->edtPortal = $edtPortal;

        return $this;
    }

    /**
     * Get the value of edtSomar
     */ 
    public function getEdtSomar()
    {
        return $this->edtSomar;
    }

    /**
     * Set the value of edtSomar
     *
     * @return  self
     */ 
    public function setEdtSomar($edtSomar)
    {
        $this->edtSomar = $edtSomar;

        return $this;
    }
    
    /**
     * Get the value of edtDataInicio
     */ 
    public function getEdtDataInicio()
    {
        return $this->edtDataInicio;
    }

    /**
     * Set the value of edtDataInicio
     *
     * @return  self
     */ 
    public function setEdtDataInicio($edtDataInicio)
    {
        $this->edtDataInicio = $edtDataInicio;

        return $this;
    }

    /**
     * Get the value of edtDataFinal
     */ 
    public function getEdtDataFinal()
    {
        return $this->edtDataFinal;
    }

    /**
     * Set the value of edtDataFinal
     *
     * @return  self
     */ 
    public function setEdtDataFinal($edtDataFinal)
    {
        $this->edtDataFinal = $edtDataFinal;

        return $this;
    }
    
     /**
         * Get the value of disputa
         */ 
        public function getDisputa()
        {
                return $this->disputa;
        }

        /**
         * Set the value of disputa
         *
         * @return  self
         */ 
        public function setDisputa($disputa)
        {
                $this->disputa = $disputa;

                return $this;
        }
     /**
         * Get the value of justificativa
         */ 
        public function getJustificativa()
        {
                return $this->justificativa;
        }

        /**
         * Set the value of justificativa
         *
         * @return  self
         */ 
        public function setJustificativa($justificativa)
        {
                $this->justificativa = $justificativa;

                return $this;
        }
 }

?>