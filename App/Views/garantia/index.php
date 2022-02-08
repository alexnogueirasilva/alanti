<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <div class="kt-portlet kt-portlet--mobile">
        <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/garantia/" method="post"
            id="form_cadastro" enctype="multipart/form-data">
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
                        <select class="form-control" id="operador" name="operador">
                            <option value="">Selecione o Usuario</option>

                        </select>
                        <span class="form-text text-muted">Por favor insira o Representante</span>
                    </div>
                    <div class="col-lg-3">
                        <label for="codRepresentante">Representante</label>
                        <select class="form-control" id="codRepresentante" name="codRepresentante">
                            <option value="">Selecione o Representante</option>

                        </select>
                        <span class="form-text text-muted">Por favor insira o Representante</span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-1">
                        <label for="codigo">Codigo:</label>
                        <input type="text" class="form-control" title="Digite o codido" placeholder="codigo" id="codigo"
                            name="codigo" value="<?php echo $Sessao::retornaValorFormulario('codigo'); ?>">
                    </div>
                    <div class="col-lg-2">
                        <label for="prosposta">Prosposta:</label>
                        <input type="text" class="form-control" title="Digite o numero da Prosposta"
                            placeholder="Prosposta" id="proposta" name="proposta"
                            value="<?php echo $Sessao::retornaValorFormulario('proposta'); ?>">
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
                            <select class="form-control" name="modalidade" id="modalidade">
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
                        <input type="text" class="form-control" title="Digite o numero da licitacao"
                            placeholder="Nume. Licitacao" id="numeroLicitacao" name="numeroLicitacao"
                            value="<?php echo $Sessao::retornaValorFormulario('numeroLicitacao'); ?>">
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
                                        <a href="http://<?php echo APP_HOST; ?>/garantia/excel" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                            <span class="kt-nav__link-text">Excel</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="http://<?php echo APP_HOST; ?>/garantia/excel" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">CSV</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="http://<?php echo APP_HOST; ?>/garantia/pdf" class="kt-nav__link">
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
            <input type="hidden" id="grtcodigo" name="grtcodigo" class="form-control">
            <?php
                                        $dados = $viewVar['garantia'] ;
                                        if (!empty($dados)) {
                                    ?>
            <!--begin: Datatable -->
            <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_3">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">MARCA</th>
                        <th class="text-center">EDITAL</th>
                        <th class="text-center">DATA SOLICITACAO</th>
                        <th class="text-center">DATA RECEBIMENTO</th>
                        <th class="text-center">DATA RESULTADO</th>
                        <th class="text-center">RESULTADO</th>
                        <th class="text-center">ACOES</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">MARCA</th>
                        <th class="text-center">EDITAL</th>
                        <th class="text-center">DATA SOLICITACAO</th>
                        <th class="text-center">DATA RECEBIMENTO</th>
                        <th class="text-center">DATA RESULTADO</th>
                        <th class="text-center">RESULTADO</th>
                        <th class="text-center">ACOES</th>
                    </tr>
                </tfoot>
                <?php                                         
                                                foreach ( $dados as $garantia) { ?>
                <tr>
                    <td><?php echo $garantia->getCtrId(); ?></td>
                     <td class="text-center"><span class="badge badge-pill badge-<?php echo $garantia->getGrtPkIdStatus()->getCors()->getCorCor(); ?>">
                        <?php echo $garantia->getGrtPkIdStatus()->getStGarNome(); ?>
                    </td>
                    <td><?php  echo $garantia->getGrtFornecedor()->getForNomeFantasia(); ?></td>
                    <td><?php //exibi o nome do cliente
                        echo "<a  style='color: #6495ED' title='". $garantia->getGrtPkIdEdital()->getClienteLicitacao()->getNomeFantasia()."'>" .$garantia->getGrtPkIdEdital()->getEdtNumero() ." </a> ";
                    ?></td>
                    <td><?php echo $garantia->getGrtDataSolicitacao()->format('d/m/Y'); ?></td>
                    <td>
                        <?php 
                                                    if ($garantia->getGrtPkIdStatus()->getStGarNome() == "NAO GARANTIDO") {
                                                        echo "<span class='badge badge-pill badge-success'>NÃO INFORMAR!</span>";                                                       
                                                    } else{
                                                        if($garantia->getGrtPkIdStatus()->getStGarNome() == "NAO RESPONDIDO"){
                                                            echo "<span class='badge badge-pill badge-danger'>". $garantia->getGrtPkIdStatus()->getStGarNome() ."</span>";
                                                        }else {                                                        
                                                            echo $garantia->getGrtDataRecebido()->format('d/m/Y');
                                                        }
                                                    }
                                                ?>
                    </td>
                    <td class="text-center">
                        <?php if ($garantia->getGrtPkIdStatus()->getStGarNome() == "NAO GARANTIDO") {
                                                        echo "<span class='badge badge-pill badge-success'>NÃO INFORMAR!</span>";                                                                                                           
                                                      } else{
                                                        if(($garantia->getGrtDataResultado()->format('d/m/Y') == $garantia->getGrtDataSolicitacao()->format('d/m/Y')) || ($garantia->getGrtPkIdStatus()->getStGarNome() == "NAO RESPONDIDO")){
                                                            echo "<span class='badge badge-pill badge-danger'>NÃO INFORMADO</span>";
                                                        }else {                                                        
                                                            echo $garantia->getGrtDataResultado()->format('d/m/Y');
                                                        }
                                                    }                                   
                                                    ?>
                    </td>
                    <td>
                        <?php
                            if ($garantia->getGrtResultado() == "NAO INFORMADO") {
                                echo "<span class='badge badge-pill badge-danger'>". $garantia->getGrtResultado() ."</span>";                                                      
                            } else{
                                if(($garantia->getGrtResultado() == "INFORMADO") || ($garantia->getGrtResultado() == "NAO INFORMAr")){
                                    echo "<span class='badge badge-pill badge-success'>". $garantia->getGrtResultado() ."</span>";
                                }else{
                                    echo "<span class='badge badge-pill badge-warning'>". $garantia->getGrtResultado() ."</span>";
                                }
                            }
                        ?>
                    </td>
                    <td class="text-center">
                        <div class="dropdown  d-block d-md">
                            <button class="btn btn-primary dropdown-toggle btn-elevate btn-pill btn-elevate-air btn-sm"
                                type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                Ações
                            </button>
                            <div class="dropdown-menu dropdown-menu-right " aria-labelledby="acoesListar">
                                <a href="http://<?php echo APP_HOST; ?>/garantia/visualizar/<?php echo $garantia->getGrtPkIdEdital()->getEdtId(); ?>"
                                    class="dropdown-item btn btn-outline-success btn-elevate btn-pill btn-elevate-air btn-sm"><i
                                        class="la la-list"></i>Visualizar</a>
                                <a href="http://<?php echo APP_HOST; ?>/garantia/cadastro/<?php echo $garantia->getGrtPkIdEdital()->getEdtId(); ?>"
                                    class="dropdown-item btn btn-outline-warning btn-elevate btn-pill btn-elevate-air btn-sm"><i
                                        class="la la-edit"></i>Editar</a>
                                <a data-codigo="<?php echo $garantia->getCtrId() ;?>"
                                    data-fornecedor="<?php echo $garantia->getGrtFornecedor()->getForNomeFantasia() ;?>"
                                    data-codigoedital="<?php echo $garantia->getGrtPkIdEdital()->getEdtId(); ?>"
                                    title="Excluir Garantia" id="btnApagarGarantia"
                                    class="dropdown-item btn btn-outline-danger btn-elevate btn-pill btn-elevate-air btn-sm"><i
                                        class="la la-trash"></i>Apagar</a>
                                <a href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/<?php echo $garantia->getGrtAnexo(); ?>"
                                    class="dropdown-item btn btn-outline-dark btn-elevate btn-pill btn-elevate-air btn-sm"
                                    target="_blank" title="Visualizar anexo"> <i class="la la-chain"></i>Anexo</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
            <!--end: Datatable -->
            <?php 
                } else {
                    echo "<h3 class='kt-portlet__head-title'><p class='text-danger'>Nenhum Dado Encontrado!</p></h3>";
                }
            ?>
        </div>
        <!--end::Portlet-->
    </div>
</div>
