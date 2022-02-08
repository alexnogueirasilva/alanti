<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\Entidades\Cidade;
use App\Models\Validacao\CidadeValidador;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Estado;
use App\Services\CidadeService;
use App\Services\EstadoService;
use App\Services\UsuarioService;


class CidadeController extends Controller
{
    public function index($params)
    {
        $cidId = $params[0];
        $cidadeService = new CidadeService();
         $estadoService = new EstadoService();
        $cidade        = new Cidade();
        $cidade->setCidId($cidId);

       self::setViewParam('listaEstados', $estadoService->listar());
        if($_POST){
            $cidade->setCidId($_POST['pesCidCodigo']);
            $cidade->setCidNome($_POST['pesCidNome']);
            $cidade->setUf($_POST['pesCidUf']);
           
            self::setViewParam('listaCidades', $cidadeService->listar($cidade));
            $_SESSION['pesCidCodigo']           = $_POST['pesCidCodigo'];
            $_SESSION['pesCidNome']             = $_POST['pesCidNome'];
            $_SESSION['pesCidUf']               = $_POST['pesCidUf'];          
           
        }else{
            unset($_SESSION['pesCidCodigo'],
            $_SESSION['pesCidNome'], $_SESSION['pesCidUf']
            );
        }
        $this->render('/cidade/index');

        Sessao::limpaMensagem();
    }

    public function autoComplete($params)
    {
        $cidade = new Cidade();
        $cidade->setCidNome($params[0]);        
        $cidadeService = new CidadeService();
        $busca = $cidadeService->autoComplete($cidade);
        
        echo $busca;
    }

    public function cadastro()
    {
        if(Sessao::existeFormulario()) { 
        $cidade = new Cidade();
        $estadoService = new EstadoService();
        $estId = Sessao::retornaValorFormulario('estado');
        $estado = $estadoService->listar($estId);
        $cidade->setEstado($estado);
        }else{
            $cidade = new Cidade();
            $cidade->setEstado(new Estado());
        }
        $this->setViewParam('cidade',$cidade);        
        $this->render('/cidade/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $estadoService  = new EstadoService();        
        $usuarioService = new UsuarioService();        
        $usuario         = new Usuario();   
        $usuario->setId($_POST['cidUsuario']);     
        $estado         = $estadoService->listar($_POST['estado']);
        $usuario        = $usuarioService->listar($usuario)[0];
        
        $cidade = new Cidade();
        $cidade->setCidNome($_POST['cidNome']);        
        $cidade->setEstado($estado);
        $cidade->setUsuario($usuario);

        Sessao::gravaFormulario($_POST);

        $cidadeValidador    = new CidadeValidador();
        $resultadoValidacao = $cidadeValidador->validar($cidade);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/cidade/cadastro');
        }

        $cidadeService = new CidadeService();
    
        if($cidadeService->salvar($cidade)){
            $this->redirect('/cidade');
        }else{
            $this->redirect('/cidade/cadastro');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function edicao($params)
    {
        $cidId = $params[0];
        
        $cidade     = new Cidade();
        $usuario    = new Usuario();
        if(Sessao::existeFormulario()) { 
            $cidade->setCidId(Sessao::retornaValorFormulario('cidId'));
            $cidade->setCidNome(Sessao::retornaValorFormulario('cidNome'));
            $cidade->setCidDataAlteracao(Sessao::retornaValorFormulario('dataAlteracao'));
            $estadoService = new EstadoService();
            $usuarioService = new UsuarioService();
            $estId = Sessao::retornaValorFormulario('estado');
            $id = Sessao::retornaValorFormulario('cidUsuario');
            $estado = $estadoService->listar($estId);
            $usuario->setId($id);
            $usuario = $usuarioService->listar($usuario)[0];
            $cidade->setEstado($estado);
            $cidade->setUsuario($usuario);
            
        }else{           
            $cidadeService = new CidadeService();
           
            $cidade->setCidId($cidId);
            $cidade = $cidadeService->listar($cidade)[0]; 
        }
       
        if (!$cidade) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/cidade');
        }
            
       $this->setViewParam('cidade', $cidade);
       
        $this->render('/cidade/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $estadoService  = new EstadoService();        
        $usuarioService = new UsuarioService();        
        $usuario        = new Usuario();        
        $estado         = $estadoService->listar($_POST['estado']);
        $usuario->setId($_POST['cidUsuario']);
        $usuario        = $usuarioService->listar( $usuario)[0];
        
        $cidade = new Cidade();
        $cidade->setCidId($_POST['cidId']);
        $cidade->setCidNome($_POST['cidNome']);
        $cidade->setEstado($estado);
        $cidade->setUsuario($usuario);
        $cidade->setCidDataAlteracao($_POST['dataAlteracao']);
        
        
        $cidadeValidador = new CidadeValidador();
        $resultadoValidacao = $cidadeValidador->validar($cidade);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            Sessao::gravaMensagem("erro na atualizacao");
            Sessao::gravaFormulario($_POST);
            $this->redirect('/cidade/edicao/' . $_POST['cidId']);
        }
        
        $cidadeService = new CidadeService();        
        if ($cidadeService->Editar($cidade)) {
            $this->redirect('/cidade');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();
        }else{
            Sessao::gravaFormulario($_POST);            
            Sessao::gravaMensagem("erro na atualizacao");
          $this->redirect('/cidade/edicao/' . $_POST['cidId']);
        }

    }
    
    public function exclusao($params)
    {
        $cidId = $params[0];

        $cidadeService = new CidadeService();
        $cidade        = new Cidade();
        $cidade->setCidId($cidId);
        $cidade = $cidadeService->listar($cidade)[0];

        if (!$cidade) {
        Sessao::gravaMensagem("Cidade inexistente");
            $this->redirect('/cidade');
        }

        self::setViewParam('cidade', $cidade);

        $this->render('/cidade/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $cidade = new Cidade();
        $cidade->setCidId($_POST['cidId']);

        $cidadeService= new CidadeService();

        if (!$cidadeService->excluir($cidade)) {
            Sessao::gravaMensagem("Cidade inexistente");
            $this->redirect('/cidade/exclusao'.$cidade->getCidId());
        }

        Sessao::gravaMensagem("Cidade excluido com sucesso!");

        $this->redirect('/cidade');
    }
    
    public function excel()
    {
      $cidade         = new Cidade();
      $cidadeService  = new CidadeService();
                      
      $cidade->setCidId($_POST['pesCidCodigo']);
      $cidade->setCidNome($_SESSION['pesCidNome']);
      $cidade->setUf($_SESSION['pesCidUf']);      

        $dados =$cidadeService->listar($cidade);
		if(isset($dados)){
            // Definimos o nome do arquivo que será exportado
			$arquivo = 'Cidades_'.date('dmY_His').'.xls';
            $conta = 0;
            ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="utf-8">
            <title>Relatorio de Cidades</title>

            <head>

            <body><?php
                    // Criamos uma tabela HTML com o formato da planilha
                    $html = '';
                    $html .= '<table border="1">';
                    $html .= '<tr>';
                    $html .= '<th class="text-center" colspan="6">Relatorio de Cidades</th>';
                    $html .= '</tr>';                    
                    $html .= '<tr>';
                    $html .= '<th class="text-center">ORDEM</th>';
                    $html .= '<th class="text-center">CÓDIGO</th>';
                    $html .= '<th class="text-center">NOME</th>';
                    $html .= '<th class="text-center">UF</th>';
                    $html .= '<th class="text-center">USUARIO</th>';
                    $html .= '<th class="text-center">DATA CADASTRO</th>';
                    $html .= '<th class="text-center">DATA ALTERACAO</th>';                   
                    $html .= '</tr>';                   
                    foreach($dados as$cidade){
                        $conta += 1;
                            $html .= '<tr>';
                                $html .= '<td class="text-center">' .$conta.'</td>';
                                $html .= '<td>'.$cidade->getCidId().'</td>';
                                $html .= '<td>'.$cidade->getCidNome().'</td>';
                                $html .= '<td>'.$cidade->getEstado()->getEstUf().'</td>';
                                $html .= '<td>'.$cidade->getUsuario()->getNome().'</td>';
                                $html .= '<td>'.$cidade->getCidDataCadastro()->format('d/m/Y H:i:s').'</td>';
                                $html .= '<td>'.$cidade->getCidDataAlteracao()->format('d/m/Y H:i:s').'</td>';
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
        $this->redirect('/cidade');
    }

}
