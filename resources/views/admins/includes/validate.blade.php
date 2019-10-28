@if (\App\Models\Permission::buttonPermission('btn-resend-email-admin'))
    <!-- reenviar e-mail de confirmação do administrador -->
    <script>
        $(function () {
            $('.form-resend-email-admin').validate({
                rules: {
                    id_resend_email_admin: {
                        required: true,
                        maxlength: 20,
                        number: true,
                    },
                },
                messages: {
                    id_resend_email_admin: {
                        required:  'O campo id é obrigatório.',
                        maxlength: 'O campo id não pode ser superior a {0} dígitos.',
                        number:    'O campo id deve ser um número.',
                    },
                }
            });
        });
    </script>
@endif
