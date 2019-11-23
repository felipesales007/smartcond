<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-user').removeAttr('disabled', 'disabled').html('Recuperar usuário');
            $('#form-recover-user').trigger('reset');
        };

        // recuperar
        $(document).on('click', '.btn-modal-recover-user', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('user.recover') ? route('user.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-recover-user').val(data.id);
                    let name = first_word(data.name);
                    $('#name-confirmation-recover-user-text').html(name);
                    $('#name-recover-user').val(name);

                    $('#modal-recover-user').modal('show');
                }
            });
        });

        // recuperando
        $(document).on('click', '#btn-recover-user', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-user').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-user').serialize(),
                    url: '{{ app('router')->has('user.restore') ? route('user.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-recover-user').modal('hide');
                        $('#datatable-users-deleted').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-user').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-user').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o usuário.');
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
