@extends('layouts.app', ['sidebarMenu' => '8', 'sidebarItem' => '93'])
@section('title', \App\Models\Menu\MenuItem::getMenuItem(93)['name'])

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
                'router' => 'department.dashboard',
                'group'  => '12',
                'route'  => '90',
                'menu'   => '8',
                'item'   => '92',
                'color'  => 'info',
                'size'   => 'sm',
                'title'  => '',
                'icon'   => 'fas fa-chart-line'
            ])@endcomponent
        @endslot
    @endcomponent

    @include('administrative.departments.dashboard.cards')

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
                            <div class="col-8">
                                <h3 class="text-uppercase text-monospace mb--1">
                                    <b>{{ __('Lista de departamentos') }}</b>
                                </h3>
                            </div>
                            <!-- botões -->
                            <div class="col-4 text-right">
                                <!-- adicionar -->
                                @component('layouts.components.button', [
                                    'text'   => 'Adicionar',
                                    'button' => 'btn-modal-new-department',
                                    'router' => 'department.store',
                                    'group'  => '12',
                                    'route'  => '94',
                                    'menu'   => '8',
                                    'item'   => '96',
                                    'color'  => 'primary',
                                    'size'   => 'sm',
                                    'title'  => '',
                                    'icon'   => 'fas fa-plus'
                                ])@endcomponent

                                <!-- lista de deletados -->
                                @component('layouts.components.button', [
                                    'text'   => '',
                                    'button' => '',
                                    'router' => 'department.list.deleted',
                                    'group'  => '12',
                                    'route'  => '92',
                                    'menu'   => '8',
                                    'item'   => '94',
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
                        <table id="datatable-departments" class="table table-flush">
                            <!-- título da tabela -->
                            <thead class="thead-light">
                            <tr>
                                <th data-base="name">{{ __('Nome') }}</th>
                                <th>{{ __('Descrição') }}</th>
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

    @include('administrative.departments.tables.all.ajax')
    @include('administrative.departments.tables.all.modal')

@endsection
