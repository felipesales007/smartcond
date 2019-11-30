@extends('layouts.app', ['sidebarMenu' => $page['menu'], 'sidebarItem' => $page['item']])
@section('title', $page['item_name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ $page['menu_name'] }}@endslot
        <li class="breadcrumb-item"><a href="{{ app('router')->has($list['router']) ? route($list['router']) : url('/') }}">{{ $list['item_name'] }}</a></li>
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
                                    <b>{{ __('Lista de usuários com permissões') }}</b>
                                </h3>
                            </div>
                            <!-- botão de voltar -->
                            <div class="col-4 text-right">
                                @component('layouts.components.return')@endcomponent
                            </div>
                        </div>
                    </div>
                    <!-- corpo -->
                    <div class="table-responsive mb-2">
                        <table id="datatable-permissions-users-with" class="table table-flush">
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

    @include('management.permissions.tables.with-permissions.ajax')

@endsection
