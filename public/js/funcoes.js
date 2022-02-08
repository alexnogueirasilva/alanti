var appHosp = $('#appHosp').val();//varivel constate atribuida no header
/*
$(document).ready(function(){
	document.getElementById('frmCadastro').addEventListener('submit', function(){ // CRIA EM EVENTO QUE É DISPARADO QUANDO O ELEMENTO DE ID 'form' FOR 'submetido/enviado'.
	var inputs = this.getElementsByTagName('input'); // PEGA TODOS OS INPUTS PRESENTES NESSE ELEMENTO
	var teste = 0;
	var tabela3;
	for(var i in inputs){ // ITERA OS INPUTS
		//teste = teste + 1;
		var input = inputs[i];
			if(input.type == 'checkbox'){ // CASO SEJA UM 'checkbox'
				input.value = input.checked; // SETA 'value' COM TRUE/FALSE DE ACORDO COM O CHECKED
				if(input.checked == true){
				//	alert("checked true js " +teste );
				teste = 1;
				}else{
					//alert("checked falso js  " +teste );
				teste = 0;
				}
				tabela3 = teste;
				alert("checked falso js  "  );
				$.ajax({ //Função AJAX
				//url:"http://coisavirtual.com.br/Permissao/cadastro",			//Arquivo php
					url:"http://localhost/SOMVC/permissao/salvar",			//Arquivo php
					//url:"http://localhost/SOMVC/App/Controllers/PermissaoController.php",			//Arquivo php
					type:"POST",				//Método de envio
					data: {tabela3:tabela3}	//Dados
				});
			}
			//input.checked = true; // SETA COMO CHECKED PARA QUE ELE SEJA ENVIADO, O VALOR VALIDO É O QUE ESTA NO 'value' DO ELEMENTO
		}
	});
});
*/



// begin multi select do select2
$('#emails, #kt_select2_3_validate').select2({
	placeholder: "Selecione um ou mais emails",
});
// end multi select do select2

if (document.getElementById("enviarEmail")) {
	if (document.getElementById("enviarEmail").checked == true) {
		document.getElementById("email").disabled = false;
	}
	$(document).on("click", "#enviarEmail", function () {
		//alert('teste');
		var chek = document.getElementById("enviarEmail");
		if (chek.checked == true) {

			document.getElementById("email").disabled = false;
		} else {
			$('#email').val('');
			document.getElementById("email").disabled = true;
		}
	});
}

if(document.getElementById('status')){
//	var Cliente = document.getElementById('status').options[document.getElementById('status').selectedIndex].innerText;

}
//alert(Cliente);
/*
$('#frmCadastro').submit(function(){
	var tabela = $("#tabela").val();
	if(document.getElementById("tabela").checked == true){
		alert('teste');
	}

	$.ajax({ //Função AJAX
			//url:"http://coisavirtual.com.br/Permissao/cadastro",			//Arquivo php
			url:"http://localhost/SOMVC/Permissao/cadastro",			//Arquivo php
			type:"post",				//Método de envio
			data: {tabela:tabela},	//Dados
			success: function (result){
				  /* if(result==1){
					   swal({
						title: "OK!",
						text: "Departamento Cadastrado com Sucesso!",
						type: "success",
						confirmButtonText: "Fechar",
						closeOnConfirm: false
					},

					function(isConfirm){
						if (isConfirm) {
								window.location = "cad_dep.php";
							}
					});

					   $("#nomeDep").val('');

				   }else{
					alert("Erro ao salvar");		//Informa o erro

					}
				});

		return false;//Evita que a página seja atualizada
	});

 */
 
 // begin buscar cnpj
$('#buscarCNPJ').slideUp();
function validarCnpj(){
	var cnpjExemplo = $('#cnpj').val();
	cnpjExemplo = cnpjExemplo.replace(/[^0-9]/g,'');
	if (cnpjExemplo.length == 14) {		
		$('#buscarCNPJ').slideDown();	
	} else if (cnpjExemplo.length > 14 || cnpjExemplo.length < 14){	
		$('#buscarCNPJ').slideUp();	
	}
}
$(document).on("click", "#buscarCNPJ", function(){
	var valor = $('#cnpj').val();
	var cnpj = valor.replace(/[^0-9]/g,'');//tratando deixando apenas numeros

	if(cnpj == ""){
		alert("CNPJ não informado!");
	}else{
		$.ajax({
			'url':  'https://www.receitaws.com.br/v1/cnpj/'+cnpj,//codumentacao em: https://receitaws.com.br/api
			'type': "GET",
			'dataType': 'jsonp',
			'success': function (result) {				
				if(result.status == "ERROR"){
					alert("STATUS: "+result.message);					
				}else{		
					document.getElementById('razaoSocial').value 	= result.nome;
					document.getElementById('nomeFantasia').value 	= result.fantasia;
					document.getElementById('cep').value 			= result.cep;
					document.getElementById('cnpj').value 			= cnpj;
					document.getElementById('longradouro').value 	= result.logradouro;
					document.getElementById('numero').value 		= result.numero;
					document.getElementById('complemento').value 	= result.complemento;
					document.getElementById('bairro').value 		= result.bairro;
					document.getElementById('telefone').value 		= result.telefone;
					document.getElementById('email').value 			= result.email;
				    //document.getElementById('cidade-autocomplete').value 		= result.municipio;// retirando o campo para buscar solução, sistema se perdendo ao localizar a cidade no cadastro do alanti
					
				}				
			}
		});
	}
	return false; //Evita que a página seja atualizada
 });
 //end buscar cnpj