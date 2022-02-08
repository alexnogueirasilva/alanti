<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Services\UsuarioService;
use App\Services\EditalService;
use App\Services\LogisticaService;
use App\Services\PedidoService;
use App\Services\SugestoesService;
use App\Services\ContratoService;
use App\Services\ClienteLicitacaoService;

class HomeController extends Controller
{
    public function index()
    {
        $this->render('/home/index');
       Sessao::limpaMensagem();
       Sessao::limpaErro();
       Sessao::limpaFormulario();
    }
    public function dashboard()
    {
       $Usuarios    = new UsuarioService();
       $Editais     = new EditalService();
       $Pedidos     = new PedidoService();
       $Sugestoes   = new SugestoesService();
       $Logistica   = new LogisticaService();
       $contrato    = new ContratoService();
       $clientes    = new ClienteLicitacaoService();

        $this->Dados = $clientes->qtdeClientes();
       self::setViewParam('ContratosAtivos', $contrato->qtdeContratoPorEdital());
        self::setViewParam('ContratosVencidos', $contrato->qtdeContratoVencido());
       self::setViewParam('UsuariosAtivos', $Usuarios->usuariosAtivos());
       self::setViewParam('UsuariosInativos', $Usuarios->usuariosInativos());
       self::setViewParam('EditaisPendentes', $Editais->editaisPendentes());
       self::setViewParam('EditaisFinalizados', $Editais->editaisFinalizados());
       self::setViewParam('PedidosAutorizados', $Pedidos->pedidosAutorizados());
       self::setViewParam('PedidoNaoAutorizados', $Pedidos->pedidoNaoAutorizados());
       self::setViewParam('SugestoesResolvidas', $Sugestoes->sugestoesResolvidas());
       self::setViewParam('SugestoesPendentes', $Sugestoes->sugestoesPendentes());
       self::setViewParam('Entregues', $Logistica->entregues());
       self::setViewParam('Pendentes', $Logistica->pendentes());

       $contrato->sicronizar();
       $this->render('/home/dashboard');
       Sessao::limpaMensagem();
       Sessao::limpaErro();
       Sessao::limpaFormulario();
    }
}