<!--begin::Portlet-->
<div class="kt-portlet kt-portlet--tabs">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">

            <h1 class="kt-portlet__head-title">
                REPRESENTANTE
            </h1>
        </div>
    </div>
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-toolbar">
            <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-left nav-tabs-line-primary"
                role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#kt_builder_principal" role="tab">
                        PRINCIPAL
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_builder_transportadora" role="tab">
                        TRANSPORTADORA
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_builder_representante" role="tab">
                        REPRESENTANTE
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" action="" method="POST">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <div class="kt-form__actions">
                    <div class="col-lg-3"></div>
                    <button type="submit" name="builder_submit" data-demo="demo1"
                        class="btn btn-outline-brand btn-elevate btn-pill btn-elevate-air">
                        <i class="la la-eye"></i>
                        Salvar
                    </button>&nbsp;
                    <button type="submit" id="builder_export" data-demo="demo1"
                        class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air">
                        <i class="la la-download"></i>
                        Export
                    </button>&nbsp;
                    <button type="submit" name="builder_reset" data-demo="demo2"
                        class="btn btn-outline-secondary btn-elevate btn-pill btn-elevate-air">
                        <i class="la la-recycle"></i>
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="tab-content">
                <div class="form-group">
                    <label for="cadastroCliente" class="">CLIENTE</label>
                    <a href="http://<?php echo APP_HOST; ?>/clientelicitacao/cadastro" id="cadastroCliente"
                        name="cadastroCliente" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                        <i class="la la-plus"></i>Novo Cliente</a>
                    <div>
                        <input type="text" name="clienteLicitacaoAutocomplete" id="clienteLicitacao-autocomplete"
                            class="form-control" required placeholder="Cliente - autocomplete"
                            value="<?php "echo $ viewVar['pedido']->getClienteLicitacao()->getRazaoSocial()"; ?>">
                        <input type="hidden" id="cliente" name="cliente"
                            value="<?php "echo $ viewVar['pedido']->getClienteLicitacao()->getCodCliente()"; ?>">
                    </div>
                    <span class="form-text text-muted">Por favor insira o cliente</span>
                </div>
                <div class="tab-pane active" id="kt_builder_principal">
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label class="" for="">Pedido ERP:</label>
                            <input type="text" id="" name="" class="form-control" placeholder="">
                            <span class="form-text text-muted">Favor informar</span>
                        </div>
                        <div class="col-lg-4">
                            <label for="inscricaoestadual">AFM:</label>
                            <input type="text" id="" name="" class="form-control" placeholder="">
                            <span class="form-text text-muted">Favor informar </span>
                        </div>
                        <div class="col-lg-4">
                            <label class="" for="">NF-e:</label>
                            <input type="text" id="" name="" class="form-control" placeholder="Entre com NF-e">
                            <span class="form-text text-muted">Favor informar </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label class="" for="">Valor:</label>
                            <input type="text" id="" name="" class="form-control" placeholder="">
                            <span class="form-text text-muted">Favor informar</span>
                        </div>
                        <div class="col-lg-4">
                            <label for="">Valor Corrigido:</label>
                            <input type="text" id="" name="" class="form-control" placeholder="">
                            <span class="form-text text-muted">Favor informar </span>
                        </div>
                        <div class="col-lg-4">
                            <div class="kt-input-icon kt-input-icon--right">
                                <label for="" class="">Status:</label>
                                <select class="form-control" id="" name="">
                                    <option value="">Selecione o Status</option>
                                    <span class="input-group-text">
                                        <i class="la la-user"></i></span>
                                    <option value="Status 1"> Status 1</option>
                                    <option value="Status 2"> Status 2</option>
                                    <option value="Status 3"> Status 3</option>
                                </select>
                            </div>
                            <span class="form-text text-muted">Favor informar Status</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <div class="kt-input-icon kt-input-icon--right">
                                <label for="" class="">Operador:</label>
                                <select class="form-control" id="" name="">
                                    <option value="">Selecione o Operador</option>
                                    <span class="input-group-text">
                                        <i class="la la-user"></i></span>
                                    <option value="Operador 1"> Operador 1</option>
                                    <option value="Operador 2"> Operador 2</option>
                                    <option value="Operador 3"> Operador 3</option>
                                </select>
                            </div>
                            <span class="form-text text-muted">Favor informar Operador</span>
                        </div>
                        <div class="col-lg-4">
                            <label class="" for="">:</label>
                            <input type="text" id="" name="" class="form-control" placeholder="Entre com ">
                            <span class="form-text text-muted">Favor informar </span>
                        </div>
                        <div class="col-lg-4">
                            <label class="" for="">:</label>
                            <div class="kt-input-icon kt-input-icon--right">
                                <input type="text" id="" name="" class="form-control" placeholder="Entre com ">
                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                            class="la la-info-circle"></i></span></span>
                            </div>
                            <span class="form-text text-muted">Favor informar </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cadastroTransportadora" class="">TRANSPORTADORA</label>
                    <a href="http://<?php echo APP_HOST; ?>/transportadora/cadastro" id="cadastroTransportadora"
                        name="cadastroTransportadora" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                        <i class="la la-plus"></i>Nova Transportadora</a>
                    <div>
                        <input type="text" name="transportadora-autocomplete" id="transportadora-autocomplete"
                            class="form-control" required placeholder="transportadora"
                            value="<?php "echo $ viewVar['pedido']->getClienteLicitacao()->getRazaoSocial()"; ?>">
                        <input type="hidden" id="transportadora" name="transportadora"
                            value="<?php "echo $ viewVar['pedido']->getClienteLicitacao()->getCodCliente()"; ?>">
                    </div>
                    <span class="form-text text-muted">Por favor insira</span>
                </div>
                <div class="tab-pane" id="kt_builder_transportadora">                   
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label for="razaosocial">Razão Social:</label>
                                <input type="text" id="razaosocial" name="razaosocial" class="form-control"
                                    placeholder="Entre com Razão Social">
                                <span class="form-text text-muted">Favor informar Razão Social</span>
                            </div>
                            <div class="col-lg-4">
                                <label for="nomefantasia">Nome Fantasia:</label>
                                <input type="text" id="nomefantasia" name="nomefantasia" class="form-control"
                                    placeholder="Entre com Nome Fantasia">
                                <span class="form-text text-muted">Favor informar Nome Fantasia</span>
                            </div>
                            <div class="col-lg-4">
                                <label for="contato">Contato:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                class="la la-user"></i></span></div>
                                    <input type="text" id="contato" name="contato" class="form-control"
                                        placeholder="Entre com contato">
                                </div>
                                <span class="form-text text-muted">Favor informar contato</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-8">
                                <label for="endereco">Endereco:</label>
                                <div class="kt-input-icon kt-input-icon--right">
                                    <input type="text" id="endereco" name="endereco" class="form-control"
                                        placeholder="Entre com endereco">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                class="la la-map-marker"></i></span></span>
                                </div>
                                <span class="form-text text-muted">Favor informar endereco</span>
                            </div>
                            <div class="col-lg-4">
                                <label for="numero">Numero:</label>
                                <div class="kt-input-icon kt-input-icon--right">
                                    <input type="number" id="numero" name="numero" class="form-control"
                                        placeholder="Entre com numero">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--right"></span>
                                </div>
                                <span class="form-text text-muted">Favor informar numero</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label for="bairro" class="">Bairro:</label>
                                <div class="kt-input-icon kt-input-icon--right">
                                    <input type="text" id="bairro" name="bairro" class="form-control"
                                        placeholder="Entre com bairro">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                class="la la-bookmark-o"></i></span></span>
                                </div>
                                <span class="form-text text-muted">Favor informar bairro</span>
                            </div>
                            <div class="col-lg-4">
                                <label for="cidade" class="">Cidade:</label>
                                <div class="kt-input-icon kt-input-icon--right">
                                    <input type="text" id="cidade" name="cidade" class="form-control"
                                        placeholder="Entre com cidade">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                class="la la-bookmark-o"></i></span></span>
                                </div>
                                <span class="form-text text-muted">Favor informar cidade</span>
                            </div>
                            <div class="col-lg-4">
                                <label class="">Status:</label>
                                <div class="kt-radio-inline">
                                    <label for="status" class="kt-radio kt-radio--solid">
                                        <input type="radio" name="status1" checked value="2"> Ativo
                                        <span></span>
                                    </label>
                                    <label class="kt-radio kt-radio--solid">
                                        <input type="radio" name="status1" value="2"> Inativo
                                        <span></span>
                                    </label>
                                </div>
                                <span class="form-text text-muted">Favor informar status</span>
                            </div>
                        </div>                    
                </div>
                <div class="tab-pane " id="kt_builder_representante">
                </div>
            </div>
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-9">
                        <button type="submit" name="builder_submit" data-demo="demo1"
                            class="btn btn-outline-brand btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-eye"></i>
                            Visualizar
                        </button>&nbsp;
                        <button type="submit" name="builder_submit" data-demo="demo1"
                            class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-save"></i>
                            Salvar
                        </button>&nbsp;
                        <button type="submit" id="builder_export" data-demo="demo1"
                            class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-download"></i>
                            Export
                        </button>&nbsp;
                        <button type="submit" name="builder_reset" data-demo="demo2"
                            class="btn btn-outline-secondary btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-recycle"></i>
                            Cancelar
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--end::Form-->
</div>
<!--end::Portlet-->