<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\UsuarioDAO;

use App\Models\Validacao\UsuarioValidador;
use App\Models\Validacao\ResultadoValidacao;
use App\Models\Entidades\Usuario;

use App\Services\TecnologiaService;

class UsuarioService
{
   public function listar(Usuario $usuario)
    {
        $usuarioDAO = new UsuarioDAO();
        return $usuarioDAO->listar($usuario);
    }
    
    public function usuariosAtivos()
    {
        $usuarioDAO = new UsuarioDAO();
        return $usuarioDAO->usuariosAtivos();
    }
    public function usuariosInativos()
    {
        $usuarioDAO = new UsuarioDAO();
        return $usuarioDAO->usuariosInativos();
    }
    public function listarUsuarioEdital()
    {
        $usuarioDAO = new UsuarioDAO();
        return $usuarioDAO->listarUsuarioEdital();
    }
    public function listarprecadastro($idUsuario = null)
    {
        $usuarioDAO = new UsuarioDAO();
        return $usuarioDAO->listarprecadastro($idUsuario);
    }
    public function verificaEmail($email)
    {
        $usuarioDAO = new UsuarioDAO();
        return $usuarioDAO->verificaEmail($email);
    }
   
    public function validacadastro($codigo,$valida,$email)
    {
        $usuarioDAO = new UsuarioDAO();
        return $usuarioDAO->validacadastro($codigo,$valida,$email);
    }
    public function ativarcadastro(Usuario $usuario)
    {
        $usuarioDAO = new UsuarioDAO();
        return $usuarioDAO->ativarcadastro($usuario);
    }

  /*public function autoComplete(Usuario $usuario)
    { 
        $usuarioDAO = new UsuarioDAO();
        $busca = $usuarioDAO->listaPorNome($usuario);          
        $exportar = new Exportar();
        return $exportar->exportarJSON($busca);
    }*/
    
    /*public function listarEstadosVinculadas(Usuario $usuario)
    {
        $usuarioDAO = new UsuarioDAO();
        return $usuarioDAO->listarEstadosVinculadas($usuario);
    }*/

    public function salvar(Usuario $usuario)
    {
        $transacao = new Transacao();
        $usuarioValidador = new UsuarioValidador();
        $resultadoValidacao = $usuarioValidador->validar($usuario);

        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
                $transacao->beginTransaction();
                $usuarioDAO = new UsuarioDAO();            
                $codUsuario = $usuarioDAO->salvar($usuario);
                $transacao->commit(); 
                Sessao::gravaMensagem("Cadastro realizado com sucesso! <br> <br> Codigo: ".$codUsuario);
                Sessao::limpaFormulario();
                return true;
            }catch(\Exception $e){
                Sessao::gravaMensagem("Erro ao tentar cadastrar.");
                $transacao->rollBack(); 
                return false;
            }
        }
    }
    public function precadastro(Usuario $usuario)
    {
        $transacao = new Transacao();
        $usuarioValidador = new UsuarioValidador();
        $resultadoValidacao = $usuarioValidador->validar($usuario);

        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
                $transacao->beginTransaction();
                $usuarioDAO = new UsuarioDAO();            
                $codUsuario = $usuarioDAO->precadastro($usuario);
                $transacao->commit(); 
                Sessao::gravaMensagem("Pre-Cadastro realizado com sucesso! <br> <br> Codigo: ".$codUsuario);
                Sessao::limpaFormulario();
                return $codUsuario;
            }catch(\Exception $e){
                Sessao::gravaMensagem("Erro ao tentar cadastrar.");
                $transacao->rollBack(); 
                return false;
            }
        }
    }

 public function desInfo(Usuario $usuario)
    {
        $transacao              = new Transacao();
        $usuarioValidador       = new UsuarioValidador();
        $resultadoValidacao     = new ResultadoValidacao();
        $resultadoValidacao     = $usuarioValidador->validar($usuario);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
                $transacao->beginTransaction();
                $usuarioDAO = new UsuarioDAO();            
                $usuarioDAO->desInfo($usuario);
                $transacao->commit(); 
               
                Sessao::limpaFormulario();
                return true;
            }catch(\Exception $e){                
                $transacao->rollBack(); 
                Sessao::gravaMensagem("Erro ao tentar alterar. ");
               return false;
            }
        }

    }

    public function atualizar(Usuario $usuario)
    {
        $transacao              = new Transacao();
        $usuarioValidador       = new UsuarioValidador();
        $resultadoValidacao     = new ResultadoValidacao();
        $resultadoValidacao     = $usuarioValidador->validar($usuario);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
                $transacao->beginTransaction();
                $usuarioDAO = new UsuarioDAO();            
                $usuarioDAO->atualizar($usuario);
                $transacao->commit(); 
                Sessao::gravaMensagem("cadastro alterado com sucesso! <br> <br>  Codigo ".$usuario->getId() );
                Sessao::limpaFormulario();
                return true;
            }catch(\Exception $e){                
                $transacao->rollBack(); 
                //var_dump($e);
                Sessao::gravaMensagem("Erro ao tentar alterar. ");
               return false;
            }
        }

    }

    public function excluir(Usuario $usuario)
    {
        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $usuarioDAO = new UsuarioDAO();

            $usuarioDAO->excluir($usuario);
            $transacao->commit();            
            
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Cadastro Excluida com Sucesso!");
            return true;
        } catch (\Exception $e) {
            $transacao->rollBack();
            throw new \Exception(["Erro ao excluir Cadastro!"]);            
            return false;
        }
    }
}