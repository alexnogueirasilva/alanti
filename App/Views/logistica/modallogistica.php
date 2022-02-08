<!--begin::Modal-->
<div class="modal fade" id="modal_logistica" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">LOGISTICA - <span style="color:red" id="nomeCliente"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>
            <div class="kt-portlet kt-portlet--tabs">

                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-left nav-tabs-line-primary"
                            role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_builder_principal" role="tab">
                                    Principal
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--begin::Form-->

                <form id="frmModalLogistica" class="kt-form kt-form--label-right">
                    <div class="modal-body">
                        <div class="kt-portlet__body">
                            <div class="tab-content">
                                <input type="hidden" id="codigo" name="codigo">
                                <input type="hidden" id="pedidoerp" name="pedidoerp">
                                <input type="hidden" id="acao" name="acao" >
                                <div class="tab-pane active" id="kt_builder_principal">
                                    <div class="form-group">
                                        <label for="cadastroTransportadora" class="">TRANSPORTADORA</label>
                                        <a href="http://<?php echo APP_HOST; ?>/transportadora/cadastro"
                                            id="cadastroTransportadora" name="cadastroTransportadora" target="_blank"
                                            class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                                            <i class="la la-plus"></i>Nova Transportadora</a>
                                        <div>
                                            <input type="text" name="transportadora-autocomplete"
                                                id="transportadora-autocomplete" class="autocomplete-logistica" required
                                                placeholder="transportadora">
                                            <input type="hidden" id="transportadora" name="transportadora">
                                        </div>
                                        <span class="form-text text-muted">Por favor insira</span>

                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label for="nfe">NF-e:</label>
                                                <input type="text" id="nfe" name="nfe" class="form-control"
                                                    placeholder="Nota fiscal">
                                                <span class="form-text text-muted">Favor informar NF-e</span>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group"><label for="status">Status</label>
                                                    <select class="form-control" name="status" id="status"
                                                        value="<?php echo $Sessao::retornaValorFormulario('status'); ?>" required >
                                                        <option value="">Selecione o Status</option>
                                                        <option value="ETIQUETAGEM">ETIQUETAGEM</option>
                                                        <option value="CARREGAMENTO">CARREGAMENTO</option>
                                                        <option value="COLETADO">COLETADO</option>
                                                        <option value="ENTREGUE">ENTREGUE</option>
                                                    </select>
                                                    <span class="form-text text-muted">Por favor insira o Status</span>
                                                </div>                                                
                                            </div>
                                            <div class="col-lg-3">
                                                <input type="checkbox" title="marque para informar o valor corrigido"
                                                    id="infoValorCorrigido" name="infoValorCorrigido" value="1">
                                                <label style="color:red" class="" for="valorcorrigido">Valor Pedido:
                                                    R$<label id="valor" name="valor" disabled></label></label>
                                                <input type="text" title="informar corrigido" id="valorcorrigido"
                                                    name="valorcorrigido" class="form-control"
                                                    placeholder="Entre com o valor" disabled>
                                                <span class="form-text text-muted">Favor informar valor corrigido</span>
                                            </div>
                                             <div class="col-lg-3">                                                
                                                <label class="" for="valorFrete">Valor Frete</label>
                                                <input type="text" title="informar valor do frete" id="valorFrete"
                                                    name="valorFrete" class="form-control"
                                                    placeholder="Valor do frete">
                                                <span class="form-text text-muted">Favor informar valor do frete</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label for="rota">Rota:</label>
                                                <input type="text" id="rota" name="rota" class="form-control"
                                                    placeholder="Entre com a rota">
                                                <span class="form-text text-muted">Favor informar rota</span>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="anexoLogistica" class="">Anexo:</label>
                                                <input type="file" name="anexoLogistica" id="anexoLogistica"
                                                    class="form-control"
                                                    value="<?php echo $Sessao::retornaValorFormulario('anexoLogistica'); ?>">
                                                <input type="hidden" class="form-control" id="anexoLogisticaAlt"
                                                    readonly="readonly" name="anexoLogisticaAlt">
                                                <a class="dropdown-item" id="verAnexo" name="verAnexo" target="_blank"
                                                    title="Click para Visualizar Anexo" class="btn btn-info btn-sm"><i
                                                        class="la la-chain"></i> Anexo</a>
                                                <span class="form-text text-muted">Selecione o arquivo</span>
                                            </div>
                                        </div>
                                        <div class="form-group row" >
                                            <div class="col-lg-6" id="justificativaPreco">
                                            </div>
                                            <div class="col-lg-6" id="justificativaExcluir">
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
                                            <button type="Submit" id="salvarLogistica"
                                                class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air">Salvar</button>
                                            <button type="button" id="limparLogistica" data-dismiss="modal"
                                                class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
            <!--end::Modal-->
        </div>
    </div>

</div>
</div>