@if (\App\Models\Permission::buttonPermission('btn-modal-view-department'))
    <!-- visualizar departamento -->
    @include('departments.modals.view')
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-new-department'))
    <!-- novo departamento -->
    @include('departments.modals.new')
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
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-edit-department'))
    <!-- editar departamento -->
    @include('departments.modals.edit')
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
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-block-department'))
    <!-- bloquear departamento -->
    @include('departments.modals.block')
    <script>
        $(function () {
            $('#form-block-department').validate({
                rules: {
                    id_block_department: {
                        required: true,
                        maxlength: 20,
                        number: true,
                    },
                },
                messages: {
                    id_block_department: {
                        required:  'O campo id é obrigatório.',
                        maxlength: 'O campo id não pode ser superior a {0} dígitos.',
                        number:    'O campo id deve ser um número.',
                    },
                }
            });
        });
    </script>
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-delete-department'))
    <!-- deletar departamento -->
    @include('departments.modals.delete')
    <script>
        $(function () {
            $('#form-delete-department').validate({
                rules: {
                    id_delete_department: {
                        required: true,
                        maxlength: 20,
                        number: true,
                    },
                    name_delete_department: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersdigit: true,
                    },
                    name_confirmation_delete_department: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersdigit: true,
                        equalTo: '#name-delete-department',
                    },
                },
                messages: {
                    id_delete_department: {
                        required:     'O campo id é obrigatório.',
                        maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                        number:       'O campo id deve ser um número.',
                    },
                    name_delete_department: {
                        required:     'O campo nome do departamento é obrigatório.',
                        minlength:    'O campo nome do departamento deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo nome do departamento não pode ser superior a {0} caracteres.',
                        lettersdigit: 'O campo nome do departamento deve ter somente letras, espaços e caracteres permitidos.',
                    },
                    name_confirmation_delete_department: {
                        required:     'O campo nome do departamento para exclusão é obrigatório.',
                        minlength:    'O campo nome do departamento para exclusão deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo nome do departamento para exclusão não pode ser superior a {0} caracteres.',
                        lettersdigit: 'O campo nome do departamento para exclusão deve ter somente letras, espaços e caracteres permitidos.',
                        equalTo:      'O campo nome do departamento para exclusão de confirmação não confere.',
                    },
                }
            });
        });
    </script>
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-recover-department'))
    <!-- recuperar departamento -->
    @include('departments.modals.recover')
    <script>
        $(function () {
            $('#form-recover-department').validate({
                rules: {
                    id_recover_department: {
                        required: true,
                        maxlength: 20,
                        number: true,
                    },
                    name_recover_department: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersdigit: true,
                    },
                    name_confirmation_recover_department: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersdigit: true,
                        equalTo: '#name-recover-department',
                    },
                },
                messages: {
                    id_recover_department: {
                        required:     'O campo id é obrigatório.',
                        maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                        number:       'O campo id deve ser um número.',
                    },
                    name_recover_department: {
                        required:     'O campo nome do departamento é obrigatório.',
                        minlength:    'O campo nome do departamento deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo nome do departamento não pode ser superior a {0} caracteres.',
                        lettersdigit: 'O campo nome do departamento deve ter somente letras, espaços e caracteres permitidos.',
                    },
                    name_confirmation_recover_department: {
                        required:     'O campo nome do departamento para recuperação é obrigatório.',
                        minlength:    'O campo nome do departamento para recuperação deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo nome do departamento para recuperação não pode ser superior a {0} caracteres.',
                        lettersdigit: 'O campo nome do departamento para recuperação deve ter somente letras, espaços e caracteres permitidos.',
                        equalTo:      'O campo nome do departamento para recuperação de confirmação não confere.',
                    },
                }
            });
        });
    </script>
@endif
