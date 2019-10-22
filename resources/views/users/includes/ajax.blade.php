<script>
    $(function () {
        // variáveis
        let databaseUser = '#datatable-users';
        let databaseEntity = '#datatable-entities';

        // tabela de usuários
        let tableUsers = $(databaseUser).DataTable({
            language:    datatables_pt_br,
            dom:         datatables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableUsers.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [1, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('user.list') ? route('user.list') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseUser + '_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseUser + ' th').on('click', databaseUser + ' th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseUser, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseUser, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseUser);
                    }
                }
            },
            columns: [
                { data: 'photo',       name: 'photo', className: 'text-center fe-td-img d-print-none', orderable: false, searchable: false },
                { data: 'name',        name: 'name' },
                { data: 'entity_name', name: 'entity_name', className: '{{ auth()->user()['admin'] == 0 && count(\App\Models\Entity\Entity::getEntitiesUser()) == 1 ? 'd-none' : '' }}' },
                { data: 'email',       name: 'email' },
                { data: 'date',        name: 'date', searchable: false },
                { data: 'action',      name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableUsers.draw();
        });

        // tabela de usuários deletados
        let tableUsersDeleted = $(databaseUser + '-deleted').DataTable({
            language:    datatables_pt_br,
            dom:         datatables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableUsersDeleted.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [1, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('user.list.deleted') ? route('user.list.deleted') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseUser + '-deleted_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseUser + '-deleted th').on('click', databaseUser + '-deleted th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseUser, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseUser, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseUser);
                    }
                }
            },
            columns: [
                { data: 'photo',       name: 'photo', className: 'text-center fe-td-img d-print-none', orderable: false, searchable: false },
                { data: 'name',        name: 'name' },
                { data: 'entity_name', name: 'entity_name', className: '{{ auth()->user()['admin'] == 0 && count(\App\Models\Entity\Entity::getEntitiesUser()) == 1 ? 'd-none' : '' }}' },
                { data: 'email',       name: 'email' },
                { data: 'date',        name: 'date', searchable: false },
                { data: 'action',      name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableUsersDeleted.draw();
        });

        // modal de novo usuário disponível
        let newUserAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-user').removeAttr('disabled', 'disabled').html('Criar usuário');
            $('#entity-id-new-user').val('').trigger('change');
            $('#form-new-user').trigger('reset');
        };

        // modal de editar usuário disponível
        let editUserAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-user').removeAttr('disabled', 'disabled').html('Editar usuário');
            $('#entity-id-edit-user').val('').trigger('change');
            $('#gender-id-edit-user').val('').trigger('change');
            $('#state-id-edit-user').val('').trigger('change');
            $('#birthday-edit-user').val('').datepicker('update');
            $('#form-edit-user .card-header').attr('aria-expanded', false);
            $('#form-edit-user .collapse').removeClass('show');
            $('#form-edit-user').trigger('reset');
        };

        // modal de bloquear usuário disponível
        let blockUserAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-user').removeAttr('disabled', 'disabled').html('Bloquear usuário');
            $('#form-block-user').trigger('reset');
        };

        // modal de deletar usuário disponível
        let deleteUserAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-user').removeAttr('disabled', 'disabled').html('Excluir usuário');
            $('#form-delete-user').trigger('reset');
        };

        // modal de recuperar usuário disponível
        let recoverUserAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-user').removeAttr('disabled', 'disabled').html('Recuperar usuário');
            $('#form-recover-user').trigger('reset');
        };

        // modal de enviar e-mail para o usuário disponível
        let sendEmailUserAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-send-email-user').removeAttr('disabled', 'disabled').html('Enviar e-mail');
            $('#form-send-email-user').trigger('reset');
        };

        // visualizar usuário
        $(document).on('click', '.btn-modal-view-user', function () {
            let id = $(this).data('id');
            $('#event-view-user-info').click();

            $.get('{{ app('router')->has('user.view') ? route('user.view') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    // capa
                    if (data.background) {
                        $('#background-view-user').css('background-image', 'url({{ url('storage/images/users/background') }}/' + data.background + ')');
                    } else {
                        $('#background-view-user').css('background-image', 'url({{ url('images/default/default-background.png') }})');
                    }
                    // status
                    if (data.blocked || data.blocked_at >= moment().format('YYYY-MM-DD') || data.deleted_at) {
                        $('#status-view-user').removeClass('d-none');

                        if (data.blocked || data.blocked_at) {
                            if (data.blocked) {
                                $('#status-view-user i').addClass('bg-warning').attr('data-original-title', 'bloqueado');
                            } else {
                                $('#status-view-user i').addClass('bg-warning').attr('data-original-title', 'bloqueado até ' + timestamp_to_date_br(data.blocked_at));
                            }
                        } else {
                            $('#status-view-user i').addClass('bg-danger').attr('data-original-title', 'deletado');
                        }
                    } else {
                        $('#status-view-user').addClass('d-none');
                        $('#status-view-user i').removeAttr('data-original-title');
                    }
                    // foto
                    if (data.photo) {
                        $('#photo-view-user').css('background-image', 'url({{ url('storage/images/users/photo') }}/' + data.photo + ')');
                    } else {
                        $('#photo-view-user').css('background-image', 'url({{ url('images/default/default-user.png') }})');
                    }
                    // nome
                    $('#name-view-user').html(data.name);
                    // aniversário
                    if (data.birthday) {
                        $('#icon-birthday-view-user').removeClass('d-none');
                        $('#birthday-view-user').html('&nbsp;' + date_to_date_br(data.birthday) + ' - ' + calcularIdade(data.birthday) + ' anos');
                    } else {
                        $('#icon-birthday-view-user').addClass('d-none');
                        $('#birthday-view-user').html('');
                    }
                    // cpf
                    if (data.cpf) {
                        $('#icon-cpf-view-user').removeClass('d-none');
                        $('#cpf-view-user').html(data.cpf);
                    } else {
                        $('#icon-cpf-view-user').addClass('d-none');
                        $('#cpf-view-user').html('');
                    }
                    // rg
                    if (data.rg) {
                        $('#icon-rg-view-user').removeClass('d-none');
                        $('#rg-view-user').html(data.rg);
                    } else {
                        $('#icon-rg-view-user').addClass('d-none');
                        $('#rg-view-user').html('');
                    }
                    // sexo
                    if (data.gender_id) {
                        $('#icon-gender-view-user').removeClass('d-none');
                        $('#gender-view-user').html(data.gender);
                    } else {
                        $('#icon-gender-view-user').addClass('d-none');
                        $('#gender-view-user').html('');
                    }
                    // profissão
                    if (data.profession || data.company) {
                        $('#icon-profession-view-user').removeClass('d-none');

                        if (data.profession && data.company) {
                            $('#profession-view-user').html('&nbsp;' + data.profession);
                            $('#company-view-user').html(' na ' + data.company);
                        } else if (data.profession && !data.company) {
                            $('#profession-view-user').html('&nbsp;' + data.profession);
                            $('#company-view-user').html('');
                        } else if (!data.profession && data.company) {
                            $('#company-view-user').html('&nbsp;' + data.company);
                            $('#profession-view-user').html('');
                        }
                    } else {
                        $('#icon-profession-view-user').addClass('d-none');
                        $('#profession-view-user').html('');
                        $('#company-view-user').html('');
                    }
                    // formação
                    if (data.course || data.college) {
                        let gender = 'o';

                        if (data.gender_id === 2) {
                            gender = 'a';
                        }

                        $('#icon-course-view-user').removeClass('d-none');

                        if (data.course && data.college) {
                            $('#course-view-user').html('Formad' + gender + ' em ' + data.course);
                            $('#college-view-user').html(' na ' + data.college);

                        } else if (data.course && !data.company) {
                            $('#course-view-user').html('Formad' + gender + ' em ' + data.course);
                            $('#college-view-user').html('');

                        } else if (!data.course && data.company) {
                            $('#college-view-user').html('Formad' + gender + ' na ' + data.college);
                            $('#course-view-user').html('');
                        }
                    } else {
                        $('#icon-course-view-user').addClass('d-none');
                        $('#course-view-user').html('');
                        $('#college-view-user').html('');
                    }
                    // descrição
                    if (data.description) {
                        $('#text-description-view-user').removeClass('d-none');
                        $('#description-view-user').html(data.description);
                    } else {
                        $('#text-description-view-user').addClass('d-none');
                        $('#description-view-user').html('');
                    }
                    // endereço
                    $('#residential-view-user').removeClass('mb-4 mb-sm-0').addClass('d-none');
                    $('#br-postal-code-view-user').addClass('d-none');
                    $('#br-address-view-user').addClass('d-none');
                    $('#br-complement-view-user').addClass('d-none');
                    $('#br-neighborhood-view-user').addClass('d-none');
                    if (data.postal_code || data.address || data.house_number || data.complement || data.neighborhood || data.city || data.state_id || data.country) {
                        $('#residential-view-user').addClass('mb-4 mb-sm-0').removeClass('d-none');

                        if (data.postal_code) {
                            $('#postal-code-view-user').html(data.postal_code);
                            $('#br-postal-code-view-user').removeClass('d-none');
                        } else {
                            $('#postal-code-view-user').html('');
                        }

                        if (data.address) {
                            $('#address-view-user').html(data.address);
                            $('#br-address-view-user').removeClass('d-none');
                        } else {
                            $('#address-view-user').html('');
                        }

                        if (data.house_number) {
                            $('#br-address-view-user').removeClass('d-none');

                            if (data.address) {
                                $('#house-number-view-user').html(', nº ' + data.house_number);
                            } else {
                                $('#house-number-view-user').html('nº ' + data.house_number);
                            }
                        } else {
                            $('#house-number-view-user').html('');
                        }

                        if (data.complement) {
                            $('#complement-view-user').html(data.complement);
                            $('#br-complement-view-user').removeClass('d-none');
                        } else {
                            $('#complement-view-user').html('');
                        }

                        if (data.neighborhood) {
                            $('#neighborhood-view-user').html(data.neighborhood);
                            $('#br-neighborhood-view-user').removeClass('d-none');
                        } else {
                            $('#neighborhood-view-user').html('');
                        }

                        if (data.city) {
                            $('#br-neighborhood-view-user').removeClass('d-none');

                            if (data.neighborhood) {
                                $('#city-view-user').html(', ' + data.city);
                            } else {
                                $('#city-view-user').html(data.city);
                            }
                        } else {
                            $('#city-view-user').html('');
                        }

                        if (data.state) {
                            $('#br-neighborhood-view-user').removeClass('d-none');

                            if (data.neighborhood || data.city) {
                                $('#state-view-user').html(', ' + data.state);
                            } else {
                                $('#state-view-user').html(data.state);
                            }
                        } else {
                            $('#state-view-user').html('');
                        }

                        if (data.country) {
                            $('#br-neighborhood-view-user').removeClass('d-none');

                            if (data.neighborhood || data.city || data.state) {
                                $('#country-view-user').html(' - ' + data.country);
                            } else {
                                $('#country-view-user').html(data.country);
                            }
                        } else {
                            $('#country-view-user').html('');
                        }
                    } else {
                        $('#postal-code-view-user').html('');
                        $('#address-view-user').html('');
                        $('#house-number-view-user').html('');
                        $('#complement-view-user').html('');
                        $('#neighborhood-view-user').html('');
                        $('#city-view-user').html('');
                        $('#state-view-user').html('');
                        $('#country-view-user').html('');
                    }
                    // última conexão em ip
                    if (data.last_login_ip) {
                        $('#last-login-ip-view-user').html('último ip ' + data.last_login_ip);
                    } else {
                        $('#last-login-ip-view-user').html('&nbsp;');
                    }
                    // e-mail
                    $('#email-view-user').html(data.email);
                    // contato
                    $('#contact-view-user').html(data.contact);
                    // criado
                    $('#created-at-view-user').html('criado em ' + timestamp_to_date_br(data.created_at) + ' - ' + moment(data.created_at, 'YYYY-MM-DD hh:mm').locale('pt-br').fromNow());
                    // atualizado
                    $('#last-update-at-view-user').html('atualizado em ' + timestamp_to_date_br(data.last_update_at));
                    // condomínio do usuário
                    $('#scroll-user-view-entity').html('');
                    $.each(data.entities, function(index, value) {
                        let html = '';
                        html += '<a href="javascript:void(0)" class="list-group-item list-group-item-action fe-mouse-default">';
                        html += '<div class="row align-items-center">';
                        html += '<div class="col-auto">';
                        html += '<div class="avatar avatar-sm">';
                        if (value.logo) {
                            html += '<img src="' + url_public('storage/images/companies/logo/' + value.logo) + '" class="fe-img-list-view" alt="">';
                        } else {
                            html += '<img src="' + url_public('images/default/default-logo.png') + '" class="fe-img-list-view" alt="">';
                        }
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="col ml--2">';
                        html += '<div class="d-flex justify-content-between align-items-center">';
                        html += '<h4 class="mb-0 text-sm">' + value.entity + '</h4>';
                        if (value.preferred) {
                            html += '<i hidden class="fas fa-star text-yellow opacity-8" data-toggle="tooltip" data-placement="left" title="Condomínio principal"></i>';
                        }
                        html += '</div>';
                        html += '<p class="text-sm mb-0">' + value.cnpj + '</p>';
                        html += '</div>';
                        html += '</div>';
                        html += '</a>';

                        $('#scroll-user-view-entity').append(html);
                    });

                    $('#modal-view-user').modal('show');
                }
            });
        });

        // novo usuário
        $(document).on('click', '.btn-modal-new-user', function (e) {
            e.preventDefault();
            newUserAvailable();
            $('#modal-new-user').modal('show');
        });

        // salvando usuário
        $(document).on('click', '#btn-new-user', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-user').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-user').serialize(),
                    url: '{{ app('router')->has('user.store') ? route('user.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        newUserAvailable();
                        $('#modal-new-user').modal('hide');
                        tableUsers.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-user').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-user').valid();
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

        // editar usuário
        $(document).on('click', '.btn-modal-edit-user', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('user.edit') ? route('user.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    editUserAvailable();
                    // edição comum
                    $('#id-edit-user').val(data.id);
                    $('#name-edit-user').val(data.name);
                    $('#email-edit-user').val(data.email);
                    $("#entity-id-edit-user").select2().val(data.entity_id).trigger('change');
                    // acessar permissões
                    $('#link-permission-edit-user').attr('href', '{{ app('router')->has('permission.user.edit') ? route('permission.user.edit') : '' }}?id=' + data.id);
                    // imagens
                    $('.fe-image-url-2').val(destination_url(data.id, 'png'));
                    if (data.photo) {
                        $('.fe-remove-preview-2').removeClass('fe-hidden');
                        $('.fe-img-preview-2').attr('src', '{{ url('storage/images/users/photo') }}/' + data.photo);
                    } else {
                        $('.fe-remove-preview-2').addClass('fe-hidden');
                        $('.fe-img-preview-2').attr('src', '');
                    }
                    $('.fe-image-url-3').val(destination_url(data.id, 'png'));
                    if (data.background) {
                        $('.fe-remove-preview-3').removeClass('fe-hidden');
                        $('.fe-img-preview-3').attr('src', '{{ url('storage/images/users/background') }}/' + data.background);
                    } else {
                        $('.fe-remove-preview-3').addClass('fe-hidden');
                        $('.fe-img-preview-3').attr('src', '');
                    }
                    // informações do usuário
                    $('#cpf-edit-user').val(data.cpf);
                    $('#rg-edit-user').val(data.rg);
                    if (data.birthday) {
                        $('#birthday-edit-user').datepicker('setDate', date_to_date_br(data.birthday));
                    }
                    $('#contact-edit-user').val(data.contact);
                    $('#gender-id-edit-user').val(data.gender_id).trigger('change');
                    $('#description-edit-user').val(data.description);
                    // informações acadêmicas
                    $('#course-edit-user').val(data.course);
                    $('#college-edit-user').val(data.college);
                    // informações profissionais
                    $('#profession-edit-user').val(data.profession);
                    $('#company-edit-user').val(data.company);
                    // informações residenciais
                    $('#postal-code-edit-user').val(data.postal_code);
                    $('#address-edit-user').val(data.address);
                    $('#house-number-edit-user').val(data.house_number);
                    $('#complement-edit-user').val(data.complement);
                    $('#neighborhood-edit-user').val(data.neighborhood);
                    $('#city-edit-user').val(data.city);
                    $('#state-id-edit-user').val(data.state_id).trigger('change');
                    $('#country-edit-user').val(data.country);

                    $('#modal-edit-user').modal('show');
                }
            });
        });

        // editando usuário
        $(document).on('click', '#btn-edit-user', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-user').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: new FormData($('#form-edit-user')[0]),
                    contentType: false,
                    processData: false,
                    url: '{{ app('router')->has('user.update') ? route('user.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        editUserAvailable();
                        $('#modal-edit-user').modal('hide');
                        tableUsers.draw();
                        $(databaseEntity + '-users').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-user').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-user').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o usuário.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // bloquear usuário
        $(document).on('click', '.btn-modal-block-user', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('user.ban') ? route('user.ban') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    blockUserAvailable();
                    $('#id-block-user').val(data.id);
                    // checkbox
                    if (data.blocked) {
                        $('#blocked-block-user').prop('checked', true).attr('checked', 'checked');
                    } else {
                        $('#blocked-block-user').prop('checked', false).removeAttr('checked', 'checked');
                    }
                    // input
                    $('#blocked-at-block-user').datepicker('setDate', timestamp_to_date_br(data.blocked_at));
                    let name = two_word(data.name);
                    if (data.blocked_at >= moment().format('YYYY-MM-DD')) {
                        $('#blocked-at-block-user-text').html('Usuário <b class="text-warning">' + name + '</b> bloqueado até ' + timestamp_to_date_br(data.blocked_at));
                    } else {
                        $('#blocked-at-block-user-text').html('Bloquear <b class="text-warning">' + name + '</b> até uma data determinada');
                    }

                    $('#modal-block-user').modal('show');
                }
            });
        });

        // bloqueando usuário
        $(document).on('click', '#btn-block-user', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-block-user').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-block-user').serialize(),
                    url: '{{ app('router')->has('user.block') ? route('user.block') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        blockUserAvailable();
                        $('#modal-block-user').modal('hide');
                        tableUsers.draw();
                        $(databaseEntity + '-users').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-block-user').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-block-user').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao bloquear o usuário.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // deletar usuário
        $(document).on('click', '.btn-modal-delete-user', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('user.delete') ? route('user.delete') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    deleteUserAvailable();
                    $('#id-delete-user').val(data.id);
                    let name = first_word(data.name);
                    $('#name-confirmation-delete-user-text').html(name);
                    $('#name-delete-user').val(name);

                    $('#modal-delete-user').modal('show');
                }
            });
        });

        // deletando usuário
        $(document).on('click', '#btn-delete-user', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-delete-user').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-delete-user').serialize(),
                    url: '{{ app('router')->has('user.destroy') ? route('user.destroy') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        deleteUserAvailable();
                        $('#modal-delete-user').modal('hide');
                        tableUsers.draw();
                        $(databaseEntity + '-users').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-delete-user').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-delete-user').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao deletar o usuário.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // recuperar usuário
        $(document).on('click', '.btn-modal-recover-user', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('user.recover') ? route('user.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    recoverUserAvailable();
                    $('#id-recover-user').val(data.id);
                    let name = first_word(data.name);
                    $('#name-confirmation-recover-user-text').html(name);
                    $('#name-recover-user').val(name);

                    $('#modal-recover-user').modal('show');
                }
            });
        });

        // recuperando usuário
        $(document).on('click', '#btn-recover-user', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-user').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-user').serialize(),
                    url: '{{ app('router')->has('user.restore') ? route('user.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        recoverUserAvailable();
                        $('#modal-recover-user').modal('hide');
                        tableUsersDeleted.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-user').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-user').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o usuário.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // reenviando e-mail de confirmação do usuário
        $(document).on('click', '.btn-resend-email-user', function (e) {
            e.preventDefault();
            $('.tooltip').remove();
            let btn = $(this).attr('disabled', 'disabled').html('<i class="fas fa-sync-alt fa-pulse"></i>');

            if ($('.form-resend-email-user').valid()) {
                $.ajax({
                    data: $(this).parent().serialize(),
                    url: '{{ app('router')->has('user.resend.email') ? route('user.resend.email') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        btn.removeAttr('disabled', 'disabled').html('<i class="fas fa-sync-alt" data-toggle="tooltip" data-placement="top" title="reenviar e-mail de confirmação para o usuário"></i>');
                        removeValidate();
                        notify(data);
                    },
                    error: function (data) {
                        btn.removeAttr('disabled', 'disabled').html('<i class="fas fa-exclamation-circle" data-toggle="tooltip" data-placement="top" title="ops, ocorreu um erro ao tentar reenviar o e-mail, por favor tente novamente mais tarde"></i>');
                        $('.form-resend-email-user').valid();
                        serverValidate(data);
                        notifyError('Erro ao reenviar o e-mail de confirmação de e-mail.');
                    }
                });
            } else {
                $(this).removeAttr('disabled', 'disabled').html('<i class="fas fa-exclamation-circle" data-toggle="tooltip" data-placement="top" title="ops, ocorreu um erro ao tentar reenviar o e-mail, por favor tente novamente mais tarde"></i>');
                return false;
            }
        });

        // enviar e-mail para o usuário
        $(document).on('click', '.btn-modal-send-email-user', function (e) {
            e.preventDefault();
            sendEmailUserAvailable();
            $('#name-send-email-user').val($(this).data('name'));
            $('#email-send-email-user').val($(this).data('email'));
            if ($(this).data('photo')) {
                $('#photo-send-email-user').removeClass('d-none').css('background-image', 'url({{ url('storage/images/users/photo') }}/' + $(this).data('photo') + ')');
            } else {
                $('#photo-send-email-user').addClass('d-none').css('background-image', '');
            }
            $('#text-name-send-email-user').html('Para: <b>' + two_word($(this).data('name')) + '</b>');

            $('#modal-send-email-user').modal('show');
        });

        // enviando e-mail para o usuário
        $(document).on('click', '#btn-send-email-user', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-send-email-user').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-send-email-user').serialize(),
                    url: '{{ app('router')->has('user.send.email') ? route('user.send.email') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        sendEmailUserAvailable();
                        $('#modal-send-email-user').modal('hide');
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-send-email-user').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-send-email-user').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao enviar o e-mail para o usuário.');
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
