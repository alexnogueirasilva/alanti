<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\PedidoDAO;
use App\Models\DAO\StatusDAO;
use App\Models\DAO\RepresentanteDAO;
use App\Services\RepresentanteService;
use App\Services\ClienteLicitacaoService;
use App\Services\EmailService;
use App\Services\InstituicaoService;
use App\Services\UsuarioService;
use App\Services\PedidoService;
use App\Services\StatusService;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Representante;
use App\Models\Entidades\ClienteLicitacao;

class EmailController extends Controller
{

    public function emailPedido()
    {   
        $pedido = new Pedido();
        $pedidoService = new PedidoService();
        $pedido->setCodControle($_POST['codControle']);
        $pedido = $pedidoService->listar($pedido)[0];   
        $mensagem = $_POST['mensagem'];
        $email = $_POST['email'];               
        $emailService = new EmailService();
        $subject = 3;
    $emailService->email($pedido,$email, $subject, $mensagem);
        Sessao::gravaMensagem("Email enviado com sucesso!");
        $this->redirect('/pedido');   
   /* }else {
        Sessao::gravaMensagem("Error no envio do Email!");
       $this->redirect('/pedido/visualisar/' . $_POST['codControle']);
    }*/
    Sessao::limpaMensagem();  
    }


}