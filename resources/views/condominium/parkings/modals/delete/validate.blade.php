<script>
    $(function () {
        $('#form-delete-condominium-parking').validate({
            rules: {
                id_delete_condominium_parking: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_delete_condominium_parking: {
                    required: true,
                    maxlength: 191,
                    lettersdigitnumber: true,
                },
                name_confirmation_delete_condominium_parking: {
                    required: true,
                    maxlength: 191,
                    lettersdigitnumber: true,
                    equalTo: '#name-delete-condominium-parking',
                },
            },
            messages: {
                id_delete_condominium_parking: {
                    required:           'O campo id é obrigatório.',
                    maxlength:          'O campo id não pode ser superior a {0} dígitos.',
                    number:             'O campo id deve ser um número.',
                },
                name_delete_condominium_parking: {
                    required:           'O campo nome do estacionamento é obrigatório.',
                    maxlength:          'O campo nome do estacionamento não pode ser superior a {0} caracteres.',
                    lettersdigitnumber: 'O campo nome do estacionamento para exclusão deve ter somente letras, números, espaços e caracteres permitidos.',
                },
                name_confirmation_delete_condominium_parking: {
                    required:           'O campo nome do estacionamento para exclusão é obrigatório.',
                    maxlength:          'O campo nome do estacionamento para exclusão não pode ser superior a {0} caracteres.',
                    lettersdigitnumber: 'O campo nome do estacionamento para exclusão deve ter somente letras, números, espaços e caracteres permitidos.',
                    equalTo:            'O campo nome do estacionamento para exclusão de confirmação não confere.',
                },
            }
        });
    });
</script>
