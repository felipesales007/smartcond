@extends('layouts.app')
@section('title', __('Dashboard de administradores'))

@section('content')

    <!-- breadcrumbs e cards -->
    @component('layouts.headers.background')
        @component('layouts.headers.breadcrumbs')
            @slot('title')
                {{ __('Administradores') }}
            @endslot

            <li class="breadcrumb-item fe-mouse-default active" aria-current="page">@yield('title')</li>
        @endcomponent

        @include('admins.dashboard.cards')
    @endcomponent

    @include('admins.dashboard.statistics')

@endsection
