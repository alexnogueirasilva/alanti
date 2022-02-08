<div class="kt-content  kt-grid__item kt-grid__item--fluid " id="kt_content" >
    <h1>Pedido Do ERP SCORP-I </h1>
    <div class="kt-portlet kt-portlet--mobile kt-portlet--fit">
    <form id="frmLogisticaPesq" action="http://<?php echo APP_HOST; ?>/logistica/"
            method="post" id="form_cadastro" enctype="multipart/form-data">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Pesquisa de pedidos registrados <a href="http://<?php echo APP_HOST; ?>/logistica/rastreio"
                            class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-edit"></i> Rastreio</a></h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label for="codCliente">Cliente</label>
                        <select class="form-control" id="codCliente" name="codCliente">
                            <option value="">Selecione o cliente</option>
                            <?php foreach ($viewVar['listarClientesPedidoErp'] as $cliente) : ?>
                            <option
                                value="<?php echo $cliente->getCodCliente(); ?>"
                                <?php echo ($Sessao::retornaValorFormulario('codCliente') == $cliente->getCodCliente()) ? "selected" : ""; ?>>
                                <?php echo $cliente->getRazaoSocial(); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3">
                        <label for="codigoErp">Pedido Erp:</label>
                        <input type="text" class="form-control" title="Digite o pedidoERP" placeholder="pedidoERPp" id="codigoErp"
                            name="codigoErp" value="<?php echo $Sessao::retornaValorFormulario('codigoErp'); ?>">
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group"><label for="status">Status</label>
                            <select class="form-control m-select2" id="status2" name="codStatus[]" multiple="multiple"
                                title="Selecione um ou mais status"
                                value="<?php echo $Sessao::retornaValorFormulario('codStatus'); ?>">>
                                <optgroup for="status" label="Selecione Status">
                                <?php foreach ($viewVar['listarStatusPedidoErp'] as $statusPedido) : ?><option
                                    value="<?php echo $statusPedido->getCodStatus(); ?>"
                                    <?php echo ($Sessao::retornaValorFormulario('codStatus') == $statusPedido->getCodStatus()) ? "selected" : ""; ?>>
                                    <?php echo $statusPedido->getNome(); ?></option>
                                <?php endforeach; ?>
                                </optgroup>
                            </select>
                            <span class="form-text text-muted">Por favor insira o Status</span>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <label for="codRepresentante">Representante</label>
                        <select class="form-control" id="codRepresentante" name="codRepresentante">
                            <option value="">Selecione o Representante</option>
                            <?php foreach ($viewVar['listarRepresentantePedidoErp'] as $representante) : ?><option
                                value="<?php echo $representante->getCodRepresentante(); ?>"
                                <?php echo ($Sessao::retornaValorFormulario('codRepresentante') == $representante->getCodRepresentante()) ? "selected" : ""; ?>>
                                <?php echo $representante->getNomeRepresentante(); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <span class="form-text text-muted">Por favor insira o Representante</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-elevate btn-pill btn-elevate-air">Pesquisar</button>
            </div>
        </form>

    <div class="kt-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_3">

            <thead  class="thead-light">
            <tr>
                <th>ID SCORP</th>
                <th>CLIENTE</th>
                <th>AFM</th>
                <th>VALOR</th>
                <th>STATUS</th>
                <th>REPRESENTANTE</th>
                <th>OPERADOR</th>
                <th>ACOES</th>
            </tr>
            </thead>
            <tfoot>
            <tr  class="thead-light">
                <th>ID SCORP</th>
                <th>CLIENTE</th>
                <th>AFM</th>
                <th>VALOR</th>
                <th>STATUS</th>
                <th>REPRESENTANTE</th>
                <th>OPERADOR</th>
                <th>ACOES</th>
            </tr>
            </tfoot>
            <tbody id="tableLogisticaErp" >
            
            </tbody>
        </table>
        <!--end: Datatable -->
    </div>
    </div>
</div>
<?php
include_once "modallogistica.php";
?>