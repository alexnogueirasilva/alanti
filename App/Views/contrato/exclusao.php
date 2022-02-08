

<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet">
    <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h1 class="kt-portlet__head-title">
                EXCLUSAO DE CONTRATO
                </h1>
            </div>
        </div>  
        <div class="col-md-12">
        <?php        
        if($Sessao::retornaMensagem()) { ?>
            <div class="alert alert-warning" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close"> &times; </a> 
                <?php echo $Sessao::retornaMensagem(); ?>
            </div>
            <?php }            
                if($Sessao::retornaErro()){ ?>
                    <div class="alert alert-warning" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } 
                $notificacao = $viewVar['notificacao'];
                if ($notificacao) {
                    $notificacao = " - $notificacao "." <a id='' target='blank' href=http://". APP_HOST."/notificacao/listarPorEdital/".$viewVar['contrato']->getEdital()->getEdtId()." title='Clique aqui pra detalhes' >notificacoes</a>";                                
                } else {
                    $notificacao = "";
                }                                 
            ?>
            <form action="http://<?php echo APP_HOST; ?>/contrato/excluir" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="ctr_id" id="ctr_id" value="<?php echo $viewVar['contrato']->getCtrId(); ?>">
                <div class="panel panel-danger">
                                      
                    <div class="alert alert-warning" role="alert">
                    <h4><i class="flaticon-warning"></i> Deseja realmente excluir o contrato: <?php echo $viewVar['contrato']->getCtrNumero() ." Cliente ". $viewVar['contrato']->getEdital()->getClienteLicitacao()->getRazaoSocial(). " ".$notificacao; ; ?> </h4>                    
                    </div>
                   
                    <div class="kt-portlet__foot">
                        <h3 class="text-danger">* Ao Exlcuir não pode mais retornar este cadastro!.</h3>
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-8">
                                    <input type="submit" id="btnExcluirMet" name="btnExcluirMet"
                                        class="btn btn-outline-danger btn-elevate btn-pill btn-elevate-air" value="Excluir">
                                    <a href="http://<?php echo APP_HOST; ?>/contrato"
                                        class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                                        
                                </div>
                                
                            </div>
                            <br>
                            <h5 class="text-center" name="informacao" id="informacao">
                                <p><strong><em>Cadastrado em:
                                    <?php                                     
                                       $datacadastro = $viewVar['contrato']->getCtrDataCadastro()->format('d/m/Y H:i:s');
                                       $dataalteracao = $viewVar['contrato']->getCtrDataAlteracao()->format('d/m/Y H:i:s');
                                        echo $datacadastro; ?>
                                    - Ultima Alteracao em:
                                    <?php $dataalteracao = ($dataalteracao == "" ? $datacadastro : $dataalteracao); 
                                    echo $dataalteracao;  ?>
                                </em></strong></p>
                            </h5>
                        </div>
                </div>
                </div>
            </form>
        </div>
        <div class="kt-portlet__head"></div>
    </div>
</div>
</div>
