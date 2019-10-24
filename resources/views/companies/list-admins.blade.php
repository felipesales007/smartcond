@extends('layouts.app')
@section('title', __('Lista de administradores'))

@section('content')

    @include('layouts.companies.background', [
        'logo' => __($company['logo']),
        'title' => __($company['name']),
        'description' => __('Esta é a página de listagem dos administradores.<br> Você pode visualizar e editar os administradores desta empresa conforme desejado.'),
        'class' => 'col-lg-7'
    ])

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
                                    <b>{{ __('Lista de administradores') }}</b>
                                </h3>
                            </div>
                            <!-- botão -->
                            @if (app('router')->has('company.admin.store') && \App\Models\Permission::buttonPermission('btn-modal-new-company-admin') && \App\Models\Menu\MenuItem::getMenuItemDeleted('company.admin.store') && auth()->user()['admin'] == 1)
                                <div class="col-7 col-sm-6 text-right">
                                    <a href="javascript:void(0)" data-id="{{ $company['id'] }}" data-logo="{{ $company['logo'] }}" data-name="{{ $company['name'] }}" class="btn btn-sm btn-icon btn-primary {{ \App\Models\Route\Route::getRouteBlocked('company.admin.store') ? 'notify-block-route' : 'btn-modal-new-company-admin' }} {{ \App\Models\Menu\MenuItem::getMenuItemBlocked('company.admin.store') ? 'opacity-2 disabled' : '' }}">
                                        <span class="btn-inner--icon">
                                            <i class="fas fa-plus mr-1"></i>
                                        </span>
                                        <span class="nav-link-inner--text">{{ __('Adicionar administrador') }}</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- corpo -->
                    <div class="table-responsive mb-2">
                        <table id="datatable-companies-admins" class="table table-flush">
                            <!-- título da tabela -->
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center"><i class="ni ni-image"></i></th>
                                    <th data-base="name">{{ __('Nome') }}</th>
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
