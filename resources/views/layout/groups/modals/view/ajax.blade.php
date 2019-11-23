<script>
    $(function () {
        // visualizar
        $(document).on('click', '.btn-modal-view-group', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('group.view') ? route('group.view') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    // status
                    if (data.blocked || data.deleted_at) {
                        $('#status-view-group').removeClass('d-none');
                        $('#name-view-group').removeClass('mt--3').addClass('mt-3');

                        if (data.blocked) {
                            $('#status-view-group').addClass('text-warning').html('<i class="fas fa-ban"></i> bloqueado');
                        } else {
                            $('#status-view-group').addClass('text-danger').html('<i class="fas fa-ban"></i> deletado');
                        }
                    } else {
                        $('#status-view-group').addClass('d-none').html('');
                        $('#name-view-group').addClass('mt--3').removeClass('mt-3');
                    }
                    // nome
                    $('#name-view-group').html(data.name);
                    // nível
                    $('#user-level-view-group').html(data.user_level);
                    // descrição
                    if (data.description) {
                        $('#description-view-group').html('<div class="small mt-4">' + data.description + '</div>');
                    } else {
                        $('#description-view-group').html('');
                    }
                    // criado
                    $('#created-at-view-group').html('criado em ' + timestamp_to_date_br(data.created_at) + ' - ' + moment(data.created_at, 'YYYY-MM-DD hh:mm').locale('pt-br').fromNow());
                    // atualizado
                    $('#updated-at-view-group').html('atualizado em ' + timestamp_to_date_br(data.updated_at));

                    $('#modal-view-group').modal('show');
                }
            });
        });
    });
</script>
