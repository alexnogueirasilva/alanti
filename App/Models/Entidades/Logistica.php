<?php

namespace App\Models\Entidades;

use DateTime;

class Logistica
{

    private $lgtId;
    private $lgtNfe;
    private $lgtValorCorrigido;
    private $lgtValorFrete;
    private $lgtRota;
    private $lgtInfoExcluir;
    private $lgtInfoValorCorrigido;
    private $lgtDataCadastro;
    private $lgtDataAlteracao;
    private $fk_erp;
    private $fk_transportadora;
    private $fk_statuslogistica;
    private $lgtAnexo;
    private $fk_operador;
    private $clinetelicitacao;


    private $codStatus;
    private $codRepresentante;
    private $codCliente;
    private $codTransportadora;
    
    public function __construct()
    {
        $this->clinetelicitacao = new ClienteLicitacao();
    }

    public function getClienteLicitacaoId()
    {
        return $this->clinetelicitacao_id;
    }

    public function setClienteLicitacaoId($clientelicitacao_id)
    {
        $this->clinetelicitacao = $clientelicitacao_id;
    }

    public function getClienteLicitacao()
    {
        return $this->clinetelicitacao;
    }

    private $fk_pedido;

    /**
     * Get the value of lgtId
     */
    public function getLgtId()
    {
        return $this->lgtId;
    }

    /**
     * Set the value of lgtId
     *
     * @return  self
     */ 
    public function setLgtId($lgtId)
    {
        $this->lgtId = $lgtId;

        return $this;
    }

    /**
     * Get the value of fk_erp
     */ 
    public function getFk_Erp()
    {
        return $this->fk_erp;
    }

    /**
     * Set the value of fk_erp
     *
     * @return  self
     */ 
    public function setFk_Erp(PedidoErp $fk_erp)
    {
        $this->fk_erp = $fk_erp;

        return $this;
    }

    /**
     * Get the value of lgtNfe
     */ 
    public function getLgtNfe()
    {
        return $this->lgtNfe;
    }

    /**
     * Set the value of lgtNfe
     *
     * @return  self
     */ 
    public function setLgtNfe($lgtNfe)
    {
        $this->lgtNfe = $lgtNfe;

        return $this;
    }

    /**
     * Get the value of fk_transportadora
     */ 
    public function getFk_Transportadora()
    {
        return $this->fk_transportadora;
    }

    /**
     * Set the value of fk_transportadora
     *
     * @return  self
     */ 
    public function setFk_Transportadora(Transportadora $fk_transportadora)
    {
        $this->fk_transportadora = $fk_transportadora;

        return $this;
    }

    /**
     * Get the value of fk_statuslogistica
     */ 
    public function getFk_StatusLogistica()
    {
        return $this->fk_statuslogistica;
    }

    /**
     * Set the value of fk_statuslogistica
     *
     * @return  self
     */ 
    public function setFk_StatusLogistica($fk_statuslogistica)
    {
        $this->fk_statuslogistica = $fk_statuslogistica;

        return $this;
    }

    /**
     * Get the value of lgtRota
     */ 
    public function getLgtRota()
    {
        return $this->lgtRota;
    }

    /**
     * Set the value of lgtRota
     *
     * @return  self
     */ 
    public function setLgtRota($lgtRota)
    {
        $this->lgtRota = $lgtRota;

        return $this;
    }

    /**
     * Get the value of lgtInfoExcluir
     */ 
    public function getLgtInfoExcluir()
    {
        return $this->lgtInfoExcluir;
    }

    /**
     * Set the value of lgtInfoExcluir
     *
     * @return  self
     */ 
    public function setLgtInfoExcluir($lgtInfoExcluir)
    {
        $this->lgtInfoExcluir = $lgtInfoExcluir;

        return $this;
    }

    /**
     * Get the value of lgtInfoValorCorrigido
     */ 
    public function getLgtInfoValorCorrigido()
    {
        return $this->lgtInfoValorCorrigido;
    }

    /**
     * Set the value of lgtInfoValorCorrigido
     *
     * @return  self
     */ 
    public function setLgtInfoValorCorrigido($lgtInfoValorCorrigido)
    {
        $this->lgtInfoValorCorrigido = $lgtInfoValorCorrigido;

        return $this;
    }


    /**
     * Get the value of lgtValorCorrigido
     */ 
    public function getLgtValorCorrigido()
    {
        return $this->lgtValorCorrigido;
    }

    /**
     * Set the value of lgtValorCorrigido
     *
     * @return  self
     */ 
    public function setLgtValorCorrigido($lgtValorCorrigido)
    {
        $this->lgtValorCorrigido = $lgtValorCorrigido;

        return $this;
    }

 /**
     * Get the value of lgtValorFrete
     */ 
    public function getLgtValorFrete()
    {
        return $this->lgtValorFrete;
    }

    /**
     * Set the value of lgtValorFrete
     *
     * @return  self
     */ 
    public function setLgtValorFrete($lgtValorFrete)
    {
        $this->lgtValorFrete = $lgtValorFrete;

        return $this;
    }
    /**
     * Get the value of lgtAnexo
     */ 
    public function getLgtAnexo()
    {
        return $this->lgtAnexo;
    }

    /**
     * Set the value of lgtAnexo
     *
     * @return  self
     */ 
    public function setLgtAnexo($lgtAnexo)
    {
        $this->lgtAnexo = $lgtAnexo;

        return $this;
    }

    /**
     * Get the value of lgtDataCadastro
     */ 
    public function getLgtDataCadastro()
    {
        return new DateTime($this->lgtDataCadastro);
    }

    /**
     * Set the value of lgtDataCadastro
     *
     * @return  self
     */ 
    public function setLgtDataCadastro($lgtDataCadastro)
    {
        $this->lgtDataCadastro = $lgtDataCadastro;

        return $this;
    }


    /**
     * Set the value of lgtDataAlteracao
     *
     * @return  self
     */
    public function setLgtDataAlteracao($lgtDataAlteracao)
    {
        $this->lgtDataAlteracao = $lgtDataAlteracao;

        return $this;
    }

    /**
     * Get the value of lgtdataAlteracao
     */ 
    public function getLgtDataAlteracao()
    {
        return new DateTime($this->lgtDataAlteracao);
    }
    
    /**
     * Get the value of fk_cliente
     */ 
    public function getFk_Cliente()
    {
        return $this->fk_cliente;
    }

    /**
     * Set the value of fk_cliente
     *
     * @return  self
     */ 
    public function setFk_Cliente(ClienteLicitacao $fk_cliente)
    {
        $this->fk_cliente = $fk_cliente;

        return $this;
    }

    /**
     * Get the value of fk_operador
     */ 
    public function getFk_Operador()
    {
        return $this->fk_operador;
    }

    /**
     * Set the value of fk_operador
     *
     * @return  self
     */ 
    public function setFk_Operador(Usuario $fk_operador)
    {
        $this->fk_operador = $fk_operador;

        return $this;
    }

    /**
     * Get the value of fk_representante
     */ 
    public function getFk_representante()
    {
        return $this->fk_representante;
    }

    /**
     * Set the value of fk_representante
     *
     * @return  self
     */ 
    public function setFk_representante(Representante $fk_representante)
    {
        $this->fk_representante = $fk_representante;

        return $this;
    }

    /**
     * Get the value of fk_pedido
     */ 
    public function getFk_Pedido()
    {
        return $this->fk_pedido;
    }

    /**
     * Set the value of fk_pedido
     *
     * @return  self
     */ 
    public function setFk_Pedido(Pedido $fk_pedido)
    {
        $this->fk_pedido = $fk_pedido;

        return $this;
    }

    /**
     * Get the value of codStatus
     */ 
    public function getCodStatus()
    {
        return $this->codStatus;
    }

    /**
     * Set the value of codStatus
     *
     * @return  self
     */ 
    public function setCodStatus($codStatus)
    {
        $this->codStatus = $codStatus;

        return $this;
    }

    /**
     * Get the value of codRepresentante
     */ 
    public function getCodRepresentante()
    {
        return $this->codRepresentante;
    }

    /**
     * Set the value of codRepresentante
     *
     * @return  self
     */ 
    public function setCodRepresentante($codRepresentante)
    {
        $this->codRepresentante = $codRepresentante;

        return $this;
    }

    /**
     * Get the value of codCliente
     */ 
    public function getCodCliente()
    {
        return $this->codCliente;
    }

    /**
     * Set the value of codCliente
     *
     * @return  self
     */ 
    public function setCodCliente($codCliente)
    {
        $this->codCliente = $codCliente;

        return $this;
    }

    /**
     * Get the value of codTransportadora
     */ 
    public function getCodTransportadora()
    {
        return $this->codTransportadora;
    }

    /**
     * Set the value of codTransportadora
     *
     * @return  self
     */ 
    public function setCodTransportadora($codTransportadora)
    {
        $this->codTransportadora = $codTransportadora;

        return $this;
    }
}