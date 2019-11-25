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
