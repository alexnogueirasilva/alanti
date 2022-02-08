<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h1 class="kt-portlet__head-title">
                    ALTERAÇÃO DE SLA
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
            <form action="http://<?php echo APP_HOST; ?>/sla/atualizar" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['Sla']->getId(); ?>">
                <input type="hidden" class="form-control" name="fk_instituicao" id="fk_instituicao" value="<?php  echo $_SESSION['idInstituicao']; ?>" required>
               <div class="col-lg-12">
                    <label for="descricao"><span class="text-danger">* </span>Descricao</label>
                    <input type="text"  class="form-control" name="descricao" id="descricao" placeholder="" value="<?php echo $viewVar['Sla']->getDescricao(); ?>" required>
                    <span class="form-text text-muted">Digite a Descrição</span>
                </div>
               <div class="col-lg-12">
                    <label for="tempo"><span class="text-danger">* </span>Tempo</label>
                    <input type="text"  class="form-control" name="tempo" id="tempo" placeholder="" value="<?php echo $viewVar['Sla']->getTempo(); ?>" required>
                    <span class="form-text text-muted">Digite o Tempo</span>
                </div>
               <div class="col-lg-12">
                    <label for="uniTempo"><span class="text-danger">* </span>Uni Tempo</label>
                    <input type="text"  class="form-control" name="uniTempo" id="uniTempo" placeholder="" value="<?php echo $viewVar['Sla']->getUniTempo(); ?>" required>
                    <span class="form-text text-muted">Digite o Uni-Tempo</span>
                </div>
           <br><p><span class="text-danger">* </span>Campos obrigatórios</p>
            <div class="kt-portlet__foot">                
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-5"></div>
                                <div class="col-lg-7">                               
                                    <a type="button" 
                                       href='http://<?php echo APP_HOST; ?>/sla'
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
        <!-- footer -->
    </div>
    <!--end::Portlet-->
</div>
<!-- ende:: Content -->
</div>