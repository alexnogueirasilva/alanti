var appHosp = $('#appHosp').val();//varivel constate atribuida no header

//ADICIONA PEDIDO/ ALTERAR CADASTRO
$('#frmModalLogistica').submit(function () {
 
    var valor = $("#valor").text();
    var valorCorrigido = $("#valorcorrigido").val();

    if(valor != '0,00' || valorCorrigido != ''){
        
        var codigo = $("#acao").val();  
    
        var mensagem = '';
        if(codigo  == 0){
            mensagem = 'Cadastrado';
        } else if(codigo  == 1){
            mensagem = 'Alterado';
        }else if(codigo  == 2){
            mensagem = 'Excluido';
        }
    
        $.ajax({
            url: appHosp+'/Logistica/salvar',
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#salvarLogistica").html("<i class='fa fa-spinner fa-spin'></i> Salvando, aguarde...");
                $("#salvarLogistica").prop("disabled", true);
            },
            success: function (result) {
               // alert(result);
                if (result > 0 ) {
                    alert(mensagem+" Com Sucesso! \nCódigo " + result);
                   
    				$("#valorcorrigido").val('');		
                    $("#transportadora").val(''); 
                     if( valorCorrigido != '' && codigo  == 0){                      
                        enviarEmailValorCorrigido(result);
                    } 
                } else {
                    alert("Erro ao salvar");
                }
                $('#acao').val('');
                location.reload();
                $('#modal_logistica').modal('hide');
            }
        });
    }else{
        alert('O valor do pedido deve ser informado!');
    }
    return false; //Evita que a página seja atualizada
});
//ADICIONA PEDIDO

//begin limpar dados
$(document).on("click", "#limparLogistica", function(){
    $("#transportadora-autocomplete").val('');
    $("#transportadora").val('');
    $("#nfe").val('');
    $("#anexoLogisticaAlt").val('');
    $("#status").val('');
    $("#status").val('');
    $("#rota").val('');
    $("#codigo").val('');
    $("#valor").text('');
    $("#valorcorrigido").val('');
     $("#valorFrete").val('');
    $("#pedidoerp").val('');
    $('#nomeCliente').text('');
    $('#codCliente').val('');
    $('#acao').val('');
});
//end limpar dados

//begin pegar dados para edicao
var infoValor = '';//variavel global para pegar o campo observao do valor corrigido
$(document).on("click", "#btnModalLogisticaAlterar", function(){
	$("#transportadora").focus();
    var nfe = $(this).data('nfe');
    var anexo = $(this).data('anexo');
    var status = $(this).data('status');
    var rota = $(this).data('rota');
    var codigo = $(this).data('codigo');
    var traRazaoSocial = $(this).data('trarazaosocial');
    var traCodigo = $(this).data('traid');
    var pedidoerp = $(this).data('pedidoerp');
    var valorCorrigido = $(this).data('valorcorrigido');
     var valorFrete = $(this).data('valorfrete');
    var valor = $(this).data('valor');
    var clientelogistica = $(this).data('nomecliente');
    var codclientelogistica = $(this).data('codcliente');
    var infoValorCorrigido = $(this).data('infovalorcorrigido');
    infoValor = infoValorCorrigido;  
    action = $('#acao').val('1');
    
    $("#transportadora-autocomplete").val(traRazaoSocial);
    $("#transportadora").val(traCodigo);
    $("#nfe").val(nfe);
    $("#anexoLogisticaAlt").val(anexo);
    $("#status").val(status);
    $("#statusPedido").val(status);
    $("#rota").val(rota);
    $("#infovalorcorrigido").val(infoValorCorrigido);
    $("#codigo").val(codigo);
    $("#valor").text(valor);
    $("#valorcorrigido").val(valorCorrigido);
    $("#valorFrete").val(valorFrete);
    $("#pedidoerp").val(pedidoerp);
    $('#nomeCliente').text(clientelogistica);
    $('#codCliente').val(codclientelogistica);
     justificativaPreco();
});
//end pegar dados para edicao

//begin pegar dados para cadastrar na logistica
$(document).on("click", "#btnModalLogistica", function(){
	$("#transportadora").focus();
    var pedidoerp = $(this).data('pedidoerp');
    var pedidocontrole = $(this).data('pedidocontrole');
    var valor = $(this).data('valor');
    var clientelogistica = $(this).data('nomecliente');
    var statusPedido = $(this).data('statuspedido');

    action = $('#acao').val('0');

    $("#valor").text(valor);
   // $("#valorcorrigido").val(valor);
    $("#pedidoerp").val(pedidoerp);
    $("#statusPedido").val(statusPedido);
    $("#pedidocontrole").val(pedidocontrole);
    $('#nomeCliente').text(clientelogistica);
});
//end pegar dados para cadastrar na logistica

// begin multi select do select2
$('#status2, #kt_select2_3_validate').select2({
	placeholder: "Selecione um ou mais dados",
});
// end multi select do select2
//begin funcao para habilitar o campo de valor corrigido
if (document.getElementById("infoValorCorrigido")) {
    $(document).on("click", "#infoValorCorrigido", function () {
        justificativaPreco();
    });
}
function justificativaPreco() {
    var chek = document.getElementById("infoValorCorrigido");

    if (chek.checked == true || infoValor != '') {
        document.getElementById("valorcorrigido").disabled = false;
        $('#justificativaPreco').html("<label class=''>Justificativa de preço:</label><textarea minlength='20' class='form-control' title='Favor informar justificativa do valor corrigido' rows='3' placeholder='justificativa do valor corrigido'id='infovalorcorrigido' name='infovalorcorrigido' required></textarea><span class='form-text text-muted'>Digite a justificativa do valor corrigido</span> " );
        $("#infovalorcorrigido").val(infoValor);
    } else {
        $('#valorcorrigido').val('');
        document.getElementById("valorcorrigido").disabled = true;
        $('#justificativaPreco').html('')
    }
}
/*
if (document.getElementById("infoValorCorrigido")) {

    if (document.getElementById("infoValorCorrigido").checked == true) {
        document.getElementById("valorcorrigido").disabled = false;
    }
    $(document).on("click", "#infoValorCorrigido", function () {
        var chek = document.getElementById("infoValorCorrigido");
        if (chek.checked == true) {
            document.getElementById("valorcorrigido").disabled = false;
            $('#justificativaPreco').html("<label class=''>Justificativa de preço:</label><textarea minlength='20' class='form-control' title='Favor informar justificativa do valor corrigido' rows='3' placeholder='justificativa do valor corrigido'id='infovalorcorrigido' name='infovalorcorrigido' required></textarea><span class='form-text text-muted'>Digite a justificativa do valor corrigido</span> " );
            } else {
            $('#valorcorrigido').val('');
            document.getElementById("valorcorrigido").disabled = true;
            $('#justificativaPreco').html('')
        }
    });
}
*/
//end funcao para habilitar o campo de valor corrigido

//begin visualizar anexo
$(document).on("click", "#verAnexo", function(){
    var veAnexo = appHosp+ "/public/assets/media/anexos/"+ $('#anexoLogisticaAlt').val();
    window.location = veAnexo;
});
// end visuakuzar anexo

//begin excluir pedido
$(document).on("click", "#btnModalLogisticaExcluir", function(){
   $('#salvarLogistica').html('Excluir');
    action = $('#acao').val('2');
    $('#justificativaExcluir').html("<label class=''>Justifique a Exclusao:</label><textarea minlength='20' class='form-control' title='Favor informar justificativa do motivo da exclusao' rows='3' placeholder='justificativa do motivo da exclusao'id='infoexcluir' name='infoexcluir' required></textarea><span class='form-text text-muted'>Digite a justificativa do exclusao</span> " );
    $("#salvarLogistica").focus();
    var nfe = $(this).data('nfe');
    var anexo = $(this).data('anexo');
    var status = $(this).data('status');
    var rota = $(this).data('rota');
    var codigo = $(this).data('codigo');
    var traRazaoSocial = $(this).data('trarazaosocial');
    var traCodigo = $(this).data('traid');
    var pedidoerp = $(this).data('pedidoerp');
    var valorCorrigido = $(this).data('valorcorrigido');
     var valorFrete = $(this).data('valorfrete');
    var valor = $(this).data('valor');
    var clientelogistica = $(this).data('nomecliente')
    var codclientelogistica = $(this).data('codcliente')
    var infoExcluir = $(this).data('infoexcluir')
    
    $("#transportadora-autocomplete").val(traRazaoSocial);
    $("#transportadora").val(traCodigo);
    $("#infoexcluir").val(infoExcluir);
    $("#nfe").val(nfe);
    $("#anexoLogisticaAlt").val(anexo);
    $("#status").val(status);
    $("#status").val(status);
    $("#rota").val(rota);
    $("#codigo").val(codigo);
    $("#valor").text(valor);
    $("#valorcorrigido").val(valorCorrigido);
     $("#valorFrete").val(valorFrete);
    $("#pedidoerp").val(pedidoerp);
    $('#nomeCliente').text(clientelogistica);
    $('#codCliente').val(codclientelogistica);

    /*
   var codigo = $(this).data('perpid');
    var codControle = $("#codControle").val();
	
    $.ajax({
        url: appHosp+'',
        type: "POST",
        data: {
            codControle: codControle,
            codigo: codigo
        },
        success: function (result) {
           // alert(result);
            if (result) {
                alert("Cadastro excluido com Sucesso! \nCódigo " + result);
                atualizaDados();
				
                //location.reload();
            } else {
                alert("Erro ao excluir");
            }
        }
    });
    return false; //Evita que a página seja atualizada
    */
});
//end excluir pedido


//ADICIONA PEDIDO/ ALTERAR CADASTRO
$('#frmLogisticaPesq1').submit(function () {
    $.ajax({        
        url: appHosp+'/Logistica/buscarPedido',
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $("#id").html("<i class='fa fa-spinner fa-spin'></i> Salvando, aguarde...");
            $("#id").prop("disabled", true);
        },
        success: function (data) {
			//alert(data);
            if (data) {
				$('#tableLogisticaErp').html(data);
            }
        }
    });
     return false; //Evita que a página seja atualizada
});
//ADICIONA PEDIDO

//FUNÇÃO QUE ATUALIZA AS DADOS APOS INSERIR/ ALTERARR -------------------------
function atualizaLogistica() {
    alert(' alert');
    //MONTA OS COMENTÁRIOS NO MODAL
    $.ajax({        
        url: appHosp+'/Logistica/buscarPedido',
        type: "POST",
       
        beforeSend: function () {
            $("#salvarLogistica").html("<i class='fa fa-spinner fa-spin'></i> Salvando, aguarde...");
            $("#salvarLogistica").prop("disabled", true);
        },
        success: function (data) {
			alert(data);
            if (data) {
				$('#tableLogisticaErp').html(data);
            }else{
                alert(' sem dados');
            }
        }
    });
}

function enviarEmailValorCorrigido($idLogistica) {
   // alert(' testando execusao apos salvar '+$idLogistica);    
   $.ajax({        
        url: appHosp+'/Logistica/enviarEmail/'+$idLogistica,
        type: "POST",       
        success: function (data) {
			//alert(data);
            if (data) {
				//$('#tableLogisticaErp').html(data);
                alert(' E-mail informativo enviado com sucesso!');
            }else{
                alert(' Error: E-mail não enviado');
            }
        }
    });
    return false; //Evita que a página seja atualizada
}
