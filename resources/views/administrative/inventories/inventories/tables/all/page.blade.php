@extends('layouts.app', ['sidebarMenu' => '8', 'sidebarItem' => '111'])
@section('title', \App\Models\Menu\MenuItem::getMenuItem(111)['name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ 8 }}@endslot
        <li class="breadcrumb-item fe-mouse active" aria-current="page">@yield('title')</li>
        @slot('xl')@endslot

        @slot('link')
            <!-- visualizar dashboard -->
            @component('layouts.components.button', [
                'text'   => 'Dashboard',
                'button' => '',
                'router' => 'inventory.dashboard',
                'group'  => '14',
                'route'  => '108',
                'menu'   => '8',
                'item'   => '110',
                'color'  => 'info',
                'size'   => 'sm',
                'title'  => '',
                'icon'   => 'fas fa-chart-line'
            ])@endcomponent
        @endslot
    @endcomponent

    @include('administrative.inventories.inventories.dashboard.cards')

    <!-- tabela ajax -->
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <!-- card -->
                <div class="card">
                    <!-- título e botões da tabela -->
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <!-- título -->
                            <div class="col-7">
                                <h3 class="text-uppercase text-monospace mb--1">
                                    <b>{{ __('Lista de itens do inventário') }}</b>
                                </h3>
                            </div>
                            <!-- botões -->
                            <div class="col-5 text-right">
                                <!-- adicionar -->
                                @component('layouts.components.button', [
                                    'text'   => 'Adicionar',
                                    'button' => 'btn-modal-new-inventory',
                                    'router' => 'inventory.store',
                                    'group'  => '14',
                                    'route'  => '112',
                                    'menu'   => '8',
                                    'item'   => '114',
                                    'color'  => 'primary',
                                    'size'   => 'sm',
                                    'title'  => '',
                                    'icon'   => 'fas fa-plus'
                                ])@endcomponent

                                <!-- categorias -->
                                @component('layouts.components.button', [
                                    'text'   => 'Categorias',
                                    'button' => '',
                                    'router' => 'inventory.category.list',
                                    'group'  => '13',
                                    'route'  => '100',
                                    'menu'   => '8',
                                    'item'   => '102',
                                    'color'  => 'default',
                                    'size'   => 'sm',
                                    'title'  => '',
                                    'icon'   => 'fas fa-boxes'
                                ])@endcomponent

                                <!-- lista de deletados -->
                                @component('layouts.components.button', [
                                    'text'   => '',
                                    'button' => '',
                                    'router' => 'inventory.list.deleted',
                                    'group'  => '14',
                                    'route'  => '110',
                                    'menu'   => '8',
                                    'item'   => '112',
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
                        <table id="datatable-inventories" class="table table-flush">
                            <!-- título da tabela -->
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center"><i class="ni ni-image"></i></th>
                                    <th data-base="patrimonial_number">{{ __('Patrimônio') }}</th>
                                    <th data-base="name">{{ __('Nome') }}</th>
                                    <th data-base="inventory_category_id">{{ __('Categoria') }}</th>
                                    <th data-base="department_id">{{ __('Departamento') }}</th>
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

    @include('administrative.inventories.inventories.tables.all.ajax')
    @include('administrative.inventories.inventories.tables.all.modal')

@endsection
