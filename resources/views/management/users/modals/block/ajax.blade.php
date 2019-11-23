<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-user').removeAttr('disabled', 'disabled').html('Bloquear usuário');
            $('#form-block-user').trigger('reset');
        };

        // bloquear
        $(document).on('click', '.btn-modal-block-user', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('user.ban') ? route('user.ban') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-block-user').val(data.id);
                    // checkbox
                    if (data.blocked) {
                        $('#blocked-block-user').prop('checked', true).attr('checked', 'checked');
                    } else {
                        $('#blocked-block-user').prop('checked', false).removeAttr('checked', 'checked');
                    }
                    // input
                    $('#blocked-at-block-user').datepicker('setDate', timestamp_to_date_br(data.blocked_at));
                    let name = two_word(data.name);
                    if (data.blocked_at >= moment().format('YYYY-MM-DD')) {
                        $('#blocked-at-block-user-text').html('Usuário <b class="text-warning">' + name + '</b> bloqueado até ' + timestamp_to_date_br(data.blocked_at));
                    } else {
                        $('#blocked-at-block-user-text').html('Bloquear <b class="text-warning">' + name + '</b> até uma data determinada');
                    }

                    $('#modal-block-user').modal('show');
                }
            });
        });

        // bloqueando
        $(document).on('click', '#btn-block-user', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-block-user').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-block-user').serialize(),
                    url: '{{ app('router')->has('user.block') ? route('user.block') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-block-user').modal('hide');
                        $('#datatable-users').DataTable().draw();
                        $('#datatable-users-entities').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-block-user').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-block-user').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao bloquear o usuário.');
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
