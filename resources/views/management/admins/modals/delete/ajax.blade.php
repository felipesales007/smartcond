<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-admin').removeAttr('disabled', 'disabled').html('Excluir administrador');
            $('#form-delete-admin').trigger('reset');
        };

        // deletar
        $(document).on('click', '.btn-modal-delete-admin', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('admin.delete') ? route('admin.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-delete-admin').val(data.id);
                    let name = first_word(data.name);
                    $('#name-confirmation-delete-admin-text').html(name);
                    $('#name-delete-admin').val(name);

                    $('#modal-delete-admin').modal('show');
                }
            });
        });

        // deletando
        $(document).on('click', '#btn-delete-admin', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-admin').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-admin').serialize(),
                    url: '{{ app('router')->has('admin.destroy') ? route('admin.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-delete-admin').modal('hide');
                        $('#datatable-admins').DataTable().draw();
                        $('#datatable-admins-companies').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-admin').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-admin').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o administrador.');
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
