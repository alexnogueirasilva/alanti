//"use strict";
var appHosp = $('#appHosp').val();//varivel constate atribuida no header

//Begin Cadastrar/ Alterar e Excluir
$('#frmModalEdital').submit(function () {
 
    $.ajax({
        url: appHosp+'/Edital/salvarEdital',
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $("#btnEditalSalvar").html("<i class='fa fa-spinner fa-spin'></i> Enviando, aguarde...");
           // $("#btnEditalSalvar").prop("disabled", true);
        },
        success: function (result) {            
           // alert(result);
            if (result ) {               
                desativarButton();
                limparInput();
                desativarInput(); 
                listarEditais();
                $('#modal_edital').modal('hide');
            } else {
                $('#modal_edital').modal('show');
                alert("Erro ao salvar Cadastro");
            }                      
        }
    });
    return false; //Evita que a página seja atualizada
});
//End Cadastrar/ Alterar e Excluir Editais
/*
$(document).on("click", "#btnEditalListar", function(){
    listarEditais();
});
*/
$(document).on("click", "#btnEditalLimpar", function(){
    limparPesquisa();
});
//BEGIN PESQUISAR
$('#frmEditalPesq').submit(function () { 
    $.ajax({        
        url: appHosp+'/Edital/listarEditais/',
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $("#btnPesqEdital").html("<i class='fa fa-spinner fa-spin'></i> Pesquisando, aguarde...");
        },
        success: function (data) {			
            if (data) {                
                $("#kt_table_Editais").dataTable().fnDestroy();
                $('#listarEditais').html(data);
                   $(document).ready(function() {
                       KTDatatablesAdvancedColumnVisibilityEditais.init();
                   });
               }
               $("#btnPesqEdital").html("Pesquisar");
        }
    });
     return false; //Evita que a página seja atualizada
});
//END PESQUISAR
//begin limpar campos para novo cadastro
$(document).on("click", "#btnEditalNovo", function(){
    limparInput();
    ativarInput();
    $('#acao').val('0');//cadastrar
    $('#btnEditalSalvar').slideDown();
    $('#btnEditalDelete').slideUp();
    $('#btnEditalUpdate').slideUp();   
    $('#btnEditalSalvar').text('Salvar');      
});
//end limpar campos para novo cadastro

//begin ativar campos para update cadastro
$(document).on("click", "#btnEditalUpdate", function(){
    $('#acao').val('1');//alterar    
    ativarInput();
    ativarButton();
    $('#btnEditalSalvar').slideDown();
    $('#btnEditalUpdate').slideUp();
    $('#btnEditalDelete').slideUp();
    $('#btnEditalSalvar').text('Confirmar Alteracao');
});
//end ativar campos para update cadastro

$(document).on("click", "#btnEditalDelete", function(){
    $('#acao').val('2');//excluir
    ativarInput();
    $('#btnEditalSalvar').slideDown();
    $('#btnEditalUpdate').slideUp();
    $('#btnEditalDelete').slideUp();
    $('#btnEditalSalvar').text('Confirmar Exclusao');
});

$(document).on("click", "#btnEditalCancel", function(){
    limparInput();
    desativarInput();
    desativarButton();
    action = $('#acao').val('');    
});

//begin pegar dados para visualizar
$(document).on("click", "#btnEditalVisualizar", function(){
   
    //$("#nomeCliente").focus();
    var codigoEdital        = $(this).data('codigoedital');
    var nomeCliente         = $(this).data('nomecliente');
    var codigoCliente       = $(this).data('codigocliente');
    var numeroEdital        = $(this).data('numeroedital');
    var nomeEmpresa         = $(this).data('nomeempresa');
    var modalidadeEdital    = $(this).data('modalidadeedital');
    var nomeDepartamento    = $(this).data('tipoedital');
    var garantia            = $(this).data('garantiaedital');
    var statusEdital        = $(this).data('statusedital');
    var codStatusEdital     = $(this).data('codstatusedital');
    var dataAbertura        = $(this).data('dataabertura');
    var horaAbertura        = $(this).data('horaabertura');
    var dataLimite          = $(this).data('datalimite');
    var horaLimite          = $(this).data('horalimite');
    var proposta            = $(this).data('proposta');
    var tipo                = $(this).data('tipoedital');
    var portal              = $(this).data('portal');
    var idPortal            = $(this).data('idportal');
    var observacao          = $(this).data('observacao');
    var analise             = $(this).data('analise');
    var codRepresentante    = $(this).data('codrepresentante');
    var nomeRepresentante   = $(this).data('nomerepresentante');
    var empresa             = $(this).data('empresa');
    var operador            = $(this).data('operador');
    var idOperador          = $(this).data('idoperador');
    var anexo               = $(this).data('anexo');
    
    $("#clienteLicitacao-autocomplete").val(nomeCliente);
    $("#clienteEditalTitulo").text(nomeCliente);
    $("#cliente").val(codigoCliente);
    $("#codigo").val(codigoEdital);
    $("#modalidade").val(modalidadeEdital);
    $("#numeroLicitacao").val(numeroEdital);
    $("#status").val(codStatusEdital);
    //$("#status").val(statusEdital);
    $("#codRepresentante").val(codRepresentante);
    //$("#codRepresentante").val(nomeRepresentante);
    $("#proposta").val(proposta);
    $("#tipo").val(tipo);
    $("#portal").val(portal);
    $("#identificador").val(idPortal);
    $("#observacao").val(observacao);
    $("#analise").val(analise);
    $("#hora").val(horaAbertura);
    $("#horaLimite").val(horaLimite);
    $("#dataAbertura").val(dataAbertura);
    $("#dataLimite").val(dataLimite);
    $("#garantia").val(garantia);
    $("#codInstituicao").val(empresa);
    $("#operador").val(operador);
    $("#anexoAlt").val(anexo);
    $("#verAnexoEdt").html("<a class='dropdown-item' href='"+appHosp+"/public/assets/media/anexos/"+ anexo+"' target='_blank' title='Visualizar Anexo' class='btn btn-info btn-sm'><i class='la la-chain'></i>Anexo</a>");
    ativarButton();
    $('#btnEditalSalvar').slideUp();
    desativarInput();
});
//end pegar dados para visualizar

//begin pegar dados digitado nome do edital e coloca na barra de titulo
$('#clienteLicitacao-autocomplete').keyup(function(){
    var nome = $('#clienteLicitacao-autocomplete').val();
    $("#clienteEditalTitulo").text(nome);
 });
//end pegar dados digitado nome do edital e coloca na barra de titulo

// end visuakuzar anexo

function desativarButton(){
    $('#btnEditalNovo').slideUp();    
    $('#btnEditalDelete').slideUp();
    $('#btnEditalUpdate').slideUp();
    $('#btnEditalSalvar').text('Salvar');
}

function ativarButton(){
    $('#btnEditalNovo').slideDown();
    $('#btnEditalDelete').slideDown();
    $('#btnEditalUpdate').slideDown();
}

function limparPesquisa(){
    $("#codClientePesq").val('');
    $("#codigoPesq").val('');
    $("#propostaPesq").val('');
    $("#numeroLicitacaoPesq").val('');
    $("#modalidadePesq").val('');
    $("#statusPesq").val('');
    $("#tipoPesq").val('');
    $("#codRepresentantePesq").val('');
}
function limparInput(){
    $("#codigo").val('');
    $("#clienteLicitacao-autocomplete").val('');
    $("#cliente").val('');
     $("#modalidade").val('');
     $("#numeroLicitacao").val('');
     $("#status").val('');
     $('#acao').val('');
     $("#codRepresentante").val('');
     //$("#codRepresentante").val(nomeRepresentante);
     $("#proposta").val('');
     $("#tipo").val('');
     $("#portal").val('');
     $("#identificador").val('');
     $("#observacao").val('');
     $("#analise").val('');
     $("#hora").val('');
     $("#horaLimite").val('');
     $("#dataAbertura").val('');
     $("#dataLimite").val('');
     $("#garantia").val('');
     $("#codInstituicao").val('');
     $("#operador").val('');
     $("#anexoAlt").val('');     
     $("#verAnexoEdt")
}
function desativarInput(){
    document.getElementById("clienteLicitacao-autocomplete").disabled = true;
    document.getElementById("cliente").disabled = true;
    document.getElementById("modalidade").disabled = true;
    document.getElementById("numeroLicitacao").disabled = true;
    document.getElementById("status").disabled = true;
    document.getElementById("codRepresentante").disabled = true;
    document.getElementById("proposta").disabled = true;
    document.getElementById("tipo").disabled = true;
    document.getElementById("portal").disabled = true;
    document.getElementById("identificador").disabled = true;
    document.getElementById("observacao").disabled = true;
    document.getElementById("analise").disabled = true;
    document.getElementById("hora").disabled = true;
    document.getElementById("horaLimite").disabled = true;
    document.getElementById("dataAbertura").disabled = true;
    document.getElementById("dataLimite").disabled = true;
    document.getElementById("garantia").disabled = true;
    document.getElementById("codInstituicao").disabled = true;
    document.getElementById("operador").disabled = true;
    document.getElementById("anexoAlt").disabled = true;
    document.getElementById("anexo").disabled = true;
    document.getElementById("verAnexoEdt").disabled = true;    
}

function ativarInput(){
    document.getElementById("clienteLicitacao-autocomplete").disabled = false;
    document.getElementById("cliente").disabled = false;
    document.getElementById("modalidade").disabled = false;
    document.getElementById("numeroLicitacao").disabled = false;
    document.getElementById("status").disabled = false;
    document.getElementById("codRepresentante").disabled = false;
    document.getElementById("proposta").disabled = false;
    document.getElementById("tipo").disabled = false;
    document.getElementById("portal").disabled = false;
    document.getElementById("identificador").disabled = false;
    document.getElementById("observacao").disabled = false;
    document.getElementById("analise").disabled = false;
    document.getElementById("hora").disabled = false;
    document.getElementById("horaLimite").disabled = false;
    document.getElementById("dataAbertura").disabled = false;
    document.getElementById("dataLimite").disabled = false;
    document.getElementById("garantia").disabled = false;
    document.getElementById("codInstituicao").disabled = false;
    document.getElementById("operador").disabled = false;
    document.getElementById("anexoAlt").disabled = false;
    document.getElementById("anexo").disabled = false;
    document.getElementById("verAnexoEdt").disabled = false;    
}

var KTDatatablesAdvancedColumnVisibilityEditais = function() {

    var initTable = function() {
       
        var table = $('#kt_table_Editais');   
       
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
					targets:-7,//definindo em qual coluna vai executar esta funcao
					render: function(data, type, full, meta) {
						var status = {
							'LANCAMENTO FECHADO': {'title': 'LANCAMENTO FECHADO', 'class': 'kt-badge--brand'},
							D: {'title': 'Dasativado', 'class': ' kt-badge--danger'},
							A: {'title': 'Ativo', 'class': ' kt-badge--success'},
							0: {'title': 'Não', 'class': ' kt-badge--danger'},
							1: {'title': 'Sim', 'class': ' kt-badge--success'},
							'Desativado': {'title': 'Desativado', 'class': ' kt-badge--danger'},
							'NAO': {'title': 'Não', 'class': ' kt-badge--danger'},
							'SIM': {'title': 'Sim', 'class': ' kt-badge--success'},
							'CONTRATO': {'title': 'CONTRATO', 'class': ' kt-badge--success'},
							'ARREMATADO': {'title': 'ARREMATADO', 'class': ' kt-badge--success'},
							'RECEPCIONADO': {'title': 'RECEPCIONADO', 'class': ' kt-badge--info'},
							'EM PARTICIPACAO': {'title': 'EM PARTICIPACAO', 'class': ' kt-badge--info'},
							66666: {'title': 'Negado', 'class': ' kt-badge--danger'},
							'ANALISE INICIAL': {'title': 'ANALISE INICIAL', 'class': ' kt-badge--warning'},
							'DESISTIDO': {'title': 'DESISTIDO', 'class': ' kt-badge--warning'},
							'DESCLASSIFICADO': {'title': 'DESCLASSIFICADO', 'class': ' kt-badge--danger'},
							'ANULADO': {'title': 'ANULADO', 'class': ' kt-badge--danger'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="kt-badge ' + status[data].class + ' kt-badge--inline kt-badge--pill">' + status[data].title + '</span>';
					},
				},
				{
					targets: -6,//definindo em qual coluna vai executar esta funcao
					render: function(data, type, full, meta) {
						var status = {							
							'DESCLASSIFICADO': {'title': 'DESCLASSIFICADO', 'state': 'danger'},
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
                initTable();
            },
            
        };
        
}();
/*$(document).ready(function() {
    KTDatatablesAdvancedColumnVisibilityEditais10.init();
});
*/

function listarEditais() {	       
    var codigoPesq = $("#codigoPesq").val();
    var operadorPesq = $("#operadorPesq").val();
    var propostaPesq = $("#propostaPesq").val();
    var numeroLicitacaoPesq = $("#numeroLicitacaoPesq").val();
    var modalidadePesq = $("#modalidadePesq").val();
    var statusPesq = $("#statusPesq").val();
    var tipoPesq = $("#tipoPesq").val();
    var codRepresentantePesq = $("#codRepresentantePesq").val();
    var codClientePesq = $("#codClientePesq").val();
    
    $.ajax({
        url: appHosp+'/Edital/listarEditais/',
        type: "POST",  
        data: {
            codClientePesq:         codClientePesq,
            codRepresentantePesq:   codRepresentantePesq,
            codigoPesq:             codigoPesq,
            operadorPesq:           operadorPesq,
            propostaPesq:           propostaPesq,
            numeroLicitacaoPesq:    numeroLicitacaoPesq,
            modalidadePesq:         modalidadePesq,
            statusPesq:             statusPesq, 
            tipoPesq:               tipoPesq

        },
        contentType: false,
        cache: false,
        processData: false,      
        success: function (data) {	
         if (data) {                
             $("#kt_table_Editais").dataTable().fnDestroy();
             $('#listarEditais').html(data);
                $(document).ready(function() {
                    KTDatatablesAdvancedColumnVisibilityEditais.init();
                });
            }
        }
    });
}

if (document.getElementById("status")) {
    $('#status').change(function() {
        msgJustificarEdital();
    });
        msgJustificarEdital();
};
function msgJustificarEdital() {
    var justificativa = $('#txtJustificarEdital').val();   
    var option = $( "#status option:selected" ).val();
    if(option == 11 || option == 12 || option == 13 || option == 14 || option == 15 || justificativa != ""){
        if (document.getElementById("msgJustificarEdital")) {
            $('#msgJustificarEdital').html("<label class=''><span class='text-danger'>* </span>Justificativa:</label><textarea class='form-control' minlength='1' title='Favor informar justificativa do status atual' rows='3' placeholder='Favor informar justificativa do status atual' id='justificarEdital' name='justificarEdital' ></textarea><span class='form-text text-muted'>Digite a mensagem Justificativa</span>");
            $("#justificarEdital").text(justificativa);
        }
    }else{
        if (document.getElementById("msgJustificarEdital")) {
            $('#msgJustificarEdital').html("");
            $('#justificarEdital').html("");
        }
    }
}
