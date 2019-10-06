@extends('layouts.app')
@section('title', __('Meu perfil'))

@section('content')

    @include('layouts.profile.background', [
        'title' => __('Olá ' . \App\Helpers\FormatHelpers::first_word(auth()->user()['name'])),
        'description' => __('Esta é a sua página de perfil.<br> Você pode visualizar e editar seu perfil conforme desejado.'),
        'class' => 'col-lg-7'
    ])

    <!-- editar perfil -->
    <div class="container-fluid mt--7">
        <div class="row">
            <!-- preview do perfil -->
            @include('layouts.profile.card')

            <!-- edição -->
            <div class="col-xl-8 order-xl-1">
                <!-- card -->
                <div class="card bg-secondary">
                    <!-- título e botão da tabela -->
                    <div class="card-header bg-white border-bottom">
                        <div class="row align-items-center">
                            <!-- título -->
                            <div class="col-7 col-sm-6">
                                <h3 class="text-uppercase text-monospace mb--1">
                                    <b>{{ __('Editar perfil') }}</b>
                                </h3>
                            </div>
                            <!-- botão de voltar -->
                            <div class="col-5 col-sm-6 text-right">
                                <a href="javascript:void(0)" class="btn btn-sm btn-icon btn-primary" onclick="voltar();">
                                    <span class="btn-inner--icon">
                                        <i class="fas fa-reply mr-1"></i>
                                    </span>
                                    <span class="nav-link-inner--text">Voltar</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- corpo -->
                    <div class="card-body">
                        <!-- form -->
                        <form id="form-edit-profile" method="post" action="{{ app('router')->has('profile.update') ? route('profile.update') : url('/') }}" role="form" autocomplete="off" novalidate enctype="multipart/form-data">
                            @csrf
                            @if (isset($array[0]))
                                <!-- empresa -->
                                <a href="javascript:void(0)" id="event-edit-profile-company" class="h5 badge badge-primary mb-4 pl-2" data-toggle="collapse" data-target="#collapse-edit-profile-company" aria-expanded="false" aria-controls="collapse-edit-profile-company" onclick="eventExpanded(this, `ocultar empresa <i class='fas fa-chevron-up ml-1'></i>`, `visualizar empresa <i class='fas fa-chevron-down ml-1'></i>`);">
                                    {{ __('visualizar empresa') }}
                                    <i class="fas fa-chevron-down ml-1"></i>
                                </a>
                                <!-- itens da empresa -->
                                <div class="accordion">
                                    <div id="collapse-edit-profile-company" class="collapse" aria-labelledby="heading-edit-profile-company" data-parent="#event-edit-profile-company">
                                        <!-- accordion para visualização da empresa -->
                                        <div id="accordion-edit-profile-company" class="accordion mb-3">
                                            <div class="scroll-user-view-company">
                                                @foreach($array as $company)
                                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action fe-mouse-default">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <div class="avatar avatar-sm">
                                                                    <img src="{{ $company['logo'] ? url('storage/img/companies/logo/' . $company['logo']) : url('img/default/default-logo.png') }}" class="fe-img-list-view" alt="">
                                                                </div>
                                                            </div>
                                                            <div class="col ml--2">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <h4 class="mb-0 text-sm">{{ $company['company'] }}</h4>
                                                                    <div class="custom-control custom-radio custom-checkbox-primary" hidden>{{-- @if (count($array) == 1) hidden @endif --}}
                                                                        <small class="mr-5">{{ $company['preferred'] == 1 ? 'principal' : 'definir como principal' }}</small>
                                                                        <input type="radio" id="company-edit-profile-id-{{ $company['id'] }}" name="company_edit_profile_id" class="custom-control-input" value="{{ $company['id'] }}" @if ($company['preferred'] == 1) checked @endif>
                                                                        <label class="custom-control-label" for="company-edit-profile-id-{{ $company['id'] }}"></label>
                                                                    </div>
                                                                </div>
                                                                <p class="text-sm mb-0">{{ $company['cnpj'] }}</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <!-- inputs -->
                            <h6 class="heading-small text-muted mb-3">{{ __('Imagens do perfil') }}</h6>
                            <div class="row">
                                @include('profile.profile.img-profile')
                            </div>

                            <h6 class="heading-small text-muted mb-3">{{ __('Informações do usuário') }}</h6>
                            <div class="row">
                                @include('profile.profile.info-user')
                            </div>

                            <h6 class="heading-small text-muted mb-3">{{ __('Informações acadêmicas') }}</h6>
                            <div class="row">
                                @include('profile.profile.info-academics')
                            </div>

                            <h6 class="heading-small text-muted mb-3">{{ __('Informações profissionais') }}</h6>
                            <div class="row">
                                @include('profile.profile.info-professionals')
                            </div>

                            <h6 class="heading-small text-muted mb-3">{{ __('Informações residenciais') }}</h6>
                            <div class="row">
                                @include('profile.profile.info-residential')
                            </div>

                            <!-- informação -->
                            <div class="fe-mouse-off">
                                <div class="text-right">
                                    <small class="fe-text-star">{{ __('*') }}</small>
                                    <small class="text-light">{{ __('campos obrigatórios') }}</small>
                                </div>
                            </div>
                            <!-- botão -->
                            @if (app('router')->has('profile.update') && \App\Models\Permission::routePermission('profile.update'))
                                <div class="text-right float-right fe-form-footer">
                                    <button type="submit" class="btn btn-success fe-carregando fe-scroll-top mr-4">{{ __('Salvar perfil') }}</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
