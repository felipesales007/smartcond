<script>
    $(function () {
        // visualizar
        $(document).on('click', '.btn-modal-view-condominium-parking', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('condominium.parking.view') ? route('condominium.parking.view') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    // status
                    if (data.deleted_at) {
                        $('#status-view-condominium-parking').removeClass('d-none');
                        $('#status-view-condominium-parking').addClass('text-danger').html('<i class="fas fa-ban"></i> deletado');
                    } else {
                        $('#status-view-condominium-parking').addClass('d-none').html('');
                    }
                    // nome
                    $('#name-view-condominium-parking').html('<i class="fas fa-car mr-2"></i>' + data.name);
                    // descrição
                    if (data.description) {
                        $('#description-view-condominium-parking').html('<div class="small mt-4">' + data.description + '</div>');
                    } else {
                        $('#description-view-condominium-parking').html('');
                    }
                    // criado
                    $('#created-at-view-condominium-parking').html('criado em ' + timestamp_to_date_br(data.created_at) + ' - ' + moment(data.created_at, 'YYYY-MM-DD hh:mm').locale('pt-br').fromNow());
                    // atualizado
                    $('#updated-at-view-condominium-parking').html('atualizado em ' + timestamp_to_date_br(data.updated_at));

                    $('#modal-view-condominium-parking').modal('show');
                }
            });
        });
    });
</script>
