<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-condominium-service').removeAttr('disabled', 'disabled').html('Excluir prestador de serviços');
            $('#form-delete-condominium-service').trigger('reset');
        };

        // deletar
        $(document).on('click', '.btn-modal-delete-condominium-service', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('condominium.service.delete') ? route('condominium.service.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-delete-condominium-service').val(data.id);
                    $('#name-confirmation-delete-condominium-service-text').html(data.name);
                    $('#name-delete-condominium-service').val(data.name);

                    $('#modal-delete-condominium-service').modal('show');
                }
            });
        });

        // deletando
        $(document).on('click', '#btn-delete-condominium-service', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-condominium-service').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-condominium-service').serialize(),
                    url: '{{ app('router')->has('condominium.service.destroy') ? route('condominium.service.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-delete-condominium-service').modal('hide');
                        $('#datatable-condominium-services').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-condominium-service').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-condominium-service').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o prestador de serviços.');
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
