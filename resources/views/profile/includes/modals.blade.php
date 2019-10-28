@if (\App\Models\Permission::buttonPermission('btn-modal-password-reset-profile'))
    <!-- editar senha do usuário logado -->
    @include('profile.modals.password-reset')
    <script>
        $(function () {
            $('#form-password-reset-profile').validate({
                rules: {
                    old_password_reset_profile: {
                        required: true,
                        minlength: 8,
                        maxlength: 191,
                        remote: {
                            url: '{{ app('router')->has('profile.check.password') ? route('profile.check.password') : route('remote.validate.destroy') }}',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                password: function () {
                                    return $('#old-password-reset-profile').val();
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
                    password_reset_profile: {
                        required: true,
                        minlength: 8,
                        maxlength: 191,
                        notEqualTo: '#old-password-reset-profile'
                    },
                    password_confirmation_reset_profile: {
                        required: true,
                        minlength: 8,
                        maxlength: 191,
                        equalTo: '#password-reset-profile',
                    },
                },
                messages: {
                    old_password_reset_profile: {
                        required:   'O campo senha atual é obrigatório.',
                        minlength:  'O campo senha atual deve ter pelo menos {0} caracteres.',
                        maxlength:  'O campo senha atual não pode ser superior a {0} caracteres.',
                        remote:     'O campo senha atual está incorreto.',
                    },
                    password_reset_profile: {
                        required:   'O campo nova senha é obrigatório.',
                        minlength:  'O campo nova senha deve ter pelo menos {0} caracteres.',
                        maxlength:  'O campo nova senha não pode ser superior a {0} caracteres.',
                        notEqualTo: 'Os campos senha atual e nova senha devem ser diferentes.',
                    },
                    password_confirmation_reset_profile: {
                        required:   'O campo confirme a nova senha é obrigatório.',
                        minlength:  'O campo confirme a nova senha deve ter pelo menos {0} caracteres.',
                        maxlength:  'O campo confirme a nova senha não pode ser superior a {0} caracteres.',
                        equalTo:    'O campo confirme a nova senha de confirmação não confere.',
                    },
                }
            });
        });
    </script>
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-support-send'))
    <!-- enviar e-mail para o suporte -->
    @include('profile.modals.send-support')
    <script>
        $(function () {
            $('#form-send-support-profile').validate({
                rules: {
                    reason_send_support_profile: {
                        required: true,
                    },
                    message_send_support_profile: {
                        required: true,
                        minlength: 10,
                        maxlength: 1500,
                    },
                },
                messages: {
                    reason_send_support_profile: {
                        required:  'O campo motivo é obrigatório.',
                    },
                    message_send_support_profile: {
                        required:  'O campo mensagem é obrigatório.',
                        minlength: 'O campo mensagem deve ter pelo menos {0} caracteres.',
                        maxlength: 'O campo mensagem não pode ser superior a {0} caracteres.',
                    },
                }
            });
        });
    </script>
@endif
