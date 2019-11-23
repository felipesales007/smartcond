<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-menu').removeAttr('disabled', 'disabled').html('Editar menu');
            $('#menu-option-id-edit-menu').val('').trigger('change');
            $('#color-id-edit-menu').val('').trigger('change');
            $('#hidden-edit-menu').val('').removeAttr('checked', 'checked');
            $('#form-edit-menu').trigger('reset');
        };

        // editar
        $(document).on('click', '.btn-modal-edit-menu', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('menu.edit') ? route('menu.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-edit-menu').val(data.id);
                    $('#group-id-edit-menu').val(data.group_id).trigger('change');
                    $('#menu-option-id-edit-menu').val(data.menu_option_id).trigger('change');
                    $('#name-edit-menu').val(data.name);
                    $('#icon-edit-menu').val(data.icon);
                    $('#color-id-edit-menu').val(data.color_id).trigger('change');
                    $('#order-edit-menu').val(data.order);
                    if (data.hidden) {
                        $('#hidden-edit-menu').prop('checked', true).attr('checked', 'checked');
                    } else {
                        $('#hidden-edit-menu').prop('checked', false).removeAttr('checked', 'checked');
                    }
                    $('#description-edit-menu').val(data.description);

                    $('#modal-edit-menu').modal('show');
                }
            });
        });

        // editando
        $(document).on('click', '#btn-edit-menu', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-menu').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-edit-menu').serialize(),
                    url: '{{ app('router')->has('menu.update') ? route('menu.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-edit-menu').modal('hide');
                        $('#datatable-menu').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-menu').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-menu').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o menu.');
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
