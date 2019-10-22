@extends('layouts.app')
@section('title', __('Lista de usuários'))

@section('content')

    @include('users.dashboard.cards')

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
                                    <b>{{ __('Lista de usuários') }}</b>
                                </h3>
                            </div>
                            <!-- botão -->
                            @if (app('router')->has('user.store') && \App\Models\Permission::buttonPermission('btn-modal-new-user') && \App\Models\Menu\MenuItem::getMenuItemDeleted('user.store'))
                                <div class="col-7 col-sm-6 text-right">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-dark {{ \App\Models\Route\Route::getRouteBlocked('user.store') ? 'notify-block-route' : 'btn-modal-new-user' }} {{ \App\Models\Menu\MenuItem::getMenuItemBlocked('user.store') ? 'opacity-2 disabled' : '' }}">
                                        <span class="btn-inner--icon">
                                            <i class="fas fa-plus mr-1"></i>
                                        </span>
                                        <span class="nav-link-inner--text">{{ __('Adicionar usuário') }}</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- corpo -->
                    <div class="table-responsive mb-2">
                        <table id="datatable-users" class="table table-flush">
                            <!-- título da tabela -->
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center"><i class="ni ni-image"></i></th>
                                    <th data-base="name">{{ __('Nome') }}</th>
                                    <th data-base="entity_name">{{ __('Condomínio') }}</th>
                                    <th data-base="email">{{ __('E-mail') }}</th>
                                    <th data-base="last_login_at">{{ __('Último login') }}</th>
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
