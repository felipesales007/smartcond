<script>
    $(function () {
        // tabela
        let databaseInventoryCategory = '#datatable-inventory-categories';
        let tableInventoryCategories  = $(databaseInventoryCategory).DataTable({
            language:    datatables_pt_br,
            dom:         datatables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableInventoryCategories.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [0, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('inventory.category.list') ? route('inventory.category.list') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseInventoryCategory + '_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseInventoryCategory + ' th').on('click', databaseInventoryCategory + ' th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseInventoryCategory, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseInventoryCategory, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseInventoryCategory);
                    }
                }
            },
            columns: [
                { data: 'name',        name: 'name' },
                { data: 'description', name: 'description', orderable: false, searchable: false },
                { data: 'action',      name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableInventoryCategories.draw();
        });

        // tabela
        let tableInventoryCategoriesDeleted = $(databaseInventoryCategory + '-deleted').DataTable({
            language:    datatables_pt_br,
            dom:         datatables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableInventoryCategoriesDeleted.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [0, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('inventory.category.list.deleted') ? route('inventory.category.list.deleted') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseInventoryCategory + '-deleted_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseInventoryCategory + '-deleted th').on('click', databaseInventoryCategory + '-deleted th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseInventoryCategory, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseInventoryCategory, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseInventoryCategory);
                    }
                }
            },
            columns: [
                { data: 'name',        name: 'name' },
                { data: 'description', name: 'description', orderable: false, searchable: false },
                { data: 'action',      name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableInventoryCategoriesDeleted.draw();
        });

        // modal de nova categoria disponível
        let newInventoryCategoryAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-inventory-category').removeAttr('disabled', 'disabled').html('Criar categoria');
            $('#form-new-inventory-category').trigger('reset');
        };

        // modal de editar categoria disponível
        let editInventoryCategoryAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-inventory-category').removeAttr('disabled', 'disabled').html('Editar categoria');
            $('#form-edit-inventory-category').trigger('reset');
        };

        // modal de bloquear categoria disponível
        let blockInventoryCategoryAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-inventory-category').removeAttr('disabled', 'disabled').html('Bloquear categoria');
            $('#form-block-inventory-category').trigger('reset');
        };

        // modal de deletar categoria disponível
        let deleteInventoryCategoryAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-inventory-category').removeAttr('disabled', 'disabled').html('Excluir categoria');
            $('#form-delete-inventory-category').trigger('reset');
        };

        // modal de recuperar categoria disponível
        let recoverInventoryCategoryAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-inventory-category').removeAttr('disabled', 'disabled').html('Recuperar categoria');
            $('#form-recover-inventory-category').trigger('reset');
        };

        // visualizar categoria
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

        // nova categoria
        $(document).on('click', '.btn-modal-new-inventory-category', function (e) {
            e.preventDefault();
            newInventoryCategoryAvailable();
            $('#modal-new-inventory-category').modal('show');
        });

        // salvando categoria
        $(document).on('click', '#btn-new-inventory-category', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-inventory-category').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-inventory-category').serialize(),
                    url: '{{ app('router')->has('inventory.category.store') ? route('inventory.category.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        newInventoryCategoryAvailable();
                        $('#modal-new-inventory-category').modal('hide');
                        tableInventoryCategories.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-inventory-category').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-inventory-category').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo categoria.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // editar categoria
        $(document).on('click', '.btn-modal-edit-inventory-category', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('inventory.category.edit') ? route('inventory.category.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    editInventoryCategoryAvailable();
                    // dados
                    $('#id-edit-inventory-category').val(data.id);
                    $('#name-edit-inventory-category').val(data.name);
                    $('#description-edit-inventory-category').val(data.description);
                }

                $('#modal-edit-inventory-category').modal('show');
            });
        });

        // editando categoria
        $(document).on('click', '#btn-edit-inventory-category', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-inventory-category').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-edit-inventory-category').serialize(),
                    url: '{{ app('router')->has('inventory.category.update') ? route('inventory.category.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        editInventoryCategoryAvailable();
                        $('#modal-edit-inventory-category').modal('hide');
                        tableInventoryCategories.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-inventory-category').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-inventory-category').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o categoria.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // bloquear categoria
        $(document).on('click', '.btn-modal-block-inventory-category', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('inventory.category.ban') ? route('inventory.category.ban') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    blockInventoryCategoryAvailable();
                    $('#id-block-inventory-category').val(data.id);
                    if (data.blocked) {
                        $('#blocked-block-inventory-category').prop('checked', true).attr('checked', 'checked');
                        $('#btn-block-inventory-category').html('Bloquear categoria');
                    } else {
                        $('#blocked-block-inventory-category').prop('checked', false).removeAttr('checked', 'checked');
                        $('#btn-block-inventory-category').html('Desbloquear categoria');
                    }

                    $('#modal-block-inventory-category').modal('show');
                }
            });
        });

        // bloqueando categoria
        $(document).on('click', '#btn-block-inventory-category', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-block-inventory-category').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-block-inventory-category').serialize(),
                    url: '{{ app('router')->has('inventory.category.block') ? route('inventory.category.block') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        blockInventoryCategoryAvailable();
                        $('#modal-block-inventory-category').modal('hide');
                        tableInventoryCategories.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-block-inventory-category').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-block-inventory-category').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao bloquear o categoria.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // deletar categoria
        $(document).on('click', '.btn-modal-delete-inventory-category', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('inventory.category.delete') ? route('inventory.category.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    deleteInventoryCategoryAvailable();
                    $('#id-delete-inventory-category').val(data.id);
                    $('#name-confirmation-delete-inventory-category-text').html(data.name);
                    $('#name-delete-inventory-category').val(data.name);

                    $('#modal-delete-inventory-category').modal('show');
                }
            });
        });

        // deletando categoria
        $(document).on('click', '#btn-delete-inventory-category', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-inventory-category').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-inventory-category').serialize(),
                    url: '{{ app('router')->has('inventory.category.destroy') ? route('inventory.category.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        deleteInventoryCategoryAvailable();
                        $('#modal-delete-inventory-category').modal('hide');
                        tableInventoryCategories.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-inventory-category').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-inventory-category').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o categoria.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // recuperar categoria
        $(document).on('click', '.btn-modal-recover-inventory-category', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('inventory.category.recover') ? route('inventory.category.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    recoverInventoryCategoryAvailable();
                    $('#id-recover-inventory-category').val(data.id);
                    $('#name-confirmation-recover-inventory-category-text').html(data.name);
                    $('#name-recover-inventory-category').val(data.name);

                    $('#modal-recover-inventory-category').modal('show');
                }
            });
        });

        // recuperando categoria
        $(document).on('click', '#btn-recover-inventory-category', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-inventory-category').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-inventory-category').serialize(),
                    url: '{{ app('router')->has('inventory.category.restore') ? route('inventory.category.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        recoverInventoryCategoryAvailable();
                        $('#modal-recover-inventory-category').modal('hide');
                        tableInventoryCategoriesDeleted.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-inventory-category').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-inventory-category').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o categoria.');
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
