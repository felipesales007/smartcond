<script>
    $(function () {
        // visualizar
        $(document).on('click', '.btn-modal-view-menu-item', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('menu.item.view') ? route('menu.item.view') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    // copia
                    if (data.view) {
                        $('#view-view-item-menu').addClass('d-inline-flex').removeClass('fe-hidden mt--5');
                        $('#view-view-item-menu').parent().addClass('mb-4').removeClass('mb-2').removeClass('mb-3');
                        $('#link-view-tem-menu').prop('href', url_public(data.group + '/' + data.url));
                        $('#copy-url-view-menu-item').text(url_public(data.group + '/' + data.url));
                    } else {
                        $('#view-view-item-menu').addClass('fe-hidden');
                        $('#copy-url-view-menu-item').text('');
                    }
                    // status
                    if (data.blocked || data.deleted_at) {
                        $('#view-view-item-menu').addClass('d-inline-flex');
                        $('#status-view-menu-item').removeClass('d-none');

                        if (!data.view) {
                            $('#view-view-item-menu').parent().addClass('mb-3').removeClass('mb-2').removeClass('mb-4');
                        }

                        if (data.blocked) {
                            $('#status-view-menu-item').addClass('text-warning').html('<i class="fas fa-ban"></i> bloqueado');
                        } else {
                            $('#status-view-menu-item').addClass('text-danger').html('<i class="fas fa-ban"></i> deletado');
                        }
                    } else {
                        $('#status-view-menu-item').addClass('d-none').html('');

                        if (!data.view) {
                            $('#view-view-item-menu').addClass('mt--5').removeClass('d-inline-flex');
                            $('#view-view-item-menu').parent().addClass('mb-2').removeClass('mb-3').removeClass('mb-4');
                        }
                    }
                    // nome
                    $('#name-view-menu-item').html(data.name);
                    // menu
                    if (data.menu_description) {
                        $('#menu-view-menu-item').html('<small><b>menu: </b><span data-toggle="tooltip" data-placement="top" title="' + data.menu_description + '">' + data.menu + '</span></small>');
                    } else {
                        $('#menu-view-menu-item').html('<small><b>menu: </b>' + data.menu + '</small>');
                    }
                    // grupo
                    if (data.group_description) {
                        $('#group-view-menu-item').html('<small><b>grupo: </b><span data-toggle="tooltip" data-placement="top" title="' + data.group_description + '">' + data.group + '</span></small>');
                    } else {
                        $('#group-view-menu-item').html('<small><b>grupo: </b>' + data.group + '</small>');
                    }
                    // principal
                    if (data.main) {
                        $('#main-view-menu-item').html('<small><b>principal: </b>sim</small>');
                    } else {
                        $('#main-view-menu-item').html('<small><b>principal: </b>não</small>');
                    }
                    // oculto
                    if (data.hidden) {
                        $('#hidden-view-menu-item').html('<small><b>oculto: </b>sim</small>');
                    } else {
                        $('#hidden-view-menu-item').html('<small><b>oculto: </b>não</small>');
                    }
                    // ordem
                    $('#order-view-menu-item').html('<small><b>ordem: </b>' + data.order + '</small>');
                    // ordem
                    $('#route-view-menu-item').html('<small><b>rota: </b>' + data.route + '</small>');
                    // botão
                    if (data.button) {
                        $('#button-view-menu-item').html('<small><b>botão: </b>' + data.button + '</small>');
                    } else {
                        $('#button-view-menu-item').html(' ');
                    }
                    // descrição
                    if (data.description) {
                        $('#description-view-menu-item').html('<div class="mt-5"><small>' + data.description + '</small></div>');
                    } else {
                        $('#description-view-menu-item').html('<div class="mt-4"></div>');
                    }
                    // criado
                    $('#created-at-view-menu-item').html('criado em ' + timestamp_to_date_br(data.created_at) + ' - ' + moment(data.created_at, 'YYYY-MM-DD hh:mm').locale('pt-br').fromNow());
                    // atualizado
                    $('#updated-at-view-menu-item').html('atualizado em ' + timestamp_to_date_br(data.updated_at));

                    $('#modal-view-menu-item').modal('show');
                }
            });
        });
    });
</script>
