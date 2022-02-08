<?php
    namespace App\Services;
    use App\Lib\Sessao;
    use App\Lib\Exportar;
    use App\Lib\Transacao;
    use App\Models\DAO\ProdutoDAO;
    use App\Models\DAO\PessoaDAO;
    use App\Models\DAO\EnderecoDAO;
    use App\Models\DAO\ClienteLicitacaoDAO;
    use App\Models\Entidades\ClienteLicitacao;
    use App\Models\Entidades\PedidoFalta;
    use App\Models\Entidades\Produto;
    use App\Models\Entidades\Pessoa;
    use App\Models\Entidades\Contato;
    use App\Models\Validacao\ClienteLicitacaoValidador;
    
    class ClienteLicitacaoService
    {
        public function listar(ClienteLicitacao $clienteLicitacao)
        {
            $clienteLicitacaoDAO = new ClienteLicitacaoDAO();
            return $clienteLicitacaoDAO->listar($clienteLicitacao);
        }
        
         public function qtdeClientes()
        {
            $clienteLicitacaoDAO = new ClienteLicitacaoDAO();
            return $clienteLicitacaoDAO->qtdeClientes();
        }
        
        public function listarClientesPedidoErp($codCliente = null)
        {
            $clienteLicitacaoDAO = new ClienteLicitacaoDAO();
            return $clienteLicitacaoDAO->listarClientesPedidoErp($codCliente);
        }
        
        public function listarClientesLogisticaNfe($codCliente = null)
        {
            $clienteLicitacaoDAO = new ClienteLicitacaoDAO();
            return $clienteLicitacaoDAO->listarClientesLogisticaNfe($codCliente);
        }
        public function listaClientesPedido()
        {           
            $clienteLicitacaoDAO = new ClienteLicitacaoDAO();
            return $clienteLicitacaoDAO->listaClientesPedido();
        }
        public function listaClientesEdital()
        {           
            $clienteLicitacaoDAO = new ClienteLicitacaoDAO();
            return $clienteLicitacaoDAO->listaClientesEdital();
        }
         public function listaTipoCliente(ClienteLicitacao $clienteLicitacao)
        {           
            $clienteLicitacaoDAO = new ClienteLicitacaoDAO();
            return $clienteLicitacaoDAO->listaTipoClienteLicitacao($clienteLicitacao);
        }
        
        public function listarPorProduto(Produto $produto)
        {
            $produtoDAO =  new ProdutoDAO();
            return $produtoDAO->listarPorProduto($produto->getProCodigo());
        }
        public function listraPorCliente(ClienteLicitacao $clienteLicitacao)
        {
            $clienteLicitacaoDAO =  new ClienteLicitacaoDAO();
            $clienteLicitacao = $clienteLicitacaoDAO->listarPorNomeFantasia($clienteLicitacao);
        }
        
        public function autoComplete(ClienteLicitacao $clienteLicitacao)
        {
            $clienteLicitacao->getRazaoSocial();
            $clienteLicitacaoDAO = new ClienteLicitacaoDAO();
            $busca = $clienteLicitacaoDAO->listarPorRazaoSocial($clienteLicitacao);
            $exportar = new Exportar();
            echo $exportar->exportarJSON($busca);
        
        }
       
        public function listarClienteFalta(ClienteLicitacao $clienteLicitacao)
        {
            $clienteLicitacao->getNomeFantasia();
            $clienteLicitacaoDAO =  new ClienteLicitacaoDAO();
            $busca = $clienteLicitacaoDAO->listarClienteLicitacao($clienteLicitacao);

            $exportar = new Exportar();
            echo $exportar->exportarJSON($busca);
        }
        
        public function salvar(ClienteLicitacao $clienteLicitacao)
        {
            $clienteLicitacaoValidador = new ClienteLicitacaoValidador();
            $clienteLicitacaoDAO       = new ClienteLicitacaoDAO();
            
            $pessoaDAO               = new PessoaDAO();
            $enderecoDAO             = new EnderecoDAO();
            $transacao = new Transacao();
           
            $resultadoValidacao = $clienteLicitacaoValidador->validar($clienteLicitacao);
            
            if ($resultadoValidacao->getErros()) {
                
                Sessao::gravaErro($resultadoValidacao->getErros());
                Sessao::limpaErro();
            } else {
                try{
                    $transacao->beginTransaction();
                   
                    $codPessoa = $pessoaDAO->salvar($_POST['tipoPessoa']);
                    $clienteLicitacao->setCliPessoa($codPessoa);
                    
                    $clienteLicitacao->setEndPessoa($codPessoa);                   
                   
                    
                    $codClienteLicitacao = $codClienteLicitacao = $clienteLicitacaoDAO->salvar($clienteLicitacao);
                    
                    $enderecoDAO->salvar($clienteLicitacao);
                    if($clienteLicitacao->getContatos()->getContato()){

                        $clienteLicitacaoDAO->addContatos($clienteLicitacao);
                    }
                    
                    $transacao->commit(); 
                    
                    Sessao::gravaMensagem("Cadastro realizado com sucesso!. <br><br> Cadastro Numero: ".$codClienteLicitacao);
                    Sessao::limpaFormulario();
                    
                    return $codClienteLicitacao;
                }catch(\Exception $e){                     
                    $tela = " Cadastro ClienteLicitacao ";
                    $emailService = new EmailService();         
                   // $emailService->emailSuporte($e, $tela);
                    $transacao->rollBack(); 
                    Sessao::gravaMensagem("Erro ao tentar cadastrar. ".$e);
                return false;
                }
            }
        }

        public function addContato(Contato $contato)
        {
            $clienteLicitacaoDAO       = new ClienteLicitacaoDAO();
            $clienteLicitacaoDAO       = new ClienteLicitacaoDAO();
            $transacao = new Transacao();
            
            try{
                    $transacao->beginTransaction();
                
                    $clienteLicitacaoDAO->addContato($contato);
                    
                    $transacao->commit(); 
                    
                    Sessao::gravaMensagem("Cadastro realizado com sucesso!. <br><br> Cadastro Numero: ");
                    Sessao::limpaFormulario();
                    return true;
                }catch(\Exception $e){  
                    $tela = " Cadastro ClienteLicitacao ";
                    $emailService = new EmailService();         
                   // $emailService->emailSuporte($e, $tela);
                    $transacao->rollBack(); 
                    Sessao::gravaMensagem("Erro ao tentar cadastrar. ".$e);
                return false;
                }
        }

        public function alterar(ClienteLicitacao $clienteLicitacao)
        {
            try 
                {
                    $transacao = new Transacao();
                    $transacao->beginTransaction();
                    $codPessoa = $clienteLicitacao->getCliPessoa();
                    $clienteLicitacaoDAO  = new ClienteLicitacaoDAO();
                    $enderecoDAO        = new EnderecoDAO();
                    
                    $clienteLicitacaoDAO->atualizar($clienteLicitacao);          
                    
                    $enderecoDAO->alterar($clienteLicitacao);
    
                    $transacao->commit();            
                    
                    Sessao::limpaMensagem();
                    Sessao::gravaMensagem("Cadastro Alterado com Sucesso. <br><br> Cadastro Numero: ".$clienteLicitacao->getCodCliente());
                    return true;
                } catch (\Exception $e) {
                    $emailService = new EmailService();
                    $tela = " Alteracao de ClienteLicitacao ";
                    $emailService->emailSuporte($e, $tela);
                    $transacao->rollBack();
                    throw new \Exception("Erro ao alterar cadastro!");            
                    return false;
                }
        }
    
        public function excluir(ClienteLicitacao $clienteLicitacao)
        {
                try 
                {
                    $transacao              = new Transacao();
                    $transacao->beginTransaction();
                    $codPessoa              = $clienteLicitacao->getCliPessoa();
                    $clienteLicitacaoDAO    = new ClienteLicitacaoDAO();
                    $pessoaDAO              = new PessoaDAO();
                    $enderecoDAO            = new EnderecoDAO();
                    $pessoa                 = new Pessoa();
                    $pessoa->setPesId($codPessoa);
                    
                    $enderecoDAO->excluir($clienteLicitacao);
                
                    $clienteLicitacaoDAO->excluir($clienteLicitacao);
                    
                    $pessoaDAO->excluir($pessoa);
    
                    $transacao->commit();            
                    
                    Sessao::limpaMensagem();
                    Sessao::gravaMensagem("Cadastro Excluida com Sucesso!");
                    return true;
                } catch (\Exception $e) {
                    $emailService = new EmailService();
                    $tela = " Exclusao de ClienteLicitacao ";
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
                    $clienteLicitacaoDAO = new  ClienteLicitacaoDAO();
                    $transacao = new Transacao();
                    $transacao->beginTransaction();
                   
                    $total = $clienteLicitacaoDAO->sicronizar();
                   
                    $transacao->commit();            
                    if($total){
                        Sessao::gravaMensagem("Cadastros Sicronizados com Sucesso! Total: ".$total);
                    }else{
                        Sessao::gravaMensagem("Nenhum Cadastros Sicronizados!");                                
                    }      
                    return true;
                } catch (\Exception $e) {
                    $emailService = new EmailService();
                    $tela = " sicronizar de Cliente ";
                   // $emailService->emailSuporte($e, $tela);
                    $transacao->rollBack();
                    throw new \Exception(["Erro ao sicronizar o cadastro!"]);            
                    return false;
                }
        }
    }