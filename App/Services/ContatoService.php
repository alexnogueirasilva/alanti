<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;


use App\Models\DAO\ContatoDAO;
use App\Models\Entidades\Contato;
use App\Services\EmailService;


class ContatoService
{
    /*public function listar(Contato $contato)
    {
       $contatoDAO = new ContatoDAO();
       return $contatoDAO->listar($contato);
    }
    public function listarAtendidos(Contato $contato)
    {
       $contatoDAO = new ContatoDAO();
       return$contatoDAO->listarAtendidos($contato);
    }
    public function listarStatusPedidoErp()
    {
       $contatoDAO = new ContatoDAO();
       return$contatoDAO->listarStatusPedidoErp();
    }*/
    public function buscarContatos(Contato $contato)
    {        
       $contatoDAO = new ContatoDAO();
       return $contatoDAO->listar($contato);      
    }
    
    public function salvar(Contato $contato)
    {        
        $transacao = new Transacao();                   
            try{
                $transacao->beginTransaction();
                $contatoDAO = new ContatoDAO();            
                $codigo = $contatoDAO->salvar($contato);
                $transacao->commit(); 
              
                Sessao::limpaFormulario();
                return $codigo;
            }catch(\Exception $e){
                $emailService = new EmailService();
                $tela = "Cadastro contatos - Codigo ".$codigo;
                $emailService->emailSuporte($e, $tela);              
                $transacao->rollBack(); 
                Sessao::gravaMensagem(" Erro ao tentar cadastrar. ");
               return false;
            }
       
    }

    public function editar(Contato $contato)
    {   
        $transacao = new Transacao();        
            try{
               $transacao->beginTransaction();
               $contatoDAO = new ContatoDAO();            
                
                $contatoDAO->alterar($contato);
                $transacao->commit();                 
                Sessao::limpaFormulario();
                return true;
            }catch(\Exception $e){
                $emailService = new EmailService();
                $tela = "Alteracao Contato - Codigo ".$contato->getCntId();
                $emailService->emailSuporte($e, $tela);
                $transacao->rollBack(); 
                Sessao::gravaMensagem("Erro ao tentar alterar. ".$e);
               return false;
            }
    }

    public function excluir($codigo)
    {
        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();
            
           $contatoDAO = new ContatoDAO();
                                   
           $contatoDAO->excluir($codigo);
            $transacao->commit();            
            
            Sessao::limpaMensagem();
            
            return true;
        } catch (\Exception $e) {
                $emailService = new EmailService();
                $tela = " Exclusao de contatos - Codigo ".$codigo;
                $emailService->emailSuporte($e, $tela);
                $transacao->rollBack();
            throw new \Exception("Erro ao excluir a cadastro");            
            return false;
        }
    }
    
}