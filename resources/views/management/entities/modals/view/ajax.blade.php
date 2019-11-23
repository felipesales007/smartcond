<script>
    $(function () {
        // visualizar
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
                    // telefone
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
    });
</script>
