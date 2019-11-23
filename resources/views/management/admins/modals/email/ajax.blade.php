<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-send-email-admin').removeAttr('disabled', 'disabled').html('Enviar e-mail');
            $('#form-send-email-admin').trigger('reset');
        };

        // enviar e-mail
        $(document).on('click', '.btn-modal-send-email-admin', function (e) {
            e.preventDefault();
            available();
            $('#name-send-email-admin').val($(this).data('name'));
            $('#email-send-email-admin').val($(this).data('email'));
            if ($(this).data('photo')) {
                $('#photo-send-email-admin').removeClass('d-none').css('background-image', 'url({{ url('storage/images/users/photo') }}/' + $(this).data('photo') + ')');
            } else {
                $('#photo-send-email-admin').addClass('d-none').css('background-image', '');
            }
            $('#text-name-send-email-admin').html('Para: <b>' + two_word($(this).data('name')) + '</b>');

            $('#modal-send-email-admin').modal('show');
        });

        // enviando e-mail
        $(document).on('click', '#btn-send-email-admin', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-send-email-admin').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-send-email-admin').serialize(),
                    url: '{{ app('router')->has('admin.send.email') ? route('admin.send.email') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-send-email-admin').modal('hide');
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-send-email-admin').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-send-email-admin').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao enviar o e-mail para o administrador.');
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
