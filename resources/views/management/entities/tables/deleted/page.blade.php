@extends('layouts.app', ['sidebarMenu' => '6', 'sidebarItem' => '42'])
@section('title', \App\Models\Menu\MenuItem::getMenuItem(42)['name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ 6 }}@endslot
        <li class="breadcrumb-item"><a href="{{ app('router')->has('entity.list') ? route('entity.list') : url('/') }}">{{ \App\Models\Menu\MenuItem::getMenuItem(41)['name'] }}</a></li>
        <li class="breadcrumb-item fe-mouse active" aria-current="page">@yield('title')</li>

        @slot('link')
            <!-- visualizar dashboard -->
            @component('layouts.components.button', [
                'text'   => 'Dashboard',
                'button' => '',
                'router' => 'entity.dashboard',
                'group'  => '6',
                'route'  => '39',
                'menu'   => '6',
                'item'   => '40',
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
                                    <b>{{ __('Lista de entidades deletadas') }}</b>
                                </h3>
                            </div>
                            <!-- botões -->
                            <div class="col-4 text-right">
                                <!-- adicionar -->
                                @if (auth()->user()['admin'] == 1)
                                    @component('layouts.components.button', [
                                        'text'   => 'Adicionar',
                                        'button' => 'btn-modal-new-entity',
                                        'router' => 'entity.store',
                                        'group'  => '6',
                                        'route'  => '44',
                                        'menu'   => '6',
                                        'item'   => '45',
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
                                    'router' => 'entity.list',
                                    'group'  => '6',
                                    'route'  => '40',
                                    'menu'   => '6',
                                    'item'   => '41',
                                    'color'  => 'success',
                                    'size'   => 'sm',
                                    'title'  => 'Lista de entidades',
                                    'icon'   => 'fas fa-list-ul'
                                ])@endcomponent
                            </div>
                        </div>
                    </div>
                    <!-- corpo -->
                    <div class="table-responsive mb-2">
                        <table id="datatable-entities-deleted" class="table table-flush">
                            <!-- título da tabela -->
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center"><i class="ni ni-image"></i></th>
                                    <th data-base="name">{{ __('Nome') }}</th>
                                    <th data-base="email">{{ __('E-mail') }}</th>
                                    <th data-base="contact">{{ __('Telefone') }}</th>
                                    <th data-base="cnpj">{{ __('CNPJ') }}</th>
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

    @include('management.entities.tables.deleted.ajax')
    @include('management.entities.tables.deleted.modal')

@endsection
