<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use App\Models\Entidades\Pedido;

class PedidoErpValidador{

    public function validar(Pedido $pedido)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($pedido->getPerpNumero()))
        {
            $resultadoValidacao->addErro('numeroPedido',"Numero do pedido: Este campo não pode ser vazio");
        }               
        if(empty($pedido->getPerpValor()))
        {
            $resultadoValidacao->addErro('valorPedido',"Valor do pedido: Este campo não pode ser vazio");
        }               

        return $resultadoValidacao;
    }
}