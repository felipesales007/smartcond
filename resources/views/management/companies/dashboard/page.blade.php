@extends('layouts.app', ['sidebarMenu' => '6', 'sidebarItem' => '28'])
@section('title', \App\Models\Menu\MenuItem::getMenuItem(28)['name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ 6 }}@endslot
        <li class="breadcrumb-item"><a href="{{ app('router')->has('company.list') ? route('company.list') : url('/') }}">{{ \App\Models\Menu\MenuItem::getMenuItem(29)['name'] }}</a></li>
        <li class="breadcrumb-item fe-mouse active" aria-current="page">@yield('title')</li>
        @slot('xl')@endslot

        @slot('link')
            <!-- lista -->
            @component('layouts.components.button', [
                'text'   => 'Empresas',
                'button' => '',
                'router' => 'company.list',
                'group'  => '5',
                'route'  => '28',
                'menu'   => '6',
                'item'   => '29',
                'color'  => 'success',
                'size'   => 'sm',
                'title'  => '',
                'icon'   => 'fas fa-list-ul'
            ])@endcomponent
        @endslot
    @endcomponent

    <!-- dashboard -->
    @include('management.companies.dashboard.cards')

@endsection
