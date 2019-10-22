<script>
    $(function () {
        // modal de alteração de senha do usuário disponível
        let passwordResetAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-password-reset-profile').removeAttr('disabled', 'disabled').html('Alterar senha');
            $('#form-password-reset-profile').trigger('reset');
        };

        // modal de envio de e-mail ao suporte disponível
        let supportSendAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-send-support-profile').removeAttr('disabled', 'disabled').html('Enviar e-mail');
            $('#reason-send-support-profile').val('').trigger('change');
            $('#form-send-support-profile').trigger('reset');
        };

        // alterar a senha de usuário
        $(document).on('click', '.btn-modal-password-reset-profile', function (e) {
            e.preventDefault();
            passwordResetAvailable();
            $('#modal-password-reset-profile').modal('show');
        });

        // alterando a senha de usuário
        $(document).on('click', '#btn-password-reset-profile', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-password-reset-profile').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-password-reset-profile').serialize(),
                    url: '{{ app('router')->has('profile.password.reset') ? route('profile.password.reset') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        passwordResetAvailable();
                        $('#modal-password-reset-profile').modal('hide');
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-password-reset-profile').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-password-reset-profile').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao alterar a senha.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // enviar e-mail de contato
        $(document).on('click', '.btn-modal-send-support-profile', function (e) {
            e.preventDefault();
            supportSendAvailable();
            $('#modal-send-support-profile').modal('show');
        });

        // enviando e-mail de contato
        $(document).on('click', '#btn-send-support-profile', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-send-support-profile').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-send-support-profile').serialize(),
                    url: '{{ app('router')->has('profile.send.support') ? route('profile.send.support') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        supportSendAvailable();
                        $('#modal-send-support-profile').modal('hide');
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-send-support-profile').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-send-support-profile').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao enviar a mensagem para o suporte.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });
    });
</script>
