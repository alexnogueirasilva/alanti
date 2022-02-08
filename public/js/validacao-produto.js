$().ready(function() {

    $('#form_cadastro_produto').validate({
        rules: {
            ProNome: {
                required: true
            }
        },
        messages: {
            ProNome: {
                required: "Este campo não pode ser vazio"
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }

    });

});