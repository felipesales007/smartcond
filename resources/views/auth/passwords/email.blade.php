@extends('layouts.app')
@section('title', __('Recuperar senha'))

@section('content')

    <!-- recuperar senha -->
    <div class="container mt--5">
        <div class="fe-center-auth">
            <div class="row justify-content-center">
                <div class="col-lg-12 fe-auth-corpo-width fe-z-1">
                    <!-- card -->
                    <div class="card fe-card-sm-transparent bg-secondary border-0 mb-md-5">
                        <div class="card-body pt-5 px-1 px-sm-5 px-lg-5">
                            <div class="text-left text-monospace mb-4">
                                <h3>
                                    <b>{{ __('Recuperar senha') }}</b>
                                </h3>
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
                            <form id="form-password-reset" method="post" action="{{ app('router')->has('password.email') ? route('password.email') : url('/') }}" role="form" autocomplete="off" novalidate>
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
                                                <span class="fe-star" data-toggle="tooltip" data-placement="top" title="{{ __('e-mail cadastrado') }}">*</span>
                                                <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="{{ __('E-mail') }}" value="{{ old('email') }}" maxlength="191" required autocomplete="email" @if ($errors->has('email')) autofocus @endif>
                                            </div>
                                            <!-- alerta de erro -->
                                            @if ($errors->has('email'))
                                                <div class="invalid-feedback" role="alert">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- alinhamento -->
                                    <div class="col-lg-12 fe-hidden mt--5">
                                        <div class="input-group">
                                            <span class="input-group-text"></span>
                                            <label for="alinhamento"></label>
                                            <input id="alinhamento">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 fe-hidden mt--5"></div>
                                </div>
                                <!-- botão -->
                                <div class="text-center mb-4 mt-2">
                                    <button type="submit" class="btn btn-dark btn-block fe-carregando fe-scroll-top">{{ __('Recuperar') }}</button>
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
