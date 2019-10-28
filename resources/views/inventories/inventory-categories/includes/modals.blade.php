@if (\App\Models\Permission::buttonPermission('btn-modal-view-inventory-category'))
    <!-- visualizar categoria -->
    @include('inventories.inventory-categories.modals.view')
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-new-inventory-category'))
    <!-- nova categoria -->
    @include('inventories.inventory-categories.modals.new')
    <script>
        $(function () {
            $('#form-new-inventory-category').validate({
                rules: {
                    name_new_inventory_category: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersdigit: true,
                        remote: {
                            url: '{{ app('router')->has('inventory.category.check.name') ? route('inventory.category.check.name') : route('remote.validate.destroy') }}',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                name: function () {
                                    return $('#name-new-inventory-category').val();
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
                    description_new_inventory_category: {
                        minlength: 10,
                        maxlength: 1500,
                    },
                },
                messages: {
                    name_new_inventory_category: {
                        required:     'O campo nome da categoria é obrigatório.',
                        minlength:    'O campo nome da categoria deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo nome da categoria não pode ser superior a {0} caracteres.',
                        lettersdigit: 'O campo nome da categoria deve ter somente letras, espaços e caracteres permitidos.',
                        remote:       'O campo nome da categoria já está sendo utilizado.',
                    },
                    description_new_inventory_category: {
                        minlength:    'O campo descrição deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo descrição não pode ser superior a {0} caracteres.',
                    },
                }
            });
        });
    </script>
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-edit-inventory-category'))
    <!-- editar categoria -->
    @include('inventories.inventory-categories.modals.edit')
    <script>
        $(function () {
            $('#form-edit-inventory-category').validate({
                rules: {
                    id_edit_inventory_category: {
                        required: true,
                        maxlength: 20,
                        number: true,
                    },
                    name_edit_inventory_category: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersdigit: true,
                        remote: {
                            url: '{{ app('router')->has('inventory.category.check.name.different') ? route('inventory.category.check.name.different') : route('remote.validate.destroy') }}',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                id: function () {
                                    return $('#id-edit-inventory-category').val();
                                },
                                name: function () {
                                    return $('#name-edit-inventory-category').val();
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
                    description_edit_inventory_category: {
                        minlength: 10,
                        maxlength: 1500,
                    },
                },
                messages: {
                    id_edit_inventory_category: {
                        required:     'O campo id é obrigatório.',
                        maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                        number:       'O campo id deve ser um número.',
                    },
                    name_edit_inventory_category: {
                        required:     'O campo nome da categoria é obrigatório.',
                        minlength:    'O campo nome da categoria deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo nome da categoria não pode ser superior a {0} caracteres.',
                        lettersdigit: 'O campo nome da categoria deve ter somente letras, espaços e caracteres permitidos.',
                        remote:       'O campo nome da categoria já está sendo utilizado.',
                    },
                    description_edit_inventory_category: {
                        minlength:    'O campo descrição deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo descrição não pode ser superior a {0} caracteres.',
                    },
                }
            });
        });
    </script>
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-block-inventory-category'))
    <!-- bloquear categoria -->
    @include('inventories.inventory-categories.modals.block')
    <script>
        $('#form-block-inventory-category').validate({
            rules: {
                id_block_inventory_category: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
            },
            messages: {
                id_block_inventory_category: {
                    required:  'O campo id é obrigatório.',
                    maxlength: 'O campo id não pode ser superior a {0} dígitos.',
                    number:    'O campo id deve ser um número.',
                },
            }
        });
    </script>
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-delete-inventory-category'))
    <!-- deletar categoria -->
    @include('inventories.inventory-categories.modals.delete')
    <script>
        $(function () {
            $('#form-delete-inventory-category').validate({
                rules: {
                    id_delete_inventory_category: {
                        required: true,
                        maxlength: 20,
                        number: true,
                    },
                    name_delete_inventory_category: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersdigit: true,
                    },
                    name_confirmation_delete_inventory_category: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersdigit: true,
                        equalTo: '#name-delete-inventory-category',
                    },
                },
                messages: {
                    id_delete_inventory_category: {
                        required:     'O campo id é obrigatório.',
                        maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                        number:       'O campo id deve ser um número.',
                    },
                    name_delete_inventory_category: {
                        required:     'O campo nome da categoria é obrigatório.',
                        minlength:    'O campo nome da categoria deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo nome da categoria não pode ser superior a {0} caracteres.',
                        lettersdigit: 'O campo nome da categoria deve ter somente letras, espaços e caracteres permitidos.',
                    },
                    name_confirmation_delete_inventory_category: {
                        required:     'O campo nome da categoria para exclusão é obrigatório.',
                        minlength:    'O campo nome da categoria para exclusão deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo nome da categoria para exclusão não pode ser superior a {0} caracteres.',
                        lettersdigit: 'O campo nome da categoria para exclusão deve ter somente letras, espaços e caracteres permitidos.',
                        equalTo:      'O campo nome da categoria para exclusão de confirmação não confere.',
                    },
                }
            });
        });
    </script>
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-recover-inventory-category'))
    <!-- recuperar categoria -->
    @include('inventories.inventory-categories.modals.recover')
    <script>
        $(function () {
            $('#form-recover-inventory-category').validate({
                rules: {
                    id_recover_inventory_category: {
                        required: true,
                        maxlength: 20,
                        number: true,
                    },
                    name_recover_inventory_category: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersdigit: true,
                    },
                    name_confirmation_recover_inventory_category: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersdigit: true,
                        equalTo: '#name-recover-inventory-category',
                    },
                },
                messages: {
                    id_recover_inventory_category: {
                        required:     'O campo id é obrigatório.',
                        maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                        number:       'O campo id deve ser um número.',
                    },
                    name_recover_inventory_category: {
                        required:     'O campo nome da categoria é obrigatório.',
                        minlength:    'O campo nome da categoria deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo nome da categoria não pode ser superior a {0} caracteres.',
                        lettersdigit: 'O campo nome da categoria deve ter somente letras, espaços e caracteres permitidos.',
                    },
                    name_confirmation_recover_inventory_category: {
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
@endif
