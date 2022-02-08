<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">

                <h1 class="kt-portlet__head-title">
                    CONTATO
                </h1>
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
        </div>
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-left nav-tabs-line-primary"
                    role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_builder_principal" role="tab">
                            Principal
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#kt_builder_contato" role="tab">
                            Contato
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--begin::Form-->
        <form class="kt-form kt-form--label-right"  action="http://<?php echo APP_HOST; ?>/ContatoEmail/enviarEmail" method="post" id="form_cadastro" enctype="multipart/form-data">

            <div class="kt-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane  active" id="kt_builder_principal">
                        <div class="kt-portlet__body">
                            <div class="form-row">
                            <div class="form-group col-md-6">
                                    <label for="contato">Contato:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="la la-user"></i></span></div>
                                        <input type="text" id="contato" name="contato"  value="<?php echo $Sessao::retornaValorFormulario('contato'); ?>" class="form-control"
                                            placeholder="Entre com contato">
                                    </div>
                                    <span class="form-text text-muted">Favor informar contato</span>
                                </div>                               
                                <div class="form-group col-md-6">
                                    <label>E-mail</label>
                                    <input type="email" id="email" name="email"  value="<?php echo $Sessao::retornaValorFormulario('email'); ?>" class="form-control" placeholder="Seu Melhor E-mail">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Assunto</label>
                                <input type="text" id="assunto" name="assunto"  value="<?php echo $Sessao::retornaValorFormulario('assunto'); ?>" class="form-control" placeholder="Assunto da mensagem">
                            </div>
                           
                            <div class="form-group">
                                <label>Mensagem</label>
                                <textarea id="mensagem" name="mensagem"  value="<?php echo $Sessao::retornaValorFormulario('mensagem'); ?>" class="form-control" rows="6"></textarea>
                            </div>
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
                            <a type="button" id="btnVoltarTra" href='http://<?php echo APP_HOST; ?>/'
                                class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>
    <!--end::Portlet-->
</div>
</div>