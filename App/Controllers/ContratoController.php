<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\Validacao\ContratoValidador;
use App\Models\Entidades\Contrato;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Edital;
use App\Models\Entidades\Representante;
use App\Models\Entidades\ClienteLicitacao;
use App\Services\ContratoService;
use App\Services\UsuarioService;
use App\Services\EditalService;
use App\Services\InstituicaoService;
use App\Services\ClienteLicitacaoService;
use App\Services\RepresentanteService;
use App\Services\NotificacaoService;

class ContratoController extends Controller
{
    public function listarPorEdital($params)
    {
        $contratoService = new ContratoService();
        $contrato = new Contrato();
        $editalId = $params[0];
        if($contrato)
        {
           // $contrato->setEdital(new Edital());
            $contrato->setCodEdital($editalId);
           
            self::setViewParam('listaContratos', $contratoService->listarDinamico($contrato));
            $this->render('/contrato/index');
        }
    }

    public function index($params)
    {
        $contratoId = $params[0];
        $contratoService = new ContratoService();
        $editalService = new EditalService();
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $representanteService = new RepresentanteService();
        $contrato = new Contrato();

        self::setViewParam('listaClientes', $contratoService->listarClienteContrato($contratoId));
        //self::setViewParam('listaClientes', $clienteLicitacaoService->listar());
        self::setViewParam('listarRepresentantes', $contratoService->listarRepresentanteContrato());
        
       if($_POST){
           $contrato->setCtrRepresentante($_POST['codRepresentante']);
           $contrato->setCtrId($_POST['ctr_id']);
           $contrato->setCtrClienteLicitacao($_POST['clienteId']);
           $contrato->setCtrNumero($_POST['contrato']); 
           $contrato->setCtrStatus($_POST['status']);
           $contrato->setCtrModalidade($_POST['modalidade']);       
           $contrato->setCtrNumeroLicitacao($_POST['numeroLicitacao']); 
          $_SESSION['codRepresentante'] =  $_POST['codRepresentante'];
           $_SESSION['ctr_id'] =  $_POST['ctr_id'];
           $_SESSION['clienteId'] =  $_POST['clienteId'];
           $_SESSION['contrato'] =  $_POST['contrato'];
           $_SESSION['status'] =  $_POST['status'];
           $_SESSION['modalidade'] =  $_POST['modalidade'];
           $_SESSION['numeroLicitacao'] =  $_POST['numeroLicitacao'];
        }else{
            unset($_SESSION['codRepresentante'],
            $_SESSION['ctr_id'],
            $_SESSION['clienteId'],
            $_SESSION['contrato'],
            $_SESSION['status'],
            $_SESSION['modalidade'], 
            $_SESSION['numeroLicitacao']);        
        }
        
    
        self::setViewParam('listaContratos', $contratoService->listarDinamico($contrato));
        $this->render('/contrato/index');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();

    }

    public function autoCompleteContratoClienteRazaoSocial($params)
    {       
        $clienteLicitacao = new ClienteLicitacao();
        $clienteLicitacao->setRazaoSocial($params[0]);        
        
        $contratoService = new ContratoService();
        $busca = $contratoService->autoCompleteContratoClienteRazaoSocial($clienteLicitacao);      
        echo $busca;
    }

    public function autoCompleteEditalClienteRazaoSocial($params)
    {       
        $clienteLicitacao = new ClienteLicitacao();
        $clienteLicitacao->setRazaoSocial($params[0]);        
        
        $contratoService = new ContratoService();
        $busca = $contratoService->autoCompleteEditalClienteRazaoSocial($clienteLicitacao);      
        echo $busca;
    }

    public function autoCompleteNumeroContratoCodCliente($params)
    {       
        $edital = new Edital();
        $edital->setEdtNumero($params[0]);        
        $clienteLicitacao = new ClienteLicitacao();
        $clienteLicitacao->setCodCliente($params[1]);
          
        $contratoService = new ContratoService();
        $busca = $contratoService->autoCompleteNumeroContratoCodCliente($edital, $clienteLicitacao);      
        echo $busca;
    }

    public function autoCompleteNumeroEditalCodCliente($params)
    {       
        $edital = new Edital();
        $edital->setEdtNumero($params[0]);        
        $clienteLicitacao = new ClienteLicitacao();
        $clienteLicitacao->setCodCliente($params[1]);
          
        $contratoService = new ContratoService();
        $busca = $contratoService->autoCompleteNumeroEditalCodCliente($edital, $clienteLicitacao);      
        echo $busca;
    }

    public function cadastro($params)
    {
       
        $editalService              = new EditalService();   
        $edital                     = new Edital();   
        $contrato                   = new Contrato();
        $contratoService            = new ContratoService();
        if(empty( $params[0])){
            Sessao::gravaMensagem("Nenhuma Edital informado!");
            $this->redirect('/contrato/index');
          
        }
        if(Sessao::existeFormulario()) { 
            $contrato->setCtrId(Sessao::retornaValorFormulario('ctr_id'));        
            $contrato->setCtrNumero(Sessao::retornaValorFormulario('numeroContrato'));        
            $contrato->setCtrDataInicio(Sessao::retornaValorFormulario('dataInicio'));        
            $contrato->setCtrDataVencimento(Sessao::retornaValorFormulario('dataVencimento'));        
            $contrato->setCtrValor(str_replace(',','.', str_replace(".", "", Sessao::retornaValorFormulario('valor'))));
            $contrato->setCtrStatus(Sessao::retornaValorFormulario('status'));        
            $contrato->setCtrObservacao(Sessao::retornaValorFormulario('observacao'));
            $contrato->setCtrAnexo(Sessao::retornaValorFormulario('anexo'));
            $contrato->setCtrPrazoPagamento(Sessao::retornaValorFormulario('prazoPagamento'));        
            $contrato->setCtrPrazoEntrega(Sessao::retornaValorFormulario('prazoEntrega'));             
            $contrato->setCtrDataAlteracao(Sessao::retornaValorFormulario('dataCadastro'));        
            $contrato->setCtrDataCadastro(Sessao::retornaValorFormulario('dataCadastro'));            
        }       
        
        $idEdital = $params[0];
        $edital = $editalService->listar($idEdital)[0];
        $contrato->setEdital($edital);
        $contrato->setCodEdital($params[0]);
        $contratos = $contratoService->listarDinamico($contrato);        
     
        $this->setViewParam('contrato',$edital);          
        $this->setViewParam('contratos',$contratos);          
       
        $this->render('/contrato/cadastro');        
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    { 
          
        $usuarioService             = new UsuarioService();        
        $usuario                    = new Usuario(); 
        $editalService              = new EditalService();
        
        $usuario->setId($_POST['ctrUsuario']);
       
        $usuario                    = $usuarioService->listar($usuario)[0];
        $edital                     = $editalService->listar($_POST['ctr_edital'])[0];
 
        $contrato                   = new Contrato();
        $ctrCodigo  = $_POST['ctr_id'];        
        $contrato->setCtrNumero($_POST['numeroContrato']);        
        $contrato->setCtrDataInicio($_POST['dataInicio']);        
        $contrato->setCtrDataVencimento($_POST['dataVencimento']);        
        $contrato->setCtrValor(str_replace(',','.', str_replace(".", "", $_POST['valor'])));
        $contrato->setCtrStatus($_POST['status']);        
        $contrato->setCtrObservacao($_POST['observacao']);
        $contrato->setCtrAnexo($_POST['anexo']);        
        $contrato->setEdital($edital);        
        $contrato->setCtrPrazoPagamento($_POST['prazoPagamento']);        
        $contrato->setCtrPrazoEntrega($_POST['prazoEntrega']);             
        $contrato->setCtrDataAlteracao($_POST['dataCadastro']);        
        $contrato->setCtrDataCadastro($_POST['dataCadastro']);        
        $contrato->setCtrObservacao($_POST['observacao']);        
        
        $contrato->setUsuario($usuario);
        Sessao::gravaFormulario($_POST);

        $contratoValidador  = new ContratoValidador();
        $resultadoValidacao = $contratoValidador->validar($contrato);

       if ($resultadoValidacao->getErros()) {
           $this->redirect('/contrato/cadastro');
        }
        if (!$edital) {
            $this->redirect('/contrato/cadastro');
            Sessao::gravaMensagem("nenhuma licitacao informada");
         }

        $contratoService = new ContratoService();        

        if($ctrCodigo){
            $anexo =  $_POST['anexo'];
            if($anexo == ""){
                $contrato->setCtrAnexo(trim($_POST['ctrAnexoAlt']));
            } else{
                $contrato->setCtrAnexo(trim($_POST['anexo']));
            }                       
            $contrato->setCtrId(trim($_POST['ctr_id']));
            if ($contratoService->Editar($contrato)) {
                $this->redirect('/contrato/cadastro/'. $edital->getEdtId());
                Sessao::limpaFormulario();
                Sessao::limpaMensagem();
                Sessao::limpaErro();
            } else {
               $this->redirect('/contrato/cadastro/'. $edital->getEdtId());
            }
        }else{
            if ($contratoService->salvar($contrato)) {
                $this->redirect('/contrato/cadastro/'. $edital->getEdtId());
                Sessao::limpaFormulario();
                Sessao::limpaMensagem();
                Sessao::limpaErro();
            } else {
               $this->redirect('/contrato/cadastro/'. $edital->getEdtId());
            }
        }
    }

    public function edicao($params)
    { 
      
        $contratoId = $params[0];
        
        $contratoService = new ContratoService();
        $contrato = new Contrato();
              
        if(Sessao::existeFormulario()) { 
            $contrato->setCtrId(Sessao::retornaValorFormulario('ctr_id'));
            $contrato->setCtrNumero(Sessao::retornaValorFormulario('numeroContrato'));        
            $contrato->setCtrDataInicio(Sessao::retornaValorFormulario('dataInicio'));        
            $contrato->setCtrDataVencimento(Sessao::retornaValorFormulario('dataVencimento'));        
            $contrato->setCtrValor(str_replace(',','.', str_replace(".", "", Sessao::retornaValorFormulario('valor'))));
            $contrato->setCtrStatus(Sessao::retornaValorFormulario('status'));        
            $contrato->setCtrObservacao(Sessao::retornaValorFormulario('observacao'));
            $contrato->setCtrAnexo(Sessao::retornaValorFormulario('anexo'));
            $contrato->setCtrPrazoPagamento(Sessao::retornaValorFormulario('prazoPagamento'));        
            $contrato->setCtrPrazoEntrega(Sessao::retornaValorFormulario('prazoEntrega'));             
            $contrato->setCtrDataAlteracao(Sessao::retornaValorFormulario('dataCadastro'));        
            $contrato->setCtrDataCadastro(Sessao::retornaValorFormulario('dataCadastro'));
           
            
            $contrato = $contratoService->listar($contratoId)[0];           
        }else{                       
            self::setViewParam('listarRepresentantes', $representanteService->listar());            
           
            $contrato = $contratoService->listar($contratoId)[0]; 
        }        
        if (!$contrato) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/contrato');
        }
        
        $this->setViewParam('contrato', $contrato);
        $this->render('/contrato/edicao');
        
        Sessao::limpaMensagem();
    }

    public function atualizar()
    {             
         
        $usuarioService             = new UsuarioService();        
        $usuario                    = new Usuario();         
        $instituicaoService         = new InstituicaoService();        
        $editalService              = new EditalService();  
        $usuario->setId($_POST['ctrUsuario']);
        $usuario                    = $usuarioService->listar($usuario)[0];
        $edital                     = $editalService->listar($_POST['ctr_edital'])[0];
 
        $contrato = new Contrato();
        $contrato->setCtrId($_POST['ctr_id']);        
        $contrato->setCtrNumero($_POST['numeroContrato']);        
        $contrato->setCtrDataInicio($_POST['dataInicio']);        
        $contrato->setCtrDataVencimento($_POST['dataVencimento']);        
        $contrato->setCtrValor(str_replace(',','.', str_replace(".", "", $_POST['valor'])));
        $contrato->setCtrStatus($_POST['status']);        
        $contrato->setCtrObservacao($_POST['observacao']);
        $contrato->setCtrAnexo($_POST['anexo']);        
        $contrato->setEdital($edital);        
        $contrato->setCtrPrazoPagamento($_POST['prazoPagamento']);        
        $contrato->setCtrPrazoEntrega($_POST['prazoEntrega']);             
        $contrato->setCtrDataAlteracao($_POST['dataCadastro']);
        $contrato->setUsuario($usuario);
        $anexo =  $_POST['anexo'];
        if($anexo == ""){
            $contrato->setCtrAnexo($_POST['ctrAnexoAlt']);                    
        } else{
            $contrato->setCtrAnexo($_POST['anexo']);        
        }
        $contrato->setCtrObservacao($_POST['observacao']);        
        
        $contrato->setUsuario($usuario);

        Sessao::gravaFormulario($_POST);

        $contratoService = new ContratoService();
    
        $contratoValidador = new ContratoValidador();
        $resultadoValidacao = $contratoValidador->validar($contrato);
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            Sessao::gravaMensagem("erro na atualizacao");
            Sessao::gravaFormulario($_POST);
           $this->redirect('/contrato/edicao/' . $_POST['ctr_id']);
        }        
        if ($contratoService->Editar($contrato)) {
            $this->redirect('/contrato');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();           
        }else{
            Sessao::gravaFormulario($_POST);            
            Sessao::gravaMensagem("erro na atualizacao");
            $this->redirect('/contrato/edicao/'.$_POST['ctr_id']);
        }
    }
    
    public function exclusao($params)
    {
        $ctrId = $params[0];

        $contratoService    = new ContratoService();
        $contrato           = new Contrato();
        $notificacaoService = new NotificacaoService();
        $contrato->setCtrId($ctrId);
        $contrato           = $contratoService->listarDinamico($contrato)[0];
        $codEdital          = $contrato->getEdital()->getEdtId();        
        $notificacao        = $notificacaoService->qtdeNotificacaoPorEdital($codEdital);
        
        
        if (!$contrato) {
        Sessao::gravaMensagem("Contrato inexistente");
           $this->redirect('/contrato');
        }
        if($notificacao){
            $notificacao = $notificacao->getNtf_numero();
            self::setViewParam('notificacao', $notificacao);               
        }else{
            $notificacao = "";               
            self::setViewParam('notificacao', $notificacao);
        }
        self::setViewParam('contrato', $contrato);

        $this->render('/contrato/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $contrato = new Contrato();
        $contrato->setCtrId($_POST['ctr_id']);

        $contratoService= new ContratoService();

        if (!$contratoService->excluir($contrato)) {
            Sessao::gravaMensagem("Contrato inexistente");
            $this->redirect('/contrato/exclusao/'.$contrato->getCtrId());
        }

        Sessao::gravaMensagem("Contrato excluido com sucesso!");

        $this->redirect('/contrato');
    }
    public function excel()
    {
        $contrato = new Contrato();
        $contratoService = new ContratoService();
        $contrato->setCtrRepresentante($_SESSION['codRepresentante']);
        $contrato->setCtrId($_SESSION['ctr_id']);
        $contrato->setCtrClienteLicitacao($_SESSION['clienteId']);
        $contrato->setCtrNumero($_SESSION['contrato']); 
        $contrato->setCtrStatus($_SESSION['status']);
        $contrato->setCtrModalidade($_SESSION['modalidade']);       
        $contrato->setCtrNumeroLicitacao($_SESSION['numeroLicitacao']);

        $contratos = $contratoService->listarDinamico($contrato);
		if(isset($contratos)){
			// Definimos o nome do arquivo que será exportado
			$arquivo = 'contratos.xls';
            $conta = 0;
            ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="utf-8">
            <title>Relatorio de Contratos</title>
            <head>
            <body><?php
                    // Criamos uma tabela HTML com o formato da planilha
                    $html = '';
                    $html .= '<table border="1">';
                    $html .= '<tr>';
                    $html .= '<th class="text-center" colspan="13">Planilha de Contratos</th>';
                    $html .= '</tr>';
                    
                    
                    $html .= '<tr>';
                            $html .= '<th class="text-center">ORDEM</th>';
                            $html .= '<th class="text-center">CÓDIGO</th>';
                            $html .= '<th class="text-center">CLIENTE</th>';
                            $html .= '<th class="text-center">TIPO</th>';
                            $html .= '<th class="text-center">NUMERO</th>';
                            $html .= '<th class="text-center">EMPRESA</th>';
                            $html .= '<th class="text-center">VENCIMENTO</th>';
                            $html .= '<th class="text-center">VALOR</th>';
                            $html .= '<th class="text-center">USUARIO</th>';
                            $html .= '<th class="text-center">ENTREGA</th>';
                            $html .= '<th class="text-center">PAGTO</th>';
                            $html .= '<th class="text-center">STATUS</th>';
                            $html .= '<th class="text-center">EDITAL</th>';			
                    $html .= '</tr>';
                    
                    foreach($contratos as $contrato){
                        $conta += 1;
                        $valor = str_replace(',','.', str_replace(".", "", $contrato->getCtrValor()));
                        $total += $valor;
                        //echo "ID do item: $id <br>";
                        //Selecionar todos os itens da tabela 
                        //$result_msg_contatos = "SELECT * FROM mensagens_contatos WHERE id = $id LIMIT 1";
                        //$resultado_msg_contatos = mysqli_query($conn , $result_msg_contatos);
                        
                        //while($row_msg_contatos = mysqli_fetch_assoc($resultado_msg_contatos)){
                            $html .= '<tr>';
                            $html .= '<td class="text-center">' .$conta.'</td>';
                            $html .= '<td>' .$contrato->getCtrId().'</td>';
                            $html .= '<td>' .$contrato->getEdital()->getClienteLicitacao()->getRazaoSocial().'</td>';
                            $html .= '<td>' .$contrato->getEdital()->getClienteLicitacao()->getTipoCliente().'</td>';
                            $html .= '<td>' .$contrato->getCtrNumero().'</td>';
                            $html .= '<td>' .$contrato->getInstituicao()->getInst_NomeFantasia().'</td>';
                            $html .= '<td>' .$contrato->getCtrDataVencimento()->format('d/m/Y').'</td>';
                            $html .= '<td>R$' .$contrato->getCtrValor().'</td>';
                            $html .= '<td>' .$contrato->getUsuario()->getApelido().'</td>';
                            $html .= '<td>' .$contrato->getCtrPrazoEntrega().'</td>';
                            $html .= '<td>' .$contrato->getCtrPrazoPagamento().'</td>';
                            $html .= '<td>' .$contrato->getCtrStatus().'</td>';
                            $html .= '<td>' .$contrato->getEdital()->getEdtNumero().'</td>';
                            $html .= '</tr>';
                            ;
                        //}
                    }
                    $html .= '<tr>';
                    $html .= '<th class="text-right " colspan="13">VALOR TOTAL R$'.number_format($total, 2, ',', '.').'</th>';                   
                    $html .= '</tr>';
                    // Configurações header para forçar o download
                    header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
                    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
                    header ("Cache-Control: no-cache, must-revalidate");
                    header ("Pragma: no-cache");
                    header ("Content-type: application/x-msexcel");
                    header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
                    header ("Content-Description: PHP Generated Data" );
                    // Envia o conteúdo do arquivo
                    echo $html;           
                    exit;
                }else{			
                    echo "Nenhum Contratolocalizado!";
                }
                ?>
            </body>
        </html>
        <?php
		
    }

}
