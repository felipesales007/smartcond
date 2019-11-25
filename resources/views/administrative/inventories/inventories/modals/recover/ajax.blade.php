<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-inventory').removeAttr('disabled', 'disabled').html('Recuperar inventário');
            $('#form-recover-inventory').trigger('reset');
        };

        // recuperar
        $(document).on('click', '.btn-modal-recover-inventory', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('inventory.recover') ? route('inventory.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-recover-inventory').val(data.id);
                    $('#name-confirmation-recover-inventory-text').html(data.name);
                    $('#name-recover-inventory').val(data.name);

                    $('#modal-recover-inventory').modal('show');
                }
            });
        });

        // recuperando
        $(document).on('click', '#btn-recover-inventory', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-inventory').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-inventory').serialize(),
                    url: '{{ app('router')->has('inventory.restore') ? route('inventory.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-recover-inventory').modal('hide');
                        $('#datatable-inventories-deleted').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-inventory').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-inventory').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o item do inventário.');
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
