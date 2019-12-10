<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-condominium-block').removeAttr('disabled', 'disabled').html('Excluir bloco');
            $('#form-delete-condominium-block').trigger('reset');
        };

        // deletar
        $(document).on('click', '.btn-modal-delete-condominium-block', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('condominium.block.delete') ? route('condominium.block.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-delete-condominium-block').val(data.id);
                    $('#name-confirmation-delete-condominium-block-text').html(data.name);
                    $('#name-delete-condominium-block').val(data.name);

                    $('#modal-delete-condominium-block').modal('show');
                }
            });
        });

        // deletando
        $(document).on('click', '#btn-delete-condominium-block', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-condominium-block').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-condominium-block').serialize(),
                    url: '{{ app('router')->has('condominium.block.destroy') ? route('condominium.block.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-delete-condominium-block').modal('hide');
                        $('#datatable-condominium-blocks').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-condominium-block').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-condominium-block').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o bloco.');
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
