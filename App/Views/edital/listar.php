<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <div class="kt-portlet kt-portlet--mobile">
        <form id="frmEditalPesq" action="" method="post" id="form_cadastro" enctype="multipart/form-data">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">Pesquisa de editais registrados</h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="codClientePesq">Cliente</label>
                        <select class="form-control" name="codClientePesq" id="codClientePesq">
                            <option value="">Selecione o cliente</option>
                            <?php foreach ($viewVar['listaClientesEdital'] as $cliente) : ?>
                            <option value="<?php echo $cliente->getCodCliente(); ?>"
                                <?php echo ($Sessao::retornaValorFormulario('codClientePesq') == $cliente->getCodCliente()) ? "selected" : ""; ?>>
                                <?php echo $cliente->getRazaoSocial().' - CNPJ: '.$cliente->getCnpj() ; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label for="operadorPesq">Usuario</label>
                        <select class="form-control" id="operadorPesq" name="operadorPesq">
                            <option value="">Selecione o Usuario</option>
                            <?php foreach ($viewVar['listarOperadorEdital'] as $operador) : ?>
                            <option value="<?php echo $operador->getEdtOperador(); ?>"
                                <?php echo ($Sessao::retornaValorFormulario('operadorPesq') == $operador->getEdtOperador()) ? "selected" : ""; ?>>
                                <?php echo $operador->getEdtOperador(); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="form-text text-muted">Por favor insira o Representante</span>
                    </div>
                    <div class="col-lg-3">
                        <label for="codRepresentantePesq">Representante</label>
                        <select class="form-control" id="codRepresentantePesq" name="codRepresentantePesq">
                            <option value="">Selecione o Representante</option>
                            <?php foreach ($viewVar['listarRepresentantes'] as $representante) : ?>
                            <option value="<?php echo $representante->getRepresentante()->getCodRepresentante(); ?>"
                                <?php echo ($Sessao::retornaValorFormulario('codRepresentantePesq') == $representante->getRepresentante()->getCodRepresentante()) ? "selected" : ""; ?>>
                                <?php echo $representante->getRepresentante()->getNomeRepresentante(); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="form-text text-muted">Por favor insira o Representante</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="codigoPesq">Codigo:</label>
                        <input type="text" class="form-control" title="Digite o codido" placeholder="codigo"
                            id="codigoPesq" name="codigoPesq"
                            value="<?php echo $Sessao::retornaValorFormulario('codigoPesq'); ?>">
                    </div>
                    <div class="col-lg-2">
                        <label for="prospostaPesq">Prosposta:</label>
                        <input type="text" class="form-control" title="Digite o numero da Prosposta"
                            placeholder="Prosposta" id="propostaPesq" name="propostaPesq"
                            value="<?php echo $Sessao::retornaValorFormulario('proposta'); ?>">
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group"><label for="statusPesq">Status</label>
                            <select class="form-control" id="statusPesq" name="statusPesq">
                                <option value="">Selecione o status</option>
                                <?php foreach ($viewVar['listarEditalStatus'] as $editalStatus) : ?>
                                <option value="<?php echo $editalStatus->getStEdtId(); ?>"
                                    <?php echo ($Sessao::retornaValorFormulario('statusPesq') == $editalStatus->getStEdtId()) ? "selected" : ""; ?>>
                                    <?php echo $editalStatus->getStEdtNome(); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="form-text text-muted">Por favor insira o status</span>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group"><label for="modalidadePesq">modalidade</label>
                            <select class="form-control" name="modalidadePesq" id="modalidadePesq">
                                <option value="">Selecione a Modalidade</option>
                                <option value="Eletronico">Eletronico</option>
                                <option value="Presencial">Presencial</option>
                                <option value="Concorrencia">Concorrencia</option>
                                <option value="Convite">Convite</option>
                            </select>
                            <span class="form-text text-muted">Por favor insira o Modalidade</span>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <label for="numeroLicitacaoPesq">Licitacao:</label>
                        <input type="text" class="form-control" title="Digite o numero da licitacao"
                            placeholder="Nume. Licitacao" id="numeroLicitacaoPesq" name="numeroLicitacaoPesq"
                            value="<?php echo $Sessao::retornaValorFormulario('numeroLicitacao'); ?>">
                    </div>
                </div>
                <button type="submit" id="btnPesqEdital"
                    class="btn btn-primary btn-elevate btn-pill btn-elevate-air">Pesquisar</button>
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
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                            <span class="kt-nav__link-text">Excel</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">CSV</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="kt-nav__link-text">PDF</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        &nbsp;
                        <a  data-toggle='modal' data-target='#modal_edital' data-whatever='@getbootstrap'
                        class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air">
                            <i class="fa fa-plus fa-2x"></i>
                            Novo Cadastro
                        </a>
                        <a id="btnEditalLimpar"
                        class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">
                            <i class='fa fa-eraser fa-2x'></i>
                            Limpar Filtro
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_Editais">

                <thead>
                    <tr>
                        <th class="text-center">CLIENTE</th>
                        <th class="text-center">NUMERO</th>
                        <th class="text-center">EMPRESA</th>
                        <th class="text-center">MODALIDADE</th>
                        <th class="text-center">TIPO</th>
                        <th class="text-center">GARANTIA</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">DATA ABERTURA</th>
                        <th class="text-center">HORA</th>
                        <th class="text-center">DATA LIMITE</th>
                        <th class="text-center">HORA LIMITE</th>
                        <th class="text-center">PROPOSTA</th>
                        <th class="text-center">ACOES</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-center">CLIENTE</th>
                        <th class="text-center">NUMERO</th>
                        <th class="text-center">EMPRESA</th>
                        <th class="text-center">MODALIDADE</th>
                        <th class="text-center">TIPO</th>
                        <th class="text-center">GARANTIA</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">DATA ABERTURA</th>
                        <th class="text-center">HORA</th>
                        <th class="text-center">DATA LIMITE</th>
                        <th class="text-center">HORA LIMITE</th>
                        <th class="text-center">PROPOSTA</th>
                        <th class="text-center">ACOES</th>
                    </tr>
                </tfoot>
                <tbody id="listarEditais">

                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>
    <?php
        echo "<h3 class='kt-portlet__head-title'><p class='text-info'>Qtde. de Editais " . $qtdeEditais . " e Valor Total R$" . number_format($total, 2, ',', '.') . "</p></h3>";
    ?>
</div>
<!-- end:: Content -->

<!-- MODAL edital-->
<div class="modal fade" id="modal_edital" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">CADASTRO DE EDITAL - <span id="clienteEditalTitulo"></span></h4>
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
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_builder_endereco" role="tab">
                                    Endereco
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--begin::Form-->
                <form id="frmModalEdital" class="kt-form kt-form--label-right">
                    <div class="modal-body">
                        <div class="kt-portlet__body">
                            <div class="tab-content">
                                <input type="hidden" id="codigo" name="codigo">
                                <input type="hidden" class="form-control" name="fk_instituicao" id="fk_instituicao"
                                    value="<?php echo $_SESSION['idInstituicao']; ?>" required>
                                <input type="hidden" id="acao" name="acao">
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <label for="cadastroCliente" class="">CADASTRO DO CLIENTE</label>
                                        <a href="http://<?php echo APP_HOST; ?>/clienteLicitacao/cadastro"
                                            id="cadastroCliente" name="cadastroCliente"
                                            class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                                            <i class="la la-plus"></i>Novo Cliente</a>
                                        <input type="text" name="clienteLicitacaoAutocomplete"
                                            id="clienteLicitacao-autocomplete" class="" required
                                            placeholder="Cliente - autocomplete">
                                        <input type="hidden" id="cliente" name="cliente">
                                        <span class="form-text text-muted">Por favor insira o cliente</span>
                                    </div>
                                </div>
                                <div class="tab-pane active" id="kt_builder_principal">
                                <div class="form-group row">
                                <div class="col-lg-2">
                                            <label for="modalidade">Modalidade</label>
                                            <select class="form-control" name="modalidade" id="modalidade" required>
                                                <option value="">Selecione a Modalidade</option>
                                                <option value="Eletronico">Eletronico</option>
                                                <option value="Presencial">Presencial</option>
                                                <option value="Concorrencia">Concorrencia</option>
                                                <option value="Convite">Convite</option>
                                            </select>
                                            <span class="form-text text-muted">Por favor insira o Modalidade</span>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="numeroLicitacao">Numero da Licitacao:</label>
                                            <input type="text" class="form-control"
                                                placeholder="Digite numero da licitacao" id="numeroLicitacao"
                                                name="numeroLicitacao"
                                                value="<?php echo $Sessao::retornaValorFormulario('numeroLicitacao'); ?>"
                                                required>
                                            <span class="form-text text-muted">Digite o numero da licitacao</span>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="garantia">Garantia</label>
                                            <select class="form-control" name="garantia" id="garantia" >
                                                <option value="">Selecione Garantia</option>
                                                <option value="Sim">SIM</option>
                                                <option value="Nao">NÃO</option>
                                            </select>
                                            <span class="form-text text-muted">Por favor Garantia</span>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="">Selecione o Status</option>
                                                <?php foreach ($viewVar['listarEditalStatus'] as $editalStatus) : ?>
                                                <option value="<?php echo $editalStatus->getStEdtId(); ?>"
                                                    <?php echo ($Sessao::retornaValorFormulario('status') == $editalStatus->getStEdtId()) ? "selected" : ""; ?>>
                                                    <?php echo $editalStatus->getStEdtNome(); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <span class="form-text text-muted">Por favor insira o Status</span>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="codRepresentante1">Representante</label>
                                            <select class="form-control" id="codRepresentante" name="codRepresentante">
                                                <option value="">Selecione o Representante</option>
                                                <?php foreach ($viewVar['listarRepresentantes1'] as $representante) : ?>
                                                <option value="<?php echo $representante->getCodRepresentante(); ?>"
                                                    <?php echo ($Sessao::retornaValorFormulario('codRepresentante') == $representante->getCodRepresentante()) ? "selected" : ""; ?>>
                                                    <?php echo $representante->getNomeRepresentante(); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <span class="form-text text-muted">Por favor insira o Representante</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label for="dataAbertura" class="">Data de Abertura:</label>
                                            <input type="date" class="form-control"
                                                placeholder="Digite a Data de Abertura" id="dataAbertura"
                                                name="dataAbertura"
                                                value="<?php echo $Sessao::retornaValorFormulario('dataAbertura'); ?>"
                                                required>
                                            <span class="form-text text-muted">Digite a Data de Abertura</span>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="hora" class="">Hora:</label>
                                            <input type="time" class="form-control"
                                                placeholder="Digite a Hora de Abertura" id="hora" name="hora"
                                                value="<?php echo $Sessao::retornaValorFormulario('hora'); ?>" required>
                                            <span class="form-text text-muted">Digite a Hora de Abertura</span>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="tipo">Tipo</label>
                                            <select class="form-control" id="tipo" name="tipo" required>
                                                <option value="">Selecione o Tipo</option>
                                                <option value="Por Item">Por Item</option>
                                                <option value="Por Lote">Por Lote</option>>
                                            </select>
                                            <span class="form-text text-muted">Por favor insira o Tipo</span>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="operador">Operador</label>
                                            <select class="form-control" id="operador" name="operador" required>
                                                <option value="">Operador</option>
                                                <?php foreach ($viewVar['listarUsuarios'] as $usuario) : ?>
                                                <option value="<?php echo $usuario->getNome(); ?>"
                                                    <?php echo ($Sessao::retornaValorFormulario('operador') == $usuario->getNome()) ? "selected" : ""; ?>>
                                                    <?php echo $usuario->getNome(); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <span class="form-text text-muted">Por favor operador</span>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="portal">Portal</label>
                                            <select class="form-control" id="portal" name="portal" required>
                                                <option value="">Selecione portal</option>
                                                <option value="LICITACOES-E">LICITACOES-E</option>
                                                <option value="PE INTEGRADO">PE INTEGRADO</option>
                                                <option value="BLL">BLL</option>
                                                <option value="BNC">BNC</option>
                                                <option value="COMPRASNET">COMPRASNET</option>
                                                <option value="OUTRO">OUTRO</option>
                                            </select>
                                            <span class="form-text text-muted">Por favor portal</span>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="identificador" class="">Id Portal:</label>
                                            <input type="text" class="form-control"
                                                title="favor informar o numero identificador no portal"
                                                placeholder="Id Portal" id="identificador" name="identificador"
                                                value="<?php echo $Sessao::retornaValorFormulario('identificador'); ?>">
                                            <span class="form-text text-muted">Digite o numero Id Portal</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label for="proposta" class="">Proposta:</label>
                                            <input type="text" class="form-control" placeholder="Digite a Proposta"
                                                id="proposta" name="proposta"
                                                value="<?php echo $Sessao::retornaValorFormulario('proposta'); ?>">
                                            <span class="form-text text-muted">Digite o numero da Proposta</span>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="dataLimite" class="">Data de Limite:</label>
                                            <input type="date" class="form-control"
                                                placeholder="Digite a Data de Limite" id="dataLimite" name="dataLimite"
                                                value="<?php echo $Sessao::retornaValorFormulario('dataLimite'); ?>"
                                                required>
                                            <span class="form-text text-muted">Digite Data Limite</span>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="horaLimite" class="">Hora Limite:</label>
                                            <input type="time" class="form-control" placeholder="Digite a Hora Limite"
                                                id="horaLimite" name="horaLimite"
                                                value="<?php echo $Sessao::retornaValorFormulario('horaLimite'); ?>"
                                                required>
                                            <span class="form-text text-muted">Digite a Hora Limite</span>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="codInstituicao">Empresa</label>
                                            <select class="form-control" id="codInstituicao" name="codInstituicao"
                                                required>
                                                <option value="">Selecione o Instituicao</option>
                                                <?php foreach ($viewVar['listaInstituicoes'] as $instituicao) : ?>
                                                <option value="<?php echo $instituicao->getInst_Id(); ?>"
                                                    <?php echo ($Sessao::retornaValorFormulario('codInstituicao') == $instituicao->getInst_Id()) ? "selected" : ""; ?>>
                                                    <?php echo $instituicao->getInst_NomeFantasia(); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <span class="form-text text-muted">Informe a empresa</span>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="anexo" class="">Anexo:</label>
                                            <input type="file" name="anexo" id="anexo"
                                                value="<?php echo $Sessao::retornaValorFormulario('anexo'); ?>">
                                            <input type="hidden" class="form-control" readonly="readonly" id="anexoAlt"
                                                name="anexoAlt">
                                            <div id="verAnexoEdt" name="verAnexoEdt"></div>
                                            <span class="form-text text-muted">Selecione o arquivo</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label for="observacao" class="">Observacao do Edital:</label>
                                            <textarea class="form-control" rows="3"
                                                placeholder="Digite Observacao do Edital" id="observacao"
                                                name="observacao"
                                                value="<?php echo $Sessao::retornaValorFormulario('observacao'); ?>"></textarea>
                                            <span class="form-text text-muted">Digite Observacao do Edital</span>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="analise" class="">Analise do Edital:</label>
                                            <textarea class="form-control" rows="3"
                                                placeholder="Digite Analise do Edital" id="analise" name="analise"
                                                value="<?php echo $Sessao::retornaValorFormulario('analise'); ?>"></textarea>
                                            <span class="form-text text-muted">Digite Analise do Edital</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <input type="checkbox" id="enviarEmail" name="enviarEmail" value="1" checked>
                                        <label for="enviarEmail">Deseja enviar Email?</label>
                                        <select class="form-control m-select2" id="emails" name="emails[]"
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
                            </div>
                            <div class="tab-pane" id="kt_builder_endereco">
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-8">
                                        <button type="Submit" id="btnEditalSalvar" name="btnEditalSalvar"
                                            class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air">Salvar</button>
                                        <a id="btnEditalNovo"
                                            class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Novo</a>
                                        <a id="btnEditalDelete"
                                            class="btn btn-outline-danger btn-elevate btn-pill btn-elevate-air">Excluir</a>
                                        <a id="btnEditalUpdate"
                                            class="btn btn-outline-warning btn-elevate btn-pill btn-elevate-air">Alterar</a>
                                        <button type="button" id="btnEditalCancel" data-dismiss="modal"
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
<!-- MODAL edital-->
</div>