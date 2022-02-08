<?php 

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\LoginDAO;
use App\Models\Entidades\Login;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\home;
use App\Services\EmailService;
use App\Services\UsuarioService;

class LoginController extends Controller
{
    public function index()
    {       
        $this->renderLogin('/login/index');
    }

    public function autenticar()
    {
        $email          = $_POST['email'];
        $Password       = $_POST['password'];   
        
        $loginDAO       = new LoginDAO();
        $usuario        = new Usuario(); 
        $usuarioService = new UsuarioService();
        $login = new Login();
        $login = $loginDAO->autenticar($email, $Password);
       
        if(!$login){          
            //session_destroy();
            //$this->redirect('/login');   //Se a consulta não retornar nada é porque as credenciais estão erradas   
            Sessao::gravaMensagem("Login inexistente");
            echo 0;
        }  else  if( $login->getUsuStatus() == 2 || $login->getUsuStatus() == 'Desativado'){ 
            
            echo 2;
           
             $this->emailUsuario($login->getCodUsuario());
            session_destroy();                
            exit;
            //$this->redirect('/login');   //Se a consulta não retornar nada é porque as credenciais estão desativadas 
        } else {           
            if(!isset($_SESSION)) 	//verifica se há sessão aberta		
            session_start();		//Inicia seção                    
            //Abrindo seções                   
                       
            self::setViewParam('Login',$login);
            $this->validarLogin($login);
            date_default_timezone_set("Brazil/East");
            $tempolimite = 10800;// duracao da sessao 3:00H
            $_SESSION['registro'] = time(); // armazena o momento em que autenticado ou atualiza a pagina//
            $_SESSION['limite'] = $tempolimite; 
           //$this->redirect('/'); // o java script (login-general.js) esta fazendo o redirecionamento
           echo 1;   
           exit;	
        }
        Sessao::limpaMensagem();
    }
    private function validarLogin($login)
    {
         //$_SESSION['nomeUsuario']=$vf['nome'];
         $_SESSION['id']             = $login->getCodUsuario();
         $_SESSION['email']          = $login->getEmailLogin();
         $_SESSION['nome']           = $login->getNomeLogin();
         $_SESSION['apelido']        = $login->getApelidoLogin();
         $_SESSION['info']           = $login->getInfo();
         $_SESSION['nivel']          = $login->getNivel();
         $_SESSION['status']         = $login->getUsuStatus();
         $_SESSION['idInstituicao']  = $login->getFk_Instituicao();
         $_SESSION['inst_id']        = $login->getInstituicao()->getInst_Id();
      
        //echo $_SESSION['id']." - " . $_SESSION['nome']. " - ". $_SESSION['email']." - ".$_SESSION['nivel']." - ". $_SESSION['idInstituicao'] ." - " . $_SESSION['inst_id'] ; 
      
    }
    public function logout(){
        session_destroy();        
        $this->redirect('/login/index');

    }
    
    private  function emailUsuario($CodUsuario)
   {
        $usuario        = new Usuario();
        $usuarioService = new UsuarioService();
        $emailService   = new EmailService();
        $usuario->setId($CodUsuario);
        $usuario = $usuarioService->listar($usuario)[0]; 

        $codigo              = $usuario->getId();         
        $nome                = $usuario->getNome();
        $apelido                = $usuario->getApelido();
        $email               = $usuario->getEmail();
        $valida              = $usuario->getValida();
        $status              = $usuario->getSituacoes()->getSitNome();
       
        $dadosCadastro = "
            <table class='table table-striped table-bordered table-hover table-checkable' id='kt_table_3' style='width:30% ' border='3px groove'  >
                <tr> <td><b>Codigo</b></td> <td> $codigo  </td>  </tr>
                <tr> <td><b>Nome</b></td> <td> $nome  </td>  </tr>
                <tr> <td><b>Status</b></td> <td>$status</td></tr>
                <tr> <td><b>Email</b></td> <td>$email</td></tr>
            </table>";
        $assunto  = "Acesso ao Sistema";
        $message  = "Olá, " . $apelido . "<br><br>";
        $message .= "Você tentou acessaro sistema, não foi possivel devido ao seu status ser " . $status . " .<br><br>";
        $message .= "Seguindo o link abaixo você poderá ativar seu cadastro.<br><br>";
        $message .= "Para continuar o processo de ativação do usuario, clique no link abaixo ou cole o endereço abaixo no seu navegador.<br><br>";
        $message .= "<a href=http://".APP_HOST."/usuario/validaUsuario/?v=$valida&v2=$email&v3=$codigo> <b><i>Click aqui para validar seu cadastro </b></i></a><br><br>";
        $message .= "Dados Usuário: " .$dadosCadastro. "<br><br>";
        $message .= "Se você não solicitou esse acesso, nenhuma ação é necessária. Seu usuario permanecerá bloqueado até que você ative o cadastro.<br><br>";
        $_SESSION['instituicao'] = $usuario->getInstituicao()->getInst_Id();//sessao usada na autenticacao do e-mail
        $emailService->envioEmail($emails = null, $assunto, $email,  $message);
   }

}


?>