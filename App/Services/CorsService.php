<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\CorsDAO;

use App\Models\Entidades\Cors;
use App\Services\EmailService;


class CorsService
{
    public function listar(Cors $cors)
    {        
        $corsDAO = new CorsDAO();
        return $corsDAO->listar($cors);
    }

    public function salvar(Cors $cors)
    {
        $transacao = new Transacao();
            try{
                $transacao->beginTransaction();
                $corsDAO = new CorsDAO();            
                $codigo = $corsDAO->salvar($cors);
                $transacao->commit(); 
                Sessao::limpaFormulario();
                Sessao::limpaMensagem();
                Sessao::gravaMensagem("cadastro realizado com sucesso!. Codigo: " .$codigo);
                return $codigo;
            }catch(\Exception $e){
                $emailService = new EmailService();
            $tela = " Cadastro de Cores ";
            $emailService->emailSuporte($e, $tela);
                Sessao::gravaMensagem("Erro ao tentar cadastrar.");
                $transacao->rollBack(); 
                return false;
            }
    }

    public function Editar(Cors $cors)
    {        
        $transacao = new Transacao();
        try 
        {
            $transacao->beginTransaction();
            $corsDAO  = new CorsDAO();
           
            $corsDAO->atualizar($cors);            

            $transacao->commit();      
            
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Cadastro Alterado com Sucesso. <br><br> Cadastro Numero: ".$cors->getCorId());
            return true;
        } catch (\Exception $e) {
            $emailService = new EmailService();
            $tela = " Alteracao de Cores ";
            $emailService->emailSuporte($e, $tela);
            $transacao->rollBack();
            throw new \Exception("Erro ao alterar cadastro!");            
            return false;
        }
    }

    public function excluir(Cors $cors)
    {
        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $corsDAO = new CorsDAO();
           
            $corsDAO->excluir($cors);
            $transacao->commit();            
            
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Cadastro Excluida com Sucesso!");
            return true;
        } catch (\Exception $e) {
            $emailService = new EmailService();
            $tela = " Exclusao de Cores ";
            $emailService->emailSuporte($e, $tela);
            $transacao->rollBack();
            throw new \Exception(["Erro ao excluir a empresa"]);            
            return false;
        }
    }
}