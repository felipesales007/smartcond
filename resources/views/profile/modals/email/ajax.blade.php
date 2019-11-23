<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-send-support-profile').removeAttr('disabled', 'disabled').html('Enviar e-mail');
            $('#reason-send-support-profile').val('').trigger('change');
            $('#form-send-support-profile').trigger('reset');
        };

        // enviar e-mail
        $(document).on('click', '.btn-modal-send-support-profile', function (e) {
            e.preventDefault();
            available();
            $('#modal-send-support-profile').modal('show');
        });

        // enviando e-mail
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
                        available();
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
