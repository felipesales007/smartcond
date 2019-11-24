<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-entity').removeAttr('disabled', 'disabled').html('Bloquear condomínio');
            $('#form-block-entity').trigger('reset');
        };

        // bloquear
        $(document).on('click', '.btn-modal-block-entity', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('entity.ban') ? route('entity.ban') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-block-entity').val(data.id);
                    // checkbox
                    if (data.blocked) {
                        $('#blocked-block-entity').prop('checked', true).attr('checked', 'checked');
                    } else {
                        $('#blocked-block-entity').prop('checked', false).removeAttr('checked', 'checked');
                    }
                    // input
                    $('#blocked-at-block-entity').datepicker('setDate', timestamp_to_date_br(data.blocked_at));
                    if (data.blocked_at >= moment().format('YYYY-MM-DD')) {
                        $('#blocked-at-block-entity-text').html('Condomínio <b class="text-warning">' + data.name + '</b> bloqueado até ' + timestamp_to_date_br(data.blocked_at));
                    } else {
                        $('#blocked-at-block-entity-text').html('Bloquear <b class="text-warning">' + data.name + '</b> até uma data determinada');
                    }

                    $('#modal-block-entity').modal('show');
                }
            });
        });

        // bloqueando
        $(document).on('click', '#btn-block-entity', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-block-entity').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-block-entity').serialize(),
                    url: '{{ app('router')->has('entity.block') ? route('entity.block') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-block-entity').modal('hide');
                        $('#datatable-entities').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-block-entity').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-block-entity').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao bloquear o condomínio.');
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
