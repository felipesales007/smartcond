<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-condominium-parking').removeAttr('disabled', 'disabled').html('Criar estacionamento');
            $('#form-new-condominium-parking').trigger('reset');
        };

        // novo
        $(document).on('click', '.btn-modal-new-condominium-parking', function (e) {
            e.preventDefault();
            available();
            $('#modal-new-condominium-parking').modal('show');
        });

        // salvando
        $(document).on('click', '#btn-new-condominium-parking', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-condominium-parking').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-condominium-parking').serialize(),
                    url: '{{ app('router')->has('condominium.parking.store') ? route('condominium.parking.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-new-condominium-parking').modal('hide');
                        $('#datatable-condominium-parkings').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-condominium-parking').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-condominium-parking').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo estacionamento.');
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
