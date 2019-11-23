<script>
    $(function () {
        $('#form-recover-route').validate({
            rules: {
                id_recover_route: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                route_recover_route: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersroute: true,
                },
                route_confirmation_recover_route: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersroute: true,
                    equalTo: '#route-recover-route',
                },
            },
            messages: {
                id_recover_route: {
                    required:     'O campo id é obrigatório.',
                    maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                    number:       'O campo id deve ser um número.',
                },
                route_recover_route: {
                    required:     'O campo rota é obrigatório.',
                    minlength:    'O campo rota deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo rota não pode ser superior a {0} caracteres.',
                    lettersroute: 'O campo rota deve ter somente letras minúsculas e caracteres permitidos.',
                },
                route_confirmation_recover_route: {
                    required:     'O campo rota para recuperação é obrigatório.',
                    minlength:    'O campo rota para recuperação deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo rota para recuperação não pode ser superior a {0} caracteres.',
                    lettersroute: 'O campo rota deve ter somente letras minúsculas e caracteres permitidos.',
                    equalTo:      'O campo rota para recuperação de confirmação não confere.',
                },
            }
        });
    });
</script>
