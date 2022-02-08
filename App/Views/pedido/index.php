<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <div class="kt-portlet kt-portlet--mobile">
        <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/pedido/" method="post"
            id="form_cadastro" enctype="multipart/form-data">
            <h3 class="kt-portlet__head-title">
                Pesquisa de pedidos registrados
            </h3>
           <div class="kt-portlet__body">
                <div class="form-group row">
                <div class="col-lg-8">
                    <label for="codCliente">Cliente</label> 
                        <input type="text" name="clienteLicitacaoAutocomplete" id="clienteLicitacao-autocomplete"
                            class="form-control" placeholder="Cliente - autocomplete" >
                        <input type="hidden" id="cliente" name="cliente">
                </div>
                <!-- <div class="col-lg-4">
                    <label for="cliente">Cliente</label>
                    <select class="form-control" name="cliente">
                        <option value="">Selecione o cliente</option>
                        < ?php foreach ($viewVar['listaClientesPedido'] as $cliente) : ?>
                        <option value="< ?php echo $cliente->getCodCliente(); ?>"
                            < ?php echo ($Sessao::retornaValorFormulario('cliente') == $cliente->getCodCliente()) ? "selected" : ""; ?>>
                            < ?php echo $cliente->getRazaoSocial(); ?></option>
                        < ?php endforeach; ?>
                    </select>
                </div> -->
                    <div class="col-lg-4">
                            <label for="nomeFantasiaPesq">Nome Fantasia:</label>
                            <input type="text" class="form-control" title="Digite o codido do pedido" placeholder="Nome Fantasia"
                                id="nomeFantasiaPesq" name="nomeFantasiaPesq"
                                value="<?php echo $Sessao::retornaValorFormulario('nomeFantasiaPesq'); ?>">
                        </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-1">
                        <label>Pedido:</label>
                        <input type="text" class="form-control" title="Digite o codido do pedido" placeholder="codigo"
                            id="codControle" name="codControle"
                            value="<?php echo $Sessao::retornaValorFormulario('codControle'); ?>">
                    </div>
                    <div class="col-lg-1">
                        <label>AFM:</label>
                        <input type="text" class="form-control" title="Digite o numero o pedido" placeholder="pedido"
                            id="numeroAf" name="numeroAf"
                            value="<?php echo $Sessao::retornaValorFormulario('codControle'); ?>">
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group"><label for="status">Status</label>
                            <select class="form-control" name="status" title="Selecione o status do pedido">
                                <option value="">Selecione o status</option>
                                <?php foreach ($viewVar['listaStatus'] as $status) : ?>
                                <option value="<?php echo $status->getCodStatus(); ?>"
                                    <?php echo ($Sessao::retornaValorFormulario('codStatus') == $status->getCodStatus()) ? "selected" : ""; ?>>
                                    <?php echo $status->getNome(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group"><label for="representante">Representante</label>
                            <select class="form-control" name="representante">
                                <option value="">Representante</option>
                                <?php foreach ($viewVar['listarRepresentantes'] as $representante) : ?>
                                <option value="<?php echo $representante->getCodRepresentante(); ?>"
                                    <?php echo ($Sessao::retornaValorFormulario('representante') == $representante->getCodRepresentante()) ? "selected" : ""; ?>>
                                    <?php echo $representante->getNomeRepresentante(); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="form-text text-muted">Por favor insira o Representante do Pedido</span>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <div class="form-group"><label for="tipo">Tipo Cliente</label>
                                <select class="form-control m-select2" id="kt_select2_3" name="tipo[]"
                                    multiple="multiple">
                                    <optgroup for="tipo" label="Tipo Cliente">
                                        <?php foreach ($viewVar['listaTipoClientes'] as $cliente) : ?>
                                        <option value="<?php echo $cliente->getTpcDescricao(); ?>"
                                            <?php echo ($Sessao::retornaValorFormulario('tipo') == $cliente->getTpcId()) ? "selected" : ""; ?>>
                                            <?php echo $cliente->getTpcDescricao(); ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                </select>
                                <span class="form-text text-muted">Por favor insira o tipo do cliente</span>
                            </div>
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
                                        <a href="http://<?php echo APP_HOST; ?>/pedido/excel" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                            <span class="kt-nav__link-text">Excel</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="http://<?php echo APP_HOST; ?>/pedido/excel" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">CSV</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="http://<?php echo APP_HOST; ?>/pedido/pdf" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="kt-nav__link-text">PDF</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        &nbsp;
                        <a href="http://<?php echo APP_HOST; ?>/pedido/cadastro"
                            class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-plus"></i>Novo pedido</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_3">
                <thead>
                    <tr>
                        <th colspan="3">Dados Cliente</th>
                        <th colspan="3">Dados do pedido</th>
                        <th colspan="3">Status</th>
                    </tr>
                    <tr>
                        <th>CÓDIGO</th>
                        <th>Nome</th>
                        <th>TIPO</th>
                        <th>VALOR</th>
                        <th>AFM</th>
                        <th>LICITACAO</th>
                        <th>USUARIO</th>
                        <th>STATUS</th>
                        <th>DATA</th>
                        <th>Acoes</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>CÓDIGO</th>
                        <th>Nome</th>
                        <th>TIPO</th>
                        <th>VALOR</th>
                        <th>AFM</th>
                        <th>LICITACAO</th>
                        <th>USUARIO</th>
                        <th>STATUS</th>
                        <th>DATA</th>
                        <th>Acoes</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
					 $pedido1 = $viewVar['listarPedidos'];
                   
					 $andre = $pedido1 > 0;
					 $soma = 0;
					 if ($pedido1 > 0) {
						 foreach ($pedido1 as $pedido) {
							 $soma = $pedido->getSomaPedido();
							 $total += $soma;
							 $qtdePedido += 1;
						?>
                    <tr>
                        <td><?php echo $pedido->getCodControle(); ?></td>
                        <td><?php echo $pedido->getClienteLicitacao()->getRazaoSocial(); ?></td>
                        <td><?php echo $pedido->getClienteLicitacao()->getTipoCliente(); ?></td>
                        <td>R$<?php echo $pedido->getValorPedido(); ?></td>
                        <td><?php echo $pedido->getNumeroAf(); ?></td>
                        <td><?php echo $pedido->getNumeroLicitacao(); ?></td>
                        <td><?php echo $pedido->getUsuario()->getApelido(); ?></td>
                        <td><?php echo $pedido->getStatus()->getNome(); ?></td>
                        <td><?php echo $pedido->getDataAlteracao()->format('d/m/Y H:i:s'); ?></td>
                        <td class="text-center">                                                    
                            <div class="dropdown  d-block d-md">
                                    <button class="btn btn-primary dropdown-toggle btn-elevate btn-pill btn-elevate-air btn-sm"
                                        type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Ações
                                    </button>
                                <div class="dropdown-menu dropdown-menu-right " aria-labelledby="acoesListar">
                                    <a type="button" id="btnEdtiarPedido"
                                        href="http://<?php echo APP_HOST; ?>/pedido/edicao/<?php echo $pedido->getCodControle(); ?>"
                                        title="Alterar pedido" class="dropdown-item btn btn-outline-warning btn-elevate btn-pill btn-elevate-air btn-sm"><i class="la la-edit"></i>  Editar</a>
                                    <a href="http://<?php echo APP_HOST; ?>/pedido/exclusao/<?php echo $pedido->getCodControle(); ?>"
                                        title="Excluir" class="dropdown-item btn btn-outline-danger btn-elevate btn-pill btn-elevate-air btn-sm"><i class="la la-trash"></i>  Excluir</a>
                                    <a href="http://<?php echo APP_HOST; ?>/pedido/visualisar/<?php echo $pedido->getCodControle(); ?>"
                                        title="Visualisar" class="dropdown-item btn btn-outline-success btn-elevate btn-pill btn-elevate-air btn-sm"><i class="la la-list"></i>   Visualisar</a>
                                    <a href="http://<?php echo APP_HOST; ?>/pedido/edicao/<?php echo $pedido->getCodControle(); ?>"
                                        title="Alterar Status" class="dropdown-item btn btn-outline-info btn-elevate btn-pill btn-elevate-air btn-sm"><i class="la la-list"></i>  Status</a>
                                    <a href="http://<?php echo APP_HOST; ?>/pedido/edicao/<?php echo $pedido->getCodControle(); ?>"
                                        title="Relatorios" class="dropdown-item btn btn-outline-info btn-elevate btn-pill btn-elevate-air btn-sm"><i class="la la-print"></i>  Relatorio</a>
                                    <a href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/<?php echo $pedido->getAnexo(); ?>"
                                        target="_blank" title="Visualizar Anexo" class="dropdown-item btn btn-outline-dark btn-elevate btn-pill btn-elevate-air btn-sm"><i class="la la-chain"></i> Anexo</a>
                                </div>
                            </div>
                        </td>
                        <?php
						}
					} else {

						echo "<h3 class='kt-portlet__head-title'><p class='text-danger'>Sem Pedidos encontrados!</p></h3>";
					}
					?>

                    </tr>
                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>
    <?php	

    echo "<h3 class='kt-portlet__head-title'><p class='text-info'>Qtde. de Pedidos " . $qtdePedido . " e Valor Total R$" . number_format($total, 2, ',', '.') . "</p></h3>";
    ?>
</div>
<!-- end:: Content -->
</div>