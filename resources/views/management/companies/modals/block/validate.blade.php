<script>
    $(function () {
        $('#form-block-company').validate({
            rules: {
                id_block_company: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                blocked_at_block_company: {
                    minlength: 10,
                    maxlength: 10,
                    dateITA: true,
                },
            },
            messages: {
                id_block_company: {
                    required:  'O campo id é obrigatório.',
                    maxlength: 'O campo id não pode ser superior a {0} dígitos.',
                    number:    'O campo id deve ser um número.',
                },
                blocked_at_block_company: {
                    minlength: 'O campo data determinada deve ter pelo menos 8 dígitos.',
                    maxlength: 'O campo data determinada não pode ser superior a 8 dígitos.',
                    dateITA:   'O campo data determinada não é uma data válida.',
                },
            }
        });
    });
</script>
