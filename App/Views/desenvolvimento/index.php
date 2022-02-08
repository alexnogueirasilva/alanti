<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
	
	<div class="kt-portlet kt-portlet--mobile">
		<form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/desenvolvimento/" method="post" id="form_cadastro" enctype="multipart/form-data">
            <h3 class="kt-portlet__head-title">
                Pesquisa de pedidos registrados
            </h3>
            <div class="kt-portlet__body">
                <button type="submit" class="btn btn-primary btn-elevate btn-pill btn-elevate-air">Pesquisar</button>
            </div>
        </form>
		<div class="kt-portlet__head kt-portlet__head--lg">
			<div class="kt-portlet__head-label">
				<span class="kt-portlet__head-icon">
					<i class="kt-font-brand flaticon2-line-chart"></i>
				</span>
				<h3 class="kt-portlet__head-title">
					Pesquisa de coluna individual
				</h3>
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
						<a href="http://<?php echo APP_HOST; ?>/desenvolvimento/cadastro" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
							<i class="la la-plus"></i>Cadastro</a>
					</div>
				</div>
			</div>
		</div>
		<div class="kt-portlet__body">
			<!--begin: Datatable -->
			<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_3">
				<thead>
					<tr>
						<th>CÓDIGO</th>						
						<th>USUARIO</th>
						<th>STATUS</th>
						<th>CADASTRO</th>
						<th>ALTERACAO</th>
						<th>Acoes</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>CÓDIGO</th>						
						<th>USUARIO</th>
						<th>STATUS</th>
						<th>CADASTRO</th>
						<th>ALTERACAO</th>
						<th>Acoes</th>
					</tr>
				</tfoot>
				<tbody>
					<?php
					 $dados = $viewVar['listarDesenvolvimentos'];
					 
					 if ($dados > 0) {
						 foreach ($dados as $dado) {
							 $qtdePedido += 1;
							 ?>
					<tr>
						<td><?php echo $dado->getDesId(); ?></td>
						<td><?php echo $dado->getDesUsuario()->getNome(); ?></td>
						<td><?php echo $dado->getDesStatus(); ?></td>					
						<td><?php echo $dado->getDesDataCadastro()->format('d/m/Y H:m:s'); ?></td>
						<td><?php echo $dado->getDesDataAlteracao()->format('d/m/Y H:m:s'); ?></td>
						<td>
						<span class="dropdown">
									<?php print_r('  teste '); ?>
								<a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" title="click aqui para exibir as acoes" aria-expanded="true"><i class="la la-ellipsis-h"></i></a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" type="button" id="btnEdtiarDesenvolvimento" href="http://<?php echo APP_HOST; ?>/desenvolvimento/cadastro/<?php echo $dado->getDesId(); ?>" title="Alterar" class="btn btn-info btn-sm"><i class="la la-edit"></i> Alterar</a>
									<a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/desenvolvimento/exclusao/<?php echo $dado->getDesId(); ?>" title="Excluir" class="btn btn-info btn-sm"><i class="la la-trash"></i> Excluir</a>
									<a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/desenvolvimento/visualizar/<?php echo $dado->getDesId(); ?>" title="visualizar" class="btn btn-info btn-sm"><i class="la la-leaf"></i> visualizar</a>
									<a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/desenvolvimento/edicao/<?php echo $dado->getDesId(); ?>" title="Alterar Status" class="btn btn-info btn-sm"><i class="la la-leaf"></i> Status</a>
									<a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/desenvolvimento/edicao/<?php echo $dado->getDesId(); ?>" title="Relatorios" class="btn btn-info btn-sm"><i class="la la-print"></i> Relatorio</a>
									<a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/<?php echo $dado->getDesAnexo(); ?>" target="_blank" title="Visualizar Anexo" class="btn btn-info btn-sm"><i class="la la-chain"></i> Anexo</a>
								</div>
							</span>
							<a type="button" id="btnEdtiarDesenvolvimento" href="http://<?php echo APP_HOST; ?>/desenvolvimento/edicao/<?php echo $dado->getDesId(); ?>" title="Editar" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-edit"></i></a>
							<a href="http://<?php echo APP_HOST; ?>/desenvolvimento/visualizar/<?php echo $dado->getDesId(); ?>" title="visualizar" class="btn btn-clean btn-icon btn-icon-md"><i class="la la-leaf"></i> </a>
							<a href="http://<?php echo APP_HOST; ?>/desenvolvimento/exclusao/<?php echo $dado->getDesId(); ?>" title="Excluir" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-trash"></i></a>
						</td>

						<?php
						}
					} else {
						echo "<h3 class='kt-portlet__head-title'><p class='text-danger'>Sem resultados encontrados!</p></h3>";
					}
					?>
						
					</tr>
				</tbody>
			</table>
			<!--end: Datatable -->
		</div>
	</div>
	<?php	
    echo "<h3 class='kt-portlet__head-title'><p class='text-info'>Qtde. de Registros " . $qtdePedido . " </p></h3>";
    ?>
</div>
<!-- end:: Content -->
</div>