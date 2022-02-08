<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\GarantiaStatusDAO;

use App\Models\Validacao\GarantiaStatusValidador;
use App\Models\Validacao\ResultadoValidacao;
use App\Models\Entidades\GarantiaStatus;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Instituicao;


class GarantiaStatusService
{
    public function listar(GarantiaStatus $garantiaStatus)
    {
        $garantiaStatusDAO = new GarantiaStatusDAO();
        return $garantiaStatusDAO->listar($garantiaStatus);
    }

    public function salvar(GarantiaStatus $garantiaStatus)
    {
        $transacao = new Transacao();
        $garantiaStatusValidador = new GarantiaStatusValidador();
        $resultadoValidacao = $garantiaStatusValidador->validar($garantiaStatus);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
               $transacao->beginTransaction();
               $garantiaStatusDAO = new GarantiaStatusDAO();            
               $codigo =  $garantiaStatusDAO->salvar($garantiaStatus);
               $transacao->commit(); 
               Sessao::gravaMensagem("cadastro realizado com sucesso!. <br><br> Numero: ".$codigo);
               Sessao::limpaFormulario();
                return $codigo;
            }catch(\Exception $e){   
                $emailService = new EmailService();
                $tela = "Cadastro de Status de Garantia - Nome ".$garantiaStatus->getStGarNome;
                $emailService->emailSuporte($e, $tela);           
                $transacao->rollBack(); 
                Sessao::gravaMensagem("Erro ao tentar cadastrar. ".$e);
               return false;
            }
        }
    }

    public function Editar(GarantiaStatus $garantiaStatus)
    {   
        $transacao = new Transacao();
        $garantiaStatusValidador = new GarantiaStatusValidador();
        $resultadoValidacao = $garantiaStatusValidador->validar($garantiaStatus);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
               $transacao->beginTransaction();
                $garantiaStatusDAO = new GarantiaStatusDAO();            
                $garantiaStatusDAO->atualizar($garantiaStatus);
                $transacao->commit(); 
                Sessao::gravaMensagem("cadastro atualizado com sucesso!. <br><br> Numero: ".$garantiaStatus->getStGarId());
                Sessao::limpaFormulario();
                return true;
            }catch(\Exception $e){
                $emailService = new EmailService();
                $tela = "Atualizacao de Status de Garantia - Codigo ".$garantiaStatus->getStGarId();
                $emailService->emailSuporte($e, $tela);
                $transacao->rollBack(); 
             //var_dump($e);
                Sessao::gravaMensagem("Erro ao tentar alterar. ".$e);
               return false;
            }
        }

    }

    public function excluir(GarantiaStatus $garantiaStatus)
    {
        try {
            
            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $garantiaStatusDAO = new GarantiaStatusDAO();
                                   
            $garantiaStatusDAO->excluir($garantiaStatus);
            $transacao->commit();            
            
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Cadastro Excluida com Sucesso!");
            return true;
        } catch (\Exception $e) {
            $emailService = new EmailService();
            $tela = "Exclusao de Status de Garantia - Codigo ".$garantiaStatus->getStGarId();
            $emailService->emailSuporte($e, $tela);
           // var_dump($e);
            $transacao->rollBack();
            throw new \Exception("Erro ao excluir cadastro");            
            return false;
        }
    }
}