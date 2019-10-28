@if (\App\Models\Permission::buttonPermission('btn-resend-email-user'))
    <!-- reenviar e-mail de confirmação do usuário -->
    <script>
        $(function () {
            $('.form-resend-email-user').validate({
                rules: {
                    id_resend_email_user: {
                        required: true,
                        maxlength: 20,
                        number: true,
                    },
                },
                messages: {
                    id_resend_email_user: {
                        required:  'O campo id é obrigatório.',
                        maxlength: 'O campo id não pode ser superior a {0} dígitos.',
                        number:    'O campo id deve ser um número.',
                    },
                }
            });
        });
    </script>
@endif
