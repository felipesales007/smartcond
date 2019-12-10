<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-condominium-block').removeAttr('disabled', 'disabled').html('Criar bloco');
            $('#form-new-condominium-block').trigger('reset');
        };

        // novo
        $(document).on('click', '.btn-modal-new-condominium-block', function (e) {
            e.preventDefault();
            available();
            $('#modal-new-condominium-block').modal('show');
        });

        // salvando
        $(document).on('click', '#btn-new-condominium-block', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-condominium-block').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-condominium-block').serialize(),
                    url: '{{ app('router')->has('condominium.block.store') ? route('condominium.block.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-new-condominium-block').modal('hide');
                        $('#datatable-condominium-blocks').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-condominium-block').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-condominium-block').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo bloco.');
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
