<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-user-entity').removeAttr('disabled', 'disabled').html('Criar usuário');
            $('#form-new-user-entity').trigger('reset');
        };

        // novo
        $(document).on('click', '.btn-modal-new-user-entity', function (e) {
            e.preventDefault();
            available();

            if ($(this).data('logo')) {
                $('#logo-new-user-entity').removeClass('d-none').css('background-image', 'url({{ url('storage/images/companies/logo') }}/' + $(this).data('logo') + ')');
                $('#text-name-new-user-entity').addClass('ml-5');

                if ($(this).data('name').length > 30) {
                    $('#logo-new-user-entity').addClass('mt-3');
                } else {
                    $('#logo-new-user-entity').removeClass('mt-3');
                }
            } else {
                $('#logo-new-user-entity').addClass('d-none').css('background-image', '');
                $('#text-name-new-user-entity').removeClass('ml-5');
            }

            $('#text-name-new-user-entity').html($(this).data('name'));
            $('#id-entity-new-user-entity').val($(this).data('id'));

            $('#modal-new-user-entity').modal('show');
        });

        // salvando
        $(document).on('click', '#btn-new-user-entity', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-user-entity').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-user-entity').serialize(),
                    url: '{{ app('router')->has('entity.user.store') ? route('entity.user.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-new-user-entity').modal('hide');
                        $('#datatable-users-entities').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-user-entity').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-user-entity').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo usuário.');
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
