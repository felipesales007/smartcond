<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-group').removeAttr('disabled', 'disabled').html('Editar grupo');
            $('#user-level-id-edit-group').val('3').trigger('change');
            $('#form-edit-group').trigger('reset');
        };

        // editar
        $(document).on('click', '.btn-modal-edit-group', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('group.edit') ? route('group.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-edit-group').val(data.id);
                    $('#name-edit-group').val(data.name);
                    $('#user-level-id-edit-group').val(data.user_level_id).trigger('change');
                    $('#description-edit-group').val(data.description);

                    $('#modal-edit-group').modal('show');
                }
            });
        });

        // editando
        $(document).on('click', '#btn-edit-group', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-group').valid()) {
                loader(1);
                scrollTop();
                $.ajax({
                    data: $('#form-edit-group').serialize(),
                    url: '{{ app('router')->has('group.update') ? route('group.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-edit-group').modal('hide');
                        $('#datatable-groups').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-group').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-group').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o grupo.');
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
