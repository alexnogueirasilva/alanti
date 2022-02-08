<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\SugestoesDAO;

use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Sugestoes;
use App\Models\Validacao\SugestoesValidador;

class SugestoesService
{
    public function listar(Sugestoes $sugestoes)
    {
        $sugestoesDAO = new SugestoesDAO();
        return $sugestoesDAO->listar($sugestoes);
    }   

 public function sugestoesResolvidas()
    {
        $sugestoesDAO = new SugestoesDAO();
        return $sugestoesDAO->sugestoesResolvidas();
    }   
    public function sugestoesPendentes()
    {
        $sugestoesDAO = new SugestoesDAO();
        return $sugestoesDAO->sugestoesPendentes();
    }   

    public function salvar(Sugestoes $sugestoes)
    {
        $transacao = new Transacao();
        $sugestoesValidador = new SugestoesValidador();
        $resultadoValidacao = $sugestoesValidador->validar($sugestoes);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
               $transacao->beginTransaction();
                $sugestoesDAO = new SugestoesDAO();            
                $codSugestoes = $sugestoesDAO->salvar($sugestoes);
                
                $transacao->commit(); 
                
                Sessao::gravaMensagem("cadastro realizado com sucesso!. <br><br> Sugestoes Numero: ".$codSugestoes);
                Sessao::limpaFormulario();
                return $codSugestoes;
            }catch(\Exception $e){              
                $tela = " Cadastro de Sugestoes ";
                $emailService = new EmailService();
               $emailService->emailSuporte($e,$tela);
                $transacao->rollBack(); 
                Sessao::gravaMensagem("Erro ao tentar cadastrar. ".$e);
               return false;
            }
        }
    }

    public function Editar(Sugestoes $sugestoes)
    {   
        $transacao = new Transacao();
        $sugestoesValidador = new SugestoesValidador();
        $resultadoValidacao = $sugestoesValidador->validar($sugestoes);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
               $transacao->beginTransaction();
                $sugestoesDAO = new SugestoesDAO();            
                $sugestoesDAO->atualizar($sugestoes);
                
                $transacao->commit(); 
                Sessao::gravaMensagem("cadastro alterado com sucesso!. <br> <br>  Codigo ".$sugestoes->getSugId());
                Sessao::limpaFormulario();
                return true;
            }catch(\Exception $e){
                $tela = " Altercação de Sugestoes ";
                $emailService = new EmailService();
               $emailService->emailSuporte($e,$tela);
                $transacao->rollBack(); 
              //var_dump($e);
                Sessao::gravaMensagem("Erro ao tentar alterar. ".$e);
               return false;
            }
        }

    }

    public function excluir(Sugestoes $sugestoes)
    {
        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $sugestoesDAO = new SugestoesDAO();
                                   
            $sugestoesDAO->excluir($sugestoes);
            $transacao->commit();            
            
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Cadastro Excluido com Sucesso!");
            return true;
        } catch (\Exception $e) {
            $tela = " Exclusao de Sugestoes ";
            $emailService = new EmailService();
           $emailService->emailSuporte($e,$tela);
            $transacao->rollBack();
            throw new \Exception(["Erro ao excluir Cadastro"]);            
            return false;
        }
    }
    
}