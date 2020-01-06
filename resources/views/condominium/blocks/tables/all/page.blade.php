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

    @include('condominium.blocks.dashboard.cards')

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
                                    <b>{{ __('Lista de blocos') }}</b>
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
                        <table id="datatable-condominium-blocks" class="table table-flush">
                            <!-- título da tabela -->
                            <thead class="thead-light">
                                <tr>
                                    <th data-base="name">{{ __('Bloco') }}</th>
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

    @include('condominium.blocks.tables.all.ajax')
    @include('condominium.blocks.tables.all.modal')

@endsection
