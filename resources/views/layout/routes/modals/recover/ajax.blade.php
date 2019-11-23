<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-route').removeAttr('disabled', 'disabled').html('Recuperar rota');
            $('#form-recover-route').trigger('reset');
        };

        // recuperar
        $(document).on('click', '.btn-modal-recover-route', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('route.recover') ? route('route.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-recover-route').val(data.id);
                    $('#route-confirmation-recover-route-text').html(data.route);
                    $('#route-recover-route').val(data.route);

                    $('#modal-recover-route').modal('show');
                }
            });
        });

        // recuperando
        $(document).on('click', '#btn-recover-route', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-route').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-route').serialize(),
                    url: '{{ app('router')->has('route.restore') ? route('route.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-recover-route').modal('hide');
                        $('#datatable-routes-deleted').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-route').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-route').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar a rota.');
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
