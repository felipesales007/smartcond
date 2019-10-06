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

        // registrar
        $('#form-register').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersaccentedspace: true,
                },
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
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    maxlength: 191,
                    equalTo: '#password',
                },
            },
            messages: {
                name: {
                    required:             'O campo nome é obrigatório.',
                    minlength:            'O campo nome deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo nome não pode ser superior a {0} caracteres.',
                    lettersaccentedspace: 'O campo nome deve ter somente letras e espaços.',
                },
                email: {
                    required:             'O campo e-mail é obrigatório.',
                    maxlength:            'O campo e-mail não pode ser superior a {0} caracteres.',
                    email:                'O campo e-mail deve ser um endereço de e-mail válido.',
                },
                password: {
                    required:             'O campo senha é obrigatório.',
                    minlength:            'O campo senha deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo senha não pode ser superior a {0} caracteres.',
                },
                password_confirmation: {
                    required:             'O campo confirme a senha é obrigatório.',
                    minlength:            'O campo confirme a senha deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo confirme a senha não pode ser superior a {0} caracteres.',
                    equalTo:              'O campo confirme a senha de confirmação não confere.',
                },
            }
        });

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

        // recuperar senha
        $('#form-password-reset-update').validate({
            rules: {
                token: {
                    required: true,
                    minlength: 1,
                    maxlength: 191,
                },
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
                password_confirmation: {
                    required: true,
                    minlength: 8,
                    maxlength: 191,
                    equalTo: '#password',
                },
            },
            messages: {
                token: {
                    required:  'O campo token é obrigatório.',
                    minlength: 'O campo token deve ter pelo menos {0} caracteres.',
                    maxlength: 'O campo token não pode ser superior a {0} caracteres.',
                },
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
                password_confirmation: {
                    required:  'O campo confirme a senha é obrigatório.',
                    minlength: 'O campo confirme a senha deve ter pelo menos {0} caracteres.',
                    maxlength: 'O campo confirme a senha não pode ser superior a {0} caracteres.',
                    equalTo:   'O campo confirme a senha de confirmação não confere.',
                },
            }
        });
    });
</script>
