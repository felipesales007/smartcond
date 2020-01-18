<script>
    $(function () {
        // modal disponível
        let available = function () {
            removeValidate();
            $('a[data-dismiss="modal"]').removeClass('fe-hidden');
            $('#btn-edit-condominium-service').removeAttr('disabled', 'disabled').html('Editar prestador de serviços');
            $('#form-edit-condominium-service').trigger('reset');
        };

        // editar
        $(document).on('click', '.btn-modal-edit-condominium-service', function () {
            let id = $(this).data('id');

            $.get('{{ app('router')->has('condominium.service.edit') ? route('condominium.service.edit') : url('/') }}' + '/' + id, function (data) {
                // se houver erro
                if (data.align && data.from) {
                    notify(data);
                } else {
                    available();
                    // dados
                    $('#id-edit-condominium-service').val(data.id);
                    $('#name-edit-condominium-service').val(data.name);
                    $('#rg-edit-condominium-service').val(data.rg);
                    $('#contact-edit-condominium-service').val(data.contact);
                    $('#profession-edit-condominium-service').val(data.profession);
                    $('#note-edit-condominium-service').val(data.note);
                }

                $('#modal-edit-condominium-service').modal('show');
            });
        });

        // editando
        $(document).on('click', '#btn-edit-condominium-service', function (e) {
            e.preventDefault();
            $('a[data-dismiss="modal"]').addClass('fe-hidden');
            $(this).attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-pulse mr-2"></i>Aguarde');

            if ($('#form-edit-condominium-service').valid()) {
                scrollTop();
                loader(1);
                $.ajax({
                    data: $('#form-edit-condominium-service').serialize(),
                    url: '{{ app('router')->has('condominium.service.update') ? route('condominium.service.update') : url('/') }}',
                    type: 'post',
                    dataType: 'json',
                    success: function (data) {
                        available();
                        $('#modal-edit-condominium-service').modal('hide');
                        $('#datatable-condominium-services').DataTable().draw();
                        loader(0);
                        notify(data);
                    },
                    error: function (data) {
                        $('a[data-dismiss="modal"]').removeClass('fe-hidden');
                        $('#btn-edit-condominium-service').removeAttr('disabled', 'disabled').html('Tentar novamente');
                        $('#form-edit-condominium-service').valid();
                        loader(0);
                        serverValidate(data);
                        notifyError('Erro ao editar o prestador de serviços.');
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
