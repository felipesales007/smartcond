@extends('layouts.app')
@section('title', __('Login'))

@section('content')

    <!-- informativo e login -->
    <div class="container mt--3">
        <div class="fe-center-auth">
            <div class="row justify-content-center">
                <!-- informativo -->
                <div class="col-lg-6 mt-auto fe-z-1 fe-auth-info-corpo-login fe-mouse-default fe-mobile-none" onmousedown="return false;">
                    @foreach (\App\Models\AuthPicture::getRandAuthPicture() as $info)
                        <div class="text-center fe-auth-info-texto fe-center-x mt--6">
                            <div class="h2 font-weight-900">{{ $info['title'] }}</div>
                            <div class="h3 font-weight-900 text-muted">{{ $info['description'] }}</div>
                        </div>
                        <img src="{{ url('images/auth/' . $info['image']) }}" class="fe-auth-info-imagem" alt="">
                    @endforeach
                </div>
                <!-- login -->
                <div class="col-lg-5 fe-z-1">
                    <!-- card -->
                    <div class="card fe-card-sm-transparent bg-secondary border-0 mb-md-5">
                        <div class="card-body pt-5 px-1 px-sm-5 px-lg-5">
                            <div class="text-left text-monospace mb-4">
                                <h3>
                                    <b>{{ __('Entrar') }}</b>
                                </h3>
                            </div>
                            <!-- alerta de status -->
                            @if (session('status'))
                                <div class="alert alert-warning alert-dismissible fade show mt--2" role="alert">
                                    <span class="alert-text">{!! session('status') !!}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <!-- form -->
                            <form id="form-login" method="post" action="{{ app('router')->has('login') ? route('login') : url('/') }}" role="form" autocomplete="off" novalidate>
                                @csrf
                                <!-- inputs -->
                                <div class="row">
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
                                    <!-- lembrar me -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-merge validate-remember">
                                                <div class="custom-control custom-checkbox custom-checkbox-dark">
                                                    <input type="checkbox" id="remember" name="remember" class="custom-control-input" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="custom-control-label text-muted fe-checkbox-center" for="remember">{{ __('Lembrar-me') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- recuperar senha -->
                                    <div class="col-lg-6 text-right">
                                        <a href="{{ app('router')->has('password.request') ? route('password.request') : url('/') }}" class="text-link fe-loading fe-login-texto-senha">{{ __('Esqueci minha senha') }}</a>
                                    </div>
                                </div>
                                <!-- botão -->
                                <div class="text-center mb-4">
                                    <button type="submit" class="btn btn-dark btn-block fe-carregando fe-scroll-top">{{ __('Entrar') }}</button>
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
