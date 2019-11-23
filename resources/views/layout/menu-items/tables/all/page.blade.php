@extends('layouts.app', ['sidebarMenu' => '7', 'sidebarItem' => '84'])
@section('title', \App\Models\Menu\MenuItem::getMenuItem(84)['name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ 7 }}@endslot
        <li class="breadcrumb-item fe-mouse active" aria-current="page">@yield('title')</li>
        @slot('xl')@endslot

        @slot('link')
            <!-- visualizar dashboard -->
            @component('layouts.components.button', [
                'text'   => 'Dashboard',
                'button' => '',
                'router' => 'menu.item.dashboard',
                'group'  => '11',
                'route'  => '81',
                'menu'   => '7',
                'item'   => '84',
                'color'  => 'info',
                'size'   => 'sm',
                'title'  => '',
                'icon'   => 'fas fa-chart-line'
            ])@endcomponent
        @endslot
    @endcomponent

    @include('layout.menu-items.dashboard.cards')

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
                                    <b>{{ __('Lista de itens do menu') }}</b>
                                </h3>
                            </div>
                            <!-- botões -->
                            <div class="col-4 text-right">
                                <!-- adicionar -->
                                @if (\App\Models\Company\Company::id() == 1)
                                    @component('layouts.components.button', [
                                        'text'   => 'Adicionar',
                                        'button' => 'btn-modal-new-menu-item',
                                        'router' => 'menu.item.store',
                                        'group'  => '11',
                                        'route'  => '85',
                                        'menu'   => '7',
                                        'item'   => '87',
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
                                    'router' => 'menu.item.list.deleted',
                                    'group'  => '11',
                                    'route'  => '83',
                                    'menu'   => '7',
                                    'item'   => '85',
                                    'color'  => 'danger',
                                    'size'   => 'sm',
                                    'title'  => 'Lista de deletados',
                                    'icon'   => 'far fa-trash-alt'
                                ])@endcomponent
                            </div>
                        </div>
                    </div>
                    <!-- corpo -->
                    <div class="table-responsive mb-2">
                        <table id="datatable-menu-items" class="table table-flush">
                            <!-- título da tabela -->
                            <thead class="thead-light">
                                <tr>
                                    <th data-base="name">{{ __('Nome') }}</th>
                                    <th data-base="menu">{{ __('Menu') }}</th>
                                    <th data-base="group">{{ __('Grupo') }}</th>
                                    <th data-base="route">{{ __('Rota') }}</th>
                                    <th data-base="button">{{ __('Botão') }}</th>
                                    <th data-base="main">{{ __('Principal') }}</th>
                                    <th data-base="hidden">{{ __('Visível') }}</th>
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

    @include('layout.menu-items.tables.all.ajax')
    @include('layout.menu-items.tables.all.modal')

@endsection
