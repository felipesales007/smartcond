<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-condominium-apartment').removeAttr('disabled', 'disabled').html('Excluir apartamento');
            $('#form-delete-condominium-apartment').trigger('reset');
        };

        // deletar
        $(document).on('click', '.btn-modal-delete-condominium-apartment', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('condominium.apartment.delete') ? route('condominium.apartment.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-delete-condominium-apartment').val(data.id);
                    $('#name-confirmation-delete-condominium-apartment-text').html(data.name);
                    $('#name-delete-condominium-apartment').val(data.name);

                    $('#modal-delete-condominium-apartment').modal('show');
                }
            });
        });

        // deletando
        $(document).on('click', '#btn-delete-condominium-apartment', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-condominium-apartment').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-condominium-apartment').serialize(),
                    url: '{{ app('router')->has('condominium.apartment.destroy') ? route('condominium.apartment.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-delete-condominium-apartment').modal('hide');
                        $('#datatable-condominium-apartments').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-condominium-apartment').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-condominium-apartment').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o apartamento.');
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
