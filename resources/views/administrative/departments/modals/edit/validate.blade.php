<script>
    $(function () {
        $('#form-edit-department').validate({
            rules: {
                id_edit_department: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_edit_department: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,remote: {
                        url: '{{ app('router')->has('department.check.name.different') ? route('department.check.name.different') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: function () {
                                return $('#id-edit-department').val();
                            },
                            name: function () {
                                return $('#name-edit-department').val();
                            }
                        },
                        dataFilter: function (data) {
                            let json = JSON.parse(data);

                            if (!json) {
                                return false;
                            }

                            if (json.align && json.from) {
                                notifyValidate('Rota bloqueada para validação do nome do departamento.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            if (json.status === 0) {
                                notifyValidate('Rota excluída para validação do nome do departamento.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            return true;
                        },
                    },
                },
                description_edit_department: {
                    minlength: 10,
                    maxlength: 1500,
                },
            },
            messages: {
                id_edit_department: {
                    required:     'O campo id é obrigatório.',
                    maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                    number:       'O campo id deve ser um número.',
                },
                name_edit_department: {
                    required:     'O campo nome do departamento é obrigatório.',
                    minlength:    'O campo nome do departamento deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome do departamento não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome do departamento deve ter somente letras, espaços e caracteres permitidos.',
                    remote:       'O campo nome do departamento já está sendo utilizado.',
                },
                description_edit_department: {
                    minlength:    'O campo descrição deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo descrição não pode ser superior a {0} caracteres.',
                },
            }
        });
    });
</script>
