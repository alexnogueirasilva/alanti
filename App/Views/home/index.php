
 
    <center>
    <div class="kt-error_container">   
            <img src="http://<?php echo APP_HOST; ?>/public/assets/media/logos/alanti_logo.png" alt="Coisa Virtual" >        
    </div>
    <!-- MODAL info
    ideia de criar um modal pra exibir atualizações no sistema
-->
<div class="modal fade" id="infModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">INFORMACOES</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>
            <div class="kt-portlet kt-portlet--tabs">
               
                <!--begin::Form--> 
                <form id="frmModalInfo" class="kt-form kt-form--label-right" method="POST" action="http://<?php echo APP_HOST .'/usuario/desInfo/'. $_SESSION['id'] ;?>">
                    <div class="modal-body">
                        <div class="kt-portlet__body">                        
                                <input type="hidden" id="id" name="id" value="<?php echo $_SESSION['id']; ?>"">
                                <input type="hidden" class="form-control" name="info" id="info"
                                    value="<?php echo $_SESSION['info']; ?>" required>              
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <label for="observacao" class="">Observacao:</label>
                                            <textarea class="form-control" rows="6"
                                                placeholder="" id="observacao"
                                                name="observacao"
                                                value="">testando tela pra exibir informações de atualizações do sistema</textarea>
                                            <span class="form-text text-muted">Observacao</span>
                                        </div>                                       
                                    </div>
                                    <main role="main">
                                                <a class="navbar-brand" target="_blank" href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/informacoes.png"> 
                                                <img class="primeira imagem img-fluid" src="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/informacoes.png" alt="Informações" >
                                            </a>
                                    </main>                               
                                    <div class="form-group row">
                                      <div class="col-lg-12">
                                            <label for="anexo" class="">Anexo:</label>                                            
                                                <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/informacoes.png"
                                    target="_blank" title="Click para Visualizar Anexo" class="btn btn-info btn-sm"><i
                                class=" la la-chain la-3x"></i> Anexo</a>                                            
                                        </div>
                                    </div>
    <!-- 
                            <div class="jumbotron video">
                                <div class="container">
                                    <h2 class="display-4 text-center video-titulo anim_left" style="margin-bottom: 40px;">Titutlo</h2>
                                    <p class="lead text-center video-paragrafo anim_right">Descricao</p>
                                    <div class="row justify-content-md-center video-conteudo anim_bottom">
                                        <div class="col-12 col-md-8 ">
                                            <div class="embed-responsive embed-responsive-16by9">
                                            <iframe width="560" height="315" src="https://www.youtube.com/embed/tZT3HgPXMMY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    -->                            
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-8">
                                        <button type="Submit" 
                                            class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air">Nao Mostrar</button>                                       
                                        <button type="button"  data-dismiss="modal"
                                            class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--end::Modal-->
        </div>
    </div>
</div>
</div>
<!-- MODAL edital-->
<script type="text/javascript">

$(document).ready(function() {
    var info = $('#info').val();    
    if(info == 0){
        
        $('#infModal').modal('show');
    }
})
</script>
