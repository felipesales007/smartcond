@extends('layouts.app')
@section('title', __('Confirmar senha'))

@section('content')

    <!-- fundo -->
    <div class="bg-gradient-primary pb-7 pb-xl-7 pt-4 pt-md-7 pt-xl-7"></div>

    <!-- recuperar senha -->
    <div class="container mt-md--8 mt-lg--9 mt--6">
        <div class="fe-center-auth">
            <div class="row justify-content-center">
                <div class="col-lg-12 fe-auth-corpo-width fe-z-1">
                    <!-- card -->
                    <div class="card fe-card-sm-transparent bg-secondary border-0 mb-md-5">
                        <div class="card-body pt-5 px-1 px-sm-5 px-lg-5">
                            <div class="text-left text-monospace mb-4">
                                <h3>
                                    <b>{{ __('Confirme a senha') }}</b>
                                </h3>
                                <small>{{ __('Confirme sua senha antes de continuar.') }}</small>
                            </div>
                            <!-- alerta de status -->
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show mt--2" role="alert">
                                    <span class="alert-text">{{ session('status') }}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <!-- form -->
                            <form id="form-password-confirm" method="post" action="{{ app('router')->has('password.confirm') ? route('password.confirm') : url('/') }}" role="form" autocomplete="off" novalidate>
                            @csrf
                            <!-- inputs -->
                                <div class="row">
                                    <!-- senha -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="password">{{ __('Senha') }}</label>
                                            <div class="input-group input-group-merge validate-password">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text @error('password') is-invalid @enderror">
                                                        <i class="fas fa-key"></i>
                                                    </span>
                                                </div>
                                                <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('confirme sua senha para continuar') }}">*</span>
                                                <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="{{ __('Senha') }}" minlength="8" maxlength="191" required autocomplete="password" @if ($errors->has('password')) autofocus @endif>
                                                <!-- visualizar ou ocultar senha -->
                                                <div class="input-group-append" onclick="verSenha(this);">
                                                    <span class="input-group-text @error('password') is-invalid @enderror">
                                                        <i class="fe-input-icone far fa-eye"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <!-- alerta de erro -->
                                            @error('password')
                                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- botão -->
                                <div class="text-center mb-4 mt-2">
                                    <button type="submit" class="btn btn-primary btn-block fe-carregando fe-scroll-top">{{ __('Confirmar senha') }}</button>
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
