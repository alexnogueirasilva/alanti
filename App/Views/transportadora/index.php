<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <div class="kt-portlet kt-portlet--mobile">
        <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/transportadora/" method="post"
            id="form_cadastro" enctype="multipart/form-data">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Pesquisa de transportadoras registradas
                    </h3>
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
            </div>
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <div class="col-lg-8">
                        <label for="codigo">Transportadora</label>
                        <select class="form-control" id="codigo" name="codigo">
                            <option value="">Selecione a Razao Social</option>
                            <?php foreach ($viewVar['carregarTransportadoras'] as $transportadora) : ?>
                            <option value="<?php echo $transportadora->getTraId(); ?>"
                                <?php echo ($Sessao::retornaValorFormulario('codigo') ) ? "selected" : ""; ?>>
                                <?php echo $transportadora->getTraRazaoSocial() ."    - CNPJ: ". $transportadora->getTraCnpj(); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label for="nomefantasia">Nome Fantasia</label>
                        <select class="form-control" id="nomefantasia" name="nomefantasia">
                            <option value="">Selecione o Nome Fantasia</option>
                            <?php foreach ($viewVar['carregarTransportadoras'] as $transportadora) : ?>
                            <option value="<?php echo $transportadora->getTraNomeFantasia(); ?>"
                                <?php echo ($Sessao::retornaValorFormulario('nomefantasia')) ? "selected" : ""; ?>>
                                <?php echo $transportadora->getTraNomeFantasia(); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="form-text text-muted">Por favor insira o Nome Fantasia</span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-1">
                        <label for="codigo1">Codigo:</label>
                        <input type="text" class="form-control" title="Digite o codido" placeholder="codigo"
                            id="codigo1" name="codigo1" >
                        <span class="form-text text-muted">Codigo</span>
                    </div>
                    <div class="col-lg-2">
                        <label for="cnpj">CNPJ:</label>
                        <input type="text" class="form-control" title="Digite o numero da CNPJ" placeholder="CNPJ"
                            id="cnpj" name="cnpj" >
                        <span class="form-text text-muted">CNPJ</span>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group"><label for="status">Status</label>
                            <select title="Selecione a status" class="form-control" name="status" id="status">
                                <option value="">Selecione o Status</option>
                                <option value="Ativo">Ativo</option>
                                <option value="Inativo">Inativo</option>
                            </select>
                            <span class="form-text text-muted">Por favor insira o Status</span>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group"><label for="tipo">Tipo</label>
                            <select class="form-control" name="tipo" id="tipo">
                                <option value="">Selecione o Tipo</option>
                                <option value="FISICO">FISICO</option>
                                <option value="JURIDICO">JURIDICO</option>
                            </select>
                            <span class="form-text text-muted">Por favor insira o tipo</span>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <label for="inscricaoestadual">Inscricao Estadual:</label>
                        <input type="text" class="form-control" title="Digite a Inscricao Estadual"
                            placeholder="Inscricao Estadual" id="inscricaoestadual" name="inscricaoestadual">
                        <span class="form-text text-muted">Inscricao Estadual</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-elevate btn-pill btn-elevate-air">Pesquisar</button>
            </div>
        </form>
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
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
                        <a href="http://<?php echo APP_HOST; ?>/transportadora/cadastro"
                            class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-plus"></i>
                            Novo Cadastro
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_3">
                <thead>
                    <tr>
                        <th  class="text-center">CODIGO</th>
                        <th  class="text-center">RAZAO SOCIAL</th>
                        <th  class="text-center">CNPJ</th>
                        <th  class="text-center">CIDADE</th>
                        <th  class="text-center">STATUS</th>
                        <th  class="text-center">DATA</th>
                        <th  class="text-center">ACOES</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th  class="text-center">CODIGO</th>
                        <th  class="text-center">RAZAO SOCIAL</th>
                        <th  class="text-center">CNPJ</th>
                        <th  class="text-center">CIDADE</th>
                        <th  class="text-center">STATUS</th>
                        <th  class="text-center">DATA</th>
                        <th  class="text-center">ACOES</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $dados = $viewVar['listarTransportadoras'];
                    if (!empty($dados)) {  
                        foreach ($dados as $transportadora) {
                            ?>
                    <tr>
                        <td><?php echo $transportadora->getTraId(); ?></td>
                        <td><?php echo $transportadora->getTraRazaoSocial(); ?></td>
                        <td><?php echo $transportadora->getTraCnpj(); ?></td>
                        <td><?php echo $transportadora->getEndCidade()->getCidNome(); ?></td>
                        <td class="text-center"><span class="badge badge-pill badge-<?php echo $transportadora->getSituacoes()->getCors()->getCorCor(); ?>"><?php echo $transportadora->getSituacoes()->getSitNome(); ?></span></td>
                        <td><?php echo $transportadora->getTraDataCadastro()->format('d/m/Y'); ?></td>
                        <td>
                            <span class="dropdown">
                                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown"
                                    aria-expanded="true"><i class="la la-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" id="btnTraEditar" name="btnTraEditar"
                                        href='http://<?php echo APP_HOST; ?>/transportadora/edicao/<?php echo $transportadora->getTraId(); ?>'
                                        title="Editar" class="btn btn-info btn-sm"><i class="la la-edit"></i> Editar</a>
                                    <a class="dropdown-item"
                                        href="http://<?php echo APP_HOST; ?>/transportadora/exclusao/<?php echo $transportadora->getTraId(); ?>"
                                        title="Excluir" class="btn btn-info btn-sm"><i class="la la-trash"></i>
                                        Excluir</a>
                                    <a class="dropdown-item"
                                        href="http://<?php echo APP_HOST; ?>/transportadora/edicao/<?php echo $transportadora->getTraId(); ?>"
                                        title="Status" class="btn btn-info btn-sm"><i class="la la-leaf"></i> Status</a>
                                    <a class="dropdown-item"
                                        href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/<?php echo $transportadora->getTraId(); ?>"
                                        target="_blank" title="Visualizar Anexo" class="btn btn-info btn-sm"><i
                                            class="la la-chain"></i> Anexo</a>
                                    <a class="dropdown-item"
                                        href="http://<?php echo APP_HOST; ?>/transportadora/edicao/<?php echo $transportadora->getTraId(); ?>"
                                        title="Relatorios" class="btn btn-info btn-sm"><i class="la la-print"></i>
                                        Relatorio</a>
                                </div>
                            </span>
                            <a id="btnTraEditar1" name="btnTraEditar"
                                href='http://<?php echo APP_HOST; ?>/transportadora/edicao/<?php echo $transportadora->getTraId(); ?>'
                                title="Editar" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i
                                    class="la la-edit"></i></a>
                            <a id="btnTraExcluir" name="btnTraExcluir"
                                href='http://<?php echo APP_HOST; ?>/transportadora/exclusao/<?php echo $transportadora->getTraId(); ?>'
                                title="Excluir" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i
                                    class="la la-trash"></i></a>
                        </td>
                        <?php
                            }
                        } else {

                            echo "<h3 class='kt-portlet__head-title'><p class='text-danger'>Nenhum Dado Encontrado!</p></h3>";
                        }
                        ?>
                    </tr>
                </tbody>

            </table>

            <!--end: Datatable -->
        </div>
    </div>
</div>

<!-- end:: Content -->
</div>
