<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\Validacao\FornecedorValidador;
use App\Models\Entidades\Fornecedor;
use App\Models\Entidades\Cidade;
use App\Models\Entidades\Contato;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Situacoes;
use App\Services\FornecedorService;
use App\Services\CidadeService;
use App\Services\SituacoesService;
use App\Services\UsuarioService;
use App\Services\EmailService;

class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedorService  = new FornecedorService();
        $fornecedor         = new Fornecedor();

        if($_POST){
            $fornecedor->setFornecedor_Cod($_POST['pesForCodigo']);
            $fornecedor->setForCnpj($_POST['pesForCnpj']);
            $fornecedor->setForRazaoSocial($_POST['pesForRazaoSocial']);
            $fornecedor->setForNomeFantasia($_POST['pesForNomeFantasia']);
            $fornecedor->setForStatus($_POST['pesForStatus']);
            $fornecedor->setForTipo($_POST['pesForTipo']);    
            self::setViewParam('listaFornecedores',$fornecedorService->listar($fornecedor));      
            
            $_SESSION['pesForCodigo']           = $_POST['pesForCodigo'];
            $_SESSION['pesForCnpj']             = $_POST['pesForCnpj'];
            $_SESSION['pesForRazaoSocial']      = $_POST['pesForRazaoSocial'];
            $_SESSION['pesForNomeFantasia']     = $_POST['pesForNomeFantasia'];
            $_SESSION['pesForStatus']           = $_POST['pesForStatus'];
            $_SESSION['pesForTipo']             = $_POST['pesForTipo'];
           
        }else{
            unset($_SESSION['pesForCodigo'],
            $_SESSION['pesForCnpj'], $_SESSION['pesForRazaoSocial'],
            $_SESSION['pesForNomeFantasia'], $_SESSION['pesForStatus'],
            $_SESSION['pesForTipo']
            );
        }

        $this->render('/fornecedor/index');

        Sessao::limpaMensagem();
        Sessao::limpaErro();
        Sessao::limpaFormulario();
    }
    
    public function cadastro()
    {
        $cidadeService          = new CidadeService();
        $cidade                 = new Cidade();
        $fornecedor             = new Fornecedor();
        $situacoesService       = new SituacoesService();
        $situacoes              = new Situacoes();
        $usuarioService         = new UsuarioService();
        $usuario                = new Usuario();

        self::setViewParam('listarUsuarios', $usuarioService->listar($usuario));
        self::setViewParam('listarStatus', $situacoesService->listar($situacoes));

        if(Sessao::existeFormulario()) {
            $situacoes->setSitId(Sessao::retornaValorFormulario('status'));
            $situacoes = $situacoesService->listar($situacoes)[0];
            $cidade->setCidId(Sessao::retornaValorFormulario('cidade'));
            $cidade    = $cidadeService->listar($cidade)[0];
            
            $fornecedor->setForRazaoSocial(Sessao::retornaValorFormulario('razaoSocial'));
            $fornecedor->setForNomeFantasia(Sessao::retornaValorFormulario('nomeFantasia'));
            $fornecedor->setForCnpj(Sessao::retornaValorFormulario('cnpj'));
            $fornecedor->setForIE(Sessao::retornaValorFormulario('forIe'));
            $fornecedor->setForTipo(Sessao::retornaValorFormulario('forTipo'));
            $fornecedor->setForObservacao(Sessao::retornaValorFormulario('forObservacao'));
            $fornecedor->setForEmail(Sessao::retornaValorFormulario('email'));
            $fornecedor->setForContato(Sessao::retornaValorFormulario('contato'));
            $fornecedor->setForCargo(Sessao::retornaValorFormulario('cargo'));
            $fornecedor->setForCelular(Sessao::retornaValorFormulario('celular'));
            $fornecedor->setForTelefone(Sessao::retornaValorFormulario('telefone'));
            $fornecedor->setEndBairro(Sessao::retornaValorFormulario('bairro'));
            $fornecedor->setEndCep(Sessao::retornaValorFormulario('cep'));
            $fornecedor->setEndComplemento(Sessao::retornaValorFormulario('complemento'));
            $fornecedor->setEndLongradouro(Sessao::retornaValorFormulario('longradouro'));
            $fornecedor->setEndNumero(Sessao::retornaValorFormulario('numero'));
            $fornecedor->setEndPontoReferencia(Sessao::retornaValorFormulario('pontoreferencia'));
            $fornecedor->setEndCidade($cidade);
            $fornecedor->setSituacoes($situacoes);

        }else{
            self::setViewParam('listarCidades', $cidadeService->listar($cidade));
            $fornecedor->setEndCidade(new Cidade());
        }        
    
        $this->setViewParam('fornecedor',$fornecedor);
        $this->render('/fornecedor/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar() 
    {
        $fornecedor        = new Fornecedor();
        $cidade            = new Cidade();
        $contato           = new Contato();
        $fornecedorService = new FornecedorService();
        $cidadeService     = new CidadeService();
        $cidadeService     = new CidadeService();
        $situacoesService  = new SituacoesService();
        $situacoes         = new Situacoes();

        $situacoes->setSitId($_POST['status']);
        $situacoes = $situacoesService->listar($situacoes)[0];
        if($_POST['cnt_contatos']){
            $contato->setContato($_POST['cnt_contato']);
            $contato->setCargo($_POST['cnt_cargo']);
            $contato->setTelefone($_POST['cnt_telefone']);
            $contato->setCelular($_POST['cnt_celular']);
            $contato->setEmail($_POST['cnt_email']);
            $contato->setContatos($_POST['cnt_contatos']);
        }
        $fornecedor->setContatos($contato);
        $cidade->setCidId($_POST['cidade']);
        $cidade    = $cidadeService->listar($cidade)[0];
        
        $fornecedor->setForRazaoSocial($_POST['razaoSocial']);
        $fornecedor->setForNomeFantasia($_POST['nomeFantasia']);
        $fornecedor->setForCnpj($_POST['cnpj']);
        $fornecedor->setForIE($_POST['forIe']);
        $fornecedor->setForTipo($_POST['forTipo']);
        $fornecedor->setForObservacao($_POST['forObservacao']);           
        $fornecedor->setForEmail($_POST['email']);
        $fornecedor->setForContato($_POST['contato']);
        $fornecedor->setForCargo($_POST['cargo']);
        $fornecedor->setForTelefone($_POST['telefone']);
        $fornecedor->setForCelular($_POST['celular']);     
        $fornecedor->setForUsuario($_SESSION['id']);     
        $fornecedor->setSituacoes($situacoes);
        
        $fornecedor->setEndLongradouro($_POST['longradouro']);
        $fornecedor->setEndNumero($_POST['numero']);
        $fornecedor->setEndBairro($_POST['bairro']);            
        $fornecedor->setEndCep($_POST['cep']);
        $fornecedor->setEndCidade($cidade);
        $fornecedor->setEndComplemento($_POST['complemento']);  
        $fornecedor->setEndPontoReferencia($_POST['pontoreferencia']);
        
        Sessao::gravaFormulario($_POST);

        $fornecedorValidador = new FornecedorValidador();
        $resultadoValidacao = $fornecedorValidador->validar($fornecedor);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/fornecedor/cadastro');
        }       

        if($codFornecedor = $fornecedorService->salvar($fornecedor)){
            if(isset($_POST['enviarEmail'])){				
				if(!empty($_POST['emails'])){
					$this->Codigo = $codFornecedor;
					$this->Email = $_POST['emails'];
					$this->Assunto = " Cadastro de Fornecedor ";
					if($this->enviarEmail()){
						 Sessao::gravaMensagem("Cadastro realizado com sucesso!. <br><br> Cadastro Numero: ".$this->Codigo." e E-mail Enviado com Sucesso!");
					}
				}
			}	
            $this->redirect('/fornecedor');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();
      
        }else{
            $this->redirect('/fornecedor/cadastro');
        }
       
    }
    
    public function edicao($params){
        $codFornecedor = $params[0];

        $cidadeService              = new CidadeService();
        $cidade                     = new Cidade();
        $fornecedorService          = new FornecedorService();
        $fornecedor                 = new Fornecedor();
        $situacoesService           = new SituacoesService();
        $situacoes                  = new Situacoes();
        $usuarioService             = new UsuarioService();
        $usuario                    = new Usuario();

        $fornecedor->setFornecedor_Cod($codFornecedor);
        $fornecedor = $fornecedorService->listar($fornecedor)[0];
        if(Sessao::existeFormulario()) {
            $cidade->setCidId(Sessao::retornaValorFormulario('cidade'));
            $cidade    = $cidadeService->listar($cidade)[0];
            
            $fornecedor->setEndCidade($cidade);
            $fornecedor->setForNomeFantasia(Sessao::retornaValorFormulario('nomeFantasia'));
            $fornecedor->setForRazaoSocial(Sessao::retornaValorFormulario('razaoSocial'));
            $fornecedor->setForCnpj(Sessao::retornaValorFormulario('cnpj'));
            $fornecedor->setForPessoa(Sessao::retornaValorFormulario('forPessoa'));          

            $situacoes->setSitId(Sessao::retornaValorFormulario('status'));
            $situacoes = $situacoesService->listar($situacoes)[0];
            $cidade->setCidId(Sessao::retornaValorFormulario('cidade'));
            $cidade    = $cidadeService->listar($cidade)[0];
            
            $fornecedor->setForRazaoSocial(Sessao::retornaValorFormulario('razaoSocial'));
            $fornecedor->setForNomeFantasia(Sessao::retornaValorFormulario('nomeFantasia'));
            $fornecedor->setForCnpj(Sessao::retornaValorFormulario('cnpj'));
            $fornecedor->setForIE(Sessao::retornaValorFormulario('forIe'));
            $fornecedor->setForTipo(Sessao::retornaValorFormulario('forTipo'));
            $fornecedor->setForObservacao(Sessao::retornaValorFormulario('forObservacao'));
            $fornecedor->setForEmail(Sessao::retornaValorFormulario('email'));
            $fornecedor->setForContato(Sessao::retornaValorFormulario('contato'));
            $fornecedor->setForCargo(Sessao::retornaValorFormulario('cargo'));
            $fornecedor->setForCelular(Sessao::retornaValorFormulario('celular'));
            $fornecedor->setForTelefone(Sessao::retornaValorFormulario('telefone'));
            $fornecedor->setEndBairro(Sessao::retornaValorFormulario('bairro'));
            $fornecedor->setEndCep(Sessao::retornaValorFormulario('cep'));
            $fornecedor->setEndComplemento(Sessao::retornaValorFormulario('complemento'));
            $fornecedor->setEndLongradouro(Sessao::retornaValorFormulario('longradouro'));
            $fornecedor->setEndNumero(Sessao::retornaValorFormulario('numero'));
            $fornecedor->setEndPontoReferencia(Sessao::retornaValorFormulario('pontoreferencia'));
            $fornecedor->setEndCidade($cidade);
            $fornecedor->setSituacoes($situacoes);

        }
        if(!$fornecedor){
            Sessao::gravaMensagem("fornecedor inexistente");
            $this->redirect('/fornecedor');
        }
        self::setViewParam('listarStatus', $situacoesService->listar($situacoes));
        self::setViewParam('listarUsuarios', $usuarioService->listar($usuario));
        self::setViewParam('fornecedor',$fornecedor);

        $this->render('/fornecedor/editar');

        Sessao::limpaMensagem();

    }

    public function atualizar()   {

        $fornecedor         = new Fornecedor();
        $cidade             = new Cidade();
        $cidadeService      = new CidadeService();
        $situacoes               = new Situacoes();
        $situacoesService        = new SituacoesService();

        $situacoes->setSitId($_POST['status']);
        $situacoes               = $situacoesService->listar($situacoes)[0];

        $cidade->setCidId($_POST['cidade']);
        $cidade    = $cidadeService->listar($cidade)[0];

        $fornecedor->setEndCidade($cidade);
             
        $fornecedor->setForPessoa($_POST['forPessoa']);   
        
        $fornecedor->setFornecedor_Cod($_POST['codFornecedor']);
        $fornecedor->setForRazaoSocial($_POST['razaoSocial']);
        $fornecedor->setForNomeFantasia($_POST['nomeFantasia']);
        $fornecedor->setForCnpj($_POST['cnpj']);
        $fornecedor->setForIE($_POST['forIe']);
        $fornecedor->setForTipo($_POST['forTipo']);
        $fornecedor->setForObservacao($_POST['forObservacao']);           
        $fornecedor->setForEmail($_POST['email']);
        $fornecedor->setForContato($_POST['contato']);
        $fornecedor->setForCargo($_POST['cargo']);
        $fornecedor->setForTelefone($_POST['telefone']);
        $fornecedor->setForCelular($_POST['celular']);     
        $fornecedor->setForUsuario($_SESSION['id']);     
        $fornecedor->setSituacoes($situacoes);
        
        $fornecedor->setEndLongradouro($_POST['longradouro']);
        $fornecedor->setEndNumero($_POST['numero']);
        $fornecedor->setEndBairro($_POST['bairro']);            
        $fornecedor->setEndCep($_POST['cep']);
        $fornecedor->setEndCidade($cidade);
        $fornecedor->setEndComplemento($_POST['complemento']);  
        $fornecedor->setEndPontoReferencia($_POST['pontoreferencia']);

        Sessao::gravaFormulario($_POST);

        $fornecedorValidador = new FornecedorValidador();
        $resultadoValidacao = $fornecedorValidador->validar($fornecedor);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/fornecedor/edicao/'.$_POST['codFornecedor']);
        }

        $fornecedorService = new FornecedorService();

        if($fornecedorService->alterar($fornecedor)){
            if(isset($_POST['enviarEmail'])){				
				if(!empty($_POST['emails'])){
					$this->Codigo = $_POST['codFornecedor'];
					$this->Email = $_POST['emails'];					
					$this->Assunto = " Alteração do Fornecedor ";
					if($this->enviarEmail()){
						 Sessao::gravaMensagem("Cadastro Alterado com Sucesso. <br><br> Cadastro Numero: ".$this->Codigo." e E-mail Enviado com Sucesso!");
					}
				}
            }
            $this->redirect('/fornecedor');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();
        }else{
            $this->redirect('/fornecedor/edicao/'.$_POST['codFornecedor']);
        }
    }
    
    public function exclusao($params)
    {
        $codFornecedor = $params[0];

        $fornecedorService = new FornecedorService();
        $fornecedor = new Fornecedor();
        $fornecedor->setFornecedor_Cod($codFornecedor);
        $fornecedor = $fornecedorService->listar($fornecedor)[0];

        if(!$fornecedor){
            Sessao::gravaMensagem("fornecedor inexistente");
            $this->redirect('/fornecedor');
        }

        self::setViewParam('fornecedor',$fornecedor);

        $this->render('/fornecedor/exclusao');

        Sessao::limpaMensagem();

    }

    public function excluir()
    {
        $fornecedor         = new Fornecedor();
        $fornecedorService  = new FornecedorService();
        $fornecedor->setFornecedor_Cod($_POST['codFornecedor']);
        $fornecedor = $fornecedorService->listar($fornecedor)[0];

        if (!$fornecedorService->excluir($fornecedor)) {
            Sessao::gravaMensagem("fornecedor inexistente");
            $this->redirect('/fornecedor');
        }

        Sessao::gravaMensagem("fornecedor excluido com sucesso!");

        $this->redirect('/fornecedor');

    }

    public function autoComplete($params)
    {
        $fornecedorService = new FornecedorService();
        $fornecedor = new Fornecedor();
        $fornecedor->setForNomeFantasia($params[0]);

        $busca = $fornecedorService->autoComplete($fornecedor);
        echo $busca;

    }
    public function sicronizar (){
        

        $fornecedorService = new FornecedorService();

        if (!$fornecedorService->sicronizar()) {
            Sessao::gravaMensagem("Erro ao sicronizar fornecedores");
            $this->redirect('/fornecedor');
        }
    
       $this->redirect('/fornecedor');

       Sessao::limpaFormulario();
       Sessao::limpaMensagem();
       Sessao::limpaErro();
    }
    
    public function excel()
    {
       $fornecedor = new Fornecedor();
       $fornecedorService = new FornecedorService();
        
       $fornecedor->setFornecedor_Cod($_SESSION['pesForCodigo']);           
       $fornecedor->setForCnpj($_SESSION['pesForCnpj']);        
       $fornecedor->setForRazaoSocial($_SESSION['pesForRazaoSocial']);        
       $fornecedor->setForNomeFantasia($_SESSION['pesForNomeFantasia']);        
       $fornecedor->setForStatus($_SESSION['pesForStatus']);              
       $fornecedor->setForTipo($_SESSION['pesForTipo']);      

        $dados = $fornecedorService->listar($fornecedor);
		if(isset($dados)){
            // Definimos o nome do arquivo que será exportado
			$arquivo = 'fornecedor_'.date('dmY_His').'.xls';
            $conta = 0;
            ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="utf-8">
            <title>Relatorio de Fornecedores</title>

            <head>

            <body><?php
                    // Criamos uma tabela HTML com o formato da planilha
                    $html = '';
                    $html .= '<table border="1">';
                    $html .= '<tr>';
                    $html .= '<th class="text-center" colspan="11">Relatorio de Fornecedores</th>';
                    $html .= '</tr>';                    
                    $html .= '<tr>';
                    $html .= '<th class="text-center">ORDEM</th>';
                    $html .= '<th class="text-center">CÓDIGO</th>';
                    $html .= '<th class="text-center">RAZAO SOCIAL</th>';
                    $html .= '<th class="text-center">NOME FANTASIA</th>';
                    $html .= '<th class="text-center">UF</th>';
                    $html .= '<th class="text-center">CNPJ</th>';
                    $html .= '<th class="text-center">INSC. ESTADUAL</th>';
                    $html .= '<th class="text-center">TIPO</th>';
                    $html .= '<th class="text-center">STATUS</th>';
                    $html .= '<th class="text-center">DATA CADASTRO</th>';
                    $html .= '<th class="text-center">DATA ALTERACAO</th>';                   
                    $html .= '</tr>';
                    
                    foreach($dados as $fornecedor){
                        $conta += 1;
                            $html .= '<tr>';
                                $html .= '<td class="text-center">' .$conta.'</td>';
                                $html .= '<td>'.$fornecedor->getFornecedor_Cod().'</td>';
                                $html .= '<td>'.$fornecedor->getForRazaoSocial().'</td>';
                                $html .= '<td>'.$fornecedor->getForNomeFantasia().'</td>';
                                $html .= '<td>'.$fornecedor->getEndCidade()->getEstado()->getEstUf().'</td>';
                                $html .= '<td>'.$fornecedor->getForCNPJ().'</td>';
                                $html .= '<td>'.$fornecedor->getForIE().'</td>';
                                $html .= '<td>'.$fornecedor->getForTipo().'</td>';
                                $html .= '<td>'.$fornecedor->getSituacoes()->getSitNome().'</td>';
                                $html .= '<td>'.$fornecedor->getForDataCadastro()->format('d/m/Y H:i:s').'</td>';
                                $html .= '<td>'.$fornecedor->getForDataAlteracao()->format('d/m/Y H:i:s').'</td>';
                            $html .= '</tr>';
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
        $this->redirect('/fornecedor');
    }
    
    private $Assunto;
	private $Email;
	private $Codigo;
    private function enviarEmail()
	{		
		$emailService 		  = new EmailService();
		$fornecedor           = new Fornecedor();
		$fornecedorService    = new FornecedorService();
		$fornecedor->setFornecedor_Cod($this->Codigo);
		$fornecedor = $fornecedorService->listar($fornecedor)[0];
		
       $codigo          = $fornecedor->getFornecedor_Cod();           
       $razaoSocial     = $fornecedor->getForRazaoSocial();           
       $nomeFantasia    = $fornecedor->getForNomeFantasia();           
       $cidade        	= $fornecedor->getEndCidade()->getCidNome()." - UF: ".$fornecedor->getEndCidade()->getEstado()->getEstNome();           
       $cnpj         	= $fornecedor->getForCnpj();
       $tipo            = $fornecedor->getForTipo();
       $status          = $fornecedor->getSituacoes()->getSitNome();
       $cor				= $fornecedor->getSituacoes()->getCors()->getCorCor();            
       
       $dadosCadastro .= "
					<table class='table table-striped table-bordered table-hover table-checkable' id='kt_table_3' style='width:50% ' border='3px groove'  >
                            <tr> <td>Codigo</td> <td> $codigo  </td>  </tr>
                            <tr> <td>Razão Social</td> <td> $razaoSocial  </td>  </tr>
                            <tr> <td>Nome Fantasia</td> <td>$nomeFantasia</td></tr>
                            <tr> <td class='text-center'>Cidade</td> <td>$cidade</td></tr>
                            <tr> <td>CNPJ</td> <td>$cnpj</td> </tr>
                            <tr> <td>tipo</td> <td>$tipo</td> </tr>
                            <tr> <td class='text-center'>Status</td> <td><span class='badge badge-pill badge-$cor'>$status</span></td> </tr>                            
                    </table>";	                
        $hora = date('H'); 
        if (  $hora >= 12 &&  $hora <= 17 ) {
            $saudacao = " Boa Tarde!";
        }else if (  $hora  >= 00 &&  $hora  < 12 ){
            $saudacao = " Bom Dia!";
        }else{
            $saudacao = " Boa Noite!";
        } 
       $this->Assunto .= " - Codigo: " . $codigo . "  - Cliente: ".$razaoSocial;
       $message = $saudacao.", <br><br> " .$_SESSION['apelido'].  "  efetuou ".$this->Assunto. "<br> " . "\r\n";
       //$message .= "<p align='justify widher:80%;'><h3><pre>" . $mensagem. "</pre></h3></p>";
       //$message .= "<a target='_blank' href=http://".APP_HOST."/fornecedor/visualizar/".$codigo." > Click aqui para visualizar dados do Cliente</a> <br>" . "\r\n";     
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $dadosCadastro. "</p>";       
		if($emailService->envioEmail($this->Email, $this->Assunto, $to = null, $message)){
			return true;
		}else{
			return false;
		}      
	}
}