<script>
    $(function () {
        // visualizar
        $(document).on('click', '.btn-modal-view-condominium-service', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('condominium.service.view') ? route('condominium.service.view') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    // status
                    if (data.deleted_at) {
                        $('#status-view-condominium-service').removeClass('d-none');
                        $('#status-view-condominium-service').addClass('text-danger').html('<i class="fas fa-ban"></i> deletado');
                    } else {
                        $('#status-view-condominium-service').addClass('d-none').html('');
                    }

                    // nome
                    $('#name-view-condominium-service').html('<i class="fas fa-user mr-2"></i>' + data.name);

                    // rg
                    if (data.rg) {
                        $('#rg-view-condominium-service').html('<i class="fas fa-id-card mr-2"></i>' + data.rg);
                    } else {
                        $('#rg-view-condominium-service').html('');
                    }

                    // profissão
                    if (data.profession) {
                        $('#profession-view-condominium-service').html('<i class="fas fa-briefcase mr-2"></i>' + data.profession);
                    } else {
                        $('#profession-view-condominium-service').html('');
                    }

                    // contato
                    if (data.contact) {
                        $('#contact-view-condominium-service').html('<i class="fas fa-phone mr-2"></i>' + data.contact);
                    } else {
                        $('#contact-view-condominium-service').html('');
                    }

                    // observação
                    if (data.note) {
                        $('#note-view-condominium-service').html('<div class="small mt-4">' + data.note + '</div>');
                    } else {
                        $('#note-view-condominium-service').html('');
                    }
                    // criado
                    $('#created-at-view-condominium-service').html('criado em ' + timestamp_to_date_br(data.created_at) + ' - ' + moment(data.created_at, 'YYYY-MM-DD hh:mm').locale('pt-br').fromNow());
                    // atualizado
                    $('#updated-at-view-condominium-service').html('atualizado em ' + timestamp_to_date_br(data.updated_at));

                    $('#modal-view-condominium-service').modal('show');
                }
            });
        });
    });
</script>
