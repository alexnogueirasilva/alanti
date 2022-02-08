

var appHosp = $('#appHosp').val();//varivel constate atribuida no header

var codigo = $('#codControle').val();

if(codigo != ""){
	atualizaMsg();
}
//codControle
$(document).on("click", "#btnAdicionarPedido", function () {

	//var numeroNota = $('#numeroNota').val();
	var numeroPedido = $('#numeroPedidoErp').val();
	var valor = $('#valorPedidoErp').val();
	if (valor == '0,00') {
        alert(" favor informar o valor do pedido ");
    }else if (numeroPedido != '' && valor != '') {
		tproduto(numeroPedido, valor);
	} else {
		alert(" favor prencher todos os dados do pedido ");
	}
});

function tproduto( numeroPedido, valor) {
	$('#kt_table_3').append('<tr>' +
		'<td>' + numeroPedido + ' 	<input type="hidden" value="'+ numeroPedido +'" id="pedidos[]" name="pedidos[]"></td>' +
		//'<td>' + numeroNota + ' 	<input type="hidden" value="'+ numeroNota +'" name="pedidos[]"></td>' +
		'<td>R$' + valor + ' 		<input type="hidden" value="'+ valor +'" id="pedidos[]" name="pedidos[]"></td>' +
		'<td><a class="btn btn-outline-danger btn-sm  btn-elevate btn-pill btn-elevate-air" id="removePedido" onClick="app.removePedido(this,' + numeroPedido + ')">excluir' +
		'<a class="btn btn-outline-warning btn-sm  btn-elevate btn-pill btn-elevate-air" id="editarPedido" onClick="app.editarPedido(this,' + numeroPedido + ')">Editar</td>' +
		'</tr>');
	$("#numeroPedidoErp").val('');
	//$("#numeroNota").val('');
	$("#valorPedidoErp").val('');
	atualizaMsg();
}

$(document).on("click", "#removePedido", function () {
	$(this).parent().parent().remove();
});
$(document).on("click", "#editarPedido", function () {	
	var teste1 = $(this).parent().parent().text();
alert(' funcao em desenvolvimento ' );
});
/*
<script>

function buscar(palavra)
{
	//O método $.ajax(); é o responsável pela requisição
	$.ajax
			({
				//Configurações
				type: 'POST',//Método que está sendo utilizado.
				dataType: 'html',//É o tipo de dado que a página vai retornar.
				url: '.php',//Indica a página que está sendo solicitada.
				//função que vai ser executada assim que a requisição for enviada
				beforeSend: function () {
					$("#pedidoerp").html("Carregando...");
				},
				data: {palavra: palavra},//Dados para consulta
				//função que será executada quando a solicitação for finalizada.
				success: function (msg)
				{
					$("#dados").html(msg);
				}
			});

$('#buscar').click(function () {
	buscar($("#palavra").val())
});
</script>
*/

//ADICIONA PEDIDO
$('#frmAdicionarPedido1').submit(function () {
    var numeroPedido = $("#numeroPedidoErp").val();
    var valorPedido = $("#valorPedidoErp").val();
    var codControle = $("#codControle").val();
	var usuario = $("#usuario").val();
	
    $.ajax({
        url: appHosp+'/pedidoErp/salvar',
        type: "POST",
        data: {
            numeroPedido: numeroPedido,
            valorPedido: valorPedido,
            codControle: codControle,
            usuario: usuario
        },
        success: function (result) {
            //alert(result);
            if (result) {
                alert("Pedido incluido com Sucesso! \nCódigo " + result);
                atualizaMsg();
				$("#numeroNota").val('');
				
				$("#numeroPedidoErp").val('');
				$("#valorPedidoErp").val('');
                //location.reload();
            } else {
                alert("Erro ao salvar");
            }
        }
    });
    return false; //Evita que a página seja atualizada
});
//ADICIONA PEDIDO

//FUNÇÃO QUE ATUALIZA AS MENSAGENS NOS DETALHES APÓS SUBMETE-LA -------------------------
function atualizaMsg() {
    var codControle = $("#codControle").val();
	
    //MONTA OS COMENTÁRIOS NO MODAL
    $.ajax({
        url: appHosp+'/pedidoErp/buscarPedido/' + codControle,
        type: "POST",
        data: {            
            	codControle: codControle
        },
        success: function (data) {
			//alert(data);
            if (data) {
				$('#adicionarPedidoErp').html(data);
            }
        }
    });
}
//begin pegar dados para edicao
$(document).on("click", "#btnEditarPedidoErp", function(){
	$("#numeroPedidoErp").focus();
    var codigo = $(this).data('perpid');
    var valor = $(this).data('perpvalor');
    var numero = $(this).data('perpnumero');
    
    $("#valorPedidoErp").val(valor);
    $("#numeroPedidoErp").val(numero);
    $("#perpid").val(codigo);
});
//end pegar dados para edicao

//begin salvar pedido (cadatro e alteracao)
$(document).on("click", "#btnAdicionarPedidoErp", function(){
    $("#numeroPedidoErp").focus();  
	var numeroPedido = $("#numeroPedidoErp").val();
    var valorPedido = $("#valorPedidoErp").val();
    var codControle = $("#codControle").val();
	var usuario = $("#usuario").val();
    var codigo = $("#perpid").val();
    var statusPedido = "ATENDIDO";
    var mensagem = 'Cadastrado';
    if(codigo !=''){
        mensagem = 'Alterado';
    }
        $.ajax({
            url: appHosp+'/pedidoErp/salvar',
            type: "POST",
            data: {
                numeroPedido: numeroPedido,
                valorPedido: valorPedido,
                codControle: codControle,
                codigo: codigo,
                statusPedido: statusPedido,
                usuario: usuario
            },
            success: function (result) {
                //alert(result);
                if (result) {
                    if (result> 0) {
                        alert("Pedido "+mensagem+" com Sucesso! \nCódigo " + result);
                        atualizaMsg();                    
                        $("#numeroPedidoErp").val('');
                        $("#valorPedidoErp").val('');
                        //location.reload();
                    } else {
                        alert("Duplicidade! \n " + result);
                    }
                } else {
                    alert("Erro ao salvar");
                }
        }
    });	
	return false; //Evita que a página seja atualizada
});
//end salvar pedido (cadatro e alteracao)

//begin excluir pedido
$(document).on("click", "#btnExluirPedidoErp", function(){
   
   var codigo = $(this).data('perpid');
    var codControle = $("#codControle").val();
	var statusPedido = "EXCLUIDO";
    $.ajax({
        url: appHosp+'/pedidoErp/excluir',
        type: "POST",
        data: {
            codControle: codControle,
            statusPedido: statusPedido,
            codigo: codigo
        },
        success: function (result) {
           // alert(result);
            if (result) {
                alert("Cadastro excluido com Sucesso! \nCódigo " + result);
                atualizaMsg();
				
                //location.reload();
            } else {
                alert("Erro ao excluir");
            }
        }
    });
	return false; //Evita que a página seja atualizada
});
//end excluir pedido