var licitacaoCliente_cod = null;
var appHosp = $('#appHosp').val();//varivel constate atribuida no header
var optionsCliente = {
    url: function(cliente) {
        return appHosp+"/clienteLicitacao/autoComplete/" + cliente;
    },

    getValue: function(element) {
        return element.nomefantasia;
    },

    list: {
        onChooseEvent: function() {
            licitacaoCliente_cod = $("#autocomplete-clientefalta").getSelectedItemData().licitacaoCliente_cod;
            $('#cliente').val(licitacaoCliente_cod);
        },

        onHideListEvent: function(){
            if(licitacaoCliente_cod == null){
                $("#autocomplete-clientefalta").val('');
            }
        }

    }
};

$("#autocomplete-clientefalta").easyAutocomplete(optionsCliente);