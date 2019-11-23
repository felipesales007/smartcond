<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-menu').removeAttr('disabled', 'disabled').html('Recuperar menu');
            $('#form-recover-menu').trigger('reset');
        };

        // recuperar
        $(document).on('click', '.btn-modal-recover-menu', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('menu.recover') ? route('menu.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-recover-menu').val(data.id);
                    $('#name-confirmation-recover-menu-text').html(data.name);
                    $('#name-recover-menu').val(data.name);

                    $('#modal-recover-menu').modal('show');
                }
            });
        });

        // recuperando
        $(document).on('click', '#btn-recover-menu', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-menu').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-menu').serialize(),
                    url: '{{ app('router')->has('menu.restore') ? route('menu.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-recover-menu').modal('hide');
                        $('#datatable-menu-deleted').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-menu').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-menu').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o menu.');
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
