<script>
    $(function () {
        // iniciar sessão
        $('#form-login').validate({
            rules: {
                email: {
                    required: true,
                    maxlength: 191,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 191,
                },
            },
            messages: {
                email: {
                    required:  'O campo e-mail é obrigatório.',
                    maxlength: 'O campo e-mail não pode ser superior a {0} caracteres.',
                    email:     'O campo e-mail deve ser um endereço de e-mail válido.',
                },
                password: {
                    required:  'O campo senha é obrigatório.',
                    minlength: 'O campo senha deve ter pelo menos {0} caracteres.',
                    maxlength: 'O campo senha não pode ser superior a {0} caracteres.',
                },
            }
        });
    });
</script>
