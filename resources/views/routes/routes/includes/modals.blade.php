@if (\App\Models\Permission::buttonPermission('btn-modal-view-route'))
    <!-- visualizar rota -->
    @include('routes.routes.modals.view')
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-new-route'))
    <!-- nova rota -->
    @include('routes.routes.modals.new')
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
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-edit-route'))
    <!-- editar rota -->
    @include('routes.routes.modals.edit')
    <script>
        $(function () {
            $('#form-edit-route').validate({
                rules: {
                    id_edit_route: {
                        required: true,
                        maxlength: 20,
                        number: true,
                    },
                    group_id_edit_route: {
                        required: true,
                    },
                    route_option_id_edit_route: {
                        required: true,
                    },
                    url_edit_route: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersurl: true,
                    },
                    route_edit_route: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersroute: true,
                        remote: {
                            url: '{{ app('router')->has('route.check.route.different') ? route('route.check.route.different') : route('remote.validate.destroy') }}',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                id: function () {
                                    return $('#id-edit-route').val();
                                },
                                route: function () {
                                    return $('#route-edit-route').val();
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
                    controller_edit_route: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        letterscontroller: true,
                        validatecontroller: true,
                    },
                    description_edit_route: {
                        minlength: 10,
                        maxlength: 1500,
                    },
                },
                messages: {
                    id_edit_route: {
                        required:           'O campo id é obrigatório.',
                        maxlength:          'O campo id não pode ser superior a {0} dígitos.',
                        number:             'O campo id deve ser um número.',
                    },
                    group_id_edit_route: {
                        required:           'O campo grupo é obrigatório.',
                    },
                    route_option_id_edit_route: {
                        required:           'O campo tipo de rota é obrigatório.',
                    },
                    url_edit_route: {
                        required:           'O campo url é obrigatório.',
                        minlength:          'O campo url deve ter pelo menos {0} caracteres.',
                        maxlength:          'O campo url não pode ser superior a {0} caracteres.',
                        lettersurl:         'O campo url deve ter somente letras minúsculas e caracteres permitidos.',
                    },
                    route_edit_route: {
                        required:           'O campo rota é obrigatório.',
                        minlength:          'O campo rota deve ter pelo menos {0} caracteres.',
                        maxlength:          'O campo rota não pode ser superior a {0} caracteres.',
                        lettersroute:       'O campo rota deve ter somente letras minúsculas e caracteres permitidos.',
                        remote:             'O campo rota já está sendo utilizado.',
                    },
                    controller_edit_route: {
                        required:           'O campo controle é obrigatório.',
                        minlength:          'O campo controle deve ter pelo menos {0} caracteres.',
                        maxlength:          'O campo controle não pode ser superior a {0} caracteres.',
                        letterscontroller:  'O campo controle deve ter somente letras e caracteres permitidos.',
                        validatecontroller: 'O campo controle está em um formato incorreto.',
                    },
                    description_edit_route: {
                        minlength:          'O campo descrição deve ter pelo menos {0} caracteres.',
                        maxlength:          'O campo descrição não pode ser superior a {0} caracteres.',
                    },
                }
            });
        });
    </script>
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-block-route'))
    <!-- bloquear rota -->
    @include('routes.routes.modals.block')
    <script>
        $(function () {
            $('#form-block-route').validate({
                rules: {
                    id_block_route: {
                        required: true,
                        maxlength: 20,
                        number: true,
                    },
                },
                messages: {
                    id_block_route: {
                        required:  'O campo id é obrigatório.',
                        maxlength: 'O campo id não pode ser superior a {0} dígitos.',
                        number:    'O campo id deve ser um número.',
                    },
                }
            });
        });
    </script>
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-delete-route'))
    <!-- deletar rota -->
    @include('routes.routes.modals.delete')
    <script>
        $(function () {
            $('#form-delete-route').validate({
                rules: {
                    id_delete_route: {
                        required: true,
                        maxlength: 20,
                        number: true,
                    },
                    route_delete_route: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersroute: true,
                    },
                    route_confirmation_delete_route: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersroute: true,
                        equalTo: '#route-delete-route',
                    },
                },
                messages: {
                    id_delete_route: {
                        required:     'O campo id é obrigatório.',
                        maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                        number:       'O campo id deve ser um número.',
                    },
                    route_delete_route: {
                        required:     'O campo rota é obrigatório.',
                        minlength:    'O campo rota deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo rota não pode ser superior a {0} caracteres.',
                        lettersroute: 'O campo rota deve ter somente letras minúsculas e caracteres permitidos.',
                    },
                    route_confirmation_delete_route: {
                        required:     'O campo rota para exclusão é obrigatório.',
                        minlength:    'O campo rota para exclusão deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo rota para exclusão não pode ser superior a {0} caracteres.',
                        lettersroute: 'O campo rota deve ter somente letras minúsculas e caracteres permitidos.',
                        equalTo:      'O campo rota para exclusão de confirmação não confere.',
                    },
                }
            });
        });
    </script>
@endif

@if (\App\Models\Permission::buttonPermission('btn-modal-recover-route'))
    <!-- recuperar rota -->
    @include('routes.routes.modals.recover')
    <script>
        $(function () {
            $('#form-recover-route').validate({
                rules: {
                    id_recover_route: {
                        required: true,
                        maxlength: 20,
                        number: true,
                    },
                    route_recover_route: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersroute: true,
                    },
                    route_confirmation_recover_route: {
                        required: true,
                        minlength: 3,
                        maxlength: 191,
                        lettersroute: true,
                        equalTo: '#route-recover-route',
                    },
                },
                messages: {
                    id_recover_route: {
                        required:     'O campo id é obrigatório.',
                        maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                        number:       'O campo id deve ser um número.',
                    },
                    route_recover_route: {
                        required:     'O campo rota é obrigatório.',
                        minlength:    'O campo rota deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo rota não pode ser superior a {0} caracteres.',
                        lettersroute: 'O campo rota deve ter somente letras minúsculas e caracteres permitidos.',
                    },
                    route_confirmation_recover_route: {
                        required:     'O campo rota para recuperação é obrigatório.',
                        minlength:    'O campo rota para recuperação deve ter pelo menos {0} caracteres.',
                        maxlength:    'O campo rota para recuperação não pode ser superior a {0} caracteres.',
                        lettersroute: 'O campo rota deve ter somente letras minúsculas e caracteres permitidos.',
                        equalTo:      'O campo rota para recuperação de confirmação não confere.',
                    },
                }
            });
        });
    </script>
@endif
