<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- cabeçalho -->
        @include('layouts.import.head')

        <!-- título da aba -->
        <title>{{ config('app.name', 'Smartcond') }} - @yield('title')</title>

        <!-- fonte -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">

        <!-- css -->
        <link rel="stylesheet" href="{{ asset('css/error.css') }}">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title">
                    @yield('message')
                </div>
            </div>
        </div>
    </body>
</html>
