<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-company').removeAttr('disabled', 'disabled').html('Recuperar empresa');
            $('#form-recover-company').trigger('reset');
        };

        // recuperar
        $(document).on('click', '.btn-modal-recover-company', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('company.recover') ? route('company.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-recover-company').val(data.id);
                    $('#name-confirmation-recover-company-text').html(data.name);
                    $('#name-recover-company').val(data.name);

                    $('#modal-recover-company').modal('show');
                }
            });
        });

        // recuperando
        $(document).on('click', '#btn-recover-company', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-company').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-company').serialize(),
                    url: '{{ app('router')->has('company.restore') ? route('company.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-recover-company').modal('hide');
                        $('#datatable-companies-deleted').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-company').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-company').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar a empresa.');
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
