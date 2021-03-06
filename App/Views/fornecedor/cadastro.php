<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h1 class="kt-portlet__head-title">
                    CADASTRO DE FORNECEDORES
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
                        <a class="nav-link " data-toggle="tab" href="#kt_builder_endereco" role="tab">
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
                            Observa????o
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/fornecedor/salvar"
            method="post" id="form_cadastro" enctype="multipart/form-data">
            <div class="kt-portlet__body">
                    <input type="hidden" class="form-control" name="fk_instituicao" id="fk_instituicao"
                        value="<?php echo $_SESSION['idInstituicao']; ?>" required>
                    <input type="hidden" class="form-control" name="usuario" id="usuario"
                        value="<?php echo $_SESSION['id']; ?>" required>                
                <div class="tab-content">
                    <div class="tab-pane  active" id="kt_builder_principal">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-2">
                                <label for="cnpj" class=""><span class="text-danger">* </span>Numero do CNPJ/CPF:</label>
                                    <div class="input-group">                                       
                                        <input type="text" class="form-control" placeholder="Digite o numero do CNPJ"
                                        id="cnpj" name="cnpj" onkeyup="validarCnpj()"
                                            value="<?php echo $Sessao::retornaValorFormulario('cnpj'); ?>" required>
                                        <div class="input-group-prepend">
                                            <a href="#" id="buscarCNPJ" class="btn btn-outline-success btn-elevate btn-icon btn-pill btn-elevate-air" 
                                            title="Buscar Cnpj receita"><i class="la la-search"></i></a>
                                        </div>
                                    </div>
                                    <span class="form-text text-muted">Digite o numero do CNPJ</span>
                                </div>
                                <div class="col-lg-6">
                                    <label for="razaoSocial"><span class="text-danger">* </span>Razao Social</label>
                                    <input type="text" class="form-control"
                                        placeholder="Digite a Razao Social" id="razaoSocial"
                                        name="razaoSocial"
                                        value="<?php echo $Sessao::retornaValorFormulario('razaoSocial'); ?>" required>
                                    <span class="form-text text-muted">Por favor insira a Razao Social</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for="nomeFantasia"><span class="text-danger">* </span>Nome Fantasia:</label>
                                    <input type="text" class="form-control" placeholder="Digite o Nome Fantasia"
                                        id="nomeFantasia" name="nomeFantasia"
                                        value="<?php echo $Sessao::retornaValorFormulario('nomeFantasia'); ?>" required>
                                    <span class="form-text text-muted">Por favor insira o Nome Fantasia</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-2">
                                    <label for="forIe" class="">Numero da Insc. Estad: </label>
                                    <input type="text" class="form-control" placeholder="Digite o numero da Insc. Estadual"
                                        id="forIe" name="forIe"
                                        value="<?php echo $Sessao::retornaValorFormulario('forIe'); ?>">
                                    <span class="form-text text-muted">Digite o numero da Insc. Estadual</span>
                                </div>                                
                                <div class="col-lg-3">
                                    <label for="forTipo"><span class="text-danger">* </span>Tipo Fornecedor</label>
                                    <div class="input-group">
                                        <select class="form-control" name="forTipo" id="forTipo"
                                            value="<?php echo $Sessao::retornaValorFormulario('forTipo'); ?>"
                                            required>
                                            <option value="">Tipo do Fornecedor</option>
                                            <option value="DISTRIBUIDOR">1 - DISTRIBUIDOR</option>                                           
                                            <option value="INDUSTRIA">2 - INDUSTRIA</option>
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Digite o tipo</span>
                                </div>
                                <div class="col-lg-3">
                                        <label for="status"><span class="text-danger">* </span>Status</label>
                                        <select class="form-control" name="status" id="status" required>
                                        <option value="">Selecione o Status</option>
                                                <?php foreach ($viewVar['listarStatus'] as $situacoes) : ?>
                                                <option value="<?php echo $situacoes->getSitId(); ?>"
                                                <?php echo ($Sessao::retornaValorFormulario('status') == $situacoes->getSitId()) ? "selected" : ""; ?>>
                                                <?php echo $situacoes->getSitNome(); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        <span class="form-text text-muted">Informar o Status</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for="forTipopessoa"><span class="text-danger">* </span>Tipo Pessoa</label>
                                    <div class="kt-radio-inline">
                                        <label for="forTipopessoa" class="kt-radio kt-radio--solid">
                                            <input type="radio" id="forTipopessoa" name="forTipopessoa" checked
                                                title="Pessoa Juridica" value="JURIDICA"> J
                                            <span></span></label>
                                        <label class="kt-radio kt-radio--solid">
                                            <input type="radio" id="forTipopessoa" name="forTipopessoa" title="Pessoa Fisica"
                                                value="FISICA"> F
                                            <span></span></label>
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
                                                value="<?php echo $Sessao::retornaValorFormulario('contato'); ?>"
                                                placeholder="Entre com contato">
                                        </div>
                                        <span class="form-text text-muted">Favor informar contato</span>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="" for="cargo">Cargo/ Fun????o:</label>
                                        <div class="input-group">                                    
                                            <div class="input-group-prepend"><span class="input-group-text"> <i class="la la-user"></i></span></div>
                                            <input type="text" id="cargo" name="cargo" class="form-control"
                                            value="<?php $Sessao::retornaValorFormulario('cargo');?>"
                                            placeholder="Entre com cargo/ fun??ao">
                                        </div>
                                        <span class="form-text text-muted">Favor informar Cargo/ Fun????o</span>
                                    </div>
                                    <div class="col-lg-2">
                                        <label class="" for="telefone">Telefone:</label>
                                        <div class="input-group">                                    
                                            <div class="input-group-prepend"><span class="input-group-text"> <i class="la la-phone"></i></span></div>
                                            <input type="text" id="telefone" name="telefone" class="form-control" 
                                                value="<?php echo $Sessao::retornaValorFormulario('telefone'); ?>"
                                                placeholder="Entre com telefone">
                                        </div>
                                        <span class="form-text text-muted">Favor informar telefone</span>
                                    </div>
                                    <div class="col-lg-2">
                                        <label class="" for="celular">Celular:</label>
                                        <div class="input-group">                                    
                                            <div class="input-group-prepend"><span class="input-group-text"> <i class="la la-mobile"></i></span></div>
                                            <input type="text" id="celular" name="celular" class="form-control" 
                                                value="<?php echo $Sessao::retornaValorFormulario('celular'); ?>"
                                                placeholder="Entre com celular">                                        
                                        </div>
                                        <span class="form-text text-muted">Favor informar celular</span>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="" for="email">Email:</label>
                                        <div class="input-group">                                    
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="la la-envelope"></i></span></div>
                                            <input type="text" id="email" name="email" class="form-control" 
                                                value="<?php echo $Sessao::retornaValorFormulario('email'); ?>"
                                                placeholder="Entre com email">
                                        </div>
                                        <span class="form-text text-muted">Favor informar e-mail</span>
                                    </div>                            
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="kt_builder_endereco">
                        <input type="hidden" id="forPessoa" name="forPessoa"
                            value="<?php echo $Sessao::retornaValorFormulario('forPessoa'); ?>" class="form-control">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-8">
                                    <label for="longradouro">Longradouro:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="longradouro" name="longradouro" class="form-control"
                                            value="<?php echo $Sessao::retornaValorFormulario('longradouro'); ?>"
                                            placeholder="Entre com longradouro">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-map-marker"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar longradouro</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for="numero">Numero:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="numero" name="numero" class="form-control"
                                            value="<?php echo $Sessao::retornaValorFormulario('numero'); ?>"
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
                                            value="<?php echo $Sessao::retornaValorFormulario('bairro'); ?>"
                                            placeholder="Entre com bairro">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-bookmark-o"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar bairro</span>
                                </div>                               
                                <div class="col-lg-3">
                                    <label for="cidade" class=""><span class="text-danger">* </span>Cidade:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" name="cidade-autocomplete" id="cidade-autocomplete"
                                            class="form-control" placeholder="Cidade - autocomplete"
                                            value=<?php echo $viewVar['fornecedor']->getEndCidade()->getCidNome(); ?>>

                                        <input type="hidden" id="cidade" name="cidade"
                                            value=<?php echo $viewVar['fornecedor']->getEndCidade()->getCidId(); ?>>
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-bookmark-o"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar cidade</span>
                                </div>
                                <div class="col-lg-3">
                                    <label for="complemento" class="">Complemento:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="complemento" name="complemento" class="form-control"
                                            value="<?php echo $Sessao::retornaValorFormulario('complemento'); ?>"
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
                                            value="<?php echo $Sessao::retornaValorFormulario('cep'); ?>"
                                            placeholder="Entre com cep"><span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
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
                                            value="<?php echo $Sessao::retornaValorFormulario('pontoreferencia'); ?>"
                                            class="form-control" placeholder="Entre com ponto de referencia">
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
                                    <label class="" for="cnt_cargo">Cargo/ Fun????o:</label>
                                    <input type="text" id="cnt_cargo" name="cnt_cargo" class="form-control"
                                        value="<?php $Sessao::retornaValorFormulario('cnt_cargo');?>"
                                        placeholder="Entre com telefone">
                                    <span class="form-text text-muted">Favor informar Cargo/ Fun????o</span>
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
                                    <label for="btnAdicionarContato" class="">Salvar:</label>
                                    <a class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air form-control"
                                        name="btnAdicionarContato" id="btnAdicionarContato">Adicionar</a>
                                </div>
                            </div>                           
                        </div>
                        <div class="kt-portlet__body">
                                <!--begin: Datatable -->
                                <table class="table table-striped table-bordered table-hover table-checkable"
                                    id="kt_table_3">
                                    <thead>
                                        <tr>
                                            <th class="text-center">CONTATO</th>
                                            <th class="text-center">CARGO/ FUN????O</th>
                                            <th class="text-center">EMAIL</th>
                                            <th class="text-center">TELEFONE</th>
                                            <th class="text-center">CELULAR</th>
                                            <th class="text-center">ACOES</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">CONTATO</th>
                                            <th class="text-center">CARGO/ FUN????O</th>
                                            <th class="text-center">EMAIL</th>
                                            <th class="text-center">TELEFONE</th>
                                            <th class="text-center">CELULAR</th>
                                            <th class="text-center">ACOES</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td><input type="hidden" value="" name="contatos[]"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end: Datatable -->                            
                            </div>
                    </div>  
                    <div class="tab-pane" id="kt_builder_observacao">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label for="forObservacao">Observacao:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"></div>
                                        <textarea type="text" id="forObservacao" rows="5" name="forObservacao"
                                            class="form-control"
                                            value="<?php $Sessao::retornaValorFormulario('forObservacao');?>"
                                            placeholder="Entre com observacao"></textarea>
                                    </div>
                                    <span class="form-text text-muted">Favor informar observacao</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p><span class="text-danger">* </span>Campos obrigat??rios</p>
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
                                class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air">Gravar</button>
                            <a href="http://<?php echo APP_HOST; ?>/fornecedor"
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
<!-- end:: Content -->
</div>
<!-- footer -->