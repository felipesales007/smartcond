<script>
    $(function () {
        // novo condomínio
        $('#form-new-entity').validate({
            rules: {
                image_logo_new_entity: {
                    extension: 'jpeg|png|jpg|gif',
                    maxsize: 1000000,
                },
                name_new_entity: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                },
                corporate_name_new_entity: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                },
                cnpj_new_entity: {
                    required: true,
                    minlength: 18,
                    maxlength: 18,
                    cnpjBR: true,
                    remote: {
                        url: '{{ app('router')->has('entity.check.cnpj') ? route('entity.check.cnpj') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            cnpj: function () {
                                return $('#cnpj-new-entity').val();
                            }
                        },
                        dataFilter: function (data) {
                            let json = JSON.parse(data);

                            if (!json) {
                                return false;
                            }

                            if (json.align && json.from) {
                                notifyValidate('Rota bloqueada para validação do cnpj.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            if (json.status === 0) {
                                notifyValidate('Rota excluída para validação do cnpj.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            return true;
                        },
                    },
                },
                email_new_entity: {
                    maxlength: 191,
                    email: true,
                    remote: {
                        url: '{{ app('router')->has('entity.check.email') ? route('entity.check.email') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            email: function () {
                                return $('#email-new-entity').val();
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
                contact_new_entity: {
                    minlength: 14,
                    maxlength: 15,
                    phones: true,
                },
                postal_code_new_entity: {
                    required: true,
                    minlength: 9,
                    maxlength: 9,
                    postalcodeBR: true,
                },
                address_new_entity: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                },
                house_number_new_entity: {
                    maxlength: 191,
                },
                complement_new_entity: {
                    minlength: 3,
                    maxlength: 191,
                },
                neighborhood_new_entity: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                },
                city_new_entity: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                },
                state_id_new_entity: {
                    required: true,
                },
                country_new_entity: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                },
            },
            messages: {
                image_logo_new_entity: {
                    extension:    'O campo logo deve ser um arquivo do tipo: jpeg|png|jpg|gif.',
                    maxsize:      'O campo logo não pode ser superior a 1 mb.',
                },
                name_new_entity: {
                    required:     'O campo nome fantasia é obrigatório.',
                    minlength:    'O campo nome fantasia deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome fantasia não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome fantasia deve ter somente letras, espaços e caracteres permitidos.',
                },
                corporate_name_new_entity: {
                    required:     'O campo razão social é obrigatório.',
                    minlength:    'O campo razão social deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo razão social não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo campo razão deve ter somente letras, espaços e caracteres permitidos.',
                },
                cnpj_new_entity: {
                    required:     'O campo cnpj é obrigatório.',
                    minlength:    'O campo cnpj deve ter pelo menos {0} dígitos.',
                    maxlength:    'O campo cnpj não pode ser superior a {0} dígitos.',
                    cnpjBR:       'O campo cnpj deve ter um número de valor do cnpj.',
                    remote:       'O campo cnpj já está sendo utilizado.',
                },
                email_new_entity: {
                    maxlength:    'O campo e-mail não pode ser superior a {0} caracteres.',
                    email:        'O campo e-mail deve ser um endereço de e-mail válido.',
                    remote:       'O campo e-mail já está sendo utilizado.',
                },
                contact_new_entity: {
                    minlength:    'O campo contato deve ter pelo menos 10 dígitos.',
                    maxlength:    'O campo contato não pode ser superior a 11 dígitos.',
                    phones:       'O campo contato deve ter um número de telefone ou celular válido.',
                },
                postal_code_new_entity: {
                    required:     'O campo cep é obrigatório.',
                    minlength:    'O campo cep deve ter pelo menos 8 dígitos.',
                    maxlength:    'O campo cep não pode ser superior a 8 dígitos.',
                    postalcodeBR: 'O campo cep deve ter um cep válido.',
                },
                address_new_entity: {
                    required:     'O campo endereço é obrigatório.',
                    minlength:    'O campo endereço deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo endereço não pode ser superior a {0} caracteres.',
                },
                house_number_new_entity: {
                    maxlength:    'O campo nº não pode ser superior a {0} caracteres.',
                },
                complement_new_entity: {
                    minlength:    'O campo complemento deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo complemento não pode ser superior a {0} caracteres.',
                },
                neighborhood_new_entity: {
                    required:     'O campo bairro é obrigatório.',
                    minlength:    'O campo bairro deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo bairro não pode ser superior a {0} caracteres.',
                },
                city_new_entity: {
                    required:     'O campo cidade é obrigatório.',
                    minlength:    'O campo cidade deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo cidade não pode ser superior a {0} caracteres.',
                },
                state_id_new_entity: {
                    required:     'O campo estado é obrigatório.',
                },
                country_new_entity: {
                    required:     'O campo país é obrigatório.',
                    minlength:    'O campo país deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo país não pode ser superior a {0} caracteres.',
                },
            }
        });

        // editar condomínio
        $('#form-edit-entity').validate({
            rules: {
                id_edit_entity: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                image_logo_edit_entity: {
                    extension: 'jpeg|png|jpg|gif',
                    maxsize: 1000000,
                },
                name_edit_entity: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                },
                corporate_name_edit_entity: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                },
                cnpj_edit_entity: {
                    required: true,
                    minlength: 18,
                    maxlength: 18,
                    cnpjBR: true,
                    remote: {
                        url: '{{ app('router')->has('entity.check.cnpj.different') ? route('entity.check.cnpj.different') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: function () {
                                return $('#id-edit-entity').val();
                            },
                            cnpj: function () {
                                return $('#cnpj-edit-entity').val();
                            }
                        },
                        dataFilter: function (data) {
                            let json = JSON.parse(data);

                            if (!json) {
                                return false;
                            }

                            if (json.align && json.from) {
                                notifyValidate('Rota bloqueada para validação do cnpj.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            if (json.status === 0) {
                                notifyValidate('Rota excluída para validação do cnpj.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            return true;
                        },
                    },
                },
                email_edit_entity: {
                    maxlength: 191,
                    email: true,
                    remote: {
                        url: '{{ app('router')->has('entity.check.email.different') ? route('entity.check.email.different') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: function () {
                                return $('#id-edit-entity').val();
                            },
                            email: function () {
                                return $('#email-edit-entity').val();
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
                contact_edit_entity: {
                    minlength: 14,
                    maxlength: 15,
                    phones: true,
                },
                postal_code_edit_entity: {
                    required: true,
                    minlength: 9,
                    maxlength: 9,
                    postalcodeBR: true,
                },
                address_edit_entity: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                },
                house_number_edit_entity: {
                    maxlength: 191,
                },
                complement_edit_entity: {
                    minlength: 3,
                    maxlength: 191,
                },
                neighborhood_edit_entity: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                },
                city_edit_entity: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                },
                state_id_edit_entity: {
                    required: true,
                },
                country_edit_entity: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                },
            },
            messages: {
                id_edit_entity: {
                    required:     'O campo id é obrigatório.',
                    maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                    number:       'O campo id deve ser um número.',
                },
                image_logo_edit_entity: {
                    extension:    'O campo logo deve ser um arquivo do tipo: jpeg|png|jpg|gif.',
                    maxsize:      'O campo logo não pode ser superior a 1 mb.',
                },
                name_edit_entity: {
                    required:     'O campo nome fantasia é obrigatório.',
                    minlength:    'O campo nome fantasia deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome fantasia não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome fantasia deve ter somente letras, espaços e caracteres permitidos.',
                },
                corporate_name_edit_entity: {
                    required:     'O campo razão social é obrigatório.',
                    minlength:    'O campo razão social deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo razão social não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo razão social deve ter somente letras, espaços e caracteres permitidos.',
                },
                cnpj_edit_entity: {
                    required:     'O campo cnpj é obrigatório.',
                    minlength:    'O campo cnpj deve ter pelo menos {0} dígitos.',
                    maxlength:    'O campo cnpj não pode ser superior a {0} dígitos.',
                    cnpjBR:       'O campo cnpj deve ter um número de valor do cnpj.',
                    remote:       'O campo cnpj já está sendo utilizado.',
                },
                email_edit_entity: {
                    maxlength:    'O campo e-mail não pode ser superior a {0} caracteres.',
                    email:        'O campo e-mail deve ser um endereço de e-mail válido.',
                    remote:       'O campo e-mail já está sendo utilizado.',
                },
                contact_edit_entity: {
                    minlength:    'O campo contato deve ter pelo menos 10 dígitos.',
                    maxlength:    'O campo contato não pode ser superior a 11 dígitos.',
                    phones:       'O campo contato deve ter um número de telefone ou celular válido.',
                },
                postal_code_edit_entity: {
                    required:     'O campo cep é obrigatório.',
                    minlength:    'O campo cep deve ter pelo menos 8 dígitos.',
                    maxlength:    'O campo cep não pode ser superior a 8 dígitos.',
                    postalcodeBR: 'O campo cep deve ter um cep válido.',
                },
                address_edit_entity: {
                    required:     'O campo endereço é obrigatório.',
                    minlength:    'O campo endereço deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo endereço não pode ser superior a {0} caracteres.',
                },
                house_number_edit_entity: {
                    maxlength:    'O campo nº não pode ser superior a {0} caracteres.',
                },
                complement_edit_entity: {
                    minlength:    'O campo complemento deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo complemento não pode ser superior a {0} caracteres.',
                },
                neighborhood_edit_entity: {
                    required:     'O campo bairro é obrigatório.',
                    minlength:    'O campo bairro deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo bairro não pode ser superior a {0} caracteres.',
                },
                city_edit_entity: {
                    required:     'O campo cidade é obrigatório.',
                    minlength:    'O campo cidade deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo cidade não pode ser superior a {0} caracteres.',
                },
                state_id_edit_entity: {
                    required:     'O campo estado é obrigatório.',
                },
                country_edit_entity: {
                    required:     'O campo país é obrigatório.',
                    minlength:    'O campo país deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo país não pode ser superior a {0} caracteres.',
                },
            }
        });

        // bloquear condomínio
        $('#form-block-entity').validate({
            rules: {
                id_block_entity: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                blocked_at_block_entity: {
                    minlength: 10,
                    maxlength: 10,
                    dateITA: true,
                },
            },
            messages: {
                id_block_entity: {
                    required:  'O campo id é obrigatório.',
                    maxlength: 'O campo id não pode ser superior a {0} dígitos.',
                    number:    'O campo id deve ser um número.',
                },
                blocked_at_block_entity: {
                    minlength: 'O campo data determinada deve ter pelo menos 8 dígitos.',
                    maxlength: 'O campo data determinada não pode ser superior a 8 dígitos.',
                    dateITA:   'O campo data determinada não é uma data válida.',
                },
            }
        });

        // deletar condomínio
        $('#form-delete-entity').validate({
            rules: {
                id_delete_entity: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_delete_entity: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                },
                name_confirmation_delete_entity: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                    equalTo: '#name-delete-entity',
                },
            },
            messages: {
                id_delete_entity: {
                    required:     'O campo id é obrigatório.',
                    maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                    number:       'O campo id deve ser um número.',
                },
                name_delete_entity: {
                    required:     'O campo nome é obrigatório.',
                    minlength:    'O campo nome deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome deve ter somente letras, espaços e caracteres permitidos.',
                },
                name_confirmation_delete_entity: {
                    required:     'O campo nome para exclusão é obrigatório.',
                    minlength:    'O campo nome para exclusão deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome para exclusão não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome para exclusão deve ter somente letras, espaços e caracteres permitidos.',
                    equalTo:      'O campo nome para exclusão de confirmação não confere.',
                },
            }
        });

        // recuperar condomínio
        $('#form-recover-entity').validate({
            rules: {
                id_recover_entity: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_recover_entity: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                },
                name_confirmation_recover_entity: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                    equalTo: '#name-recover-entity',
                },
            },
            messages: {
                id_recover_entity: {
                    required:     'O campo id é obrigatório.',
                    maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                    number:       'O campo id deve ser um número.',
                },
                name_recover_entity: {
                    required:     'O campo nome é obrigatório.',
                    minlength:    'O campo nome deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome deve ter somente letras, espaços e caracteres permitidos.',
                },
                name_confirmation_recover_entity: {
                    required:     'O campo nome para recuperação é obrigatório.',
                    minlength:    'O campo nome para recuperação deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome para recuperação não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome para recuperação deve ter somente letras, espaços e caracteres permitidos.',
                    equalTo:      'O campo nome para recuperação de confirmação não confere.',
                },
            }
        });

        // enviar e-mail para o condomínio
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

        // novo usuário
        $('#form-new-entity-user').validate({
            rules: {
                name_new_entity_user: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersaccentedspace: true,
                },
                email_new_entity_user: {
                    required: true,
                    maxlength: 191,
                    email: true,
                    remote: {
                        url: '{{ app('router')->has('user.check.email') ? route('user.check.email') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            email: function () {
                                return $('#email-new-entity-user').val();
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
                id_entity_new_entity_user: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
            },
            messages: {
                name_new_entity_user: {
                    required:             'O campo nome é obrigatório.',
                    minlength:            'O campo nome deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo nome não pode ser superior a {0} caracteres.',
                    lettersaccentedspace: 'O campo nome deve ter somente letras e espaços.',
                },
                email_new_entity_user: {
                    required:             'O campo e-mail é obrigatório.',
                    maxlength:            'O campo e-mail não pode ser superior a {0} caracteres.',
                    email:                'O campo e-mail deve ser um endereço de e-mail válido.',
                    remote:               'O campo e-mail já está sendo utilizado.',
                },
                id_entity_new_entity_user: {
                    required:             'O campo id é obrigatório.',
                    maxlength:            'O campo id não pode ser superior a {0} dígitos.',
                    number:               'O campo id deve ser um número.',
                },
            }
        });
    });
</script>
