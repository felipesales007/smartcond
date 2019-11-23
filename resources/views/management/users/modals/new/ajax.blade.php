<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-user').removeAttr('disabled', 'disabled').html('Criar usuário');
            $('#entity-id-new-user').val('').trigger('change');
            $('#form-new-user').trigger('reset');
        };

        // novo
        $(document).on('click', '.btn-modal-new-user', function (e) {
            e.preventDefault();
            available();
            $('#modal-new-user').modal('show');
        });

        // salvando
        $(document).on('click', '#btn-new-user', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-user').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-user').serialize(),
                    url: '{{ app('router')->has('user.store') ? route('user.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-new-user').modal('hide');
                        $('#datatable-users').DataTable().draw();
                        $('#datatable-users-entities').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-user').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-user').valid();
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
