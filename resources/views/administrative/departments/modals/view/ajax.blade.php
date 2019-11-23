<script>
    $(function () {
        // visualizar
        $(document).on('click', '.btn-modal-view-department', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('department.view') ? route('department.view') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    // status
                    if (data.blocked || data.deleted_at) {
                        $('#status-view-department').removeClass('d-none');
                        $('#name-view-department').removeClass('mt--3').addClass('mt-3');

                        if (data.blocked) {
                            $('#status-view-department').addClass('text-warning').html('<i class="fas fa-ban"></i> bloqueado');
                        } else {
                            $('#status-view-department').addClass('text-danger').html('<i class="fas fa-ban"></i> deletado');
                        }
                    } else {
                        $('#status-view-department').addClass('d-none').html('');
                        $('#name-view-department').addClass('mt--3').removeClass('mt-3');
                    }
                    // nome
                    $('#name-view-department').html(data.name);
                    // descrição
                    if (data.description) {
                        $('#description-view-department').html('<div class="small mt-4">' + data.description + '</div>');
                    } else {
                        $('#description-view-department').html('');
                    }
                    // criado
                    $('#created-at-view-department').html('criado em ' + timestamp_to_date_br(data.created_at) + ' - ' + moment(data.created_at, 'YYYY-MM-DD hh:mm').locale('pt-br').fromNow());
                    // atualizado
                    $('#updated-at-view-department').html('atualizado em ' + timestamp_to_date_br(data.updated_at));

                    $('#modal-view-department').modal('show');
                }
            });
        });
    });
</script>
