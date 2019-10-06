@extends('layouts.app')
@section('title', __('Registrar'))

@section('content')

    <!-- informativo e cadastro -->
    <div class="container mt-8 mt-lg--2">
        <div class="fe-center-auth">
            <div class="row justify-content-center">
                <!-- informativo -->
                <div class="col-lg-6 mt-9 fe-z-1 fe-auth-info-corpo-register fe-mouse-default fe-mobile-none" onmousedown="return false;">
                    @foreach (\App\Models\AuthPicture::getRandAuthPicture() as $info)
                        <div class="text-center fe-auth-info-texto fe-center-x mt--6">
                            <div class="h2 font-weight-900">{{ $info['title'] }}</div>
                            <div class="h3 font-weight-900 text-muted">{{ $info['description'] }}</div>
                        </div>
                        <img src="{{ url('img/auth/' . $info['image']) }}" class="fe-auth-info-imagem" alt="">
                    @endforeach
                </div>
                <!-- cadastro -->
                <div class="col-lg-5 fe-z-1 mt--3">
                    <!-- card -->
                    <div class="card fe-card-sm-transparent bg-secondary border-0 mb-md-5">
                        <div class="card-body pt-5 px-1 px-sm-5 px-lg-5">
                            <div class="text-left text-monospace mb-4">
                                <h3>
                                    <b>{{ __('Cadastro') }}</b>
                                </h3>
                            </div>
                            <!-- form -->
                            <form id="form-register" method="post" action="{{ route('register') }}" role="form" autocomplete="off" novalidate onsubmit="return $(this).valid() && grecaptcha.getResponse() !== ''">
                                @csrf
                                <!-- inputs -->
                                <div class="row">
                                    <!-- nome -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="name">{{ __('Nome completo') }}</label>
                                            <div class="input-group input-group-merge validate-name">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                                        <i class="fas fa-user"></i>
                                                    </span>
                                                </div>
                                                <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('no mínimo 3 caracteres') }}">*</span>
                                                <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="{{ __('Nome completo') }}" value="{{ old('name') }}" minlength="3" maxlength="191" required onkeypress="return soLetras(event);" onkeyup="letraMaiuscula('name');" @if ($errors->has('name')) autofocus @endif>
                                            </div>
                                            <!-- alerta de erro -->
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback" role="alert">{{ $errors->first('name') }}</div>
                                            @endif
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
                                                <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('e-mail válido') }}">*</span>
                                                <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="{{ __('E-mail') }}" value="{{ old('email') }}" maxlength="191" required @if ($errors->has('email')) autofocus @endif>
                                            </div>
                                            <!-- alerta de erro -->
                                            @if ($errors->has('email'))
                                                <div class="invalid-feedback" role="alert">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- senha -->
                                    <div class="col-lg-6">
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
                                                <div class="input-group-append" onclick="verSenha(this);">
                                                    <span class="input-group-text">
                                                        <i class="fe-input-icone far fa-eye"></i>
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
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="password-confirmation">{{ __('Confirme a senha') }}</label>
                                            <div class="input-group input-group-merge validate-password-confirmation">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}">
                                                        <i class="fas fa-key"></i>
                                                    </span>
                                                </div>
                                                <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('repetir a senha') }}">*</span>
                                                <input type="password" id="password-confirmation" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" placeholder="{{ __('Confirme') }}" minlength="8" maxlength="191" required autocomplete="password-confirmation">
                                                <!-- visualizar ou ocultar senha -->
                                                <div class="input-group-append" onclick="verSenha(this);">
                                                    <span class="input-group-text">
                                                        <i class="fe-input-icone far fa-eye"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <!-- alerta de erro -->
                                            @if ($errors->has('password_confirmation'))
                                                <div class="invalid-feedback" role="alert">{{ $errors->first('password_confirmation') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- reCAPTCHA -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="input-group input-group-merge validate-g-recaptcha-response fe-recaptcha mr--4 mt-2">{!! Recaptcha::render() !!}</div>
                                            <!-- alerta de erro -->
                                            <div id="g-recaptcha-error"></div>
                                            @if ($errors->has('g-recaptcha-response'))
                                                <div class="invalid-feedback" role="alert">{{ $errors->first('g-recaptcha-response') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- botão -->
                                <div class="text-center mb-4 mt-2">
                                    <button type="submit" class="btn btn-primary btn-block fe-recaptcha-carregando fe-scroll-top">{{ __('Registrar') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- validate -->
    @include('auth.includes.validate')

@endsection
