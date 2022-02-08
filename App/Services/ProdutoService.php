<?php
    
    
    namespace App\Services;
    
    use App\Lib\Sessao;
    use App\Lib\Transacao;
    use App\Lib\Exportar;

    use App\Models\DAO\PedidoFaltaDAO;
    use App\Models\DAO\ProdutoDAO;
    
    use App\Models\Entidades\PedidoFalta;
    use App\Models\Entidades\Produto;
    use App\Models\Entidades\ClienteLicitacao;
    
    use App\Models\Validacao\PedidoValidador;
    use App\Models\Validacao\ProdutoValidador;
    
    
    class ProdutoService
    {
        
        public function listar($proCodigo = null)
        {
            $produtoDAO = new ProdutoDAO();
            return $produtoDAO->listar($proCodigo);
        }
        
        public function  listarPorFalta(pedidoFalta $pedidoFalta)
        {
            $produtoDAO = new ProdutoDAO();
            return $produtoDAO->listarPorFalta($pedidoFalta->getFaltaClienteCod());
        }
        
        public function autoComplete(Produto $produto)
        {
            $produtoDAO = new ProdutoDAO();
            $busca =  $produtoDAO->listarPorProduto($produto);
            
            $exportar = new Exportar();
            echo $exportar->exportarJSON($busca);
            
        }
        
        public function listarPorCliente($clienteLicitacao)
        {
            $prdutoDAO = new ProdutoDAO();
            $produtos = $prdutoDAO->listarPorCliente($clienteLicitacao);
            return $produtos;
        }
        
        public function preencheProduto($arryProdutos)
        {   
            $produtoDAO = new ProdutoDAO();
            $produtos = [];
            
            if (isset($arryProdutos)){
                foreach ($arryProdutos as $proCodigo)
                {
                    
                    $produtos[] = $produtoDAO->listar($proCodigo)[0];
                  
                }

            }
            
            return $produtos;
        
        }
        
    }