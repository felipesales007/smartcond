<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-condominium-parking').removeAttr('disabled', 'disabled').html('Editar estacionamento');
            $('#form-edit-condominium-parking').trigger('reset');
        };

        // editar
        $(document).on('click', '.btn-modal-edit-condominium-parking', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('condominium.parking.edit') ? route('condominium.parking.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    // dados
                    $('#id-edit-condominium-parking').val(data.id);
                    $('#name-edit-condominium-parking').val(data.name);
                    $('#description-edit-condominium-parking').val(data.description);
                }

                $('#modal-edit-condominium-parking').modal('show');
            });
        });

        // editando
        $(document).on('click', '#btn-edit-condominium-parking', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-condominium-parking').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-edit-condominium-parking').serialize(),
                    url: '{{ app('router')->has('condominium.parking.update') ? route('condominium.parking.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-edit-condominium-parking').modal('hide');
                        $('#datatable-condominium-parkings').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-condominium-parking').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-condominium-parking').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o estacionamento.');
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
