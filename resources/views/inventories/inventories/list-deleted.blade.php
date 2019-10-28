@extends('layouts.app')
@section('title', __('Lista de itens do inventário deletados'))

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.headers.background')
        @component('layouts.headers.breadcrumbs')
            @slot('title')
                {{ __('Inventário') }}
            @endslot

            <li class="breadcrumb-item fe-mouse-default active" aria-current="page">@yield('title')</li>
        @endcomponent
    @endcomponent

    <!-- tabela ajax -->
    <div class="container-fluid mt--8">
        <div class="row">
            <div class="col">
                <!-- card -->
                <div class="card">
                    <!-- título e botão da tabela -->
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <!-- título -->
                            <h3 class="text-uppercase text-monospace mb--1">
                                <b>{{ __('Lista de itens do inventário deletados') }}</b>
                            </h3>
                            <!-- botão -->
                            @if (app('router')->has('inventory.store') && \App\Models\Permission::buttonPermission('btn-modal-new-inventory') && \App\Models\Menu\MenuItem::getMenuItemDeleted('inventory.store'))
                                <div class="col-7 col-sm-6 text-right">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-primary {{ \App\Models\Route\Route::getRouteBlocked('inventory.store') ? 'notify-block-route' : 'btn-modal-new-inventory' }} {{ \App\Models\Menu\MenuItem::getMenuItemBlocked('inventory.store') ? 'opacity-2 disabled' : '' }}">
                                        <span class="btn-inner--icon">
                                            <i class="fas fa-plus mr-1"></i>
                                        </span>
                                        <span class="nav-link-inner--text">{{ __('Adicionar item') }}</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- corpo -->
                    <div class="table-responsive mb-2">
                        <table id="datatable-inventories-deleted" class="table table-flush">
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

@endsection
