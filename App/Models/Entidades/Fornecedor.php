<?php
    
    
    namespace App\Models\Entidades;
    
    use DateTime;
    
    class Fornecedor extends Endereco
    {
        private $fornecedor_cod;
        private $forRazaoSocial;
        private $forNomeFantasia;
        private $forCnpj;
        private $forIE;
        private $forTipo;
        private $forObservacao;
        private $forStatus;
        private $forDataCadastro;
        private $forDataAlteracao;
        private $forEmail;
        private $forContato;
        private $forCargo;
        private $forCelular;
        private $forTelefone;
        private $forPessoa;
        private $forUsuario;
        private $usuario;
        private $contatos;
        private $situacoes;
        
        /**
         * @return mixed
         */
        public function getFornecedor_Cod()
        {
            return $this->fornecedor_cod;
        }
    
        /**
         * @param mixed $fornecedor_cod
         */
        public function setFornecedor_Cod($fornecedor_cod)
        {
            $this->fornecedor_cod = $fornecedor_cod;
        }
    
        /**
         * @return mixed
         */
        public function getForRazaoSocial()
        {
            return $this->forRazaoSocial;
        }
    
        /**
         * @param mixed $forRazaoSocial
         */
        public function setForRazaoSocial($forRazaoSocial)
        {
            $this->forRazaoSocial = $forRazaoSocial;
        }
    
        /**
         * @return mixed
         */
        public function getForNomeFantasia()
        {
            return $this->forNomeFantasia;
        }
    
        /**
         * @param mixed $forNomeFantasia
         */
        public function setForNomeFantasia($forNomeFantasia)
        {
            $this->forNomeFantasia = $forNomeFantasia;
        }
    
        /**
         * @return mixed
         */
        public function getForCnpj()
        {
            return $this->forCnpj;
        }
    
        /**
         * @param mixed $forCnpj
         */
        public function setForCnpj($forCnpj)
        {
            $this->forCnpj = $forCnpj;
        }
    
        /**
         * @return mixed
         * @throws \Exception
         */
        public function getForDataCadastro()
        {
            return new DateTime($this->forDataCadastro);
        }
    
        /**
         * @param mixed $forDataCadastro
         */
        public function setForDataCadastro($forDataCadastro)
        {
            $this->forDataCadastro = $forDataCadastro;
        }
        /**
         * @return mixed
         * @throws \Exception
         */
        public function getForDataAlteracao()
        {
            return new DateTime($this->forDataAlteracao);
        }
    
        /**
         * @param mixed $forDataAlteracao
         */
        public function setForDataAlteracao($forDataAlteracao)
        {
            $this->forDataAlteracao = $forDataAlteracao;
        }
        /**
         * @return mixed
         */
        public function getForPessoa()
        {
            return $this->forPessoa;
        }
    
        /**
         * @param mixed $forPessoa
         */
        public function setForPessoa($forPessoa)
        {
            $this->forPessoa = $forPessoa;
        }
        /**
         * @return mixed
         */
        public function getForTipo()
        {
            return $this->forTipo;
        }
    
        /**
         * @param mixed $forTipo
         */
        public function setForTipo($forTipo)
        {
            $this->forTipo = $forTipo;
        }
        /**
         * @return mixed
         */
        public function getForObservacao()
        {
            return $this->forObservacao;
        }
    
        /**
         * @param mixed $forObservacao
         */
        public function setForObservacao($forObservacao)
        {
            $this->forObservacao = $forObservacao;
        }
        /**
         * @return mixed
         */
        public function getForStatus()
        {
            return $this->forStatus;
        }
    
        /**
         * @param mixed $forStatus
         */
        public function setForStatus($forStatus)
        {
            $this->forStatus = $forStatus;
        }
        /**
     * Get the value of contatos
     */ 
    public function getContatos()
    {
        return $this->contatos;
    }

    /**
     * Set the value of contatos
     *
     * @return  self
     */ 
    public function setContatos(Contato $contatos)
    {
        $this->contatos = $contatos;

        return $this;
    }

        /**
         * Get the value of forUsuario
         */ 
        public function getForUsuario()
        {
                return $this->forUsuario;
        }

        /**
         * Set the value of forUsuario
         *
         * @return  self
         */ 
        public function setForUsuario($forUsuario)
        {
                $this->forUsuario = $forUsuario;

                return $this;
        }
        /**
     * Get the value of Usuario
     */ 
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of Usuario
     *
     * @return  self
     */ 
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

        /**
         * Get the value of forEmail
         */ 
        public function getForEmail()
        {
                return $this->forEmail;
        }

        /**
         * Set the value of forEmail
         *
         * @return  self
         */ 
        public function setForEmail($forEmail)
        {
                $this->forEmail = $forEmail;

                return $this;
        }

        /**
         * Get the value of forCargo
         */ 
        public function getForCargo()
        {
                return $this->forCargo;
        }

        /**
         * Set the value of forCargo
         *
         * @return  self
         */ 
        public function setForCargo($forCargo)
        {
                $this->forCargo = $forCargo;

                return $this;
        }

        /**
         * Get the value of forCelular
         */ 
        public function getForCelular()
        {
                return $this->forCelular;
        }

        /**
         * Set the value of forCelular
         *
         * @return  self
         */ 
        public function setForCelular($forCelular)
        {
                $this->forCelular = $forCelular;

                return $this;
        }

        /**
         * Get the value of forTelefone
         */ 
        public function getForTelefone()
        {
                return $this->forTelefone;
        }

        /**
         * Set the value of forTelefone
         *
         * @return  self
         */ 
        public function setForTelefone($forTelefone)
        {
                $this->forTelefone = $forTelefone;

                return $this;
        }

        /**
         * Get the value of forContato
         */ 
        public function getForContato()
        {
                return $this->forContato;
        }

        /**
         * Set the value of forContato
         *
         * @return  self
         */ 
        public function setForContato($forContato)
        {
                $this->forContato = $forContato;

                return $this;
        }
        /**
         * Get the value of situacoes
         */ 
        public function getSituacoes()
        {
            return $this->situacoes;
        }

        /**
         * Set the value of situacoes
         *
         * @return  self
         */ 
        public function setSituacoes(Situacoes $situacoes)
        {
            $this->situacoes = $situacoes;

            return $this;
        }

        /**
         * Get the value of forIE
         */ 
        public function getForIE()
        {
                return $this->forIE;
        }

        /**
         * Set the value of forIE
         *
         * @return  self
         */ 
        public function setForIE($forIE)
        {
                $this->forIE = $forIE;

                return $this;
        }
    }