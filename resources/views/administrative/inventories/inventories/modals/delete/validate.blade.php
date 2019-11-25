<script>
    $(function () {
        $('#form-delete-inventory').validate({
            rules: {
                id_delete_inventory: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_delete_inventory: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                },
                name_confirmation_delete_inventory: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                    equalTo: '#name-delete-inventory',
                },
            },
            messages: {
                id_delete_inventory: {
                    required:     'O campo id é obrigatório.',
                    maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                    number:       'O campo id deve ser um número.',
                },
                name_delete_inventory: {
                    required:     'O campo nome do item é obrigatório.',
                    minlength:    'O campo nome do item deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome do item não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome do item deve ter somente letras, espaços e caracteres permitidos.',
                },
                name_confirmation_delete_inventory: {
                    required:     'O campo nome do item para exclusão é obrigatório.',
                    minlength:    'O campo nome do item para exclusão deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome do item para exclusão não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome do item para exclusão deve ter somente letras, espaços e caracteres permitidos.',
                    equalTo:      'O campo nome do item para exclusão de confirmação não confere.',
                },
            }
        });
    });
</script>
