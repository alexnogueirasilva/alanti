<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h1 class="kt-portlet__head-title">
                    CADASTRO DE SUGESTÕES
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
            <div class="kt-portlet__body">
                <!--begin::Form-->
                <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/sugestoes/salvar" method="post" id="form_cadastro" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="instituicao" id="instituicao"
                           value="<?php echo $_SESSION['inst_id']; ?>" required>
                    <input type="hidden" class="form-control" name="usuario" id="usuario" value="<?php echo $_SESSION['id']; ?>"
                           required>
                    <input type="hidden" class="form-control" name="dataCadastro" id="dataCadastro"
                           value="<?php echo $dataAtual; ?>" required>
                    <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class=""><span class="text-danger">* </span>Assunto:</label>
                                    <input type="text" class="form-control" placeholder="Digite o Assunto"
                                           title="este campo se refere ao Assunto" id="assunto" name="assunto"
                                           value="<?php echo $Sessao::retornaValorFormulario('assunto'); ?>">
                                    <span class="form-text text-muted">Digite o Assunto</span>
                                </div>
                                <div class="col-lg-2">
                                    <label for="status"><span class="text-danger">* </span>Status</label>
                                        <select class="form-control" name="status" id="status"
                                                value="<?php echo $Sessao::retornaValorFormulario('status'); ?>">
                                            <option value="">Selecione o Status</option>
                                            <option value="EM ANALISE" selected>EM ANALISE</option>
                                            <option value="EM TRATAMENTO">EM TRATAMENTO</option>
                                            <option value="EM TESTE">EM TESTE</option>
                                            <option value="CONCLUIDO">CONCLUIDO</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                        </select>
                                        <span class="form-text text-muted">Por favor insira o Status</span>
                                </div>
                                <div class="col-lg-2">
                                    <label for="tipo"><span class="text-danger">* </span>Tipo</label>
                                        <select class="form-control" name="tipo" id="tipo"
                                                value="<?php echo $Sessao::retornaValorFormulario('tipo'); ?>">
                                            <option value="">Selecione o tipo</option>
                                            <option value="CORRECAO">CORRECAO</option>
                                            <option value="DESENVOLVIMENTO">DESENVOLVIMENTO</option>
                                            <option value="OUTROS" selected >OUTROS</option>
                                        </select>
                                        <span class="form-text text-muted">Por favor insira o tipo</span>
                                </div>
                                <div class="col-lg-2">
                                    <label for="anexo" class="">Anexo:</label>
                                    <input type="file" name="anexo" id="anexo"
                                           value="<?php echo $Sessao::retornaValorFormulario('anexo'); ?>">
                                    <span class="form-text text-muted">Selecione o arquivo</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label for="observacao" class=""><span class="text-danger">* </span>descricao da sugestoes:</label>
                                    <textarea class="form-control" rows="6" placeholder="Digite descricao do sugestoes"
                                              id="descricao" name="descricao"
                                              value="<?php echo $Sessao::retornaValorFormulario('descricao'); ?>"></textarea>
                                    <span class="form-text text-muted">Digite descricao do sugestoes</span>
                                </div>
                            </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="checkbox" id="enviarEmail" name="enviarEmail" value="1" checked>
                                <label>Deseja enviar Email?</label>
                                <select class="form-control m-select2" id="emails" name="emails[]" multiple="multiple"
                                        title="Selecione um ou mais o endereco de e-mail">
                                    <optgroup for="email" label="Email">
                                        <?php foreach ($viewVar['listarUsuarios'] as $usuario) : ?>
                                            <option value="<?php echo $usuario->getEmail(); ?>"
                                                    <?php echo ($Sessao::retornaValorFormulario('emails') == $usuario->getId()) ? "selected" : ""; ?>>
                                                        <?php echo $usuario->getEmail(); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <br><p><span class="text-danger">* </span>Campos obrigatórios</p>
                        <div class="kt-portlet__foot">                
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-5"></div>
                                    <div class="col-lg-7">                               
                                        <a type="button" 
                                           href='http://<?php echo APP_HOST; ?>/sugestoes'
                                           class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                                        <button type="submit"
                                                class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air">Salvar</button>
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
    <!--end::Portlet-->
</div>
<!-- ende:: Content -->
</div>