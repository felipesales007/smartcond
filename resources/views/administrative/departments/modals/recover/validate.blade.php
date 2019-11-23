<script>
    $(function () {
        $('#form-recover-department').validate({
            rules: {
                id_recover_department: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_recover_department: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                },
                name_confirmation_recover_department: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                    equalTo: '#name-recover-department',
                },
            },
            messages: {
                id_recover_department: {
                    required:     'O campo id é obrigatório.',
                    maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                    number:       'O campo id deve ser um número.',
                },
                name_recover_department: {
                    required:     'O campo nome do departamento é obrigatório.',
                    minlength:    'O campo nome do departamento deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome do departamento não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome do departamento deve ter somente letras, espaços e caracteres permitidos.',
                },
                name_confirmation_recover_department: {
                    required:     'O campo nome do departamento para recuperação é obrigatório.',
                    minlength:    'O campo nome do departamento para recuperação deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome do departamento para recuperação não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome do departamento para recuperação deve ter somente letras, espaços e caracteres permitidos.',
                    equalTo:      'O campo nome do departamento para recuperação de confirmação não confere.',
                },
            }
        });
    });
</script>
