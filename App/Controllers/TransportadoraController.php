<?php

namespace App\Controllers;


use App\Lib\Sessao;
use App\Models\Entidades\Cidade;
use App\Models\Entidades\Contato;
use App\Models\Entidades\Transportadora;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Endereco;
use App\Models\Entidades\Situacoes;
use App\Models\Validacao\TransportadoraValidador;
use App\Services\TransportadoraService;
use App\Services\EmailService;
use App\Services\InstituicaoService;
use App\Services\UsuarioService;
use App\Services\CidadeService;
use App\Services\SituacoesService;

class TransportadoraController extends Controller
{
    public function index()
    {
        $transportadora         = new Transportadora();
        $transportadoraService = new TransportadoraService();
        self::setViewParam('carregarTransportadoras', $transportadoraService->listar($transportadora));   
        if($_POST)
        {
            $transportadora->setTraId($_POST['codigo']);
            $transportadora->setTraCnpj($_POST['cnpj']);
            $transportadora->setTraStatus($_POST['status']);
            $transportadora->setTraRazaoSocial($_POST['razaoSocial']);
            $transportadora->setTraNomeFantasia($_POST['nomeFantasia']);                     
        }
        self::setViewParam('listarTransportadoras', $transportadoraService->listar($transportadora));
        $this->render('/transportadora/index');
        Sessao::limpaMensagem();
        Sessao::limpaErro();
        Sessao::limpaFormulario();
    }

    public function autoComplete($params)
    {        
        $transportadora = new Transportadora();
        $transportadora->setTraRazaoSocial($params[0]);
        
        $transportadoraService = new TransportadoraService();
        $busca = $transportadoraService->autoComplete($transportadora);
        
        echo $busca;
    }

    public function cadastro()
    {
        $transportadoraService  = new TransportadoraService();
        $transportadora         = new Transportadora();
        $instituicaoService     = new InstituicaoService();
        $cidadeService          = new CidadeService();
        $situacoes              = new Situacoes();
        $situacoesService       = new SituacoesService();
        $cidade                 = new Cidade();
        $usuarioService         = new UsuarioService(); 
        $usuario                = new Usuario(); 

        self::setViewParam('listarUsuarios', $usuarioService->listar($usuario));
        self::setViewParam('listarCidades', $cidadeService->listar($cidade));
        if(Sessao::existeFormulario()) {
            $situacoes->setSitId(Sessao::retornaValorFormulario('status'));
            $situacoes = $situacoesService->listar($situacoes)[0];
            $cidade->setCidId(Sessao::retornaValorFormulario('cidade'));
            $cidade    = $cidadeService->listar($cidade)[0];
            
            $instituicaoId  = Sessao::retornaValorFormulario('instituicao');
            $instituicao    = $instituicaoService->listar($instituicaoId);
            
            $usuario->setId(Sessao::retornaValorFormulario('usuario'));
            $usuario        = $usuarioService->listar($usuario)[0];
            
            $transportadora->setTraRazaoSocial(Sessao::retornaValorFormulario('razaoSocial'));
            $transportadora->setTraNomeFantasia(Sessao::retornaValorFormulario('nomeFantasia'));
            $transportadora->setTraCnpj(Sessao::retornaValorFormulario('cnpj'));
            $transportadora->setTraIE(Sessao::retornaValorFormulario('inscricaoestadual'));
            $transportadora->setTraContato(Sessao::retornaValorFormulario('contato'));
            $transportadora->setTraCargo(Sessao::retornaValorFormulario('cargo'));
            $transportadora->setTraTelefone(Sessao::retornaValorFormulario('telefone'));
            $transportadora->setTraCelular(Sessao::retornaValorFormulario('celular'));
            $transportadora->setTraEmail(Sessao::retornaValorFormulario('email'));
            $transportadora->setTraObservacao(Sessao::retornaValorFormulario('observacao'));
            $transportadora->setTraUsuario($usuario);
            $transportadora->setSituacoes($situacoes);
            $transportadora->setTraInstituicao($instituicao);
            $transportadora->setEndLongradouro(Sessao::retornaValorFormulario('longradouro'));
            $transportadora->setEndNumero(Sessao::retornaValorFormulario('numero'));
            $transportadora->setEndBairro(Sessao::retornaValorFormulario('bairro'));
            $transportadora->setEndCidade($cidade);
            $transportadora->setEndPontoReferencia(Sessao::retornaValorFormulario('pontoreferencia'));
            $transportadora->setEndComplemento(Sessao::retornaValorFormulario('complemento'));            
        }else{
            $transportadora->setEndCidade(new Cidade());
        }
        /*if (!empty($_REQUEST['action']))
        {
            if ($_REQUEST['action'] == 'editar')
            {
                if (!empty($_GET['codigo']))
                {
                    $id = (int) $_GET['codigo'];
                    $this->visualisar($id);               
                }else{
                    var_dump( ' action editar sem ID informado! ');
                }
            }else if ($_REQUEST['action'] == 'salvar')
            {                      
                var_dump($_POST);      
             //   $this->salvar();            
            }else if ($_REQUEST['action'] == 'excluir')
            {  
                if (!empty($_GET['codigo']))
                {
                    $id = (int) $_GET['codigo']; 
                    Sessao::gravaMensagem("<h2 style='color: red'> Deseja excluir o cadastro abaixo?</h2>");    
                   $this->visualisar($id);
                }else{
                    var_dump( ' action editar sem ID informado! ');
                }             
            }
        }else{            
             // $transportadora = $transportadoraService->listar($transportadora);    
                                  
            self::setViewParam('transportadora',  $transportadora);
            $this->render('/transportadora/cadastro');
        }*/
        self::setViewParam('listarStatus', $situacoesService->listar($situacoes));
        $this->setViewParam('transportadora',$transportadora); 
        $this->render('/transportadora/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }
    
    public function visualisar($id = null)
    {
        $transportadoraService  = new TransportadoraService();
        $transportadora         = new Transportadora();
        $cidadeService          = new CidadeService();
        $cidade                 = new Cidade();
        if($id){
            $transportadora = $transportadoraService->listar($transportadora->setTraId($id))[0];            
        }        

        self::setViewParam('listarCidades', $cidadeService->listar($cidade));
        self::setViewParam('transportadora', $transportadora);  
        $this->render('/transportadora/cadastro');
    }

   public function salvar()
    {  
        $transportadora         = new Transportadora();
        $transportadoraService  = new TransportadoraService();
        $instituicaoService     = new InstituicaoService();
        $usuarioService         = new UsuarioService();
        $situacoes              = new Situacoes();
        $situacoesService       = new SituacoesService();
        $cidadeService          = new CidadeService();
        $cidade                 = new Cidade();
        $contato                = new Contato();
        $usuario                = new Usuario();
        $situacoes->setSitId($_POST['status']);
        $situacoes               = $situacoesService->listar($situacoes)[0];
        $usuario->setId($_POST['usuario']);
        $usuario                = $usuarioService->listar($usuario)[0];
        $instituicao            = $instituicaoService->listar($_POST['instituicao']);
        $cidade->setCidId($_POST['cidade']);
        $cidade                 = $cidadeService->listar($cidade)[0];
              
        if($_POST['cnt_contatos']){
            $contato->setContato($_POST['cnt_contato']);
            $contato->setCargo($_POST['cnt_cargo']);
            $contato->setTelefone($_POST['cnt_telefone']);
            $contato->setCelular($_POST['cnt_celular']);
            $contato->setEmail($_POST['cnt_email']);
            $contato->setContatos($_POST['cnt_contatos']);           
         }
        $transportadora->setContatos($contato);
        $transportadora->setTraRazaoSocial($_POST['razaoSocial']);
        $transportadora->setTraNomeFantasia($_POST['nomeFantasia']);
        $transportadora->setTraCnpj($_POST['cnpj']);
        $transportadora->setTraIE($_POST['inscricaoestadual']);
        $transportadora->setTraEmail($_POST['email']);
        $transportadora->setTraContato($_POST['contato']);
        $transportadora->setTraTelefone($_POST['telefone']);
        $transportadora->setTraCelular($_POST['celular']);
        $transportadora->setTraPessoa($_POST['pessoa']);
        $transportadora->setTraObservacao($_POST['observacao']);
        $transportadora->setTraUsuario($usuario);
        $transportadora->setSituacoes($situacoes);
        $transportadora->setTraInstituicao($instituicao);
        $transportadora->setEndLongradouro($_POST['longradouro']);
        $transportadora->setEndNumero($_POST['numero']);
        $transportadora->setEndBairro($_POST['bairro']);
        $transportadora->setEndCidade($cidade);
        $transportadora->setEndPontoReferencia($_POST['pontoreferencia']);
        $transportadora->setEndComplemento($_POST['complemento']);
        $transportadora->setEndPessoa($_POST['pessoa']);
        $mensagem = null;//($_POST['mensagem']);
        Sessao::gravaFormulario($_POST);        
        $transportadoraValidador = new TransportadoraValidador();
        $resultadoValidacao     = $transportadoraValidador->validar($transportadora);        
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/transportadora/cadastro');
        }else{
           
           /* if (!$transportadora) {           
                Sessao::gravaMensagem("sem dados informados");
                $this->redirect('/transportadora/cadastro');
            }
                //  $codTransportadora  = $transportadoraService->salvar($transportadora);
            if ($_POST['acao'] == 'excluir')
            {  
                if (!empty($_POST['codigo']))
                {
                    $id = (int) $_POST['codigo'];                           
                     $this->excluir($id);
                }
            }else if($_POST['acao'] == 'alterar')
            {  
                if (!empty($_POST['codigo']))
                {
                    $id = (int) $_POST['codigo'];
                    $transportadora->setTraId($id);
                    $this->alterar($transportadora);                         
                      $codTransportadora  = $id;
                }
            } else if  ($_POST['acao'] == 'novo')
            {                             
                $codTransportadora  =  $this->gravar($transportadora);        
            }    
            if ($codTransportadora) {
               // $transportadora->setTraId($codTransportadora);
                //var_dump($transportadora->setTraId($codTransportadora));
               // $transportadora = $transportadoraService->listar($transportadora)[0];
                
                $subject = 1;
                $emailService = new EmailService();
                $emailService->emailTransportadora($transportadora,$subject,$mensagem);
                
                $this->redirect('/transportadora'); 
                Sessao::limpaFormulario();
                Sessao::limpaMensagem();
                Sessao::limpaErro();               
            } else {
                $this->redirect('/transportadora/cadastro');
            }*/
        }
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/transportadora/cadastro');
        }
        if($codTransportadora  =  $transportadoraService->salvar($transportadora)){           
            $this->redirect('/transportadora');
        }else{
           
            $this->redirect('/transportadora/cadastro');
        }
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

    }
    
     public function edicao($params)
    {
        $codTransportadora          = $params[0];
        $transportadoraService      = new TransportadoraService();
        $instituicaoService         = new InstituicaoService();
        $cidadeService              = new CidadeService();
        $cidade                     = new Cidade();
        $situacoes                  = new Situacoes();
        $situacoesService           = new SituacoesService();
        $transportadora             = new Transportadora();
        $usuarioService             = new UsuarioService();
        $usuario                    = new Usuario();

        self::setViewParam('listarUsuarios', $usuarioService->listar($usuario));
        if(Sessao::existeFormulario()) {
            $situacoes->setSitId(Sessao::retornaValorFormulario('status'));
            $situacoes = $situacoesService->listar($situacoes)[0];
            $cidade->setCidId(Sessao::retornaValorFormulario('cidade'));
            $cidade    = $cidadeService->listar($cidade)[0];
            
            $instituicaoId  = Sessao::retornaValorFormulario('instituicao');
            $instituicao    = $instituicaoService->listar($instituicaoId);
            
            $usuario->setId(Sessao::retornaValorFormulario('usuario'));
            $usuario        = $usuarioService->listar($usuario)[0];
            
            $transportadora->setTraRazaoSocial(Sessao::retornaValorFormulario('razaoSocial'));
            $transportadora->setTraNomeFantasia(Sessao::retornaValorFormulario('nomeFantasia'));
            $transportadora->setTraCnpj(Sessao::retornaValorFormulario('cnpj'));
            $transportadora->setTraIE(Sessao::retornaValorFormulario('inscricaoestadual'));
            $transportadora->setTraContato(Sessao::retornaValorFormulario('contato'));
            $transportadora->setTraCargo(Sessao::retornaValorFormulario('cargo'));
            $transportadora->setTraTelefone(Sessao::retornaValorFormulario('telefone'));
            $transportadora->setTraCelular(Sessao::retornaValorFormulario('celular'));
            $transportadora->setTraEmail(Sessao::retornaValorFormulario('email'));
            $transportadora->setTraObservacao(Sessao::retornaValorFormulario('observacao'));
            $transportadora->setTraUsuario($usuario);
            $transportadora->setSituacoes($situacoes);
            $transportadora->setTraInstituicao($instituicao);
            $transportadora->setEndLongradouro(Sessao::retornaValorFormulario('longradouro'));
            $transportadora->setEndNumero(Sessao::retornaValorFormulario('numero'));
            $transportadora->setEndBairro(Sessao::retornaValorFormulario('bairro'));
            $transportadora->setEndCidade($cidade);
            $transportadora->setEndPontoReferencia(Sessao::retornaValorFormulario('pontoreferencia'));
            $transportadora->setEndComplemento(Sessao::retornaValorFormulario('complemento'));            
        }else{
            $transportadora = $transportadoraService->listar($transportadora->setTraId($codTransportadora))[0];
        }
        if (!$transportadora) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/transportadora');
        }
        self::setViewParam('listarStatus', $situacoesService->listar($situacoes));
        self::setViewParam('listarCidades', $cidadeService->listar($cidade));
        self::setViewParam('transportadora', $transportadora);
       $this->render('/transportadora/editar');
        Sessao::limpaMensagem();
    }


    public function atualizar()
    {  
        $transportadora         = new Transportadora();
        $transportadoraService  = new TransportadoraService();
        $instituicaoService     = new InstituicaoService();
        $usuarioService         = new UsuarioService();
        $cidadeService          = new CidadeService();
        $situacoes              = new Situacoes();
        $situacoesService       = new SituacoesService();
        $cidade                 = new Cidade();
        $usuario                = new Usuario();
        $situacoes->setSitId($_POST['status']);
        $situacoes               = $situacoesService->listar($situacoes)[0];
        $usuario->setId($_POST['usuario']);
        $usuario                = $usuarioService->listar($usuario)[0];
        $instituicao            = $instituicaoService->listar($_POST['instituicao']);
        $cidade->setCidId($_POST['cidade']);
        $cidade                 = $cidadeService->listar($cidade)[0];
              
        $transportadora->setTraId($_POST['codigo']);
        $transportadora->setTraRazaoSocial($_POST['razaoSocial']);
        $transportadora->setTraNomeFantasia($_POST['nomeFantasia']);
        $transportadora->setTraCnpj($_POST['cnpj']);
        $transportadora->setTraIE($_POST['inscricaoestadual']);
        $transportadora->setTraContato($_POST['contato']);
        $transportadora->setTraCargo($_POST['cargo']);
        $transportadora->setTraTelefone($_POST['telefone']);
        $transportadora->setTraCelular($_POST['celular']);
        $transportadora->setTraEmail($_POST['email']);
        $transportadora->setTraPessoa($_POST['pessoa']);
        $transportadora->setTraObservacao($_POST['observacao']);
        $transportadora->setSituacoes($situacoes);
        $transportadora->setTraUsuario($usuario);
        $transportadora->setTraInstituicao($instituicao);
        $transportadora->setEndLongradouro($_POST['longradouro']);
        $transportadora->setEndNumero($_POST['numero']);
        $transportadora->setEndBairro($_POST['bairro']);
        $transportadora->setEndCidade($cidade);
        $transportadora->setEndPontoReferencia($_POST['pontoreferencia']);
        $transportadora->setEndComplemento($_POST['complemento']);
        $transportadora->setEndPessoa($_POST['pessoa']);
        $mensagem = null;//($_POST['mensagem']);
        Sessao::gravaFormulario($_POST);        
        $transportadoraValidador = new TransportadoraValidador();
        $resultadoValidacao     = $transportadoraValidador->validar($transportadora);        
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/transportadora/cadastro');
        }
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/transportadora/edicao/' . $_POST['codigo']);
        }
        if ($transportadoraService->alterar($transportadora)) {
            /*if(isset($_POST['enviarEmail'])){  
               $pedido->setCodControle($_POST['codControle']);
               $pedido = $pedidoService->listar($pedido)[0];  
           
               $email = $_POST['emails'];
               $emailService = new EmailService();
               $subject = 2;
               $emailService->email($pedido, $email,$subject);*/
           
           $this->redirect('/transportadora');
           Sessao::limpaFormulario();
           Sessao::limpaMensagem();
           Sessao::limpaErro();           
        }else{
           Sessao::gravaFormulario($_POST);            
           Sessao::gravaMensagem("erro na atualizacao");
           $this->redirect('/transportadora/edicao/' . $_POST['codigo']);
        }

    }


    public function gravar($id)
    {
        $transportadora = new Transportadora();       
        
        $transportadoraService = new TransportadoraService();        
        $transportadora = ($transportadoraService->listar($transportadora->setTraId($id))[0]);
        Sessao::gravaFormulario($_POST);
        if(!$transportadoraService->salvar($transportadora)) {
            Sessao::gravaMensagem("Cadastro inexistente");
            Sessao::gravaErro("Erro ao excluir cadastro!");
            $this->redirect('/transportadora/cadastro'.$transportadora->getTraId());
        }
        Sessao::gravaMensagem("Cadastro alterado com sucesso!");
        $this->redirect('/transportadora');

    }

    public function alterar($transportadora)
    {        
        $transportadoraService = new TransportadoraService();        
        Sessao::gravaFormulario($_POST);        
        if(!$transportadoraService->alterar($transportadora)) {
            Sessao::gravaMensagem("Cadastro inexistente");
            Sessao::gravaErro("Erro ao excluir cadastro!");
            $this->redirect('/transportadora/cadastro/'.$transportadora->getTraId());
        }
        Sessao::gravaMensagem("Cadastro alterado com sucesso!");
        $this->redirect('/transportadora');

    }

    public function exclusao($params)
    {
        $codTransportadora        = $params[0];        
        $transportadora             = new Transportadora();        
        $transportadoraService      = new TransportadoraService();
                
        $transportadora->setTraId($codTransportadora);
        $transportadora     = $transportadoraService->listar($transportadora)[0];
    
        if (!$transportadora) {
            Sessao::gravaMensagem("Cadastro inexistente!");
            $this->redirect('/transportadora');
        }
        
        self::setViewParam('transportadora', $transportadora);
       $this->render('/transportadora/excluir');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {

        $transportadora         = new Transportadora();
        $transportadoraService  = new TransportadoraService();
        $transportadora->setTraId($_POST['codigo']);
       // $transportadora->setTraId($transportadora);
        $transportadora = $transportadoraService->listar($transportadora)[0];

        if (!$transportadoraService->excluir($transportadora)) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/transportadora');
        }
        Sessao::gravaMensagem("Cadastro excluido com sucesso!<br><br> Codigo: ".$transportadora->getTraId());

        $this->redirect('/transportadora');
        Sessao::limpaMensagem();
    }  

}
