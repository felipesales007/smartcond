<script>
    $(function () {
        $('#form-block-route').validate({
            rules: {
                id_block_route: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
            },
            messages: {
                id_block_route: {
                    required:  'O campo id é obrigatório.',
                    maxlength: 'O campo id não pode ser superior a {0} dígitos.',
                    number:    'O campo id deve ser um número.',
                },
            }
        });
    });
</script>
