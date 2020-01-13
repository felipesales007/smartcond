<script>
    $(function () {
        $('#form-recover-condominium-service').validate({
            rules: {
                id_recover_condominium_service: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_recover_condominium_service: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersaccentedspace: true,
                },
                name_confirmation_recover_condominium_service: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersaccentedspace: true,
                    equalTo: '#name-recover-condominium-service',
                },
            },
            messages: {
                id_recover_condominium_service: {
                    required:             'O campo id é obrigatório.',
                    maxlength:            'O campo id não pode ser superior a {0} dígitos.',
                    number:               'O campo id deve ser um número.',
                },
                name_recover_condominium_service: {
                    required:             'O campo nome é obrigatório.',
                    minlength:            'O campo nome deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo nome não pode ser superior a {0} caracteres.',
                    lettersaccentedspace: 'O campo nome deve ter somente letras e espaços.',
                },
                name_confirmation_recover_condominium_service: {
                    required:             'O campo nome para recuperação é obrigatório.',
                    minlength:            'O campo nome deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo nome para recuperação não pode ser superior a {0} caracteres.',
                    lettersaccentedspace: 'O campo nome deve ter somente letras e espaços.',
                    equalTo:              'O campo nome para recuperação de confirmação não confere.',
                },
            }
        });
    });
</script>
