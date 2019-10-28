@if (\App\Models\Permission::buttonPermission('btn-modal-view-menu'))
    <!-- visualizar menu -->
    @include('menu.menu.modals.view')
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-new-menu'))
    <!-- novo menu -->
    @include('menu.menu.modals.new')
    <script>
        $(function () {
            $('#form-new-menu').validate({
                rules: {
                    name_new_menu: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersaccentedspace: true,
                    },
                    menu_option_id_new_menu: {
                        required: true,
                    },
                    icon_new_menu: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersicon: true,
                    },
                    color_id_new_menu: {
                        required: true,
                    },
                    order_new_menu: {
                        required: true,
                        maxlength: 10,
                        number: true,
                    },
                    description_new_menu: {
                        minlength: 10,
                        maxlength: 1500,
                    },
                },
                messages: {
                    name_new_menu: {
                        required:             'O campo nome é obrigatório.',
                        minlength:            'O campo nome deve ter pelo menos {0} caracteres.',
                        maxlength:            'O campo nome não pode ser superior a {0} caracteres.',
                        lettersaccentedspace: 'O campo nome deve ter somente letras e espaços.',
                    },
                    menu_option_id_new_menu: {
                        required:             'O campo tipo de menu é obrigatório.',
                    },
                    icon_new_menu: {
                        required:             'O campo ícone é obrigatório.',
                        minlength:            'O campo ícone deve ter pelo menos {0} caracteres.',
                        maxlength:            'O campo ícone não pode ser superior a {0} caracteres.',
                        lettersicon:          'O campo ícone deve ter somente letras, espaços e caracteres permitidos.',
                    },
                    color_id_new_menu: {
                        required:             'O campo tipo de menu é obrigatório.',
                    },
                    order_new_menu: {
                        required:             'O campo ordem de listagem é obrigatório.',
                        maxlength:            'O campo ordem de listagem não pode ser superior a {0} dígitos.',
                        number:               'O campo ordem de listagem deve ser um número.',
                    },
                    description_new_menu: {
                        minlength:            'O campo descrição deve ter pelo menos {0} caracteres.',
                        maxlength:            'O campo descrição não pode ser superior a {0} caracteres.',
                    },
                }
            });
        });
    </script>
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-edit-menu'))
    <!-- editar menu -->
    @include('menu.menu.modals.edit')
    <script>
        $(function () {
            $('#form-edit-menu').validate({
                rules: {
                    id_edit_menu: {
                        required: true,
                        maxlength: 20,
                        number: true,
                    },
                    name_edit_menu: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersaccentedspace: true,
                    },
                    menu_option_id_edit_menu: {
                        required: true,
                    },
                    icon_edit_menu: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersicon: true,
                    },
                    color_id_edit_menu: {
                        required: true,
                    },
                    order_edit_menu: {
                        required: true,
                        maxlength: 10,
                        number: true,
                    },
                    description_edit_menu: {
                        minlength: 10,
                        maxlength: 1500,
                    },
                },
                messages: {
                    id_edit_menu: {
                        required:             'O campo id é obrigatório.',
                        maxlength:            'O campo id não pode ser superior a {0} dígitos.',
                        number:               'O campo id deve ser um número.',
                    },
                    name_edit_menu: {
                        required:             'O campo nome é obrigatório.',
                        minlength:            'O campo nome deve ter pelo menos {0} caracteres.',
                        maxlength:            'O campo nome não pode ser superior a {0} caracteres.',
                        lettersaccentedspace: 'O campo nome deve ter somente letras e espaços.',
                    },
                    menu_option_id_edit_menu: {
                        required:             'O campo tipo de menu é obrigatório.',
                    },
                    icon_edit_menu: {
                        required:             'O campo ícone é obrigatório.',
                        minlength:            'O campo ícone deve ter pelo menos {0} caracteres.',
                        maxlength:            'O campo ícone não pode ser superior a {0} caracteres.',
                        lettersicon:          'O campo ícone deve ter somente letras, espaços e caracteres permitidos.',
                    },
                    color_id_edit_menu: {
                        required:             'O campo tipo de menu é obrigatório.',
                    },
                    order_edit_menu: {
                        required:             'O campo ordem de listagem é obrigatório.',
                        maxlength:            'O campo ordem de listagem não pode ser superior a {0} dígitos.',
                        number:               'O campo ordem de listagem deve ser um número.',
                    },
                    description_edit_menu: {
                        minlength:            'O campo descrição deve ter pelo menos {0} caracteres.',
                        maxlength:            'O campo descrição não pode ser superior a {0} caracteres.',
                    },
                }
            });
        });
    </script>
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-block-menu'))
    <!-- bloquear menu -->
    @include('menu.menu.modals.block')
    <script>
        $(function () {
            $('#form-block-menu').validate({
                rules: {
                    id_block_menu: {
                        required: true,
                        maxlength: 20,
                        number: true,
                    },
                },
                messages: {
                    id_block_menu: {
                        required:  'O campo id é obrigatório.',
                        maxlength: 'O campo id não pode ser superior a {0} dígitos.',
                        number:    'O campo id deve ser um número.',
                    },
                }
            });
        });
    </script>
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-delete-menu'))
    <!-- deletar menu -->
    @include('menu.menu.modals.delete')
    <script>
        $(function () {
            $('#form-delete-menu').validate({
                rules: {
                    id_delete_menu: {
                        required: true,
                        maxlength: 20,
                        number: true,
                    },
                    name_delete_menu: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersaccentedspace: true,
                    },
                    name_confirmation_delete_menu: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersaccentedspace: true,
                        equalTo: '#name-delete-menu',
                    },
                },
                messages: {
                    id_delete_menu: {
                        required:             'O campo id é obrigatório.',
                        maxlength:            'O campo id não pode ser superior a {0} dígitos.',
                        number:               'O campo id deve ser um número.',
                    },
                    name_delete_menu: {
                        required:             'O campo nome é obrigatório.',
                        minlength:            'O campo nome deve ter pelo menos {0} caracteres.',
                        maxlength:            'O campo nome não pode ser superior a {0} caracteres.',
                        lettersaccentedspace: 'O campo nome deve ter somente letras e espaços.',
                    },
                    name_confirmation_delete_menu: {
                        required:             'O campo nome para exclusão é obrigatório.',
                        minlength:            'O campo nome para exclusão deve ter pelo menos {0} caracteres.',
                        maxlength:            'O campo nome para exclusão não pode ser superior a {0} caracteres.',
                        lettersaccentedspace: 'O campo nome para exclusão deve ter somente letras e espaços.',
                        equalTo:              'O campo nome para exclusão de confirmação não confere.',
                    },
                }
            });
        });
    </script>
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-recover-menu'))
    <!-- recuperar menu -->
    @include('menu.menu.modals.recover')
    <script>
        $(function () {
            $('#form-recover-menu').validate({
                rules: {
                    id_recover_menu: {
                        required: true,
                        maxlength: 20,
                        number: true,
                    },
                    name_recover_menu: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersaccentedspace: true,
                    },
                    name_confirmation_recover_menu: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersaccentedspace: true,
                        equalTo: '#name-recover-menu',
                    },
                },
                messages: {
                    id_recover_menu: {
                        required:             'O campo id é obrigatório.',
                        maxlength:            'O campo id não pode ser superior a {0} dígitos.',
                        number:               'O campo id deve ser um número.',
                    },
                    name_recover_menu: {
                        required:             'O campo nome é obrigatório.',
                        minlength:            'O campo nome deve ter pelo menos {0} caracteres.',
                        maxlength:            'O campo nome não pode ser superior a {0} caracteres.',
                        lettersaccentedspace: 'O campo nome deve ter somente letras e espaços.',
                    },
                    name_confirmation_recover_menu: {
                        required:             'O campo nome para recuperação é obrigatório.',
                        minlength:            'O campo nome para recuperação deve ter pelo menos {0} caracteres.',
                        maxlength:            'O campo nome para recuperação não pode ser superior a {0} caracteres.',
                        lettersaccentedspace: 'O campo nome deve ter somente letras e espaços.',
                        equalTo:              'O campo nome para recuperação de confirmação não confere.',
                    },
                }
            });
        });
    </script>
@endif
