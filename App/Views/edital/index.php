<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <div class="kt-portlet kt-portlet--mobile">
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/edital/" method="post" id="form_cadastro" enctype="multipart/form-data">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                Pesquisa de editais registrados
            </h3>
        </div>
        </div>
        <div class="kt-portlet__body">
        <div class="form-group row">
            <div class="col-lg-6">
                    <label for="codCliente">Cliente</label> 
                        <input type="text" name="clienteLicitacaoAutocomplete" id="clienteLicitacao-autocomplete"
                            class="form-control" placeholder="Cliente - autocomplete" >
                        <input type="hidden" id="cliente" name="cliente">
                </div>
           <!-- <div class="col-lg-6">
            <label for="codCliente">Cliente</label>
                <select class="form-control" name="codCliente">
                    <option value="">Selecione o cliente</option>
                    < ?php foreach ($viewVar['listaClientesEdital'] as $cliente) : ?>
                        <option value="< ?php echo $cliente->getCodCliente(); ?>" < ?php echo ($Sessao::retornaValorFormulario('cliente') == $cliente->getCodCliente()) ? "selected" : ""; ?>>
                            < ?php echo $cliente->getRazaoSocial().' - CNPJ: '.$cliente->getCnpj() ; ?></option>
                    < ?php endforeach; ?>
                </select>
            </div> -->
            <div class="col-lg-2">
                        <label for="operador">Usuario</label>
                        <select title="Selecione o Usuario" class="form-control" id="operador" name="operador" >
                                <option  value="">Usuario</option>
                                <?php foreach ($viewVar['listarOperadorEdital'] as $operador) : ?>
                                    <option value="<?php echo $operador->getEdtOperador(); ?>" 
                                    <?php echo ($Sessao::retornaValorFormulario('operador') == $operador->getEdtOperador()) ? "selected" : ""; ?>>
                                        <?php echo $operador->getEdtOperador(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        <span class="form-text text-muted">Por favor insira o Representante</span>
            </div>   
            <div class="col-lg-2">
                        <label for="codRepresentante">Representante</label>
                        <select title="Selecione o Representante" class="form-control" id="codRepresentante" name="codRepresentante" >
                                <option value="">Representante</option>
                                <?php foreach ($viewVar['listarRepresentantes'] as $representante) : ?>
                                    <option value="<?php echo $representante->getRepresentante()->getCodRepresentante(); ?>" <?php echo ($Sessao::retornaValorFormulario('codRepresentante') == $representante->getRepresentante()->getCodRepresentante()) ? "selected" : ""; ?>>
                                        <?php echo $representante->getRepresentante()->getNomeRepresentante(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        <span class="form-text text-muted">Por favor insira o Representante</span>
            </div>   
            <div class="col-lg-2">
                        <label for="codRepresentante">Portal</label>
                        <select title="Selecione o Portal" class="form-control" id="codRepresentante" name="codRepresentante" >
                                <option value="">Portal</option>
                                <?php foreach ($viewVar['listarRepresentantes'] as $representante) : ?>
                                    <option value="<?php echo $representante->getRepresentante()->getCodRepresentante(); ?>" <?php echo ($Sessao::retornaValorFormulario('codRepresentante') == $representante->getRepresentante()->getCodRepresentante()) ? "selected" : ""; ?>>
                                        <?php echo $representante->getRepresentante()->getNomeRepresentante(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        <span class="form-text text-muted">Por favor insira o Portal</span>
            </div>   
            </div>   
            
                <div class="form-group row">
                    <div class="col-lg-1">
                        <label for="codigo">Codigo:</label>
                        <input type="text" class="form-control" title="Digite o codido" placeholder="codigo" id="codigo" name="codigo" value="<?php echo $Sessao::retornaValorFormulario('codigo'); ?>">
                    </div>
                    <div class="col-lg-1">
                        <label for="prosposta">Prosposta:</label>
                        <input type="text" class="form-control" title="Digite o numero da Prosposta" placeholder="Prosposta" id="proposta" name="proposta" value="<?php echo $Sessao::retornaValorFormulario('proposta'); ?>">
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group"><label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="">Selecione</option>
                            <?php foreach ($viewVar['listarEditalStatus'] as $editalStatus) : ?>
                            <option value="<?php echo $editalStatus->getStEdtId(); ?>"
                                <?php echo ($Sessao::retornaValorFormulario('status') == $editalStatus->getStEdtId()) ? "selected" : ""; ?>>
                                <?php echo $editalStatus->getStEdtNome(); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="form-text text-muted">Por favor insira o status</span>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group"><label for="modalidade">modalidade</label>
                        <select class="form-control" name="modalidade" id="modalidade" >
                                <option value="">Selecione</option>
                                <option value="Eletronico">Eletronico</option>
                                <option value="Presencial">Presencial</option>
                                <option value="Concorrencia">Concorrencia</option>
                                <option value="Convite">Convite</option>
                            </select>
                            <span class="form-text text-muted">Por favor insira o Modalidade</span>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <label>Licitacao:</label>
                        <input type="text" class="form-control" title="Digite o numero da licitacao" placeholder="Nume. Licitacao" id="numeroLicitacao" name="numeroLicitacao" value="<?php echo $Sessao::retornaValorFormulario('numeroLicitacao'); ?>">
                    </div>
                    <div class="col-lg-2">
                        <label for="edtDataInicio" class="">Data de Inicio:</label>
                        <input type="checkbox" title="Marque Para Pesquisar por Data de Abertura" id="edtDataCadDisp" name="edtDataCadDisp">
                        <input type="date" class="form-control"
                            placeholder="Digite a Data" id="edtDataInicio"
                            name="edtDataInicio" value="">
                        <span class="form-text text-muted">Digite a Data</span>
                    </div>
                    <div class="col-lg-2">
                        <label for="edtDataFinal" class="">Data de Final:</label>
                        <input type="date" class="form-control"
                            placeholder="Digite a Data" id="edtDataFinal"
                            name="edtDataFinal" value=" ">
                        <span class="form-text text-muted">Digite a Data</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-elevate btn-pill btn-elevate-air">Pesquisar</button>
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
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                        <a href="http://<?php echo APP_HOST; ?>/edital/excel" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                            <span class="kt-nav__link-text">Excel</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="http://<?php echo APP_HOST; ?>/edital/excel" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">CSV</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="http://<?php echo APP_HOST; ?>/edital/pdf" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="kt-nav__link-text">PDF</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        &nbsp;
                        <a href="http://<?php echo APP_HOST; ?>/edital/cadastro" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-plus"></i>
                            Novo Cadastro
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_3">

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
                    <th class="text-center">OPERADOR</th>
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
                    <th class="text-center">OPERADOR</th>
                    <th class="text-center">ACOES</th>
                </tr>
                </tfoot>
                <tbody>
                <?php
                    $dados = $viewVar['listaEditais'];
                    if (!empty($dados)) {  
                        foreach ($dados as $edital) {
                            $soma = $edital->getEdtSomar();
                            $total += $soma;
                            $qtdeEditais += 1;
                ?>
                <tr>
                    <td><?php echo $edital->getClienteLicitacao()->getRazaoSocial()
                    ." - UF: ". $edital->getClienteLicitacao()->getEndCidade()->getEstado()->getEstUf(); ?></td>
                    <td><?php echo $edital->getEdtNumero(); ?></td>
                    <td><?php echo $edital->getInstituicao()->getInst_Nome(); ?></td>
                    <td><?php  
                     if ($edital->getEdtModalidade() == "Dispensa" || $edital->getEdtModalidade() == "Presencial"  ) {
                          echo "<a style='color: #6495ED'>". $edital->getEdtModalidade() ." - ". $edital->getEdtPortal()."</a>";                                                       
                    }else{
                        echo $edital->getEdtModalidade() ." - ". $edital->getEdtPortal(); 
                    } ?> </td>
                    <td><?php 
                    echo $edital->getEdtTipo()." - ".  $edital->getDisputa(); ?></td>
                    <td><?php echo $edital->getEdtGarantia(); ?>
                        <?php if ($edital->getEdtGarantia() == "Sim") { ?>
                        <a href="http://<?php echo APP_HOST; ?>/garantia/cadastro/<?php echo $edital->getEdtId(); ?>">
                            <button type="button" title="Click para adicionar garantia"
                                    class="btn btn-outline-dark btn-elevate btn-icon"><i class="la la-edit"></i>
                            </button>
                        </a></td>
                    <?php } ?>
                    <td class="text-center"><span class="badge badge-pill badge-<?php echo $edital->getEditalStatus()->getCors()->getCorCor(); ?>">
                    <?php echo $edital->getEditalStatus()->getStEdtNome(); ?></span>
                    <?php if ($edital->getEditalStatus()->getStEdtNome() == "CONTRATO") { ?>
                        <a href="http://<?php echo APP_HOST; ?>/contrato/cadastro/<?php echo $edital->getEdtId(); ?>">
                            <button type="button" title="Click para adicionar Contrato"
                                    class="btn btn-outline-dark btn-elevate btn-icon"><i class="la la-edit"></i>
                            </button>
                        </a></td>
                    <?php } ?>
                    
                    </td>
                    <td><?php echo $edital->getEdtDataAbertura()->format('Y-m-d'); ?></td>
                    <td><?php echo $edital->getEdtHora()->format('H:i'); ?></td>
                    <td><?php echo $edital->getEdtDataLimite()->format('Y-m-d'); ?></td>
                    <td><?php echo $edital->getEdtHoraLimite()->format('H:i'); ?></td>
                    <td><?php echo $edital->getEdtProposta(); ?></td>
                    <td><?php echo $edital->getEdtOperador(); ?></td>
                     <td class="text-center">                                                    
                        <div class="dropdown  d-block d-md">
                            <button class="btn btn-primary dropdown-toggle btn-elevate btn-pill btn-elevate-air btn-sm"
                                type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                Ações
                            </button>
                            <div class="dropdown-menu dropdown-menu-right " aria-labelledby="acoesListar">
                                <a href="http://<?php echo APP_HOST; ?>/edital/edicao/<?php echo $edital->getEdtId(); ?>"
                                    title="Editar" class="dropdown-item btn btn-outline-warning btn-elevate btn-pill btn-elevate-air btn-sm"><i class="la la-edit"></i> Editar</a>
                                <a href="http://<?php echo APP_HOST; ?>/edital/exclusao/<?php echo $edital->getEdtId(); ?>"
                                    title="Excluir" class="dropdown-item btn btn-outline-danger btn-elevate btn-pill btn-elevate-air btn-sm"><i class="la la-trash"></i> Excluir</a>
                                <a href="http://<?php echo APP_HOST; ?>/edital/edicao/<?php echo $edital->getEdtId(); ?>"
                                    title="Status" class="dropdown-item btn btn-outline-info btn-elevate btn-pill btn-elevate-air btn-sm"><i class="la la-list"></i> Status</a>
                                <a href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/<?php echo $edital->getEdtAnexo(); ?>"
                                    target="_blank" title="Visualizar Anexo" class="dropdown-item btn btn-outline-dark btn-elevate btn-pill btn-elevate-air btn-sm"><i
                                        class="la la-chain"></i> Anexo</a>
                                <a href="http://<?php echo APP_HOST; ?>/edital/edicao/<?php echo $edital->getEdtId(); ?>" title="Relatorios" 
                                class="dropdown-item btn btn-outline-info btn-elevate btn-pill btn-elevate-air btn-sm"><i class="la la-print"></i> Relatorio</a>
                            </div>
                        </div>
                    </td>
                        <?php
                            }
                        } else {

                            echo "<h3 class='kt-portlet__head-title'><p class='text-danger'>Nenhum Dado Encontrado!</p></h3>";
                        }
                        ?>
                            </tr>
                </tbody>
               
            </table>

            <!--end: Datatable -->
        </div>
    </div>
    <?php	
        echo "<h3 class='kt-portlet__head-title'><p class='text-info'>Qtde. de Editais " . $qtdeEditais . "</p></h3>"; // " e Valor Total R$" .number_format($total, 2, ',', '.') . "</p></h3>";
    ?>
</div>

<!-- end:: Content -->
</div>