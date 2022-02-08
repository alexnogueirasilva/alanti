var fornecedor_cod = null;

var appHosp = $('#appHosp').val();//varivel constate atribuida no header

var optionsFornecedor = {
    adjustWidth: false,//desativar o ajuter default
    url: function (garantia) {
        //return "http://suporte.devaction.com.br/fornecedor/autoComplete/" + garantia;
        return appHosp+"/fornecedor/autoComplete/" + garantia;
        //return "http://coisavirtual.com.br/fornecedor/autoComplete/" + garantia;
    },

    getValue: function (element) {
        return element.nomefantasia;
    },

    list: {
        onChooseEvent: function () {
            fornecedor_cod = $("#autocomplete-garantia").getSelectedItemData().fornecedor_cod;
            $('#grtfornecedor').val(fornecedor_cod);
            $('#cadastroFornecedor').slideUp();	
        },

        onHideListEvent: function () {
            if (fornecedor_cod == null) {
                $("#autocomplete-garantia").val('');
               // $('#cadastroFornecedor').slideInDown();	
            }
        }

    }
};

$("#autocomplete-garantia").easyAutocomplete(optionsFornecedor);



//begin pegar dados para edicao
$(document).on("click", "#btnEditarGarantia", function(){

	//$("#garantiastatus").focus();
    var codigo              = $(this).data('codigo');
    var fornecedor          = $(this).data('fornecedor');
    var fornecedorId        = $(this).data('fornecedorid');
    var status              = $(this).data('status');
    var statusId            = $(this).data('statusid');
    var dataSolicitacao     = $(this).data('datasolicitacao');
    var dataResultado       = $(this).data('dataresultado');
    var dataRecebido        = $(this).data('datarecebido');
    var observacao          = $(this).data('observacao');
    var resultado           = $(this).data('resultado');
    var anexo               = $(this).data('anexo');
    
    $("#grtcodigo").val(codigo);
    $("#grtfornecedor").val(fornecedorId);
    $("#garantiastatus").val(statusId);
    $("#grtdataresultado").val(dataResultado);
    $("#grtdatarecebimento").val(dataRecebido);
    $("#grtdatasolicitacao").val(dataSolicitacao);
    $("#grtresultado").val(resultado);
    $("#grtobservacao").val(observacao);
    $("#autocomplete-garantia").val(fornecedor);
    $("#grtanexoAlt").val(anexo);    
});
//end pegar dados para edicao


//begin visualizar anexo
$(document).on("click", "#grtanexoverAnexo", function(){
    var veAnexo = appHosp+ "/public/assets/media/anexos/"+ $('#grtanexoAlt').val();
    window.location = veAnexo;
});
// end visualizar anexo

$(document).on("click", "#btnApagarGarantia", function(){
    var codigo              = $(this).data('codigo');
    var fornecedor 	        = $(this).data('fornecedor');
    var codigoEdital 	    = $(this).data('codigoedital');
    var fornecedorGarantia  = " Código: "+codigo+" - Fornecedor: "+fornecedor;

	$('#codigoGarantia').val(codigo);
	$('#codigoEdital').val(codigoEdital);
	$('#fornecedorGarantia').text(fornecedorGarantia);
    $('body').append(' <div class="modal fade" id="apagarGarantia" tabindex="-1" role="dialog" aria-labelledby="apagarGarantia" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header bg-danger"><h5 class="modal-title text-white" id="apagarGarantia">EXCLUIR</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><input type="hidden" id="codigoEdital" name="codigoEdital"><input type="hidden" id="codigoGarantia" name="codigoGarantia"><span aria-hidden="true">&times;</span></button></div><div class="modal-body bg-light">Deseja realmente excluir o registro selecionado?<span id="fornecedorGarantia" class="text-danger" name="fornecedorGarantia"></div><div class="modal-footer"><button type="button" class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air" data-dismiss="modal">Fechar</button><button type="button" class="btn btn-outline-danger btn-elevate btn-pill btn-elevate-air" id="btnExcluirGarantia">Excluir</button></div> </div></div></div>');
    $('#apagarGarantia').modal('show');
});

$(document).on("click", "#btnExcluirGarantia", function(){
    var grtcodigo       = $('#codigoGarantia').val();
    var grtpkidedital   = $('#codigoEdital').val();

	if(grtcodigo == ""){
		alert("Cadastro nao informado!");
	}else{
		$.ajax({
			url: appHosp+'/garantia/excluir',
			type: "POST",
			data: {			 
				grtcodigo: grtcodigo,
				grtpkidedital: grtpkidedital
            },
          
			success: function (result) {
				// alert(result);
				if (result) {
					alert("Cadastro excluido com Sucesso! \nCódigo " + result);
                    location.reload();
					//atualizaGarantia();
				} else {
                    alert("Erro ao excluir Cadastro");
				}
                $('#apagarGarantia').modal('hide');
			}
		});
	}
	return false; //Evita que a página seja atualizada
 });
 //end excluir cadastro

 function atualizaGarantia() {
    var grtpkidedital = $('#codigoEdital').val();
  
    $.ajax({
        url: appHosp+'/garantia/index/' + grtpkidedital,
        type: "POST",
        data: {            
            	grtpkidedital: grtpkidedital
        },
        success: function (data) {
			//alert(data);
            if (data) {
				//$('#tblcontados').html(data);
            }
        }
    });
}