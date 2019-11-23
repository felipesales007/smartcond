<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-admin-company').removeAttr('disabled', 'disabled').html('Criar administrador');
            $('#form-new-admin-company').trigger('reset');
        };

        // novo
        $(document).on('click', '.btn-modal-new-admin-company', function (e) {
            e.preventDefault();
            available();

            if ($(this).data('logo')) {
                $('#logo-new-admin-company').removeClass('d-none').css('background-image', 'url({{ url('storage/images/companies/logo') }}/' + $(this).data('logo') + ')');
                $('#text-name-new-admin-company').addClass('ml-5');

                if ($(this).data('name').length > 30) {
                    $('#logo-new-admin-company').addClass('mt-3');
                } else {
                    $('#logo-new-admin-company').removeClass('mt-3');
                }
            } else {
                $('#logo-new-admin-company').addClass('d-none').css('background-image', '');
                $('#text-name-new-admin-company').removeClass('ml-5');
            }

            $('#text-name-new-admin-company').html($(this).data('name'));
            $('#id-company-new-admin-company').val($(this).data('id'));

            $('#modal-new-admin-company').modal('show');
        });

        // salvando
        $(document).on('click', '#btn-new-admin-company', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-admin-company').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-admin-company').serialize(),
                    url: '{{ app('router')->has('company.admin.store') ? route('company.admin.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-new-admin-company').modal('hide');
                        $('#datatable-admins-companies').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-admin-company').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-admin-company').valid();
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
