@extends('layouts.app')
@section('title', __('Lista de condomínios deletados'))

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
                                <h3 class="text-uppercase text-monospace mb--1">
                                    <b>{{ __('Lista de condomínios deletados') }}</b>
                                </h3>
                            </div>
                            <!-- botão -->
                            @if (app('router')->has('entity.store') && \App\Models\Permission::buttonPermission('btn-modal-new-entity') && \App\Models\Menu\MenuItem::getMenuItemDeleted('entity.store'))
                                <div class="col-7 col-sm-6 text-right">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-primary {{ \App\Models\Route\Route::getRouteBlocked('entity.store') ? 'notify-block-route' : 'btn-modal-new-entity' }} {{ \App\Models\Menu\MenuItem::getMenuItemBlocked('entity.store') ? 'opacity-2 disabled' : '' }}">
                                        <span class="btn-inner--icon">
                                            <i class="fas fa-plus mr-1"></i>
                                        </span>
                                        <span class="nav-link-inner--text">{{ __('Adicionar condomínio') }}</span>
                                    </a>
                                </div>
                            @endif
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
                                    <th data-base="contact">{{ __('Contato') }}</th>
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

@endsection
