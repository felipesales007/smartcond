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

        Route::create([
            'group_id'        => '2',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'editar',
            'route'           => 'profile.index',
            'controller'      => 'Profile\ProfileController@index',
            'description'     => 'Página do perfil do usuário logado',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '2',
            'route_option_id' => '2',
            'url'             => 'atualizar/{id?}',
            'route'           => 'profile.update',
            'controller'      => 'Profile\ProfileController@update',
            'description'     => 'Atualizar o perfil do usuário logado',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

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

        Route::create([
            'group_id'        => '2',
            'route_option_id' => '2',
            'url'             => 'verificar/senha',
            'route'           => 'profile.check.password',
            'controller'      => 'Profile\CheckController@checkPassword',
            'description'     => 'Verificar a senha do usuário logado',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '2',
            'route_option_id' => '2',
            'url'             => 'verificar/email/diferente',
            'route'           => 'profile.check.email.different',
            'controller'      => 'User\CheckController@checkEmailDifferent',
            'description'     => 'Verificar o e-mail dos usuários que seja diferente do e-mail do usuário logado',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '2',
            'route_option_id' => '2',
            'url'             => 'verificar/cpf/diferente',
            'route'           => 'profile.check.cpf.different',
            'controller'      => 'User\CheckController@checkCpfDifferent',
            'description'     => 'Verificar o cpf dos usuários que seja diferente do cpf do usuário logado',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '2',
            'route_option_id' => '2',
            'url'             => 'verificar/rg/diferente',
            'route'           => 'profile.check.rg.different',
            'controller'      => 'User\CheckController@checkRgDifferent',
            'description'     => 'Verificar o rg dos usuários que seja diferente do rg do usuário logado',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '1',
            'url'             => 'data',
            'route'           => 'user.data',
            'controller'      => 'User\DashboardController@data',
            'description'     => 'Dados do dashboard de usuários',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'dashboard',
            'route'           => 'user.dashboard',
            'controller'      => 'User\DashboardController@dashboard',
            'description'     => 'Página do dashboard de usuários',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista',
            'route'           => 'user.list',
            'controller'      => 'User\UserController@list',
            'description'     => 'Página de listagem de usuários',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/deletados',
            'route'           => 'user.list.deleted',
            'controller'      => 'User\UserController@listDeleted',
            'description'     => 'Página de listagem de usuários deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '1',
            'url'             => 'visualizar/{id?}',
            'route'           => 'user.view',
            'controller'      => 'User\UserController@edit',
            'description'     => 'Modal de visualizar os dados dos usuários',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '1',
            'url'             => 'editar/{id?}',
            'route'           => 'user.edit',
            'controller'      => 'User\UserController@edit',
            'description'     => 'Modal de editar os dados dos usuários',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '1',
            'url'             => 'banir/{id?}',
            'route'           => 'user.ban',
            'controller'      => 'User\UserController@edit',
            'description'     => 'Modal de bloquear e desbloquear os usuários',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '1',
            'url'             => 'deletar/{id?}',
            'route'           => 'user.delete',
            'controller'      => 'User\UserController@edit',
            'description'     => 'Modal de deletar os usuários',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '1',
            'url'             => 'recuperar/{id?}',
            'route'           => 'user.recover',
            'controller'      => 'User\UserController@edit',
            'description'     => 'Modal de recuperar os usuários',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '2',
            'url'             => 'novo',
            'route'           => 'user.store',
            'controller'      => 'User\UserController@store',
            'description'     => 'Modal de criar novo usuário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '2',
            'url'             => 'atualizar/{id?}',
            'route'           => 'user.update',
            'controller'      => 'User\UserController@update',
            'description'     => 'Atualizar os dados dos usuários',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '2',
            'url'             => 'bloquear/{id?}',
            'route'           => 'user.block',
            'controller'      => 'User\UserController@block',
            'description'     => 'Bloquear os usuários',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '2',
            'url'             => 'remover/{id?}',
            'route'           => 'user.destroy',
            'controller'      => 'User\UserController@destroy',
            'description'     => 'Deletar os usuários',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '2',
            'url'             => 'restaurar/{id?}',
            'route'           => 'user.restore',
            'controller'      => 'User\UserController@restore',
            'description'     => 'Recuperar os usuários deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '2',
            'url'             => 'reenviar/email',
            'route'           => 'user.resend.email',
            'controller'      => 'User\UserController@resendEmail',
            'description'     => 'Reenviar o e-mail de confirmação de e-mail do usuário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '2',
            'url'             => 'verificar/email',
            'route'           => 'user.check.email',
            'controller'      => 'User\CheckController@checkEmail',
            'description'     => 'Verificar o e-mail dos usuários',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '2',
            'url'             => 'verificar/email/diferente',
            'route'           => 'user.check.email.different',
            'controller'      => 'User\CheckController@checkEmailDifferent',
            'description'     => 'Verificar o e-mail dos usuários que seja diferente do e-mail do usuário em edição',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '2',
            'url'             => 'verificar/cpf',
            'route'           => 'user.check.cpf',
            'controller'      => 'User\CheckController@checkCpf',
            'description'     => 'Verificar o cpf dos usuários',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '2',
            'url'             => 'verificar/cpf/diferente',
            'route'           => 'user.check.cpf.different',
            'controller'      => 'User\CheckController@checkCpfDifferent',
            'description'     => 'Verificar o cpf dos usuários que seja diferente do cpf do usuário em edição',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '2',
            'url'             => 'verificar/rg',
            'route'           => 'user.check.rg',
            'controller'      => 'User\CheckController@checkRg',
            'description'     => 'Verificar o rg dos usuários',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '2',
            'url'             => 'verificar/rg/diferente',
            'route'           => 'user.check.rg.different',
            'controller'      => 'User\CheckController@checkRgDifferent',
            'description'     => 'Verificar o rg dos usuários que seja diferente do rg do usuário em edição',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '4',
            'route_option_id' => '1',
            'url'             => 'data',
            'route'           => 'company.data',
            'controller'      => 'Company\DashboardController@data',
            'description'     => 'Dados do dashboard de empresas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '4',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'dashboard',
            'route'           => 'company.dashboard',
            'controller'      => 'Company\DashboardController@dashboard',
            'description'     => 'Página do dashboard de empresas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '4',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista',
            'route'           => 'company.list',
            'controller'      => 'Company\CompanyController@list',
            'description'     => 'Página de listagem de empresas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '4',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/deletados',
            'route'           => 'company.list.deleted',
            'controller'      => 'Company\CompanyController@listDeleted',
            'description'     => 'Página de listagem de empresas deletadas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '4',
            'route_option_id' => '1',
            'url'             => 'visualizar/{id?}',
            'route'           => 'company.view',
            'controller'      => 'Company\CompanyController@edit',
            'description'     => 'Modal de visualizar os dados das empresas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '4',
            'route_option_id' => '1',
            'url'             => 'editar/{id?}',
            'route'           => 'company.edit',
            'controller'      => 'Company\CompanyController@edit',
            'description'     => 'Modal de editar os dados das empresas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '4',
            'route_option_id' => '1',
            'url'             => 'banir/{id?}',
            'route'           => 'company.ban',
            'controller'      => 'Company\CompanyController@edit',
            'description'     => 'Modal de bloquear e desbloquear as empresas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '4',
            'route_option_id' => '1',
            'url'             => 'deletar/{id?}',
            'route'           => 'company.delete',
            'controller'      => 'Company\CompanyController@edit',
            'description'     => 'Modal de deletar as empresas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '4',
            'route_option_id' => '1',
            'url'             => 'recuperar/{id?}',
            'route'           => 'company.recover',
            'controller'      => 'Company\CompanyController@edit',
            'description'     => 'Modal de recuperar as empresas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '4',
            'route_option_id' => '2',
            'url'             => 'novo',
            'route'           => 'company.store',
            'controller'      => 'Company\CompanyController@store',
            'description'     => 'Modal de criar nova empresa',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '4',
            'route_option_id' => '2',
            'url'             => 'atualizar/{id?}',
            'route'           => 'company.update',
            'controller'      => 'Company\CompanyController@update',
            'description'     => 'Atualizar os dados das empresas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '4',
            'route_option_id' => '2',
            'url'             => 'bloquear/{id?}',
            'route'           => 'company.block',
            'controller'      => 'Company\CompanyController@block',
            'description'     => 'Bloquear as empresas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '4',
            'route_option_id' => '2',
            'url'             => 'remover/{id?}',
            'route'           => 'company.destroy',
            'controller'      => 'Company\CompanyController@destroy',
            'description'     => 'Deletar as empresas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '4',
            'route_option_id' => '2',
            'url'             => 'restaurar/{id?}',
            'route'           => 'company.restore',
            'controller'      => 'Company\CompanyController@restore',
            'description'     => 'Recuperar as empresas deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '4',
            'route_option_id' => '2',
            'url'             => 'verificar/email',
            'route'           => 'company.check.email',
            'controller'      => 'Company\CheckController@checkEmail',
            'description'     => 'Verificar o e-mail das empresas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '4',
            'route_option_id' => '2',
            'url'             => 'verificar/email/diferente',
            'route'           => 'company.check.email.different',
            'controller'      => 'Company\CheckController@checkEmailDifferent',
            'description'     => 'Verificar o e-mail das empresas que seja diferente do e-mail da empresa em edição',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '4',
            'route_option_id' => '2',
            'url'             => 'verificar/cnpj',
            'route'           => 'company.check.cnpj',
            'controller'      => 'Company\CheckController@checkCnpj',
            'description'     => 'Verificar o cnpj das empresas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '4',
            'route_option_id' => '2',
            'url'             => 'verificar/cnpj/diferente',
            'route'           => 'company.check.cnpj.different',
            'controller'      => 'Company\CheckController@checkCnpjDifferent',
            'description'     => 'Verificar o cnpj das empresas que seja diferente do cnpj da empresa em edição',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '3',
            'route_option_id' => '2',
            'url'             => 'enviar/email',
            'route'           => 'user.send.email',
            'controller'      => 'User\UserController@sendEmail',
            'description'     => 'Enviar e-mail para o usuário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '4',
            'route_option_id' => '2',
            'url'             => 'enviar/email',
            'route'           => 'company.send.email',
            'controller'      => 'Company\CompanyController@sendEmail',
            'description'     => 'Enviar e-mail para a empresa',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'url'             => 'data',
            'route'           => 'route.data',
            'controller'      => 'Route\DashboardController@data',
            'description'     => 'Dados do dashboard de rotas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'dashboard',
            'route'           => 'route.dashboard',
            'controller'      => 'Route\DashboardController@dashboard',
            'description'     => 'Página do dashboard de rotas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/grupos',
            'route'           => 'group.list',
            'controller'      => 'Route\GroupController@list',
            'description'     => 'Página de listagem de grupos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/grupos/deletados',
            'route'           => 'group.list.deleted',
            'controller'      => 'Route\GroupController@listDeleted',
            'description'     => 'Página de listagem de grupos deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'url'             => 'visualizar/grupo/{id?}',
            'route'           => 'group.view',
            'controller'      => 'Route\GroupController@edit',
            'description'     => 'Modal de visualizar os dados dos grupos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'url'             => 'editar/grupo/{id?}',
            'route'           => 'group.edit',
            'controller'      => 'Route\GroupController@edit',
            'description'     => 'Modal de editar os dados dos grupos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'url'             => 'banir/grupo/{id?}',
            'route'           => 'group.ban',
            'controller'      => 'Route\GroupController@edit',
            'description'     => 'Modal de bloquear e desbloquear os grupos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'url'             => 'deletar/grupo/{id?}',
            'route'           => 'group.delete',
            'controller'      => 'Route\GroupController@edit',
            'description'     => 'Modal de deletar os grupos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'url'             => 'recuperar/grupo/{id?}',
            'route'           => 'group.recover',
            'controller'      => 'Route\GroupController@edit',
            'description'     => 'Modal de recuperar os grupos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '2',
            'url'             => 'novo/grupo',
            'route'           => 'group.store',
            'controller'      => 'Route\GroupController@store',
            'description'     => 'Modal de criar novo grupo',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '2',
            'url'             => 'atualizar/grupo/{id?}',
            'route'           => 'group.update',
            'controller'      => 'Route\GroupController@update',
            'description'     => 'Atualizar os dados dos grupos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '2',
            'url'             => 'bloquear/grupo/{id?}',
            'route'           => 'group.block',
            'controller'      => 'Route\GroupController@block',
            'description'     => 'Bloquear os grupos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '2',
            'url'             => 'remover/grupo/{id?}',
            'route'           => 'group.destroy',
            'controller'      => 'Route\GroupController@destroy',
            'description'     => 'Deletar os grupos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '2',
            'url'             => 'restaurar/grupo/{id?}',
            'route'           => 'group.restore',
            'controller'      => 'Route\GroupController@restore',
            'description'     => 'Recuperar os grupos deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/rotas',
            'route'           => 'route.list',
            'controller'      => 'Route\RouteController@list',
            'description'     => 'Página de listagem de rotas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/rotas/deletados',
            'route'           => 'route.list.deleted',
            'controller'      => 'Route\RouteController@listDeleted',
            'description'     => 'Página de listagem de rotas deletadas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'url'             => 'visualizar/rota/{id?}',
            'route'           => 'route.view',
            'controller'      => 'Route\RouteController@edit',
            'description'     => 'Modal de visualizar os dados das rotas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'url'             => 'editar/rota/{id?}',
            'route'           => 'route.edit',
            'controller'      => 'Route\RouteController@edit',
            'description'     => 'Modal de editar os dados das rotas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'url'             => 'banir/rota/{id?}',
            'route'           => 'route.ban',
            'controller'      => 'Route\RouteController@edit',
            'description'     => 'Modal de bloquear e desbloquear as rotas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'url'             => 'deletar/rota/{id?}',
            'route'           => 'route.delete',
            'controller'      => 'Route\RouteController@edit',
            'description'     => 'Modal de deletar as rotas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '1',
            'url'             => 'recuperar/rota/{id?}',
            'route'           => 'route.recover',
            'controller'      => 'Route\RouteController@edit',
            'description'     => 'Modal de recuperar as rotas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '2',
            'url'             => 'novo/rota',
            'route'           => 'route.store',
            'controller'      => 'Route\RouteController@store',
            'description'     => 'Modal de criar nova rota',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '2',
            'url'             => 'atualizar/rota/{id?}',
            'route'           => 'route.update',
            'controller'      => 'Route\RouteController@update',
            'description'     => 'Atualizar os dados das rotas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '2',
            'url'             => 'bloquear/rota/{id?}',
            'route'           => 'route.block',
            'controller'      => 'Route\RouteController@block',
            'description'     => 'Bloquear as rotas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '2',
            'url'             => 'remover/rota/{id?}',
            'route'           => 'route.destroy',
            'controller'      => 'Route\RouteController@destroy',
            'description'     => 'Deletar as rotas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '2',
            'url'             => 'restaurar/rota/{id?}',
            'route'           => 'route.restore',
            'controller'      => 'Route\RouteController@restore',
            'description'     => 'Recuperar as rotas deletadas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'url'             => 'data',
            'route'           => 'menu.data',
            'controller'      => 'Menu\DashboardController@data',
            'description'     => 'Dados do dashboard de menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'dashboard',
            'route'           => 'menu.dashboard',
            'controller'      => 'Menu\DashboardController@dashboard',
            'description'     => 'Página do dashboard de menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/menu',
            'route'           => 'menu.list',
            'controller'      => 'Menu\MenuController@list',
            'description'     => 'Página de listagem de menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/menu/deletados',
            'route'           => 'menu.list.deleted',
            'controller'      => 'Menu\MenuController@listDeleted',
            'description'     => 'Página de listagem de menu deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'url'             => 'visualizar/menu/{id?}',
            'route'           => 'menu.view',
            'controller'      => 'Menu\MenuController@edit',
            'description'     => 'Modal de visualizar os dados dos menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'url'             => 'editar/menu/{id?}',
            'route'           => 'menu.edit',
            'controller'      => 'Menu\MenuController@edit',
            'description'     => 'Modal de editar os dados dos menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'url'             => 'banir/menu/{id?}',
            'route'           => 'menu.ban',
            'controller'      => 'Menu\MenuController@edit',
            'description'     => 'Modal de bloquear e desbloquear os menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'url'             => 'deletar/menu/{id?}',
            'route'           => 'menu.delete',
            'controller'      => 'Menu\MenuController@edit',
            'description'     => 'Modal de deletar os menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'url'             => 'recuperar/menu/{id?}',
            'route'           => 'menu.recover',
            'controller'      => 'Menu\MenuController@edit',
            'description'     => 'Modal de recuperar os menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '2',
            'url'             => 'novo/menu',
            'route'           => 'menu.store',
            'controller'      => 'Menu\MenuController@store',
            'description'     => 'Modal de criar novo menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '2',
            'url'             => 'atualizar/menu/{id?}',
            'route'           => 'menu.update',
            'controller'      => 'Menu\MenuController@update',
            'description'     => 'Atualizar os dados dos menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '2',
            'url'             => 'bloquear/menu/{id?}',
            'route'           => 'menu.block',
            'controller'      => 'Menu\MenuController@block',
            'description'     => 'Bloquear os menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '2',
            'url'             => 'remover/menu/{id?}',
            'route'           => 'menu.destroy',
            'controller'      => 'Menu\MenuController@destroy',
            'description'     => 'Deletar os menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '2',
            'url'             => 'restaurar/menu/{id?}',
            'route'           => 'menu.restore',
            'controller'      => 'Menu\MenuController@restore',
            'description'     => 'Recuperar os menu deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/menu-itens',
            'route'           => 'menu.item.list',
            'controller'      => 'Menu\MenuItemController@list',
            'description'     => 'Página de listagem de itens de menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/menu-itens/deletados',
            'route'           => 'menu.item.list.deleted',
            'controller'      => 'Menu\MenuItemController@listDeleted',
            'description'     => 'Página de listagem de itens de menu deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'url'             => 'visualizar/menu-item/{id?}',
            'route'           => 'menu.item.view',
            'controller'      => 'Menu\MenuItemController@edit',
            'description'     => 'Modal de visualizar os dados dos itens de menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'url'             => 'editar/menu-item/{id?}',
            'route'           => 'menu.item.edit',
            'controller'      => 'Menu\MenuItemController@edit',
            'description'     => 'Modal de editar os dados dos itens de menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'url'             => 'banir/menu-item/{id?}',
            'route'           => 'menu.item.ban',
            'controller'      => 'Menu\MenuItemController@edit',
            'description'     => 'Modal de bloquear e desbloquear os itens de menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'url'             => 'deletar/menu-item/{id?}',
            'route'           => 'menu.item.delete',
            'controller'      => 'Menu\MenuItemController@edit',
            'description'     => 'Modal de deletar os itens de menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '1',
            'url'             => 'recuperar/menu-item/{id?}',
            'route'           => 'menu.item.recover',
            'controller'      => 'Menu\MenuItemController@edit',
            'description'     => 'Modal de recuperar os itens de menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '2',
            'url'             => 'novo/menu-item',
            'route'           => 'menu.item.store',
            'controller'      => 'Menu\MenuItemController@store',
            'description'     => 'Modal de criar novo item de menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '2',
            'url'             => 'atualizar/menu-item/{id?}',
            'route'           => 'menu.item.update',
            'controller'      => 'Menu\MenuItemController@update',
            'description'     => 'Atualizar os dados dos itens de menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '2',
            'url'             => 'bloquear/menu-item/{id?}',
            'route'           => 'menu.item.block',
            'controller'      => 'Menu\MenuItemController@block',
            'description'     => 'Bloquear os itens de menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '2',
            'url'             => 'remover/menu-item/{id?}',
            'route'           => 'menu.item.destroy',
            'controller'      => 'Menu\MenuItemController@destroy',
            'description'     => 'Deletar os itens de menu',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '6',
            'route_option_id' => '2',
            'url'             => 'restaurar/menu-item/{id?}',
            'route'           => 'menu.item.restore',
            'controller'      => 'Menu\MenuItemController@restore',
            'description'     => 'Recuperar os itens de menu deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '2',
            'url'             => 'verificar/grupo/nome',
            'route'           => 'group.check.name',
            'controller'      => 'Route\CheckController@checkGroupName',
            'description'     => 'Verificar o nome dos grupos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '2',
            'url'             => 'verificar/grupo/nome/diferente',
            'route'           => 'group.check.name.different',
            'controller'      => 'Route\CheckController@checkGroupNameDifferent',
            'description'     => 'Verificar o nome dos grupos que seja diferente do nome do grupo em edição',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '2',
            'url'             => 'verificar/route/route',
            'route'           => 'route.check.route',
            'controller'      => 'Route\CheckController@checkRouteRoute',
            'description'     => 'Verificar o nome da rota em rotas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '5',
            'route_option_id' => '2',
            'url'             => 'verificar/route/route/diferente',
            'route'           => 'route.check.route.different',
            'controller'      => 'Route\CheckController@checkRouteRouteDifferent',
            'description'     => 'Verificar o nome da rota em rotas que seja diferente do nome da rota em edição',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '7',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/sem-permissoes',
            'route'           => 'permission.user.list',
            'controller'      => 'PermissionController@list',
            'description'     => 'Página de listagem de usuários sem permissões',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '7',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'usuario/editar',
            'route'           => 'permission.user.edit',
            'controller'      => 'PermissionController@edit',
            'description'     => 'Página de alteração das permissões de usuários',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '7',
            'route_option_id' => '2',
            'url'             => 'usuario/atualizar/{id?}',
            'route'           => 'permission.user.update',
            'controller'      => 'PermissionController@update',
            'description'     => 'Atualizar os dados das permissões de usuários',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '7',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/permissoes',
            'route'           => 'permission.user.list.all',
            'controller'      => 'PermissionController@listAll',
            'description'     => 'Página de listagem de usuários com permissões',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '8',
            'route_option_id' => '1',
            'url'             => 'data',
            'route'           => 'department.data',
            'controller'      => 'Department\DashboardController@data',
            'description'     => 'Dados do dashboard dos departamentos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '8',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'dashboard',
            'route'           => 'department.dashboard',
            'controller'      => 'Department\DashboardController@dashboard',
            'description'     => 'Página do dashboard dos departamentos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '8',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista',
            'route'           => 'department.list',
            'controller'      => 'Department\DepartmentController@list',
            'description'     => 'Página de listagem dos departamentos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '8',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/deletados',
            'route'           => 'department.list.deleted',
            'controller'      => 'Department\DepartmentController@listDeleted',
            'description'     => 'Página de listagem dos departamentos deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '8',
            'route_option_id' => '1',
            'url'             => 'visualizar/{id?}',
            'route'           => 'department.view',
            'controller'      => 'Department\DepartmentController@edit',
            'description'     => 'Modal de visualizar os dados dos departamentos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '8',
            'route_option_id' => '1',
            'url'             => 'editar/{id?}',
            'route'           => 'department.edit',
            'controller'      => 'Department\DepartmentController@edit',
            'description'     => 'Modal de editar os dados dos departamentos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '8',
            'route_option_id' => '1',
            'url'             => 'banir/{id?}',
            'route'           => 'department.ban',
            'controller'      => 'Department\DepartmentController@edit',
            'description'     => 'Modal de bloquear e desbloquear os departamentos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '8',
            'route_option_id' => '1',
            'url'             => 'deletar/{id?}',
            'route'           => 'department.delete',
            'controller'      => 'Department\DepartmentController@edit',
            'description'     => 'Modal de deletar os departamentos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '8',
            'route_option_id' => '1',
            'url'             => 'recuperar/{id?}',
            'route'           => 'department.recover',
            'controller'      => 'Department\DepartmentController@edit',
            'description'     => 'Modal de recuperar os departamentos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '8',
            'route_option_id' => '2',
            'url'             => 'novo',
            'route'           => 'department.store',
            'controller'      => 'Department\DepartmentController@store',
            'description'     => 'Modal de criar novo departamento',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '8',
            'route_option_id' => '2',
            'url'             => 'atualizar/{id?}',
            'route'           => 'department.update',
            'controller'      => 'Department\DepartmentController@update',
            'description'     => 'Atualizar os dados dos departamentos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '8',
            'route_option_id' => '2',
            'url'             => 'bloquear/{id?}',
            'route'           => 'department.block',
            'controller'      => 'Department\DepartmentController@block',
            'description'     => 'Bloquear os departamentos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '8',
            'route_option_id' => '2',
            'url'             => 'remover/{id?}',
            'route'           => 'department.destroy',
            'controller'      => 'Department\DepartmentController@destroy',
            'description'     => 'Deletar os departamentos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '8',
            'route_option_id' => '2',
            'url'             => 'restaurar/{id?}',
            'route'           => 'department.restore',
            'controller'      => 'Department\DepartmentController@restore',
            'description'     => 'Recuperar os departamentos deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '8',
            'route_option_id' => '2',
            'url'             => 'verificar/nome',
            'route'           => 'department.check.name',
            'controller'      => 'Department\CheckController@checkName',
            'description'     => 'Verificar o nome dos departamentos',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '8',
            'route_option_id' => '2',
            'url'             => 'verificar/nome/diferente',
            'route'           => 'department.check.name.different',
            'controller'      => 'Department\CheckController@checkNameDifferent',
            'description'     => 'Verificar o nome dos departamentos que seja diferente do departamento em edição',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/categorias',
            'route'           => 'inventory.category.list',
            'controller'      => 'Inventory\InventoryCategoryController@list',
            'description'     => 'Página de listagem das categorias',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/categorias/deletadas',
            'route'           => 'inventory.category.list.deleted',
            'controller'      => 'Inventory\InventoryCategoryController@listDeleted',
            'description'     => 'Página de listagem das categorias deletadas',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'url'             => 'visualizar/categoria/{id?}',
            'route'           => 'inventory.category.view',
            'controller'      => 'Inventory\InventoryCategoryController@edit',
            'description'     => 'Modal de visualizar os dados das categorias',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'url'             => 'editar/categoria/{id?}',
            'route'           => 'inventory.category.edit',
            'controller'      => 'Inventory\InventoryCategoryController@edit',
            'description'     => 'Modal de editar os dados das categorias',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'url'             => 'banir/categoria/{id?}',
            'route'           => 'inventory.category.ban',
            'controller'      => 'Inventory\InventoryCategoryController@edit',
            'description'     => 'Modal de bloquear e desbloquear as categorias',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'url'             => 'deletar/categoria/{id?}',
            'route'           => 'inventory.category.delete',
            'controller'      => 'Inventory\InventoryCategoryController@edit',
            'description'     => 'Modal de deletar as categorias',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'url'             => 'recuperar/categoria/{id?}',
            'route'           => 'inventory.category.recover',
            'controller'      => 'Inventory\InventoryCategoryController@edit',
            'description'     => 'Modal de recuperar as categorias',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '2',
            'url'             => 'nova/categoria',
            'route'           => 'inventory.category.store',
            'controller'      => 'Inventory\InventoryCategoryController@store',
            'description'     => 'Modal de criar nova categoria',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '2',
            'url'             => 'atualizar/categoria/{id?}',
            'route'           => 'inventory.category.update',
            'controller'      => 'Inventory\InventoryCategoryController@update',
            'description'     => 'Atualizar os dados das categorias',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '2',
            'url'             => 'bloquear/categoria/{id?}',
            'route'           => 'inventory.category.block',
            'controller'      => 'Inventory\InventoryCategoryController@block',
            'description'     => 'Bloquear as categorias',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '2',
            'url'             => 'remover/categoria/{id?}',
            'route'           => 'inventory.category.destroy',
            'controller'      => 'Inventory\InventoryCategoryController@destroy',
            'description'     => 'Deletar as categorias',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '2',
            'url'             => 'restaurar/categoria/{id?}',
            'route'           => 'inventory.category.restore',
            'controller'      => 'Inventory\InventoryCategoryController@restore',
            'description'     => 'Recuperar as categorias deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '2',
            'url'             => 'verificar/categoria/nome',
            'route'           => 'inventory.category.check.name',
            'controller'      => 'Inventory\CheckController@checkName',
            'description'     => 'Verificar o nome das categorias',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '2',
            'url'             => 'verificar/categoria/nome/diferente',
            'route'           => 'inventory.category.check.name.different',
            'controller'      => 'Inventory\CheckController@checkNameDifferent',
            'description'     => 'Verificar o nome das categorias que seja diferente da categoria em edição',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'url'             => 'data',
            'route'           => 'inventory.data',
            'controller'      => 'Inventory\DashboardController@data',
            'description'     => 'Dados do dashboard dos itens do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'dashboard',
            'route'           => 'inventory.dashboard',
            'controller'      => 'Inventory\DashboardController@dashboard',
            'description'     => 'Página do dashboard dos itens do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/inventarios',
            'route'           => 'inventory.list',
            'controller'      => 'Inventory\InventoryController@list',
            'description'     => 'Página de listagem dos itens do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'view'            => '1',
            'url'             => 'lista/inventarios/deletados',
            'route'           => 'inventory.list.deleted',
            'controller'      => 'Inventory\InventoryController@listDeleted',
            'description'     => 'Página de listagem dos itens do inventário deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'url'             => 'visualizar/inventario/{id?}',
            'route'           => 'inventory.view',
            'controller'      => 'Inventory\InventoryController@edit',
            'description'     => 'Modal de visualizar os dados dos itens do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'url'             => 'editar/inventario/{id?}',
            'route'           => 'inventory.edit',
            'controller'      => 'Inventory\InventoryController@edit',
            'description'     => 'Modal de editar os dados dos itens do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'url'             => 'banir/inventario/{id?}',
            'route'           => 'inventory.ban',
            'controller'      => 'Inventory\InventoryController@edit',
            'description'     => 'Modal de bloquear e desbloquear os itens do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'url'             => 'deletar/inventario/{id?}',
            'route'           => 'inventory.delete',
            'controller'      => 'Inventory\InventoryController@edit',
            'description'     => 'Modal de deletar os itens do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '1',
            'url'             => 'recuperar/inventario/{id?}',
            'route'           => 'inventory.recover',
            'controller'      => 'Inventory\InventoryController@edit',
            'description'     => 'Modal de recuperar os itens do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '2',
            'url'             => 'novo/inventario',
            'route'           => 'inventory.store',
            'controller'      => 'Inventory\InventoryController@store',
            'description'     => 'Modal de criar novo item do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '2',
            'url'             => 'atualizar/inventario/{id?}',
            'route'           => 'inventory.update',
            'controller'      => 'Inventory\InventoryController@update',
            'description'     => 'Atualizar os dados dos itens do inventários',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '2',
            'url'             => 'bloquear/inventario/{id?}',
            'route'           => 'inventory.block',
            'controller'      => 'Inventory\InventoryController@block',
            'description'     => 'Bloquear os itens do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '2',
            'url'             => 'remover/inventario/{id?}',
            'route'           => 'inventory.destroy',
            'controller'      => 'Inventory\InventoryController@destroy',
            'description'     => 'Deletar os itens do inventário',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);

        Route::create([
            'group_id'        => '9',
            'route_option_id' => '2',
            'url'             => 'restaurar/inventario/{id?}',
            'route'           => 'inventory.restore',
            'controller'      => 'Inventory\InventoryController@restore',
            'description'     => 'Recuperar os itens do inventário deletados',
            'created_at'      => now(),
            'updated_at'      => now()
        ]);
    }
}
