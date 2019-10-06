<script>
    $(function () {
        // tabela
        let databaseCompany = '#datatable-companies';
        let tableCompanies  = $(databaseCompany).DataTable({
            language:    dataTables_pt_br,
            dom:         dataTables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableCompanies.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [1, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('company.list') ? route('company.list') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseCompany + '_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseCompany + ' th').on('click', databaseCompany + ' th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseCompany, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseCompany, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseCompany);
                    }
                }
            },
            columns: [
                { data: 'logo',    name: 'logo', className: 'text-center fe-td-img d-print-none', orderable: false, searchable: false },
                { data: 'name',    name: 'name' },
                { data: 'email',   name: 'email' },
                { data: 'contact', name: 'contact' },
                { data: 'cnpj',    name: 'cnpj' },
                { data: 'action',  name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableCompanies.draw();
        });

        // tabela
        let tableCompaniesDeleted = $(databaseCompany + '-deleted').DataTable({
            language:    dataTables_pt_br,
            dom:         dataTables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableCompaniesDeleted.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [1, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('company.list.deleted') ? route('company.list.deleted') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseCompany + '-deleted_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseCompany + '-deleted th').on('click', databaseCompany + '-deleted th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseCompany, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseCompany, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseCompany);
                    }
                }
            },
            columns: [
                { data: 'logo',    name: 'logo', className: 'text-center fe-td-img d-print-none', orderable: false, searchable: false },
                { data: 'name',    name: 'name' },
                { data: 'email',   name: 'email' },
                { data: 'contact', name: 'contact' },
                { data: 'cnpj',    name: 'cnpj' },
                { data: 'action',  name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableCompaniesDeleted.draw();
        });

        // modal de nova empresa disponível
        let newCompanyAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-company').removeAttr('disabled', 'disabled').html('Criar empresa');
            $('.fe-remove-preview-4').addClass('fe-hidden');
            $('.fe-img-preview-4').attr('src', '');
            $('#state-id-new-company').val('').trigger('change');
            $('#form-new-company').trigger('reset');
        };

        // modal de editar empresa disponível
        let editCompanyAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-company').removeAttr('disabled', 'disabled').html('Editar empresa');
            $('#state-id-edit-company').val('').trigger('change');
            $('#form-edit-company').trigger('reset');
        };

        // modal de bloquear empresa disponível
        let blockCompanyAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-company').removeAttr('disabled', 'disabled').html('Bloquear empresa');
            $('#form-block-company').trigger('reset');
        };

        // modal de deletar empresa disponível
        let deleteCompanyAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-company').removeAttr('disabled', 'disabled').html('Excluir empresa');
            $('#form-delete-company').trigger('reset');
        };

        // modal de recuperar empresa disponível
        let recoverCompanyAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-company').removeAttr('disabled', 'disabled').html('Recuperar empresa');
            $('#form-recover-company').trigger('reset');
        };

        // modal de enviar e-mail para a empresa disponível
        let sendEmailCompanyAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-send-email-company').removeAttr('disabled', 'disabled').html('Enviar e-mail');
            $('#form-send-email-company').trigger('reset');
        };

        // visualizar empresa
        $(document).on('click', '.btn-modal-view-company', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('company.view') ? route('company.view') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    // capa
                    $('#background-view-company').css('background-image', 'url({{ url('img/default/default-background.png') }})');
                    // status
                    if (data.blocked || data.blocked_at >= moment().format('YYYY-MM-DD') || data.deleted_at) {
                        $('#status-view-company').removeClass('d-none');

                        if (data.blocked || data.blocked_at) {
                            if (data.blocked) {
                                $('#status-view-company i').addClass('bg-warning').attr('data-original-title', 'bloqueada');
                            } else {
                                $('#status-view-company i').addClass('bg-warning').attr('data-original-title', 'bloqueada até ' + timestamp_to_date_br(data.blocked_at));
                            }
                        } else {
                            $('#status-view-company i').addClass('bg-danger').attr('data-original-title', 'deletada');
                        }
                    } else {
                        $('#status-view-company').addClass('d-none');
                        $('#status-view-company i').removeAttr('data-original-title');
                    }
                    // foto
                    if (data.logo) {
                        $('#logo-view-company').css('background-image', 'url({{ url('storage/img/companies/logo') }}/' + data.logo + ')');
                    } else {
                        $('#logo-view-company').css('background-image', 'url({{ url('img/default/default-logo.png') }})');
                    }
                    // nome
                    $('#name-view-company').html(data.name);
                    // cnpj
                    $('#cnpj-view-company').html(data.cnpj);
                    // razão social
                    $('#corporate-name-view-company').html(data.corporate_name);
                    // endereço
                    $('#residential-view-company').removeClass('mb-4 mb-sm-0').addClass('d-none');
                    $('#br-postal-code-view-company').addClass('d-none');
                    $('#br-address-view-company').addClass('d-none');
                    $('#br-complement-view-company').addClass('d-none');
                    $('#br-neighborhood-view-company').addClass('d-none');
                    if (data.postal_code || data.address || data.house_number || data.complement || data.neighborhood || data.city || data.state_id || data.country) {
                        $('#residential-view-company').addClass('mb-4 mb-sm-0').removeClass('d-none');

                        if (data.postal_code) {
                            $('#postal-code-view-company').html(data.postal_code);
                            $('#br-postal-code-view-company').removeClass('d-none');
                        } else {
                            $('#postal-code-view-company').html('');
                        }

                        if (data.address) {
                            $('#address-view-company').html(data.address);
                            $('#br-address-view-company').removeClass('d-none');
                        } else {
                            $('#address-view-company').html('');
                        }

                        if (data.house_number) {
                            $('#br-address-view-company').removeClass('d-none');

                            if (data.address) {
                                $('#house-number-view-company').html(', nº ' + data.house_number);
                            } else {
                                $('#house-number-view-company').html('nº ' + data.house_number);
                            }
                        } else {
                            $('#house-number-view-company').html('');
                        }

                        if (data.complement) {
                            $('#complement-view-company').html(data.complement);
                            $('#br-complement-view-company').removeClass('d-none');
                        } else {
                            $('#complement-view-company').html('');
                        }

                        if (data.neighborhood) {
                            $('#neighborhood-view-company').html(data.neighborhood);
                            $('#br-neighborhood-view-company').removeClass('d-none');
                        } else {
                            $('#neighborhood-view-company').html('');
                        }

                        if (data.city) {
                            $('#br-neighborhood-view-company').removeClass('d-none');

                            if (data.neighborhood) {
                                $('#city-view-company').html(', ' + data.city);
                            } else {
                                $('#city-view-company').html(data.city);
                            }
                        } else {
                            $('#city-view-company').html('');
                        }

                        if (data.state) {
                            $('#br-neighborhood-view-company').removeClass('d-none');

                            if (data.neighborhood || data.city) {
                                $('#state-view-company').html(', ' + data.state);
                            } else {
                                $('#state-view-company').html(data.state);
                            }
                        } else {
                            $('#state-view-company').html('');
                        }

                        if (data.country) {
                            $('#br-neighborhood-view-company').removeClass('d-none');

                            if (data.neighborhood || data.city || data.state) {
                                $('#country-view-company').html(' - ' + data.country);
                            } else {
                                $('#country-view-company').html(data.country);
                            }
                        } else {
                            $('#country-view-company').html('');
                        }
                    } else {
                        $('#postal-code-view-company').html('');
                        $('#address-view-company').html('');
                        $('#house-number-view-company').html('');
                        $('#complement-view-company').html('');
                        $('#neighborhood-view-company').html('');
                        $('#city-view-company').html('');
                        $('#state-view-company').html('');
                        $('#country-view-company').html('');
                    }
                    // e-mail
                    $('#email-view-company').html(data.email);
                    // contato
                    $('#contact-view-company').html(data.contact);
                    // criado
                    $('#created-at-view-company').html('criado em ' + timestamp_to_date_br(data.created_at) + ' - ' + moment(data.created_at, 'YYYY-MM-DD hh:mm').locale('pt-br').fromNow());
                    // atualizado
                    $('#last-update-at-view-company').html('atualizado em ' + timestamp_to_date_br(data.last_update_at));

                    $('#modal-view-company').modal('show');
                }
            });
        });

        // nova empresa
        $(document).on('click', '.btn-modal-new-company', function (e) {
            e.preventDefault();
            newCompanyAvailable();
            $('#modal-new-company').modal('show');
        });

        // salvando empresa
        $(document).on('click', '#btn-new-company', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-company').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: new FormData($('#form-new-company')[0]),
                    contentType: false,
                    processData: false,
                    url: '{{ app('router')->has('company.store') ? route('company.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        newCompanyAvailable();
                        $('#modal-new-company').modal('hide');
                        tableCompanies.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-company').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-company').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar uma nova empresa.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // editar empresa
        $(document).on('click', '.btn-modal-edit-company', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('company.edit') ? route('company.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    editCompanyAvailable();
                    // logo
                    $('.fe-image-url-5').val(destination_url(data.id, 'png'));
                    if (data.logo) {
                        $('.fe-remove-preview-5').removeClass('fe-hidden');
                        $('.fe-img-preview-5').attr('src', '{{ url('storage/img/companies/logo') }}/' + data.logo);
                    } else {
                        $('.fe-remove-preview-5').addClass('fe-hidden');
                        $('.fe-img-preview-5').attr('src', '');
                    }
                    // dados
                    $('#id-edit-company').val(data.id);
                    $('#cnpj-edit-company').val(data.cnpj);
                    $('#name-edit-company').val(data.name);
                    $('#corporate-name-edit-company').val(data.corporate_name);
                    // responsável
                    $('#email-edit-company').val(data.email);
                    $('#contact-edit-company').val(data.contact);
                    // residenciais
                    $('#postal-code-edit-company').val(data.postal_code);
                    $('#address-edit-company').val(data.address);
                    $('#house-number-edit-company').val(data.house_number);
                    $('#complement-edit-company').val(data.complement);
                    $('#neighborhood-edit-company').val(data.neighborhood);
                    $('#city-edit-company').val(data.city);
                    $('#state-id-edit-company').val(data.state_id).trigger('change');
                    $('#country-edit-company').val(data.country);
                }

                $('#modal-edit-company').modal('show');
            });
        });

        // editando empresa
        $(document).on('click', '#btn-edit-company', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-company').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: new FormData($('#form-edit-company')[0]),
                    contentType: false,
                    processData: false,
                    url: '{{ app('router')->has('company.update') ? route('company.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        editCompanyAvailable();
                        $('#modal-edit-company').modal('hide');
                        tableCompanies.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-company').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-company').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar a empresa.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // bloquear empresa
        $(document).on('click', '.btn-modal-block-company', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('company.ban') ? route('company.ban') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    blockCompanyAvailable();
                    $('#id-block-company').val(data.id);
                    // checkbox
                    if (data.blocked) {
                        $('#blocked-block-company').prop('checked', true).attr('checked', 'checked');
                    } else {
                        $('#blocked-block-company').prop('checked', false).removeAttr('checked', 'checked');
                    }
                    // input
                    $('#blocked-at-block-company').datepicker('setDate', timestamp_to_date_br(data.blocked_at));
                    if (data.blocked_at >= moment().format('YYYY-MM-DD')) {
                        $('#blocked-at-block-company-text').html('Empresa <b class="text-warning">' + data.name + '</b> bloqueada até ' + timestamp_to_date_br(data.blocked_at));
                    } else {
                        $('#blocked-at-block-company-text').html('Bloquear <b class="text-warning">' + data.name + '</b> até uma data determinada');
                    }

                    $('#modal-block-company').modal('show');
                }
            });
        });

        // bloqueando empresa
        $(document).on('click', '#btn-block-company', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-block-company').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-block-company').serialize(),
                    url: '{{ app('router')->has('company.block') ? route('company.block') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        blockCompanyAvailable();
                        $('#modal-block-company').modal('hide');
                        tableCompanies.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-block-company').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-block-company').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao bloquear a empresa.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // deletar empresa
        $(document).on('click', '.btn-modal-delete-company', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('company.delete') ? route('company.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    deleteCompanyAvailable();
                    $('#id-delete-company').val(data.id);
                    $('#name-confirmation-delete-company-text').html(data.name);
                    $('#name-delete-company').val(data.name);

                    $('#modal-delete-company').modal('show');
                }
            });
        });

        // deletando empresa
        $(document).on('click', '#btn-delete-company', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-company').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-company').serialize(),
                    url: '{{ app('router')->has('company.destroy') ? route('company.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        deleteCompanyAvailable();
                        $('#modal-delete-company').modal('hide');
                        tableCompanies.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-company').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-company').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar a empresa.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // recuperar empresa
        $(document).on('click', '.btn-modal-recover-company', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('company.recover') ? route('company.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    recoverCompanyAvailable();
                    $('#id-recover-company').val(data.id);
                    $('#name-confirmation-recover-company-text').html(data.name);
                    $('#name-recover-company').val(data.name);

                    $('#modal-recover-company').modal('show');
                }
            });
        });

        // recuperando empresa
        $(document).on('click', '#btn-recover-company', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-company').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-company').serialize(),
                    url: '{{ app('router')->has('company.restore') ? route('company.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        recoverCompanyAvailable();
                        $('#modal-recover-company').modal('hide');
                        tableCompaniesDeleted.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-company').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-company').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar a empresa.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // enviar e-mail para a empresa
        $(document).on('click', '.btn-modal-send-email-company', function (e) {
            e.preventDefault();
            sendEmailCompanyAvailable();
            $('#name-send-email-company').val($(this).data('name'));
            $('#email-send-email-company').val($(this).data('email'));
            if ($(this).data('logo')) {
                $('#logo-send-email-company').removeClass('d-none').css('background-image', 'url({{ url('storage/img/companies/logo') }}/' + $(this).data('logo') + ')');
            } else {
                $('#logo-send-email-company').addClass('d-none').css('background-image', '');
            }
            $('#text-name-send-email-company').html('Para: <b>' + $(this).data('name') + '</b>');

            $('#modal-send-email-company').modal('show');
        });

        // enviando e-mail para a empresa
        $(document).on('click', '#btn-send-email-company', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-send-email-company').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-send-email-company').serialize(),
                    url: '{{ app('router')->has('company.send.email') ? route('company.send.email') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        sendEmailCompanyAvailable();
                        $('#modal-send-email-company').modal('hide');
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-send-email-company').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-send-email-company').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao enviar o e-mail para a empresa.');
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
