<script>
    $(function () {
        // visualizar
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
                        $('#birthday-view-user').html('&nbsp;' + date_to_date_br(data.birthday) + ' - ' + calculateAge(data.birthday) + ' anos');
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
                    // telefone
                    $('#contact-view-user').html(data.contact);
                    // criado
                    $('#created-at-view-user').html('criado em ' + timestamp_to_date_br(data.created_at) + ' - ' + moment(data.created_at, 'YYYY-MM-DD hh:mm').locale('pt-br').fromNow());
                    // atualizado
                    $('#last-update-at-view-user').html('atualizado em ' + timestamp_to_date_br(data.last_update_at));
                    // condomínio do usuário
                    $('#scroll-user-view-entity').html('');
                    $.each(data.entities, function(index, value) {
                        let html = '';
                        html += '<a href="javascript:void(0)" class="list-group-item list-group-item-action fe-mouse">';
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
    });
</script>
