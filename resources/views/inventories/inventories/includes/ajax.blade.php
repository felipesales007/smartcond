<script>
    $(function () {
        // tabela
        let databaseInventory = '#datatable-inventories';
        let tableInventories   = $(databaseInventory).DataTable({
            language:    datatables_pt_br,
            dom:         datatables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableInventories.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [2, 'asc'],
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
                { data: 'image',              name: 'image', className: 'text-center fe-td-img d-print-none', orderable: false, searchable: false },
                { data: 'patrimonial_number', name: 'patrimonial_number' },
                { data: 'name',               name: 'name' },
                { data: 'category',           name: 'category' },
                { data: 'department',         name: 'department' },
                { data: 'action',             name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableInventories.draw();
        });

        // tabela
        let tableInventoriesDeleted = $(databaseInventory + '-deleted').DataTable({
            language:    datatables_pt_br,
            dom:         datatables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableInventoriesDeleted.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [2, 'asc'],
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
                { data: 'image',              name: 'image', className: 'text-center fe-td-img d-print-none', orderable: false, searchable: false },
                { data: 'patrimonial_number', name: 'patrimonial_number' },
                { data: 'name',               name: 'name' },
                { data: 'category',           name: 'category' },
                { data: 'department',         name: 'department' },
                { data: 'action',             name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableInventoriesDeleted.draw();
        });

        // modal de novo inventário disponível
        let newInventoryAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-inventory').removeAttr('disabled', 'disabled').html('Criar item');
            $('.fe-remove-preview-10').addClass('fe-hidden');
            $('.fe-img-preview-10').attr('src', '');
            $('#department-id-new-inventory').val('').trigger('change');
            $('#inventory-category-id-new-inventory').val('').trigger('change');
            $('#inventory-state-id-new-inventory').val('1').trigger('change');
            $('#voltage-id-new-inventory').val('1').trigger('change');
            $('#form-new-inventory').trigger('reset');
        };

        // modal de outro novo inventário disponível
        let newOtherInventoryAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-other-inventory').removeAttr('disabled', 'disabled').html('<i class="far fa-copy"></i>');
            $('#patrimonial-number-new-inventory').val('');
            $('#serial-number-new-inventory').val('');
        };

        // modal de editar inventário disponível
        let editInventoryAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-inventory').removeAttr('disabled', 'disabled').html('Editar item');
            $('.fe-remove-preview-11').addClass('fe-hidden');
            $('.fe-img-preview-11').attr('src', '');
            $('#department-id-edit-inventory').val('').trigger('change');
            $('#inventory-category-id-edit-inventory').val('').trigger('change');
            $('#inventory-state-id-edit-inventory').val('1').trigger('change');
            $('#voltage-id-edit-inventory').val('1').trigger('change');
            $('#form-edit-inventory').trigger('reset');
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
                    // capa
                    $('#background-view-inventory').css('background-image', 'url({{ url('images/default/default-background.png') }})');

                    // status
                    if (data.deleted_at) {
                        $('#status-view-inventory').removeClass('d-none');
                        $('#status-view-inventory i').addClass('bg-danger').attr('data-original-title', 'deletado');
                    } else {
                        $('#status-view-inventory').addClass('d-none');
                        $('#status-view-inventory i').removeAttr('data-original-title');
                    }

                    // imagem
                    if (data.image) {
                        $('#image-view-inventory').css('background-image', 'url({{ url('storage/images/inventories/items') }}/' + data.image + ')');
                    } else {
                        $('#image-view-inventory').css('background-image', 'url({{ url('images/default/default-image.png') }})');
                    }

                    // nome
                    $('#name-view-inventory').html(data.name);

                    // patrimônio
                    if (data.patrimonial_number) {
                        $('#icon-patrimonial-number-view-inventory').removeClass('fe-hidden');
                        $('#patrimonial-number-view-inventory').html(data.patrimonial_number);
                    } else {
                        $('#icon-patrimonial-number-view-inventory').addClass('fe-hidden');
                        $('#patrimonial-number-view-inventory').html('');
                    }

                    // voltagem e estado de conservação
                    if (data.voltage || data.state) {
                        if (!data.voltage && data.state) {
                            $('#voltage-view-inventory').html('&nbsp;');
                            $('#state-view-inventory').html('<b>estado: </b>' + data.state);
                        } else if (data.voltage && !data.state) {
                            $('#voltage-view-inventory').html('<b>voltagem: </b>' + data.voltage);
                            $('#state-view-inventory').html('&nbsp;');
                        } else {
                            $('#voltage-view-inventory').html('<b>voltagem: </b>' + data.voltage);
                            $('#state-view-inventory').html('<b>estado: </b>' + data.state);
                        }
                    } else {
                        $('#voltage-view-inventory').html('');
                        $('#state-view-inventory').html('');
                    }

                    // marca e modelo
                    if (data.brand || data.model) {
                        if (!data.brand && data.model) {
                            $('#brand-view-inventory').html('&nbsp;').addClass('pb-2');
                            $('#model-view-inventory').html('<b>modelo: </b>' + data.model);
                        } else if (data.brand && !data.model) {
                            $('#brand-view-inventory').html('<b>marca: </b>' + data.brand).addClass('pb-2');
                            $('#model-view-inventory').html('&nbsp;');
                        } else {
                            $('#brand-view-inventory').html('<b>marca: </b>' + data.brand).addClass('pb-2');
                            $('#model-view-inventory').html('<b>modelo: </b>' + data.model);
                        }
                    } else {
                        $('#brand-view-inventory').html('').removeClass('pb-2');
                        $('#model-view-inventory').html('');
                    }

                    // nº de série e nº da nota fiscal
                    if (data.serial_number || data.invoice) {
                        if (!data.serial_number && data.invoice) {
                            $('#serial-number-view-inventory').html('&nbsp;').addClass('pb-2');
                            $('#invoice-view-inventory').html('<b>nota fiscal: </b>' + data.invoice);
                        } else if (data.serial_number && !data.invoice) {
                            $('#serial-number-view-inventory').html('<b>nº de série: </b>' + data.serial_number).addClass('pb-2');
                            $('#invoice-view-inventory').html('&nbsp;');
                        } else {
                            $('#serial-number-view-inventory').html('<b>nº de série: </b>' + data.serial_number).addClass('pb-2');
                            $('#invoice-view-inventory').html('<b>nota fiscal: </b>' + data.invoice);
                        }
                    } else {
                        $('#serial-number-view-inventory').html('').removeClass('pb-2');
                        $('#invoice-view-inventory').html('');
                    }

                    // valor e data de comprado
                    if (data.value && data.value > 0 || data.purchase_date) {
                        if (!data.value && data.purchase_date) {
                            $('#value-view-inventory').html('&nbsp;').addClass('pb-2');
                            $('#purchase-date-view-inventory').html('<b>comprado em: </b>' + date_to_date_br(data.purchase_date));
                        } else if (data.value && data.value > 0 && !data.purchase_date) {
                            $('#value-view-inventory').html('<b>valor: </b>R$ ' + to_real(data.value)).addClass('pb-2');
                            $('#purchase-date-view-inventory').html('&nbsp;');
                        } else {
                            $('#value-view-inventory').html('<b>valor: </b>R$ ' + to_real(data.value)).addClass('pb-2');
                            $('#purchase-date-view-inventory').html('<b>comprado em: </b>' + date_to_date_br(data.purchase_date));
                        }
                    } else {
                        $('#value-view-inventory').html('').removeClass('pb-2');
                        $('#purchase-date-view-inventory').html('');
                    }

                    // data da garantia
                    if (data.warranty_date) {
                        let days = moment(date_to_date_br(data.warranty_date), 'DD/MM/YYYY').diff(moment(), 'days');
                        days = moment(days).add(1, 'days').format('d');

                        if (days > 0) {
                            if (days === '1') {
                                $('#warranty-date-view-inventory').html('<b>garantia até: </b>' + date_to_date_br(data.warranty_date) + ' <span class="badge badge-info">' + days + ' dia restante</span>');
                            } else {
                                $('#warranty-date-view-inventory').html('<b>garantia até: </b>' + date_to_date_br(data.warranty_date) + ' <span class="badge badge-info">' + days + ' dias restante</span>');
                            }
                        } else {
                            $('#warranty-date-view-inventory').html('<b>garantia até: </b>' + date_to_date_br(data.warranty_date) + ' <span class="badge badge-warning">sem garantia</span>');
                        }

                    } else {
                        $('#warranty-date-view-inventory').html('');
                    }

                    // descrição
                    if (data.description) {
                        $('#text-description-view-inventory').removeClass('d-none');
                        $('#description-view-inventory').html(data.description);
                    } else {
                        $('#text-description-view-inventory').addClass('d-none');
                        $('#description-view-inventory').html('');
                    }

                    // departamento
                    $('#department-view-inventory').html('<b>' + data.department + '</b><i class="fas fa-building ml-2"></i>');
                    // categoria
                    $('#category-view-inventory').html('<b>' + data.category + '</b><i class="fas fa-box ml-2"></i>');
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
                    data: new FormData($('#form-new-inventory')[0]),
                    contentType: false,
                    processData: false,
                    url: '{{ app('router')->has('inventory.store') ? route('inventory.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        newInventoryAvailable();
                        //$('#modal-new-inventory').modal('hide');
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

        // salvando outro inventário
        $(document).on('click', '#btn-new-other-inventory', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse"></i>');

            if ($('#form-new-inventory').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: new FormData($('#form-new-inventory')[0]),
                    contentType: false,
                    processData: false,
                    url: '{{ app('router')->has('inventory.store') ? route('inventory.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        newOtherInventoryAvailable();
                        tableInventories.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-other-inventory').removeAttr('disabled', 'disabled').html('<i class="far fa-copy"></i>');;
                        $('#form-new-inventory').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo item do inventário.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('<i class="far fa-copy"></i>');;
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
                    // imagem
                    $('.fe-image-url-11').val(destination_url(data.id, 'png'));
                    if (data.image) {
                        $('.fe-remove-preview-11').removeClass('fe-hidden');
                        $('.fe-img-preview-11').attr('src', '{{ url('storage/images/inventories/items') }}/' + data.image);
                    } else {
                        $('.fe-remove-preview-11').addClass('fe-hidden');
                        $('.fe-img-preview-11').attr('src', '');
                    }
                    // dados
                    $('#id-edit-inventory').val(data.id);
                    $('#department-id-edit-inventory').val(data.department_id).trigger('change');
                    $('#inventory-category-id-edit-inventory').val(data.inventory_category_id).trigger('change');
                    $('#inventory-state-id-edit-inventory').val(data.inventory_state_id).trigger('change');
                    $('#patrimonial-number-edit-inventory').val(data.patrimonial_number);
                    $('#name-edit-inventory').val(data.name);
                    $('#brand-edit-inventory').val(data.brand);
                    $('#model-edit-inventory').val(data.model);
                    $('#serial-number-edit-inventory').val(data.serial_number);
                    $('#invoice-edit-inventory').val(data.invoice);
                    $('#value-edit-inventory').val(to_real(data.value));
                    $('#voltage-id-edit-inventory').val(data.voltage_id).trigger('change');
                    $('#purchase-date-edit-inventory').datepicker('setDate', date_to_date_br(data.purchase_date));
                    $('#warranty-date-edit-inventory').datepicker('setDate', date_to_date_br(data.warranty_date));
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
                    data: new FormData($('#form-edit-inventory')[0]),
                    contentType: false,
                    processData: false,
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
                        notifyError('Erro ao editar o item do inventário.');
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
                        notifyError('Erro ao deletar o item do inventário.');
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
                        notifyError('Erro ao recuperar o item do inventário.');
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
