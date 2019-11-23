<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-menu-item').removeAttr('disabled', 'disabled').html('Criar item do menu');
            $('#menu-id-new-menu-item').val('').trigger('change');
            $('#route-id-new-menu-item').val('').trigger('change');
            $('#main-new-menu-item').val('').removeAttr('checked', 'checked');
            $('#hidden-new-menu-item').val('').removeAttr('checked', 'checked');
            $('#form-new-menu-item').trigger('reset');
        };

        // novo
        $(document).on('click', '.btn-modal-new-menu-item', function (e) {
            e.preventDefault();
            available();
            $('#modal-new-menu-item').modal('show');
        });

        // salvando
        $(document).on('click', '#btn-new-menu-item', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-menu-item').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-menu-item').serialize(),
                    url: '{{ app('router')->has('menu.item.store') ? route('menu.item.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-new-menu-item').modal('hide');
                        $('#datatable-menu-items').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-menu-item').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-menu-item').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo item do menu.');
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
