<script>
    $(function () {
        // visualizar
        $(document).on('click', '.btn-modal-view-menu', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('menu.view') ? route('menu.view') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    // status
                    if (data.blocked || data.deleted_at) {
                        $('#status-view-menu').removeClass('d-none');

                        if (data.blocked) {
                            $('#status-view-menu').addClass('text-warning').html('<i class="fas fa-ban"></i> bloqueado');
                        } else {
                            $('#status-view-menu').addClass('text-danger').html('<i class="fas fa-ban"></i> deletado');
                        }
                    } else {
                        $('#status-view-menu').addClass('d-none').html('');
                    }
                    // visível ou não
                    if (data.hidden === 1) {
                        $('#hidden-view-menu').html('<i class="far fa-eye-slash mr-3" data-toggle="tooltip" data-placement="top" title="menu oculto no grupo ' + data.group + '"></i>');
                    } else {
                        $('#hidden-view-menu').html('<i class="far fa-eye mr-3" data-toggle="tooltip" data-placement="top" title="menu visível e acessível no grupo ' + data.group + '"></i>');
                    }
                    // nome
                    $('#name-view-menu').html('<i class="' + data.icon + ' ' + data.color + ' mr-2"></i>' + data.name);
                    // tipo
                    if (data.type_description) {
                        $('#type-view-menu').html('<small><b>tipo: </b><span data-toggle="tooltip" data-placement="top" title="' + data.type_description + '">' + data.type + '</span></small>');
                    } else {
                        $('#type-view-menu').html('<small><b>tipo: </b>' + data.type + '</small>');
                    }
                    // cor
                    $('#color-view-menu').html('<small><b>cor: </b>' + data.color_name + '</small>');
                    // icone
                    $('#icon-view-menu').html('<small><b>ícone: </b>' + data.icon + '</small>');
                    // ordem
                    $('#order-view-menu').html('<small><b>ordem: </b>' + data.order + '</small>');
                    // descrição
                    if (data.description) {
                        $('#description-view-menu').html('<div class="mt-4"><small>' + data.description + '</small></div>');
                    } else {
                        $('#description-view-menu').html('');
                    }
                    // criado
                    $('#created-at-view-menu').html('criado em ' + timestamp_to_date_br(data.created_at) + ' - ' + moment(data.created_at, 'YYYY-MM-DD hh:mm').locale('pt-br').fromNow());
                    // atualizado
                    $('#updated-at-view-menu').html('atualizado em ' + timestamp_to_date_br(data.updated_at));

                    $('#modal-view-menu').modal('show');
                }
            });
        });
    });
</script>
