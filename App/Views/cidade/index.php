<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <div class="kt-portlet kt-portlet--mobile">
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/cidade/" method="post" id="form_cadastro" enctype="multipart/form-data">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                    <h3 class="kt-portlet__head-title">
                    Pesquisa de Cidades Cadastradas 
                    </h3>                   
            </div>
        </div>
            <div class="kt-portlet__body">                     
                <div class="form-group row">
                    <div class="col-lg-3">
                        <label for="pesCliCodigo">Codigo:</label>
                        <input type="text" class="form-control" title="Digite o codido" placeholder="Código" id="pesCidCodigo" name="pesCidCodigo" value="<?php echo $Sessao::retornaValorFormulario('pesCidCodigo'); ?>">
                    </div>
                    <div class="col-lg-4">
                        <label for="pesCidNome">Nome:</label>
                        <input type="text" class="form-control" title="Digite a Nome" placeholder="Nome" id="pesCidNome" name="pesCidNome" value="<?php echo $Sessao::retornaValorFormulario('pesCidNome'); ?>">
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <div class="form-group"><label for="pesCidUf">Estado</label>
                                <select class="form-control m-select2" id="kt_select2_3" name="pesCidUf[]"
                                    multiple="multiple">
                                    <optgroup for="pesCidUf" label="Estado">
                                        <?php foreach ($viewVar['listaEstados'] as $estado) : ?>
                                        <option value="<?php echo $estado->getEstUf(); ?>"
                                            <?php echo ($Sessao::retornaValorFormulario('pesCidUf') == $estado->getEstId()) ? "selected" : ""; ?>>
                                            <?php echo $estado->getEstUf(); ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>                                  
                </div>
                <button type="submit" class="btn btn-primary btn-elevate btn-pill btn-elevate-air">Pesquisar</button>
            </div>                     
    </form>
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">               
                <?php if ($Sessao::retornaMensagem()) { ?>
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
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                        <a href="http://<?php echo APP_HOST; ?>/cidade/excel" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                            <span class="kt-nav__link-text">Excel</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="http://<?php echo APP_HOST; ?>/cidade/excel" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">CSV</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="http://<?php echo APP_HOST; ?>/cidade/pdf" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="kt-nav__link-text">PDF</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        &nbsp;
                        <a href="http://<?php echo APP_HOST; ?>/cidade/cadastro" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-plus"></i>
                            Novo cidade
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <?php
                    $dados = $viewVar['listaCidades'];
                    if ($dados > 0) {
            ?>
            <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_3">
                <thead>
                    <tr>
                        <th class="text-center">CÓDIGO</th>
                        <th class="text-center">NOME</th>
                        <th class="text-center">UF</th>
                        <th class="text-center">USUARIO</th>
                        <th class="text-center">Acoes</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-center">CÓDIGO</th>
                        <th class="text-center">NOME</th>
                        <th class="text-center">UF</th>
                        <th class="text-center">USUARIO</th>
                        <th class="text-center">Acoes</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        foreach ($dados as $cidade) {
                            ?>
                            <tr>
                                <td><?php echo $cidade->getCidId(); ?></td>
                                <td><?php echo $cidade->getCidNome(); ?></td>
                                <td><?php echo $cidade->getEstado()->getEstUf(); ?></td>
                                <td><?php echo $cidade->getUsuario()->getNome(); ?></td>
                                <td>
                                    <span class="dropdown">
                                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true"><i class="la la-ellipsis-h"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/cidade/edicao/<?php echo $cidade->getCidId(); ?>" title="Editar" class="btn btn-info btn-sm"><i class="la la-edit"></i> Editar</a>
                                            <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/cidade/exclusao/<?php echo $cidade->getCidId(); ?>" title="Excluir" class="btn btn-info btn-sm"><i class="la la-trash"></i> Excluir</a>
                                            <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/cidade/edicao/<?php echo $cidade->getCidId(); ?>" title="Status" class="btn btn-info btn-sm"><i class="la la-leaf"></i> Status</a>
                                            <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/cidade/edicao/<?php echo $cidade->getCidId(); ?>" title="Relatorios" class="btn btn-info btn-sm"><i class="la la-print"></i> Relatorio</a>
                                        </div>
                                    </span>
                                    <a href="http://<?php echo APP_HOST; ?>/cidade/edicao/<?php echo $cidade->getCidId(); ?>" title="Editar" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-edit"></i></a>
                                    <a href="http://<?php echo APP_HOST; ?>/cidade/exclusao/<?php echo $cidade->getCidId(); ?>" title="Excluir" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-trash"></i></a>
                                </td>
                        <?php
                            }
                       
                        ?>
                            </tr>
                </tbody>
               
            </table>
            <?php
            }else {

                echo "<center><h3 class='kt-portlet__head-title'><p class='text-danger'>Nenhum Dado Encontrado!</p></h3>";

                echo "<div class='kt-error_container'><img src='http://". APP_HOST."/public/assets/media/logos/alanti_logo.png' style='width: 400px; height: 250px;' alt='ALANTI' > </div>";
            }
            ?>

            <!--end: Datatable -->
        </div>
    </div>
</div>

<!-- end:: Content -->
</div>