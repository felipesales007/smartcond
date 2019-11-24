<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-send-email-entity').removeAttr('disabled', 'disabled').html('Enviar e-mail');
            $('#form-send-email-entity').trigger('reset');
        };

        // enviar e-mail
        $(document).on('click', '.btn-modal-send-email-entity', function (e) {
            e.preventDefault();
            available();
            $('#name-send-email-entity').val($(this).data('name'));
            $('#email-send-email-entity').val($(this).data('email'));
            if ($(this).data('logo')) {
                $('#logo-send-email-entity').removeClass('d-none').css('background-image', 'url({{ url('storage/images/companies/logo') }}/' + $(this).data('logo') + ')');
            } else {
                $('#logo-send-email-entity').addClass('d-none').css('background-image', '');
            }
            $('#text-name-send-email-entity').html('Para: <b>' + $(this).data('name') + '</b>');

            $('#modal-send-email-entity').modal('show');
        });

        // enviando e-mail
        $(document).on('click', '#btn-send-email-entity', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-send-email-entity').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-send-email-entity').serialize(),
                    url: '{{ app('router')->has('entity.send.email') ? route('entity.send.email') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-send-email-entity').modal('hide');
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-send-email-entity').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-send-email-entity').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao enviar o e-mail para o condomínio.');
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
