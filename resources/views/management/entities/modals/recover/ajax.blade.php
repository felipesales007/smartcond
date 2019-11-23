<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-entity').removeAttr('disabled', 'disabled').html('Recuperar entidade');
            $('#form-recover-entity').trigger('reset');
        };

        // recuperar
        $(document).on('click', '.btn-modal-recover-entity', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('entity.recover') ? route('entity.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-recover-entity').val(data.id);
                    $('#name-confirmation-recover-entity-text').html(data.name);
                    $('#name-recover-entity').val(data.name);

                    $('#modal-recover-entity').modal('show');
                }
            });
        });

        // recuperando
        $(document).on('click', '#btn-recover-entity', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-entity').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-entity').serialize(),
                    url: '{{ app('router')->has('entity.restore') ? route('entity.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-recover-entity').modal('hide');
                        $('#datatable-entities-deleted').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-entity').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-entity').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar a entidade.');
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
