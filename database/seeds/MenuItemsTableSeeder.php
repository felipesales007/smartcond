<?php

use App\Models\Menu\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1 -  Home
        MenuItem::create([
            'menu_id'     => '1',
            'route_id'    => '1',
            'order'       => '1',
            'name'        => 'Home',
            'main'        => '1',
            'description' => 'Item do menu de acesso a página inicial',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 2 - Meu perfil
        MenuItem::create([
            'menu_id'     => '2',
            'route_id'    => '2',
            'order'       => '0',
            'name'        => 'Meu perfil',
            'description' => 'Item do menu oculto de acesso a página do perfil do usuário logado',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 3 - Meu perfil
        MenuItem::create([
            'menu_id'     => '3',
            'route_id'    => '2',
            'order'       => '1',
            'name'        => 'Meu perfil',
            'main'        => '1',
            'description' => 'Item do menu dropdown de acesso a página do perfil do usuário logado',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 4 - Alterar senha
        MenuItem::create([
            'menu_id'     => '4',
            'route_id'    => '3',
            'order'       => '2',
            'name'        => 'Alterar senha',
            'button'      => 'btn-modal-password-reset-profile',
            'main'        => '1',
            'description' => 'Item do menu dropdown de acesso ao modal de alteração de senha do usuário logado',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 5 - Suporte
        MenuItem::create([
            'menu_id'     => '5',
            'route_id'    => '4',
            'order'       => '3',
            'name'        => 'Suporte',
            'button'      => 'btn-modal-send-support-profile',
            'main'        => '1',
            'description' => 'Item do menu dropdown de acesso ao modal de envio de e-mail para o suporte do sistema',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 6 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '5',
            'order'       => '0',
            'name'        => 'Dashboard de administradores',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de dashboard de administradores',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 7 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '6',
            'order'       => '3',
            'name'        => 'Administradores',
            'main'        => '1',
            'description' => 'Item do menu collapse de acesso a página de listagem de administradores',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 8 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '7',
            'order'       => '0',
            'name'        => 'Lista de administradores deletados',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de administradores deletados',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 9 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '8',
            'order'       => '0',
            'name'        => 'Visualizar administrador',
            'button'      => 'btn-modal-view-admin',
            'description' => 'Item do menu da listagem de administradores de acesso ao modal de visualização de administrador',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 10 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '9',
            'order'       => '0',
            'name'        => 'Novo administrador',
            'button'      => 'btn-modal-new-admin',
            'description' => 'Item do menu de acesso ao modal de criação de administrador',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 11 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '10',
            'order'       => '0',
            'name'        => 'Editar administrador',
            'button'      => 'btn-modal-edit-admin',
            'description' => 'Item do menu da listagem de administradores de acesso ao modal de edição de administrador',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 12 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '11',
            'order'       => '0',
            'name'        => 'Bloquear administrador',
            'button'      => 'btn-modal-block-admin',
            'description' => 'Item do menu da listagem de administradores de acesso ao modal de bloqueio de administrador',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 13 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '12',
            'order'       => '0',
            'name'        => 'Deletar administrador',
            'button'      => 'btn-modal-delete-admin',
            'description' => 'Item do menu da listagem de administradores de acesso ao modal de exclusão de administrador',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 14 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '13',
            'order'       => '0',
            'name'        => 'Recuperar administrador',
            'button'      => 'btn-modal-recover-admin',
            'description' => 'Item do menu da listagem de administradores deletados de acesso ao modal de recuperação de administrador',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 15 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '14',
            'order'       => '0',
            'name'        => 'Enviar e-mail para o administrador',
            'button'      => 'btn-modal-send-email-admin',
            'description' => 'Item do menu da listagem de administradores de acesso ao botão de envio de e-mail para o administrador',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 16 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '15',
            'order'       => '0',
            'name'        => 'Reenviar e-mail do administrador',
            'button'      => 'btn-resend-email-admin',
            'description' => 'Item do menu da listagem de administradores de acesso ao botão de reenvio de e-mail de confirmação do administrador',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 17 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '16',
            'order'       => '0',
            'name'        => 'Dashboard de usuários',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de dashboard de usuários',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 18 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '17',
            'order'       => '1',
            'name'        => 'Usuários',
            'main'        => '1',
            'description' => 'Item do menu collapse de acesso a página de listagem de usuários',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 19 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '18',
            'order'       => '0',
            'name'        => 'Lista de usuários deletados',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de usuários deletados',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 20 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '19',
            'order'       => '0',
            'name'        => 'Visualizar usuário',
            'button'      => 'btn-modal-view-user',
            'description' => 'Item do menu da listagem de usuários de acesso ao modal de visualização de usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 21 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '20',
            'order'       => '0',
            'name'        => 'Novo usuário',
            'button'      => 'btn-modal-new-user',
            'description' => 'Item do menu de acesso ao modal de criação de usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 22 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '21',
            'order'       => '0',
            'name'        => 'Editar usuário',
            'button'      => 'btn-modal-edit-user',
            'description' => 'Item do menu da listagem de usuários de acesso ao modal de edição de usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 23 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '22',
            'order'       => '0',
            'name'        => 'Bloquear usuário',
            'button'      => 'btn-modal-block-user',
            'description' => 'Item do menu da listagem de usuários de acesso ao modal de bloqueio de usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 24 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '23',
            'order'       => '0',
            'name'        => 'Deletar usuário',
            'button'      => 'btn-modal-delete-user',
            'description' => 'Item do menu da listagem de usuários de acesso ao modal de exclusão de usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 25 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '24',
            'order'       => '0',
            'name'        => 'Recuperar usuário',
            'button'      => 'btn-modal-recover-user',
            'description' => 'Item do menu da listagem de usuários deletados de acesso ao modal de recuperação de usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 26 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '25',
            'order'       => '0',
            'name'        => 'Enviar e-mail para o usuário',
            'button'      => 'btn-modal-send-email-user',
            'description' => 'Item do menu da listagem de usuários de acesso ao botão de envio de e-mail para o usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 27 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '26',
            'order'       => '0',
            'name'        => 'Reenviar e-mail do usuário',
            'button'      => 'btn-resend-email-user',
            'description' => 'Item do menu da listagem de usuários de acesso ao botão de reenvio de e-mail de confirmação do usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 28 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '27',
            'order'       => '0',
            'name'        => 'Dashboard de empresas',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de dashboard de empresas',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 29 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '28',
            'order'       => '4',
            'name'        => 'Empresas',
            'main'        => '1',
            'description' => 'Item do menu collapse de acesso a página de listagem de empresas',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 30 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '29',
            'order'       => '0',
            'name'        => 'Lista de empresas deletadas',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de empresas deletadas',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 31 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '30',
            'order'       => '0',
            'name'        => 'Lista de administradores',
            'hidden'      => '1',
            'description' => 'Item do modal de visualização de empresa oculto de acesso a página de listagem de administradores da empresa',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 32 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '31',
            'order'       => '0',
            'name'        => 'Visualizar empresa',
            'button'      => 'btn-modal-view-company',
            'description' => 'Item do menu da listagem de empresas de acesso ao modal de visualização de empresa',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 33 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '32',
            'order'       => '0',
            'name'        => 'Nova empresa',
            'button'      => 'btn-modal-new-company',
            'description' => 'Item do menu de acesso ao modal de criação de empresa',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 34 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '33',
            'order'       => '0',
            'name'        => 'Novo administrador',
            'button'      => 'btn-modal-new-admin-company',
            'description' => 'Item do menu da listagem de empresas de acesso ao modal de criação de administrador',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 35 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '34',
            'order'       => '0',
            'name'        => 'Editar empresa',
            'button'      => 'btn-modal-edit-company',
            'description' => 'Item do menu da listagem de empresas de acesso ao modal de edição de empresa',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 36 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '35',
            'order'       => '0',
            'name'        => 'Bloquear empresa',
            'button'      => 'btn-modal-block-company',
            'description' => 'Item do menu da listagem de empresas de acesso ao modal de bloqueio de empresa',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 37 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '36',
            'order'       => '0',
            'name'        => 'Deletar empresa',
            'button'      => 'btn-modal-delete-company',
            'description' => 'Item do menu da listagem de empresas de acesso ao modal de exclusão de empresa',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 38 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '37',
            'order'       => '0',
            'name'        => 'Recuperar empresa',
            'button'      => 'btn-modal-recover-company',
            'description' => 'Item do menu da listagem de empresas deletadas de acesso ao modal de recuperação de empresa',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 39 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '38',
            'order'       => '0',
            'name'        => 'Enviar e-mail para a empresa',
            'button'      => 'btn-modal-send-email-company',
            'description' => 'Item do menu da listagem da empresa de acesso ao botão de envio de e-mail para a empresa',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 40 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '39',
            'order'       => '0',
            'name'        => 'Dashboard de condomínios',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de dashboard de condomínios',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 41 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '40',
            'order'       => '2',
            'name'        => 'Condomínios',
            'main'        => '1',
            'description' => 'Item do menu collapse de acesso a página de listagem de condomínios',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 42 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '41',
            'order'       => '0',
            'name'        => 'Lista de condomínios deletados',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de condomínios deletados',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 43 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '42',
            'order'       => '0',
            'name'        => 'Lista de usuários',
            'hidden'      => '1',
            'description' => 'Item do modal de visualização de condomínio oculto de acesso a página de listagem de usuários do condomínio',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 44 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '43',
            'order'       => '0',
            'name'        => 'Visualizar condomínio',
            'button'      => 'btn-modal-view-entity',
            'description' => 'Item do menu da listagem de condomínios de acesso ao modal de visualização de condomínio',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 45 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '44',
            'order'       => '0',
            'name'        => 'Novo condomínio',
            'button'      => 'btn-modal-new-entity',
            'description' => 'Item do menu de acesso ao modal de criação de condomínio',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 46 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '45',
            'order'       => '0',
            'name'        => 'Novo usuário',
            'button'      => 'btn-modal-new-user-entity',
            'description' => 'Item do menu da listagem de condomínios de acesso ao modal de criação de usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 47 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '46',
            'order'       => '0',
            'name'        => 'Editar condomínio',
            'button'      => 'btn-modal-edit-entity',
            'description' => 'Item do menu da listagem de condomínios de acesso ao modal de edição de condomínio',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 48 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '47',
            'order'       => '0',
            'name'        => 'Bloquear condomínio',
            'button'      => 'btn-modal-block-entity',
            'description' => 'Item do menu da listagem de condomínios de acesso ao modal de bloqueio de condomínio',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 49 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '48',
            'order'       => '0',
            'name'        => 'Deletar condomínio',
            'button'      => 'btn-modal-delete-entity',
            'description' => 'Item do menu da listagem de condomínios de acesso ao modal de exclusão de condomínio',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 50 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '49',
            'order'       => '0',
            'name'        => 'Recuperar condomínio',
            'button'      => 'btn-modal-recover-entity',
            'description' => 'Item do menu da listagem de condomínios deletados de acesso ao modal de recuperação de condomínio',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 51 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '50',
            'order'       => '0',
            'name'        => 'Enviar e-mail para o condomínio',
            'button'      => 'btn-modal-send-email-entity',
            'description' => 'Item do menu da listagem do condomínio de acesso ao botão de envio de e-mail para o condomínio',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 52 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '51',
            'order'       => '5',
            'name'        => 'Permissões',
            'main'        => '1',
            'description' => 'Item do menu collapse de acesso a página de listagem de usuários sem permissões',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 53 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '52',
            'order'       => '0',
            'name'        => 'Editar permissões',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de usuários com permissões',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 54 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '53',
            'order'       => '0',
            'name'        => 'Alterar permissões',
            'button'      => 'btn-edit-permission-user',
            'description' => 'Item do menu da listagem de usuários sem ou com permissões de acesso a página de permissões do usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 55 - Gerenciamento
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '53',
            'order'       => '0',
            'name'        => 'Permissões do usuário',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de permissões do usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 56 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '54',
            'order'       => '0',
            'name'        => 'Dashboard de grupos',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de dashboard de grupos',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 57 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '55',
            'order'       => '1',
            'name'        => 'Grupos',
            'main'        => '1',
            'description' => 'Item do menu collapse de acesso a página de listagem de grupos',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 58 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '56',
            'order'       => '0',
            'name'        => 'Lista de grupos deletados',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de grupos deletados',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 59 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '57',
            'order'       => '0',
            'name'        => 'Visualizar grupo',
            'button'      => 'btn-modal-view-group',
            'description' => 'Item do menu da listagem de grupos de acesso ao modal de visualização de grupo',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 60 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '58',
            'order'       => '0',
            'name'        => 'Novo grupo',
            'button'      => 'btn-modal-new-group',
            'description' => 'Item do menu de acesso ao modal de criação de grupo',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 61 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '59',
            'order'       => '0',
            'name'        => 'Editar grupo',
            'button'      => 'btn-modal-edit-group',
            'description' => 'Item do menu da listagem de grupos de acesso ao modal de edição de grupo',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 62 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '60',
            'order'       => '0',
            'name'        => 'Bloquear grupo',
            'button'      => 'btn-modal-block-group',
            'description' => 'Item do menu da listagem de grupos de acesso ao modal de bloqueio de grupo',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 63 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '61',
            'order'       => '0',
            'name'        => 'Deletar grupo',
            'button'      => 'btn-modal-delete-group',
            'description' => 'Item do menu da listagem de grupos de acesso ao modal de exclusão de grupo',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 64 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '62',
            'order'       => '0',
            'name'        => 'Recuperar grupo',
            'button'      => 'btn-modal-recover-group',
            'description' => 'Item do menu da listagem de grupos deletados de acesso ao modal de recuperação de grupo',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 65 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '63',
            'order'       => '0',
            'name'        => 'Dashboard de rotas',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de dashboard de rotas',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 66 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '64',
            'order'       => '2',
            'name'        => 'Rotas',
            'main'        => '1',
            'description' => 'Item do menu collapse de acesso a página de listagem de rotas',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 67 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '65',
            'order'       => '0',
            'name'        => 'Lista de rotas deletadas',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de rotas deletadas',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 68 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '66',
            'order'       => '0',
            'name'        => 'Visualizar rota',
            'button'      => 'btn-modal-view-route',
            'description' => 'Item do menu da listagem de rotas de acesso ao modal de visualização de rota',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 69 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '67',
            'order'       => '0',
            'name'        => 'Nova rota',
            'button'      => 'btn-modal-new-route',
            'description' => 'Item do menu de acesso ao modal de criação de rota',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 70 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '68',
            'order'       => '0',
            'name'        => 'Editar rota',
            'button'      => 'btn-modal-edit-route',
            'description' => 'Item do menu da listagem de rotas de acesso ao modal de edição de rota',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 71 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '69',
            'order'       => '0',
            'name'        => 'Bloquear rota',
            'button'      => 'btn-modal-block-route',
            'description' => 'Item do menu da listagem de rotas de acesso ao modal de bloqueio de rota',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 72 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '70',
            'order'       => '0',
            'name'        => 'Deletar rota',
            'button'      => 'btn-modal-delete-route',
            'description' => 'Item do menu da listagem de rotas de acesso ao modal de exclusão de rota',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 73 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '71',
            'order'       => '0',
            'name'        => 'Recuperar rota',
            'button'      => 'btn-modal-recover-route',
            'description' => 'Item do menu da listagem de rotas deletadas de acesso ao modal de recuperação de rota',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 74 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '72',
            'order'       => '0',
            'name'        => 'Dashboard de menu',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de dashboard de menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 75 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '73',
            'order'       => '3',
            'name'        => 'Menu',
            'main'        => '1',
            'description' => 'Item do menu collapse de acesso a página de listagem de menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 76 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '74',
            'order'       => '0',
            'name'        => 'Lista de menu deletados',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de menu deletados',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 77 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '75',
            'order'       => '0',
            'name'        => 'Visualizar menu',
            'button'      => 'btn-modal-view-menu',
            'description' => 'Item do menu da listagem de menu de acesso ao modal de visualização de menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 78 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '76',
            'order'       => '0',
            'name'        => 'Novo menu',
            'button'      => 'btn-modal-new-menu',
            'description' => 'Item do menu de acesso ao modal de criação de menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 79 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '77',
            'order'       => '0',
            'name'        => 'Editar menu',
            'button'      => 'btn-modal-edit-menu',
            'description' => 'Item do menu da listagem de menu de acesso ao modal de edição de menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 80 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '78',
            'order'       => '0',
            'name'        => 'Bloquear menu',
            'button'      => 'btn-modal-block-menu',
            'description' => 'Item do menu da listagem de menu de acesso ao modal de bloqueio de menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 81 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '79',
            'order'       => '0',
            'name'        => 'Deletar menu',
            'button'      => 'btn-modal-delete-menu',
            'description' => 'Item do menu da listagem de menu de acesso ao modal de exclusão de menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 82 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '80',
            'order'       => '0',
            'name'        => 'Recuperar menu',
            'button'      => 'btn-modal-recover-menu',
            'description' => 'Item do menu da listagem de menu deletados de acesso ao modal de recuperação de menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 83 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '81',
            'order'       => '0',
            'name'        => 'Dashboard de itens do menu',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de dashboard de itens do menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 84 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '82',
            'order'       => '4',
            'name'        => 'Itens do menu',
            'main'        => '1',
            'description' => 'Item do menu collapse de acesso a página de listagem de itens do menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 85 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '83',
            'order'       => '0',
            'name'        => 'Lista de itens do menu deletados',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de itens do menu deletados',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 86 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '84',
            'order'       => '0',
            'name'        => 'Visualizar item do menu',
            'button'      => 'btn-modal-view-menu-item',
            'description' => 'Item do menu da listagem de itens do menu de acesso ao modal de visualização de item do menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 87 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '85',
            'order'       => '0',
            'name'        => 'Novo item do menu',
            'button'      => 'btn-modal-new-menu-item',
            'description' => 'Item do menu de acesso ao modal de criação de item do menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 88 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '86',
            'order'       => '0',
            'name'        => 'Editar item do menu',
            'button'      => 'btn-modal-edit-menu-item',
            'description' => 'Item do menu da listagem de itens do menu de acesso ao modal de edição de item do menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 89 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '87',
            'order'       => '0',
            'name'        => 'Bloquear item do menu',
            'button'      => 'btn-modal-block-menu-item',
            'description' => 'Item do menu da listagem de itens do menu de acesso ao modal de bloqueio de item do menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 90 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '88',
            'order'       => '0',
            'name'        => 'Deletar item do menu',
            'button'      => 'btn-modal-delete-menu-item',
            'description' => 'Item do menu da listagem de itens do menu de acesso ao modal de exclusão de item do menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 91 - Layout
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '89',
            'order'       => '0',
            'name'        => 'Recuperar item do menu',
            'button'      => 'btn-modal-recover-menu-item',
            'description' => 'Item do menu da listagem de itens do menu deletados de acesso ao modal de recuperação de item do menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 92 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '90',
            'order'       => '0',
            'name'        => 'Dashboard de departamentos',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de dashboard de departamentos',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 93 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '91',
            'order'       => '1',
            'name'        => 'Departamentos',
            'main'        => '1',
            'description' => 'Item do menu collapse de acesso a página de listagem de departamentos',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 94 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '92',
            'order'       => '0',
            'name'        => 'Lista de departamentos deletados',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de departamentos deletados',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 95 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '93',
            'order'       => '0',
            'name'        => 'Visualizar departamento',
            'button'      => 'btn-modal-view-department',
            'description' => 'Item do menu da listagem de departamentos de acesso ao modal de visualização de departamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 96 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '94',
            'order'       => '0',
            'name'        => 'Novo departamento',
            'button'      => 'btn-modal-new-department',
            'description' => 'Item do menu de acesso ao modal de criação de departamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 97 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '95',
            'order'       => '0',
            'name'        => 'Editar departamento',
            'button'      => 'btn-modal-edit-department',
            'description' => 'Item do menu da listagem de departamentos de acesso ao modal de edição de departamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 98 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '96',
            'order'       => '0',
            'name'        => 'Bloquear departamento',
            'button'      => 'btn-modal-block-department',
            'description' => 'Item do menu da listagem de departamentos de acesso ao modal de bloqueio do departamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 99 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '97',
            'order'       => '0',
            'name'        => 'Deletar departamento',
            'button'      => 'btn-modal-delete-department',
            'description' => 'Item do menu da listagem de departamentos de acesso ao modal de exclusão de departamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 100 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '98',
            'order'       => '0',
            'name'        => 'Recuperar departamento',
            'button'      => 'btn-modal-recover-department',
            'description' => 'Item do menu da listagem de departamentos deletados de acesso ao modal de recuperação de departamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 101 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '99',
            'order'       => '0',
            'name'        => 'Dashboard de categorias do inventário',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de dashboard de categorias do inventário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 102 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '100',
            'order'       => '0',
            'name'        => 'Categorias do inventário',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de categorias do inventário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 103 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '101',
            'order'       => '0',
            'name'        => 'Lista de categorias do inventário deletados',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de categorias do inventário deletados',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 104 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '102',
            'order'       => '0',
            'name'        => 'Visualizar categoria do inventário',
            'button'      => 'btn-modal-view-inventory-category',
            'description' => 'Item do menu da listagem de categorias do inventário de acesso ao modal de visualização de categoria do inventário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 105 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '103',
            'order'       => '0',
            'name'        => 'Nova categoria do inventário',
            'button'      => 'btn-modal-new-inventory-category',
            'description' => 'Item do menu de acesso ao modal de criação de categoria do inventário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 106 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '104',
            'order'       => '0',
            'name'        => 'Editar categoria do inventário',
            'button'      => 'btn-modal-edit-inventory-category',
            'description' => 'Item do menu da listagem de categorias do inventário de acesso ao modal de edição de categoria do inventário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 107 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '105',
            'order'       => '0',
            'name'        => 'Bloquear categoria do inventário',
            'button'      => 'btn-modal-block-inventory-category',
            'description' => 'Item do menu da listagem de categorias do inventário de acesso ao modal de bloqueio do categoria do inventário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 108 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '106',
            'order'       => '0',
            'name'        => 'Deletar categoria do inventário',
            'button'      => 'btn-modal-delete-inventory-category',
            'description' => 'Item do menu da listagem de categorias do inventário de acesso ao modal de exclusão de categoria do inventário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 109 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '107',
            'order'       => '0',
            'name'        => 'Recuperar categoria do inventário',
            'button'      => 'btn-modal-recover-inventory-category',
            'description' => 'Item do menu da listagem de categorias do inventário deletados de acesso ao modal de recuperação de categoria do inventário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 110 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '108',
            'order'       => '0',
            'name'        => 'Dashboard de inventário',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de dashboard de inventário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 111 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '109',
            'order'       => '2',
            'name'        => 'Inventário',
            'main'        => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de itens do inventário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 112 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '110',
            'order'       => '0',
            'name'        => 'Lista de itens do inventário deletados',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de itens do inventário deletados',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 113 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '111',
            'order'       => '0',
            'name'        => 'Visualizar item do inventário',
            'button'      => 'btn-modal-view-inventory',
            'description' => 'Item do menu da listagem de itens do inventário de acesso ao modal de visualização de item do inventário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 114 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '112',
            'order'       => '0',
            'name'        => 'Novo item do inventário',
            'button'      => 'btn-modal-new-inventory',
            'description' => 'Item do menu de acesso ao modal de criação de item do inventário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 115 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '113',
            'order'       => '0',
            'name'        => 'Editar item do inventário',
            'button'      => 'btn-modal-edit-inventory',
            'description' => 'Item do menu da listagem de itens do inventário de acesso ao modal de edição de item do inventário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 116 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '114',
            'order'       => '0',
            'name'        => 'Deletar item do inventário',
            'button'      => 'btn-modal-delete-inventory',
            'description' => 'Item do menu da listagem de itens do inventário de acesso ao modal de exclusão de item do inventário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 117 - Administrativo
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '115',
            'order'       => '0',
            'name'        => 'Recuperar item do inventário',
            'button'      => 'btn-modal-recover-inventory',
            'description' => 'Item do menu da listagem de itens do inventário deletados de acesso ao modal de recuperação de item do inventário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 118 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '116',
            'order'       => '0',
            'name'        => 'Dashboard de blocos',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de dashboard de blocos',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 119 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '117',
            'order'       => '1',
            'name'        => 'Blocos',
            'main'        => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de blocos',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 120 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '118',
            'order'       => '0',
            'name'        => 'Lista de blocos deletados',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de blocos deletados',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 121 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '119',
            'order'       => '0',
            'name'        => 'Visualizar blocos',
            'button'      => 'btn-modal-view-condominium-block',
            'description' => 'Item do menu da listagem de blocos de acesso ao modal de visualização de bloco',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 122 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '120',
            'order'       => '0',
            'name'        => 'Novo blocos',
            'button'      => 'btn-modal-new-condominium-block',
            'description' => 'Item do menu de acesso ao modal de criação de bloco',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 123 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '121',
            'order'       => '0',
            'name'        => 'Editar blocos',
            'button'      => 'btn-modal-edit-condominium-block',
            'description' => 'Item do menu da listagem de blocos de acesso ao modal de edição de bloco',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 124 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '122',
            'order'       => '0',
            'name'        => 'Deletar blocos',
            'button'      => 'btn-modal-delete-condominium-block',
            'description' => 'Item do menu da listagem de blocos de acesso ao modal de exclusão de bloco',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 125 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '123',
            'order'       => '0',
            'name'        => 'Recuperar blocos',
            'button'      => 'btn-modal-recover-condominium-block',
            'description' => 'Item do menu da listagem de blocos deletados de acesso ao modal de recuperação de bloco',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 126 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '124',
            'order'       => '0',
            'name'        => 'Dashboard de estacionamentos',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de dashboard de estacionamentos',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 127 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '125',
            'order'       => '3',
            'name'        => 'Estacionamentos',
            'main'        => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de estacionamentos',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 128 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '126',
            'order'       => '0',
            'name'        => 'Lista de estacionamentos deletados',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de estacionamentos deletados',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 129 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '127',
            'order'       => '0',
            'name'        => 'Visualizar estacionamentos',
            'button'      => 'btn-modal-view-condominium-parking',
            'description' => 'Item do menu da listagem de estacionamentos de acesso ao modal de visualização de estacionamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 130 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '128',
            'order'       => '0',
            'name'        => 'Novo estacionamentos',
            'button'      => 'btn-modal-new-condominium-parking',
            'description' => 'Item do menu de acesso ao modal de criação de estacionamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 131 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '129',
            'order'       => '0',
            'name'        => 'Editar estacionamentos',
            'button'      => 'btn-modal-edit-condominium-parking',
            'description' => 'Item do menu da listagem de estacionamentos de acesso ao modal de edição de estacionamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 132 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '130',
            'order'       => '0',
            'name'        => 'Deletar estacionamentos',
            'button'      => 'btn-modal-delete-condominium-parking',
            'description' => 'Item do menu da listagem de estacionamentos de acesso ao modal de exclusão de estacionamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 133 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '131',
            'order'       => '0',
            'name'        => 'Recuperar estacionamentos',
            'button'      => 'btn-modal-recover-condominium-parking',
            'description' => 'Item do menu da listagem de estacionamentos deletados de acesso ao modal de recuperação de estacionamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 134 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '132',
            'order'       => '0',
            'name'        => 'Dashboard de apartamentos',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de dashboard de apartamentos',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 135 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '133',
            'order'       => '2',
            'name'        => 'Apartamentos',
            'main'        => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de apartamentos',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 136 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '134',
            'order'       => '0',
            'name'        => 'Lista de apartamentos deletados',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de apartamentos deletados',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 137 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '135',
            'order'       => '0',
            'name'        => 'Visualizar apartamentos',
            'button'      => 'btn-modal-view-condominium-apartment',
            'description' => 'Item do menu da listagem de apartamentos de acesso ao modal de visualização de apartamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 138 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '136',
            'order'       => '0',
            'name'        => 'Novo apartamentos',
            'button'      => 'btn-modal-new-condominium-apartment',
            'description' => 'Item do menu de acesso ao modal de criação de apartamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 139 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '137',
            'order'       => '0',
            'name'        => 'Editar apartamentos',
            'button'      => 'btn-modal-edit-condominium-apartment',
            'description' => 'Item do menu da listagem de apartamentos de acesso ao modal de edição de apartamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 140 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '138',
            'order'       => '0',
            'name'        => 'Deletar apartamentos',
            'button'      => 'btn-modal-delete-condominium-apartment',
            'description' => 'Item do menu da listagem de apartamentos de acesso ao modal de exclusão de apartamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 141 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '139',
            'order'       => '0',
            'name'        => 'Recuperar apartamentos',
            'button'      => 'btn-modal-recover-condominium-apartment',
            'description' => 'Item do menu da listagem de apartamentos deletados de acesso ao modal de recuperação de apartamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 142 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '140',
            'order'       => '0',
            'name'        => 'Dashboard de serviços',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de dashboard de prestadores de serviços',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 143 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '141',
            'order'       => '2',
            'name'        => 'Serviços',
            'main'        => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de prestadores de serviços',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 144 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '142',
            'order'       => '0',
            'name'        => 'Lista de serviços deletados',
            'hidden'      => '1',
            'description' => 'Item do menu collapse oculto de acesso a página de listagem de prestadores de serviços deletados',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 145 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '143',
            'order'       => '0',
            'name'        => 'Visualizar serviço',
            'button'      => 'btn-modal-view-condominium-service',
            'description' => 'Item do menu da listagem de prestadores de serviços de acesso ao modal de visualização de prestador de serviços',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 146 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '144',
            'order'       => '0',
            'name'        => 'Novo serviço',
            'button'      => 'btn-modal-new-condominium-service',
            'description' => 'Item do menu de acesso ao modal de criação de prestador de serviços',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 147 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '145',
            'order'       => '0',
            'name'        => 'Editar serviço',
            'button'      => 'btn-modal-edit-condominium-service',
            'description' => 'Item do menu da listagem de prestadores de serviços de acesso ao modal de edição de prestador de serviços',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 148 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '146',
            'order'       => '0',
            'name'        => 'Deletar serviço',
            'button'      => 'btn-modal-delete-condominium-service',
            'description' => 'Item do menu da listagem de prestadores de serviços de acesso ao modal de exclusão de prestador de serviços',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // 149 - Condomínio
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '147',
            'order'       => '0',
            'name'        => 'Recuperar serviço',
            'button'      => 'btn-modal-recover-condominium-service',
            'description' => 'Item do menu da listagem de prestadores de serviços deletados de acesso ao modal de recuperação de prestador de serviços',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);
    }
}
