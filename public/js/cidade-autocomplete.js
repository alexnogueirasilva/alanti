var cid_id = null;
var appHosp = $('#appHosp').val();//varivel constate atribuida no header

var optionsCidade = {
	adjustWidth: false,//desativar o ajuter default
	url: function(cidade) {
		return appHosp+"/cidade/autoComplete/" + cidade;
	},

	getValue: function(element) {
		return element.cid_nome + ' - UF: ' +element.est_uf;
	},

	list: {		
		onChooseEvent: function() {	
			cid_id = $("#cidade-autocomplete").getSelectedItemData().cid_id;		
			$('#cidade').val(cid_id);			
		},

		onHideListEvent: function(){
			if(cid_id == null){
				$("#cidade-autocomplete").val('');	
			}		
		}

	}
};

$("#cidade-autocomplete").easyAutocomplete(optionsCidade);
