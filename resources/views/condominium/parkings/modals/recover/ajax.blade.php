<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-condominium-parking').removeAttr('disabled', 'disabled').html('Recuperar estacionamento');
            $('#form-recover-condominium-parking').trigger('reset');
        };

        // recuperar
        $(document).on('click', '.btn-modal-recover-condominium-parking', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('condominium.parking.recover') ? route('condominium.parking.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-recover-condominium-parking').val(data.id);
                    $('#name-confirmation-recover-condominium-parking-text').html(data.name);
                    $('#name-recover-condominium-parking').val(data.name);

                    $('#modal-recover-condominium-parking').modal('show');
                }
            });
        });

        // recuperando
        $(document).on('click', '#btn-recover-condominium-parking', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-condominium-parking').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-condominium-parking').serialize(),
                    url: '{{ app('router')->has('condominium.parking.restore') ? route('condominium.parking.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-recover-condominium-parking').modal('hide');
                        $('#datatable-condominium-parkings-deleted').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-condominium-parking').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-condominium-parking').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o estacionamento.');
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
