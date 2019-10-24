<script>
    $(function () {
        // tabela
        let databaseDepartment = '#datatable-departments';
        let tableDepartments   = $(databaseDepartment).DataTable({
            language:    datatables_pt_br,
            dom:         datatables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableDepartments.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [0, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('department.list') ? route('department.list') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseDepartment + '_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseDepartment + ' th').on('click', databaseDepartment + ' th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseDepartment, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseDepartment, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseDepartment);
                    }
                }
            },
            columns: [
                { data: 'name',        name: 'name' },
                { data: 'description', name: 'description', orderable: false, searchable: false },
                { data: 'action',      name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableDepartments.draw();
        });

        // tabela
        let tableDepartmentsDeleted = $(databaseDepartment + '-deleted').DataTable({
            language:    datatables_pt_br,
            dom:         datatables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableDepartmentsDeleted.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [0, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('department.list.deleted') ? route('department.list.deleted') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseDepartment + '-deleted_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseDepartment + '-deleted th').on('click', databaseDepartment + '-deleted th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseDepartment, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseDepartment, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseDepartment);
                    }
                }
            },
            columns: [
                { data: 'name',        name: 'name' },
                { data: 'description', name: 'description', orderable: false, searchable: false },
                { data: 'action',      name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableDepartmentsDeleted.draw();
        });

        // modal de novo departamento disponível
        let newDepartmentAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-department').removeAttr('disabled', 'disabled').html('Criar departamento');
            $('#form-new-department').trigger('reset');
        };

        // modal de editar departamento disponível
        let editDepartmentAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-department').removeAttr('disabled', 'disabled').html('Editar departamento');
            $('#form-edit-department').trigger('reset');
        };

        // modal de bloquear departamento disponível
        let blockDepartmentAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-department').removeAttr('disabled', 'disabled').html('Bloquear departamento');
            $('#form-block-department').trigger('reset');
        };

        // modal de deletar departamento disponível
        let deleteDepartmentAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-department').removeAttr('disabled', 'disabled').html('Excluir departamento');
            $('#form-delete-department').trigger('reset');
        };

        // modal de recuperar departamento disponível
        let recoverDepartmentAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-department').removeAttr('disabled', 'disabled').html('Recuperar departamento');
            $('#form-recover-department').trigger('reset');
        };

        // visualizar departamento
        $(document).on('click', '.btn-modal-view-department', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('department.view') ? route('department.view') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    // status
                    if (data.blocked || data.deleted_at) {
                        $('#status-view-department').removeClass('d-none');
                        $('#name-view-department').removeClass('mt--3').addClass('mt-3');

                        if (data.blocked) {
                            $('#status-view-department').addClass('text-warning').html('<i class="fas fa-ban"></i> bloqueado');
                        } else {
                            $('#status-view-department').addClass('text-danger').html('<i class="fas fa-ban"></i> deletado');
                        }
                    } else {
                        $('#status-view-department').addClass('d-none').html('');
                        $('#name-view-department').addClass('mt--3').removeClass('mt-3');
                    }
                    // nome
                    $('#name-view-department').html(data.name);
                    // descrição
                    if (data.description) {
                        $('#description-view-department').html('<div class="small mt-4">' + data.description + '</div>');
                    } else {
                        $('#description-view-department').html('');
                    }
                    // criado
                    $('#created-at-view-department').html('criado em ' + timestamp_to_date_br(data.created_at) + ' - ' + moment(data.created_at, 'YYYY-MM-DD hh:mm').locale('pt-br').fromNow());
                    // atualizado
                    $('#updated-at-view-department').html('atualizado em ' + timestamp_to_date_br(data.updated_at));

                    $('#modal-view-department').modal('show');
                }
            });
        });

        // novo departamento
        $(document).on('click', '.btn-modal-new-department', function (e) {
            e.preventDefault();
            newDepartmentAvailable();
            $('#modal-new-department').modal('show');
        });

        // salvando departamento
        $(document).on('click', '#btn-new-department', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-department').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-department').serialize(),
                    url: '{{ app('router')->has('department.store') ? route('department.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        newDepartmentAvailable();
                        $('#modal-new-department').modal('hide');
                        tableDepartments.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-department').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-department').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo departamento.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // editar departamento
        $(document).on('click', '.btn-modal-edit-department', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('department.edit') ? route('department.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    editDepartmentAvailable();
                    // dados
                    $('#id-edit-department').val(data.id);
                    $('#name-edit-department').val(data.name);
                    $('#description-edit-department').val(data.description);
                }

                $('#modal-edit-department').modal('show');
            });
        });

        // editando departamento
        $(document).on('click', '#btn-edit-department', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-department').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-edit-department').serialize(),
                    url: '{{ app('router')->has('department.update') ? route('department.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        editDepartmentAvailable();
                        $('#modal-edit-department').modal('hide');
                        tableDepartments.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-department').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-department').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o departamento.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // bloquear departamento
        $(document).on('click', '.btn-modal-block-department', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('department.ban') ? route('department.ban') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    blockDepartmentAvailable();
                    $('#id-block-department').val(data.id);
                    if (data.blocked) {
                        $('#blocked-block-department').prop('checked', true).attr('checked', 'checked');
                        $('#btn-block-department').html('Bloquear departamento');
                    } else {
                        $('#blocked-block-department').prop('checked', false).removeAttr('checked', 'checked');
                        $('#btn-block-department').html('Desbloquear departamento');
                    }

                    $('#modal-block-department').modal('show');
                }
            });
        });

        // bloqueando departamento
        $(document).on('click', '#btn-block-department', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-block-department').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-block-department').serialize(),
                    url: '{{ app('router')->has('department.block') ? route('department.block') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        blockDepartmentAvailable();
                        $('#modal-block-department').modal('hide');
                        tableDepartments.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-block-department').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-block-department').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao bloquear o departamento.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // deletar departamento
        $(document).on('click', '.btn-modal-delete-department', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('department.delete') ? route('department.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    deleteDepartmentAvailable();
                    $('#id-delete-department').val(data.id);
                    $('#name-confirmation-delete-department-text').html(data.name);
                    $('#name-delete-department').val(data.name);

                    $('#modal-delete-department').modal('show');
                }
            });
        });

        // deletando departamento
        $(document).on('click', '#btn-delete-department', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-department').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-department').serialize(),
                    url: '{{ app('router')->has('department.destroy') ? route('department.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        deleteDepartmentAvailable();
                        $('#modal-delete-department').modal('hide');
                        tableDepartments.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-department').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-department').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o departamento.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // recuperar departamento
        $(document).on('click', '.btn-modal-recover-department', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('department.recover') ? route('department.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    recoverDepartmentAvailable();
                    $('#id-recover-department').val(data.id);
                    $('#name-confirmation-recover-department-text').html(data.name);
                    $('#name-recover-department').val(data.name);

                    $('#modal-recover-department').modal('show');
                }
            });
        });

        // recuperando departamento
        $(document).on('click', '#btn-recover-department', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-department').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-department').serialize(),
                    url: '{{ app('router')->has('department.restore') ? route('department.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        recoverDepartmentAvailable();
                        $('#modal-recover-department').modal('hide');
                        tableDepartmentsDeleted.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-department').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-department').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o departamento.');
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
