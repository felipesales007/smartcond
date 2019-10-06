@extends('layouts.app')
@section('title', __('Lista de grupos deletados'))

@section('content')

    <!-- fundo -->
    <div class="bg-gradient-primary pb-7 pb-xl-7 pt-7 pt-md-7 pt-xl-7"></div>

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
                                <h3 class="text-uppercase text-monospace mb--1">{{ __('Lista de grupos deletados') }}</h3>
                            </div>
                            <!-- botão -->
                            @if (app('router')->has('group.store') && \App\Models\Permission::buttonPermission('btn-modal-new-group') && \App\Models\Menu\MenuItem::getMenuItemDeleted('group.store'))
                                <div class="col-7 col-sm-6 text-right">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-primary {{ \App\Models\Route\Route::getRouteBlocked('group.store') ? 'notify-block-route' : 'btn-modal-new-group' }} {{ \App\Models\Menu\MenuItem::getMenuItemBlocked('group.store') ? 'opacity-2 disabled' : '' }}">
                                        <span class="btn-inner--icon">
                                            <i class="fas fa-plus mr-1"></i>
                                        </span>
                                        <span class="nav-link-inner--text">{{ __('Adicionar grupo') }}</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- corpo -->
                    <div class="table-responsive mb-2">
                        <table id="datatable-groups-deleted" class="table table-flush">
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

@endsection
