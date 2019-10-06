@extends('layouts.app')
@section('title', __('Lista de menu'))

@section('content')

    <!-- cards -->
    <div class="bg-gradient-primary pb-7 pb-xl-8 pt-6 pt-md-7 pt-xl-8">
        @include('menu.menu.dashboard.cards')
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
                                <h3 class="text-uppercase text-monospace mb--1">{{ __('Lista de menu') }}</h3>
                            </div>
                            <!-- botão -->
                            @if (app('router')->has('menu.store') && \App\Models\Permission::buttonPermission('btn-modal-new-menu') && \App\Models\Menu\MenuItem::getMenuItemDeleted('menu.store'))
                                <div class="col-7 col-sm-6 text-right">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-primary {{ \App\Models\Route\Route::getRouteBlocked('menu.store') ? 'notify-block-route' : 'btn-modal-new-menu' }} {{ \App\Models\Menu\MenuItem::getMenuItemBlocked('menu.store') ? 'opacity-2 disabled' : '' }}">
                                        <span class="btn-inner--icon">
                                            <i class="fas fa-plus mr-1"></i>
                                        </span>
                                        <span class="nav-link-inner--text">{{ __('Adicionar menu') }}</span>
                                    </a>
                                </div>
                            @endif
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

@endsection
