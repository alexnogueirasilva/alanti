<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\Desenvolvimento;
use App\Models\Entidades\ContatoEmail;
use App\Models\Entidades\EditalStatus;
use App\Services\TesteService;
use App\Models\Validacao\PedidoValidador;
use App\Services\EditalStatusService;
use App\Services\DesenvolvimentoService;
use App\Services\UsuarioService;
use App\Services\EmailService;
use Exception;

class ContatoEmailController extends Controller
{
    private $html;
    
    public function index()
    {        
        $desenvolvimentoService = new DesenvolvimentoService();
        $usuarioService         = new UsuarioService();
        $desenvolvimento        = new Desenvolvimento();
        
        if($_POST){
           // $desenvolvimento->setDesId($_POST['codigo']);
           // $desenvolvimento->setDesStatus($_POST['status']);
           // $desenvolvimento->setDesCodUsuario($_POST['usuario']);
        }
        
        self::setViewParam('listaUsuarios', $usuarioService->listar());
        self::setViewParam('listarDesenvolvimentos', $desenvolvimentoService->listar($desenvolvimento));
        
        $this->render('/contato/contato');
        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
    }

    public function contato()
    {
        $contatoEmail = new ContatoEmail();
        if(Sessao::existeFormulario()) 
        {
            $contatoEmail->setCnteEmail(Sessao::retornaValorFormulario('email')); 
            $contatoEmail->setCnteAssunto(Sessao::retornaValorFormulario('assunto')); 
            $contatoEmail->setCnteMensagem(Sessao::retornaValorFormulario('mensagem')); 
            $contatoEmail->setCnteNome(Sessao::retornaValorFormulario('contato')); 
        }

        $this->render('/contato/contato');
    }
    
    public function enviarEmail()
    {
        $contatoEmail = new ContatoEmail();
        $emailService = new EmailService();
        $contatoEmail->setCnteNome($_POST['contato']);
        $contatoEmail->setCnteEmail($_POST['email']);
        $contatoEmail->setCnteAssunto($_POST['assunto']);
        $contatoEmail->setCnteMensagem($_POST['mensagem']);
        Sessao::gravaFormulario($_POST);
        
        if($emailService->emailContato($contatoEmail)){
            Sessao::gravaMensagem('Email enviado com sucesso');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();    
        }else{
            Sessao::gravaErro('Erro ao enviar Email');
        }
        
        $this->redirect('/ContatoEmail/contato');
    }

    public function cadastro()
    {
        $pedido = new Pedido();
        $teste = new Teste();
        $statusDAO = new StatusDAO();
        self::setViewParam('listaStatus', $statusDAO->listar());
        $testeDAO = new ClienteDAO();
        self::setViewParam('listaClientes', $testeDAO->listar());
        $representanteDAO = new RepresentanteDAO();
        self::setViewParam('listaRepresentantes', $representanteDAO->listar());

        $id = Sessao::retornaValorFormulario('clientes');
            
        if(empty($id)) {
            $teste->setClientes(array());    
        } else {
            $testeService = new testeService(); 
            $id = $testeService->listaClientes($id);
            $teste->setClientes($id); 
        }

        $idCliente = Sessao::retornaValorFormulario('clientes');
        $testeDAO1 = new TesteDAO();
        $cliente = $testeDAO1->listar($idCliente)[0];
        $pedido->getCliente($cliente);       

        $this->setViewParam('teste',$teste);
        $this->render('/desenvolvimento/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
    }
    public function salvar()
    {
        $pedido = new Pedido();

        $pedido->setDataCadastro($_POST['dataCadastro']);
        //date_format($date, 'Y-m-d H:i:s');
        $pedido->setNumeroLicitacao($_POST['numeroPregao']);
        $pedido->setNumeroAf($_POST['numeroAf']);
        $pedido->setValorPedido($_POST['valorPedido']);
        $pedido->setCodStatus($_POST['codStatus']);
        $pedido->setCodCliente($_POST['codCliente']);
        $pedido->setAnexo($_POST['anexo']);
        $pedido->setObservacao($_POST['observacao']);
        $pedido->setCodRepresentante($_POST['codRepresentante']);
        $pedido->setFk_Instituicao($_POST['fk_instituicao']);
        $pedido->setDataFechamento($_POST['dataFechamento']);
        $pedido->setDataAlteracao($_POST['dataAlteracao']);

        Sessao::gravaFormulario($_POST);

        $pedidoDAO = new PedidoDAO();

        if ($pedidoDAO->salvar($pedido)) {

            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();
        //    $this->redirect('/pedido');
        } else {
            Sessao::gravaMensagem("Erro ao gravar");
        }
    }
    public function edicao($params)
    {
        $editalStatus = new EditalStatus();
        $codigo = $editalStatus->setStEdtId($params[0]);
        
        if (!$codigo) {
            Sessao::gravaMensagem("Nenhum Cadastro Selecionado");
            $this->redirect('/desenvolvimento');
        }
        $editalStatusService = new EditalStatusService();

        $pedido = $editalStatusService->listar($codigo);

        if (!$pedido) {
            Sessao::gravaMensagem("Pedido inexistente");
            $this->redirect('/pedido');
        }

        $testeDAO = new TesteDAO();
        self::setViewParam('listaClientes', $testeDAO->listar());
        $statusDAO = new StatusDAO();
        self::setViewParam('listaStatus', $statusDAO->listar());
        $representanteDAO = new RepresentanteDAO();
        self::setViewParam('listaRepresentantes', $representanteDAO->listar());

        self::setViewParam('editalStatus', $editalStatus);
        
       // $this->render('/pedido/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $pedido = new Pedido();
        //$pedido->setDataCadastro($_POST['dataCadastro']);
        //date_format($date, 'Y-m-d H:i:s');
        $pedido->setCodControle($_POST['codControle']);
        $pedido->setNumeroLicitacao($_POST['numeroPregao']);
        $pedido->setNumeroAf($_POST['numeroAf']);
        //$pedido->setValorPedido(number_format($_POST['valorPedido'], 2, ',', '.'));
        $pedido->setValorPedido($_POST['valorPedido']);
        $pedido->setCodStatus($_POST['codStatus']);
        $pedido->setCodCliente($_POST['codCliente']);
        $pedido->setAnexo($_POST['anexo']);
        $pedido->setObservacao($_POST['observacao']);
        $pedido->setCodRepresentante($_POST['codRepresentante']);
        $pedido->setFk_Instituicao($_POST['fk_instituicao']);
        $pedido->setDataFechamento($_POST['dataFechamento']);
        $pedido->setDataAlteracao($_POST['dataAlteracao']);

        Sessao::gravaFormulario($_POST);
        $pedidoValidador = new PedidoValidador();
        $resultadoValidacao = $pedidoValidador->validar($pedido);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/pedido/edicao/' . $_POST['codControle']);
        }

        $pedidoDAO = new PedidoDAO();


        $pedidoDAO->atualizar($pedido);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/pedido');
    }

    public function exclusao($params)
    {

        $id = $params[0];

        $pedidoDAO = new PedidoDAO();

        $pedido = $pedidoDAO->listar($id);

        if (!$pedido) {
            Sessao::gravaMensagem("pedido inexistente");
            $this->redirect('/pedido');
        }

        self::setViewParam('pedido', $pedido);
        $this->render('/pedido/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $pedido = new Pedido();
        $pedido->setCodControle($_POST['codControle']);

        $pedidoDAO = new PedidoDAO();

        if (!$pedidoDAO->excluir($pedido)) {
            Sessao::gravaMensagem("pedido inexistente");
            $this->redirect('/pedido');
        }

        Sessao::gravaMensagem("pedido excluido com sucesso!");

        $this->redirect('/pedido');
    }
}