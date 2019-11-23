<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-admin').removeAttr('disabled', 'disabled').html('Bloquear administrador');
            $('#form-block-admin').trigger('reset');
        };

        // bloquear
        $(document).on('click', '.btn-modal-block-admin', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('admin.ban') ? route('admin.ban') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-block-admin').val(data.id);
                    // checkbox
                    if (data.blocked) {
                        $('#blocked-block-admin').prop('checked', true).attr('checked', 'checked');
                    } else {
                        $('#blocked-block-admin').prop('checked', false).removeAttr('checked', 'checked');
                    }
                    // input
                    $('#blocked-at-block-admin').datepicker('setDate', timestamp_to_date_br(data.blocked_at));
                    let name = two_word(data.name);
                    if (data.blocked_at >= moment().format('YYYY-MM-DD')) {
                        $('#blocked-at-block-admin-text').html('Administrador <b class="text-warning">' + name + '</b> bloqueado até ' + timestamp_to_date_br(data.blocked_at));
                    } else {
                        $('#blocked-at-block-admin-text').html('Bloquear <b class="text-warning">' + name + '</b> até uma data determinada');
                    }

                    $('#modal-block-admin').modal('show');
                }
            });
        });

        // bloqueando
        $(document).on('click', '#btn-block-admin', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-block-admin').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-block-admin').serialize(),
                    url: '{{ app('router')->has('admin.block') ? route('admin.block') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-block-admin').modal('hide');
                        $('#datatable-admins').DataTable().draw();
                        $('#datatable-admins-companies').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-block-admin').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-block-admin').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao bloquear o administrador.');
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
