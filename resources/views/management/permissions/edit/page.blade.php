@extends('layouts.app', ['sidebarMenu' => $page['menu'], 'sidebarItem' => $page['item']])
@section('title', $page['item_name'])

@section('content')

    <!-- capa -->
    @include('layouts.users.background', [
        'title' => __(\App\Helpers\FormatHelpers::first_word($user['name'])),
        'description' => __('Esta é a página do perfil de <b>' . $user['name'] . '</b>.<br> Você pode visualizar e editar as permisões de acesso do usuário no sistema conforme desejado.')
    ])

    <!-- editar permissões -->
    <div class="container-fluid">
        <div class="row">
            <!-- preview do perfil -->
            @include('layouts.users.card')

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
                                    <b>{{ __('Permissões do usuário') }}</b>
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
                        <form id="form-edit-user-permisson" method="post" action="{{ app('router')->has('permission.user.update') ? route('permission.user.update') : url('/') }}" role="form" autocomplete="off" novalidate>
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
                                    <input readonly type="number" id="id-edit-user-permission" name="id_edit_user_permission" class="form-control {{ $errors->has('id_edit_user_permission') ? 'is-invalid' : '' }}" placeholder="{{ __('ID do usuário') }}" value="{{ $user['id'] }}" maxlength="20" required onkeypress="return onlyNumbers(event);" @if ($errors->has('id_edit_user_permission')) autofocus @endif>
                                </div>
                                <!-- alerta de erro -->
                                @if ($errors->has('id_edit_user_permission'))
                                    <div class="invalid-feedback" role="alert">{{ $errors->first('id_edit_user_permission') }}</div>
                                @endif
                            </div>
                            <!-- lista -->
                            <div class="card-body p-0">
                                <!-- grupos -->
                                <div class="accordion" id="accordion-edit-user-permision">
                                    <span hidden>{{ $level = 0 }}</span>
                                    <!-- usuário -->
                                    @if (!\App\Models\Company\Company::userCompany($user['id']))
                                        @foreach ($groups as $index => $group)
                                            <!-- variáveis -->
                                            <span hidden>
                                                {{ $user_permissions = \App\Models\User\Permission::userPermission($group['group'], $user['id']) }}
                                                {{ $profile_permissions = \App\Models\User\Permission::profilePermission($group['group']) }}
                                            </span>

                                            @if ($group['level_id'] == 3)
                                                <div class="card mb-3 fe-radius-card">
                                                    <div class="card-header fe-hr-card-header fe-radius-card" id="heading-edit-user-permision-{{ $index }}" data-toggle="collapse" data-target="#collapse-edit-user-permision-{{ $index }}" aria-expanded="false" aria-controls="collapse-edit-user-permision-{{ $index }}">
                                                        <small class="d-block float-right mr-4 mt-1 font-weight-bold checkbox-all-{{ $index }}">{{ $user_permissions }}/{{ $profile_permissions }}</small>
                                                        <h5 class="d-flex mb-0">
                                                            <span class="custom-control custom-checkbox custom-checkbox-primary no-event">
                                                                <input type="checkbox" id="checkbox-all-{{ $index }}" class="custom-control-input" onclick="checkboxAll(this);" @if ($user_permissions > 0 && $user_permissions == $profile_permissions) value="true" checked="checked" @endif @if ($group['group'] == 1 && $user_permissions == 1) disabled @endif>
                                                                <label class="custom-control-label" for="checkbox-all-{{ $index }}">
                                                                    <span class="mt-0">
                                                                        <i class="{{ $group['icon'] }} mr-2"></i>
                                                                        <span class="h6 text-muted text-truncate position-absolute mt--3">{{ explode('/', $group['name'])[0] }}</span>
                                                                        {{ isset(explode('/', $group['name'])[2]) ? explode('/', $group['name'])[1] . '/' . explode('/', $group['name'])[2] : explode('/', $group['name'])[1] ?? explode('/', $group['name'])[0] }}
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
                                                                            <hr class="fe-hr-accordion">
                                                                            <div class="checklist-item custom-checkbox-primary">
                                                                                <div class="checklist">
                                                                                    <div class="h5 checklist-title mb-0">{{ $permission['name'] ? $permission['name'] : str_replace('/{id?}', '', $permission['url']) }}</div>
                                                                                    @if ($permission['view'] == 1)
                                                                                        @if ($permission['main'] == 1)
                                                                                            <i class="fas fa-desktop text-yellow mr-1" data-toggle="tooltip" data-placement="top" title="página web principal necessária para as outras permissões serem acessíveis"></i>
                                                                                        @else
                                                                                            <i class="fas fa-desktop mr-1" data-toggle="tooltip" data-placement="top" title="página web"></i>
                                                                                        @endif
                                                                                    @endif
                                                                                    @if (!$permission['name']) <i class="fas fa-bolt mr-1" data-toggle="tooltip" data-placement="top" title="ação ou evento"></i> @endif
                                                                                    @if ($permission['button']) <i class="far fa-window-restore mr-1" data-toggle="tooltip" data-placement="top" title="botão ou link de acesso a um modal, ação ou evento"></i> @endif
                                                                                    <small>{{ $permission['description'] }}</small>
                                                                                </div>
                                                                                <div class="custom-control custom-checkbox custom-checkbox-primary">
                                                                                    <input type="checkbox" id="permission-edit-user-permision-{{ $item }}" name="permission_edit_user[]" class="custom-control-input ignore" value="{{ $permission['id'] }}" data-check="checkbox-all-{{ $index }}" onclick="checkboxOne(this);" @if (in_array($permission['id'], $accesses)) checked="checked" @endif>
                                                                                    <label class="custom-control-label fe-checkbox-center-list {{ $permission['id'] == 1 ? 'fe-hidden' : '' }}" for="permission-edit-user-permision-{{ $item }}"></label>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif

                                    <!-- administrador -->
                                    @if (\App\Models\Company\Company::userCompany($user['id']) > 1)
                                        @foreach ($groups as $index => $group)
                                            <!-- variáveis -->
                                            <span hidden>
                                                {{ $user_permissions = \App\Models\User\Permission::userPermission($group['group'], $user['id']) }}
                                                {{ $profile_permissions = \App\Models\User\Permission::profilePermission($group['group']) }}
                                            </span>

                                            @if ($group['level_id'] > 1)
                                                <!-- título -->
                                                @if ($group['level_id'] != $level)
                                                    <span hidden>{{ $level = $group['level_id'] }}</span>
                                                    <h6 class="heading-small text-muted mb-3">{{ __($group['level']) }}</h6>
                                                @endif

                                                <div class="card mb-3 fe-radius-card">
                                                    <div class="card-header fe-hr-card-header fe-radius-card" id="heading-edit-user-permision-{{ $index }}" data-toggle="collapse" data-target="#collapse-edit-user-permision-{{ $index }}" aria-expanded="false" aria-controls="collapse-edit-user-permision-{{ $index }}">
                                                        <small class="d-block float-right mr-4 mt-1 font-weight-bold checkbox-all-{{ $index }}">{{ $user_permissions }}/{{ $profile_permissions }}</small>
                                                        <h5 class="d-flex mb-0">
                                                        <span class="custom-control custom-checkbox custom-checkbox-primary no-event">
                                                            <input type="checkbox" id="checkbox-all-{{ $index }}" class="custom-control-input" onclick="checkboxAll(this);" @if ($user_permissions > 0 && $user_permissions == $profile_permissions) value="true" checked="checked" @endif @if ($group['group'] == 1 && $user_permissions == 1) disabled @endif>
                                                            <label class="custom-control-label" for="checkbox-all-{{ $index }}">
                                                                <span class="mt-0">
                                                                    <i class="{{ $group['icon'] }} mr-2"></i>
                                                                    <span class="h6 text-muted text-truncate position-absolute mt--3">{{ explode('/', $group['name'])[0] }}</span>
                                                                    {{ isset(explode('/', $group['name'])[2]) ? explode('/', $group['name'])[1] . '/' . explode('/', $group['name'])[2] : explode('/', $group['name'])[1] ?? explode('/', $group['name'])[0] }}
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
                                                                            <hr class="fe-hr-accordion">
                                                                            <div class="checklist-item custom-checkbox-primary">
                                                                                <div class="checklist">
                                                                                    <div class="h5 checklist-title mb-0">{{ $permission['name'] ? $permission['name'] : str_replace('/{id?}', '', $permission['url']) }}</div>
                                                                                    @if ($permission['view'] == 1)
                                                                                        @if ($permission['main'] == 1)
                                                                                            <i class="fas fa-desktop text-yellow mr-1" data-toggle="tooltip" data-placement="top" title="página web principal necessária para as outras permissões serem acessíveis"></i>
                                                                                        @else
                                                                                            <i class="fas fa-desktop mr-1" data-toggle="tooltip" data-placement="top" title="página web"></i>
                                                                                        @endif
                                                                                    @endif
                                                                                    @if (!$permission['name']) <i class="fas fa-bolt mr-1" data-toggle="tooltip" data-placement="top" title="ação ou evento"></i> @endif
                                                                                    @if ($permission['button']) <i class="far fa-window-restore mr-1" data-toggle="tooltip" data-placement="top" title="botão ou link de acesso a um modal, ação ou evento"></i> @endif
                                                                                    <small>{{ $permission['description'] }}</small>
                                                                                </div>
                                                                                <div class="custom-control custom-checkbox custom-checkbox-primary">
                                                                                    <input type="checkbox" id="permission-edit-user-permision-{{ $item }}" name="permission_edit_user[]" class="custom-control-input ignore" value="{{ $permission['id'] }}" data-check="checkbox-all-{{ $index }}" onclick="checkboxOne(this);" @if (in_array($permission['id'], $accesses)) checked="checked" @endif>
                                                                                    <label class="custom-control-label fe-checkbox-center-list {{ $permission['id'] == 1 ? 'fe-hidden' : '' }}" for="permission-edit-user-permision-{{ $item }}"></label>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif

                                    <!-- master -->
                                    @if (\App\Models\Company\Company::userCompany($user['id']) == 1)
                                        @foreach ($groups as $index => $group)
                                            <!-- variáveis -->
                                            <span hidden>
                                                {{ $user_permissions = \App\Models\User\Permission::userPermission($group['group'], $user['id']) }}
                                                {{ $profile_permissions = \App\Models\User\Permission::profilePermission($group['group']) }}
                                            </span>

                                            <!-- título -->
                                            @if ($group['level_id'] != $level)
                                                <span hidden>{{ $level = $group['level_id'] }}</span>
                                                <h6 class="heading-small text-muted mb-3">{{ __($group['level']) }}</h6>
                                            @endif

                                            <div class="card mb-3 fe-radius-card">
                                                <div class="card-header fe-hr-card-header fe-radius-card" id="heading-edit-user-permision-{{ $index }}" data-toggle="collapse" data-target="#collapse-edit-user-permision-{{ $index }}" aria-expanded="false" aria-controls="collapse-edit-user-permision-{{ $index }}">
                                                    <small class="d-block float-right mr-4 mt-1 font-weight-bold checkbox-all-{{ $index }}">{{ $user_permissions }}/{{ $profile_permissions }}</small>
                                                    <h5 class="d-flex mb-0">
                                                    <span class="custom-control custom-checkbox custom-checkbox-primary no-event">
                                                        <input type="checkbox" id="checkbox-all-{{ $index }}" class="custom-control-input" onclick="checkboxAll(this);" @if ($user_permissions > 0 && $user_permissions == $profile_permissions) value="true" checked="checked" @endif @if ($group['group'] == 1 && $user_permissions == 1) disabled @endif>
                                                        <label class="custom-control-label" for="checkbox-all-{{ $index }}">
                                                            <span class="mt-0">
                                                                <i class="{{ $group['icon'] }} mr-2"></i>
                                                                <span class="h6 text-muted text-truncate position-absolute mt--3">{{ explode('/', $group['name'])[0] }}</span>
                                                                {{ isset(explode('/', $group['name'])[2]) ? explode('/', $group['name'])[1] . '/' . explode('/', $group['name'])[2] : explode('/', $group['name'])[1] ?? explode('/', $group['name'])[0] }}
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
                                                                        <hr class="fe-hr-accordion">
                                                                        <div class="checklist-item custom-checkbox-primary">
                                                                            <div class="checklist">
                                                                                <div class="h5 checklist-title mb-0">{{ $permission['name'] ? $permission['name'] : str_replace('/{id?}', '', $permission['url']) }}</div>
                                                                                @if ($permission['view'] == 1)
                                                                                    @if ($permission['main'] == 1)
                                                                                        <i class="fas fa-desktop text-yellow mr-1" data-toggle="tooltip" data-placement="top" title="página web principal necessária para as outras permissões serem acessíveis"></i>
                                                                                    @else
                                                                                        <i class="fas fa-desktop mr-1" data-toggle="tooltip" data-placement="top" title="página web"></i>
                                                                                    @endif
                                                                                @endif
                                                                                @if (!$permission['name']) <i class="fas fa-bolt mr-1" data-toggle="tooltip" data-placement="top" title="ação ou evento"></i> @endif
                                                                                @if ($permission['button']) <i class="far fa-window-restore mr-1" data-toggle="tooltip" data-placement="top" title="botão ou link de acesso a um modal, ação ou evento"></i> @endif
                                                                                <small>{{ $permission['description'] }}</small>
                                                                            </div>
                                                                            <div class="custom-control custom-checkbox custom-checkbox-primary">
                                                                                <input type="checkbox" id="permission-edit-user-permision-{{ $item }}" name="permission_edit_user[]" class="custom-control-input ignore" value="{{ $permission['id'] }}" data-check="checkbox-all-{{ $index }}" onclick="checkboxOne(this);" @if (in_array($permission['id'], $accesses)) checked="checked" @endif>
                                                                                <label class="custom-control-label fe-checkbox-center-list {{ $permission['id'] == 1 ? 'fe-hidden' : '' }}" for="permission-edit-user-permision-{{ $item }}"></label>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <!-- botão -->
                            <div class="text-right float-right fe-form-footer">
                                <button type="submit" class="btn btn-success fe-spinner fe-scroll-top mr-4">{{ __('Salvar permissões') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- validate -->
    @include('management.permissions.edit.validate')

@endsection
