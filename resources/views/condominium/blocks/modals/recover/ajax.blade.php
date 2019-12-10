<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-condominium-block').removeAttr('disabled', 'disabled').html('Recuperar bloco');
            $('#form-recover-condominium-block').trigger('reset');
        };

        // recuperar
        $(document).on('click', '.btn-modal-recover-condominium-block', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('condominium.block.recover') ? route('condominium.block.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-recover-condominium-block').val(data.id);
                    $('#name-confirmation-recover-condominium-block-text').html(data.name);
                    $('#name-recover-condominium-block').val(data.name);

                    $('#modal-recover-condominium-block').modal('show');
                }
            });
        });

        // recuperando
        $(document).on('click', '#btn-recover-condominium-block', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-condominium-block').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-condominium-block').serialize(),
                    url: '{{ app('router')->has('condominium.block.restore') ? route('condominium.block.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-recover-condominium-block').modal('hide');
                        $('#datatable-condominium-blocks-deleted').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-condominium-block').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-condominium-block').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o bloco.');
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
