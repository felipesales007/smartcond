<script>
    $(function () {
        // visualizar
        $(document).on('click', '.btn-modal-view-condominium-apartment', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('condominium.apartment.view') ? route('condominium.apartment.view') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    // status
                    if (data.deleted_at) {
                        $('#status-view-condominium-apartment').removeClass('d-none');
                        $('#status-view-condominium-apartment').addClass('text-danger').html('<i class="fas fa-ban"></i> deletado');
                    } else {
                        $('#status-view-condominium-apartment').addClass('d-none').html('');
                    }
                    // nome
                    $('#name-view-condominium-apartment').html(data.name);
                    // descrição
                    if (data.description) {
                        $('#description-view-condominium-apartment').html('<div class="small mt-4">' + data.description + '</div>');
                    } else {
                        $('#description-view-condominium-apartment').html('');
                    }
                    // criado
                    $('#created-at-view-condominium-apartment').html('criado em ' + timestamp_to_date_br(data.created_at) + ' - ' + moment(data.created_at, 'YYYY-MM-DD hh:mm').locale('pt-br').fromNow());
                    // atualizado
                    $('#updated-at-view-condominium-apartment').html('atualizado em ' + timestamp_to_date_br(data.updated_at));

                    $('#modal-view-condominium-apartment').modal('show');
                }
            });
        });
    });
</script>
