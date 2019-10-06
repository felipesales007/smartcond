<script>
    $(function () {
        // editar permissão do usuário
        $('#form-edit-user-permisson').validate({
            rules: {
                id_edit_user_permission: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
            },
            messages: {
                id_edit_user_permission: {
                    required:  'O campo id é obrigatório.',
                    maxlength: 'O campo id não pode ser superior a {0} dígitos.',
                    number:    'O campo id deve ser um número.',
                },
            }
        });
    });
</script>
