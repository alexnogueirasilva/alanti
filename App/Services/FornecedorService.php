<?php
    
    
    namespace App\Services;

    use App\Lib\Sessao;
    use App\Lib\Transacao;
    use App\Lib\Exportar;
use App\Models\DAO\ContatoDAO;
use App\Models\Validacao\FornecedorValidador;
    use App\Models\DAO\EnderecoDAO;
    use App\Models\Entidades\Fornecedor;
    use App\Models\DAO\FornecedorDAO;
use App\Models\DAO\PessoaDAO;
use App\Models\Entidades\Contato;
use App\Models\Entidades\Pessoa;

class FornecedorService
    {
        public function listar(Fornecedor $fornecedor)
        {
            $fornecedorDAO = new FornecedorDAO();
            return $fornecedorDAO->listar($fornecedor);
        }
        public function listarId($fornecedorId)
        {
            $fornecedorDAO = new FornecedorDAO();
            return $fornecedorDAO->listarId($fornecedorId);
        }

        public function autoComplete(Fornecedor $fornecedor)
        {
            $fornecedorDAO = new FornecedorDAO();
            $busca = $fornecedorDAO->listarFornecedor($fornecedor);

            $exporte = new Exportar();
            echo $exporte->exportarJSON($busca);
        }
        public function salvar(Fornecedor $fornecedor)
        {
            $fornecedorValidador    = new FornecedorValidador();
            $fornecedorDAO          = new FornecedorDAO();
            $contatoDAO             = new ContatoDAO();
            $contato                = new Contato();
            $pessoaDAO              = new PessoaDAO();
            $enderecoDAO            = new EnderecoDAO();
            $transacao              = new Transacao();           
            $resultadoValidacao     = $fornecedorValidador->validar($fornecedor);
            
            if ($resultadoValidacao->getErros()) {
                
                Sessao::gravaErro($resultadoValidacao->getErros());
                Sessao::limpaErro();
            } else {
                try{
                    $transacao->beginTransaction();
                    $codPessoa = $pessoaDAO->salvar($_POST['forTipopessoa']);
                    
                    $fornecedor->setForPessoa($codPessoa);
                    $fornecedor->setEndPessoa($codPessoa);
                    
                    $codFornecedor = $fornecedorDAO->salvar($fornecedor);
                    
                    $enderecoDAO->salvar($fornecedor);
                    $contato =  $fornecedor->getContatos();
                    $contato->setPessoa($codPessoa);

                   if($contato){
                       $contatoDAO->addContatos($contato);
                   }
                   
                    $transacao->commit(); 
                    
                    Sessao::gravaMensagem("Cadastro realizado com sucesso!. <br><br> Cadastro Numero: ".$codFornecedor);
                    Sessao::limpaFormulario();
                    
                    return $codFornecedor;
                }catch(\Exception $e){                     
                    $tela = " Cadastro Fornecedor ";
                    $emailService = new EmailService();         
                   // $emailService->emailSuporte($e, $tela);
                    $transacao->rollBack(); 
                    Sessao::gravaMensagem("Erro ao tentar cadastrar. ".$e);
                return false;
                }
            }
        }

        public function alterar(Fornecedor $fornecedor)
        {
            try 
                {
                    $transacao      = new Transacao();
                    $transacao->beginTransaction();
                    $codPessoa      = $fornecedor->getForPessoa();
                    $fornecedorDAO  = new FornecedorDAO();
                    $enderecoDAO    = new EnderecoDAO();
                   
                    $fornecedorDAO->atualizar($fornecedor);          
                    $fornecedor->setEndPessoa($codPessoa);
                    $enderecoDAO->alterar($fornecedor);
                   
                    $transacao->commit();            
                    
                    Sessao::limpaMensagem();
                    Sessao::gravaMensagem("Cadastro Alterado com Sucesso. <br><br> Cadastro Numero: ".$fornecedor->getFornecedor_Cod());
                    return true;
                } catch (\Exception $e) {
                    $emailService = new EmailService();
                    $tela = " Alteracao de Fornecedor ";
                    //$emailService->emailSuporte($e, $tela);
                    $transacao->rollBack();
                    throw new \Exception("Erro ao alterar cadastro!");            
                    return false;
                }
        }
    
        public function excluir(Fornecedor $fornecedor)
        {
                try 
                {
                    
                    $transacao = new Transacao();
                    $transacao->beginTransaction();
                    $codPessoa          = $fornecedor->getForPessoa();
                    $fornecedorDAO      = new FornecedorDAO();
                    $contatosDAO        = new ContatoDAO();
                    $pessoaDAO          = new PessoaDAO();
                    $enderecoDAO        = new EnderecoDAO();
                    $pessoa             = new Pessoa();
                    $contato            = new Contato();
                   
                    $pessoa->setPesId($codPessoa);
                    $contato->setPessoa($codPessoa);
                    $enderecoDAO->excluir($fornecedor);
                
                    $fornecedorDAO->excluir($fornecedor);
                    $contatosDAO->excluirPorPessoa($contato);
                    $pessoaDAO->excluir($pessoa);
    
                    $transacao->commit();            
                    
                    Sessao::limpaMensagem();
                    Sessao::gravaMensagem("Cadastro Excluida com Sucesso!");
                    return true;
                } catch (\Exception $e) {
                    $emailService = new EmailService();
                    $tela = " Exclusao de Fornecedor ";
                    $emailService->emailSuporte($e, $tela);
                    $transacao->rollBack();
                    throw new \Exception(["Erro ao excluir a cadastro!"]);            
                    return false;
                }
        }
        public function sicronizar()
        {
                try 
                {
                    $fornecedorDAO = new  FornecedorDAO();
                    $transacao = new Transacao();
                    $transacao->beginTransaction();
                   
                    $total = $fornecedorDAO->sicronizar();
                   
                    $transacao->commit();            
                                        
                    Sessao::gravaMensagem("Cadastros Sicronizados com Sucesso! Total: ".$total);
                    return true;
                } catch (\Exception $e) {
                    $emailService = new EmailService();
                    $tela = " sicronizar de Fornecedor ";
                    $emailService->emailSuporte($e, $tela);
                    $transacao->rollBack();
                    throw new \Exception("Erro ao sicronizar o cadastro!");            
                    return false;
                }
        }
    }