<script>
    $(function () {
        // tabela
        let databaseResident = '#datatable-residents';
        let tableResidents   = $(databaseResident).DataTable({
            language:    dataTables_pt_br,
            dom:         dataTables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableResidents.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [1, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('resident.list') ? route('resident.list') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseResident + '_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseResident + ' th').on('click', databaseResident + ' th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseResident, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseResident, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseResident);
                    }
                }
            },
            columns: [
                { data: 'photo',  name: 'photo', className: 'text-center fe-td-img d-print-none', orderable: false, searchable: false },
                { data: 'name',   name: 'name' },
                { data: 'email',  name: 'email' },
                { data: 'date',   name: 'date', searchable: false },
                { data: 'action', name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableResidents.draw();
        });

        // tabela
        let tableResidentsDeleted = $(databaseResident + '-deleted').DataTable({
            language:    dataTables_pt_br,
            dom:         dataTables_edited_button,
            buttons: [
                { extend: 'print', text: '<i class="fas fa-print"></i>', autoPrint: true },
                { extend: 'print', text: '<i class="fas fa-sync"></i>', action: function (e) { tableResidentsDeleted.draw(); animateItem(e.target, 'fa-pulse'); }}
            ],
            lengthMenu:  [[5, 10, 15, 20, 25, 30, 40, 50, 100, -1], ['5', '10', '15', '20', '25', '30', '40', '50', '100', 'todos']],
            pageLength:  10,
            order:       [1, 'asc'],
            stateSave:   true,
            processing:  true,
            serverSide:  true,
            deferRender: true,
            ajax: {
                url: '{{ app('router')->has('resident.list.deleted') ? route('resident.list.deleted') : url('/') }}',
                data: {
                    search: function () {
                        return $(databaseResident + '-deleted_filter input').val();
                    },
                    orderBy: function () {
                        $(document).off('click', databaseResident + '-deleted th').on('click', databaseResident + '-deleted th', function () {
                            if ($(this).hasClass('sorting') || $(this).hasClass('sorting_desc')) {
                                sessionStorage.setItem('table.order.' + databaseResident, $(this).data('base') + ' asc');
                            } else if ($(this).hasClass('sorting_asc')) {
                                sessionStorage.setItem('table.order.' + databaseResident, $(this).data('base') + ' desc');
                            }
                        });

                        return sessionStorage.getItem('table.order.' + databaseResident);
                    }
                }
            },
            columns: [
                { data: 'photo',  name: 'photo', className: 'text-center fe-td-img d-print-none', orderable: false, searchable: false },
                { data: 'name',   name: 'name' },
                { data: 'email',  name: 'email' },
                { data: 'date',   name: 'date', searchable: false },
                { data: 'action', name: 'action', className: 'text-center fe-td-action d-print-none', orderable: false, searchable: false },
            ]
        }).on('error.dt', function() {
            tableResidentsDeleted.draw();
        });

        // modal de novo morador disponível
        let newResidentAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-new-resident').removeAttr('disabled', 'disabled').html('Criar morador');
            $('#company-id-new-resident').val('').trigger('change');
            $('#form-new-resident').trigger('reset');
        };

        // modal de editar morador disponível
        let editResidentAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-resident').removeAttr('disabled', 'disabled').html('Editar morador');
            $('#company-id-edit-resident').val('').trigger('change');
            $('#gender-id-edit-resident').val('').trigger('change');
            $('#state-id-edit-resident').val('').trigger('change');
            $('#birthday-edit-resident').val('').datepicker('update');
            $('#form-edit-resident .card-header').attr('aria-expanded', false);
            $('#form-edit-resident .collapse').removeClass('show');
            $('#form-edit-resident').trigger('reset');
        };

        // modal de bloquear morador disponível
        let blockResidentAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-block-resident').removeAttr('disabled', 'disabled').html('Bloquear morador');
            $('#form-block-resident').trigger('reset');
        };

        // modal de deletar morador disponível
        let deleteResidentAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-delete-resident').removeAttr('disabled', 'disabled').html('Excluir morador');
            $('#form-delete-resident').trigger('reset');
        };

        // modal de recuperar morador disponível
        let recoverResidentAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-recover-resident').removeAttr('disabled', 'disabled').html('Recuperar morador');
            $('#form-recover-resident').trigger('reset');
        };

        // modal de enviar e-mail para o morador disponível
        let sendEmailResidentAvailable = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-send-email-resident').removeAttr('disabled', 'disabled').html('Enviar e-mail');
            $('#form-send-email-resident').trigger('reset');
        };

        // visualizar morador
        $(document).on('click', '.btn-modal-view-resident', function () {
            let id = $(this).data('id');
            $('#event-view-resident-info').click();

            $.get('{{ app('router')->has('resident.view') ? route('resident.view') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    // capa
                    if (data.background) {
                        $('#background-view-resident').css('background-image', 'url({{ url('storage/img/residents/background') }}/' + data.background + ')');
                    } else {
                        $('#background-view-resident').css('background-image', 'url({{ url('img/default/default-background.png') }})');
                    }
                    // status
                    if (data.blocked || data.blocked_at >= moment().format('YYYY-MM-DD') || data.deleted_at) {
                        $('#status-view-resident').removeClass('d-none');

                        if (data.blocked || data.blocked_at) {
                            if (data.blocked) {
                                $('#status-view-resident i').addClass('bg-warning').attr('data-original-title', 'bloqueado');
                            } else {
                                $('#status-view-resident i').addClass('bg-warning').attr('data-original-title', 'bloqueado até ' + timestamp_to_date_br(data.blocked_at));
                            }
                        } else {
                            $('#status-view-resident i').addClass('bg-danger').attr('data-original-title', 'deletado');
                        }
                    } else {
                        $('#status-view-resident').addClass('d-none');
                        $('#status-view-resident i').removeAttr('data-original-title');
                    }
                    // foto
                    if (data.photo) {
                        $('#photo-view-resident').css('background-image', 'url({{ url('storage/img/residents/photo') }}/' + data.photo + ')');
                    } else {
                        $('#photo-view-resident').css('background-image', 'url({{ url('img/default/default-user.png') }})');
                    }
                    // nome
                    $('#name-view-resident').html(data.name);
                    // aniversário
                    if (data.birthday) {
                        $('#icon-birthday-view-resident').removeClass('d-none');
                        $('#birthday-view-resident').html('&nbsp;' + date_to_date_br(data.birthday) + ' - ' + calcularIdade(data.birthday) + ' anos');
                    } else {
                        $('#icon-birthday-view-resident').addClass('d-none');
                        $('#birthday-view-resident').html('');
                    }
                    // cpf
                    if (data.cpf) {
                        $('#icon-cpf-view-resident').removeClass('d-none');
                        $('#cpf-view-resident').html(data.cpf);
                    } else {
                        $('#icon-cpf-view-resident').addClass('d-none');
                        $('#cpf-view-resident').html('');
                    }
                    // rg
                    if (data.rg) {
                        $('#icon-rg-view-resident').removeClass('d-none');
                        $('#rg-view-resident').html(data.rg);
                    } else {
                        $('#icon-rg-view-resident').addClass('d-none');
                        $('#rg-view-resident').html('');
                    }
                    // sexo
                    if (data.gender_id) {
                        $('#icon-gender-view-resident').removeClass('d-none');
                        $('#gender-view-resident').html(data.gender);
                    } else {
                        $('#icon-gender-view-resident').addClass('d-none');
                        $('#gender-view-resident').html('');
                    }
                    // profissão
                    if (data.profession || data.company) {
                        $('#icon-profession-view-resident').removeClass('d-none');

                        if (data.profession && data.company) {
                            $('#profession-view-resident').html('&nbsp;' + data.profession);
                            $('#company-view-resident').html(' na ' + data.company);
                        } else if (data.profession && !data.company) {
                            $('#profession-view-resident').html('&nbsp;' + data.profession);
                            $('#company-view-resident').html('');
                        } else if (!data.profession && data.company) {
                            $('#company-view-resident').html('&nbsp;' + data.company);
                            $('#profession-view-resident').html('');
                        }
                    } else {
                        $('#icon-profession-view-resident').addClass('d-none');
                        $('#profession-view-resident').html('');
                        $('#company-view-resident').html('');
                    }
                    // formação
                    if (data.course || data.college) {
                        let gender = 'o';

                        if (data.gender_id === 2) {
                            gender = 'a';
                        }

                        $('#icon-course-view-resident').removeClass('d-none');

                        if (data.course && data.college) {
                            $('#course-view-resident').html('Formad' + gender + ' em ' + data.course);
                            $('#college-view-resident').html(' na ' + data.college);

                        } else if (data.course && !data.company) {
                            $('#course-view-resident').html('Formad' + gender + ' em ' + data.course);
                            $('#college-view-resident').html('');

                        } else if (!data.course && data.company) {
                            $('#college-view-resident').html('Formad' + gender + ' na ' + data.college);
                            $('#course-view-resident').html('');
                        }
                    } else {
                        $('#icon-course-view-resident').addClass('d-none');
                        $('#course-view-resident').html('');
                        $('#college-view-resident').html('');
                    }
                    // descrição
                    if (data.description) {
                        $('#text-description-view-resident').removeClass('d-none');
                        $('#description-view-resident').html(data.description);
                    } else {
                        $('#text-description-view-resident').addClass('d-none');
                        $('#description-view-resident').html('');
                    }
                    // endereço
                    $('#residential-view-resident').removeClass('mb-4 mb-sm-0').addClass('d-none');
                    $('#br-postal-code-view-resident').addClass('d-none');
                    $('#br-address-view-resident').addClass('d-none');
                    $('#br-complement-view-resident').addClass('d-none');
                    $('#br-neighborhood-view-resident').addClass('d-none');
                    if (data.postal_code || data.address || data.house_number || data.complement || data.neighborhood || data.city || data.state_id || data.country) {
                        $('#residential-view-resident').addClass('mb-4 mb-sm-0').removeClass('d-none');

                        if (data.postal_code) {
                            $('#postal-code-view-resident').html(data.postal_code);
                            $('#br-postal-code-view-resident').removeClass('d-none');
                        } else {
                            $('#postal-code-view-resident').html('');
                        }

                        if (data.address) {
                            $('#address-view-resident').html(data.address);
                            $('#br-address-view-resident').removeClass('d-none');
                        } else {
                            $('#address-view-resident').html('');
                        }

                        if (data.house_number) {
                            $('#br-address-view-resident').removeClass('d-none');

                            if (data.address) {
                                $('#house-number-view-resident').html(', nº ' + data.house_number);
                            } else {
                                $('#house-number-view-resident').html('nº ' + data.house_number);
                            }
                        } else {
                            $('#house-number-view-resident').html('');
                        }

                        if (data.complement) {
                            $('#complement-view-resident').html(data.complement);
                            $('#br-complement-view-resident').removeClass('d-none');
                        } else {
                            $('#complement-view-resident').html('');
                        }

                        if (data.neighborhood) {
                            $('#neighborhood-view-resident').html(data.neighborhood);
                            $('#br-neighborhood-view-resident').removeClass('d-none');
                        } else {
                            $('#neighborhood-view-resident').html('');
                        }

                        if (data.city) {
                            $('#br-neighborhood-view-resident').removeClass('d-none');

                            if (data.neighborhood) {
                                $('#city-view-resident').html(', ' + data.city);
                            } else {
                                $('#city-view-resident').html(data.city);
                            }
                        } else {
                            $('#city-view-resident').html('');
                        }

                        if (data.state) {
                            $('#br-neighborhood-view-resident').removeClass('d-none');

                            if (data.neighborhood || data.city) {
                                $('#state-view-resident').html(', ' + data.state);
                            } else {
                                $('#state-view-resident').html(data.state);
                            }
                        } else {
                            $('#state-view-resident').html('');
                        }

                        if (data.country) {
                            $('#br-neighborhood-view-resident').removeClass('d-none');

                            if (data.neighborhood || data.city || data.state) {
                                $('#country-view-resident').html(' - ' + data.country);
                            } else {
                                $('#country-view-resident').html(data.country);
                            }
                        } else {
                            $('#country-view-resident').html('');
                        }
                    } else {
                        $('#postal-code-view-resident').html('');
                        $('#address-view-resident').html('');
                        $('#house-number-view-resident').html('');
                        $('#complement-view-resident').html('');
                        $('#neighborhood-view-resident').html('');
                        $('#city-view-resident').html('');
                        $('#state-view-resident').html('');
                        $('#country-view-resident').html('');
                    }
                    // última conexão em ip
                    if (data.last_login_ip) {
                        $('#last-login-ip-view-resident').html('último ip ' + data.last_login_ip);
                    } else {
                        $('#last-login-ip-view-resident').html('&nbsp;');
                    }
                    // e-mail
                    $('#email-view-resident').html(data.email);
                    // contato
                    $('#contact-view-resident').html(data.contact);
                    // criado
                    $('#created-at-view-resident').html('criado em ' + timestamp_to_date_br(data.created_at) + ' - ' + moment(data.created_at, 'YYYY-MM-DD hh:mm').locale('pt-br').fromNow());
                    // atualizado
                    $('#last-update-at-view-resident').html('atualizado em ' + timestamp_to_date_br(data.last_update_at));
                    // condomínio do morador
                    $('#scroll-resident-view-company').html('');
                    $.each(data.companies, function(index, value){
                        let html = '';
                        html += '<a href="javascript:void(0)" class="list-group-item list-group-item-action fe-mouse-default">';
                        html += '<div class="row align-items-center">';
                        html += '<div class="col-auto">';
                        html += '<div class="avatar avatar-sm">';
                        if (value.logo) {
                            html += '<img src="' + url_public('storage/img/companies/logo/' + value.logo) + '" class="fe-img-list-view" alt="">';
                        } else {
                            html += '<img src="' + url_public('img/default/default-logo.png') + '" class="fe-img-list-view" alt="">';
                        }
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="col ml--2">';
                        html += '<div class="d-flex justify-content-between align-items-center">';
                        html += '<h4 class="mb-0 text-sm">' + value.company + '</h4>';
                        if (value.preferred) {
                            html += '<i hidden class="fas fa-star text-yellow opacity-8" data-toggle="tooltip" data-placement="left" title="Condomínio principal"></i>';
                        }
                        html += '</div>';
                        html += '<p class="text-sm mb-0">' + value.cnpj + '</p>';
                        html += '</div>';
                        html += '</div>';
                        html += '</a>';

                        $('#scroll-resident-view-company').append(html);
                    });

                    $('#modal-view-resident').modal('show');
                }
            });
        });

        // novo morador
        $(document).on('click', '.btn-modal-new-resident', function (e) {
            e.preventDefault();
            newResidentAvailable();
            $('#modal-new-resident').modal('show');
        });

        // salvando morador
        $(document).on('click', '#btn-new-resident', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-new-resident').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-new-resident').serialize(),
                    url: '{{ app('router')->has('resident.store') ? route('resident.store') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        newResidentAvailable();
                        $('#modal-new-resident').modal('hide');
                        tableResidents.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-new-resident').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-new-resident').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao criar um novo morador.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // editar morador
        $(document).on('click', '.btn-modal-edit-resident', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('resident.edit') ? route('resident.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    editResidentAvailable();
                    // edição comum
                    $('#id-edit-resident').val(data.id);
                    $('#name-edit-resident').val(data.name);
                    $('#email-edit-resident').val(data.email);
                    $("#company-id-edit-resident").select2().val(data.company_id).trigger('change');
                    // acessar permissões
                    $('#link-permission-edit-resident').attr('href', '{{ app('router')->has('permission.resident.edit') ? route('permission.resident.edit') : '' }}?id=' + data.id);
                    // imagens
                    $('.fe-image-url-2').val(destination_url(data.id, 'png'));
                    if (data.photo) {
                        $('.fe-remove-preview-2').removeClass('fe-hidden');
                        $('.fe-img-preview-2').attr('src', '{{ url('storage/img/residents/photo') }}/' + data.photo);
                    } else {
                        $('.fe-remove-preview-2').addClass('fe-hidden');
                        $('.fe-img-preview-2').attr('src', '');
                    }
                    $('.fe-image-url-3').val(destination_url(data.id, 'png'));
                    if (data.background) {
                        $('.fe-remove-preview-3').removeClass('fe-hidden');
                        $('.fe-img-preview-3').attr('src', '{{ url('storage/img/residents/background') }}/' + data.background);
                    } else {
                        $('.fe-remove-preview-3').addClass('fe-hidden');
                        $('.fe-img-preview-3').attr('src', '');
                    }
                    // informações do morador
                    $('#cpf-edit-resident').val(data.cpf);
                    $('#rg-edit-resident').val(data.rg);
                    if (data.birthday) {
                        $('#birthday-edit-resident').datepicker('setDate', date_to_date_br(data.birthday));
                    }
                    $('#contact-edit-resident').val(data.contact);
                    $('#gender-id-edit-resident').val(data.gender_id).trigger('change');
                    $('#description-edit-resident').val(data.description);
                    // informações acadêmicas
                    $('#course-edit-resident').val(data.course);
                    $('#college-edit-resident').val(data.college);
                    // informações profissionais
                    $('#profession-edit-resident').val(data.profession);
                    $('#company-edit-resident').val(data.company);
                    // informações residenciais
                    $('#postal-code-edit-resident').val(data.postal_code);
                    $('#address-edit-resident').val(data.address);
                    $('#house-number-edit-resident').val(data.house_number);
                    $('#complement-edit-resident').val(data.complement);
                    $('#neighborhood-edit-resident').val(data.neighborhood);
                    $('#city-edit-resident').val(data.city);
                    $('#state-id-edit-resident').val(data.state_id).trigger('change');
                    $('#country-edit-resident').val(data.country);

                    $('#modal-edit-resident').modal('show');
                }
            });
        });

        // editando morador
        $(document).on('click', '#btn-edit-resident', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-resident').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: new FormData($('#form-edit-resident')[0]),
                    contentType: false,
                    processData: false,
                    url: '{{ app('router')->has('resident.update') ? route('resident.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        editResidentAvailable();
                        $('#modal-edit-resident').modal('hide');
                        tableResidents.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-resident').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-resident').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o morador.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // recuperar morador
        $(document).on('click', '.btn-modal-recover-resident', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('resident.recover') ? route('resident.recover') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    recoverResidentAvailable();
                    $('#id-recover-resident').val(data.id);
                    let name = first_word(data.name);
                    $('#name-confirmation-recover-resident-text').html(name);
                    $('#name-recover-resident').val(name);

                    $('#modal-recover-resident').modal('show');
                }
            });
        });

        // recuperando morador
        $(document).on('click', '#btn-recover-resident', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-recover-resident').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-recover-resident').serialize(),
                    url: '{{ app('router')->has('resident.restore') ? route('resident.restore') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        recoverResidentAvailable();
                        $('#modal-recover-resident').modal('hide');
                        tableResidentsDeleted.draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-recover-resident').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-recover-resident').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao recuperar o morador.');
                    }
                });
            } else {
                $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                $(this).removeAttr('disabled', 'disabled').html('Tentar novamente');
                return false;
            }
        });

        // enviar e-mail para o morador
        $(document).on('click', '.btn-modal-send-email-resident', function (e) {
            e.preventDefault();
            sendEmailResidentAvailable();
            $('#name-send-email-resident').val($(this).data('name'));
            $('#email-send-email-resident').val($(this).data('email'));
            if ($(this).data('photo')) {
                $('#photo-send-email-resident').removeClass('d-none').css('background-image', 'url({{ url('storage/img/residents/photo') }}/' + $(this).data('photo') + ')');
            } else {
                $('#photo-send-email-resident').addClass('d-none').css('background-image', '');
            }
            $('#text-name-send-email-resident').html('Para: <b>' + two_word($(this).data('name')) + '</b>');

            $('#modal-send-email-resident').modal('show');
        });

        // enviando e-mail para o morador
        $(document).on('click', '#btn-send-email-resident', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-send-email-resident').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-send-email-resident').serialize(),
                    url: '{{ app('router')->has('resident.send.email') ? route('resident.send.email') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        sendEmailResidentAvailable();
                        $('#modal-send-email-resident').modal('hide');
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-send-email-resident').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-send-email-resident').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao enviar o e-mail para o morador.');
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
