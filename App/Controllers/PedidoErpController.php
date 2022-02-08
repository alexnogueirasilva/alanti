<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\PedidoErpDAO;
use App\Services\PedidoService;
use App\Services\PedidoErpService;
use App\Services\InstituicaoService;
use App\Services\UsuarioService;
use App\Services\StatusService;
use App\Services\EmailService;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\PedidoErp;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Representante;
use App\Models\Entidades\ClienteLicitacao;
use App\Models\Entidades\Teste;
use App\Models\Validacao\PedidoValidador;

class PedidoErpController extends Controller
{
    public function listarPorPedido($params)
    {
        $codigo = $params[0];
        $pedido = new Pedido();
        $pedidoErpService = new PedidoErpService();

        $pedido->setPerpCodControle($codigo);
        $pedido = $pedidoErpService->buscarPedido($pedido);
        self::setViewParam('listarPedidosErp', $pedido);
        $this->render('/pedidoerp/index');
        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
    }

    public function buscarPedido($params)
    {        
        $pedido = new Pedido();
        if($_POST['codControle']){

            $pedido->setPerpCodControle($_POST['codControle']);
            $pedidoErpService = new PedidoErpService();
            $pedido = $pedidoErpService->buscarPedido($pedido);
        }                
        $html = "";
        $soma = 0;
        $qtdePedido = 0;
        if ($pedido >= 1) {          
             
        foreach ($pedido as $dado){    
            $soma = $dado->getPerpValor();
            $total += $soma;
            $qtdePedido += 1;

            $html .= "<tr>                    
                        <td>".$dado->getPerpNumero()."</td>
                        <td>R$".$dado->getPerpValor()."</td>
                        <td>".$dado->getPerpStatus()."</td>
                        <td>".$dado->getPerpDataCadastro()->format('d/m/Y H:m:s')."</td>
                        <td><i>".$dado->getPerpUsuario()->getNome()."</i></td>
                        <td>
                            <span class='dropdown'>
                                    <a href='#' class='btn btn-sm btn-clean btn-icon btn-icon-md' data-toggle='dropdown' title='click aqui para exibir as acoes' aria-expanded='true'><i class='la la-ellipsis-h'></i></a>
                                    <div class='dropdown-menu dropdown-menu-right'>
                                        <a class='dropdown-item' type='button' id='btnEdtiarPedido' href='http://". APP_HOST."/pedido/edicao/". $dado->getPerpId()."' title='Alterar pedido' class='btn btn-info btn-sm'><i class='la la-edit'></i> Alterar</a>
                                        <a class='dropdown-item' href='http://". APP_HOST."/pedido/exclusao/". $dado->getPerpId()."' title='Excluir' class='btn btn-info btn-sm'><i class='la la-trash'></i> Excluir</a>
                                        <a class='dropdown-item' href='http://". APP_HOST."/pedido/edicao/". $dado->getPerpId()."' title='Alterar Status' class='btn btn-info btn-sm'><i class='la la-leaf'></i> Status</a>
								    </div>
							</span>
                            <a type='button' id='btnEditarPedidoErp' name='btnEditarPedidoErp' data-perpstatus='".$dado->getPerpStatus()."' data-perpvalor='".$dado->getPerpValor()."' data-perpnumero='".$dado->getPerpNumero()."' data-perpid='".$dado->getPerpId()."'  title='Editar' class='btn btn-sm btn-clean btn-icon btn-icon-md'><i class='la la-edit'></i></a>
                                                         
                            <a id='btnExluirPedidoErp' name='btnExluirPedidoErp' data-perpvalor='".$dado->getPerpValor()."' data-perpnumero='".$dado->getPerpNumero()."' data-perpid='".$dado->getPerpId()."'  title='Excluir' class='btn btn-sm btn-clean btn-icon btn-icon-md'>
                            
                            <i class='la la-trash'></i></a>
                        </td>
                    </tr>";
        }
       } else {
        echo "<h3 class='kt-portlet__head-title'><p class='text-danger'>Sem Dados Encontrados!</p></h3>";
       }
       echo $html;
    }
    
    public function salvar()
    {        
        $pedido = new Pedido();
        $pedidoErpService = new PedidoErpService();
        $pedidoUnico = $pedidoErpService->listarPedidoUnico($_POST['numeroPedido'])[0];
        if(!$pedidoUnico){
            $pedido->setPerpNumero($_POST['numeroPedido']);
            $pedido->setPerpStatus($_POST['statusPedido']);
            $pedido->setPerpValor($_POST['valorPedido']);
            $pedido->setPerpCodControle($_POST['codControle']);        
            $pedido->setPerpUsuario($_POST['usuario']);
            $codigo = $_POST['codigo']; 
    
            if($codigo > 0){
                $pedido->setPerpId($codigo);  
                $pedidoErpService->editar($pedido);
               echo $codigo;
            } else{
                $codigo = $pedidoErpService->salvar($pedido);
               echo $codigo;
            }
        }else{
            echo "Este pedido ja existe! Numero: ". $_POST['numeroPedido'];
        }
       
    }

    public function excluir()
    {
        $pedido = new Pedido();
         
        $pedido->setPerpId($_POST['codigo']);  
        $codigo = $_POST['codigo'];
        $pedido->setPerpStatus($_POST['statusPedido']);
        $pedidoErpService = new PedidoErpService();
          
        if (!$pedidoErpService->excluir($pedido)) {
            Sessao::gravaMensagem("pedido inexistente");
            //$this->redirect('/pedidoerp');
        }
        
       // Sessao::gravaMensagem("pedido excluido com sucesso!");
        
        echo $codigo;
       // $this->redirect('/pedidoerp');
    }    
}