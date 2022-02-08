<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h1 class="kt-portlet__head-title">
                    ALTERAÇÃO DE ESTADO
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
        <div class="container">
            <div class="kt-portlet__body">
                <!--begin::Form-->
                <form action="http://<?php echo APP_HOST; ?>/estado/atualizar" method="post" id="form_cadastro">
                    <input type="hidden" class="form-control" name="estId" proIdigo="estId" value="<?php echo $viewVar['estado']->getEstId(); ?>">
                    <input type="hidden" class="form-control" name="dataAlteracao" id="dataAlteracao" value="<?php echo $dataAtual; ?>" required>
                    <input type="hidden" class="form-control" name="fk_instituicao" id="fk_instituicao" value="<?php echo $_SESSION['idInstituicao']; ?>" required>
                    <input type="hidden" class="form-control" name="estUsuario" id="estUsuario" value="<?php echo $_SESSION['id']; ?>" required>

                    <div class="kt-portlet__body">                                          
                        <div class="col-lg-12">
                            <label>Nome do Estado:</label>
                            <input type="text" class="form-control" placeholder="Digite Nome da Estado" id="estNome" name="estNome" value="<?php echo $viewVar['estado']->getEstNome(); ?>" required>
                            <span class="form-text text-muted">Digite o Nome do Estado</span>
                        </div>                                                            
                        <div class="col-lg-2">
                            <label>UF:</label>
                            <input type="text" class="form-control" placeholder="Digite a UF" id="estUf" name="estUf" value="<?php echo $viewVar['estado']->getEstUf(); ?>" required>
                            <span class="form-text text-muted">Digite a UF</span>
                        </div>                              
                    </div>
                    <div class="kt-portlet__foot">                
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-5"></div>
                                <div class="col-lg-7">                               
                                    <a type="button" 
                                       href='http://<?php echo APP_HOST; ?>/estado'
                                       class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                                    <button type="submit"
                                            class="btn btn-outline-warning btn-elevate btn-pill btn-elevate-air">Alterar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
        <!--end::Portlet-->
    </div>

    <!--end footer -->

</div>