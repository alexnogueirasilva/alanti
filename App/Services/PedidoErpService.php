<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\PedidoDAO;
use App\Models\DAO\PedidoErpDAO;

use App\Models\Validacao\PedidoErpValidador;
use App\Models\Validacao\ResultadoErpValidacao;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\PedidoErp;
use App\Models\Entidades\Edital;
use App\Models\Entidades\ClienteLicitacao;
use App\Services\EmailService;


class PedidoErpService
{
    public function listarPedidoUnico($numPedido)
    {
        $pedidoErpDAO = new PedidoErpDAO();
       return $pedidoErpDAO->listarPedidoUnico($numPedido);
    }
    public function listar(Pedido $pedido)
    {
        $pedidoErpDAO = new PedidoErpDAO();
       return $pedidoErpDAO->listar($pedido);
    }
    public function listarAtendidos(Pedido $pedido)
    {
        $pedidoErpDAO = new PedidoErpDAO();
       return $pedidoErpDAO->listarAtendidos($pedido);
    }
    public function listarStatusPedidoErp()
    {
        $pedidoErpDAO = new PedidoErpDAO();
       return $pedidoErpDAO->listarStatusPedidoErp();
    }
    public function buscarPedido(PedidoErp $pedido)
    {        
        $pedidoErpDAO = new PedidoErpDAO();
       return $pedidoErpDAO->listar($pedido);
       /* $busca = $pedidoErpDAO->listar($pedido);
        $exportar = new Exportar();
        echo $exportar->exportarJSON($busca);*/
    }
    public function salvar(PedidoErp $pedido)
    {        
        
        $transacao = new Transacao();
        $pedidoErpValidador = new PedidoErpValidador();
        $resultadoErpValidacao = $pedidoErpValidador->validar($pedido);
        
        if ($resultadoErpValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoErpValidacao->getErros());            
        } else {            
            try{
                $transacao->beginTransaction();
                $pedidoErpDAO = new PedidoErpDAO();            
                $codPedido = $pedidoErpDAO->salvar($pedido);
                $transacao->commit(); 
               // Sessao::gravaMensagem("cadastro realizado com sucesso!. <br> <br> Codigo: ".$codPedido);
                Sessao::limpaFormulario();
                return $codPedido;
            }catch(\Exception $e){
                $emailService = new EmailService();
                $tela = "Cadastro Pedido - Codigo ".$$codPedido;
                $emailService->emailSuporte($e, $tela);
                //var_dump($e);
                $transacao->rollBack(); 
                Sessao::gravaMensagem(" Erro ao tentar cadastrar. ");
               return false;
            }
        }
    }

    public function editar(Pedido $pedido)
    {   
        $transacao = new Transacao();
        $pedidoErpValidador = new PedidoErpValidador();
        $resultadoErpValidacao = $pedidoErpValidador->validar($pedido);
        
        if ($resultadoErpValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoErpValidacao->getErros());
        } else {
            try{
               $transacao->beginTransaction();
                $pedidoErpDAO = new PedidoErpDAO();            
                
                $pedidoErpDAO->alterar($pedido);
                $transacao->commit(); 
                Sessao::gravaMensagem("cadastro alterado com sucesso!. <br> <br>  Codigo: ".$pedido->getPerpId());
                Sessao::limpaFormulario();
                return true;
            }catch(\Exception $e){
                $emailService = new EmailService();
                $tela = "Alteracao Pedido - Codigo ".$pedido->getPerpId();
                $emailService->emailSuporte($e, $tela);
                $transacao->rollBack(); 
              //var_dump($e);
                Sessao::gravaMensagem("Erro ao tentar alterar. ".$e);
               return false;
            }
        }

    }

    public function excluir(Pedido $pedido)
    {
        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $pedidoErpDAO = new PedidoErpDAO();
                                   
            $pedidoErpDAO->excluir($pedido);
            $transacao->commit();            
            
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Cadastro Excluido com Sucesso!");
            return true;
        } catch (\Exception $e) {
            $emailService = new EmailService();
                $tela = "Exclusao de Pedido - Codigo ".$pedido->getPerpId();
                $emailService->emailSuporte($e, $tela);
                $transacao->rollBack();
            throw new \Exception("Erro ao excluir a cadastro");            
            return false;
        }
    }
}