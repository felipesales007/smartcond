<script>
    $(function () {
        $('#form-delete-condominium-apartment').validate({
            rules: {
                id_delete_condominium_apartment: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_delete_condominium_apartment: {
                    required: true,
                    maxlength: 191,
                    lettersdigitnumber: true,
                },
                name_confirmation_delete_condominium_apartment: {
                    required: true,
                    maxlength: 191,
                    lettersdigitnumber: true,
                    equalTo: '#name-delete-condominium-apartment',
                },
            },
            messages: {
                id_delete_condominium_apartment: {
                    required:           'O campo id é obrigatório.',
                    maxlength:          'O campo id não pode ser superior a {0} dígitos.',
                    number:             'O campo id deve ser um número.',
                },
                name_delete_condominium_apartment: {
                    required:           'O campo nome do apartamento é obrigatório.',
                    maxlength:          'O campo nome do apartamento não pode ser superior a {0} caracteres.',
                    lettersdigitnumber: 'O campo nome do apartamento para exclusão deve ter somente letras, números, espaços e caracteres permitidos.',
                },
                name_confirmation_delete_condominium_apartment: {
                    required:           'O campo nome do apartamento para exclusão é obrigatório.',
                    maxlength:          'O campo nome do apartamento para exclusão não pode ser superior a {0} caracteres.',
                    lettersdigitnumber: 'O campo nome do apartamento para exclusão deve ter somente letras, números, espaços e caracteres permitidos.',
                    equalTo:            'O campo nome do apartamento para exclusão de confirmação não confere.',
                },
            }
        });
    });
</script>
