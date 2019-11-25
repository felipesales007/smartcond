@extends('layouts.app', ['sidebarMenu' => '8', 'sidebarItem' => '92'])
@section('title', \App\Models\Menu\MenuItem::getMenuItem(92)['name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ 8 }}@endslot
        <li class="breadcrumb-item"><a href="{{ app('router')->has('inventory.list') ? route('inventory.list') : url('/') }}">{{ \App\Models\Menu\MenuItem::getMenuItem(93)['name'] }}</a></li>
        <li class="breadcrumb-item fe-mouse active" aria-current="page">@yield('title')</li>
        @slot('xl')@endslot

        @slot('link')
            <!-- lista -->
            @component('layouts.components.button', [
                'text'   => 'Inventário',
                'button' => '',
                'router' => 'inventory.list',
                'group'  => '12',
                'route'  => '91',
                'menu'   => '8',
                'item'   => '93',
                'color'  => 'success',
                'size'   => 'sm',
                'title'  => '',
                'icon'   => 'fas fa-list-ul'
            ])@endcomponent
        @endslot
    @endcomponent

    <!-- dashboard -->
    @include('administrative.inventories.inventories.dashboard.cards')

@endsection
