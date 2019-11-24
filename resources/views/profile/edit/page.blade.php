@extends('layouts.app', ['sidebarMenu' => '2', 'sidebarItem' => '2'])
@section('title', \App\Models\Menu\MenuItem::getMenuItem(2)['name'])

@section('content')

    <!-- capa -->
    @include('layouts.profile.background', [
        'title' => __('Olá ' . \App\Helpers\FormatHelpers::first_word(auth()->user()['name'])),
        'description' => __('Esta é a sua página de perfil.<br> Você pode visualizar e editar seu perfil conforme desejado.')
    ])

    <!-- editar perfil -->
    <div class="container-fluid">
        <div class="row">
            <!-- preview do perfil -->
            @include('layouts.profile.card')

            <!-- edição -->
            <div class="col-xl-8 order-xl-1">
                <!-- card -->
                <div class="card bg-secondary">
                    <!-- título e botão da tabela -->
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <!-- título -->
                            <div class="col-8">
                                <h3 class="text-uppercase text-monospace mb--1">
                                    <b>{{ __('Editar perfil') }}</b>
                                </h3>
                            </div>
                            <!-- botão de voltar -->
                            <div class="col-4 text-right">
                                @component('layouts.components.return')@endcomponent
                            </div>
                        </div>
                    </div>
                    <!-- corpo -->
                    <div class="card-body">
                        <!-- form -->
                        <form id="form-edit-profile" method="post" action="{{ app('router')->has('profile.update') ? route('profile.update') : url('/') }}" role="form" autocomplete="off" novalidate enctype="multipart/form-data">
                            @csrf
                            @if (isset($entities[0]) || $company)
                                <!-- variáveis -->
                                <span hidden>
                                    @if (isset($entities[0]) && $company)
                                        {{ $view   = 'visualizar empresa e condomínio' }}
                                        {{ $hidden = 'ocultar empresa e condomínio' }}
                                    @elseif (!isset($entities[0]) && $company)
                                        {{ $view   = 'visualizar empresa' }}
                                        {{ $hidden = 'ocultar empresa' }}
                                    @else
                                        {{ $view   = 'visualizar condomínio' }}
                                        {{ $hidden = 'ocultar condomínio' }}
                                    @endif
                                </span>
                                <!-- empresa ou condomínio -->
                                <a href="javascript:void(0)" id="event-edit-profile-company" class="h5 badge badge-primary mb-4 pl-3 fe-event-arrow" data-toggle="collapse" data-target="#collapse-edit-profile-company" aria-expanded="false" aria-controls="collapse-edit-profile-company" onclick="eventExpanded(this, '{{ $hidden }}', '{{ $view }}');">
                                    @if (isset($entities[0]) && $company)
                                        {{ __('visualizar empresa e condomínio') }}
                                    @elseif (!isset($entities[0]) && $company)
                                        {{ __('visualizar empresa') }}
                                    @else
                                        {{ __('visualizar condomínio') }}
                                    @endif
                                </a>
                                <!-- itens do condomínio -->
                                <div class="accordion">
                                    <div id="collapse-edit-profile-company" class="collapse" aria-labelledby="heading-edit-profile-company" data-parent="#event-edit-profile-company">
                                        <!-- accordion para visualização do condomínio -->
                                        <div id="accordion-edit-profile-company" class="accordion mb-3">
                                            <div class="scroll-user-view-company">
                                                <a href="javascript:void(0)" class="list-group-item list-group-item-action fe-mouse" @if (!$company) hidden @endif>
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <div class="avatar avatar-sm">
                                                                <img src="{{ $company['logo'] ? url('storage/images/companies/logo/' . $company['logo']) : url('images/default/default-logo.png') }}" class="fe-img-list-view" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="col ml--2">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <h4 class="mb-0 text-sm">{{ $company['company'] }}</h4>
                                                            </div>
                                                            <p class="text-sm mb-0">{{ $company['cnpj'] }}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                @foreach($entities as $entity)
                                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action fe-mouse">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <div class="avatar avatar-sm">
                                                                    <img src="{{ $entity['logo'] ? url('storage/images/companies/logo/' . $entity['logo']) : url('images/default/default-logo.png') }}" class="fe-img-list-view" alt="">
                                                                </div>
                                                            </div>
                                                            <div class="col ml--2">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <h4 class="mb-0 text-sm">{{ $entity['entity'] }}</h4>
                                                                    <div class="custom-control custom-radio custom-checkbox-primary" @if (count($entities) == 1) hidden @endif>
                                                                        <small class="mr-5">{{ $entity['preferred'] == 1 ? 'principal' : 'definir como principal' }}</small>
                                                                        <input type="radio" id="entity-edit-profile-id-{{ $entity['id'] }}" name="entity_edit_profile_id" class="custom-control-input ignore" value="{{ $entity['id'] }}" @if ($entity['preferred'] == 1) checked @endif>
                                                                        <label class="custom-control-label" for="entity-edit-profile-id-{{ $entity['id'] }}"></label>
                                                                    </div>
                                                                </div>
                                                                <p class="text-sm mb-0">{{ $entity['cnpj'] }}</p>
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
                                @include('profile.edit.fields.image')
                            </div>

                            <h6 class="heading-small text-muted mb-3">{{ __('Informações do usuário') }}</h6>
                            <div class="row">
                                @include('profile.edit.fields.user')
                            </div>

                            <h6 class="heading-small text-muted mb-3">{{ __('Informações acadêmicas') }}</h6>
                            <div class="row">
                                @include('profile.edit.fields.academic')
                            </div>

                            <h6 class="heading-small text-muted mb-3">{{ __('Informações profissionais') }}</h6>
                            <div class="row">
                                @include('profile.edit.fields.professional')
                            </div>

                            <h6 class="heading-small text-muted mb-3">{{ __('Informações residenciais') }}</h6>
                            <div class="row">
                                @include('profile.edit.fields.residential')
                            </div>

                            <!-- informação -->
                            <div class="fe-mouse">
                                <div class="text-right">
                                    <small class="fe-text-star">{{ __('*') }}</small>
                                    <small class="text-light">{{ __('campos obrigatórios') }}</small>
                                </div>
                            </div>
                            <!-- botão -->
                            <div class="text-right float-right fe-form-footer">
                                <button type="submit" class="btn btn-success fe-spinner fe-scroll-top mr-4">{{ __('Salvar perfil') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- validate -->
    @include('profile.edit.validate')

@endsection
