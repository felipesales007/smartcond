<script>
    $(function () {
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
    });
</script>
