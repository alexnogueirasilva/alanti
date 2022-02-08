    <!--begin::Portlet-->
    <div class="container">
        <br>
        <center><h3>Cadastro de Pedido</h3></center>
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
        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/pedido/salvar" method="post" id="form_cadastro" enctype="multipart/form-data">
            <input type="text" class="form-control" name="fk_instituicao" id="fk_instituicao" value="<?php echo $_SESSION['inst_id']; ?>" required>
            <input type="hidden" class="form-control" name="usuario" id="usuario" value="<?php echo $_SESSION['id']; ?>" required>
            <div class="kt-portlet__body">
                <input type="hidden" class="form-control" name="dataCadastro" id="dataCadastro" value="<?php echo $dataAtual; ?>" required>
                <div class="kt-portlet__body">
                <div class="form-group">
                        <label for="cadastroCliente" class="">CADASTRO DO CLIENTE</label>                    
                        <a href="http://<?php echo APP_HOST; ?>/cliente/cadastro" id="cadastroCliente"  name="cadastroCliente" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                                <i class="la la-plus"></i>Novo Cliente</a>
                        <div>    
                            <input type="text" name="clienteLicitacaoAutocomplete" id="clienteLicitacao-autocomplete" class="form-control" required placeholder="Cliente - autocomplete"
                            value="<?php echo $viewVar['pedido']->getClienteLicitacao()->getRazaoSocial(); ?>" > 
                            
                            <input type="text" id="cliente" name="cliente" 
                            value="<?php echo $viewVar['pedido']->getClienteLicitacao()->getCodCliente(); ?>">  
                        </div>
                        <span class="form-text text-muted">Por favor insira o cliente do Pedido</span>                       
                </div>            
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label>Numero da Licitacao:</label>
                            <input type="text" class="form-control" placeholder="Digite numero da licitacao" id="numeroPregao" name="numeroPregao" value="<?php echo $Sessao::retornaValorFormulario('numeroPregao'); ?>" required>
                            <span class="form-text text-muted">Digite o numero da licitacao</span>
                        </div>
                        <div class="col-lg-3">
                            <label class="">Numero do AFM:</label>
                            <input type="text" class="form-control" placeholder="Digite o numero do AFM" id="numeroAf" name="numeroAf" value="<?php echo $Sessao::retornaValorFormulario('numeroAf'); ?>" required>
                            <span class="form-text text-muted">Digite o numero do AFM</span>
                        </div>
                        <div class="col-lg-3">
                            <label class="">Valor do pedido:</label>
                            <input type="text" class="form-control" placeholder="Digite o valor do pedido" id="valorPedido" name="valorPedido" value="<?php echo $Sessao::retornaValorFormulario('valorPedido'); ?>" required>
                            <span class="form-text text-muted">Digite o valor do pedido</span>
                        </div>
                        <div class="col-lg-3">
                            <label class="">Numero do pedido:</label>
                            <input type="number" class="form-control" placeholder="Digite o Numero do pedido" title="este campo se refere ao numero do pedido gerado no ERP" id="numeroPedidoERP" name="numeroPedidoERP" value="<?php echo $Sessao::retornaValorFormulario('numeroPedidoERP'); ?>" >
                            <span class="form-text text-muted">Digite o Numeto do pedido</span>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <div class="form-group"><label for="representante">Representante</label>
                                <select class="form-control" name="representante" required>
                                    <option value="">Selecione o Representante</option>
                                    <?php foreach ($viewVar['listarRepresentantes'] as $representante) : ?>
                                        <option value="<?php echo $representante->getCodRepresentante(); ?>" <?php echo ($Sessao::retornaValorFormulario('representante') == $representante->getCodRepresentante()) ? "selected" : ""; ?>>
                                            <?php echo $representante->getNomeRepresentante(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="form-text text-muted">Por favor insira o Representante do Pedido</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group"><label for="codStatus">Status</label>
                                <select class="form-control" name="codStatus" required>
                                    <option value="">Selecione o status</option>
                                    <?php foreach ($viewVar['listaStatus'] as $status) : ?>
                                        <option value="<?php echo $status->getCodStatus(); ?>" <?php echo ($Sessao::retornaValorFormulario('codStatus') == $status->getCodStatus()) ? "selected" : ""; ?>>
                                            <?php echo $status->getNome(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="form-text text-muted">Por favor insira o Status do Pedido</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label class="">Anexo:</label>
                            <input type="file" name="anexo" id="anexo" value="<?php echo $Sessao::retornaValorFormulario('anexo'); ?>">
                            <span class="form-text text-muted">Selecione o arquivo</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="">Observacao do Pedido:</label>
                        <textarea class="form-control" rows="3" placeholder="Digite Observacao do Pedido" id="observacao" name="observacao" value="<?php echo $Sessao::retornaValorFormulario('observacao'); ?>" ></textarea>
                        <span class="form-text text-muted">Digite Observacao do Pedido</span>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12">
                        <input type="checkbox" id="enviarEmail" name="enviarEmail" checked >
                        <label>Deseja enviar Email?</label>
                        <input type="text" class="form-control" title="Digite o endereco de e-mail" placeholder="email separado por virgula" id="email" name="email" disabled value="<?php echo $Sessao::retornaValorFormulario('eviarEmail'); ?>">
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-8">
                            <button type="submit" class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air">Gravar</button>
                                <a href="http://<?php echo APP_HOST; ?>/pedido" class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <!--end::Form-->
    </div>

    <!--end::Portlet-->

    <!-- footer -->

    </div>