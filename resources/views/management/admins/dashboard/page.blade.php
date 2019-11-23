@extends('layouts.app', ['sidebarMenu' => '6', 'sidebarItem' => '6'])
@section('title', \App\Models\Menu\MenuItem::getMenuItem(6)['name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ 6 }}@endslot
        <li class="breadcrumb-item"><a href="{{ app('router')->has('admin.list') ? route('admin.list') : url('/') }}">{{ \App\Models\Menu\MenuItem::getMenuItem(7)['name'] }}</a></li>
        <li class="breadcrumb-item fe-mouse active" aria-current="page">@yield('title')</li>
        @slot('xl')@endslot

        @slot('link')
            <!-- lista -->
            @component('layouts.components.button', [
                'text'   => 'Administradores',
                'button' => '',
                'router' => 'admin.list',
                'group'  => '3',
                'route'  => '6',
                'menu'   => '6',
                'item'   => '7',
                'color'  => 'success',
                'size'   => 'sm',
                'title'  => '',
                'icon'   => 'fas fa-list-ul'
            ])@endcomponent
        @endslot
    @endcomponent

    <!-- dashboard -->
    @include('management.admins.dashboard.cards')
    @include('management.admins.dashboard.statistics')

@endsection
