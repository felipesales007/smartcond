<script>
    $('#form-block-inventory-category').validate({
        rules: {
            id_block_inventory_category: {
                required: true,
                maxlength: 20,
                number: true,
            },
        },
        messages: {
            id_block_inventory_category: {
                required:  'O campo id é obrigatório.',
                maxlength: 'O campo id não pode ser superior a {0} dígitos.',
                number:    'O campo id deve ser um número.',
            },
        }
    });
</script>
