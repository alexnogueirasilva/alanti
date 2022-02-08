<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ClienteLicitacaoDAO;
use App\Models\Entidades\ClienteLicitacao;
use App\Models\Entidades\Endereco;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Cidade;
use App\Models\Entidades\Contato;
use App\Models\Entidades\Situacoes;
use App\Models\Validacao\ClienteLicitacaoValidador;
use App\Services\ClienteLicitacaoService;
use App\Services\CidadeService;
use App\Services\SituacoesService;
use App\Services\UsuarioService;
use App\Services\EmailService;

class ClienteLicitacaoController extends Controller
{
    public function index()
    {
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $clienteLicitacao        = new ClienteLicitacao();

       if($_POST){
        $clienteLicitacao->setCodCliente($_POST['pesCliCodigo']);
        $clienteLicitacao->setCnpj($_POST['pesCliCnpj']);
        $clienteLicitacao->setRazaoSocial($_POST['pesCliRazaoSocial']);
        $clienteLicitacao->setNomeFantasia($_POST['pesCliNomeFantasia']);
        $clienteLicitacao->setStatus($_POST['pesCliStatus']);
        $clienteLicitacao->setTipoCliente($_POST['pesCliTipo']);

            self::setViewParam('listar', $clienteLicitacaoService->listar($clienteLicitacao));
    
            $_SESSION['pesCliCodigo']           = $_POST['pesCliCodigo'];
            $_SESSION['pesCliCnpj']             = $_POST['pesCliCnpj'];
            $_SESSION['pesCliRazaoSocial']      = $_POST['pesCliRazaoSocial'];
            $_SESSION['pesCliNomeFantasia']     = $_POST['pesCliNomeFantasia'];
            $_SESSION['pesCliStatus']           = $_POST['pesCliStatus'];
            $_SESSION['pesCliTipo']             = $_POST['pesCliTipo'];
           
        }else{
            unset($_SESSION['pesCliCodigo'],
            $_SESSION['pesCliCnpj'], $_SESSION['pesCliRazaoSocial'],
            $_SESSION['pesCliNomeFantasia'], $_SESSION['pesCliStatus'],
            $_SESSION['pesCliTipo']
            );
        }
        $this->render('/clientelicitacao/index');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function autoComplete($params)
    {
        
        $clienteLicitacao = new ClienteLicitacao();
        $clienteLicitacao->setRazaoSocial($params[0]);
        
        $clienteService = new ClienteLicitacaoService();
        $busca = $clienteService->autoComplete($clienteLicitacao);
        
        echo $busca;
    }
    
    public function listarClienteFalta($params)
    {
        $clienteLicitacaoService = new ClienteLicitacaoService();

        $clienteLicitacao =  new ClienteLicitacao();
        $clienteLicitacao->setNomeFantasia($params[0]);

        $busca = $clienteLicitacaoService->listarClienteFalta($clienteLicitacao);

        echo $busca;
    }
    
   public function cadastro()
   {
        $cidadeService          = new CidadeService();
        $cidade                 = new Cidade();
        $clienteLicitacao       = new ClienteLicitacao();
        $situacoesService       = new SituacoesService();
        $situacoes              = new Situacoes();
        $usuarioService         = new UsuarioService();
        $usuario                = new Usuario();

        self::setViewParam('listarUsuarios', $usuarioService->listar($usuario));
        
        if(Sessao::existeFormulario()) {
            $situacoes->setSitId(Sessao::retornaValorFormulario('status'));
            $situacoes = $situacoesService->listar($situacoes)[0];
            $cidadeId  = Sessao::retornaValorFormulario('cidade');
            $cidade->setCidId($cidadeId);
            $cidade    = $cidadeService->listar($cidade)[0];

            $clienteLicitacao->setRazaoSocial(Sessao::retornaValorFormulario('razaoSocial'));
            $clienteLicitacao->setNomeFantasia(Sessao::retornaValorFormulario('nomeFantasia'));
            $clienteLicitacao->setTrocaMarca(Sessao::retornaValorFormulario('trocaMarca'));
            $clienteLicitacao->setTipoCliente(Sessao::retornaValorFormulario('tipoCliente'));
            $clienteLicitacao->setCliPessoa(Sessao::retornaValorFormulario('pessoa'));
            $clienteLicitacao->setCnpj(Sessao::retornaValorFormulario('cnpj'));
            $clienteLicitacao->setSituacoes($situacoes);

            $clienteLicitacao->setCliContato(Sessao::retornaValorFormulario('contato'));
            $clienteLicitacao->setCliCargo(Sessao::retornaValorFormulario('cargo'));
            $clienteLicitacao->setCliTelefone(Sessao::retornaValorFormulario('telefone'));
            $clienteLicitacao->setCliCelular(Sessao::retornaValorFormulario('celular'));
            $clienteLicitacao->setCliEmail(Sessao::retornaValorFormulario('email'));
            $clienteLicitacao->setEndCidade($cidade);
            $clienteLicitacao->setCliObservacao(Sessao::retornaValorFormulario('observacao'));           
            $clienteLicitacao->setEndPontoReferencia(Sessao::retornaValorFormulario('pontoreferencia'));
            $clienteLicitacao->setEndComplemento(Sessao::retornaValorFormulario('complemento'));  
            $clienteLicitacao->setEndLongradouro(Sessao::retornaValorFormulario('longradouro'));
            $clienteLicitacao->setEndNumero(Sessao::retornaValorFormulario('numero'));
            $clienteLicitacao->setEndBairro(Sessao::retornaValorFormulario('bairro'));           
            $clienteLicitacao->setEndPontoReferencia(Sessao::retornaValorFormulario('pontoreferencia'));
            $clienteLicitacao->setEndComplemento(Sessao::retornaValorFormulario('complemento'));   

        }else{
            self::setViewParam('listarCidades', $cidadeService->listar($cidade));
            $clienteLicitacao->setEndCidade(new Cidade());
        }        
        self::setViewParam('listarStatus', $situacoesService->listar($situacoes));
        $this->setViewParam('cliente',$clienteLicitacao);
        $this->render('/clientelicitacao/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

   public function salvar()
    {
        $clienteLicitacao       = new ClienteLicitacao();
        $clienteService         = new ClienteLicitacaoService();
        $usuarioService         = new UsuarioService();
        $cidadeService          = new CidadeService();
        $cidade                 = new Cidade();
        $situacoesService       = new SituacoesService();
        $situacoes              = new Situacoes();
        $usuario                = new Usuario();
        $contato                = new Contato();
        
        $situacoes->setSitId($_POST['status']);
        $situacoes               = $situacoesService->listar($situacoes)[0];
        $usuario->setId($_POST['usuario']);
        $usuario                = $usuarioService->listar($usuario)[0];
        $cidade->setCidId($_POST['cidade']);
        //$cidade->setCidNome($_POST['cidade-autocomplete']);
        $cidade                 = $cidadeService->listar($cidade)[0];
       if($_POST['cnt_contatos']){
           $contato->setContato($_POST['cnt_contato']);
           $contato->setCargo($_POST['cnt_cargo']);
           $contato->setTelefone($_POST['cnt_telefone']);
           $contato->setCelular($_POST['cnt_celular']);
           $contato->setEmail($_POST['cnt_email']);
           $contato->setContatos($_POST['cnt_contatos']);           
        }
        $clienteLicitacao->setContatos($contato);

        $clienteLicitacao->setRazaoSocial($_POST['razaoSocial']);
        $clienteLicitacao->setCnpj($_POST['cnpj']);
        
        if($clienteService->listar($clienteLicitacao)[0])
        {
            Sessao::gravaMensagem("Este Cadastro já existe!.");
           $this->redirect('/clienteLicitacao/edicao/' . $clienteLicitacao->getCodCliente());
        }
        $clienteLicitacao->setNomeFantasia($_POST['nomeFantasia']);
        $clienteLicitacao->setTrocaMarca($_POST['trocaMarca']);
        $clienteLicitacao->setTipoCliente($_POST['tipoCliente']);
        $clienteLicitacao->setCliContato($_POST['contato']);
        $clienteLicitacao->setCliObservacao($_POST['observacao']);
        $clienteLicitacao->setCliCargo($_POST['cargo']);
        $clienteLicitacao->setCliTelefone($_POST['telefone']);
        $clienteLicitacao->setCliCelular($_POST['celular']);
        $clienteLicitacao->setCliEmail($_POST['email']);
        $clienteLicitacao->setCliPessoa($_POST['pessoa']);
        $clienteLicitacao->setSituacoes($situacoes);
        $clienteLicitacao->setUsuario($usuario);

        $clienteLicitacao->setEndLongradouro($_POST['longradouro']);
        $clienteLicitacao->setEndNumero($_POST['numero']);
        $clienteLicitacao->setEndBairro($_POST['bairro']);
        $clienteLicitacao->setEndCep($_POST['cep']);
        $clienteLicitacao->setEndCidade($cidade);
        $clienteLicitacao->setEndPontoReferencia($_POST['pontoreferencia']);
        $clienteLicitacao->setEndComplemento($_POST['complemento']);
        $clienteLicitacao->setEndPessoa($_POST['pessoa']);
        Sessao::gravaFormulario($_POST);
       
        if ($codCliente = $clienteService->salvar($clienteLicitacao)) {
           /* $clienteLicitacao = new ClienteLicitacao();        
            $clienteLicitacao = $clienteService->listar($codCliente);            
            $codPessoa = $clienteLicitacao->getCliPessoa();
            for($i = 0; $i < count($_POST['cnt_contato']); $i++ ){               
                $contato->setContato($_POST['cnt_contato'][$i]);
                $contato->setCargo($_POST['cnt_cargo'][$i]);
                $contato->setTelefone($_POST['cnt_telefone'][$i]);
                $contato->setCelular($_POST['cnt_celular'][$i]);
                $contato->setPessoa($codPessoa);
                
               // $clienteService->addContato($contato);
            }
            */
            if(isset($_POST['enviarEmail'])){				
				if(!empty($_POST['emails'])){
					$this->Codigo = $codCliente;
					$this->Email = $_POST['emails'];
					$this->Assunto = " Cadastro do Cliente ";
				if($this->enviarEmail()){
						 Sessao::gravaMensagem("Cadastro realizado com sucesso!. <br><br> Cadastro Numero: ".$this->Codigo." e E-mail Enviado com Sucesso!");
					}
				}
			}	
            $this->redirect('/clienteLicitacao/');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();
           
        } else {
            Sessao::gravaMensagem("Erro ao gravar");
        }
    }
      
    public function edicao($params)
    {
        $codCliente = $params[0];

        if (!$codCliente) {
            Sessao::gravaMensagem("Nenhum Cadastro Selecionado");
            $this->redirect('/clienteLicitacao/');
        }

        $clienteLicitacao           = new ClienteLicitacao();
        $clienteLicitacaoService    = new ClienteLicitacaoService();
        $cidadeService              = new CidadeService();
        $cidade                     = new Cidade();
        $usuarioService             = new UsuarioService();
        $situacoesService           = new SituacoesService();
        $usuario                    = new Usuario();
        $situacoes                  = new Situacoes();

        $clienteLicitacao->setCodCliente($codCliente);
        if(Sessao::existeFormulario()) {
            $situacoes->setSitId(Sessao::retornaValorFormulario('status'));
            $situacoes = $situacoesService->listar($situacoes)[0];
            
            $cidade->setCidId(Sessao::retornaValorFormulario('cidade'));
            $cidade                  = $cidadeService->listar($cidade)[0];
            
            $clienteLicitacao->setRazaoSocial(Sessao::retornaValorFormulario('razaoSocial'));
            $clienteLicitacao->setNomeFantasia(Sessao::retornaValorFormulario('nomeFantasia'));
            $clienteLicitacao->setTrocaMarca(Sessao::retornaValorFormulario('trocaMarca'));
            $clienteLicitacao->setTipoCliente(Sessao::retornaValorFormulario('tipoCliente'));
            $clienteLicitacao->setCliPessoa(Sessao::retornaValorFormulario('pessoa'));
            $clienteLicitacao->setCnpj(Sessao::retornaValorFormulario('cnpj'));
            $clienteLicitacao->setSituacoes($situacoes);
            
            $clienteLicitacao->setCliContato(Sessao::retornaValorFormulario('contato'));
            $clienteLicitacao->setCliCargo(Sessao::retornaValorFormulario('cargo'));
            $clienteLicitacao->setCliTelefone(Sessao::retornaValorFormulario('telefone'));
            $clienteLicitacao->setCliCelular(Sessao::retornaValorFormulario('celular'));
            $clienteLicitacao->setCliEmail(Sessao::retornaValorFormulario('email'));
            $clienteLicitacao->setCliObservacao(Sessao::retornaValorFormulario('observacao'));           
            $clienteLicitacao->setEndCidade($cidade);
            $clienteLicitacao->setEndPontoReferencia(Sessao::retornaValorFormulario('pontoreferencia'));
            $clienteLicitacao->setEndComplemento(Sessao::retornaValorFormulario('complemento'));  
            $clienteLicitacao->setEndLongradouro(Sessao::retornaValorFormulario('longradouro'));
            $clienteLicitacao->setEndNumero(Sessao::retornaValorFormulario('numero'));
            $clienteLicitacao->setEndBairro(Sessao::retornaValorFormulario('bairro'));
            $clienteLicitacao->setEndCep(Sessao::retornaValorFormulario('cep'));   
            
        }else{
            $clienteLicitacao = $clienteLicitacaoService->listar($clienteLicitacao)[0];
            
           
        }
        if (!$clienteLicitacao) {
            Sessao::gravaMensagem("Cliente inexistente");
            $this->redirect('/clienteLicitacao/');
        }
        self::setViewParam('listarStatus', $situacoesService->listar($situacoes));
        self::setViewParam('listarUsuarios', $usuarioService->listar($usuario));
        self::setViewParam('clienteLicitacao', $clienteLicitacao);
        $this->render('/clientelicitacao/editar');
        
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function visualizar($params)
    {
        $codCliente = $params[0];

        if (!$codCliente) {
            Sessao::gravaMensagem("Nenhum Cadastro Selecionado");
            $this->redirect('/clienteLicitacao/index');
        }
        $clienteLicitacaoService    = new ClienteLicitacaoService();
        $clienteLicitacao           = new ClienteLicitacao();
        $usuarioService             = new UsuarioService();       
        $usuario                    = new Usuario();

        $clienteLicitacao->setCodCliente($codCliente);
        $clienteLicitacao = $clienteLicitacaoService->listar($clienteLicitacao)[0];

        if (!$clienteLicitacao) {
            Sessao::gravaMensagem("Cliente inexistente");
            $this->redirect('/clienteLicitacao/index');
        }
				
			self::setViewParam('listarUsuarios', $usuarioService->listar($usuario));
			self::setViewParam('clienteLicitacao', $clienteLicitacao);
			$this->render('/clientelicitacao/visualizar');
			Sessao::limpaFormulario();
			Sessao::limpaMensagem();
			Sessao::limpaErro();
    }

   public function atualizar()
   {
        $clienteLicitacao        = new ClienteLicitacao();
        $usuarioService          = new UsuarioService();
        $cidade                  = new Cidade();
        $cidadeService           = new CidadeService();
        $usuario                 = new Usuario();
        $situacoes               = new Situacoes();
        $situacoesService        = new SituacoesService();
        $clienteLicitacaoService = new ClienteLicitacaoService();

        $clienteLicitacao->setCnpj($_POST['cnpj']);
        $clienteLicitacao->setRazaoSocial($_POST['razaoSocial']);
      /* if( $clienteLicitacao = $clienteLicitacaoService->listar($clienteLicitacao)[1])
        {
            Sessao::gravaMensagem("Este Cadastro já existe!.");
            $this->redirect('/clienteLicitacao/edicao/' . $clienteLicitacao->getCodCliente());
        }*/
        
        $situacoes->setSitId($_POST['status']);
        $situacoes               = $situacoesService->listar($situacoes)[0];
        $usuario->setId($_POST['usuario']);
        $usuario                 = $usuarioService->listar($usuario)[0];
        $cidade->setCidId($_POST['cidade']);
        $cidade                  = $cidadeService->listar($cidade)[0];

        $clienteLicitacao->setCodCliente($_POST['codCliente']);
        $clienteLicitacao->setNomeFantasia($_POST['nomeFantasia']);
        $clienteLicitacao->setTrocaMarca($_POST['trocaMarca']);
        $clienteLicitacao->setTipoCliente($_POST['tipoCliente']);        
        $clienteLicitacao->setCliContato($_POST['contato']);
        $clienteLicitacao->setCliCargo($_POST['cargo']);
        $clienteLicitacao->setCliTelefone($_POST['telefone']);
        $clienteLicitacao->setCliCelular($_POST['celular']);
        $clienteLicitacao->setCliObservacao($_POST['observacao']);
        $clienteLicitacao->setCliEmail($_POST['email']);
        $clienteLicitacao->setCliPessoa($_POST['pessoa']);
        $clienteLicitacao->setSituacoes($situacoes);
        $clienteLicitacao->setUsuario($usuario);
        $clienteLicitacao->setEndLongradouro($_POST['longradouro']);
        $clienteLicitacao->setEndNumero($_POST['numero']);
        $clienteLicitacao->setEndBairro($_POST['bairro']);
        $clienteLicitacao->setEndCidade($cidade);
        $clienteLicitacao->setEndPontoReferencia($_POST['pontoreferencia']);
        $clienteLicitacao->setEndComplemento($_POST['complemento']);
        $clienteLicitacao->setEndPessoa($_POST['pessoa']);
        $clienteLicitacao->setEndCep($_POST['cep']);
        Sessao::gravaFormulario($_POST);
        
        $clienteLicitacaoValidador = new ClienteLicitacaoValidador();
        $resultadoValidacao = $clienteLicitacaoValidador->validar($clienteLicitacao);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/ClienteLicitacao/edicao/' . $_POST['codCliente']);
        }
        
        if($clienteLicitacaoService->alterar($clienteLicitacao)){
            if(isset($_POST['enviarEmail'])){				
				if(!empty($_POST['emails'])){
					$this->Codigo = $_POST['codCliente'];
					$this->Email = $_POST['emails'];
					$this->Assunto = " Alteração do Cliente ";
				if($this->enviarEmail()){
						 Sessao::gravaMensagem("Cadastro Alterado com Sucesso. <br><br> Cadastro Numero: ".$this->Codigo." e E-mail Enviado com Sucesso!");
					}
				}
			}	
            $this->redirect('/clienteLicitacao/');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();
        }else{
            $this->redirect('/clienteLicitacao/edicao/' . $_POST['codCliente']);
        }       
    }

    public function exclusao($params)
    {

        $codCliente = $params[0];

        $clienteLicitacaoService = new ClienteLicitacaoService();
        $clienteLicitacao = new ClienteLicitacao();
        $clienteLicitacao->setCodCliente($codCliente);
        $clienteLicitacao = $clienteLicitacaoService->listar($clienteLicitacao)[0];

        if (!$clienteLicitacao) {
            Sessao::gravaMensagem("Cliente inexistente");
            $this->redirect('/clienteLicitacao/');
        }

        self::setViewParam('clienteLicitacao', $clienteLicitacao);
        $this->render('/clientelicitacao/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $clienteLicitacao = new ClienteLicitacao();
        $clienteLicitacao->setCodCliente($_POST['codCliente']);

        $clienteLicitacaoDAO = new ClienteLicitacaoDAO();

        if (!$clienteLicitacaoDAO->excluir($clienteLicitacao)) {
            Sessao::gravaMensagem("clienteLicitacao inexistente");
            $this->redirect('/clienteLicitacao/exclusao/'.$_POST['codCliente']);
        }

        Sessao::gravaMensagem("clienteL excluido com sucesso!");

        $this->redirect('/clienteLicitacao/');
    }

    public function sicronizar ()
    {      
        $clienteLicitacaoService = new ClienteLicitacaoService();

        if (!$clienteLicitacaoService->sicronizar()) {
            Sessao::gravaMensagem("Erro ao sicronizar cientes");
            $this->redirect('/clienteLicitacao/index');
        }
    
        $this->redirect('/clienteLicitacao/');

       Sessao::limpaFormulario();
       Sessao::limpaMensagem();
       Sessao::limpaErro();
    }
      public function excel()
    {
      $clienteLicitacao         = new ClienteLicitacao();
      $clienteLicitacaoService  = new ClienteLicitacaoService();
        
      $clienteLicitacao->setCodCliente($_SESSION['pesCliCodigo']);           
      $clienteLicitacao->setCnpj($_SESSION['pesCliCnpj']);        
      $clienteLicitacao->setRazaoSocial($_SESSION['pesCliRazaoSocial']);        
      $clienteLicitacao->setNomeFantasia($_SESSION['pesCliNomeFantasia']);        
      $clienteLicitacao->setStatus($_SESSION['pesCliStatus']);              
      $clienteLicitacao->setTipoCliente($_SESSION['pesCliTipo']);      

        $dados =$clienteLicitacaoService->listar($clienteLicitacao);
		if(isset($dados)){
            // Definimos o nome do arquivo que será exportado
			$arquivo = 'Clientes_'.date('dmY_His').'.xls';
            $conta = 0;
            ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="utf-8">
            <title>Relatorio de Clientes</title>

            <head>

            <body><?php
                    // Criamos uma tabela HTML com o formato da planilha
                    $html = '';
                    $html .= '<table border="1">';
                    $html .= '<tr>';
                    $html .= '<th class="text-center" colspan="11">Relatorio de Clientes</th>';
                    $html .= '</tr>';                    
                    $html .= '<tr>';
                    $html .= '<th class="text-center">ORDEM</th>';
                    $html .= '<th class="text-center">CÓDIGO</th>';
                    $html .= '<th class="text-center">RAZAO SOCIAL</th>';
                    $html .= '<th class="text-center">NOME FANTASIA</th>';
                    $html .= '<th class="text-center">UF</th>';
                    $html .= '<th class="text-center">CNPJ</th>';
                    $html .= '<th class="text-center">TROCA MARCA</th>';
                    $html .= '<th class="text-center">TIPO</th>';
                    $html .= '<th class="text-center">STATUS</th>';
                    $html .= '<th class="text-center">DATA CADASTRO</th>';
                    $html .= '<th class="text-center">DATA ALTERACAO</th>';                   
                    $html .= '</tr>';
                    
                    foreach($dados as$clienteLicitacao){
                        $conta += 1;
                            $html .= '<tr>';
                                $html .= '<td class="text-center">' .$conta.'</td>';
                                $html .= '<td>'.$clienteLicitacao->getCodCliente().'</td>';
                                $html .= '<td>'.$clienteLicitacao->getRazaoSocial().'</td>';
                                $html .= '<td>'.$clienteLicitacao->getNomeFantasia().'</td>';
                                $html .= '<td>'.$clienteLicitacao->getEndCidade()->getEstado()->getEstUf().'</td>';
                                $html .= '<td>'.$clienteLicitacao->getCNPJ().'</td>';
                                $html .= '<td>'.$clienteLicitacao->getTrocaMarca().'</td>';
                                $html .= '<td>'.$clienteLicitacao->getTipoCliente().'</td>';
                                $html .= '<td>'.$clienteLicitacao->getSituacoes()->getSitNome().'</td>';
                                $html .= '<td>'.$clienteLicitacao->getCliDataCadastro()->format('d/m/Y H:i:s').'</td>';
                                $html .= '<td>'.$clienteLicitacao->getCliDataAlteracao()->format('d/m/Y H:i:s').'</td>';
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
         $this->redirect('/clienteLicitacao/');
    }
    
    private $Assunto;
	private $Email;
	private $Codigo;
	public function envioEmailCliente($params)
	{		
		if(isset($_POST['enviarEmail'])){				
			if(!empty($_POST['emails'])){
				if($params[0]){
					$this->Codigo = $params[0];
					$this->Email = $_POST['emails'];					
					$this->Assunto = " Enviando E-mail do Cliente ";
					if($this->enviarEmail()){
						Sessao::gravaMensagem("E-mail Enviado com Sucesso!");
						$this->redirect('/clienteLicitacao/index');
					}else{
						Sessao::gravaMensagem("Erro ao enviar Email");
						$this->redirect('/clienteLicitacao/visualizar/'.$this->Codigo);
					}  
				}
			}
		}else{
			$this->Codigo = $params[0];
			Sessao::gravaMensagem("Favor informar um Email");
			$this->redirect('/clienteLicitacao/visualizar/'.$this->Codigo);
		} 
			Sessao::limpaFormulario();
			Sessao::limpaMensagem();
			Sessao::limpaErro();		
	}
	
	private function enviarEmail()
	{		
		$emailService 				= new EmailService();
		$clienteLicitacao           = new ClienteLicitacao();
		$clienteLicitacaoService    = new ClienteLicitacaoService();
		$clienteLicitacao->SetCodCliente($this->Codigo);
		$clienteLicitacao = $clienteLicitacaoService->listar($clienteLicitacao)[0];
		
       $codigo          = $clienteLicitacao->getCodCliente();           
       $razaoSocial     = $clienteLicitacao->getRazaoSocial();           
       $nomeFantasia    = $clienteLicitacao->getNomeFantasia();           
       $cidade        	= $clienteLicitacao->getEndCidade()->getCidNome()." - UF: ".$clienteLicitacao->getEndCidade()->getEstado()->getEstNome();           
       $cnpj         	= $clienteLicitacao->getCnpj();
       $tipo            = $clienteLicitacao->getTipoCliente();
       $status          = $clienteLicitacao->getSituacoes()->getSitNome();
       $trocaMarca      = $clienteLicitacao->getTrocaMarca();
	   $cor				= $clienteLicitacao->getSituacoes()->getCors()->getCorCor();
       
       $dadosCadastro .= "
					<table class='table table-striped table-bordered table-hover table-checkable' id='kt_table_3' style='width:50% ' border='3px groove'  >
                            <tr> <td>Codigo</td> <td> $codigo  </td>  </tr>
                            <tr> <td>Razão Social</td> <td> $razaoSocial  </td>  </tr>
                            <tr> <td>Nome Fantasia</td> <td>$nomeFantasia</td></tr>
                            <tr> <td class='text-center'>Cidade</td> <td>$cidade</td></tr>
                            <tr> <td>CNPJ</td> <td>$cnpj</td> </tr>
                            <tr> <td>tipo</td> <td>$tipo</td> </tr>
                            <tr> <td class='text-center'>Status</td> <td><span class='badge badge-pill badge-$cor'>$status</span></td> </tr>
                            <tr> <td class='text-center'>Troca Marca</td> <td>$trocaMarca</td> </tr>
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
       $message .= "<a target='_blank' href=http://".APP_HOST."/clienteLicitacao/visualizar/".$codigo." > Click aqui para visualizar dados do Cliente</a> <br>" . "\r\n";     
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $dadosCadastro. "</p>";       
		if($emailService->envioEmail($this->Email, $this->Assunto, $to = null, $message)){
			return true;
		}else{
			return false;
		}      
	}
     public function enviarEmailTeste()
	{		
		$emailService 				= new EmailService();
		$clienteLicitacao           = new ClienteLicitacao();
		$clienteLicitacaoService    = new ClienteLicitacaoService();
		$clienteLicitacao->setCodCliente($this->Codigo);
		$clienteLicitacao = $clienteLicitacaoService->listar($clienteLicitacao)[0];
		//$_SESSION['instituicao'] = 4;
       $codigo          = $clienteLicitacao->getCodCliente();           
       $razaoSocial     = $clienteLicitacao->getRazaoSocial();           
       $nomeFantasia    = $clienteLicitacao->getNomeFantasia();           
       $cidade        	= $clienteLicitacao->getEndCidade()->getCidNome()." - UF: ".$clienteLicitacao->getEndCidade()->getEstado()->getEstNome();           
       $cnpj         	= $clienteLicitacao->getCnpj();
       $tipo            = $clienteLicitacao->getTipoCliente();
       $status          = $clienteLicitacao->getSituacoes()->getSitNome();
       $trocaMarca      = $clienteLicitacao->getTrocaMarca();
	   $cor				= $clienteLicitacao->getSituacoes()->getCors()->getCorCor();
       
       $dadosCadastro = "
					<table class='table table-striped table-bordered table-hover table-checkable' id='kt_table_3' style='width:50% ' border='3px groove'  >
                            <tr> <td>Codigo</td> <td> $codigo  </td>  </tr>
                            <tr> <td>Razão Social</td> <td> $razaoSocial  </td>  </tr>
                            <tr> <td>Nome Fantasia</td> <td>$nomeFantasia</td></tr>
                            <tr> <td class='text-center'>Cidade</td> <td>$cidade</td></tr>
                            <tr> <td>CNPJ</td> <td>$cnpj</td> </tr>
                            <tr> <td>tipo</td> <td>$tipo</td> </tr>
                            <tr> <td class='text-center'>Status</td> <td><span class='badge badge-pill badge-$cor'>$status</span></td> </tr>
                            <tr> <td class='text-center'>Troca Marca</td> <td>$trocaMarca</td> </tr>
                    </table>";	                
        $hora = date('H'); 
        if (  $hora >= 12 &&  $hora <= 17 ) {
            $saudacao = " Boa Tarde!";
        }else if (  $hora  >= 00 &&  $hora  < 12 ){
            $saudacao = " Bom Dia!";
        }else{
            $saudacao = " Boa Noite!";
        } 
        $this->Email = ['vendas2@fabmed.com.br'];
       $this->Assunto .= " - Codigo: " . $codigo . "  - Cliente: ".$razaoSocial;
       $message = $saudacao.", <br><br> " .$_SESSION['apelido'].  "  efetuou ".$this->Assunto. "<br> " . "\r\n";
       //$message .= "<p align='justify widher:80%;'><h3><pre>" . $mensagem. "</pre></h3></p>";
       $message .= "<a target='_blank' href=http://".APP_HOST."/clienteLicitacao/visualizar/".$codigo." > Click aqui para visualizar dados do Cliente</a> <br><br>" . "\r\n";
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $dadosCadastro. "</p>";       
		if($emailService->envioEmail($this->Email, $this->Assunto, $to = null, $message)){
			return true;
		}else{
			return false;
		}      
	}
}
