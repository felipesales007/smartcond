@extends('layouts.app', ['sidebarMenu' => '7', 'sidebarItem' => '67'])
@section('title', \App\Models\Menu\MenuItem::getMenuItem(67)['name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ 7 }}@endslot
        <li class="breadcrumb-item"><a href="{{ app('router')->has('route.list') ? route('route.list') : url('/') }}">{{ \App\Models\Menu\MenuItem::getMenuItem(66)['name'] }}</a></li>
        <li class="breadcrumb-item fe-mouse active" aria-current="page">@yield('title')</li>

        @slot('link')
            <!-- visualizar dashboard -->
            @component('layouts.components.button', [
                'text'   => 'Dashboard',
                'button' => '',
                'router' => 'route.dashboard',
                'group'  => '9',
                'route'  => '63',
                'menu'   => '7',
                'item'   => '65',
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
                                    <b>{{ __('Lista de rotas deletadas') }}</b>
                                </h3>
                            </div>
                            <!-- botões -->
                            <div class="col-4 text-right">
                                <!-- adicionar -->
                                @if (\App\Models\Company\Company::id() == 1)
                                    @component('layouts.components.button', [
                                        'text'   => 'Adicionar',
                                        'button' => 'btn-modal-new-route',
                                        'router' => 'route.store',
                                        'group'  => '9',
                                        'route'  => '67',
                                        'menu'   => '7',
                                        'item'   => '69',
                                        'color'  => 'primary',
                                        'size'   => 'sm',
                                        'title'  => '',
                                        'icon'   => 'fas fa-plus'
                                    ])@endcomponent
                                @endif

                                <!-- lista de deletados -->
                                @component('layouts.components.button', [
                                    'text'   => '',
                                    'button' => '',
                                    'router' => 'route.list',
                                    'group'  => '9',
                                    'route'  => '64',
                                    'menu'   => '7',
                                    'item'   => '66',
                                    'color'  => 'success',
                                    'size'   => 'sm',
                                    'title'  => 'Lista de rotas',
                                    'icon'   => 'fas fa-list-ul'
                                ])@endcomponent
                            </div>
                        </div>
                    </div>
                    <!-- corpo -->
                    <div class="table-responsive mb-2">
                        <table id="datatable-routes-deleted" class="table table-flush">
                            <!-- título da tabela -->
                            <thead class="thead-light">
                                <tr>
                                    <th data-base="group">{{ __('Grupo') }}</th>
                                    <th data-base="url">{{ __('URL') }}</th>
                                    <th data-base="route">{{ __('Rota') }}</th>
                                    <th data-base="controller">{{ __('Controle') }}</th>
                                    <th data-base="type">{{ __('Tipo') }}</th>
                                    <th data-base="view">{{ __('Página') }}</th>
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

    @include('layout.routes.tables.deleted.ajax')
    @include('layout.routes.tables.deleted.modal')

@endsection
