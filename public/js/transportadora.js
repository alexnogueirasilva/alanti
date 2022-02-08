var appHosp = $('#appHosp').val();//varivel constate atribuida no header


var tra_id = null;
//document.getElementById("numeroLicitacao").disabled = false;
$('#cadastroTransportadora').slideUp();

	var optionstransportadora = {
		url: function (transportadora) {
			//return "http://coisavirtual.com.br/ClienteLicitacao/autoComplete/" + cliente; //hospedagem
			return appHosp+"/Transportadora/autoComplete/" + transportadora;
			//return "http://localhost/SOMVC/ClienteLicitacao/autoComplete/" + cliente;
		},

		getValue: function (element) {
				return element.tra_razaosocial + ' - ' + element.tra_cnpj;
		},

		list: {
			onChooseEvent: function () {
				tra_id = $("#transportadora-autocomplete").getSelectedItemData().tra_id;

				$('#transportadora').val(tra_id);					
				$('#cadastroTransportadora').slideUp();					
			},
			onHideListEvent: function () {
				if (tra_id == null) {
					$('#transportadora-autocomplete').val('');
					$('#cadastroTransportadora').slideDown();
				
				}
			}
		}
	};
	$("#transportadora-autocomplete").easyAutocomplete(optionstransportadora);
/*
	$("#acao").val('');
var acao = '';
$(document).on("click", "#btnTraNovo", function () {	
	ativarInput();
	limparInput();
	$("#btnTraNovo").hide();
	$("#btnTraAlterar").hide();
	$("#btnTraExcluir").hide();
	$("#acao").val('novo');
});
$(document).on("click", "#btnTraAlterar", function () {
	codigo = $("#codigo").val();
	$("#btnTraNovo").hide();
	$("#btnTraExcluir").hide();
	if(codigo == ''){
		alert('Nenhum cadastro selecionado!');
	}
	ativarInput();
	$("#acao").val('alterar');		
});
if(acao == 'excluir'){
	$("#btnTraAlterar").hide();
	$("#btnTraNovo").hide();
	alert(acao);
}

$(document).on("click", "#btnTraExcluir", function () {
	$("#btnTraAlterar").hide();
	$("#btnTraNovo").hide();
var acao = $("#acao").val('excluir');
alert("acao");
	desativarInput();
});
$(document).on("click", "#btnTraEditar", function () {
	$("#acao").val('alterar');
	desativarInput();
});
$(document).on("click", "#visualizar", function () {
	ativarInput();
});

function ativarInput()
{
	document.getElementById("razaosocial").disabled = false;	
	document.getElementById("nomefantasia").disabled = false;	
	document.getElementById("cnpj").disabled = false;	
	document.getElementById("inscricaoestadual").disabled = false;	
	document.getElementById("numero").disabled = false;	
	document.getElementById("email").disabled = false;	
	document.getElementById("celular").disabled = false;	
	document.getElementById("contato").disabled = false;	
	document.getElementById("telefone").disabled = false;	
	document.getElementById("longradouro").disabled = false;	
	document.getElementById("contato").disabled = false;	
	document.getElementById("telefone").disabled = false;	
	document.getElementById("longradouro").disabled = false;	
	document.getElementById("status").disabled = false;	
	document.getElementById("complemento").disabled = false;	
	document.getElementById("pontoreferencia").disabled = false;	
	document.getElementById("observacao").disabled = false;	
	document.getElementById("bairro").disabled = false;	
//	document.getElementById("cidade").disabled = false;	

}
function limparInput()
{
	$("#razaosocial").val('');
	$("#nomefantasia").val('');
	$("#cnpj").val('');
	$("#codigo").val('');
	$("#inscricaoestadual").val('');
	$("#numero").val('');
	$("#email").val('');
	$("#celular").val('');
	$("#contato").val('');
	$("#telefone").val('');
	$("#longradouro").val('');
	$("#contato").val('');
	$("#telefone").val('');
	$("#longradouro").val('');
	$("#status").val('');
	$("#complemento").val('');
	$("#pontoreferencia").val('');
	$("#observacao").val('');
	$("#bairro").val('');
//	document.getElementById("cidade").val('');

}
function desativarInput()
{
	document.getElementById("btnVoltarTra").onclick = false;	

	document.getElementById("razaosocial").disabled = true;	
	document.getElementById("nomefantasia").disabled = true;	
	document.getElementById("cnpj").disabled = true;	
	document.getElementById("inscricaoestadual").disabled = true;	
	document.getElementById("numero").disabled = true;	
	document.getElementById("email").disabled = true;	
	document.getElementById("celular").disabled = true;	
	document.getElementById("contato").disabled = true;	
	document.getElementById("telefone").disabled = true;	
	document.getElementById("longradouro").disabled = true;	
	document.getElementById("contato").disabled = true;	
	document.getElementById("telefone").disabled = true;	
	document.getElementById("longradouro").disabled = true;	
	document.getElementById("status").disabled = true;	
	document.getElementById("complemento").disabled = true;	
	document.getElementById("pontoreferencia").disabled = true;	
	document.getElementById("observacao").disabled = true;	
	document.getElementById("bairro").disabled = true;	
	//document.getElementById("cidade").disabled = true;	

}
*/