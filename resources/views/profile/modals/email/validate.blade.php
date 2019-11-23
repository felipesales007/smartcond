<script>
    $(function () {
        $('#form-send-support-profile').validate({
            rules: {
                reason_send_support_profile: {
                    required: true,
                },
                message_send_support_profile: {
                    required: true,
                    minlength: 10,
                    maxlength: 1500,
                },
            },
            messages: {
                reason_send_support_profile: {
                    required:  'O campo motivo é obrigatório.',
                },
                message_send_support_profile: {
                    required:  'O campo mensagem é obrigatório.',
                    minlength: 'O campo mensagem deve ter pelo menos {0} caracteres.',
                    maxlength: 'O campo mensagem não pode ser superior a {0} caracteres.',
                },
            }
        });
    });
</script>
