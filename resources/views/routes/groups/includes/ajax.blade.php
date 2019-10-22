<script>
    $(function () {
        // variável
        let databaseGroup = '#datatable-groups';

        // tabela de grupos
        let tableGroups = $(databaseGroup).DataTable({
            language:    datatables_pt_br,
            dom:         datatables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableGroups.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [0, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('group.list') ? route('group.list') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseGroup + '_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseGroup + ' th').on('click', databaseGroup + ' th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseGroup, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseGroup, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseGroup);
                    }
                }
            },
            columns: [
                { data: 'name',        name: 'name' },
                { data: 'description', name: 'description', orderable: false, searchable: false },
                { data: 'action',      name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableGroups.draw();
        });

        // tabela de grupos deletados
        let tableGroupsDeleted = $(databaseGroup + '-deleted').DataTable({
            language:    datatables_pt_br,
            dom:         datatables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableGroupsDeleted.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [0, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('group.list.deleted') ? route('group.list.deleted') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseGroup + '-deleted_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseGroup + '-deleted th').on('click', databaseGroup + '-deleted th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseGroup, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseGroup, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseGroup);
                    }
                }
            },
            columns: [
                { data: 'name',        name: 'name' },
                { data: 'description', name: 'description', orderable: false, searchable: false },
                { data: 'action',      name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableGroupsDeleted.draw();
        });

        // modal de novo grupo disponível
        let newGroupAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-group').removeAttr('disabled', 'disabled').html('Criar grupo');
            $('#form-new-group').trigger('reset');
        };

        // modal de editar grupo disponível
        let editGroupAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-group').removeAttr('disabled', 'disabled').html('Editar grupo');
            $('#form-edit-group').trigger('reset');
        };

        // modal de bloquear grupo disponível
        let blockGroupAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-group').removeAttr('disabled', 'disabled').html('Bloquear grupo');
            $('#form-block-group').trigger('reset');
        };

        // modal de deletar grupo disponível
        let deleteGroupAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-group').removeAttr('disabled', 'disabled').html('Excluir grupo');
            $('#form-delete-group').trigger('reset');
        };

        // modal de recuperar grupo disponível
        let recoverGroupAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-group').removeAttr('disabled', 'disabled').html('Recuperar grupo');
            $('#form-recover-group').trigger('reset');
        };

        // visualizar grupo
        $(document).on('click', '.btn-modal-view-group', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('group.view') ? route('group.view') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    // status
                    if (data.blocked || data.deleted_at) {
                        $('#status-view-group').removeClass('d-none');
                        $('#name-view-group').removeClass('mt--3').addClass('mt-3');

                        if (data.blocked) {
                            $('#status-view-group').addClass('text-warning').html('<i class="fas fa-ban"></i> bloqueado');
                        } else {
                            $('#status-view-group').addClass('text-danger').html('<i class="fas fa-ban"></i> deletado');
                        }
                    } else {
                        $('#status-view-group').addClass('d-none').html('');
                        $('#name-view-group').addClass('mt--3').removeClass('mt-3');
                    }
                    // nome
                    $('#name-view-group').html(data.name);
                    // descrição
                    if (data.description) {
                        $('#description-view-group').html('<div class="small mt-4">' + data.description + '</div>');
                    } else {
                        $('#description-view-group').html('');
                    }
                    // criado
                    $('#created-at-view-group').html('criado em ' + timestamp_to_date_br(data.created_at) + ' - ' + moment(data.created_at, 'YYYY-MM-DD hh:mm').locale('pt-br').fromNow());
                    // atualizado
                    $('#updated-at-view-group').html('atualizado em ' + timestamp_to_date_br(data.updated_at));

                    $('#modal-view-group').modal('show');
                }
            });
        });

        // novo grupo
        $(document).on('click', '.btn-modal-new-group', function (e) {
            e.preventDefault();
            newGroupAvailable();
            $('#modal-new-group').modal('show');
        });

        // salvando grupo
        $(document).on('click', '#btn-new-group', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-group').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-group').serialize(),
                    url: '{{ app('router')->has('group.store') ? route('group.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        newGroupAvailable();
                        $('#modal-new-group').modal('hide');
                        tableGroups.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-group').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-group').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo grupo.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // editar grupo
        $(document).on('click', '.btn-modal-edit-group', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('group.edit') ? route('group.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    editGroupAvailable();
                    $('#id-edit-group').val(data.id);
                    $('#name-edit-group').val(data.name);
                    $('#description-edit-group').val(data.description);

                    $('#modal-edit-group').modal('show');
                }
            });
        });

        // editando grupo
        $(document).on('click', '#btn-edit-group', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-group').valid()) {
                loader(1);
                scrollTop();
                $.ajax({
                    data: $('#form-edit-group').serialize(),
                    url: '{{ app('router')->has('group.update') ? route('group.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        editGroupAvailable();
                        $('#modal-edit-group').modal('hide');
                        tableGroups.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-group').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-group').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o grupo.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // bloquear grupo
        $(document).on('click', '.btn-modal-block-group', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('group.ban') ? route('group.ban') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    blockGroupAvailable();
                    $('#id-block-group').val(data.id);
                    if (data.blocked) {
                        $('#blocked-block-group').prop('checked', true).attr('checked', 'checked');
                        $('#btn-block-group').html('Bloquear grupo');
                    } else {
                        $('#blocked-block-group').prop('checked', false).removeAttr('checked', 'checked');
                        $('#btn-block-group').html('Desbloquear grupo');
                    }

                    $('#modal-block-group').modal('show');
                }
            });
        });

        // bloqueando grupo
        $(document).on('click', '#btn-block-group', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-block-group').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-block-group').serialize(),
                    url: '{{ app('router')->has('group.block') ? route('group.block') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        blockGroupAvailable();
                        $('#modal-block-group').modal('hide');
                        tableGroups.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-block-group').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-block-group').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao bloquear o grupo.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // deletar grupo
        $(document).on('click', '.btn-modal-delete-group', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('group.delete') ? route('group.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    deleteGroupAvailable();
                    $('#id-delete-group').val(data.id);
                    $('#name-confirmation-delete-group-text').html(data.name);
                    $('#name-delete-group').val(data.name);

                    $('#modal-delete-group').modal('show');
                }
            });
        });

        // deletando grupo
        $(document).on('click', '#btn-delete-group', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-group').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-group').serialize(),
                    url: '{{ app('router')->has('group.destroy') ? route('group.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        deleteGroupAvailable();
                        $('#modal-delete-group').modal('hide');
                        tableGroups.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-group').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-group').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o grupo.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // recuperar grupo
        $(document).on('click', '.btn-modal-recover-group', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('group.recover') ? route('group.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    recoverGroupAvailable();
                    $('#id-recover-group').val(data.id);
                    $('#name-confirmation-recover-group-text').html(data.name);
                    $('#name-recover-group').val(data.name);

                    $('#modal-recover-group').modal('show');
                }
            });
        });

        // recuperando grupo
        $(document).on('click', '#btn-recover-group', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-group').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-group').serialize(),
                    url: '{{ app('router')->has('group.restore') ? route('group.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        recoverGroupAvailable();
                        $('#modal-recover-group').modal('hide');
                        tableGroupsDeleted.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-group').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-group').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o grupo.');
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
