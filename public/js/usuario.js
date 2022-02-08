//"use strict";
var appHosp = $('#appHosp').val();//varivel constate atribuida no header

//Begin Cadastrar/ Alterar e Excluir Usuarios
$('#frmModalUsuario').submit(function () {
 
    $.ajax({
        url: appHosp+'/Usuario/salvarUser',
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $("#btnUserSalvar").html("<i class='fa fa-spinner fa-spin'></i> Enviando, aguarde...");
           // $("#btnUserSalvar").prop("disabled", true);
        },
        success: function (result) {  
             alert(result);
            if (result ) {               
                alert(result);
                desativarButtonUser();
                limparInput();
                desativarInputUser(); 
                listarUsuarios();
            } else {
                alert("Erro ao salvar Cadastro! ");
            }
                      
            $('#modal_usuario').modal('hide');
        }
    });
    return false; //Evita que a página seja atualizada
});
//End Cadastrar/ Alterar e Excluir Usuarios

$(document).on("click", "#btnUserListar", function(){
    listarUsuarios();
});


//ADICIONA PEDIDO/ ALTERAR CADASTRO
$('#frmUserPesq').submit(function () {
    $.ajax({        
        url: appHosp+'/Usuario/listarUsuarios/',
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $("#id").html("<i class='fa fa-spinner fa-spin'></i> Pesquisando, aguarde...");
            $("#id").prop("disabled", true);
        },
        success: function (data) {
			//alert(data);
            if (data) {                
                $("#kt_table_10").dataTable().fnDestroy();
                $('#listarUsuarios').html(data);
                   $(document).ready(function() {
                       KTDatatablesAdvancedColumnVisibility10.init();
                   });
               }
        }
    });
     return false; //Evita que a página seja atualizada
});
//ADICIONA PEDIDO


$(document).on("click", "#btnUserNovo", function(){
    limparInput();
    ativarInputUser();
    action = $('#acao').val('0');//cadastrar
    
    $('#btnUserSalvar').slideDown();
    $('#btnUserDelete').slideUp();
    $('#btnUserUpdate').slideUp();   
    $('#btnUserSalvar').text('Salvar');
        
});

$(document).on("click", "#btnUserUpdate", function(){
    action = $('#acao').val('1');//alterar
    ativarInputUser();
    ativarButtonUser();
    $('#btnUserSalvar').slideDown();
    $('#btnUserUpdate').slideUp();
    $('#btnUserDelete').slideUp();
    $('#btnUserSalvar').text('Confirmar Alteracao');
    
});

$(document).on("click", "#btnUserDelete", function(){
    action = $('#acao').val('2');//excluir
    desativarInputUser();
    $('#btnUserSalvar').slideDown();
    $('#btnUserSalvar').text('Confirmar Exclusao');
    $('#btnUserUpdate').slideUp();
    $('#btnUserDelete').slideUp();
});

$(document).on("click", "#btnUserCancel", function(){
    limparInput();
    desativarInputUser();
    desativarButtonUser();
    action = $('#acao').val('');    
});
$(document).on("click", "#btnUserLimparFiltro", function(){
    limparPesquisaUser();
});
function limparPesquisaUser(){
    $("#codigoUser").val('');
    $("#nomeUsuarioPesq").val('');
    $("#departamentoPesq").val('');
    $("#numeroLicitacaoPesq").val('');
    $("#emailPesq").val('');
    $("#status2").val('');
   
}
function limparInput(){
    $("#codigo").val('');
    $("#nome").val('');
    $("#apelido").val('');
    $("#status").val('');
    $("#nivel").val('');
    $("#status").val('');
    $("#id_dep").val('');
    $("#email").val('');
    $("#dica").val('');
    $('#acao').val('');            
    $('#omeUsuario').val(''); 
}
//begin pegar dados para edicao
$(document).on("click", "#btnUserVisualizar", function(){
	$("#nome").focus();
    var codigo = $(this).data('codigo');
    var nome = $(this).data('nome');
    var apelido = $(this).data('apelido');
    var statusId = $(this).data('statusid');
    var status = $(this).data('status');
    var nivel = $(this).data('nivel');
    //var nomeDepartamento = $(this).data('nomedepartamento');
    var codDepartamento = $(this).data('departamento');
    var email = $(this).data('email');
    var dica = $(this).data('dica');
            
    $("#codigo").val(codigo);
    $("#nome").val(nome);
    $("#nomeUsuario").text(nome);
    $("#apelido").val(apelido);
    $("#status").val(statusId);
    $("#statusId").val(statusId);
    $("#nivel").val(nivel);
    $("#id_dep").val(codDepartamento);
    $("#email").val(email);
    $("#dica").val(dica);    
    ativarButtonUser();
    desativarInputUser();
    $('#btnUserSalvar').slideUp();
});
//end pegar dados para edicao

function desativarButtonUser(){
    $('#btnUserNovo').slideUp();    
    $('#btnUserDelete').slideUp();
    $('#btnUserUpdate').slideUp();
    $('#btnUserSalvar').text('Salvar');
}

function ativarButtonUser(){
    $('#btnUserNovo').slideDown();
    $('#btnUserDelete').slideDown();
    $('#btnUserUpdate').slideDown();
}

function desativarInputUser(){
    document.getElementById("nome").disabled = true;
    document.getElementById("apelido").disabled = true;
    document.getElementById("email").disabled = true;
    document.getElementById("dica").disabled = true;
    document.getElementById("senha").disabled = true;
    document.getElementById("nivel").disabled = true;
    document.getElementById("id_dep").disabled = true;
    document.getElementById("status").disabled = true;
    
}

function ativarInputUser(){
    document.getElementById("nome").disabled = false;
    document.getElementById("apelido").disabled = false;
    document.getElementById("email").disabled = false;
    document.getElementById("dica").disabled = false;
    document.getElementById("senha").disabled = false;
    document.getElementById("nivel").disabled = false;
    document.getElementById("id_dep").disabled = false;
    document.getElementById("status").disabled = false;
}



var KTDatatablesAdvancedColumnVisibility10 = function() {

    var initTable10 = function() {
       
        var table = $('#kt_table_10');   
       
		// begin first table
		table.DataTable({
			responsive: true,
			columnDefs: [
				{
					// oculta coluna por numero de idex
					targets: false,
					 //targets: [0, 3],
					visible: false,
				},
				{
					//coluna de funcoes
					targets: -1,//definindo posição da colula
					title: 'Acoes',//definindo o nome da coluna
					orderable: false,					
				},
				{
					targets:-3,//definindo em qual coluna vai executar esta funcao
					render: function(data, type, full, meta) {
						var status = {
							11111: {'title': 'Pending', 'class': 'kt-badge--brand'},
							D: {'title': 'Dasativado', 'class': ' kt-badge--danger'},
							A: {'title': 'Ativo', 'class': ' kt-badge--success'},
							0: {'title': 'Não', 'class': ' kt-badge--danger'},
							1: {'title': 'Sim', 'class': ' kt-badge--success'},
							'Desativado': {'title': 'Desativado', 'class': ' kt-badge--danger'},
							'NAO': {'title': 'Não', 'class': ' kt-badge--danger'},
							'SIM': {'title': 'Sim', 'class': ' kt-badge--success'},
							'Ativo': {'title': 'Ativo', 'class': ' kt-badge--success'},
							55555: {'title': 'Info', 'class': ' kt-badge--info'},
							66666: {'title': 'Negado', 'class': ' kt-badge--danger'},
							77777: {'title': 'Em Analise', 'class': ' kt-badge--warning'},
							'ANALISE FINANCEIRO': {'title': 'Analise Financeiro', 'class': ' kt-badge--warning'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="kt-badge ' + status[data].class + ' kt-badge--inline kt-badge--pill">' + status[data].title + '</span>';
					},
				},
				{
					targets: -3,//definindo em qual coluna vai executar esta funcao
					render: function(data, type, full, meta) {
						var status = {							
							'Desativado': {'title': 'Desativado', 'state': 'danger'},
							'NEGADO': {'title': 'NEGADO', 'state': 'danger'},							
							'RECEPCIONADO': {'title': 'RECEPCIONADO', 'state': 'primary'},
							'Ativo': {'title': 'Ativo', 'state': 'success'},
							'ANALISE FINANCEIRO': {'title': 'ANALISE FINANCEIRO', 'state': 'warning'},
							'AUTORIZADO': {'title': 'AUTORIZADO', 'state': 'warning'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="kt-badge kt-badge--' + status[data].state + ' kt-badge--dot"></span>&nbsp;' +
							'<span class="kt-font-bold kt-font-' + status[data].state + '">' + status[data].title + '</span>';
					},
				},
			],
		});
    };
        return {
            
            //main function to initiate the module
            init: function() {
                initTable10();
            },
            
        };
        
}();
/*$(document).ready(function() {
    KTDatatablesAdvancedColumnVisibility10.init();
});
*/
function listarUsuarios() {	      
    $.ajax({
        url: appHosp+'/Usuario/listarUsuarios/',
        type: "POST",        
        success: function (data) {	
           // alert(data);
         if (data) {                
             $("#kt_table_10").dataTable().fnDestroy();
             $('#listarUsuarios').html(data);
                $(document).ready(function() {
                    KTDatatablesAdvancedColumnVisibility10.init();
                });
            }
        }
    });
}
