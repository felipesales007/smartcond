@extends('layouts.app', ['sidebarMenu' => '6', 'sidebarItem' => '19'])
@section('title', \App\Models\Menu\MenuItem::getMenuItem(19)['name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ 6 }}@endslot
        <li class="breadcrumb-item"><a href="{{ app('router')->has('user.list') ? route('user.list') : url('/') }}">{{ \App\Models\Menu\MenuItem::getMenuItem(18)['name'] }}</a></li>
        <li class="breadcrumb-item fe-mouse active" aria-current="page">@yield('title')</li>

        @slot('link')
            <!-- visualizar dashboard -->
            @component('layouts.components.button', [
                'text'   => 'Dashboard',
                'button' => '',
                'router' => 'user.dashboard',
                'group'  => '4',
                'route'  => '16',
                'menu'   => '6',
                'item'   => '17',
                'color'  => 'info',
                'size'   => 'sm',
                'title'  => '',
                'icon'   => 'fas fa-chart-line'
            ])@endcomponent
        @endslot
    @endcomponent

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
                                    <b>{{ __('Lista de usuários deletados') }}</b>
                                </h3>
                            </div>
                            <!-- botões -->
                            <div class="col-4 text-right">
                                <!-- adicionar -->
                                @component('layouts.components.button', [
                                    'text'   => 'Adicionar',
                                    'button' => 'btn-modal-new-user',
                                    'router' => 'user.store',
                                    'group'  => '4',
                                    'route'  => '20',
                                    'menu'   => '6',
                                    'item'   => '21',
                                    'color'  => 'primary',
                                    'size'   => 'sm',
                                    'title'  => '',
                                    'icon'   => 'fas fa-plus'
                                ])@endcomponent

                                <!-- lista -->
                                @component('layouts.components.button', [
                                    'text'   => '',
                                    'button' => '',
                                    'router' => 'user.list',
                                    'group'  => '4',
                                    'route'  => '17',
                                    'menu'   => '6',
                                    'item'   => '18',
                                    'color'  => 'success',
                                    'size'   => 'sm',
                                    'title'  => 'Lista de usuários',
                                    'icon'   => 'fas fa-list'
                                ])@endcomponent
                            </div>
                        </div>
                    </div>
                    <!-- corpo -->
                    <div class="table-responsive mb-2">
                        <table id="datatable-users-deleted" class="table table-flush">
                            <!-- título da tabela -->
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center"><i class="ni ni-image"></i></th>
                                    <th data-base="name">{{ __('Nome') }}</th>
                                    <th data-base="entity_name">{{ __('Entidade') }}</th>
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

    @include('management.users.tables.deleted.ajax')
    @include('management.users.tables.deleted.modal')

@endsection
