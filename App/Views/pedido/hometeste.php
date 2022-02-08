<div class="content">
	<div class="container-fluid">
		<div class="row">
		<h3 class="panel-title text-center">INFORMACOES DE PEDIDOS</h3><br>
			<div class="col-sm-3 text-center">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Recebidas</h3>
					</div>
					<div class="panel-body" onclick="window.location.href = 'pedido.php'" style="cursor:pointer">
						<h3 id="pedidoTodos"> <?php ?></h3>
					</div>
				</div>
			</div>
			<div class="col-sm-3 text-center">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">Atendidos</h3>
					</div>
					<div class="panel-body" onclick="window.location.href = 'pedidoAtendido.php'" style="cursor:pointer">
						<h3 id="pedidoAtendido"><?php   ?></h3>
					</div>
				</div>
			</div>
			<div class="col-sm-3 text-center">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<h3 class="panel-title">Negados</h3>
					</div>
					<div class="panel-body" onclick="window.location.href = 'pedidoCancelado.php'" style="cursor:pointer">
						<h3 id="pedidoCancelado"><?php   ?></h3>
					</div>
				</div>
			</div>
			<div class="col-sm-3 text-center">
				<div class="panel panel-yellow">
					<div class="panel-heading">
						<h3 class="panel-title">Pendentes</h3>
					</div>
					<div class="panel-body" onclick="window.location.href = 'pedidoPendente.php'" style="cursor:pointer">
						<h3 id="pedidoPendente"><?php ?></h3>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="panel-body">
					<div id="graficoPedido" style="width: 600px; height: 300px;"></div> <br>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel-body">
					<div id="graficoPedido1" style="width: 600px; height: 300px;"></div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Lista de clientes Top 5</h3>
					</div>
					<div class="panel-body">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Título</th>
									<th>Pedido</th>
									<th class="hidden-xs">Ações</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<a href="pedido.php"><?php  ?></a>
									</td>
									<td>
										<a href="pedido.php"><a href="#"><?php  ?></a></a>
									</td>
									<td class="hidden-xs">
										<a class="btn btn-xs btn-info" href="#">Detalhes</a>
									</td>
								</tr>
								<tr>
									<td>
										<a href="pedido.php"><a href="#"><?php  ?></a></a>
									</td>
									<td>
										<a href="pedido.php"><a href="#"><?php  ?></a></a>
									</td>
									<td class="hidden-xs">
										<a class="btn btn-xs btn-info" href="#">Detalhes</a>
									</td>
								</tr>
								<tr>
									<td>
										<a href="pedido.php"><a href="#"><?php  ?></a></a>
									</td>
									<td>
										<a href="pedido.php"><a href="#"><?php  ?></a></a>
									</td>
									<td class="hidden-xs">
										<a class="btn btn-xs btn-info" href="#">Detalhes</a>
									</td>

								</tr>
								<tr>
									<td>
										<a href="pedido.php"><a href="#"><?php  ?></a></a>
									</td>
									<td>
										<a href="pedido.php"><a href="#"><?php  ?></a></a>
									</td>
									<td class="hidden-xs">
										<a class="btn btn-xs btn-info" href="#">Detalhes</a>
									</td>
								</tr>
								<tr>
									<td>
										<a href="pedido.php"><?php  ?></a>
									</td>
									<td>
										<a href="pedido.php"> <?php  ?></a>
									</td>
									<td class="hidden-xs">
										<a class="btn btn-xs btn-info" href="#">Detalhes</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

			</div>
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Categorias</h3>
					</div>
					<div class="panel-body">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Nome</th>
									<th class="hidden-xs">Ações</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>									
										<a href="cad_status.php"><?php  ?></a>																										
									</td>
									<td class="hidden-xs">
										<a class="btn btn-xs btn-info" href="#">Editar</a>
									</td>
								</tr>
								<tr>
									<td>
									<a href="cad_status.php"><?php  ?></a>																										
									</td>
									<td class="hidden-xs">
										<a class="btn btn-xs btn-info" href="#">Editar</a>
									</td>
								</tr>
								<tr>
									<td>
									<a href="cad_status.php"><?php  ?></a>																										
									</td>
									<td class="hidden-xs">
										<a class="btn btn-xs btn-info" href="#">Editar</a>
									</td>
								</tr>
								<tr>
									<td>
									<a href="cad_status.php"><?php  ?></a>																										
									</td>
									<td class="hidden-xs">
										<a class="btn btn-xs btn-info" href="#">Editar</a>
									</td>
								</tr>
								<tr>
									<td>
									<a href="cad_status.php"><?php  ?></a>																										
									</td>
									<td class="hidden-xs">
										<a class="btn btn-xs btn-info" href="#">Editar</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>