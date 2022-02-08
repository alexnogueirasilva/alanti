<?php
    
    
    namespace App\Models\Entidades;
    
    use DateTime;
    
    class Estado
    {
        private $estId;
        private $estNome;        
        private $estUf;        
        private $estUsuario;        
        private $usuario;        
        private $dataCadastro;
        private $dataAlteracao;

        public function setUsuario(Usuario $usuario)
        {
            $this->usuario = $usuario;
        }
        public function getUsuario()
        {
            return $this->usuario;
        }
        /**
         * @return mixed
         */
        public function getEstId()
        {
            return $this->estId;
        }
    
        /**
         * @param mixed $estId
         */
        public function setEstId($estId)
        {
            $this->estId = $estId;
        }
        /**
         * @return mixed
         */
        public function getEstUsuario()
        {
            return $this->estUsuario;
        }
    
        /**
         * @param mixed $estUsuario
         */
        public function setEstUsuario($estUsuario)
        {
            $this->estUsuario = $estUsuario;
        }
    
        /**
         * @return mixed
         */
        public function getEstNome()
        {
            return $this->estNome;
        }
    
        /**
         * @param mixed $estNome
         */
        public function setEstNome($estNome)
        {
            $this->estNome = $estNome;
        }
        /**
         * @return mixed
         */
        public function getEstUf()
        {
            return $this->estUf;
        }
    
        /**
         * @param mixed $estUf
         */
        public function setEstUf($estUf)
        {
            $this->estUf = $estUf;
        }
    
        
        /**
         * @return mixed
         * @throws \Exception
         */
        public function getDataCadastro()
        {
            return new DateTime($this->dataCadastro);
        }
    
        /**
         * @param mixed $dataCadastro
         */
        public function setDataCadastro($dataCadastro)
        {
            $this->dataCadastro = $dataCadastro;
        }
        /**
         * @return mixed
         * @throws \Exception
         */
        public function getDataAlteracao()
        {
            return new DateTime($this->dataAlteracao);
        }
    
        /**
         * @param mixed $dataAlteracao
         */
        public function setDataAlteracao($dataAlteracao)
        {
            $this->dataAlteracao = $dataAlteracao;
        }
        
    }