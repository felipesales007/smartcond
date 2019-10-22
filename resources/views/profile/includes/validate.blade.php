<script>
    $(function () {
        // editar perfil do usuário logado
        $('#form-edit-profile').validate({
            rules: {
                image_photo_edit_profile: {
                    extension: 'jpeg|png|jpg|gif',
                    maxsize: 1000000,
                },
                image_background_edit_profile: {
                    extension: 'jpeg|png|jpg|gif',
                    maxsize: 1000000,
                },
                id_edit_profile: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_edit_profile: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersaccentedspace: true,
                },
                cpf_edit_profile: {
                    minlength: 14,
                    maxlength: 14,
                    cpfBR: true,
                    remote: {
                        url: '{{ app('router')->has('profile.check.cpf.different') ? route('profile.check.cpf.different') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: function () {
                                return $('#id-edit-profile').val();
                            },
                            cpf: function () {
                                return $('#cpf-edit-profile').val();
                            }
                        },
                        dataFilter: function (data) {
                            let json = JSON.parse(data);

                            if (!json) {
                                return false;
                            }

                            if (json.align && json.from) {
                                notifyValidate('Rota bloqueada para validação do cpf.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            if (json.status === 0) {
                                notifyValidate('Rota excluída para validação do cpf.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            return true;
                        },
                    },
                },
                rg_edit_profile: {
                    minlength: 8,
                    maxlength: 14,
                    number: true,
                    remote: {
                        url: '{{ app('router')->has('profile.check.rg.different') ? route('profile.check.rg.different') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: function () {
                                return $('#id-edit-profile').val();
                            },
                            rg: function () {
                                return $('#rg-edit-profile').val();
                            }
                        },
                        dataFilter: function (data) {
                            let json = JSON.parse(data);

                            if (!json) {
                                return false;
                            }

                            if (json.align && json.from) {
                                notifyValidate('Rota bloqueada para validação do rg.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            if (json.status === 0) {
                                notifyValidate('Rota excluída para validação do rg.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            return true;
                        },
                    },
                },
                email_edit_profile: {
                    required: true,
                    maxlength: 191,
                    email: true,
                    remote: {
                        url: '{{ app('router')->has('profile.check.email.different') ? route('profile.check.email.different') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: function () {
                                return $('#id-edit-profile').val();
                            },
                            email: function () {
                                return $('#email-edit-profile').val();
                            }
                        },
                        dataFilter: function (data) {
                            let json = JSON.parse(data);

                            if (!json) {
                                return false;
                            }

                            if (json.align && json.from) {
                                notifyValidate('Rota bloqueada para validação do e-mail.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            if (json.status === 0) {
                                notifyValidate('Rota excluída para validação do e-mail.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            return true;
                        },
                    },
                },
                birthday_edit_profile: {
                    minlength: 10,
                    maxlength: 10,
                    dateITA: true,
                },
                contact_edit_profile: {
                    minlength: 14,
                    maxlength: 15,
                    phones: true,
                },
                description_edit_profile: {
                    minlength: 10,
                    maxlength: 1500,
                },
                course_edit_profile: {
                    minlength: 3,
                    maxlength: 191,
                },
                college_edit_profile: {
                    minlength: 3,
                    maxlength: 191,
                },
                profession_edit_profile: {
                    minlength: 3,
                    maxlength: 191,
                },
                company_edit_profile: {
                    minlength: 3,
                    maxlength: 191,
                },
                postal_code_edit_profile: {
                    minlength: 9,
                    maxlength: 9,
                    postalcodeBR: true,
                },
                address_edit_profile: {
                    minlength: 3,
                    maxlength: 191,
                },
                house_number_edit_profile: {
                    maxlength: 191,
                },
                complement_edit_profile: {
                    minlength: 3,
                    maxlength: 191,
                },
                neighborhood_edit_profile: {
                    minlength: 3,
                    maxlength: 191,
                },
                city_edit_profile: {
                    minlength: 3,
                    maxlength: 191,
                },
                country_edit_profile: {
                    minlength: 3,
                    maxlength: 191,
                },
            },
            messages: {
                image_photo_edit_profile: {
                    extension:            'O campo foto deve ser um arquivo do tipo: jpeg|png|jpg|gif.',
                    maxsize:              'O campo foto não pode ser superior a 1 mb.',
                },
                image_background_edit_profile: {
                    extension:            'O campo capa deve ser um arquivo do tipo: jpeg|png|jpg|gif.',
                    maxsize:              'O campo capa não pode ser superior a 1 mb.',
                },
                id_edit_profile: {
                    required:             'O campo id é obrigatório.',
                    maxlength:            'O campo id não pode ser superior a {0} dígitos.',
                    number:               'O campo id deve ser um número.',
                },
                name_edit_profile: {
                    required:             'O campo nome é obrigatório.',
                    minlength:            'O campo nome deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo nome não pode ser superior a {0} caracteres.',
                    lettersaccentedspace: 'O campo nome deve ter somente letras e espaços.',
                },
                cpf_edit_profile: {
                    minlength:            'O campo cpf deve ter pelo menos 11 dígitos.',
                    maxlength:            'O campo cpf não pode ser superior a 11 dígitos.',
                    cpfBR:                'O campo cpf deve ter um número de cpf válido.',
                    remote:               'O campo cpf já está sendo utilizado.',
                },
                rg_edit_profile: {
                    minlength:            'O campo rg deve ter pelo menos {0} dígitos.',
                    maxlength:            'O campo rg não pode ser superior a {0} dígitos.',
                    number:               'O campo rg deve ser um número.',
                    remote:               'O campo rg já está sendo utilizado.',
                },
                email_edit_profile: {
                    required:             'O campo e-mail é obrigatório.',
                    maxlength:            'O campo e-mail não pode ser superior a {0} caracteres.',
                    email:                'O campo e-mail deve ser um endereço de e-mail válido.',
                    remote:               'O campo e-mail já está sendo utilizado.',
                },
                birthday_edit_profile: {
                    minlength:            'O campo data de nascimento deve ter pelo menos 8 dígitos.',
                    maxlength:            'O campo data de nascimento não pode ser superior a 8 dígitos.',
                    dateITA:              'O campo data de nascimento não é uma data válida.',
                },
                contact_edit_profile: {
                    minlength:            'O campo contato deve ter pelo menos 10 dígitos.',
                    maxlength:            'O campo contato não pode ser superior a 11 dígitos.',
                    phones:               'O campo contato deve ter um número de telefone ou celular válido.',
                },
                description_edit_profile: {
                    minlength:            'O campo descrição deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo descrição não pode ser superior a {0} caracteres.',
                },
                course_edit_profile: {
                    minlength:            'O campo curso deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo curso não pode ser superior a {0} caracteres.',
                },
                college_edit_profile: {
                    minlength:            'O campo faculdade deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo faculdade não pode ser superior a {0} caracteres.',
                },
                profession_edit_profile: {
                    minlength:            'O campo profissão deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo profissão não pode ser superior a {0} caracteres.',
                },
                company_edit_profile: {
                    minlength:            'O campo empresa deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo empresa não pode ser superior a {0} caracteres.',
                },
                postal_code_edit_profile: {
                    minlength:            'O campo cep deve ter pelo menos 8 dígitos.',
                    maxlength:            'O campo cep não pode ser superior a 8 dígitos.',
                    postalcodeBR:         'O campo cep deve ter um cep válido.',
                },
                address_edit_profile: {
                    minlength:            'O campo endereço deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo endereço não pode ser superior a {0} caracteres.',
                },
                house_number_edit_profile: {
                    maxlength:            'O campo nº não pode ser superior a {0} caracteres.',
                },
                complement_edit_profile: {
                    minlength:            'O campo complemento deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo complemento não pode ser superior a {0} caracteres.',
                },
                neighborhood_edit_profile: {
                    minlength:            'O campo bairro deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo bairro não pode ser superior a {0} caracteres.',
                },
                city_edit_profile: {
                    minlength:            'O campo cidade deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo cidade não pode ser superior a {0} caracteres.',
                },
                country_edit_profile: {
                    minlength:            'O campo país deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo país não pode ser superior a {0} caracteres.',
                },
            }
        });

        // editar senha do usuário logado
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

        // enviar e-mail para o suporte
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
