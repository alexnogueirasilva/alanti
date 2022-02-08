<?php 

namespace App\Models\DAO;

use App\Models\Entidades\ClienteLicitacao;
use App\Models\Entidades\Contato;
use App\Models\Entidades\PedidoErp;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\Representante;
use App\Models\Entidades\Status;
use App\Models\Entidades\Usuario;
use Exception;

class ContatoDAO extends BaseDAO
{
    public  function listar(Contato $contato)
    {             
        $usuario            = $contato->getUsuario();     
        $codContato         = $contato->getCntId();
        $codPessoa          = $contato->getPessoa();
            
        
        
        $sql = " SELECT *
        FROM contatos ";
        /*
        INNER JOIN usuarios as u ON u.id = crtperp.perp_usuario
        INNER JOIN controlePedido as p ON p.codControle = crtperp.perp_codcontrole
        INNER JOIN statusPedido as s ON s.codStatus = p.codStatus
        INNER JOIN cadRepresentante as r ON r.codRepresentante = p.codRepresentante
        INNER JOIN clienteLicitacao as c ON c.licitacaoCliente_cod = p.codCliente*/ 

             $where = Array();
             if( $codPessoa){ $where[] = " pessoa_id = {$codPessoa}"; }
             if( $codContato){ $where[] = " cnt_id = {$codContato}"; }
             /*if( $codPedidoErp ){ $where[] = " crtperp.perp_id = {$codPedidoErp}"; }
             if( $usuario ){ $where[] = " crtperp.perp_usuario = '{$usuario}'"; }
             if( $numero ){ $where[] = " crtperp.perp_numeroerp = '{$numero}'"; }   
             if( $codRepresentante ){ $where[] = " r.codRepresentante = {$codRepresentante}"; }*/
                   
          if( sizeof( $where ) ){
            $sql .= ' WHERE '.implode( ' AND ',$where );
           }else {
            $sql.= ' ORDER BY cnt_id DESC';
           }

          $resultado = $this->select($sql);
     
          $dados = $resultado->fetchAll();
          $lista = [];
          foreach ($dados as $dado) { 
                
            $contato = new Contato();
            $contato->setCntId($dado['cnt_id']);
            $contato->setContato($dado['cnt_nome']);
            $contato->setCargo($dado['cnt_cargosetor']);
            $contato->setEmail($dado['cnt_email']);
            $contato->setCelular($dado['cnt_celular']);
            $contato->setTelefone($dado['cnt_telefone']);
            $contato->setUsuario($dado['usuario_id']);
            $contato->setPessoa($dado['pessoa_id']);
            $contato->setCntDataAlteracao($dado['cnt_dataalteracao']);            

            $lista[] = $contato;
        }
            
        return $lista;
      //    return $resultado->fetchAll(\PDO::FETCH_CLASS, Notificacao::class);   
                
    }

    public  function listarAtendidos(Contato $contato)
    {             
        $usuario            = $contato->getPerpUsuario();     
        $codPedidoErp       = $contato->getPerpId();
        $codControle        = $contato->getPerpCodControle();      
        $codCliente         = $contato->getCodCliente();
        $numero             = $contato->getPerpNumero();              
        $codRepresentante   = $contato->getCodRepresentante();
        $status             = $contato->getPerpStatus();
        $codStatus          = $contato->getCodStatus();
            
        $sql = " SELECT crtperp.perp_id,
                            crtperp.perp_codcontrole,
                            crtperp.perp_dataalteracao,
                            crtperp.perp_datacadastro,
                            crtperp.perp_numeroerp,
                            crtperp.perp_status,
                            crtperp.perp_usuario,
                            crtperp.perp_valor,
                            u.id,
                            u.nome as nomeUsuario,
                            u.nivel,
                            u.email, 
                            r.codRepresentante,
                            r.nomeRepresentante, 
                            p.numeroPregao, 
                            p.numeroAf, 
                            p.valorPedido, 
                            c.razaosocial, 
                            c.nomefantasia, 
                            s.codStatus,
                            s.nome
                            FROM crt_pedidoerp crtperp
                            INNER JOIN usuarios as u ON u.id = crtperp.perp_usuario
                            INNER JOIN controlePedido as p ON p.codControle = crtperp.perp_codcontrole
                            INNER JOIN statusPedido as s ON s.codStatus = p.codStatus
                            INNER JOIN cadRepresentante as r ON r.codRepresentante = p.codRepresentante
                            INNER JOIN clienteLicitacao as c ON c.licitacaoCliente_cod = p.codCliente ";
             $where = Array();
                if(!empty($codStatus)){
                    $codStatus = implode(",",$codStatus);
                }       
                if(!empty($status)){
                    $status = implode(",",$status);
                }       
             if( $codControle){ $where[] = " crtperp.perp_codcontrole = {$codControle}"; }
             if( $codPedidoErp ){ $where[] = " crtperp.perp_id = {$codPedidoErp}"; }
             if( $usuario ){ $where[] = " crtperp.perp_usuario = '{$usuario}'"; }
             if( $status ){ $where[] = " crtperp.perp_status in ('{$status}')"; }
             if( $codCliente ){ $where[] = " c.licitacaoCliente_cod = {$codCliente}"; }
             if( $numero ){ $where[] = " crtperp.perp_numeroerp = '{$numero}'"; }   
             if( $codRepresentante ){ $where[] = " r.codRepresentante = {$codRepresentante}"; }
             if($codStatus ){ $where[] = " s.codStatus in ('{$codStatus}')"; }
          
          if( sizeof( $where ) ){
                $sql .= ' WHERE '.implode( ' AND ',$where );
           }else {
               $sql .= " WHERE crtperp.perp_status IN ('ATENDIDO') ORDER BY c.razaosocial desc ";
           }

          $resultado = $this->select($sql);
         
          $dados = $resultado->fetchAll();
          $lista = [];
          foreach ($dados as $dado) { 
            
        $contato = new Pedido();
        $contato->setPerpId($dado['perp_id']);
        $contato->setPerpNumero($dado['perp_numeroerp']);
        $contato->setPerpValor(number_format($dado['perp_valor'], 2, ',', '.'));
        $contato->setPerpUsuario($dado['perp_usuario']);
        $contato->setPerpDataCadastro($dado['perp_datacadastro']);
        $contato->setPerpDataAlteracao($dado['perp_dataalteracao']);
        $contato->setPerpCodControle($dado['perp_codcontrole']);
        $contato->setPerpStatus($dado['perp_status']);
        $contato->setNumeroAF($dado['numeroAf']);
        $contato->setValorPedido($dado['valorPedido']);
        $contato->setPerpUsuario(new Usuario());
        $contato->getPerpUsuario()->setId($dado['id']);
        $contato->getPerpUsuario()->setNome($dado['nomeUsuario']);
        $contato->getPerpUsuario()->setNivel($dado['nivel']);
        $contato->getPerpUsuario()->setEmail($dado['email']);
        $contato->setRepresentante(new Representante());
        $contato->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
        $contato->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
        $contato->setClienteLicitacao(new ClienteLicitacao());
        $contato->getClienteLicitacao()->setCodCliente($dado['licitacaoCliente_cod']);
        $contato->getClienteLicitacao()->setNomeFantasia($dado['nomefantasia']);
        $contato->getClienteLicitacao()->setRazaoSocial($dado['razaosocial']);
        $contato->setStatus(new Status());
        $contato->getStatus()->setCodStatus($dado['codStatus']);
        $contato->getStatus()->setNome($dado['nome']);

            $lista[] = $contato;
        }     
           
        return $lista;
      //    return $resultado->fetchAll(\PDO::FETCH_CLASS, Notificacao::class);   
                
    }

    public  function listarStatusPedidoErp() 
    {
        $resultado = $this->select(
            "SELECT distinct(crtperp.perp_status)
            FROM crt_pedidoerp crtperp
            INNER JOIN controlePedido as p ON p.codControle = crtperp.perp_codcontrole ORDER BY crtperp.perp_status "
            );
        $dados = $resultado->fetchAll();
        
        if ($dados) {
           
            $lista = [];

            foreach ($dados as $dado) {
            $contato = new Pedido();
            $contato->setPerpStatus($dado['perp_status']);

                $lista[] = $contato;
            }           
            return $lista;
        }

        return false;
    }
    
    public  function salvar(Contato $contato)
    {
        try {            
                $nome               = $contato->getContato();             
                $email              = $contato->getEmail();
                $telefone           = $contato->getTelefone();
                $celular            = $contato->getCelular();
                $cargosetor         = $contato->getCargo();
                $datacadastro       = date('Y-m-d H:i:s');
                $usuario_id         = $_SESSION['id'];
                $pessoa_id          = $contato->getPessoa();
                           
        return $this->insert(
            'contatos',
                ":cnt_nome, :cnt_email, :cnt_telefone, :cnt_celular, 
                :cnt_datacadastro, :cnt_cargosetor, :usuario_id, :pessoa_id",
                [
                    ":cnt_nome"          => $nome,
                    ":cnt_email"         => $email, 
                    ":cnt_telefone"      => $telefone, 
                    ":cnt_celular"       => $celular, 
                    ":cnt_datacadastro"  => $datacadastro,
                    ":cnt_cargosetor"    => $cargosetor, 
                    ":usuario_id"        => $usuario_id, 
                    ":pessoa_id"         => $pessoa_id                    
                ]
            );
        } catch (\Exception $e) {
            //var_dump($e);
            throw new \Exception("Erro na gravação de dados. " . $e, 500);
        }
    }
    public function addContatos(Contato $contato)
    {    
        try { 
            
            $conta = count($contato->getContato());
            if($conta > 0){
            for($i = 0; $i < $conta; $i++ ){                               
                $nome               = $contato->getContato()[$i];             
                $email              = $contato->getEmail()[$i];
                $telefone           = $contato->getTelefone()[$i];
                $celular            = $contato->getCelular()[$i];
                $cargosetor         = $contato->getCargo()[$i];
                $datacadastro       = date('Y-m-d H:i:s');
                $dataAlteracao      = date('Y-m-d H:i:s');
                $usuario_id         = $_SESSION['id'];
                $pessoa_id          = $contato->getPessoa();
               
             $this->insert(
                'contatos',
                ":cnt_nome, :cnt_email, :cnt_telefone, :cnt_celular, 
                :cnt_datacadastro, :cnt_dataalteracao, :cnt_cargosetor, :usuario_id, :pessoa_id",
                [
                    ":cnt_nome"          => $nome,
                    ":cnt_email"         => $email, 
                    ":cnt_telefone"      => $telefone, 
                    ":cnt_celular"       => $celular, 
                    ":cnt_datacadastro"  => $datacadastro,
                    ":cnt_dataalteracao" => $dataAlteracao,
                    ":cnt_cargosetor"    => $cargosetor, 
                    ":usuario_id"        => $usuario_id, 
                    ":pessoa_id"         => $pessoa_id                    
                ]
                );
            }
            }
                return true;
        } catch (\Exception $e) {            
            throw new \Exception("Erro na gravação de dados:" . $e->getMessage(), 500);
            return false;
        }
    }

    public function alterar(Contato $contato)
    {        
        try {       
            $codigo             = $contato->getCntId();             
            $nome               = $contato->getContato();             
            $email              = $contato->getEmail();
            $telefone           = $contato->getTelefone();
            $celular            = $contato->getCelular();
            $cargosetor         = $contato->getCargo();
            $dataAlteracao      = date('Y-m-d H:i:s');
            $usuario_id         = $_SESSION['id'];
            $pessoa_id          = $contato->getPessoa();
            
            return $this->update(
                'contatos',
                "
                    cnt_nome            =:nome,
                    cnt_email           =:email,
                    cnt_telefone        =:telefone,
                    cnt_celular         =:celular,
                    cnt_dataalteracao   =:dataAlteracao,
                    cnt_cargosetor      =:cargosetor,
                    usuario_id          =:usuario_id,
                    pessoa_id           =:pessoa_id",
                [
                    ':codigo'           => $codigo,
                    ':nome'             => $nome,
                    ':email'            => $email,
                    ':telefone'         => $telefone,
                    ':celular'          => $celular,
                    ':cargosetor'       => $cargosetor,
                    ':dataAlteracao'    => $dataAlteracao,
                    ':usuario_id'       => $usuario_id,
                    ':pessoa_id'        => $pessoa_id,
                ],
                "cnt_id = :codigo"
            );          
        } catch (\Exception $e) {            
            var_dump($e);
             throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }

    public function excluir($codigo)
    {
        try {           

            return $this->delete('contatos', "cnt_id = $codigo");
        } catch (Exception $e) {

            throw new \Exception("Erro ao excluir cadastro! ", 500);
        }
    }

    public function excluirPorPessoa(Contato $contato)
    {       
        try {
            $codPessoa = $contato->getPessoa();
           return $this->delete('contatos', "pessoa_id = $codPessoa");
        } catch (Exception $e) {

            throw new \Exception("Erro ao excluir cadastro! ", 500);
        }
    }
}

?>