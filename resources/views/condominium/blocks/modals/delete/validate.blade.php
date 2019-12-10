<script>
    $(function () {
        $('#form-delete-condominium-block').validate({
            rules: {
                id_delete_condominium_block: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_delete_condominium_block: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                },
                name_confirmation_delete_condominium_block: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                    equalTo: '#name-delete-condominium-block',
                },
            },
            messages: {
                id_delete_condominium_block: {
                    required:     'O campo id é obrigatório.',
                    maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                    number:       'O campo id deve ser um número.',
                },
                name_delete_condominium_block: {
                    required:     'O campo nome do bloco é obrigatório.',
                    minlength:    'O campo nome do bloco deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome do bloco não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome do bloco deve ter somente letras, espaços e caracteres permitidos.',
                },
                name_confirmation_delete_condominium_block: {
                    required:     'O campo nome do bloco para exclusão é obrigatório.',
                    minlength:    'O campo nome do bloco para exclusão deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome do bloco para exclusão não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome do bloco para exclusão deve ter somente letras, espaços e caracteres permitidos.',
                    equalTo:      'O campo nome do bloco para exclusão de confirmação não confere.',
                },
            }
        });
    });
</script>
