<!--begin::Portlet-->
<div class="kt-portlet">
    <?php if ($Sessao::retornaMensagem()) { ?>
    <div class="alert alert-warning" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $Sessao::retornaMensagem(); ?>
    </div>
    <?php } ?>
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/usuario/salvar" method="post"
        id="form_cadastro">
        <input type="hidden" class="form-control" name="fk_instituicao" id="fk_instituicao"
            value="<?php echo $_SESSION['idInstituicao']; ?>" required>
        <div class="kt-portlet__body">
            <input type="hidden" class="form-control" name="dataCadastro" id="dataCadastro"
                value="<?php echo $dataAtual; ?>" required>
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <div class="col-lg-8">
                        <label>Nome de Compelto:</label>
                        <input type="text" class="form-control" placeholder="Digite nome completo" id="nome" name="nome"
                            value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>" required>
                        <span class="form-text text-muted">Digite nome completo</span>
                    </div>
                    <div class="col-lg-4">
                        <label>Primeiro Nome:</label>
                        <input type="text" class="form-control" title="Digite nome que deseja ser chamado" placeholder="primeiro nome" id="apelido" name="apelido"
                            value="<?php echo $Sessao::retornaValorFormulario('apelido'); ?>" required>
                        <span class="form-text text-muted">Digite primeiro nome</span>
                    </div>                    
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label class="">Nivel de usu??rio:</label>
                        <div class="kt-radio-inline">
                            <label class="kt-radio kt-radio--solid">
                                <input type="radio" name="nivel" value="1"> Administrador
                                <span></span>
                            </label>
                        </div>
                        <label class="kt-radio kt-radio--solid">
                            <input type="radio" name="nivel" value="2"> Usuario
                            <span></span>
                        </label>
                        <span class="form-text text-muted">Por favor, selecione o nivel de usu??rios</span>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group"><label for="id_ep">Departamento</label>
                            <select class="form-control" name="id_dep" required>
                                <option value="">Selecione a Departamento</option>
                                <?php foreach ($viewVar['listaDepartamentos'] as $departamento) : ?>
                                <option value="<?php echo $departamento->getId(); ?>"
                                    <?php echo ($Sessao::retornaValorFormulario('id') == $departamento->getId()) ? "selected" : ""; ?>>
                                    <?php echo $departamento->getNome(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <span class="form-text text-muted">Por favor insira o Departamento de usu??rio</span>
                    </div>

                    <div class="col-lg-4">
                        <label class="">Status de usu??rio:</label>
                        <div class="kt-radio-inline">
                            <label class="kt-radio kt-radio--solid">
                                <input type="radio" name="status" value="1" readonly="readonly"> Ativo
                                <span></span>
                            </label>
                        </div>
                        <label class="kt-radio kt-radio--solid">
                            <input type="radio" name="status" checked value="2" readonly="readonly"> Desativado
                            <span></span>
                        </label>
                        <span class="form-text text-muted">Por favor, selecione o status de usu??rios</span>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label class="">Email:</label>
                        <input type="email" class="form-control" placeholder="Digite seu e-mail" name="email"
                            value="<?php echo $Sessao::retornaValorFormulario('email'); ?>" required>
                        <span class="form-text text-muted">Digite seu e-mail</span>
                    </div>
                    <div class="col-lg-4">
                        <label class="">Senha:</label>
                        <input type="password" class="form-control" placeholder="Digite o senha" id="senha" name="senha"
                        value="<?php echo $Sessao::retornaValorFormulario('senha'); ?>" >
                        <span class="form-text text-muted">Por favor insira sua senha</span>
                    </div>
                    <div class="col-lg-4">
                        <label class="">Dica:</label>
                        <input type="text" class="form-control" id="dica" name="dica"
                            placeholder="Digite a dica de senha">
                        <span class="form-text text-muted">Por favor insira sua dica</span>
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
                            <a href="http://<?php echo APP_HOST; ?>/usuario"
                                class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
    </form>

    <!--end::Form-->
</div>

<!--end::Portlet-->

<!-- footer -->

</div>