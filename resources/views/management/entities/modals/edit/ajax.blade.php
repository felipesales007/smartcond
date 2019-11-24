<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-entity').removeAttr('disabled', 'disabled').html('Editar condomínio');
            $('#state-id-edit-entity').val('').trigger('change');
            $('#form-edit-entity').trigger('reset');
        };

        // editar
        $(document).on('click', '.btn-modal-edit-entity', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('entity.edit') ? route('entity.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    // logo
                    $('.fe-image-url-5').val(destination_url(data.id, 'png'));
                    if (data.logo) {
                        $('.fe-remove-preview-5').removeClass('fe-hidden');
                        $('.fe-img-preview-5').attr('src', '{{ url('storage/images/companies/logo') }}/' + data.logo);
                    } else {
                        $('.fe-remove-preview-5').addClass('fe-hidden');
                        $('.fe-img-preview-5').attr('src', '');
                    }
                    // dados
                    $('#id-edit-entity').val(data.id);
                    $('#cnpj-edit-entity').val(data.cnpj);
                    $('#name-edit-entity').val(data.name);
                    $('#corporate-name-edit-entity').val(data.corporate_name);
                    // responsável
                    $('#email-edit-entity').val(data.email);
                    $('#contact-edit-entity').val(data.contact);
                    // residenciais
                    $('#postal-code-edit-entity').val(data.postal_code);
                    $('#address-edit-entity').val(data.address);
                    $('#house-number-edit-entity').val(data.house_number);
                    $('#complement-edit-entity').val(data.complement);
                    $('#neighborhood-edit-entity').val(data.neighborhood);
                    $('#city-edit-entity').val(data.city);
                    $('#state-id-edit-entity').val(data.state_id).trigger('change');
                    $('#country-edit-entity').val(data.country);
                }

                $('#modal-edit-entity').modal('show');
            });
        });

        // editando
        $(document).on('click', '#btn-edit-entity', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-entity').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: new FormData($('#form-edit-entity')[0]),
                    contentType: false,
                    processData: false,
                    url: '{{ app('router')->has('entity.update') ? route('entity.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-edit-entity').modal('hide');
                        $('#datatable-entities').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-entity').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-entity').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o condomínio.');
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
