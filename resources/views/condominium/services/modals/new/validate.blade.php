<script>
    $(function () {
        $('#form-new-condominium-service').validate({
            rules: {
                name_new_condominium_service: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersaccentedspace: true,
                    remote: {
                        url: '{{ app('router')->has('condominium.service.check.name') ? route('condominium.service.check.name') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            name: function () {
                                return $('#name-new-condominium-service').val();
                            }
                        },
                        dataFilter: function (data) {
                            let json = JSON.parse(data);

                            if (!json) {
                                return false;
                            }

                            if (json.align && json.from) {
                                notifyValidate('Rota bloqueada para validação do nome.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            if (json.status === 0) {
                                notifyValidate('Rota excluída para validação do nome.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            return true;
                        },
                    },
                },
                rg_new_condominium_service: {
                    minlength: 8,
                    maxlength: 14,
                    number: true,
                    remote: {
                        url: '{{ app('router')->has('condominium.service.check.rg') ? route('condominium.service.check.rg') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: function () {
                                return $('#id-new-condominium-service').val();
                            },
                            rg: function () {
                                return $('#rg-new-condominium-service').val();
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
                contact_new_condominium_service: {
                    minlength: 14,
                    maxlength: 15,
                    phones: true,
                },
                profession_new_condominium_service: {
                    minlength: 3,
                    maxlength: 191,
                },
                note_new_condominium_service: {
                    minlength: 10,
                    maxlength: 1500,
                },
            },
            messages: {
                name_new_condominium_service: {
                    required:             'O campo nome é obrigatório.',
                    minlength:            'O campo nome deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo nome não pode ser superior a {0} caracteres.',
                    lettersaccentedspace: 'O campo nome deve ter somente letras e espaços.',
                    remote:               'O campo nome já está sendo utilizado.',
                },
                rg_new_condominium_service: {
                    minlength:            'O campo rg deve ter pelo menos {0} dígitos.',
                    maxlength:            'O campo rg não pode ser superior a {0} dígitos.',
                    number:               'O campo rg deve ser um número.',
                    remote:               'O campo rg já está sendo utilizado.',
                },
                contact_new_condominium_service: {
                    minlength:            'O campo telefone deve ter pelo menos 10 dígitos.',
                    maxlength:            'O campo telefone não pode ser superior a 11 dígitos.',
                    phones:               'O campo telefone deve ter um número de telefone ou celular válido.',
                },
                profession_new_condominium_service: {
                    minlength:            'O campo profissão deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo profissão não pode ser superior a {0} caracteres.',
                },
                note_new_condominium_service: {
                    minlength:            'O campo observação deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo observação não pode ser superior a {0} caracteres.',
                },
            }
        });
    });
</script>
