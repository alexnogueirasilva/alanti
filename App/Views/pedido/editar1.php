<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h1 class="kt-portlet__head-title">
                    ALTERACAO DE PEDIDO
                </h1>
            </div>
        </div>
        <center>
            <h3>Alteracao de pedido</h3>
        </center>
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
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">                
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-left nav-tabs-line-primary"
                    role="tablist">
                    
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_builder_pedidos3" role="tab">
                            Pedidos3
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#kt_builder_pedidos4" role="tab">
                            Pedidos4
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#kt_builder_pedidos5" role="tab">
                            Pedidos5
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="tab-content">
               
                <div class="tab-pane  active" id="kt_builder_pedidos3">
                    <div class="kt-portlet__body">
                        <h1> pedido 3</h1>
                            <form>
                                </form>
                                  
                        </div>
                    </div>                                   
                    <div class="tab-pane  " id="kt_builder_pedidos4">
                        <div class="kt-portlet__body">
                                    <h1> pedido 4</h1>

                                </div>
                            </div>
                            <div class="tab-pane " id="kt_builder_pedidos5">
                                <div class="kt-portlet__body">
                                <h1> pedido 5 </h1>
                                    <form class="kt-form kt-form--label-right" method="post" id="frmAdicionarPedido" >
                                        <input type="hidden" class="form-control" name="codControle1" id="codControle"
                                            value="<?php ?>" required>
                                            <input type="hidden" class="form-control" name="usuario" id="usuario" value="<?php echo $_SESSION['id']; ?>"
                                                required>
                                            <div class="kt-portlet__body">
                                                        <div class="form-group row">
                                                            <div class="col-lg-4">
                                                                <label for="numeroPedidoErp">Numero do Pedido</label>
                                                                <input type="text" class="form-control" placeholder="Informe o numero do pedido"
                                                                    id="numeroPedidoErp" name="numeroPedidoErp"
                                                                    value="<?php $Sessao::retornaValorFormulario('numeroPedidoErp');?>">
                                                                <span class="form-text text-muted">Informe numero do pedido</span>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label for="valorPedidoErp" class="">Valor:</label>
                                                                <input type="text" class="form-control" placeholder="Informe o valor"
                                                                    id="valorPedidoErp" name="valorPedidoErp"
                                                                    value="<?php echo $Sessao::retornaValorFormulario('valorPedidoErp'); ?>">
                                                                <span class="form-text text-muted">Informe o valor</span>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <label for="btnAdicionarPedido" class="">Adicionar Pedidos:</label>
                                                                <button  type="submit" class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air form-control"
                                                                    id="btnAdicionarPedidoteste">Adicionar</button>
                                                            </div>
                                                        </div>
                                                
                                                
                                                    <div class="kt-portlet__body">
                                                        <!--begin: Datatable -->
                                                        <table class="table table-striped- table-bordered table-hover table-checkable"
                                                            id="kt_table_3">
                                                            <thead>
                                                                <tr>
                                                                    <th>PEDIDO</th>
                                                                    <th>VALOR</th>
                                                                    <th>USUARIO</th>
                                                                    <th>DATA</th>
                                                                    <th>ACOES</th>
                                                                </tr>
                                                            </thead>
                                                            <tfoot>
                                                                <tr>
                                                                <th>PEDIDO</th>
                                                                    <th>VALOR</th>
                                                                    <th>USUARIO</th>
                                                                    <th>DATA</th>
                                                                    <th>ACOES</th>
                                                                </tr>
                                                            </tfoot>
                                                            <tbody id="adicionarPedidoErp">
                                                                <tr>
                                                                    <!-- <td><input type="hidden" value="" name="pedidos[]"></td> -->
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--end: Datatable -->
                                                    </div>                      
                                            </div>
                                    </form>                                    
                                </div>
                            </div>
            </div>
        </div>
        <!--begin::Form-->
        
        <br>
        <!--end::Form-->
    </div>
    <!--end::Portlet-->

</div>
<!-- end:: Content -->

<!-- footer -->

</div>