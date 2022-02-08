<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\Entidades\Cidade;
use App\Models\Entidades\Garantia;
use App\Models\Entidades\GarantiaStatus;
use App\Models\Entidades\Transportadora;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Edital;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Endereco;
use App\Models\Entidades\Fornecedor;
use App\Models\Validacao\TransportadoraValidador;
use App\Services\EditalStatusService;
use App\Services\FornecedorService;
use App\Services\EditalService;
use App\Services\GarantiaService;
use App\Services\TransportadoraServices;
use App\Services\EmailService;
use App\Services\InstituicaoService;
use App\Services\UsuarioService;
use App\Services\GarantiaStatusService;
use App\Services\CidadeService;

class GarantiaController extends Controller
{
    public function index($params)
    {
        $grtId = $params[0];
        $garantiaService =  new GarantiaService();
        $garantia = $garantiaService->listar($grtId);  
         if($grtId){
            $_SESSION['grtId'] = $grtId;
        }else{
            unset( $_SESSION['grtId']);
        }
        $this->setViewParam('garantia', $garantia);
        $this->render('/garantia/index');
         Sessao::limpaFormulario();
         Sessao::limpaMensagem();
         Sessao::limpaErro();  
    }

    public function cadastro($params)
    {
         if(empty( $params[0])){
            Sessao::gravaMensagem("Nenhuma Edital informado!");
            $this->redirect('/garantia/index');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();       
        }
        $garantiaService        = new GarantiaService();
        $garantiaStatusService  = new GarantiaStatusService();
        $garantiaStatus         = new GarantiaStatus();
        $fornecedorService      = new FornecedorService();
        $editalService          = new EditalService();
        $garantia               = new Garantia();
        $edital                 = new Edital();
        if($params[0]){
            $_SESSION['grtId'] = $params[0];
        }else{
            unset( $_SESSION['grtId']);
        }
        
        $garantias = $garantiaService->listar($params[0]);
        self::setViewParam('garantiastatus', $garantiaStatusService->listar($garantiaStatus));
        if(Sessao::existeFormulario()) 
        {            
            $edital = Sessao::retornaValorFormulario('grtpkidedital');            
            $edital = $editalService->listar($edital);
            $garantia->setGrtPkIdEdital($edital);

            $garantiaStatus->setStGarId(Sessao::retornaValorFormulario('garantiastatus'));
            $garantiaStatus = $garantiaStatusService->listar($garantiaStatus)[0];
            $garantia->setGrtPkIdStatus( $garantiaStatus);  
           
            $fornecedor = Sessao::retornaValorFormulario('grtfornecedor');
            $fornecedor = $fornecedorService->listar($fornecedor);
            $garantia->setGrtFornecedor( $fornecedor);   
           
            $garantia->setGrtDataSolicitacao(Sessao::retornaValorFormulario('grtdatasolicitacao')); 
            $garantia->setGrtDataResultado(Sessao::retornaValorFormulario('grtdataresultado'));
             $garantia->setGrtObservacao(Sessao::retornaValorFormulario('grtobservacao'));
            $garantia->setGrtResultado(Sessao::retornaValorFormulario('grtresultado')); 
            $garantia->setGrtAnexo(Sessao::retornaValorFormulario('grtanexo')); 
            $garantia->setCtrId(Sessao::retornaValorFormulario('grtcodigo')); 
        }else{            
            $garantia->setGrtFornecedor(new Fornecedor());
        }

        $edital = $params[0];
        $edital = $editalService->listar($edital)[0];
        $garantia->setGrtPkIdEdital($edital);
         if(!$edital){
            Sessao::gravaMensagem("Nenhuma Edital Encontrado!");
            $this->redirect('/garantia/index');
       }
        
        $this->setViewParam('garantia',$garantia);
        $this->setViewParam('garantias',$garantias);
        
        $this->render('/garantia/cadastro');
        
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $garantia = new Garantia();
        $edital = new Edital();
        $grtCodigo = $_POST['grtcodigo'];        
        $garantia->setGrtAnexo(trim($_POST['grtanexo']));
        $garantia->setGrtDataSolicitacao(trim($_POST['grtdatasolicitacao']));
        $garantia->setGrtDataResultado(trim($_POST['grtdataresultado']));
        $garantia->setGrtDataRecebido(trim($_POST['grtdatarecebimento']));
        $garantia->setGrtResultado(trim($_POST['grtresultado']));
         $garantia->setGrtObservacao(trim($_POST['grtobservacao']));
       if (ctype_digit($_POST['grtpkidedital'])) {
           $editalService = new EditalService();                  
           $edital = $editalService->listar($_POST['grtpkidedital'])[0];
           $garantia->setGrtPkIdEdital($edital);
        }
        if (ctype_digit($_POST['garantiastatus'])) {
            $garantiaStatusService = new GarantiaStatusService();
            $garantiaStatus = new GarantiaStatus();
            $garantiaStatus->setStGarId($_POST['garantiastatus']);
            $garantiaStatus = $garantiaStatusService->listar($garantiaStatus)[0];
            $garantia->setGrtPkIdStatus( $garantiaStatus);
        }
     
        if (ctype_digit($_POST['grtfornecedor'])) {
            $fornecedorService = new FornecedorService();
            $fornecedor = $fornecedorService->listarId($_POST['grtfornecedor'])[0];
        
        } else {
            throw  new \Exception('Erro ao salvar garantia controller');
        }
        if(empty(trim($_POST['grtdatasolicitacao']))){
            Sessao::gravaMensagem("Favor informar data de solicitação");
            Sessao::gravaFormulario($_POST);
            $this->redirect('/garantia/cadastro/' . $_POST['grtpkidedital']);
        }
        if($_POST['grtresultado'] == 'NAO INFORMAR' AND  empty(trim($_POST['grtobservacao']))){
            Sessao::gravaMensagem("Favor informar o motivo do Satus: ".$_POST['grtresultado']);
            Sessao::gravaFormulario($_POST);
            $this->redirect('/garantia/cadastro/' . $_POST['grtpkidedital']);
        }  
        if (is_null($fornecedor)) {
            throw new \Exception('Erro ao salvar garantia controller');

        } else {
            
            $garantia->setGrtFornecedor($fornecedor);
            $garantiaService = new GarantiaService();
            Sessao::gravaFormulario($_POST);
            if($grtCodigo){
                $anexo =  $_POST['grtanexo'];
                if($anexo == ""){
                    $garantia->setGrtAnexo(trim($_POST['grtanexoAlt']));
                } else{
                    $garantia->setGrtAnexo(trim($_POST['grtanexo']));
                }                       
                $garantia->setCtrId(trim($_POST['grtcodigo']));
                if ($garantiaService->editar($garantia)) {
                    $this->redirect('/garantia/cadastro/' . $_POST['grtpkidedital']);
                    Sessao::limpaFormulario();
                    Sessao::limpaMensagem();
                    Sessao::limpaErro();
                } else {
                   $this->redirect('/garantia/cadastro');
                }
            }else{
                if ($garantiaService->salvar($garantia)) {
                    $this->redirect('/garantia/cadastro/'. $_POST['grtpkidedital']);
                    Sessao::limpaFormulario();
                    Sessao::limpaMensagem();
                    Sessao::limpaErro();
                } else {
                   $this->redirect('/garantia/cadastro');
                }
            }

        }
    }

    public function edicao($params)
    {
        $garantia = new Garantia();
        $garantia->getCtrId();

        $garantiaService        = new GarantiaStatusService();
        $editalService          = new EditalService();
        $fornecedorService      = new FornecedorService();
        $editalstatusService    = new EditalStatusService();

        self::setViewParam('listaeditastatus', $editalstatusService);
        self::setViewParam('listafornecedor', $fornecedorService);

        if (Sessao::existeFormulario())
        {
            $codedtital    =  Sessao::retornaValorFormulario('codedital');
            $edital        =  $editalstatusService->listar($codedtital[0]);
            $garantia->setGrtPkIdEdital($edital);

            $fornecedorcod = Sessao::retornaValorFormulario('fornecdorcod');
            $fornecedor    = $fornecedorService->listar($fornecedorcod[0]);
            $garantia->getGrtFornecedor($fornecedor);

            $codstatusedital = Sessao::retornaValorFormulario('codeditalstatus');
            $editalstatus    = $editalstatusService->listar($codstatusedital);
            $garantia->getGrtPkIdStatus($editalstatus);
        }

    }

    public function exclusao($params)
    {
        $grtid              = $params[0];
        $garantia           =   new Garantia();
        $garantiaService    = new GarantiaService();

        $garantia->setCtrId($grtid);
        $garantia   =   $garantiaService->listar($garantia);

        if (!$garantia)
        {
            throw new \Exception('Erro ao excluir garantia');
        }
        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $edital             = new Edital();
        $edtialService      = new EditalService();
        $garantia           = new Garantia();
        $garantiaService    = new GarantiaService();
        $codigo             = $_POST['grtcodigo'];
        $CodEdital          = $_POST['grtpkidedital'];
              
        if (!$garantiaService->excluir($codigo))
        {
            Sessao::gravaMensagem('Erro ao excluir Garantia!');
            throw new \Exception("Garantia inexistente");
        }else {
            Sessao::gravaMensagem('Garantia excluida com sucesso !');       
        }
        //$this->redirect('/garantia/cadastro/' . $codEdital);
        Sessao::limpaMensagem();
        echo $codigo;
    }
    
    public function excel()
    {
        $garantia = new Garantia();
        $garantiaService = new GarantiaService();
        
        /*$garantia->setEdtCliente($_SESSION['codClienteEdt']);           
        $garantia->setEdtId($_SESSION['codigoEdt']);        
        $garantia->setEdtOperador($_SESSION['operadorEdt']);        
        $garantia->setEdtProposta($_SESSION['propostaEdt']);        
        $garantia->setEdtNumero($_SESSION['numeroLicitacaoEdt']);              
        $garantia->setEdtModalidade($_SESSION['modalidadeEdt']);        
        $garantia->setEdtStatus($_SESSION['statusEdt']);        
        $garantia->setEdtTipo($_SESSION['tipoEdt']);  
        $garantia->setEdtRepresentante($_SESSION['codRepresentanteEdt']);                
        $garantia->setEdtDataInicio($_SESSION['dataInicioEdt']); 
        $garantia->setEdtDataFinal($_SESSION['dataFinalEdt']); */

        $garantias = $garantiaService->listar( $_SESSION['grtId']);
		if(isset($garantias)){
            // Definimos o nome do arquivo que será exportado
			$arquivo = 'garantia_'.date('dmY_His').'.xls';
            $conta = 0;
            ?>
        <!DOCTYPE html>
        <html lang="pt-br">

        <head>
            <meta charset="utf-8">
            <title>Relatorio de garantias</title>

            <head>

            <body><?php
                    // Criamos uma tabela HTML com o formato da planilha
                    $html = '';
                    $html .= '<table border="1">';
                    $html .= '<tr>';
                    $html .= '<th class="text-center" colspan="10">Planilha de Garantias</th>';
                    $html .= '</tr>';                    
                    $html .= '<tr>';
                    $html .= '<th class="text-center">ORDEM</th>';
                     $html .= '<th class="text-center">CODIGO</th>';
                    $html .= '<th class="text-center">STATUS</th>';
                    $html .= '<th class="text-center">MARCA</th>';
                    $html .= '<th class="text-center">CLIENTE</th>';
                    $html .= '<th class="text-center">EDITAL</th>';
                    $html .= '<th class="text-center">DATA SOLICITACAO</th>';
                    $html .= '<th class="text-center">DATA RECEBIMENTO</th>';
                    $html .= '<th class="text-center">DATA RESULTADO</th>';
                    $html .= '<th class="text-center">RESULTADO</th>';                    
                    $html .= '</tr>';
                    
                    foreach($garantias as $garantia){
                        $conta += 1;
                            $html .= '<tr>';
                                $html .= '<td class="text-center">' .$conta.'</td>';
                                $html .= '<td>'.$garantia->getCtrId().'</td>';
                                $html .= '<td>'.$garantia->getGrtPkIdStatus()->getStGarNome().'</td>';
                                $html .= '<td>'.$garantia->getGrtFornecedor()->getForNomeFantasia().'</td>';
                                $html .= '<td>'.$garantia->getGrtPkIdEdital()->getClienteLicitacao()->getNomeFantasia().'</td>';
                                $html .= '<td>'.$garantia->getGrtPkIdEdital()->getEdtNumero().'</td>';
                                $html .= '<td>'.$garantia->getGrtDataSolicitacao()->format('d/m/Y').'</td>';
                                $html .= '<td>';
                                
                                if ($garantia->getGrtPkIdStatus()->getStGarNome() == "NAO GARANTIDO") {
                                    $html .='<span class="badge badge-pill badge-success">NÃO INFORMAR!</span>';                                                       
                                } else{
                                    if($garantia->getGrtPkIdStatus()->getStGarNome() == "NAO RESPONDIDO"){
                                        $html .='<span class="badge badge-pill badge-danger">'. $garantia->getGrtPkIdStatus()->getStGarNome() ."</span>";
                                    }else {                                                        
                                        $html .= $garantia->getGrtDataRecebido()->format('d/m/Y');
                                    }
                                }                                
                                '</td>';
                                $html .= '<td>';
                                if ($garantia->getGrtPkIdStatus()->getStGarNome() == "NAO GARANTIDO") {
                                    $html .= '<span class="badge badge-pill badge-success">NÃO INFORMAR!</span>';                                                                                                           
                                  } else{
                                    if(($garantia->getGrtDataResultado()->format('d/m/Y') == $garantia->getGrtDataSolicitacao()->format('d/m/Y')) || ($garantia->getGrtPkIdStatus()->getStGarNome() == "NAO RESPONDIDO")){
                                        $html .= '<span class="badge badge-pill badge-danger">NÃO INFORMADO</span>';
                                    }else {                                                        
                                        $html .= $garantia->getGrtDataResultado()->format('d/m/Y');
                                    }
                                }                                                                  
                                '</td>';                                
                                $html .= '<td>'.$garantia->getGrtResultado().'</td>';
                            $html .= '</tr>';
                        //}
                    }
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
                    Sessao::gravaMensagem("Nenhum dado encontrado!");
                }
                        ?>
            </body>

        </html>
        <?php		
    }
    
     public function pdf()
    {
        Sessao::gravaMensagem('Em Desenvolvimento!'); 
        $this->redirect('/garantia/index');
    }
}