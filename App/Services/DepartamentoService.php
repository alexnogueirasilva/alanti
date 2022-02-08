<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\DepartamentoDAO;

use App\Models\Validacao\DepartamentoValidador;
use App\Models\Validacao\ResultadoValidacao;
use App\Models\Entidades\Departamento;


class DepartamentoService
{
    public function listar($idDepartamento = null)
    {
        $departamentoDAO = new DepartamentoDAO();
        return $departamentoDAO->listar($idDepartamento);
    }
    
    public function salvar(Departamento $departamento)
    {
        $transacao = new Transacao();
        $departamentoValidador = new DepartamentoValidador();
        $resultadoValidacao = $departamentoValidador->validar($departamento);

        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
                $transacao->beginTransaction();
                $departamentoDAO = new DepartamentoDAO();            
                $codDepartamento = $departamentoDAO->salvar($departamento);
                $transacao->commit(); 
                Sessao::gravaMensagem("Cadastro realizado com sucesso! <br> <br> Codigo: ".$codDepartamento);
                Sessao::limpaFormulario();
                return $codDepartamento;
            }catch(\Exception $e){
                Sessao::gravaMensagem("Erro ao tentar cadastrar.");
                $transacao->rollBack(); 
                return false;
            }
        }
    }
    

    public function atualizar(Departamento $departamento)
    {
        $transacao              = new Transacao();
        $departamentoValidador       = new DepartamentoValidador();
        $resultadoValidacao     = new ResultadoValidacao();
        $resultadoValidacao     = $departamentoValidador->validar($departamento);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
                $transacao->beginTransaction();
                $departamentoDAO = new DepartamentoDAO();            
                $departamentoDAO->atualizar($departamento);
                $transacao->commit(); 
                Sessao::gravaMensagem("cadastro alterado com sucesso! <br> <br>  Codigo ".$departamento->getId());
                Sessao::limpaFormulario();
                return true;
            }catch(\Exception $e){                
                $transacao->rollBack();            
                Sessao::gravaMensagem("Erro ao tentar alterar. ");
               return false;
            }
        }

    }

    public function excluir(Departamento $departamento)
    {
        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $departamentoDAO = new DepartamentoDAO();

            $departamentoDAO->excluir($departamento);
            $transacao->commit();            
            
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Cadastro Excluida com Sucesso!");
            return true;
        } catch (\Exception $e) {
            $transacao->rollBack();
            throw new \Exception(["Erro ao excluir Cadastro!"]);            
            return false;
        }
    }
}