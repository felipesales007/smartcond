<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-company').removeAttr('disabled', 'disabled').html('Editar empresa');
            $('#state-id-edit-company').val('').trigger('change');
            $('#form-edit-company').trigger('reset');
        };

        // editar
        $(document).on('click', '.btn-modal-edit-company', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('company.edit') ? route('company.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    // logo
                    $('.fe-image-url-7').val(destination_url(data.id, 'png'));
                    if (data.logo) {
                        $('.fe-remove-preview-7').removeClass('fe-hidden');
                        $('.fe-img-preview-7').attr('src', '{{ url('storage/images/companies/logo') }}/' + data.logo);
                    } else {
                        $('.fe-remove-preview-7').addClass('fe-hidden');
                        $('.fe-img-preview-7').attr('src', '');
                    }
                    // dados
                    $('#id-edit-company').val(data.id);
                    $('#cnpj-edit-company').val(data.cnpj);
                    $('#name-edit-company').val(data.name);
                    $('#corporate-name-edit-company').val(data.corporate_name);
                    // responsável
                    $('#email-edit-company').val(data.email);
                    $('#contact-edit-company').val(data.contact);
                    // residenciais
                    $('#postal-code-edit-company').val(data.postal_code);
                    $('#address-edit-company').val(data.address);
                    $('#house-number-edit-company').val(data.house_number);
                    $('#complement-edit-company').val(data.complement);
                    $('#neighborhood-edit-company').val(data.neighborhood);
                    $('#city-edit-company').val(data.city);
                    $('#state-id-edit-company').val(data.state_id).trigger('change');
                    $('#country-edit-company').val(data.country);
                }

                $('#modal-edit-company').modal('show');
            });
        });

        // editando
        $(document).on('click', '#btn-edit-company', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-company').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: new FormData($('#form-edit-company')[0]),
                    contentType: false,
                    processData: false,
                    url: '{{ app('router')->has('company.update') ? route('company.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-edit-company').modal('hide');
                        $('#datatable-companies').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-company').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-company').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar a empresa.');
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
