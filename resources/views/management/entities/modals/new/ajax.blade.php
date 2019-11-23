<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-entity').removeAttr('disabled', 'disabled').html('Criar entidade');
            $('.fe-remove-preview-4').addClass('fe-hidden');
            $('.fe-img-preview-4').attr('src', '');
            $('#state-id-new-entity').val('').trigger('change');
            $('#form-new-entity').trigger('reset');
        };

        // nova
        $(document).on('click', '.btn-modal-new-entity', function (e) {
            e.preventDefault();
            available();
            $('#modal-new-entity').modal('show');
        });

        // salvando
        $(document).on('click', '#btn-new-entity', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-entity').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: new FormData($('#form-new-entity')[0]),
                    contentType: false,
                    processData: false,
                    url: '{{ app('router')->has('entity.store') ? route('entity.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-new-entity').modal('hide');
                        $('#datatable-entities').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-entity').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-entity').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar uma nova entidade.');
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
