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
        // grupo home
        MenuItem::create([
            'menu_id'     => '1',
            'route_id'    => '1',
            'order'       => '1',
            'name'        => 'Home',
            'description' => 'Item do menu de acesso a página inicial',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // grupo perfil
        MenuItem::create([
            'menu_id'     => '2',
            'route_id'    => '2',
            'order'       => '1',
            'name'        => 'Meu perfil',
            'description' => 'Item do menu oculto de acesso a página do perfil do usuário logado',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '3',
            'route_id'    => '2',
            'order'       => '1',
            'name'        => 'Meu perfil',
            'description' => 'Item do menu dropdown de acesso a página do perfil do usuário logado',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '4',
            'route_id'    => '4',
            'order'       => '2',
            'name'        => 'Alterar senha',
            'button'      => 'btn-modal-password-reset-profile',
            'description' => 'Item do menu dropdown de acesso ao modal de alteração de senha do usuário logado',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '5',
            'route_id'    => '5',
            'order'       => '3',
            'name'        => 'Suporte',
            'button'      => 'btn-modal-send-support-profile',
            'description' => 'Item do menu dropdown de acesso ao modal de envio de e-mail para o suporte do sistema',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // grupo usuários
        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '11',
            'order'       => '1',
            'name'        => 'Dashboard',
            'description' => 'Item do menu collapse de acesso a página de dashboard de usuários',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '19',
            'order'       => '2',
            'name'        => 'Novo usuário',
            'button'      => 'btn-modal-new-user',
            'description' => 'Item do menu collapse de acesso ao modal de criação de usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '12',
            'order'       => '3',
            'name'        => 'Lista de usuários',
            'description' => 'Item do menu collapse de acesso a página de listagem de usuários',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '13',
            'order'       => '4',
            'name'        => 'Lista de usuários deletados',
            'description' => 'Item do menu collapse de acesso a página de listagem de usuários deletados',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '14',
            'order'       => '1',
            'name'        => 'Visualizar usuário',
            'button'      => 'btn-modal-view-user',
            'list'        => '1',
            'description' => 'Item do menu da listagem de usuários de acesso ao modal de visualização de usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '15',
            'order'       => '2',
            'name'        => 'Editar usuário',
            'button'      => 'btn-modal-edit-user',
            'list'        => '1',
            'description' => 'Item do menu da listagem de usuários de acesso ao modal de edição de usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '16',
            'order'       => '3',
            'name'        => 'Bloquear usuário',
            'button'      => 'btn-modal-block-user',
            'list'        => '1',
            'description' => 'Item do menu da listagem de usuários de acesso ao modal de bloqueio de usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '17',
            'order'       => '4',
            'name'        => 'Deletar usuário',
            'button'      => 'btn-modal-delete-user',
            'list'        => '1',
            'description' => 'Item do menu da listagem de usuários de acesso ao modal de exclusão de usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '18',
            'order'       => '1',
            'name'        => 'Recuperar usuário',
            'button'      => 'btn-modal-recover-user',
            'list'        => '1',
            'description' => 'Item do menu da listagem de usuários deletados de acesso ao modal de recuperação de usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '24',
            'order'       => '1',
            'name'        => 'Reenviar e-mail do usuário',
            'button'      => 'btn-resend-email-user',
            'list'        => '1',
            'description' => 'Item do menu da listagem de usuários de acesso ao botão de reenvio de e-mail de confirmação do usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // grupo empresas
        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '32',
            'order'       => '1',
            'name'        => 'Dashboard',
            'description' => 'Item do menu collapse de acesso a página de dashboard de empresas',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '40',
            'order'       => '2',
            'name'        => 'Nova empresa',
            'button'      => 'btn-modal-new-company',
            'description' => 'Item do menu collapse de acesso ao modal de criação de empresa',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '33',
            'order'       => '3',
            'name'        => 'Lista de empresas',
            'description' => 'Item do menu collapse de acesso a página de listagem de empresas',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '34',
            'order'       => '4',
            'name'        => 'Lista de empresas deletadas',
            'description' => 'Item do menu collapse de acesso a página de listagem de empresas deletadas',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '35',
            'order'       => '1',
            'name'        => 'Visualizar empresa',
            'button'      => 'btn-modal-view-company',
            'list'        => '1',
            'description' => 'Item do menu da listagem de empresas de acesso ao modal de visualização de empresa',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '36',
            'order'       => '2',
            'name'        => 'Editar empresa',
            'button'      => 'btn-modal-edit-company',
            'list'        => '1',
            'description' => 'Item do menu da listagem de empresas de acesso ao modal de edição de empresa',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '37',
            'order'       => '3',
            'name'        => 'Bloquear empresa',
            'button'      => 'btn-modal-block-company',
            'list'        => '1',
            'description' => 'Item do menu da listagem de empresas de acesso ao modal de bloqueio de empresa',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '38',
            'order'       => '4',
            'name'        => 'Deletar empresa',
            'button'      => 'btn-modal-delete-company',
            'list'        => '1',
            'description' => 'Item do menu da listagem de empresas de acesso ao modal de exclusão de empresa',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '39',
            'order'       => '1',
            'name'        => 'Recuperar empresa',
            'button'      => 'btn-modal-recover-company',
            'list'        => '1',
            'description' => 'Item do menu da listagem de empresas deletadas de acesso ao modal de recuperação de empresa',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '6',
            'route_id'    => '49',
            'order'       => '1',
            'name'        => 'Enviar e-mail para o usuário',
            'button'      => 'btn-send-email-user',
            'list'        => '1',
            'description' => 'Item do menu da listagem de usuários de acesso ao botão de envio de e-mail para o usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '7',
            'route_id'    => '50',
            'order'       => '1',
            'name'        => 'Enviar e-mail para a empresa',
            'button'      => 'btn-send-email-company',
            'list'        => '1',
            'description' => 'Item do menu da listagem da empresa de acesso ao botão de envio de e-mail para a empresa',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // grupo rotas
        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '52',
            'order'       => '1',
            'name'        => 'Dashboard',
            'description' => 'Item do menu collapse de acesso a página de dashboard de rotas',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '60',
            'order'       => '2',
            'name'        => 'Novo grupo',
            'button'      => 'btn-modal-new-group',
            'description' => 'Item do menu collapse de acesso ao modal de criação de grupos',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '72',
            'order'       => '3',
            'name'        => 'Nova rota',
            'button'      => 'btn-modal-new-route',
            'description' => 'Item do menu collapse de acesso ao modal de criação de rotas',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '53',
            'order'       => '4',
            'name'        => 'Lista de grupos',
            'description' => 'Item do menu collapse de acesso a página de listagem de grupos',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '65',
            'order'       => '5',
            'name'        => 'Lista de rotas',
            'description' => 'Item do menu collapse de acesso a página de listagem de rotas',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '54',
            'order'       => '6',
            'name'        => 'Lista de grupos deletados',
            'description' => 'Item do menu collapse de acesso a página de listagem de grupos deletados',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '66',
            'order'       => '7',
            'name'        => 'Lista de rotas deletadas',
            'description' => 'Item do menu collapse de acesso a página de listagem de rotas deletadas',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '55',
            'order'       => '1',
            'name'        => 'Visualizar grupo',
            'button'      => 'btn-modal-view-group',
            'list'        => '1',
            'description' => 'Item do menu da listagem de grupos de acesso ao modal de visualização de grupo',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '67',
            'order'       => '1',
            'name'        => 'Visualizar rota',
            'button'      => 'btn-modal-view-route',
            'list'        => '1',
            'description' => 'Item do menu da listagem de rotas de acesso ao modal de visualização de rota',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '56',
            'order'       => '2',
            'name'        => 'Editar grupo',
            'button'      => 'btn-modal-edit-group',
            'list'        => '1',
            'description' => 'Item do menu da listagem de grupos de acesso ao modal de edição de grupo',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '68',
            'order'       => '2',
            'name'        => 'Editar rota',
            'button'      => 'btn-modal-edit-route',
            'list'        => '1',
            'description' => 'Item do menu da listagem de rotas de acesso ao modal de edição de rota',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '57',
            'order'       => '3',
            'name'        => 'Bloquear grupo',
            'button'      => 'btn-modal-block-group',
            'list'        => '1',
            'description' => 'Item do menu da listagem de grupos de acesso ao modal de bloqueio de grupo',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '69',
            'order'       => '3',
            'name'        => 'Bloquear rota',
            'button'      => 'btn-modal-block-route',
            'list'        => '1',
            'description' => 'Item do menu da listagem de rotas de acesso ao modal de bloqueio de rota',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '58',
            'order'       => '4',
            'name'        => 'Deletar grupo',
            'button'      => 'btn-modal-delete-group',
            'list'        => '1',
            'description' => 'Item do menu da listagem de grupos de acesso ao modal de exclusão de grupo',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '70',
            'order'       => '4',
            'name'        => 'Deletar rota',
            'button'      => 'btn-modal-delete-route',
            'list'        => '1',
            'description' => 'Item do menu da listagem de rotas de acesso ao modal de exclusão de rota',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '59',
            'order'       => '1',
            'name'        => 'Recuperar grupo',
            'button'      => 'btn-modal-recover-group',
            'list'        => '1',
            'description' => 'Item do menu da listagem de grupos deletados de acesso ao modal de recuperação de grupo',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '8',
            'route_id'    => '71',
            'order'       => '1',
            'name'        => 'Recuperar rota',
            'button'      => 'btn-modal-recover-route',
            'list'        => '1',
            'description' => 'Item do menu da listagem de rotas deletadas de acesso ao modal de recuperação de rota',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // grupo menu
        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '78',
            'order'       => '1',
            'name'        => 'Dashboard',
            'description' => 'Item do menu collapse de acesso a página de dashboard de menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '86',
            'order'       => '2',
            'name'        => 'Novo menu',
            'button'      => 'btn-modal-new-menu',
            'description' => 'Item do menu collapse de acesso ao modal de criação de menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '98',
            'order'       => '3',
            'name'        => 'Novo item do menu',
            'button'      => 'btn-modal-new-menu-item',
            'description' => 'Item do menu collapse de acesso ao modal de criação de item do menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '79',
            'order'       => '4',
            'name'        => 'Lista de menu',
            'description' => 'Item do menu collapse de acesso a página de listagem de menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '91',
            'order'       => '5',
            'name'        => 'Lista de itens do menu',
            'description' => 'Item do menu collapse de acesso a página de listagem de itens do menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '80',
            'order'       => '6',
            'name'        => 'Lista de menu deletados',
            'description' => 'Item do menu collapse de acesso a página de listagem de menu deletados',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '92',
            'order'       => '7',
            'name'        => 'Lista de itens do menu deletados',
            'description' => 'Item do menu collapse de acesso a página de listagem de itens do menu deletados',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '81',
            'order'       => '1',
            'name'        => 'Visualizar menu',
            'button'      => 'btn-modal-view-menu',
            'list'        => '1',
            'description' => 'Item do menu da listagem de menu de acesso ao modal de visualização de menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '93',
            'order'       => '1',
            'name'        => 'Visualizar item do menu',
            'button'      => 'btn-modal-view-menu-item',
            'list'        => '1',
            'description' => 'Item do menu da listagem de itens do menu de acesso ao modal de visualização de item do menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '82',
            'order'       => '2',
            'name'        => 'Editar menu',
            'button'      => 'btn-modal-edit-menu',
            'list'        => '1',
            'description' => 'Item do menu da listagem de menu de acesso ao modal de edição de menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '94',
            'order'       => '2',
            'name'        => 'Editar item do menu',
            'button'      => 'btn-modal-edit-menu-item',
            'list'        => '1',
            'description' => 'Item do menu da listagem de itens do menu de acesso ao modal de edição de itens do menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '83',
            'order'       => '3',
            'name'        => 'Bloquear menu',
            'button'      => 'btn-modal-block-menu',
            'list'        => '1',
            'description' => 'Item do menu da listagem de menu de acesso ao modal de bloqueio de menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '95',
            'order'       => '3',
            'name'        => 'Bloquear item do menu',
            'button'      => 'btn-modal-block-menu-item',
            'list'        => '1',
            'description' => 'Item do menu da listagem de itens do menu de acesso ao modal de bloqueio de item do menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '84',
            'order'       => '4',
            'name'        => 'Deletar menu',
            'button'      => 'btn-modal-delete-menu',
            'list'        => '1',
            'description' => 'Item do menu da listagem de menu de acesso ao modal de exclusão de menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '96',
            'order'       => '4',
            'name'        => 'Deletar item do menu',
            'button'      => 'btn-modal-delete-menu-item',
            'list'        => '1',
            'description' => 'Item do menu da listagem de itens do menu de acesso ao modal de exclusão de item do menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '85',
            'order'       => '1',
            'name'        => 'Recuperar menu',
            'button'      => 'btn-modal-recover-menu',
            'list'        => '1',
            'description' => 'Item do menu da listagem de menu deletados de acesso ao modal de recuperação de menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '9',
            'route_id'    => '97',
            'order'       => '1',
            'name'        => 'Recuperar item do menu',
            'button'      => 'btn-modal-recover-menu-item',
            'list'        => '1',
            'description' => 'Item do menu da listagem de itens do menu deletados de acesso ao modal de recuperação de item do menu',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // grupo permissões
        MenuItem::create([
            'menu_id'     => '10',
            'route_id'    => '107',
            'order'       => '1',
            'name'        => 'Usuários sem permissões',
            'description' => 'Item do menu collapse de acesso a página de listagem de usuários sem permissões',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '10',
            'route_id'    => '108',
            'order'       => '1',
            'name'        => 'Editar permissão',
            'button'      => 'btn-edit-permission-user',
            'list'        => '1',
            'description' => 'Item do menu da listagem de usuários sem permissões de acesso a página de permissões do usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '10',
            'route_id'    => '108',
            'order'       => '1',
            'hidden'      => '1',
            'name'        => 'Permissões do usuário',
            'description' => 'Item do menu collapse oculto de acesso a página de permissões do usuário',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '10',
            'route_id'    => '110',
            'order'       => '2',
            'name'        => 'Usuários com permissões',
            'description' => 'Item do menu collapse de acesso a página de listagem de usuários com permissões',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        // grupo departamentos
        MenuItem::create([
            'menu_id'     => '11',
            'route_id'    => '112',
            'order'       => '1',
            'name'        => 'Dashboard',
            'description' => 'Item do menu collapse de acesso a página de dashboard de departamentos',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '11',
            'route_id'    => '120',
            'order'       => '2',
            'name'        => 'Novo departamento',
            'button'      => 'btn-modal-new-department',
            'description' => 'Item do menu collapse de acesso ao modal de criação de departamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '11',
            'route_id'    => '113',
            'order'       => '3',
            'name'        => 'Lista de departamentos',
            'description' => 'Item do menu collapse de acesso a página de listagem de departamentos',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '11',
            'route_id'    => '114',
            'order'       => '4',
            'name'        => 'Lista de departamentos deletados',
            'description' => 'Item do menu collapse de acesso a página de listagem de departamnentos deletados',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '11',
            'route_id'    => '115',
            'order'       => '1',
            'name'        => 'Visualizar departamento',
            'button'      => 'btn-modal-view-department',
            'list'        => '1',
            'description' => 'Item do menu da listagem de departamentos de acesso ao modal de visualização de departamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '11',
            'route_id'    => '116',
            'order'       => '2',
            'name'        => 'Editar departamento',
            'button'      => 'btn-modal-edit-department',
            'list'        => '1',
            'description' => 'Item do menu da listagem de departamentos de acesso ao modal de edição de departamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '11',
            'route_id'    => '117',
            'order'       => '3',
            'name'        => 'Bloquear departamento',
            'button'      => 'btn-modal-block-department',
            'list'        => '1',
            'description' => 'Item do menu da listagem de departamentos de acesso ao modal de bloqueio de departamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '11',
            'route_id'    => '118',
            'order'       => '4',
            'name'        => 'Deletar departamento',
            'button'      => 'btn-modal-delete-department',
            'list'        => '1',
            'description' => 'Item do menu da listagem de departamentos de acesso ao modal de exclusão de departamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);

        MenuItem::create([
            'menu_id'     => '11',
            'route_id'    => '119',
            'order'       => '1',
            'name'        => 'Recuperar departamento',
            'button'      => 'btn-modal-recover-department',
            'list'        => '1',
            'description' => 'Item do menu da listagem de departamentos deletados de acesso ao modal de recuperação de departamento',
            'created_at'  => now(),
            'updated_at'  => now()
        ]);
    }
}
