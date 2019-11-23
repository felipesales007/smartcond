<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-route').removeAttr('disabled', 'disabled').html('Criar rota');
            $('#group-id-new-route').val('').trigger('change');
            $('#route-option-id-new-route').val('').trigger('change');
            $('#view-new-route').val('').removeAttr('checked', 'checked');
            $('#form-new-route').trigger('reset');
        };

        // nova
        $(document).on('click', '.btn-modal-new-route', function (e) {
            e.preventDefault();
            available();
            $('#modal-new-route').modal('show');
        });

        // salvando
        $(document).on('click', '#btn-new-route', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-route').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-route').serialize(),
                    url: '{{ app('router')->has('route.store') ? route('route.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-new-route').modal('hide');
                        $('#datatable-routes').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-route').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-route').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar uma nova rota.');
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
