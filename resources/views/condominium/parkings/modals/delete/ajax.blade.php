<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-condominium-parking').removeAttr('disabled', 'disabled').html('Excluir estacionamento');
            $('#form-delete-condominium-parking').trigger('reset');
        };

        // deletar
        $(document).on('click', '.btn-modal-delete-condominium-parking', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('condominium.parking.delete') ? route('condominium.parking.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-delete-condominium-parking').val(data.id);
                    $('#name-confirmation-delete-condominium-parking-text').html(data.name);
                    $('#name-delete-condominium-parking').val(data.name);

                    $('#modal-delete-condominium-parking').modal('show');
                }
            });
        });

        // deletando
        $(document).on('click', '#btn-delete-condominium-parking', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-condominium-parking').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-condominium-parking').serialize(),
                    url: '{{ app('router')->has('condominium.parking.destroy') ? route('condominium.parking.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-delete-condominium-parking').modal('hide');
                        $('#datatable-condominium-parkings').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-condominium-parking').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-condominium-parking').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o estacionamento.');
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
