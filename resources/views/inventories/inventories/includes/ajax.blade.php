<script>
    $(function () {
        // tabela
        let databaseInventory = '#datatable-inventories';
        let tableInventories   = $(databaseInventory).DataTable({
            language:    dataTables_pt_br,
            dom:         dataTables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableInventories.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [0, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('inventory.list') ? route('inventory.list') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseInventory + '_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseInventory + ' th').on('click', databaseInventory + ' th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseInventory, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseInventory, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseInventory);
                    }
                }
            },
            columns: [
                { data: 'patrimonial_number', name: 'patrimonial_number' },
                { data: 'name',               name: 'name' },
                { data: 'action',             name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableInventories.draw();
        });

        // tabela
        let tableInventoriesDeleted = $(databaseInventory + '-deleted').DataTable({
            language:    dataTables_pt_br,
            dom:         dataTables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableInventoriesDeleted.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [0, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('inventory.list.deleted') ? route('inventory.list.deleted') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseInventory + '-deleted_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseInventory + '-deleted th').on('click', databaseInventory + '-deleted th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseInventory, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseInventory, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseInventory);
                    }
                }
            },
            columns: [
                { data: 'name',        name: 'name' },
                { data: 'description', name: 'description', orderable: false, searchable: false },
                { data: 'action',      name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableInventoriesDeleted.draw();
        });

        // modal de novo inventário disponível
        let newInventoryAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-inventory').removeAttr('disabled', 'disabled').html('Criar item');
            $('#department-id-new-inventory').val('').trigger('change');
            $('#inventory-category-id-new-inventory').val('').trigger('change');
            $('#inventory-state-id-new-inventory').val('1').trigger('change');
            $('#voltage-id-new-inventory').val('1').trigger('change');
            $('#form-new-inventory').trigger('reset');
        };

        // modal de editar inventário disponível
        let editInventoryAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-inventory').removeAttr('disabled', 'disabled').html('Editar inventário');
            $('#form-edit-inventory').trigger('reset');
        };

        // modal de bloquear inventário disponível
        let blockInventoryAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-inventory').removeAttr('disabled', 'disabled').html('Bloquear inventário');
            $('#form-block-inventory').trigger('reset');
        };

        // modal de deletar inventário disponível
        let deleteInventoryAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-inventory').removeAttr('disabled', 'disabled').html('Excluir inventário');
            $('#form-delete-inventory').trigger('reset');
        };

        // modal de recuperar inventário disponível
        let recoverInventoryAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-inventory').removeAttr('disabled', 'disabled').html('Recuperar inventário');
            $('#form-recover-inventory').trigger('reset');
        };

        // visualizar inventário
        $(document).on('click', '.btn-modal-view-inventory', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('inventory.view') ? route('inventory.view') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    // status
                    if (data.blocked || data.deleted_at) {
                        $('#status-view-inventory').removeClass('d-none');
                        $('#name-view-inventory').removeClass('mt--3').addClass('mt-3');

                        if (data.blocked) {
                            $('#status-view-inventory').addClass('text-warning').html('<i class="fas fa-ban"></i> bloqueado');
                        } else {
                            $('#status-view-inventory').addClass('text-danger').html('<i class="fas fa-ban"></i> deletado');
                        }
                    } else {
                        $('#status-view-inventory').addClass('d-none').html('');
                        $('#name-view-inventory').addClass('mt--3').removeClass('mt-3');
                    }
                    // nome
                    $('#name-view-inventory').html(data.name);
                    // descrição
                    if (data.description) {
                        $('#description-view-inventory').html('<div class="small mt-4">' + data.description + '</div>');
                    } else {
                        $('#description-view-inventory').html('');
                    }
                    // criado
                    $('#created-at-view-inventory').html('criado em ' + timestamp_to_date_br(data.created_at) + ' - ' + moment(data.created_at, 'YYYY-MM-DD hh:mm').locale('pt-br').fromNow());
                    // atualizado
                    $('#updated-at-view-inventory').html('atualizado em ' + timestamp_to_date_br(data.updated_at));

                    $('#modal-view-inventory').modal('show');
                }
            });
        });

        // novo inventário
        $(document).on('click', '.btn-modal-new-inventory', function (e) {
            e.preventDefault();
            newInventoryAvailable();
            $('#modal-new-inventory').modal('show');
        });

        // salvando inventário
        $(document).on('click', '#btn-new-inventory', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-inventory').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-inventory').serialize(),
                    url: '{{ app('router')->has('inventory.store') ? route('inventory.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        newInventoryAvailable();
                        $('#modal-new-inventory').modal('hide');
                        tableInventories.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-inventory').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-inventory').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo item do inventário.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });












        // editar inventário
        $(document).on('click', '.btn-modal-edit-inventory', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('inventory.edit') ? route('inventory.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    editInventoryAvailable();
                    // dados
                    $('#id-edit-inventory').val(data.id);
                    $('#name-edit-inventory').val(data.name);
                    $('#description-edit-inventory').val(data.description);
                }

                $('#modal-edit-inventory').modal('show');
            });
        });

        // editando inventário
        $(document).on('click', '#btn-edit-inventory', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-inventory').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-edit-inventory').serialize(),
                    url: '{{ app('router')->has('inventory.update') ? route('inventory.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        editInventoryAvailable();
                        $('#modal-edit-inventory').modal('hide');
                        tableInventories.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-inventory').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-inventory').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o inventário.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // bloquear inventário
        $(document).on('click', '.btn-modal-block-inventory', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('inventory.ban') ? route('inventory.ban') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    blockInventoryAvailable();
                    $('#id-block-inventory').val(data.id);
                    if (data.blocked) {
                        $('#blocked-block-inventory').prop('checked', true).attr('checked', 'checked');
                        $('#btn-block-inventory').html('Bloquear inventário');
                    } else {
                        $('#blocked-block-inventory').prop('checked', false).removeAttr('checked', 'checked');
                        $('#btn-block-inventory').html('Desbloquear inventário');
                    }

                    $('#modal-block-inventory').modal('show');
                }
            });
        });

        // bloqueando inventário
        $(document).on('click', '#btn-block-inventory', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-block-inventory').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-block-inventory').serialize(),
                    url: '{{ app('router')->has('inventory.block') ? route('inventory.block') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        blockInventoryAvailable();
                        $('#modal-block-inventory').modal('hide');
                        tableInventories.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-block-inventory').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-block-inventory').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao bloquear o inventário.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // deletar inventário
        $(document).on('click', '.btn-modal-delete-inventory', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('inventory.delete') ? route('inventory.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    deleteInventoryAvailable();
                    $('#id-delete-inventory').val(data.id);
                    $('#name-confirmation-delete-inventory-text').html(data.name);
                    $('#name-delete-inventory').val(data.name);

                    $('#modal-delete-inventory').modal('show');
                }
            });
        });

        // deletando inventário
        $(document).on('click', '#btn-delete-inventory', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-inventory').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-inventory').serialize(),
                    url: '{{ app('router')->has('inventory.destroy') ? route('inventory.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        deleteInventoryAvailable();
                        $('#modal-delete-inventory').modal('hide');
                        tableInventories.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-inventory').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-inventory').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o inventário.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // recuperar inventário
        $(document).on('click', '.btn-modal-recover-inventory', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('inventory.recover') ? route('inventory.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    recoverInventoryAvailable();
                    $('#id-recover-inventory').val(data.id);
                    $('#name-confirmation-recover-inventory-text').html(data.name);
                    $('#name-recover-inventory').val(data.name);

                    $('#modal-recover-inventory').modal('show');
                }
            });
        });

        // recuperando inventário
        $(document).on('click', '#btn-recover-inventory', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-inventory').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-inventory').serialize(),
                    url: '{{ app('router')->has('inventory.restore') ? route('inventory.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        recoverInventoryAvailable();
                        $('#modal-recover-inventory').modal('hide');
                        tableInventoriesDeleted.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-inventory').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-inventory').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o inventário.');
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
