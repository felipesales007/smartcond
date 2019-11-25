<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-inventory-category').removeAttr('disabled', 'disabled').html('Recuperar categoria');
            $('#form-recover-inventory-category').trigger('reset');
        };

        // recuperar
        $(document).on('click', '.btn-modal-recover-inventory-category', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('inventory.category.recover') ? route('inventory.category.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-recover-inventory-category').val(data.id);
                    $('#name-confirmation-recover-inventory-category-text').html(data.name);
                    $('#name-recover-inventory-category').val(data.name);

                    $('#modal-recover-inventory-category').modal('show');
                }
            });
        });

        // recuperando
        $(document).on('click', '#btn-recover-inventory-category', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-inventory-category').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-inventory-category').serialize(),
                    url: '{{ app('router')->has('inventory.category.restore') ? route('inventory.category.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-recover-inventory-category').modal('hide');
                        $('#datatable-inventory-categories-deleted').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-inventory-category').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-inventory-category').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o categoria.');
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
