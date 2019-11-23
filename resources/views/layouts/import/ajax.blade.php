<script>
    $(function () {
        // validação da seleção da entidade no navbar
        $('#form-edit-entity-profile').validate({
            ignore: '.ignore',
        });

        // editando a entidade do usuário logado
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
                    notifyError('Erro ao mudar de entidade.');
                }
            });
        });
    });
</script>
