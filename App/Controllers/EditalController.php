<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\GarantiaStatusDAO;
use App\Models\Entidades\Edital;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\EditalStatus;
use App\Models\Entidades\ClienteLicitacao;
use App\Models\Entidades\Representante;
use App\Models\Validacao\EditalValidador;
use App\Services\EditalService;
use App\Services\EmailService;
use App\Services\EditalStatusService;
use App\Services\RepresentanteService;
use App\Services\ClienteLicitacaoService;
use App\Services\ContratoService;
use App\Services\GarantiaService;
use App\Services\UsuarioService;
use App\Services\InstituicaoService;
use App\Services\NotificacaoService;

class EditalController extends Controller
{
    public function index($params)
    {
        $editalId                   = $params[0];
        $editalService              = new EditalService();
        $editalStatusService        = new EditalStatusService();
        $clienteLicitacaoService    = new ClienteLicitacaoService();
        $instituicaoService         = new InstituicaoService();
        $representanteService       = new RepresentanteService();
        $edital                     = new Edital();
        $editalStatus               = new EditalStatus();
        $usuarioService             = new UsuarioService();
         $usuarioService             = new UsuarioService();
            $usuario                    = new Usuario();

        self::setViewParam('listaClientesEdital', $clienteLicitacaoService->listaClientesEdital());
        self::setViewParam('listarOperadorEdital', $editalService->listarOperadorEdital());
        self::setViewParam('listarUsuarios', $usuarioService->listar($usuario));
        self::setViewParam('listarEditalStatus', $editalStatusService->listar($editalStatus)); 
        self::setViewParam('listaInstituicoes', $instituicaoService->listar());
        self::setViewParam('listarRepresentantes', $editalService->listarRepresentanteEdital());
        
       if($_POST){
           //$edital->setEdtCliente($_POST['codCliente']);           
           $edital->setEdtCliente($_POST['cliente']);           
           $edital->setEdtId($_POST['codigo']);        
           $edital->setEdtOperador($_POST['operador']);        
           $edital->setEdtProposta($_POST['proposta']);        
           $edital->setEdtNumero($_POST['numeroLicitacao']);              
           $edital->setEdtModalidade($_POST['modalidade']);        
           $edital->setEdtStatus($_POST['status']);        
           $edital->setEdtTipo($_POST['tipo']);  
           $edital->setEdtRepresentante($_POST['codRepresentante']); 
        $edital->setEdtDataInicio($_POST['edtDataInicio']); 
                $edital->setEdtDataFinal($_POST['edtDataFinal']); 
                            
                //$_SESSION['codClienteEdt']          = $_POST['codCliente'];
                $_SESSION['codClienteEdt']          = $_POST['cliente'];
                $_SESSION['codigoEdt']              = $_POST['codigo'];
                $_SESSION['operadorEdt']            = $_POST['operador'];
                $_SESSION['propostaEdt']            = $_POST['proposta'];
                $_SESSION['numeroLicitacaoEdt']     = $_POST['numeroLicitacao'];
                $_SESSION['modalidadeEdt']          = $_POST['modalidade'];
                $_SESSION['statusEdt']              = $_POST['status'];
                $_SESSION['tipoEdt']                = $_POST['tipo'];
                $_SESSION['codRepresentanteEdt']    = $_POST['codRepresentante'];
                $_SESSION['dataInicioEdt']          = $_POST['edtDataInicio'];
                $_SESSION['dataFinalEdt']           = $_POST['edtDataFinal'];
                $_SESSION['edtDataCadDisp']         = $_POST['edtDataCadDisp'];
             }else{
                 unset($_SESSION['codClienteEdt'],$_SESSION['edtDataCadDisp'],
                $_SESSION['codigoEdt'], $_SESSION['operadorEdt'],
                $_SESSION['propostaEdt'], $_SESSION['numeroLicitacaoEdt'],
                $_SESSION['modalidadeEdt'], $_SESSION['statusEdt'], 
                $_SESSION['tipoEdt'], $_SESSION['codRepresentanteEdt'],
                $_SESSION['dataInicioEdt'], $_SESSION['dataFinalEdt']
                );
             }
        
        self::setViewParam('listaEditais', $editalService->listarDinamico($edital));
        $this->render('/edital/index');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
    }

    public function autoComplete($params)
    {
        $edital = new Edital();
        $edital->CidNome($params[0]);
        $editalService = new EditalService();
        $busca = $editalService->autoComplete($edital);
        
        echo $busca;
    }
    
    public function cadastro()
    {
        $editalStatusService     = new EditalStatusService();
        $editalStatus            = new EditalStatus();
        $representanteService    = new RepresentanteService();
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $clienteLicitacao        = new ClienteLicitacao();
        $instituicaoService      = new InstituicaoService();
        $edital                  = new Edital();
        $usuarioService          = new UsuarioService();
        $usuario                 = new Usuario();
        
        self::setViewParam('listarUsuarios', $usuarioService->listar($usuario));
        self::setViewParam('listaInstituicoes', $instituicaoService->listar());
        self::setViewParam('listarEditalStatus', $editalStatusService->listar($editalStatus)); 
        if(Sessao::existeFormulario()) {
     
            $codInstituicao = Sessao::retornaValorFormulario('codInstituicao');
            $codInstituicao    = $instituicaoService->listar($codInstituicao);
            $edital->setInstituicao($codInstituicao);
            
            $editalStatusId = Sessao::retornaValorFormulario('status');
            $editalStatus->setStEdtId($editalStatusId);
            $status    = $editalStatusService->listar($editalStatus)[0];
            $edital->setEditalStatus($status);
        
            $clienteLicitacao->setCodCliente( Sessao::retornaValorFormulario('cliente'));
            $clienteLicitacao = $clienteLicitacaoService->listar($clienteLicitacao)[0];
            $edital->setClienteLicitacao($clienteLicitacao);
        
            $representanteId = Sessao::retornaValorFormulario('representante');
            $representante = $representanteService->listar($representanteId)[0];
            $edital->setRepresentante($representante);
            
            $usuario->setId(Sessao::retornaValorFormulario('operador'));
            $usuario = $usuarioService->listar($usuario)[0];
            $edital->setEdtOperador($usuario);
            
            $edital->setEdtModalidade(Sessao::retornaValorFormulario('modalidade'));
            $edital->setEdtProposta(Sessao::retornaValorFormulario('proposta'));
            $edital->setEdtIdentificador(Sessao::retornaValorFormulario('identificador'));
            $edital->setEdtPortal(Sessao::retornaValorFormulario('portal'));
            $edital->setEdtModalidade(Sessao::retornaValorFormulario('modalidade'));
            $edital->setEdtGarantia(Sessao::retornaValorFormulario('garantia'));
            $edital->setEdtTipo(Sessao::retornaValorFormulario('tipo'));
            $edital->setEdtNumero(Sessao::retornaValorFormulario('numeroLicitacao'));
            $edital->setEdtHora(Sessao::retornaValorFormulario('hora'));
            $edital->setEdtHoraLimite(Sessao::retornaValorFormulario('horaLimite'));
            $edital->setEdtDataLimite(Sessao::retornaValorFormulario('dataLimite'));
           $edital->setEdtValor(str_replace(',','.', str_replace(".", "", $_POST['valor'])));
            $edital->setEdtDataAbertura(Sessao::retornaValorFormulario('dataAbertura'));
            $edital->setEdtAnalise(Sessao::retornaValorFormulario('analise'));
            $edital->setEdtObservacao(Sessao::retornaValorFormulario('observacao'));
            $edital->setEdtAnexo(Sessao::retornaValorFormulario('anexo'));
            $edital->setEdtAnexo(Sessao::retornaValorFormulario('anexoAlt'));
            $edital->setDisputa(Sessao::retornaValorFormulario('disputa'));
            $edital->setJustificativa(Sessao::retornaValorFormulario('justificarEdital'));
        }else{   
            
            $edital->setClienteLicitacao(new ClienteLicitacao());
            $edital->setRepresentante(new Representante());
            $edital->setEditalStatus(new EditalStatus());
        }
        self::setViewParam('listarRepresentantes', $representanteService->listar());                 
        
        $this->setViewParam('edital',$edital);        
        $this->render('/edital/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

     public function salvar()
    {
        $editalStatus            = new EditalStatus();
        $clienteLicitacaoService = new ClienteLicitacaoService();  
        $clienteLicitacao           = new ClienteLicitacao();    
        $usuarioService          = new UsuarioService();
        $usuario                 = new Usuario();
        $editalStatusService     = new EditalStatusService();        
        $representanteService    = new RepresentanteService();        
        $instituicaoService      = new InstituicaoService();        
        $clienteLicitacao->setCodCliente($_POST['cliente']);
        $clienteLicitacao           = $clienteLicitacaoService->listar($clienteLicitacao)[0];
        $usuario->setId($_POST['operador']);
        $usuario                 = $usuarioService->listar($usuario)[0];
        $editalStatus->setStEdtId($_POST['status']);
        $status                  = $editalStatusService->listar($editalStatus)[0];
        $instituicao             = $instituicaoService->listar($_POST['codInstituicao']);
        $representante           = $representanteService->listar($_POST['representante'])[0];

        $edital = new Edital();
        $edital->setEdtProposta($_POST['proposta']);        
        $edital->setEdtNumero($_POST['numeroLicitacao']);        
        $edital->setEdtValor(str_replace(',','.', str_replace(".", "", $_POST['valor'])));      
        $edital->setEdtModalidade($_POST['modalidade']);
        $edital->setEdtTipo($_POST['tipo']);
        $edital->setEdtHora($_POST['hora']);
        $edital->setEdtHoraLimite($_POST['horaLimite']);
        $edital->setEdtDataLimite($_POST['dataLimite']);    
        $edital->setEdtOperador($_SESSION['id']);    
        $edital->setEdtIdentificador($_POST['identificador']);    
        $edital->setEdtPortal($_POST['portal']);    
        $edital->setEdtDataAbertura($_POST['dataAbertura']);    
        $edital->setEdtDataCadastro($_POST['dataCadastro']);        
        $edital->setEdtDataAlteracao($_POST['dataAlteracao']);        
        $edital->setEdtDataResultado($_POST['dataResultado']);        
        $edital->setEdtGarantia($_POST['garantia']);        
        $edital->setEdtAnalise($_POST['analise']);        
        $edital->setEdtAnexo($_POST['anexo']);        
        $edital->setEdtObservacao($_POST['observacao']);  
        $edital->setDisputa($_POST['disputa']);
        $edital->setJustificativa($_POST['justificarEdital']);
        $edital->setClienteLicitacao($clienteLicitacao);
        $edital->setInstituicao($instituicao);
        $edital->setRepresentante($representante);
        $edital->setUsuario($usuario);
        $edital->setEditalStatus($status);

        Sessao::gravaFormulario($_POST);

        $editalValidador    = new EditalValidador();
        $resultadoValidacao = $editalValidador->validar($edital);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
           $this->redirect('/edital/cadastro');
        }
        if ($_POST['dataLimite'] > $_POST['dataAbertura']) {
           Sessao::gravaMensagem("A data limite nao pode ser maior que a data de abertura!");
           $this->redirect('/edital/cadastro');
        }
        
        $editalService = new EditalService();
    
       if($codEdital = $editalService->salvar($edital)){
        if(isset($_POST['enviarEmail'])){ 
                $edital = new Edital();
          
                $edital = $editalService->listarDinamico($edital->setEdtId($codEdital))[0];
                 $edital->setUsuario($usuario);
                $email = $_POST['emails'];
                $emailService = new EmailService();
                $subject = 1;
                $emailService->emailEdital($edital,$email, $subject);
            }
             if($_POST['copiar']){              
                Sessao::gravaFormulario($_POST);  
                $this->redirect('/edital/cadastro');               
            }
          if($_POST['status'] == 10){
                $this->redirect('/contrato/cadastro/'. $codEdital);
            }else {                
                $this->redirect('/edital');
            }
        }else{
            $this->redirect('/edital/cadastro');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function edicao($params)
    {
        $edital                  = new Edital();
        $editalStatus            = new EditalStatus();
        $editalId                = $params[0];
        $representanteService    = new RepresentanteService();
        $editalStatusService     = new EditalStatusService();
        $instituicaoService      = new InstituicaoService();
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $clienteLicitacao        = new ClienteLicitacao();
        $usuarioService          = new UsuarioService();
        $usuario                 = new Usuario();
        $garantiaService         = new GarantiaService();
        $garantias = $garantiaService->listar($params[0]);
        self::setViewParam('garantias', $garantias);
        self::setViewParam('listarUsuarios', $usuarioService->listar($usuario));
        self::setViewParam('listarRepresentantes', $representanteService->listar());            
        self::setViewParam('listarInstituicoes', $instituicaoService->listar());            
        self::setViewParam('listarEditalStatus', $editalStatusService->listar($editalStatus));

        if(Sessao::existeFormulario()) { 
            $codInstituicao = Sessao::retornaValorFormulario('codInstituicao');
             $instituicao    = $instituicaoService->listar($codInstituicao);
            $edital->setInstituicao($instituicao);

            $clienteLicitacao->setCodCliente( Sessao::retornaValorFormulario('cliente'));
            $clienteLicitacao = $clienteLicitacaoService->listar($clienteLicitacao)[0];
            $edital->setClienteLicitacao($clienteLicitacao);
            
            $representanteId = Sessao::retornaValorFormulario('codRepresentante');
            $representante = $representanteService->listar($representanteId)[0];
            $edital->setRepresentante($representante);

            $editalStatusId = Sessao::retornaValorFormulario('status');
            $editalStatus->setStEdtId($editalStatusId);
            $status    = $editalStatusService->listar($editalStatus)[0];
            $edital->setEditalStatus($status);
            
            $usuario->setId(Sessao::retornaValorFormulario('operador'));
            $usuario = $usuarioService->listar($usuario)[0];
            $edital->setEdtOperador($usuario->getApelido());
            $edital->setUsuario($usuario);
            
            $edital->setEdtId(Sessao::retornaValorFormulario('codigo'));
            $edital->setEdtProposta(Sessao::retornaValorFormulario('proposta'));
            $edital->setEdtIdentificador(Sessao::retornaValorFormulario('identificador'));
            $edital->setEdtPortal(Sessao::retornaValorFormulario('portal'));
            $edital->setEdtModalidade(Sessao::retornaValorFormulario('modalidade'));
            $edital->setEdtGarantia(Sessao::retornaValorFormulario('garantia'));
            $edital->setEdtTipo(Sessao::retornaValorFormulario('tipo'));
            $edital->setEdtNumero(Sessao::retornaValorFormulario('numeroLicitacao'));
            $edital->setEdtHora(Sessao::retornaValorFormulario('hora'));
            $edital->setEdtHoraLimite(Sessao::retornaValorFormulario('horaLimite'));
            $edital->setEdtDataLimite(Sessao::retornaValorFormulario('dataLimite'));
            $edital->setEdtDataAbertura(Sessao::retornaValorFormulario('dataAbertura'));
            $edital->setEdtAnalise(Sessao::retornaValorFormulario('analise'));
            $edital->setEdtObservacao(Sessao::retornaValorFormulario('observacao'));
            $edital->setEdtAnexo(Sessao::retornaValorFormulario('anexo'));
            $edital->setEdtAnexo(Sessao::retornaValorFormulario('anexoAlt'));
            $edital->setDisputa(Sessao::retornaValorFormulario('disputa'));
            $edital->setJustificativa(Sessao::retornaValorFormulario('justificarEdital'));
            $edital->setEdtValor(str_replace(',','.', str_replace(".", "", Sessao::retornaValorFormulario('valor'))));   
        }else{                       
            $editalService = new EditalService();
            $edital        = $editalService->listar($editalId)[0];
        }              
       
        if (!$edital) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/edital');
        }
       $this->setViewParam('edital', $edital);
       
        $this->render('/edital/editar');
        Sessao::limpaMensagem();
    }

    public function atualizar()
    {       
        $edital                     = new Edital();
        $editalStatus               = new EditalStatus();
        $editalStatusService        = new EditalStatusService();    
        $clienteLicitacaoService    = new ClienteLicitacaoService();   
         $clienteLicitacao           = new ClienteLicitacao();
        $usuarioService             = new UsuarioService();
        $usuario                    = new Usuario();
        $representanteService       = new RepresentanteService();        
        $instituicaoService         = new InstituicaoService();        
        $clienteLicitacao->setCodCliente($_POST['cliente']);
        $clienteLicitacao           = $clienteLicitacaoService->listar($clienteLicitacao)[0];
        $editalStatus->setStEdtId($_POST['status']);
        $usuario->setId($_POST['operador']);
        $status                     = $editalStatusService->listar($editalStatus)[0];
        $usuario                    = $usuarioService->listar($usuario)[0];
        $instituicao                = $instituicaoService->listar($_POST['codInstituicao']);
        $representante              = $representanteService->listar($_POST['representante'])[0];
       
        $edital->setEdtId($_POST['codigo']);        
        $edital->setEdtProposta($_POST['proposta']);        
        $edital->setEdtNumero($_POST['numeroLicitacao']);        
        $edital->setEdtValor(str_replace(',','.', str_replace(".", "", $_POST['valor'])));      
        $edital->setEdtModalidade($_POST['modalidade']);        
       //$edital->setEdtStatus($_POST['status']);        
        $edital->setEdtTipo($_POST['tipo']);        
        $edital->setEdtHora($_POST['hora']);
        $edital->setEdtHoraLimite($_POST['horaLimite']);
        $edital->setEdtDataLimite($_POST['dataLimite']);    
        $edital->setEdtOperador($_SESSION['id']);    
        $edital->setEdtIdentificador($_POST['identificador']);   
        $edital->setEdtPortal($_POST['portal']);   
        $edital->setEdtDataAbertura($_POST['dataAbertura']);        
        $edital->setEdtDataCadastro($_POST['dataCadastro']);        
        $edital->setEdtDataAlteracao($_POST['dataAlteracao']);        
       // $edital->setEdtDataResultado($_POST['dataResultado']);        
        $edital->setEdtGarantia($_POST['garantia']);        
        $edital->setEdtAnalise($_POST['analise']); 
        $anexo =  $_POST['anexo'];
        if($anexo == ""){
            $edital->setEdtAnexo($_POST['anexoAlt']);                    
        } else{
            $edital->setEdtAnexo($_POST['anexo']);        
        }
        $edital->setEdtObservacao($_POST['observacao']);  
        $edital->setDisputa($_POST['disputa']);
        $edital->setJustificativa($_POST['justificarEdital']);
        $edital->setClienteLicitacao($clienteLicitacao);
        $edital->setInstituicao($instituicao);
        $edital->setRepresentante($representante);
        $edital->setUsuario($usuario);
        $edital->setEditalStatus($status);

        Sessao::gravaFormulario($_POST);

        $editalService = new EditalService();
       
        $editalValidador = new EditalValidador();
        $resultadoValidacao = $editalValidador->validar($edital);
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            Sessao::gravaMensagem("erro na atualizacao");
            Sessao::gravaFormulario($_POST);
           $this->redirect('/edital/edicao/' . $_POST['codigo']);
        }
         if ($_POST['dataLimite'] > $_POST['dataAbertura']) {
           Sessao::gravaMensagem("A data limite nao pode ser maior que a data de abertura!");
            $this->redirect('/edital/edicao/' . $_POST['codigo']);
        }
        
         if ($editalService->Editar($edital)) {

            if(isset($_POST['enviarEmail'])){
                $edital = new Edital();
                $edital = $editalService->listar($_POST['codigo'])[0];  
                $edital->setUsuario($usuario);
                $email = $_POST['emails'];               
                $emailService = new EmailService();
                $subject = 2;
                $emailService->emailEdital($edital,$email, $subject);
            }
             if($_POST['copiar']){              
                Sessao::gravaFormulario($_POST);  
                $this->redirect('/edital/cadastro');               
            }
            if($_POST['status'] == 10){
               $this->redirect('/edital');// $this->redirect('/contrato/cadastro/'. $_POST['codigo']);
            }else {                
                $this->redirect('/edital');
            }
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();
           
        }else{
            Sessao::gravaFormulario($_POST);            
            Sessao::gravaErro(" erro na atualizacao ");
          $this->redirect('/edital/edicao/' . $_POST['codigo']);
        }        
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

    }

    public function exclusao($params)
    {
        $editalId           = $params[0];

        $editalService      = new EditalService();
        $contratoService    = new ContratoService();
        $notificacaoService = new NotificacaoService();
        $garantiaService    = new GarantiaService();

        $edital      = $editalService->listar($editalId)[0];
        $contrato    = $contratoService->qtdeContratoPorEdital($editalId);
        $notificacao = $notificacaoService->qtdeNotificacaoPorEdital($editalId);
        $garantia    = $garantiaService->listar($editalId);

        if (!$edital) {
            Sessao::gravaMensagem("Cadastro inexistente!");
            $this->redirect('/edital');
        }
        if($notificacao){
            $notificacao = $notificacao->getNtf_numero();
            self::setViewParam('notificacao', $notificacao);               
        }else{
            $notificacao = "";               
            self::setViewParam('notificacao', $notificacao);
        }
        if($garantia){
           // $garantia = $garantia->getGrtPkIdEdital()->getEdtId();            
            self::setViewParam('garantia', $garantia);               
        }else{
            $garantia = "";               
            self::setViewParam('garantia', $garantia);
        }
        if($contrato){
            $contrato = $contrato->getCtrNumero();
            self::setViewParam('contrato', $contrato);               
        }else{
            $contrato = "";               
            self::setViewParam('contrato', $contrato);               
        }
        self::setViewParam('edital', $edital);           

       $this->render('/edital/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $codigo = $_POST['codigo'];
        $edital = new Edital();
        $edital->setEdtId($codigo);

        $editalService = new EditalService();        

        if (!$editalService->excluir($edital)) {
            Sessao::gravaMensagem("Edital inexistente");
            $this->redirect('/edital/exclusao'.$edital->getEdtId());
        }

        Sessao::gravaMensagem("Edital excluido com sucesso! <br><br>".$codigo);

        $this->redirect('/edital');
        Sessao::limpaMensagem();
    }
    public function excel()
    {
        $edital = new Edital();
        $editalService = new EditalService();
        
        $edital->setEdtCliente($_SESSION['codClienteEdt']);           
        $edital->setEdtId($_SESSION['codigoEdt']);        
        $edital->setEdtOperador($_SESSION['operadorEdt']);        
        $edital->setEdtProposta($_SESSION['propostaEdt']);        
        $edital->setEdtNumero($_SESSION['numeroLicitacaoEdt']);              
        $edital->setEdtModalidade($_SESSION['modalidadeEdt']);        
        $edital->setEdtStatus($_SESSION['statusEdt']);        
        $edital->setEdtTipo($_SESSION['tipoEdt']);  
        $edital->setEdtRepresentante($_SESSION['codRepresentanteEdt']);                
        $edital->setEdtDataInicio($_SESSION['dataInicioEdt']); 
        $edital->setEdtDataFinal($_SESSION['dataFinalEdt']); 

        $editais = $editalService->listarDinamico($edital);
		if(isset($editais)){
            // Definimos o nome do arquivo que será exportado
			$arquivo = 'edital_'.date('dmY_His').'.xls';
            $conta = 0;
            ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="utf-8">
            <title>Relatorio de Editais</title>
            <head>
            <body><?php
                    // Criamos uma tabela HTML com o formato da planilha
                    $html = '';
                    $html .= '<table border="1">';
                    $html .= '<tr>';
                    $html .= '<th class="text-center" colspan="15">Planilha de Editais</th>';
                    $html .= '</tr>';                    
                    $html .= '<tr>';
                    $html .= '<th class="text-center">ORDEM</th>';
                    $html .= '<th class="text-center">CÓDIGO</th>';
                    $html .= '<th class="text-center">CLIENTE</th>';
                    $html .= '<th class="text-center">ORGÃO</th>';
                    $html .= '<th class="text-center">UF</th>';
                    $html .= '<th class="text-center">NUMERO</th>';
                    $html .= '<th class="text-center">EMPRESA</th>';
                    $html .= '<th class="text-center">MODALIDADE</th>';
                    $html .= '<th class="text-center">TIPO</th>';
                    $html .= '<th class="text-center">GARANTIA</th>';
                    $html .= '<th class="text-center">STATUS</th>';
                    $html .= '<th class="text-center">DATA CADASTRO</th>';
                    $html .= '<th class="text-center">DATA ABERTURA</th>';
                    $html .= '<th class="text-center">HORA</th>';
                    $html .= '<th class="text-center">DATA LIMITE</th>';
                    $html .= '<th class="text-center">HORA LIMITE</th>';
                    $html .= '<th class="text-center">PROPOSTA</th>';
                    $html .= '<th class="text-center">OPERADOR</th>';
                    $html .= '<th class="text-center">IDENTIFICADOR</th>';
                    $html .= '<th class="text-center">PORTAL</th>';
                    $html .= '<th class="text-center">DISPUTA</th>';
                    $html .= '<th class="text-center">JUSTIFICATIVA</th>';
                    
                    $html .= '</tr>';
                    
                    foreach($editais as $edital){
                        $conta += 1;
                            $html .= '<tr>';
                                $html .= '<td class="text-center">' .$conta.'</td>';
                                $html .= '<td>'.$edital->getEdtId().'</td>';
                                $html .= '<td>'.$edital->getClienteLicitacao()->getRazaoSocial().'</td>';
                                $html .= '<td>'.$edital->getClienteLicitacao()->getTipoCliente().'</td>';
                                $html .= '<td>'.$edital->getClienteLicitacao()->getEndCidade()->getEstado()->getEstUf().'</td>';
                                $html .= '<td>'.$edital->getEdtNumero().'</td>';
                                $html .= '<td>'.$edital->getInstituicao()->getInst_Nome().'</td>';
                                $html .= '<td>'.$edital->getEdtModalidade().'</td>';
                                $html .= '<td>'.$edital->getEdtTipo().'</td>';
                                $html .= '<td>'.$edital->getEdtGarantia().'</td>';
                                $html .= '<td>'.$edital->getEditalStatus()->getStEdtNome().'</td>';
                                $html .= '<td>'.$edital->getEdtDataCadastro()->format('d/m/Y').'</td>';
                                $html .= '<td>'.$edital->getEdtDataAbertura()->format('d/m/Y').'</td>';
                                $html .= '<td>'.$edital->getEdtHora()->format('H:i').'</td>';
                                $html .= '<td>'.$edital->getEdtDataLimite()->format('Y-m-d').'</td>';
                                $html .= '<td>'.$edital->getEdtHoraLimite()->format('H:i').'</td>';
                                $html .= '<td>'.$edital->getEdtProposta().'</td>';
                                $html .= '<td>'.$edital->getEdtOperador().'</td>';
                                $html .= '<td>'.$edital->getEdtIdentificador().'</td>';
                                $html .= '<td>'.$edital->getEdtPortal().'</td>';
                                $html .= '<td>'.$edital->getDisputa().'</td>';
                                $html .= '<td>'.$edital->getJustificativa().'</td>';
                            $html .= '</tr>';
                        //}
                    }
                    // Configurações header para forçar o download
                    header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
                    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
                    header ("Cache-Control: no-cache, must-revalidate");
                    header ("Pragma: no-cache");
                    header ("Content-type: application/x-msexcel");
                    header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
                    header ("Content-Description: PHP Generated Data" );
                    // Envia o conteúdo do arquivo
                    echo $html;           
                    exit;
                }else{			
                    Sessao::gravaMensagem("Nenhum dado encontrado!");
                }
                ?>
            </body>
        </html>
        <?php		
    }
    public function listar()
    {        
        $editalService              = new EditalService();
        $editalStatusService        = new EditalStatusService();
        $clienteLicitacaoService    = new ClienteLicitacaoService();
        $instituicaoService         = new InstituicaoService();
        $representanteService       = new RepresentanteService();
        $edital                     = new Edital();
        $editalStatus               = new EditalStatus();
        $usuarioService             = new UsuarioService();
        $usuario                    = new Usuario();

        self::setViewParam('listaClientesEdital', $clienteLicitacaoService->listaClientesEdital());
        self::setViewParam('listarOperadorEdital', $editalService->listarOperadorEdital());
        self::setViewParam('listarUsuarios', $usuarioService->listar($usuario));
        
        self::setViewParam('listarEditalStatus', $editalStatusService->listar($editalStatus)); 
        self::setViewParam('listaInstituicoes', $instituicaoService->listar());
        self::setViewParam('listarRepresentantes', $editalService->listarRepresentanteEdital());
        self::setViewParam('listarRepresentantes1', $representanteService->listar());
        
        $this->render('/edital/listar');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
    }
    
    public function listarEditais()
    {
        $edital         = new Edital();
        $editalService  = new EditalService();
        if($_POST){
            $edital->setEdtId($_POST['codigoPesq']);            
            $edital->setEdtCliente($_POST['codClientePesq']); 
            $edital->setEdtOperador($_POST['operadorPesq']);
            $edital->setEdtProposta($_POST['propostaPesq']);
            $edital->setEdtNumero($_POST['numeroLicitacaoPesq']);              
            $edital->setEdtModalidade($_POST['modalidadePesq']);        
            $edital->setEdtStatus($_POST['statusPesq']);        
            $edital->setEdtTipo($_POST['tipoPesq']);  
            $edital->setEdtRepresentante($_POST['codRepresentantePesq']); 
        }
        $editais = $editalService->listarDinamico($edital);        
        $html = "";
        if($editais >=1){
           foreach ($editais as $edital){
            $soma = $edital->getEdtSomar();
            $total += $soma;
            $qtdeEditais += 1;                
            $html .= "  <tr>
                        <td>".$edital->getClienteLicitacao()->getRazaoSocial()."</td>
                        <td>".$edital->getEdtNumero()."</td>
                        <td>".$edital->getInstituicao()->getInst_Nome()."</td>
                        <td>".$edital->getEdtModalidade()."</td>
                        <td>".$edital->getEdtTipo()."</td>
                        <td>".$edital->getEdtGarantia();
                        if ($edital->getEdtGarantia() == "Sim") {                                
            $html.="
                            <a href='http://". APP_HOST."/garantia/cadastro/". $edital->getEdtId()."'>
                            <button type='button' title='Click para adicionar garantia'
                            class='btn btn-outline-dark btn-elevate btn-icon'><i class='la la-edit'></i>
                            </button></a> </td>";
                        }
            $html .="
                            <td>". $edital->getEditalStatus()->getStEdtNome()."</td>
                            <td>". $edital->getEdtDataAbertura()->format('d/m/Y')."</td>
                            <td>". $edital->getEdtHora()->format('H:i')."</td>
                            <td>". $edital->getEdtDataLimite()->format('Y-m-d')."</td>
                            <td>". $edital->getEdtHoraLimite()->format('H:i')."</td>
                            <td>". $edital->getEdtProposta()."</td>
                            <td>
                                <span class='dropdown'>
                                <a class='btn btn-outline-success btn-elevate btn-pill btn-elevate-air'
                                title='clique para fazer novo cadastro' type='button' id='btnEditalVisualizar'
                                data-toggle='modal' data-target='#modal_edital' data-whatever='@getbootstrap'
                                data-codigoedital='". $edital->getEdtId()."' data-codigocliente='". $edital->getClienteLicitacao()->getCodCliente()."'
                                data-nomecliente='". $edital->getClienteLicitacao()->getRazaoSocial()."'
                                data-numeroedital='". $edital->getEdtNumero()."' data-nomeempresa='". $edital->getInstituicao()->getInst_Nome()."'
                                data-empresa='". $edital->getInstituicao()->getInst_id()."' data-modalidadeedital='". $edital->getEdtModalidade()."'
                                data-tipoedital='". $edital->getEdtTipo()."' data-idportal='". $edital->getEdtIdentificador()."'
                                data-portal='". $edital->getEdtPortal()."' data-garantiaedital='". $edital->getEdtGarantia()."'
                                data-codstatusedital='". $edital->getEditalStatus()->getStEdtId()."' data-statusedital='". $edital->getEditalStatus()->getStEdtNome()."'
                                data-dataabertura='". $edital->getEdtDataAbertura()->format('Y-m-d')."' data-horaabertura='". $edital->getEdtHora()->format('H:i')."'
                                data-datalimite='". $edital->getEdtDataLimite()->format('Y-m-d')."' data-horalimite='". $edital->getEdtHoraLimite()->format('H:i')."'
                                data-proposta='". $edital->getEdtProposta()."' data-observacao='". $edital->getEdtObservacao()."'
                                data-analise='". $edital->getEdtAnalise()."' data-operador='". $edital->getEdtOperador()."'
                                data-anexo='". $edital->getEdtAnexo()."' data-idoperador='". $edital->getUsuario()->getId()."'
                                data-codrepresentante='". $edital->getRepresentante()->getCodRepresentante()."'
                                data-nomerepresentante='". $edital->getRepresentante()->getNomeRepresentante()."'
                                ><i class='fa fa-eye fa-2x'></i></a>
                                <a class='btn btn-outline-success btn-elevate btn-pill btn-elevate-air' title='clique para fazer novo cadastro' type='button' id='btnEditalNovo'
                                data-toggle='modal' data-target='#modal_edital' data-whatever='@getbootstrap'><i class='fa fa-plus fa-2x'></i></a>
                                <a href='#' class='btn btn-sm btn-clean btn-icon btn-icon-md'  data-toggle='dropdown' aria-expanded='true'><i class='la la-ellipsis-h'></i></a>
                                <div class='dropdown-menu dropdown-menu-right'>
                                    <a class='dropdown-item' href='http://".  APP_HOST."/public/assets/media/anexos/".  $edital->getEdtAnexo()."'
                                    target='_blank' title='Visualizar Anexo' class='btn btn-info btn-sm'><i class='la la-chain'></i> Anexo</a>
                                </div>
                                </span>
                                    <!--a href='http://".  APP_HOST."/edital/edicao/".  $edital->getEdtId()."' title='Editar' class='btn btn-sm btn-clean btn-icon btn-icon-md'><i class='la la-edit'></i></a-->
                            </td>                                
                            </tr>";
            }
        } else {        
            $html .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>Nenhum Dado Encontrado!</p></h3>";
        }    
           // $html .= "<h3 class='kt-portlet__head-title'><p class='text-info'>Qtde. de Editais " . $qtdeEditais . " e Valor Total R$" . number_format($total, 2, ',', '.') . "</p></h3>";
            echo $html;
    }
    
    private $Assunto;
	private $Email;
	private $Codigo;
    public function enviarEmailTeste()
	{		
        $emailService 				= new EmailService();
        $editalService 				= new EditalService();
        $edital 				    = new Edital();
        $edital->setEdtId($this->Codigo);
      
        $proximosEditais = $editalService->proximosEditais();
        if($proximosEditais){
         //$this->Email = ['andre.almeida@fabmed.com.br'];
          $this->Email = ['gerencia@fabmed.com.br','licitacao@fabmed.com.br', 'elizabeth.carvalho@fabmed.com.br'];
  
                    $html = '';
                    $html .= '<table border="3px groove">';                                     
                    $html .= '<tr>';
                    $html .= '<th class="text-center" colspan="18">Planilha de Editais</th>';
                    $html .= '<tr> <th colspan="3">Finalizados:</th> <th class="text-center"> '.$proximosEditais['Finalizados'][0].'</th> <th colspan="3">Pendentes:</th> <th class="text-center"> '.$proximosEditais['Pendentes'][0].'</th> <th class="text-center" colspan="3">Proximas Licitacoes:</th> <th> '.$proximosEditais['totalLicitacoes'][0].'</td>  </tr>';                         
                    $html .= '</tr>';                    
                    $html .= '<tr>';
                    $html .= '<th class="text-center">ORDEM</th>';
                    $html .= '<th class="text-center">CÓDIGO</th>';
                    $html .= '<th class="text-center">CLIENTE</th>';
                    $html .= '<th class="text-center">NUMERO</th>';
                    $html .= '<th class="text-center">EMPRESA</th>';
                    $html .= '<th class="text-center">MODALIDADE</th>';
                    $html .= '<th class="text-center">TIPO</th>';
                    $html .= '<th class="text-center">GARANTIA</th>';
                    $html .= '<th class="text-center">STATUS</th>';
                    $html .= '<th class="text-center">DATA CADASTRO</th>';
                    $html .= '<th class="text-center">DATA ABERTURA</th>';
                    $html .= '<th class="text-center">HORA</th>';
                    $html .= '<th class="text-center">DATA LIMITE</th>';
                    $html .= '<th class="text-center">HORA LIMITE</th>';
                    $html .= '<th class="text-center">PROPOSTA</th>';
                    $html .= '<th class="text-center">OPERADOR</th>';
                    $html .= '<th class="text-center">IDENTIFICADOR</th>';
                    $html .= '<th class="text-center">PORTAL</th>';
                    $html .= '<th class="text-center">DISPUTA</th>';
                    $html .= '</tr>';
                    $dataBase = date('Y-m-d', strtotime('+3 days'));//data atual mais 3 dias
                   
                    foreach($proximosEditais['Licitacoes'] as $dados){                       
                        $conta += 1;
                        $dataLimite = date('Y-m-d', strtotime($dados["edt_datalimite"]));
                       if($dataBase <= $dataLimite && $dados["stedt_id"] == 1 || $dados["stedt_id"] == 2 || $dados["stedt_id"] == 3)
                       {
                           $teste[] = $dados["edt_id"];
                       }
                        $html .= '<tr>';                            
                            $html .= '<td class="text-center">' .$conta.'</td>';
                            $html .= '<td> <a href=http://' . APP_HOST . '/edital/edicao/'.$dados["edt_id"].' >'.$dados["edt_id"].'</a></td>';
                            $html .= '<td>'.$dados["razaosocial"].'</td>';
                            $html .= '<td>'.$dados["edt_numero"].'</td>';
                            $html .= '<td>'.$dados["inst_nomeFantasia"].'</td>';
                            $html .= '<td>'.$dados["edt_modalidade"].'</td>';
                            $html .= '<td>'.$dados["edt_tipo"].'</td>';
                            $html .= '<td>'.$dados["edt_garantia"].'</td>';
                            $html .= '<td>'.$dados["stedt_nome"].'</td>';
                            $html .= '<td>'.$dados["edt_datacadastro"].'</td>';
                            $html .= '<td>'.$dados["edt_dataabertura"].'</td>';
                            $html .= '<td>'.$dados["edt_hora"].'</td>';
                            $html .= '<td>'.date('d/m/Y', strtotime($dados["edt_datalimite"])).'</td>';
                            $html .= '<td>'.$dados["edt_horalimite"].'</td>';
                            $html .= '<td>'.$dados["edt_proposta"].'</td>';
                            $html .= '<td>'.$dados["edt_operador"].'</td>';
                            $html .= '<td>'.$dados["edt_identificador"].'</td>';
                            $html .= '<td>'.$dados["edt_portal"].'</td>';
                            $html .= '<td>'.$dados["edt_disputa"].'</td>';
                        $html .= '</tr>';  
                    }
            $hora = date('H'); 
            if (  $hora >= 12 &&  $hora <= 17 ) {
                $saudacao = " Boa Tarde!";
            }else if (  $hora  >= 00 &&  $hora  < 12 ){
                $saudacao = " Bom Dia!";
            }else{
                $saudacao = " Boa Noite!";
            } 
            
            $this->Assunto .= "LEMBRETE DE PROCESSOS LICITATORIOS";
            $message = "<h4><p>" .$saudacao.", <br><br>Segue abaixo informações dos processos a acontecer nos proximos 10 dias</p></h4>";
            $message .= "<a title='Click aqui para aletar o registro' href=http://" . APP_HOST . "/edital" . $codigo . " > Click aqui para acessar o sistema</a> <br><br> " . "\r\n";
            $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $html. "</p></h4>";     
       
            if($emailService->envioEmail($this->Email, $this->Assunto, $to = null, $message)){
                 $this->enviarEmail($teste);
                return true;
            }else{
                return false;
            }
        }
    }
    private function enviarEmail($dados)
    {
        $emailService 				= new EmailService();
        $editalService 				= new EditalService();
        $subject = "Lembrete de Edital Pendente";
        foreach($dados as $dado){
            $edital = new Edital();
            $edital->setEdtId($dado);
            $edital = $editalService->listarDinamico($edital)[0];
            $emailService->emailEdital($edital,$email, $subject);
        }
    }
}
