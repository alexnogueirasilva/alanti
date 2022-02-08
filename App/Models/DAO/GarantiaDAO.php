<?php


namespace App\Models\DAO;

use App\Models\Entidades\Fornecedor;
use App\Models\Entidades\Garantia;
use App\Models\Entidades\GarantiaStatus;
use App\Models\Entidades\Edital;
use App\Models\Entidades\ClienteLicitacao;
use App\Models\Entidades\Cors;

class GarantiaDAO extends BaseDAO
{
     public function listarGarantia($grtId = null)
    {
        $sql = 'SELECT crt.grt_id, crt.grt_pk_fornecedor, crt.grt_data_solicitacao,
                       crt.grt_data_resultado, crt.grt_data_recebido, crt.grt_observacao,
                       crt.grt_resultado,  crt.grt_anexo,  grt.stgar_nome,
                       e.edt_cliente,  e.edt_numero,  crt.grt_id_status_garantia,
                       crt.grt_pk_edtital, f.nomefantasia, c.razaosocial ,
                       grt.cor_id, cor.cor_cor, cor.cor_nome
                FROM crt_garantia crt            
                INNER JOIN crt_garantiaStatus grt ON crt.grt_id_status_garantia = grt.stgar_id
                INNER JOIN cors cor ON cor.cor_id = grt.cor_id
                INNER JOIN edital e on crt.grt_pk_edtital = e.edt_id 
                INNER JOIN clienteLicitacao c on c.licitacaoCliente_cod = e.edt_cliente 
                INNER JOIN fornecedor f on crt.grt_pk_fornecedor = f.fornecedor_cod  ';
                $where = Array();
                if( $grtId ){ $where[] = " crt.grt_id = {$grtId}"; }                  
               
               if( sizeof( $where ) )
               {
                   $sql .= ' WHERE '.implode( ' AND ',$where ); 
                 } else {
                     $sql .= " ORDER BY crt.grt_id ASC ";
                 }           

        $resultado = $this->select($sql);
        $dataSetGarantias = $resultado->fetchAll();
        $listaGarantias = [];

        foreach ( $dataSetGarantias as $dataSetGarantia)
        {
            $garantia =  new Garantia();

            $garantia->setCtrId($dataSetGarantia['grt_id']);
            $garantia->setGrtFornecedor($dataSetGarantia['grt_pk_fornecedor']);
            $garantia->setGrtResultado($dataSetGarantia['grt_resultado']);
            $garantia->setGrtDataSolicitacao($dataSetGarantia['grt_data_solicitacao']);
            $garantia->setGrtDataResultado($dataSetGarantia['grt_data_resultado']);
            $garantia->setGrtDataRecebido($dataSetGarantia['grt_data_recebido']);
            $garantia->setGrtObservacao($dataSetGarantia['grt_observacao']);
            //$garantia->setGrtPkIdStatus($dataSetGarantia['grt_id_status_garantia']);
            //$garantia->setGrtPkIdEdital($dataSetGarantia['grt_pk_edtital']);
            $garantia->setGrtAnexo($dataSetGarantia['grt_anexo']);
            //$garantia->setGrtPkIdStatus($dataSetGarantia['grt_id_status_garantia']);

            $garantia->setGrtFornecedor(new Fornecedor());
            $garantia->getGrtFornecedor()->setFornecedor_Cod($dataSetGarantia['grt_pk_fornecedor']);
            $garantia->getGrtFornecedor()->setForNomeFantasia($dataSetGarantia['nomefantasia']);

            $garantia->setGrtPkIdStatus(new GarantiaStatus());
            $garantia->getGrtPkIdStatus()->setStGarNome($dataSetGarantia['stgar_nome']);
            $garantia->getGrtPkIdStatus()->setStGarId($dataSetGarantia['grt_id_status_garantia']);
            $garantia->getGrtPkIdStatus()->setCors(new Cors());
            $garantia->getGrtPkIdStatus()->getCors()->setCorId($dataSetGarantia['cor_id']);
            $garantia->getGrtPkIdStatus()->getCors()->setCorNome($dataSetGarantia['cor_nome']);
            $garantia->getGrtPkIdStatus()->getCors()->setCorCor($dataSetGarantia['cor_cor']);
            $garantia->setGrtPkIdEdital( new Edital());
            $garantia->getGrtPkIdEdital()->setEdtId($dataSetGarantia['grt_pk_edtital']);

            $garantia->getGrtPkIdEdital()->setClienteLicitacao( new ClienteLicitacao);
            $garantia->getGrtPkIdEdital()->getClienteLicitacao()->setCodCliente( $dataSetGarantia['edt_cliente']);
            $garantia->getGrtPkIdEdital()->getClienteLicitacao()->setRazaoSocial( $dataSetGarantia['razaosocial']);

            $listaGarantias[] = $garantia;

        }

         return $listaGarantias;


    }
    
    public function listar($grtId = null)
    {
        $sql = 'SELECT crt.grt_id, crt.grt_pk_fornecedor,
                       crt.grt_data_solicitacao, crt.grt_data_resultado, crt.grt_data_recebido, crt.grt_observacao,
                       crt.grt_resultado, crt.grt_anexo, grt.stgar_nome, e.edt_cliente,  
                       e.edt_numero, crt.grt_id_status_garantia, crt.grt_pk_edtital, 
                       f.nomefantasia, c.nomefantasia as clinomefantasia, c.razaosocial,
                       grt.cor_id, cor.cor_cor, cor.cor_nome
                FROM crt_garantia crt            
                INNER JOIN crt_garantiaStatus grt ON crt.grt_id_status_garantia = grt.stgar_id
                INNER JOIN cors cor ON cor.cor_id = grt.cor_id
                INNER JOIN edital e on crt.grt_pk_edtital = e.edt_id 
                INNER JOIN clienteLicitacao c on c.licitacaoCliente_cod = e.edt_cliente 
                INNER JOIN fornecedor f on crt.grt_pk_fornecedor = f.fornecedor_cod  ';
            $where = Array();
              if( $grtId ){ $where[] = " crt.grt_pk_edtital = {$grtId}"; }                  
             
             if( sizeof( $where ) )
             {
                     $sql .= ' WHERE '.implode( ' AND ',$where ); 
               } else {
                   $sql .= " WHERE grt.stgar_nome NOT IN ('NAO GARANTIDO','CANCELADO') AND crt.grt_resultado NOT IN ('INFORMADO','NAO INFORMAR') ORDER BY crt.grt_pk_edtital ASC ";
               } 

        $resultado = $this->select($sql);
        $dataSetGarantias = $resultado->fetchAll();
        $listaGarantias = [];

        foreach ( $dataSetGarantias as $dataSetGarantia)
        {
            $garantia =  new Garantia();

            $garantia->setCtrId($dataSetGarantia['grt_id']);
            $garantia->setGrtFornecedor($dataSetGarantia['grt_pk_fornecedor']);
            $garantia->setGrtResultado($dataSetGarantia['grt_resultado']);
            $garantia->setGrtDataSolicitacao($dataSetGarantia['grt_data_solicitacao']);
            $garantia->setGrtDataResultado($dataSetGarantia['grt_data_resultado']);
            $garantia->setGrtDataRecebido($dataSetGarantia['grt_data_recebido']);
            $garantia->setGrtObservacao($dataSetGarantia['grt_observacao']);
            //$garantia->setGrtPkIdStatus($dataSetGarantia['grt_id_status_garantia']);
            //$garantia->setGrtPkIdEdital($dataSetGarantia['grt_pk_edtital']);
            $garantia->setGrtAnexo($dataSetGarantia['grt_anexo']);
            //$garantia->setGrtPkIdStatus($dataSetGarantia['grt_id_status_garantia']);

            $garantia->setGrtFornecedor(new Fornecedor());
            $garantia->getGrtFornecedor()->setFornecedor_Cod($dataSetGarantia['grt_pk_fornecedor']);
            $garantia->getGrtFornecedor()->setForNomeFantasia($dataSetGarantia['nomefantasia']);

            $garantia->setGrtPkIdStatus(new GarantiaStatus());
            $garantia->getGrtPkIdStatus()->setStGarNome($dataSetGarantia['stgar_nome']);
            $garantia->getGrtPkIdStatus()->setStGarId($dataSetGarantia['grt_id_status_garantia']);
            $garantia->getGrtPkIdStatus()->setCors(new Cors());
            $garantia->getGrtPkIdStatus()->getCors()->setCorId($dataSetGarantia['cor_id']);
            $garantia->getGrtPkIdStatus()->getCors()->setCorNome($dataSetGarantia['cor_nome']);
            $garantia->getGrtPkIdStatus()->getCors()->setCorCor($dataSetGarantia['cor_cor']);

            $garantia->setGrtPkIdEdital( new Edital());
            $garantia->getGrtPkIdEdital()->setEdtId($dataSetGarantia['grt_pk_edtital']);
            $garantia->getGrtPkIdEdital()->setEdtNumero($dataSetGarantia['edt_numero']);

            $garantia->getGrtPkIdEdital()->setClienteLicitacao( new ClienteLicitacao);
            $garantia->getGrtPkIdEdital()->getClienteLicitacao()->setCodCliente( $dataSetGarantia['edt_cliente']);
            $garantia->getGrtPkIdEdital()->getClienteLicitacao()->setRazaoSocial( $dataSetGarantia['razaosocial']);
            $garantia->getGrtPkIdEdital()->getClienteLicitacao()->setNomeFantasia( $dataSetGarantia['clinomefantasia']);
            $listaGarantias[] = $garantia;
        }

         return $listaGarantias;


    }

    public function salvar(Garantia $garantia )
    {
        try {
            $grtfornecedor      = $garantia->getGrtFornecedor()->getFornecedor_Cod();
            $grtresultado       = $garantia->getGrtResultado();
            $grtdatasolicitacao = $garantia->getGrtDataSolicitacao()->format('Y-m-d');
            //$grtdataresultado   = $garantia->getGrtDataResultado()->format('Y-m-d');
            //$grtdatarecebido    = $garantia->getGrtDataRecebido()->format('Y-m-d');
            if($_POST['grtdatarecebimento']){
                $grtdatarecebido    = $garantia->getGrtDataRecebido()->format('Y-m-d');
            }
            if($_POST['grtdataresultado']){
                $grtdataresultado   = $garantia->getGrtDataResultado()->format('Y-m-d');
            }
            $grtpkidedital      = $garantia->getGrtPkIdEdital()->getEdtId();
            $grtpkidstatus      = $garantia->getGrtPkIdStatus()->getStGarId();
            $dataCadastro       = date('Y-m-d H:i:s');
            $dataAlteracao      = date('Y-m-d H:i:s');
            $observacao         = $garantia->getGrtObservacao();
            $anexo              = $garantia->getGrtAnexo();           
            $grtanexo           = $this->anexo($anexo);            
            $usuario_id         = $_SESSION['id'];

            return $this->insert(
                'crt_garantia',
                ':grt_pk_fornecedor, :grt_resultado, :grt_data_solicitacao, :grt_data_resultado, :grt_data_recebido, :grt_dataalteracao, :grt_datacadastro, :grt_observacao,
                :grt_anexo, :grt_id_status_garantia, :grt_pk_edtital, :usuario_id',
                [
                   ':grt_pk_fornecedor'        => $grtfornecedor,
                   ':grt_resultado'            => $grtresultado,
                   ':grt_data_solicitacao'     => $grtdatasolicitacao,
                   ':grt_data_resultado'       => $grtdataresultado,
                   ':grt_data_recebido'        => $grtdatarecebido,
                   ':grt_anexo'                => $grtanexo,
                   ':grt_dataalteracao'        => $dataAlteracao,
                   ':grt_datacadastro'         => $dataCadastro,
                   ':grt_observacao'           => $observacao,
                   ':grt_id_status_garantia'   => $grtpkidstatus,
                   ':grt_pk_edtital'           => $grtpkidedital,
                   ':usuario_id'               => $usuario_id

                ]
            );
        }
        catch (\Exception $e)
        {
            //var_dump($e);
            throw new \Exception('Erro ao gravar garantia');
        }

    }

    public function addGarantia(Garantia $garantia)
    {

    }

    public function editar(Garantia $garantia)
    {
        try {
            
            $grtid                  = $garantia->getCtrId();
            $grtfornecedor          = $garantia->getGrtFornecedor()->getFornecedor_Cod();
            $grtresultado           = $garantia->getGrtResultado();
            $grtdatasolicitacao     = $garantia->getGrtDataSolicitacao()->format('Y-m-d');
            $dataAlteracao          = date('Y-m-d H:i:s');
            if($_POST['grtdatarecebimento']){
                $grtdatarecebido    = $garantia->getGrtDataRecebido()->format('Y-m-d');
            }
            if($_POST['grtdataresultado']){
                $grtdataresultado   = $garantia->getGrtDataResultado()->format('Y-m-d');
            }
            $observacao             = $garantia->getGrtObservacao();
            $grtpkidedital          = $garantia->getGrtPkIdEdital()->getEdtId();
            $grtpkidstatus          = $garantia->getGrtPkIdStatus()->getStGarId();
            $anexo                  = $garantia->getGrtAnexo();           
            $grtanexo               = $this->anexo($anexo);            
            $usuario_id             = $_SESSION['id'];
            return $this->update(
                'crt_garantia',
                'grt_pk_fornecedor = :grt_pk_fornecedor, 
                grt_resultado = :grt_resultado, 
                grt_data_solicitacao = :grt_data_solicitacao, 
                grt_data_resultado = :grt_data_resultado, grt_data_recebido = :grt_data_recebido, grt_dataalteracao = :grt_dataalteracao, grt_anexo = :grt_anexo, 
                grt_observacao = :grt_observacao, grt_id_status_garantia = :grt_id_status_garantia, grt_pk_edtital = :grt_pk_edtital, usuario_id = :usuario_id',
                [
                    ':grtid'                    => $grtid,
                    ':grt_pk_fornecedor'        => $grtfornecedor,
                    ':grt_resultado'            => $grtresultado,
                    ':grt_data_solicitacao'     => $grtdatasolicitacao,
                    ':grt_data_resultado'       => $grtdataresultado,
                    ':grt_data_recebido'        => $grtdatarecebido,
                    ':grt_dataalteracao'        => $dataAlteracao,
                    ':grt_observacao'           => $observacao,
                    ':grt_anexo'                => $grtanexo,
                    ':grt_id_status_garantia'   => $grtpkidstatus,
                    ':grt_pk_edtital'           => $grtpkidedital,
                    ':usuario_id'               => $usuario_id

                ],
                "grt_id = :grtid"
            );
        }
        catch (\Exception $e)
        {            
            var_dump($e);
            throw new \Exception('Erro ao gravar garantia');
        }
    }

    public function excluir($codigo)
    {
        try {
            $grtid      = $codigo;

            return $this->delete( 'crt_garantia',  "grt_id = $grtid" );
        }
        catch (\Exception $e)
        {
            throw new \Exception('Erro ao deletar garantia');
        }
    }
    
    private function anexo($grtanexo)
    {
        $nomeanexo              = date('Y-m-d-H:i:s');
        if (!$_FILES['grtanexo']['name'] == "") {
            $validextensions = array("jpeg", "jpg", "png", "PNG", "JPG", "JPEG", "pdf", "PDF", "xlsx", "xls", "doc", "docx");
            $temporary = explode(".", $_FILES["grtanexo"]["name"]);
            $file_extension = end($temporary);
            $grtanexo = md5($nomeanexo) . "." . $file_extension;

            if (in_array($file_extension, $validextensions)) {
                $sourcePath = $_FILES['grtanexo']['tmp_name'];
                $targetPath = "public/assets/media/anexos/" . md5($nomeanexo) . "." . $file_extension;
                move_uploaded_file($sourcePath, $targetPath); // Move arquivo
            }
        } else {
            if($grtanexo == ""){
                $grtanexo = "sem_anexo1.png";
            }           
        }
        return $grtanexo;
    }

}