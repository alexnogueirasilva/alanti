<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Services\ContatoService;
use App\Services\UsuarioService;
use App\Services\EmailService;
use App\Models\Entidades\Contato;

class ContatoController extends Controller
{
    /*public function listarPorPedido($params)
    {
        $codigo = $params[0];
        $pedido = new Contato();
        $contatoService = new ContatoService();

        $pedido->setPerpCodControle($codigo);
        $pedido = $contatoService->buscarPedido($pedido);
        self::setViewParam('listarContatos', $pedido);
        $this->render('/contato/index');
        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
    }*/

    public function buscarContatos($params)
    {     
         
        $contato = new Contato();
        if($_POST['codPessoa']){

            $contato->setPessoa($_POST['codPessoa']);
            $contatoService = new ContatoService();
            $contato = $contatoService->buscarContatos($contato);
        }              
      
        if ($contato >= 1) {          
            
        foreach ($contato as $contato){    
           
            $html .= "<tr>                    
                        <td>".$contato->getContato()."</td>
                        <td>".$contato->getCargo()."</td>
                        <td>".$contato->getEmail()."</td>
                        <td>".$contato->getTelefone()."</td>
                        <td>".$contato->getCelular()."</td>
                        <td><i>".$contato->getUsuario()."</i></td>
                        <td class='text-center'>
                        <div class='dropdown  d-block d-md-none'>
                            <button
                                class='btn btn-primary dropdown-toggle btn-elevate btn-pill btn-elevate-air btn-sm'
                                type='button' id='acoesListar' data-toggle='dropdown' aria-haspopup='true'
                                aria-expanded='false'>
                                Ações
                            </button>
                                <div class='dropdown-menu dropdown-menu-right ' aria-labelledby='acoesListar'>
                                    <a class='dropdown-item' type='button' id='' href='http://". APP_HOST."/contato/edicao/". $contato->getCntId()."' title='Alterar pedido' class='btn btn-info btn-sm'><i class='la la-edit'></i> Alterar</a>
                                    <a class='dropdown-item' href='http://". APP_HOST."/contato/exclusao/". $contato->getCntId()."' title='Excluir' class='btn btn-info btn-sm'><i class='la la-trash'></i> Excluir</a>
                                    <a class='dropdown-item' href='http://". APP_HOST."/contato/edicao/". $contato->getCntId()."' title='Alterar Status' class='btn btn-info btn-sm'><i class='la la-leaf'></i> Status</a>
                                </div>               
                        </div>     
                        <span class='d-none d-md-block'>          
                                    <a type='button' id='btnEditarContato' name='btnEditarContato' data-cntcontato='".$contato->getContato()."' 
                                    data-cntemail='".$contato->getEmail()."' data-cntcelular='".$contato->getCelular()."' 
                                    data-cnttelefone='".$contato->getTelefone()."' data-cntcargo='".$contato->getCargo()."' 
                                    data-cntcontatoid='".$contato->getCntId()."' title='Editar cadastro' class='btn btn-sm btn-clean btn-icon btn-icon-md'><i class='la la-edit'></i></a>                           
                                <a data-toggle='modal' data-target='#apagarContato' id='btnApagarContato' name='btnApagarContato'  data-contatoid='".$contato->getCntId()."' data-nomecontato='".$contato->getContato()."'  title='Excluir' class='btn btn-sm btn-clean btn-icon btn-icon-md'><i class='la la-trash'></i></a>
                        </span>
                        </td>
                    </tr>";
        }    
        echo $html;      
       } else {
        echo "<h3 class='kt-portlet__head-title'><p class='text-danger'>Sem Dados Encontrados!</p></h3>";
       }
    }
    
    public function salvar()
    {        
        $contato            = new Contato();
        $contatoService     = new ContatoService();
        $codigo             = $_POST['contatoid']; 
        $contato->setContato($_POST['cnt_contato']);
        $contato->setCargo($_POST['cnt_cargo']);
        $contato->setTelefone($_POST['cnt_telefone']);
        $contato->setEmail($_POST['cnt_email']);
        $contato->setCelular($_POST['cnt_celular']);
        $contato->setPessoa($_POST['pessoa']);
        
        if($codigo > 0){
            $contato->setCntId($codigo);         
            $contatoService->editar($contato);
           echo $codigo;
        } else{
            $codigo = $contatoService->salvar($contato);
           echo $codigo;
        }     
       
    }

    public function excluir()
    {
        $contato = new Contato();
         
        $codigo = $_POST['codigo'];
       
        $contatoService = new ContatoService();
          
        if (!$contatoService->excluir($codigo)) {
            Sessao::gravaMensagem("Contato inexistente");            
        }        
        echo $codigo;
    }    
}