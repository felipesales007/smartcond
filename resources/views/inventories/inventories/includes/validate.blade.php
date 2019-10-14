<script>
    $(function () {
        // novo inventário
        $('#form-new-inventory').validate({
            rules: {
                image_image_new_inventory: {
                    extension: 'jpeg|png|jpg|gif',
                    maxsize: 1000000,
                },
                department_id_new_inventory: {
                    required: true,
                },
                inventory_category_id_new_inventory: {
                    required: true,
                },
                inventory_state_id_new_inventory: {
                    required: true,
                },
                patrimonial_number_new_inventory: {
                    maxlength: 191,
                    number: true,
                },
                name_new_inventory: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                },
                brand_new_inventory: {
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                },
                model_new_inventory: {
                    maxlength: 191,
                },
                serial_number_new_inventory: {
                    maxlength: 191,
                },
                invoice_new_inventory: {
                    maxlength: 191,
                },
                value_new_inventory: {
                    maxlength: 191,
                    decimal: true,
                },
                voltage_id_new_inventory: {
                    required: true,
                },
                purchase_date_new_inventory: {
                    minlength: 10,
                    maxlength: 10,
                    dateITA: true,
                },
                warranty_date_new_inventory: {
                    minlength: 10,
                    maxlength: 10,
                    dateITA: true,
                },
                description_new_inventory: {
                    minlength: 10,
                    maxlength: 1500,
                },
            },
            messages: {
                image_image_new_inventory: {
                    extension:    'O campo imagem deve ser um arquivo do tipo: jpeg|png|jpg|gif.',
                    maxsize:      'O campo imagem não pode ser superior a 1 mb.',
                },
                department_id_new_inventory: {
                    required:     'O campo departamento é obrigatório.',
                },
                inventory_category_id_new_inventory: {
                    required:     'O campo categoria é obrigatório.',
                },
                inventory_state_id_new_inventory: {
                    required:     'O campo estado do item é obrigatório.',
                },
                patrimonial_number_new_inventory: {
                    maxlength:    'O campo e-mail não pode ser superior a {0} caracteres.',
                    number:       'O campo id deve ser um número.',
                },
                name_new_inventory: {
                    required:     'O campo nome do item é obrigatório.',
                    minlength:    'O campo nome do item deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome do item não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome do item deve ter somente letras, espaços e caracteres permitidos.',
                },
                brand_new_inventory: {
                    minlength:    'O campo marca deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo marca não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo marca deve ter somente letras, espaços e caracteres permitidos.',
                },
                model_new_inventory: {
                    maxlength:    'O campo modelo não pode ser superior a {0} caracteres.',
                },
                serial_number_new_inventory: {
                    maxlength:    'O campo nº de série não pode ser superior a {0} caracteres.',
                },
                invoice_new_inventory: {
                    maxlength:    'O campo nota fiscal não pode ser superior a {0} caracteres.',
                },
                value_new_inventory: {
                    maxlength:    'O campo valor não pode ser superior a {0} caracteres.',
                    decimal:      'O campo valor deve ter um número decimal.',
                },
                voltage_id_new_inventory: {
                    required:     'O campo departamento é obrigatório.',
                },
                purchase_date_new_inventory: {
                    minlength:    'O campo data de compra deve ter pelo menos 8 dígitos.',
                    maxlength:    'O campo data de compra não pode ser superior a 8 dígitos.',
                    dateITA:      'O campo data de compra não é uma data válida.',
                },
                warranty_date_new_inventory: {
                    minlength:    'O campo data da garantia deve ter pelo menos 8 dígitos.',
                    maxlength:    'O campo data da garantia não pode ser superior a 8 dígitos.',
                    dateITA:      'O campo data da garantia não é uma data válida.',
                },
                description_new_department: {
                    minlength:    'O campo descrição deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo descrição não pode ser superior a {0} caracteres.',
                },
            }
        });

        // editar inventário
        $('#form-edit-inventory').validate({
            rules: {
                id_edit_inventory: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                image_image_edit_inventory: {
                    extension: 'jpeg|png|jpg|gif',
                    maxsize: 1000000,
                },
                department_id_edit_inventory: {
                    required: true,
                },
                inventory_category_id_edit_inventory: {
                    required: true,
                },
                inventory_state_id_edit_inventory: {
                    required: true,
                },
                patrimonial_number_edit_inventory: {
                    maxlength: 191,
                    number: true,
                },
                name_edit_inventory: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                },
                brand_edit_inventory: {
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                },
                model_edit_inventory: {
                    maxlength: 191,
                },
                serial_number_edit_inventory: {
                    maxlength: 191,
                },
                invoice_edit_inventory: {
                    maxlength: 191,
                },
                value_edit_inventory: {
                    maxlength: 191,
                    decimal: true,
                },
                voltage_id_edit_inventory: {
                    required: true,
                },
                purchase_date_edit_inventory: {
                    minlength: 10,
                    maxlength: 10,
                    dateITA: true,
                },
                warranty_date_edit_inventory: {
                    minlength: 10,
                    maxlength: 10,
                    dateITA: true,
                },
                description_edit_inventory: {
                    minlength: 10,
                    maxlength: 1500,
                },
            },
            messages: {
                id_edit_inventory: {
                    required:     'O campo id é obrigatório.',
                    maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                    number:       'O campo id deve ser um número.',
                },
                image_image_edit_inventory: {
                    extension:    'O campo imagem deve ser um arquivo do tipo: jpeg|png|jpg|gif.',
                    maxsize:      'O campo imagem não pode ser superior a 1 mb.',
                },
                department_id_edit_inventory: {
                    required:     'O campo departamento é obrigatório.',
                },
                inventory_category_id_edit_inventory: {
                    required:     'O campo categoria é obrigatório.',
                },
                inventory_state_id_edit_inventory: {
                    required:     'O campo estado do item é obrigatório.',
                },
                patrimonial_number_edit_inventory: {
                    maxlength:    'O campo e-mail não pode ser superior a {0} caracteres.',
                    number:       'O campo id deve ser um número.',
                },
                name_edit_inventory: {
                    required:     'O campo nome do item é obrigatório.',
                    minlength:    'O campo nome do item deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome do item não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome do item deve ter somente letras, espaços e caracteres permitidos.',
                },
                brand_edit_inventory: {
                    minlength:    'O campo marca deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo marca não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo marca deve ter somente letras, espaços e caracteres permitidos.',
                },
                model_edit_inventory: {
                    maxlength:    'O campo modelo não pode ser superior a {0} caracteres.',
                },
                serial_number_edit_inventory: {
                    maxlength:    'O campo nº de série não pode ser superior a {0} caracteres.',
                },
                invoice_edit_inventory: {
                    maxlength:    'O campo nota fiscal não pode ser superior a {0} caracteres.',
                },
                value_edit_inventory: {
                    maxlength:    'O campo valor não pode ser superior a {0} caracteres.',
                    decimal:      'O campo valor deve ter um número decimal.',
                },
                voltage_id_edit_inventory: {
                    required:     'O campo departamento é obrigatório.',
                },
                purchase_date_edit_inventory: {
                    minlength:    'O campo data de compra deve ter pelo menos 8 dígitos.',
                    maxlength:    'O campo data de compra não pode ser superior a 8 dígitos.',
                    dateITA:      'O campo data de compra não é uma data válida.',
                },
                warranty_date_edit_inventory: {
                    minlength:    'O campo data da garantia deve ter pelo menos 8 dígitos.',
                    maxlength:    'O campo data da garantia não pode ser superior a 8 dígitos.',
                    dateITA:      'O campo data da garantia não é uma data válida.',
                },
                description_edit_department: {
                    minlength:    'O campo descrição deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo descrição não pode ser superior a {0} caracteres.',
                },
            }
        });

        // deletar inventário
        $('#form-delete-inventory').validate({
            rules: {
                id_delete_inventory: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_delete_inventory: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                },
                name_confirmation_delete_inventory: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                    equalTo: '#name-delete-inventory',
                },
            },
            messages: {
                id_delete_inventory: {
                    required:     'O campo id é obrigatório.',
                    maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                    number:       'O campo id deve ser um número.',
                },
                name_delete_inventory: {
                    required:     'O campo nome do item é obrigatório.',
                    minlength:    'O campo nome do item deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome do item não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome do item deve ter somente letras, espaços e caracteres permitidos.',
                },
                name_confirmation_delete_inventory: {
                    required:     'O campo nome do item para exclusão é obrigatório.',
                    minlength:    'O campo nome do item para exclusão deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome do item para exclusão não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome do item para exclusão deve ter somente letras, espaços e caracteres permitidos.',
                    equalTo:      'O campo nome do item para exclusão de confirmação não confere.',
                },
            }
        });

        // recuperar inventário
        $('#form-recover-inventory').validate({
            rules: {
                id_recover_inventory: {
                    required: true,
                    maxlength: 20,
                    number: true,
                },
                name_recover_inventory: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                },
                name_confirmation_recover_inventory: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersdigit: true,
                    equalTo: '#name-recover-inventory',
                },
            },
            messages: {
                id_recover_inventory: {
                    required:     'O campo id é obrigatório.',
                    maxlength:    'O campo id não pode ser superior a {0} dígitos.',
                    number:       'O campo id deve ser um número.',
                },
                name_recover_inventory: {
                    required:     'O campo nome do item é obrigatório.',
                    minlength:    'O campo nome do item deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome do item não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome do item deve ter somente letras, espaços e caracteres permitidos.',
                },
                name_confirmation_recover_inventory: {
                    required:     'O campo nome do item para recuperação é obrigatório.',
                    minlength:    'O campo nome do item para recuperação deve ter pelo menos {0} caracteres.',
                    maxlength:    'O campo nome do item para recuperação não pode ser superior a {0} caracteres.',
                    lettersdigit: 'O campo nome do item para recuperação deve ter somente letras, espaços e caracteres permitidos.',
                    equalTo:      'O campo nome do item para recuperação de confirmação não confere.',
                },
            }
        });
    });
</script>
