<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\DepartamentoDAO;
use App\Models\Entidades\Usuario;
use App\Services\UsuarioService;
use App\Services\DepartamentoService;
use App\Services\EmailService;

use App\Models\Validacao\UsuarioValidador;

class UsuarioController extends Controller
{
    private $Assunto;
	private $Email;
    private $Codigo;
    private $Senha;
    
    public function index()
    {
        $usuarioService         = new UsuarioService();
        $departamentoService    = new DepartamentoService();
        $usuario            = new Usuario();

        self::setViewParam('listaDepartamentos', $departamentoService->listar()); 
        self::setViewParam('listaUsuarios', $usuarioService->listar($usuario));

        $this->render('/usuario/index');
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }
    
    public function listarUsuarios()
    {
        $usuarioService         = new UsuarioService();
        $usuario                = new Usuario();
        $departamentoService    = new DepartamentoService();
        $usuario                = new Usuario();      
        
        self::setViewParam('listaUsuarios', $usuarioService->listar($usuario));   
        self::setViewParam('listaDepartamentos', $departamentoService->listar());
        if($_POST){
        $usuario->setId($_POST['codigoUser']);
        $usuario->setNome($_POST['nomeUsuarioPesq']);
        $usuario->setStatus($_POST['codStatus']);
        $usuario->setCodDepartamento($_POST['departamentoPesq']);
        $usuario->setEmail($_POST['emailPesq']);
        
        if($_SESSION['nivel'] == 2){
            $usuario->setId($_SESSION['id']);
        }   
        $usuarios = $usuarioService->listar($usuario);
        
        $html = "";                         
        if($usuarios >=1){
           foreach ($usuarios as $usuario){
            $html .= " <tr>
            <td>".$usuario->getId()."</td>
            <td>".$usuario->getNome()."</td>
            <td>".$usuario->getEmail()."</td>
            <td>".$usuario->getNivel()."</td>
            <td>".$usuario->getDepartamento()->getNome()."</td>
            <td class='text-center'><span class='badge badge-pill badge-".$usuario->getSituacoes()->getCors()->getCorCor()."'>".$usuario->getSituacoes()->getSitNome()."</td>
            <td >".$usuario->getDataCadastro()->format('d/m/Y H:m')."</td>              
            <td>
            <span class='dropdown'>
                    <a class='btn btn-outline-info btn-elevate btn-pill btn-elevate-air' title='clique para visualizar' type='button' id='btnUserVisualizar'
                    data-toggle='modal' data-target='#modal_usuario' data-whatever='@getbootstrap'
                    data-codigo='". $usuario->getId()."'
                    data-nome='". $usuario->getNome()."'
                    data-apelido='". $usuario->getApelido()."'
                    data-nivel='". $usuario->getNivel()."'
                    data-departamento='". $usuario->getId_dep()."'
                    data-nomedepartamento='". $usuario->getDepartamento()->getNome()."'
                    data-email='". $usuario->getEmail()."'
                    data-statusid='". $usuario->getSituacoes()->getSitId()."'
                    data-status='". $usuario->getSituacoes()->getSitNome()."'
                    data-dica='". $usuario->getDica()."'
                    data-instituicao='". $usuario->getFk_Instituicao()."'
                    target='_blank'><i class='fa fa-list fa-2x'></i></a>                           
                    <div class='dropdown-menu dropdown-menu-right'>
                        <a class='dropdown-item'
                        href='http://". APP_HOST."/usuario/edicao/". $usuario->getId()."
                        title='Editar' class='btn btn-info btn-sm'><i class='la la-edit'></i> Editar</a>
                        <a class='dropdown-item'
                        href='http://". APP_HOST."/usuario/exclusao/". $usuario->getId()."
                        title='Excluir' class='btn btn-info btn-sm'><i class='la la-trash'></i>
                        Excluir</a>
                        <a class='dropdown-item'
                        href='http://". APP_HOST."/usuario/edicao/". $usuario->getId()."
                        title='Status' class='btn btn-info btn-sm'><i class='la la-leaf'></i> Status</a>
                        <a class='dropdown-item'
                        href='http://". APP_HOST."/usuario/edicao/". $usuario->getId()."
                        title='Relatorios' class='btn btn-info btn-sm'><i class='fa fa-print'></i> Relatorio</a>
                    </div>                                
                    </span>
                </td>
                </tr>";
            }               
            echo $html;
        }else {
            echo "<h3 class='kt-portlet__head-title'><p class='text-danger'>Sem Dados Encontrados!</p></h3>";
        }
        }
    }  
        
    public function preusuario()
    {
        $usuarioService = new UsuarioService();

        self::setViewParam('listaPreUsuarios', $usuarioService->listarprecadastro());

        $this->render('/usuario/precadastro');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $usuario = new Usuario();
        $departamentoService = new DepartamentoService();
        self::setViewParam('listaDepartamentos', $departamentoService->listar());
        if(Sessao::existeFormulario()) { 
            $usuario->setNome(Sessao::retornaValorFormulario('nome'));
            $usuario->setApelido(Sessao::retornaValorFormulario('apelido'));
            $usuario->setNivel(Sessao::retornaValorFormulario('nivel'));
            $usuario->setEmail(Sessao::retornaValorFormulario('email'));
            $usuario->setId_dep(Sessao::retornaValorFormulario('id_dep'));
            $usuario->setStatus(Sessao::retornaValorFormulario('status'));
            $usuario->setDataCadastro(Sessao::retornaValorFormulario('dataCadastro'));
            $usuario->setValida(Sessao::retornaValorFormulario('email'));
            $usuario->setDica(Sessao::retornaValorFormulario('dica'));
            $usuario->setSenha(Sessao::retornaValorFormulario('senha'));
            $usuario->setFk_Instituicao(Sessao::retornaValorFormulario('fk_instituicao'));
        }
        $this->render('/usuario/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
    }
    
    public function salvar()
    {
        $usuario = new Usuario();
        $usuarioService = new UsuarioService();
        $usuario->setNome($_POST['nome']);
        $usuario->setApelido($_POST['apelido']);
        $usuario->setNivel($_POST['nivel']);
        $usuario->setEmail($_POST['email']);
        $usuario->setId_dep($_POST['id_dep']);
        $usuario->setStatus($_POST['status']);
        $usuario->setDataCadastro($_POST['dataCadastro']);
        $usuario->setValida($_POST['email']);
        $usuario->setDica($_POST['dica']);
        if(!empty($_POST['senha'])){
            $senha         = sha1($_POST['senha']);
            $usuario->setSenha($senha);
        }
        $usuario->setFk_Instituicao($_POST['fk_instituicao']);
        
        Sessao::gravaFormulario($_POST);

        if ($usuarioService->verificaEmail($_POST['email'])) {
            Sessao::gravaMensagem("Email existente");
            $this->redirect('/usuario/cadastro');
        }

        if ($usuarioId = $usuarioService->salvar($usuario)) {
            $usuario = new Usuario();
            $usuario->setId($usuarioId);
            $usuario = $usuarioService->listar($usuario)[0];
            $email = $_POST['email'];               
            $emailService = new EmailService();
            $subject = 1;
            $emailService->emailUsuario($usuario,$email, $subject);

            $this->redirect('/usuario');
        } else {
            Sessao::gravaMensagem("Erro ao gravar");
        }
    }

    public function validausuario()
    {  
        $valida     = $_GET['v'];
        $email      = $_GET['v2'];
        $codigo     = $_GET['v3'];
        
        if ($valida == "" || $email == "" || $codigo == "" ) {            
            $this->redirect('/mensagem/erro');          
        }else {
            $usuarioService = new UsuarioService();
            if($usuarioService->validacadastro($codigo,$valida,$email)){
                $usuario = new Usuario();
                $usuario->setId($codigo);
                $usuario->setValida($valida);
                $usuario->setEmail($email);
                $usuario->setStatus(1);// ativo
                
                if($usuarioService->ativarcadastro($usuario)){
                    $this->redirect('/mensagem/sucesso');
                }
            }else{
               $this->redirect('/mensagem/erro');              
            }
        }        
    }
    
    public function salvarpre()
    {
        $usuario = new Usuario();
        $usuarioService = new UsuarioService();
        $usuario->setNome($_POST['fullname']);
        $usuario->setEmail($_POST['email']);
        $usuario->setSenha($_POST['password']);
        //$usuario->setValida($_POST['email']);       
        //$usuario->setNivel(2);//usuario
       // $usuario->setId_dep(8);//recepcao
        //$usuario->setStatus('Desativado');
        //$usuario->setFk_Instituicao(3);//fabmed
        
        Sessao::gravaFormulario($_POST);

        if ($usuarioService->verificaEmail($_POST['email'])) {
            echo 3;
            return false;
        }else if ($usuarioId = $usuarioService->precadastro($usuario)) {
            $usuario->setId($usuarioId);
            $usuarioId = $usuarioService->listarprecadastro($usuarioId);
            $email = $_POST['email'];               
            $emailService = new EmailService();
            $subject = 1;
            $emailService->emailPreCadastro($usuario,$email, $subject);

            echo 1;
        } else {
            echo 2;
        }
    }

   public function recuperarsenha()
    {
        $usuario        = new Usuario();
        $usuarioService = new UsuarioService();
        $emailrec       = $_POST['emailrec'];
        $usuario->setEmail($emailrec);
        if($usuario = $usuarioService->verificaEmail($emailrec)) {
            $senha      = rand(111111,999999);
            $senhamd5   = sha1($senha);
        
            $usuario->setSenha($senhamd5);
            $usuario->setStatus(2);//Inativo
            $atualizar = $usuarioService->atualizar($usuario);
            if($atualizar > 0){                                     
                $this->Assunto = "Recuperação de Senha";
                $this->Codigo = $usuario->getId();
                $this->Senha = "<h3 class='kt-portlet__head-title'><p class='text-danger'>Sua Nova Senha de Acesso é: " . $senha. "</p></h3>";
                $_SESSION['apelido'] = "Você ";
                $this->emailUsuario();
              echo true;
            }
        }else{            
            echo false;
        }
    }
    
   public function salvarUser()
   {
        
        $usuarioService = new UsuarioService();
        $usuario        = new Usuario();
        $codigo = $_POST['codigo'];
        $usuario->setId($codigo);
        $usuario        = $usuarioService->listar($usuario)[0];
        $email          = $usuario->getEmail();
        $usuario->setNome($_POST['nome']);
        $usuario->setApelido($_POST['apelido']);
        $usuario->setNivel($_POST['nivel']);
        $usuario->setEmail($_POST['email']);
        $usuario->setId_dep($_POST['id_dep']);
        $usuario->setStatus($_POST['status']);
        $usuario->setDataCadastro($_POST['dataCadastro']);
        $usuario->setValida($_POST['email']);
        $usuario->setDica($_POST['dica']);
        if(!empty($_POST['senha'])){
            $senha         = sha1($_POST['senha']);
            $usuario->setSenha($senha);
        }
        $usuario->setFk_Instituicao($_POST['fk_instituicao']);
        
        $usuario->setId($_POST['codigo']);
        $acao = $_POST['acao'];           
        if (!$usuario) {
            echo "Usuario existente!";
        }
        $this->Codigo = $codigo;
           if($acao == 0){//ACAO CADASDATR
             if ($usuarioService->verificaEmail($_POST['email'])) {
                echo "E-mail existente! <br><br> ". $_POST['email'];
            } else if($codigo = $usuarioService->salvar($usuario)){               
                    echo "Cadastro realizado com Sucesso! \n Codigo: ". $codigo;                    
                    $this->Assunto = "Cadastro de Usuario";
                    $this->emailUsuario();
            }
        } else if($acao == 1){ //ACAO ALTERAR  
         $usuario->setStatus(2);
                if ($_POST['email'] !=  $email) { 
                    if($usuarioService->verificaEmail($_POST['email'])){
                        echo "E-mail existente! \n ". $_POST['email'] . ' email '.$email;
                    }else{
                            if($usuarioService->atualizar($usuario)){                       
                            echo "Cadastro Alterado com Sucesso! \n Codigo: ". $codigo;
                            $this->Assunto = "Alteração de Usuario";
                            $this->emailUsuario();
                        }
                    }
                }else{
                    if($usuarioService->atualizar($usuario)){                       
                        echo "Cadastro Alterado com Sucesso! \n Codigo: ". $codigo;
                        $this->Assunto = "Alteração de Usuario";
                        $this->emailUsuario();
                    }
            }
          } else if($acao == 2){//ACAO EXCLUIR - analisar nao excluir apenas inativar             
              if($usuarioService->excluir($usuario)){
                echo "Cadastro Excluido com Sucesso! \n Codigo: ". $codigo;
              }
          }
    }
   
    public function edicao($params)
    {
        $id = $params[0];
        if (!$id) {
            Sessao::gravaMensagem("Nenhum Cadastro Selecionado");
            $this->redirect('/usuario');
        }
        $usuario = new Usuario();
        $usuarioService = new UsuarioService();
        $usuario->setId($id);
        if(Sessao::existeFormulario()) {
            $usuario->setNome(Sessao::retornaValorFormulario('nome'));
            $usuario->setApelido(Sessao::retornaValorFormulario('apelido'));
            $usuario->setNivel(Sessao::retornaValorFormulario('nivel'));
            $usuario->setEmail(Sessao::retornaValorFormulario('email'));
            $usuario->setId_dep(Sessao::retornaValorFormulario('id_dep'));
            $usuario->setStatus(Sessao::retornaValorFormulario('status'));
            $usuario->setDataCadastro(Sessao::retornaValorFormulario('dataCadastro'));
            $usuario->setValida(Sessao::retornaValorFormulario('email'));
            $usuario->setDica(Sessao::retornaValorFormulario('dica'));
            $usuario->setSenha(Sessao::retornaValorFormulario('senha'));
            $usuario->setFk_Instituicao(Sessao::retornaValorFormulario('fk_instituicao'));
        }else{            
            $usuario = $usuarioService->listar($usuario)[0];
        }
        if (!$usuario) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/usuario');
        }
            $departamentoService = new DepartamentoService();
            self::setViewParam('listaDepartamentos', $departamentoService->listar());
            self::setViewParam('usuario', $usuario);
            $this->render('/usuario/editar');

            Sessao::limpaErro();
            Sessao::limpaMensagem();
    }

    public function edicaopre($params)
    {

        $id = $params[0];
        if (!$id) {
            Sessao::gravaMensagem("Nenhum Cadastro Selecionado");
            $this->redirect('/usuario');
        }
        $usuarioService = new UsuarioService();

        $usuario = $usuarioService->listarprecadastro($id);

        if (!$usuario) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/usuario');
        }
        
        $departamentoService = new DepartamentoService();
        self::setViewParam('listaDepartamentos', $departamentoService->listar());
        self::setViewParam('usuario', $usuario);
        $this->render('/usuario/editar');

        Sessao::limpaErro();
        Sessao::limpaMensagem();
    }

    public function desInfo()
    {       
        $usuarioService = new UsuarioService();
        $usuario = new Usuario();
        $usuario->setId($_POST['id']);
        $usuario = $usuarioService->listar($usuario)[0];
        $usuario->setId($_POST['id']);
        $usuario->setInfo(1);
                
        if($usuarioService->desInfo($usuario)){
            $_SESSION['info'] = 1;
            $this->redirect('/home/');
        }
    }
    
    public function atualizar()
    {
        $usuarioService = new UsuarioService();
        $usuario = new Usuario();
        $usuario->setId($_POST['id']);
        $usuario = $usuarioService->listar($usuario)[0];
        
        $email = $usuario->getEmail();
        
        $usuario = new Usuario();
        $usuario->setId($_POST['id']);
        $usuario->setNome($_POST['nome']);
        $usuario->setApelido($_POST['apelido']);
        $usuario->setNivel($_POST['nivel']);
        $usuario->setEmail($_POST['email']);
        $usuario->setId_dep($_POST['id_dep']);
        $usuario->setStatus($_POST['status']);
        $usuario->setDica($_POST['dica']);
         if(!empty($_POST['senha'])){
            $senha         = sha1($_POST['senha']);
            $usuario->setSenha($senha);
        }
        $usuario->setFk_Instituicao($_POST['fk_instituicao']);

        Sessao::gravaFormulario($_POST);
        
        $usuarioValidador = new UsuarioValidador();
        $resultadoValidacao = $usuarioValidador->validar($usuario);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/usuario/edicao/' . $_POST['id']);
        }
        if ($_POST['email'] !=  $email) {
            if($usuarioService->verificaEmail($_POST['email'])){
                echo ' Email existente';
                Sessao::gravaMensagem("Email existente");
                $this->redirect('/usuario/edicao/' . $_POST['id']);
            }else{
                $atualizar = $usuarioService->atualizar($usuario);
        
                if( $atualizar > 0){
                   
                    $email = $_POST['email'];               
                    $emailService = new EmailService();
                    $subject = 2;
                    $usuario = new Usuario();
                    $usuario->setId($_POST['id']);
                    $usuario = $usuarioService->listar($usuario)[0];
                    $emailService->emailUsuario($usuario,$email, $subject);
                    
                    $this->redirect('/usuario');
                    Sessao::limpaFormulario();
                    Sessao::limpaMensagem();
                    Sessao::limpaErro();           
               } else if ($atualizar == 0) {
                   echo ' nenhuma alteração indetificada';
                    Sessao::gravaMensagem("nenhuma alteração indetificada");
                    $this->redirect('/usuario');
                }else {       
                    echo ' erro na atualizacao';
                    Sessao::gravaMensagem("erro na atualizacao");
                    $this->redirect('/usuario/edicao/' . $_POST['id']);
                }
            }
        }
            $atualizar = $usuarioService->atualizar($usuario);
       
            if( $atualizar > 0){
               
                $email = $_POST['email'];               
                $emailService = new EmailService();
                $subject = 2;
                $usuario = new Usuario();
                $usuario->setId($_POST['id']);
                $usuario = $usuarioService->listar($usuario)[0];
                $emailService->emailUsuario($usuario,$email, $subject);
                
                $this->redirect('/usuario');
                Sessao::limpaFormulario();
                Sessao::limpaMensagem();
                Sessao::limpaErro();           
           } else if ($atualizar == 0) {
                Sessao::gravaMensagem("nenhuma alteração indetificada");
                $this->redirect('/usuario');
            }else {       
                Sessao::gravaMensagem("erro na atualizacao");
                $this->redirect('/usuario/edicao/' . $_POST['id']);
            }
    }

    public function exclusao($params)
    {
        $id = $params[0];
        if (!$id) {
            Sessao::gravaMensagem("Nenhum Cadastro Selecionado");
            $this->redirect('/usuario');
        }
        if ($id == $_SESSION['id']) {
            Sessao::gravaMensagem("Não é possivel excluir seu proprio Cadastro");
            $this->redirect('/usuario');
        }
        $usuarioService = new UsuarioService();
        $usuario = new Usuario();
        $usuario->setId($id);

        $usuario = $usuarioService->listar($usuario)[0];

        if (!$usuario) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/usuario');
        }

        self::setViewParam('usuario', $usuario);
        $this->render('/usuario/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $usuario = new Usuario();
        $usuario->setId($_POST['id']);

        $usuarioService = new UsuarioService();

        if (!$usuarioService->excluir($usuario)) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/usuario');
        }

        $this->redirect('/usuario');
    }

    public function sucesso()
    {
        if (Sessao::retornaValorFormulario('nome')) {
            $this->render('/usuario/sucesso');

            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
        } else {
            $this->redirect('/');
        }
    }
   
    private function emailUsuario()
    {
        $usuario        = new Usuario();
        $usuarioService = new UsuarioService();
        $emailService   = new EmailService();
        $usuario->setId($this->Codigo);
        $usuario = $usuarioService->listar($usuario)[0]; 

        $codigo              = $usuario->getId();         
        $nome                = $usuario->getNome();
        $apelido             = $usuario->getApelido();
        $email               = $usuario->getEmail();
        $valida              = $usuario->getValida();
        $status              = $usuario->getSituacoes()->getSitNome();

        $dadosCadastro = "
            <table class='table table-striped table-bordered table-hover table-checkable' id='kt_table_3' style='width:30% ' border='3px groove'>
                <tr> <td><b>Codigo</b></td><td> $codigo  </td>  </tr>
                <tr> <td><b>Nome Completo</b></td><td> $nome  </td>  </tr>
                <tr> <td><b>Nome</b></td><td> $apelido  </td>  </tr>
                <tr> <td><b>Status</b></td><td>$status</td></tr>
                <tr> <td><b>Email</b></td><td>$email</td></tr>
            </table>";
           
        $message  = "Olá, ".$apelido."<br><br>";
        $message .=  $_SESSION['apelido']. " efetuou ".$this->Assunto.", não será possivel acessar o Sistema com status <b><i>" . $status . "</b></i>.<br><br>";
        $message .= "Seguindo o link abaixo você poderá ativar seu cadastro.<br><br>";
        $message .= "Para continuar o processo de ativação do usuario, clique no link abaixo ou cole o endereço abaixo no seu navegador.<br><br>";
        $message .= "<a href=http://".APP_HOST."/usuario/validaUsuario/?v=$valida&v2=$email&v3=$codigo> <b><i>Click aqui para validar seu cadastro </b></i></a><br><br>";
        $message .= "<b>Dados Usuário: " .$dadosCadastro. "</b><br><br>";
        if(!empty($this->Senha)){
            $message .= "<b><i>".$this->Senha."</b></i><b><br>";
        }
        //$message .= "Olá " . $apelido . " efetuou ". $this->Assunto.". Seguindo o link abaixo para ativar o cadastro. Para continuar o processo de ativação do usuario, clique no link abaixo ou cole o endereço abaixo no seu navegador. " . APP_HOST . "/usuario/validaUsuario/?v=$valida&v2=$email&v3=$codigo" . " Usuário: " . $dadosCadastro . "Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.";
        $message .= "<b>Seu usuario permanecerá bloqueado até que você ative o cadastro.</b><br><br>";
        $_SESSION['instituicao'] = $usuario->getInstituicao()->getInst_Id();//sessao usada na autenticacao do e-mail
        $this->Assunto .= " - Codigo: " . $codigo . "  - Usuario: ".$apelido;
        
        $emailService->envioEmail($emails = null, $this->Assunto, $email,  $message);
    }
}