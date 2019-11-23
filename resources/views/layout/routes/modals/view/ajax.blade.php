<script>
    $(function () {
        // visualizar
        $(document).on('click', '.btn-modal-view-route', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('route.view') ? route('route.view') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    // copia
                    $('#copy-route-view-route').text(
                        "Route::group(['prefix' => 'group'], function () {\n" +
                        "   Route::type('url', ['as' => 'route', 'uses' => 'controller']);\n" +
                        "});"
                    );
                    $('#copy-route-view-route').text($('#copy-route-view-route').text().replace('group', data.group).replace('type', data.type).replace('url', data.url).replace('route', data.route).replace('controller', data.controller));
                    // status
                    if (data.blocked || data.deleted_at) {
                        $('#status-view-route').removeClass('d-none');

                        if (data.blocked) {
                            $('#status-view-route').addClass('text-warning').html('<i class="fas fa-ban"></i> bloqueada');
                        } else {
                            $('#status-view-route').addClass('text-danger').html('<i class="fas fa-ban"></i> deletada');
                        }
                    } else {
                        $('#status-view-route').addClass('d-none').html('');
                    }
                    // grupo
                    $('#group-view-route').html('\'' + data.group + '\'');
                    // tipo
                    $('#type-view-route').html(data.type);
                    // página
                    if (data.view === 1) {
                        $('#view-view-route').html('<i class="fas fa-desktop mr-3" data-toggle="tooltip" data-placement="top" title="página de visualização"></i>');
                    } else {
                        $('#view-view-route').html('');
                    }
                    // url
                    $('#url-view-route').html('\'' + data.url + '\'');
                    // rota
                    $('#route-view-route').html('\'' + data.route + '\'');
                    // controle
                    $('#controller-view-route').html('\'' + data.controller + '\'');
                    // descrição
                    if (data.description) {
                        $('#description-view-route').html('<div class="mt-4">' + data.description + '</div>');
                    } else {
                        $('#description-view-route').html('');
                    }
                    // criado
                    $('#created-at-view-route').html('criado em ' + timestamp_to_date_br(data.created_at) + ' - ' + moment(data.created_at, 'YYYY-MM-DD hh:mm').locale('pt-br').fromNow());
                    // atualizado
                    $('#updated-at-view-route').html('atualizado em ' + timestamp_to_date_br(data.updated_at));

                    $('#modal-view-route').modal('show');
                }
            });
        });
    });
</script>
