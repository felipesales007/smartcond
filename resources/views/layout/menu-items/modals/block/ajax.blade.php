<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-menu-item').removeAttr('disabled', 'disabled').html('Bloquear item do menu');
            $('#form-block-menu-item').trigger('reset');
        };

        // bloquear
        $(document).on('click', '.btn-modal-block-menu-item', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('menu.item.ban') ? route('menu.item.ban') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-block-menu-item').val(data.id);
                    if (data.blocked) {
                        $('#blocked-block-menu-item').prop('checked', true).attr('checked', 'checked');
                        $('#btn-block-menu-item').html('Bloquear item do menu');
                    } else {
                        $('#blocked-block-menu-item').prop('checked', false).removeAttr('checked', 'checked');
                        $('#btn-block-menu-item').html('Desbloquear item do menu');
                    }

                    $('#modal-block-menu-item').modal('show');
                }
            });
        });

        // bloqueando
        $(document).on('click', '#btn-block-menu-item', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-block-menu-item').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-block-menu-item').serialize(),
                    url: '{{ app('router')->has('menu.item.block') ? route('menu.item.block') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-block-menu-item').modal('hide');
                        $('#datatable-menu-items').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-block-menu-item').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-block-menu-item').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao bloquear o item do menu.');
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
