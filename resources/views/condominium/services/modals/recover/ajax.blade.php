<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-condominium-service').removeAttr('disabled', 'disabled').html('Recuperar prestador de serviços');
            $('#form-recover-condominium-service').trigger('reset');
        };

        // recuperar
        $(document).on('click', '.btn-modal-recover-condominium-service', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('condominium.service.recover') ? route('condominium.service.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-recover-condominium-service').val(data.id);
                    $('#name-confirmation-recover-condominium-service-text').html(data.name);
                    $('#name-recover-condominium-service').val(data.name);

                    $('#modal-recover-condominium-service').modal('show');
                }
            });
        });

        // recuperando
        $(document).on('click', '#btn-recover-condominium-service', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-condominium-service').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-condominium-service').serialize(),
                    url: '{{ app('router')->has('condominium.service.restore') ? route('condominium.service.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-recover-condominium-service').modal('hide');
                        $('#datatable-condominium-services-deleted').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-condominium-service').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-condominium-service').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o prestador de serviços.');
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
