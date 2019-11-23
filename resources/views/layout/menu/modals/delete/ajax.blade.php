<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-menu').removeAttr('disabled', 'disabled').html('Excluir menu');
            $('#form-delete-menu').trigger('reset');
        };

        // deletar
        $(document).on('click', '.btn-modal-delete-menu', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('menu.delete') ? route('menu.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-delete-menu').val(data.id);
                    $('#name-confirmation-delete-menu-text').html(data.name);
                    $('#name-delete-menu').val(data.name);

                    $('#modal-delete-menu').modal('show');
                }
            });
        });

        // deletando
        $(document).on('click', '#btn-delete-menu', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-menu').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-menu').serialize(),
                    url: '{{ app('router')->has('menu.destroy') ? route('menu.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-delete-menu').modal('hide');
                        $('#datatable-menu').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-menu').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-menu').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o menu.');
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
