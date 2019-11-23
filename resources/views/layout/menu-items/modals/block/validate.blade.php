<script>
    $(function () {
        $('#form-block-menu-item').validate({
            rules: {
                id_block_menu_item: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
            },
            messages: {
                id_block_menu_item: {
                    required:  'O campo id é obrigatório.',
                    maxlength: 'O campo id não pode ser superior a {0} dígitos.',
                    number:    'O campo id deve ser um número.',
                },
            }
        });
    });
</script>
