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
