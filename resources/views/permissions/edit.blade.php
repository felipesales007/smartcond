@extends('layouts.app')
@section('title', __('Permissões do usuário'))

@section('content')

    @include('layouts.users.background', [
        'title' => __(\App\Helpers\FormatHelpers::first_word($user['name'])),
        'description' => __('Esta é a página do perfil de <b>' . $user['name'] . '</b>.<br> Você pode visualizar e editar as permisões de acesso do usuário no sistema conforme desejado.'),
        'class' => 'col-lg-7'
    ])

    <!-- editar permissões -->
    <div class="container-fluid mt--7">
        <div class="row">
            <!-- preview do perfil -->
            @include('layouts.users.card')

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
                                    <b>{{ __('Permissões do usuário') }}</b>
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
                        <form id="form-edit-user-permisson" role="form" method="post" action="{{ app('router')->has('permission.user.update') ? route('permission.user.update') : url('/') }}" role="form" autocomplete="off" novalidate>
                            @csrf
                            <!-- id -->
                            <div hidden class="form-group">
                                <label class="form-control-label" for="id-edit-user-permission">{{ __('ID') }}</label>
                                <div class="input-group input-group-merge validate-id-edit-user-permission">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-lighter {{ $errors->has('id_edit_user_permission') ? 'is-invalid' : '' }}">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('id do usuário') }}">*</span>
                                    <input readonly type="number" id="id-edit-user-permission" name="id_edit_user_permission" class="form-control {{ $errors->has('id_edit_user_permission') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do usuário') }}" value="{{ $user['id'] }}" maxlength="20" required onkeypress="return soNumeros(event);" @if ($errors->has('id_edit_user_permission')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_edit_user_permission'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_edit_user_permission') }}</div>
                                @endif
                            </div>
                            <!-- lista -->
                            <div class="card-body p-0">
                                <div class="accordion" id="accordion-edit-user-permision">
                                    <!-- grupos -->
                                    @foreach ($groups as $index => $group)
                                        <!-- variáveis -->
                                        <span hidden>
                                            {{ $user_permissions = \App\Models\Permission::userPermission($group['group'], $user['id']) }}
                                            {{ $profile_permissions = \App\Models\Permission::profilePermission($group['group']) }}
                                        </span>
                                        <div class="card mb-3">
                                            <div class="card-header fe-hr-card-header" id="heading-edit-user-permision-{{ $index }}" data-toggle="collapse" data-target="#collapse-edit-user-permision-{{ $index }}" aria-expanded="false" aria-controls="collapse-edit-user-permision-{{ $index }}">
                                                <small class="d-block float-right mr-5 mt-1 font-weight-bold">{{ $user_permissions }}/{{ $profile_permissions }}</small>
                                                <h5 class="d-flex mb-0">
                                                    <span class="custom-control custom-checkbox custom-checkbox-primary no-event">
                                                        <input type="checkbox" id="checkbox-all-{{ $index }}" class="custom-control-input" onclick="checkboxAll(this);" @if ($user_permissions > 0 && $user_permissions == $profile_permissions) value="true" checked="checked" @endif @if ($group['group'] == 1 && $user_permissions == 1) disabled @endif>
                                                        <label class="custom-control-label" for="checkbox-all-{{ $index }}">
                                                            <span class="mt-0">
                                                                <i class="{{ $group['icon'] }} mr-2"></i>
                                                                {{ __($group['name']) }}
                                                            </span>
                                                        </label>
                                                    </span>
                                                </h5>
                                            </div>
                                            <div id="collapse-edit-user-permision-{{ $index }}" class="collapse" aria-labelledby="heading-edit-user-permision-{{ $index }}" data-parent="#accordion-edit-user-permision">
                                                <!-- permissões -->
                                                @foreach ($permissions as $item => $permission)
                                                    @if ($group['group'] == $permission['group'])
                                                        <div class="card-body">
                                                            <ul class="list-group list-group-flush mx--4 my--4" data-toggle="checklist">
                                                                <li class="checklist-entry list-group-item flex-column align-items-start py-1 px-1">
                                                                    <div class="checklist-item custom-checkbox-primary">
                                                                        <div class="checklist">
                                                                            <h5 class="checklist-title mb-0">{{ str_replace('/{id?}', '', $permission['url']) }}</h5>
                                                                            <small>{{ $permission['description'] }}</small>
                                                                        </div>
                                                                        <div class="custom-control custom-checkbox custom-checkbox-primary">
                                                                            <input type="checkbox" id="permission-edit-user-permision-{{ $item }}" name="permission_edit_user[]" class="custom-control-input" value="{{ $permission['id'] }}" data-check="checkbox-all-{{ $index }}" onclick="checkboxOne(this);" @if (in_array($permission['id'], $accesses)) checked="checked" @endif>
                                                                            <label class="custom-control-label fe-checkbox-center-list {{ $permission['id'] == 1 ? 'fe-hidden' : '' }}" for="permission-edit-user-permision-{{ $item }}"></label>
                                                                        </div>
                                                                    </div>
                                                                    <hr class="fe-hr-accordion my--5 mx--1">
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- botão -->
                            @if (app('router')->has('permission.user.update') && \App\Models\Permission::routePermission('permission.user.update'))
                                <div class="text-right float-right fe-form-footer">
                                    <button type="submit" class="btn btn-success fe-carregando fe-scroll-top mr-4">{{ __('Salvar permissões') }}</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
