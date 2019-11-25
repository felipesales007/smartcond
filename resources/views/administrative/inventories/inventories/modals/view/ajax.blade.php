<script>
    $(function () {
        // visualizar
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
    });
</script>
