<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <div class="kt-portlet kt-portlet--mobile">
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/clienteLicitacao/" method="post" id="form_cadastro" enctype="multipart/form-data">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                    <h3 class="kt-portlet__head-title">
                    Pesquisa de Clientes Cadastrados 
                    </h3>                   
            </div>
        </div>
            <div class="kt-portlet__body">                     
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="pesCliCodigo">Codigo:</label>
                        <input type="text" class="form-control" title="Digite o codido" placeholder="Código" id="pesCliCodigo" name="pesCliCodigo" value="<?php echo $Sessao::retornaValorFormulario('pesCliCodigo'); ?>">
                    </div>
                    <div class="col-lg-2">
                        <label for="pesCliRazaoSocial">Razao Social:</label>
                        <input type="text" class="form-control" title="Digite a Razao Social" placeholder="Razao Social" id="pesCliRazaoSocial" name="pesCliRazaoSocial" value="<?php echo $Sessao::retornaValorFormulario('pesRazaoSocial'); ?>">
                    </div>
                    <div class="col-lg-2">
                        <label for="pesCliNomeFantasia">Nome Fantasia:</label>
                        <input type="text" class="form-control" title="Digite o Nome Fantasia" placeholder="Nome Fantasia" id="pesCliNomeFantasia" name="pesCliNomeFantasia" value="<?php echo $Sessao::retornaValorFormulario('pesNomeFantasia'); ?>">
                    </div>
                    <div class="col-lg-2">
                        <label for="pesCliCnpj">CNPJ:</label>
                        <input type="text" class="form-control" title="Digite o CNPJ" placeholder="CNPJ/ CPF" id="pesCliCnpj"  name="pesCliCnpj" value="<?php echo $Sessao::retornaValorFormulario('pesCnpj'); ?>">
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group"><label for="pesCliStatus">Status</label>
                        <select class="form-control" name="pesCliStatus" id="pesCliStatus">
                            <option value="">Selecione o Status</option>
                            <option value="ATIVO">ATIVO</option>
                            <option value="INATIVO">INATIVO</option>
                        </select>
                        </div>
                    </div>                   
                    <div class="col-lg-2">
                        <div class="form-group"><label for="pesCliTipo">Tipo</label>
                        <select class="form-control" name="pesCliTipo" id="pesCliTipo">
                            <option value="">Selecione o Tipo</option>
                            <option value="Estadual">ESTADUAL</option>
                            <option value="Federal">FEDERAL</option>
                            <option value="Municipal">MUNICIPAL</option>
                            <option value="Particular">PARTICULAR</option>
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
                                        <a href="http://<?php echo APP_HOST; ?>/clienteLicitacao/excel" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                            <span class="kt-nav__link-text">Excel</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="http://<?php echo APP_HOST; ?>/clienteLicitacao/excel" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-text-o"></i>
                                            <span class="kt-nav__link-text">CSV</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="http://<?php echo APP_HOST; ?>/clienteLicitacao/pdf" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                            <span class="kt-nav__link-text">PDF</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        &nbsp;
                        <a href="http://<?php echo APP_HOST; ?>/clienteLicitacao/cadastro" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-plus"></i>
                            Novo Cliente
                        </a>                       
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
                <?php
                    $clienteLicitacao1 = $viewVar['listar']; 
                    if ($clienteLicitacao1 > 0) {                  
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
                        <th class="text-center">TROCA DE MARCA</th>
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
                        <th class="text-center">TROCA DE MARCA</th>
                        <th class="text-center">Acoes</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php                   
                    
                        foreach ($clienteLicitacao1 as $clienteLicitacao) {
                            ?>
                    <tr>
                        <td><?php echo $clienteLicitacao->getCodCliente(); ?></td>
                        <td><?php echo $clienteLicitacao->getRazaoSocial(); ?></td>
                        <td><?php echo $clienteLicitacao->getNomeFantasia(); ?></td>
						<td class="text-center"><?php echo $clienteLicitacao->getEndCidade()->getEstado()->getEstUf(); ?></td>
                        <td><?php echo $clienteLicitacao->getCnpj(); ?></td>
                        <td><?php echo $clienteLicitacao->getTipoCliente(); ?></td>
                        <td class="text-center"><span class="badge badge-pill badge-<?php echo $clienteLicitacao->getSituacoes()->getCors()->getCorCor(); ?>"><?php echo $clienteLicitacao->getSituacoes()->getSitNome(); ?></span></td>
                        <td class="text-center"><?php echo $clienteLicitacao->getTrocaMarca(); ?></td>
                        <td>
                            <span class="dropdown">
                                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true"><i class="la la-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/clienteLicitacao/edicao/<?php echo $clienteLicitacao->getCodcliente(); ?>" title="Editar" class="btn btn-info btn-sm"><i class="la la-edit"></i> Editar</a>
                                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/clienteLicitacao/exclusao/<?php echo $clienteLicitacao->getCodcliente(); ?>" title="Excluir" class="btn btn-info btn-sm"><i class="la la-trash"></i> Excluir</a>
                                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/clienteLicitacao/edicao/<?php echo $clienteLicitacao->getCodcliente(); ?>" title="Status" class="btn btn-info btn-sm"><i class="la la-leaf"></i> Status</a>
                                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/clienteLicitacao/edicao/<?php echo $clienteLicitacao->getCodcliente(); ?>" title="Relatorios" class="btn btn-info btn-sm"><i class="la la-print"></i> Relatorio</a>
									<a class="dropdown-item" href="#" data-codigocliente="<?php echo $clienteLicitacao->getCodcliente(); ?>" title="visualzar cliente" id="btnVisCliente" name="btnVisCliente" class="btn btn-info btn-sm"><i class="la la-print"></i> Visualizar</a>
                                </div>
                            </span>
                            <a href="http://<?php echo APP_HOST; ?>/clienteLicitacao/edicao/<?php echo $clienteLicitacao->getCodcliente(); ?>" title="Editar" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-edit"></i></a>
                            <a href="http://<?php echo APP_HOST; ?>/clienteLicitacao/exclusao/<?php echo $clienteLicitacao->getCodcliente(); ?>" title="Excluir" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-trash"></i></a>
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


<!-- Modal -->
<div class="modal fade" id="visCliente" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title text-white" id="visCliente">Detalhes Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>		  
        </button>
      </div>
      <div class="modal-body bg-light">
       <span id="visDadosCliente">&times;</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air" data-dismiss="modal">Fechar</button>
		<button type="button" class="btn btn-outline-danger btn-elevate btn-pill btn-elevate-air" id="btnExcluirGarantia">Excluir</button>
      </div>
    </div>
  </div>
</div>