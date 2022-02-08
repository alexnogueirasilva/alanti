<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;
use App\Models\DAO\TransportadoraDAO;
use App\Models\DAO\PessoaDAO;
use App\Models\DAO\EnderecoDAO;
use App\Models\Entidades\Transportadora;
use App\Models\Entidades\Endereco;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Pessoa;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Contato;
use App\Services\EmailService;
use App\Models\Validacao\TransportadoraValidador;

class TransportadoraService
{

    public function listar(Transportadora $transportadora)
    {
        $transportadoraDAO       = new TransportadoraDAO();
        return $transportadoraDAO->listar($transportadora);
    }
    public function listarTransportadoraLogisticaNfe()
    {
        $transportadoraDAO       = new TransportadoraDAO();
        return $transportadoraDAO->listarTransportadoraLogisticaNfe();
    }

    public function autoComplete(Transportadora $transportadora)
    {
        $transportadora->getTraRazaoSocial();
        $transportadoraDAO = new TransportadoraDAO();
        $busca = $transportadoraDAO->listarPorRazaoSocial($transportadora);
        $exportar = new Exportar();
        echo $exportar->exportarJSON($busca);
    
    }

     public function salvar(Transportadora $transportadora)
    {
        $transportadoraValidador = new TransportadoraValidador();
        $transportadoraDAO       = new TransportadoraDAO();
        $pessoaDAO               = new PessoaDAO();
        $enderecoDAO             = new EnderecoDAO();
        $transacao = new Transacao();

        $resultadoValidacao = $transportadoraValidador->validar($transportadora);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            Sessao::limpaErro();
        } else {
            try{
                $transacao->beginTransaction();
                        
                $codPessoa = $pessoaDAO->salvar($_POST['tipoPessoa']);
                
                $transportadora->setTraPessoa($codPessoa);
                $transportadora->setEndPessoa($codPessoa);
                $codTransportadora = $transportadoraDAO->salvar($transportadora);
                $enderecoDAO->salvar($transportadora);

                if($transportadora->getContatos()->getContato()){
                    $transportadoraDAO->addContatos($transportadora);
                }
                $transacao->commit(); 
                
                Sessao::gravaMensagem("Cadastro realizado com sucesso!. <br><br> Cadastro Numero: ".$codTransportadora);
                Sessao::limpaFormulario();
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
    
    public function alterar(Transportadora $transportadora)
    {
        try 
            {
                $transacao = new Transacao();
                $transacao->beginTransaction();
                $codPessoa = $transportadora->getTraPessoa();
                $transportadoraDAO  = new TransportadoraDAO();
                $enderecoDAO        = new EnderecoDAO();
                
                $transportadoraDAO->alterar($transportadora);          
                
                $enderecoDAO->alterar($transportadora);

                $transacao->commit();            
                
                Sessao::limpaMensagem();
                Sessao::gravaMensagem("Cadastro Alterado com Sucesso. <br><br> Cadastro Numero: ".$transportadora->getTraId());                
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

    public function excluir(Transportadora $transportadora)
    {
            try 
            {
                $transacao = new Transacao();
                $transacao->beginTransaction();
                $codPessoa          = $transportadora->getTraPessoa();
                $transportadoraDAO  = new TransportadoraDAO();
                $pessoaDAO          = new PessoaDAO();
                $enderecoDAO        = new EnderecoDAO();
                $contatoDAO         = new ContatoDAO();
                $contato            = new Contato();
                $pessoa             = new Pessoa();
                $pessoa->setPesId($codPessoa);
                $contato->setPessoa($codPessoa);

                $enderecoDAO->excluir($transportadora);
            
                $transportadoraDAO->excluir($transportadora);
                $contatoDAO->excluirPorPessoa($contato);
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