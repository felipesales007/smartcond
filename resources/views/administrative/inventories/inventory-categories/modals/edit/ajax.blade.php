<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-inventory-category').removeAttr('disabled', 'disabled').html('Editar categoria');
            $('#form-edit-inventory-category').trigger('reset');
        };

        // editar
        $(document).on('click', '.btn-modal-edit-inventory-category', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('inventory.category.edit') ? route('inventory.category.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    // dados
                    $('#id-edit-inventory-category').val(data.id);
                    $('#name-edit-inventory-category').val(data.name);
                    $('#description-edit-inventory-category').val(data.description);
                }

                $('#modal-edit-inventory-category').modal('show');
            });
        });

        // editando
        $(document).on('click', '#btn-edit-inventory-category', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-inventory-category').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-edit-inventory-category').serialize(),
                    url: '{{ app('router')->has('inventory.category.update') ? route('inventory.category.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-edit-inventory-category').modal('hide');
                        $('#datatable-inventory-categories').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-inventory-category').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-inventory-category').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o categoria.');
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
