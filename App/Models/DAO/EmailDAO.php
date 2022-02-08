<?php
namespace App\Models\DAO;

use App\Models\Entidades\ContatoEmail;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\Edital;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Sugestoes;
use App\Models\Entidades\Notificacao;
use App\Models\Entidades\Garantia;
use App\Models\Entidades\GarantiaStatus;
use Exception;

class EmailDAO extends BaseDAO
{    
    private $saudacao;
    
    public function saudacao()
    {
         $hora = date('H');
        if (  $hora >= 12 &&  $hora <= 17 ) {
            $this->saudacao = " Boa Tarde!";
        }else if (  $hora  >= 00 &&  $hora  < 12 ){
            $this->saudacao = " Bom Dia!";
        }else{
            $this->saudacao = " Boa Noite!";
        }
        return $this->saudacao;
    }
   
    public function email(Pedido $pedido, $email, $subject, $mensagem = null)
    {
       $codPedido                = $pedido->getCodControle();           
       $codStatus                = $pedido->getStatus()->getCodStatus();           
       $nomeStatus               = $pedido->getStatus()->getNome();           
       $nomeUsuario              = $pedido->getUsuario()->getNome();           
       $codUsuario               = $pedido->getUsuario()->getId();
       $tipoCliente              = $pedido->getClienteLicitacao()->getTipoCliente();
       $razaoSocialCliente       = $pedido->getClienteLicitacao()->getRazaoSocial();
       $empresa                  = $pedido->getInstituicao()->getInst_NomeFantasia();
       $anexos                   = $pedido->getAnexo();
       $numeroPregao             = $pedido->getNumeroLicitacao();
       $numeroAf                 = $pedido->getNumeroAf();
       $data                     = $pedido->getDataCadastro()->format('d/m/Y H:m:s');
       $observacao               = nl2br($pedido->getObservacao());
       $valorPedidoAtual         = $pedido->getValorPedido();   
        $_SESSION['instituicao'] = $pedido->getInstituicao()->getInst_Id();
        
       $dadosCadastro .= "
       <table class='table table-striped- table-bordered table-hover table-checkable' id='kt_table_3' style='width:50% ' border='3px groove'  >
                            <tr> <td>Codigo</td> <td> $codPedido  </td>  </tr>
                            <tr> <td>Cliente</td> <td> $razaoSocialCliente  </td>  </tr>
                            <tr> <td>Status</td> <td>$nomeStatus</td></tr>
                            <tr> <td>Pregao</td> <td>$numeroPregao</td></tr>
                            <tr> <td>Data</td> <td>$data</td> </tr>
                            <tr> <td>Numero</td> <td>$numeroAf</td> </tr>
                            <tr> <td>Empresa</td> <td>$empresa</td> </tr>
                            <tr> <td>Valor</td> <td>R$$valorPedidoAtual</td> </tr>
                            <tr> <td>Observacao</td><td> $observacao </td></tr>
                    </table>";
       
       if($subject == 1){
           $subject = "Cadastro do Pedido";
          
               $to = 'posvenda@fabmed.com.br';
            
        }else if($subject == 2){
            $subject = "Alteracao de Pedido";
            if( $codStatus == 2 || $codStatus == 3 || $codStatus == 5){
                $to = ' sac@fabmed.com.br';
            }
        }else if($subject == 3){
            $subject = "envio do email do Pedido";            
        }
        /*$arrayEmail = array();
        $arrayEmail[] = $email;
        if( sizeof( $email ) ){
          //  $to .= ', '.implode( ',',$arrayEmail );
          $to .= ', '.implode( ',',$email );
        }*/
       $this->saudacao = $this->saudacao(); 
      
       $subject .= " - Codigo: " . $codPedido . "  - Cliente: ".$razaoSocialCliente;
       $message = $this->saudacao.", <br><br> " .$_SESSION['apelido'].  "  efetuou ". $subject  . "<br> " . "\r\n";
       $message .= "<p align='justify widher:80%;'><h3><pre>" . $mensagem. "</pre></h3></p>";
       $message .= "<a href=http://".APP_HOST."/pedido > Click aqui para acessar o sistema</a> <br><br> " . "\r\n";
       $message .= "<a href=http://".APP_HOST."/public/assets/media/anexos/".$anexos."> Click aqui para visualisar o anexo</a> <br><br> " . "\r\n";
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $dadosCadastro. "</p>";
       $headers = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= 'From:< noreply@alanti.com.br>' . "\r\n"; //email de envio
       //$headers .= 'CC:< nuvem@fabmed.com.br>' . "\r\n"; //email com copia
       $headers .= 'Reply-To: < nuvem@fabmed.com.br >' . "\r\n"; //email para resposta
       $this->envioEmail($email, $subject, $to, $message);
      // mail($to, $subject, $message, $headers);
    }
    
    public function emailEdital(Edital $edital, $email, $subject)
    {
       $codigo             = $edital->getEdtId();           
       $razaoSocialCliente = $edital->getClienteLicitacao()->getRazaoSocial().' - '.$edital->getClienteLicitacao()->getEndCidade()->getEstado()->getEstUf();
       $nomeStatus         = $edital->getEditalStatus()->getStEdtNome();          
       $nomeUsuario        = $edital->getUsuario()->getNome();  
       $nomeOperador       = $edital->getEdtOperador(); 
       $emailUsuario       = $edital->getUsuario()->getEmail();  
       $codUsuario         = $edital->getUsuario()->getId();
       $tipoCliente        = $edital->getClienteLicitacao()->getTipoCliente();
       $anexos             = $edital->getEdtAnexo();
       $numeroPregao       = $edital->getEdtNumero();
       $proposta           = $edital->getEdtProposta().' - '.$edital->getEdtIdentificador().' / '.$edital->getEdtPortal();
       $modalidede         = $edital->getEdtModalidade();
       $representante      = $edital->getRepresentante()->getNomeRepresentante();
       $dataAbertura       = $edital->getEdtDataAbertura()->format('d/m/Y').' - ' .$edital->getEdtHora()->format('H:i:s');
       $dataLimite         = $edital->getEdtDataLimite()->format('d/m/Y').' - ' .$edital->getEdtHoraLimite()->format('H:i:s');
       $observacao         = nl2br($edital->getEdtObservacao());
       $tipo               = $edital->getEdtTipo().' - '.$edital->getDisputa();;
       $analise            = nl2br($edital->getEdtAnalise());
       $valor              = $edital->getEdtValor();   
       $justificativa      = $edital->getJustificativa();   
       $codStatus          = $edital->getEditalStatus()->getStEdtId();           
       $empresa            = $edital->getInstituicao()->getInst_NomeFantasia();   
        $to =  $emailUsuario;
       $_SESSION['instituicao'] = $edital->getInstituicao()->getInst_Id();
        
       $dadosCadastro .= "
                    <table class='table table-striped- table-bordered table-hover table-checkable' id='kt_table_3' style='width:50% ' border='3px groove'  >     
                            <tr> <td>Codigo</td> <td> $codigo  </td>  </tr>
                            <tr> <td>Cliente</td> <td> $razaoSocialCliente  </td>  </tr>
                            <tr> <td>Status</td> <td>$nomeStatus</td></tr>
                            <tr> <td>Data e Hora Abertura</td> <td>$dataAbertura</td></tr>
                            <tr> <td>Data e Hora Limite</td> <td>$dataLimite</td></tr>
                            <tr> <td>Pregao</td> <td>$numeroPregao</td></tr>
                            <tr> <td>Proposta e Portal</td> <td>$proposta</td></tr>
                            <tr> <td>Modalidade</td> <td>$modalidede</td> </tr>
                            <tr> <td>Tipo e Disputa</td><td> $tipo </td></tr>
                            <tr> <td>Empresa</td> <td>$empresa</td></tr>
                            <tr> <td>Operador</td> <td>$nomeOperador</td></tr>
                            <tr> <td>Representante</td> <td>$representante</td> </tr>
                            <tr> <td>Valor</td> <td>R$$valor</td> </tr>
                            <tr> <td>Observacao</td><td> $observacao </td></tr>
                            <tr> <td>Analise</td><td> $analise </td></tr>";
                            if($justificativa){
                               $dadosCadastro .= "  <tr style='color:red'> <td>Justificativa</td><td> $justificativa </td></tr>";
                            }
        $dadosCadastro .= "</table>";
       if($subject == 1){
            $subject = "Cadastro do Edital";
            $emailInfo = ['andre.almeida@fabmed.com.br'];
            $email =  array_merge($email, $emailInfo);
        }else if($subject == 2){
            $subject = "Alteração de Edital";
        }
        
        if($codStatus == 5 || $codStatus == 8 ){//lancamento aberto ou arrematado
             if(!empty($email)){
                $emailInfo = ['andrea.borges@fabmed.com.br', 'luanderson.dias@fabmed.com.br'];
                $email =  array_merge($email, $emailInfo);
            }else{
                 $email = ['andrea.borges@fabmed.com.br', 'luanderson.dias@fabmed.com.br'];
            }
                if($codStatus == 5){
                    $to = '';
                }
         }
         if($codStatus == 8 || $codStatus == 10 || $codStatus == 11 ){//contrato, perdido ou arrematado
             if(!empty($email)){
                $emailInfo = ['debora.mendes@fabmed.com.br'];
                $email =  array_merge($email, $emailInfo);
            }else{
                $email = ['debora.mendes@fabmed.com.br'];
            }
        }
         if($codStatus == 4 || $codStatus == 6){//proposta fechada ou lancamento fechado
             if(!empty($email)){
                $emailInfo = ['lisiane.nunes@fabmed.com.br', 'andre.almeida@fabmed.com.br'];
                $email =  array_merge($email, $emailInfo);
            }else{
                 $email = ['lisiane.nunes@fabmed.com.br','andre.almeida@fabmed.com.br'];
            }
             $to = '';
         }
         if($codStatus == 11 || $codStatus == 12 || $codStatus == 13 || $codStatus == 14 || $codStatus == 15){//proposta perdido, desistido, suspenso ou anulado
             if(!empty($email)){
                $emailInfo = ['licitacao@fabmed.com.br'];
                $email =  array_merge($email, $emailInfo);
            }else{
                 $email =  ['licitacao@fabmed.com.br'];
            }
             $to = '';
         }
       $this->saudacao = $this->saudacao();
      // $subject .= " - Pregão: " . $numeroPregao . "  - Cliente: ".ucwords(strtolower($razaoSocialCliente));
       $subject .= " - Pregão: " . $numeroPregao . "  - Cliente: ".$razaoSocialCliente;
       $message = "Ola, ".$this->saudacao." <br><br> " . ucwords(strtolower($_SESSION['apelido'])).  "  efetuou ". $subject  . " <br><br> " . "\r\n";
       $message .= "<a href=http://".APP_HOST."/edital/edicao/".$codigo." > Click aqui para acessar o sistema</a> <br><br> " . "\r\n";
       $message .= "<a href=http://".APP_HOST."/public/assets/media/anexos/".$anexos."> Click aqui para visualisar o anexo</a> <br><br> " . "\r\n";
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $dadosCadastro. "</p></h3>";
       $headers = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= 'From:< noreply@alanti.com.br>' . "\r\n"; //email de envio
       //$headers .= 'CC:< nuvem@fabmed.com.br>' . "\r\n"; //email com copia
       $headers .= 'Reply-To: <nuvem@fabmed.com.br,andre.almeida@fabmed.com.br; >' . "\r\n"; //email para resposta

       //mail($to, $subject, $message, $headers);
       
       $this->envioEmail($email, $subject, $to, $message);
       //$this->enviarEmail($email, $to,$subject,$message);
   }
   
   public  function emailUsuario(Usuario $usuario, $email, $subject)
   {
       $codigo              = $usuario->getId();           
       $nome                = $usuario->getNome();
       $valida              = $usuario->getValida(); 
       //$email               = $usuario->getEmail();
       $status              = $usuario->getStatus();          
       
       $to = $email;
       $dadosCadastro .= "
       <table class='table table-striped- table-bordered table-hover table-checkable' id='kt_table_3' style='width:50% ' border='3px groove'  >
                            <tr> <td>Codigo</td> <td> $codigo  </td>  </tr>
                            <tr> <td>Nome</td> <td> $nome  </td>  </tr>
                            <tr> <td>Status</td> <td>$status</td></tr>
                            <tr> <td>Email</td> <td>$email</td></tr>
                    </table>";
      
       if($subject == 1){
           $subject = "Cadastro de Usuario ";
           
        }else{
            $subject = "Alteração de Usuario";           
        }    
      
       $subject .= " - Codigo: " . $codigo . "  - nome: ".$nome;
       $message = "Ola, <br><br> " .$nome.  "  efetuou ". $subject  . " <br><br> " . "\r\n";
       $message .= "<a href=http://".APP_HOST."/usuario/validaUsuario/?v=$valida&v2=$email&v3=$codigo> Click aqui para validar seu cadastro </a>";             
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $dadosCadastro. "</p></h3>";
       $headers = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= 'From:< noreply@alanti.com.br>' . "\r\n"; //email de envio
       //$headers .= 'CC:< nuvem@fabmed.com.br>' . "\r\n"; //email com copia
       $headers .= 'Reply-To: <nuvem@fabmed.com.br,vendas2@fabmed.com.br; >' . "\r\n"; //email para resposta
       //mail($to, $subject, $message, $headers);
       
       $this->envioEmail($email = null, $subject, $to,  $message);  
   }
   
   public  function emailContato(ContatoEmail $emailContato)
   {
       $assunto              = $emailContato->getCnteAssunto();           
       $email              = $emailContato->getCnteEmail();           
       $mensagem              = nl2br($emailContato->getCnteMensagem());           
       $contato              = $emailContato->getCnteNome();    
       
       $dadosCadastro .= "
       <table class='table table-striped- table-bordered table-hover table-checkable' id='kt_table_3' style='width:50% ' border='3px groove'  >
                            <tr> <td>Contato</td> <td> $contato  </td>  </tr>
                            <tr> <td>Assunto</td> <td> $assunto  </td>  </tr>
                            <tr> <td>Email</td> <td>$email</td></tr>
                            <tr> <td>Mensagem</td> <td>$mensagem</td></tr>
                    </table>";
       
        $arrayEmail = array();
        if( sizeof( $arrayEmail ) ){
           // $arrayEmail[] = $email;
          //  $to .= ', '.implode( ',',$arrayEmail );
        }               
      
       $assunto .= " - Contato: " . $contato . "  - Email: ".$email;
       $message = "Ola, <br><br> " .$contato.  " enviou um e-mail  "." <br><br> " . "\r\n";
      // $message .= "<a href=http://".APP_HOST."/usuario/validaUsuario/?v=$valida&v2=$email&v3=$codigo> Click aqui para validar seu cadastro </a>";             
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $dadosCadastro. "</p></h3>";
       $headers = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= 'From:< noreply@alanti.com.br>' . "\r\n"; //email de envio
       //$headers .= 'CC:< nuvem@fabmed.com.br>' . "\r\n"; //email com copia
       $headers .= 'Reply-To: <nuvem@fabmed.com.br,vendas2@fabmed.com.br; >' . "\r\n"; //email para resposta
       //var_dump($message);
       if (mail($email, $assunto, $message, $headers)){
           echo true;
        }else{
            echo false;
       }
   }

   public  function emailPreCadastro(Usuario $usuario, $email, $subject)
   {
       $codigo              = $usuario->getId();           
       $nome                = $usuario->getNome();
      // $email               = $usuario->getEmail();
       $status              = $usuario->getStatus();          
       $data              = $usuario->getDataCadastro()->format('d/m/Y H:m:s');          
       $obsercacao = "Recebemos seu dados cadastrais e iremos fazer uma avaliação!";
    
       $to = $email;
       $dadosCadastro .= "
       <table class='table table-striped- table-bordered table-hover table-checkable' id='kt_table_3' style='width:50% ' border='3px groove'  >
                            <tr> <td>Codigo</td> <td> $codigo  </td>  </tr>
                            <tr> <td>Nome</td> <td> $nome  </td>  </tr>
                            <tr> <td>Email</td> <td>$email</td></tr>
                            <tr> <td>Data</td> <td>$data</td></tr>
                            <tr> <td>Obsercacao</td> <td>$obsercacao</td></tr>
                    </table>";
       
       if($subject == 1){
           $subject = "Pre Cadastro de Usuario ";
           
        }else{
            $subject = "Pre Alteração de Usuario";           
        }
        $to .= ',nuvem@fabmed.com.br,vendas2@fabmed.com.br';
        $arrayEmail = array();
        if( sizeof( $arrayEmail ) ){
            $arrayEmail[] = $email;
            $to .= ',nuvem@fabmed.com.br,vendas2@fabmed.com.br';
        }               
      
       $subject .= " - Codigo: " . $codigo . "  - nome: ".$nome;
       $message = "Ola, <br><br> " .$nome.  "  efetuou ". $subject  . " <br><br> " . "\r\n";
      // $message .= "<a href=http://".APP_HOST."/usuario/validaUsuario/?v=$valida&v2=$email&v3=$codigo> Click aqui para validar seu cadastro </a>";             
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $dadosCadastro. "</p></h3>";
       $headers = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= 'From:< noreply@alanti.com.br>' . "\r\n"; //email de envio
       //$headers .= 'CC:< nuvem@fabmed.com.br>' . "\r\n"; //email com copia
       $headers .= 'Reply-To: < nuvem@fabmed.com.br,vendas2@fabmed.com.br >' . "\r\n"; //email para resposta
       mail($to, $subject, $message, $headers);
   }

   public  function emailSugestoes(Sugestoes $sugestoes, $email, $subject)
    {
        $codSugestoes       = $sugestoes->getSugId();           
        $status             = $sugestoes->getSugStatus();
        $tipo               = $sugestoes->getSugTipo();
        $nomeUsuario        = $sugestoes->getUsuario()->getNome();
        $anexos             = $sugestoes->getSugAnexo();
        $descricao          = nl2br($sugestoes->getSugDescricao()); 
               
        $dadosCadastro .= "
        <table class='table table-striped- table-bordered table-hover table-checkable' id='kt_table_3' style='width:50% ' border='3px groove'  >
                <tr> <td>Codigo</td> <td> $codSugestoes  </td>  </tr>
                <tr> <td>Tipo</td><td> $tipo </td></tr>
                <tr> <td>Status</td> <td>$status</td></tr>
                <tr> <td>Descricao</td><td> $descricao </td></tr>                
        </table>";
        
        if($subject == 1){
            $subject = "Cadastro de Sugestoes";
        }else if($subject == 2){
            $subject = "Alteração de Sugestoes";           
       }else {
            $subject = "Exclusao do Sugestoes";
       }
      $emails = ['vendas2@fabmed.com.br','nuvem@fabmed.com.br'];
       
      // $emails = array_merge($email, $to);// unindo arrays
      
        $hora = date('H'); 
        if (  $hora >= 12 &&  $hora <= 18 ) {
            $saudacao = " Boa Tarde!";
        }else if (  $hora  >= 00 &&  $hora  < 12 ){
            $saudacao = " Bom Dia!";
        }else{
            $saudacao = " Boa Noite!";
        }
          
       $subject .= " - Codigo: " . $codSugestoes . "  - Tipo: ".$tipo;
       $message = "Ola, ".$saudacao."<br><br> " .$_SESSION['apelido'].  "  efetuou ". $subject  . " no sistema <br><br> " . "\r\n";
       $message .= "<a href=http://".APP_HOST."/sugestoes > Click aqui para acessar o sistema</a> <br><br> " . "\r\n";
       $message .= "<a href=http://".APP_HOST."/public/assets/media/anexos/".$anexos."> Click aqui para visualisar o anexo</a> <br><br> " . "\r\n";
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $dadosCadastro. "</p></h3>";
       $headers = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= 'From:< noreply@alanti.com.br>' . "\r\n"; //email de envio
       //$headers .= 'CC:< nuvem@fabmed.com.br>' . "\r\n"; //email com copia
       $headers .= 'Reply-To: <nuvem@fabmed.com.br, vendas2@fabmed.com.br >' . "\r\n"; //email para resposta
       $this->envioEmail($emails, $subject, $email, $message);
      //mail($to, $subject, $message, $headers);
   }
    
   public  function emailNotificacao(Notificacao $notificacao, $subject)
   {
       $codNotificacao     = $notificacao->getNtf_cod();           
       $status             = $notificacao->getNtf_status();
       $numero             = $notificacao->getNtf_numero();
       $pedido             = $notificacao->getNtf_pedido();
       $valor              = number_format($notificacao->getNtf_valor(), 2, ',', '.');
       $prazoDefesa        = $notificacao->getNtf_prazodefesa();
       $nomeUsuario        = $notificacao->getNtf_usuario()->getNome();
       $nomeCliente        = $notificacao->getClienteLicitacao()->getRazaoSocial();
       $anexos             = $notificacao->getNtf_anexo();
       $observacao         = nl2br($notificacao->getNtf_observacao()); 
        
    $dadosCadastro .= "
        <table class='table table-striped- table-bordered table-hover table-checkable' id='kt_table_3' style='width:50% ' border='3px groove'  >
        <tr> <td>Codigo</td> <td> $codNotificacao  </td>  </tr>
        <tr> <td>Cliente</td> <td> $nomeCliente  </td>  </tr>
        <tr> <td>Status</td> <td>$status</td></tr>
        <tr> <td>Numero</td> <td>$numero</td> </tr>
        <tr> <td>Pedido</td> <td>$pedido</td> </tr>
        <tr> <td>Valor</td> <td>R$$valor</td> </tr>
        <tr> <td>Prazo Defesa</td><td> $prazoDefesa Dias</td></tr>
        <tr> <td>Observacao</td><td> $observacao </td></tr>
    </table>";

        if($subject == 1){
            $subject = "Cadastro de Notificacao";
        }else if($subject == 2 AND ($status == "ATENDIDO" || $status == "Atendido")){
            $subject = "Alteração de Notificacao";           
        }else  if($subject == 3) {
            $subject = "Exclusao do Notificacao";
        }
        $arrayEmail = array();
        $arrayEmail[] = $email;
        if( sizeof( $arrayEmail ) ){
            $to .= ', '.implode( ',',$arrayEmail );
        } 
    
       $to = 'sac@fabmed.com.br';
       $subject .= " - Codigo: " . $codNotificacao . " - Cliente: ".$nomeCliente;
       $message = "Ola, <br><br> " .$_SESSION['apelido'].  "  efetuou ". $subject  . " no sistema <br><br> " . "\r\n";
       $message .= "<a href=http://".APP_HOST."/notificacao/edicao/".$codNotificacao."  > Click aqui para acessar o sistema</a> <br><br> " . "\r\n";
       $message .= "<a href=http://".APP_HOST."/public/assets/media/anexos/".$anexos."> Click aqui para visualisar o anexo</a> <br><br> " . "\r\n";
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $dadosCadastro. "</p></h3>";
       $headers = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= 'From:< noreply@alanti.com.br>' . "\r\n"; //email de envio
       //$headers .= 'CC:< nuvem@fabmed.com.br>' . "\r\n"; //email com copia
       $headers .= 'Reply-To: <nuvem@fabmed.com.br, vendas2@fabmed.com.br >' . "\r\n"; //email para resposta
       
      mail($to, $subject, $message, $headers);
   }

    public  function emailGarantiaStatus(GarantiaStatus $garantiaStatus, $subject)
   {
       $codigo          = $garantiaStatus->getStGarId();           
       $nome            = $garantiaStatus->getStGarNome();           
       $observacao      = nl2br($garantiaStatus->getStGarObservacao());           
       $dataCadastro    = $garantiaStatus->getStGarDataAlteracao()->format('d/m/Y h:m:s');       
       $dataAlteracao   = $garantiaStatus->getStGarDataCadastro()->format('d/m/Y h:m:s');  
       $nomeUsuario     = $garantiaStatus->getStGarUsuario()->getNome();
        
        $dadosCadastro .= "
            <table class='table table-striped- table-bordered table-hover table-checkable' id='kt_table_3' style='width:50% ' border='3px groove'  >
            <tr> <td>Codigo</td> <td> $codigo  </td>  </tr>
            <tr> <td>Nome</td> <td>$nome</td></tr>
            <tr> <td>Usuario</td> <td>$nomeUsuario</td></tr>
            <tr> <td>Data Cadastro</td> <td>$dataCadastro</td> </tr>
            <tr> <td>Data Alteracao</td> <td>$dataAlteracao</td> </tr>
            <tr> <td>Observacao</td><td> $observacao </td></tr>
        </table>";

        if($subject == 1){
            $subject = "Cadastro de Startus Garantia";
        }else if($subject == 2 ){
            $subject = "Alteração de Startus Garantia";           
        }else  if($subject == 3) {
            $subject = "Exclusao de Startus Garantia";
        }

        $arrayEmail = array();
        $arrayEmail[] = $email;
        if( sizeof( $arrayEmail ) ){
            $to .= ', '.implode( ',',$arrayEmail );
        } 
    
       $to = 'sac@fabmed.com.br';
       $subject .= " - Codigo: " . $codigo . " - Nome: ".$nome;
       $message = "Ola, <br><br> " .$_SESSION['apelido'].  "  efetuou ". $subject  . " no sistema <br><br> " . "\r\n";
       $message .= "<a href=http://".APP_HOST."/notificacao/edicao/".$codigo."  > Click aqui para acessar o sistema</a> <br><br> " . "\r\n";
      // $message .= "<a href=http://".APP_HOST."/public/assets/media/anexos/".$anexos."> Click aqui para visualisar o anexo</a> <br><br> " . "\r\n";
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $dadosCadastro. "</p></h3>";
       $headers = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= 'From:< noreply@alanti.com.br>' . "\r\n"; //email de envio
       //$headers .= 'CC:< nuvem@fabmed.com.br>' . "\r\n"; //email com copia
       $headers .= 'Reply-To: <nuvem@fabmed.com.br, vendas2@fabmed.com.br >' . "\r\n"; //email para resposta
       
      mail($to, $subject, $message, $headers);
   }

    public  function emailSuporte($erro, $tela)
   {

        $dadosCadastro .= "
            <table class='table table-striped- table-bordered table-hover table-checkable' id='kt_table_3' style='width:50% ' border='3px groove'  >
                <tr> <td>Descricao do erro </td> <td> $erro  </td>  </tr>
        </table>";

       $to = ['nuvem@fabmed.com.br', 'vendas2@fabmed.com.br', 'programadorfsaba@gmail.com','silvalov@gmail.com'];
       $subject = " Erro no sistema ('.$tela.') ";
       $message = "Ola , <br><br> favor verificar o erro ocorrido no sistema com o usuario(a) ". $_SESSION['nome']." - E-mail: ".$_SESSION['email'] ."<br><br> " . "\r\n";
       $message .= "<a href=http://".APP_HOST." > Click aqui para acessar o sistema</a> <br><br> " . "\r\n";
       $message .= "<h3 class='kt-portlet__head-title'><p class='text-danger'>" . $dadosCadastro. "</p></h3>";
       $headers = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= 'From:< noreply@alanti.com.br>' . "\r\n"; //email de envio
       //$headers .= 'CC:< nuvem@fabmed.com.br>' . "\r\n"; //email com copia
       $headers .= 'Reply-To:'. $_SESSION['nome'].' < '.$_SESSION['email'] .' > '. "\r\n"; //email para resposta
      
       mail($to, $subject, $message, $headers);
       $this->envioEmail($to,$subject, $email1 = null,$message);
   }

    public function envioEmail($emails,$assunto, $email1 = null,$conteudo)
   {        
        $credencial = $this->autenticarEmail();
        
        if($credencial){   
            if(empty($emails) && $email1 == "" ){
                echo 'Não foi possível enviar a mensagem.<br> favor informar um e-mail';
            }else{
                $mail = new \PHPMailer\PHPMailer\PHPMailer();
                $mail->CharSet='UTF-8';
                $mail->isSMTP();
                $mail->Host = $credencial['ema_host'];
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = $credencial['ema_smtpsecure'];
                $mail->Username = $credencial['ema_usuario'];
                $mail->Password = $credencial['ema_senha'];
                $mail->Port = $credencial['ema_porta'];//587;
                $mail->Subject = $assunto;
                $mail->setFrom($credencial['ema_email'], $credencial['ema_nome']);
                $mail->addReplyTo($_SESSION['email'], $_SESSION['apelido']);                
                $mail->addAddress($email1);
            
                if(!is_array($emails)){
                    $emails = [];
                }
                foreach( $emails as $email ){
                    $mail->addAddress($email);
                }
                
                $mail->isHTML(true);
                $mail->Body = "<html><body>". $conteudo."</body></html>";
                $mail->AltBody =  $conteudo;//'Para visualizar essa mensagem acesse http://site.com.br/mail';
                
               // $mail->SMTPDebug = 3;
                $mail->Debugoutput = 'html';
                $mail->setLanguage('pt');
                
                if (!$mail->send()) {              
                    echo 'Não foi possível enviar a mensagem.<br>';
                    echo 'Erro: ' . $mail->ErrorInfo;
                    $email1 .= ', '.implode(' , ' , $emails);
                // $this->emailErro($assunto, $email1, $mail->ErrorInfo, 'Erro: '.$mail->ErrorInfo.' <br><br> Informaçoes do e-mail: '.$conteudo);            
                } else {
                 //echo 'Mensagem enviada.'; 
                    return true;
                }
            }
        }else{
            echo 'Não foi possível enviar a mensagem.<br> erro na autenticação do e-mail';
        }
   }
    private  function autenticarEmail()
   {      
        if(!$_SESSION['instituicao']){      
            $_SESSION['instituicao'] = $_SESSION['inst_id'];
        } 
        $sql = " SELECT e.ema_id, e.ema_nome, e.ema_email, e.ema_usuario, e.ema_host, e.ema_senha, e.ema_porta, e.ema_smtpsecure,
                u.id, u.email, u.apelido, u.nome
                FROM emails e
                INNER JOIN usuarios u ON u.id = e.usuario_id ";
                
        $where = Array();
        if( $_SESSION['instituicao'] ){ $where[] = " instituicao_id = {$_SESSION['instituicao']}"; }
        if( sizeof( $where ) )
        {
            $sql .= ' WHERE '.implode( ' AND ',$where );            
        } 
        $resultado = $this->select($sql);
        $dados = $resultado->fetch();
         unset($_SESSION['instituicao']);
        if($dados){
            return $dados;        
        }else{
            return false;
        }
   }
   
    public function enviarEmail($destinos, $to = null, $assunto, $mensagem)
    {       
        echo '<pre>';
        $tos = $to;
       // $destinos[] .= $tos;
        //var_dump($destinos);           
        var_dump($tos);
        echo '</pre>';

        $email = new \SendGrid\Mail\Mail();
       // $email->addTo($tos, "nome");
        if(!is_array($destinos)){
            $destinos = [];
        }
        foreach( $destinos as $destino ){
            $email->addTo($destino);               
        }        
        
       $email->setFrom("noreply@alanti.com.br", "ALANTI");
       $email->setSubject($assunto);
       $email->addContent("text/plain", "texto");
       $email->addContent("text/html", 'Destinatario: '.$destinatario.' <br><br>'.$mensagem);
       $key      = parse_ini_file('App/Api/Sendgrid/sendgrid.ini')['key'];
       $sendgrid = new \SendGrid($key);
       try
       {
           $resposta = $sendgrid->send($email);
           echo 'Mensagem enviada com sucesso!';
           /*echo '<pre>';
           var_dump($resposta->statusCode());
           var_dump($resposta->headers());
           var_dump($resposta->body());
           echo '</pre>';*/
       }
       catch (Exception $e)
       {
           var_dump( "Caught exception" . $e->getMessage());
       }
    }
      
    /*
    public function enviarEmail($emailEnvio, $mensagem,$assunto)
   {
        
        $email = new \SendGrid\Mail\Mail();  
        $email->setFrom(" noreply@alanti.com.br", "ALANTI");
        $email->setSubject("$assunto");
        $email->addTo("$emailEnvio", "Nome");
        $email->addContent("text/plain", "$mensagem");
        $email->addContent("text/html", "mais conteudo");
        $key      = parse_ini_file('App/Api/Sendgrid/sendgrid.ini')['key'];
        $sendgrid = new SendGrid($key);
        try
        {
            $resposta = $sendgrid->send($email);
            var_dump($resposta->statusCode());
            var_dump($resposta->headers());
            var_dump($resposta->body());
        }
        catch (Exception $e)
        {
            var_dump( "Caught exception" . $e->getMessage());
        }

   }
    */
  
    /*
   public function enviarEmail($emailEnvio, $mensagem,$assunto)
   {
        
        $email = new \SendGrid\Mail\Mail();  
        $email->setFrom(" noreply@alanti.com.br", "ALANTI");
        $email->setSubject("$assunto");
        $email->addTo("$emailEnvio", "Nome");
        $email->addContent("text/plain", "$mensagem");
        $email->addContent("text/html", "mais conteudo");
        $key      = parse_ini_file('App/Api/Sendgrid/sendgrid.ini')['key'];
        $sendgrid = new SendGrid($key);
        try
        {
            $resposta = $sendgrid->send($email);
            var_dump($resposta->statusCode());
            var_dump($resposta->headers());
            var_dump($resposta->body());
        }
        catch (Exception $e)
        {
            var_dump( "Caught exception" . $e->getMessage());
    }
   }*/
   
   public function emailErro($assunto, $destinatario, $erro, $conteudo)
   {
       $email = new \SendGrid\Mail\Mail();
       $email->setFrom("noreply@alanti.com.br", "ALANTI");
       $email->setSubject($assunto);
       //$email->addTo('carlosandrefsaba@gmail.com', 'Andre');
       $email->addTos(['nuvem@fabmed.com.br'=> 'Alex', 'vendas2@fabmed.com.br'=> 'Andre', 'carlosandrefsaba@gmail.com'=> 'Andre', 'silvalov@gmail.com'=> 'Alex']);
       //$email->addContent("text/plain", "texto");
       $email->addContent("text/html", 'Destinatario: '.$destinatario.' <br><br>'.$conteudo);
       $key      = parse_ini_file('App/Api/Sendgrid/sendgrid.ini')['key'];
       $sendgrid = new \SendGrid($key);
       try
       {
           $resposta = $sendgrid->send($email);
           echo '<pre>';
           var_dump($resposta->statusCode());
           var_dump($resposta->headers());
           var_dump($resposta->body());
           echo '</pre>';
       }
       catch (Exception $e)
       {
           var_dump( "Caught exception" . $e->getMessage());
       }
   }

}