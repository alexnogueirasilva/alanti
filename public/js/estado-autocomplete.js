var estid = null;
var appHosp = $('#appHosp').val();//varivel constate atribuida no header
var optionsEstado = {
	url: function(estado) {
		//return "http://coisavirtual.com.br/estado/autoComplete/" + estado;
		return appHosp+"/estado/autoComplete/" + estado;
	},

	getValue: function(element) {
		return element.estnome  + " - " + element.estuf;
	},

	list: {		
		onChooseEvent: function() {	
			estid = $("#estado-autocomplete").getSelectedItemData().estid;		
			$('#estado').val(estid);			
		},

		onHideListEvent: function(){
			if(estid == null){
				$("#estado-autocomplete").val('');	
			}		
		}

	}
};

$("#estado-autocomplete").easyAutocomplete(optionsEstado);
