@extends('layouts.app', ['sidebarMenu' => '6', 'sidebarItem' => '40'])
@section('title', \App\Models\Menu\MenuItem::getMenuItem(40)['name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ 6 }}@endslot
        <li class="breadcrumb-item"><a href="{{ app('router')->has('entity.list') ? route('entity.list') : url('/') }}">{{ \App\Models\Menu\MenuItem::getMenuItem(41)['name'] }}</a></li>
        <li class="breadcrumb-item fe-mouse active" aria-current="page">@yield('title')</li>
        @slot('xl')@endslot

        @slot('link')
            <!-- lista -->
            @component('layouts.components.button', [
                'text'   => 'Entidades',
                'button' => '',
                'router' => 'entity.list',
                'group'  => '6',
                'route'  => '40',
                'menu'   => '6',
                'item'   => '41',
                'color'  => 'success',
                'size'   => 'sm',
                'title'  => '',
                'icon'   => 'fas fa-list-ul'
            ])@endcomponent
        @endslot
    @endcomponent

    <!-- dashboard -->
    @include('management.entities.dashboard.cards')

@endsection
