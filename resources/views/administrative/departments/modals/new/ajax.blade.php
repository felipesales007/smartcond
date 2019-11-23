<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-department').removeAttr('disabled', 'disabled').html('Criar departamento');
            $('#form-new-department').trigger('reset');
        };

        // novo
        $(document).on('click', '.btn-modal-new-department', function (e) {
            e.preventDefault();
            available();
            $('#modal-new-department').modal('show');
        });

        // salvando
        $(document).on('click', '#btn-new-department', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-department').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-department').serialize(),
                    url: '{{ app('router')->has('department.store') ? route('department.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-new-department').modal('hide');
                        $('#datatable-departments').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-department').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-department').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo departamento.');
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
