<script>
    $(function () {
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
                cnpj_edit_entity: {
                    required:     'O campo cnpj é obrigatório.',
                    minlength:    'O campo cnpj deve ter pelo menos {0} dígitos.',
                    maxlength:    'O campo cnpj não pode ser superior a {0} dígitos.',
                    cnpjBR:       'O campo cnpj deve ter um número de valor do cnpj.',
                    remote:       'O campo cnpj já está sendo utilizado.',
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
                email_edit_entity: {
                    maxlength:    'O campo e-mail não pode ser superior a {0} caracteres.',
                    email:        'O campo e-mail deve ser um endereço de e-mail válido.',
                    remote:       'O campo e-mail já está sendo utilizado.',
                },
                contact_edit_entity: {
                    minlength:    'O campo telefone deve ter pelo menos 10 dígitos.',
                    maxlength:    'O campo telefone não pode ser superior a 11 dígitos.',
                    phones:       'O campo telefone deve ter um número de telefone ou celular válido.',
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
    });
</script>
