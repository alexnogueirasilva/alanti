<?php    
    
    namespace App\Services;
    
    use App\Lib\Sessao;
    use App\Lib\Transacao;
    use App\Lib\Exportar;
    use App\Models\Validacao\LogisticaValidador;
    use App\Models\Validacao\ResultadoValidacao;
    use App\Models\Entidades\Logistica;
    use App\Models\DAO\LogisticaDAO;
    use App\Models\DAO\PedidoDAO;
    use App\Models\DAO\PedidoErpDAO;
    use App\Models\Entidades\Pedido;

class LogisticaService
    {
        public function listar(Logistica $logistica)
        {            
            $logisticaDAO = new LogisticaDAO();
            return $logisticaDAO->listar($logistica);
        }
        public function entregues()
        {            
            $logisticaDAO = new LogisticaDAO();
            return $logisticaDAO->entregues();            
        }
        public function pendentes()
        {            
            $logisticaDAO = new LogisticaDAO();
            return $logisticaDAO->pendentes();            
        }
        public function indexLogistica(Logistica $logistica)
        {            
            $logisticaDAO = new LogisticaDAO();
            return $logisticaDAO->indexLogistica($logistica);
            
        }
        public function salvar(Logistica $logistica)
        {
            $transacao = new Transacao();
            $logisticaValidador = new LogisticaValidador();
            $resultadoValidacao = $logisticaValidador->validar($logistica);
            
            if ($resultadoValidacao->getErros()) {
                Sessao::limpaErro();
                Sessao::gravaErro($resultadoValidacao->getErros());
            } else {
                try{
                   $transacao->beginTransaction();
                   $logisticaDAO = new LogisticaDAO();            
                   $pedidoErpDAO = new PedidoErpDAO();            
                   $pedido = new Pedido();
                   
                   $pedido->setPerpId($logistica->getFk_Pedido()->getPerpId());
                   $pedido->setPerpValor($logistica->getFk_Pedido()->getPerpValor());
                   $pedido->setPerpCodControle($logistica->getFk_Pedido()->getPerpCodControle());
                   $pedido->setPerpNumero($logistica->getFk_Pedido()->getPerpNumero());
                   $pedido->setPerpUsuario($logistica->getFk_Operador()->getId());
                   $pedido->setPerpStatus($logistica->getFk_StatusLogistica());

                   $codigo =  $logisticaDAO->salvar($logistica);
                   
                   $pedidoErpDAO->alterar($pedido);
                   $transacao->commit(); 
                   Sessao::gravaMensagem("cadastro realizado com sucesso!. <br><br> Numero: ".$codigo);
                   Sessao::limpaFormulario();
                    return $codigo;
                }catch(\Exception $e){              
                    $emailService = new EmailService();
                    $codigo = 'Codigo indefinido';
                    $tela = "Cadastro de logistica - Codigo ".$codigo;
                    $emailService->emailSuporte($e, $tela);
                    $transacao->rollBack(); 
                    Sessao::gravaMensagem("Erro ao tentar cadastrar. ");
                   return false;
                }
            }

        }
        public function atualizar(Logistica $logistica)
        {
            $transacao = new Transacao();
            $logisticaValidador = new LogisticaValidador();
            $resultadoValidacao = $logisticaValidador->validar($logistica);
           
            if ($resultadoValidacao->getErros()) {
                Sessao::limpaErro();
                Sessao::gravaErro($resultadoValidacao->getErros());
            } else {
                try{
                $transacao->beginTransaction();
                    $logisticaDAO = new LogisticaDAO();          
                    $logisticaDAO->atualizar($logistica);
                        
                    $transacao->commit(); 
                    Sessao::gravaMensagem("cadastro atualizado com sucesso!. <br><br> Numero: ".$logistica->getLgtId());
                    Sessao::limpaFormulario();
                   
                    return true;
                }catch(\Exception $e){    
                           
                    $emailService = new EmailService();
                    $tela = "Atualizar de logistica - Codigo ".$logistica->getLgtId();
                    $emailService->emailSuporte($e, $tela);
                    $transacao->rollBack(); 
                    Sessao::gravaMensagem("Erro ao tentar alterar. ".$e);
                    return false;
                }
            }

        }
        public function excluir(Logistica $logistica)
        {
            try {
            
                $transacao = new Transacao();
                $transacao->beginTransaction();
                $codigo = $logistica->getLgtId();
                
                $logisticaDAO = new LogisticaDAO();
                                       
                $logisticaDAO->excluir($logistica);
                $transacao->commit();            
                
                Sessao::limpaMensagem();
                Sessao::gravaMensagem("Cadastro Excluida com Sucesso!");
                return true;
            } catch (\Exception $e) {
                $emailService = new EmailService();
                $tela = "Exclusao de logistica - Codigo ".$codigo;
                $emailService->emailSuporte($e, $tela);

                $transacao->rollBack();
                throw new \Exception("Erro ao excluir cadastro");            
                return false;
            }
    

        }

    }