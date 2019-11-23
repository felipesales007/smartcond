<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-group').removeAttr('disabled', 'disabled').html('Excluir grupo');
            $('#form-delete-group').trigger('reset');
        };

        // deletar
        $(document).on('click', '.btn-modal-delete-group', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('group.delete') ? route('group.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-delete-group').val(data.id);
                    $('#name-confirmation-delete-group-text').html(data.name);
                    $('#name-delete-group').val(data.name);

                    $('#modal-delete-group').modal('show');
                }
            });
        });

        // deletando
        $(document).on('click', '#btn-delete-group', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-group').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-group').serialize(),
                    url: '{{ app('router')->has('group.destroy') ? route('group.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-delete-group').modal('hide');
                        $('#datatable-groups').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-group').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-group').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o grupo.');
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
