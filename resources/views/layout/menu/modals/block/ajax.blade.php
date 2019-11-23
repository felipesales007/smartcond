<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-menu').removeAttr('disabled', 'disabled').html('Bloquear menu');
            $('#form-block-menu').trigger('reset');
        };

        // bloquear
        $(document).on('click', '.btn-modal-block-menu', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('menu.ban') ? route('menu.ban') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-block-menu').val(data.id);
                    if (data.blocked) {
                        $('#blocked-block-menu').prop('checked', true).attr('checked', 'checked');
                        $('#btn-block-menu').html('Bloquear menu');
                    } else {
                        $('#blocked-block-menu').prop('checked', false).removeAttr('checked', 'checked');
                        $('#btn-block-menu').html('Desbloquear menu');
                    }

                    $('#modal-block-menu').modal('show');
                }
            });
        });

        // bloqueando
        $(document).on('click', '#btn-block-menu', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-block-menu').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-block-menu').serialize(),
                    url: '{{ app('router')->has('menu.block') ? route('menu.block') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-block-menu').modal('hide');
                        $('#datatable-menu').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-block-menu').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-block-menu').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao bloquear o menu.');
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
