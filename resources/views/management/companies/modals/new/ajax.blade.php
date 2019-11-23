<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-company').removeAttr('disabled', 'disabled').html('Criar empresa');
            $('.fe-remove-preview-6').addClass('fe-hidden');
            $('.fe-img-preview-6').attr('src', '');
            $('#state-id-new-company').val('').trigger('change');
            $('#form-new-company').trigger('reset');
        };

        // nova
        $(document).on('click', '.btn-modal-new-company', function (e) {
            e.preventDefault();
            available();
            $('#modal-new-company').modal('show');
        });

        // salvando
        $(document).on('click', '#btn-new-company', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-company').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: new FormData($('#form-new-company')[0]),
                    contentType: false,
                    processData: false,
                    url: '{{ app('router')->has('company.store') ? route('company.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-new-company').modal('hide');
                        $('#datatable-companies').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-company').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-company').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar uma nova empresa.');
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
