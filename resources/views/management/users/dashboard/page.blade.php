@extends('layouts.app', ['sidebarMenu' => '6', 'sidebarItem' => '17'])
@section('title', \App\Models\Menu\MenuItem::getMenuItem(17)['name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ 6 }}@endslot
        <li class="breadcrumb-item"><a href="{{ app('router')->has('user.list') ? route('user.list') : url('/') }}">{{ \App\Models\Menu\MenuItem::getMenuItem(18)['name'] }}</a></li>
        <li class="breadcrumb-item fe-mouse active" aria-current="page">@yield('title')</li>
        @slot('xl')@endslot

        @slot('link')
            <!-- lista -->
            @component('layouts.components.button', [
                'text'   => 'Usuários',
                'button' => '',
                'router' => 'user.list',
                'group'  => '4',
                'route'  => '17',
                'menu'   => '6',
                'item'   => '18',
                'color'  => 'success',
                'size'   => 'sm',
                'title'  => '',
                'icon'   => 'fas fa-list-ul'
            ])@endcomponent
        @endslot
    @endcomponent

    <!-- dashboard -->
    @include('management.users.dashboard.cards')
    @include('management.users.dashboard.statistics')

@endsection
