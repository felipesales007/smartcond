<script>
    $(function () {
        // modal disponível
        let passwordResetAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-password-reset-profile').removeAttr('disabled', 'disabled').html('Alterar senha');
            $('#form-password-reset-profile').trigger('reset');
        };

        // alterar a senha
        $(document).on('click', '.btn-modal-password-reset-profile', function (e) {
            e.preventDefault();
            passwordResetAvailable();
            $('#modal-password-reset-profile').modal('show');
        });

        // alterando a senha
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
    });
</script>
