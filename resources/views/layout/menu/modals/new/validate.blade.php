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
