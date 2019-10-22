<script>
    $(function () {
        // variável
        let databaseEntity = '#datatable-entities';

        // tabela de condomínios
        let tableEntities = $(databaseEntity).DataTable({
            language:    datatables_pt_br,
            dom:         datatables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableEntities.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [1, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('entity.list') ? route('entity.list') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseEntity + '_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseEntity + ' th').on('click', databaseEntity + ' th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseEntity, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseEntity, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseEntity);
                    }
                }
            },
            columns: [
                { data: 'logo',        name: 'logo', className: 'text-center fe-td-img d-print-none', orderable: false, searchable: false },
                { data: 'name',        name: 'name' },
                { data: 'email',       name: 'email' },
                { data: 'contact',     name: 'contact' },
                { data: 'cnpj',        name: 'cnpj' },
                { data: 'action',      name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableEntities.draw();
        });

        // tabela de condomínios deletadas
        let tableEntitiesDeleted = $(databaseEntity + '-deleted').DataTable({
            language:    datatables_pt_br,
            dom:         datatables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableEntitiesDeleted.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [1, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('entity.list.deleted') ? route('entity.list.deleted') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseEntity + '-deleted_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseEntity + '-deleted th').on('click', databaseEntity + '-deleted th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseEntity, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseEntity, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseEntity);
                    }
                }
            },
            columns: [
                { data: 'logo',        name: 'logo', className: 'text-center fe-td-img d-print-none', orderable: false, searchable: false },
                { data: 'name',        name: 'name' },
                { data: 'email',       name: 'email' },
                { data: 'contact',     name: 'contact' },
                { data: 'cnpj',        name: 'cnpj' },
                { data: 'action',      name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableEntitiesDeleted.draw();
        });

        // tabela de usuários do condomínio
        let tableEntitiesUsers = $(databaseEntity + '-users').DataTable({
            language:    datatables_pt_br,
            dom:         datatables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableEntitiesUsers.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [1, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('entity.list.users') ? route('entity.list.users') : url('/') }}',
                data: {
                    entity : function () {
                        return window.location.search.split('?id=').pop();
                    },
                    search: function () {
                        return $(databaseEntity + '-users_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseEntity + '-users th').on('click', databaseEntity + '-users th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseEntity, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseEntity, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseEntity);
                    }
                }
            },
            columns: [
                { data: 'photo',     name: 'photo', className: 'text-center fe-td-img d-print-none', orderable: false, searchable: false },
                { data: 'name',      name: 'name' },
                { data: 'email',     name: 'email' },
                { data: 'date',      name: 'date', searchable: false },
                { data: 'action',    name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableEntitiesUsers.draw();
        });

        // modal de novo condomínio disponível
        let newEntityAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-entity').removeAttr('disabled', 'disabled').html('Criar condomínio');
            $('.fe-remove-preview-4').addClass('fe-hidden');
            $('.fe-img-preview-4').attr('src', '');
            $('#state-id-new-entity').val('').trigger('change');
            $('#form-new-entity').trigger('reset');
        };

        // modal de editar condomínio disponível
        let editEntityAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-entity').removeAttr('disabled', 'disabled').html('Editar condomínio');
            $('#state-id-edit-entity').val('').trigger('change');
            $('#form-edit-entity').trigger('reset');
        };

        // modal de bloquear condomínio disponível
        let blockEntityAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-entity').removeAttr('disabled', 'disabled').html('Bloquear condomínio');
            $('#form-block-entity').trigger('reset');
        };

        // modal de deletar condomínio disponível
        let deleteEntityAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-entity').removeAttr('disabled', 'disabled').html('Excluir condomínio');
            $('#form-delete-entity').trigger('reset');
        };

        // modal de recuperar condomínio disponível
        let recoverEntityAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-entity').removeAttr('disabled', 'disabled').html('Recuperar condomínio');
            $('#form-recover-entity').trigger('reset');
        };

        // modal de enviar e-mail para o condomínio disponível
        let sendEmailEntityAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-send-email-entity').removeAttr('disabled', 'disabled').html('Enviar e-mail');
            $('#form-send-email-entity').trigger('reset');
        };

        // modal de novo usuário do condomínio disponível
        let newEntityUserAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-entity-user').removeAttr('disabled', 'disabled').html('Criar usuário');
            $('#form-new-entity-user').trigger('reset');
        };

        // visualizar condomínio
        $(document).on('click', '.btn-modal-view-entity', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('entity.view') ? route('entity.view') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    // capa
                    $('#background-view-entity').css('background-image', 'url({{ url('images/default/default-background.png') }})');
                    // status
                    if (data.blocked || data.blocked_at >= moment().format('YYYY-MM-DD') || data.deleted_at) {
                        $('#status-view-entity').removeClass('d-none');

                        if (data.blocked || data.blocked_at) {
                            if (data.blocked) {
                                $('#status-view-entity i').addClass('bg-warning').attr('data-original-title', 'bloqueado');
                            } else {
                                $('#status-view-entity i').addClass('bg-warning').attr('data-original-title', 'bloqueado até ' + timestamp_to_date_br(data.blocked_at));
                            }
                        } else {
                            $('#status-view-entity i').addClass('bg-danger').attr('data-original-title', 'deletada');
                        }
                    } else {
                        $('#status-view-entity').addClass('d-none');
                        $('#status-view-entity i').removeAttr('data-original-title');
                    }
                    // foto
                    if (data.logo) {
                        $('#logo-view-entity').css('background-image', 'url({{ url('storage/images/companies/logo') }}/' + data.logo + ')');
                    } else {
                        $('#logo-view-entity').css('background-image', 'url({{ url('images/default/default-logo.png') }})');
                    }
                    // nome
                    $('#name-view-entity').html(data.name);
                    // cnpj
                    $('#cnpj-view-entity').html(data.cnpj);
                    // razão social
                    $('#corporate-name-view-entity').html(data.corporate_name);
                    // endereço
                    $('#residential-view-entity').removeClass('mb-4 mb-sm-0').addClass('d-none');
                    $('#br-postal-code-view-entity').addClass('d-none');
                    $('#br-address-view-entity').addClass('d-none');
                    $('#br-complement-view-entity').addClass('d-none');
                    $('#br-neighborhood-view-entity').addClass('d-none');
                    if (data.postal_code || data.address || data.house_number || data.complement || data.neighborhood || data.city || data.state_id || data.country) {
                        $('#residential-view-entity').addClass('mb-4 mb-sm-0').removeClass('d-none');

                        if (data.postal_code) {
                            $('#postal-code-view-entity').html(data.postal_code);
                            $('#br-postal-code-view-entity').removeClass('d-none');
                        } else {
                            $('#postal-code-view-entity').html('');
                        }

                        if (data.address) {
                            $('#address-view-entity').html(data.address);
                            $('#br-address-view-entity').removeClass('d-none');
                        } else {
                            $('#address-view-entity').html('');
                        }

                        if (data.house_number) {
                            $('#br-address-view-entity').removeClass('d-none');

                            if (data.address) {
                                $('#house-number-view-entity').html(', nº ' + data.house_number);
                            } else {
                                $('#house-number-view-entity').html('nº ' + data.house_number);
                            }
                        } else {
                            $('#house-number-view-entity').html('');
                        }

                        if (data.complement) {
                            $('#complement-view-entity').html(data.complement);
                            $('#br-complement-view-entity').removeClass('d-none');
                        } else {
                            $('#complement-view-entity').html('');
                        }

                        if (data.neighborhood) {
                            $('#neighborhood-view-entity').html(data.neighborhood);
                            $('#br-neighborhood-view-entity').removeClass('d-none');
                        } else {
                            $('#neighborhood-view-entity').html('');
                        }

                        if (data.city) {
                            $('#br-neighborhood-view-entity').removeClass('d-none');

                            if (data.neighborhood) {
                                $('#city-view-entity').html(', ' + data.city);
                            } else {
                                $('#city-view-entity').html(data.city);
                            }
                        } else {
                            $('#city-view-entity').html('');
                        }

                        if (data.state) {
                            $('#br-neighborhood-view-entity').removeClass('d-none');

                            if (data.neighborhood || data.city) {
                                $('#state-view-entity').html(', ' + data.state);
                            } else {
                                $('#state-view-entity').html(data.state);
                            }
                        } else {
                            $('#state-view-entity').html('');
                        }

                        if (data.country) {
                            $('#br-neighborhood-view-entity').removeClass('d-none');

                            if (data.neighborhood || data.city || data.state) {
                                $('#country-view-entity').html(' - ' + data.country);
                            } else {
                                $('#country-view-entity').html(data.country);
                            }
                        } else {
                            $('#country-view-entity').html('');
                        }
                    } else {
                        $('#postal-code-view-entity').html('');
                        $('#address-view-entity').html('');
                        $('#house-number-view-entity').html('');
                        $('#complement-view-entity').html('');
                        $('#neighborhood-view-entity').html('');
                        $('#city-view-entity').html('');
                        $('#state-view-entity').html('');
                        $('#country-view-entity').html('');
                    }
                    // e-mail
                    $('#email-view-entity').html(data.email);
                    // contato
                    $('#contact-view-entity').html(data.contact);
                    // criado
                    $('#created-at-view-entity').html('criado em ' + timestamp_to_date_br(data.created_at) + ' - ' + moment(data.created_at, 'YYYY-MM-DD hh:mm').locale('pt-br').fromNow());
                    // atualizado
                    $('#last-update-at-view-entity').html('atualizado em ' + timestamp_to_date_br(data.last_update_at));
                    // acessar lista de usuários
                    $('#link-entity-list-users').attr('href', '{{ app('router')->has('entity.list.users') ? route('entity.list.users') : '' }}?id=' + data.id);

                    $('#modal-view-entity').modal('show');
                }
            });
        });

        // novo condomínio
        $(document).on('click', '.btn-modal-new-entity', function (e) {
            e.preventDefault();
            newEntityAvailable();
            $('#modal-new-entity').modal('show');
        });

        // salvando condomínio
        $(document).on('click', '#btn-new-entity', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-entity').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: new FormData($('#form-new-entity')[0]),
                    contentType: false,
                    processData: false,
                    url: '{{ app('router')->has('entity.store') ? route('entity.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        newEntityAvailable();
                        $('#modal-new-entity').modal('hide');
                        tableEntities.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-entity').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-entity').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo condomínio.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // editar condomínio
        $(document).on('click', '.btn-modal-edit-entity', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('entity.edit') ? route('entity.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    editEntityAvailable();
                    // logo
                    $('.fe-image-url-5').val(destination_url(data.id, 'png'));
                    if (data.logo) {
                        $('.fe-remove-preview-5').removeClass('fe-hidden');
                        $('.fe-img-preview-5').attr('src', '{{ url('storage/images/companies/logo') }}/' + data.logo);
                    } else {
                        $('.fe-remove-preview-5').addClass('fe-hidden');
                        $('.fe-img-preview-5').attr('src', '');
                    }
                    // dados
                    $('#id-edit-entity').val(data.id);
                    $('#name-edit-entity').val(data.name);
                    $('#corporate-name-edit-entity').val(data.corporate_name);
                    $('#cnpj-edit-entity').val(data.cnpj);
                    // responsável
                    $('#email-edit-entity').val(data.email);
                    $('#contact-edit-entity').val(data.contact);
                    // residenciais
                    $('#postal-code-edit-entity').val(data.postal_code);
                    $('#address-edit-entity').val(data.address);
                    $('#house-number-edit-entity').val(data.house_number);
                    $('#complement-edit-entity').val(data.complement);
                    $('#neighborhood-edit-entity').val(data.neighborhood);
                    $('#city-edit-entity').val(data.city);
                    $('#state-id-edit-entity').val(data.state_id).trigger('change');
                    $('#country-edit-entity').val(data.country);
                }

                $('#modal-edit-entity').modal('show');
            });
        });

        // editando condomínio
        $(document).on('click', '#btn-edit-entity', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-entity').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: new FormData($('#form-edit-entity')[0]),
                    contentType: false,
                    processData: false,
                    url: '{{ app('router')->has('entity.update') ? route('entity.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        editEntityAvailable();
                        $('#modal-edit-entity').modal('hide');
                        tableEntities.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-entity').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-entity').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o condomínio.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // bloquear condomínio
        $(document).on('click', '.btn-modal-block-entity', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('entity.ban') ? route('entity.ban') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    blockEntityAvailable();
                    $('#id-block-entity').val(data.id);
                    // checkbox
                    if (data.blocked) {
                        $('#blocked-block-entity').prop('checked', true).attr('checked', 'checked');
                    } else {
                        $('#blocked-block-entity').prop('checked', false).removeAttr('checked', 'checked');
                    }
                    // input
                    $('#blocked-at-block-entity').datepicker('setDate', timestamp_to_date_br(data.blocked_at));
                    if (data.blocked_at >= moment().format('YYYY-MM-DD')) {
                        $('#blocked-at-block-entity-text').html('Condomínio <b class="text-warning">' + data.name + '</b> bloqueado até ' + timestamp_to_date_br(data.blocked_at));
                    } else {
                        $('#blocked-at-block-entity-text').html('Bloquear <b class="text-warning">' + data.name + '</b> até uma data determinada');
                    }

                    $('#modal-block-entity').modal('show');
                }
            });
        });

        // bloqueando condomínio
        $(document).on('click', '#btn-block-entity', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-block-entity').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-block-entity').serialize(),
                    url: '{{ app('router')->has('entity.block') ? route('entity.block') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        blockEntityAvailable();
                        $('#modal-block-entity').modal('hide');
                        tableEntities.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-block-entity').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-block-entity').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao bloquear o condomínio.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // deletar condomínio
        $(document).on('click', '.btn-modal-delete-entity', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('entity.delete') ? route('entity.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    deleteEntityAvailable();
                    $('#id-delete-entity').val(data.id);
                    $('#name-confirmation-delete-entity-text').html(data.name);
                    $('#name-delete-entity').val(data.name);

                    $('#modal-delete-entity').modal('show');
                }
            });
        });

        // deletando condomínio
        $(document).on('click', '#btn-delete-entity', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-entity').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-entity').serialize(),
                    url: '{{ app('router')->has('entity.destroy') ? route('entity.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        deleteEntityAvailable();
                        $('#modal-delete-entity').modal('hide');
                        tableEntities.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-entity').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-entity').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o condomínio.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // recuperar condomínio
        $(document).on('click', '.btn-modal-recover-entity', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('entity.recover') ? route('entity.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    recoverEntityAvailable();
                    $('#id-recover-entity').val(data.id);
                    $('#name-confirmation-recover-entity-text').html(data.name);
                    $('#name-recover-entity').val(data.name);

                    $('#modal-recover-entity').modal('show');
                }
            });
        });

        // recuperando condomínio
        $(document).on('click', '#btn-recover-entity', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-entity').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-entity').serialize(),
                    url: '{{ app('router')->has('entity.restore') ? route('entity.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        recoverEntityAvailable();
                        $('#modal-recover-entity').modal('hide');
                        tableEntitiesDeleted.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-entity').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-entity').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o condomínio.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // enviar e-mail para o condomínio
        $(document).on('click', '.btn-modal-send-email-entity', function (e) {
            e.preventDefault();
            sendEmailEntityAvailable();
            $('#name-send-email-entity').val($(this).data('name'));
            $('#email-send-email-entity').val($(this).data('email'));
            if ($(this).data('logo')) {
                $('#logo-send-email-entity').removeClass('d-none').css('background-image', 'url({{ url('storage/images/companies/logo') }}/' + $(this).data('logo') + ')');
            } else {
                $('#logo-send-email-entity').addClass('d-none').css('background-image', '');
            }
            $('#text-name-send-email-entity').html('Para: <b>' + $(this).data('name') + '</b>');

            $('#modal-send-email-entity').modal('show');
        });

        // enviando e-mail para o condomínio
        $(document).on('click', '#btn-send-email-entity', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-send-email-entity').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-send-email-entity').serialize(),
                    url: '{{ app('router')->has('entity.send.email') ? route('entity.send.email') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        sendEmailEntityAvailable();
                        $('#modal-send-email-entity').modal('hide');
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-send-email-entity').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-send-email-entity').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao enviar o e-mail para o condomínio.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // novo usuário para o condomínio
        $(document).on('click', '.btn-modal-new-entity-user', function (e) {
            e.preventDefault();
            newEntityUserAvailable();

            if ($(this).data('logo')) {
                $('#logo-new-entity-user').removeClass('d-none').css('background-image', 'url({{ url('storage/images/companies/logo') }}/' + $(this).data('logo') + ')');
                $('#text-name-new-entity-user').addClass('ml-5');

                if ($(this).data('name').length > 30) {
                    $('#logo-new-entity-user').addClass('mt-3');
                } else {
                    $('#logo-new-entity-user').removeClass('mt-3');
                }
            } else {
                $('#logo-new-entity-user').addClass('d-none').css('background-image', '');
                $('#text-name-new-entity-user').removeClass('ml-5');
            }

            $('#text-name-new-entity-user').html($(this).data('name'));
            $('#id-company-new-entity-user').val($(this).data('id'));

            $('#modal-new-entity-user').modal('show');
        });

        // salvando novo usuário para o condomínio
        $(document).on('click', '#btn-new-entity-user', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-entity-user').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-entity-user').serialize(),
                    url: '{{ app('router')->has('entity.user.store') ? route('entity.user.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        newEntityUserAvailable();
                        $('#modal-new-entity-user').modal('hide');
                        tableEntitiesUsers.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-entity-user').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-entity-user').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo usuário.');
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
