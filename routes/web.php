<?php

use App\Models\Route\Group;
use App\Models\Route\Route as Routes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| Rotas da Web
|--------------------------------------------------------------------------
|
| Aqui é onde você pode registrar rotas da web para seu aplicativo. Esses
| rotas são carregadas pelo RouteServiceProvider dentro de um grupo que
| contém o grupo de middleware "web". Agora crie algo ótimo!
|
*/

// grupo default laravel
Auth::routes(['verify' => true]);
Route::get ('/',      function () { return redirect('login'); })->middleware('guest');
Route::get ('logout', function () { Auth::logout(); return redirect('login'); })->name('logout');
Route::get ('sair',   function () { Auth::logout(); return redirect('login'); })->name('sair');
Route::post('erro', ['as' => 'remote.validate.destroy', 'uses' => 'ErrorController@remoteValidateDestroy']);

// grupo login
Route::get ('login', ['as' => 'login',  'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'login',  'uses' => 'Auth\LoginController@login']);
Route::post('sair',  ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

// grupo registro
Route::get ('register',  ['as' => 'register', 'uses' => 'ErrorController@error404']);
// Route::get ('registrar', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
// Route::post('registrar', ['as' => 'register', 'uses' => 'Auth\RegisterController@register']);

// grupo resetar senha
Route::get ('resetar/senha',          ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::get ('resetar/senha/{token?}', ['as' => 'password.reset',   'uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::post('senha/email',            ['as' => 'password.email',   'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::post('senha/resetar',          ['as' => 'password.update',  'uses' => 'Auth\ResetPasswordController@reset']);

// grupo verificar e-mail
Route::get('verificar/email',       ['as' => 'verification.notice', 'uses' => 'Auth\VerificationController@show']);
Route::get('verificar/email/{id?}', ['as' => 'verification.verify', 'uses' => 'Auth\VerificationController@verify']);
Route::get('reenviar/email',        ['as' => 'verification.resend', 'uses' => 'Auth\VerificationController@resend']);

// restrições para acesso
Route::group(['middleware' => ['auth', 'verified', 'unique', 'permission']], function () {
    // grupos do banco
    if (Schema::hasTable('groups')) {
        foreach (Group::getGroups() as $group) {
            $this->group = $group->id;

            Route::group(['prefix' => $group->name], function () {
                foreach (Routes::getRoutes() as $route) {
                    if ($route->group_id == $this->group) {
                        if ($route->route_option_id == 1) {
                            Route::get($route->url, ['as' => $route->route, 'uses' => $route->controller]);
                        } elseif ($route->route_option_id == 2) {
                            Route::post($route->url, ['as' => $route->route, 'uses' => $route->controller]);
                        } elseif ($route->route_option_id == 3) {
                            Route::put($route->url, ['as' => $route->route, 'uses' => $route->controller]);
                        } elseif ($route->route_option_id == 4) {
                            Route::delete($route->url, ['as' => $route->route, 'uses' => $route->controller]);
                        }
                    }
                }
            });
        }
    }

    /*
    =========================================================
    Rotas existentes na tabela routes do banco de dados
    Nomenclaturas:
    // -> é um botão ou link de acesso a um modal ou função
    *  -> é um botão ou link de listagem
    =========================================================

    // grupo home
    Route::group(['prefix' => 'home'], function () {
        Route::get('index', ['as' => 'home.index', 'uses' => 'HomeController@index']);
    });

    // grupo perfil
    Route::group(['prefix' => 'perfil'], function () {
        Route::get ('editar',                    ['as' => 'profile.index',                 'uses' => 'Profile\ProfileController@index']);
        Route::post('atualizar/{id?}',           ['as' => 'profile.update',                'uses' => 'Profile\ProfileController@update']);
        Route::post('senha/{id?}',               ['as' => 'profile.password.reset',        'uses' => 'Profile\ProfileController@passwordReset']); // btn-modal-password-reset-profile
        Route::post('suporte',                   ['as' => 'profile.support',               'uses' => 'Profile\ProfileController@support']); // btn-modal-support-send
        Route::post('verificar/senha',           ['as' => 'profile.check.password',        'uses' => 'Profile\CheckController@checkPassword']);
        Route::post('verificar/email/diferente', ['as' => 'profile.check.email.different', 'uses' => 'User\CheckController@checkEmailDifferent']);
        Route::post('verificar/cpf/diferente',   ['as' => 'profile.check.cpf.different',   'uses' => 'User\CheckController@checkCpfDifferent']);
        Route::post('verificar/rg/diferente',    ['as' => 'profile.check.rg.different',    'uses' => 'User\CheckController@checkRgDifferent']);
    });

    // grupo usuários
    Route::group(['prefix' => 'usuarios'], function () {
        Route::get ('data',                      ['as' => 'user.data',                  'uses' => 'User\DashboardController@data']);
        Route::get ('dashboard',                 ['as' => 'user.dashboard',             'uses' => 'User\DashboardController@dashboard']);
        Route::get ('lista',                     ['as' => 'user.list',                  'uses' => 'User\UserController@list']);
        Route::get ('lista/deletados',           ['as' => 'user.list.deleted',          'uses' => 'User\UserController@listDeleted']);
        Route::get ('visualizar/{id?}',          ['as' => 'user.view',                  'uses' => 'User\UserController@edit']); // * btn-modal-view-user
        Route::get ('editar/{id?}',              ['as' => 'user.edit',                  'uses' => 'User\UserController@edit']); // * btn-modal-edit-user
        Route::get ('banir/{id?}',               ['as' => 'user.ban',                   'uses' => 'User\UserController@edit']); // * btn-modal-block-user
        Route::get ('deletar/{id?}',             ['as' => 'user.delete',                'uses' => 'User\UserController@edit']); // * btn-modal-delete-user
        Route::get ('recuperar/{id?}',           ['as' => 'user.recover',               'uses' => 'User\UserController@edit']); // * btn-modal-recover-user
        Route::post('novo',                      ['as' => 'user.store',                 'uses' => 'User\UserController@store']); // btn-modal-new-user
        Route::post('atualizar/{id?}',           ['as' => 'user.update',                'uses' => 'User\UserController@update']);
        Route::post('bloquear/{id?}',            ['as' => 'user.block',                 'uses' => 'User\UserController@block']);
        Route::post('remover/{id?}',             ['as' => 'user.destroy',               'uses' => 'User\UserController@destroy']);
        Route::post('restaurar/{id?}',           ['as' => 'user.restore',               'uses' => 'User\UserController@restore']);
        Route::post('enviar/email',              ['as' => 'user.send.email',            'uses' => 'User\UserController@sendEmail']); // * btn-send-email-user
        Route::post('reenviar/email',            ['as' => 'user.resend.email',          'uses' => 'User\UserController@resendEmail']); // btn-resend-email-user
        Route::post('verificar/email',           ['as' => 'user.check.email',           'uses' => 'User\CheckController@checkEmail']);
        Route::post('verificar/email/diferente', ['as' => 'user.check.email.different', 'uses' => 'User\CheckController@checkEmailDifferent']);
        Route::post('verificar/cpf',             ['as' => 'user.check.cpf',             'uses' => 'User\CheckController@checkCpf']);
        Route::post('verificar/cpf/diferente',   ['as' => 'user.check.cpf.different',   'uses' => 'User\CheckController@checkCpfDifferent']);
        Route::post('verificar/rg',              ['as' => 'user.check.rg',              'uses' => 'User\CheckController@checkRg']);
        Route::post('verificar/rg/diferente',    ['as' => 'user.check.rg.different',    'uses' => 'User\CheckController@checkRgDifferent']);
    });

    // grupo condomínios
    Route::group(['prefix' => 'condominios'], function () {
        Route::get ('data',                      ['as' => 'company.data',                  'uses' => 'Company\DashboardController@data']);
        Route::get ('dashboard',                 ['as' => 'company.dashboard',             'uses' => 'Company\DashboardController@dashboard']);
        Route::get ('lista',                     ['as' => 'company.list',                  'uses' => 'Company\CompanyController@list']);
        Route::get ('lista/deletados',           ['as' => 'company.list.deleted',          'uses' => 'Company\CompanyController@listDeleted']);
        Route::get ('visualizar/{id?}',          ['as' => 'company.view',                  'uses' => 'Company\CompanyController@edit']); // * btn-modal-view-company
        Route::get ('editar/{id?}',              ['as' => 'company.edit',                  'uses' => 'Company\CompanyController@edit']); // * btn-modal-edit-company
        Route::get ('banir/{id?}',               ['as' => 'company.ban',                   'uses' => 'Company\CompanyController@edit']); // * btn-modal-block-company
        Route::get ('deletar/{id?}',             ['as' => 'company.delete',                'uses' => 'Company\CompanyController@edit']); // * btn-modal-delete-company
        Route::get ('recuperar/{id?}',           ['as' => 'company.recover',               'uses' => 'Company\CompanyController@edit']); // * btn-modal-recover-company
        Route::post('novo',                      ['as' => 'company.store',                 'uses' => 'Company\CompanyController@store']); // btn-modal-new-company
        Route::post('atualizar/{id?}',           ['as' => 'company.update',                'uses' => 'Company\CompanyController@update']);
        Route::post('bloquear/{id?}',            ['as' => 'company.block',                 'uses' => 'Company\CompanyController@block']);
        Route::post('remover/{id?}',             ['as' => 'company.destroy',               'uses' => 'Company\CompanyController@destroy']);
        Route::post('restaurar/{id?}',           ['as' => 'company.restore',               'uses' => 'Company\CompanyController@restore']);
        Route::post('enviar/email',              ['as' => 'company.send.email',            'uses' => 'Company\CompanyController@sendEmail']); // * btn-send-email-company
        Route::post('verificar/email',           ['as' => 'company.check.email',           'uses' => 'Company\CheckController@checkEmail']);
        Route::post('verificar/email/diferente', ['as' => 'company.check.email.different', 'uses' => 'Company\CheckController@checkEmailDifferent']);
        Route::post('verificar/cnpj',            ['as' => 'company.check.cnpj',            'uses' => 'Company\CheckController@checkCnpj']);
        Route::post('verificar/cnpj/diferente',  ['as' => 'company.check.cnpj.different',  'uses' => 'Company\CheckController@checkCnpjDifferent']);
    });

    // grupo rotas
    Route::group(['prefix' => 'rotas'], function () {
        Route::get ('data',                            ['as' => 'route.data',                  'uses' => 'Route\DashboardController@data']);
        Route::get ('dashboard',                       ['as' => 'route.dashboard',             'uses' => 'Route\DashboardController@dashboard']);
        Route::get ('lista/grupos',                    ['as' => 'group.list',                  'uses' => 'Route\GroupController@list']);
        Route::get ('lista/grupos/deletados',          ['as' => 'group.list.deleted',          'uses' => 'Route\GroupController@listDeleted']);
        Route::get ('visualizar/grupo/{id?}',          ['as' => 'group.view',                  'uses' => 'Route\GroupController@edit']); // * btn-modal-view-group
        Route::get ('editar/grupo/{id?}',              ['as' => 'group.edit',                  'uses' => 'Route\GroupController@edit']); // * btn-modal-edit-group
        Route::get ('banir/grupo/{id?}',               ['as' => 'group.ban',                   'uses' => 'Route\GroupController@edit']); // * btn-modal-block-group
        Route::get ('deletar/grupo/{id?}',             ['as' => 'group.delete',                'uses' => 'Route\GroupController@edit']); // * btn-modal-delete-group
        Route::get ('recuperar/grupo/{id?}',           ['as' => 'group.recover',               'uses' => 'Route\GroupController@edit']); // * btn-modal-recover-group
        Route::post('novo/grupo',                      ['as' => 'group.store',                 'uses' => 'Route\GroupController@store']); // btn-modal-new-group
        Route::post('atualizar/grupo/{id?}',           ['as' => 'group.update',                'uses' => 'Route\GroupController@update']);
        Route::post('bloquear/grupo/{id?}',            ['as' => 'group.block',                 'uses' => 'Route\GroupController@block']);
        Route::post('remover/grupo/{id?}',             ['as' => 'group.destroy',               'uses' => 'Route\GroupController@destroy']);
        Route::post('restaurar/grupo/{id?}',           ['as' => 'group.restore',               'uses' => 'Route\GroupController@restore']);
        Route::post('verificar/grupo/nome',            ['as' => 'group.check.name',            'uses' => 'Route\CheckController@checkGroupName']);
        Route::post('verificar/grupo/nome/diferente',  ['as' => 'group.check.name.different',  'uses' => 'Route\CheckController@checkGroupNameDifferent']);
        Route::get ('lista/rotas',                     ['as' => 'route.list',                  'uses' => 'Route\RouteController@list']);
        Route::get ('lista/rotas/deletados',           ['as' => 'route.list.deleted',          'uses' => 'Route\RouteController@listDeleted']);
        Route::get ('visualizar/rota/{id?}',           ['as' => 'route.view',                  'uses' => 'Route\RouteController@edit']); // * btn-modal-view-route
        Route::get ('editar/rota/{id?}',               ['as' => 'route.edit',                  'uses' => 'Route\RouteController@edit']); // * btn-modal-edit-route
        Route::get ('banir/rota/{id?}',                ['as' => 'route.ban',                   'uses' => 'Route\RouteController@edit']); // * btn-modal-block-route
        Route::get ('deletar/rota/{id?}',              ['as' => 'route.delete',                'uses' => 'Route\RouteController@edit']); // * btn-modal-delete-route
        Route::get ('recuperar/rota/{id?}',            ['as' => 'route.recover',               'uses' => 'Route\RouteController@edit']); // * btn-modal-recover-route
        Route::post('nova/rota',                       ['as' => 'route.store',                 'uses' => 'Route\RouteController@store']); // btn-modal-new-route
        Route::post('atualizar/rota/{id?}',            ['as' => 'route.update',                'uses' => 'Route\RouteController@update']);
        Route::post('bloquear/rota/{id?}',             ['as' => 'route.block',                 'uses' => 'Route\RouteController@block']);
        Route::post('remover/rota/{id?}',              ['as' => 'route.destroy',               'uses' => 'Route\RouteController@destroy']);
        Route::post('restaurar/rota/{id?}',            ['as' => 'route.restore',               'uses' => 'Route\RouteController@restore']);
        Route::post('verificar/route/route',           ['as' => 'route.check.route',           'uses' => 'Route\CheckController@checkRouteRoute']);
        Route::post('verificar/route/route/diferente', ['as' => 'route.check.route.different', 'uses' => 'Route\CheckController@checkRouteRouteDifferent']);
    });

    // grupo menu
    Route::group(['prefix' => 'menu'], function () {
        Route::get ('data',                       ['as' => 'menu.data',              'uses' => 'Menu\DashboardController@data']);
        Route::get ('dashboard',                  ['as' => 'menu.dashboard',         'uses' => 'Menu\DashboardController@dashboard']);
        Route::get ('lista/menu',                 ['as' => 'menu.list',              'uses' => 'Menu\MenuController@list']);
        Route::get ('lista/menu/deletados',       ['as' => 'menu.list.deleted',      'uses' => 'Menu\MenuController@listDeleted']);
        Route::get ('visualizar/menu/{id?}',      ['as' => 'menu.view',              'uses' => 'Menu\MenuController@edit']); // * btn-modal-view-menu
        Route::get ('editar/menu/{id?}',          ['as' => 'menu.edit',              'uses' => 'Menu\MenuController@edit']); // * btn-modal-edit-menu
        Route::get ('banir/menu/{id?}',           ['as' => 'menu.ban',               'uses' => 'Menu\MenuController@edit']); // * btn-modal-block-menu
        Route::get ('deletar/menu/{id?}',         ['as' => 'menu.delete',            'uses' => 'Menu\MenuController@edit']); // * btn-modal-delete-menu
        Route::get ('recuperar/menu/{id?}',       ['as' => 'menu.recover',           'uses' => 'Menu\MenuController@edit']); // * btn-modal-recover-menu
        Route::post('novo/menu',                  ['as' => 'menu.store',             'uses' => 'Menu\MenuController@store']); // btn-modal-new-menu
        Route::post('atualizar/menu/{id?}',       ['as' => 'menu.update',            'uses' => 'Menu\MenuController@update']);
        Route::post('bloquear/menu/{id?}',        ['as' => 'menu.block',             'uses' => 'Menu\MenuController@block']);
        Route::post('remover/menu/{id?}',         ['as' => 'menu.destroy',           'uses' => 'Menu\MenuController@destroy']);
        Route::post('restaurar/menu/{id?}',       ['as' => 'menu.restore',           'uses' => 'Menu\MenuController@restore']);
        Route::get ('lista/menu-itens',           ['as' => 'menu.item.list',         'uses' => 'Menu\MenuItemController@list']);
        Route::get ('lista/menu-itens/deletados', ['as' => 'menu.item.list.deleted', 'uses' => 'Menu\MenuItemController@listDeleted']);
        Route::get ('visualizar/menu-item/{id?}', ['as' => 'menu.item.view',         'uses' => 'Menu\MenuItemController@edit']); // * btn-modal-view-menu-item
        Route::get ('editar/menu-item/{id?}',     ['as' => 'menu.item.edit',         'uses' => 'Menu\MenuItemController@edit']); // * btn-modal-edit-menu-item
        Route::get ('banir/menu-item/{id?}',      ['as' => 'menu.item.ban',          'uses' => 'Menu\MenuItemController@edit']); // * btn-modal-block-menu-item
        Route::get ('deletar/menu-item/{id?}',    ['as' => 'menu.item.delete',       'uses' => 'Menu\MenuItemController@edit']); // * btn-modal-delete-menu-item
        Route::get ('recuperar/menu-item/{id?}',  ['as' => 'menu.item.recover',      'uses' => 'Menu\MenuItemController@edit']); // * btn-modal-recover-menu-item
        Route::post('novo/menu-item',             ['as' => 'menu.item.store',        'uses' => 'Menu\MenuItemController@store']); // btn-modal-new-menu-item
        Route::post('atualizar/menu-item/{id?}',  ['as' => 'menu.item.update',       'uses' => 'Menu\MenuItemController@update']);
        Route::post('bloquear/menu-item/{id?}',   ['as' => 'menu.item.block',        'uses' => 'Menu\MenuItemController@block']);
        Route::post('remover/menu-item/{id?}',    ['as' => 'menu.item.destroy',      'uses' => 'Menu\MenuItemController@destroy']);
        Route::post('restaurar/menu-item/{id?}',  ['as' => 'menu.item.restore',      'uses' => 'Menu\MenuItemController@restore']);
    });

    // grupo permissões
    Route::group(['prefix' => 'permissoes'], function () {
        Route::get ('lista/sem-permissoes',    ['as' => 'permission.user.list',     'uses' => 'User\PermissionController@list']);
        Route::get ('lista/permissoes',        ['as' => 'permission.user.list.all', 'uses' => 'User\PermissionController@listAll']);
        Route::get ('usuario/editar',          ['as' => 'permission.user.edit',     'uses' => 'User\PermissionController@edit']); // * btn-edit-permission-user
        Route::post('usuario/atualizar/{id?}', ['as' => 'permission.user.update',   'uses' => 'User\PermissionController@update']);
    });

    // grupo departamentos
    Route::group(['prefix' => 'departamentos'], function () {
        Route::get ('data',                     ['as' => 'department.data',                 'uses' => 'Department\DashboardController@data']);
        Route::get ('dashboard',                ['as' => 'department.dashboard',            'uses' => 'Department\DashboardController@dashboard']);
        Route::get ('lista',                    ['as' => 'department.list',                 'uses' => 'Department\DepartmentController@list']);
        Route::get ('lista/deletados',          ['as' => 'department.list.deleted',         'uses' => 'Department\DepartmentController@listDeleted']);
        Route::get ('visualizar/{id?}',         ['as' => 'department.view',                 'uses' => 'Department\DepartmentController@edit']); // * btn-modal-view-department
        Route::get ('editar/{id?}',             ['as' => 'department.edit',                 'uses' => 'Department\DepartmentController@edit']); // * btn-modal-edit-department
        Route::get ('banir/{id?}',              ['as' => 'department.ban',                  'uses' => 'Department\DepartmentController@edit']); // * btn-modal-block-department
        Route::get ('deletar/{id?}',            ['as' => 'department.delete',               'uses' => 'Department\DepartmentController@edit']); // * btn-modal-delete-department
        Route::get ('recuperar/{id?}',          ['as' => 'department.recover',              'uses' => 'Department\DepartmentController@edit']); // * btn-modal-recover-department
        Route::post('novo',                     ['as' => 'department.store',                'uses' => 'Department\DepartmentController@store']); // btn-modal-new-department
        Route::post('atualizar/{id?}',          ['as' => 'department.update',               'uses' => 'Department\DepartmentController@update']);
        Route::post('bloquear/{id?}',           ['as' => 'department.block',                'uses' => 'Department\DepartmentController@block']);
        Route::post('remover/{id?}',            ['as' => 'department.destroy',              'uses' => 'Department\DepartmentController@destroy']);
        Route::post('restaurar/{id?}',          ['as' => 'department.restore',              'uses' => 'Department\DepartmentController@restore']);
        Route::post('verificar/nome',           ['as' => 'department.check.name',           'uses' => 'Department\CheckController@checkName']);
        Route::post('verificar/nome/diferente', ['as' => 'department.check.name.different', 'uses' => 'Department\CheckController@checkNameDifferent']);
    });

    // grupo inventários
    Route::group(['prefix' => 'inventarios'], function () {
        Route::get ('data',                               ['as' => 'inventory.data',                          'uses' => 'Inventory\DashboardController@data']);
        Route::get ('dashboard',                          ['as' => 'inventory.dashboard',                     'uses' => 'Inventory\DashboardController@dashboard']);
        Route::get ('lista/categorias',                   ['as' => 'inventory.category.list',                 'uses' => 'Inventory\InventoryCategoryController@list']);
        Route::get ('lista/categorias/deletadas',         ['as' => 'inventory.category.list.deleted',         'uses' => 'Inventory\InventoryCategoryController@listDeleted']);
        Route::get ('visualizar/categoria/{id?}',         ['as' => 'inventory.category.view',                 'uses' => 'Inventory\InventoryCategoryController@edit']); // * btn-modal-view-inventory-category
        Route::get ('editar/categoria/{id?}',             ['as' => 'inventory.category.edit',                 'uses' => 'Inventory\InventoryCategoryController@edit']); // * btn-modal-edit-inventory-category
        Route::get ('banir/categoria/{id?}',              ['as' => 'inventory.category.ban',                  'uses' => 'Inventory\InventoryCategoryController@edit']); // * btn-modal-block-inventory-category
        Route::get ('deletar/categoria/{id?}',            ['as' => 'inventory.category.delete',               'uses' => 'Inventory\InventoryCategoryController@edit']); // * btn-modal-delete-inventory-category
        Route::get ('recuperar/categoria/{id?}',          ['as' => 'inventory.category.recover',              'uses' => 'Inventory\InventoryCategoryController@edit']); // * btn-modal-recover-inventory-category
        Route::post('nova/categoria',                     ['as' => 'inventory.category.store',                'uses' => 'Inventory\InventoryCategoryController@store']); // btn-modal-new-inventory-category
        Route::post('atualizar/categoria/{id?}',          ['as' => 'inventory.category.update',               'uses' => 'Inventory\InventoryCategoryController@update']);
        Route::post('bloquear/categoria/{id?}',           ['as' => 'inventory.category.block',                'uses' => 'Inventory\InventoryCategoryController@block']);
        Route::post('remover/categoria/{id?}',            ['as' => 'inventory.category.destroy',              'uses' => 'Inventory\InventoryCategoryController@destroy']);
        Route::post('restaurar/categoria/{id?}',          ['as' => 'inventory.category.restore',              'uses' => 'Inventory\InventoryCategoryController@restore']);
        Route::post('verificar/categoria/nome',           ['as' => 'inventory.category.check.name',           'uses' => 'Inventory\CheckController@checkName']);
        Route::post('verificar/categoria/nome/diferente', ['as' => 'inventory.category.check.name.different', 'uses' => 'Inventory\CheckController@checkNameDifferent']);
        Route::get ('lista/inventarios',                  ['as' => 'inventory.list',                          'uses' => 'Inventory\InventoryController@list']);
        Route::get ('lista/inventarios/deletados',        ['as' => 'inventory.list.deleted',                  'uses' => 'Inventory\InventoryController@listDeleted']);
        Route::get ('visualizar/inventario/{id?}',        ['as' => 'inventory.view',                          'uses' => 'Inventory\InventoryController@edit']); // * btn-modal-view-inventory
        Route::get ('editar/inventario/{id?}',            ['as' => 'inventory.edit',                          'uses' => 'Inventory\InventoryController@edit']); // * btn-modal-edit-inventory
        Route::get ('deletar/inventario/{id?}',           ['as' => 'inventory.delete',                        'uses' => 'Inventory\InventoryController@edit']); // * btn-modal-delete-inventory
        Route::get ('recuperar/inventario/{id?}',         ['as' => 'inventory.recover',                       'uses' => 'Inventory\InventoryController@edit']); // * btn-modal-recover-inventory
        Route::post('novo/inventario',                    ['as' => 'inventory.store',                         'uses' => 'Inventory\InventoryController@store']); // btn-modal-new-inventory
        Route::post('atualizar/inventario/{id?}',         ['as' => 'inventory.update',                        'uses' => 'Inventory\InventoryController@update']);
        Route::post('remover/inventario/{id?}',           ['as' => 'inventory.destroy',                       'uses' => 'Inventory\InventoryController@destroy']);
        Route::post('restaurar/inventario/{id?}',         ['as' => 'inventory.restore',                       'uses' => 'Inventory\InventoryController@restore']);
    });

    // grupo moradores
    Route::group(['prefix' => 'moradores'], function () {
        Route::get ('lista',                     ['as' => 'resident.list',                  'uses' => 'Resident\ResidentController@list']);
        Route::get ('lista/deletados',           ['as' => 'resident.list.deleted',          'uses' => 'Resident\ResidentController@listDeleted']);
        Route::get ('visualizar/{id?}',          ['as' => 'resident.view',                  'uses' => 'Resident\ResidentController@edit']); // * btn-modal-view-resident
        Route::get ('editar/{id?}',              ['as' => 'resident.edit',                  'uses' => 'Resident\ResidentController@edit']); // * btn-modal-edit-resident
        Route::get ('deletar/{id?}',             ['as' => 'resident.delete',                'uses' => 'Resident\ResidentController@edit']); // * btn-modal-delete-resident
        Route::get ('recuperar/{id?}',           ['as' => 'resident.recover',               'uses' => 'Resident\ResidentController@edit']); // * btn-modal-recover-resident
        Route::post('novo',                      ['as' => 'resident.store',                 'uses' => 'Resident\ResidentController@store']); // btn-modal-new-resident
        Route::post('atualizar/{id?}',           ['as' => 'resident.update',                'uses' => 'Resident\ResidentController@update']);
        Route::post('remover/{id?}',             ['as' => 'resident.destroy',               'uses' => 'Resident\ResidentController@destroy']);
        Route::post('restaurar/{id?}',           ['as' => 'resident.restore',               'uses' => 'Resident\ResidentController@restore']);
        Route::post('enviar/email',              ['as' => 'resident.send.email',            'uses' => 'Resident\ResidentController@sendEmail']); // * btn-send-email-resident
        Route::post('verificar/email',           ['as' => 'resident.check.email',           'uses' => 'Resident\CheckController@checkEmail']);
        Route::post('verificar/email/diferente', ['as' => 'resident.check.email.different', 'uses' => 'Resident\CheckController@checkEmailDifferent']);
        Route::post('verificar/cpf',             ['as' => 'resident.check.cpf',             'uses' => 'Resident\CheckController@checkCpf']);
        Route::post('verificar/cpf/diferente',   ['as' => 'resident.check.cpf.different',   'uses' => 'Resident\CheckController@checkCpfDifferent']);
        Route::post('verificar/rg',              ['as' => 'resident.check.rg',              'uses' => 'Resident\CheckController@checkRg']);
        Route::post('verificar/rg/diferente',    ['as' => 'resident.check.rg.different',    'uses' => 'Resident\CheckController@checkRgDifferent']);
    });

    */
});
