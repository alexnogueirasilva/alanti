<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h1 class="kt-portlet__head-title">
                    ALTERAÇÃO DE SUGESTÕES
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
                <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/sugestoes/atualizar" method="post"
                      id="form_cadastro" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" name="dataCadastro" id="dataCadastro"
                           value="<?php echo $dataAtual; ?>" required>
                    <input type="hidden" class="form-control" name="instituicao" id="instituicao"
                           value="<?php echo $_SESSION['inst_id']; ?>" required>
                    <input type="hidden" class="form-control" id="usuario" name="usuario" value="<?php echo $_SESSION['id']; ?>"
                           required>
                    <input type="hidden" class="form-control" id="codigo" name="codigo"
                           value="<?php echo $viewVar['sugestoes']->getSugId(); ?>" required>
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class=""><span class="text-danger">* </span>Assunto:</label>
                                    <input type="text" class="form-control" placeholder="Digite o Assunto"
                                           title="este campo se refere o Assunto" id="assunto" name="assunto"
                                           value="<?php echo $viewVar['sugestoes']->getSugAssunto(); ?>">
                                    <span class="form-text text-muted">Digite o Assunto</span>
                                </div>
                                <div class="col-lg-2">
                                    <label for="status"><span class="text-danger">* </span>Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="">Selecione o Status</option>
                                        <option value="<?php echo $viewVar['sugestoes']->getSugStatus(); ?>"
                                                <?php echo ($viewVar['sugestoes']->getSugStatus() == $viewVar['sugestoes']->getSugStatus()) ? "selected" : ""; ?>>
                                            <?php echo $viewVar['sugestoes']->getSugStatus(); ?> </option>
                                        <option value="EM ANALISE">EM ANALISE</option>
                                        <option value="EM TRATAMENTO">EM TRATAMENTO</option>
                                        <option value="EM TESTE">EM TESTE</option>
                                        <option value="CONCLUIDO">CONCLUIDO</option>
                                        <option value="CANCELADO">CANCELADO</option>
                                    </select>
                                    <span class="form-text text-muted">Por favor insira o Status</span>
                                </div>
                                <div class="col-lg-2">
                                    <label for="tipo"><span class="text-danger">* </span>Tipo</label>
                                        <select class="form-control" name="tipo" id="tipo">
                                            <option value="">Selecione o Tipo</option>
                                            <option value="<?php echo $viewVar['sugestoes']->getSugTipo(); ?>"
                                                    <?php echo ($viewVar['sugestoes']->getSugTipo() == $viewVar['sugestoes']->getSugTipo()) ? "selected" : ""; ?>>
                                                <?php echo $viewVar['sugestoes']->getSugTipo(); ?> </option>
                                            <option value="CORRECAO">CORRECAO</option>
                                            <option value="DESENVOLVIMENTO">DESENVOLVIMENTO</option>
                                            <option value="OUTROS">OUTROS</option>
                                        </select>
                                        <span class="form-text text-muted">Por favor insira o Tipo</span>
                                   </div>
                                <div class="col-lg-2">
                                    <label for="anexo" class="">Anexo:</label>
                                    <input type="file" name="anexo" id="anexo"
                                           value="<?php echo $Sessao::retornaValorFormulario('anexo'); ?>">
                                    <input type="hidden" name="anexoAlt" id="anexoAlt"
                                           value="<?php echo $viewVar['sugestoes']->getSugAnexo(); ?>">
                                    <a class="dropdown-item"
                                       href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/<?php echo $viewVar['sugestoes']->getSugAnexo(); ?>"
                                       target="_blank" title="Click para Visualizar Anexo" class="btn btn-info btn-sm"><i
                                            class="la la-chain"></i> Anexo</a>
                                    <span class="form-text text-muted">Selecione o arquivo</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label for="descricao" class=""><span class="text-danger">* </span>descricao do sugestoes:</label>
                                    <textarea class="form-control" rows="6" placeholder="Digite descricao do sugestoes"
                                              id="descricao"
                                              name="descricao"><?php echo $viewVar['sugestoes']->getSugDescricao(); ?></textarea>
                                    <span class="form-text text-muted">Digite descricao do sugestoes</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <input type="checkbox" id="enviarEmail" name="enviarEmail" value="1" checked>
                                    <label>Deseja enviar Email?</label>
                                    <select class="form-control m-select2" id="emails"  name="emails[]"
                                            multiple="multiple" title="Selecione um ou mais o endereco de e-mail">
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
                                                    class="btn btn-outline-warning btn-elevate btn-pill btn-elevate-air">Alterar</button>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h5 class="" name="informacao" id="informacao">
                                    <p><strong><em>Cadastrado em:
                                                <?php echo $viewVar['sugestoes']->getSugDataCadastro()->format('d/m/Y H:m:s'); ?>
                                                - Ultima Alteracao em:
                                                <?php echo $viewVar['sugestoes']->getSugDataAlteracao()->format('d/m/Y H:m:s') ?>
                                                Por: <?php echo $viewVar['sugestoes']->getUsuario()->getNome(); ?>
                                            </em></strong></p>
                                </h5>
                            </div>
                        </div>
                </form>
                <!--end::Form-->
            </div>
        <!--end::Portlet-->
        <!-- footer -->
    </div>
    <!--end::Portlet-->
</div>
<!-- ende:: Content -->
</div>