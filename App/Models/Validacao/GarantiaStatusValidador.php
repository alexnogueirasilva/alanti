<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\GarantiaStatus;

class GarantiaStatusValidador{

    public function validar(GarantiaStatus $garantiaStatus)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($garantiaStatus->getStGarNome()))
        {
            $resultadoValidacao->addErro('nome',"Nome: Nome campo não pode ser vazio");
        }
        if(empty($garantiaStatus->getStGarInstituicao()))
        {
            $resultadoValidacao->addErro('instituicao',"Instituicao: Este campo não pode ser vazio");
        }
        if(empty($garantiaStatus->getStGarUsuario()))
        {
            $resultadoValidacao->addErro('usuario',"Usuarioo: Este campo não pode ser vazio");
        }
        
        return $resultadoValidacao;
    }
}