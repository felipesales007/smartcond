<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-route').removeAttr('disabled', 'disabled').html('Editar rota');
            $('#group-id-edit-route').val('').trigger('change');
            $('#route-option-id-edit-route').val('').trigger('change');
            $('#view-edit-route').val('').removeAttr('checked', 'checked');
            $('#form-edit-route').trigger('reset');
        };

        // editar
        $(document).on('click', '.btn-modal-edit-route', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('route.edit') ? route('route.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-edit-route').val(data.id);
                    $('#group-id-edit-route').val(data.group_id).trigger('change');
                    $('#route-option-id-edit-route').val(data.route_option_id).trigger('change');
                    if (data.view) {
                        $('#view-edit-route').prop('checked', true).attr('checked', 'checked');
                    } else {
                        $('#view-edit-route').prop('checked', false).removeAttr('checked', 'checked');
                    }
                    $('#url-edit-route').val(data.url);
                    $('#route-edit-route').val(data.route);
                    $('#controller-edit-route').val(data.controller);
                    $('#description-edit-route').val(data.description);

                    $('#modal-edit-route').modal('show');
                }
            });
        });

        // editando
        $(document).on('click', '#btn-edit-route', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-route').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-edit-route').serialize(),
                    url: '{{ app('router')->has('route.update') ? route('route.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-edit-route').modal('hide');
                        $('#datatable-routes').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-route').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-route').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar a rota.');
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
