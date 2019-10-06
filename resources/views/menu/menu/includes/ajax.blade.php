<script>
    $(function () {
        // tabela
        let databaseMenu = '#datatable-menu';
        let tableMenu    = $(databaseMenu).DataTable({
            language:    dataTables_pt_br,
            dom:         dataTables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableMenu.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [1, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('menu.list') ? route('menu.list') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseMenu + '_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseMenu + ' th').on('click', databaseMenu + ' th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseMenu, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseMenu, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseMenu);
                    }
                }
            },
            columns: [
                { data: 'icon',   name: 'icon', className: 'text-center fe-td-icon d-print-none', orderable: false, searchable: false },
                { data: 'name',   name: 'name' },
                { data: 'type',   name: 'type' },
                { data: 'hidden', name: 'hidden', className: 'text-center', searchable: false },
                { data: 'action', name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableMenu.draw();
        });

        // tabela
        let tableMenuDeleted = $(databaseMenu + '-deleted').DataTable({
            language:    dataTables_pt_br,
            dom:         dataTables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableMenuDeleted.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [1, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('menu.list.deleted') ? route('menu.list.deleted') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseMenu + '-deleted_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseMenu + '-deleted th').on('click', databaseMenu + '-deleted th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseMenu, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseMenu, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseMenu);
                    }
                }
            },
            columns: [
                { data: 'icon',   name: 'icon', className: 'text-center fe-td-icon d-print-none', orderable: false, searchable: false },
                { data: 'name',   name: 'name' },
                { data: 'type',   name: 'type' },
                { data: 'hidden', name: 'hidden', className: 'text-center', searchable: false },
                { data: 'action', name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableMenuDeleted.draw();
        });

        // modal de novo menu disponível
        let newMenuAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-menu').removeAttr('disabled', 'disabled').html('Criar menu');
            $('#menu-option-id-new-menu').val('').trigger('change');
            $('#color-id-new-menu').val('').trigger('change');
            $('#hidden-new-menu').val('').removeAttr('checked', 'checked');
            $('#form-new-menu').trigger('reset');
        };

        // modal de editar menu disponível
        let editMenuAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-menu').removeAttr('disabled', 'disabled').html('Editar menu');
            $('#menu-option-id-edit-menu').val('').trigger('change');
            $('#color-id-edit-menu').val('').trigger('change');
            $('#hidden-edit-menu').val('').removeAttr('checked', 'checked');
            $('#form-edit-menu').trigger('reset');
        };

        // modal de bloquear menu disponível
        let blockMenuAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-menu').removeAttr('disabled', 'disabled').html('Bloquear menu');
            $('#form-block-menu').trigger('reset');
        };

        // modal de deletar menu disponível
        let deleteMenuAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-menu').removeAttr('disabled', 'disabled').html('Excluir menu');
            $('#form-delete-menu').trigger('reset');
        };

        // modal de recuperar menu disponível
        let recoverMenuAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-menu').removeAttr('disabled', 'disabled').html('Recuperar menu');
            $('#form-recover-menu').trigger('reset');
        };

        // visualizar menu
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

        // novo menu
        $(document).on('click', '.btn-modal-new-menu', function (e) {
            e.preventDefault();
            newMenuAvailable();
            $('#modal-new-menu').modal('show');
        });

        // salvando menu
        $(document).on('click', '#btn-new-menu', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-menu').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-menu').serialize(),
                    url: '{{ app('router')->has('menu.store') ? route('menu.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        newMenuAvailable();
                        $('#modal-new-menu').modal('hide');
                        tableMenu.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-menu').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-menu').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo menu.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // editar menu
        $(document).on('click', '.btn-modal-edit-menu', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('menu.edit') ? route('menu.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    editMenuAvailable();
                    $('#id-edit-menu').val(data.id);
                    $('#group-id-edit-menu').val(data.group_id).trigger('change');
                    $('#menu-option-id-edit-menu').val(data.menu_option_id).trigger('change');
                    $('#name-edit-menu').val(data.name);
                    $('#icon-edit-menu').val(data.icon);
                    $('#color-id-edit-menu').val(data.color_id).trigger('change');
                    $('#order-edit-menu').val(data.order);
                    if (data.hidden) {
                        $('#hidden-edit-menu').prop('checked', true).attr('checked', 'checked');
                    } else {
                        $('#hidden-edit-menu').prop('checked', false).removeAttr('checked', 'checked');
                    }
                    $('#description-edit-menu').val(data.description);

                    $('#modal-edit-menu').modal('show');
                }
            });
        });

        // editando menu
        $(document).on('click', '#btn-edit-menu', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-menu').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-edit-menu').serialize(),
                    url: '{{ app('router')->has('menu.update') ? route('menu.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        editMenuAvailable();
                        $('#modal-edit-menu').modal('hide');
                        tableMenu.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-menu').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-menu').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o menu.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // bloquear menu
        $(document).on('click', '.btn-modal-block-menu', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('menu.ban') ? route('menu.ban') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    blockMenuAvailable();
                    $('#id-block-menu').val(data.id);
                    if (data.blocked) {
                        $('#blocked-block-menu').prop('checked', true).attr('checked', 'checked');
                        $('#btn-block-menu').html('Bloquear menu');
                    } else {
                        $('#blocked-block-menu').prop('checked', false).removeAttr('checked', 'checked');
                        $('#btn-block-menu').html('Desbloquear menu');
                    }

                    $('#modal-block-menu').modal('show');
                }
            });
        });

        // bloqueando menu
        $(document).on('click', '#btn-block-menu', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-block-menu').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-block-menu').serialize(),
                    url: '{{ app('router')->has('menu.block') ? route('menu.block') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        blockMenuAvailable();
                        $('#modal-block-menu').modal('hide');
                        tableMenu.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-block-menu').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-block-menu').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao bloquear o menu.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // deletar menu
        $(document).on('click', '.btn-modal-delete-menu', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('menu.delete') ? route('menu.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    deleteMenuAvailable();
                    $('#id-delete-menu').val(data.id);
                    $('#name-confirmation-delete-menu-text').html(data.name);
                    $('#name-delete-menu').val(data.name);

                    $('#modal-delete-menu').modal('show');
                }
            });
        });

        // deletando menu
        $(document).on('click', '#btn-delete-menu', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-menu').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-menu').serialize(),
                    url: '{{ app('router')->has('menu.destroy') ? route('menu.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        deleteMenuAvailable();
                        $('#modal-delete-menu').modal('hide');
                        tableMenu.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-menu').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-menu').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o menu.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // recuperar menu
        $(document).on('click', '.btn-modal-recover-menu', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('menu.recover') ? route('menu.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    recoverMenuAvailable();
                    $('#id-recover-menu').val(data.id);
                    $('#name-confirmation-recover-menu-text').html(data.name);
                    $('#name-recover-menu').val(data.name);

                    $('#modal-recover-menu').modal('show');
                }
            });
        });

        // recuperando menu
        $(document).on('click', '#btn-recover-menu', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-menu').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-menu').serialize(),
                    url: '{{ app('router')->has('menu.restore') ? route('menu.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        recoverMenuAvailable();
                        $('#modal-recover-menu').modal('hide');
                        tableMenuDeleted.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-menu').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-menu').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o menu.');
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
