<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-department').removeAttr('disabled', 'disabled').html('Editar departamento');
            $('#form-edit-department').trigger('reset');
        };

        // editar
        $(document).on('click', '.btn-modal-edit-department', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('department.edit') ? route('department.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    // dados
                    $('#id-edit-department').val(data.id);
                    $('#name-edit-department').val(data.name);
                    $('#description-edit-department').val(data.description);
                }

                $('#modal-edit-department').modal('show');
            });
        });

        // editando
        $(document).on('click', '#btn-edit-department', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-department').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-edit-department').serialize(),
                    url: '{{ app('router')->has('department.update') ? route('department.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-edit-department').modal('hide');
                        $('#datatable-departments').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-department').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-department').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o departamento.');
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
