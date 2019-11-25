<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-inventory-category').removeAttr('disabled', 'disabled').html('Bloquear categoria');
            $('#form-block-inventory-category').trigger('reset');
        };

        // bloquear
        $(document).on('click', '.btn-modal-block-inventory-category', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('inventory.category.ban') ? route('inventory.category.ban') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-block-inventory-category').val(data.id);
                    if (data.blocked) {
                        $('#blocked-block-inventory-category').prop('checked', true).attr('checked', 'checked');
                        $('#btn-block-inventory-category').html('Bloquear categoria');
                    } else {
                        $('#blocked-block-inventory-category').prop('checked', false).removeAttr('checked', 'checked');
                        $('#btn-block-inventory-category').html('Desbloquear categoria');
                    }

                    $('#modal-block-inventory-category').modal('show');
                }
            });
        });

        // bloqueando
        $(document).on('click', '#btn-block-inventory-category', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-block-inventory-category').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-block-inventory-category').serialize(),
                    url: '{{ app('router')->has('inventory.category.block') ? route('inventory.category.block') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-block-inventory-category').modal('hide');
                        $('#datatable-inventory-categories').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-block-inventory-category').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-block-inventory-category').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao bloquear o categoria.');
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
