<?php

namespace App\Models\Entidades;
use DateTime;
class Usuario
{
    private $id;
    private $nome;
    private $apelido;
    private $email;
    private $senha;
    private $nivel;
    private $nivel_id;
    private $id_dep;
    private $status;
    private $fk_instituicao;
    private $dataCadastro;
    private $dataAlteracao;
    private $valida;
    private $dica;
    private $info;
    private $departamento;
    private $codDepartamento;
    private $instituicao;
     private $situacoes;
    
    public function __construct()
    {
        $this->departamento = new Departamento();
    }
    /**
     * Set the value of desUsuario
     *
     * @return  self
     */ 
    public function setDepartamento(Departamento $departamento)
    {
        $this->departamento = $departamento;

        return $this;
    }
    /**
     * Get the value of departamento
     */ 
    public function getDepartamento()
    {
        return $this->departamento;
    }
    /**
     * Get the value of fk_instituicao
     */ 
    public function getFk_Instituicao()
    {
        return $this->fk_instituicao;
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
     * Get the value of instituicao
     */ 
    public function getInstituicao()
    {
        return $this->instituicao;
    }

    /**
     * Set the value of instituicao
     *
     * @return  self
     */ 
    public function setInstituicao(Instituicao $instituicao)
    {
        $this->instituicao = $instituicao;

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
     * Get the value of dataAlteracao
     */ 
    public function getDataAlteracao()
    {
        return new DateTime($this->dataAlteracao);
    }

    /**
     * Set the value of dataAlteracao
     *
     * @return  self
     */ 
    public function setDataAlteracao($dataAlteracao)
    {
        $this->dataAlteracao = $dataAlteracao;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }
    
    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
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
     * Get the value of id_dep
     */ 
    public function getId_dep()
    {
        return $this->id_dep;
    }

    /**
     * Set the value of id_dep
     *
     * @return  self
     */ 
    public function setId_dep($id_dep)
    {
        $this->id_dep = $id_dep;

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
     * Get the value of valida
     */ 
    public function getValida()
    {
        return $this->valida;
    }

    /**
     * Set the value of valida
     *
     * @return  self
     */ 
    public function setValida($valida)
    {
        $this->valida = $valida;

        return $this;
    }

    /**
     * Get the value of dica
     */ 
    public function getDica()
    {
        return $this->dica;
    }

    /**
     * Set the value of dica
     *
     * @return  self
     */ 
    public function setDica($dica)
    {
        $this->dica = $dica;

        return $this;
    }

    

    /**
     * Get the value of apelido
     */ 
    public function getApelido()
    {
        return $this->apelido;
    }

    /**
     * Set the value of apelido
     *
     * @return  self
     */ 
    public function setApelido($apelido)
    {
        $this->apelido = $apelido;

        return $this;
    }

    /**
     * Get the value of codDepartamento
     */ 
    public function getCodDepartamento()
    {
        return $this->codDepartamento;
    }

    /**
     * Set the value of codDepartamento
     *
     * @return  self
     */ 
    public function setCodDepartamento($codDepartamento)
    {
        $this->codDepartamento = $codDepartamento;

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
     * Get the value of nivel_id
     */ 
    public function getNivel_id()
    {
        return $this->nivel_id;
    }

    /**
     * Set the value of nivel_id
     *
     * @return  self
     */ 
    public function setNivel_id($nivel_id)
    {
        $this->nivel_id = $nivel_id;

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