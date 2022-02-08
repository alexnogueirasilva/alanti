<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

<div class="kt-portlet kt-portlet--mobile">
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/edital/" method="post" id="form_cadastro" enctype="multipart/form-data">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                Pesquisa de garantias registrados
            </h3>
        </div>
        </div>
        <div class="kt-portlet__body">
        <div class="form-group row">
            <div class="col-lg-6">
            <label for="codCliente">Cliente</label>
                <select class="form-control" name="codCliente">
                    <option value="">Selecione o cliente</option>
                    </select>
            </div>
            <div class="col-lg-3">
                        <label for="operador">Usuario</label>
                        <select class="form-control" id="operador" name="operador" >
                                <option value="">Selecione o Usuario</option>
                                
                            </select>
                        <span class="form-text text-muted">Por favor insira o Representante</span>
            </div>   
            <div class="col-lg-3">
                        <label for="codRepresentante">Representante</label>
                        <select class="form-control" id="codRepresentante" name="codRepresentante" >
                                <option value="">Selecione o Representante</option>
                                
                            </select>
                        <span class="form-text text-muted">Por favor insira o Representante</span>
            </div>   
            </div>   
            
                <div class="form-group row">
                    <div class="col-lg-1">
                        <label for="codigo">Codigo:</label>
                        <input type="text" class="form-control" title="Digite o codido" placeholder="codigo" id="codigo" name="codigo" value="<?php echo $Sessao::retornaValorFormulario('codigo'); ?>">
                    </div>
                    <div class="col-lg-2">
                        <label for="prosposta">Prosposta:</label>
                        <input type="text" class="form-control" title="Digite o numero da Prosposta" placeholder="Prosposta" id="proposta" name="proposta" value="<?php echo $Sessao::retornaValorFormulario('proposta'); ?>">
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group"><label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="">Selecione o status</option>
                            
                        </select>
                        <span class="form-text text-muted">Por favor insira o status</span>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group"><label for="modalidade">modalidade</label>
                        <select class="form-control" name="modalidade" id="modalidade" >
                                <option value="">Selecione a Modalidade</option>
                                <option value="Eletronico">Eletronico</option>
                                <option value="Presencial">Presencial</option>
                                <option value="Concorrencia">Concorrencia</option>
                                <option value="Convite">Convite</option>
                            </select>
                            <span class="form-text text-muted">Por favor insira o Modalidade</span>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <label>Licitacao:</label>
                        <input type="text" class="form-control" title="Digite o numero da licitacao" placeholder="Nume. Licitacao" id="numeroLicitacao" name="numeroLicitacao" value="<?php echo $Sessao::retornaValorFormulario('numeroLicitacao'); ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-elevate btn-pill btn-elevate-air">Pesquisar</button>
            </div>
    </form>
    <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Pesquisa de coluna individual
                </h3>
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
                        <a href="#" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-plus"></i>
                            Novo Cadastro
                        </a>
                    </div>
                </div>
            </div>
    </div>
        
        <div class="kt-portlet__body">
                <input type="hidden" id="usuario" name="usuario" value="<?php echo $_SESSION['id']; ?>"
                       class="form-control">
                <input type="hidden" id="instituicao" name="instituicao" value="<?php echo $_SESSION['inst_id']; ?>"
                       class="form-control">
                <input type="hidden" id="grtcodigo" name="grtcodigo"  class="form-control">                               
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
                                        
                                        foreach ($viewVar['garantia'] as $garantia) { ?>

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
                                                <a href="http://<?php echo APP_HOST; ?>/garantia/cadastro/<?php echo $garantia->getGrtPkIdEdital()->getEdtId(); ?>"
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
        <!--end::Portlet-->
    </div>
</div>