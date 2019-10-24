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

        // confirmar senha
        $('#form-password-confirm').validate({
            rules: {
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 191,
                    remote: {
                        url: '{{ app('router')->has('profile.check.password') ? route('profile.check.password') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            password: function () {
                                return $('#password').val();
                            }
                        },
                        dataFilter: function (data) {
                            let json = JSON.parse(data);

                            if (!json) {
                                return false;
                            }

                            if (json.align && json.from) {
                                notifyValidate('Rota bloqueada para validação da senha.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            if (json.status === 0) {
                                notifyValidate('Rota excluída para validação da senha.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            return true;
                        },
                    },
                },
            },
            messages: {
                password: {
                    required:  'O campo senha é obrigatório.',
                    minlength: 'O campo senha deve ter pelo menos {0} caracteres.',
                    maxlength: 'O campo senha não pode ser superior a {0} caracteres.',
                    remote:    'O campo senha de confirmação está incorreto.',
                },
            }
        });
    });
</script>
