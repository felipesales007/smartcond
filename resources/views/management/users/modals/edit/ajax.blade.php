<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-user').removeAttr('disabled', 'disabled').html('Editar usuário');
            $('#entity-id-edit-user').val('').trigger('change');
            $('#gender-id-edit-user').val('').trigger('change');
            $('#state-id-edit-user').val('').trigger('change');
            $('#birthday-edit-user').val('').datepicker('update');
            $('#form-edit-user .card-header').attr('aria-expanded', false);
            $('#form-edit-user .collapse').removeClass('show');
            $('#form-edit-user').trigger('reset');
        };

        // editar
        $(document).on('click', '.btn-modal-edit-user', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('user.edit') ? route('user.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    // edição comum
                    $('#id-edit-user').val(data.id);
                    $('#name-edit-user').val(data.name);
                    $('#email-edit-user').val(data.email);
                    $("#entity-id-edit-user").select2().val(data.entity_id).trigger('change');
                    // acessar permissões
                    $('#link-permission-edit-user').attr('href', '{{ app('router')->has('permission.user.edit') ? route('permission.user.edit') : '' }}?id=' + data.id);
                    // imagens
                    $('.fe-image-url-2').val(destination_url(data.id, 'png'));
                    if (data.photo) {
                        $('.fe-remove-preview-2').removeClass('fe-hidden');
                        $('.fe-img-preview-2').attr('src', '{{ url('storage/images/users/photo') }}/' + data.photo);
                    } else {
                        $('.fe-remove-preview-2').addClass('fe-hidden');
                        $('.fe-img-preview-2').attr('src', '');
                    }
                    $('.fe-image-url-3').val(destination_url(data.id, 'png'));
                    if (data.background) {
                        $('.fe-remove-preview-3').removeClass('fe-hidden');
                        $('.fe-img-preview-3').attr('src', '{{ url('storage/images/users/background') }}/' + data.background);
                    } else {
                        $('.fe-remove-preview-3').addClass('fe-hidden');
                        $('.fe-img-preview-3').attr('src', '');
                    }
                    // informações do usuário
                    $('#cpf-edit-user').val(data.cpf);
                    $('#rg-edit-user').val(data.rg);
                    if (data.birthday) {
                        $('#birthday-edit-user').datepicker('setDate', date_to_date_br(data.birthday));
                    }
                    $('#contact-edit-user').val(data.contact);
                    $('#gender-id-edit-user').val(data.gender_id).trigger('change');
                    $('#description-edit-user').val(data.description);
                    // informações acadêmicas
                    $('#course-edit-user').val(data.course);
                    $('#college-edit-user').val(data.college);
                    // informações profissionais
                    $('#profession-edit-user').val(data.profession);
                    $('#company-edit-user').val(data.company);
                    // informações residenciais
                    $('#postal-code-edit-user').val(data.postal_code);
                    $('#address-edit-user').val(data.address);
                    $('#house-number-edit-user').val(data.house_number);
                    $('#complement-edit-user').val(data.complement);
                    $('#neighborhood-edit-user').val(data.neighborhood);
                    $('#city-edit-user').val(data.city);
                    $('#state-id-edit-user').val(data.state_id).trigger('change');
                    $('#country-edit-user').val(data.country);

                    $('#modal-edit-user').modal('show');
                }
            });
        });

        // editando
        $(document).on('click', '#btn-edit-user', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-user').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: new FormData($('#form-edit-user')[0]),
                    contentType: false,
                    processData: false,
                    url: '{{ app('router')->has('user.update') ? route('user.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-edit-user').modal('hide');
                        $('#datatable-users').DataTable().draw();
                        $('#datatable-users-entities').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-user').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-user').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o usuário.');
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
