@extends('layouts.app')
@section('title', __('Dashboard de menu e itens do menu'))

@section('content')

    <!-- breadcrumbs e cards -->
    @component('layouts.headers.background')
        @component('layouts.headers.breadcrumbs')
            @slot('title')
                {{ __('Menu e Itens') }}
            @endslot

            <li class="breadcrumb-item fe-mouse-default active" aria-current="page">@yield('title')</li>
        @endcomponent

        <div class="mb-xl-5">
            @include('menu.menu.dashboard.cards')
        </div>
        <div class="mt-xl--3">
            @include('menu.menu-item.dashboard.cards')
        </div>
    @endcomponent

@endsection
