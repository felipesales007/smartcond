<script>
    $(function () {
        // variável
        let databaseRoute = '#datatable-routes';

        // tabela de rotas
        let tableRoutes = $(databaseRoute).DataTable({
            language:    datatables_pt_br,
            dom:         datatables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableRoutes.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [0, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('route.list') ? route('route.list') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseRoute + '_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseRoute + ' th').on('click', databaseRoute + ' th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseRoute, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseRoute, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseRoute);
                    }
                }
            },
            columns: [
                { data: 'group',        name: 'group' },
                { data: 'url',          name: 'url' },
                { data: 'route',        name: 'route' },
                { data: 'controller',   name: 'controller' },
                { data: 'route_option', name: 'route_option' },
                { data: 'view',         name: 'view', className: 'text-center', searchable: false },
                { data: 'action',       name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableRoutes.draw();
        });

        // tabela de rotas deletadas
        let tableRoutesDeleted = $(databaseRoute + '-deleted').DataTable({
            language:    datatables_pt_br,
            dom:         datatables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableRoutesDeleted.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [0, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('route.list.deleted') ? route('route.list.deleted') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseRoute + '-deleted_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseRoute + '-deleted th').on('click', databaseRoute + '-deleted th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseRoute, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseRoute, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseRoute);
                    }
                }
            },
            columns: [
                { data: 'group',        name: 'group' },
                { data: 'url',          name: 'url' },
                { data: 'route',        name: 'route' },
                { data: 'controller',   name: 'controller' },
                { data: 'route_option', name: 'route_option' },
                { data: 'view',         name: 'view', className: 'text-center', searchable: false },
                { data: 'action',       name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableRoutesDeleted.draw();
        });

        // modal de nova rota disponível
        let newRouteAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-route').removeAttr('disabled', 'disabled').html('Criar rota');
            $('#group-id-new-route').val('').trigger('change');
            $('#route-option-id-new-route').val('').trigger('change');
            $('#view-new-route').val('').removeAttr('checked', 'checked');
            $('#form-new-route').trigger('reset');
        };

        // modal de editar rota disponível
        let editRouteAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-route').removeAttr('disabled', 'disabled').html('Editar rota');
            $('#group-id-edit-route').val('').trigger('change');
            $('#route-option-id-edit-route').val('').trigger('change');
            $('#view-edit-route').val('').removeAttr('checked', 'checked');
            $('#form-edit-route').trigger('reset');
        };

        // modal de bloquear rota disponível
        let blockRouteAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-route').removeAttr('disabled', 'disabled').html('Bloquear rota');
            $('#form-block-route').trigger('reset');
        };

        // modal de deletar rota disponível
        let deleteRouteAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-route').removeAttr('disabled', 'disabled').html('Excluir rota');
            $('#form-delete-route').trigger('reset');
        };

        // modal de recuperar rota disponível
        let recoverRouteAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-route').removeAttr('disabled', 'disabled').html('Recuperar rota');
            $('#form-recover-route').trigger('reset');
        };

        // visualizar rota
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

        // nova rota
        $(document).on('click', '.btn-modal-new-route', function (e) {
            e.preventDefault();
            newRouteAvailable();
            $('#modal-new-route').modal('show');
        });

        // salvando rota
        $(document).on('click', '#btn-new-route', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-route').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-route').serialize(),
                    url: '{{ app('router')->has('route.store') ? route('route.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        newRouteAvailable();
                        $('#modal-new-route').modal('hide');
                        tableRoutes.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-route').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-route').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar uma nova rota.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // editar rota
        $(document).on('click', '.btn-modal-edit-route', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('route.edit') ? route('route.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    editRouteAvailable();
                    $('#id-edit-route').val(data.id);
                    $('#group-id-edit-route').val(data.group_id).trigger('change');
                    $('#route-option-id-edit-route').val(data.route_option_id).trigger('change');
                    if (data.view) {
                        $('#view-edit-route').prop('checked', true).attr('checked', 'checked');
                    } else {
                        $('#view-edit-route').prop('checked', false).removeAttr('checked', 'checked');
                    }
                    $('#url-edit-route').val(data.url);
                    $('#route-edit-route').val(data.route);
                    $('#controller-edit-route').val(data.controller);
                    $('#description-edit-route').val(data.description);

                    $('#modal-edit-route').modal('show');
                }
            });
        });

        // editando rota
        $(document).on('click', '#btn-edit-route', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-route').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-edit-route').serialize(),
                    url: '{{ app('router')->has('route.update') ? route('route.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        editRouteAvailable();
                        $('#modal-edit-route').modal('hide');
                        tableRoutes.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-route').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-route').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar a rota.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // bloquear rota
        $(document).on('click', '.btn-modal-block-route', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('route.ban') ? route('route.ban') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    blockRouteAvailable();
                    $('#id-block-route').val(data.id);
                    if (data.blocked) {
                        $('#blocked-block-route').prop('checked', true).attr('checked', 'checked');
                        $('#btn-block-route').html('Bloquear rota');
                    } else {
                        $('#blocked-block-route').prop('checked', false).removeAttr('checked', 'checked');
                        $('#btn-block-route').html('Desbloquear rota');
                    }

                    $('#modal-block-route').modal('show');
                }
            });
        });

        // bloqueando rota
        $(document).on('click', '#btn-block-route', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-block-route').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-block-route').serialize(),
                    url: '{{ app('router')->has('route.block') ? route('route.block') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        blockRouteAvailable();
                        $('#modal-block-route').modal('hide');
                        tableRoutes.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-block-route').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-block-route').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao bloquear a rota.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // deletar rota
        $(document).on('click', '.btn-modal-delete-route', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('route.delete') ? route('route.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    deleteRouteAvailable();
                    $('#id-delete-route').val(data.id);
                    $('#route-confirmation-delete-route-text').html(data.route);
                    $('#route-delete-route').val(data.route);

                    $('#modal-delete-route').modal('show');
                }
            });
        });

        // deletando rota
        $(document).on('click', '#btn-delete-route', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-route').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-route').serialize(),
                    url: '{{ app('router')->has('route.destroy') ? route('route.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        deleteRouteAvailable();
                        $('#modal-delete-route').modal('hide');
                        tableRoutes.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-route').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-route').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar a rota.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // recuperar rota
        $(document).on('click', '.btn-modal-recover-route', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('route.recover') ? route('route.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    recoverRouteAvailable();
                    $('#id-recover-route').val(data.id);
                    $('#route-confirmation-recover-route-text').html(data.route);
                    $('#route-recover-route').val(data.route);

                    $('#modal-recover-route').modal('show');
                }
            });
        });

        // recuperando rota
        $(document).on('click', '#btn-recover-route', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-route').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-route').serialize(),
                    url: '{{ app('router')->has('route.restore') ? route('route.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        recoverRouteAvailable();
                        $('#modal-recover-route').modal('hide');
                        tableRoutesDeleted.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-route').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-route').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar a rota.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });
    });
</script>
