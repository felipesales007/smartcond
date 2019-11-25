<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-inventory-category').removeAttr('disabled', 'disabled').html('Criar categoria');
            $('#form-new-inventory-category').trigger('reset');
        };

        // nova
        $(document).on('click', '.btn-modal-new-inventory-category', function (e) {
            e.preventDefault();
            available();
            $('#modal-new-inventory-category').modal('show');
        });

        // salvando
        $(document).on('click', '#btn-new-inventory-category', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-inventory-category').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-inventory-category').serialize(),
                    url: '{{ app('router')->has('inventory.category.store') ? route('inventory.category.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-new-inventory-category').modal('hide');
                        $('#datatable-inventory-categories').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-inventory-category').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-inventory-category').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo categoria.');
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
