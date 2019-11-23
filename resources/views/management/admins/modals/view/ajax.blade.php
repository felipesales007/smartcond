<script>
    $(function () {
        // visualizar
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
                        $('#birthday-view-admin').html('&nbsp;' + date_to_date_br(data.birthday) + ' - ' + calculateAge(data.birthday) + ' anos');
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
                    // telefone
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
    });
</script>
