@extends('layouts.app', ['sidebarMenu' => $page['menu'], 'sidebarItem' => $page['item']])
@section('title', $page['item_name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ $page['menu_name'] }}@endslot
        <li class="breadcrumb-item"><a href="{{ app('router')->has($list['router']) ? route($list['router']) : url('/') }}">{{ $list['item_name'] }}</a></li>
        <li class="breadcrumb-item fe-mouse active" aria-current="page">@yield('title')</li>

        @slot('link')
            <!-- visualizar dashboard -->
            @component('layouts.components.button', [
                'text'   => 'Dashboard',
                'title'  => '',
                'button' => $dash['button'],
                'router' => $dash['router'],
                'group'  => $dash['group'],
                'route'  => $dash['route'],
                'menu'   => $dash['menu'],
                'item'   => $dash['item'],
                'color'  => 'info',
                'size'   => 'sm',
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
                                    'title'  => '',
                                    'button' => $add['button'],
                                    'router' => $add['router'],
                                    'group'  => $add['group'],
                                    'route'  => $add['route'],
                                    'menu'   => $add['menu'],
                                    'item'   => $add['item'],
                                    'color'  => 'primary',
                                    'size'   => 'sm',
                                    'icon'   => 'fas fa-plus'
                                ])@endcomponent

                                <!-- lista -->
                                @component('layouts.components.button', [
                                    'text'   => '',
                                    'title'  => 'Lista de usuários',
                                    'button' => $list['button'],
                                    'router' => $list['router'],
                                    'group'  => $list['group'],
                                    'route'  => $list['route'],
                                    'menu'   => $list['menu'],
                                    'item'   => $list['item'],
                                    'color'  => 'success',
                                    'size'   => 'sm',
                                    'icon'   => 'fas fa-list-ul'
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
                                    <th data-base="entity_name">{{ __('Condomínio') }}</th>
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
