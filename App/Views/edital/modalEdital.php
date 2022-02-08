
<!-- MODAL CADASTRAR PEDIDO -->
<div class="modal fade bs-example-modal-lg" id="modalCadastrarPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel1">Cadastro de Pedido</h4>
            </div>
            <div class="modal-body">
                <form id="frmCadastroPedido" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="CadastroPedido" name="tipo" id="tipo">
                    <input type="hidden" value="<?php ?>" name="dataAtual" id="dataAtual">
                    <input type="hidden" value="<?php  ?>" name="idInstituicao" id="idInstituicao">
                    <input type="hidden" value="<?php ?>" name="dataCadastro" id="dataCadastro">
                    <div class="form-group">
                            <select class="form-control" name="nomeCliente" id="nomeCliente" required>
                                <option value="" selected disabled>Selecione o Cliente</option>
                                
                            </select>
                        </div>
                    <div class="form-inline">
                        
                        <div class="form-group">
                            <input type="text" size="50" style="text-transform: uppercase;" maxlength="40" class="form-control" name="numeroAf" id="numeroAf" placeholder="Numero da AF" required>
                        </div>
                        <div class="form-group">
                            <input type="text" size="50" style="text-transform: uppercase;" maxlength="40" class="form-control" name="numeroPregao" id="numeroPregao" placeholder="Numero Licitação" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-inline">
                        
                        <div class="form-group">
                            <input type="text" size="50" style="text-transform: uppercase;" maxlength="40" class="form-control" name="valorPedido" id="valorPedido" placeholder="Valor do Pedido">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="statusPedido" id="statusPedido" required>
                                <option value="" selected disabled>Selecione o Status</option>
                                
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Observação:</label>
                        <textarea name="mensagem" class="form-control" rows="3" id="mensagem"></textarea>
                    </div>
                    <input type="file" name="file" id="file">
            </div>
            <div class="modal-footer">
                <button type="submit" id="salvaPedido" class="btn btn-primary">Enviar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- MODAL CRIA PEDIDO -->

<!-- MODAL detalhe do Pedido-->
<div class="modal fade bs-example-modal-lg" id="modalDetPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel1">Detalhes do Pedido</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="" class="table table-striped">
                            <tr>
                                <td>Código</td>
                                <td><span id="codigoDetalhes"></span></td>
                            </tr>
                            <tr>
                                <td>Nome Cliente</td>
                                <td><span id="nomeClienteDetalhes"></span></td>
                            </tr>
                            <tr>
                                <td>Tipo</td>
                                <td><span id="tipoClienteDetalhes"></span></td>
                            </tr>
                            <tr>
                                <td>Licitacao</td>
                                <td><span id="licitacaoDetalhes"></span></td>
                            </tr>
                            <tr>
                                <td>Pedido</td>
                                <td><span id="pedidoDetalhes"></span></td>
                            </tr>
                            <tr>
                                <td>Valor</td>
                                <td><span id="valorDetathes"></span></td>
                            </tr>
                            <tr>
                                <td>Cadastrado em:</td>
                                <td><span id="dataCriacaoDetalhes"></span></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td id="statusDetalhes"></td>
                            </tr>
                            <tr>
                                <th class="text-center">Decorridos</th>
                                <td id="tempoDetalhes"></td>
                            </tr>
                            <tr>
                                <td>Mensagem</td>
                                <td id="mensagemDetatalhes"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-12">
                            <h4><strong>Comentários:</strong></h4>
                            <table class="table table-striped">
                                <tbody id="comentariosPedido" >
                                
                                
                                </tbody>
                            </table>
                        </div>   
                         
                    <div class="col-md-12">                       
                            <form id="frmAddMensagem">
                                <input type="hidden" value="<?php  ?>" name="idLogado" id="idLogado">
                                <input type="hidden" value="<?php  ?>" name="datahora" id="datahora"> 
                                <input type="hidden" value="<?php  ?>" name="idInstituicaoMensagem" id="idInstituicaoMensagem">                         
                                <div class="form-group">
                                    <label for="message-text" class="control-label">Adicionar Comentário</label>
                                    <textarea name="mensagemComentario" class="form-control" rows="2" id="mensagemComentario" required></textarea>          
                                </div>
                                <button type="submit" id="addMensagem" class="btn btn-primary" >Enviar</button>
                            </form>
                        </div>                 

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <td><a class="btn btn-primary waves-effect waves-light" type="button" id="btnPedidoAlterar2" data-toggle="modal" data-target="#modalPedidoAlterar" data-whatever="@getbootstrap" value="<?php echo $idControle; ?>" target="_blank" data-codigocontrolealterar="<?php print($row['codControle']); ?>">Alterar</a></td>
            </div>
        </div>
    </div>
</div>
<!-- MODAL detalhe do Pedido-->

<!-- MODAL anexo do Pedido-->
<div class="modal fade" id="modalPedidoSemAnexo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" id="headerModalAlerta">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="headermodal">Alerta</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="contextoModal">
                            <h2>Este pedido não possui anexo!</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

            </div>
        </div>
    </div>
</div>
<!-- MODAL anexo do Pedido-->

<!-- MODAL EXCLUIR cliente-->
<div class="modal fade" id="modalExluirPedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="headermodal">Confirmação</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden"  name="ExcIdInstituicao" id="ExcIdInstituicao">
                        <input type="hidden" name="excIdPedido" id="excIdPedido">
                        <div class="col-md-12">
                            <div id="contextoModal">
                                <h2>Você vai EXCLUIR pedido do Cliente: <span id="ExcNomePedido"></span>?</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btnExcluirPedido" class="btn btn-primary">Confirmar</button>
                </div>
            </div>
        </div>
</div>
        <!-- MODAL EXCLUIR cliente-->



 <!-- MODAL alterar  Pedido-->
 <div class="modal fade bs-example-modal-lg" id="modalPedidoAlterar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel1">Alterar Status do Pedido</h4>
                </div>
                <div class="modal-body">
                    <form id="frmAlterarPedido" action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" value="AlterarPedido2" name="tipo" id="tipo">
                        <input type="hidden" id="codigoControleAlterar" name="codigoControleAlterar">
                        <input type="hidden" value="<?php echo $dataAtual; ?>" name="dataAtual2" id="dataAtual2">
                        <div class="form-group">
                            <select class="form-control" name="idClientePedidoAlterar" id="idClientePedidoAlterar" required>
                                <option value="" selected disabled>Selecione o Cliente</option>
                               
                            </select>
                        </div>
                    <div class="form-inline">
                        <div class="form-group">
                            <select class="form-control" name="statusPedidoAlterar" id="statusPedidoAlterar" required>
                                <option value="" selected disabled>Selecione o Status</option>
                               
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" size="36" style="text-transform: uppercase;" maxlength="40" class="form-control" name="numeroAfPedidoAlterar" id="numeroAfPedidoAlterar" placeholder="Numero da AF" required>
                        </div>
                        <div class="form-group">
                            <input type="text" size="36" style="text-transform: uppercase;" maxlength="40" class="form-control" name="numeroLicitacaoPedidoAlterar" id="numeroLicitacaoPedidoAlterar" placeholder="Numero da licitacao" required>
                        </div>
                    </div>
                        <br>
                    <div class="form-inline">
                        <div class="form-group">
                            <input type="text" size="50" style="text-transform: uppercase;" maxlength="40" class="form-control" name="valorPedidoAlterar" id="valorPedidoAlterar" placeholder="valor pedido" required>
                        </div>
                        <div class="form-group">
                            <input type="hidden" size="50" style="text-transform: uppercase;" maxlength="40" class="form-control" name="idInstituicaoAlterar" id="idInstituicaoAlterar" placeholder="instituicao" required>
                        </div>
                        
                    </div>

                        <div class="form-group">
                            <label for="message-text" class="control-label">Observação:</label>
                            <textarea name="mensagemPedidoAlterar" class="form-control" rows="3" id="mensagemPedidoAlterar"></textarea>
                        </div>
                        <input type="file" name="file" id="file">
                        <br>
                        <div class="form-group">
                        <input type="text" style="text-transform" class="form-control"  name="anexoAlterar" id="anexoAlterar" readonly="readonly">
                        </div>
                        <div class="modal-footer">                        
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="submit" id="alteraPedido" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
</div>
    <!-- MODAL altera Pedido-->

    <div class="modal fade" id="modal_teste" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">LOGISTICA - <span id="nomeCliente"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>
            <div class="kt-portlet kt-portlet--tabs">

                <div class="modal-kt-portlet__head">
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
                                    <label for="cadastroCliente" class="">CADASTRO DO CLIENTE</label>
                                    <a href="http://<?php echo APP_HOST; ?>/clienteLicitacao/cadastro" id="cadastroCliente"
                                        name="cadastroCliente" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                                        <i class="la la-plus"></i>Novo Cliente</a>
                                    <div>
                                        <input type="text" name="clienteLicitacaoAutocomplete" id="clienteLicitacao-autocomplete"
                                            class="form-control" required placeholder="Cliente - autocomplete">

                                        <input type="hidden" id="cliente" name="cliente" >
                                    </div>
                                    <span class="form-text text-muted">Por favor insira o cliente</span>
                                </div>
                                
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
                                            <div class="col-lg-4">
                                                <label for="nfe">NF-e:</label>
                                                <input type="text" id="nfe" name="nfe" class="form-control"
                                                    placeholder="Nota fiscal">
                                                <span class="form-text text-muted">Favor informar NF-e</span>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group"><label for="status">Status</label>
                                                    <select class="form-control" name="status" id="status"
                                                        value="<?php echo $Sessao::retornaValorFormulario('status'); ?>">
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
                                                <label for="codRepresentante">Representante</label>
                                                <select class="form-control" id="codRepresentante" name="codRepresentante">
                                                    <option value="">Selecione o Representante</option>
                                                    <?php foreach ($viewVar['listarRepresentantes'] as $representante) : ?>
                                                    <option value="<?php echo $representante->getCodRepresentante(); ?>"
                                                        <?php echo ($Sessao::retornaValorFormulario('codRepresentante') == $representante->getCodRepresentante()) ? "selected" : ""; ?>>
                                                        <?php echo $representante->getNomeRepresentante(); ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span class="form-text text-muted">Por favor insira o Representante</span>
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="checkbox" title="marque para informar o valor corrigido"
                                                    id="infoValorCorrigido" name="infoValorCorrigido" value="1">
                                                <label style="color:red" class="" for="valorcorrigido">Valor Pedido:
                                                    R$<label id="valor" name="valor" disabled></label></label>
                                                <input type="text" title="informar corrigido" id="valorcorrigido"
                                                    name="valorcorrigido" class="form-control"
                                                    placeholder="Entre com o valor" disabled>
                                                <span class="form-text text-muted">Favor informar valor corrigido</span>
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