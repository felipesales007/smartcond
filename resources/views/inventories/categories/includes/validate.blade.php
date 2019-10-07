<script>
    $(function () {
        // novo departamento
        $('#form-new-category').validate({
            rules: {
                name_new_category: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                    remote: {
                        url: '{{ app('router')->has('category.check.name') ? route('category.check.name') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            name: function () {
                                return $('#name-new-category').val();
                            }
                        },
                        dataFilter: function (data) {
                            let json = JSON.parse(data);

                            if (!json) {
                                return false;
                            }

                            if (json.align && json.from) {
                                notifyValidate('Rota bloqueada para validação do nome da categoria.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            if (json.status === 0) {
                                notifyValidate('Rota excluída para validação do nome da categoria.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            return true;
                        },
                    },
                },
                description_new_category: {
                    minlength: 10,
                    maxlength: 1500,
                },
            },
            messages: {
                name_new_category: {
                    required:     'O campo nome da categoria é obrigatório.',
                    minlength:    'O campo nome da categoria deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome da categoria não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome da categoria deve ter somente letras, espaços e caracteres permitidos.',
                    remote:       'O campo nome da categoria já está sendo utilizado.',
                },
                description_new_category: {
                    minlength:    'O campo descrição deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo descrição não pode ser superior a {0} caracteres.',
                },
            }
        });

        // editar departamento
        $('#form-edit-category').validate({
            rules: {
                id_edit_category: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_edit_category: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,remote: {
                        url: '{{ app('router')->has('category.check.name.different') ? route('category.check.name.different') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: function () {
                                return $('#id-edit-category').val();
                            },
                            name: function () {
                                return $('#name-edit-category').val();
                            }
                        },
                        dataFilter: function (data) {
                            let json = JSON.parse(data);

                            if (!json) {
                                return false;
                            }

                            if (json.align && json.from) {
                                notifyValidate('Rota bloqueada para validação do nome da categoria.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            if (json.status === 0) {
                                notifyValidate('Rota excluída para validação do nome da categoria.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            return true;
                        },
                    },
                },
                description_edit_category: {
                    minlength: 10,
                    maxlength: 1500,
                },
            },
            messages: {
                id_edit_category: {
                    required:     'O campo id é obrigatório.',
                    maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                    number:       'O campo id deve ser um número.',
                },
                name_edit_category: {
                    required:     'O campo nome da categoria é obrigatório.',
                    minlength:    'O campo nome da categoria deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome da categoria não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome da categoria deve ter somente letras, espaços e caracteres permitidos.',
                    remote:       'O campo nome da categoria já está sendo utilizado.',
                },
                description_edit_category: {
                    minlength:    'O campo descrição deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo descrição não pode ser superior a {0} caracteres.',
                },
            }
        });

        // bloquear departamento
        $('#form-block-category').validate({
            rules: {
                id_block_category: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
            },
            messages: {
                id_block_category: {
                    required:  'O campo id é obrigatório.',
                    maxlength: 'O campo id não pode ser superior a {0} dígitos.',
                    number:    'O campo id deve ser um número.',
                },
            }
        });

        // deletar departamento
        $('#form-delete-category').validate({
            rules: {
                id_delete_category: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_delete_category: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                },
                name_confirmation_delete_category: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                    equalTo: '#name-delete-category',
                },
            },
            messages: {
                id_delete_category: {
                    required:     'O campo id é obrigatório.',
                    maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                    number:       'O campo id deve ser um número.',
                },
                name_delete_category: {
                    required:     'O campo nome da categoria é obrigatório.',
                    minlength:    'O campo nome da categoria deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome da categoria não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome da categoria deve ter somente letras, espaços e caracteres permitidos.',
                },
                name_confirmation_delete_category: {
                    required:     'O campo nome da categoria para exclusão é obrigatório.',
                    minlength:    'O campo nome da categoria para exclusão deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome da categoria para exclusão não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome da categoria para exclusão deve ter somente letras, espaços e caracteres permitidos.',
                    equalTo:      'O campo nome da categoria para exclusão de confirmação não confere.',
                },
            }
        });

        // recuperar departamento
        $('#form-recover-category').validate({
            rules: {
                id_recover_category: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_recover_category: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                },
                name_confirmation_recover_category: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                    equalTo: '#name-recover-category',
                },
            },
            messages: {
                id_recover_category: {
                    required:     'O campo id é obrigatório.',
                    maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                    number:       'O campo id deve ser um número.',
                },
                name_recover_category: {
                    required:     'O campo nome da categoria é obrigatório.',
                    minlength:    'O campo nome da categoria deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome da categoria não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome da categoria deve ter somente letras, espaços e caracteres permitidos.',
                },
                name_confirmation_recover_category: {
                    required:     'O campo nome da categoria para recuperação é obrigatório.',
                    minlength:    'O campo nome da categoria para recuperação deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome da categoria para recuperação não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome da categoria para recuperação deve ter somente letras, espaços e caracteres permitidos.',
                    equalTo:      'O campo nome da categoria para recuperação de confirmação não confere.',
                },
            }
        });
    });
</script>
