<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-group').removeAttr('disabled', 'disabled').html('Recuperar grupo');
            $('#form-recover-group').trigger('reset');
        };

        // recuperar
        $(document).on('click', '.btn-modal-recover-group', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('group.recover') ? route('group.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-recover-group').val(data.id);
                    $('#name-confirmation-recover-group-text').html(data.name);
                    $('#name-recover-group').val(data.name);

                    $('#modal-recover-group').modal('show');
                }
            });
        });

        // recuperando
        $(document).on('click', '#btn-recover-group', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-group').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-group').serialize(),
                    url: '{{ app('router')->has('group.restore') ? route('group.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-recover-group').modal('hide');
                        $('#datatable-groups-deleted').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-group').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-group').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o grupo.');
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
