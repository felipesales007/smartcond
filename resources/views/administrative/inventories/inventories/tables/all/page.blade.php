@extends('layouts.app', ['sidebarMenu' => $page['menu'], 'sidebarItem' => $page['item']])
@section('title', $page['item_name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ $page['menu_name'] }}@endslot
        <li class="breadcrumb-item fe-mouse active" aria-current="page">@yield('title')</li>
        @slot('xl')@endslot

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

                                <!-- categorias -->
                                @component('layouts.components.button', [
                                    'text'   => 'Categorias',
                                    'title'  => '',
                                    'button' => $sub['button'],
                                    'router' => $sub['router'],
                                    'group'  => $sub['group'],
                                    'route'  => $sub['route'],
                                    'menu'   => $sub['menu'],
                                    'item'   => $sub['item'],
                                    'color'  => 'default',
                                    'size'   => 'sm',
                                    'icon'   => 'fas fa-boxes'
                                ])@endcomponent

                                <!-- lista de deletados -->
                                @component('layouts.components.button', [
                                    'text'   => '',
                                    'title'  => 'Lista de deletados',
                                    'button' => $list['button'],
                                    'router' => $list['router'],
                                    'group'  => $list['group'],
                                    'route'  => $list['route'],
                                    'menu'   => $list['menu'],
                                    'item'   => $list['item'],
                                    'color'  => 'danger',
                                    'size'   => 'sm',
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
