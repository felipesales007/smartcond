<script>
    $(function () {
        $('#form-edit-condominium-block').validate({
            rules: {
                id_edit_condominium_block: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_edit_condominium_block: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                    remote: {
                        url: '{{ app('router')->has('condominium.block.check.name.different') ? route('condominium.block.check.name.different') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: function () {
                                return $('#id-edit-condominium-block').val();
                            },
                            name: function () {
                                return $('#name-edit-condominium-block').val();
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
                description_edit_condominium_block: {
                    minlength: 10,
                    maxlength: 1500,
                },
            },
            messages: {
                id_edit_condominium_block: {
                    required:     'O campo id é obrigatório.',
                    maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                    number:       'O campo id deve ser um número.',
                },
                name_edit_condominium_block: {
                    required:     'O campo nome do bloco é obrigatório.',
                    minlength:    'O campo nome do bloco deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome do bloco não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome do bloco deve ter somente letras, espaços e caracteres permitidos.',
                    remote:       'O campo nome do bloco já está sendo utilizado.',
                },
                description_edit_condominium_block: {
                    minlength:    'O campo descrição deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo descrição não pode ser superior a {0} caracteres.',
                },
            }
        });
    });
</script>
