<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-company').removeAttr('disabled', 'disabled').html('Bloquear empresa');
            $('#form-block-company').trigger('reset');
        };

        // bloquear
        $(document).on('click', '.btn-modal-block-company', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('company.ban') ? route('company.ban') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-block-company').val(data.id);
                    // checkbox
                    if (data.blocked) {
                        $('#blocked-block-company').prop('checked', true).attr('checked', 'checked');
                    } else {
                        $('#blocked-block-company').prop('checked', false).removeAttr('checked', 'checked');
                    }
                    // input
                    $('#blocked-at-block-company').datepicker('setDate', timestamp_to_date_br(data.blocked_at));
                    if (data.blocked_at >= moment().format('YYYY-MM-DD')) {
                        $('#blocked-at-block-company-text').html('Empresa <b class="text-warning">' + data.name + '</b> bloqueada até ' + timestamp_to_date_br(data.blocked_at));
                    } else {
                        $('#blocked-at-block-company-text').html('Bloquear <b class="text-warning">' + data.name + '</b> até uma data determinada');
                    }

                    $('#modal-block-company').modal('show');
                }
            });
        });

        // bloqueando
        $(document).on('click', '#btn-block-company', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-block-company').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-block-company').serialize(),
                    url: '{{ app('router')->has('company.block') ? route('company.block') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-block-company').modal('hide');
                        $('#datatable-companies').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-block-company').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-block-company').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao bloquear a empresa.');
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
