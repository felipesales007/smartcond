@extends('layouts.app')
@section('title', __('Dashboard de empresas'))

@section('content')

    <!-- breadcrumbs e cards -->
    @component('layouts.headers.background')
        @component('layouts.headers.breadcrumbs')
            @slot('title')
                {{ __('Empresas') }}
            @endslot

            <li class="breadcrumb-item fe-mouse-default active" aria-current="page">@yield('title')</li>
        @endcomponent

        @include('companies.dashboard.cards')
    @endcomponent

@endsection
