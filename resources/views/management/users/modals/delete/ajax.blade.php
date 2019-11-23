<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-user').removeAttr('disabled', 'disabled').html('Excluir usuário');
            $('#form-delete-user').trigger('reset');
        };

        // deletar
        $(document).on('click', '.btn-modal-delete-user', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('user.delete') ? route('user.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-delete-user').val(data.id);
                    let name = first_word(data.name);
                    $('#name-confirmation-delete-user-text').html(name);
                    $('#name-delete-user').val(name);

                    $('#modal-delete-user').modal('show');
                }
            });
        });

        // deletando
        $(document).on('click', '#btn-delete-user', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-user').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-user').serialize(),
                    url: '{{ app('router')->has('user.destroy') ? route('user.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-delete-user').modal('hide');
                        $('#datatable-users').DataTable().draw();
                        $('#datatable-users-entities').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-user').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-user').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o usuário.');
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
