<script>
    $(function () {
        $('#form-delete-department').validate({
            rules: {
                id_delete_department: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_delete_department: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                },
                name_confirmation_delete_department: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                    equalTo: '#name-delete-department',
                },
            },
            messages: {
                id_delete_department: {
                    required:     'O campo id é obrigatório.',
                    maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                    number:       'O campo id deve ser um número.',
                },
                name_delete_department: {
                    required:     'O campo nome do departamento é obrigatório.',
                    minlength:    'O campo nome do departamento deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome do departamento não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome do departamento deve ter somente letras, espaços e caracteres permitidos.',
                },
                name_confirmation_delete_department: {
                    required:     'O campo nome do departamento para exclusão é obrigatório.',
                    minlength:    'O campo nome do departamento para exclusão deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome do departamento para exclusão não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome do departamento para exclusão deve ter somente letras, espaços e caracteres permitidos.',
                    equalTo:      'O campo nome do departamento para exclusão de confirmação não confere.',
                },
            }
        });
    });
</script>
