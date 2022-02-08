<?php
require 'vendor/autoload.php';

/*
$email = new \SendGrid\Mail\Mail();
$email->setFrom("noreply@alanti.com.br", "ALANTI");
$email->setSubject("Assunto - Teste de e-mail");
$email->addTo("vendas2@fabmed.com.br", "Nome");
$email->addContent("text/plain", "conteudo");
$email->addContent("text/html", "mais conteudo");
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
*/
//https://forum.imasters.com.br/topic/584657-codeigniter-como-enviar-m%C3%BAltiplos-e-mails-com-phpmailer/?tab=comments#comment-2283526 limk de pesquisa

//$nome=$linha['nome'];
//$sobrenome=$linha['sobrenome'];
$emails= [' vendas2@fabmed.com.br ','zuckpapeis@gmail.com']; // Variáveis com assunto e mensagem
//var_dump($emails);
//foreach ($emails as $email ){
    //$email1 = [0];
    //$email2 = [1];
    $mail = new \PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.umbler.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Username = 'noreply@alanti.com.br';
    $mail->Password = 'alanti@2020';
    $mail->Port = 587;
    $mail->Subject = 'Autenticnado via PHPMailer';
    $mail->setFrom('noreply@alanti.com.br', 'Alanti');
    $mail->addReplyTo('noreply@alanti.com.br', 'Alanti');
    $mail->addAddress(' vendas2@fabmed.com.br ');
    //var_dump($mails);
    $mail->isHTML(true);
    $mail->Body = 'Este é o conteúdo da mensagem em <b>HTML!</b>';
    $mail->AltBody = 'Para visualizar essa mensagem acesse http://site.com.br/mail';


    $mail->SMTPDebug = 3;
    $mail->Debugoutput = 'html';
    $mail->setLanguage('pt');


    if (!$mail->send()) {
        echo 'Não foi possível enviar a mensagem.<br>';
        echo 'Erro: ' . $mail->ErrorInfo;
    } else {
        echo 'Mensagem enviada.';
    }
//}