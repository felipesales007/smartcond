<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-inventory').removeAttr('disabled', 'disabled').html('Editar item');
            $('.fe-remove-preview-11').addClass('fe-hidden');
            $('.fe-img-preview-11').attr('src', '');
            $('#department-id-edit-inventory').val('').trigger('change');
            $('#inventory-category-id-edit-inventory').val('').trigger('change');
            $('#inventory-state-id-edit-inventory').val('1').trigger('change');
            $('#voltage-id-edit-inventory').val('1').trigger('change');
            $('#form-edit-inventory').trigger('reset');
        };

        // editar
        $(document).on('click', '.btn-modal-edit-inventory', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('inventory.edit') ? route('inventory.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    // imagem
                    $('.fe-image-url-11').val(destination_url(data.id, 'png'));
                    if (data.image) {
                        $('.fe-remove-preview-11').removeClass('fe-hidden');
                        $('.fe-img-preview-11').attr('src', '{{ url('storage/images/inventories/items') }}/' + data.image);
                    } else {
                        $('.fe-remove-preview-11').addClass('fe-hidden');
                        $('.fe-img-preview-11').attr('src', '');
                    }
                    // dados
                    $('#id-edit-inventory').val(data.id);
                    $('#department-id-edit-inventory').val(data.department_id).trigger('change');
                    $('#inventory-category-id-edit-inventory').val(data.inventory_category_id).trigger('change');
                    $('#inventory-state-id-edit-inventory').val(data.inventory_state_id).trigger('change');
                    $('#patrimonial-number-edit-inventory').val(data.patrimonial_number);
                    $('#name-edit-inventory').val(data.name);
                    $('#brand-edit-inventory').val(data.brand);
                    $('#model-edit-inventory').val(data.model);
                    $('#serial-number-edit-inventory').val(data.serial_number);
                    $('#invoice-edit-inventory').val(data.invoice);
                    $('#value-edit-inventory').val(to_real(data.value));
                    $('#voltage-id-edit-inventory').val(data.voltage_id).trigger('change');
                    $('#purchase-date-edit-inventory').datepicker('setDate', date_to_date_br(data.purchase_date));
                    $('#warranty-date-edit-inventory').datepicker('setDate', date_to_date_br(data.warranty_date));
                    $('#description-edit-inventory').val(data.description);
                }

                $('#modal-edit-inventory').modal('show');
            });
        });

        // editando
        $(document).on('click', '#btn-edit-inventory', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-inventory').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: new FormData($('#form-edit-inventory')[0]),
                    contentType: false,
                    processData: false,
                    url: '{{ app('router')->has('inventory.update') ? route('inventory.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-edit-inventory').modal('hide');
                        $('#datatable-inventories').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-inventory').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-inventory').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o item do inventário.');
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
