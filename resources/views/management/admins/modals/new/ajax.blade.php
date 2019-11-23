<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-admin').removeAttr('disabled', 'disabled').html('Criar administrador');
            $('#company-id-new-admin').val('').trigger('change');
            $('#form-new-admin').trigger('reset');
        };

        // novo
        $(document).on('click', '.btn-modal-new-admin', function (e) {
            e.preventDefault();
            available();
            $('#modal-new-admin').modal('show');
        });

        // salvando
        $(document).on('click', '#btn-new-admin', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-admin').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-admin').serialize(),
                    url: '{{ app('router')->has('admin.store') ? route('admin.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-new-admin').modal('hide');
                        $('#datatable-admins').DataTable().draw();
                        $('#datatable-admins-companies').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-admin').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-admin').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo administrador.');
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
