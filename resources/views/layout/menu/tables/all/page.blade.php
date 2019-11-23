@extends('layouts.app', ['sidebarMenu' => '7', 'sidebarItem' => '75'])
@section('title', \App\Models\Menu\MenuItem::getMenuItem(75)['name'])

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
                'router' => 'menu.dashboard',
                'group'  => '10',
                'route'  => '72',
                'menu'   => '7',
                'item'   => '74',
                'color'  => 'info',
                'size'   => 'sm',
                'title'  => '',
                'icon'   => 'fas fa-chart-line'
            ])@endcomponent
        @endslot
    @endcomponent

    @include('layout.menu.dashboard.cards')

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
                                    <b>{{ __('Lista de menu') }}</b>
                                </h3>
                            </div>
                            <!-- botões -->
                            <div class="col-4 text-right">
                                <!-- adicionar -->
                                @if (\App\Models\Company\Company::id() == 1)
                                    @component('layouts.components.button', [
                                        'text'   => 'Adicionar',
                                        'button' => 'btn-modal-new-menu',
                                        'router' => 'menu.store',
                                        'group'  => '10',
                                        'route'  => '76',
                                        'menu'   => '7',
                                        'item'   => '78',
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
                                    'router' => 'menu.list.deleted',
                                    'group'  => '10',
                                    'route'  => '74',
                                    'menu'   => '7',
                                    'item'   => '76',
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
                        <table id="datatable-menu" class="table table-flush">
                            <!-- título da tabela -->
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center"><i class="ni ni-image"></i></th>
                                    <th data-base="name">{{ __('Nome') }}</th>
                                    <th data-base="type">{{ __('Tipo') }}</th>
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

    @include('layout.menu.tables.all.ajax')
    @include('layout.menu.tables.all.modal')

@endsection
