<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <div class="kt-portlet kt-portlet--mobile">
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/contrato/" method="post" id="form_cadastro" enctype="multipart/form-data">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                    <h3 class="kt-portlet__head-title">
                    Pesquisa de contratos cadastrados 
                    </h3>                   
            </div>
        </div>
            <div class="kt-portlet__body">  
                <div class="form-group row">
                    <div class="col-lg-9">
                        <label for="clienteId">Cliente</label>
                        <select class="form-control" name="clienteId">
                            <option value="">Selecione o cliente</option>
                            <?php foreach ($viewVar['listaClientes'] as $cliente) : ?>
                            <option value="<?php echo $cliente->getEdital()->getClienteLicitacao()->getCodCliente(); ?>" <?php echo ($Sessao::retornaValorFormulario('clienteId') == $cliente->getEdital()->getClienteLicitacao()->getCodCliente()) ? "selected" : ""; ?>>
                            <?php echo $cliente->getEdital()->getClienteLicitacao()->getRazaoSocial(); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="form-text text-muted">Por favor insira o cliente</span>
                    </div>
                    <div class="col-lg-3">
                        <label for="codRepresentante">Representante</label>
                        <select class="form-control" id="codRepresentante" name="codRepresentante" >
                            <option value="">Selecione o Representante</option>
                            <?php foreach ($viewVar['listarRepresentantes'] as $representante) : ?>
                            <option value="<?php echo $representante->getEdital()->getRepresentante()->getCodRepresentante(); ?>" <?php echo ($Sessao::retornaValorFormulario('codRepresentante') == $representante->getEdital()->getRepresentante()->getCodRepresentante()) ? "selected" : ""; ?>>
                            <?php echo $representante->getEdital()->getRepresentante()->getNomeRepresentante(); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="form-text text-muted">Por favor insira o Representante</span>
                    </div>   
                </div>       
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="codigo">Codigo:</label>
                        <input type="text" class="form-control" title="Digite o codido" placeholder="codigo" id="codigo" name="codigo" value="<?php echo $Sessao::retornaValorFormulario('codigo'); ?>">
                    </div>
                    <div class="col-lg-2">
                        <label for="numero">Contrato:</label>
                        <input type="text" class="form-control" title="Digite o numero da Contrato" placeholder="Contrato" id="contrato" name="contrato" value="<?php echo $Sessao::retornaValorFormulario('contrato'); ?>">
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group"><label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="">Selecione o Status</option>
                            <option value="Pendente">Pendente</option>
                                <option value="Lancado">Lancado</option>
                                <option value="Vencido">Vencido</option>
                        </select>
                            <span class="form-text text-muted">Por favor insira o Status</span>
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
                                        <a href="http://<?php echo APP_HOST; ?>/contrato/excel" class="kt-nav__link">
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
                                        <a href="http://<?php echo APP_HOST; ?>/contrato/pdf" target="_blank" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="kt-nav__link-text">PDF</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        &nbsp;
                        <a href="http://<?php echo APP_HOST; ?>/contrato/cadastro" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
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
                   <th class="text-center">CÓDIGO</th>
                    <th class="text-center">CLIENTE</th>
                    <th class="text-center">TIPO</th>
                    <th class="text-center">NUMERO</th>
                    <th class="text-center">EMPRESA</th>
                    <th class="text-center">VENCIMENTO</th>
                    <th class="text-center">VALOR</th>
                    <th class="text-center">USUARIO</th>
                    <th class="text-center">ENTREGA</th>
                    <th class="text-center">PAGTO</th>
                    <th class="text-center">STATUS</th>
                    <th class="text-center">EDITAL</th>
                    <th class="text-center">ACOES</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-center">CÓDIGO</th>
                    <th class="text-center">CLIENTE</th>
                    <th class="text-center">TIPO</th>
                    <th class="text-center">NUMERO</th>
                    <th class="text-center">EMPRESA</th>
                    <th class="text-center">VENCIMENTO</th>
                    <th class="text-center">VALOR</th>
                    <th class="text-center">USUARIO</th>
                    <th class="text-center">ENTREGA</th>
                    <th class="text-center">PAGTO</th>
                    <th class="text-center">STATUS</th>
                    <th class="text-center">EDITAL</th>
                    <th class="text-center">ACOES</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $dados = $viewVar['listaContratos'];
                   
                    if (!empty($dados)) {            
                        foreach ($dados as $contrato) {
                            ?>
                            <tr>
                                <td><?php echo $contrato->getCtrId(); ?></td>
                                <td><?php echo $contrato->getEdital()->getClienteLicitacao()->getRazaoSocial(); ?></td>
                                <td><?php echo $contrato->getEdital()->getClienteLicitacao()->getTipoCliente(); ?></td>
                                <td><?php echo $contrato->getCtrNumero(); ?></td>
                                <td><?php echo $contrato->getInstituicao()->getInst_NomeFantasia(); ?></td>
                                <td><?php echo $contrato->getCtrDataVencimento()->format('d/m/Y'); ?></td>
                                <td><?php echo $contrato->getCtrValor(); ?></td>
                                <td><?php echo $contrato->getUsuario()->getApelido(); ?></td>
                                <td><?php echo $contrato->getCtrPrazoEntrega(); ?></td>
                                <td><?php echo $contrato->getCtrPrazoPagamento(); ?></td>
                                <td>
                                    <?php 
                                        if ($contrato->getCtrStatus() == "Lancado") {
                                            echo "<span class='badge badge-pill badge-success'>". $contrato->getCtrStatus() ."</span>";                                                      
                                        } else if($contrato->getCtrStatus() == "Pendente"){
                                                echo "<span class='badge badge-pill badge-danger'>". $contrato->getCtrStatus() ."</span>";
                                        }else {                                                        
                                            echo "<span class='badge badge-pill badge-danger'>". $contrato->getCtrStatus() ."</span>";   
                                        }
                                    ?>
                                </td>
                                <td><?php echo $contrato->getEdital()->getEdtNumero(); ?></td>
                                <td>
                                     <div class="dropdown d-block d-md">
                                       <button class="btn btn-primary dropdown-toggle btn-elevate btn-pill btn-elevate-air btn-sm"
                                            type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Ações
                                        </button>
                                    <div class="dropdown-menu dropdown-menu-right " aria-labelledby="acoesListar">
                                            <a href="http://<?php echo APP_HOST; ?>/contrato/cadastro/<?php echo $contrato->getEdital()->getEdtId(); ?>" title="Editar" 
                                            class="dropdown-item btn btn-outline-warning  btn-elevate btn-pill btn-elevate-air btn-sm"><i class="la la-edit"></i>Editar</a>
                                            <a href="http://<?php echo APP_HOST; ?>/contrato/exclusao/<?php echo $contrato->getCtrId(); ?>" title="Excluir" 
                                            class="dropdown-item btn btn-outline-danger btn-elevate btn-pill btn-elevate-air btn-sm"><i class="la la-trash"></i>Excluir</a>
                                            <a href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/<?php echo $contrato->getCtrAnexo(); ?>" target="_blank" title="Visualizar Anexo" 
                                            class="dropdown-item btn btn-outline-dark btn-elevate btn-pill btn-elevate-air btn-sm"><i class="la la-chain"></i> Anexo</a>
                                            <a href="#" title="Relatorios" 
                                            class="dropdown-item btn btn-outline-info btn-elevate btn-pill btn-elevate-air btn-sm"><i class="la la-print"></i>Imprimir </a>
                                            <a href="#" title="Visualizar" 
                                            class="dropdown-item btn btn-outline-success btn-elevate btn-pill btn-elevate-air btn-sm"><i class="la la-list"></i>Visualizar </a>
                                        </div>
                                    </div>
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