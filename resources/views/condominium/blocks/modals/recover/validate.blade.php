<script>
    $(function () {
        $('#form-recover-condominium-block').validate({
            rules: {
                id_recover_condominium_block: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_recover_condominium_block: {
                    required: true,
                    maxlength: 191,
                    lettersdigitnumber: true,
                },
                name_confirmation_recover_condominium_block: {
                    required: true,
                    maxlength: 191,
                    lettersdigitnumber: true,
                    equalTo: '#name-recover-condominium-block',
                },
            },
            messages: {
                id_recover_condominium_block: {
                    required:           'O campo id é obrigatório.',
                    maxlength:          'O campo id não pode ser superior a {0} dígitos.',
                    number:             'O campo id deve ser um número.',
                },
                name_recover_condominium_block: {
                    required:           'O campo nome do bloco é obrigatório.',
                    maxlength:          'O campo nome do bloco não pode ser superior a {0} caracteres.',
                    lettersdigitnumber: 'O campo nome do bloco deve ter somente letras, números, espaços e caracteres permitidos.',
                },
                name_confirmation_recover_condominium_block: {
                    required:           'O campo nome do bloco para recuperação é obrigatório.',
                    maxlength:          'O campo nome do bloco para recuperação não pode ser superior a {0} caracteres.',
                    lettersdigitnumber: 'O campo nome do bloco para recuperação deve ter somente letras, números, espaços e caracteres permitidos.',
                    equalTo:            'O campo nome do bloco para recuperação de confirmação não confere.',
                },
            }
        });
    });
</script>
