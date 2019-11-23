<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-send-email-user').removeAttr('disabled', 'disabled').html('Enviar e-mail');
            $('#form-send-email-user').trigger('reset');
        };

        // enviar e-mail
        $(document).on('click', '.btn-modal-send-email-user', function (e) {
            e.preventDefault();
            available();
            $('#name-send-email-user').val($(this).data('name'));
            $('#email-send-email-user').val($(this).data('email'));
            if ($(this).data('photo')) {
                $('#photo-send-email-user').removeClass('d-none').css('background-image', 'url({{ url('storage/images/users/photo') }}/' + $(this).data('photo') + ')');
            } else {
                $('#photo-send-email-user').addClass('d-none').css('background-image', '');
            }
            $('#text-name-send-email-user').html('Para: <b>' + two_word($(this).data('name')) + '</b>');

            $('#modal-send-email-user').modal('show');
        });

        // enviando e-mail
        $(document).on('click', '#btn-send-email-user', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-send-email-user').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-send-email-user').serialize(),
                    url: '{{ app('router')->has('user.send.email') ? route('user.send.email') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-send-email-user').modal('hide');
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-send-email-user').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-send-email-user').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao enviar o e-mail para o usuário.');
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
