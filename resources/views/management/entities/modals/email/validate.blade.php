<script>
    $(function () {
        $('#form-send-email-entity').validate({
            rules: {
                name_send_email_entity: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                },
                email_send_email_entity: {
                    required: true,
                    maxlength: 191,
                    email: true,
                },
                message_send_email_entity: {
                    required: true,
                    minlength: 10,
                    maxlength: 1500,
                },
            },
            messages: {
                name_send_email_entity: {
                    required:     'O campo nome fantasia é obrigatório.',
                    minlength:    'O campo nome fantasia deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome fantasia não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome fantasia deve ter somente letras, espaços e caracteres permitidos.',
                },
                email_send_email_entity: {
                    required:     'O campo e-mail é obrigatório.',
                    maxlength:    'O campo e-mail não pode ser superior a {0} caracteres.',
                    email:        'O campo e-mail deve ser um endereço de e-mail válido.',
                },
                message_send_email_entity: {
                    required:     'O campo mensagem é obrigatório.',
                    minlength:    'O campo mensagem deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo mensagem não pode ser superior a {0} caracteres.',
                },
            }
        });
    });
</script>
