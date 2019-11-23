<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-admin').removeAttr('disabled', 'disabled').html('Recuperar administrador');
            $('#form-recover-admin').trigger('reset');
        };

        // recuperar
        $(document).on('click', '.btn-modal-recover-admin', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('admin.recover') ? route('admin.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-recover-admin').val(data.id);
                    let name = first_word(data.name);
                    $('#name-confirmation-recover-admin-text').html(name);
                    $('#name-recover-admin').val(name);

                    $('#modal-recover-admin').modal('show');
                }
            });
        });

        // recuperando
        $(document).on('click', '#btn-recover-admin', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-admin').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-admin').serialize(),
                    url: '{{ app('router')->has('admin.restore') ? route('admin.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-recover-admin').modal('hide');
                        $('#datatable-admins').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-admin').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-admin').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o administrador.');
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
