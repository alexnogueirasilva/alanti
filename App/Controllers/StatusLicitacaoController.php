<?php


namespace App\Controllers;


use App\Models\DAO\StatusLicitacaoDAO;

class StatusLicitacaoController extends Controller
{
    public function listar($faltaStatus_cod)
    {
        $statusliciatacaoDAO = new StatusLicitacaoDAO();
        self::setViewParam('statusliciatacao', $statusliciatacaoDAO->listar());
    }

}