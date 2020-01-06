@extends('layouts.app', ['sidebarMenu' => $page['menu'], 'sidebarItem' => $page['item']])
@section('title', $page['item_name'])

@section('content')

    <!-- breadcrumbs -->
    @component('layouts.components.breadcrumbs')
        @slot('title'){{ $page['menu_name'] }}@endslot
        <li class="breadcrumb-item"><a href="{{ app('router')->has($list['router']) ? route($list['router']) : url('/') }}">{{ $list['item_name'] }}</a></li>
        <li class="breadcrumb-item fe-mouse active" aria-current="page">@yield('title')</li>
        @slot('xl')@endslot

        @slot('link')
            <!-- lista -->
            @component('layouts.components.button', [
                'text'   => 'Apartamentos',
                'title'  => '',
                'button' => $list['button'],
                'router' => $list['router'],
                'group'  => $list['group'],
                'route'  => $list['route'],
                'menu'   => $list['menu'],
                'item'   => $list['item'],
                'color'  => 'success',
                'size'   => 'sm',
                'icon'   => 'fas fa-list-ul'
            ])@endcomponent
        @endslot
    @endcomponent

    <!-- dashboard -->
    @include('condominium.apartments.dashboard.cards')

@endsection
