<?php

use App\Models\Route\Route;
use Illuminate\Database\Seeder;

class RoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1 - home
        Route::create([
            'group_id'        => '1',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'index',
            'route'           => 'home.index',
            'controller'      => 'HomeController@index',
            'description'     => 'Página inicial',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 2 - perfil
        Route::create([
            'group_id'        => '2',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'editar',
            'route'           => 'profile.edit',
            'controller'      => 'Profile\ProfileController@edit',
            'description'     => 'Página do perfil do usuário logado',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 3 - perfil
        Route::create([
            'group_id'        => '2',
            'route_option_id' => '2',
            'url'             => 'senha/{id?}',
            'route'           => 'profile.password.reset',
            'controller'      => 'Profile\ProfileController@passwordReset',
            'description'     => 'Modal de atualizar a senha do usuário logado',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 4 - perfil
        Route::create([
            'group_id'        => '2',
            'route_option_id' => '2',
            'url'             => 'suporte',
            'route'           => 'profile.send.support',
            'controller'      => 'Profile\ProfileController@support',
            'description'     => 'Modal de envio de e-mail para o suporte técnico do sistema',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 5 - administradores
        Route::create([
            'group_id'        => '3',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'dashboard',
            'route'           => 'admin.dashboard',
            'controller'      => 'Management\Admin\DashboardController@dashboard',
            'description'     => 'Página de dashboard dos administradores',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 6 - administradores
        Route::create([
            'group_id'        => '3',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista',
            'route'           => 'admin.list',
            'controller'      => 'Management\Admin\AdminController@list',
            'description'     => 'Página de listagem dos administradores',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 7 - administradores
        Route::create([
            'group_id'        => '3',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/deletados',
            'route'           => 'admin.list.deleted',
            'controller'      => 'Management\Admin\AdminController@listDeleted',
            'description'     => 'Página de listagem dos administradores deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 8 - administradores
        Route::create([
            'group_id'        => '3',
            'route_option_id' => '1',
            'url'             => 'visualizar/{id?}',
            'route'           => 'admin.view',
            'controller'      => 'Management\Admin\AdminController@edit',
            'description'     => 'Modal de visualizar os dados do administrador',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 9 - administradores
        Route::create([
            'group_id'        => '3',
            'route_option_id' => '2',
            'url'             => 'novo',
            'route'           => 'admin.store',
            'controller'      => 'Management\Admin\AdminController@store',
            'description'     => 'Modal de criar novo administrador',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 10 - administradores
        Route::create([
            'group_id'        => '3',
            'route_option_id' => '1',
            'url'             => 'editar/{id?}',
            'route'           => 'admin.edit',
            'controller'      => 'Management\Admin\AdminController@edit',
            'description'     => 'Modal de editar os dados do administrador',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 11 - administradores
        Route::create([
            'group_id'        => '3',
            'route_option_id' => '1',
            'url'             => 'banir/{id?}',
            'route'           => 'admin.ban',
            'controller'      => 'Management\Admin\AdminController@edit',
            'description'     => 'Modal de bloquear e desbloquear o administrador',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 12 - administradores
        Route::create([
            'group_id'        => '3',
            'route_option_id' => '1',
            'url'             => 'deletar/{id?}',
            'route'           => 'admin.delete',
            'controller'      => 'Management\Admin\AdminController@edit',
            'description'     => 'Modal de deletar o administrador',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 13 - administradores
        Route::create([
            'group_id'        => '3',
            'route_option_id' => '1',
            'url'             => 'recuperar/{id?}',
            'route'           => 'admin.recover',
            'controller'      => 'Management\Admin\AdminController@edit',
            'description'     => 'Modal de recuperar o administrador',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 14 - administradores
        Route::create([
            'group_id'        => '3',
            'route_option_id' => '2',
            'url'             => 'enviar/email',
            'route'           => 'admin.send.email',
            'controller'      => 'Management\Admin\AdminController@sendEmail',
            'description'     => 'Enviar e-mail para o administrador',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 15 - administradores
        Route::create([
            'group_id'        => '3',
            'route_option_id' => '2',
            'url'             => 'reenviar/email',
            'route'           => 'admin.resend.email',
            'controller'      => 'Management\Admin\AdminController@resendEmail',
            'description'     => 'Reenviar o e-mail de confirmação de e-mail do administrador',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 16 - usuarios
        Route::create([
            'group_id'        => '4',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'dashboard',
            'route'           => 'user.dashboard',
            'controller'      => 'Management\User\DashboardController@dashboard',
            'description'     => 'Página de dashboard dos usuários',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 17 - usuarios
        Route::create([
            'group_id'        => '4',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista',
            'route'           => 'user.list',
            'controller'      => 'Management\User\UserController@list',
            'description'     => 'Página de listagem dos usuários',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 18 - usuarios
        Route::create([
            'group_id'        => '4',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/deletados',
            'route'           => 'user.list.deleted',
            'controller'      => 'Management\User\UserController@listDeleted',
            'description'     => 'Página de listagem dos usuários deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 19 - usuarios
        Route::create([
            'group_id'        => '4',
            'route_option_id' => '1',
            'url'             => 'visualizar/{id?}',
            'route'           => 'user.view',
            'controller'      => 'Management\User\UserController@edit',
            'description'     => 'Modal de visualizar os dados do usuário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 20 - usuarios
        Route::create([
            'group_id'        => '4',
            'route_option_id' => '2',
            'url'             => 'novo',
            'route'           => 'user.store',
            'controller'      => 'Management\User\UserController@store',
            'description'     => 'Modal de criar novo usuário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 21 - usuarios
        Route::create([
            'group_id'        => '4',
            'route_option_id' => '1',
            'url'             => 'editar/{id?}',
            'route'           => 'user.edit',
            'controller'      => 'Management\User\UserController@edit',
            'description'     => 'Modal de editar os dados do usuário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 22 - usuarios
        Route::create([
            'group_id'        => '4',
            'route_option_id' => '1',
            'url'             => 'banir/{id?}',
            'route'           => 'user.ban',
            'controller'      => 'Management\User\UserController@edit',
            'description'     => 'Modal de bloquear e desbloquear o usuário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 23 - usuarios
        Route::create([
            'group_id'        => '4',
            'route_option_id' => '1',
            'url'             => 'deletar/{id?}',
            'route'           => 'user.delete',
            'controller'      => 'Management\User\UserController@edit',
            'description'     => 'Modal de deletar o usuário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 24 - usuarios
        Route::create([
            'group_id'        => '4',
            'route_option_id' => '1',
            'url'             => 'recuperar/{id?}',
            'route'           => 'user.recover',
            'controller'      => 'Management\User\UserController@edit',
            'description'     => 'Modal de recuperar o usuário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 25 - usuarios
        Route::create([
            'group_id'        => '4',
            'route_option_id' => '2',
            'url'             => 'enviar/email',
            'route'           => 'user.send.email',
            'controller'      => 'Management\User\UserController@sendEmail',
            'description'     => 'Enviar e-mail para o usuário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 26 - usuarios
        Route::create([
            'group_id'        => '4',
            'route_option_id' => '2',
            'url'             => 'reenviar/email',
            'route'           => 'user.resend.email',
            'controller'      => 'Management\User\UserController@resendEmail',
            'description'     => 'Reenviar o e-mail de confirmação de e-mail do usuário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 27 - empresas
        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'dashboard',
            'route'           => 'company.dashboard',
            'controller'      => 'Management\Company\DashboardController@dashboard',
            'description'     => 'Página de dashboard das empresas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 28 - empresas
        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista',
            'route'           => 'company.list',
            'controller'      => 'Management\Company\CompanyController@list',
            'description'     => 'Página de listagem das empresas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 29 - empresas
        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/deletados',
            'route'           => 'company.list.deleted',
            'controller'      => 'Management\Company\CompanyController@listDeleted',
            'description'     => 'Página de listagem das empresas deletadas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 30 - empresas
        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/administradores',
            'route'           => 'company.list.admins',
            'controller'      => 'Management\Company\CompanyController@listAdmins',
            'description'     => 'Página de listagem dos administradores da empresa',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 31 - empresas
        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'url'             => 'visualizar/{id?}',
            'route'           => 'company.view',
            'controller'      => 'Management\Company\CompanyController@edit',
            'description'     => 'Modal de visualizar os dados da empresa',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 32 - empresas
        Route::create([
            'group_id'        => '5',
            'route_option_id' => '2',
            'url'             => 'novo',
            'route'           => 'company.store',
            'controller'      => 'Management\Company\CompanyController@store',
            'description'     => 'Modal de criar nova empresa',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 33 - empresas
        Route::create([
            'group_id'        => '5',
            'route_option_id' => '2',
            'url'             => 'novo/administrador',
            'route'           => 'company.admin.store',
            'controller'      => 'Management\Company\CompanyController@storeAdmin',
            'description'     => 'Modal de criar novo administrador',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 34 - empresas
        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'url'             => 'editar/{id?}',
            'route'           => 'company.edit',
            'controller'      => 'Management\Company\CompanyController@edit',
            'description'     => 'Modal de editar os dados da empresa',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 35 - empresas
        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'url'             => 'banir/{id?}',
            'route'           => 'company.ban',
            'controller'      => 'Management\Company\CompanyController@edit',
            'description'     => 'Modal de bloquear e desbloquear a empresa',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 36 - empresas
        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'url'             => 'deletar/{id?}',
            'route'           => 'company.delete',
            'controller'      => 'Management\Company\CompanyController@edit',
            'description'     => 'Modal de deletar a empresa',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 37 - empresas
        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'url'             => 'recuperar/{id?}',
            'route'           => 'company.recover',
            'controller'      => 'Management\Company\CompanyController@edit',
            'description'     => 'Modal de recuperar a empresa',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 38 - empresas
        Route::create([
            'group_id'        => '5',
            'route_option_id' => '2',
            'url'             => 'enviar/email',
            'route'           => 'company.send.email',
            'controller'      => 'Management\Company\CompanyController@sendEmail',
            'description'     => 'Enviar e-mail para a empresa',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 39 - condominios
        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'dashboard',
            'route'           => 'entity.dashboard',
            'controller'      => 'Management\Entity\DashboardController@dashboard',
            'description'     => 'Página de dashboard dos condomínios',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 40 - condominios
        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista',
            'route'           => 'entity.list',
            'controller'      => 'Management\Entity\EntityController@list',
            'description'     => 'Página de listagem dos condomínios',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 41 - condominios
        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/deletados',
            'route'           => 'entity.list.deleted',
            'controller'      => 'Management\Entity\EntityController@listDeleted',
            'description'     => 'Página de listagem dos condomínios deletadas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 42 - condominios
        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/usuarios',
            'route'           => 'entity.list.users',
            'controller'      => 'Management\Entity\EntityController@listUsers',
            'description'     => 'Página de listagem dos usuários do condomínio',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 43 - condominios
        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'url'             => 'visualizar/{id?}',
            'route'           => 'entity.view',
            'controller'      => 'Management\Entity\EntityController@edit',
            'description'     => 'Modal de visualizar os dados do condomínio',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 44 - condominios
        Route::create([
            'group_id'        => '6',
            'route_option_id' => '2',
            'url'             => 'nova',
            'route'           => 'entity.store',
            'controller'      => 'Management\Entity\EntityController@store',
            'description'     => 'Modal de criar novo condomínio',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 45 - condominios
        Route::create([
            'group_id'        => '6',
            'route_option_id' => '2',
            'url'             => 'novo/usuario',
            'route'           => 'entity.user.store',
            'controller'      => 'Management\Entity\EntityController@storeUser',
            'description'     => 'Modal de criar novo usuário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 46 - condominios
        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'url'             => 'editar/{id?}',
            'route'           => 'entity.edit',
            'controller'      => 'Management\Entity\EntityController@edit',
            'description'     => 'Modal de editar os dados do condomínio',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 47 - condominios
        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'url'             => 'banir/{id?}',
            'route'           => 'entity.ban',
            'controller'      => 'Management\Entity\EntityController@edit',
            'description'     => 'Modal de bloquear e desbloquear o condomínio',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 48 - condominios
        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'url'             => 'deletar/{id?}',
            'route'           => 'entity.delete',
            'controller'      => 'Management\Entity\EntityController@edit',
            'description'     => 'Modal de deletar o condomínio',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 49 - condominios
        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'url'             => 'recuperar/{id?}',
            'route'           => 'entity.recover',
            'controller'      => 'Management\Entity\EntityController@edit',
            'description'     => 'Modal de recuperar o condomínio',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 50 - condominios
        Route::create([
            'group_id'        => '6',
            'route_option_id' => '2',
            'url'             => 'enviar/email',
            'route'           => 'entity.send.email',
            'controller'      => 'Management\Entity\EntityController@sendEmail',
            'description'     => 'Enviar e-mail para o condomínio',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 51 - permissoes
        Route::create([
            'group_id'        => '7',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/sem-permissoes',
            'route'           => 'permission.user.list.without',
            'controller'      => 'Management\PermissionController@listWithout',
            'description'     => 'Página de listagem dos usuários sem permissões',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 52 - permissoes
        Route::create([
            'group_id'        => '7',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/com-permissoes',
            'route'           => 'permission.user.list.with',
            'controller'      => 'Management\PermissionController@listWith',
            'description'     => 'Página de listagem dos usuários com permissões',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 53 - permissoes
        Route::create([
            'group_id'        => '7',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'usuario/editar',
            'route'           => 'permission.user.edit',
            'controller'      => 'Management\PermissionController@edit',
            'description'     => 'Página de edição das permissões do usuário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 54 - grupos
        Route::create([
            'group_id'        => '8',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'dashboard',
            'route'           => 'group.dashboard',
            'controller'      => 'Layout\Group\DashboardController@dashboard',
            'description'     => 'Página de dashboard dos grupos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 55 - grupos
        Route::create([
            'group_id'        => '8',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista',
            'route'           => 'group.list',
            'controller'      => 'Layout\Group\GroupController@list',
            'description'     => 'Página de listagem dos grupos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 56 - grupos
        Route::create([
            'group_id'        => '8',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/deletados',
            'route'           => 'group.list.deleted',
            'controller'      => 'Layout\Group\GroupController@listDeleted',
            'description'     => 'Página de listagem dos grupos deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 57 - grupos
        Route::create([
            'group_id'        => '8',
            'route_option_id' => '1',
            'url'             => 'visualizar/{id?}',
            'route'           => 'group.view',
            'controller'      => 'Layout\Group\GroupController@edit',
            'description'     => 'Modal de visualizar os dados do grupo',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 58 - grupos
        Route::create([
            'group_id'        => '8',
            'route_option_id' => '2',
            'url'             => 'novo',
            'route'           => 'group.store',
            'controller'      => 'Layout\Group\GroupController@store',
            'description'     => 'Modal de criar novo grupo',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 59 - grupos
        Route::create([
            'group_id'        => '8',
            'route_option_id' => '1',
            'url'             => 'editar/{id?}',
            'route'           => 'group.edit',
            'controller'      => 'Layout\Group\GroupController@edit',
            'description'     => 'Modal de editar os dados do grupo',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 60 - grupos
        Route::create([
            'group_id'        => '8',
            'route_option_id' => '1',
            'url'             => 'banir/{id?}',
            'route'           => 'group.ban',
            'controller'      => 'Layout\Group\GroupController@edit',
            'description'     => 'Modal de bloquear e desbloquear o grupo',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 61 - grupos
        Route::create([
            'group_id'        => '8',
            'route_option_id' => '1',
            'url'             => 'deletar/{id?}',
            'route'           => 'group.delete',
            'controller'      => 'Layout\Group\GroupController@edit',
            'description'     => 'Modal de deletar o grupo',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 62 - grupos
        Route::create([
            'group_id'        => '8',
            'route_option_id' => '1',
            'url'             => 'recuperar/{id?}',
            'route'           => 'group.recover',
            'controller'      => 'Layout\Group\GroupController@edit',
            'description'     => 'Modal de recuperar o grupo',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 63 - rotas
        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'dashboard',
            'route'           => 'route.dashboard',
            'controller'      => 'Layout\Route\DashboardController@dashboard',
            'description'     => 'Página de dashboard das rotas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 64 - rotas
        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista',
            'route'           => 'route.list',
            'controller'      => 'Layout\Route\RouteController@list',
            'description'     => 'Página de listagem das rotas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 65 - rotas
        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/deletados',
            'route'           => 'route.list.deleted',
            'controller'      => 'Layout\Route\RouteController@listDeleted',
            'description'     => 'Página de listagem das rotas deletadas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 66 - rotas
        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'url'             => 'visualizar/{id?}',
            'route'           => 'route.view',
            'controller'      => 'Layout\Route\RouteController@edit',
            'description'     => 'Modal de visualizar os dados da rota',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 67 - rotas
        Route::create([
            'group_id'        => '9',
            'route_option_id' => '2',
            'url'             => 'novo',
            'route'           => 'route.store',
            'controller'      => 'Layout\Route\RouteController@store',
            'description'     => 'Modal de criar nova rota',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 68 - rotas
        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'url'             => 'editar/{id?}',
            'route'           => 'route.edit',
            'controller'      => 'Layout\Route\RouteController@edit',
            'description'     => 'Modal de editar os dados da rota',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 69 - rotas
        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'url'             => 'banir/{id?}',
            'route'           => 'route.ban',
            'controller'      => 'Layout\Route\RouteController@edit',
            'description'     => 'Modal de bloquear e desbloquear a rota',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 70 - rotas
        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'url'             => 'deletar/{id?}',
            'route'           => 'route.delete',
            'controller'      => 'Layout\Route\RouteController@edit',
            'description'     => 'Modal de deletar a rota',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 71 - rotas
        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'url'             => 'recuperar/{id?}',
            'route'           => 'route.recover',
            'controller'      => 'Layout\Route\RouteController@edit',
            'description'     => 'Modal de recuperar a rota',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 72 - menu
        Route::create([
            'group_id'        => '10',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'dashboard',
            'route'           => 'menu.dashboard',
            'controller'      => 'Layout\Menu\DashboardController@dashboard',
            'description'     => 'Página de dashboard dos menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 73 - menu
        Route::create([
            'group_id'        => '10',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista',
            'route'           => 'menu.list',
            'controller'      => 'Layout\Menu\MenuController@list',
            'description'     => 'Página de listagem dos menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 74 - menu
        Route::create([
            'group_id'        => '10',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/deletados',
            'route'           => 'menu.list.deleted',
            'controller'      => 'Layout\Menu\MenuController@listDeleted',
            'description'     => 'Página de listagem dos menu deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 75 - menu
        Route::create([
            'group_id'        => '10',
            'route_option_id' => '1',
            'url'             => 'visualizar/{id?}',
            'route'           => 'menu.view',
            'controller'      => 'Layout\Menu\MenuController@edit',
            'description'     => 'Modal de visualizar os dados do menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 76 - menu
        Route::create([
            'group_id'        => '10',
            'route_option_id' => '2',
            'url'             => 'novo',
            'route'           => 'menu.store',
            'controller'      => 'Layout\Menu\MenuController@store',
            'description'     => 'Modal de criar novo menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 77 - menu
        Route::create([
            'group_id'        => '10',
            'route_option_id' => '1',
            'url'             => 'editar/{id?}',
            'route'           => 'menu.edit',
            'controller'      => 'Layout\Menu\MenuController@edit',
            'description'     => 'Modal de editar os dados do menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 78 - menu
        Route::create([
            'group_id'        => '10',
            'route_option_id' => '1',
            'url'             => 'banir/{id?}',
            'route'           => 'menu.ban',
            'controller'      => 'Layout\Menu\MenuController@edit',
            'description'     => 'Modal de bloquear e desbloquear o menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 79 - menu
        Route::create([
            'group_id'        => '10',
            'route_option_id' => '1',
            'url'             => 'deletar/{id?}',
            'route'           => 'menu.delete',
            'controller'      => 'Layout\Menu\MenuController@edit',
            'description'     => 'Modal de deletar o menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 80 - menu
        Route::create([
            'group_id'        => '10',
            'route_option_id' => '1',
            'url'             => 'recuperar/{id?}',
            'route'           => 'menu.recover',
            'controller'      => 'Layout\Menu\MenuController@edit',
            'description'     => 'Modal de recuperar o menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 81 - menu-itens
        Route::create([
            'group_id'        => '11',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'dashboard',
            'route'           => 'menu.item.dashboard',
            'controller'      => 'Layout\MenuItem\DashboardController@dashboard',
            'description'     => 'Página de dashboard dos itens do menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 82 - menu-itens
        Route::create([
            'group_id'        => '11',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista',
            'route'           => 'menu.item.list',
            'controller'      => 'Layout\MenuItem\MenuItemController@list',
            'description'     => 'Página de listagem dos itens do menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 83 - menu-itens
        Route::create([
            'group_id'        => '11',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/deletados',
            'route'           => 'menu.item.list.deleted',
            'controller'      => 'Layout\MenuItem\MenuItemController@listDeleted',
            'description'     => 'Página de listagem dos itens do menu deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 84 - menu-itens
        Route::create([
            'group_id'        => '11',
            'route_option_id' => '1',
            'url'             => 'visualizar/{id?}',
            'route'           => 'menu.item.view',
            'controller'      => 'Layout\MenuItem\MenuItemController@edit',
            'description'     => 'Modal de visualizar os dados do item do menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 85 - menu-itens
        Route::create([
            'group_id'        => '11',
            'route_option_id' => '2',
            'url'             => 'novo',
            'route'           => 'menu.item.store',
            'controller'      => 'Layout\MenuItem\MenuItemController@store',
            'description'     => 'Modal de criar novo item do menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 86 - menu-itens
        Route::create([
            'group_id'        => '11',
            'route_option_id' => '1',
            'url'             => 'editar/{id?}',
            'route'           => 'menu.item.edit',
            'controller'      => 'Layout\MenuItem\MenuItemController@edit',
            'description'     => 'Modal de editar os dados do item do menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 87 - menu-itens
        Route::create([
            'group_id'        => '11',
            'route_option_id' => '1',
            'url'             => 'banir/{id?}',
            'route'           => 'menu.item.ban',
            'controller'      => 'Layout\MenuItem\MenuItemController@edit',
            'description'     => 'Modal de bloquear e desbloquear o item do menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 88 - menu-itens
        Route::create([
            'group_id'        => '11',
            'route_option_id' => '1',
            'url'             => 'deletar/{id?}',
            'route'           => 'menu.item.delete',
            'controller'      => 'Layout\MenuItem\MenuItemController@edit',
            'description'     => 'Modal de deletar o item do menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 89 - menu-itens
        Route::create([
            'group_id'        => '11',
            'route_option_id' => '1',
            'url'             => 'recuperar/{id?}',
            'route'           => 'menu.item.recover',
            'controller'      => 'Layout\MenuItem\MenuItemController@edit',
            'description'     => 'Modal de recuperar o item do menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 90 - administrativo
        Route::create([
            'group_id'        => '12',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'dashboard',
            'route'           => 'department.dashboard',
            'controller'      => 'Administrative\Department\DashboardController@dashboard',
            'description'     => 'Página de dashboard dos departamentos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 91 - administrativo
        Route::create([
            'group_id'        => '12',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista',
            'route'           => 'department.list',
            'controller'      => 'Administrative\Department\DepartmentController@list',
            'description'     => 'Página de listagem dos departamentos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 92 - administrativo
        Route::create([
            'group_id'        => '12',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/deletados',
            'route'           => 'department.list.deleted',
            'controller'      => 'Administrative\Department\DepartmentController@listDeleted',
            'description'     => 'Página de listagem dos departamentos deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 93 - administrativo
        Route::create([
            'group_id'        => '12',
            'route_option_id' => '1',
            'url'             => 'visualizar/{id?}',
            'route'           => 'department.view',
            'controller'      => 'Administrative\Department\DepartmentController@edit',
            'description'     => 'Modal de visualizar os dados do departamento',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 94 - administrativo
        Route::create([
            'group_id'        => '12',
            'route_option_id' => '2',
            'url'             => 'novo',
            'route'           => 'department.store',
            'controller'      => 'Administrative\Department\DepartmentController@store',
            'description'     => 'Modal de criar novo departamento',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 95 - administrativo
        Route::create([
            'group_id'        => '12',
            'route_option_id' => '1',
            'url'             => 'editar/{id?}',
            'route'           => 'department.edit',
            'controller'      => 'Administrative\Department\DepartmentController@edit',
            'description'     => 'Modal de editar os dados do departamento',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 96 - administrativo
        Route::create([
            'group_id'        => '12',
            'route_option_id' => '1',
            'url'             => 'banir/{id?}',
            'route'           => 'department.ban',
            'controller'      => 'Administrative\Department\DepartmentController@edit',
            'description'     => 'Modal de bloquear e desbloquear o departamento',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 97 - administrativo
        Route::create([
            'group_id'        => '12',
            'route_option_id' => '1',
            'url'             => 'deletar/{id?}',
            'route'           => 'department.delete',
            'controller'      => 'Administrative\Department\DepartmentController@edit',
            'description'     => 'Modal de deletar o departamento',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 98 - administrativo
        Route::create([
            'group_id'        => '12',
            'route_option_id' => '1',
            'url'             => 'recuperar/{id?}',
            'route'           => 'department.recover',
            'controller'      => 'Administrative\Department\DepartmentController@edit',
            'description'     => 'Modal de recuperar o departamento',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 99 - administrativo
        Route::create([
            'group_id'        => '13',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'dashboard',
            'route'           => 'inventory.category.dashboard',
            'controller'      => 'Administrative\Inventory\InventoryCategory\DashboardController@dashboard',
            'description'     => 'Página de dashboard das categorias do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 100 - administrativo
        Route::create([
            'group_id'        => '13',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista',
            'route'           => 'inventory.category.list',
            'controller'      => 'Administrative\Inventory\InventoryCategory\InventoryCategoryController@list',
            'description'     => 'Página de listagem das categorias do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 101 - administrativo
        Route::create([
            'group_id'        => '13',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/deletadas',
            'route'           => 'inventory.category.list.deleted',
            'controller'      => 'Administrative\Inventory\InventoryCategory\InventoryCategoryController@listDeleted',
            'description'     => 'Página de listagem das categorias do inventário deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 102 - administrativo
        Route::create([
            'group_id'        => '13',
            'route_option_id' => '1',
            'url'             => 'visualizar/{id?}',
            'route'           => 'inventory.category.view',
            'controller'      => 'Administrative\Inventory\InventoryCategory\InventoryCategoryController@edit',
            'description'     => 'Modal de visualizar os dados da categoria do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 103 - administrativo
        Route::create([
            'group_id'        => '13',
            'route_option_id' => '2',
            'url'             => 'nova',
            'route'           => 'inventory.category.store',
            'controller'      => 'Administrative\Inventory\InventoryCategory\InventoryCategoryController@store',
            'description'     => 'Modal de criar nova categoria do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 104 - administrativo
        Route::create([
            'group_id'        => '13',
            'route_option_id' => '1',
            'url'             => 'editar/{id?}',
            'route'           => 'inventory.category.edit',
            'controller'      => 'Administrative\Inventory\InventoryCategory\InventoryCategoryController@edit',
            'description'     => 'Modal de editar os dados da categoria do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 105 - administrativo
        Route::create([
            'group_id'        => '13',
            'route_option_id' => '1',
            'url'             => 'banir/{id?}',
            'route'           => 'inventory.category.ban',
            'controller'      => 'Administrative\Inventory\InventoryCategory\InventoryCategoryController@edit',
            'description'     => 'Modal de bloquear e desbloquear a categoria do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 106 - administrativo
        Route::create([
            'group_id'        => '13',
            'route_option_id' => '1',
            'url'             => 'deletar/{id?}',
            'route'           => 'inventory.category.delete',
            'controller'      => 'Administrative\Inventory\InventoryCategory\InventoryCategoryController@edit',
            'description'     => 'Modal de deletar a categoria do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 107 - administrativo
        Route::create([
            'group_id'        => '13',
            'route_option_id' => '1',
            'url'             => 'recuperar/{id?}',
            'route'           => 'inventory.category.recover',
            'controller'      => 'Administrative\Inventory\InventoryCategory\InventoryCategoryController@edit',
            'description'     => 'Modal de recuperar a categoria do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 108 - administrativo
        Route::create([
            'group_id'        => '14',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'dashboard',
            'route'           => 'inventory.dashboard',
            'controller'      => 'Administrative\Inventory\Inventory\DashboardController@dashboard',
            'description'     => 'Página de dashboard dos itens do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 109 - administrativo
        Route::create([
            'group_id'        => '14',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista',
            'route'           => 'inventory.list',
            'controller'      => 'Administrative\Inventory\Inventory\InventoryController@list',
            'description'     => 'Página de listagem dos itens do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 110 - administrativo
        Route::create([
            'group_id'        => '14',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/deletadas',
            'route'           => 'inventory.list.deleted',
            'controller'      => 'Administrative\Inventory\Inventory\InventoryController@listDeleted',
            'description'     => 'Página de listagem dos itens do inventário deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 111 - administrativo
        Route::create([
            'group_id'        => '14',
            'route_option_id' => '1',
            'url'             => 'visualizar/{id?}',
            'route'           => 'inventory.view',
            'controller'      => 'Administrative\Inventory\Inventory\InventoryController@edit',
            'description'     => 'Modal de visualizar os dados do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 112 - administrativo
        Route::create([
            'group_id'        => '14',
            'route_option_id' => '2',
            'url'             => 'nova',
            'route'           => 'inventory.store',
            'controller'      => 'Administrative\Inventory\Inventory\InventoryController@store',
            'description'     => 'Modal de criar novo item do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 113 - administrativo
        Route::create([
            'group_id'        => '14',
            'route_option_id' => '1',
            'url'             => 'editar/{id?}',
            'route'           => 'inventory.edit',
            'controller'      => 'Administrative\Inventory\Inventory\InventoryController@edit',
            'description'     => 'Modal de editar os dados do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 114 - administrativo
        Route::create([
            'group_id'        => '14',
            'route_option_id' => '1',
            'url'             => 'deletar/{id?}',
            'route'           => 'inventory.delete',
            'controller'      => 'Administrative\Inventory\Inventory\InventoryController@edit',
            'description'     => 'Modal de deletar a categoria do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        // 115 - administrativo
        Route::create([
            'group_id'        => '14',
            'route_option_id' => '1',
            'url'             => 'recuperar/{id?}',
            'route'           => 'inventory.recover',
            'controller'      => 'Administrative\Inventory\Inventory\InventoryController@edit',
            'description'     => 'Modal de recuperar a categoria do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);
    }
}
