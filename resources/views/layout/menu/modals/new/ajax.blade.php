<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-menu').removeAttr('disabled', 'disabled').html('Criar menu');
            $('#menu-option-id-new-menu').val('').trigger('change');
            $('#color-id-new-menu').val('').trigger('change');
            $('#hidden-new-menu').val('').removeAttr('checked', 'checked');
            $('#form-new-menu').trigger('reset');
        };

        // novo
        $(document).on('click', '.btn-modal-new-menu', function (e) {
            e.preventDefault();
            available();
            $('#modal-new-menu').modal('show');
        });

        // salvando
        $(document).on('click', '#btn-new-menu', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-menu').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-menu').serialize(),
                    url: '{{ app('router')->has('menu.store') ? route('menu.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-new-menu').modal('hide');
                        $('#datatable-menu').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-menu').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-menu').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo menu.');
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
