<script>
    $(function () {
        // enviar e-mail de recuperar senha
        $('#form-password-reset').validate({
            rules: {
                email: {
                    required: true,
                    maxlength: 191,
                    email: true,
                },
            },
            messages: {
                email: {
                    required:  'O campo e-mail é obrigatório.',
                    maxlength: 'O campo e-mail não pode ser superior a {0} caracteres.',
                    email:     'O campo e-mail deve ser um endereço de e-mail válido.',
                },
            }
        });
    });
</script>
