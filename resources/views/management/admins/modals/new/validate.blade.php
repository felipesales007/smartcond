<script>
    $(function () {
        $('#form-new-admin').validate({
            rules: {
                name_new_admin: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersaccentedspace: true,
                },
                email_new_admin: {
                    required: true,
                    maxlength: 191,
                    email: true,
                    remote: {
                        url: '{{ app('router')->has('admin.check.email') ? route('admin.check.email') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            email: function () {
                                return $('#email-new-admin').val();
                            }
                        },
                        dataFilter: function (data) {
                            let json = JSON.parse(data);

                            if (!json) {
                                return false;
                            }

                            if (json.align && json.from) {
                                notifyValidate('Rota bloqueada para validação do e-mail.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            if (json.status === 0) {
                                notifyValidate('Rota excluída para validação do e-mail.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            return true;
                        },
                    },
                },
                company_id_new_admin: {
                    required: true,
                },
            },
            messages: {
                name_new_admin: {
                    required:             'O campo nome é obrigatório.',
                    minlength:            'O campo nome deve ter pelo menos {0} caracteres.',
                    maxlength:            'O campo nome não pode ser superior a {0} caracteres.',
                    lettersaccentedspace: 'O campo nome deve ter somente letras e espaços.',
                },
                email_new_admin: {
                    required:             'O campo e-mail é obrigatório.',
                    maxlength:            'O campo e-mail não pode ser superior a {0} caracteres.',
                    email:                'O campo e-mail deve ser um endereço de e-mail válido.',
                    remote:               'O campo e-mail já está sendo utilizado.',
                },
                company_id_new_admin: {
                    required:             'O campo empresa é obrigatório.',
                },
            }
        });
    });
</script>
