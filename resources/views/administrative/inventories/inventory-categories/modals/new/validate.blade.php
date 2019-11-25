<script>
    $(function () {
        $('#form-new-inventory-category').validate({
            rules: {
                name_new_inventory_category: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                    remote: {
                        url: '{{ app('router')->has('inventory.category.check.name') ? route('inventory.category.check.name') : route('remote.validate.destroy') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            name: function () {
                                return $('#name-new-inventory-category').val();
                            }
                        },
                        dataFilter: function (data) {
                            let json = JSON.parse(data);

                            if (!json) {
                                return false;
                            }

                            if (json.align && json.from) {
                                notifyValidate('Rota bloqueada para validação do nome da categoria.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            if (json.status === 0) {
                                notifyValidate('Rota excluída para validação do nome da categoria.<br><small>Procure o Administrador para obter mais informações.</small>');
                                return true;
                            }

                            return true;
                        },
                    },
                },
                description_new_inventory_category: {
                    minlength: 10,
                    maxlength: 1500,
                },
            },
            messages: {
                name_new_inventory_category: {
                    required:     'O campo nome da categoria é obrigatório.',
                    minlength:    'O campo nome da categoria deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome da categoria não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome da categoria deve ter somente letras, espaços e caracteres permitidos.',
                    remote:       'O campo nome da categoria já está sendo utilizado.',
                },
                description_new_inventory_category: {
                    minlength:    'O campo descrição deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo descrição não pode ser superior a {0} caracteres.',
                },
            }
        });
    });
</script>
