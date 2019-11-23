<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-department').removeAttr('disabled', 'disabled').html('Excluir departamento');
            $('#form-delete-department').trigger('reset');
        };

        // deletar
        $(document).on('click', '.btn-modal-delete-department', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('department.delete') ? route('department.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-delete-department').val(data.id);
                    $('#name-confirmation-delete-department-text').html(data.name);
                    $('#name-delete-department').val(data.name);

                    $('#modal-delete-department').modal('show');
                }
            });
        });

        // deletando
        $(document).on('click', '#btn-delete-department', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-department').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-department').serialize(),
                    url: '{{ app('router')->has('department.destroy') ? route('department.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-delete-department').modal('hide');
                        $('#datatable-departments').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-department').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-department').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o departamento.');
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
