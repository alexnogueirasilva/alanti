<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <div class="kt-portlet kt-portlet--mobile">
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/fornecedor/" method="post" id="form_cadastro" enctype="multipart/form-data">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                    <h3 class="kt-portlet__head-title">
                    Pesquisa de Fornecedores Cadastrados 
                    </h3>                   
            </div>
        </div>
            <div class="kt-portlet__body">                     
                <div class="form-group row">
                
                    <div class="col-lg-2">
                        <label for="pesForCodigo">Codigo:</label>
                        <input type="text" class="form-control" title="Digite o codido" placeholder="Código" id="pesForCodigo" name="pesForCodigo" value="<?php echo $Sessao::retornaValorFormulario('pesForCodigo'); ?>">
                    </div>
                    <div class="col-lg-2">
                        <label for="pesForRazaoSocial">Razao Social:</label>
                        <input type="text" class="form-control" title="Digite a Razao Social" placeholder="Razao Social" id="pesForRazaoSocial" name="pesForRazaoSocial" value="<?php echo $Sessao::retornaValorFormulario('pesRazaoSocial'); ?>">
                    </div>
                    <div class="col-lg-2">
                        <label for="pesForNomeFantasia">Nome Fantasia:</label>
                        <input type="text" class="form-control" title="Digite o Nome Fantasia" placeholder="Nome Fantasia" id="pesForNomeFantasia" name="pesForNomeFantasia" value="<?php echo $Sessao::retornaValorFormulario('pesNomeFantasia'); ?>">
                    </div>
                    <div class="col-lg-2">
                        <label for="pesForCnpj">CNPJ:</label>
                        <input type="text" class="form-control" title="Digite o CNPJ" placeholder="CNPJ/ CPF" id="pesForCnpj"  name="pesForCnpj" value="<?php echo $Sessao::retornaValorFormulario('pesCnpj'); ?>">
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group"><label for="pesForStatus">Status</label>
                        <select class="form-control" name="pesForStatus" id="pesForStatus">
                            <option value="">Selecione o Status</option>
                            <option value="ATIVO">ATIVO</option>
                            <option value="INATIVO">INATIVO</option>
                        </select>
                        </div>
                    </div>                   
                    <div class="col-lg-2">
                        <div class="form-group"><label for="pesForTipo">Tipo</label>
                        <select class="form-control" name="pesForTipo" id="pesForTipo">
                            <option value="">Selecione o Tipo</option>
                            <option value="DISTRIBUIDOR">DISTRIBUIDOR</option>
                            <option value="INDUSTRIA">INDUSTRIA</option>
                        </select>
                        </div>
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
                                    <a href="http://<?php echo APP_HOST; ?>/fornecedor/excel" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                            <span class="kt-nav__link-text">Excel</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                    <a href="http://<?php echo APP_HOST; ?>/fornecedor/excel" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">CSV</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                    <a href="http://<?php echo APP_HOST; ?>/fornecedor/pdf" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="kt-nav__link-text">PDF</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        &nbsp;
                        <a href="http://<?php echo APP_HOST; ?>/fornecedor/cadastro"
                            class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-plus"></i>
                            Novo Fornecedor
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
        <?php
                    $dados = $viewVar['listaFornecedores'];
                    if ($dados > 0){
                       
                        ?>
            <!--begin: Datatable -->
            <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_3">
                <thead>
                    <tr>
                        <th class="text-center">CÓDIGO</th>
                        <th class="text-center">RAZAO SOCIAL</th>
                        <th class="text-center">NOME FANTASIA</th>
                        <th class="text-center">UF</th>
                        <th class="text-center">CNPJ</th>
                        <th class="text-center">TIPO</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">Acoes</th>

                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="text-center">CÓDIGO</th>
                        <th class="text-center">RAZAO SOCIAL</th>
                        <th class="text-center">NOME FANTASIA</th>
                        <th class="text-center">UF</th>
                        <th class="text-center">CNPJ</th>
                        <th class="text-center">TIPO</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">Acoes</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php                   
                        foreach ($dados as $fornecedor){
                        ?>
                    <tr>
                        <td><?php echo $fornecedor->getFornecedor_Cod(); ?></td>
                        <td><?php echo $fornecedor->getForRazaoSocial(); ?></td>
                        <td><?php echo $fornecedor->getForNomeFantasia(); ?></td>
                        <td class="text-center"><?php echo $fornecedor->getEndCidade()->getEstado()->getEstUf(); ?></td>
                        <td><?php echo $fornecedor->getForCNPJ(); ?></td>
                        <td><?php echo $fornecedor->getForTipo(); ?></td>
                        <td class="text-center"><span class="badge badge-pill badge-<?php echo $fornecedor->getSituacoes()->getCors()->getCorCor(); ?>"><?php echo $fornecedor->getSituacoes()->getSitNome(); ?></span></td>
                        <td class="text-center">
                            <span class="d-none d-md-block">
                                <a href="http://<?php echo APP_HOST; ?>/fornecedor/edicao/<?php echo $fornecedor->getFornecedor_Cod(); ?>"
                                    title="Editar" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i
                                        class="la la-edit"></i></a>
                                <a href="http://<?php echo APP_HOST; ?>/fornecedor/exclusao/<?php echo $fornecedor->getFornecedor_Cod(); ?>"
                                    title="Excluir" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i
                                        class="la la-trash"></i></a>
                            </span>
                            <div class="dropdown  d-block d-md-none">
                                <button
                                    class="btn btn-primary dropdown-toggle btn-elevate btn-pill btn-elevate-air btn-sm"
                                    type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Ações
                                </button>
                                <div class="dropdown-menu dropdown-menu-right " aria-labelledby="acoesListar">
                                    <a href="http://<?php echo APP_HOST; ?>/fornecedor/edicao/<?php echo $fornecedor->getFornecedor_Cod(); ?>"
                                        title="Editar" class="dropdown-item btn btn-outline-warning btn-elevate btn-pill btn-elevate-air btn-sm"><i class="la la-edit"></i> Editar</a>
                                    <a href="http://<?php echo APP_HOST; ?>/fornecedor/exclusao/<?php echo $fornecedor->getFornecedor_Cod(); ?>"
                                        title="Excluir" class="dropdown-item btn btn-outline-danger btn-elevate btn-pill btn-elevate-air btn-sm"><i class="la la-trash"></i>
                                        Excluir</a>
                                    <a href="http://<?php echo APP_HOST; ?>/fornecedor/edicao/<?php echo $fornecedor->getFornecedor_Cod(); ?>"
                                        title="Status" class="dropdown-item btn btn-outline-warning btn-elevate btn-pill btn-elevate-air btn-sm"><i class="la la-leaf"></i> Status</a>
                                    <a href="http://<?php echo APP_HOST; ?>/fornecedor/edicao/<?php echo $fornecedor->getFornecedor_Cod(); ?>"
                                        title="Relatorios" class="dropdown-item btn btn-outline-info btn-elevate btn-pill btn-elevate-air btn-sm"><i class="la la-print"></i>
                                        Relatorio</a>
                                </div>
                            </div>
                    </div>
                    </td>
        <?php
                            }
                       
                        ?>
                </tr>
            </tbody>

        </table>
                 
                    <?php
                           
                        }else {

                            echo "<center><h3 class='kt-portlet__head-title'><p class='text-danger'>Nenhum Dado Encontrado!</p></h3>";

                            echo "<div class='kt-error_container'><img src='http://". APP_HOST."/public/assets/media/logos/alanti_logo.png' style='width: 400px; height: 250px;' alt='ALANTI' > </div>";
                        }
                        ?>
    
        <!--end: Datatable -->
    </div>
</div>
</div>

<!-- end:: Content -->
</div>