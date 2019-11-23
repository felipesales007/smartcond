@extends('layouts.app', ['sidebarMenu' => '7', 'sidebarItem' => '74'])
@section('title', \App\Models\Menu\MenuItem::getMenuItem(74)['name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ 7 }}@endslot
        <li class="breadcrumb-item"><a href="{{ app('router')->has('menu.list') ? route('menu.list') : url('/') }}">{{ \App\Models\Menu\MenuItem::getMenuItem(75)['name'] }}</a></li>
        <li class="breadcrumb-item fe-mouse active" aria-current="page">@yield('title')</li>
        @slot('xl')@endslot

        @slot('link')
            <!-- lista -->
            @component('layouts.components.button', [
                'text'   => 'Menu',
                'button' => '',
                'router' => 'menu.list',
                'group'  => '10',
                'route'  => '73',
                'menu'   => '7',
                'item'   => '75',
                'color'  => 'success',
                'size'   => 'sm',
                'title'  => '',
                'icon'   => 'fas fa-list-ul'
            ])@endcomponent
        @endslot
    @endcomponent

    <!-- dashboard -->
    @include('layout.menu.dashboard.cards')

@endsection
