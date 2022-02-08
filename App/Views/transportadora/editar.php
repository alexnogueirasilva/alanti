<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">

                <h1 class="kt-portlet__head-title">
                    TRANSPORTADORA
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
            <?php if ($Sessao::retornaMensagem()) { ?>
            <div class="alert alert-warning" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $Sessao::retornaMensagem(); ?>
            </div>
            <?php } ?>
        </div>
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
                        <a class="nav-link" data-toggle="tab" href="#kt_builder_endereco" role="tab">
                            Endereco
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#kt_builder_contato" role="tab">
                            Contato
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#kt_builder_observacao" role="tab">
                            Observacao
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/transportadora/atualizar"
            method="post" id="form_cadastro" enctype="multipart/form-data">
            <input type="hidden" id="usuario" name="usuario" value="<?php echo $_SESSION['id']; ?>"
                class="form-control">
            <input type="hidden" id="codigo" name="codigo" value="<?php echo $viewVar['transportadora']->getTraId(); ?>"
                class="form-control">
            <input type="hidden" id="instituicao" name="instituicao" value="<?php echo $_SESSION['inst_id']; ?>"
                class="form-control">           
            <div class="kt-portlet__body">
                <div class="tab-content">
                    
                    <div class="tab-pane  active" id="kt_builder_principal">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                            <div class="col-lg-2">
                                    <label class="" for="cnpj"><span class="text-danger">* </span>Numero do CNPJ/CPF: </label>
                                    <div class="input-group"> 
                                        <input type="text" id="cnpj" name="cnpj" class="form-control"  onkeyup="validarCnpj()"
                                        value="<?php echo $viewVar['transportadora']->getTraCnpj(); ?>"
                                        placeholder="Entre com CNPJ" required>
                                        <div class="input-group-prepend">
                                            <a href="#" id="buscarCNPJ" class="btn btn-outline-success btn-elevate btn-icon btn-pill btn-elevate-air" 
                                            title="Buscar Cnpj receita"><i class="la la-search"></i></a>
                                        </div>
                                    </div>
                                    <span class="form-text text-muted">Favor informar CNPJ</span>
                                </div>
                                <div class="col-lg-6">
                                    <label for="razaoSocial"><span class="text-danger">* </span>Razão Social:</label>
                                    <input type="text" id="razaoSocial" name="razaoSocial"  class="form-control"
                                        value="<?php echo $viewVar['transportadora']->getTraRazaoSocial(); ?>"
                                        placeholder="Entre com Razão Social">
                                    <span class="form-text text-muted">Favor informar Razão Social</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for="nomeFantasia">Nome Fantasia:</label>
                                    <input type="text" id="nomeFantasia" name="nomeFantasia" 
                                        class="form-control"
                                        value="<?php echo $viewVar['transportadora']->getTraNomeFantasia(); ?>"
                                        placeholder="Entre com Nome Fantasia">
                                    <span class="form-text text-muted">Favor informar Nome Fantasia</span>
                                </div>
                            </div>
                            <div class="form-group row">                               
                                <div class="col-lg-4">
                                    <label for="inscricaoestadual">Insc. Estadual:</label>
                                    <input type="text" id="inscricaoestadual" name="inscricaoestadual" 
                                        value="<?php echo $viewVar['transportadora']->getTraIE(); ?>"
                                        class="form-control" placeholder="Insc. Estadual">
                                    <span class="form-text text-muted">Favor informar Insc. Estadual</span>
                                </div>
                                <div class="col-lg-3">
                                    <label for="status"><span class="text-danger">* </span>status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="">Selecione o status</option>
                                        <?php foreach ($viewVar['listarStatus'] as $situacoes) : ?>
                                        <option value="<?php echo $situacoes->getSitId(); ?>"
                                            <?php echo ($viewVar['transportadora']->getSituacoes()->getSitId() == $situacoes->getSitId()) ? "selected" : ""; ?>>
                                            <?php echo $situacoes->getSitNome(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="form-text text-muted">Por favor insira o status</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for="tipoPessoa"><span class="text-danger">* </span>Tipo Pessoa</label>
                                    <div class="kt-radio-inline">
                                        <?php if($viewVar['transportadora']->getPessoa()->getPesTipo() == "JURIDICA"){
                                        ?>
                                        <label for="tipoPessoa" class="kt-radio kt-radio--solid">
                                            <input type="radio" id="tipoPessoa" name="tipoPessoa" checked
                                                title="Pessoa Juridica" value="JURIDICA"> J
                                            <span></span></label>
                                        <label class="kt-radio kt-radio--solid">
                                            <input type="radio" id="tipoPessoa" name="tipoPessoa" title="Pessoa Fisica"
                                                value="FISICA"> F
                                            <span></span></label>
                                        <?php                                       
                                    }else{
                                        ?>
                                        <label for="tipoPessoa" class="kt-radio kt-radio--solid">
                                            <input type="radio" id="tipoPessoa" name="tipoPessoa"
                                                title="Pessoa Juridica" value="JURIDICA"> J
                                            <span></span></label>
                                        <label class="kt-radio kt-radio--solid">
                                            <input type="radio" id="tipoPessoa" name="tipoPessoa" checked
                                                title="Pessoa Fisica" value="FISICA"> F
                                            <span></span></label>
                                        <?php
                                    }
                                    ?>
                                    </div>
                                    <span class="form-text text-muted">Tipo de pessoa</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-2">
                                    <label for="contato">Contato:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="la la-user"></i></span></div>
                                        <input type="text" id="contato" name="contato" class="form-control" 
                                            value="<?php echo $viewVar['transportadora']->getTraContato(); ?>"
                                            placeholder="Entre com contato">
                                    </div>
                                    <span class="form-text text-muted">Favor informar contato</span>
                                </div>
                                <div class="col-lg-3">
                                    <label class="" for="cargo">Cargo/ Função:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="la la-user"></i></span></div>
                                    <input type="text" id="cargo" name="cargo" class="form-control"
                                    value="<?php echo $viewVar['transportadora']->getTraCargo(); ?>"
                                        placeholder="Entre com telefone">
                                    </div>
                                    <span class="form-text text-muted">Favor informar Cargo/ Função</span>
                                </div>
                                <div class="col-lg-2">
                                    <label class="" for="telefone">Telefone:</label>
                                    <div class="input-group">                                    
                                            <div class="input-group-prepend"><span class="input-group-text"> <i class="la la-phone"></i></span></div>
                                    <input type="text" id="telefone" name="telefone" class="form-control" 
                                        value="<?php echo $viewVar['transportadora']->getTraTelefone(); ?>"
                                        placeholder="Entre com telefone">
                                    </div>
                                    <span class="form-text text-muted">Favor informar telefone</span>
                                </div>
                                <div class="col-lg-2">
                                    <label class="" for="celular">Celular:</label>
                                    <div class="input-group">                                    
                                            <div class="input-group-prepend"><span class="input-group-text"> <i class="la la-mobile"></i></span></div>
                                        <input type="text" id="celular" name="celular" class="form-control" 
                                            value="<?php echo $viewVar['transportadora']->getTraCelular(); ?>"
                                            placeholder="Entre com celular">
                                    </div>
                                    <span class="form-text text-muted">Favor informar celular</span>
                                </div>
                                <div class="col-lg-3">
                                    <label class="" for="email">Email:</label>
                                    <div class="input-group">                                    
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="la la-envelope"></i></span></div>
                                            <input type="email" id="email" name="email" class="form-control" 
                                        value="<?php echo $viewVar['transportadora']->getTraEmail(); ?>"
                                        placeholder="Entre com email">
                                    </div>
                                    <span class="form-text text-muted">Favor informar email</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="kt_builder_endereco">
                        <input type="hidden" id="pessoa" name="pessoa"
                            value="<?php echo $viewVar['transportadora']->getTraPessoa(); ?>" class="form-control">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-8">
                                    <label for="longradouro">Longradouro:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="longradouro" name="longradouro" class="form-control"
                                            
                                            value="<?php echo $viewVar['transportadora']->getEndLongradouro(); ?>"
                                            placeholder="Entre com longradouro">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-map-marker"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar longradouro</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for="numero">Numero:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="number" id="numero" name="numero" class="form-control" 
                                            value="<?php echo $viewVar['transportadora']->getEndNumero(); ?>"
                                            placeholder="Entre com numero">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar numero</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="bairro" class="">Bairro:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="bairro" name="bairro" class="form-control" 
                                            value="<?php echo $viewVar['transportadora']->getEndBairro(); ?>"
                                            placeholder="Entre com bairro">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-bookmark-o"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar bairro</span>
                                </div>
                                <div class="col-lg-3">
                                    <label for="cidade" class="">Cidade:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" name="cidade-autocomplete" id="cidade-autocomplete"
                                            class="form-control" placeholder="Cidade - autocomplete"
                                            value="<?php echo $viewVar['transportadora']->getEndCidade()->getCidNome() ." - UF ".
                                            $viewVar['transportadora']->getEndCidade()->getEstado()->getEstUf(); ?>">

                                        <input type="hidden" id="cidade" name="cidade"
                                            value="<?php echo $viewVar['transportadora']->getEndCidade()->getCidId(); ?>">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-bookmark-o"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar cidade</span>
                                </div>
                                <div class="col-lg-3">
                                    <label for="complemento" class="">Complemento:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="complemento" name="complemento" class="form-control"
                                            value="<?php echo $viewVar['transportadora']->getEndComplemento(); ?>"
                                            placeholder="Entre com complemento">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-bookmark-o"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar complemento</span>
                                </div>
                                <div class="col-lg-2">
                                    <label for="cep" class="">CEP:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="cep" name="cep" class="form-control"
                                            value="<?php echo $viewVar['transportadora']->getEndCep(); ?>"
                                            placeholder="Entre com cep"> <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-bookmark-o"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar cep</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label for="pontoreferencia" class="">Ponto Referencia:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="pontoreferencia" name="pontoreferencia" 
                                            value="<?php echo $viewVar['transportadora']->getEndPontoReferencia(); ?>"
                                            class="form-control" placeholder="Entre com pontoreferencia">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-bookmark-o"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar referencia</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="kt_builder_contato">
                        <div class="kt-portlet__body">
                            <input type="hidden" class="form-control" name="contatoid" id="contatoid">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="cnt_contato">Contato:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="la la-user"></i></span></div>
                                        <input type="text" id="cnt_contato" name="cnt_contato" class="form-control"
                                            value="<?php $Sessao::retornaValorFormulario('cnt_contato');?>"
                                            placeholder="Entre com contato">
                                    </div>
                                    <span class="form-text text-muted">Favor informar contato</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="" for="cnt_cargo">Cargo/ Função:</label>
                                    <input type="text" id="cnt_cargo" name="cnt_cargo" class="form-control"
                                        value="<?php $Sessao::retornaValorFormulario('cnt_cargo');?>"
                                        placeholder="Entre com telefone">
                                    <span class="form-text text-muted">Favor informar Cargo/ Função</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="" for="cnt_email">E-mail:</label>
                                    <input type="text" id="cnt_email" name="cnt_email" class="form-control"
                                        value="<?php $Sessao::retornaValorFormulario('cnt_email');?>"
                                        placeholder="Entre com email">
                                    <span class="form-text text-muted">Favor informar email</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="" for="cnt_telefone">Telefone:</label>
                                    <input type="text" id="cnt_telefone" name="cnt_telefone" class="form-control"
                                        value="<?php $Sessao::retornaValorFormulario('cnt_telefone');?>"
                                        placeholder="Entre com telefone">
                                    <span class="form-text text-muted">Favor informar telefone</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="" for="cnt_celular">Celular:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="cnt_celular" name="cnt_celular" class="form-control"
                                            value="<?php $Sessao::retornaValorFormulario('cnt_celular');?>"
                                            placeholder="Entre com celular">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-info-circle"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar celular</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for="btnAdicionarAlterarContato" class="">Salvar:</label>
                                    <a type='button'
                                        class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air form-control"
                                        name="btnAdicionarAlterarContato" id="btnAdicionarAlterarContato">Adicionar</a>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <!--begin: Datatable -->
                                <table class="table table-striped table-bordered table-hover table-checkable"
                                    id="kt_table_3">
                                    <thead>
                                        <tr>
                                            <th class="text-center">CONTATO</th>
                                            <th class="text-center">CARGO/ FUNÇÃO</th>
                                            <th class="text-center">EMAIL</th>
                                            <th class="text-center">TELEFONE</th>
                                            <th class="text-center">CELULAR</th>
                                            <th class="text-center">USUARIO</th>
                                            <th class="text-center">ACOES</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">CONTATO</th>
                                            <th class="text-center">CARGO/ FUNÇÃO</th>
                                            <th class="text-center">EMAIL</th>
                                            <th class="text-center">TELEFONE</th>
                                            <th class="text-center">USUARIO</th>
                                            <th class="text-center">ACOES</th>
                                        </tr>
                                    </tfoot>
                                    <tbody id="tblcontatos">
                                        <tr>
                                            <!--carregamento de contato atraves do js contatos(teste) -->

                                        </tr>
                                    </tbody>
                                </table>
                                <!--end: Datatable -->                           
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="kt_builder_observacao">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label for="observacao">Observacao:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"></div>
                                        <textarea type="text" id="observacao" rows="5" name="observacao"
                                            class="form-control"
                                            placeholder="Entre com observacao"><?php echo $viewVar['transportadora']->getTraObservacao(); ?></textarea>
                                    </div>
                                    <span class="form-text text-muted">Favor informar observacao</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p><span class="text-danger">* </span>Campos obrigatórios</p>
                <div class="form-group row">
                        <div class="col-lg-12">
                            <input type="checkbox" id="enviarEmail" name="enviarEmail">
                            <label>Deseja enviar Email?</label>
                            <select class="form-control m-select2" id="emails" name="emails[]" multiple="multiple"
                                title="Selecione um ou mais o endereco de e-mail">
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
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-8">
                            <button type="submit"
                                class="btn btn-outline-warning btn-elevate btn-pill btn-elevate-air">Alterar</button>
                            <a type="button" id="btnVoltarTra" href='http://<?php echo APP_HOST; ?>/transportadora/'
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