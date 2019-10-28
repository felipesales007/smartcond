@extends('layouts.app')
@section('title', __('Dashboard de inventário'))

@section('content')

    <!-- breadcrumbs e cards -->
    @component('layouts.headers.background')
        @component('layouts.headers.breadcrumbs')
            @slot('title')
                {{ __('Inventário') }}
            @endslot

            <li class="breadcrumb-item fe-mouse-default active" aria-current="page">@yield('title')</li>
        @endcomponent

        <div class="mb-xl-5">
            @include('inventories.inventories.dashboard.cards')
        </div>
        <div class="mt-xl--3">
            @include('inventories.inventory-categories.dashboard.cards')
        </div>
    @endcomponent

@endsection
