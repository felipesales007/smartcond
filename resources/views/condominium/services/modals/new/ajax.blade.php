<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-condominium-service').removeAttr('disabled', 'disabled').html('Criar prestador de serviços');
            $('#form-new-condominium-service').trigger('reset');
        };

        // novo
        $(document).on('click', '.btn-modal-new-condominium-service', function (e) {
            e.preventDefault();
            available();
            $('#modal-new-condominium-service').modal('show');
        });

        // salvando
        $(document).on('click', '#btn-new-condominium-service', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-condominium-service').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-condominium-service').serialize(),
                    url: '{{ app('router')->has('condominium.service.store') ? route('condominium.service.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-new-condominium-service').modal('hide');
                        $('#datatable-condominium-services').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-condominium-service').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-condominium-service').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo prestador de serviços.');
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
