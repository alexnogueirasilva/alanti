<?php
    
    
    namespace App\Services;
    
    use App\Lib\Sessao;
    use App\Lib\Transacao;
    use App\Lib\Exportar;
    use App\Models\Entidades\Cliente;
    use App\Models\DAO\ClienteDAO;
    
    
    
    class ClienteService
    {
        public function listar($clienteId = null)
    {
        
        $clienteDAO = new ClienteDAO();
        return $clienteDAO->listar($clienteId);
    }

        public function autoComplete(Cliente $cliente)
        {
          
            $clienteDAO = new ClienteDAO();
            $busca = $clienteDAO->listarPorNomeFantasia($cliente);           
            $exportar = new Exportar();
            return $exportar->exportarJSON($busca);

        }
        
        public function pesquisarCliente(Cliente $cliente)
        {        
           
            $clienteDAO = new ClienteDAO();
            $busca = $clienteDAO->listarPorRazaoSocial($cliente);    
                            
            return json_encode($busca,JSON_UNESCAPED_UNICODE);

        }
       
    }