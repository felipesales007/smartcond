@extends('layouts.app', ['sidebarMenu' => '7', 'sidebarItem' => '65'])
@section('title', \App\Models\Menu\MenuItem::getMenuItem(65)['name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ 7 }}@endslot
        <li class="breadcrumb-item"><a href="{{ app('router')->has('route.list') ? route('route.list') : url('/') }}">{{ \App\Models\Menu\MenuItem::getMenuItem(66)['name'] }}</a></li>
        <li class="breadcrumb-item fe-mouse active" aria-current="page">@yield('title')</li>
        @slot('xl')@endslot

        @slot('link')
            <!-- lista -->
            @component('layouts.components.button', [
                'text'   => 'Rotas',
                'button' => '',
                'router' => 'route.list',
                'group'  => '9',
                'route'  => '64',
                'menu'   => '7',
                'item'   => '66',
                'color'  => 'success',
                'size'   => 'sm',
                'title'  => '',
                'icon'   => 'fas fa-list-ul'
            ])@endcomponent
        @endslot
    @endcomponent

    <!-- dashboard -->
    @include('layout.routes.dashboard.cards')

@endsection
