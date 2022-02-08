<div class="kt-content  kt-grid__item kt-grid__item--fluid " id="kt_content">
    <h2>Pedido Do ERP SCORP-I</h2>
    <div class="kt-portlet kt-portlet--mobile kt-portlet--fit">
        <form  action="http://<?php echo APP_HOST; ?>/logistica/rastreio"
            method="post" id="form_cadastro" enctype="multipart/form-data">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Pesquisa de pedidos registrados <a href="http://<?php echo APP_HOST; ?>/logistica/"
                            class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-plus"></i>Novo Cadastro</a></h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <div class="col-lg-8">
                        <label for="codCliente">Cliente</label>
                        <select class="form-control" id="codCliente" name="codCliente">
                            <option value="">Selecione o cliente</option>
                            <?php foreach ($viewVar['listarClientesLogisticaNfe'] as $cliente) : ?>
                            <option
                                value="<?php echo $cliente->getCodCliente(); ?>"
                                <?php echo ($Sessao::retornaValorFormulario('codCliente') == $cliente->getCodCliente()) ? "selected" : ""; ?>>
                                <?php echo $cliente->getRazaoSocial(); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label for="codRepresentante">Representante</label>
                        <select class="form-control" id="codRepresentante" name="codRepresentante">
                            <option value="">Selecione o Representante</option>
                            <?php foreach ($viewVar['listarRepresentantesLogisticaNfe'] as $representante) : ?>
                            <option
                                value="<?php echo $representante->getCodRepresentante(); ?>"
                                <?php echo ($Sessao::retornaValorFormulario('codRepresentante') == $representante->getCodRepresentante()) ? "selected" : ""; ?>>
                                <?php echo $representante->getNomeRepresentante(); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <span class="form-text text-muted">Por favor insira o Representante</span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="idLogistica">Codigo:</label>
                        <input type="text" class="form-control" title="Digite o codido" placeholder="codigo" id="idLogistica"
                            name="idLogistica" value="<?php echo $Sessao::retornaValorFormulario('idLogistica'); ?>">
                    </div>
                    <div class="col-lg-2">
                        <label for="notafiscal">Nota Fiscal:</label>
                        <input type="text" class="form-control" title="Digite o numero da nota fiscal"
                            placeholder="Nota Fiscal" id="notafiscal" name="notafiscal"
                            value="<?php echo $Sessao::retornaValorFormulario('notafiscal'); ?>">
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group"><label for="status">Status</label>
                            <select class="form-control m-select2" id="status2" name="codStatus[]" multiple="multiple"
                                title="Selecione um ou mais status"
                                value="<?php echo $Sessao::retornaValorFormulario('codStatus'); ?>">>
                                <optgroup for="status" label="Selecione Status">
                                    <option value="ETIQUETAGEM">ETIQUETAGEM</option>
                                    <option value="CARREGAMENTO">CARREGAMENTO</option>
                                    <option value="COLETADO">COLETADO</option>
                                    <option value="ENTREGUE">ENTREGUE</option>
                                    <option value="EXCLUIDO">EXCLUIDO</option>
                                </optgroup>
                            </select>
                            <span class="form-text text-muted">Por favor insira o Status</span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group"><label for="codTransportadora">Transportadora</label>
                            <select class="form-control" id="codTransportadora" name="codTransportadora">
                                <option value="">Selecione o Transportadora</option>
                                <?php foreach ($viewVar['listarTransportadoraLogisticaNfe'] as $transportadora) : ?>
                                <option value="<?php echo $transportadora->getTraId(); ?>"
                                    <?php echo ($Sessao::retornaValorFormulario('codTransportadora') == $transportadora->getTraId()) ? "selected" : ""; ?>>
                                    <?php echo $transportadora->getTraRazaoSocial(); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="form-text text-muted">Por favor insira a Transportadora</span>
                        </div>
                    </div>                   
                </div>
                <button type="submit" class="btn btn-primary btn-elevate btn-pill btn-elevate-air">Pesquisar</button>
            </div>
        </form>

        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_3">

                <thead class="thead-light">
                    <tr>
                        <th>CODIGO</th>
                        <th>CLIENTE</th>
                        <th>AFM</th>
                        <th>TRANSPORTADORA</th>
                        <th>NFE</th>
                        <th>VALOR</th>
                        <th>STATUS</th>
                        <th>REPRESENTANTE</th>
                        <th>OPERADOR</th>
                        <th>DATA</th>
                        <th>ACOES</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="thead-light">
                        <th>CODIGO</th>
                        <th>CLIENTE</th>
                        <th>AFM</th>
                        <th>TRANSPORTADORA</th>
                        <th>NFE</th>
                        <th>VALOR</th>
                        <th>STATUS</th>
                        <th>REPRESENTANTE</th>
                        <th>OPERADOR</th>
                        <th>DATA</th>
                        <th>ACOES</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
            $logisticas = $viewVar['listarLogisticaNfe'];
            /** @var TYPE_NAME $logisticas */
            foreach ($logisticas as $logistica){
            ?>
                    <tr>
                        <td><?php echo $logistica->getLgtId(); ?></td>
                        <td><?php echo $logistica->getFk_Pedido()->getClienteLicitacao()->getRazaoSocial(); ?></td>
                        <td><?php echo $logistica->getFk_Pedido()->getNumeroAF(); ?></td>
                        <td><?php echo $logistica->getFk_Transportadora()->GetTraNomeFantasia(); ?></td>
                        <td><?php echo $logistica->getLgtNfe(); ?></td>
                        <td>R$<?php
                        if($logistica->getLgtValorCorrigido() == '0,00'){
                            echo $logistica->getFk_Pedido()->getPerpValor(); 
                        }else{
                            echo $logistica->getLgtValorCorrigido();
                        }   
                        ?></td>
                        <td class="text-center">
                            <?php 
                                if ($logistica->getFk_StatusLogistica() == "COLETADO") {
                                    echo "<span class='badge badge-pill badge-warning'>". $logistica->getFk_StatusLogistica() ."</span>";                                                      
                                } else if($logistica->getFk_StatusLogistica() == "EXCLUIDO"){
                                        echo "<span class='badge badge-pill badge-danger'>". $logistica->getFk_StatusLogistica() ."</span>";
                                }else if($logistica->getFk_StatusLogistica() == "CARREGAMENTO"){
                                    echo "<span class='badge badge-pill badge-info'>". $logistica->getFk_StatusLogistica() ."</span>";
                                }else if($logistica->getFk_StatusLogistica() == "ENTREGUE"){                                                      
                                    echo "<span class='badge badge-pill badge-success'>". $logistica->getFk_StatusLogistica() ."</span>";   
                                }else{
                                    echo "<span class='badge badge-pill badge-dark'>". $logistica->getFk_StatusLogistica() ."</span>";   
                                }
                            ?>
                        </td>
                        <td><?php echo $logistica->getFk_Pedido()->getRepresentante()->getNomeRepresentante(); ?></td>
                        <td><?php echo $logistica->getFk_Operador()->getApelido();?></td>
                        <td><?php echo $logistica->getLgtDataAlteracao()->format('d/m/Y H:i:s');?></td>
                        <td><span class="kt-pulse__ring"><a href="" data-toggle="modal"
                                    data-target="#modal_logistica"><button type="button" id="btnModalLogisticaAlterar"
                                        data-valor="<?php echo $logistica->getFk_Pedido()->getPerpValor(); ?>"
                                        data-codigo="<?php echo $logistica->getLgtId(); ?>"
                                        data-rota="<?php echo $logistica->getLgtRota(); ?>"
                                        data-infovalorcorrigido="<?php echo $logistica->getLgtInfoValorCorrigido(); ?>"
                                        data-nfe="<?php echo $logistica->getLgtNfe(); ?>"
                                        data-anexo="<?php echo $logistica->getLgtAnexo(); ?>"
                                        data-status="<?php echo $logistica->getFk_StatusLogistica(); ?>"
                                        data-valorfrete="<?php echo $logistica->getLgtValorFrete(); ?>"
                                        data-pedidoerp="<?php echo $logistica->getFk_Pedido()->getPerpId(); ?>"
                                        data-numero="<?php echo $logistica->getFk_Pedido()->getPerpNumero(); ?>"
                                        data-trarazaosocial="<?php echo $logistica->getFk_Transportadora()->getTraRazaoSocial(); ?>"
                                        data-traid="<?php echo $logistica->getFk_Transportadora()->GetTraId(); ?>"
                                        data-nomecliente="<?php echo $logistica->getFk_Pedido()->getClienteLicitacao()->getRazaoSocial();?> "
                                        data-codcliente="<?php echo $logistica->getFk_Pedido()->getClienteLicitacao()->getCodCliente();?> "
                                        class=" btn btn-elevate btn-warning btn-icon"><i
                                            class="fa fa-truck"></i></button></a></span>

                            <span class="kt-pulse__ring"><a href="" data-toggle="modal"
                                    data-target="#modal_logistica"><button type="button" id="btnModalLogisticaExcluir"
                                        data-valor="<?php echo $logistica->getFk_Pedido()->getPerpValor(); ?>"
                                        data-codigo="<?php echo $logistica->getLgtId(); ?>"
                                        data-rota="<?php echo $logistica->getLgtRota(); ?>"
                                        data-infoexcluir="<?php echo $logistica->getLgtInfoExcluir(); ?>"
                                        data-nfe="<?php echo $logistica->getLgtNfe(); ?>"
                                        data-anexo="<?php echo $logistica->getLgtAnexo(); ?>"
                                        data-status="<?php echo $logistica->getFk_StatusLogistica(); ?>"
                                        data-pedidoerp="<?php echo $logistica->getFk_Pedido()->getPerpId(); ?>"
                                        data-numero="<?php echo $logistica->getFk_Pedido()->getPerpNumero(); ?>"
                                        data-trarazaosocial="<?php echo $logistica->getFk_Transportadora()->GetTraRazaoSocial(); ?>"
                                        data-traid="<?php echo $logistica->getFk_Transportadora()->GetTraId(); ?>"
                                        data-nomecliente="<?php echo $logistica->getFk_Pedido()->getClienteLicitacao()->getRazaoSocial();?> "
                                        data-codcliente="<?php echo $logistica->getFk_Pedido()->getClienteLicitacao()->getCodCliente();?> "
                                        class=" btn btn-elevate btn-danger btn-icon"><i
                                            class="fa fa-trash"></i></button></a></span>
                        </td>
                        <?php
                }                
                ?>
                    </tr>
                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>
</div>
</div>
<?php
include_once "modallogistica.php";
?>