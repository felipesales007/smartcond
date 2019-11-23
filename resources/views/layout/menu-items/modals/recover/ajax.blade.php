<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-menu-item').removeAttr('disabled', 'disabled').html('Recuperar item do menu');
            $('#form-recover-menu-item').trigger('reset');
        };

        // recuperar
        $(document).on('click', '.btn-modal-recover-menu-item', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('menu.item.recover') ? route('menu.item.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-recover-menu-item').val(data.id);
                    $('#name-confirmation-recover-menu-item-text').html(data.name);
                    $('#name-recover-menu-item').val(data.name);

                    $('#modal-recover-menu-item').modal('show');
                }
            });
        });

        // recuperando
        $(document).on('click', '#btn-recover-menu-item', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-menu-item').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-menu-item').serialize(),
                    url: '{{ app('router')->has('menu.item.restore') ? route('menu.item.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-recover-menu-item').modal('hide');
                        $('#datatable-menu-items-deleted').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-menu-item').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-menu-item').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o item do menu.');
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
