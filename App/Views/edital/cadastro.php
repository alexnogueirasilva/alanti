<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h1 class="kt-portlet__head-title">
                    CADASTRO DE EDITAIS
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
                        <a class="nav-link " data-toggle="tab" href="#kt_builder_anexos" role="tab">
                            Anexos
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    <!--begin::Portlet
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/edital/salvar" method="post"
        id="form_cadastro" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="fk_instituicao" id="fk_instituicao"
            value="<?php echo $_SESSION['inst_id']; ?>" required>
        <input type="hidden" class="form-control" name="edtUsuario" id="edtUsuario"
            value="<?php echo $_SESSION['id']; ?>" required>
        <input type="hidden" class="form-control" name="dataCadastro" id="dataCadastro"
            value="<?php echo $dataAtual; ?>" required>
        <div class="kt-portlet__body">
            <input type="hidden" class="form-control" name="idCliente" id="idCliente" required>
            <div class="kt-portlet__body">
            <div class="tab-content">
                    <div class="tab-pane  active" id="kt_builder_principal">
                <div class="form-group">
                    <label for="cadastroCliente" class="">CADASTRO DO CLIENTE</label>
                    <a href="http://<?php echo APP_HOST; ?>/clienteLicitacao/cadastro" id="cadastroCliente"
                        name="cadastroCliente" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                        <i class="la la-plus"></i>Novo Cliente</a>
                    <div>
                        <input type="text" name="clienteLicitacaoAutocomplete" id="clienteLicitacao-autocomplete"
                            class="form-control" required placeholder="Cliente - autocomplete"
                            value="<?php echo $viewVar['edital']->getClienteLicitacao()->getRazaoSocial(); ?>">

                        <input type="hidden" id="cliente" name="cliente"
                            value="<?php echo $viewVar['edital']->getClienteLicitacao()->getCodCliente(); ?>">
                    </div>
                    <span class="form-text text-muted">Por favor insira o cliente</span>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="modalidade">Modalidade</label>
                        <!--select class="form-control" name="modalidade" id="modalidade" required>
                             <option value="< ?php echo $Sessao::retornaValorFormulario('modalidade'); ?>"
                            < ?php echo ($Sessao::retornaValorFormulario('modalidade') == $Sessao::retornaValorFormulario('modalidade')) ? "selected" : ""; ?>>
                            < ?php echo $Sessao::retornaValorFormulario('modalidade'); ?> </option-->  
                            <select  class="form-control" name="modalidade"
                            value="<?php echo $Sessao::retornaValorFormulario('modalidade'); ?>" required >
                            <option value="">Selecione a Modalidade</option>
                            <option value="Eletronico">Eletronico</option>
                            <option value="Presencial">Presencial</option>
                            <option value="Concorrencia">Concorrencia</option>
                            <option value="Convite">Convite</option>
                            <option value="Dispensa">Dispensa</option>
                        </select>
                        <span class="form-text text-muted">Por favor insira o Modalidade</span>
                    </div>
                    <div class="col-lg-2">
                        <label for="numeroLicitacao">Numero da Licitacao:</label>
                        <input type="text" class="form-control" placeholder="Digite numero da licitacao"
                            id="numeroLicitacao" name="numeroLicitacao"
                            value="<?php echo $Sessao::retornaValorFormulario('numeroLicitacao'); ?>" required>
                        <span class="form-text text-muted">Digite o numero da licitacao</span>
                    </div>
                    <div class="col-lg-2">
                        <label for="garantia">Garantia</label>
                        <!-- select class="form-control" name="garantia" >
                            <option value="< ?php echo $Sessao::retornaValorFormulario('garantia'); ?>"
                                < ?php echo ($Sessao::retornaValorFormulario('garantia') == $Sessao::retornaValorFormulario('garantia')) ? "selected" : ""; ?>>
                                < ?php echo $Sessao::retornaValorFormulario('garantia'); ? > </option --> 
                             <select  class="form-control" name="garantia"
                                value="<?php echo $Sessao::retornaValorFormulario('garantia'); ?>" required >
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
                    <div class="col-lg-2">
                        <label for="codRepresentante">Representante</label>
                        <select class="form-control" id="codRepresentante" name="codRepresentante" required>
                            <option value="">Selecione o Representante</option>
                            <?php foreach ($viewVar['listarRepresentantes'] as $representante) : ?>
                            <option value="<?php echo $representante->getCodRepresentante(); ?>"
                                <?php echo ($Sessao::retornaValorFormulario('codRepresentante') == $representante->getCodRepresentante()) ? "selected" : ""; ?>>
                                <?php echo $representante->getNomeRepresentante(); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="form-text text-muted">Por favor insira o Representante</span>
                    </div>
                    <div class="col-lg-2">
                                <label for="disputa">Modo Disputa</label>
                                <select class="form-control" id="disputa" name="disputa" 
                                value="<?php echo $Sessao::retornaValorFormulario('disputa'); ?>" required >
                                    <option value="">Selecione Disputa</option>           
                                    <option value="ABERTO">ABERTO</option>
                                    <option value="ABERTO E FECHADO">ABERTO E FECHADO</option>
                                    <option value="RANDOMICO">RANDOMICO</option>
                                    <option value="OUTROS">OUTROS</option>
                                </select>
                                <span class="form-text text-muted">Por favor Modo Disputa</span>
                            </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="dataAbertura" class="">Data de Abertura:</label>
                        <input type="date" class="form-control" placeholder="Digite a Data de Abertura"
                            id="dataAbertura" name="dataAbertura"
                            value="<?php echo $Sessao::retornaValorFormulario('dataAbertura'); ?>" required>
                        <span class="form-text text-muted">Digite a Data de Abertura</span>
                    </div>
                    <div class="col-lg-2">
                        <label for="hora" class="">Hora:</label>
                        <input type="time" class="form-control" placeholder="Digite a Hora de Abertura" id="hora"
                            name="hora" value="<?php echo $Sessao::retornaValorFormulario('hora'); ?>" required>
                        <span class="form-text text-muted">Digite a Hora de Abertura</span>
                    </div>
                    <div class="col-lg-2">
                        <label for="tipo">Tipo</label>
                        <!--select class="form-control" name="tipo" required>
                             <option value="< ?php echo $Sessao::retornaValorFormulario('tipo'); ?>"
                                < ?php echo ($Sessao::retornaValorFormulario('tipo') == $Sessao::retornaValorFormulario('tipo')) ? "selected" : ""; ?>>
                                < ?php echo $Sessao::retornaValorFormulario('tipo'); ?> </option --> 
                            <select  class="form-control" name="tipo"
                            value="<?php echo $Sessao::retornaValorFormulario('tipo'); ?>" required >
                            <option value="">Selecione o Tipo</option>
                            <option value="Por Item">Por Item</option>
                            <option value="Por Lote">Por Lote</option>>
                            <option value="Por Lote/ Item">Por Lote/ Item</option>>
                        </select>
                        <span class="form-text text-muted">Por favor insira o Tipo</span>
                    </div>
                    <div class="col-lg-2">
                        <label for="operador">Operador</label>
                        <select class="form-control" id="operador" name="operador" required>
                            <option value="">Operador</option>
                            <?php foreach ($viewVar['listarUsuarios'] as $usuario) : ?>
                            <option value="<?php echo $usuario->getId(); ?>"
                                <?php echo ($Sessao::retornaValorFormulario('operador') == $usuario->getId()) ? "selected" : ""; ?>>
                                <?php echo $usuario->getApelido(); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="form-text text-muted">Por favor operador</span>
                    </div>
                    <div class="col-lg-2">
                        <label for="portal">Portal</label>
                        <select class="form-control" name="portal" required>
                            <option value="">Selecione portal</option>
                            <option value="BBMNET ">BBMNET </option>
                            <option value="BLL">BLL</option>
                            <option value="BNC">BNC</option>
                            <option value="PUBLINEXO">PUBLINEXO</option>
                            <option value="COMPRASNET">COMPRASNET</option>
                            <option value="LICITACOES-E">LICITACOES-E</option>
                            <option value="LICITANET">LICITANET</option>
                            <option value="PE INTEGRADO">PE INTEGRADO</option>
                            <option value="BANRISUL">BANRISUL</option>
                            <option value="E-MUNICIPIO">E-MUNICIPIO</option>
                            <option value="COMPRAS RS">COMPRAS RS</option>
                            <option value="COMPRAS PUBLICAS">COMPRAS PUBLICAS</option>
                            <option value="OUTRO">OUTRO</option>
                        </select>
                        <span class="form-text text-muted">Por favor portal</span>
                    </div>
                    <div class="col-lg-2">
                        <label for="identificador" class="">Id Portal:</label>
                        <input type="text" class="form-control" title="favor informar o numero identificador no portal"
                            placeholder="Id Portal" id="identificador" name="identificador"
                            value="<?php echo $Sessao::retornaValorFormulario('identificador'); ?>">
                        <span class="form-text text-muted">Digite o numero Id Portal</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="proposta" class="">Proposta:</label>
                        <input type="text" class="form-control" placeholder="Digite a Proposta" id="proposta"
                            name="proposta" value="<?php echo $Sessao::retornaValorFormulario('proposta'); ?>">
                        <span class="form-text text-muted">Digite o numero da Proposta</span>
                    </div>
                    <div class="col-lg-2">
                        <label for="dataLimite" class="">Data de Limite:</label>
                        <input type="date" class="form-control" placeholder="Digite a Data de Limite" id="dataLimite"
                            name="dataLimite" value="<?php echo $Sessao::retornaValorFormulario('dataLimite'); ?>"
                            required>
                        <span class="form-text text-muted">Digite Data Limite</span>
                    </div>
                    <div class="col-lg-1">
                        <label for="horaLimite" class="">Hora Limite:</label>
                        <input type="time" class="form-control" placeholder="Digite a Hora Limite" id="horaLimite"
                            name="horaLimite" value="<?php echo $Sessao::retornaValorFormulario('horaLimite'); ?>"
                            required>
                        <span class="form-text text-muted">Digite a Hora Limite</span>
                    </div>
                    <div class="col-lg-2">
                                <label for="valor" class="">Valor:</label>
                                <input type="text" class="form-control" placeholder="Digite a valor" id="valor"
                                    name="valor" value="<?php echo $Sessao::retornaValorFormulario('valor'); ?>">
                                <span class="form-text text-muted">Digite o numero da Proposta</span>
                            </div>
                    <div class="col-lg-2">
                        <label for="codInstituicao">Empresa</label>
                        <select class="form-control" id="codInstituicao" name="codInstituicao" required>
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
                        <span class="form-text text-muted">Selecione o arquivo</span>
                    </div>
                </div>
                 <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="observacao" class="">Observacao do Edital:</label>
                        <textarea class="form-control" rows="3" placeholder="Digite Observacao do Edital"
                            id="observacao" name="observacao"
                            value=""><?php echo $Sessao::retornaValorFormulario('observacao'); ?></textarea>
                        <span class="form-text text-muted">Digite Observacao do Edital</span>
                    </div>
                    <div class="col-lg-6">
                        <label for="analise" class="">Analise do Edital:</label>
                        <textarea class="form-control" rows="3" placeholder="Digite Analise do Edital" id="analise"
                            name="analise" value=""><?php echo $Sessao::retornaValorFormulario('analise'); ?></textarea>
                        <span class="form-text text-muted">Digite Analise do Edital</span>
                    </div>
                 </div>
                 <div class="col-lg-12" id="msgJustificarEdital">          
                </div>   
                <input type="hidden" id="txtJustificarEdital" name="txtJustificarEdital" value="<?php echo $Sessao::retornaValorFormulario('justificarEdital'); ?>"> 
                </div>
                 <div class="tab-pane" id="kt_builder_anexos">
                        <h3 class="kt-portlet__head-title"> EM DESENVOLVIMENTO </h3>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <input type="checkbox" id="enviarEmail" name="enviarEmail" value="1" checked>
                    <label>Deseja enviar Email?</label>
                    <!--input type="text" class="form-control" title="Digite o endereco de e-mail"
                            placeholder="email separado por virgula" id="email" name="email" disabled
                            value="< ?php echo $Sessao::retornaValorFormulario('eviarEmail'); ?>"-->

                            <select class="form-control m-select2" id="emails"  name="emails[]"
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
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-8">
                            <button type="submit"
                                class="btn  btn-outline-success btn-elevate btn-pill btn-elevate-air">Salvar</button>
                            <a href="http://<?php echo APP_HOST; ?>/edital"
                                class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                                <button type="submit" id="copiar" name="copiar" class="btn  btn-outline-warning btn-elevate btn-pill btn-elevate-air" value="copiar">Salvar e Copiar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--end::Form
    </div>-->
    <!--end::Portlet-->
    </div>
    <!--end::Portlet-->
    </div>
<!-- begin:: Content -->

<!-- footer -->