<?php


namespace App\Models\Entidades;

use DateTime;

class ClienteLicitacao extends Endereco
{

    private $codCliente;
    private $razaoSocial;
    private $nomeFantasia;
    private $cnpj;
    private $tipoLicitacao;
    private $trocaMarca;
    private $cliDataCadastro;
    private $cliDataAlteracao;
    private $tipoCliente;
    private $idTipoCliente;
    private $tpcDescricao;
    private $tpcId;
    private $cliPessoa;
    private $usuario;
    private $contatos;
    private $status;
    private $cliObservacao;
    private $cliEmail;
    private $cliCargo;
    private $cliCelular;
    private $cliTelefone;
    private $cliContato;
    private $situacoes;
    
    /**
     * @return TipoCliente
     */

    public function getTipoCliente()   
    {
        return $this->tipoCliente;
    }
    
    /**
     * @return mixed
     */
    public function getCodCliente()
    {
        return $this->codCliente;
    }

    /**
     * @param mixed $codCliente
     */
    public function setCodCliente($codCliente)
    {
        $this->codCliente = $codCliente;
    }
    
    public function  getTipoCliente_cod()
    {
        return $this->TipoCliente_cod();
    }
    
    public function setTipoCliente_cod($TipoCliente_cod)
    {
        $this->$TipoCliente_cod = $TipoCliente_cod;
    }


    public function  getIdTipoCliente()
    {
        return $this->IdTipoCliente();
    }
    
    public function setIdTipoCliente($IdTipoCliente)
    {
        $this->$IdTipoCliente = $IdTipoCliente;
    }
    /**
     * @return tpcDescricao
     */

    public function getTpcDescricao()   {
        return $this->tpcDescricao;
    }
    
    /**
     * Set the value of tpcDescricao
     *
     * @return  self
     */ 
    public function setTpcDescricao($tpcDescricao)
    {
        $this->tpcDescricao = $tpcDescricao;

        return $this;
    }
    
    /**
     * @return tpcId
     */

    public function getTpcId()   {
        return $this->tpcId;
    }
    
    /**
     * Set the value of tpcId
     *
     * @return  self
     */ 
    public function setTpcId($tpcId)
    {
        $this->tpcId = $tpcId;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getTrocaMarca()
    {
        return $this->trocaMarca;
    }

    /**
     * @param mixed $trocaMarca
     */
    public function setTrocaMarca($trocaMarca)
    {
        $this->trocaMarca = $trocaMarca;
    }

    /**
     * @return mixed
     */
    public function getNomeFantasia()
    {
        return $this->nomeFantasia;
    }

    /**
     * @param mixed $nomeFantasia
     */
    public function setNomeFantasia($nomeFantasia)
    {
        $this->nomeFantasia = $nomeFantasia;
    }

    /**
     * @return mixed DateTime
     * @throws \Exception
     */
    public function getCliDataCadastro()
    {
        return new DateTime($this->cliDataCadastro);
    }

    /**
     * @param mixed $cliDataCadastro
     */
    public function setCliDataCadastro($cliDataCadastro)
    {
        $this->cliDataCadastro = $cliDataCadastro;
    }

    /**
     * @return mixed DateTime
     * @throws \Exception
     */
    public function getCliDataAlteracao()
    {
        return new DateTime($this->cliDataAlteracao);
    }

    /**
     * @param mixed $cliDataAlteracao
     */
    public function setCliDataAlteracao($cliDataAlteracao)
    {
        $this->cliDataAlteracao = $cliDataAlteracao;
    }
    
    /**
     * Get the value of razaoSocial
     */ 
    public function getRazaoSocial()
    {
        return $this->razaoSocial;
    }

    /**
     * Set the value of razaoSocial
     *
     * @return  self
     */ 
    public function setRazaoSocial($razaoSocial)
    {
        $this->razaoSocial = $razaoSocial;

        return $this;
    }

    /**
     * Get the value of cnpj
     */ 
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * Set the value of cnpj
     *
     * @return  self
     */ 
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    /**
     * Set the value of tipoCliente
     *
     * @return  self
     */ 
    public function setTipoCliente($tipoCliente)
    {
        $this->tipoCliente = $tipoCliente;

        return $this;
    }
    /**
     * Get the value of cliPessoa
     */ 
    public function getCliPessoa()
    {
        return $this->cliPessoa;
    }

    /**
     * Set the value of traPessoa
     *
     * @return  self
     */ 
    public function setCliPessoa($cliPessoa)
    {
        $this->cliPessoa = $cliPessoa;

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
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of cliObservacao
     */ 
    public function getCliObservacao()
    {
        return $this->cliObservacao;
    }

    /**
     * Set the value of cliObservacao
     *
     * @return  self
     */ 
    public function setCliObservacao($cliObservacao)
    {
        $this->cliObservacao = $cliObservacao;

        return $this;
    }


    /**
     * Get the value of cliCargo
     */ 
    public function getCliCargo()
    {
        return $this->cliCargo;
    }

    /**
     * Set the value of cliCargo
     *
     * @return  self
     */ 
    public function setCliCargo($cliCargo)
    {
        $this->cliCargo = $cliCargo;

        return $this;
    }

    /**
     * Get the value of cliCelular
     */ 
    public function getCliCelular()
    {
        return $this->cliCelular;
    }

    /**
     * Set the value of cliCelular
     *
     * @return  self
     */ 
    public function setCliCelular($cliCelular)
    {
        $this->cliCelular = $cliCelular;

        return $this;
    }

    /**
     * Get the value of cliTelefone
     */ 
    public function getCliTelefone()
    {
        return $this->cliTelefone;
    }

    /**
     * Set the value of cliTelefone
     *
     * @return  self
     */ 
    public function setCliTelefone($cliTelefone)
    {
        $this->cliTelefone = $cliTelefone;

        return $this;
    }

    /**
     * Get the value of cliContato
     */ 
    public function getCliContato()
    {
        return $this->cliContato;
    }

    /**
     * Set the value of cliContato
     *
     * @return  self
     */ 
    public function setCliContato($cliContato)
    {
        $this->cliContato = $cliContato;

        return $this;
    }

    /**
     * Get the value of cliEmail
     */ 
    public function getCliEmail()
    {
        return $this->cliEmail;
    }

    /**
     * Set the value of cliEmail
     *
     * @return  self
     */ 
    public function setCliEmail($cliEmail)
    {
        $this->cliEmail = $cliEmail;

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
}