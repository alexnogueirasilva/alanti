<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Services\SugestoesService;
use App\Services\InstituicaoService;
use App\Services\UsuarioService;
use App\Services\ClienteLicitacaoService;
use App\Services\EmailService;
use App\Models\Entidades\Sugestoes;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Usuario;
use App\Models\Validacao\SugestoesValidador;

class SugestoesController extends Controller
{

    public function index()
    {
        $sugestoes              = new Sugestoes();
        
        if($_POST){
            $sugestoes->setSugId($_POST['codigo']);
            $sugestoes->setSugDescricao($_POST['descricao']);
            $sugestoes->setSugStatus($_POST['status']);
            $sugestoes->setSugAnexo($_POST['anexo']);
            $sugestoes->setSugTipo($_POST['tipo']);
            $sugestoes->setSugDataCadastro($_POST['dataCadastro']);
            $sugestoes->setCodInstituicao($_POST['instituicao']);
            $sugestoes->getCodUsuario($_POST['usuario']);
         }
         $sugestoesService       = new SugestoesService();
         $usuarioService         = new UsuarioService();         
         $usuario                = new Usuario();         
         $instituicaoService     = new InstituicaoService();

         self::setViewParam('listarUsuarios', $usuarioService->listar($usuario));                 
         self::setViewParam('listarSugestoes', $sugestoesService->listar($sugestoes));
       
        $this->render('/sugestoes/index');
        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
    }

    public function cadastro()
    {
        $sugestoes          = new Sugestoes();
        $instituicaoService = new InstituicaoService();
        $usuario            = new Usuario();
        $usuarioService     = new UsuarioService();
        
        self::setViewParam('listarUsuarios', $usuarioService->listar($usuario)); 
        self::setViewParam('listarInstituicao', $instituicaoService->listar()); 

        if(Sessao::existeFormulario()) {
            $instituicaoId  = Sessao::retornaValorFormulario('instituicao');
            $instituicao    = $instituicaoService->listar($instituicaoId);
            
            $usuario->setId(Sessao::retornaValorFormulario('usuario'));
            $usuario        = $usuarioService->listar($usuario)[0];
            
            $sugestoes->setInstituicao($instituicao);              
            $sugestoes->setUsuario($usuario);     
            $sugestoes->setSugDataCadastro(Sessao::retornaValorFormulario('dataCadastro'));  
            $sugestoes->setSugAssunto(Sessao::retornaValorFormulario('assunto'));                     
            $sugestoes->setSugTipo(Sessao::retornaValorFormulario('tipo'));                       
            $sugestoes->setSugDescricao(Sessao::retornaValorFormulario('descricao'));
            $sugestoes->setSugStatus(Sessao::retornaValorFormulario('status'));
            $sugestoes->setSugAnexo(Sessao::retornaValorFormulario('anexo'));
            
        }else{            
            $sugestoes->setUsuario(new Usuario());
            $sugestoes->setInstituicao(new Instituicao());          
        }
        $this->setViewParam('sugestoes',$sugestoes); 
        $this->render('/sugestoes/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {              
        $usuarioService           = new UsuarioService();
        $usuario           = new Usuario();
        $instituicaoService       = new InstituicaoService();        
        $sugestoesService         = new SugestoesService();
        $sugestoes                = new Sugestoes();
        $usuario->setId($_POST['usuario']);
        $usuario                  = $usuarioService->listar($usuario)[0];
        $instituicao              = $instituicaoService->listar($_POST['instituicao']);
        
        $sugestoes->setSugDescricao($_POST['descricao']);
        $sugestoes->setSugStatus($_POST['status']);
        $sugestoes->setSugAssunto($_POST['assunto']);
        $sugestoes->setSugTipo($_POST['tipo']);
        $sugestoes->setSugAnexo($_POST['anexo']);
        $sugestoes->setSugDataCadastro($_POST['dataCadastro']);
        $sugestoes->setInstituicao($instituicao);
        $sugestoes->setUsuario($usuario);
        Sessao::gravaFormulario($_POST);        
               
        $sugestoesValidador   = new SugestoesValidador();
        $resultadoValidacao     = $sugestoesValidador->validar($sugestoes);
                
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/sugestoes/cadastro');
        }else{                 
            if (!$sugestoes) {           
                Sessao::gravaMensagem("sem dados informados");
                $this->redirect('/sugestoes/cadastro');
            }
            if ($codSugestoes  = $sugestoesService->salvar($sugestoes)) {
                if(isset($_POST['enviarEmail'])){  
                    $sugestoes->setSugId($codSugestoes);
                    $sugestoes = $sugestoesService->listar($sugestoes)[0];
                    $email = $_POST['emails'];
                    $emailService = new EmailService();
                    $subject = 1;
                    
                    $emailService->emailSugestoes($sugestoes, $email, $subject);
                }
               
                $this->redirect('/sugestoes');
                Sessao::limpaFormulario();
                Sessao::limpaMensagem();
                Sessao::limpaErro();
            } else {
                Sessao::gravaMensagem("Erro ao gravar");
                $this->redirect('/sugestoes/cadastro');
            }
        }
    }

    public function edicao($params)
    {
        $codSugestoes = $params[0];
        
        $sugestoes      = new Sugestoes();
        $sugestoes->setSugId($codSugestoes);
        $instituicaoService = new InstituicaoService();     
        $usuarioService     = new UsuarioService();        
        $usuario            = new Usuario();        
        $sugestoesService   = new SugestoesService();        
        self::setViewParam('listarUsuarios', $usuarioService->listar($usuario)); 
        if(Sessao::existeFormulario()) {
            $instituicaoId  = Sessao::retornaValorFormulario('instituicao');
            $instituicao    = $instituicaoService->listar($instituicaoId);
            
            $usuario->setId(Sessao::retornaValorFormulario('usuario'));
            $usuario        = $usuarioService->listar($usuario)[0];
            
            $sugestoes->setInstituicao($instituicao);              
            $sugestoes->setUsuario($usuario);     
            $sugestoes->setSugAssunto(Sessao::retornaValorFormulario('assunto'));                       
            $sugestoes->setSugId(Sessao::retornaValorFormulario('codigo'));                       
            $sugestoes->setSugDataCadastro(Sessao::retornaValorFormulario('dataCadastro'));                       
            $sugestoes->setSugTipo(Sessao::retornaValorFormulario('tipo'));                       
            $sugestoes->setSugDescricao(Sessao::retornaValorFormulario('descricao'));
            $sugestoes->setSugStatus(Sessao::retornaValorFormulario('status'));
            $sugestoes->setSugAnexo(Sessao::retornaValorFormulario('anexoAlt'));
        }else{
            $sugestoes->setUsuario(new Usuario());
            $sugestoes->setInstituicao(new Instituicao());
            $sugestoes = $sugestoesService->listar($sugestoes)[0];
        }
        if (!$sugestoes) {
            $this->redirect('/sugestoes');
            Sessao::gravaMensagem("sugestoes inexistente");
        }
        self::setViewParam('sugestoes', $sugestoes);
        $this->render('/sugestoes/editar');
        Sessao::limpaMensagem();
    }
    
    public function atualizar()
    {
        $sugestoes            = new Sugestoes();
        $usuarioService       = new UsuarioService();        
        $usuario              = new Usuario();        
        $sugestoesService     = new SugestoesService();        
        $instituicaoService   = new InstituicaoService(); 
        $instituicao          = $instituicaoService->listar($_POST['instituicao']);
        $usuario->setId($_POST['usuario']);
        $usuario              = $usuarioService->listar($usuario)[0];
        
        $sugestoes->setSugId($_POST['codigo']);
        $sugestoes->setSugAssunto($_POST['assunto']);
        $sugestoes->setSugDescricao($_POST['descricao']);
        $sugestoes->setSugStatus($_POST['status']);
        $sugestoes->setSugTipo($_POST['tipo']);
        $sugestoes->setSugAnexo($_POST['anexo']);
        $sugestoes->setSugDataCadastro($_POST['dataCadastro']);
        $sugestoes->setInstituicao($instituicao);
        $sugestoes->setUsuario($usuario);
        $anexo =  $_POST['anexo'];
        if($anexo == ""){
            $sugestoes->setSugAnexo($_POST['anexoAlt']);                    
        } else{
            $sugestoes->setSugAnexo($_POST['anexo']);        
        }
        Sessao::gravaFormulario($_POST);
        $sugestoesValidador = new SugestoesValidador();
        $resultadoValidacao = $sugestoesValidador->validar($sugestoes);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
           $this->redirect('/sugestoes/edicao/' . $_POST['codigo']);
        }
        if ($sugestoesService->Editar($sugestoes)) {
            if(isset($_POST['enviarEmail'])){  
                $sugestoes->setSugId($_POST['codigo']);
                $sugestoes = $sugestoesService->listar($sugestoes)[0];
                $emailService = new EmailService();
                $email = $_POST['emails'];
                $subject = 2;
                $emailService->emailSugestoes($sugestoes, $email, $subject);
            }           
                       
            $this->redirect('/sugestoes');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();           
        }else{
            Sessao::gravaFormulario($_POST);            
            Sessao::gravaMensagem("erro na atualizacao");
            $this->redirect('/sugestoes/edicao/' . $_POST['codigo']);
        }
        
    }

    public function exclusao($params)
    {
        $sugestoes          = new Sugestoes();
        $sugestoesService   = new SugestoesService();
        $codSugestoes = $params[0];

        $sugestoes->setSugId($codSugestoes);
        $sugestoes = $sugestoesService->listar($sugestoes)[0];

        if (!$sugestoes) {
            Sessao::gravaMensagem("sugestao inexistente");
            $this->redirect('/sugestoes');
        }

        self::setViewParam('sugestoes', $sugestoes);
        $this->render('/sugestoes/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $sugestoes          = new Sugestoes();
        $sugestoesService   = new SugestoesService();
        $sugestoes->setSugId($_POST['codigo']);

        if (!$sugestoesService->excluir($sugestoes)) {
            Sessao::gravaMensagem("sugestao inexistente");
            $this->redirect('/sugestoes');
        }
              
        $this->redirect('/sugestoes');

        Sessao::gravaMensagem("Cadastro excluido com sucesso!");

    }
}
