<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-route').removeAttr('disabled', 'disabled').html('Excluir rota');
            $('#form-delete-route').trigger('reset');
        };

        // deletar
        $(document).on('click', '.btn-modal-delete-route', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('route.delete') ? route('route.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-delete-route').val(data.id);
                    $('#route-confirmation-delete-route-text').html(data.route);
                    $('#route-delete-route').val(data.route);

                    $('#modal-delete-route').modal('show');
                }
            });
        });

        // deletando
        $(document).on('click', '#btn-delete-route', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-route').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-route').serialize(),
                    url: '{{ app('router')->has('route.destroy') ? route('route.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-delete-route').modal('hide');
                        $('#datatable-routes').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-route').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-route').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar a rota.');
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
