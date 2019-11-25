<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-inventory').removeAttr('disabled', 'disabled').html('Excluir inventário');
            $('#form-delete-inventory').trigger('reset');
        };

        // deletar
        $(document).on('click', '.btn-modal-delete-inventory', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('inventory.delete') ? route('inventory.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-delete-inventory').val(data.id);
                    $('#name-confirmation-delete-inventory-text').html(data.name);
                    $('#name-delete-inventory').val(data.name);

                    $('#modal-delete-inventory').modal('show');
                }
            });
        });

        // deletando
        $(document).on('click', '#btn-delete-inventory', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-inventory').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-inventory').serialize(),
                    url: '{{ app('router')->has('inventory.destroy') ? route('inventory.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-delete-inventory').modal('hide');
                        $('#datatable-inventories').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-inventory').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-inventory').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o item do inventário.');
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
