<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-condominium-apartment').removeAttr('disabled', 'disabled').html('Editar apartamento');
            $('#block-id-edit-condominium-apartment').val('').trigger('change');
            $('#parking-id-edit-condominium-apartment').val('').trigger('change');
            $('#form-edit-condominium-apartment').trigger('reset');
        };

        // editar
        $(document).on('click', '.btn-modal-edit-condominium-apartment', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('condominium.apartment.edit') ? route('condominium.apartment.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    // dados
                    $('#id-edit-condominium-apartment').val(data.id);
                    $('#block-id-edit-condominium-apartment').val(data.block_id).trigger('change');
                    $('#parking-id-edit-condominium-apartment').val(data.parking_id).trigger('change');
                    $('#name-edit-condominium-apartment').val(data.name);
                    $('#description-edit-condominium-apartment').val(data.description);
                }

                $('#modal-edit-condominium-apartment').modal('show');
            });
        });

        // editando
        $(document).on('click', '#btn-edit-condominium-apartment', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-condominium-apartment').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-edit-condominium-apartment').serialize(),
                    url: '{{ app('router')->has('condominium.apartment.update') ? route('condominium.apartment.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-edit-condominium-apartment').modal('hide');
                        $('#datatable-condominium-apartments').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-condominium-apartment').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-condominium-apartment').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o apartamento.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // bloco
        $('#block-id-edit-condominium-apartment').select2({
            placeholder: 'Selecione',
            language: 'pt-BR',
            minimumResultsForSearch: -1
        }).on('select2:select', function () {
            if ($('#name-edit-condominium-apartment').val() !== '') {
                $('#name-edit-condominium-apartment').valid();
            }
        });
    });
</script>
