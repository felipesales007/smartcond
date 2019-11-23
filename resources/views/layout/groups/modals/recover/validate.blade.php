<script>
    $(function () {
        $('#form-recover-group').validate({
            rules: {
                id_recover_group: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_recover_group: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersgroup: true,
                },
                name_confirmation_recover_group: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersgroup: true,
                    equalTo: '#name-recover-group',
                },
            },
            messages: {
                id_recover_group: {
                    required:     'O campo id é obrigatório.',
                    maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                    number:       'O campo id deve ser um número.',
                },
                name_recover_group: {
                    required:     'O campo nome é obrigatório.',
                    minlength:    'O campo nome deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome não pode ser superior a {0} caracteres.',
                    lettersgroup: 'O campo nome deve ter somente letras minúsculas e caracteres permitidos.',
                },
                name_confirmation_recover_group: {
                    required:     'O campo nome para recuperação é obrigatório.',
                    minlength:    'O campo nome para recuperação deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome para recuperação não pode ser superior a {0} caracteres.',
                    lettersgroup: 'O campo nome deve ter somente letras minúsculas e caracteres permitidos.',
                    equalTo:      'O campo nome para recuperação de confirmação não confere.',
                },
            }
        });
    });
</script>
