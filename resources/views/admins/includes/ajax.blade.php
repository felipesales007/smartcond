<script>
    $(function () {
        // variável
        let databaseAdmin   = '#datatable-admins';
        let databaseCompany = '#datatable-companies';

        // tabela de administradores
        let tableAdmins = $(databaseAdmin).DataTable({
            language:    datatables_pt_br,
            dom:         datatables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableAdmins.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [1, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('admin.list') ? route('admin.list') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseAdmin + '_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseAdmin + ' th').on('click', databaseAdmin + ' th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseAdmin, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseAdmin, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseAdmin);
                    }
                }
            },
            columns: [
                { data: 'photo',        name: 'photo', className: 'text-center fe-td-img d-print-none', orderable: false, searchable: false },
                { data: 'name',         name: 'name' },
                { data: 'company_name', name: 'company_name' },
                { data: 'email',        name: 'email' },
                { data: 'date',         name: 'date', searchable: false },
                { data: 'action',       name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableAdmins.draw();
        });

        // tabela de administradores deletados
        let tableAdminsDeleted = $(databaseAdmin + '-deleted').DataTable({
            language:    datatables_pt_br,
            dom:         datatables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableAdminsDeleted.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [1, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('admin.list.deleted') ? route('admin.list.deleted') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseAdmin + '-deleted_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseAdmin + '-deleted th').on('click', databaseAdmin + '-deleted th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseAdmin, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseAdmin, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseAdmin);
                    }
                }
            },
            columns: [
                { data: 'photo',        name: 'photo', className: 'text-center fe-td-img d-print-none', orderable: false, searchable: false },
                { data: 'name',         name: 'name' },
                { data: 'company_name', name: 'company_name' },
                { data: 'email',        name: 'email' },
                { data: 'date',         name: 'date', searchable: false },
                { data: 'action',       name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableAdminsDeleted.draw();
        });

        // modal de novo administrador disponível
        let newAdminAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-admin').removeAttr('disabled', 'disabled').html('Criar administrador');
            $('#company-id-new-admin').val('').trigger('change');
            $('#form-new-admin').trigger('reset');
        };

        // modal de editar administrador disponível
        let editAdminAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-admin').removeAttr('disabled', 'disabled').html('Editar administrador');
            $('#company-id-edit-admin').val('').trigger('change');
            $('#gender-id-edit-admin').val('').trigger('change');
            $('#state-id-edit-admin').val('').trigger('change');
            $('#birthday-edit-admin').val('').datepicker('update');
            $('#form-edit-admin .card-header').attr('aria-expanded', false);
            $('#form-edit-admin .collapse').removeClass('show');
            $('#form-edit-admin').trigger('reset');
        };

        // modal de bloquear administrador disponível
        let blockAdminAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-admin').removeAttr('disabled', 'disabled').html('Bloquear administrador');
            $('#form-block-admin').trigger('reset');
        };

        // modal de deletar administrador disponível
        let deleteAdminAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-admin').removeAttr('disabled', 'disabled').html('Excluir administrador');
            $('#form-delete-admin').trigger('reset');
        };

        // modal de recuperar administrador disponível
        let recoverAdminAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-admin').removeAttr('disabled', 'disabled').html('Recuperar administrador');
            $('#form-recover-admin').trigger('reset');
        };

        // modal de enviar e-mail para o administrador disponível
        let sendEmailAdminAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-send-email-admin').removeAttr('disabled', 'disabled').html('Enviar e-mail');
            $('#form-send-email-admin').trigger('reset');
        };

        // visualizar administrador
        $(document).on('click', '.btn-modal-view-admin', function () {
            let id = $(this).data('id');
            $('#event-view-admin-info').click();

            $.get('{{ app('router')->has('admin.view') ? route('admin.view') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    // capa
                    if (data.background) {
                        $('#background-view-admin').css('background-image', 'url({{ url('storage/images/users/background') }}/' + data.background + ')');
                    } else {
                        $('#background-view-admin').css('background-image', 'url({{ url('images/default/default-background.png') }})');
                    }
                    // status
                    if (data.blocked || data.blocked_at >= moment().format('YYYY-MM-DD') || data.deleted_at) {
                        $('#status-view-admin').removeClass('d-none');

                        if (data.blocked || data.blocked_at) {
                            if (data.blocked) {
                                $('#status-view-admin i').addClass('bg-warning').attr('data-original-title', 'bloqueado');
                            } else {
                                $('#status-view-admin i').addClass('bg-warning').attr('data-original-title', 'bloqueado até ' + timestamp_to_date_br(data.blocked_at));
                            }
                        } else {
                            $('#status-view-admin i').addClass('bg-danger').attr('data-original-title', 'deletado');
                        }
                    } else {
                        $('#status-view-admin').addClass('d-none');
                        $('#status-view-admin i').removeAttr('data-original-title');
                    }
                    // foto
                    if (data.photo) {
                        $('#photo-view-admin').css('background-image', 'url({{ url('storage/images/users/photo') }}/' + data.photo + ')');
                    } else {
                        $('#photo-view-admin').css('background-image', 'url({{ url('images/default/default-user.png') }})');
                    }
                    // nome
                    $('#name-view-admin').html(data.name);
                    // aniversário
                    if (data.birthday) {
                        $('#icon-birthday-view-admin').removeClass('d-none');
                        $('#birthday-view-admin').html('&nbsp;' + date_to_date_br(data.birthday) + ' - ' + calcularIdade(data.birthday) + ' anos');
                    } else {
                        $('#icon-birthday-view-admin').addClass('d-none');
                        $('#birthday-view-admin').html('');
                    }
                    // cpf
                    if (data.cpf) {
                        $('#icon-cpf-view-admin').removeClass('d-none');
                        $('#cpf-view-admin').html(data.cpf);
                    } else {
                        $('#icon-cpf-view-admin').addClass('d-none');
                        $('#cpf-view-admin').html('');
                    }
                    // rg
                    if (data.rg) {
                        $('#icon-rg-view-admin').removeClass('d-none');
                        $('#rg-view-admin').html(data.rg);
                    } else {
                        $('#icon-rg-view-admin').addClass('d-none');
                        $('#rg-view-admin').html('');
                    }
                    // sexo
                    if (data.gender_id) {
                        $('#icon-gender-view-admin').removeClass('d-none');
                        $('#gender-view-admin').html(data.gender);
                    } else {
                        $('#icon-gender-view-admin').addClass('d-none');
                        $('#gender-view-admin').html('');
                    }
                    // profissão
                    if (data.profession || data.company) {
                        $('#icon-profession-view-admin').removeClass('d-none');

                        if (data.profession && data.company) {
                            $('#profession-view-admin').html('&nbsp;' + data.profession);
                            $('#company-view-admin').html(' na ' + data.company);
                        } else if (data.profession && !data.company) {
                            $('#profession-view-admin').html('&nbsp;' + data.profession);
                            $('#company-view-admin').html('');
                        } else if (!data.profession && data.company) {
                            $('#company-view-admin').html('&nbsp;' + data.company);
                            $('#profession-view-admin').html('');
                        }
                    } else {
                        $('#icon-profession-view-admin').addClass('d-none');
                        $('#profession-view-admin').html('');
                        $('#company-view-admin').html('');
                    }
                    // formação
                    if (data.course || data.college) {
                        let gender = 'o';

                        if (data.gender_id === 2) {
                            gender = 'a';
                        }

                        $('#icon-course-view-admin').removeClass('d-none');

                        if (data.course && data.college) {
                            $('#course-view-admin').html('Formad' + gender + ' em ' + data.course);
                            $('#college-view-admin').html(' na ' + data.college);

                        } else if (data.course && !data.company) {
                            $('#course-view-admin').html('Formad' + gender + ' em ' + data.course);
                            $('#college-view-admin').html('');

                        } else if (!data.course && data.company) {
                            $('#college-view-admin').html('Formad' + gender + ' na ' + data.college);
                            $('#course-view-admin').html('');
                        }
                    } else {
                        $('#icon-course-view-admin').addClass('d-none');
                        $('#course-view-admin').html('');
                        $('#college-view-admin').html('');
                    }
                    // descrição
                    if (data.description) {
                        $('#text-description-view-admin').removeClass('d-none');
                        $('#description-view-admin').html(data.description);
                    } else {
                        $('#text-description-view-admin').addClass('d-none');
                        $('#description-view-admin').html('');
                    }
                    // endereço
                    $('#residential-view-admin').removeClass('mb-4 mb-sm-0').addClass('d-none');
                    $('#br-postal-code-view-admin').addClass('d-none');
                    $('#br-address-view-admin').addClass('d-none');
                    $('#br-complement-view-admin').addClass('d-none');
                    $('#br-neighborhood-view-admin').addClass('d-none');
                    if (data.postal_code || data.address || data.house_number || data.complement || data.neighborhood || data.city || data.state_id || data.country) {
                        $('#residential-view-admin').addClass('mb-4 mb-sm-0').removeClass('d-none');

                        if (data.postal_code) {
                            $('#postal-code-view-admin').html(data.postal_code);
                            $('#br-postal-code-view-admin').removeClass('d-none');
                        } else {
                            $('#postal-code-view-admin').html('');
                        }

                        if (data.address) {
                            $('#address-view-admin').html(data.address);
                            $('#br-address-view-admin').removeClass('d-none');
                        } else {
                            $('#address-view-admin').html('');
                        }

                        if (data.house_number) {
                            $('#br-address-view-admin').removeClass('d-none');

                            if (data.address) {
                                $('#house-number-view-admin').html(', nº ' + data.house_number);
                            } else {
                                $('#house-number-view-admin').html('nº ' + data.house_number);
                            }
                        } else {
                            $('#house-number-view-admin').html('');
                        }

                        if (data.complement) {
                            $('#complement-view-admin').html(data.complement);
                            $('#br-complement-view-admin').removeClass('d-none');
                        } else {
                            $('#complement-view-admin').html('');
                        }

                        if (data.neighborhood) {
                            $('#neighborhood-view-admin').html(data.neighborhood);
                            $('#br-neighborhood-view-admin').removeClass('d-none');
                        } else {
                            $('#neighborhood-view-admin').html('');
                        }

                        if (data.city) {
                            $('#br-neighborhood-view-admin').removeClass('d-none');

                            if (data.neighborhood) {
                                $('#city-view-admin').html(', ' + data.city);
                            } else {
                                $('#city-view-admin').html(data.city);
                            }
                        } else {
                            $('#city-view-admin').html('');
                        }

                        if (data.state) {
                            $('#br-neighborhood-view-admin').removeClass('d-none');

                            if (data.neighborhood || data.city) {
                                $('#state-view-admin').html(', ' + data.state);
                            } else {
                                $('#state-view-admin').html(data.state);
                            }
                        } else {
                            $('#state-view-admin').html('');
                        }

                        if (data.country) {
                            $('#br-neighborhood-view-admin').removeClass('d-none');

                            if (data.neighborhood || data.city || data.state) {
                                $('#country-view-admin').html(' - ' + data.country);
                            } else {
                                $('#country-view-admin').html(data.country);
                            }
                        } else {
                            $('#country-view-admin').html('');
                        }
                    } else {
                        $('#postal-code-view-admin').html('');
                        $('#address-view-admin').html('');
                        $('#house-number-view-admin').html('');
                        $('#complement-view-admin').html('');
                        $('#neighborhood-view-admin').html('');
                        $('#city-view-admin').html('');
                        $('#state-view-admin').html('');
                        $('#country-view-admin').html('');
                    }
                    // última conexão em ip
                    if (data.last_login_ip) {
                        $('#last-login-ip-view-admin').html('último ip ' + data.last_login_ip);
                    } else {
                        $('#last-login-ip-view-admin').html('&nbsp;');
                    }
                    // e-mail
                    $('#email-view-admin').html(data.email);
                    // contato
                    $('#contact-view-admin').html(data.contact);
                    // criado
                    $('#created-at-view-admin').html('criado em ' + timestamp_to_date_br(data.created_at) + ' - ' + moment(data.created_at, 'YYYY-MM-DD hh:mm').locale('pt-br').fromNow());
                    // atualizado
                    $('#last-update-at-view-admin').html('atualizado em ' + timestamp_to_date_br(data.last_update_at));
                    // empresa do administrador
                    $('#companies-company-admin').html(data.companies.company);
                    $('#companies-cnpj-admin').html(data.companies.cnpj);
                    if (data.companies.logo) {
                        $('#companies-logo-admin').attr('src', '{{ url('storage/images/companies/logo') }}/' + data.companies.logo);
                    } else {
                        $('#companies-logo-admin').attr('src', '{{ url('images/default/default-logo.png') }}');
                    }

                    $('#modal-view-admin').modal('show');
                }
            });
        });

        // novo administrador
        $(document).on('click', '.btn-modal-new-admin', function (e) {
            e.preventDefault();
            newAdminAvailable();
            $('#modal-new-admin').modal('show');
        });

        // salvando administrador
        $(document).on('click', '#btn-new-admin', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-admin').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-admin').serialize(),
                    url: '{{ app('router')->has('admin.store') ? route('admin.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        newAdminAvailable();
                        $('#modal-new-admin').modal('hide');
                        tableAdmins.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-admin').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-admin').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo administrador.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // editar administrador
        $(document).on('click', '.btn-modal-edit-admin', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('admin.edit') ? route('admin.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    editAdminAvailable();
                    // edição comum
                    $('#id-edit-admin').val(data.id);
                    $('#name-edit-admin').val(data.name);
                    $('#email-edit-admin').val(data.email);
                    $("#company-id-edit-admin").val(data.company_id).trigger('change');
                    // acessar permissões
                    $('#link-permission-edit-admin').attr('href', '{{ app('router')->has('permission.user.edit') ? route('permission.user.edit') : '' }}?id=' + data.id);
                    // imagens
                    $('.fe-image-url-8').val(destination_url(data.id, 'png'));
                    if (data.photo) {
                        $('.fe-remove-preview-8').removeClass('fe-hidden');
                        $('.fe-img-preview-8').attr('src', '{{ url('storage/images/users/photo') }}/' + data.photo);
                    } else {
                        $('.fe-remove-preview-8').addClass('fe-hidden');
                        $('.fe-img-preview-8').attr('src', '');
                    }
                    $('.fe-image-url-9').val(destination_url(data.id, 'png'));
                    if (data.background) {
                        $('.fe-remove-preview-9').removeClass('fe-hidden');
                        $('.fe-img-preview-9').attr('src', '{{ url('storage/images/users/background') }}/' + data.background);
                    } else {
                        $('.fe-remove-preview-9').addClass('fe-hidden');
                        $('.fe-img-preview-9').attr('src', '');
                    }
                    // informações do administrador
                    $('#cpf-edit-admin').val(data.cpf);
                    $('#rg-edit-admin').val(data.rg);
                    if (data.birthday) {
                        $('#birthday-edit-admin').datepicker('setDate', date_to_date_br(data.birthday));
                    }
                    $('#contact-edit-admin').val(data.contact);
                    $('#gender-id-edit-admin').val(data.gender_id).trigger('change');
                    $('#description-edit-admin').val(data.description);
                    // informações acadêmicas
                    $('#course-edit-admin').val(data.course);
                    $('#college-edit-admin').val(data.college);
                    // informações profissionais
                    $('#profession-edit-admin').val(data.profession);
                    $('#company-edit-admin').val(data.company);
                    // informações residenciais
                    $('#postal-code-edit-admin').val(data.postal_code);
                    $('#address-edit-admin').val(data.address);
                    $('#house-number-edit-admin').val(data.house_number);
                    $('#complement-edit-admin').val(data.complement);
                    $('#neighborhood-edit-admin').val(data.neighborhood);
                    $('#city-edit-admin').val(data.city);
                    $('#state-id-edit-admin').val(data.state_id).trigger('change');
                    $('#country-edit-admin').val(data.country);

                    $('#modal-edit-admin').modal('show');
                }
            });
        });

        // editando administrador
        $(document).on('click', '#btn-edit-admin', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-admin').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: new FormData($('#form-edit-admin')[0]),
                    contentType: false,
                    processData: false,
                    url: '{{ app('router')->has('admin.update') ? route('admin.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        editAdminAvailable();
                        $('#modal-edit-admin').modal('hide');
                        tableAdmins.draw();
                        $(databaseCompany + '-admins').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-admin').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-admin').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o administrador.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // bloquear administrador
        $(document).on('click', '.btn-modal-block-admin', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('admin.ban') ? route('admin.ban') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    blockAdminAvailable();
                    $('#id-block-admin').val(data.id);
                    // checkbox
                    if (data.blocked) {
                        $('#blocked-block-admin').prop('checked', true).attr('checked', 'checked');
                    } else {
                        $('#blocked-block-admin').prop('checked', false).removeAttr('checked', 'checked');
                    }
                    // input
                    $('#blocked-at-block-admin').datepicker('setDate', timestamp_to_date_br(data.blocked_at));
                    let name = two_word(data.name);
                    if (data.blocked_at >= moment().format('YYYY-MM-DD')) {
                        $('#blocked-at-block-admin-text').html('Administrador <b class="text-warning">' + name + '</b> bloqueado até ' + timestamp_to_date_br(data.blocked_at));
                    } else {
                        $('#blocked-at-block-admin-text').html('Bloquear <b class="text-warning">' + name + '</b> até uma data determinada');
                    }

                    $('#modal-block-admin').modal('show');
                }
            });
        });

        // bloqueando administrador
        $(document).on('click', '#btn-block-admin', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-block-admin').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-block-admin').serialize(),
                    url: '{{ app('router')->has('admin.block') ? route('admin.block') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        blockAdminAvailable();
                        $('#modal-block-admin').modal('hide');
                        tableAdmins.draw();
                        $(databaseCompany + '-admins').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-block-admin').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-block-admin').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao bloquear o administrador.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // deletar administrador
        $(document).on('click', '.btn-modal-delete-admin', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('admin.delete') ? route('admin.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    deleteAdminAvailable();
                    $('#id-delete-admin').val(data.id);
                    let name = first_word(data.name);
                    $('#name-confirmation-delete-admin-text').html(name);
                    $('#name-delete-admin').val(name);

                    $('#modal-delete-admin').modal('show');
                }
            });
        });

        // deletando administrador
        $(document).on('click', '#btn-delete-admin', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-admin').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-admin').serialize(),
                    url: '{{ app('router')->has('admin.destroy') ? route('admin.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        deleteAdminAvailable();
                        $('#modal-delete-admin').modal('hide');
                        tableAdmins.draw();
                        $(databaseCompany + '-admins').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-admin').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-admin').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o administrador.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // recuperar administrador
        $(document).on('click', '.btn-modal-recover-admin', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('admin.recover') ? route('admin.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    recoverAdminAvailable();
                    $('#id-recover-admin').val(data.id);
                    let name = first_word(data.name);
                    $('#name-confirmation-recover-admin-text').html(name);
                    $('#name-recover-admin').val(name);

                    $('#modal-recover-admin').modal('show');
                }
            });
        });

        // recuperando administrador
        $(document).on('click', '#btn-recover-admin', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-admin').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-admin').serialize(),
                    url: '{{ app('router')->has('admin.restore') ? route('admin.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        recoverAdminAvailable();
                        $('#modal-recover-admin').modal('hide');
                        tableAdminsDeleted.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-admin').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-admin').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o administrador.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // reenviando e-mail de confirmação do administrador
        $(document).on('click', '.btn-resend-email-admin', function (e) {
            e.preventDefault();
            $('.tooltip').remove();
            let btn = $(this).attr('disabled', 'disabled').html('<i class="fas fa-sync-alt fa-pulse"></i>');

            if ($('.form-resend-email-admin').valid()) {
                $.ajax({
                    data: $(this).parent().serialize(),
                    url: '{{ app('router')->has('admin.resend.email') ? route('admin.resend.email') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        btn.removeAttr('disabled', 'disabled').html('<i class="fas fa-sync-alt" data-toggle="tooltip" data-placement="top" title="reenviar e-mail de confirmação para o administrador"></i>');
                        removeValidate();
                        notify(data);
                    },
                    error: function (data) {
                        btn.removeAttr('disabled', 'disabled').html('<i class="fas fa-exclamation-circle" data-toggle="tooltip" data-placement="top" title="ops, ocorreu um erro ao tentar reenviar o e-mail, por favor tente novamente mais tarde"></i>');
                        $('.form-resend-email-admin').valid();
                        serverValidate(data);
                        notifyError('Erro ao reenviar o e-mail de confirmação de e-mail.');
                    }
                });
            } else {
                $(this).removeAttr('disabled', 'disabled').html('<i class="fas fa-exclamation-circle" data-toggle="tooltip" data-placement="top" title="ops, ocorreu um erro ao tentar reenviar o e-mail, por favor tente novamente mais tarde"></i>');
                return false;
            }
        });

        // enviar e-mail para o administrador
        $(document).on('click', '.btn-modal-send-email-admin', function (e) {
            e.preventDefault();
            sendEmailAdminAvailable();
            $('#name-send-email-admin').val($(this).data('name'));
            $('#email-send-email-admin').val($(this).data('email'));
            if ($(this).data('photo')) {
                $('#photo-send-email-admin').removeClass('d-none').css('background-image', 'url({{ url('storage/images/users/photo') }}/' + $(this).data('photo') + ')');
            } else {
                $('#photo-send-email-admin').addClass('d-none').css('background-image', '');
            }
            $('#text-name-send-email-admin').html('Para: <b>' + two_word($(this).data('name')) + '</b>');

            $('#modal-send-email-admin').modal('show');
        });

        // enviando e-mail para o administrador
        $(document).on('click', '#btn-send-email-admin', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-send-email-admin').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-send-email-admin').serialize(),
                    url: '{{ app('router')->has('admin.send.email') ? route('admin.send.email') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        sendEmailAdminAvailable();
                        $('#modal-send-email-admin').modal('hide');
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-send-email-admin').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-send-email-admin').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao enviar o e-mail para o administrador.');
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
