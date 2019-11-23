<script>
    $(function () {
        $('#form-send-email-admin').validate({
            rules: {
                name_send_email_admin: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersaccentedspace: true,
                },
                email_send_email_admin: {
                    required: true,
                    maxlength: 191,
                    email: true,
                },
                message_send_email_admin: {
                    required: true,
                    minlength: 10,
                    maxlength: 1500,
                },
            },
            messages: {
                name_send_email_admin: {
                    required:             'O campo nome é obrigatório.',
                    minlength:            'O campo nome deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo nome não pode ser superior a {0} caracteres.',
                    lettersaccentedspace: 'O campo nome deve ter somente letras e espaços.',
                },
                email_send_email_admin: {
                    required:             'O campo e-mail é obrigatório.',
                    maxlength:            'O campo e-mail não pode ser superior a {0} caracteres.',
                    email:                'O campo e-mail deve ser um endereço de e-mail válido.',
                },
                message_send_email_admin: {
                    required:             'O campo mensagem é obrigatório.',
                    minlength:            'O campo mensagem deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo mensagem não pode ser superior a {0} caracteres.',
                },
            }
        });
    });
</script>
