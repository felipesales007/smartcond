<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-menu-item').removeAttr('disabled', 'disabled').html('Editar item do menu');
            $('#menu-id-edit-menu-item').val('').trigger('change');
            $('#route-id-edit-menu-item').val('').trigger('change');
            $('#main-edit-menu-item').val('').removeAttr('checked', 'checked');
            $('#hidden-edit-menu-item').val('').removeAttr('checked', 'checked');
            $('#form-edit-menu-item').trigger('reset');
        };

        // editar
        $(document).on('click', '.btn-modal-edit-menu-item', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('menu.item.edit') ? route('menu.item.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-edit-menu-item').val(data.id);
                    $('#menu-id-edit-menu-item').val(data.menu_id).trigger('change');
                    $('#route-id-edit-menu-item').val(data.route_id).trigger('change');
                    $('#name-edit-menu-item').val(data.name);
                    $('#order-edit-menu-item').val(data.order);
                    if (data.main) {
                        $('#main-edit-menu-item').prop('checked', true).attr('checked', 'checked');
                    } else {
                        $('#main-edit-menu-item').prop('checked', false).removeAttr('checked', 'checked');
                    }
                    if (data.hidden) {
                        $('#hidden-edit-menu-item').prop('checked', true).attr('checked', 'checked');
                    } else {
                        $('#hidden-edit-menu-item').prop('checked', false).removeAttr('checked', 'checked');
                    }
                    $('#button-edit-menu-item').val(data.button);
                    $('#description-edit-menu-item').val(data.description);

                    $('#modal-edit-menu-item').modal('show');
                }
            });
        });

        // editando
        $(document).on('click', '#btn-edit-menu-item', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-menu-item').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-edit-menu-item').serialize(),
                    url: '{{ app('router')->has('menu.item.update') ? route('menu.item.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-edit-menu-item').modal('hide');
                        $('#datatable-menu-items').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-menu-item').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-menu-item').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o item do menu.');
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
