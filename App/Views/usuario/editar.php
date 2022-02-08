<div class="container">
    <br>
    <center>
        <h3>Editar Usuario</h3>
    </center>
    <?php if ($Sessao::retornaMensagem()) { ?>
    <div class="alert alert-warning" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $Sessao::retornaMensagem(); ?>
    </div>
    <?php } ?>
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/usuario/atualizar" method="post"
        id="form_cadastro" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['usuario']->getId(); ?>">
        <input type="hidden" class="form-control" name="fk_instituicao" id="fk_instituicao"
            value="<?php echo $_SESSION['idInstituicao']; ?>" required>
        <div class="kt-portlet__body">
            
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="nome do usuario"
                            value="<?php echo $viewVar['usuario']->getNome(); ?>" required>
                            <span class="form-text text-muted">Por favor insira o nome do usuario</span>  
                    </div>
                    <div class="col-lg-3">
                        <label>Primeiro Nome:</label>
                        <input type="text" class="form-control" placeholder="Digite nome que deseja ser chamado" id="apelido" name="apelido"
                            value="<?php echo $viewVar['usuario']->getApelido(); ?>" required>
                        <span class="form-text text-muted">Digite primeiro nome</span>
                    </div>   
                    <div class="col-lg-3">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                            value="<?php echo $viewVar['usuario']->getEmail(); ?>" required>
                            <span class="form-text text-muted">Por favor insira o e-mail</span> 
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="id_dep">Departamento</label>
                        <select class="form-control" name="id_dep" required>
                            <option value="">Selecione a Departamento</option>
                            <?php foreach ($viewVar['listaDepartamentos'] as $departamento) : ?>
                            <option value="<?php echo $departamento->getId(); ?>"
                                <?php echo ($viewVar['usuario']->getDepartamento()->getId() == $departamento->getId()) ? "selected" : ""; ?>>
                                <?php echo $departamento->getNome(); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="form-text text-muted">Por favor insira o departamento</span> 
                    </div>
                    <div class="col-lg-4">
                        <label for="dica">Dica</label>
                        <input type="text" class="form-control" name="dica" id="dica" placeholder="Dida de senha"
                            value="<?php echo $viewVar['usuario']->getDica(); ?>" required>
                            <span class="form-text text-muted">Por favor insira a dica de senha</span> 
                    </div>
                    <div class="col-lg-2">
                        <label class="">Senha:</label>
                        <input type="password" class="form-control" placeholder="Digite o senha" id="senha" name="senha">
                        <span class="form-text text-muted">Por favor insira sua senha</span>
                    </div>
                    <div class="col-lg-2">
                        <label for="nivel">Nivel do Usuario</label>
                        <div class="input-group">
                            <select class="form-control" name="nivel" id="nivel">
                                <option value="">Selecione o nivel</option>
                                <option value="<?php echo $viewVar['usuario']->getNivel(); ?>"
                                    <?php echo ($viewVar['usuario']->getNivel() == $viewVar['usuario']->getNivel()) ? "selected" : ""; ?>>
                                    <?php echo $viewVar['usuario']->getNivel(); ?> </option>
                                    <?php if($_SESSION['nivel'] == 1){ ?>
                                        <option value="1">1 - Administrador</option>
                                        <option value="2">2 - Usuario</option>
                                    <?php } ?>
                            </select>
                        </div>
                        <span class="form-text text-muted">Por favor insira o nivel</span> 
                    </div>
                    <div class="col-lg-2">
                        <label for="status">Status do Usuario</label>
                        <div class="input-group">
                            <select class="form-control" name="status" id="status" readonly="readonly">
                                <option value="">Selecione o Status</option>
                                     <option value="<?php echo $viewVar['usuario']->getSituacoes()->getSitId(); ?>"
                                    <?php echo ($viewVar['usuario']->getSituacoes()->getSitId() == $viewVar['usuario']->getSituacoes()->getSitId()) ? "selected" : ""; ?>>
                                    <?php echo $viewVar['usuario']->getSituacoes()->getSitId(); ?> </option>
                                <option value="1">1 - Ativo</option>
                                <option value="2" selected >2 - Desativado</option>
                            </select>
                        </div>
                            <span class="form-text text-muted">Por favor insira o status</span> 
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-8">
                                <button type="submit"
                                    class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air">Salvar</button>
                                <a href="http://<?php echo APP_HOST; ?>/usuario"
                                    class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
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