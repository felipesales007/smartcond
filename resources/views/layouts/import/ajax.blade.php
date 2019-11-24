<script>
    $(function () {
        // validação da seleção do condomínio no navbar
        $('#form-edit-entity-profile').validate({
            ignore: '.ignore',
        });

        // editando o condomínio do usuário logado
        $('#entity-id-edit-profile').on('select2:select', function () {
            scrollTop();
            loader(1);
            $.ajax({
                data: $('#form-edit-entity-profile').serialize(),
                url: '{{ app('router')->has('profile.entity') ? route('profile.entity') : url('/') }}',
                type: 'post',
                dataType: 'json',
                success: function () {
                    location.reload();
                },
                error: function () {
                    loader(0);
                    notifyError('Erro ao mudar de condomínio.');
                }
            });
        });
    });
</script>
