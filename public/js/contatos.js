var item = null;
var appHosp = $('#appHosp').val();//varivel constate atribuida no header

var codPessoa = $('#pessoa').val();

if(codPessoa != ""){
	atualizaContatos();
}

$(document).on("click", "#btnAdicionarContato", function () {
    
    var contato = $('#cnt_contato').val();
	var cargo = $('#cnt_cargo').val();
	var email = $('#cnt_email').val();
	var telefone = $('#cnt_telefone').val();
	var celular = $('#cnt_celular').val();
	
	 if (contato != '' && cargo != '') {
		adicionarcontatos(contato, cargo, email, telefone, celular);
	} else {
		alert("Favor Verificar os Campos Contato e Cargo São Obrigatorios ");
	}
});

function adicionarcontatos( contato, cargo, email, telefone, celular) {
	$('#kt_table_3').append('<tr>' +
		'<td>' + contato + ' <input type="hidden" value="" id="cnt_contatos[]" name="cnt_contatos[]">	<input type="hidden" value="'+ contato +'" id="cnt_contato[]" name="cnt_contato[]"></td>' +		
		'<td>' + cargo + ' 		<input type="hidden" value="'+ cargo +'" id="cnt_cargo[]" name="cnt_cargo[]"></td>' +
		'<td>' + email + ' 		<input type="hidden" value="'+ email +'" id="cnt_email[]" name="cnt_email[]"></td>' +
		'<td>' + telefone + ' 	<input type="hidden" value="'+ telefone +'" id="cnt_telefone[]" name="cnt_telefone[]"></td>' +
		'<td>' + celular + ' 	<input type="hidden" value="'+ celular +'" id="cnt_celular[]" name="cnt_celular[]"></td>' +
		'<td><a class="btn btn-outline-danger btn-sm  btn-elevate btn-pill btn-elevate-air" id="removeContato" onClick="app.removeContato(this,' + contato + ')">excluir' +
		'<a class="btn btn-outline-warning btn-sm  btn-elevate btn-pill btn-elevate-air" id="editarContato" onClick="app.editarContato(this,' + contato + ')">Editar</td>' +
		'</tr>');
	$("#cnt_contato").val('');
	$("#cnt_telefone").val('');
	$("#cnt_cargo").val('');
	$("#cnt_email").val('');
	$("#cnt_celular").val('');
	//atualizaContatos();
}

$(document).on("click", "#removeContato", function () {
	$(this).parent().parent().remove();
});
$(document).on("click", "#editarContato", function () {	
	var teste1 = $(this).parent().parent().text();
alert(' funcao em desenvolvimento ' );
});

//begin pegar dados para edicao
$(document).on("click", "#btnEditarContato", function(){
	$("#cnt_contato").focus();
	var contato 		= $(this).data('cntcontato');
	var contatoId 		= $(this).data('cntcontatoid');
	var cargo 			= $(this).data('cntcargo');
	var email 			= $(this).data('cntemail');
	var telefone 		= $(this).data('cnttelefone');
	var celular 		= $(this).data('cntcelular');	

    $("#contatoid").val(contatoId);
    $("#cnt_contato").val(contato);
    $("#cnt_cargo").val(cargo);
    $("#cnt_email").val(email);
	$("#cnt_telefone").val(telefone);
	$("#cnt_celular").val(celular);
});
//end pegar dados para edicao

//begin salvar (cadatro e alteracao)
$(document).on("click", "#btnAdicionarAlterarContato", function(){
    $("#cnt_contato").focus();  
	var contatoid 		= $("#contatoid").val();
    var cnt_contato 		= $("#cnt_contato").val();
    var cnt_cargo 		= $("#cnt_cargo").val();
    var cnt_email 		= $("#cnt_email").val();
	var cnt_telefone 	= $("#cnt_telefone").val();
	var cnt_celular 	= $("#cnt_celular").val();
	var pessoa 			= $('#pessoa').val();
	var mensagem 		= 'Cadastrado';
	if (cnt_contato != '' && cnt_cargo != '' && pessoa != '') {		
	
		if(contatoid !=''){
			mensagem = 'Alterado';
		}
	
        $.ajax({
            url: appHosp+'/contato/salvar',
            type: "POST",
            data: {
                contatoid: 		contatoid,
                cnt_contato: 	cnt_contato,
                cnt_cargo: 		cnt_cargo,
                cnt_email: 		cnt_email,
                cnt_celular: 	cnt_celular,
                cnt_telefone: 	cnt_telefone,
                pessoa: 		pessoa
            },
            success: function (result) {
                //alert(result);
                if (result) {
                    alert("Cadastro "+mensagem+" com Sucesso! \nCódigo " + result);
                    atualizaContatos();                    
                   
                    $("#cnt_contato").val('');
                    $("#cnt_cargo").val('');
                    $("#cnt_email").val('');
                    $("#cnt_telefone").val('');
                    $("#cnt_celular").val('');
  
                } else {
                    alert("Erro ao salvar");
                }
        }
	});	
	} else {
		alert("Favor Verificar os Campos Contato e Cargo São Obrigatorios ");
	}
	return false; //Evita que a página seja atualizada
});
//end salvar  (cadatro e alteracao)



//begin excluir pedido
$(document).on("click", "#btnApagarContato", function(){
	var codigo 	= $(this).data('contatoid');
	var nome 	= $(this).data('nomecontato');
	$('#contatoid').val(codigo);
	$('#nomecontato').text(nome);
});

$(document).on("click", "#btnExluirContato", function(){
	var codigo = $('#contatoid').val();
	
	if(codigo == ""){
		alert("Cadastro nao informado!");
	}else{
		$.ajax({
			url: appHosp+'/contato/excluir',
			type: "POST",
			data: {			 
				codigo: codigo
			},
			success: function (result) {
				// alert(result);
				if (result) {
					alert("Cadastro excluido com Sucesso! \nCódigo " + result);
					$('#apagarContato').modal('hide');
					atualizaContatos();
				} else {
					alert("Erro ao excluir Cadastro");
				}
			}
		});
	}
	return false; //Evita que a página seja atualizada
 });
 //end excluir pedido

function atualizaContatos() {
    var codPessoa = $("#pessoa").val();
  	//alert(" contat- codigo pessoa "+codPessoa);
    $.ajax({
        url: appHosp+'/contato/buscarContatos/' + codPessoa,
        type: "POST",
        data: {            
            	codPessoa: codPessoa
        },
        success: function (data) {
			//alert(data);
            if (data) {
				$('#tblcontatos').html(data);
            }
        }
    });
}