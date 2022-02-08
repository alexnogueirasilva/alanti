<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h1 class="kt-portlet__head-title">
                    ALTERACAO DE EDITAL
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
                    <?php
                    $dados = $viewVar['garantias'];                                             
                if (!empty($dados)) { //se tiver garantia imprimi aba e as garantas                                                  
                   echo " <li class='nav-item'>
                        <a class='nav-link ' data-toggle='tab' href='#kt_builder_garantias' role='tab'>
                            Garantias
                        </a>
                    </li> ";
                    }
                    ?>  
                </ul>
            </div>
        </div>
		
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/edital/atualizar" method="post"
        id="form_cadastro" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="fk_instituicao" id="fk_instituicao"
            value="<?php echo $_SESSION['inst_id']; ?>" required>
        <input type="hidden" class="form-control" id="codigo" name="codigo"
            value="<?php echo $viewVar['edital']->getEdtId(); ?>" required>
        <input type="hidden" class="form-control" name="edtUsuario" id="edtUsuario"
            value="<?php echo $_SESSION['id']; ?>" required>
        <input type="hidden" class="form-control" name="dataCadastro" id="dataCadastro"
            value="<?php echo $dataAtual; ?>" required>
        <div class="kt-portlet__body">
            <input type="hidden" class="form-control" name="idCliente" id="idCliente" required>
        <div class="tab-content">
            <div class="tab-pane  active" id="kt_builder_principal">
                <div class="kt-portlet__body">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label class="">CADASTRO DO CLIENTE</label>
                            <a href="http://<?php echo APP_HOST; ?>/cliente/cadastro" id="cadastroCliente"
                                name="cadastroCliente" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                                <i class="la la-plus"></i>Novo Cliente</a>
                            <input type="text" class="form-control" placeholder="Cliente - autocomplete"
                                id="clienteLicitacao-autocomplete" name="clienteLicitacao-autocomplete"
                                value="<?php echo $viewVar['edital']->getClienteLicitacao()->getRazaoSocial()." - ". $viewVar['edital']->getClienteLicitacao()->getNomeFantasia(); ?>"
                                required>
                                <!-- ." - ".$viewVar['edital']->getClienteLicitacao()->getEndCidade()->getEstado()->getEstUf() -->
                            <input type="hidden" id="cliente" name="cliente"
                                value=<?php echo $viewVar['edital']->getClienteLicitacao()->getCodCliente(); ?>>
    
                            <span class="form-text text-muted">Por favor insira o cliente do Edital</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2">
                            <label for="modalidade">Modalidade</label>
                            <select class="form-control" name="modalidade" id="modalidade" required>
                                <option value="">Selecione a Modalidade</option>
                                <option value="<?php echo $viewVar['edital']->getEdtModalidade(); ?>"
                                    <?php echo ($viewVar['edital']->getEdtModalidade() == $viewVar['edital']->getEdtModalidade()) ? "selected" : ""; ?>>
                                    <?php echo $viewVar['edital']->getEdtModalidade(); ?> </option>
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
                                value="<?php echo $viewVar['edital']->getEdtNumero(); ?>" required>
                            <span class="form-text text-muted">Digite o numero da licitacao</span>
                        </div>
                        <div class="col-lg-2">
                            <label for="garantia">Garantia</label>
                            <select class="form-control" name="garantia" required>
                                <option value="">Selecione Garantia</option>
                                <option value="<?php echo $viewVar['edital']->getEdtGarantia(); ?>"
                                    <?php echo ($viewVar['edital']->getEdtGarantia() == $viewVar['edital']->getEdtGarantia()) ? "selected" : ""; ?>>
                                    <?php echo $viewVar['edital']->getEdtGarantia(); ?> </option>
                                <option value="Sim">SIM</option>
                                <option value="Nao">NÃO</option>
                            </select>
                            <span class="form-text text-muted">Por favor Garantia</span>
                        </div>
                        <div class="col-lg-2">
                            <label for="status">status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="">Selecione o status</option>
                                <?php foreach ($viewVar['listarEditalStatus'] as $editalStatus) : ?>
                                <option value="<?php echo $editalStatus->getStEdtId(); ?>"
                                    <?php echo ($viewVar['edital']->getEditalStatus()->getStEdtId() == $editalStatus->getStEdtId()) ? "selected" : ""; ?>>
                                    <?php echo $editalStatus->getStEdtNome(); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="form-text text-muted">Por favor insira o status</span>
                        </div>
                        <div class="col-lg-2">
                            <label for="representante">Representante</label>
                            <select class="form-control" id="representante" name="representante" required>
                                <option value="">Selecione o Representante</option>
                                <?php foreach ($viewVar['listarRepresentantes'] as $representante) : ?>
                                <option value="<?php echo $representante->getCodRepresentante(); ?>"
                                    <?php echo ($viewVar['edital']->getRepresentante()->getCodRepresentante() == $representante->getCodRepresentante()) ? "selected" : ""; ?>>
                                    <?php echo $representante->getNomeRepresentante(); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="form-text text-muted">Por favor insira o Representante</span>
                        </div>
                        <div class="col-lg-2">
                                <label for="disputa">Modo Disputa</label>
                                <select class="form-control" id="disputa" name="disputa" required >
                                    <option value="">Selecione Disputa</option>           
                                     <option value="<?php echo $viewVar['edital']->getDisputa(); ?>"
                                    <?php echo ($viewVar['edital']->getDisputa() == $viewVar['edital']->getDisputa()) ? "selected" : ""; ?>>
                                    <?php echo $viewVar['edital']->getDisputa(); ?> </option>
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
                                value="<?php echo $viewVar['edital']->getEdtDataAbertura()->format('Y-m-d'); ?>" required>
                            <span class="form-text text-muted">Digite a Hora</span>
                        </div>
                        <div class="col-lg-2">
                            <label for="hora" class="">Hora:</label>
                            <input type="time" class="form-control" placeholder="Digite a Hora de Abertura" id="hora"
                                name="hora" value="<?php echo $viewVar['edital']->getEdtHora()->format('H:i:s'); ?>"
                                required>
                            <span class="form-text text-muted">Digite a Hora de Abertura</span>
                        </div>
                        <div class="col-lg-2">
                            <label for="tipo">Tipo</label>
                            <select class="form-control" name="tipo" required>
                                <option value="">Selecione o Tipo</option>
                                <option value="<?php echo $viewVar['edital']->getEdtTipo(); ?>"
                                    <?php echo ($viewVar['edital']->getEdtTipo() == $viewVar['edital']->getEdtTipo()) ? "selected" : ""; ?>>
                                    <?php echo $viewVar['edital']->getEdtTipo(); ?> </option>
                                <option value="Por Item">Por Item</option>
                                <option value="Por Lote">Por Lote</option>>
                                <option value="Por Lote/ Item">Por Lote/ Item</option>>
                            </select>
                            <span class="form-text text-muted">Por favor insira o Tipo</span>
                        </div>
                        <div class="col-lg-2">
                            <label for="operador">Operador</label>
                            <select class="form-control" id="operador" 
                            <?php if ($_SESSION['nome'] != $viewVar['edital']->getEdtOperador() && $_SESSION['nivel'] == 2){
                                 echo 'readonly';
                            }
                            ?> 
                            name="operador" required>
                                <option value="">Operador</option>
                                <?php foreach ($viewVar['listarUsuarios'] as $operador) : ?>
                                <option value="<?php echo $operador->getId(); ?>"
                                    <?php echo ($viewVar['edital']->getEdtOperador() == $operador->getApelido()) ? "selected" : ""; ?>>
                                    <?php echo $operador->getApelido(); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="form-text text-muted">Por favor insira o Representante</span>
                        </div>
                        <div class="col-lg-2">
                            <label for="identificador" class="">Id Portal:</label>
                            <input type="text" class="form-control" placeholder="Digite a identificador no portal" id="identificador"
                                name="identificador" value="<?php echo $viewVar['edital']->getEdtIdentificador(); ?>">
                            <span class="form-text text-muted">Digite o Id Portal</span>
                        </div>
                        <div class="col-lg-2">
                            <label for="portal">Portal</label>
                            <select class="form-control" name="portal" required>
                                <option value="">Selecione Portal</option>
                                <option value="<?php echo $viewVar['edital']->getEdtPortal(); ?>"
                                    <?php echo ($viewVar['edital']->getEdtPortal() == $viewVar['edital']->getEdtPortal()) ? "selected" : ""; ?>>
                                    <?php echo $viewVar['edital']->getEdtPortal(); ?> </option>
                                     <option value="BBMNET ">BBMNET </option>
                                    <option value="BNC">BNC</option>
                                    <option value="BLL">BLL</option>
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
                            <span class="form-text text-muted">Por favor Garantia</span>
                        </div>                    
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2">
                            <label for="proposta" class="">Proposta:</label>
                            <input type="text" class="form-control" placeholder="Digite a Proposta" id="proposta"
                                name="proposta" value="<?php echo $viewVar['edital']->getEdtProposta(); ?>">
                            <span class="form-text text-muted">Digite o numero da Proposta</span>
                        </div>
                        <div class="col-lg-2">
                            <label for="dataLimite" class="">Data Limite:</label>
                            <input type="date" class="form-control" placeholder="Digite a Data Limite" id="dataLimite"
                                name="dataLimite"
                                value="<?php echo $viewVar['edital']->getEdtDataLimite()->format('Y-m-d'); ?>">
                            <span class="form-text text-muted">Digite Limite</span>
                        </div>
                        <div class="col-lg-1">
                            <label for="horaLimite" class="">Hora Limite:</label>
                            <input type="time" class="form-control" placeholder="Digite a Hora Limite" id="horaLimite"
                                name="horaLimite"
                                value="<?php echo $viewVar['edital']->getEdtHoraLimite()->format('H:i:s'); ?>">
                            <span class="form-text text-muted">Digite a Hora Limite</span>
                        </div>
                         <div class="col-lg-2">
                                <label for="valor" class="">Valor:</label>
                                <input type="text" class="form-control" placeholder="Digite a valor" id="valor"
                                    name="valor" value="<?php echo $viewVar['edital']->getEdtValor(); ?>">
                                <span class="form-text text-muted">Digite o numero da Proposta</span>
                            </div> 
                        <div class="col-lg-2">
                            <label for="codInstituicao">Empresa</label>
                            <select class="form-control" id="codInstituicao" name="codInstituicao" required>
                                <option value="">Selecione o Instituicao</option>
                                <?php foreach ($viewVar['listarInstituicoes'] as $instituicao) : ?>
                                <option value="<?php echo $instituicao->getInst_id(); ?>"
                                    <?php echo ($viewVar['edital']->getInstituicao()->getInst_id() == $instituicao->getInst_id()) ? "selected" : ""; ?>>
                                    <?php echo $instituicao->getInst_NomeFantasia(); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="form-text text-muted">Por favor insira o Representante</span>
                        </div>
                        <div class="col-lg-2">
                            <label for="anexo" class="">Anexo:</label>
                            <input type="file" name="anexo" id="anexo"
                                value="<?php echo $Sessao::retornaValorFormulario('anexo'); ?>">
                            <input type="hidden" name="anexoAlt" id="anexoAlt"
                                value="<?php echo $viewVar['edital']->getEdtAnexo(); ?>">
                            <a class="dropdown-item"
                                href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/<?php echo $viewVar['edital']->getEdtAnexo(); ?>"
                                target="_blank" title="Click para Visualizar Anexo" class="btn btn-info btn-sm"><i
                                    class="la la-chain"></i> Anexo</a>
                            <span class="form-text text-muted">Selecione o arquivo</span>
                        </div>
                    </div>
                     <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="observacao" class="">Observacao do Edital:</label>
                        <textarea class="form-control" rows="3" placeholder="Digite Observacao do Edital"
                            id="observacao"
                            name="observacao"><?php echo $viewVar['edital']->getEdtObservacao(); ?></textarea>
                        <span class="form-text text-muted">Digite Observacao do Edital</span>
                    </div>
                    <div class="col-lg-6">
                        <label for="analise" class="">Analise do Edital:</label>
                        <textarea class="form-control" rows="3" placeholder="Digite Analise do Edital" id="analise"
                            name="analise"><?php echo $viewVar['edital']->getEdtAnalise(); ?></textarea>
                        <span class="form-text text-muted">Digite Analise do Edital</span>
                    </div>
                </div>
                     <div class="col-lg-12" id="msgJustificarEdital">          
                     </div>   
                     <input type="hidden" id="txtJustificarEdital" name="txtJustificarEdital" value="<?php echo $viewVar['edital']->getJustificativa(); ?>"> 
               </div>
            </div> 
            <div class="tab-pane" id="kt_builder_anexos">
                    <h3 class="kt-portlet__head-title"> EM DESENVOLVIMENTO </h3>
            </div>
             <?php                                                           
                if (!empty($dados)) {                                                   
                ?>
            <div class="tab-pane" id="kt_builder_garantias">
                        <div class="kt-portlet__body">                        
                                <!--end export -->
                                <div class="kt-portlet__body">
                                    <!--begin: Datatable -->
                                   
                                    <table class="table table-striped table-bordered table-hover table-checkable"
                                        id="kt_table_3">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">STATUS</th>
                                                <th class="text-center">MARCA</th>
                                                <th class="text-center">DATA SOLICITACAO</th>
                                                <th class="text-center">DATA RECEBIMENTO</th>
                                                <th class="text-center">DATA RESULTADO</th>
                                                <th class="text-center">RESULTADO</th>
                                                <th class="text-center">ACOES</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">STATUS</th>
                                                <th class="text-center">MARCA</th>
                                                <th class="text-center">DATA SOLICITACAO</th>
                                                <th class="text-center">DATA RECEBIMENTO</th>
                                                <th class="text-center">DATA RESULTADO</th>
                                                <th class="text-center">RESULTADO</th>
                                                <th class="text-center">ACOES</th>
                                            </tr>
                                        </tfoot>
                                        <?php
                                            foreach ( $dados as $garantia) {
                                        ?>
                                        <td><?php echo $garantia->getCtrId(); ?></td>
                                        <td class="text-center"><span class="badge badge-pill badge-<?php echo $garantia->getGrtPkIdStatus()->getCors()->getCorCor(); ?>">
                                            <?php echo $garantia->getGrtPkIdStatus()->getStGarNome(); ?>
                                        </td>
                                        <td><?php echo $garantia->getGrtFornecedor()->getForNomeFantasia(); ?></td>
                                        <td><?php echo $garantia->getGrtDataSolicitacao()->format('d/m/Y'); ?></td>
                                        <td>
                                            <?php 
                                                if ($garantia->getGrtPkIdStatus()->getStGarNome() == "NAO GARANTIDO") {
                                                    echo "<span class='badge badge-pill badge-success'>NÃO INFORMAR!</span>";                                                       
                                                } else{
                                                    if($garantia->getGrtPkIdStatus()->getStGarNome() == "NAO RESPONDIDO"){
                                                        echo "<span class='badge badge-pill badge-danger'>". $garantia->getGrtPkIdStatus()->getStGarNome() ."</span>";
                                                    }else {                                                        
                                                       echo $garantia->getGrtDataRecebido()->format('d/m/Y');
                                                    }
                                                }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                                if ($garantia->getGrtPkIdStatus()->getStGarNome() == "NAO GARANTIDO") {
                                                    echo "<span class='badge badge-pill badge-success'>NÃO INFORMAR!</span>";                                                                                                           
                                                } else{
                                                    if(($garantia->getGrtDataResultado()->format('d/m/Y') == $garantia->getGrtDataSolicitacao()->format('d/m/Y')) || ($garantia->getGrtPkIdStatus()->getStGarNome() == "NAO RESPONDIDO")){
                                                        echo "<span class='badge badge-pill badge-danger'>NÃO INFORMADO</span>";
                                                    }else {                                                        
                                                        echo $garantia->getGrtDataResultado()->format('d/m/Y');
                                                    }
                                                }                               
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if ($garantia->getGrtResultado() == "NAO INFORMADO") {
                                                    echo "<span class='badge badge-pill badge-danger'>". $garantia->getGrtResultado() ."</span>";                                                      
                                                } else{
                                                    if(($garantia->getGrtResultado() == "INFORMADO") || ($garantia->getGrtResultado() == "NAO INFORMAR")){
                                                        echo "<span class='badge badge-pill badge-success'>". $garantia->getGrtResultado() ."</span>";
                                                    }else{
                                                        echo "<span class='badge badge-pill badge-warning'>". $garantia->getGrtResultado() ."</span>";
                                                    }
                                                }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                        <span class="d-none d-md-block">
                                               <a href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/<?php echo $garantia->getGrtAnexo(); ?>"  
                                                    class="btn btn-outline-dark btn-elevate btn-pill btn-elevate-air btn-sm" target="_blank" title="Visualizar anexo"><i class="la la-file-text-o"></i></a>
                                            </span>
                                            <div class="dropdown  d-block d-md-none">
                                                <button class="btn btn-primary dropdown-toggle btn-elevate btn-pill btn-elevate-air btn-sm"
                                                    type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Ações </button>
                                                <div class="dropdown-menu dropdown-menu-right " aria-labelledby="acoesListar">                                                    
                                                <a href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/<?php echo $garantia->getGrtAnexo(); ?>"
                                                        class="dropdown-item btn btn-outline-dark btn-elevate btn-pill btn-elevate-air btn-sm"
                                                        target="_blank" title="Visualizar anexo"> <i class="la la-chain"></i>Anexo</a>
                                                </div>
                                            </div>                                               
                                        </td>
                                        </tr>
                                        <?php
                                            }                                   
                                        ?>
                                        </tbody>
                                    </table>                                   
                                    <!--end: Datatable -->
                                </div>
                        </div>
                       
            </div>
                <?php                                                                          
                } 
                ?>
            </div>
            <p><span class="text-danger">* </span>Campos obrigatórios</p>
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
                                class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air">Salvar</button>
                            <a href="http://<?php echo APP_HOST; ?>/edital"
                                class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                                <button type="submit" id="copiar" name="copiar" class="btn  btn-outline-warning btn-elevate btn-pill btn-elevate-air" value="copiar">Salvar e Copiar</button>
                        </div>
                    </div>
                    <br>
                    <h5 class="text-danger text-center" name="informacao" id="informacao">
                        <p><strong><em>Cadastrado em:
                                    <?php echo $viewVar['edital']->getEdtDataCadastro()->format('d/m/Y H:i:s'); ?>
                                    - Ultima Alteracao em:
                                    <?php echo $viewVar['edital']->getEdtDataAlteracao()->format('d/m/Y H:i:s')  ?>
                                    Por: <?php echo $viewVar['edital']->getUsuario()->getApelido() ; ?>
                                </em></strong></p>
                    </h5>
                </div>
            </div>
        </div>
    </form>
    <br>
<!--end::Form-->
</div>
<!--end::Portlet-->

<!-- footer -->