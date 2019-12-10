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

// default laravel
Auth::routes(['register' => false, 'confirm' => false, 'verify' => true]);
Route::get ('/',      function () { return redirect('login'); })->middleware('guest');
Route::get ('logout', function () { Auth::logout(); return redirect('login'); })->name('logout');
Route::get ('sair',   function () { Auth::logout(); return redirect('login'); })->name('sair');
Route::post('erro', ['as' => 'remote.validate.destroy', 'uses' => 'ErrorController@remoteValidateDestroy']);

// login
Route::get ('login', ['as' => 'login',  'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'login',  'uses' => 'Auth\LoginController@login']);
Route::post('sair',  ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

// resetar senha
Route::get ('resetar/senha',          ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::get ('resetar/senha/{token?}', ['as' => 'password.reset',   'uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::post('senha/email',            ['as' => 'password.email',   'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::post('senha/resetar',          ['as' => 'password.update',  'uses' => 'Auth\ResetPasswordController@reset']);

// verificar e-mail
Route::get('verificar/email',       ['as' => 'verification.notice', 'uses' => 'Auth\VerificationController@show']);
Route::get('verificar/email/{id?}', ['as' => 'verification.verify', 'uses' => 'Auth\VerificationController@verify']);
Route::get('reenviar/email',        ['as' => 'verification.resend', 'uses' => 'Auth\VerificationController@resend']);

// restrições para acesso
Route::group(['middleware' => ['auth', 'verified', 'unique']], function () {
    // perfil
    Route::group(['prefix' => 'perfil'], function () {
        Route::post('atualizar/{id?}',           ['as' => 'profile.update',                'uses' => 'Profile\ProfileController@update']);
        Route::post('alterar/condominio/{id?}',    ['as' => 'profile.entity',                'uses' => 'Profile\ProfileController@entity']);
        Route::post('verificar/senha',           ['as' => 'profile.check.password',        'uses' => 'Profile\CheckController@checkPassword']);
        Route::post('verificar/email/diferente', ['as' => 'profile.check.email.different', 'uses' => 'Management\User\CheckController@checkEmailDifferent']);
        Route::post('verificar/cpf/diferente',   ['as' => 'profile.check.cpf.different',   'uses' => 'Management\User\CheckController@checkCpfDifferent']);
        Route::post('verificar/rg/diferente',    ['as' => 'profile.check.rg.different',    'uses' => 'Management\User\CheckController@checkRgDifferent']);
    });

    // administrador
    Route::group(['prefix' => 'gerenciamento/administradores'], function () {
        Route::get ('data',                      ['as' => 'admin.data',                  'uses' => 'Management\Admin\DashboardController@data']);
        Route::post('atualizar/{id?}',           ['as' => 'admin.update',                'uses' => 'Management\Admin\AdminController@update']);
        Route::post('bloquear/{id?}',            ['as' => 'admin.block',                 'uses' => 'Management\Admin\AdminController@block']);
        Route::post('remover/{id?}',             ['as' => 'admin.destroy',               'uses' => 'Management\Admin\AdminController@destroy']);
        Route::post('restaurar/{id?}',           ['as' => 'admin.restore',               'uses' => 'Management\Admin\AdminController@restore']);
        Route::post('verificar/email',           ['as' => 'admin.check.email',           'uses' => 'Management\User\CheckController@checkEmail']);
        Route::post('verificar/email/diferente', ['as' => 'admin.check.email.different', 'uses' => 'Management\User\CheckController@checkEmailDifferent']);
        Route::post('verificar/cpf',             ['as' => 'admin.check.cpf',             'uses' => 'Management\User\CheckController@checkCpf']);
        Route::post('verificar/cpf/diferente',   ['as' => 'admin.check.cpf.different',   'uses' => 'Management\User\CheckController@checkCpfDifferent']);
        Route::post('verificar/rg',              ['as' => 'admin.check.rg',              'uses' => 'Management\User\CheckController@checkRg']);
        Route::post('verificar/rg/diferente',    ['as' => 'admin.check.rg.different',    'uses' => 'Management\User\CheckController@checkRgDifferent']);
    });

    // usuários
    Route::group(['prefix' => 'gerenciamento/usuarios'], function () {
        Route::get ('data',                      ['as' => 'user.data',                  'uses' => 'Management\User\DashboardController@data']);
        Route::post('atualizar/{id?}',           ['as' => 'user.update',                'uses' => 'Management\User\UserController@update']);
        Route::post('bloquear/{id?}',            ['as' => 'user.block',                 'uses' => 'Management\User\UserController@block']);
        Route::post('remover/{id?}',             ['as' => 'user.destroy',               'uses' => 'Management\User\UserController@destroy']);
        Route::post('restaurar/{id?}',           ['as' => 'user.restore',               'uses' => 'Management\User\UserController@restore']);
        Route::post('verificar/email',           ['as' => 'user.check.email',           'uses' => 'Management\User\CheckController@checkEmail']);
        Route::post('verificar/email/diferente', ['as' => 'user.check.email.different', 'uses' => 'Management\User\CheckController@checkEmailDifferent']);
        Route::post('verificar/cpf',             ['as' => 'user.check.cpf',             'uses' => 'Management\User\CheckController@checkCpf']);
        Route::post('verificar/cpf/diferente',   ['as' => 'user.check.cpf.different',   'uses' => 'Management\User\CheckController@checkCpfDifferent']);
        Route::post('verificar/rg',              ['as' => 'user.check.rg',              'uses' => 'Management\User\CheckController@checkRg']);
        Route::post('verificar/rg/diferente',    ['as' => 'user.check.rg.different',    'uses' => 'Management\User\CheckController@checkRgDifferent']);
    });

    // empresas
    Route::group(['prefix' => 'gerenciamento/empresas'], function () {
        Route::get ('data',                      ['as' => 'company.data',                  'uses' => 'Management\Company\DashboardController@data']);
        Route::post('atualizar/{id?}',           ['as' => 'company.update',                'uses' => 'Management\Company\CompanyController@update']);
        Route::post('bloquear/{id?}',            ['as' => 'company.block',                 'uses' => 'Management\Company\CompanyController@block']);
        Route::post('remover/{id?}',             ['as' => 'company.destroy',               'uses' => 'Management\Company\CompanyController@destroy']);
        Route::post('restaurar/{id?}',           ['as' => 'company.restore',               'uses' => 'Management\Company\CompanyController@restore']);
        Route::post('verificar/email',           ['as' => 'company.check.email',           'uses' => 'Management\Company\CheckController@checkEmail']);
        Route::post('verificar/email/diferente', ['as' => 'company.check.email.different', 'uses' => 'Management\Company\CheckController@checkEmailDifferent']);
        Route::post('verificar/cnpj',            ['as' => 'company.check.cnpj',            'uses' => 'Management\Company\CheckController@checkCnpj']);
        Route::post('verificar/cnpj/diferente',  ['as' => 'company.check.cnpj.different',  'uses' => 'Management\Company\CheckController@checkCnpjDifferent']);
    });

    // condominios
    Route::group(['prefix' => 'gerenciamento/condominios'], function () {
        Route::get ('data',                      ['as' => 'entity.data',                  'uses' => 'Management\Entity\DashboardController@data']);
        Route::post('atualizar/{id?}',           ['as' => 'entity.update',                'uses' => 'Management\Entity\EntityController@update']);
        Route::post('bloquear/{id?}',            ['as' => 'entity.block',                 'uses' => 'Management\Entity\EntityController@block']);
        Route::post('remover/{id?}',             ['as' => 'entity.destroy',               'uses' => 'Management\Entity\EntityController@destroy']);
        Route::post('restaurar/{id?}',           ['as' => 'entity.restore',               'uses' => 'Management\Entity\EntityController@restore']);
        Route::post('verificar/email',           ['as' => 'entity.check.email',           'uses' => 'Management\Entity\CheckController@checkEmail']);
        Route::post('verificar/email/diferente', ['as' => 'entity.check.email.different', 'uses' => 'Management\Entity\CheckController@checkEmailDifferent']);
        Route::post('verificar/cnpj',            ['as' => 'entity.check.cnpj',            'uses' => 'Management\Entity\CheckController@checkCnpj']);
        Route::post('verificar/cnpj/diferente',  ['as' => 'entity.check.cnpj.different',  'uses' => 'Management\Entity\CheckController@checkCnpjDifferent']);
    });

    // permissões
    Route::group(['prefix' => 'gerenciamento/permissoes'], function () {
        Route::post('usuario/atualizar/{id?}', ['as' => 'permission.user.update', 'uses' => 'Management\PermissionController@update']);
    });

    // grupos
    Route::group(['prefix' => 'layout/grupos'], function () {
        Route::get ('data',                     ['as' => 'group.data',                 'uses' => 'Layout\Group\DashboardController@data']);
        Route::post('atualizar/{id?}',          ['as' => 'group.update',               'uses' => 'Layout\Group\GroupController@update']);
        Route::post('bloquear/{id?}',           ['as' => 'group.block',                'uses' => 'Layout\Group\GroupController@block']);
        Route::post('remover/{id?}',            ['as' => 'group.destroy',              'uses' => 'Layout\Group\GroupController@destroy']);
        Route::post('restaurar/{id?}',          ['as' => 'group.restore',              'uses' => 'Layout\Group\GroupController@restore']);
        Route::post('verificar/nome',           ['as' => 'group.check.name',           'uses' => 'Layout\Group\CheckController@checkGroupName']);
        Route::post('verificar/nome/diferente', ['as' => 'group.check.name.different', 'uses' => 'Layout\Group\CheckController@checkGroupNameDifferent']);
    });

    // rotas
    Route::group(['prefix' => 'layout/rotas'], function () {
        Route::get ('data',                     ['as' => 'route.data',                  'uses' => 'Layout\Route\DashboardController@data']);
        Route::post('atualizar/{id?}',          ['as' => 'route.update',                'uses' => 'Layout\Route\RouteController@update']);
        Route::post('bloquear/{id?}',           ['as' => 'route.block',                 'uses' => 'Layout\Route\RouteController@block']);
        Route::post('remover/{id?}',            ['as' => 'route.destroy',               'uses' => 'Layout\Route\RouteController@destroy']);
        Route::post('restaurar/{id?}',          ['as' => 'route.restore',               'uses' => 'Layout\Route\RouteController@restore']);
        Route::post('verificar/rota',           ['as' => 'route.check.route',           'uses' => 'Layout\Route\CheckController@checkRouteRoute']);
        Route::post('verificar/rota/diferente', ['as' => 'route.check.route.different', 'uses' => 'Layout\Route\CheckController@checkRouteRouteDifferent']);
    });

    // menu
    Route::group(['prefix' => 'layout/menu'], function () {
        Route::get ('data',            ['as' => 'menu.data',    'uses' => 'Layout\Menu\DashboardController@data']);
        Route::post('atualizar/{id?}', ['as' => 'menu.update',  'uses' => 'Layout\Menu\MenuController@update']);
        Route::post('bloquear/{id?}',  ['as' => 'menu.block',   'uses' => 'Layout\Menu\MenuController@block']);
        Route::post('remover/{id?}',   ['as' => 'menu.destroy', 'uses' => 'Layout\Menu\MenuController@destroy']);
        Route::post('restaurar/{id?}', ['as' => 'menu.restore', 'uses' => 'Layout\Menu\MenuController@restore']);
    });

    // menu itens
    Route::group(['prefix' => 'layout/menu-itens'], function () {
        Route::get ('data',            ['as' => 'menu.item.data',    'uses' => 'Layout\MenuItem\DashboardController@data']);
        Route::post('atualizar/{id?}', ['as' => 'menu.item.update',  'uses' => 'Layout\MenuItem\MenuItemController@update']);
        Route::post('bloquear/{id?}',  ['as' => 'menu.item.block',   'uses' => 'Layout\MenuItem\MenuItemController@block']);
        Route::post('remover/{id?}',   ['as' => 'menu.item.destroy', 'uses' => 'Layout\MenuItem\MenuItemController@destroy']);
        Route::post('restaurar/{id?}', ['as' => 'menu.item.restore', 'uses' => 'Layout\MenuItem\MenuItemController@restore']);
    });

    // departamentos
    Route::group(['prefix' => 'administrativo/departamentos'], function () {
        Route::get ('data',                     ['as' => 'department.data',                 'uses' => 'Administrative\Department\DashboardController@data']);
        Route::post('atualizar/{id?}',          ['as' => 'department.update',               'uses' => 'Administrative\Department\DepartmentController@update']);
        Route::post('bloquear/{id?}',           ['as' => 'department.block',                'uses' => 'Administrative\Department\DepartmentController@block']);
        Route::post('remover/{id?}',            ['as' => 'department.destroy',              'uses' => 'Administrative\Department\DepartmentController@destroy']);
        Route::post('restaurar/{id?}',          ['as' => 'department.restore',              'uses' => 'Administrative\Department\DepartmentController@restore']);
        Route::post('verificar/nome',           ['as' => 'department.check.name',           'uses' => 'Administrative\Department\CheckController@checkName']);
        Route::post('verificar/nome/diferente', ['as' => 'department.check.name.different', 'uses' => 'Administrative\Department\CheckController@checkNameDifferent']);
    });

    // inventário categorias
    Route::group(['prefix' => 'administrativo/inventario/categorias'], function () {
        Route::get ('data',                     ['as' => 'inventory.category.data',                 'uses' => 'Administrative\Inventory\InventoryCategory\DashboardController@data']);
        Route::post('atualizar/{id?}',          ['as' => 'inventory.category.update',               'uses' => 'Administrative\Inventory\InventoryCategory\InventoryCategoryController@update']);
        Route::post('bloquear/{id?}',           ['as' => 'inventory.category.block',                'uses' => 'Administrative\Inventory\InventoryCategory\InventoryCategoryController@block']);
        Route::post('remover/{id?}',            ['as' => 'inventory.category.destroy',              'uses' => 'Administrative\Inventory\InventoryCategory\InventoryCategoryController@destroy']);
        Route::post('restaurar/{id?}',          ['as' => 'inventory.category.restore',              'uses' => 'Administrative\Inventory\InventoryCategory\InventoryCategoryController@restore']);
        Route::post('verificar/nome',           ['as' => 'inventory.category.check.name',           'uses' => 'Administrative\Inventory\InventoryCategory\CheckController@checkName']);
        Route::post('verificar/nome/diferente', ['as' => 'inventory.category.check.name.different', 'uses' => 'Administrative\Inventory\InventoryCategory\CheckController@checkNameDifferent']);
    });

    // inventário
    Route::group(['prefix' => 'administrativo/inventario'], function () {
        Route::get ('data',             ['as' => 'inventory.data',         'uses' => 'Administrative\Inventory\Inventory\DashboardController@data']);
        Route::post('atualizar/{id?}',  ['as' => 'inventory.update',       'uses' => 'Administrative\Inventory\Inventory\InventoryController@update']);
        Route::post('remover/{id?}',    ['as' => 'inventory.destroy',      'uses' => 'Administrative\Inventory\Inventory\InventoryController@destroy']);
        Route::post('restaurar/{id?}',  ['as' => 'inventory.restore',      'uses' => 'Administrative\Inventory\Inventory\InventoryController@restore']);
    });

    // condominio bloco
    Route::group(['prefix' => 'condominio/bloco'], function () {
        Route::get ('data',                     ['as' => 'condominium.block.data',                 'uses' => 'Condominium\Block\DashboardController@data']);
        Route::post('atualizar/{id?}',          ['as' => 'condominium.block.update',               'uses' => 'Condominium\Block\BlockController@update']);
        Route::post('remover/{id?}',            ['as' => 'condominium.block.destroy',              'uses' => 'Condominium\Block\BlockController@destroy']);
        Route::post('restaurar/{id?}',          ['as' => 'condominium.block.restore',              'uses' => 'Condominium\Block\BlockController@restore']);
        Route::post('verificar/nome',           ['as' => 'condominium.block.check.name',           'uses' => 'Condominium\Block\CheckController@checkBlockName']);
        Route::post('verificar/nome/diferente', ['as' => 'condominium.block.check.name.different', 'uses' => 'Condominium\Block\CheckController@checkBlockNameDifferent']);
    });

    // restrições de permissões
    Route::group(['middleware' => ['permission']], function () {
        // grupos do banco
        if (Schema::hasTable('groups')) {
            foreach (Group::getGroups() as $group) {
                $this->group = $group->id;

                Route::group(['prefix' => $group->name], function () {
                    foreach (Routes::getRoutes() as $route) {
                        if ($route->group_id == $this->group) {
                            if ($route->route_option_id == 1) {
                                Route::get($route->url, ['as' => $route->route, 'uses' => $route->controller]);
                            } else {
                                Route::post($route->url, ['as' => $route->route, 'uses' => $route->controller]);
                            }
                        }
                    }
                });
            }
        }
    });

    /*
    =======================================================
    Rotas que necessitam de permissões para acesso
    Nomenclaturas:
    // -> é um botão ou link de acesso a um modal ou função
    *  -> é um botão ou link de listagem
    =======================================================

    // home
    Route::group(['prefix' => 'home'], function () {
        Route::get('index', ['as' => 'home.index', 'uses' => 'HomeController@index']);
    });

    // perfil
    Route::group(['prefix' => 'perfil'], function () {
        Route::get ('editar',      ['as' => 'profile.edit',           'uses' => 'Profile\ProfileController@edit']);
        Route::post('senha/{id?}', ['as' => 'profile.password.reset', 'uses' => 'Profile\ProfileController@passwordReset']); // btn-modal-password-reset-profile
        Route::post('suporte',     ['as' => 'profile.support',        'uses' => 'Profile\ProfileController@support']); // btn-modal-send-support-profile
    });

    // administrador
    Route::group(['prefix' => 'gerenciamento/administradores'], function () {
        Route::get ('dashboard',        ['as' => 'admin.dashboard',     'uses' => 'Management\Admin\DashboardController@dashboard']);
        Route::get ('lista',            ['as' => 'admin.list',          'uses' => 'Management\Admin\AdminController@list']);
        Route::get ('lista/deletados',  ['as' => 'admin.list.deleted',  'uses' => 'Management\Admin\AdminController@listDeleted']);
        Route::get ('visualizar/{id?}', ['as' => 'admin.view',          'uses' => 'Management\Admin\AdminController@edit']); // * btn-modal-view-admin
        Route::post('novo',             ['as' => 'admin.store',         'uses' => 'Management\Admin\AdminController@store']); // btn-modal-new-admin
        Route::get ('editar/{id?}',     ['as' => 'admin.edit',          'uses' => 'Management\Admin\AdminController@edit']); // * btn-modal-edit-admin
        Route::get ('banir/{id?}',      ['as' => 'admin.ban',           'uses' => 'Management\Admin\AdminController@edit']); // * btn-modal-block-admin
        Route::get ('deletar/{id?}',    ['as' => 'admin.delete',        'uses' => 'Management\Admin\AdminController@edit']); // * btn-modal-delete-admin
        Route::get ('recuperar/{id?}',  ['as' => 'admin.recover',       'uses' => 'Management\Admin\AdminController@edit']); // * btn-modal-recover-admin
        Route::post('enviar/email',     ['as' => 'admin.send.email',    'uses' => 'Management\Admin\AdminController@sendEmail']); // * btn-modal-send-email-admin
        Route::post('reenviar/email',   ['as' => 'admin.resend.email',  'uses' => 'Management\Admin\AdminController@resendEmail']); // btn-resend-email-admin
    });

    // usuários
    Route::group(['prefix' => 'gerenciamento/usuarios'], function () {
        Route::get ('dashboard',        ['as' => 'user.dashboard',    'uses' => 'Management\User\DashboardController@dashboard']);
        Route::get ('lista',            ['as' => 'user.list',         'uses' => 'Management\User\UserController@list']);
        Route::get ('lista/deletados',  ['as' => 'user.list.deleted', 'uses' => 'Management\User\UserController@listDeleted']);
        Route::get ('visualizar/{id?}', ['as' => 'user.view',         'uses' => 'Management\User\UserController@edit']); // * btn-modal-view-user
        Route::post('novo',             ['as' => 'user.store',        'uses' => 'Management\User\UserController@store']); // btn-modal-new-user
        Route::get ('editar/{id?}',     ['as' => 'user.edit',         'uses' => 'Management\User\UserController@edit']); // * btn-modal-edit-user
        Route::get ('banir/{id?}',      ['as' => 'user.ban',          'uses' => 'Management\User\UserController@edit']); // * btn-modal-block-user
        Route::get ('deletar/{id?}',    ['as' => 'user.delete',       'uses' => 'Management\User\UserController@edit']); // * btn-modal-delete-user
        Route::get ('recuperar/{id?}',  ['as' => 'user.recover',      'uses' => 'Management\User\UserController@edit']); // * btn-modal-recover-user
        Route::post('enviar/email',     ['as' => 'user.send.email',   'uses' => 'Management\User\UserController@sendEmail']); // * btn-modal-send-email-user
        Route::post('reenviar/email',   ['as' => 'user.resend.email', 'uses' => 'Management\User\UserController@resendEmail']); // btn-resend-email-user
    });

    // empresas
    Route::group(['prefix' => 'gerenciamento/empresas'], function () {
        Route::get ('dashboard',             ['as' => 'company.dashboard',    'uses' => 'Management\Company\DashboardController@dashboard']);
        Route::get ('lista',                 ['as' => 'company.list',         'uses' => 'Management\Company\CompanyController@list']);
        Route::get ('lista/deletados',       ['as' => 'company.list.deleted', 'uses' => 'Management\Company\CompanyController@listDeleted']);
        Route::get ('lista/administradores', ['as' => 'company.list.admins', 'uses' => 'Management\Company\CompanyController@listAdmins']);
        Route::get ('visualizar/{id?}',      ['as' => 'company.view',         'uses' => 'Management\Company\CompanyController@edit']); // * btn-modal-view-company
        Route::post('novo',                  ['as' => 'company.store',        'uses' => 'Management\Company\CompanyController@store']); // btn-modal-new-company
        Route::post('novo/administrador',    ['as' => 'company.admin.store',  'uses' => 'Management\Company\CompanyController@storeAdmin']); // * btn-modal-new-admin-company
        Route::get ('editar/{id?}',          ['as' => 'company.edit',         'uses' => 'Management\Company\CompanyController@edit']); // * btn-modal-edit-company
        Route::get ('banir/{id?}',           ['as' => 'company.ban',          'uses' => 'Management\Company\CompanyController@edit']); // * btn-modal-block-company
        Route::get ('deletar/{id?}',         ['as' => 'company.delete',       'uses' => 'Management\Company\CompanyController@edit']); // * btn-modal-delete-company
        Route::get ('recuperar/{id?}',       ['as' => 'company.recover',      'uses' => 'Management\Company\CompanyController@edit']); // * btn-modal-recover-company
        Route::post('enviar/email',          ['as' => 'company.send.email',   'uses' => 'Management\Company\CompanyController@sendEmail']); // * btn-modal-send-email-company
    });

    // condominios
    Route::group(['prefix' => 'gerenciamento/condominios'], function () {
        Route::get ('dashboard',        ['as' => 'entity.dashboard',    'uses' => 'Management\Entity\DashboardController@dashboard']);
        Route::get ('lista',            ['as' => 'entity.list',         'uses' => 'Management\Entity\EntityController@list']);
        Route::get ('lista/deletadas',  ['as' => 'entity.list.deleted', 'uses' => 'Management\Entity\EntityController@listDeleted']);
        Route::get ('lista/usuarios',   ['as' => 'entity.list.users',   'uses' => 'Management\Entity\EntityController@listUsers']);
        Route::get ('visualizar/{id?}', ['as' => 'entity.view',         'uses' => 'Management\Entity\EntityController@edit']); // * btn-modal-view-entity
        Route::post('nova',             ['as' => 'entity.store',        'uses' => 'Management\Entity\EntityController@store']); // btn-modal-new-entity
        Route::post('novo/usuario',     ['as' => 'entity.user.store',   'uses' => 'Management\Entity\EntityController@storeUser']); // * btn-modal-new-user-entity
        Route::get ('editar/{id?}',     ['as' => 'entity.edit',         'uses' => 'Management\Entity\EntityController@edit']); // * btn-modal-edit-entity
        Route::get ('banir/{id?}',      ['as' => 'entity.ban',          'uses' => 'Management\Entity\EntityController@edit']); // * btn-modal-block-entity
        Route::get ('deletar/{id?}',    ['as' => 'entity.delete',       'uses' => 'Management\Entity\EntityController@edit']); // * btn-modal-delete-entity
        Route::get ('recuperar/{id?}',  ['as' => 'entity.recover',      'uses' => 'Management\Entity\EntityController@edit']); // * btn-modal-recover-entity
        Route::post('enviar/email',     ['as' => 'entity.send.email',   'uses' => 'Management\Entity\EntityController@sendEmail']); // * btn-modal-send-email-entity
    });

    // permissões
    Route::group(['prefix' => 'gerenciamento/permissoes'], function () {
        Route::get ('lista/sem-permissoes', ['as' => 'permission.user.list.without', 'uses' => 'Management\PermissionController@listWithout']);
        Route::get ('lista/com-permissoes', ['as' => 'permission.user.list.with',    'uses' => 'Management\PermissionController@listWith']);
        Route::get ('usuario/editar',       ['as' => 'permission.user.edit',         'uses' => 'Management\PermissionController@edit']); // * btn-edit-permission-user
    });

    // grupos
    Route::group(['prefix' => 'layout/grupos'], function () {
        Route::get ('dashboard',        ['as' => 'group.dashboard',    'uses' => 'Layout\Group\DashboardController@dashboard']);
        Route::get ('lista',            ['as' => 'group.list',         'uses' => 'Layout\Group\GroupController@list']);
        Route::get ('lista/deletados',  ['as' => 'group.list.deleted', 'uses' => 'Layout\Group\GroupController@listDeleted']);
        Route::get ('visualizar/{id?}', ['as' => 'group.view',         'uses' => 'Layout\Group\GroupController@edit']); // * btn-modal-view-group
        Route::post('novo',             ['as' => 'group.store',        'uses' => 'Layout\Group\GroupController@store']); // btn-modal-new-group
        Route::get ('editar/{id?}',     ['as' => 'group.edit',         'uses' => 'Layout\Group\GroupController@edit']); // * btn-modal-edit-group
        Route::get ('banir/{id?}',      ['as' => 'group.ban',          'uses' => 'Layout\Group\GroupController@edit']); // * btn-modal-block-group
        Route::get ('deletar/{id?}',    ['as' => 'group.delete',       'uses' => 'Layout\Group\GroupController@edit']); // * btn-modal-delete-group
        Route::get ('recuperar/{id?}',  ['as' => 'group.recover',      'uses' => 'Layout\Group\GroupController@edit']); // * btn-modal-recover-group
    });

    // rotas
    Route::group(['prefix' => 'layout/rotas'], function () {
        Route::get ('dashboard',        ['as' => 'route.dashboard',    'uses' => 'Layout\Route\DashboardController@dashboard']);
        Route::get ('lista',            ['as' => 'route.list',         'uses' => 'Layout\Route\RouteController@list']);
        Route::get ('lista/deletadas',  ['as' => 'route.list.deleted', 'uses' => 'Layout\Route\RouteController@listDeleted']);
        Route::get ('visualizar/{id?}', ['as' => 'route.view',         'uses' => 'Layout\Route\RouteController@edit']); // * btn-modal-view-route
        Route::post('nova',             ['as' => 'route.store',        'uses' => 'Layout\Route\RouteController@store']); // btn-modal-new-route
        Route::get ('editar/{id?}',     ['as' => 'route.edit',         'uses' => 'Layout\Route\RouteController@edit']); // * btn-modal-edit-route
        Route::get ('banir/{id?}',      ['as' => 'route.ban',          'uses' => 'Layout\Route\RouteController@edit']); // * btn-modal-block-route
        Route::get ('deletar/{id?}',    ['as' => 'route.delete',       'uses' => 'Layout\Route\RouteController@edit']); // * btn-modal-delete-route
        Route::get ('recuperar/{id?}',  ['as' => 'route.recover',      'uses' => 'Layout\Route\RouteController@edit']); // * btn-modal-recover-route
    });

    // menu
    Route::group(['prefix' => 'layout/menu'], function () {
        Route::get ('dashboard',        ['as' => 'menu.dashboard',    'uses' => 'Layout\Menu\DashboardController@dashboard']);
        Route::get ('lista',            ['as' => 'menu.list',         'uses' => 'Layout\Menu\MenuController@list']);
        Route::get ('lista/deletados',  ['as' => 'menu.list.deleted', 'uses' => 'Layout\Menu\MenuController@listDeleted']);
        Route::get ('visualizar/{id?}', ['as' => 'menu.view',         'uses' => 'Layout\Menu\MenuController@edit']); // * btn-modal-view-menu
        Route::post('novo',             ['as' => 'menu.store',        'uses' => 'Layout\Menu\MenuController@store']); // btn-modal-new-menu
        Route::get ('editar/{id?}',     ['as' => 'menu.edit',         'uses' => 'Layout\Menu\MenuController@edit']); // * btn-modal-edit-menu
        Route::get ('banir/{id?}',      ['as' => 'menu.ban',          'uses' => 'Layout\Menu\MenuController@edit']); // * btn-modal-block-menu
        Route::get ('deletar/{id?}',    ['as' => 'menu.delete',       'uses' => 'Layout\Menu\MenuController@edit']); // * btn-modal-delete-menu
        Route::get ('recuperar/{id?}',  ['as' => 'menu.recover',      'uses' => 'Layout\Menu\MenuController@edit']); // * btn-modal-recover-menu
    });

    // menu itens
    Route::group(['prefix' => 'layout/menu-itens'], function () {
        Route::get ('dashboard',        ['as' => 'menu.item.dashboard',    'uses' => 'Layout\MenuItem\DashboardController@dashboard']);
        Route::get ('lista',            ['as' => 'menu.item.list',         'uses' => 'Layout\MenuItem\MenuItemController@list']);
        Route::get ('lista/deletados',  ['as' => 'menu.item.list.deleted', 'uses' => 'Layout\MenuItem\MenuItemController@listDeleted']);
        Route::get ('visualizar/{id?}', ['as' => 'menu.item.view',         'uses' => 'Layout\MenuItem\MenuItemController@edit']); // * btn-modal-view-menu-item
        Route::post('novo',             ['as' => 'menu.item.store',        'uses' => 'Layout\MenuItem\MenuItemController@store']); // btn-modal-new-menu-item
        Route::get ('editar/{id?}',     ['as' => 'menu.item.edit',         'uses' => 'Layout\MenuItem\MenuItemController@edit']); // * btn-modal-edit-menu-item
        Route::get ('banir/{id?}',      ['as' => 'menu.item.ban',          'uses' => 'Layout\MenuItem\MenuItemController@edit']); // * btn-modal-block-menu-item
        Route::get ('deletar/{id?}',    ['as' => 'menu.item.delete',       'uses' => 'Layout\MenuItem\MenuItemController@edit']); // * btn-modal-delete-menu-item
        Route::get ('recuperar/{id?}',  ['as' => 'menu.item.recover',      'uses' => 'Layout\MenuItem\MenuItemController@edit']); // * btn-modal-recover-menu-item
    });

    // departamentos
    Route::group(['prefix' => 'administrativo/departamentos'], function () {
        Route::get ('dashboard',        ['as' => 'department.dashboard',    'uses' => 'Administrative\Department\DashboardController@dashboard']);
        Route::get ('lista',            ['as' => 'department.list',         'uses' => 'Administrative\Department\DepartmentController@list']);
        Route::get ('lista/deletadas',  ['as' => 'department.list.deleted', 'uses' => 'Administrative\Department\DepartmentController@listDeleted']);
        Route::get ('visualizar/{id?}', ['as' => 'department.view',         'uses' => 'Administrative\Department\DepartmentController@edit']); // * btn-modal-view-department
        Route::post('nova',             ['as' => 'department.store',        'uses' => 'Administrative\Department\DepartmentController@store']); // btn-modal-new-department
        Route::get ('editar/{id?}',     ['as' => 'department.edit',         'uses' => 'Administrative\Department\DepartmentController@edit']); // * btn-modal-edit-department
        Route::get ('banir/{id?}',      ['as' => 'department.ban',          'uses' => 'Administrative\Department\DepartmentController@edit']); // * btn-modal-block-department
        Route::get ('deletar/{id?}',    ['as' => 'department.delete',       'uses' => 'Administrative\Department\DepartmentController@edit']); // * btn-modal-delete-department
        Route::get ('recuperar/{id?}',  ['as' => 'department.recover',      'uses' => 'Administrative\Department\DepartmentController@edit']); // * btn-modal-recover-department
    });

    // inventário categorias
    Route::group(['prefix' => 'administrativo/inventario/categorias'], function () {
        Route::get ('dashboard',        ['as' => 'inventory.category.dashboard',    'uses' => 'Administrative\Inventory\InventoryCategory\DashboardController@dashboard']);
        Route::get ('lista',            ['as' => 'inventory.category.list',         'uses' => 'Administrative\Inventory\InventoryCategory\InventoryCategoryController@list']);
        Route::get ('lista/deletadas',  ['as' => 'inventory.category.list.deleted', 'uses' => 'Administrative\Inventory\InventoryCategory\InventoryCategoryController@listDeleted']);
        Route::get ('visualizar/{id?}', ['as' => 'inventory.category.view',         'uses' => 'Administrative\Inventory\InventoryCategory\InventoryCategoryController@edit']); // * btn-modal-view-inventory-category
        Route::post('nova',             ['as' => 'inventory.category.store',        'uses' => 'Administrative\Inventory\InventoryCategory\InventoryCategoryController@store']); // btn-modal-new-inventory-category
        Route::get ('editar/{id?}',     ['as' => 'inventory.category.edit',         'uses' => 'Administrative\Inventory\InventoryCategory\InventoryCategoryController@edit']); // * btn-modal-edit-inventory-category
        Route::get ('banir/{id?}',      ['as' => 'inventory.category.ban',          'uses' => 'Administrative\Inventory\InventoryCategory\InventoryCategoryController@edit']); // * btn-modal-block-inventory-category
        Route::get ('deletar/{id?}',    ['as' => 'inventory.category.delete',       'uses' => 'Administrative\Inventory\InventoryCategory\InventoryCategoryController@edit']); // * btn-modal-delete-inventory-category
        Route::get ('recuperar/{id?}',  ['as' => 'inventory.category.recover',      'uses' => 'Administrative\Inventory\InventoryCategory\InventoryCategoryController@edit']); // * btn-modal-recover-inventory-category
    });

    // inventário
    Route::group(['prefix' => 'administrativo/inventario'], function () {
        Route::get ('dashboard',        ['as' => 'inventory.dashboard',    'uses' => 'Administrative\Inventory\Inventory\DashboardController@dashboard']);
        Route::get ('lista',            ['as' => 'inventory.list',         'uses' => 'Administrative\Inventory\Inventory\InventoryController@list']);
        Route::get ('lista/deletados',  ['as' => 'inventory.list.deleted', 'uses' => 'Administrative\Inventory\Inventory\InventoryController@listDeleted']);
        Route::get ('visualizar/{id?}', ['as' => 'inventory.view',         'uses' => 'Administrative\Inventory\Inventory\InventoryController@edit']); // * btn-modal-view-inventory
        Route::post('novo',             ['as' => 'inventory.store',        'uses' => 'Administrative\Inventory\Inventory\InventoryController@store']); // btn-modal-new-inventory
        Route::get ('editar/{id?}',     ['as' => 'inventory.edit',         'uses' => 'Administrative\Inventory\Inventory\InventoryController@edit']); // * btn-modal-edit-inventory
        Route::get ('deletar/{id?}',    ['as' => 'inventory.delete',       'uses' => 'Administrative\Inventory\Inventory\InventoryController@edit']); // * btn-modal-delete-inventory
        Route::get ('recuperar/{id?}',  ['as' => 'inventory.recover',      'uses' => 'Administrative\Inventory\Inventory\InventoryController@edit']); // * btn-modal-recover-inventory
    });

    // condominio bloco
    Route::group(['prefix' => 'condominio/bloco'], function () {
        Route::get ('dashboard',        ['as' => 'condominium.block.dashboard',    'uses' => 'Condominium\Block\DashboardController@dashboard']);
        Route::get ('lista',            ['as' => 'condominium.block.list',         'uses' => 'Condominium\Block\BlockController@list']);
        Route::get ('lista/deletados',  ['as' => 'condominium.block.list.deleted', 'uses' => 'Condominium\Block\BlockController@listDeleted']);
        Route::get ('visualizar/{id?}', ['as' => 'condominium.block.view',         'uses' => 'Condominium\Block\BlockController@edit']); // * btn-modal-view-condominium-block
        Route::post('novo',             ['as' => 'condominium.block.store',        'uses' => 'Condominium\Block\BlockController@store']); // btn-modal-new-condominium-block
        Route::get ('editar/{id?}',     ['as' => 'condominium.block.edit',         'uses' => 'Condominium\Block\BlockController@edit']); // * btn-modal-edit-condominium-block
        Route::get ('deletar/{id?}',    ['as' => 'condominium.block.delete',       'uses' => 'Condominium\Block\BlockController@edit']); // * btn-modal-delete-condominium-block
        Route::get ('recuperar/{id?}',  ['as' => 'condominium.block.recover',      'uses' => 'Condominium\Block\BlockController@edit']); // * btn-modal-recover-condominium-block
    });

    */
});
