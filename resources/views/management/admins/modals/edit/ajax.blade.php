<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-admin').removeAttr('disabled', 'disabled').html('Editar administrador');
            $('#company-id-edit-admin').val('').trigger('change');
            $('#gender-id-edit-admin').val('').trigger('change');
            $('#state-id-edit-admin').val('').trigger('change');
            $('#birthday-edit-admin').val('').datepicker('update');
            $('#form-edit-admin .card-header').attr('aria-expanded', false);
            $('#form-edit-admin .collapse').removeClass('show');
            $('#form-edit-admin').trigger('reset');
        };

        // editar
        $(document).on('click', '.btn-modal-edit-admin', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('admin.edit') ? route('admin.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    // edição comum
                    $('#id-edit-admin').val(data.id);
                    $('#name-edit-admin').val(data.name);
                    $('#email-edit-admin').val(data.email);
                    $("#company-id-edit-admin").val(data.company_id).trigger('change');
                    // acessar permissões
                    $('#link-permission-edit-admin').attr('href', '{{ app('router')->has('permission.user.edit') ? route('permission.user.edit') : '' }}?id=' + data.id);
                    // imagens
                    $('.fe-image-url-8').val(destination_url(data.id, 'png'));
                    if (data.photo) {
                        $('.fe-remove-preview-8').removeClass('fe-hidden');
                        $('.fe-img-preview-8').attr('src', '{{ url('storage/images/users/photo') }}/' + data.photo);
                    } else {
                        $('.fe-remove-preview-8').addClass('fe-hidden');
                        $('.fe-img-preview-8').attr('src', '');
                    }
                    $('.fe-image-url-9').val(destination_url(data.id, 'png'));
                    if (data.background) {
                        $('.fe-remove-preview-9').removeClass('fe-hidden');
                        $('.fe-img-preview-9').attr('src', '{{ url('storage/images/users/background') }}/' + data.background);
                    } else {
                        $('.fe-remove-preview-9').addClass('fe-hidden');
                        $('.fe-img-preview-9').attr('src', '');
                    }
                    // informações do administrador
                    $('#cpf-edit-admin').val(data.cpf);
                    $('#rg-edit-admin').val(data.rg);
                    if (data.birthday) {
                        $('#birthday-edit-admin').datepicker('setDate', date_to_date_br(data.birthday));
                    }
                    $('#contact-edit-admin').val(data.contact);
                    $('#gender-id-edit-admin').val(data.gender_id).trigger('change');
                    $('#description-edit-admin').val(data.description);
                    // informações acadêmicas
                    $('#course-edit-admin').val(data.course);
                    $('#college-edit-admin').val(data.college);
                    // informações profissionais
                    $('#profession-edit-admin').val(data.profession);
                    $('#company-edit-admin').val(data.company);
                    // informações residenciais
                    $('#postal-code-edit-admin').val(data.postal_code);
                    $('#address-edit-admin').val(data.address);
                    $('#house-number-edit-admin').val(data.house_number);
                    $('#complement-edit-admin').val(data.complement);
                    $('#neighborhood-edit-admin').val(data.neighborhood);
                    $('#city-edit-admin').val(data.city);
                    $('#state-id-edit-admin').val(data.state_id).trigger('change');
                    $('#country-edit-admin').val(data.country);

                    $('#modal-edit-admin').modal('show');
                }
            });
        });

        // editando
        $(document).on('click', '#btn-edit-admin', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-admin').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: new FormData($('#form-edit-admin')[0]),
                    contentType: false,
                    processData: false,
                    url: '{{ app('router')->has('admin.update') ? route('admin.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-edit-admin').modal('hide');
                        $('#datatable-admins').DataTable().draw();
                        $('#datatable-admins-companies').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-admin').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-admin').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o administrador.');
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
