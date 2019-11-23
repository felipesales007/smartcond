<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-company').removeAttr('disabled', 'disabled').html('Excluir empresa');
            $('#form-delete-company').trigger('reset');
        };

        // deletar
        $(document).on('click', '.btn-modal-delete-company', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('company.delete') ? route('company.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-delete-company').val(data.id);
                    $('#name-confirmation-delete-company-text').html(data.name);
                    $('#name-delete-company').val(data.name);

                    $('#modal-delete-company').modal('show');
                }
            });
        });

        // deletando
        $(document).on('click', '#btn-delete-company', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-company').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-company').serialize(),
                    url: '{{ app('router')->has('company.destroy') ? route('company.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-delete-company').modal('hide');
                        $('#datatable-companies').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-company').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-company').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar a empresa.');
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
