<script>
    $(function () {
        $('#form-edit-condominium-parking').validate({
            rules: {
                id_edit_condominium_parking: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_edit_condominium_parking: {
                    required: true,
                    maxlength: 191,
                    lettersdigitnumber: true,
                    remote: {
                        url: '{{ app('router')->has('condominium.parking.check.name.different') ? route('condominium.parking.check.name.different') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: function () {
                                return $('#id-edit-condominium-parking').val();
                            },
                            name: function () {
                                return $('#name-edit-condominium-parking').val();
                            }
                        },
                        dataFilter: function (data) {
                            let json = JSON.parse(data);

                            if (!json) {
                                return false;
                            }

                            if (json.align && json.from) {
                                notifyValidate('Rota bloqueada para validação do nome do estacionamento.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            if (json.status === 0) {
                                notifyValidate('Rota excluída para validação do nome do estacionamento.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            return true;
                        },
                    },
                },
                description_edit_condominium_parking: {
                    minlength: 10,
                    maxlength: 1500,
                },
            },
            messages: {
                id_edit_condominium_parking: {
                    required:           'O campo id é obrigatório.',
                    maxlength:          'O campo id não pode ser superior a {0} dígitos.',
                    number:             'O campo id deve ser um número.',
                },
                name_edit_condominium_parking: {
                    required:           'O campo nome do estacionamento é obrigatório.',
                    maxlength:          'O campo nome do estacionamento não pode ser superior a {0} caracteres.',
                    lettersdigitnumber: 'O campo nome do estacionamento deve ter somente letras, números, espaços e caracteres permitidos.',
                    remote:             'O campo nome do estacionamento já está sendo utilizado.',
                },
                description_edit_condominium_parking: {
                    minlength:          'O campo descrição deve ter pelo menos {0} caracteres.',
                    maxlength:          'O campo descrição não pode ser superior a {0} caracteres.',
                },
            }
        });
    });
</script>
