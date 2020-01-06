<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-condominium-apartment').removeAttr('disabled', 'disabled').html('Recuperar apartamento');
            $('#form-recover-condominium-apartment').trigger('reset');
        };

        // recuperar
        $(document).on('click', '.btn-modal-recover-condominium-apartment', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('condominium.apartment.recover') ? route('condominium.apartment.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-recover-condominium-apartment').val(data.id);
                    $('#name-confirmation-recover-condominium-apartment-text').html(data.name);
                    $('#name-recover-condominium-apartment').val(data.name);

                    $('#modal-recover-condominium-apartment').modal('show');
                }
            });
        });

        // recuperando
        $(document).on('click', '#btn-recover-condominium-apartment', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-condominium-apartment').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-condominium-apartment').serialize(),
                    url: '{{ app('router')->has('condominium.apartment.restore') ? route('condominium.apartment.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-recover-condominium-apartment').modal('hide');
                        $('#datatable-condominium-apartments-deleted').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-condominium-apartment').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-condominium-apartment').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o apartamento.');
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
