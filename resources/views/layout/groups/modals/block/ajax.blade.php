<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-group').removeAttr('disabled', 'disabled').html('Bloquear grupo');
            $('#form-block-group').trigger('reset');
        };

        // bloquear
        $(document).on('click', '.btn-modal-block-group', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('group.ban') ? route('group.ban') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-block-group').val(data.id);
                    if (data.blocked) {
                        $('#blocked-block-group').prop('checked', true).attr('checked', 'checked');
                        $('#btn-block-group').html('Bloquear grupo');
                    } else {
                        $('#blocked-block-group').prop('checked', false).removeAttr('checked', 'checked');
                        $('#btn-block-group').html('Desbloquear grupo');
                    }

                    $('#modal-block-group').modal('show');
                }
            });
        });

        // bloqueando
        $(document).on('click', '#btn-block-group', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-block-group').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-block-group').serialize(),
                    url: '{{ app('router')->has('group.block') ? route('group.block') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-block-group').modal('hide');
                        $('#datatable-groups').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-block-group').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-block-group').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao bloquear o grupo.');
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
