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
        <!--begin::portlet__head-->
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
                        <a class="nav-link " data-toggle="tab" href="#kt_builder_pedidos" role="tab">
                            Pedidos ERP
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--end::portlet__head-->

        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/pedido/atualizar"
            method="post" id="form_cadastro" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="codControle" id="codControle"
                value="<?php echo $viewVar['pedido']->getCodControle(); ?>" required>
            <input type="hidden" class="form-control" name="dataCadastro" id="dataCadastro"
                value="<?php echo $viewVar['pedido']->getDataCadastro()->format('d/m/Y H:m:s'); ?>" required>
            <input type="hidden" class="form-control" name="usuario" id="usuario" value="<?php echo $_SESSION['id']; ?>"
                required>
            <input type="hidden" class="form-control" name="fk_instituicao" id="fk_instituicao"
                value="<?php echo $_SESSION['inst_id']; ?>" required>
            <input type="hidden" class="form-control" name="dataAlteracao" id="dataAlteracao" readonly="readonly"
                value="<?php echo $dataAtual; ?>" required>
            <div class="kt-portlet__body">
                <!--begin::tab-content-->
                <div class="form-group">
                    <label for="cadastroCliente" class="">CADASTRO DO CLIENTE</label>
                    <a href="http://<?php echo APP_HOST; ?>/clientelicitacao/cadastro" id="cadastroCliente"
                        name="cadastroCliente" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                        <i class="la la-plus"></i>Novo Cliente</a>
                    <div>
                        <input type="text" name="clienteLicitacaoAutocomplete" id="clienteLicitacao-autocomplete"
                            class="form-control" required placeholder="Cliente - autocomplete"
                            value="<?php echo $viewVar['pedido']->getClienteLicitacao()->getRazaoSocial(); ?>">

                        <input type="hidden" id="cliente" name="cliente"
                            value="<?php echo $viewVar['pedido']->getClienteLicitacao()->getCodCliente(); ?>">
                    </div>
                    <span class="form-text text-muted">Por favor insira o cliente do Pedido</span>
                </div>
                <div class="tab-content">
                    <div class="tab-pane  active" id="kt_builder_principal">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label>Numero da Licitacao:</label>
                                    <input type="text" class="form-control" placeholder="Digite numero da licitacao"
                                        id="numeroPregao" name="numeroPregao"
                                        value="<?php echo $viewVar['pedido']->getNumeroLicitacao(); ?>" required>
                                    <span class="form-text text-muted">Digite o numero da licitacao</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Numero a AFM:</label>
                                    <input type="text" class="form-control" placeholder="Digite o numero a AFM"
                                        id="numeroAf" name="numeroAf"
                                        value="<?php echo $viewVar['pedido']->getNumeroAf(); ?>" required>
                                    <span class="form-text text-muted">Digite o numero a AFM</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Valor do pedido:</label>
                                    <input type="text" class="form-control" placeholder="Digite o valor do pedido"
                                        id="valorPedido" name="valorPedido"
                                        value="<?php echo $viewVar['pedido']->getValorPedido(); ?>" required>
                                    <span class="form-text text-muted">Digite o valor do pedido</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <div class="form-group"><label for="representante">Representante</label>
                                        <select class="form-control" name="representante" required>
                                            <option value="">Selecione o Representante</option>
                                            <?php foreach ($viewVar['listaRepresentantes'] as $representante) : ?>
                                            <option value="<?php echo $representante->getCodRepresentante(); ?>"
                                                <?php echo ($viewVar['pedido']->getRepresentante()->getCodRepresentante() == $representante->getCodRepresentante()) ? "selected" : ""; ?>>
                                                <?php echo $representante->getNomeRepresentante(); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class="form-text text-muted">Por favor insira o Representante do
                                            Pedido</span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group"><label for="codStatus">Status</label>
                                        <select class="form-control" id="codStatus" name="codStatus" required>
                                            <option value="">Selecione o status</option>
                                            <?php foreach ($viewVar['listaStatus'] as $status) : ?>
                                            <option value="<?php echo $status->getCodStatus(); ?>"
                                                <?php echo ($viewVar['pedido']->getStatus()->getCodStatus() == $status->getCodStatus()) ? "selected" : ""; ?>>
                                                <?php echo $status->getNome(); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class="form-text text-muted">Por favor insira o Status do Pedido</span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label for="codInstituicao">Empresa</label>
                                    <select class="form-control" id="codInstituicao" name="codInstituicao" required>
                                        <option value="">Selecione o Empresa</option>
                                        <?php foreach ($viewVar['listarInstituicoes'] as $instituicao) : ?>
                                        <option value="<?php echo $instituicao->getInst_id(); ?>"
                                            <?php echo ($viewVar['pedido']->getInstituicao()->getInst_id() == $instituicao->getInst_id()) ? "selected" : ""; ?>>
                                            <?php echo $instituicao->getInst_NomeFantasia(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="form-text text-muted">Por favor insira o Empresa</span>
                                </div>
                                <div class="col-lg-3">
                                    <label class="">Anexo:</label>
                                    <input class="form-control" type="file" name="anexo" id="anexo"
                                        value="<?php echo  $viewVar['pedido']->getAnexo(); ?>">
                                    <input type="hidden" class="form-control" id="anexoAlt" readonly="readonly"
                                        name="anexoAlt" value="<?php echo $viewVar['pedido']->getAnexo(); ?>">
                                    <a class="dropdown-item"
                                        href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/<?php echo $viewVar['pedido']->getAnexo(); ?>"
                                        target="_blank" title="Click para Visualizar Anexo"
                                        class="btn btn-info btn-sm"><i class="la la-chain"></i> Anexo</a>
                                    <!--span class="form-text text-muted">Selecione o arquivo</span-->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="">Observacao do Pedido:</label>
                                <textarea class="form-control" rows="3" placeholder="Digite Observacao do Pedido"
                                    id="observacao"
                                    name="observacao"><?php echo $viewVar['pedido']->getObservacao(); ?></textarea>
                                <span class="form-text text-muted">Digite Observacao do Pedido</span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="kt_builder_pedidos">
                        <input type="hidden" class="form-control" name="codControle1" id="codControle"
                            value="<?php echo $viewVar['pedido']->getCodControle(); ?>" required>
                        <input type="hidden" class="form-control" name="perpid" id="perpid">
                        <input type="hidden" class="form-control" name="usuario" id="usuario"
                            value="<?php echo $_SESSION['id']; ?>" required>
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
                                <button type="submit"
                                    class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air form-control"
                                    id="btnAdicionarPedidoErp">Adicionar</button>
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
                                        <th>DATA</th>
                                        <th>USUARIO</th>
                                        <th>ACOES</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>PEDIDO</th>
                                        <th>VALOR</th>
                                        <th>DATA</th>
                                        <th>USUARIO</th>
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
                        <?php
                        $dadosErp = $viewVar['listarPedidosErp'];
                        if ($dadosErp >= 1) {
                            $soma = 0;          
                            $qtdePedido = 0;
                            foreach ($dadosErp as $dadoErp){
                                $soma = $dadoErp->getPerpValor();
                                $total += $soma;
                                $qtdePedido += 1;
                            }
                        }
                        
                            echo "<h3 class='kt-portlet__head-title'><p class='text-info'>Qtde. de Pedidos " . $qtdePedido . " e Valor Total R$" . number_format($total, 2, ',', '.') . "</p></h3>";
                        ?>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <input type="checkbox" id="enviarEmail" name="enviarEmail" value="1" checked>
                            <label>Deseja enviar Email?</label>
                            <!--input type="text" class="form-control" title="Digite o endereco de e-mail"
                            placeholder="email separado por virgula" id="email" name="email" disabled
                            value="< ?php echo $Sessao::retornaValorFormulario('eviarEmail'); ?>"-->

                            <select class="form-control m-select2" id="emails"  name="emails[]"
                                    multiple="multiple" title="Selecione um ou mais o endereco de e-mail">
                                    <optgroup for="email" label="Email">
                                        <?php foreach ($viewVar['listarUsuarios'] as $usuario) : ?>
                                        <option value="<?php echo $usuario->getEmail(); ?>"
                                            <?php echo ($Sessao::retornaValorFormulario('emails') == $usuario->getId()) ? "selected" : ""; ?>>
                                            <?php echo $usuario->getEmail(); ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                </select>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-8">
                                    <button type="submit"
                                        class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air">Salvar</button>
                                    <a href="http://<?php echo APP_HOST; ?>/pedido"
                                        class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                                </div>
                            </div>
                            <br>
                            <h5 class="" name="informacao" id="informacao">
                                <p><strong><em>Cadastrado em:
                                            <?php echo $viewVar['pedido']->getDataCadastro()->format('d/m/Y H:m:s'); ?>
                                            - Ultima Alteracao em:
                                            <?php echo $viewVar['pedido']->getDataAlteracao()->format('d/m/Y H:m:s')  ?>
                                            Por: <?php echo $viewVar['pedido']->getUsuario()->getNome() ; ?>
                                        </em></strong></p>
                            </h5>
                        </div>
                    </div>
                </div>
                <!--end::tab-content-->
            </div>
        </form>
        <br>
        <!--end::Form-->
    </div>
    <!--end::Portlet-->
</div>
<!-- end:: Content -->
</div>
<!--begin::footer -->