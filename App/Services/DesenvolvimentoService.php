<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;

use App\Models\DAO\TransportadoraDAO;
use App\Models\DAO\DesenvolvimentoDAO;
use App\Models\DAO\PessoaDAO;
use App\Models\DAO\EnderecoDAO;
use App\Models\Entidades\Transportadora;
use App\Models\Entidades\Endereco;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Pessoa;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Desenvolvimento;
use App\Services\EmailService;
use App\Models\Validacao\TransportadoraValidador;

class DesenvolvimentoService
{

public function listar(Desenvolvimento $desenvolvimento)
{
    $desenvolvimentoDAO   = new DesenvolvimentoDAO();

    return $desenvolvimentoDAO->listar($desenvolvimento);
}
public function salvar(Desenvolvimento $desenvolvimento)
{
    $desenvolvimento = new TransportadoraValidador();
    $desenvolvimento       = new TransportadoraDAO();
    $pessoaDAO               = new PessoaDAO();
    $enderecoDAO             = new EnderecoDAO();
    $transacao = new Transacao();

    $resultadoValidacao = $desenvolvimento->validar($desenvolvimento);
    
    if ($resultadoValidacao->getErros()) {
        Sessao::gravaErro($resultadoValidacao->getErros());
        Sessao::limpaErro();
    } else {
        try{
            $transacao->beginTransaction();
                      
            $codPessoa = $pessoaDAO->salvar($tipo = null);
            
            $desenvolvimento->setTraPessoa($codPessoa);
            $desenvolvimento->setEndPessoa($codPessoa);
            $codTransportadora = $desenvolvimento->salvar($desenvolvimento);
            $enderecoDAO->salvar($desenvolvimento);
            
            $transacao->commit(); 
            
            Sessao::gravaMensagem("Cadastro realizado com sucesso!. <br><br> Cadastro Numero: ".$codTransportadora);
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();
            return $codTransportadora;
        }catch(\Exception $e){  
            $tela = " Cadastro Transportadora ";
            $emailService = new EmailService();         
            $emailService->emailSuporte($e, $tela);
            $transacao->rollBack(); 
            Sessao::gravaMensagem("Erro ao tentar cadastrar. ".$e);
           return false;
        }
    }
}
public function alterar(Desenvolvimento $desenvolvimento)
{
    try 
        {
            $transacao = new Transacao();
            $transacao->beginTransaction();
            $codPessoa = $desenvolvimento->getTraPessoa();
            $desenvolvimento  = new TransportadoraDAO();
            $enderecoDAO        = new EnderecoDAO();
            
            $desenvolvimento->alterar($desenvolvimento);          
            
            $enderecoDAO->alterar($desenvolvimento);

            $transacao->commit();            
            
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Cadastro Alterado com Sucesso!");
            return true;
        } catch (\Exception $e) {
            $emailService = new EmailService();
            $tela = " Alteracao de Transportadora ";
            $emailService->emailSuporte($e, $tela);
            $transacao->rollBack();
            throw new \Exception("Erro ao alterar cadastro!");            
            return false;
        }
}

public function excluir(Desenvolvimento $desenvolvimento)
{
        try 
        {
            $transacao = new Transacao();
            $transacao->beginTransaction();
            $codPessoa = $desenvolvimento->getTraPessoa();
            $desenvolvimento  = new TransportadoraDAO();
            $pessoaDAO          = new PessoaDAO();
            $enderecoDAO        = new EnderecoDAO();
            $pessoa = new Pessoa();
            $pessoa->setPesId($codPessoa);
            
            $enderecoDAO->excluir($desenvolvimento);
           
            $desenvolvimento->excluir($desenvolvimento);
            
            $pessoaDAO->excluir($pessoa);

            $transacao->commit();            
            
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Cadastro Excluida com Sucesso!");
            return true;
        } catch (\Exception $e) {
            $emailService = new EmailService();
            $tela = " Exclusao de Transportadora ";
            $emailService->emailSuporte($e, $tela);
            $transacao->rollBack();
            throw new \Exception(["Erro ao excluir a cadastro!"]);            
            return false;
        }
    }



}
