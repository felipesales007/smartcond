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
                    if (data.deleted_at) {
                        $('#status-view-condominium-block').removeClass('d-none');
                        $('#status-view-condominium-block').addClass('text-danger').html('<i class="fas fa-ban"></i> deletado');
                    } else {
                        $('#status-view-condominium-block').addClass('d-none').html('');
                    }
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
