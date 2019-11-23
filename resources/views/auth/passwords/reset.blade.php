@extends('layouts.app')
@section('title', __('Definição de senha'))

@section('content')

    <!-- definição de senha -->
    <div class="container mb-1 mt--2">
        <div class="fe-center-auth">
            <div class="row justify-content-center">
                <div class="col-lg-12 fe-auth-body-width fe-z-1">
                    <!-- card -->
                    <div class="card fe-card-sm-transparent bg-secondary border-0 mb-md-5">
                        <div class="card-body pt-5 px-1 px-sm-5 px-lg-5">
                            <div class="text-left text-monospace mb-4">
                                <h3>
                                    <b>{{ __('Definição de senha') }}</b>
                                </h3>
                            </div>
                            <!-- form -->
                            <form id="form-password-reset-update" method="post" action="{{ app('router')->has('password.update') ? route('password.update') : url('/') }}" role="form" autocomplete="off" novalidate>
                                @csrf
                                <!-- inputs -->
                                <div class="row">
                                    <!-- token -->
                                    <div hidden class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="token">{{ __('Token') }}</label>
                                            <div class="input-group input-group-merge validate-token">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-lighter {{ $errors->has('token') ? 'is-invalid' : '' }}">
                                                        <i class="fas fa-key"></i>
                                                    </span>
                                                </div>
                                                <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('token do usuário') }}">*</span>
                                                <input readonly type="hidden" id="token" name="token" class="form-control {{ $errors->has('token') ? 'is-invalid' : '' }}" placeholder="{{ __('Token do usuário') }}" value="{{ $token }}" minlength="1" maxlength="191" required @if ($errors->has('token')) autofocus @endif>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- e-mail -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="email">{{ __('E-mail') }}</label>
                                            <div class="input-group input-group-merge validate-email">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text {{ $errors->has('email') ? 'is-invalid' : '' }}">
                                                        <i class="fas fa-envelope"></i>
                                                    </span>
                                                </div>
                                                <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('e-mail cadastrado para recuperação') }}">*</span>
                                                <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="{{ __('E-mail') }}" value="{{ old('email') }}" maxlength="191" required autocomplete="email" @if ($errors->has('email')) autofocus @endif>
                                            </div>
                                            <!-- alerta de erro -->
                                            @if ($errors->has('email'))
                                                <div class="invalid-feedback" role="alert">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- senha -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="password">{{ __('Senha') }}</label>
                                            <div class="input-group input-group-merge validate-password">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text {{ $errors->has('password') ? 'is-invalid' : '' }}">
                                                        <i class="fas fa-key"></i>
                                                    </span>
                                                </div>
                                                <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 8 caracteres') }}">*</span>
                                                <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('Senha') }}" minlength="8" maxlength="191" required autocomplete="password" @if ($errors->has('password')) autofocus @endif>
                                                <!-- visualizar ou ocultar senha -->
                                                <div class="input-group-append" onclick="viewPassword(this);">
                                                    <span class="input-group-text {{ $errors->has('password') ? 'is-invalid' : '' }}">
                                                        <i class="fe-input-icon far fa-eye"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <!-- alerta de erro -->
                                            @if ($errors->has('password'))
                                                <div class="invalid-feedback" role="alert">{{ $errors->first('password') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- confirmação de senha -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="password-confirmation">{{ __('Confirme a senha') }}</label>
                                            <div class="input-group input-group-merge validate-password-confirmation">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}">
                                                        <i class="fas fa-key"></i>
                                                    </span>
                                                </div>
                                                <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('repetir a senha') }}">*</span>
                                                <input type="password" id="password-confirmation" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" placeholder="{{ __('Confirme a senha') }}" minlength="8" maxlength="191" required autocomplete="password-confirmation">
                                                <!-- visualizar ou ocultar senha -->
                                                <div class="input-group-append" onclick="viewPassword(this);">
                                                    <span class="input-group-text {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}">
                                                        <i class="fe-input-icon far fa-eye"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <!-- alerta de erro -->
                                            @if ($errors->has('password_confirmation'))
                                                <div class="invalid-feedback" role="alert">{{ $errors->first('password_confirmation') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- botão -->
                                <div class="text-center mb-4 mt-2">
                                    <button type="submit" class="btn btn-success btn-block fe-spinner fe-scroll-top">{{ __('Confirmar') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- validate -->
    @include('auth.validate.reset')

@endsection
