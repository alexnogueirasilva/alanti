<?php


namespace App\Services;

use App\Lib\Conexao;
use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Models\DAO\GarantiaDAO;
use App\Models\Entidades\Garantia;
use App\Models\DAO\BaseDAO;

class GarantiaService
{
    public function listar($grtID = null)
    {
        $garantiaDAO = new GarantiaDAO();
        return $garantiaDAO->listar($grtID);
    }

    public function listarGarantia($grtID = null)
    {
        $garantiaDAO = new GarantiaDAO();
        return $garantiaDAO->listarGarantia($grtID);
    }
    
    public function salvar(Garantia $garantia)
    {
        $transacao = new Transacao();

        try {

            $garantiaDAO = new GarantiaDAO();
            $transacao->beginTransaction();
            $id = $garantiaDAO->salvar($garantia);
            $garantia->setCtrId($id);

            $transacao->commit();

            Sessao::gravaMensagem("cadastro realizado com sucesso!. <br> Codigo: ".$id);
            Sessao::limpaFormulario();
            return $id;

        } catch (\Exception $e) {
            Sessao::gravaMensagem('Erro ao salvar garantia! ');
            $transacao->rollBack();

            return false;
        }

    }

    public function editar(Garantia $garantia)
    {

        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();

            $garantiaDAO = new GarantiaDAO();
            $garantiaDAO->editar($garantia);

            $transacao->commit();

            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::gravaMensagem('Garantia alterada com sucesso !');

                return true;
        } catch (\Exception $e) {
            Sessao::gravaMensagem('Erro ao editar garantia');
            $transacao->rollBack();
            return false;
        }
    }

    public function excluir($codigo)
    {
        try {

            $transacao  = new Transacao();
            $transacao->beginTransaction();

            $garantiaDAO   =   new GarantiaDAO();
            $garantiaDAO->excluir($codigo);

            $transacao->commit();

            Sessao::gravaMensagem('Garantia excluida !');
            Sessao::limpaMensagem();

            return true;

        }
        catch (\Exception $e)
        {
            $transacao->rollBack();
            throw new \Exception('Erro ao Excluir garantia');
        }

        return false;
    }
}