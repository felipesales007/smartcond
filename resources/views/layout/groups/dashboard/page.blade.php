@extends('layouts.app', ['sidebarMenu' => '7', 'sidebarItem' => '56'])
@section('title', \App\Models\Menu\MenuItem::getMenuItem(56)['name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ 7 }}@endslot
        <li class="breadcrumb-item"><a href="{{ app('router')->has('group.list') ? route('group.list') : url('/') }}">{{ \App\Models\Menu\MenuItem::getMenuItem(57)['name'] }}</a></li>
        <li class="breadcrumb-item fe-mouse active" aria-current="page">@yield('title')</li>
        @slot('xl')@endslot

        @slot('link')
            <!-- lista -->
            @component('layouts.components.button', [
                'text'   => 'Grupos',
                'button' => '',
                'router' => 'group.list',
                'group'  => '8',
                'route'  => '55',
                'menu'   => '7',
                'item'   => '57',
                'color'  => 'success',
                'size'   => 'sm',
                'title'  => '',
                'icon'   => 'fas fa-list-ul'
            ])@endcomponent
        @endslot
    @endcomponent

    <!-- dashboard -->
    @include('layout.groups.dashboard.cards')

@endsection
