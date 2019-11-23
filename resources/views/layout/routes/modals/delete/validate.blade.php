<script>
    $(function () {
        $('#form-delete-route').validate({
            rules: {
                id_delete_route: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                route_delete_route: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersroute: true,
                },
                route_confirmation_delete_route: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersroute: true,
                    equalTo: '#route-delete-route',
                },
            },
            messages: {
                id_delete_route: {
                    required:     'O campo id é obrigatório.',
                    maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                    number:       'O campo id deve ser um número.',
                },
                route_delete_route: {
                    required:     'O campo rota é obrigatório.',
                    minlength:    'O campo rota deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo rota não pode ser superior a {0} caracteres.',
                    lettersroute: 'O campo rota deve ter somente letras minúsculas e caracteres permitidos.',
                },
                route_confirmation_delete_route: {
                    required:     'O campo rota para exclusão é obrigatório.',
                    minlength:    'O campo rota para exclusão deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo rota para exclusão não pode ser superior a {0} caracteres.',
                    lettersroute: 'O campo rota deve ter somente letras minúsculas e caracteres permitidos.',
                    equalTo:      'O campo rota para exclusão de confirmação não confere.',
                },
            }
        });
    });
</script>
