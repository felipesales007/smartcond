<script>
    $(function () {
        $('#form-delete-user').validate({
            rules: {
                id_delete_user: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_delete_user: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersaccented: true,
                },
                name_confirmation_delete_user: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersaccented: true,
                    equalTo: '#name-delete-user',
                },
            },
            messages: {
                id_delete_user: {
                    required:        'O campo id é obrigatório.',
                    maxlength:       'O campo id não pode ser superior a {0} dígitos.',
                    number:          'O campo id deve ser um número.',
                },
                name_delete_user: {
                    required:        'O campo nome é obrigatório.',
                    minlength:       'O campo nome deve ter pelo menos {0} caracteres.',
                    maxlength:       'O campo nome não pode ser superior a {0} caracteres.',
                    lettersaccented: 'O campo nome deve ter somente letras.',
                },
                name_confirmation_delete_user: {
                    required:        'O campo nome para exclusão é obrigatório.',
                    minlength:       'O campo nome para exclusão deve ter pelo menos {0} caracteres.',
                    maxlength:       'O campo nome para exclusão não pode ser superior a {0} caracteres.',
                    lettersaccented: 'O campo nome para exclusão deve ter somente letras.',
                    equalTo:         'O campo nome para exclusão de confirmação não confere.',
                },
            }
        });
    });
</script>
