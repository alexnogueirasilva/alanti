<?php


namespace App\Models\DAO;

use App\Models\Entidades\StatusLicitacao;


class StatusLicitacaoDAO extends BaseDAO
{

    public function listar()
    {
        $resultado = $this->select(
            'SELECT * FROM statusFalta'
        );

        return $resultado->fetchAll(PDO::FETCH_ASSOC);

    }


}