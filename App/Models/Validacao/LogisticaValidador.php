<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Logistica;

class LogisticaValidador{

    public function validar(Logistica $Logistica)
    {
        $resultadoValidacao = new ResultadoValidacao();

       /* if(empty($logistica->getLgtNfe()))
        {
            $resultadoValidacao->addErro('cidNome',"Nome: Cide campo não pode ser vazio");
        }
        if(empty($logistica->getLgtId()))
        {
            $resultadoValidacao->addErro('estado',"UF: Este campo não pode ser vazio");
        }
        */
        return $resultadoValidacao;
    }
}