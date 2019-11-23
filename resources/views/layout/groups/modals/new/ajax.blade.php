<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-group').removeAttr('disabled', 'disabled').html('Criar grupo');
            $('#user-level-id-new-group').val('3').trigger('change');
            $('#form-new-group').trigger('reset');
        };

        // novo
        $(document).on('click', '.btn-modal-new-group', function (e) {
            e.preventDefault();
            available();
            $('#modal-new-group').modal('show');
        });

        // salvando
        $(document).on('click', '#btn-new-group', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-group').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-group').serialize(),
                    url: '{{ app('router')->has('group.store') ? route('group.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-new-group').modal('hide');
                        $('#datatable-groups').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-group').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-group').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo grupo.');
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
