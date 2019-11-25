<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-inventory-category').removeAttr('disabled', 'disabled').html('Excluir categoria');
            $('#form-delete-inventory-category').trigger('reset');
        };

        // deletar
        $(document).on('click', '.btn-modal-delete-inventory-category', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('inventory.category.delete') ? route('inventory.category.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-delete-inventory-category').val(data.id);
                    $('#name-confirmation-delete-inventory-category-text').html(data.name);
                    $('#name-delete-inventory-category').val(data.name);

                    $('#modal-delete-inventory-category').modal('show');
                }
            });
        });

        // deletando
        $(document).on('click', '#btn-delete-inventory-category', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-inventory-category').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-inventory-category').serialize(),
                    url: '{{ app('router')->has('inventory.category.destroy') ? route('inventory.category.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-delete-inventory-category').modal('hide');
                        $('#datatable-inventory-categories').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-inventory-category').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-inventory-category').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o categoria.');
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
