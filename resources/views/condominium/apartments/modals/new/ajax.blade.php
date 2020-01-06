<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-condominium-apartment').removeAttr('disabled', 'disabled').html('Criar apartamento');
            $('#block-id-new-condominium-apartment').val('').trigger('change');
            $('#form-new-condominium-apartment').trigger('reset');
        };

        // novo
        $(document).on('click', '.btn-modal-new-condominium-apartment', function (e) {
            e.preventDefault();
            available();
            $('#modal-new-condominium-apartment').modal('show');
        });

        // salvando
        $(document).on('click', '#btn-new-condominium-apartment', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-condominium-apartment').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-condominium-apartment').serialize(),
                    url: '{{ app('router')->has('condominium.apartment.store') ? route('condominium.apartment.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-new-condominium-apartment').modal('hide');
                        $('#datatable-condominium-apartments').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-condominium-apartment').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-condominium-apartment').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo apartamento.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // bloco
        $('#block-id-new-condominium-apartment').select2({
            placeholder: 'Selecione',
            language: 'pt-BR',
            minimumResultsForSearch: -1
        }).on('select2:select', function () {
            if ($('#name-new-condominium-apartment').val() !== '') {
                $('#name-new-condominium-apartment').valid();
            }
        });
    });
</script>
