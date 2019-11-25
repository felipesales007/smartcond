<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-inventory').removeAttr('disabled', 'disabled').html('Criar item');
            $('.fe-remove-preview-10').addClass('fe-hidden');
            $('.fe-img-preview-10').attr('src', '');
            $('#department-id-new-inventory').val('').trigger('change');
            $('#inventory-category-id-new-inventory').val('').trigger('change');
            $('#inventory-state-id-new-inventory').val('1').trigger('change');
            $('#voltage-id-new-inventory').val('1').trigger('change');
            $('#form-new-inventory').trigger('reset');
        };

        // modal outro disponível
        let availableOther = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-other-inventory').removeAttr('disabled', 'disabled').html('<i class="far fa-copy"></i>');
            $('#patrimonial-number-new-inventory').val('');
            $('#serial-number-new-inventory').val('');
        };

        // novo
        $(document).on('click', '.btn-modal-new-inventory', function (e) {
            e.preventDefault();
            available();
            $('#modal-new-inventory').modal('show');
        });

        // salvando
        $(document).on('click', '#btn-new-inventory', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-inventory').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: new FormData($('#form-new-inventory')[0]),
                    contentType: false,
                    processData: false,
                    url: '{{ app('router')->has('inventory.store') ? route('inventory.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        //$('#modal-new-inventory').modal('hide');
                        $('#datatable-inventories').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-inventory').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-inventory').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo item do inventário.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // salvando outro
        $(document).on('click', '#btn-new-other-inventory', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse"></i>');

            if ($('#form-new-inventory').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: new FormData($('#form-new-inventory')[0]),
                    contentType: false,
                    processData: false,
                    url: '{{ app('router')->has('inventory.store') ? route('inventory.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        availableOther();
                        $('#datatable-inventories').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-other-inventory').removeAttr('disabled', 'disabled').html('<i class="far fa-copy"></i>');
                        $('#form-new-inventory').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo item do inventário.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('<i class="far fa-copy"></i>');
                return false;
            }
        });
    });
</script>
