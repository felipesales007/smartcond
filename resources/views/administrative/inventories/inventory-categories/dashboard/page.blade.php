@extends('layouts.app', ['sidebarMenu' => '8', 'sidebarItem' => '101'])
@section('title', \App\Models\Menu\MenuItem::getMenuItem(101)['name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ 8 }}@endslot
        <li class="breadcrumb-item"><a href="{{ app('router')->has('inventory.category.list') ? route('inventory.category.list') : url('/') }}">{{ \App\Models\Menu\MenuItem::getMenuItem(102)['name'] }}</a></li>
        <li class="breadcrumb-item fe-mouse active" aria-current="page">@yield('title')</li>
        @slot('xl')@endslot

        @slot('link')
            <!-- lista -->
            @component('layouts.components.button', [
                'text'   => 'Categorias',
                'button' => '',
                'router' => 'inventory.category.list',
                'group'  => '13',
                'route'  => '100',
                'menu'   => '8',
                'item'   => '102',
                'color'  => 'success',
                'size'   => 'sm',
                'title'  => '',
                'icon'   => 'fas fa-list-ul'
            ])@endcomponent
        @endslot
    @endcomponent

    <!-- dashboard -->
    @include('administrative.inventories.inventory-categories.dashboard.cards')

@endsection
