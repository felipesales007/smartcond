<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-department').removeAttr('disabled', 'disabled').html('Recuperar departamento');
            $('#form-recover-department').trigger('reset');
        };

        // recuperar
        $(document).on('click', '.btn-modal-recover-department', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('department.recover') ? route('department.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-recover-department').val(data.id);
                    $('#name-confirmation-recover-department-text').html(data.name);
                    $('#name-recover-department').val(data.name);

                    $('#modal-recover-department').modal('show');
                }
            });
        });

        // recuperando
        $(document).on('click', '#btn-recover-department', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-department').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-department').serialize(),
                    url: '{{ app('router')->has('department.restore') ? route('department.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-recover-department').modal('hide');
                        $('#datatable-departments-deleted').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-department').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-department').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o departamento.');
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
