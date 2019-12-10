<script>
    $(function () {
        $('#form-new-condominium-block').validate({
            rules: {
                name_new_condominium_block: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                    remote: {
                        url: '{{ app('router')->has('condominium.block.check.name') ? route('condominium.block.check.name') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            name: function () {
                                return $('#name-new-condominium-block').val();
                            }
                        },
                        dataFilter: function (data) {
                            let json = JSON.parse(data);

                            if (!json) {
                                return false;
                            }

                            if (json.align && json.from) {
                                notifyValidate('Rota bloqueada para validação do nome do bloco.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            if (json.status === 0) {
                                notifyValidate('Rota excluída para validação do nome do bloco.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            return true;
                        },
                    },
                },
                description_new_condominium_block: {
                    minlength: 10,
                    maxlength: 1500,
                },
            },
            messages: {
                name_new_condominium_block: {
                    required:     'O campo nome do bloco é obrigatório.',
                    minlength:    'O campo nome do bloco deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome do bloco não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome do bloco deve ter somente letras, espaços e caracteres permitidos.',
                    remote:       'O campo nome do bloco já está sendo utilizado.',
                },
                description_new_condominium_block: {
                    minlength:    'O campo descrição deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo descrição não pode ser superior a {0} caracteres.',
                },
            }
        });
    });
</script>
