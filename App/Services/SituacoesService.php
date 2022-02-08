<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\SituacoesDAO;

use App\Models\Entidades\Situacoes;
use App\Services\EmailService;


class SituacoesService
{
    public function listar(Situacoes $situacoes)
    {        
        $situacoesDAO = new SituacoesDAO();
        return $situacoesDAO->listar($situacoes);
    }
       public function salvar(Situacoes $situacoes)
    {
        $transacao = new Transacao();
       
            try{
                $transacao->beginTransaction();
                $situacoesDAO = new SituacoesDAO();            
                $codigo = $situacoesDAO->salvar($situacoes);
                $transacao->commit(); 
                Sessao::gravaMensagem("cadastro realizado com sucesso!.  <br><br> Cadastro Numero: ".$codigo);
                Sessao::limpaFormulario();
                return $codigo;
            }catch(\Exception $e){
                $emailService = new EmailService();
                $tela = " Cadastro de Situacoes ";
                $emailService->emailSuporte($e, $tela);
                Sessao::gravaMensagem("Erro ao tentar cadastrar.");
                $transacao->rollBack(); 
                return false;
            }        
    }

    public function Editar(Situacoes $situacoes)
    {        
        
        $transacao = new Transacao();
        try 
        {
            $transacao->beginTransaction();
            $situacoesDAO = new SituacoesDAO();
           
            $situacoesDAO->atualizar($situacoes);            

            $transacao->commit();      
            
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Cadastro Alterado com Sucesso. <br><br> Cadastro Numero: ".$situacoes->getSitId());
            return true;
        } catch (\Exception $e) {
            $emailService = new EmailService();
            $tela = " Alteracao de Situacoes ";
            $emailService->emailSuporte($e, $tela);
            $transacao->rollBack();
            throw new \Exception("Erro ao alterar cadastro!");            
            return false;
        }
    }

    public function excluir(Situacoes $situacoes)
    {
        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $situacoesDAO = new SituacoesDAO();
            $situacoesDAO->excluir($situacoes);
            $transacao->commit();            
            
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Situacoes Excluida com Sucesso!");
            return true;
        } catch (\Exception $e) {
            $emailService = new EmailService();
            $tela = " Exclusao de Situacoes ";
            $emailService->emailSuporte($e, $tela);
            $transacao->rollBack();
            throw new \Exception(["Erro ao excluir a empresa"]);            
            return false;
        }
    }
}