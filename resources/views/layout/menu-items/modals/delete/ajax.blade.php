<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-menu-item').removeAttr('disabled', 'disabled').html('Excluir item do menu');
            $('#form-delete-menu-item').trigger('reset');
        };

        // deletar
        $(document).on('click', '.btn-modal-delete-menu-item', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('menu.item.delete') ? route('menu.item.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-delete-menu-item').val(data.id);
                    $('#name-confirmation-delete-menu-item-text').html(data.name);
                    $('#name-delete-menu-item').val(data.name);

                    $('#modal-delete-menu-item').modal('show');
                }
            });
        });

        // deletando
        $(document).on('click', '#btn-delete-menu-item', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-menu-item').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-menu-item').serialize(),
                    url: '{{ app('router')->has('menu.item.destroy') ? route('menu.item.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-delete-menu-item').modal('hide');
                        $('#datatable-menu-items').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-menu-item').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-menu-item').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o item do menu.');
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
