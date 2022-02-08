<?php
    
    
    namespace App\Models\Entidades;
    
    use DateTime;
    
    class Pessoa
    {
        private $pesId;
        private $pesTipo;
        private $pesDataAlteracao;
        private $pesDataCadastro;
        private $usuario;
       
        
        /**
         * @return mixed
         */
        public function getPesId()
        {
            return $this->pesId;
        }
    
        /**
         * @param mixed $pesId
         */
        public function setPesId($pesId)
        {
            $this->pesId = $pesId;
        }
    
        /**
         * @return mixed
         */
        public function getPesTipo()
        {
            return $this->pesTipo;
        }
    
        /**
         * @param mixed $pesTipo
         */
        public function setPesTipo($pesTipo)
        {
            $this->pesTipo = $pesTipo;
        }

          /**
     * Get the value of PesDataCadastro
     */ 
    public function getPesDataCadastro()
    {
        return new DateTime($this->pesDataCadastro);
    }
   
    /**
     * Set the value of PesDataCadastro
     *
     * @return  self
     */ 
    public function setPesDataCadastro($pesDataCadastro)
    {
        $this->pesDataCadastro = $pesDataCadastro;

        return $this;
    }

    /**
     * Get the value of PesDataAlteracao
     */ 
    public function getPesDataAlteracao()
    {
        return new DateTime($this->pesDataAlteracao);
    }

    /**
     * Set the value of PesDataAlteracao
     *
     * @return  self
     */ 
    public function setPesDataAlteracao($pesDataAlteracao)
    {
        $this->pesDataAlteracao = $pesDataAlteracao;

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