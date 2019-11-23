<script>
    $(function () {
        $('#form-new-route').validate({
            rules: {
                group_id_new_route: {
                    required: true,
                },
                route_option_id_new_route: {
                    required: true,
                },
                url_new_route: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersurl: true,
                },
                route_new_route: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersroute: true,
                    remote: {
                        url: '{{ app('router')->has('route.check.route') ? route('route.check.route') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            route: function () {
                                return $('#route-new-route').val();
                            }
                        },
                        dataFilter: function (data) {
                            let json = JSON.parse(data);

                            if (!json) {
                                return false;
                            }

                            if (json.align && json.from) {
                                notifyValidate('Rota bloqueada para validação da rota.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            if (json.status === 0) {
                                notifyValidate('Rota excluída para validação da rota.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            return true;
                        },
                    },
                },
                controller_new_route: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    letterscontroller: true,
                    validatecontroller: true,
                },
                description_new_route: {
                    minlength: 10,
                    maxlength: 1500,
                },
            },
            messages: {
                group_id_new_route: {
                    required:           'O campo grupo é obrigatório.',
                },
                route_option_id_new_route: {
                    required:           'O campo tipo de rota é obrigatório.',
                },
                url_new_route: {
                    required:           'O campo url é obrigatório.',
                    minlength:          'O campo url deve ter pelo menos {0} caracteres.',
                    maxlength:          'O campo url não pode ser superior a {0} caracteres.',
                    lettersurl:         'O campo url deve ter somente letras minúsculas e caracteres permitidos.',
                },
                route_new_route: {
                    required:           'O campo rota é obrigatório.',
                    minlength:          'O campo rota deve ter pelo menos {0} caracteres.',
                    maxlength:          'O campo rota não pode ser superior a {0} caracteres.',
                    lettersroute:       'O campo rota deve ter somente letras minúsculas e caracteres permitidos.',
                    remote:             'O campo rota já está sendo utilizado.',
                },
                controller_new_route: {
                    required:           'O campo controle é obrigatório.',
                    minlength:          'O campo controle deve ter pelo menos {0} caracteres.',
                    maxlength:          'O campo controle não pode ser superior a {0} caracteres.',
                    letterscontroller:  'O campo controle ter somente letras e caracteres permitidos.',
                    validatecontroller: 'O campo controle está em um formato incorreto.',
                },
                description_new_route: {
                    minlength:          'O campo descrição deve ter pelo menos {0} caracteres.',
                    maxlength:          'O campo descrição não pode ser superior a {0} caracteres.',
                },
            }
        });
    });
</script>
