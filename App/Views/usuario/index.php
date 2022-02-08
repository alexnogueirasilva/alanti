<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <div class="kt-portlet kt-portlet--mobile">

        <form id="frmUserPesq" action="" method="post" id="form_cadastro" enctype="multipart/form-data">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Pesquisa de Usuarios registrados</h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label for="nomeUsuarioPesq">Usuario</label>
                        <select class="form-control" id="nomeUsuarioPesq" name="nomeUsuarioPesq">
                            <option value="">Selecione o Usuario</option>
                            <?php foreach ($viewVar['listaUsuarios'] as $usuario) :  ?>
                                <option value="<?php echo $usuario->getNome(); ?>"
                                    <?php echo ($Sessao::retornaValorFormulario('nomeUsuario') == $usuario->getNome()) ? "selected" : ""; ?>>
                                    <?php echo $usuario->getNome(); ?></option>
                                <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="codigoUser">Codigo Usuario:</label>
                        <input type="text" class="form-control" title="Digite o codigo usurio"
                            placeholder="Codigo do Usuario" id="codigoUser" name="codigoUser"
                            value="<?php echo $Sessao::retornaValorFormulario('codigoUser'); ?>">
                        <span class="form-text text-muted">Por favor insira o codigo</span>
                    </div>
                    <div class="col-lg-4">
                        <label for="emailPesq">E-mail Usuario:</label>
                        <input type="text" class="form-control" title="Digite o codigo usurio"
                            placeholder="E-mail do Usuario" id="emailPesq" name="emailPesq"
                            value="<?php echo $Sessao::retornaValorFormulario('emailPesq'); ?>">
                        <span class="form-text text-muted">Por favor insira o E-mail</span>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group"><label for="status">Status</label>
                            <select class="form-control m-select2" id="status2" name="codStatus[]" multiple="multiple"
                                title="Selecione um ou mais status"
                                value="<?php echo $Sessao::retornaValorFormulario('codStatus'); ?>">>
                                <optgroup for="status" label="Selecione Status">
                                    </option>
                                    <option value="1">1 - Ativo</option>
                                    <option value="2">2 - Inativo</option>
                                </optgroup>
                            </select>
                            <span class="form-text text-muted">Por favor insira o Status</span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label for="departamentoPesq">Departamento</label>
                        <select class="form-control" id="departamentoPesq" name="departamentoPesq">
                            <option value="">Selecione o Departamento</option>
                            <?php foreach ($viewVar['listaDepartamentos'] as $departamento) : ?>
                                <option value="<?php echo $departamento->getId(); ?>"
                                    <?php echo ($Sessao::retornaValorFormulario('id') == $departamento->getId()) ? "selected" : ""; ?>>
                                    <?php echo $departamento->getNome(); ?></option>
                                <?php endforeach; ?>
                        </select>
                        <span class="form-text text-muted">Por favor insira o Departamento</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-elevate btn-pill btn-elevate-air">Pesquisar</button>
            </div>
        </form>

        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <?php
                if ($Sessao::retornaMensagem()) { ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $Sessao::retornaMensagem(); ?>
                </div>
                <?php } ?>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i> Exportar
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first">
                                        <span class="kt-nav__section-text">Escolha uma opção</span>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-print"></i>
                                            <span class="kt-nav__link-text">Imprimir</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-copy"></i>
                                            <span class="kt-nav__link-text">copiar</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                            <span class="kt-nav__link-text">Excel</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">CSV</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="kt-nav__link-text">PDF</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        &nbsp;
                        <a href="http://<?php echo APP_HOST; ?>/usuario/cadastro"
                            class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air"  data-toggle="modal" data-target="#modal_usuario" data-whatever="@getbootstrap">
                            <i class="fa fa-plus fa-2x"></i>Novo Usuario</a>
                            <a id="btnUserLimparFiltro"
                        class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">
                            <i class='fa fa-eraser fa-2x'></i>
                            Limpar Filtro
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_10">
                <thead>
                    <tr>
                        <th  class="text-center">CÓDIGO ID</th>
                        <th  class="text-center">Nome</th>
                        <th  class="text-center">EMAIL</th>
                        <th  class="text-center">NIVEL</th>
                        <th  class="text-center">DEPARTAMENTO</th>
                        <th  class="text-center">STATUS</th>
                        <th  class="text-center">DATA</th>
                        <th  class="text-center">Acoes</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th  class="text-center">CÓDIGO ID</th>
                        <th  class="text-center">Nome</th>
                        <th  class="text-center">EMAIL</th>
                        <th  class="text-center">NIVEL</th>
                        <th  class="text-center">DEPARTAMENTO</th>
                        <th  class="text-center">STATUS</th>
                        <th  class="text-center">DATA</th>
                        <th  class="text-center">Acoes</th>
                    </tr>
                </tfoot>
                <tbody id="listarUsuarios">

                    <!--Prenche os dados dinamicamento pelo js -->

                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>
</div>
<!-- end:: Content -->
</div>


<!-- MODAL usuario-->

<div class="modal fade" id="modal_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">CADASTRO DE USUARIO - <span id="nomeUsuarioTitulo"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>
            <div class="kt-portlet kt-portlet--tabs">

                <div class="modal-kt-portlet__head">
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-left nav-tabs-line-primary" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_builder_principal" role="tab">
                                    Principal
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_builder_endereco" role="tab">
                                    Endereco
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--begin::Form-->

                <form id="frmModalUsuario" class="kt-form kt-form--label-right">
                    <div class="modal-body">
                        <div class="kt-portlet__body">
                            <div class="tab-content">
                                <input type="hidden" id="codigo" name="codigo">
                                <input type="hidden" class="form-control" name="fk_instituicao" id="fk_instituicao"
                                    value="<?php echo $_SESSION['idInstituicao']; ?>" required>
                                <input type="hidden" id="acao" name="acao">
                                <div class="tab-pane active" id="kt_builder_principal">
                                    <div class="form-group row">
                                        <div class="col-lg-8">
                                            <label for="nome">Nome Completo</label>
                                            <input type="text" class="form-control" name="nome" id="nome"
                                                placeholder="nome completo do usuario" value="" required>
                                            <span class="form-text text-muted">Por favor insira o nome completo</span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="apelido">Primeiro Nome</label>
                                            <input type="text" class="form-control" name="apelido" id="apelido"
                                                title="Digite nome que deseja ser chamado" placeholder="primeiro nome"
                                                value="" required>
                                            <span class="form-text text-muted">Digite o primeiro nome</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-5">
                                            <label for="id_dep">Departamento</label>
                                            <div class="input-group">
                                                <select class="form-control" id="id_dep" name="id_dep" required>
                                                    <option value="">Selecione a Departamento</option>
                                                    <?php foreach ($viewVar['listaDepartamentos'] as $departamento) : ?>
                                                    <option value="<?php echo $departamento->getId(); ?>">
                                                        <?php echo $departamento->getNome(); ?> </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <span class="form-text text-muted">Por favor insira o departamento</span>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="nivel">Nivel do Usuario</label>
                                            <div class="input-group">
                                                <select class="form-control" name="nivel" id="nivel">
                                                    <option value="">Selecione o nivel</option>
                                                    <?php if($_SESSION['nivel'] == 1){ ?>
                                                    <option value="1">1 - Administrador</option>
                                                    <option value="2">2 - Usuario</option>
                                                    <?php } else { ?>
                                                    <option value="2" selected>2 - Usuario</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <span class="form-text text-muted">Por favor insira o nivel</span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="status">Status do Usuario</label>
                                            <input type="hidden" class="form-control" name="statusId" id="statusId">
                                            <div class="input-group">                                           
                                                <select class="form-control" name="status" id="status">
                                                    <option value="">Selecione o Status</option>
                                                    <option value="1">1 - Ativo</option>
                                                    <option value="2">2 - Inativo</option>
                                                </select>
                                            </div>
                                            <span class="form-text text-muted">Por favor insira o status</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-5">
                                            <label for="email">E-mail</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Email" value="" required>
                                            <span class="form-text text-muted">Por favor insira o e-mail</span>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="">Senha:</label>
                                            <input type="password" class="form-control" placeholder="Digite o senha"
                                                id="senha" name="senha" value="<?php echo $Sessao::retornaValorFormulario('senha'); ?>">
                                            <span class="form-text text-muted">Por favor insira sua senha</span>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="dica">Dica</label>
                                            <input type="text" class="form-control" name="dica" id="dica"
                                                placeholder="Dida de senha" value="" required>
                                            <span class="form-text text-muted">Por favor insira a dica de senha</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="kt_builder_endereco">
                                </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <div class="row">
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-8">
                                            <button type="Submit" id="btnUserSalvar" name="btnUserSalvar"
                                                class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air">Salvar</button>
                                            <a id="btnUserNovo"
                                                class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Novo</a>
                                            <a id="btnUserDelete"
                                                class="btn btn-outline-danger btn-elevate btn-pill btn-elevate-air">Excluir</a>
                                            <a id="btnUserUpdate"
                                                class="btn btn-outline-warning btn-elevate btn-pill btn-elevate-air">Alterar</a>
                                            <button type="button" id="btnUserCancel" data-dismiss="modal"
                                                class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
            <!--end::Modal-->
        </div>
    </div>

</div>
</div>
<!-- MODAL usuario-->