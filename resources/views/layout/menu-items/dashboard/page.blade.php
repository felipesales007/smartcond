@extends('layouts.app', ['sidebarMenu' => '7', 'sidebarItem' => '83'])
@section('title', \App\Models\Menu\MenuItem::getMenuItem(83)['name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ 7 }}@endslot
        <li class="breadcrumb-item"><a href="{{ app('router')->has('menu.item.list') ? route('menu.item.list') : url('/') }}">{{ \App\Models\Menu\MenuItem::getMenuItem(84)['name'] }}</a></li>
        <li class="breadcrumb-item fe-mouse active" aria-current="page">@yield('title')</li>
        @slot('xl')@endslot

        @slot('link')
            <!-- lista -->
            @component('layouts.components.button', [
                'text'   => 'Itens do menu',
                'button' => '',
                'router' => 'menu.item.list',
                'group'  => '11',
                'route'  => '82',
                'menu'   => '7',
                'item'   => '84',
                'color'  => 'success',
                'size'   => 'sm',
                'title'  => '',
                'icon'   => 'fas fa-list-ul'
            ])@endcomponent
        @endslot
    @endcomponent

    <!-- dashboard -->
    @include('layout.menu-items.dashboard.cards')

@endsection
