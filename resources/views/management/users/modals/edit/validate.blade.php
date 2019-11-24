<script>
    $(function () {
        $('#form-edit-user').validate({
            rules: {
                id_edit_user: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_edit_user: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersaccentedspace: true,
                },
                cpf_edit_user: {
                    minlength: 14,
                    maxlength: 14,
                    cpfBR: true,
                    remote: {
                        url: '{{ app('router')->has('user.check.cpf.different') ? route('user.check.cpf.different') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: function () {
                                return $('#id-edit-user').val();
                            },
                            cpf: function () {
                                return $('#cpf-edit-user').val();
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
                rg_edit_user: {
                    minlength: 8,
                    maxlength: 14,
                    number: true,
                    remote: {
                        url: '{{ app('router')->has('user.check.rg.different') ? route('user.check.rg.different') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: function () {
                                return $('#id-edit-user').val();
                            },
                            rg: function () {
                                return $('#rg-edit-user').val();
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
                email_edit_user: {
                    required: true,
                    maxlength: 191,
                    email: true,
                    remote: {
                        url: '{{ app('router')->has('user.check.email.different') ? route('user.check.email.different') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: function () {
                                return $('#id-edit-user').val();
                            },
                            email: function () {
                                return $('#email-edit-user').val();
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
                'entity_id_edit_user[]': {
                    required: true,
                },
                password_edit_user: {
                    minlength: 8,
                    maxlength: 191,
                },
                password_confirmation_edit_user: {
                    minlength: 8,
                    maxlength: 191,
                    equalTo: '#password-edit-user',
                },
                image_photo_edit_user: {
                    extension: 'jpeg|png|jpg|gif',
                    maxsize: 1000000,
                },
                image_background_edit_user: {
                    extension: 'jpeg|png|jpg|gif',
                    maxsize: 1000000,
                },
                birthday_edit_user: {
                    minlength: 10,
                    maxlength: 10,
                    dateITA: true,
                },
                contact_edit_user: {
                    minlength: 14,
                    maxlength: 15,
                    phones: true,
                },
                description_edit_user: {
                    minlength: 10,
                    maxlength: 1500,
                },
                course_edit_user: {
                    minlength: 3,
                    maxlength: 191,
                },
                college_edit_user: {
                    minlength: 3,
                    maxlength: 191,
                },
                profession_edit_user: {
                    minlength: 3,
                    maxlength: 191,
                },
                company_edit_user: {
                    minlength: 3,
                    maxlength: 191,
                },
                postal_code_edit_user: {
                    minlength: 9,
                    maxlength: 9,
                    postalcodeBR: true,
                },
                address_edit_user: {
                    minlength: 3,
                    maxlength: 191,
                },
                house_number_edit_user: {
                    maxlength: 191,
                },
                complement_edit_user: {
                    minlength: 3,
                    maxlength: 191,
                },
                neighborhood_edit_user: {
                    minlength: 3,
                    maxlength: 191,
                },
                city_edit_user: {
                    minlength: 3,
                    maxlength: 191,
                },
                country_edit_user: {
                    minlength: 3,
                    maxlength: 191,
                },
            },
            messages: {
                id_edit_user: {
                    required:             'O campo id é obrigatório.',
                    maxlength:            'O campo id não pode ser superior a {0} dígitos.',
                    number:               'O campo id deve ser um número.',
                },
                name_edit_user: {
                    required:             'O campo nome é obrigatório.',
                    minlength:            'O campo nome deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo nome não pode ser superior a {0} caracteres.',
                    lettersaccentedspace: 'O campo nome deve ter somente letras e espaços.',
                },
                cpf_edit_user: {
                    minlength:            'O campo cpf deve ter pelo menos 11 dígitos.',
                    maxlength:            'O campo cpf não pode ser superior a 11 dígitos.',
                    cpfBR:                'O campo cpf deve ter um número de cpf válido.',
                    remote:               'O campo cpf já está sendo utilizado.',
                },
                rg_edit_user: {
                    minlength:            'O campo rg deve ter pelo menos {0} dígitos.',
                    maxlength:            'O campo rg não pode ser superior a {0} dígitos.',
                    number:               'O campo rg deve ser um número.',
                    remote:               'O campo rg já está sendo utilizado.',
                },
                email_edit_user: {
                    required:             'O campo e-mail é obrigatório.',
                    maxlength:            'O campo e-mail não pode ser superior a {0} caracteres.',
                    email:                'O campo e-mail deve ser um endereço de e-mail válido.',
                    remote:               'O campo e-mail já está sendo utilizado.',
                },
                'entity_id_edit_user[]': {
                    required:             'O campo condomínio é obrigatório.',
                },
                password_edit_user: {
                    minlength:            'O campo senha deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo senha não pode ser superior a {0} caracteres.',
                },
                password_confirmation_edit_user: {
                    minlength:            'O campo confirme a senha deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo confirme a senha não pode ser superior a {0} caracteres.',
                    equalTo:              'O campo confirme a senha de confirmação não confere.',
                },
                image_photo_edit_user: {
                    extension:            'O campo foto deve ser um arquivo do tipo: jpeg|png|jpg|gif.',
                    maxsize:              'O campo foto não pode ser superior a 1 mb.',
                },
                image_background_edit_user: {
                    extension:            'O campo capa deve ser um arquivo do tipo: jpeg|png|jpg|gif.',
                    maxsize:              'O campo capa não pode ser superior a 1 mb.',
                },
                birthday_edit_user: {
                    minlength:            'O campo data de nascimento deve ter pelo menos 8 dígitos.',
                    maxlength:            'O campo data de nascimento não pode ser superior a 8 dígitos.',
                    dateITA:              'O campo data de nascimento não é uma data válida.',
                },
                contact_edit_user: {
                    minlength:            'O campo telefone deve ter pelo menos 10 dígitos.',
                    maxlength:            'O campo telefone não pode ser superior a 11 dígitos.',
                    phones:               'O campo telefone deve ter um número de telefone ou celular válido.',
                },
                description_edit_user: {
                    minlength:            'O campo descrição deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo descrição não pode ser superior a {0} caracteres.',
                },
                course_edit_user: {
                    minlength:            'O campo curso deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo curso não pode ser superior a {0} caracteres.',
                },
                college_edit_user: {
                    minlength:            'O campo faculdade deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo faculdade não pode ser superior a {0} caracteres.',
                },
                profession_edit_user: {
                    minlength:            'O campo profissão deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo profissão não pode ser superior a {0} caracteres.',
                },
                company_edit_user: {
                    minlength:            'O campo empresa deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo empresa não pode ser superior a {0} caracteres.',
                },
                postal_code_edit_user: {
                    minlength:            'O campo cep deve ter pelo menos 8 dígitos.',
                    maxlength:            'O campo cep não pode ser superior a 8 dígitos.',
                    postalcodeBR:         'O campo cep deve ter um cep válido.',
                },
                address_edit_user: {
                    minlength:            'O campo endereço deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo endereço não pode ser superior a {0} caracteres.',
                },
                house_number_edit_user: {
                    maxlength:            'O campo nº não pode ser superior a {0} caracteres.',
                },
                complement_edit_user: {
                    minlength:            'O campo complemento deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo complemento não pode ser superior a {0} caracteres.',
                },
                neighborhood_edit_user: {
                    minlength:            'O campo bairro deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo bairro não pode ser superior a {0} caracteres.',
                },
                city_edit_user: {
                    minlength:            'O campo cidade deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo cidade não pode ser superior a {0} caracteres.',
                },
                country_edit_user: {
                    minlength:            'O campo país deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo país não pode ser superior a {0} caracteres.',
                },
            }
        });
    });
</script>
