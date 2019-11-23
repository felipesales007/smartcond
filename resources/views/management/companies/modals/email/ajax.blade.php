<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-send-email-company').removeAttr('disabled', 'disabled').html('Enviar e-mail');
            $('#form-send-email-company').trigger('reset');
        };

        // enviar e-mail
        $(document).on('click', '.btn-modal-send-email-company', function (e) {
            e.preventDefault();
            available();
            $('#name-send-email-company').val($(this).data('name'));
            $('#email-send-email-company').val($(this).data('email'));
            if ($(this).data('logo')) {
                $('#logo-send-email-company').removeClass('d-none').css('background-image', 'url({{ url('storage/images/companies/logo') }}/' + $(this).data('logo') + ')');
            } else {
                $('#logo-send-email-company').addClass('d-none').css('background-image', '');
            }
            $('#text-name-send-email-company').html('Para: <b>' + $(this).data('name') + '</b>');

            $('#modal-send-email-company').modal('show');
        });

        // enviando e-mail
        $(document).on('click', '#btn-send-email-company', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-send-email-company').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-send-email-company').serialize(),
                    url: '{{ app('router')->has('company.send.email') ? route('company.send.email') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-send-email-company').modal('hide');
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-send-email-company').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-send-email-company').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao enviar o e-mail para a empresa.');
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
