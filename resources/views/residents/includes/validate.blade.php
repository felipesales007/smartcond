<script>
    $(function () {
        // novo morador
        $('#form-new-resident').validate({
            rules: {
                name_new_resident: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersaccentedspace: true,
                },
                email_new_resident: {
                    required: true,
                    maxlength: 191,
                    email: true,
                    remote: {
                        url: '{{ app('router')->has('resident.check.email') ? route('resident.check.email') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            email: function () {
                                return $('#email-new-resident').val();
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
                company_id_new_resident: {
                    required: true,
                },
            },
            messages: {
                name_new_resident: {
                    required:             'O campo nome é obrigatório.',
                    minlength:            'O campo nome deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo nome não pode ser superior a {0} caracteres.',
                    lettersaccentedspace: 'O campo nome deve ter somente letras e espaços.',
                },
                email_new_resident: {
                    required:             'O campo e-mail é obrigatório.',
                    maxlength:            'O campo e-mail não pode ser superior a {0} caracteres.',
                    email:                'O campo e-mail deve ser um endereço de e-mail válido.',
                    remote:               'O campo e-mail já está sendo utilizado.',
                },
                company_id_new_resident: {
                    required:             'O campo condomínio é obrigatório.',
                },
            }
        });

        // editar morador
        $('#form-edit-resident').validate({
            rules: {
                id_edit_resident: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_edit_resident: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersaccentedspace: true,
                },
                cpf_edit_resident: {
                    minlength: 14,
                    maxlength: 14,
                    cpfBR: true,
                    remote: {
                        url: '{{ app('router')->has('resident.check.cpf.different') ? route('resident.check.cpf.different') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: function () {
                                return $('#id-edit-resident').val();
                            },
                            cpf: function () {
                                return $('#cpf-edit-resident').val();
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
                rg_edit_resident: {
                    minlength: 8,
                    maxlength: 14,
                    number: true,
                    remote: {
                        url: '{{ app('router')->has('resident.check.rg.different') ? route('resident.check.rg.different') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: function () {
                                return $('#id-edit-resident').val();
                            },
                            rg: function () {
                                return $('#rg-edit-resident').val();
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
                email_edit_resident: {
                    required: true,
                    maxlength: 191,
                    email: true,
                    remote: {
                        url: '{{ app('router')->has('resident.check.email.different') ? route('resident.check.email.different') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: function () {
                                return $('#id-edit-resident').val();
                            },
                            email: function () {
                                return $('#email-edit-resident').val();
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
                company_id_edit_resident: {
                    required: true,
                },
                password_edit_resident: {
                    minlength: 8,
                    maxlength: 191,
                },
                password_confirmation_edit_resident: {
                    minlength: 8,
                    maxlength: 191,
                    equalTo: '#password-edit-resident',
                },
                image_2: {
                    extension: 'jpeg|png|jpg|gif',
                    maxsize: 6000000,
                },
                image_3: {
                    extension: 'jpeg|png|jpg|gif',
                    maxsize: 6000000,
                },
                birthday_edit_resident: {
                    minlength: 10,
                    maxlength: 10,
                    dateITA: true,
                },
                contact_edit_resident: {
                    minlength: 14,
                    maxlength: 15,
                    phones: true,
                },
                description_edit_resident: {
                    minlength: 10,
                    maxlength: 1500,
                },
                course_edit_resident: {
                    minlength: 3,
                    maxlength: 191,
                },
                college_edit_resident: {
                    minlength: 3,
                    maxlength: 191,
                },
                profession_edit_resident: {
                    minlength: 3,
                    maxlength: 191,
                },
                company_edit_resident: {
                    minlength: 3,
                    maxlength: 191,
                },
                postal_code_edit_resident: {
                    minlength: 9,
                    maxlength: 9,
                    postalcodeBR: true,
                },
                address_edit_resident: {
                    minlength: 3,
                    maxlength: 191,
                },
                house_number_edit_resident: {
                    maxlength: 191,
                },
                complement_edit_resident: {
                    minlength: 3,
                    maxlength: 191,
                },
                neighborhood_edit_resident: {
                    minlength: 3,
                    maxlength: 191,
                },
                city_edit_resident: {
                    minlength: 3,
                    maxlength: 191,
                },
                country_edit_resident: {
                    minlength: 3,
                    maxlength: 191,
                },
            },
            messages: {
                id_edit_resident: {
                    required:             'O campo id é obrigatório.',
                    maxlength:            'O campo id não pode ser superior a {0} dígitos.',
                    number:               'O campo id deve ser um número.',
                },
                name_edit_resident: {
                    required:             'O campo nome é obrigatório.',
                    minlength:            'O campo nome deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo nome não pode ser superior a {0} caracteres.',
                    lettersaccentedspace: 'O campo nome deve ter somente letras e espaços.',
                },
                cpf_edit_resident: {
                    minlength:            'O campo cpf deve ter pelo menos 11 dígitos.',
                    maxlength:            'O campo cpf não pode ser superior a 11 dígitos.',
                    cpfBR:                'O campo cpf deve ter um número de cpf válido.',
                    remote:               'O campo cpf já está sendo utilizado.',
                },
                rg_edit_resident: {
                    minlength:            'O campo rg deve ter pelo menos {0} dígitos.',
                    maxlength:            'O campo rg não pode ser superior a {0} dígitos.',
                    number:               'O campo rg deve ser um número.',
                    remote:               'O campo rg já está sendo utilizado.',
                },
                email_edit_resident: {
                    required:             'O campo e-mail é obrigatório.',
                    maxlength:            'O campo e-mail não pode ser superior a {0} caracteres.',
                    email:                'O campo e-mail deve ser um endereço de e-mail válido.',
                    remote:               'O campo e-mail já está sendo utilizado.',
                },
                company_id_edit_resident: {
                    required:             'O campo condomínio é obrigatório.',
                },
                password_edit_resident: {
                    minlength:            'O campo senha deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo senha não pode ser superior a {0} caracteres.',
                },
                password_confirmation_edit_resident: {
                    minlength:            'O campo confirme a senha deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo confirme a senha não pode ser superior a {0} caracteres.',
                    equalTo:              'O campo confirme a senha de confirmação não confere.',
                },
                image_2: {
                    extension:            'O campo imagem deve ser um arquivo do tipo: jpeg|png|jpg|gif.',
                    maxsize:              'O campo imagem não pode ser superior a 6 mb.',
                },
                image_3: {
                    extension:            'O campo capa deve ser um arquivo do tipo: jpeg|png|jpg|gif.',
                    maxsize:              'O campo capa não pode ser superior a 6 mb.',
                },
                birthday_edit_resident: {
                    minlength:            'O campo data de nascimento deve ter pelo menos 8 dígitos.',
                    maxlength:            'O campo data de nascimento não pode ser superior a 8 dígitos.',
                    dateITA:              'O campo data de nascimento não é uma data válida.',
                },
                contact_edit_resident: {
                    minlength:            'O campo contato deve ter pelo menos 10 dígitos.',
                    maxlength:            'O campo contato não pode ser superior a 11 dígitos.',
                    phones:               'O campo contato deve ter um número de telefone ou celular válido.',
                },
                description_edit_resident: {
                    minlength:            'O campo descrição deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo descrição não pode ser superior a {0} caracteres.',
                },
                course_edit_resident: {
                    minlength:            'O campo curso deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo curso não pode ser superior a {0} caracteres.',
                },
                college_edit_resident: {
                    minlength:            'O campo faculdade deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo faculdade não pode ser superior a {0} caracteres.',
                },
                profession_edit_resident: {
                    minlength:            'O campo profissão deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo profissão não pode ser superior a {0} caracteres.',
                },
                company_edit_resident: {
                    minlength:            'O campo condomínio deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo condomínio não pode ser superior a {0} caracteres.',
                },
                postal_code_edit_resident: {
                    minlength:            'O campo cep deve ter pelo menos 8 dígitos.',
                    maxlength:            'O campo cep não pode ser superior a 8 dígitos.',
                    postalcodeBR:         'O campo cep deve ter um cep válido.',
                },
                address_edit_resident: {
                    minlength:            'O campo endereço deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo endereço não pode ser superior a {0} caracteres.',
                },
                house_number_edit_resident: {
                    maxlength:            'O campo nº não pode ser superior a {0} caracteres.',
                },
                complement_edit_resident: {
                    minlength:            'O campo complemnto deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo complemnto não pode ser superior a {0} caracteres.',
                },
                neighborhood_edit_resident: {
                    minlength:            'O campo bairro deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo bairro não pode ser superior a {0} caracteres.',
                },
                city_edit_resident: {
                    minlength:            'O campo cidade deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo cidade não pode ser superior a {0} caracteres.',
                },
                country_edit_resident: {
                    minlength:            'O campo país deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo país não pode ser superior a {0} caracteres.',
                },
            }
        });

        // deletar morador
        $('#form-delete-resident').validate({
            rules: {
                id_delete_resident: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_delete_resident: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersaccented: true,
                },
                name_confirmation_delete_resident: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersaccented: true,
                    equalTo: '#name-delete-resident',
                },
            },
            messages: {
                id_delete_resident: {
                    required:        'O campo id é obrigatório.',
                    maxlength:       'O campo id não pode ser superior a {0} dígitos.',
                    number:          'O campo id deve ser um número.',
                },
                name_delete_resident: {
                    required:        'O campo nome é obrigatório.',
                    minlength:       'O campo nome deve ter pelo menos {0} caracteres.',
                    maxlength:       'O campo nome não pode ser superior a {0} caracteres.',
                    lettersaccented: 'O campo nome deve ter somente letras.',
                },
                name_confirmation_delete_resident: {
                    required:        'O campo nome para exclusão é obrigatório.',
                    minlength:       'O campo nome para exclusão deve ter pelo menos {0} caracteres.',
                    maxlength:       'O campo nome para exclusão não pode ser superior a {0} caracteres.',
                    lettersaccented: 'O campo nome para exclusão deve ter somente letras.',
                    equalTo:         'O campo nome para exclusão de confirmação não confere.',
                },
            }
        });

        // recuperar morador
        $('#form-recover-resident').validate({
            rules: {
                id_recover_resident: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_recover_resident: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersaccented: true,
                },
                name_confirmation_recover_resident: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersaccented: true,
                    equalTo: '#name-recover-resident',
                },
            },
            messages: {
                id_recover_resident: {
                    required:        'O campo id é obrigatório.',
                    maxlength:       'O campo id não pode ser superior a {0} dígitos.',
                    number:          'O campo id deve ser um número.',
                },
                name_recover_resident: {
                    required:        'O campo nome é obrigatório.',
                    minlength:       'O campo nome deve ter pelo menos {0} caracteres.',
                    maxlength:       'O campo nome não pode ser superior a {0} caracteres.',
                    lettersaccented: 'O campo nome deve ter somente letras.',
                },
                name_confirmation_recover_resident: {
                    required:        'O campo nome para recuperação é obrigatório.',
                    minlength:       'O campo nome para recuperação deve ter pelo menos {0} caracteres.',
                    maxlength:       'O campo nome para recuperação não pode ser superior a {0} caracteres.',
                    lettersaccented: 'O campo nome para recuperação deve ter somente letras.',
                    equalTo:         'O campo nome para recuperação de confirmação não confere.',
                },
            }
        });

        // reenviar e-mail de confirmação do morador
        $('#form-resend-email-resident').validate({
            rules: {
                id_resend_email_resident: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
            },
            messages: {
                id_resend_email_resident: {
                    required:  'O campo id é obrigatório.',
                    maxlength: 'O campo id não pode ser superior a {0} dígitos.',
                    number:    'O campo id deve ser um número.',
                },
            }
        });

        // enviar e-mail para o morador
        $('#form-send-email-resident').validate({
            rules: {
                name_send_email_resident: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersaccentedspace: true,
                },
                email_send_email_resident: {
                    required: true,
                    maxlength: 191,
                    email: true,
                },
                message_send_email_resident: {
                    required: true,
                    minlength: 10,
                    maxlength: 1500,
                },
            },
            messages: {
                name_send_email_resident: {
                    required:             'O campo nome é obrigatório.',
                    minlength:            'O campo nome deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo nome não pode ser superior a {0} caracteres.',
                    lettersaccentedspace: 'O campo nome deve ter somente letras e espaços.',
                },
                email_send_email_resident: {
                    required:             'O campo e-mail é obrigatório.',
                    maxlength:            'O campo e-mail não pode ser superior a {0} caracteres.',
                    email:                'O campo e-mail deve ser um endereço de e-mail válido.',
                },
                message_send_email_resident: {
                    required:             'O campo mensagem é obrigatório.',
                    minlength:            'O campo mensagem deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo mensagem não pode ser superior a {0} caracteres.',
                },
            }
        });
    });
</script>
