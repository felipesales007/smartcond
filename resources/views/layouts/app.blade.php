<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- cabeçalho -->
        @include('layouts.import.head')

        <!-- título da aba -->
        <title>{{ config('app.name', 'Smartcond') }} - @yield('title')</title>

        <!-- css -->
        @include('layouts.import.css')

        <!-- javascript prioritário -->
        @include('layouts.import.js-head')
    </head>
    <body class="{{ $class ?? '' }}" ondragstart="return false;">
        <!-- carregando -->
        <div class="fe-bg-loader"></div>
        <div class="fe-loader"></div>

        <!-- barra e menu lateral -->
        @auth()
            <form id="form-logout" method="post" action="{{ app('router')->has('logout') ? route('logout') : url('/') }}" class="d-none">
                @csrf
            </form>
            @if (!Illuminate\Support\Facades\Request::is('verificar/email'))
                @include('layouts.navbars.sidebar')
            @endif
        @endauth

        <!-- corpo -->
        <div class="main-content">
            @include('layouts.navbars.navbar')
            @yield('content')
            @auth()
                @include('layouts.import.includes')
            @endif
        </div>

        <!-- rodapé -->
        @auth()
            @if (!Illuminate\Support\Facades\Request::is('verificar/email'))
                @include('layouts.footers.access.auth')
            @else
                @include('layouts.footers.access.guest')
            @endif
        @endauth
        @guest()
            @include('layouts.footers.access.guest')
        @endguest

        <!-- javascript -->
        @include('layouts.import.js')
    </body>
</html>
