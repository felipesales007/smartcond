<script>
    $(function () {
        // variável
        let databaseMenuItem = '#datatable-menu-items';

        // tabela de itens do menu
        let tableMenuItems = $(databaseMenuItem).DataTable({
            language:    datatables_pt_br,
            dom:         datatables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableMenuItems.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [0, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('menu.item.list') ? route('menu.item.list') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseMenuItem + '_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseMenuItem + ' th').on('click', databaseMenuItem + ' th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseMenuItem, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseMenuItem, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseMenuItem);
                    }
                }
            },
            columns: [
                { data: 'name',   name: 'name' },
                { data: 'menu',   name: 'menu' },
                { data: 'group',  name: 'group' },
                { data: 'route',  name: 'route' },
                { data: 'button', name: 'button', className: 'text-center', searchable: false },
                { data: 'list',   name: 'list', className: 'text-center', searchable: false },
                { data: 'hidden', name: 'hidden', className: 'text-center', searchable: false },
                { data: 'action', name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableMenuItems.draw();
        });

        // tabela de itens do menu deletados
        let tableMenuItemsDeleted = $(databaseMenuItem + '-deleted').DataTable({
            language:    datatables_pt_br,
            dom:         datatables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableMenuItemsDeleted.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [0, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('menu.item.list.deleted') ? route('menu.item.list.deleted') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseMenuItem + '-deleted_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseMenuItem + '-deleted th').on('click', databaseMenuItem + '-deleted th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseMenuItem, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseMenuItem, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseMenuItem);
                    }
                }
            },
            columns: [
                { data: 'name',   name: 'name' },
                { data: 'menu',   name: 'menu' },
                { data: 'group',  name: 'group' },
                { data: 'route',  name: 'route' },
                { data: 'button', name: 'button', className: 'text-center', searchable: false },
                { data: 'list',   name: 'list', className: 'text-center', searchable: false },
                { data: 'hidden', name: 'hidden', className: 'text-center', searchable: false },
                { data: 'action', name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableMenuItemsDeleted.draw();
        });

        // modal de novo item do menu disponível
        let newMenuItemAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-menu-item').removeAttr('disabled', 'disabled').html('Criar item do menu');
            $('#menu-id-new-menu-item').val('').trigger('change');
            $('#route-id-new-menu-item').val('').trigger('change');
            $('#list-new-menu-item').val('').removeAttr('checked', 'checked');
            $('#hidden-new-menu-item').val('').removeAttr('checked', 'checked');
            $('#form-new-menu-item').trigger('reset');
        };

        // modal de editar item do menu disponível
        let editMenuItemAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-menu-item').removeAttr('disabled', 'disabled').html('Editar item do menu');
            $('#menu-id-edit-menu-item').val('').trigger('change');
            $('#route-id-edit-menu-item').val('').trigger('change');
            $('#list-edit-menu-item').val('').removeAttr('checked', 'checked');
            $('#hidden-edit-menu-item').val('').removeAttr('checked', 'checked');
            $('#form-edit-menu-item').trigger('reset');
        };

        // modal de bloquear item do menu disponível
        let blockMenuItemAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-menu-item').removeAttr('disabled', 'disabled').html('Bloquear item do menu');
            $('#form-block-menu-item').trigger('reset');
        };

        // modal de deletar item do menu disponível
        let deleteMenuItemAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-menu-item').removeAttr('disabled', 'disabled').html('Excluir item do menu');
            $('#form-delete-menu-item').trigger('reset');
        };

        // modal de recuperar item do menu disponível
        let recoverMenuItemAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-menu-item').removeAttr('disabled', 'disabled').html('Recuperar item do menu');
            $('#form-recover-menu-item').trigger('reset');
        };

        // visualizar itens do menu
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
                    // lista
                    if (data.list) {
                        $('#list-view-menu-item').html('<small><b>lista: </b>sim</small>');
                    } else {
                        $('#list-view-menu-item').html('<small><b>lista: </b>não</small>');
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

        // novo item do menu
        $(document).on('click', '.btn-modal-new-menu-item', function (e) {
            e.preventDefault();
            newMenuItemAvailable();
            $('#modal-new-menu-item').modal('show');
        });

        // salvando item do menu
        $(document).on('click', '#btn-new-menu-item', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-menu-item').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-menu-item').serialize(),
                    url: '{{ app('router')->has('menu.item.store') ? route('menu.item.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        newMenuItemAvailable();
                        $('#modal-new-menu-item').modal('hide');
                        tableMenuItems.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-menu-item').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-menu-item').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo item do menu.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // editar item do menu
        $(document).on('click', '.btn-modal-edit-menu-item', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('menu.item.edit') ? route('menu.item.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    editMenuItemAvailable();
                    $('#id-edit-menu-item').val(data.id);
                    $('#menu-id-edit-menu-item').val(data.menu_id).trigger('change');
                    $('#route-id-edit-menu-item').val(data.route_id).trigger('change');
                    $('#name-edit-menu-item').val(data.name);
                    $('#order-edit-menu-item').val(data.order);
                    if (data.list) {
                        $('#list-edit-menu-item').prop('checked', true).attr('checked', 'checked');
                    } else {
                        $('#list-edit-menu-item').prop('checked', false).removeAttr('checked', 'checked');
                    }
                    if (data.hidden) {
                        $('#hidden-edit-menu-item').prop('checked', true).attr('checked', 'checked');
                    } else {
                        $('#hidden-edit-menu-item').prop('checked', false).removeAttr('checked', 'checked');
                    }
                    $('#button-edit-menu-item').val(data.button);
                    $('#description-edit-menu-item').val(data.description);

                    $('#modal-edit-menu-item').modal('show');
                }
            });
        });

        // editando item do menu
        $(document).on('click', '#btn-edit-menu-item', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-menu-item').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-edit-menu-item').serialize(),
                    url: '{{ app('router')->has('menu.item.update') ? route('menu.item.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        editMenuItemAvailable();
                        $('#modal-edit-menu-item').modal('hide');
                        tableMenuItems.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-menu-item').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-menu-item').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o item do menu.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // bloquear item do menu
        $(document).on('click', '.btn-modal-block-menu-item', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('menu.item.ban') ? route('menu.item.ban') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    blockMenuItemAvailable();
                    $('#id-block-menu-item').val(data.id);
                    if (data.blocked) {
                        $('#blocked-block-menu-item').prop('checked', true).attr('checked', 'checked');
                        $('#btn-block-menu-item').html('Bloquear item do menu');
                    } else {
                        $('#blocked-block-menu-item').prop('checked', false).removeAttr('checked', 'checked');
                        $('#btn-block-menu-item').html('Desbloquear item do menu');
                    }

                    $('#modal-block-menu-item').modal('show');
                }
            });
        });

        // bloqueando item do menu
        $(document).on('click', '#btn-block-menu-item', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-block-menu-item').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-block-menu-item').serialize(),
                    url: '{{ app('router')->has('menu.item.block') ? route('menu.item.block') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        blockMenuItemAvailable();
                        $('#modal-block-menu-item').modal('hide');
                        tableMenuItems.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-block-menu-item').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-block-menu-item').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao bloquear o item do menu.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // deletar item do menu
        $(document).on('click', '.btn-modal-delete-menu-item', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('menu.item.delete') ? route('menu.item.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    deleteMenuItemAvailable();
                    $('#id-delete-menu-item').val(data.id);
                    $('#name-confirmation-delete-menu-item-text').html(data.name);
                    $('#name-delete-menu-item').val(data.name);

                    $('#modal-delete-menu-item').modal('show');
                }
            });
        });

        // deletando item do menu
        $(document).on('click', '#btn-delete-menu-item', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-menu-item').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-menu-item').serialize(),
                    url: '{{ app('router')->has('menu.item.destroy') ? route('menu.item.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        deleteMenuItemAvailable();
                        $('#modal-delete-menu-item').modal('hide');
                        tableMenuItems.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-menu-item').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-menu-item').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o item do menu.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // recuperar item do menu
        $(document).on('click', '.btn-modal-recover-menu-item', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('menu.item.recover') ? route('menu.item.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    recoverMenuItemAvailable();
                    $('#id-recover-menu-item').val(data.id);
                    $('#name-confirmation-recover-menu-item-text').html(data.name);
                    $('#name-recover-menu-item').val(data.name);

                    $('#modal-recover-menu-item').modal('show');
                }
            });
        });

        // recuperando item do menu
        $(document).on('click', '#btn-recover-menu-item', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-menu-item').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-menu-item').serialize(),
                    url: '{{ app('router')->has('menu.item.restore') ? route('menu.item.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        recoverMenuItemAvailable();
                        $('#modal-recover-menu-item').modal('hide');
                        tableMenuItemsDeleted.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-menu-item').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-menu-item').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o item do menu.');
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
