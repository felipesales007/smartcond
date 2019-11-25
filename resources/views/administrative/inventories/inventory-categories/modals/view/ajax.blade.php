<script>
    $(function () {
        // visualizar
        $(document).on('click', '.btn-modal-view-inventory-category', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('inventory.category.view') ? route('inventory.category.view') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    // status
                    if (data.blocked || data.deleted_at) {
                        $('#status-view-inventory-category').removeClass('d-none');
                        $('#name-view-inventory-category').removeClass('mt--3').addClass('mt-3');

                        if (data.blocked) {
                            $('#status-view-inventory-category').addClass('text-warning').html('<i class="fas fa-ban"></i> bloqueado');
                        } else {
                            $('#status-view-inventory-category').addClass('text-danger').html('<i class="fas fa-ban"></i> deletado');
                        }
                    } else {
                        $('#status-view-inventory-category').addClass('d-none').html('');
                        $('#name-view-inventory-category').addClass('mt--3').removeClass('mt-3');
                    }
                    // nome
                    $('#name-view-inventory-category').html(data.name);
                    // descrição
                    if (data.description) {
                        $('#description-view-inventory-category').html('<div class="small mt-4">' + data.description + '</div>');
                    } else {
                        $('#description-view-inventory-category').html('');
                    }
                    // criado
                    $('#created-at-view-inventory-category').html('criado em ' + timestamp_to_date_br(data.created_at) + ' - ' + moment(data.created_at, 'YYYY-MM-DD hh:mm').locale('pt-br').fromNow());
                    // atualizado
                    $('#updated-at-view-inventory-category').html('atualizado em ' + timestamp_to_date_br(data.updated_at));

                    $('#modal-view-inventory-category').modal('show');
                }
            });
        });
    });
</script>
