<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet">
        <div class="kt-portlet__head"></div>
        <div class="col-md-6">
            <h3>Excluir Fornecedor</h3>
            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/fornecedor/excluir" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="codFornecedor" id="codFornecedor" value="<?php echo $viewVar['fornecedor']->getFornecedor_Cod(); ?>">

                <div class="panel panel-danger">
                    <div class="alert alert-warning" role="alert">
                    <h4><i class="flaticon-warning"></i> Deseja realmente excluir o fornecedor: <?php echo $viewVar['fornecedor']->getForRazaoSocial(); ?> ?</h4>
                    </div>
                    <div class="panel-footer"> 
                        <button type="submit" class="btn btn-outline-danger btn-elevate btn-pill btn-elevate-air">Excluir</button>
                        <a href="http://<?php echo APP_HOST; ?>/fornecedor" class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                    </div>
                </div>
                <br>
                    <h5 class="text-danger text-center" name="informacao" id="informacao">
                    <p><strong><em>Cadastrado em:
                                    <?php echo $viewVar['fornecedor']->getForDataCadastro()->format('d/m/Y H:i:s'); ?>
                                    - Ultima Alteracao em:
                                    <?php echo $viewVar['fornecedor']->getForDataAlteracao()->format('d/m/Y H:i:s')  ?>
                                    Por: <?php echo $viewVar['fornecedor']->getUsuario()->getNome() ; ?>
                                </em></strong></p>
                    </h5>
            </form>
        </div>
        <div class="kt-portlet__head"></div>
    </div>
</div>
</div>
