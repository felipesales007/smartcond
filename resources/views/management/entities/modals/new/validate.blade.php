<script>
    $(function () {
        $('#form-new-entity').validate({
            rules: {
                image_logo_new_entity: {
                    extension: 'jpeg|png|jpg|gif',
                    maxsize: 1000000,
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
                cnpj_new_entity: {
                    required:     'O campo cnpj é obrigatório.',
                    minlength:    'O campo cnpj deve ter pelo menos {0} dígitos.',
                    maxlength:    'O campo cnpj não pode ser superior a {0} dígitos.',
                    cnpjBR:       'O campo cnpj deve ter um número de valor do cnpj.',
                    remote:       'O campo cnpj já está sendo utilizado.',
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
                email_new_entity: {
                    maxlength:    'O campo e-mail não pode ser superior a {0} caracteres.',
                    email:        'O campo e-mail deve ser um endereço de e-mail válido.',
                    remote:       'O campo e-mail já está sendo utilizado.',
                },
                contact_new_entity: {
                    minlength:    'O campo telefone deve ter pelo menos 10 dígitos.',
                    maxlength:    'O campo telefone não pode ser superior a 11 dígitos.',
                    phones:       'O campo telefone deve ter um número de telefone ou celular válido.',
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
    });
</script>
