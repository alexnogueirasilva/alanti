<?php 

namespace App\Models\Entidades;

use DateTime;

abstract class PedidoErp
{

    protected $perpId;
    protected $perpNumero;
    protected $perpStatus;
    protected $perpValor;
    protected $perpDataCadastro;
    protected $perpDataAlteracao;
    protected $perpCodControle;
    protected $perpUsuario;

    /**
     * Get the value of perpId
     */ 
    public function getPerpId()
    {
        return $this->perpId;
    }

    /**
     * Set the value of perpId
     *
     * @return  self
     */ 
    public function setPerpId($perpId)
    {
        $this->perpId = $perpId;

        return $this;
    }

    /**
     * Get the value of perpNumero
     */ 
    public function getPerpNumero()
    {
        return $this->perpNumero;
    }

    /**
     * Set the value of perpNumero
     *
     * @return  self
     */ 
    public function setPerpNumero($perpNumero)
    {
        $this->perpNumero = $perpNumero;

        return $this;
    }

    /**
     * Set the value of perpCodControle
     *
     * @return  self
     */ 
    public function setPerpCodControle($perpCodControle)
    {
        $this->perpCodControle = $perpCodControle;
        return $this;
    }

    /**
     * Get the value of perpCodControle
     */ 
               
    public function getPerpCodControle()
    {
      return  $this->perpCodControle;
        
    }

    /**
     * Get the value of perpDataCadastro
     */ 
    public function getPerpDataCadastro()
    {
        return new DateTime($this->perpDataCadastro);
    }

    /**
     * Set the value of perpDataCadastro
     *
     * @return  self
     */ 
    public function setPerpDataCadastro($perpDataCadastro)
    {
        $this->endDataCadastro = $perpDataCadastro;

        return $this;
    }

    /**
     * Get the value of perpDataAlteracao
     */ 
    public function getPerpDataAlteracao()
    {
        return new DateTime($this->perpDataAlteracao);
    }

    /**
     * Set the value of perpDataAlteracao
     *
     * @return  self
     */ 
    public function setPerpDataAlteracao($perpDataAlteracao)
    {
        $this->perpDataAlteracao = $perpDataAlteracao;

        return $this;
    }

    /**
     * Get the value of perpValor
     */ 
    public function getPerpValor()
    {
        return $this->perpValor;
    }

    /**
     * Set the value of perpValor
     *
     * @return  self
     */ 
    public function setPerpValor($perpValor)
    {
        $this->perpValor = $perpValor;

        return $this;
    }

    /**
     * Get the value of perpUsuario
     */ 
    public function getPerpUsuario()
    {
        return $this->perpUsuario;
    }

    /**
     * Set the value of perpUsuario
     *
     * @return  self
     */ 
    public function setPerpUsuario($perpUsuario)
    {
        $this->perpUsuario = $perpUsuario;

        return $this;
    }

    /**
     * Get the value of perpStatus
     */ 
    public function getPerpStatus()
    {
        return $this->perpStatus;
    }

    /**
     * Set the value of perpStatus
     *
     * @return  self
     */ 
    public function setPerpStatus($perpStatus)
    {
        $this->perpStatus = $perpStatus;

        return $this;
    }
}



?>