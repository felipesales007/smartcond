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
                    $('#name-view-condominium-apartment').html('<i class="fas fa-building mr-2"></i>' + data.name);
                    // descrição
                    if (data.description) {
                        $('#description-view-condominium-apartment').html('<div class="small mt-4">' + data.description + '</div>');
                    } else {
                        $('#description-view-condominium-apartment').html('');
                    }
                    // estacionamento
                    if (data.parking.length > 1) {
                        $('#parking-text-view-condominium-apartment').html('estacionamentos');
                    } else {
                        $('#parking-text-view-condominium-apartment').html('estacionamento');
                    }
                    $('#scroll-parking-view-condominium-apartment').html('');
                    $.each(data.parking, function(index, value) {
                        let html = '';
                        html += '<span class="list-group-item fe-mouse">';
                        html += '<div class="row align-items-center my--2 mx--2">';
                        html += '<div class="col ml--2">';
                        html += '<div class="d-flex justify-content-between align-items-center">';
                        html += '<span class="text-sm mb-0">' + value.name + '</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</span>';

                        $('#scroll-parking-view-condominium-apartment').append(html);
                    });
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
