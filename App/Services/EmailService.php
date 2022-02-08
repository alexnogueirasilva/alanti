<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\EmailDAO;
use App\Models\Entidades\ContatoEmail;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Sugestoes;
use App\Models\Entidades\GarantiaStatus;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\Edital;
use App\Models\Entidades\Notificacao;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Transportadora;

class EmailService
{
    public function email(Pedido $pedido, $email, $subject, $mensagem = null)
    {
        $emailDAO = new EmailDAO();
        return $emailDAO->email($pedido, $email, $subject, $mensagem );
       
    }
    public function emailContato(ContatoEmail $contatoEmail)
    {
        $emailDAO = new EmailDAO();
        return $emailDAO->emailContato($contatoEmail);
       
    }
    
    public function emailUsuario(Usuario $usuario, $email, $subject)
    {
        $emailDAO = new EmailDAO();
        return $emailDAO->emailUsuario($usuario, $email, $subject);
       
    }
    public function emailPreCadastro(Usuario $usuario, $email, $subject)
    {
        $emailDAO = new EmailDAO();
        return $emailDAO->emailPreCadastro($usuario, $email, $subject);
       
    }
    
    public function emailEdital(Edital $edital, $email, $subject)
    {
        $emailDAO = new EmailDAO();
        return $emailDAO->emailEdital($edital, $email, $subject);
       
    }
    public function emailSugestoes(Sugestoes $sugestoes, $email, $subject)
    {    
        $emailDAO = new EmailDAO();
        return $emailDAO->emailSugestoes($sugestoes, $email, $subject);
       
    }
    public function emailNotificacao(Notificacao $notificacao, $subject)
    {    
        $emailDAO = new EmailDAO();
        return $emailDAO->emailNotificacao($notificacao, $subject);
       
    }
    public function emailGarantiaStatus(GarantiaStatus $garantiaStatus, $email = null, $subject)
    {    
        $emailDAO = new EmailDAO();
        return $emailDAO->emailGarantiaStatus($garantiaStatus, $email, $subject);
       
    }
    public function emailTransportadora(Transportadora $transportadora, $email, $subject, $mensagem = null)
    {
        $emailDAO = new EmailDAO();
       // return $emailDAO->email($pedido, $email, $subject, $mensagem );
       
    }
    public function emailSuporte( $erro, $tela)
    {
        $emailDAO = new EmailDAO();
        return $emailDAO->emailSuporte( $erro,$tela);
       
    }
     public function envioEmail($emails,$assunto, $email1 = null,$conteudo)
    {       
        $emailDAO = new EmailDAO();
        return $emailDAO->envioEmail( $emails,$assunto, $email1 ,$conteudo);
    }
}
