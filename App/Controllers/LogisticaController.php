<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\Entidades\Logistica;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Transportadora;
use App\Models\Entidades\Representante;
use App\Models\Validacao\LogisticaValidador;
use App\Models\Validacao\PedidoValidador;
use App\Services\LogisticaService;
use App\Services\ClienteLicitacaoService;
use App\Services\PedidoErpService;
use App\Services\PedidoService;
use App\Services\StatusService;
use App\Services\RepresentanteService;
use App\Services\TransportadoraService;
use App\Services\UsuarioService;
use App\Services\EmailService;
use Exception;

class LogisticaController extends Controller
{

    public function index()
    {
        $pedidoService              = new PedidoService();
        $statusService              = new StatusService();
        $pedidoErpService           = new PedidoErpService();
        $pedido                     = new Pedido();
        $representanteService       = new RepresentanteService();
        $logisticaService           = new LogisticaService();
        $usuarioService             = new UsuarioService();
        $usuario                    = new Usuario();
        $logistica                  = new Logistica();
        $clienteLicitacaoService    = new ClienteLicitacaoService();

        if (!empty($_POST)) {
            $pedido->setPerpNumero($_POST['codigoErp']);
             $pedido->setPerpStatus($_POST['codStatus']);
            $pedido->setCodRepresentante($_POST['codRepresentante']);
            $pedido->setCodCliente($_POST['codCliente']);
            $logistica->setCodTransportadora($_POST['codTransportadora']); 
        }

        self::setViewParam('listarStatusPedidoErp', $pedidoErpService->listarStatusPedidoErp());
        self::setViewParam('listarClientesPedidoErp', $clienteLicitacaoService->listarClientesPedidoErp());
        self::setViewParam('listarUsuarios', $usuarioService->listar($usuario));
        self::setViewParam('listarLogistica', $logisticaService->listar($logistica));
        self::setViewParam('listarRepresentantePedidoErp', $representanteService->listarRepresentantePedidoErp());
        self::setViewParam('listarpedidoerp', $pedidoErpService->listarAtendidos($pedido));
                
        $this->render('/logistica/index');       
        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
    }

    public function buscarPedido()
    {
        $pedidoService              = new PedidoService();
        $statusService              = new StatusService();
        $pedidoErpService           = new PedidoErpService();
        $pedido                     = new Pedido();
        $representanteService       = new RepresentanteService();
        $logisticaService           = new LogisticaService();
        $usuarioService             = new UsuarioService();
        $logistica                  = new Logistica();
        $clienteLicitacaoService    = new ClienteLicitacaoService();

        if (!empty($_POST)) {
            $pedido->setPerpNumero($_POST['codigoErp']);
            $pedido->setCodStatus($_POST['codStatus']);
            $pedido->setCodRepresentante($_POST['codRepresentante']);
            $pedido->setCodCliente($_POST['codCliente']);
            $logistica->setCodTransportadora($_POST['codTransportadora']); 
        }

        $pedidos = $pedidoErpService->listarAtendidos($pedido);       
        $html = "";                         

        foreach ($pedidos as $pedido){
        $html .= "
           <tr>
               <td>".$pedido->getPerpNumero()."</td>
               <td>".$pedido->getClienteLicitacao()->getRazaoSocial()."</td>
               <td>".$pedido->getNumeroAF()."</td>
               <td>R$".$pedido->getPerpValor()."</td>
               <td>".$pedido->getStatus()->getNome()."</td>
               <td>".$pedido->getRepresentante()->getNomeRepresentante()."</td>
               <td>".$pedido->getPerpUsuario()->getNome()."</td>
               <td><span class='kt-pulse__ring'><a href='' data-toggle='modal'
                    data-target='#modal_logistica'><button type='button' id='btnModalLogistica'
                    class=' btn btn-elevate btn-danger btn-icon'><i class='fa fa-truck'></i></button></a></span>
               </td>
            </tr>";
               }  
       echo $html;
       
    }

    public function rastreio()
    {
        $pedido                     = new Pedido();
        $representante              = new Representante();
        $transportadoraService      = new TransportadoraService();
        $pedidoService              = new PedidoService();
        $pedidoErpService           = new PedidoErpService();
        $representanteService       = new RepresentanteService();
        $logisticaService           = new LogisticaService();
        $usuarioService             = new UsuarioService();
        $usuario                    = new Usuario();
        $logistica                  = new Logistica();
        $clienteLicitacaoService    = new ClienteLicitacaoService();
        
        if (!empty($_POST)) {            
            $logistica->setLgtId($_POST['idLogistica']);
            $logistica->setLgtNfe($_POST['nfe']);
            $logistica->setCodStatus($_POST['codStatus']);
            $logistica->setCodRepresentante($_POST['codRepresentante']);
            $logistica->setCodCliente($_POST['codCliente']);
            $logistica->setCodTransportadora($_POST['codTransportadora']);
        }

        self::setViewParam('listarClientesLogisticaNfe', $clienteLicitacaoService->listarClientesLogisticaNfe());
        self::setViewParam('listarUsuarios', $usuarioService->listar($usuario));
        self::setViewParam('listarRepresentantesLogisticaNfe', $representanteService->listarRepresentantesLogisticaNfe());
        self::setViewParam('listarTransportadoraLogisticaNfe', $transportadoraService->listarTransportadoraLogisticaNfe());
        self::setViewParam('listarLogisticaNfe', $logisticaService->indexLogistica($logistica));

        $this->render('/logistica/indexLogistica');
        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
    }

    public function autoComplete($params)
    {
        $logistica = new Logistica();
        $logistica->setLgtId($params[0]);
        
        $logisticaService = new LogisticaService();
       // $busca = $logisticaService->autoComplete($logistica);
        
       // echo $busca;
    }

    public function cadastro()
    {
        $logisticaService = new LogisticaService();
        $logistica = new Logistica();
       
        if(Sessao::existeFormulario()) { 
            
            /*$clienteId = Sessao::retornaValorFormulario('cliente');
            $clienteLicitacao = $clienteLicitacaoService->listar($clienteId);
            $logistica->setClienteLicitacao($clienteLicitacao);
            */
            $logistica->setLgtNfe( Sessao::retornaValorFormulario('nfe'));
            $logistica->setFk_StatusLogistica( Sessao::retornaValorFormulario('status'));
            $logistica->setLgtAnexo( Sessao::retornaValorFormulario('anexo'));
            $logistica->setLgtRota( Sessao::retornaValorFormulario('rota'));
            $logistica->setLgtValorCorrigido( Sessao::retornaValorFormulario('valorcorrigido'));
            $logistica->setLgtValorFrete( Sessao::retornaValorFormulario('valorFrete'));
            $logistica->setFk_Operador( Sessao::retornaValorFormulario('operador'));
            $logistica->setFk_Erp( Sessao::retornaValorFormulario('pedidoerp'));
            $logistica->setFk_Cliente( Sessao::retornaValorFormulario('cliente'));
            $logistica->setFk_representante( Sessao::retornaValorFormulario('representante'));            
        }else{
            
            //$logistica->setLgtLogistica(new Logistica());
        }        
       // self::setViewParam('listarRepresentantes', $representanteService->listar());                 
        $this->setViewParam('logistica',$logistica);        
        $this->render('/logistica/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    { 
        $logisticaService           = new LogisticaService();
        $transportadoraService      = new TransportadoraService();
        $transportadora             = new Transportadora();
        $pedidoErpService           = new PedidoErpService(); 
        $pedido                     = new Pedido();       
        $usuarioService             = new UsuarioService();
        $usuario                    = new Usuario();
        $usuario->setId($_SESSION['id']);
         $codTransportadora     = $transportadoraService->listar($transportadora->setTraId($_POST['transportadora']))[0];
         $codPedidoErp          = $pedidoErpService->listar( $pedido->setPerpId($_POST['pedidoerp']))[0];
         $codOperador           = $usuarioService->listar($usuario)[0];

        $logistica = new Logistica();
        
        $logistica->setFk_Pedido($codPedidoErp);
        $logistica->setFk_Transportadora($codTransportadora);
        $logistica->setLgtNfe($_POST['nfe']);
        $logistica->setFk_StatusLogistica($_POST['status']);
        $logistica->setLgtRota($_POST['rota']);
       // $logistica->setLgtAnexo($_FILES['anexoLogistica']['name']);
        $logistica->setLgtValorCorrigido($_POST['valorcorrigido']);
         $logistica->setLgtValorFrete($_POST['valorFrete']);
        $logistica->setLgtInfoValorCorrigido($_POST['infovalorcorrigido']);
        $logistica->setLgtInfoExcluir($_POST['infoexcluir']);
        $logistica->setFk_Operador($codOperador);
        $codigo = $_POST['codigo'];
        $acao = $_POST['acao'];

        $anexo =  $_POST['anexoLogistica'];
        if($anexo == ""){
            $logistica->setLgtAnexo($_POST['anexoLogisticaAlt']);                    
        } else{
            $logistica->setLgtAnexo($_POST['anexoLogistica']);        
        }

        Sessao::gravaFormulario($_POST);
                
        $logisticaValidador   = new LogisticaValidador();
        $resultadoValidacao     = $logisticaValidador->validar($logistica);
        
        if ($resultadoValidacao->getErros()) {
         //   $this->redirect('/logistica/cadastro');
        }
        
        if (!$logistica) {           
          //  $this->redirect('/logistica/cadastro');
            Sessao::gravaMensagem("sem dados informados");
         }
        
         if($acao == 1){ //ACAO ALTERAR
            $logistica->setLgtId($codigo);  
           
            if($logisticaService->atualizar($logistica)){
                echo $codigo;
            }
           
        } else if($acao == 0){//ACAO CADASDATR
                             
            if($codigo = $logisticaService->salvar($logistica)){
                //$pedido->setCodControle($_POST['pedidocontrole']);
                //$pedido->getStatus()->setCodStatus(19);
               // $pedidoService->Editar($pedido);
                echo $codigo;
            }
        } elseif($acao == 2){//ACAO EXCLUIR     
            $logistica->setLgtId($codigo);
            $logistica->setFk_StatusLogistica('EXCLUIDO');
            if($logisticaService->atualizar($logistica)){
                echo $codigo;
            }
        }
      
     /* if($codigo = $logisticaService->salvar($logistica)){
            $logistica->setLgtId($codigo);
            $logistica = $logisticaService->listar($logistica)[0];
            $emailService = new EmailService();
            $subject = 1;   
            echo $codigo;     
            //$emailService->emailLogistica($logistica,$subject);
            
         //   $this->redirect('/logistica');       
        }else{                      
           //$this->redirect('/logistica/cadastro');
        }*/
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function edicao($params)
    {       
        $logisticaService = new LogisticaService();
        $logistica = new Logistica();
       
        if(Sessao::existeFormulario()) { 
            
            /*$clienteId = Sessao::retornaValorFormulario('cliente');
            $clienteLicitacao = $clienteLicitacaoService->listar($clienteId);
            $logistica->setClienteLicitacao($clienteLicitacao);
            */
           
            $logistica->setLgtNfe( Sessao::retornaValorFormulario('nfe'));
            $logistica->setFk_StatusLogistica( Sessao::retornaValorFormulario('status'));
            
        }else{
            
            //$logistica->setLgtLogistica(new Logistica());
        }
        //self::setViewParam('listarRepresentantes', $representanteService->listar());            
        if (!$logistica) {
            Sessao::gravaMensagem("Cadastro inexistente");
           $this->redirect('/logistica');
        }
        $this->setViewParam('logistica', $logistica);
        $this->render('/logistica/editar');
        
        Sessao::limpaMensagem();
    }

    public function atualizar()
    {             
        $logisticaService         = new logisticaService();
       // $clienteLicitacaoService    = new ClienteLicitacaoService();        
        $usuarioService             = new UsuarioService();        
        
        //$clienteLicitacao   = $clienteLicitacaoService->listar($_POST['cliente']);  
        //$usuario            = $usuarioService->listar($_POST['usuario']);
        
        $logistica = new logistica();
        //$logistica->setClienteLicitacao($clienteLicitacao);
        $logistica->setLgtId($_POST['codigo']);        
        $logistica->setLgtNfe($_POST['nfe']);        
         
        $logistica->setLgtValorCorrigido(str_replace(',','.', str_replace(".", "", $_POST['valor'])));
        
        $anexo =  $_POST['anexo'];
        if($anexo == ""){
            $logistica->setLgtAnexo($_POST['anexoAlt']);                    
        } else{
            $logistica->setLgtAnexo($_POST['anexo']);        
        }
        
        Sessao::gravaFormulario($_POST);

        $logisticaValidador = new LogisticaValidador();
        $resultadoValidacao = $logisticaValidador->validar($logistica);
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            Sessao::gravaFormulario($_POST);
            $this->redirect('/logistica/edicao/' . $_POST['codigo']);
            Sessao::gravaMensagem("erro na atualizacao");
        }        
        if ($logisticaService->atualizar($logistica)) {
            $emailService = new EmailService();
            $subject = 2;
            //$emailService->emailLogistica($logistica, $subject);
            $this->redirect('/logistica');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();           
        }else{
            Sessao::gravaFormulario($_POST);            
            $this->redirect('/logistica/edicao/'.$_POST['codigo']);
            Sessao::gravaMensagem("erro na atualizacao");
        }
    }
    

    public function exclusao($params)
    {
        $logistica = new Logistica();
        $logistica->setLgtId($params[0]); 

        $logisticaService = new LogisticaService();

        $logistica = $logisticaService->listar($logistica)[0];

        if (!$logistica) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/logistica');
        }

        self::setViewParam('logistica', $logistica);

        $this->render('/logistica/excluir');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $logistica = new Logistica();
        $logistica->setLgtId($_POST['codigo']);
      
        $logisticaService = new LogisticaService();

        if (!$logisticaService->excluir($logistica)) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/logistica/excluir'.$logistica->getLgtId());
        }

        Sessao::gravaMensagem("Cadastro excluido com sucesso!");

        $this->redirect('/logistica');
    }
    
     private $Assunto;
	private $Email;
    private $Codigo;
    
    public function enviarEmail($params = null)
    {
       $this->Codigo= $params[0];
       $this->Assunto ="Cadastro Logistica";
       $this->Email = ['sac@fabmed.com.br'];
       $this->enviarEmailLogistica();

    }
    private function enviarEmailLogistica()
	{	       
	    $emailService 				= new EmailService();
        
        $logisticaService           = new LogisticaService();
        $logistica                  = new Logistica();    
      
        $logistica->setLgtId($this->Codigo);            
    
        $logistica = $logisticaService->indexLogistica($logistica)[0];        
        $_SESSION['instituicao'] =  $logistica->getFk_Pedido()->getFk_instituicao();
        $dadosCadastro = "
            <table class='table table-striped table-bordered table-hover table-checkable' id='kt_table_3' style='width:50% ' border='3px groove'  >
                    <tr> <td>Codigo</td><td>".$logistica->getLgtId()."</td> </tr>
                    <tr> <td>Cliente</td><td>".$logistica->getFk_Pedido()->getClienteLicitacao()->getRazaoSocial()."</td> </tr>
                    <tr> <td>AF</td><td>".$logistica->getFk_Pedido()->getNumeroAF()."</td> </tr>
                    <tr> <td>Transportadora</td><td>".$logistica->getFk_Transportadora()->GetTraRazaoSocial()."</td> </tr>
                    <tr> <td>NF-e</td><td>".$logistica->getLgtNfe()."</td> </tr>
                    <tr> <td>Valor NFe</td><td>R$".$logistica->getLgtValorCorrigido()."</td> </tr>
                    <tr> <td>Valor Pedido</td><td>R$".$logistica->getFk_Pedido()->getPerpValor()."</td> </tr>
                    <tr> <td>Status</td><td>".$logistica->getFk_StatusLogistica()."</td> </tr>
                    <tr> <td>Represenatnte</td><td>".$logistica->getFk_Pedido()->getRepresentante()->getNomeRepresentante()."</td> </tr>
                    <tr> <td>Operador</td><td>".$logistica->getFk_Operador()->getNome()."</td> </tr>               
                    <tr style='color:red'><td >Justificativa</td><td>".$logistica->getLgtInfoValorCorrigido()."</td></tr>               
                    <tr> <td>Data</td><td>".$logistica->getLgtDataAlteracao()->format('d/m/Y H:i:s')."</td> </tr>               
            </table>";	
       
        $hora = date('H'); 
        if (  $hora >= 12 &&  $hora <= 17 ) {
            $saudacao = " Boa Tarde!";
        }else if (  $hora  >= 00 &&  $hora  < 12 ){
            $saudacao = " Bom Dia!";
        }else{
            $saudacao = " Boa Noite!";
        } 
       $to = $_SESSION['email'];    
       
        $this->Assunto .= " - Codigo: " . $logistica->getLgtId() . "  - Cliente: ".$logistica->getFk_Pedido()->getClienteLicitacao()->getRazaoSocial();
        $message = $saudacao.", <br><br>" .$_SESSION['apelido'].  " Efetuou <p><b><i> ".$this->Assunto. "</b></i></p><br> " . "\r\n";
        //$message .= "<p align='justify widher:80%;'><h3><pre>" . $mensagem. "</pre></h3></p>";
       // $message .= "<a target='_blank' href=http://".APP_HOST."/logistica/visualizar/".$codigo." > Click aqui para visualizar dados do Cliente</a> <br><br>" . "\r\n";            
        $message .= "<b>Dados do Pedido: " .$dadosCadastro. "</b><br><br>";
		if($emailService->envioEmail($this->Email, $this->Assunto, $to, $message)){
			return true;
		}else{
			return false;
		}      
    }
    

}