@extends('layouts.app')
@section('title', __('Dashboard de condomínios'))

@section('content')

    <!-- breadcrumbs e cards -->
    @component('layouts.headers.background')
        @component('layouts.headers.breadcrumbs')
            @slot('title')
                {{ __('Entidades') }}
            @endslot

            <li class="breadcrumb-item fe-mouse-default active" aria-current="page">@yield('title')</li>
        @endcomponent

        @include('entities.dashboard.cards')
    @endcomponent

@endsection
