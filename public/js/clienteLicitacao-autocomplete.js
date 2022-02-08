var appHosp = $('#appHosp').val();//varivel constate atribuida no header
	var licitacaoCliente_cod = null;
	//document.getElementById("numeroLicitacao").disabled = false;
	$('#cadastroCliente').slideUp();
	
		var optionscliente = {
			url: function (cliente) {
				//return "http://coisavirtual.com.br/ClienteLicitacao/autoComplete/" + cliente; //hospedagem
				return appHosp+"/ClienteLicitacao/autoComplete/" + cliente;
				//return "http://localhost/SOMVC/ClienteLicitacao/autoComplete/" + cliente;
			},

			getValue: function (element) {
			  
					return element.razaosocial + ' - ' + element.est_uf;
			},

			list: {
				onChooseEvent: function () {
					licitacaoCliente_cod = $("#clienteLicitacao-autocomplete").getSelectedItemData().licitacaoCliente_cod;

					$('#cliente').val(licitacaoCliente_cod);
					$('#cadastroCliente').slideUp();					
				},
				onHideListEvent: function () {
					if (licitacaoCliente_cod == null) {
						$('#clienteLicitacao-autocomplete').val('');
						$('#cadastroCliente').slideDown();
					
					}
				}
			}
		};
		$("#clienteLicitacao-autocomplete").easyAutocomplete(optionscliente);
	