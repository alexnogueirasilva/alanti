<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h1 class="kt-portlet__head-title">
                    GERENCIAMENTO DE CONTRATO <span> - <?php echo $viewVar['contrato']->getClienteLicitacao()->getRazaoSocial(); ?>
                </h1>
            </div>
            <?php if ($Sessao::retornaErro()) { ?>
            <div class="alert alert-warning" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
                <?php echo $mensagem; ?> <br>
                <?php } ?>
            </div>
            <?php } ?>
           
        </div>
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
                        <a class="nav-link active" data-toggle="tab" href="#kt_builder_principal" role="tab">
                            Principal
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#kt_builder_observacao" role="tab">
                            
                        </a>
                    </li>

                </ul>
            </div>
        </div>


        <!--begin::Form-->


        <div class="kt-portlet__body">
            <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/contrato/salvar"
                  method="post"
                  id="form_cadastro" enctype="multipart/form-data">
                <input type="hidden" id="ctrUsuario" name="ctrUsuario" value="<?php echo $_SESSION['id']; ?>"
                       class="form-control">
                <input type="hidden" id="instituicao" name="instituicao" value="<?php echo $_SESSION['inst_id']; ?>"
                       class="form-control">
                <input type="hidden" id="ctr_id" name="ctr_id" value="<?php $Sessao::retornaValorFormulario('ctr_id');?>" class="form-control">
                <div class="kt-portlet__body">
                    <div class="tab-content">                        
                        <div class="tab-pane  active" id="kt_builder_principal">
                            <div class="kt-portlet__body">
                                <input type="hidden" class="form-control" id="ctr_edital" name="ctr_edital"
                                       value="<?php echo $viewVar['contrato']->getEdtId(); ?>" required>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label for="numeroContrato" ><span class="text-danger">* </span>Numero da Contrato:</label>
                                        <input type="text" class="form-control" placeholder="Digite numero da Contrato" id="numeroContrato" name="numeroContrato" value="<?php $Sessao::retornaValorFormulario('numeroContrato');?>" required>
                                        <span class="form-text text-muted">Digite o numero da Contrato</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="prazoEntrega" ><span class="text-danger">* </span>Prazo de Entrega:</label>
                                        <input type="text" class="form-control" placeholder="Digite o Prazo de Entrega" id="prazoEntrega" name="prazoEntrega" value="<?php $Sessao::retornaValorFormulario('prazoEntrega');?>" required>
                                        <span class="form-text text-muted">Digite oPrazo de Entrega</span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="prazoPagamento" ><span class="text-danger">* </span>Prazo de Pagamento:</label>
                                        <input type="text" class="form-control" placeholder="Digite o Prazo de Pagamento" id="prazoPagamento" name="prazoPagamento" value="<?php $Sessao::retornaValorFormulario('prazoPagamento');?>" required>
                                        <span class="form-text text-muted">Digite oPrazo de Pagamento</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <label for="dataInicio" class=""><span class="text-danger">* </span>Data de Inicio:</label>
                                            <input type="date" class="form-control" placeholder="Digite a Data Inicial" id="dataInicio" name="dataInicio" value="<?php echo $Sessao::retornaValorFormulario('dataInicio'); ?>" required>
                                            <span class="form-text text-muted">Digite a Data Inicial</span>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="dataVencimento" class=""><span class="text-danger">* </span>Data de Vencimento:</label>
                                            <input type="date" class="form-control" placeholder="Digite a Data Vencimento" id="dataVencimento" name="dataVencimento" value="<?php echo $Sessao::retornaValorFormulario('dataVencimento'); ?>" required>
                                            <span class="form-text text-muted">Digite a Data Vencimento</span>
                                    </div>
                                    <div class="col-lg-3">
                        <label for="status"><span class="text-danger">* </span>Status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="">Selecione o Status</option>
                                <option value="Pendente">Pendente</option>
                                <option value="Lancado">Lancado</option>
                                <option value="Vencido">Vencido</option>
                        </select>
                        <span class="form-text text-muted">Por favor insira o Status</span>
                    </div>
                                    <div class="col-lg-3">
                                        <label for="valor" class=""><span class="text-danger">* </span>Valor do Contrato:</label>
                                        <input type="text" class="form-control" placeholder="Digite o valor do Contrato" id="valor" name="valor" value="<?php echo $Sessao::retornaValorFormulario('valor'); ?>" >
                                        <span class="form-text text-muted">Digite o valor do Contrato</span>
                                    </div>
                                </div> 
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-5">
                                    <label for="observacao" class="">Observacao do Contrato:</label>
                                    <textarea class="form-control" rows="3" placeholder="Digite Observacao do Contrato" id="observacao" name="observacao" value="<?php echo $Sessao::retornaValorFormulario('observacao'); ?>" ></textarea>
                                    <span class="form-text text-muted">Digite Observacao do Contrato</span>
                                </div>  
                                <div class="col-lg-3">
                                    <label for="anexo" class="">Anexo:</label><br>
                                    <input type="file" name="anexo" id="anexo" value="<?php echo $Sessao::retornaValorFormulario('anexo'); ?>">
                                    <input type="hidden" class="form-control" id="ctrAnexoAlt"
                                                    readonly="readonly" name="ctrAnexoAlt">
                                                <a class="dropdown-item" id="ctrAnexoVerAnexo" name="ctrAnexoVerAnexo" target="_blank"
                                                    title="Click para Visualizar Anexo" class="btn btn-info btn-sm"><i class="la la-chain"></i> Anexo</a>
                                    <span class="form-text text-muted">Selecione o arquivo</span>
                                </div>                  
                                <div class="col-lg-2">
                                    <label for="btnAdicionarContrato" class="">Salvar Contrato:</label>
                                    <button type="submit" class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air form-control"
                                        id="btnAdicionarContrato">Salvar</button>
                                </div>
                            </div>           
                                <p><span class="text-danger">* </span>Campos obrigatórios</p>
                        
                            <div class="kt-portlet__body">
                                <!--begin: Datatable -->
                                <table class="table table-striped table-bordered table-hover table-checkable"
                                        id="kt_table_3">
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
                                        <?php
                                            foreach ($viewVar['contratos'] as $contrato) { ?>

                                            <td><?php echo $contrato->getCtrId(); ?></td>
                                            <td><?php echo $contrato->getEdital()->getClienteLicitacao()->getRazaoSocial(); ?></td>
                                            <td><?php echo $contrato->getEdital()->getClienteLicitacao()->getTipoCliente(); ?></td>
                                            <td><?php echo $contrato->getCtrNumero(); ?></td>
                                            <td><?php echo $contrato->getInstituicao()->getInst_NomeFantasia(); ?></td>
                                            <td><?php echo $contrato->getCtrDataVencimento()->format('d/m/Y'); ?></td>
                                            <td>R$<?php echo $contrato->getCtrValor(); ?></td>
                                            <td><?php echo $contrato->getUsuario()->getApelido(); ?></td>
                                            <td><?php echo $contrato->getCtrPrazoEntrega(); ?></td>
                                            <td><?php echo $contrato->getCtrPrazoPagamento(); ?></td>
                                            <td><?php echo $contrato->getCtrStatus(); ?></td>
                                            <td><?php echo $contrato->getEdital()->getEdtNumero(); ?></td>
                                            <td>
                                                <span class="dropdown">
                                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                        data-toggle="dropdown" aria-expanded="true"><i class="la la-ellipsis-h"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">                                       
                                                        <a class="dropdown-item"
                                                        href="http://<?php echo APP_HOST; ?>/contrato/exclusao/<?php ?>"
                                                        title="Excluir" class="btn btn-info btn-sm"><i class="la la-trash"></i> Excluir</a>
                                                        <a class="dropdown-item"
                                                        href="http://<?php echo APP_HOST; ?>/edital/edicao/<?php ?>"
                                                        title="Status" class="btn btn-info btn-sm"><i class="la la-leaf"></i> Status</a>
                                                        <a class="dropdown-item"
                                                        href="http://<?php echo APP_HOST; ?>/edital/edicao/<?php ?>"
                                                        title="Relatorios" class="btn btn-info btn-sm"><i
                                                                class="la la-print"></i> Relatorio</a>
                                                    </div>
                                                </span>
                                                <a target="_blank"
                                                    href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/<?php echo $contrato->getCtrAnexo(); ?>"
                                                    title="Visualizar anexo">
                                                    <button type="button"
                                                            class="btn btn-outline-dark btn-elevate btn-icon">
                                                        <i class="la la-file-text-o"></i></button>
                                                </a>
                                                <a href="#"
                                                    data-numerocontrato="<?php echo $contrato->getCtrNumero();?>"
                                                    data-codigocontrato="<?php echo $contrato->getCtrId() ;?>"
                                                    data-codigoedital="<?php echo $contrato->getEdital()->getEdtId() ;?>"
                                                    data-entrega="<?php echo $contrato->getCtrPrazoEntrega() ;?>"
                                                    data-pagamento="<?php echo $contrato->getCtrPrazoPagamento() ;?>"
                                                    data-datainicio="<?php echo $contrato->getCtrDataInicio()->format('Y-m-d') ;?>"
                                                    data-datavencimento="<?php echo $contrato->getCtrDataVencimento()->format('Y-m-d') ;?>"
                                                    data-valor="<?php echo $contrato->getCtrValor() ;?>"
                                                    data-anexo="<?php echo $contrato->getCtrAnexo() ;?>"
                                                    data-observacao="<?php echo $contrato->getCtrObservacao() ;?>"
                                                    data-status="<?php echo $contrato->getCtrStatus() ;?>"
                                                    id="btnEditarContrato" name="btnEditarContrato"
                                                    title="Editar" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i
                                                    class="la la-edit"></i></a>
                                                <a href="http://<?php echo APP_HOST; ?>/contrato/exclusao/<?php echo $contrato->getCtrId() ;?>"
                                                title="Excluir" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i
                                                        class="la la-trash"></i></a>
                                            </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                    </tbody>
                                </table>
                            <!--end: Datatable -->
                            </div>
                        </div>                    
                        <div class="tab-pane" id="kt_builder_observacao">
                            <div class="kt-portlet__body">
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <label for="">:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"></div>
                                            <textarea type="text" id="" rows="5" name=""
                                                    class="form-control"
                                                    placeholder=" "></textarea>
                                        </div>
                                        <span class="form-text text-muted"> </span>
                                    </div>
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
                                <a type="button" id="btnVoltarTra"
                                   href='http://<?php echo APP_HOST; ?>/edital/index'
                                   class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Portlet-->
    </div>
</div>