<?php
    
    
    namespace App\Controllers;
    
    use App\Lib\Sessao;
    use App\Models\Entidades\PedidoFalta;
    use App\Models\Entidades\ClienteLicitacao;
    use App\Models\Entidades\Produto;

    use App\Models\DAO\PedidoFaltaDAO;
    use App\Models\DAO\ClienteLicitacaoDAO;

    use App\Services\ClienteLicitacaoService;
    use App\Services\ClienteService;
    use App\Services\PedidoFaltaService;
    use App\Services\FornecedorService;
    use App\Services\MarcaService;
    use App\Services\ProdutoService;

    
    class PedidoFaltaController extends Controller
    {
        public function  listar($params)
        {
            $faltaCliente_cod = $params[0];
            $pedidoFaltaService = new PedidoFaltaService();
            $pedidoFalta = $pedidoFaltaService->listar($faltaCliente_cod);

            
            $this->setViewParam('pedidofalta', $pedidoFalta);
            $this->render('/pedidofalta/listar');
            
            Sessao::limpaMensagem();
        }
        
        public function cadastro()
        {
            $pedidoFaltaService =  new PedidoFaltaService();
                $pedidoFalta = new PedidoFalta();
            if(Sessao::existeFormulario())
            {
               // $pedidoFalta->setFaltaClienteCod(Sessao::retornaValorFormulario('cliente'));
               /* $pedidoFalta->setProposta(Sessao::retornaValorFormulario('proposta'));
                
                $pedidoFalta->setAFM(Sessao::retornaValorFormulario('afm'));
               // $pedidoFalta->setFkStatus(Sessao::retornaValorFormulario('status'));
                $pedidoFalta->setObservacao(Sessao::retornaValorFormulario('observacao'));
                $pedidoFalta->setDataFalta(Sessao::retornaValorFormulario('dataFalta'));
                */
                $codCliente = Sessao::retornaValorFormulario('cliente');
                $clienteLicitacaoServices = new ClienteLicitacaoService();
                $clienteLicitacao = $clienteLicitacaoServices->listar($codCliente);
               
                $pedidoFalta->setFkCliente($clienteLicitacao);
                
                $produtos = Sessao::retornaValorFormulario('produtos');
               
                if(empty($produtos)){
                    $pedidoFalta->setFk_Produto(array());
                    
                }else{
                    $produtoService = new ProdutoService();
                    $produtos = $produtoService->preencheProduto($produtos);
                   
                    $pedidoFalta->setFk_Produto($produtos);
                }                
                
            }else{
                
                $pedidoFalta = new PedidoFalta();
                $pedidoFalta->setFkCliente(new ClienteLicitacao());
                $pedidoFalta->setFk_Produto(array());
                
            }
            $this->setViewParam('statuslicitacao', $pedidoFaltaService->listarStatus());
            $this->setViewParam('pedidofalta', $pedidoFalta);
            $this->render('/pedidofalta/cadastro');
            
            Sessao::limpaErro();
            Sessao::limpaFormulario();

        }
        
        public function salvar()
        {
            $pedidoFalta =  new PedidoFalta();
            $pedidoFalta->setProposta(trim($_POST['proposta']));
            $pedidoFalta->setAFM(trim($_POST['afm']));
            $pedidoFalta->setObservacao(trim($_POST['observacao']));
            if(ctype_digit($_POST['cliente'])){
                $clienteLicitacaoService = new ClienteLicitacaoService();
                $clienteLicitacao = $clienteLicitacaoService->listar($_POST['cliente']);
            }else{
                
                throw new \Exception("Erro ao Cadastrar falta pedido", 500);
            }
            if(is_null($clienteLicitacao)){
                throw new \Exception("Erro ao cadastra falta pedido !", 500);
            }else{
                $pedidoFalta->setFkCliente($clienteLicitacao);
                $produtoService = new ProdutoService();
                $produtos = $produtoService->preencheProduto($_POST['produtos']);
                $pedidoFalta->setFk_Produto($produtos);
              
                Sessao::gravaFormulario($_POST);
                $pedidoFaltaService = new PedidoFaltaService();
                
                if($pedidoFaltaService->salvar($pedidoFalta)){
                    $this->redirect('/pedidofalta/listar');
              
                }else{
                   $this->redirect('/pedidofalta/cadastro');
                }
            }
        
        
        }
        
        public function editar()
        {
            $this->render('/pedidofalta/editar');
        }
        
        public function excluir()
        {
            $this->render('/pedidofalta/excluir');
        }
        
       
    }