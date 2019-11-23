@extends('layouts.app', ['sidebarMenu' => '6', 'sidebarItem' => '31'])
@section('title', \App\Models\Menu\MenuItem::getMenuItem(31)['name'])

@section('content')

    <!-- capa -->
    @include('layouts.components.company', [
        'logo' => __($company['logo']),
        'title' => __($company['name']),
        'description' => __('Esta é a página de listagem dos administradores.<br> Você pode visualizar e editar os administradores desta empresa conforme desejado.'),
        'class' => 'col-lg-7'
    ])

    <!-- tabela ajax -->
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <!-- card -->
                <div class="card">
                    <!-- título e botão da tabela -->
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <!-- título -->
                            <div class="col-8">
                                <h3 class="text-uppercase text-monospace mb--1">
                                    <b>{{ __('Lista de administradores') }}</b>
                                </h3>
                            </div>
                            <!-- botões -->
                            <div class="col-4 text-right">
                                <!-- adicionar -->
                                @if (app('router')->has('company.admin.store') && \App\Models\User\Permission::routePermission('company.admin.store') && \App\Models\Menu\MenuItem::getMenuItemDeleted('company.admin.store') && auth()->user()['admin'] == 1)
                                    <a href="javascript:void(0)" data-id="{{ $company['id'] }}" data-logo="{{ $company['logo'] }}" data-name="{{ $company['name'] }}" class="btn btn-icon btn-sm btn-primary {{ \App\Models\Route\Group::getGroup(5)['blocked'] || \App\Models\Route\Route::getRoute(33)['blocked'] || \App\Models\Menu\Menu::getMenu(6)['blocked'] || \App\Models\Menu\MenuItem::getMenuItem(34)['blocked'] ? '' : 'btn-modal-new-admin-company' }} {{ \App\Models\Route\Group::getGroup(5)['blocked'] ? 'notify-block-group' : '' }} {{ \App\Models\Route\Route::getRoute(33)['blocked'] ? 'notify-block-route' : '' }} {{ \App\Models\Menu\Menu::getMenu(6)['blocked'] || \App\Models\Menu\MenuItem::getMenuItem(34)['blocked'] ? 'opacity-2 disabled' : '' }}">
                                        <i class="fas fa-plus"></i>
                                        <span class="fe-button-sm-left">
                                            <span class="nav-link-inner--text d-none d-md-inline ml--1">{{ __('Adicionar') }}</span>
                                        </span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- corpo -->
                    <div class="table-responsive mb-2">
                        <table id="datatable-admins-companies" class="table table-flush">
                            <!-- título da tabela -->
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center"><i class="ni ni-image"></i></th>
                                    <th data-base="name">{{ __('Nome') }}</th>
                                    <th data-base="email">{{ __('E-mail') }}</th>
                                    <th data-base="last_login_at">{{ __('Último login') }}</th>
                                    <th class="text-center"><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <!-- listagem da tabela via ajax -->
                            <tbody class="fe-table-master"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('management.companies.tables.admins.ajax')
    @include('management.companies.tables.admins.modal')
    @include('management.admins.tables.all.modal')

@endsection
