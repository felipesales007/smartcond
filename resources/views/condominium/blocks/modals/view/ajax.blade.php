<script>
    $(function () {
        // visualizar
        $(document).on('click', '.btn-modal-view-condominium-block', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('condominium.block.view') ? route('condominium.block.view') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    // status
                    if (data.blocked || data.deleted_at) {
                        $('#status-view-condominium-block').removeClass('d-none');
                        $('#name-view-condominium-block').removeClass('mt--3').addClass('mt-3');

                        if (data.blocked) {
                            $('#status-view-condominium-block').addClass('text-warning').html('<i class="fas fa-ban"></i> bloqueado');
                        } else {
                            $('#status-view-condominium-block').addClass('text-danger').html('<i class="fas fa-ban"></i> deletado');
                        }
                    } else {
                        $('#status-view-condominium-block').addClass('d-none').html('');
                        $('#name-view-condominium-block').addClass('mt--3').removeClass('mt-3');
                    }
                    // código
                    $('#code-view-condominium-block').html('<i class="fas fa-tag mr-2"></i>' + zero_left(data.id, 2));
                    // nome
                    $('#name-view-condominium-block').html(data.name);
                    // descrição
                    if (data.description) {
                        $('#description-view-condominium-block').html('<div class="small mt-4">' + data.description + '</div>');
                    } else {
                        $('#description-view-condominium-block').html('');
                    }
                    // criado
                    $('#created-at-view-condominium-block').html('criado em ' + timestamp_to_date_br(data.created_at) + ' - ' + moment(data.created_at, 'YYYY-MM-DD hh:mm').locale('pt-br').fromNow());
                    // atualizado
                    $('#updated-at-view-condominium-block').html('atualizado em ' + timestamp_to_date_br(data.updated_at));

                    $('#modal-view-condominium-block').modal('show');
                }
            });
        });
    });
</script>
