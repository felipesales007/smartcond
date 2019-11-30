@extends('layouts.app', ['sidebarMenu' => $page['menu'], 'sidebarItem' => $page['item']])
@section('title', $page['item_name'])

@section('content')

    <!-- capa -->
    @include('layouts.components.company', [
        'logo' => __($entity['logo']),
        'title' => __($entity['name']),
        'description' => __('Esta é a página de listagem dos usuários.<br> Você pode visualizar e editar os usuários deste condomínio conforme desejado.'),
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
                                    <b>{{ __('Lista de usuários') }}</b>
                                </h3>
                            </div>
                            <!-- botões -->
                            <div class="col-4 text-right">
                                <!-- adicionar -->
                                @if (app('router')->has($add['router']) && \App\Models\User\Permission::routePermission($add['router']) && \App\Models\Menu\MenuItem::getMenuItemDeleted($add['router']) && auth()->user()['admin'] == 1 || app('router')->has($add['router']) && \App\Models\User\Permission::routePermission($add['router']) && \App\Models\Menu\MenuItem::getMenuItemDeleted($add['router']) && in_array($entity['id'], \App\Models\Entity\Entity::getEntitiesUser()->toArray()))
                                    <a href="javascript:void(0)" data-id="{{ $entity['id'] }}" data-logo="{{ $entity['logo'] }}" data-name="{{ $entity['name'] }}" class="btn btn-icon btn-sm btn-primary {{ \App\Models\Route\Group::getGroup($add['group'])['blocked'] || \App\Models\Route\Route::getRoute($add['route'])['blocked'] || \App\Models\Menu\Menu::getMenu($add['menu'])['blocked'] || \App\Models\Menu\MenuItem::getMenuItem($add['item'])['blocked'] ? '' : 'btn-modal-new-user-entity' }} {{ \App\Models\Route\Group::getGroup($add['group'])['blocked'] ? 'notify-block-group' : '' }} {{ \App\Models\Route\Route::getRoute($add['route'])['blocked'] ? 'notify-block-route' : '' }} {{ \App\Models\Menu\Menu::getMenu($add['menu'])['blocked'] || \App\Models\Menu\MenuItem::getMenuItem($add['item'])['blocked'] ? 'opacity-2 disabled' : '' }}">
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
                        <table id="datatable-users-entities" class="table table-flush">
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

    @include('management.entities.tables.users.ajax')
    @include('management.entities.tables.users.modal')
    @include('management.users.tables.all.modal')

@endsection
