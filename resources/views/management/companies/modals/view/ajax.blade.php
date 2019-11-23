<script>
    $(function () {
        // visualizar
        $(document).on('click', '.btn-modal-view-company', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('company.view') ? route('company.view') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    // capa
                    $('#background-view-company').css('background-image', 'url({{ url('images/default/default-background.png') }})');
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
                        $('#logo-view-company').css('background-image', 'url({{ url('storage/images/companies/logo') }}/' + data.logo + ')');
                    } else {
                        $('#logo-view-company').css('background-image', 'url({{ url('images/default/default-logo.png') }})');
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
                    // telefone
                    $('#contact-view-company').html(data.contact);
                    // criado
                    $('#created-at-view-company').html('criado em ' + timestamp_to_date_br(data.created_at) + ' - ' + moment(data.created_at, 'YYYY-MM-DD hh:mm').locale('pt-br').fromNow());
                    // atualizado
                    $('#last-update-at-view-company').html('atualizado em ' + timestamp_to_date_br(data.last_update_at));
                    // acessar lista de usuários
                    $('#link-company-list-admins').attr('href', '{{ app('router')->has('company.list.admins') ? route('company.list.admins') : '' }}?id=' + data.id);

                    $('#modal-view-company').modal('show');
                }
            });
        });
    });
</script>
