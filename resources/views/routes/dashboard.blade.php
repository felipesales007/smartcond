@extends('layouts.app')
@section('title', __('Dashboard de grupos e rotas'))

@section('content')

    <!-- breadcrumbs e cards -->
    @component('layouts.headers.background')
        @component('layouts.headers.breadcrumbs')
            @slot('title')
                {{ __('Grupos e Rotas') }}
            @endslot

            <li class="breadcrumb-item fe-mouse-default active" aria-current="page">@yield('title')</li>
        @endcomponent

        <div class="mb-xl-5">
            @include('routes.groups.dashboard.cards')
        </div>
        <div class="mt-xl--3">
            @include('routes.routes.dashboard.cards')
        </div>
    @endcomponent

@endsection
