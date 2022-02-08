<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h1 class="kt-portlet__head-title">
                    DESENVOLVIMENTO
                </h1>
            </div>
        </div>
        <?php if ($Sessao::retornaErro()) { ?>
        <div class="alert alert-warning" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
            <?php echo $mensagem; ?> <br>
            <?php } ?>
        </div>
        <?php } ?>
        <?php if ($Sessao::retornaMensagem()) { ?>
        <div class="alert alert-warning" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo $Sessao::retornaMensagem(); ?>
        </div>
        <?php } ?>
        <!--begin::portlet__head-->
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-left nav-tabs-line-primary"
                    role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_builder_requisito" role="tab">
                            Requisito
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#kt_builder_testes" role="tab">
                            Testes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#kt_builder_regra" role="tab">
                            Regra
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--end::portlet__head-->

        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/desenvolvimento/atualizar"
            method="post" id="form_cadastro" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="codControle" id="codControle"
                value="<?php echo $viewVar['desenvolvimento']->getDesId(); ?>" required>
            <div class="kt-portlet__body">
                <!--begin::tab-content-->
                <div class="tab-content">
                    <div class="tab-pane  active" id="kt_builder_requisito">
                        <div class="kt-portlet__body">
                            <center>
                                <div class="card text-white bg-primary mb-3" style="max-width: 50rem;">
                                    <div class="card-header">Header</div>
                                    <div class="card-body">
                                        <h5 class="card-title">LEVATAMENTO DE REQUISITOS</h5>
                                        <p class="card-text">
                                            <?php echo  $viewVar['desenvolvimento']->getDesRequisito(); ?></p>
                                        <a href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/<?php echo $viewVar['desenvolvimento']->getDesAnexo(); ?>"
                                            target="_blank" title="Visualizar Anexo" class="btn btn-success btn-sm"><i
                                                class="la la-file-text-o"></i> Anexo</a>
                                    </div>
                                </div>

                                <div class="card text-white bg-danger mb-3" style="max-width: 50rem;">
                                    <div class="card-header">Header</div>
                                    <div class="card-body">
                                        <h5 class="card-title">CORRECAO</h5>
                                        <p class="card-text">
                                            <?php echo  $viewVar['desenvolvimento']->getDesCorrecao(); ?></p>

                                    </div>
                                </div>
                                
                                <div class="card text-white bg-dark mb-3" style="max-width: 50rem;">
                                    <div class="card-header">Header</div>
                                    <div class="card-body">
                                        <h5 class="card-title">Dark card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make
                                            up the
                                            bulk of the card's
                                            content.</p>
                                    </div>
                                </div>

                                <div class="card text-white bg-success mb-3" style="max-width: 50rem;">
                                    <div class="card-header">Header</div>
                                    <div class="card-body">
                                        <h5 class="card-title">LIBERADO PARA PRODUCAO</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make
                                            up the
                                            bulk of the card's
                                            content.</p>
                                    </div>
                                </div>
                            </center>
                        </div>
                    </div>
                    <div class="tab-pane  active" id="kt_builder_regra">
                        <div class="kt-portlet__body">
                        <div class="card text-white bg-info mb-3" style="max-width: 50rem;">
                                    <div class="card-header">Header</div>
                                    <div class="card-body">
                                        <h5 class="card-title">REGRA DE NEGOCIOS</h5>
                                        <p class="card-text">
                                            <?php echo  $viewVar['desenvolvimento']->getDesRegraNegocio(); ?>
                                        </p>
                                    </div>
                                </div>

                        </div>
                    </div>
                    <div class="tab-pane  active" id="kt_builder_testes">
                        <div class="kt-portlet__body">
                        <div class="card text-white bg-warning mb-3" style="max-width: 50rem;">
                                    <div class="card-header">Header</div>
                                    <div class="card-body">
                                        <h5 class="card-title">TESTE DE QUALIDADE</h5>
                                        <p class="card-text"><?php echo  $viewVar['desenvolvimento']->getDesTeste(); ?>
                                        </p>
                                    </div>
                                </div>
                                
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-8">
                                    <button type="submit"
                                        class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air">Salvar</button>
                                    <a href="http://<?php echo APP_HOST; ?>/desenvolvimento"
                                        class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                                </div>
                            </div>
                            <br>
                            <h5 class="" name="informacao" id="informacao">
                                <p><strong><em>Cadastrado em:
                                            <?php echo $viewVar['desenvolvimento']->getDesDataCadastro()->format('d/m/Y H:m:s'); ?>
                                            - Ultima Alteracao em:
                                            <?php echo $viewVar['desenvolvimento']->getDesDataAlteracao()->format('d/m/Y H:m:s')  ?>
                                            Por: <?php echo $viewVar['desenvolvimento']->getDesUsuario()->getNome() ; ?>
                                        </em></strong></p>
                            </h5>
                        </div>
                    </div>
                </div>
                <!--end::tab-content-->
            </div>
        </form>