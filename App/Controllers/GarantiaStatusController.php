<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\Entidades\GarantiaStatus;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Instituicao;
use App\Models\Validacao\GarantiaStatusValidador;
use App\Models\Validacao\TransportadoraValidador;
use App\Services\GarantiaStatusServices;
use App\Services\EmailService;
use App\Services\InstituicaoService;
use App\Services\UsuarioService;
use App\Services\CidadeService;
use App\Services\GarantiaStatusService;

class GarantiaStatusController extends Controller
{
    public function index()
    {
        $garantiaStatusService = new GarantiaStatusService();
        $garantiaStatus = new GarantiaStatus();

        if($_POST){
            $garantiaStatus->setStGarId($_POST['codigo']);
            $garantiaStatus->setStGarNome($_POST['nome']);
         }


        self::setViewParam('garantiastatus', $garantiaStatusService->listar($garantiaStatus));
        $this->render('/garantiastatus/index');    
    }
    
    public function cadastro()
    {
        $garantiaStatus         = new GarantiaStatus();
        $instituicao            = new Instituicao();
        $usuario                = new Usuario();
        $garantiaStatusService  = new garantiaStatusService();
        $instituicaoService     = new InstituicaoService();
        $usuarioService         = new UsuarioService();
        
        if(Sessao::existeFormulario()) { 
            $codInstotuicao = Sessao::retornaValorFormulario('instituicao');            
            $instituicao    = $instituicaoService->listar($codInstotuicao);
            $codUsuario     = Sessao::retornaValorFormulario('usuario');            
            $usuario        = $usuarioService->listar($codUsuario);
            $garantiaStatus->setStGarNome( Sessao::retornaValorFormulario('nome'));
            $garantiaStatus->setStGarObservacao( Sessao::retornaValorFormulario('observacao'));
            $garantiaStatus->setStGarInstituicao($instituicao);            
            $garantiaStatus->setStGarUsuario($usuario);  
            
        }else{                                   
            $garantiaStatus = $garantiaStatusService->listar($garantiaStatus)[0]; 
        }
        $this->setViewParam('garantiastatus',$garantiaStatus); 
        $this->render('/garantiastatus/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $garantiaStatusService  = new GarantiaStatusService();      
        $usuarioService         = new UsuarioService();           
        $instituicaoService     = new InstituicaoService();           
        $usuario                = $usuarioService->listar($_POST['usuario']);
        $instituicao            = $instituicaoService->listar($_POST['instituicao']);
        
        $garantiaStatus = new GarantiaStatus();
        $garantiaStatus->setStGarId($_POST['codigo']);        
        $garantiaStatus->setStGarNome($_POST['nome']);        
        $garantiaStatus->setStGarObservacao($_POST['observacao']);  
        $garantiaStatus->setStGarUsuario($usuario);
        $garantiaStatus->setStGarInstituicao($instituicao);    
        
        Sessao::gravaFormulario($_POST);

        if ( $codigo  = $garantiaStatusService->salvar($garantiaStatus)) {
             if(isset($_POST['enviarEmail'])){  
                $pedido->setCodControle($codigo);
                $pedido = $garantiaStatusService->listar($garantiaStatus)[0];
                $email = $_POST['email'];
                $emailService = new EmailService();
                $subject = 1;
                $emailService->emailGarantiaStatus($garantiaStatus, $email,$subject);
            }
            $this->redirect('/pedido');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();
        } else {
            Sessao::gravaMensagem("Erro ao gravar");
            $this->redirect('/pedido/cadastro');
        }
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function edicao($params)
    {       
        $garantiaStatus         = new GarantiaStatus();
        $instituicao            = new Instituicao();
        $usuario                = new Usuario();
        $garantiaStatusService  = new garantiaStatusService();
        $instituicaoService     = new InstituicaoService();
        $usuarioService         = new UsuarioService();
        $garantiaStatus->setStGarId($params[0]);       
        
        if(Sessao::existeFormulario()) { 
            $codInstituicao = Sessao::retornaValorFormulario('instituicao');            
            $instituicao    = $instituicaoService->listar($codInstituicao);
            $codUsuario     = Sessao::retornaValorFormulario('usuario');            
            $usuario        = $usuarioService->listar($codUsuario);
            $garantiaStatus->setStGarNome( Sessao::retornaValorFormulario('nome'));
            $garantiaStatus->setStGarObservacao( Sessao::retornaValorFormulario('observacao'));
            $garantiaStatus->setStGarInstituicao($instituicao);            
            $garantiaStatus->setStGarUsuario($usuario);  
            
        }else{                                   
            $garantiaStatus = $garantiaStatusService->listar($garantiaStatus)[0]; 
        }        

        if (!$garantiaStatus) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/garantiastatus');
        }
        $this->setViewParam('garantiastatus', $garantiaStatus);
        $this->render('/garantiastatus/editar');
        
        Sessao::limpaMensagem();
    }

    public function atualizar()
    {             
        $garantiaStatusService      = new GarantiaStatusService();      
        $usuarioService             = new UsuarioService();           
        $instituicaoService         = new InstituicaoService();   
        
        $usuario            = $usuarioService->listar($_POST['usuario']);
        $instituicao        = $instituicaoService->listar($_POST['instituicao']);
        
        $garantiaStatus = new GarantiaStatus();
        $garantiaStatus->setStGarId($_POST['codigo']);        
        $garantiaStatus->setStGarNome($_POST['nome']);        
        $garantiaStatus->setStGarObservacao($_POST['observacao']);  
        $garantiaStatus->setStGarUsuario($usuario);
        $garantiaStatus->setStGarInstituicao($instituicao);    
        
        Sessao::gravaFormulario($_POST);

        $garantiaStatusValidador = new GarantiaStatusValidador();
        $resultadoValidacao = $garantiaStatusValidador->validar($garantiaStatus);
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            Sessao::gravaFormulario($_POST);
            $this->redirect('/garantiastatus/edicao/' . $_POST['codigo']);
            Sessao::gravaMensagem("erro na atualizacao");
        }        
        if ($garantiaStatusService->Editar($garantiaStatus)) {           
            if(isset($_POST['enviarEmail'])){  
                $garantiaStatus->getStGarId();
                $garantiaStatus = $garantiaStatusService->listar($garantiaStatus)[0];
                $email = $_POST['email'];
                $emailService = new EmailService();
                $subject = 2;
                $emailService->emailGarantiaStatus($garantiaStatus, $email,$subject);
            }

            $this->redirect('/garantiastatus');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();           
        }else{
            Sessao::gravaFormulario($_POST);            
            $this->redirect('/garantiastatus/edicao/'.$_POST['codigo']);
            Sessao::gravaMensagem("erro na atualizacao");
        }
    }

    public function exclusao($params)
    {
        $garantiaStatus = new GarantiaStatus();
        $garantiaStatus->setStGarId($params[0]); 

        $garantiaStatusService = new GarantiaStatusService();

        $notificacao = $garantiaStatusService->listar($garantiaStatus)[0];

        if (!$garantiaStatus) {
        Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/garantiastatus');
        }

        self::setViewParam('garantiastatus', $garantiaStatus);

        $this->render('/garantiastatus/excluir');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $garantiaStatus = new GarantiaStatus();
        $garantiaStatus->setStGarId($_POST['codigo']);
      
        $garantiaStatusService = new GarantiaStatusService();

        if (!$garantiaStatusService->excluir($garantiaStatus)) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/garantiaStatus/excluir'.$garantiaStatus->getStGarId());
        }

        Sessao::gravaMensagem("Cadastro excluido com sucesso!");

        $this->redirect('/garantiaStatus');
    }

}