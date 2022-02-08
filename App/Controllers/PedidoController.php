<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\StatusDAO;
use App\Models\DAO\RepresentanteDAO;
use App\Services\RepresentanteService;
use App\Services\ClienteLicitacaoService;
use App\Services\PedidoService;
use App\Services\PedidoErpService;
use App\Services\InstituicaoService;
use App\Services\UsuarioService;
use App\Services\StatusService;
use App\Services\EmailService;
use App\Models\Entidades\Edital;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Representante;
use App\Models\Entidades\ClienteLicitacao;
use App\Models\Validacao\PedidoValidador;
use App\Models\Entidades\Status;

class PedidoController extends Controller
{

    public function index()
    {
        $pedido = new Pedido();
        $clienteLicitacao = new ClienteLicitacao();
        if($_POST){
            $pedido->setCodControle($_POST['codControle']);
            $pedido->setCodRepresentante($_POST['representante']);
            $pedido->setCodCliente($_POST['cliente']);
             $pedido->setNomeFantasia($_POST['nomeFantasiaPesq']);
            //$pedido->setCodUsuario($_POST['usuario']); 
            $pedido->setCodStatus($_POST['status']);
            $pedido->setNumeroAF($_POST['numeroAf']);       
            $pedido->setNumeroLicitacao($_POST['numeroLicitacao']);
           // $pedido->setTipoCliente($_POST['tipo']);
            $pedido->setTipoCliente( $_POST['tipo']);
            $pedido->setPerpId($_POST['perpid']);
         }

        $pedidoService = new PedidoService();
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $representanteService = new RepresentanteService();
        $statusService = new StatusService();
        self::setViewParam('listaStatus', $statusService->listar());
        self::setViewParam('listarPedidos', $pedidoService->listar($pedido));
        self::setViewParam('listaClientesPedido', $clienteLicitacaoService->listaClientesPedido());
        self::setViewParam('listaTipoClientes', $clienteLicitacaoService->listaTipoCliente($clienteLicitacao));
        self::setViewParam('listarRepresentantes', $representanteService->listar());
               
        $this->render('/pedido/index');
        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
    }
    
    public function visualisar($params)
    {
            $codControle = $params[0];
            
            $pedido = new Pedido();
            $pedidoService           = new PedidoService();
            $usuarioService          = new UsuarioService();
            $statusService           = new StatusService();
            $instituicaoService      = new InstituicaoService();
            $clienteLicitacaoService = new ClienteLicitacaoService();        
            $representanteService    = new RepresentanteService();

            $pedido->setCodControle($codControle);
            $pedido = $pedidoService->listar($pedido)[0];
            self::setViewParam('listaStatus', $statusService->listar());
            self::setViewParam('listaRepresentantes', $representanteService->listar());
    
        if (!$pedido) {
            Sessao::gravaMensagem("Pedido inexistente");
            $this->redirect('/pedido');
        }
        self::setViewParam('pedido', $pedido);
        $this->render('/pedido/visualisar');
        Sessao::limpaMensagem();
    }

    public function teste()
    {        
        $this->render('/pedido/teste');

        Sessao::limpaMensagem();
    }

    public function pesquisa()
    {

        $statusDAO = new StatusDAO();
        self::setViewParam('listaStatus', $statusDAO->listar());


        $representanteDAO = new RepresentanteDAO();
        self::setViewParam('listaRepresentantes', $representanteDAO->listar());

        $pedido = new Pedido();
        $pedido->setCodStatus($_POST['codStatus']);
        $pedido->setNumeroAF($_POST['numeroAf']);
        $pedido->setNumeroLicitacao($_POST['numeroLicitacao']);
        $pedido->setCodControle($_POST['codControle']);
        $pedido->setCodCliente($_POST['codCliente']);

        $pedidoDAO = new PedidoDAO();

        self::setViewParam('listaPedido', $pedidoDAO->listarTeste($pedido));
        if ($pedidoDAO->listarTeste($pedido) == false) {
            Sessao::gravaMensagem("Nenhum Cadastro Localizado!");
        }
        $this->render('/pedido/teste');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
    }

    public function cadastro()
    {
        $pedido                     = new Pedido();
        $statusDAO                  = new StatusDAO();
        $clienteLicitacaoService    = new ClienteLicitacaoService();
         $clienteLicitacao           = new ClienteLicitacao();
        $instituicaoService         = new InstituicaoService();
        $representanteService       = new RepresentanteService();        
        $usuarioService             = new UsuarioService();        
        $usuario                    = new Usuario();        
        self::setViewParam('listaStatus', $statusDAO->listar());        
        self::setViewParam('listarInstituicoes', $instituicaoService->listar());
        self::setViewParam('listarUsuarios', $usuarioService->listar($usuario));
        if(Sessao::existeFormulario()) {
           $clienteLicitacao->setCodCliente(Sessao::retornaValorFormulario('cliente'));
            $clienteLicitacao = $clienteLicitacaoService->listar($clienteLicitacao)[0];
            $pedido->setClienteLicitacao($clienteLicitacao);
            
            $representanteId = Sessao::retornaValorFormulario('representante');
            $representante = $representanteService->listar($representanteId)[0];
            $pedido->setRepresentante($representante);     
            
            $usuarioId = Sessao::retornaValorFormulario('usuario');
            $usuario = $usuarioService->listar($usuarioId);
            $pedido->setUsuario($usuario);     
            
            $pedido->setDataCadastro(Sessao::retornaValorFormulario('dataCadastro'));            
            $pedido->setNumeroLicitacao(Sessao::retornaValorFormulario('numeroPregao'));
            $pedido->setNumeroAf(Sessao::retornaValorFormulario('numeroAf'));
            $pedido->setValorPedido(Sessao::retornaValorFormulario('valorPedido'));
            $pedido->setCodStatus(Sessao::retornaValorFormulario('codStatus'));
            $pedido->setCodCliente(Sessao::retornaValorFormulario('codCliente'));
            $pedido->setAnexo(Sessao::retornaValorFormulario('anexo'));
            $pedido->setObservacao(Sessao::retornaValorFormulario('observacao'));
            $pedido->setCodRepresentante(Sessao::retornaValorFormulario('representante'));
            $institutoId = Sessao::retornaValorFormulario('codInstituicao');
            $instituicao = $instituicaoService->listar($institutoId);
            $pedido->setInstituicao($instituicao);  
            $pedido->setDataFechamento(Sessao::retornaValorFormulario('dataFechamento'));
            $pedido->setDataAlteracao(Sessao::retornaValorFormulario('dataAlteracao'));

        }else{
            self::setViewParam('listarRepresentantes', $representanteService->listar()); 
            $pedido->setClienteLicitacao(new ClienteLicitacao());
            $pedido->setRepresentante(new Representante());
        }
        $this->setViewParam('pedido',$pedido); 
        $this->render('/pedido/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $clienteLicitacaoService  = new ClienteLicitacaoService();  
         $clienteLicitacao        = new ClienteLicitacao();
        $usuarioService           = new UsuarioService();        
        $usuario                  = new Usuario();        
        $representanteService     = new RepresentanteService();        
        $instituicaoService       = new InstituicaoService();
        $statusService            = new StatusService();
        $status                   = new Status();  
        $pedido                   = new Pedido();
        $pedidoService            = new PedidoService();
        $usuario->setId($_POST['usuario']);
       
         $clienteLicitacao->setCodCliente($_POST['cliente']);
        $clienteLicitacao         = $clienteLicitacaoService->listar($clienteLicitacao)[0];
        $usuario                  = $usuarioService->listar($usuario)[0];
        $instituicao              = $instituicaoService->listar($_POST['codInstituicao']);
        $representante            = $representanteService->listar($_POST['representante'])[0];
        $status                   = $statusService->listar($_POST['codStatus']);        

        $pedido->setDataCadastro($_POST['dataCadastro']);
        $pedido->setNumeroLicitacao($_POST['numeroPregao']);
        $pedido->setNumeroAf($_POST['numeroAf']);
        $pedido->setValorPedido($_POST['valorPedido']);
        $pedido->setStatus($status);
        $pedido->setAnexo($_POST['anexo']);
        $pedido->setObservacao($_POST['observacao']);
        $pedido->setDataFechamento($_POST['dataFechamento']);
        $pedido->setDataAlteracao($_POST['dataAlteracao']);
        $pedido->setInstituicao($instituicao);
        $pedido->setRepresentante($representante);
        $pedido->setUsuario($usuario);
        $pedido->setClienteLicitacao($clienteLicitacao);

        Sessao::gravaFormulario($_POST);
    
        if ( $codPedido  = $pedidoService->salvar($pedido)) {
             if(isset($_POST['enviarEmail'])){  
                $pedido->setCodControle($codPedido);
                $pedido = $pedidoService->listar($pedido)[0];
                $email = $_POST['emails'];
                $emailService = new EmailService();
                $subject = 1;
                $emailService->email($pedido, $email,$subject);
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
        $codControle = $params[0];     

        $pedido = new Pedido();
        $pedido->setCodControle($codControle);
        $pedidoService           = new PedidoService();
        $usuarioService          = new UsuarioService();
        $usuario                 = new Usuario();
        $statusService           = new StatusService();
        $instituicaoService      = new InstituicaoService();
        $clienteLicitacaoService = new ClienteLicitacaoService();        
        $clienteLicitacao        = new ClienteLicitacao();        
        $representanteService    = new RepresentanteService();
        
        $pedidoErpService = new PedidoErpService();

        $pedido->setPerpCodControle($codControle);
        $pedidoErp = $pedidoErpService->buscarPedido($pedido);
        self::setViewParam('listarPedidosErp', $pedidoErp);
        
        self::setViewParam('listaStatus', $statusService->listar());
        self::setViewParam('listarUsuarios', $usuarioService->listar($usuario));
        self::setViewParam('listaRepresentantes', $representanteService->listar());
        self::setViewParam('listarInstituicoes', $instituicaoService->listar());
    
        if(Sessao::existeFormulario()) {
            $clienteLicitacao->setCodCliente(Sessao::retornaValorFormulario('cliente'));
            $clienteLicitacao = $clienteLicitacaoService->listar($clienteLicitacao)[0];
            $pedido->setClienteLicitacao($clienteLicitacao);
            
            $representanteId = Sessao::retornaValorFormulario('representante');
            $representante = $representanteService->listar($representanteId)[0];
            $pedido->setRepresentante($representante);     
            
            $usuario->setId(Sessao::retornaValorFormulario('usuario'));
            $usuario = $usuarioService->listar($usuario)[0];
            $pedido->setUsuario($usuario);  
            
            $statusId = Sessao::retornaValorFormulario('codStatus');
            $status = $statusService->listar($statusId);
            $pedido->setStatus($status);  
            
            $institutoId = Sessao::retornaValorFormulario('codInstituicao');
            $instituicao = $instituicaoService->listar($institutoId);
            $pedido->setInstituicao($instituicao);  
            
            $pedido->setCodControle(Sessao::retornaValorFormulario('codControle'));                      
            $pedido->setNumeroLicitacao(Sessao::retornaValorFormulario('numeroPregao'));
            $pedido->setNumeroAf(Sessao::retornaValorFormulario('numeroAf'));
            $pedido->setValorPedido(Sessao::retornaValorFormulario('valorPedido'));
            $pedido->setCodStatus(Sessao::retornaValorFormulario('codStatus'));
            $pedido->setCodCliente(Sessao::retornaValorFormulario('codCliente'));
            $pedido->setValorPedido(Sessao::retornaValorFormulario('valorPedido'));
            $pedido->setAnexo(Sessao::retornaValorFormulario('anexo'));
            $pedido->setObservacao(Sessao::retornaValorFormulario('observacao'));
        }else{
            $pedido = $pedidoService->listar($pedido)[0];
        }
        if (!$pedido) {
            Sessao::gravaMensagem("Pedido inexistente");
            $this->redirect('/pedido');
        }
        self::setViewParam('pedido', $pedido);
       $this->render('/pedido/editar');
        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $pedido                     = new Pedido();
        $pedidoService              = new PedidoService();
        $pedidoErpService           = new PedidoErpService();
        $clienteLicitacaoService    = new ClienteLicitacaoService();        
        $clienteLicitacao           = new ClienteLicitacao();        
        $usuarioService             = new UsuarioService();        
        $usuario                    = new Usuario();        
        $statusService              = new StatusService();
       $status                   = new Status();  
        $representanteService       = new RepresentanteService();        
        $instituicaoService         = new InstituicaoService();
        $clienteLicitacao->setCodCliente($_POST['cliente']);
        $clienteLicitacao           = $clienteLicitacaoService->listar($clienteLicitacao)[0];
        $pedidoErp                  = $pedidoErpService->listar($pedido->setPerpCodControle($_POST['codControle']));
        $usuario->setId($_POST['usuario']);
        $usuario                    = $usuarioService->listar($usuario)[0];
        $instituicao                = $instituicaoService->listar($_POST['codInstituicao']);
        $representante              = $representanteService->listar($_POST['representante'])[0];
        $status                     = $statusService->listar($_POST['codStatus']);
    
        $pedido->setCodControle($_POST['codControle']);
        $pedido->setNumeroLicitacao($_POST['numeroPregao']);
        $pedido->setNumeroAf($_POST['numeroAf']);
        $pedido->setUsuario($usuario);
        $pedido->setStatus($status);
        $pedido->setValorPedido($_POST['valorPedido']);
        $pedido->setClienteLicitacao($clienteLicitacao);            
        $pedido->setObservacao($_POST['observacao']);
        $pedido->setRepresentante($representante);
        $pedido->setInstituicao($instituicao);
        $pedido->setDataFechamento($_POST['dataFechamento']);
        $pedido->setDataAlteracao($_POST['dataAlteracao']);
        $pedido->setDataAlteracao($_POST['dataAlteracao']);        
        $anexo =  $_POST['anexo'];
        if($anexo == ""){
            $pedido->setAnexo($_POST['anexoAlt']);                    
        } else{
            $pedido->setAnexo($_POST['anexo']);        
        }
        Sessao::gravaFormulario($_POST);
        $pedidoValidador = new PedidoValidador();
        $resultadoValidacao = $pedidoValidador->validar($pedido);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
           $this->redirect('/pedido/edicao/' . $_POST['codControle']);
        }

        if($status->getCodStatus() == 16 || $status->getCodStatus() == 17){
            if(!$pedidoErp){
                Sessao::gravaMensagem(" Numero do Pedido é Obrigatorio Para Pedidos Atendidos");
                $this->redirect('/pedido/edicao/' . $_POST['codControle']);                  
            }
        } else {
            if($pedidoErp){                
                    Sessao::gravaMensagem(" Este Status não pode ser usado para Pedido Atendidos ou Parcialmente Atendido");
                    $this->redirect('/pedido/edicao/' . $_POST['codControle']);                 
            }
        }
        
        if ($pedidoService->Editar($pedido)) {
             if(isset($_POST['enviarEmail'])){ 
                 
                $pedido->setCodControle($_POST['codControle']);
                $pedido = $pedidoService->listar($pedido)[0];  
            
                $email = $_POST['emails'];
                $emailService = new EmailService();
                $subject = 2;
                $emailService->email($pedido, $email,$subject);
            }
            $this->redirect('/pedido');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();           
        }else{
            Sessao::gravaFormulario($_POST);            
            Sessao::gravaMensagem("erro na atualizacao");
            $this->redirect('/pedido/edicao/' . $_POST['codControle']);
        }
    }

    public function exclusao($params)
    {
        $codControle        = $params[0];        
        $pedido             = new Pedido();        
        $pedidoService      = new PedidoService();
        $pedidoErpService   = new PedidoErpService();        
        
        $pedido->setCodControle($codControle);
        $pedido     = $pedidoService->listar($pedido)[0];
    
        if (!$pedido) {
            Sessao::gravaMensagem("Cadastro inexistente!");
            $this->redirect('/pedido');
        }
        if($pedidoErp = $pedidoErpService->listar($pedido->setPerpCodControle($codControle))){                     
         
            self::setViewParam('pedidoerp', $pedidoErp);               
        }else{
            $pedidoErp = "";               
            self::setViewParam('pedidoerp', $pedidoErp);
        }
        self::setViewParam('pedido', $pedido);
       $this->render('/pedido/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {

        $pedido         = new Pedido();
        $pedidoService  = new PedidoService();
        $codigo = $_POST['codControle'];
        $pedido->setCodControle($codigo);

        if (!$pedidoService->excluir($pedido)) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/pedido');
        }
        Sessao::gravaMensagem("Cadastro excluido com sucesso!<br><br> ".$codigo);

        $this->redirect('/pedido');
        Sessao::limpaMensagem();
    }    

    public function hometeste()
    {
        $this->render('/pedido/hometeste');
    }
    public function excel()
    {
        Sessao::gravaMensagem('EXCEL - Em Desenvolvimento!'); 
        $this->redirect('/pedido/index');
    }
    public function pdf()
    {
        Sessao::gravaMensagem('PDF - Em Desenvolvimento!'); 
        $this->redirect('/pedido/index');
    }
}
