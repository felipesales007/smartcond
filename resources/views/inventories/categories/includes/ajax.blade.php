<script>
    $(function () {
        // tabela
        let databaseCategory = '#datatable-categories';
        let tableCategories  = $(databaseCategory).DataTable({
            language:    dataTables_pt_br,
            dom:         dataTables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableCategories.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [0, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('category.list') ? route('category.list') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseCategory + '_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseCategory + ' th').on('click', databaseCategory + ' th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseCategory, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseCategory, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseCategory);
                    }
                }
            },
            columns: [
                { data: 'name',        name: 'name' },
                { data: 'description', name: 'description', orderable: false, searchable: false },
                { data: 'action',      name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableCategories.draw();
        });

        // tabela
        let tableCategoriesDeleted = $(databaseCategory + '-deleted').DataTable({
            language:    dataTables_pt_br,
            dom:         dataTables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableCategoriesDeleted.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [0, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('category.list.deleted') ? route('category.list.deleted') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseCategory + '-deleted_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseCategory + '-deleted th').on('click', databaseCategory + '-deleted th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseCategory, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseCategory, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseCategory);
                    }
                }
            },
            columns: [
                { data: 'name',        name: 'name' },
                { data: 'description', name: 'description', orderable: false, searchable: false },
                { data: 'action',      name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableCategoriesDeleted.draw();
        });

        // modal de novo categoria disponível
        let newCategoryAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-category').removeAttr('disabled', 'disabled').html('Criar categoria');
            $('#form-new-category').trigger('reset');
        };

        // modal de editar categoria disponível
        let editCategoryAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-category').removeAttr('disabled', 'disabled').html('Editar categoria');
            $('#form-edit-category').trigger('reset');
        };

        // modal de bloquear categoria disponível
        let blockCategoryAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-category').removeAttr('disabled', 'disabled').html('Bloquear categoria');
            $('#form-block-category').trigger('reset');
        };

        // modal de deletar categoria disponível
        let deleteCategoryAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-category').removeAttr('disabled', 'disabled').html('Excluir categoria');
            $('#form-delete-category').trigger('reset');
        };

        // modal de recuperar categoria disponível
        let recoverCategoryAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-category').removeAttr('disabled', 'disabled').html('Recuperar categoria');
            $('#form-recover-category').trigger('reset');
        };

        // visualizar categoria
        $(document).on('click', '.btn-modal-view-category', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('category.view') ? route('category.view') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    // status
                    if (data.blocked || data.deleted_at) {
                        $('#status-view-category').removeClass('d-none');
                        $('#name-view-category').removeClass('mt--3').addClass('mt-3');

                        if (data.blocked) {
                            $('#status-view-category').addClass('text-warning').html('<i class="fas fa-ban"></i> bloqueado');
                        } else {
                            $('#status-view-category').addClass('text-danger').html('<i class="fas fa-ban"></i> deletado');
                        }
                    } else {
                        $('#status-view-category').addClass('d-none').html('');
                        $('#name-view-category').addClass('mt--3').removeClass('mt-3');
                    }
                    // nome
                    $('#name-view-category').html(data.name);
                    // descrição
                    if (data.description) {
                        $('#description-view-category').html('<div class="small mt-4">' + data.description + '</div>');
                    } else {
                        $('#description-view-category').html('');
                    }
                    // criado
                    $('#created-at-view-category').html('criado em ' + timestamp_to_date_br(data.created_at) + ' - ' + moment(data.created_at, 'YYYY-MM-DD hh:mm').locale('pt-br').fromNow());
                    // atualizado
                    $('#updated-at-view-category').html('atualizado em ' + timestamp_to_date_br(data.updated_at));

                    $('#modal-view-category').modal('show');
                }
            });
        });

        // novo categoria
        $(document).on('click', '.btn-modal-new-category', function (e) {
            e.preventDefault();
            newCategoryAvailable();
            $('#modal-new-category').modal('show');
        });

        // salvando categoria
        $(document).on('click', '#btn-new-category', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-category').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-category').serialize(),
                    url: '{{ app('router')->has('category.store') ? route('category.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        newCategoryAvailable();
                        $('#modal-new-category').modal('hide');
                        tableCategories.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-category').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-category').valid();
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
        $(document).on('click', '.btn-modal-edit-category', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('category.edit') ? route('category.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    editCategoryAvailable();
                    // dados
                    $('#id-edit-category').val(data.id);
                    $('#name-edit-category').val(data.name);
                    $('#description-edit-category').val(data.description);
                }

                $('#modal-edit-category').modal('show');
            });
        });

        // editando categoria
        $(document).on('click', '#btn-edit-category', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-category').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-edit-category').serialize(),
                    url: '{{ app('router')->has('category.update') ? route('category.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        editCategoryAvailable();
                        $('#modal-edit-category').modal('hide');
                        tableCategories.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-category').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-category').valid();
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
        $(document).on('click', '.btn-modal-block-category', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('category.ban') ? route('category.ban') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    blockCategoryAvailable();
                    $('#id-block-category').val(data.id);
                    if (data.blocked) {
                        $('#blocked-block-category').prop('checked', true).attr('checked', 'checked');
                        $('#btn-block-category').html('Bloquear categoria');
                    } else {
                        $('#blocked-block-category').prop('checked', false).removeAttr('checked', 'checked');
                        $('#btn-block-category').html('Desbloquear categoria');
                    }

                    $('#modal-block-category').modal('show');
                }
            });
        });

        // bloqueando categoria
        $(document).on('click', '#btn-block-category', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-block-category').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-block-category').serialize(),
                    url: '{{ app('router')->has('category.block') ? route('category.block') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        blockCategoryAvailable();
                        $('#modal-block-category').modal('hide');
                        tableCategories.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-block-category').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-block-category').valid();
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
        $(document).on('click', '.btn-modal-delete-category', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('category.delete') ? route('category.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    deleteCategoryAvailable();
                    $('#id-delete-category').val(data.id);
                    $('#name-confirmation-delete-category-text').html(data.name);
                    $('#name-delete-category').val(data.name);

                    $('#modal-delete-category').modal('show');
                }
            });
        });

        // deletando categoria
        $(document).on('click', '#btn-delete-category', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-category').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-category').serialize(),
                    url: '{{ app('router')->has('category.destroy') ? route('category.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        deleteCategoryAvailable();
                        $('#modal-delete-category').modal('hide');
                        tableCategories.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-category').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-category').valid();
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
        $(document).on('click', '.btn-modal-recover-category', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('category.recover') ? route('category.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    recoverCategoryAvailable();
                    $('#id-recover-category').val(data.id);
                    $('#name-confirmation-recover-category-text').html(data.name);
                    $('#name-recover-category').val(data.name);

                    $('#modal-recover-category').modal('show');
                }
            });
        });

        // recuperando categoria
        $(document).on('click', '#btn-recover-category', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-category').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-category').serialize(),
                    url: '{{ app('router')->has('category.restore') ? route('category.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        recoverCategoryAvailable();
                        $('#modal-recover-category').modal('hide');
                        tableCategoriesDeleted.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-category').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-category').valid();
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
