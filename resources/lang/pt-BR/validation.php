<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Linhas de Linguagem de Validação
    |--------------------------------------------------------------------------
    |
    | As seguintes linhas de idioma contêm as mensagens de erro padrão usadas pelo
    | a classe do validador. Algumas dessas regras têm várias versões,
    | como as regras de tamanho. Sinta-se à vontade para ajustar cada uma dessas mensagens aqui.
    |
    */

    'accepted'             => 'O campo :attribute deve ser aceito.',
    'active_url'           => 'O campo :attribute não é uma URL válida.',
    'after'                => 'O campo :attribute deve ser uma data posterior a :date.',
    'after_or_equal'       => 'O campo :attribute deve ser uma data posterior ou igual a :date.',
    'alpha'                => 'O campo :attribute só pode conter letras.',
    'alpha_dash'           => 'O campo :attribute só pode conter letras, números e traços.',
    'alpha_num'            => 'O campo :attribute só pode conter letras e números.',
    'array'                => 'O campo :attribute deve ser uma matriz.',
    'before'               => 'O campo :attribute deve ser uma data anterior :date.',
    'before_or_equal'      => 'O campo :attribute deve ser uma data anterior ou igual a :date.',
    'between'     => [
        'numeric' => 'O campo :attribute deve ser entre :min e :max.',
        'file'    => 'O campo :attribute deve ser entre :min e :max kilobytes.',
        'string'  => 'O campo :attribute deve ser entre :min e :max caracteres.',
        'array'   => 'O campo :attribute deve ter entre :min e :max itens.',
    ],
    'boolean'              => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed'            => 'O campo :attribute de confirmação não confere.',
    'date'                 => 'O campo :attribute não é uma data válida.',
    'date_format'          => 'O campo :attribute não corresponde ao formato :format.',
    'different'            => 'Os campos :attribute e :other devem ser diferentes.',
    'digits'               => 'O campo :attribute deve ter :digits dígitos.',
    'digits_between'       => 'O campo :attribute deve ter entre :min e :max dígitos.',
    'dimensions'           => 'O campo :attribute tem dimensões de imagem inválidas.',
    'distinct'             => 'O campo :attribute campo tem um valor duplicado.',
    'email'                => 'O campo :attribute deve ser um endereço de e-mail válido.',
    'exists'               => 'O campo :attribute selecionado é inválido.',
    'file'                 => 'O campo :attribute deve ser um arquivo.',
    'filled'               => 'O campo :attribute deve ter um valor.',
    'gt'          => [
        'numeric' => 'O campo :attribute deve ser maior que :value.',
        'file'    => 'O campo :attribute deve ser maior que :value kilobytes.',
        'string'  => 'O campo :attribute deve ser maior que :value caracteres.',
        'array'   => 'O campo :attribute deve conter mais de :value itens.',
    ],
    'gte'         => [
        'numeric' => 'O campo :attribute deve ser maior ou igual a :value.',
        'file'    => 'O campo :attribute deve ser maior ou igual a :value kilobytes.',
        'string'  => 'O campo :attribute deve ser maior ou igual a :value caracteres.',
        'array'   => 'O campo :attribute deve conter :value itens ou mais.',
    ],
    'image'                => 'O campo :attribute deve ser uma imagem.',
    'in'                   => 'O campo :attribute selecionado é inválido.',
    'in_array'             => 'O campo :attribute não existe em :other.',
    'integer'              => 'O campo :attribute deve ser um número inteiro.',
    'ip'                   => 'O campo :attribute deve ser um endereço de IP válido.',
    'ipv4'                 => 'O campo :attribute deve ser um endereço IPv4 válido.',
    'ipv6'                 => 'O campo :attribute deve ser um endereço IPv6 válido.',
    'json'                 => 'O campo :attribute deve ser uma string JSON válida.',
    'lt'          => [
        'numeric' => 'O campo :attribute deve ser menor que :value.',
        'file'    => 'O campo :attribute deve ser menor que :value kilobytes.',
        'string'  => 'O campo :attribute deve ser menor que :value caracteres.',
        'array'   => 'O campo :attribute deve conter menos de :value itens.',
    ],
    'lte'         => [
        'numeric' => 'O campo :attribute deve ser menor ou igual a :value.',
        'file'    => 'O campo :attribute deve ser menor ou igual a :value kilobytes.',
        'string'  => 'O campo :attribute deve ser menor ou igual a :value caracteres.',
        'array'   => 'O campo :attribute não deve conter mais que :value itens.',
    ],
    'max'         => [
        'numeric' => 'O campo :attribute não pode ser superior a :max.',
        'file'    => 'O campo :attribute não pode ser superior a :max kilobytes.',
        'string'  => 'O campo :attribute não pode ser superior a :max caracteres.',
        'array'   => 'O campo :attribute não pode ter mais do que :max itens.',
    ],
    'mimes'                => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'mimetypes'            => 'O campo :attribute deve ser um arquivo do tipo: :values.',
    'min'         => [
        'numeric' => 'O campo :attribute deve ser pelo menos :min.',
        'file'    => 'O campo :attribute deve ter pelo menos :min kilobytes.',
        'string'  => 'O campo :attribute deve ter pelo menos :min caracteres.',
        'array'   => 'O campo :attribute deve ter pelo menos :min itens.',
    ],
    'not_in'               => 'O campo :attribute selecionado é inválido.',
    'not_regex'            => 'O campo :attribute possui um formato inválido.',
    'numeric'              => 'O campo :attribute deve ser um número.',
    'present'              => 'O campo :attribute deve estar presente.',
    'regex'                => 'O campo :attribute tem um formato inválido.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute é obrigatório quando :other for :value.',
    'required_unless'      => 'O campo :attribute é obrigatório exceto quando :other for :values.',
    'required_with'        => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all'    => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values estão presentes.',
    'same'                 => 'Os campos :attribute e :other devem corresponder.',
    'size'        => [
        'numeric' => 'O campo :attribute deve ser :size.',
        'file'    => 'O campo :attribute deve ser :size kilobytes.',
        'string'  => 'O campo :attribute deve ser :size caracteres.',
        'array'   => 'O campo :attribute deve conter :size itens.',
    ],
    'string'               => 'O campo :attribute deve ser uma string.',
    'timezone'             => 'O campo :attribute deve ser uma zona válida.',
    'unique'               => 'O campo :attribute já está sendo utilizado.',
    'uploaded'             => 'Ocorreu uma falha no upload do campo :attribute.',
    'url'                  => 'O campo :attribute tem um formato inválido.',

    /*
    |--------------------------------------------------------------------------
    | Mensagem de validação personalizada
    |--------------------------------------------------------------------------
    */

    'alpha_space'         => 'O campo :attribute deve ter somente letras e espaços.',
    'alpha_group'         => 'O campo :attribute deve ter somente letras minúsculas e caracteres permitidos.',
    'alpha_url'           => 'O campo :attribute deve ter somente letras minúsculas e caracteres permitidos.',
    'alpha_route'         => 'O campo :attribute deve ter somente letras minúsculas e caracteres permitidos.',
    'alpha_controller'    => 'O campo :attribute deve ter somente letras e caracteres permitidos.',
    'alpha_icon'          => 'O campo :attribute deve ter somente letras, espaços e caracteres permitidos.',
    'format_cpf'          => 'O campo :attribute está em um formato incorreto.',
    'format_cnpj'         => 'O campo :attribute está em um formato incorreto.',
    'format_cpf_cnpj'     => 'O campo :attribute está em um formato incorreto.',
    'format_nis'          => 'O campo :attribute está em um formato incorreto.',
    'format_cep'          => 'O campo :attribute está em um formato incorreto.',
    'format_controller'   => 'O campo :attribute está em um formato incorreto.',
    'phones'              => 'O campo :attribute deve ter um número de telefone ou celular válido.',
    'cpf'                 => 'O campo :attribute deve ter um número de cpf válido.',
    'cnpj'                => 'O campo :attribute deve ter um número de cnpj válido.',
    'cpf_npj'             => 'O campo :attribute deve ter um número de cpf ou cnpj válido.',
    'cnh'                 => 'O campo :attribute deve ter um número de cnh válido.',
    'voter_title'         => 'O campo :attribute deve ter um número de título de eleitor válido.',
    'nis'                 => 'O campo :attribute deve ter um número de nis válido.',
    'decimal'             => 'O campo :attribute deve ter um número decimal.',

    /*
    |--------------------------------------------------------------------------
    | Linhas de Linguagem de Validação Personalizada
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar mensagens de validação personalizadas para atributos usando o
    | convenção "attribute.rule" para nomear as linhas. Isso faz com que seja rápido
    | especifique uma linha de idioma personalizada específica para uma determinada regra de atributo.
    |
    */

    'custom'             => [
        'attribute-name' => [
            'rule-name'  => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Atributos de validação personalizados
    |--------------------------------------------------------------------------
    |
    | As seguintes linhas de idioma são usadas para trocar os titulares de lugar do atributo
    | com algo mais amigável ao leitor, como endereço de e-mail
    | de "e-mail". Isso simplesmente nos ajuda a tornar as mensagens um pouco mais limpas.
    |
    */

    'attributes'                                        => [
        'token'                                         => 'token',

        'id'                                            => 'id',
        'id_edit_profile'                               => 'id',
        'id_edit_user'                                  => 'id',
        'id_edit_company'                               => 'id',
        'id_edit_group'                                 => 'id',
        'id_edit_route'                                 => 'id',
        'id_edit_menu'                                  => 'id',
        'id_edit_menu_item'                             => 'id',
        'id_edit_user_permission'                       => 'id',
        'id_edit_department'                            => 'id',
        'id_edit_inventory_category'                    => 'id',
        'id_edit_inventory'                             => 'id',
        'id_block_user'                                 => 'id',
        'id_block_company'                              => 'id',
        'id_block_group'                                => 'id',
        'id_block_route'                                => 'id',
        'id_block_menu'                                 => 'id',
        'id_block_menu_item'                            => 'id',
        'id_block_department'                           => 'id',
        'id_block_inventory_category'                   => 'id',
        'id_delete_user'                                => 'id',
        'id_delete_company'                             => 'id',
        'id_delete_group'                               => 'id',
        'id_delete_route'                               => 'id',
        'id_delete_menu'                                => 'id',
        'id_delete_menu_item'                           => 'id',
        'id_delete_department'                          => 'id',
        'id_delete_inventory_category'                  => 'id',
        'id_delete_inventory'                           => 'id',
        'id_recover_user'                               => 'id',
        'id_recover_company'                            => 'id',
        'id_recover_group'                              => 'id',
        'id_recover_route'                              => 'id',
        'id_recover_menu'                               => 'id',
        'id_recover_menu_item'                          => 'id',
        'id_resend_email_user'                          => 'id',
        'id_recover_department'                         => 'id',
        'id_recover_inventory_category'                 => 'id',
        'id_recover_inventory'                          => 'id',

        'name'                                          => 'nome',
        'name_new_user'                                 => 'nome',
        'name_new_company'                              => 'nome fantasia',
        'name_new_group'                                => 'nome',
        'name_new_menu'                                 => 'nome',
        'name_new_menu_item'                            => 'nome',
        'name_new_department'                           => 'nome do departamento',
        'name_new_inventory_category'                   => 'nome da categoria',
        'name_new_inventory'                            => 'nome do item',
        'name_edit_profile'                             => 'nome',
        'name_edit_user'                                => 'nome',
        'name_edit_company'                             => 'nome fantasia',
        'name_edit_group'                               => 'nome',
        'name_edit_menu'                                => 'nome',
        'name_edit_menu_item'                           => 'nome',
        'name_edit_department'                          => 'nome do departamento',
        'name_edit_inventory_category'                  => 'nome da categoria',
        'name_edit_inventory'                           => 'nome do item',
        'name_delete_user'                              => 'nome',
        'name_delete_company'                           => 'nome',
        'name_delete_group'                             => 'nome',
        'name_delete_menu'                              => 'nome',
        'name_delete_menu_item'                         => 'nome',
        'name_delete_department'                        => 'nome do departamento',
        'name_delete_inventory_category'                => 'nome da categoria',
        'name_delete_inventory'                         => 'nome do item',
        'name_recover_user'                             => 'nome',
        'name_recover_company'                          => 'nome',
        'name_recover_group'                            => 'nome',
        'name_recover_menu'                             => 'nome',
        'name_recover_menu_item'                        => 'nome',
        'name_recover_department'                       => 'nome do departamento',
        'name_recover_inventory_category'               => 'nome da categoria',
        'name_recover_inventory'                        => 'nome do item',
        'name_send_email_user'                          => 'nome',
        'name_send_email_company'                       => 'nome fantasia',

        'name_confirmation'                             => 'confirme o nome',
        'name_confirmation_delete_user'                 => 'nome para exclusão',
        'name_confirmation_delete_company'              => 'nome para exclusão',
        'name_confirmation_delete_group'                => 'nome para exclusão',
        'name_confirmation_delete_menu'                 => 'nome para exclusão',
        'name_confirmation_delete_menu_item'            => 'nome para exclusão',
        'name_confirmation_delete_department'           => 'nome do departamento para exclusão',
        'name_confirmation_delete_inventory_category'   => 'nome da categoria para exclusão',
        'name_confirmation_delete_inventory'            => 'nome do item para exclusão',
        'name_confirmation_recover_user'                => 'nome para recuperação',
        'name_confirmation_recover_company'             => 'nome para recuperação',
        'name_confirmation_recover_group'               => 'nome para recuperação',
        'name_confirmation_recover_menu'                => 'nome para recuperação',
        'name_confirmation_recover_menu_item'           => 'nome para recuperação',
        'name_confirmation_recover_department'          => 'nome do departamento para recuperação',
        'name_confirmation_recover_inventory_category'  => 'nome da categoria para recuperação',
        'name_confirmation_recover_inventory'           => 'nome do item para recuperação',

        'corporate_name'                                => 'razão social',
        'corporate_name_new_company'                    => 'razão social',
        'corporate_name_edit_company'                   => 'razão social',

        'cpf'                                           => 'cpf',
        'cpf_edit_profile'                              => 'cpf',
        'cpf_edit_user'                                 => 'cpf',

        'rg'                                            => 'rg',
        'rg_edit_profile'                               => 'rg',
        'rg_edit_user'                                  => 'rg',

        'cnpj'                                          => 'cnpj',
        'cnpj_new_company'                              => 'cnpj',
        'cnpj_edit_company'                             => 'cnpj',

        'route_option_id'                               => 'tipo de rota',
        'route_option_id_new_route'                     => 'tipo de rota',
        'menu_option_id_new_menu'                       => 'tipo de menu',
        'route_option_id_edit_route'                    => 'tipo de rota',
        'menu_option_id_edit_menu'                      => 'tipo de menu',

        'password'                                      => 'senha',
        'password_new_user'                             => 'senha',
        'password_edit_user'                            => 'senha',
        'password_reset_profile'                        => 'nova senha',
        'password_confirmation'                         => 'confirme a senha',
        'password_confirmation_reset_profile'           => 'confirme a senha',
        'password_confirmation_new_user'                => 'confirme a senha',
        'password_confirmation_edit_user'               => 'confirme a senha',
        'old_password_reset_profile'                    => 'senha atual',

        'email'                                         => 'e-mail',
        'email_new_company'                             => 'e-mail',
        'email_new_user'                                => 'e-mail',
        'email_edit_profile'                            => 'e-mail',
        'email_edit_user'                               => 'e-mail',
        'email_edit_company'                            => 'e-mail',
        'email_send_email_user'                         => 'e-mail',
        'email_send_email_company'                      => 'e-mail',

        'g-recaptcha-response'                          => 'recaptcha',

        'description'                                   => 'descrição',
        'description_new_group'                         => 'descrição',
        'description_new_route'                         => 'descrição',
        'description_new_menu'                          => 'descrição',
        'description_new_menu_item'                     => 'descrição',
        'description_new_department'                    => 'descrição',
        'description_new_inventory_category'            => 'descrição',
        'description_new_inventory'                     => 'descrição',
        'description_edit_profile'                      => 'descrição',
        'description_edit_user'                         => 'descrição',
        'description_edit_group'                        => 'descrição',
        'description_edit_route'                        => 'descrição',
        'description_edit_menu'                         => 'descrição',
        'description_edit_menu_item'                    => 'descrição',
        'description_edit_department'                   => 'descrição',
        'description_edit_inventory_category'           => 'descrição',
        'description_edit_inventory'                    => 'descrição',

        'date'                                          => 'data',

        'birthday'                                      => 'data de nascimento',
        'purchase_date_new_inventory'                   => 'data de compra',
        'warranty_date_new_inventory'                   => 'data da garantia',
        'birthday_edit_profile'                         => 'data de nascimento',
        'birthday_edit_user'                            => 'data de nascimento',
        'purchase_date_edit_inventory'                  => 'data de compra',
        'warranty_date_edit_inventory'                  => 'data da garantia',

        'blocked_at'                                    => 'data determinada',
        'blocked_at_block_user'                         => 'data determinada',
        'blocked_at_block_company'                      => 'data determinada',

        'postal_code'                                   => 'cep',
        'postal_code_new_company'                       => 'cep',
        'postal_code_edit_profile'                      => 'cep',
        'postal_code_edit_user'                         => 'cep',
        'postal_code_edit_company'                      => 'cep',

        'address'                                       => 'endereço',
        'address_new_company'                           => 'endereço',
        'address_edit_profile'                          => 'endereço',
        'address_edit_user'                             => 'endereço',
        'address_edit_company'                          => 'endereço',

        'house_number'                                  => 'nº',
        'house_number_new_company'                      => 'nº',
        'house_number_edit_profile'                     => 'nº',
        'house_number_edit_user'                        => 'nº',
        'house_number_edit_company'                     => 'nº',

        'complement'                                    => 'complemento',
        'complement_new_company'                        => 'complemento',
        'complement_edit_profile'                       => 'complemento',
        'complement_edit_user'                          => 'complemento',
        'complement_edit_company'                       => 'complemento',

        'neighborhood'                                  => 'bairro',
        'neighborhood_new_company'                      => 'bairro',
        'neighborhood_edit_profile'                     => 'bairro',
        'neighborhood_edit_user'                        => 'bairro',
        'neighborhood_edit_company'                     => 'bairro',

        'city'                                          => 'cidade',
        'city_new_company'                              => 'cidade',
        'city_edit_profile'                             => 'cidade',
        'city_edit_user'                                => 'cidade',
        'city_edit_company'                             => 'cidade',

        'state_id'                                      => 'estado',
        'state_id_new_company'                          => 'estado',
        'state_id_edit_profile'                         => 'estado',
        'state_id_edit_user'                            => 'estado',
        'state_id_edit_company'                         => 'estado',

        'country'                                       => 'país',
        'country_new_company'                           => 'país',
        'country_edit_profile'                          => 'país',
        'country_edit_user'                             => 'país',
        'country_edit_company'                          => 'país',

        'course'                                        => 'curso',
        'course_edit_profile'                           => 'curso',
        'course_edit_user'                              => 'curso',

        'college'                                       => 'faculdade',
        'college_edit_profile'                          => 'faculdade',
        'college_edit_user'                             => 'faculdade',

        'company'                                       => 'condomínio',
        'company_edit_profile'                          => 'condomínio',
        'company_edit_user'                             => 'condomínio',

        'profession'                                    => 'profissão',
        'profession_edit_profile'                       => 'profissão',
        'profession_edit_user'                          => 'profissão',

        'gender_id'                                     => 'sexo',
        'gender_id_edit_profile'                        => 'sexo',
        'gender_id_edit_user'                           => 'sexo',

        'contact'                                       => 'contato',
        'contact_new_company'                           => 'contato',
        'contact_edit_profile'                          => 'contato',
        'contact_edit_user'                             => 'contato',
        'contact_edit_company'                          => 'contato',

        'image'                                         => 'imagem',
        'image_0'                                       => 'foto',
        'image_1'                                       => 'capa',
        'image_2'                                       => 'foto',
        'image_3'                                       => 'capa',
        'image_4'                                       => 'logo',
        'image_5'                                       => 'logo',
        'image_6'                                       => 'imagem',
        'image_7'                                       => 'imagem',
        'image_8'                                       => 'imagem',
        'image_9'                                       => 'imagem',
        'image_image_new_inventory'                     => 'imagem',
        'image_image_edit_inventory'                    => 'imagem',

        'photo'                                         => 'foto',
        'photo_edit_profile'                            => 'foto',
        'photo_edit_user'                               => 'foto',

        'background'                                    => 'capa',
        'background_edit_profile'                       => 'capa',
        'background_edit_user'                          => 'capa',

        'logo'                                          => 'logo',
        'logo_new_company'                              => 'logo',
        'logo_edit_company'                             => 'logo',

        'remember'                                      => 'lembrar-me',

        'reason'                                        => 'motivo',
        'reason_send_support_profile'                   => 'motivo',

        'message'                                       => 'mensagem',
        'message_send_support_profile'                  => 'mensagem',
        'message_send_email_user'                       => 'mensagem',
        'message_send_email_company'                    => 'mensagem',

        'group_id'                                      => 'grupo',
        'group_id_new_route'                            => 'grupo',
        'group_id_edit_route'                           => 'grupo',

        'view'                                          => 'página',
        'view_new_route'                                => 'página',
        'view_edit_route'                               => 'página',

        'url'                                           => 'url',
        'url_new_route'                                 => 'url',
        'url_edit_route'                                => 'url',

        'route'                                         => 'rota',
        'route_new_route'                               => 'rota',
        'route_id_new_menu_item'                        => 'rota',
        'route_edit_route'                              => 'rota',
        'route_id_edit_menu_item'                       => 'rota',
        'route_delete_route'                            => 'rota',
        'route_recover_route'                           => 'rota',
        'route_confirmation_delete_route'               => 'rota para exclusão',
        'route_confirmation_recover_route'              => 'rota para recuperação',

        'controller'                                    => 'controle',
        'controller_new_route'                          => 'controle',
        'controller_edit_route'                         => 'controle',

        'icon'                                          => 'ícone',
        'icon_new_menu'                                 => 'ícone',
        'icon_edit_menu'                                => 'ícone',

        'color'                                         => 'cor',
        'color_id_new_menu'                             => 'cor',
        'color_id_editmenu'                             => 'cor',

        'order'                                         => 'ordem',
        'order_new_menu'                                => 'ordem de listagem',
        'order_new_menu_item'                           => 'ordem de listagem',
        'order_edit_menu'                               => 'ordem de listagem',
        'order_edit_menu_item'                          => 'ordem de listagem',

        'hidden'                                        => 'oculto',
        'hidden_new_menu'                               => 'oculto',
        'hidden_new_menu_item'                          => 'oculto',
        'hidden_edit_menu'                              => 'oculto',
        'hidden_edit_menu_item'                         => 'oculto',

        'menu_id'                                       => 'menu',
        'menu_id_new_menu_item'                         => 'menu',
        'menu_id_edit_menu_item'                        => 'menu',

        'button'                                        => 'botão',
        'button_new_menu_item'                          => 'botão',
        'button_edit_menu_item'                         => 'botão',

        'permission_edit_user'                          => 'permissão',

        'company_id_new_user'                           => 'condomínio',
        'company_id_edit_user'                          => 'condomínio',

        'department_id_new_inventory'                   => 'departamento',
        'department_id_edit_inventory'                  => 'departamento',

        'inventory_category_id_new_inventory'           => 'categoria',
        'inventory_category_id_edit_inventory'          => 'categoria',

        'inventory_state_id_new_inventory'              => 'estado do item',
        'inventory_state_id_edit_inventory'             => 'estado do item',

        'patrimonial_number_new_inventory'              => 'patrimônio',
        'patrimonial_number_edit_inventory'             => 'patrimônio',

        'brand_new_inventory'                           => 'marca',
        'brand_edit_inventory'                          => 'marca',

        'model_new_inventory'                           => 'modelo',
        'model_edit_inventory'                          => 'modelo',

        'serial_number_new_inventory'                   => 'nº de série',
        'serial_number_edit_inventory'                  => 'nº de série',

        'invoice_new_inventory'                         => 'nº da nota fiscal',
        'invoice_edit_inventory'                        => 'nº da nota fiscal',

        'value_new_inventory'                           => 'valor',
        'value_edit_inventory'                          => 'valor',

        'voltage_id_new_inventory'                      => 'voltagem',
        'voltage_id_edit_inventory'                     => 'voltagem',
    ],

];
