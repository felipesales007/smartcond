@if (\App\Models\User\Permission::routePermission('permission.user.edit'))
    <script>
        $(function () {
            $('#form-edit-user-permisson').validate({
                ignore: '.ignore',
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
@endif
