@extends('layouts.app')
@section('title', __('Dashboard de usuários'))

@section('content')

    <!-- breadcrumbs e cards -->
    @component('layouts.headers.background')
        @component('layouts.headers.breadcrumbs')
            @slot('title')
                {{ __('Usuários') }}
            @endslot

            <li class="breadcrumb-item fe-mouse-default active" aria-current="page">@yield('title')</li>
        @endcomponent

        @include('users.dashboard.cards')
    @endcomponent

    @include('users.dashboard.statistics')

@endsection
