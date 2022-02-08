<div class="content p-1">
        <?php if ($Sessao::retornaMensagem()) { ?>
            <div class="alert alert-warning" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $Sessao::retornaMensagem(); ?>
            </div>
        <?php } ?>
    <div class="list-group-item">
        <div class="d-flex">        
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Dashboard</h2>               								
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-lg-3 col-sm-6">
                <div class="card bg-success text-white">
                    <a style="color: white;"  href="http://<?php echo APP_HOST; ?>/ClienteLicitacao">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x"></i>
                        <h6 class="card-title">Clientes</h6>
                            <h2 class="lead"><?php  echo $this->Dados["clientesAtivos"][0]; ?> Ativos e 
                            <span class="lead " style="color: red;"> <?php  echo $this->Dados["clientesInativos"][0]; ?> Inativos</span>
                        </h2>
                    </div>
                </a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card bg-danger text-white">
                <a style="color: white;"  href="http://<?php echo APP_HOST; ?>/edital">
                    <div class="card-body">
                        <i class="fas fa-file fa-3x"></i>
                        <h6 class="card-title">Editais</h6>
                        <h2 class="lead"><?php echo $viewVar["EditaisFinalizados"][0]; ?> Finalizados e 
                        <span class="lead " style="color: orange;"> <?php echo $viewVar["EditaisPendentes"][0] ?> Pendentes</span></h2>
                    </div>
                </a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card bg-warning text-white">
                <a style="color: white;"  href="http://<?php echo APP_HOST; ?>/contrato">
                    <div class="card-body">
                        <i class="fas fa-eye fa-3x"></i>
                        <h6 class="card-title">Contratos</h6> 
                        <h2 class="lead" ><?php echo $viewVar["ContratosAtivos"]->getCtrNumero(); ?> Ativos e 
                        <span class="lead " style="color: red;"><?php echo $viewVar["ContratosVencidos"]->getCtrNumero(); ?> Vencidos</span></h2>
                    </div>
                </a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card bg-info text-white">
                <a style="color: white;"  href="http://<?php echo APP_HOST; ?>/notificacao">
                    <div class="card-body">
                        <i class="fas fa-comments fa-3x"></i>
                        <h6 class="card-title">Notificacao</h6>
                        <h2 class="lead">??</h2>
                    </div>
                </a>
                </div>
            </div>                     
        </div>
    </div>
    <hr class="featurette-divider">
    <div class="list-group-item">
       
        <div class="row mb-3">
        <div class="col-lg-3 col-sm-6">
                <div class="card bg-info text-white">
                <a style="color: white;"  href="http://<?php echo APP_HOST; ?>/sugestoes">
                    <div class="card-body">
                        <i class="fas fa-comments fa-3x"></i>
                        <h6 class="card-title">Sugestoes</h6>
                        <h2 class="lead"><?php echo $viewVar["SugestoesResolvidas"][0]; ?> Resolvidas e 
                        <span class="lead " style="color: red;"> <?php echo $viewVar["SugestoesPendentes"][0]; ?> Pendentes</span></h2>
                    </div>
                </a>
                </div>
            </div>   
           
            <div class="col-lg-3 col-sm-6">
                <div class="card bg-warning text-white">
                <a style="color: white;"  href="http://<?php echo APP_HOST; ?>/home">
                    <div class="card-body">
                        <i class="fas fa-eye fa-3x"></i>
                        <h6 class="card-title">Visitas</h6>
                        <h2 class="lead">648</h2>
                    </div>
                </a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card bg-success text-white">
                <a style="color: white;"  href="http://<?php echo APP_HOST; ?>/pedido">
                    <div class="card-body">
                        <i class="fas fa-file fa-3x"></i>
                        <h6 class="card-title">Pedidos</h6>
                        <h2 class="lead"><?php echo $viewVar["PedidosAutorizados"][0]; ?> Autorizados e 
                        <span class="lead " style="color: red;"> <?php echo $viewVar["PedidoNaoAutorizados"][0];?> Pendentes</span></h2>
                    </div>
                </a>
                </div>
            </div>
            
            <div class="col-lg-3 col-sm-6">
                <div class="card bg-primary text-white">
                <a style="color: white;"  href="http://<?php echo APP_HOST; ?>/logistica/rastreio">
                <div class="card-body">
                        <i class="fas fa-truck-moving fa-3x"></i>                        
                        <h6 class="card-title">Transporte</h6>
                        <h2 class="lead"><?php echo $viewVar["Entregues"][0]; ?> Entregues e 
                        <span class="lead " style="color: red;"> <?php echo $viewVar["Pendentes"][0];?> Pendentes</span></h2>
                    </div>
                </a>
                </div>
            </div>             
        </div>
    </div>
    <hr class="featurette-divider">
</div>
</div>