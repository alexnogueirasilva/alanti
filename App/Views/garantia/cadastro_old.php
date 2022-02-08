<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">

                <h1 class="kt-portlet__head-title">
                    GERENCIAMENTO DE GARANTIA <span> - <?php echo $viewVar['garantia']->getGrtPkIdEdital()->getClienteLicitacao()->getRazaoSocial(); ?>
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
                        <a class="nav-link " data-toggle="tab" href="#kt_builder_observacao" role="tab">
                            Observacao
                        </a>
                    </li>

                </ul>
            </div>
        </div>


        <!--begin::Form-->


        <div class="kt-portlet__body">
            <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/garantia/salvar"
                  method="post"
                  id="form_cadastro" enctype="multipart/form-data">
                <input type="hidden" id="usuario" name="usuario" value="<?php echo $_SESSION['id']; ?>"
                       class="form-control">
                <input type="hidden" id="instituicao" name="instituicao" value="<?php echo $_SESSION['inst_id']; ?>"
                       class="form-control">
                       <input type="hidden" id="grtcodigo" name="grtcodigo"  class="form-control">
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane  active" id="kt_builder_principal">
                            <div class="kt-portlet__body">
                                <input type="hidden" class="form-control" id="grtpkidedital" name="grtpkidedital"
                                       value="<?php echo $viewVar['garantia']->getGrtPkIdEdital()->getEdtId(); ?>"
                                       required>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label for="fornecedor" class="">Fornecedor:</label>
                                        <div class="kt-input-icon kt-input-icon--right">
                                            <input class="form-control" type="text" id="autocomplete-garantia"
                                                   name="autocomplete-garantia" required
                                                   value="<?php echo $viewVar['garantia']->getGrtFornecedor()->getForNomeFantasia(); ?>">
                                            <input type="hidden" id="grtfornecedor" name="grtfornecedor"
                                                   value="<?php echo $viewVar['garantia']->getGrtFornecedor()->getFornecedor_Cod(); ?>">
                                        </div>
                                        <span class="form-text text-muted">Favor informar</span>
                                    </div>
                                    <div class="col-lg-2">
                                        <label for="" class="">Status:</label>
                                        <div class="kt-input-icon kt-input-icon--right">
                                            <select class="form-control" id="garantiastatus" name="garantiastatus">
                                                <option value="">Selecione o Status</option>
                                                <?php foreach ($viewVar['garantiastatus'] as $garantiastatus) : ?>
                                                <option value="<?php echo $garantiastatus->getStGarId(); ?>"
                                                    <?php echo ($Sessao::retornaValorFormulario('garantiastatus') == $garantiastatus->getStGarId()) ? "selected" : ""; ?>>
                                                    <?php echo $garantiastatus->getStGarNome(); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Favor informar </span>
                                </div>
                                <div class="col-lg-2">
                                    <label for="" class="">Resultado:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <select class="form-control" id="grtresultado" name="grtresultado" required>
                                            <option value="">Selecione o Resultado</option>
                                            <option value="Ganho"> Ganho</option>
                                            <option value="Perdido"> Perdido</option>
                                            <option value="Outros"> Outros</option>
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Favor informar </span>
                                </div>
                                <div class="col-lg-2">
                                    <label for="" class="">Data de Solicitacao:</label>
                                    <input type="date" class="form-control" placeholder="Digite a Data de Solicitacao"
                                           id="grtdatasolicitacao" name="grtdatasolicitacao" value="">
                                    <span class="form-text text-muted">Digite a Data</span>
                                </div>
                                <div class="col-lg-2">
                                    <label for="" class="">Data de Resultado:</label>
                                    <input type="date" class="form-control" placeholder="Digite a Data de Resultado"
                                           id="grtdataresultado" name="grtdataresultado" value=" ">
                                    <span class="form-text text-muted">Digite a Data</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="anexo" class="">Anexo:</label>
                                    <input type="file" name="grtanexo" id="grtanexo"
                                           value="<?php echo $Sessao::retornaValorFormulario('grtanexo'); ?>">
                                            <input type="hidden" class="form-control" id="grtanexoAlt"
                                                    readonly="readonly" name="grtanexoAlt">
                                                <a class="dropdown-item" id="grtanexoverAnexo" name="grtanexoverAnexo" target="_blank"
                                                    title="Click para Visualizar Anexo" class="btn btn-info btn-sm"><i
                                                        class="la la-chain"></i> Anexo</a>
                                    <span class="form-text text-muted">Selecione o arquivo</span>
                                </div>
                                <div class="col-lg-2">
                                    <label for="btnAdicionarGarantia" class="">Adicionar Garantia:</label>
                                    <button type="submit" class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air form-control"
                                       id="btnAdicionarGarantia">Adicionar</button>
                                </div>
                            </div>

                                <!--begin exporte -->
                                <!--div class="kt-portlet kt-portlet--mobile">
                                    <div class="kt-portlet__head">
                                        <div class="kt-portlet__head-label">
                                            <h3 class="kt-portlet__head-title">
                                                Garantias Cadastradas
                                            </h3>
                                        </div>
                                        <div class="kt-portlet__head-toolbar">
                                            <div class="kt-portlet__head-toolbar-wrapper">
                                                <div class="dropdown dropdown-inline">
                                                    <button type="button" class="btn btn-brand btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="la la-plus"></i> Tools
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__section kt-nav__section--first">
                                                                <span class="kt-nav__section-text">Export Tools</span>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link" id="export_print">
                                                                    <i class="kt-nav__link-icon la la-print"></i>
                                                                    <span class="kt-nav__link-text">Print</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link" id="export_copy">
                                                                    <i class="kt-nav__link-icon la la-copy"></i>
                                                                    <span class="kt-nav__link-text">Copy</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link" id="export_excel">
                                                                    <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                                    <span class="kt-nav__link-text">Excel</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link" id="export_csv">
                                                                    <i class="kt-nav__link-icon la la-file-text-o"></i>
                                                                    <span class="kt-nav__link-text">CSV</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link" id="export_pdf">
                                                                    <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                                    <span class="kt-nav__link-text">PDF</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div-->
                                <!--end export -->
                                <div class="kt-portlet__body">
                                    <!--begin: Datatable -->
                                    <table class="table table-striped- table-bordered table-hover table-checkable"
                                           id="kt_table_3">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>STATUS</th>
                                            <th>MARCA</th>
                                            <th>DATA SOLICITACAO</th>
                                            <th>DATA RESULTADO</th>
                                            <th>RESULTADO</th>
                                            <th>ANEXO</th>
                                            <th>ACOES</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>STATUS</th>
                                            <th>MARCA</th>
                                            <th>DATA SOLICITACAO</th>
                                            <th>DATA RESULTADO</th>
                                            <th>RESULTADO</th>
                                            <th>ANEXO</th>
                                            <th>ACOES</th>
                                        </tr>
                                        </tfoot>
                                        <?php
                                        foreach ($viewVar['garantias'] as $garantia) { ?>

                                            <td><?php echo $garantia->getCtrId(); ?></td>
                                            <td><?php echo $garantia->getGrtPkIdStatus()->getStGarNome(); ?></td>
                                            <td><?php echo $garantia->getGrtFornecedor()->getForNomeFantasia(); ?></td>
                                            <td><?php echo $garantia->getGrtDataSolicitacao()->format('d/m/Y'); ?></td>
                                            <td><?php echo $garantia->getGrtDataResultado()->format('d/m/Y'); ?></td>
                                            <td><?php echo $garantia->getGrtResultado(); ?></td>
                                            <td></td>
                                            <td>
                                        <span class="dropdown">
                                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                           data-toggle="dropdown" aria-expanded="true"><i class="la la-ellipsis-h"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            
                                            <a class="dropdown-item"
                                               href="http://<?php echo APP_HOST; ?>/garantia/exclusao/<?php ?>"
                                               title="Excluir" class="btn btn-info btn-sm"><i class="la la-trash"></i> Excluir</a>
                                            <a class="dropdown-item"
                                               href="http://<?php echo APP_HOST; ?>/edital/edicao/<?php ?>"
                                               title="Status" class="btn btn-info btn-sm"><i class="la la-leaf"></i> Status</a>
                                            <a class="dropdown-item"
                                               href="http://<?php echo APP_HOST; ?>/edital/edicao/<?php ?>"
                                               title="Relatorios" class="btn btn-info btn-sm"><i
                                                    class="la la-print"></i> Relatorio</a>
                                        </div>
                                    </span>
                                                <a target="_blank"
                                                   href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/<?php echo $garantia->getGrtAnexo(); ?>"
                                                   title="Visualizar anexo">
                                                    <button type="button"
                                                            class="btn btn-outline-dark btn-elevate btn-icon">
                                                        <i class="la la-file-text-o"></i></button>
                                                </a>
                                                <a href="#"
                                                data-codigo="<?php echo $garantia->getCtrId() ;?>"
                                               data-datasolicitacao="<?php echo $garantia->getGrtDataSolicitacao()->format('Y-m-d') ;?>"
                                               data-dataresultado="<?php echo $garantia->getGrtDataResultado()->format('Y-m-d') ;?>"
                                               data-status="<?php echo $garantia->getGrtPkIdStatus()->getStGarNome() ;?>"
                                               data-statusid="<?php echo $garantia->getGrtPkIdStatus()->getStGarId() ;?>"
                                               data-resultado="<?php echo $garantia->getGrtResultado() ;?>"
                                               data-anexo="<?php echo $garantia->getGrtAnexo() ;?>"
                                               data-fornecedor="<?php echo $garantia->getGrtFornecedor()->getForNomeFantasia() ;?>"
                                               data-fornecedorid="<?php echo $garantia->getGrtFornecedor()->getFornecedor_Cod() ;?>"
                                               title="Editar" id="btnEditarGarantia" name="btnEditarGarantia"
                                                   title="Editar" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i
                                                        class="la la-edit"></i></a>
                                                <a href="http://<?php echo APP_HOST; ?>/garantia/exclusao/<?php ?>"
                                                   title="Excluir" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i
                                                        class="la la-trash"></i></a>
                                            </td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
                                <!--end: Datatable -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="kt_builder_observacao">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label for="observacao">Observacao:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"></div>
                                        <textarea type="text" id="observacao" rows="5" name="observacao"
                                                  class="form-control"
                                                  placeholder="Entre com observacao"></textarea>
                                    </div>
                                    <span class="form-text text-muted">Favor informar observacao</span>
                                </div>

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
                                <a id="btnTraNovo"
                                   class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Novo</a>
                                <a type="button" id="btnVoltarTra"
                                   href='http://<?php echo APP_HOST; ?>/edital/index'
                                   class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                                <a id="btnTraAlterar"
                                   class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Alterar</a>
                                <button type="submit" id="btnTraExcluir"
                                        class="btn btn-outline-danger btn-elevate btn-pill btn-elevate-air">Excluir
                                </button>
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