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
