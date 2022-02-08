<?php


namespace App\Models\Entidades;


use DateTime;

class Garantia
{
    private $ctrId;
    private $grtFornecedor;
    private $grtAnexo;
    private $grtResultado;
    private $grtDataSolicitacao;
    private $grtDataRecebido;
    private $grtDataResultado;
    private $grtDataCadastro;
    private $grtDataAlteracao;
    private $grtPkIdStatus;
    private $grtPkIdEdital;
    private $grtObservacao;
     
    /**
     * @return mixed
     */
    public function getGrtPkIdEdital(): Edital
    {
        return $this->grtPkIdEdital;
    }

    /**
     * @param mixed $grtPkIdEdital
     */
    public function setGrtPkIdEdital($grtPkIdEdital)
    {
        $this->grtPkIdEdital = $grtPkIdEdital;
    }

    /**
     * @return mixed
     */
    public function getCtrId()
    {
        return $this->ctrId;
    }

    /**
     * @param mixed $ctrId
     */
    public function setCtrId($ctrId)
    {
        $this->ctrId = $ctrId;
    }

    /**
     * @return mixed
     */
    public function getGrtFornecedor(): Fornecedor
    {
        return $this->grtFornecedor;
    }

    /**
     * @param mixed $grtFornecedor
     */
    public function setGrtFornecedor($grtFornecedor)
    {
        $this->grtFornecedor = $grtFornecedor;
    }

    /**
     * @return mixed
     */
    public function getGrtAnexo()
    {
        return $this->grtAnexo;
    }

    /**
     * @param mixed $grtAnexo
     */
    public function setGrtAnexo($grtAnexo)
    {
        $this->grtAnexo = $grtAnexo;
    }

    /**
     * @return mixed
     */
    public function getGrtResultado()
    {
        return $this->grtResultado;
    }

    /**
     * @param mixed $grtResultado
     */
    public function setGrtResultado($grtResultado)
    {
        $this->grtResultado = $grtResultado;
    }

    /**
     * @return mixed
     */
    public function getGrtDataSolicitacao()
    {
        return new DateTime($this->grtDataSolicitacao);
    }

    /**
     * @param mixed $grtDataSolicitacao
     */
    public function setGrtDataSolicitacao($grtDataSolicitacao)
    {
        $this->grtDataSolicitacao = $grtDataSolicitacao;
    }
     /**
     * Get the value of grtDataRecebido
     */ 
    public function getGrtDataRecebido()
    {
        return new DateTime($this->grtDataRecebido);
    }

    /**
     * Set the value of grtDataRecebido
     *
     * @return  self
     */ 
    public function setGrtDataRecebido($grtDataRecebido)
    {
        $this->grtDataRecebido = $grtDataRecebido;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getGrtDataResultado()
    {
        return new DateTime($this->grtDataResultado);
    }

    /**
     * @param mixed $grtDataResultado
     */
    public function setGrtDataResultado($grtDataResultado)
    {
        $this->grtDataResultado = $grtDataResultado;
    }
    
    /**
     * Get the value of grtDataCadastro
     */ 
    public function getGrtDataCadastro()
    {
        return new DateTime($this->grtDataCadastro);
    }

    /**
     * Set the value of grtDataCadastro
     *
     * @return  self
     */ 
    public function setGrtDataCadastro($grtDataCadastro)
    {
        $this->grtDataCadastro = $grtDataCadastro;

        return $this;
    }

    /**
     * Get the value of grtDataAlteracao
     */ 
    public function getGrtDataAlteracao()
    {
        return new DateTime($this->grtDataAlteracao);
    }

    /**
     * Set the value of grtDataAlteracao
     *
     * @return  self
     */ 
    public function setGrtDataAlteracao($grtDataAlteracao)
    {
        $this->grtDataAlteracao = $grtDataAlteracao;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getGrtPkIdStatus():GarantiaStatus
    {
        return $this->grtPkIdStatus;

    }

    /**
     * @param mixed $grtPkIdStatus
     */
    public function setGrtPkIdStatus($grtPkIdStatus)
    {
        $this->grtPkIdStatus = $grtPkIdStatus;
    }


    /**
     * Get the value of grtObservacao
     */ 
    public function getGrtObservacao()
    {
        return $this->grtObservacao;
    }

    /**
     * Set the value of grtObservacao
     *
     * @return  self
     */ 
    public function setGrtObservacao($grtObservacao)
    {
        $this->grtObservacao = $grtObservacao;

        return $this;
    }    




}