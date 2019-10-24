@extends('layouts.app')
@section('title', __('Lista de usuários'))

@section('content')

    @include('layouts.companies.background', [
        'logo' => __($entity['logo']),
        'title' => __($entity['name']),
        'description' => __('Esta é a página de listagem dos usuários.<br> Você pode visualizar e editar os usuários deste condomínio conforme desejado.'),
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
                                    <b>{{ __('Lista de usuários') }}</b>
                                </h3>
                            </div>
                            <!-- botão -->
                            @if (app('router')->has('entity.user.store') && \App\Models\Permission::buttonPermission('btn-modal-new-entity-user') && \App\Models\Menu\MenuItem::getMenuItemDeleted('entity.user.store') && auth()->user()['admin'] == 1 || app('router')->has('entity.user.store') && \App\Models\Permission::buttonPermission('btn-modal-new-entity-user') && \App\Models\Menu\MenuItem::getMenuItemDeleted('entity.user.store') && in_array($entity['id'], \App\Models\Entity\Entity::getEntitiesUser()->toArray()))
                                <div class="col-7 col-sm-6 text-right">
                                    <a href="javascript:void(0)" data-id="{{ $entity['id'] }}" data-logo="{{ $entity['logo'] }}" data-name="{{ $entity['name'] }}" class="btn btn-sm btn-icon btn-primary {{ \App\Models\Route\Route::getRouteBlocked('entity.user.store') ? 'notify-block-route' : 'btn-modal-new-entity-user' }} {{ \App\Models\Menu\MenuItem::getMenuItemBlocked('entity.user.store') ? 'opacity-2 disabled' : '' }}">
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
                        <table id="datatable-entities-users" class="table table-flush">
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
