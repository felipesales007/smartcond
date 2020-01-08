<script>
    $(function () {
        $('#form-new-condominium-apartment').validate({
            rules: {
                block_id_new_condominium_apartment: {
                    required: true,
                },
                name_new_condominium_apartment: {
                    required: true,
                    maxlength: 191,
                    lettersdigitnumber: true,
                    remote: {
                        url: '{{ app('router')->has('condominium.apartment.check.name') ? route('condominium.apartment.check.name') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            block: function () {
                                return $('#block-id-new-condominium-apartment').val();
                            },
                            name: function () {
                                return $('#name-new-condominium-apartment').val();
                            }
                        },
                        dataFilter: function (data) {
                            let json = JSON.parse(data);

                            if (!json) {
                                return false;
                            }

                            if (json.align && json.from) {
                                notifyValidate('Rota bloqueada para validação do nome do apartamento.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            if (json.status === 0) {
                                notifyValidate('Rota excluída para validação do nome do apartamento.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            return true;
                        },
                    },
                },
                'parking_id_new_condominium_apartment[]': {
                    required: true,
                },
                description_new_condominium_apartment: {
                    minlength: 10,
                    maxlength: 1500,
                },
            },
            messages: {
                block_id_new_condominium_apartment: {
                    required:           'O campo bloco do apartamento é obrigatório.',
                },
                name_new_condominium_apartment: {
                    required:           'O campo nome do apartamento é obrigatório.',
                    maxlength:          'O campo nome do apartamento não pode ser superior a {0} caracteres.',
                    lettersdigitnumber: 'O campo nome do apartamento deve ter somente letras, números, espaços e caracteres permitidos.',
                    remote:             'O campo nome do apartamento já está sendo utilizado.',
                },
                'parking_id_new_condominium_apartment[]': {
                    required:  'O campo estacionamento é obrigatório.',
                },
                description_new_condominium_apartment: {
                    minlength:          'O campo descrição deve ter pelo menos {0} caracteres.',
                    maxlength:          'O campo descrição não pode ser superior a {0} caracteres.',
                },
            }
        });
    });
</script>
