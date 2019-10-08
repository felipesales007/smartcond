@extends('layouts.app')
@section('title', __('Lista de itens do menu'))

@section('content')

    <!-- cards -->
    <div class="bg-gradient-primary pb-7 pb-xl-8 pt-6 pt-md-7 pt-xl-8">
        @include('menu.menu-item.dashboard.cards')
    </div>

    <!-- tabela ajax -->
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <!-- card -->
                <div class="card">
                    <!-- título e botão da tabela -->
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <!-- título -->
                            <div class="col-5 col-sm-6">
                                <h3 class="text-uppercase text-monospace mb--1">
                                    <b>{{ __('Lista de itens do menu') }}</b>
                                </h3>
                            </div>
                            <!-- botão -->
                            @if (app('router')->has('menu.item.store') && \App\Models\Permission::buttonPermission('btn-modal-new-menu-item') && \App\Models\Menu\MenuItem::getMenuItemDeleted('menu.item.store'))
                                <div class="col-7 col-sm-6 text-right">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-primary {{ \App\Models\Route\Route::getRouteBlocked('menu.item.store') ? 'notify-block-route' : 'btn-modal-new-menu-item' }} {{ \App\Models\Menu\MenuItem::getMenuItemBlocked('menu.item.store') ? 'opacity-2 disabled' : '' }}">
                                        <span class="btn-inner--icon">
                                            <i class="fas fa-plus mr-1"></i>
                                        </span>
                                        <span class="nav-link-inner--text">{{ __('Adicionar item do menu') }}</span>
                                    </a>
                                </div>
                            @endif
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
                                    <th data-base="list">{{ __('Lista') }}</th>
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

@endsection
