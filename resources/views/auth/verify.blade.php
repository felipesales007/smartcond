@extends('layouts.app')
@section('title', __('Verificação de e-mail'))

@section('content')

    <!-- confirmação de e-mail -->
    <div class="container mt--5">
        <div class="fe-center-auth">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7 fe-z-1">
                    <!-- card -->
                    <div class="card fe-card-sm-transparent bg-secondary border-0 mb-md-5">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <b>
                                    <small>{{ __('Verifique seu endereço de e-mail') }}</small>
                                </b>
                            </div>
                            <!-- alerta de status -->
                            @if (session('resent'))
                                <div class="alert alert-success alert-dismissible fade show mt--2" role="alert">
                                    <span class="alert-text">{{ __('Um novo link de confirmação de verificação de e-mail foi enviado para o seu endereço de e-mail.') }}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            {{ __('Antes de prosseguir, verifique seu endereço de e-mail em busca de um link de verificação.') }}

                            {{ __('Se você não recebeu o email') }}, <a href="{{ app('router')->has('verification.resend') ? route('verification.resend') : url('/') }}" class="text-success fe-loading" onclick="enviando();">{{ __('clique aqui para solicitar outro') }}</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
