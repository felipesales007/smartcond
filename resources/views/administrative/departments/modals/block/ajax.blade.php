<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-department').removeAttr('disabled', 'disabled').html('Bloquear departamento');
            $('#form-block-department').trigger('reset');
        };

        // bloquear
        $(document).on('click', '.btn-modal-block-department', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('department.ban') ? route('department.ban') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    $('#id-block-department').val(data.id);
                    if (data.blocked) {
                        $('#blocked-block-department').prop('checked', true).attr('checked', 'checked');
                        $('#btn-block-department').html('Bloquear departamento');
                    } else {
                        $('#blocked-block-department').prop('checked', false).removeAttr('checked', 'checked');
                        $('#btn-block-department').html('Desbloquear departamento');
                    }

                    $('#modal-block-department').modal('show');
                }
            });
        });

        // bloqueando
        $(document).on('click', '#btn-block-department', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-block-department').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-block-department').serialize(),
                    url: '{{ app('router')->has('department.block') ? route('department.block') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-block-department').modal('hide');
                        $('#datatable-departments').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-block-department').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-block-department').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao bloquear o departamento.');
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
