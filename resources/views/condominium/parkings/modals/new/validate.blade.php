<script>
    $(function () {
        $('#form-new-condominium-parking').validate({
            rules: {
                name_new_condominium_parking: {
                    required: true,
                    maxlength: 191,
                    lettersdigitnumber: true,
                    remote: {
                        url: '{{ app('router')->has('condominium.parking.check.name') ? route('condominium.parking.check.name') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            name: function () {
                                return $('#name-new-condominium-parking').val();
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
                description_new_condominium_parking: {
                    minlength: 10,
                    maxlength: 1500,
                },
            },
            messages: {
                name_new_condominium_parking: {
                    required:           'O campo nome do estacionamento é obrigatório.',
                    maxlength:          'O campo nome do estacionamento não pode ser superior a {0} caracteres.',
                    lettersdigitnumber: 'O campo nome do estacionamento deve ter somente letras, números, espaços e caracteres permitidos.',
                    remote:             'O campo nome do estacionamento já está sendo utilizado.',
                },
                description_new_condominium_parking: {
                    minlength:          'O campo descrição deve ter pelo menos {0} caracteres.',
                    maxlength:          'O campo descrição não pode ser superior a {0} caracteres.',
                },
            }
        });
    });
</script>
