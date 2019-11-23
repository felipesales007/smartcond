<script>
    $(function () {
        $('#form-edit-group').validate({
            rules: {
                id_edit_group: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_edit_group: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersgroup: true,
                    remote: {
                        url: '{{ app('router')->has('group.check.name.different') ? route('group.check.name.different') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: function () {
                                return $('#id-edit-group').val();
                            },
                            name: function () {
                                return $('#name-edit-group').val();
                            }
                        },
                        dataFilter: function (data) {
                            let json = JSON.parse(data);

                            if (!json) {
                                return false;
                            }

                            if (json.align && json.from) {
                                notifyValidate('Rota bloqueada para validação do nome do grupo.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            if (json.status === 0) {
                                notifyValidate('Rota excluída para validação do nome do grupo.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            return true;
                        },
                    },
                },
                description_edit_group: {
                    minlength: 10,
                    maxlength: 1500,
                },
            },
            messages: {
                id_edit_group: {
                    required:     'O campo id é obrigatório.',
                    maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                    number:       'O campo id deve ser um número.',
                },
                name_edit_group: {
                    required:     'O campo nome é obrigatório.',
                    minlength:    'O campo nome deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome não pode ser superior a {0} caracteres.',
                    lettersgroup: 'O campo nome deve ter somente letras minúsculas e caracteres permitidos.',
                    remote:       'O campo nome já está sendo utilizado.',
                },
                description_edit_group: {
                    minlength:    'O campo descrição deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo descrição não pode ser superior a {0} caracteres.',
                },
            }
        });
    });
</script>
