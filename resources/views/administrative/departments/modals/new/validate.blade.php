<script>
    $(function () {
        $('#form-new-department').validate({
            rules: {
                name_new_department: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                    remote: {
                        url: '{{ app('router')->has('department.check.name') ? route('department.check.name') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            name: function () {
                                return $('#name-new-department').val();
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
                description_new_department: {
                    minlength: 10,
                    maxlength: 1500,
                },
            },
            messages: {
                name_new_department: {
                    required:     'O campo nome do departamento é obrigatório.',
                    minlength:    'O campo nome do departamento deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome do departamento não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome do departamento deve ter somente letras, espaços e caracteres permitidos.',
                    remote:       'O campo nome do departamento já está sendo utilizado.',
                },
                description_new_department: {
                    minlength:    'O campo descrição deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo descrição não pode ser superior a {0} caracteres.',
                },
            }
        });
    });
</script>
