//document.getElementById("numeroLicitacao-AutoComplete").disabled = true;
	var licitacaoCliente_cod = null;
	var appHosp = $('#appHosp').val();//varivel constate atribuida no header

	//$('#cadastroCliente').slideUp();
//	$('#cadastroCliente').slideDown();
		var optionsclientecontrato = {
			adjustWidth: false,//desativar o ajuter default
			url: function (cliente) {
				return appHosp+"/contrato/autoCompleteContratoClienteRazaoSocial/" + cliente; //hospedagem
				//return "http://localhost:81/SOMVC/contrato/autoCompleteContratoClienteRazaoSocial/" + cliente;
				//return "http://localhost/SOMVC/contrato/autoCompleteContratoClienteRazaoSocial/" + cliente;
			},
			getValue: function (element) {
					return element.razaosocial;
			},
			list: {
				onChooseEvent: function () {
					licitacaoCliente_cod = $("#contratoCliente-Autocomplete").getSelectedItemData().licitacaoCliente_cod;
					razaoSocial = $("#contratoCliente-Autocomplete").getSelectedItemData().razaosocial;
					$('#cliente').val(licitacaoCliente_cod);
					$('#cadastroCliente').slideUp();
					$('#numeroContrato').disabled = false;
					document.getElementById("numeroLicitacao-AutoComplete").disabled = false;									
				},
				onHideListEvent: function () {
					if (licitacaoCliente_cod == null) {
						$('#contratoCliente-Autocomplete').val('');
						$('#cadastroCliente').slideDown();
						document.getElementById("numeroLicitacao-AutoComplete").disabled = true;
					}
				}
			}
		};
		$("#contratoCliente-Autocomplete").easyAutocomplete(optionsclientecontrato);
	
//document.getElementById("numeroLicitacao-AutoComplete").disabled = true;
	var licitacaoCliente_cod = null;
	//$('#cadastroCliente').slideUp();
//	$('#cadastroCliente').slideDown();
		var optionsclienteedital = {
			url: function (cliente) {
				return appHosp+"/contrato/autoCompleteEditalClienteRazaoSocial/" + cliente; //hospedagem
			},
			getValue: function (element) {
					return element.razaosocial;
			},
			list: {
				onChooseEvent: function () {
					licitacaoCliente_cod = $("#editalCliente-Autocomplete").getSelectedItemData().licitacaoCliente_cod;
					razaoSocial = $("#editalCliente-Autocomplete").getSelectedItemData().razaosocial;
					$('#cliente').val(licitacaoCliente_cod);
					$('#cadastroCliente').slideUp();
					$('#numeroContrato').disabled = false;
					document.getElementById("editalLicitacao-AutoComplete").disabled = false;									
				},
				onHideListEvent: function () {
					if (licitacaoCliente_cod == null) {
						$('#contratoCliente-Autocomplete').val('Nao encontrato');
						$('#cadastroCliente').slideDown();
						document.getElementById("editalLicitacao-AutoComplete").disabled = true;
					}
				}
			}
		};
		$("#editalCliente-Autocomplete").easyAutocomplete(optionsclienteedital);
	
		var optionscontrato = {
			
			url: function (cliente) {
				return appHosp+"/contrato/autoCompleteNumeroContratoCodCliente/" + cliente+"/"; //hospedagem
				},

			getValue: function (element) { 
					return element.edt_numero;
			},

			list: {
				onChooseEvent: function () {
					licitacaoCliente_cod = $("#numeroLicitacao-Autocomplete").getSelectedItemData().licitacaoCliente_cod;
					razaoSocial  = $("#numeroLicitacao-AutoComplete").getSelectedItemData().razaosocial;
					numeroEdital = $("#numeroLicitacao").getSelectedItemData().edt_id;				
					$('#numeroLicitacao').val(numeroEdital);
			
				//	document.getElementById("numeroLicitacao-AutoComplete").disabled = false;									
				},
				onHideListEvent: function () {
					if (edt_id == null) {						
						$('#numeroLicitacao-AutoComplete').val('');
						$('#numeroLicitacao').val('');					
				//		document.getElementById("numeroLicitacao-AutoComplete").disabled = true;
					}
				}
			}
		};
		$("#numeroLicitacao-AutoComplete").easyAutocomplete(optionscontrato);

		var optionsedital = { 
			url: function (cliente) {
				return appHosp+"/contrato/autoCompleteNumeroEditalCodCliente/" + cliente+"/"+ licitacaoCliente_cod; //hospedagem
			},

			getValue: function (element) { 
					return element.edt_numero +' - '+element.inst_nomeFantasia;
			},

			list: {
				onChooseEvent: function () {
					numeroEdital = $("#editalLicitacao-AutoComplete").getSelectedItemData().edt_id;				
					razaoSocial = $("#editalLicitacao-AutoComplete").getSelectedItemData().razaosocial;
					$('#numeroLicitacao').val(numeroEdital);			
			
					//document.getElementById("editalLicitacao-AutoComplete").disabled = false;									
				},
				onHideListEvent: function () {
					if (licitacaoCliente_cod == null || edt_id == null) {
						$('#editalLicitacao-AutoComplete').val('Nao encontrato');
						$('#numeroLicitacao').val('');					
						//document.getElementById("editalLicitacao-AutoComplete").disabled = true;
					}
				}
			}
		};
		$("#editalLicitacao-AutoComplete").easyAutocomplete(optionsedital);

		
//begin pegar dados para edicao
$(document).on("click", "#btnEditarContrato", function(){

	//$("#garantiastatus").focus();
    var codigoEdital        = $(this).data('codigoedital');
    var codigoContrato      = $(this).data('codigocontrato');
    var numeroContrato      = $(this).data('numerocontrato');
    var status              = $(this).data('status');
    var entrega            	= $(this).data('entrega');
    var pagamento           = $(this).data('pagamento');
    var dataInicio     		= $(this).data('datainicio');
    var dataVencimento      = $(this).data('datavencimento');
    var valor           	= $(this).data('valor');
    var anexo               = $(this).data('anexo');
    var observacao        	= $(this).data('observacao');
    
	$("#ctr_edital").val(codigoEdital);
	$("#ctr_id").val(codigoContrato);
	$("#numeroContrato").val(numeroContrato);
	$("#prazoEntrega").val(entrega);
	$("#prazoPagamento").val(pagamento);
	$("#dataInicio").val(dataInicio);
	$("#dataVencimento").val(dataVencimento);
	$("#valor").val(valor);
	$("#status").val(status);
	$("#observacao").val(observacao);
	$("#ctrAnexoAlt").val(anexo);    
});
//end pegar dados para edicao


//begin visualizar anexo
$(document).on("click", "#ctrAnexoVerAnexo", function(){
    var veAnexo = appHosp+ "/public/assets/media/anexos/"+ $('#ctrAnexoAlt').val();
    window.location = veAnexo;
});
// end visualizar anexo