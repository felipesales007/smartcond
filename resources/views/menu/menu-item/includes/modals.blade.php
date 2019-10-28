@if (\App\Models\Permission::buttonPermission('btn-modal-view-menu-item'))
    <!-- visualizar item do menu -->
    @include('menu.menu-item.modals.view')
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-new-menu-item'))
    <!-- novo item do menu -->
    @include('menu.menu-item.modals.new')
    <script>
        $(function () {
            $('#form-new-menu-item').validate({
                rules: {
                    menu_id_new_menu_item: {
                        required: true,
                    },
                    route_id_new_menu_item: {
                        required: true,
                    },
                    name_new_menu_item: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersdigit: true,
                    },
                    order_new_menu_item: {
                        required: true,
                        maxlength: 10,
                        number: true,
                    },
                    button_new_menu_item: {
                        minlength: 3,
                        maxlength: 191,
                        lettersgroup: true,
                    },
                    description_new_menu_item: {
                        minlength: 10,
                        maxlength: 1500,
                    },
                },
                messages: {
                    menu_id_new_menu_item: {
                        required:     'O campo menu é obrigatório.',
                    },
                    route_id_new_menu_item: {
                        required:     'O campo rota é obrigatório.',
                    },
                    name_new_menu_item: {
                        required:     'O campo nome é obrigatório.',
                        minlength:    'O campo nome deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo nome não pode ser superior a {0} caracteres.',
                        lettersdigit: 'O campo nome deve ter somente letras, espaços e caracteres permitidos.',
                    },
                    order_new_menu_item: {
                        required:     'O campo ordem de listagem é obrigatório.',
                        maxlength:    'O campo ordem de listagem não pode ser superior a {0} dígitos.',
                        number:       'O campo ordem de listagem deve ser um número.',
                    },
                    button_new_menu_item: {
                        minlength:    'O campo botão deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo botão não pode ser superior a {0} caracteres.',
                        lettersgroup: 'O campo botão deve ter somente letras minúsculas e caracteres permitidos.',
                    },
                    description_new_menu_item: {
                        minlength:    'O campo descrição deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo descrição não pode ser superior a {0} caracteres.',
                    },
                }
            });
        });
    </script>
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-edit-menu-item'))
    <!-- editar item do menu -->
    @include('menu.menu-item.modals.edit')
    <script>
        $(function () {
            $('#form-edit-menu-item').validate({
                rules: {
                    id_edit_menu_item: {
                        required: true,
                        maxlength: 20,
                        number: true,
                    },
                    menu_id_edit_menu_item: {
                        required: true,
                    },
                    route_id_edit_menu_item: {
                        required: true,
                    },
                    name_edit_menu_item: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersdigit: true,
                    },
                    order_edit_menu_item: {
                        required: true,
                        maxlength: 10,
                        number: true,
                    },
                    button_edit_menu_item: {
                        minlength: 3,
                        maxlength: 191,
                        lettersgroup: true,
                    },
                    description_edit_menu_item: {
                        minlength: 10,
                        maxlength: 1500,
                    },
                },
                messages: {
                    id_edit_menu_item: {
                        required:     'O campo id é obrigatório.',
                        maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                        number:       'O campo id deve ser um número.',
                    },
                    menu_id_edit_menu_item: {
                        required:     'O campo menu é obrigatório.',
                    },
                    route_id_edit_menu_item: {
                        required:     'O campo rota é obrigatório.',
                    },
                    name_edit_menu_item: {
                        required:     'O campo nome é obrigatório.',
                        minlength:    'O campo nome deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo nome não pode ser superior a {0} caracteres.',
                        lettersdigit: 'O campo nome deve ter somente letras, espaços e caracteres permitidos.',
                    },
                    order_edit_menu_item: {
                        required:     'O campo ordem de listagem é obrigatório.',
                        maxlength:    'O campo ordem de listagem não pode ser superior a {0} dígitos.',
                        number:       'O campo ordem de listagem deve ser um número.',
                    },
                    button_edit_menu_item: {
                        minlength:    'O campo botão deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo botão não pode ser superior a {0} caracteres.',
                        lettersgroup: 'O campo botão deve ter somente letras minúsculas e caracteres permitidos.',
                    },
                    description_edit_menu_item: {
                        minlength:    'O campo descrição deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo descrição não pode ser superior a {0} caracteres.',
                    },
                }
            });
        });
    </script>
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-block-menu-item'))
    <!-- bloquear item do menu -->
    @include('menu.menu-item.modals.block')
    <script>
        $(function () {
            $('#form-block-menu-item').validate({
                rules: {
                    id_block_menu_item: {
                        required: true,
                        maxlength: 20,
                        number: true,
                    },
                },
                messages: {
                    id_block_menu_item: {
                        required:  'O campo id é obrigatório.',
                        maxlength: 'O campo id não pode ser superior a {0} dígitos.',
                        number:    'O campo id deve ser um número.',
                    },
                }
            });
        });
    </script>
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-delete-menu-item'))
    <!-- deletar item do menu -->
    @include('menu.menu-item.modals.delete')
    <script>
        $(function () {
            $('#form-delete-menu-item').validate({
                rules: {
                    id_delete_menu_item: {
                        required: true,
                        maxlength: 20,
                        number: true,
                    },
                    name_delete_menu_item: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersdigit: true,
                    },
                    name_confirmation_delete_menu_item: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersdigit: true,
                        equalTo: '#name-delete-menu-item',
                    },
                },
                messages: {
                    id_delete_menu_item: {
                        required:     'O campo id é obrigatório.',
                        maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                        number:       'O campo id deve ser um número.',
                    },
                    name_delete_menu_item: {
                        required:     'O campo nome é obrigatório.',
                        minlength:    'O campo nome deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo nome não pode ser superior a {0} caracteres.',
                        lettersdigit: 'O campo nome deve ter somente letras, espaços e caracteres permitidos.',
                    },
                    name_confirmation_delete_menu_item: {
                        required:     'O campo nome para exclusão é obrigatório.',
                        minlength:    'O campo nome para exclusão deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo nome para exclusão não pode ser superior a {0} caracteres.',
                        lettersdigit: 'O campo nome para exclusão deve ter somente letras, espaços e caracteres permitidos.',
                        equalTo:      'O campo nome para exclusão de confirmação não confere.',
                    },
                }
            });
        });
    </script>
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-recover-menu-item'))
    <!-- recuperar item do menu -->
    @include('menu.menu-item.modals.recover')
    <script>
        $(function () {
            $('#form-recover-menu-item').validate({
                rules: {
                    id_recover_menu_item: {
                        required: true,
                        maxlength: 20,
                        number: true,
                    },
                    name_recover_menu_item: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersdigit: true,
                    },
                    name_confirmation_recover_menu_item: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersdigit: true,
                        equalTo: '#name-recover-menu-item',
                    },
                },
                messages: {
                    id_recover_menu_item: {
                        required:     'O campo id é obrigatório.',
                        maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                        number:       'O campo id deve ser um número.',
                    },
                    name_recover_menu_item: {
                        required:     'O campo nome é obrigatório.',
                        minlength:    'O campo nome deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo nome não pode ser superior a {0} caracteres.',
                        lettersdigit: 'O campo nome deve ter somente letras, espaços e caracteres permitidos.',
                    },
                    name_confirmation_recover_menu_item: {
                        required:     'O campo nome para recuperação é obrigatório.',
                        minlength:    'O campo nome para recuperação deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo nome para recuperação não pode ser superior a {0} caracteres.',
                        lettersdigit: 'O campo nome deve ter somente letras, espaços e caracteres permitidos.',
                        equalTo:      'O campo nome para recuperação de confirmação não confere.',
                    },
                }
            });
        });
    </script>
@endif
