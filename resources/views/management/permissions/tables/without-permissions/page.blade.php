@extends('layouts.app', ['sidebarMenu' => '6', 'sidebarItem' => '52'])
@section('title', \App\Models\Menu\MenuItem::getMenuItem(52)['name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ 6 }}@endslot
        <li class="breadcrumb-item fe-mouse active" aria-current="page">@yield('title')</li>
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
                                    <b>{{ __('Lista de usuários sem permissões') }}</b>
                                </h3>
                            </div>
                            <!-- botão -->
                            <div class="col-4 text-right">
                                <!-- buscar -->
                                @component('layouts.components.button', [
                                    'text'   => 'buscar',
                                    'button' => '',
                                    'router' => 'permission.user.list.with',
                                    'group'  => '6',
                                    'route'  => '52',
                                    'menu'   => '6',
                                    'item'   => '53',
                                    'color'  => 'primary',
                                    'size'   => 'sm',
                                    'title'  => '',
                                    'icon'   => 'fas fa-search'
                                ])@endcomponent
                            </div>
                        </div>
                    </div>
                    <!-- corpo -->
                    <div class="table-responsive mb-2">
                        <table id="datatable-permissions-users-without" class="table table-flush">
                            <!-- título da tabela -->
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center"><i class="ni ni-image"></i></th>
                                    <th data-base="name">{{ __('Nome') }}</th>
                                    <th data-base="created_at">{{ __('Usuário criado') }}</th>
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

    @include('management.permissions.tables.without-permissions.ajax')

@endsection
