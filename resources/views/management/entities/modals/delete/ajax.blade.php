<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-entity').removeAttr('disabled', 'disabled').html('Excluir condomínio');
            $('#form-delete-entity').trigger('reset');
        };

        // deletar
        $(document).on('click', '.btn-modal-delete-entity', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('entity.delete') ? route('entity.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-delete-entity').val(data.id);
                    $('#name-confirmation-delete-entity-text').html(data.name);
                    $('#name-delete-entity').val(data.name);

                    $('#modal-delete-entity').modal('show');
                }
            });
        });

        // deletando
        $(document).on('click', '#btn-delete-entity', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-entity').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-entity').serialize(),
                    url: '{{ app('router')->has('entity.destroy') ? route('entity.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-delete-entity').modal('hide');
                        $('#datatable-entities').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-entity').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-entity').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o condomínio.');
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
