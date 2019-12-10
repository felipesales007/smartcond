<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-condominium-block').removeAttr('disabled', 'disabled').html('Editar bloco');
            $('#form-edit-condominium-block').trigger('reset');
        };

        // editar
        $(document).on('click', '.btn-modal-edit-condominium-block', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('condominium.block.edit') ? route('condominium.block.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    // dados
                    $('#id-edit-condominium-block').val(data.id);
                    $('#name-edit-condominium-block').val(data.name);
                    $('#description-edit-condominium-block').val(data.description);
                }

                $('#modal-edit-condominium-block').modal('show');
            });
        });

        // editando
        $(document).on('click', '#btn-edit-condominium-block', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-condominium-block').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-edit-condominium-block').serialize(),
                    url: '{{ app('router')->has('condominium.block.update') ? route('condominium.block.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-edit-condominium-block').modal('hide');
                        $('#datatable-condominium-blocks').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-condominium-block').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-condominium-block').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o bloco.');
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
